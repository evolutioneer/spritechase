<?php 

class RoundsController extends AppController
{
	var $name = 'Rounds';
	var $adminActions = array(
		'stop'
	);
	
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
		//$$todo tell the user about their current round of play
	}
	
	/**
	 *
	 */
	function start()
	{
		
		if($this->data)
		{
			$currentRound = $this->Round->find('first', array('conditions' => array('id' => $this->Auth->user('current_round_id'))));
			
			if(!empty($currentRound))
			{
				$this->Session->setFlash('You can\'t start a new round;  you are playing one now!');
				$this->redirect('/round');
			}
			
			else
			{
				$this->loadModel('Team');
				
				$this->Team->contain('User');
				$team = $this->Team->find('first', array('conditions' => array('id' => $this->Auth->user('team_id'))));
				
				$round = $this->Round->create();
				
				//$$todo create and pouplate the round; save the round id to each user's data
				//$$todo dispatch a message to each user of the team signaling that the round has started
				
				$this->redirect('/pages/round_started');
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
	function stop($id)
	{
		//$$todo force terminate the round of play (admins only)
	}
}