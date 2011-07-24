<?php
/**
 * AppController
 */
class AppController extends Controller
{
	var $components = array('Auth', 'Cookie', 'Session');
	
	/*private $allow = array(
		'/users/login' => true,
		'/users/register' => true,
		'/dialogs/intro' => true,
		'/pages/about' => true,
		'/pages/contact' => true,
		'/menus' => true
	);*/
	
	function beforeFilter()
	{
		App::import('Sanitize');
		
		$this->Auth->fields = array(
			'username' => 'name',
			'password' => 'password'
		);
		
		$this->Auth->loginRedirect = array('controller' => 'menus', 'action' => 'index');
		$this->Auth->logoutRedirect = array('controller' => 'menus', 'action' => 'index');
		
		//$this->Auth->allow('*');
		//if(!$this->Auth->user() && !isset($this->allow[$this->here])) $this->redirect('/menus');
	}
	
	/**
	 * Refreshes the Auth session
	 * @param string $field
	 * @param string $value
	 * @return void 
	 */
	function _refreshAuth($field = '', $value = '') {
		if (!empty($field) && !empty($value)) { 
			$this->Session->write($this->Auth->sessionKey .'.'. $field, $value);
		} else {
			if (isset($this->User)) {
				$this->Auth->login($this->User->read(false, $this->Auth->user('id')));
			} else {
				$this->Auth->login(ClassRegistry::init('User')->findById($this->Auth->user('id')));
			}
		}
	}
}
