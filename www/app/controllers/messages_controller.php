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
		$messages = array();
		$this->Message->contain();
		
		//If the user has an associated team ID, obtain the team messages
		if($this->Auth->user('team_id'))
		{
			$messages = array_merge($messages, $this->Message->find('all', array(
				'conditions' => array('team_id' => $this->Auth->user('team_id')),
				'order' => array('Message.dt_sent DESC'),
				'limit' => '10'
			)));
		}
		
		//Obtain the user messages
		$messages = array_merge($messages, $this->Message->find('all', array(
			'conditions' => array('user_id' => $this->Auth->user('id')),
			'order' => array('Message.dt_sent DESC'),
			'limit' => '10'	
		)));
		
		//Sort on date received
		function _sortFunc($a, $b) { return strcmp($b['Message']['dt_sent'], $a['Message']['dt_sent']); }
		
		usort($messages, "_sortFunc");
		$this->set('messages', $messages);
	}
	
	function view($id)
	{
		//Do a little double-checking.  If this user owns the message id or team id, write the data to session and redirect.
		App::import('Sanitize');
		$id = Sanitize::paranoid($id);
		$this->Message->contain();
		$message = $this->Message->find('first', array('conditions' => array('id' => $id)));
		
		if(empty($message)) $this->redirect('/messages');
		
		if($this->Auth->user('id') == $message['Message']['user_id'] || 
			($this->Auth->user('team_id') && $this->Auth->user('team_id') == $message['Message']['team_id']))
		{
			//Record the first time the message is opened
			if(!$message['Message']['dt_opened'])
			{
				$message['Message']['dt_opened'] = date('Y-m-d H:i:s');
				$this->Message->save($message);
			}
			
			$this->Session->write('Message.data', $message['Message']['data']);
			$this->redirect('/dialogs/' . $message['Message']['dialog']);
		}
		
		else $this->redirect('/messages');
	}
}