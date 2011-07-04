<?php

class TeamsController extends AppController
{
	var $name = 'Teams';
	var $uses = array('Team', 'User');
	
	/**
	 * Register a new team, passing in an array of user IDs to associate to the new team
	 */
	function register()
	{
		//update each given user by setting their team IDs to the new row created by this process
		if($this->data)
		{
			$team = $this->Team->save($this->data);
			
			if(!$team)
			{
				$this->Session->setFlash('ERROR!  There was a problem while saving the team data.');
			}
			
			else
			{
				$team = $this->Team->find('first', array('conditions' => array('name' => $team['Team']['name'])));
				$success = true;
				
				foreach($this->data['User'] as $key => $value)
				{
					$user = array('User' => array(
						'id' => $key,
						'team_id' => $team['Team']['id']
					));
					
					$success = $this->User->save($user);
					
					if(!$success)
					{
						$this->Session->setFlash('ERROR!  There was a problem while ' .
							'saving user id: ' . $this->data['User'][$i]['id']);
					}
				}
				
				if($success) $this->redirect('/pages/team_registration_successful');
			}
		}
		
		$this->User->contain('Team.name');
		$users = $this->User->find('all', array('fields' => array('id', 'name', 'team_id')));
		$this->set('users', $users);
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