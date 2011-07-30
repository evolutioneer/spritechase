<?php

class MenusController extends AppController
{
	var $name = 'Menus';
	var $uses = array('Part', 'Project', 'User');
	
	/**
	 *************************************************************************/
	function index()
	{
		$this->set('name', $this->Auth->user('name'));
	}
	
	/**
	 *************************************************************************/
	function registration_successful()
	{
		
	}
}