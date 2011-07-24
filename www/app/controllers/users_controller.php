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
		$this->Auth->allow('register', 'login', 'logout', 'isFree');
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