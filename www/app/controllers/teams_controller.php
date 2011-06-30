<?php

class TeamsController extends AppController
{
	var $name = 'Teams';
	
	/**
	 * Register a new team, passing in an array of user IDs to associate to the new team
	 */
	function register()
	{
		//$$todo update each given user by setting their team IDs to the new row created by this process
		
		if($this->data)
		{
			if(!$this->Team->save($this->data))
			{
				$this->Session->setFlash('ERROR!  There was a problem while saving.');
			}
			
			else
			{
				$this->redirect('/pages/team_registration_successful');
			}
		}
	}
	
	/**
	 * Checks to see if the given team name is free for registration
	 */
	function isFree($name)
	{
		$name = Sanitize::paranoid($name);
		$exists = $this->Team->find('first', array('conditions' => array('name' => $name)));
		$exists = !empty($exists);
		
		$this->set('content', '{ "response": "' . $exists . '" }');
		
		$this->layout = '/layouts/js/default';
		$this->render('/common/plain');
	}
}