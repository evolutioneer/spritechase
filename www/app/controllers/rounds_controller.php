<?php 

class RoundsController extends AppController
{
	var $name = 'Rounds';
	var $adminActions = array();
	var $uses = array('Round');
	var $components = array('Session', 'Auth', 'Cookie', 'Messager');
	
	/**
	 *************************************************************************/
	/*function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->authorize = 'controller';
	}*/
	
	/**
	 *************************************************************************/
	/*function isAuthorized()
	{
		if(isset($this->adminActions[$this->action])) return $this->Auth->user('role') == admin;
		return true;
	}*/
	
	/**
	 *************************************************************************/
	function index()
	{
		$this->loadModel('Project');
		$this->Project->contain('Round');
		$projects = $this->Project->find('all', array(
			'fields' => array('id', 'name', 'desc'),
			'order' => 'name ASC'
		));
		
		for($i = 0; $i < count($projects); $i++)
		{
			$rounds = $projects[$i]['Round'];
			$started = 0;
			$completed = 0;
			
			for($j = 0; $j < count($rounds); $j++)
			{
				//$$testme only count rounds that have not been canceled in the start count
				if($rounds[$j]['dt_canceled'] < $rounds[$j]['dt_started']) $started++;
				if($rounds[$j]['dt_completed'] > $rounds[$j]['dt_started']) $completed++;
			}
			
			$projects[$i]['Project']['rounds_started'] = $started;
			$projects[$i]['Project']['rounds_completed'] = $completed;
			unset($projects[$i]['Round']);
		}
		
		//count the number of parts in each project
		$this->loadModel('PartsProject');
		$partCtRS = $this->PartsProject->find('all', array(
			'fields' => array('PartsProject.project_id, COUNT(PartsProject.part_id) AS part_ct'),
			'group' => 'PartsProject.project_id'
		));
		
		$projectPartCts = array();
		for($i = 0; $i < count($partCtRS); $i++) $projectPartCts[$partCtRS[$i]['PartsProject']['project_id']] = $partCtRS[$i][0]['part_ct'];
		$this->set('projectPartCts', $projectPartCts);
		
		//Set the project this user's team is currently playing, if any
		if($this->Auth->user('current_round_id'))
		{
			$this->Round->contain('Project.name');
			$currentProject = $this->Round->find('first', array('conditions' => array('Round.id' => $this->Auth->user('current_round_id'))));
			$elapsed = date_diff(new DateTime('now'), new DateTime($currentProject['Round']['dt_started']));
			$elapsed = $elapsed->format('%d days, %h hours, %i minutes, %s seconds');
			$elapsed = str_replace(array('0 days, ', '0 hours, ', '0 minutes, '), '', $elapsed);
			$currentProject['Project']['elapsed'] = $elapsed;
			$currentProject['Round']['is_solo'] = $currentProject['Round']['user_id'] == $this->Auth->user('id');
			$this->set('currentProject', $currentProject);
		}
		
		if($this->Auth->user('team_id'))
		{
			$this->loadModel('Team');
			$this->Team->contain();
			$team = $this->Team->find('first', array(
				'fields' => array('Team.name', 'Team.id'),
				'conditions' => array('id' => $this->Auth->user('team_id')
			)));
			
			$this->set('team', $team);
		}
		
		$this->set('secret', $this->Auth->password($this->Auth->user('id')));
		$this->set('userId', $this->Auth->user('id'));
		$this->set('projects', $projects);
	}
	
	/**
	 *************************************************************************/
	function start()
	{
		//Avoid hacks
		if(!$this->data || $this->data['secret'] != $this->Auth->password($this->Auth->user('id')))
		{
			$this->redirect('/rounds');
			return;
		}
		
		//Can't start another round while playing one already
		if($this->Auth->user('current_round_id'))
		{
			$this->redirect('/rounds');
			return;
		}
		
		//Create the Round record and save it
		$fields = array(
			'project_id' => (0 . str_replace('project-', '', $this->data['Project']['id'])),
			'dt_started' => date('Y-m-d H:i:s')
		);
		
		if($this->data['Project']['is_solo']) $fields['user_id'] = $this->Auth->user('id');
		else $fields['team_id'] = $this->Auth->user('team_id');
		
		$this->Round->create();
		$this->Round->save($fields);
		$round = $this->Round->find('first', array('conditions' => array('Round.id' => $this->Round->getLastInsertID())));
		
		$this->loadModel('User');
		$this->User->contain();
		
		//If solo, save the one user's record; 
		if($this->data['Project']['is_solo'])
		{
			$user = $this->User->find('first', array('conditions' => array('User.id' => $this->Auth->user('id'))));
			$user['User']['current_round_id'] = $round['Round']['id'];
			$this->User->save($user);
		}
		
		else
		{
			$this->loadModel('Team');
			$this->Team->contain('User');
			$team = $this->Team->find('first', array('conditions' => array('Team.id' => $this->Auth->user('team_id'))));
			
			//Save each user row associated with the project
			for($i = 0; $i < count($team['User']); $i++)
			{
				$user = $team['User'][$i];
				$user['current_round_id'] = $round['Round']['id'];
				$result = $this->User->save($user);
				
				if(!$result) debug ('User save failed: <br/>' . print_r($user, true));
			}
		}
		
		$this->_refreshAuth();
		
		//Dispatch a message to the appropriate recipients
		$this->loadModel('Project');
		$project = $this->Project->find('first', array('conditions' => array('Project.id' => $this->data['Project']['id'])));
		
		$recipients;
		$title;
		
		if($this->data['Project']['is_solo'])
		{
			$recipients = array('Team' => array('id' => $this->Auth->user('team_id')));
			$title = 'New Round: ' . $this->Auth->user('name') . ' Seeks the ' . $project['Project']['name'];
		}
		
		else
		{
			$recipients = array('User' => array('id' => $this->Auth->user('id')));
			$title = 'New Round: ' . $team['Team']['name'] . ' Seeks the ' . $project['Project']['name'];
		}
		
		$this->Messager->deliver(
			'round_started',
			array('roundId' => $round['Round']['id']),
			$title,
			$recipients,
			true
		);
	}
	
	/**
	 *************************************************************************/
	function stop()
	{
		if(!$this->Auth->user('current_round_id')) $this->redirect('/rounds');
		
		if($this->data)
		{
			if($this->data['secret'] != $this->Auth->password($this->Auth->user('id')))
			{
				$this->redirect('/menus');
				return;
			}
			
			$this->loadModel('User');
			$this->User->contain();
			$roundUsers = $this->User->find('all', array('conditions' => array('current_round_id' => $this->Auth->user('current_round_id'))));
			
			for($i = 0; $i < count($roundUsers); $i++)
			{
				$roundUsers[$i]['User']['current_round_id'] = null;
				$this->User->save($roundUsers[$i]['User']);
			}
			
			$round = $this->Round->find('first', array('fields' => array('id', 'dt_canceled'), array('conditions' => array('id' => $this->Auth->user('current_round_id')))));
			$round['Round']['dt_canceled'] = date('Y-m-d H:i:s');
			$this->Round->save($round);
			
			$this->_refreshAuth();
			$this->redirect('/rounds');
		}
		
		else
		{
			$this->set('secret', $this->Auth->password($this->Auth->user('id')));
		}
	}
}