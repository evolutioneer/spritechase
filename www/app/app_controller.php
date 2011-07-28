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
		
		$this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');
		$this->Auth->authError = 'Please log in or register to play!';
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
