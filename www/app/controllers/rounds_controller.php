<?php 

class RoundsController extends AppController
{
	var $name = 'Rounds';
	var $adminActions = array();
	var $uses = array('Round');
	
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
		$this->redirect('/menus');
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
				$this->redirect('/menus');
			}
			
			else
			{
				$this->loadModel('Team');
				$this->loadModel('User');
				
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
				
				//$$testme save the current round ID to each user row in the team
				for($i = 0; $i < count($teamAndUsers['User']); $i++)
				{
					$user = array('User' => array('id' => $teamAndUsers['User'][$i]['id'], 'current_round_id' => $round['Round']['id']));
					$result = $this->User->save($user);
				}
				
				//$$todo dispatch a message to each user of the team signaling that the round has started
				$this->_refreshAuth();
				//$this->redirect('/pages/round_started');
			}
		}
		
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
		
		$this->set('projects', $projects);
	}
	
	/**
	 *
	 */
	function stop($confirmed = null)
	{
		if(!$this->Auth->user('current_round_id'))
		{
			if(!$this->Auth->user('team_id'))
			{
				$this->render('/pages/no_team');
			}
			
			else $this->redirect('/rounds/start');
		}
		
		if(!$confirmed)
		{
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