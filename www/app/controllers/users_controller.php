<?php

class UsersController extends AppController
{
	var $name = 'Users';
	var $uses = array('User');
	var $components = array('Auth', 'Cookie', 'Session', 'QRMaker');
	
	/**
	 * 
	 */
	function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('register', 'login', 'logout', 'isFree', 'kiosk_data');
		$this->User->contain();
	}
	
	/**
	 * 
	 */
	function index()
	{
		
	}
	
	/**
	 * Accepts POST data to register a new user
	 */
	function register()
	{
		if($this->data)
		{
			if(!$this->isFree($this->data['User']['name'], true))
			{
				$this->Session->setFlash('Username "' . $this->data['User']['name'] . '" is already in use.');
				unset($this->data['User']['password']);
				unset($this->data['User']['password2']);
				$this->redirect('/menus');
			}
			
			else if($this->data['User']['password'] == 
					$this->Auth->password($this->data['User']['password2']))
			{
				if($this->User->save($this->data))
				{
					$this->Auth->login();
					$this->redirect('/menus/registration_successful');
				}
			}
			
			else
			{
				$this->setFlash('You did not enter the same password twice.');
				unset($this->data['User']['password']);
				unset($this->data['User']['password2']);
				$this->redirect('/menus');
			}
		}
		
		else
		{
			$this->redirect('/menus');
		}
	}
	
	/**
	 * Find out if a user name is already used or not.  Returns plain JSON content.
	 * @param $name String the name to check
	 */
	function isFree($name, $return = false)
	{
		$isValid = $this->User->validName($name);
		
		if($isValid != 1)
		{
			$this->set('content', '{ "response": "' . $isValid . '" }');
			$this->layout = '/js/default';
			$this->render('/common/plain');
		}
		
		else
		{
			$isFree = $this->User->find('count', array('conditions' => array('name' => $name)));
			$isFree = $isFree ? '0' : '1';
			
			$this->set('content', '{ "response": "' . $isFree . '" }');
			
			if($return) return $isFree;
			
			$this->layout = '/js/default';
			$this->render('/common/plain');
		}
	}
	
	/**
	 * Shows the user their uplink image
	 */
	function uplink()
	{
		//Retrieve the user's AR marker from the file system
		$code = $this->Auth->user('ar_marker_id');
		$this->set('markerCode', $code);
		$this->set('markerURL', $this->QRMaker->getMarkerImageURL($code));
		$this->set('zoomable_for_layout', 'true');
	}
	
	/**
	 * 
	 */
	function kiosk_data($arMarkerId)
	{
		//Retrieve data based on user QR 
		$this->User->contain();
		
		$user = $this->User->find('first', array(
			'fields' => array('User.id', 'User.name', 'User.team_id'),
			'conditions' => array('User.ar_marker_id' => $arMarkerId)
		));
		
		if($user['User']['team_id'])
		{
			$this->loadModel('Team');
			$this->Team->contain();
			
			$team = $this->Team->find('first', array(
				'fields' => array('Team.name'),
				'conditions' => array('Team.id' => $user['User']['team_id'])
			));
			$this->set('team', $team);
		}
		
		$this->loadModel('Round');
		$this->Round->contain('Project.asset_id', 'Part.id');
		
		$round = $this->Round->find('all', array(
			'fields' => array('Round.dt_completed', 'Round.user_id', 'Round.team_id'),
			'conditions' => array('OR' => array(
				array('team_id' => $user['User']['team_id']),
				array('user_id' => $user['User']['id'])
			))
		));
		
		$this->set('user', $user);
		$this->set('round', $round);
		$this->set('leaders', $this->getLeaders());
		$this->layout = '/xml/default';
	}
	
	/**
	 * $$todo fetch the latest leaderboard standing
	 */
	private function getLeaders()
	{
		$this->loadModel('Leader');
		
		//Get the last time stamp from the cron
		$lastTimeRow = $this->Leader->query('SELECT MAX(Leader.dt_entered) AS dt_entered ' .
			'FROM leaders Leader ' .
			'LIMIT 1'
		);
		
		$lastTime = $lastTimeRow[0][0]['dt_entered'];
		
		//Get the leading users
		$userRows = $this->Leader->find('all', array(
			'fields' => array('user_name'),
			'conditions' => array('user_name NOT ' => '', 'dt_entered' => $lastTime),
			'order' => 'rank',
			'limit' => 10
		));
		
		$users = array();
		$userCt = count($userRows);
		
		for($i = 0; $i < 10; $i++)
		{
			$user = $i < $userCt ? $userRows[$i]['Leader']['user_name'] : '.';
			array_push($users, $user);
		}
		
		//Get the leading teams
		$teamRows = $this->Leader->find('all', array(
			'fields' => array('team_name'),
			'conditions' => array('team_name NOT ' => '', 'dt_entered' => $lastTime),
			'order' => 'rank',
			'limit' => 10
		));
		
		$teams = array();
		$teamCt = count($teamRows);
		
		for($i = 0; $i < 10; $i++)
		{
			$team = $i < $teamCt ? $teamRows[$i]['Leader']['team_name'] : '.';
			array_push($teams, $team);
		}
		
		//debug($users);
		//debug($teams);
		
		return array(
			'Team' => $teams,
			'User' => $users
		);
	}
	
	/**
	 * 
	 */
	function login()
	{}
	
	/**
	 * 
	 */
	function logout()
	{
		$this->redirect($this->Auth->logout());
	}
	
}