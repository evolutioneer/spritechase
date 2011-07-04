<?php

class UsersController extends AppController
{
	var $name = 'Users';
	var $uses = array('User');
	var $components = array('Auth', 'Cookie', 'Session', 'QRMaker');
	
	function beforeFilter()
	{
		parent::beforeFilter();
		App::import('Sanitize');
	}
	
	/**
	 * 
	 */
	function index()
	{
		
	}
	
	/**
	 * Accepts POST data to register a new user.  After registration, the user is forwarded
	 * to their menu home screen.
	 */
	function register()
	{
		if($this->data)
		{
			if($this->isFree($this->data['User']['name'], true))
			{
				$this->Session->setFlash('ERROR!  User name "' . $this->data['User']['name'] . '" is already in use.  Please try again.');
				unset($this->data['User']['password']);
			}
			
			else if($this->User->save($this->data))
			{
				$this->Auth->login();
				$this->redirect('/pages/user_registration_successful');
			}
			
			else
			{
				unset($this->data['User']['password']);
			}
		}
	}
	
	/**
	 * Find out if a user name is already used or not.  Returns plain JSON content.
	 * @param $name String the name to check
	 */
	function isFree($name, $return)
	{
		$name = Sanitize::paranoid($name);
		$isFree = $this->User->find('first', array('conditions' => array('name' => $name)));
		$isFree = empty($isFree) === 1;
		
		$this->set('content', '{ "response": "' . $isFree . '" }');
		
		if($return) return $isFree;
		
		$this->layout = '/js/default';
		$this->render('/common/plain');
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