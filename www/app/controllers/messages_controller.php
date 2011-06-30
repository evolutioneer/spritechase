<?php

class MessagesController extends AppController
{
	var $name = 'Messages';
	
	/**
	 * Show the user all the messages they have received thus far
	 * $$testme messages controller is stubbed but not tested
	 */
	function index()
	{
		//If the user has an associated team ID, obtain all relevant messages
		if(!empty($this->Auth->user('team_id')))
		{
			$messages = $this->Message->find('all', array('conditions' => array(
				'OR' => array(
					'user_id' => $this->Auth->user('id'),
					'team_id' => $this->Auth->user('team_id')
				)
			)));
		}
		
		//If the user has no team ID, don't select on a null value; just select the user
		else {
			$messages = $this->Message->find('all', array('conditions' => array(
					'user_id' => $this->Auth->user('id')
			)));
		}
		
		$this->set('messages', $messages);
	}
}