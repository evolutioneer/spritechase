<?php

class ProjectsController extends AppController
{
	var $name = 'Projects';
	var $adminActions = array(
		'viewall' => true
	);
	
	/**
	 *
	 */
	function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->authorize = 'controller';
	}
	
	/**
	 *
	 */
	function isAuthorized()
	{
		if(isset($this->adminActions[$this->action]))
		{
			return $this->Auth->user('role') == admin;
		}
		
		return true;
	}
	
	/**
	 *
	 */
	function index()
	{
		
	}
	
	/**
	 *
	 */
	function viewall()
	{
		$this->set('projects', $this->Project->find('all', array('order' => 'name ASC')));
		
		$this->loadModel('ProjectsUser');
		$completedRs = $this->ProjectsUser->find('all', array('conditions' => array('user_id' => $this->Auth->user('id'))));
		$completed = array();
		
		for($i = 0; $i < count($completedRs); $i++)
		{
			$completed[$completedRs[$i]['ProjectsUser']['project_id']] = true;
		}
		
		$this->set('completed', $completed);
	}
	
	/**
	 *
	 */
	function preview($id)
	{
		
	}
}