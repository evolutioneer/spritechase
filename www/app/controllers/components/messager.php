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
	function deliver($messageDialog, $messageData, $recipients)
	{
		$this->controller->loadModel('Message');
		
		if(isset($recipients['Team']))
		{
			//$$testme send to a team
			$this->controller->Message->save(array('Message' => array(
				'team_id' => $recipients['Team']['id'],
				'data' => json_encode($messageData),
				'dialog' => $messageDialog,
				'dt_sent' => date('Y-m-d H:i:s')
			)));
		}
		
		if(isset($recipients['User']))
		{
			if(count($recipients['User']))
			{
				//$$testme send in a loop
				for($i = 0; $i < count($recipients['User']); $i++)
				{
					$this->controller->Message->save(array('Message' => array(
						'user_id' => $recipients['User'][$i]['id'],
						'data' => $messageData,
						'dialog' => $messageDialog,
						'dt_sent' => date('Y-m-d H:i:s')
					)));
				}
			}
			
			else if(isset($recipients['User']['id']))
			{
				//$$testme send a single message
				$this->controller->Message->save(array('Message' => array(
					'user_id' => $recipients['User']['id'],
					'data' => $messageData,
					'dialog' => $messageDialog,
					'dt_sent' => date('Y-m-d H:i:s')
				)));
			}
		}
	}
}