<?php

class MenusController extends AppController
{
	var $name = 'Menus';
	var $uses = array('Part', 'Project', 'User');
	
	/**
	 *************************************************************************/
	function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('*');
	}
	
	/**
	 *************************************************************************/
	function index()
	{
		if(!$this->Auth->user()) $this->render('/menus/landing');
	}
	
	/**
	 *************************************************************************/
	function registration_successful()
	{
		
	}
}