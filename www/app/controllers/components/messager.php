<?php 

class MessagerComponent extends Object
{
	var $name = 'Messager';
	var $controller;
	
	/**
	 * Start-up the component
	 */
	function initialize(&$controller, $settings)
	{
		App::import('Sanitize');
		$this->controller =& $controller;
		$this->_set($settings);
	}
	
	/**
	 * $$testme Generate a message and deliver it to the users with the given IDs
	 */
	function deliver($messageDialog, $messageData, $messageTitle, $recipients, $redirect = false)
	{
		$this->controller->loadModel('Message');
		$dtOpened = $redirect ? date('Y-m-d H:i:s') : 0;
		
		if(isset($recipients['Team']))
		{
			//Send to a team
			$result = $this->controller->Message->save(array('Message' => array(
				'team_id' => $recipients['Team']['id'],
				'data' => json_encode($messageData),
				'dialog' => $messageDialog,
				'title' => $messageTitle,
				'dt_sent' => date('Y-m-d H:i:s'),
				'dt_opened' => $dtOpened
			)));
		}
		
		if(isset($recipients['User']['id']))
		{
			//$$testme send a single message
			$this->controller->Message->save(array('Message' => array(
				'user_id' => $recipients['User']['id'],
				'data' => json_encode($messageData),
				'dialog' => $messageDialog,
				'title' => $messageTitle,
				'dt_sent' => date('Y-m-d H:i:s'),
				'dt_opened' => $dtOpened
			)));
		}
		
		if($redirect)
		{
			$this->controller->Session->write('Message.data', json_encode($messageData));
			$this->controller->redirect('/dialogs/' . $messageDialog);
		}
	}
}