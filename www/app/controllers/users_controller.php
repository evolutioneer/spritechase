<?php

class UsersController extends AppController
{
	var $name = 'Users';
	var $uses = array('User');
	
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
		//$$testme insert new row in database based on user registration
		if($this->data)
		{
			if($this->User->save($this->data))
			{
				$this->redirect('/pages/registration_successful');
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
	function isFree($name)
	{
		$name = Sanitize::paranoid($name);
		$exists = $this->User->find('first', array('conditions' => array('name' => $name)));
		$exists = !empty($exists);
		
		$this->set('content', '{ "response": "' . $exists . '" }');
		
		$this->layout = '/layouts/js/default';
		$this->render('/common/plain');
	}
	
	/**
	 * Shows the user their uplink image
	 */
	function uplink()
	{
		$this->set('code', $this->Auth->user('ar_marker_id'));
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