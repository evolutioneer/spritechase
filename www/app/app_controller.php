<?php
/**
 * AppController
 */
class AppController extends Controller
{
	var $components = array('Auth', 'Cookie', 'Session');
	
	private $allow = array(
		'/users/login' => true,
		'/users/register' => true,
		'/dialogs/intro' => true,
		'/pages/about' => true,
		'/pages/contact' => true
	);
	
	function beforeFilter()
	{
		$this->Auth->fields = array(
			'username' => 'name',
			'password' => 'password'
		);
		
		$this->Auth->allow('*');
		if(!$this->Auth->user() && !isset($this->allow[$this->here])) $this->redirect('/dialogs/intro');
	}
}
