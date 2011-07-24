<?php 

class RoundsController extends AppController
{
	var $name = 'Rounds';
	var $adminActions = array();
	var $uses = array('Round');
	var $components = array('Session', 'Auth', 'Cookie', 'Messager');
	
	/**
	 * 
	 */
	function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->authorize = 'controller';
	}
	
	/**
	 * 
	 */
	function isAuthorized()
	{
		if(isset($this->adminActions[$this->action])) return $this->Auth->user('role') == admin;
		return true;
	}
	
	/**
	 * 
	 */
	function index()
	{
		$this->loadModel('Project');
		$this->Project->contain('Round');
		$projects = $this->Project->find('all', array(
			'fields' => array('id', 'name', 'desc', 'asset_thumb_url'),
			'order' => 'name ASC'
		));
		
		for($i = 0; $i < count($projects); $i++)
		{
			$rounds = $projects[$i]['Round'];
			$started = 0;
			$completed = 0;
			
			for($j = 0; $j < count($rounds); $j++)
			{
				$started++;
				if($rounds[$j]['dt_completed'] > $rounds[$j]['dt_started']) $completed++;
			}
			
			$projects[$i]['Project']['rounds_started'] = $started;
			$projects[$i]['Project']['rounds_completed'] = $completed;
			unset($projects[$i]['Round']);
		}
		
		//$$testme count the number of parts in each project
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
			$this->set('currentProject', $currentProject);
		}
		
		$this->set('projects', $projects);
	}
	
	/**
	 *
	 */
	function start()
	{
		if($this->data)
		{
			$currentRound = $this->Round->find('first', array('conditions' => array('Round.id' => $this->Auth->user('current_round_id'))));
			
			if(!empty($currentRound))
			{
				//Can't start another round while playing one already
				$this->redirect('/rounds/stop/0/' . $this->data['Project']['id']);
			}
			
			else
			{
				$this->loadModel('Team');
				$this->loadModel('User');
				$projectId = (0 . str_replace('project-', '', $this->data['Project']['id']));
				
				$this->Team->contain('User');
				$teamAndUsers = $this->Team->find('first', array('conditions' => array('Team.id' => $this->Auth->user('team_id'))));
				
				debug($this->data);
				
				$this->Round->create();
				$this->Round->save(array(
					'team_id' => $this->Auth->user('team_id'),
					'project_id' => (0 . str_replace('project-', '', $this->data['Project']['id'])),
					'dt_started' => date('Y-m-d H:i:s')
				));
				
				$this->Round->contain();
				$round = $this->Round->find('first', array('conditions' => array('Round.id' => $this->Round->getLastInsertID())));
				
				debug($teamAndUsers);
				
				//Save the current round ID to each user row in the team
				for($i = 0; $i < count($teamAndUsers['User']); $i++)
				{
					$user = array('User' => array('id' => $teamAndUsers['User'][$i]['id'], 'current_round_id' => $round['Round']['id']));
					$result = $this->User->save($user);
				}
				
				$this->_refreshAuth();
				
				//$$testme dispatch a message to each user of the team signaling that the round has started
				$this->loadModel('Project');
				$project = $this->Project->find('first', array('conditions' => array('id' => $projectId)));
				
				$this->Messager->deliver(
					'round_started',
					array('projectId' => $projectId),
					'New Round: ' . $teamAndUsers['Team']['name'] . ' Seeks the ' . $project['Project']['name'],
					array('Team' => array('id' => $this->Auth->user('team_id'))),
					true
				);
			}
		}
		
		else $this->redirect('/rounds');
	}
	
	/**
	 *
	 */
	function stop($confirmed = null, $projectId = null)
	{
		if(!$this->Auth->user('current_round_id') || !$this->Auth->user('team_id')) $this->redirect('/rounds');
		
		if(!$confirmed)
		{
			$projectId = Sanitize::paranoid($projectId);
			
			if($projectId)
			{
				$this->loadModel('Project');
				$project = $this->Project->find('first', array('conditions' => array('id' => $projectId)));
				$this->set('project', $project);
				//$$todo redirect to the rounds/start action with the correctly formatted data.  Perhaps rejigger rounds/start from POST data to GET.
			}
			
			$this->render();
			return;
		}
		
		//$$testme force terminate the round of play for the team
		$this->loadModel('User');
		$this->User->contain();
		$roundUsers = $this->User->find('all', array('conditions' => array('current_round_id' => $this->Auth->user('current_round_id'))));
		
		debug($roundUsers);
		
		for($i = 0; $i < count($roundUsers); $i++)
		{
			$roundUsers[$i]['User']['current_round_id'] = null;
			$this->User->save($roundUsers[$i]['User']);
		}
		
		debug($this->Session->read('Auth.user'));
		$this->Session->write('Auth.user.current_round_id', null);
		
		$round = $this->Round->find('first', array('fields' => array('id', 'dt_canceled'), array('conditions' => array('id' => $this->Auth->user('current_round_id')))));
		$round['Round']['dt_canceled'] = date('Y-m-d H:i:s');
		$this->Round->save($round);
		
		$this->_refreshAuth();
		$this->render('/pages/round_stopped');
	}
}