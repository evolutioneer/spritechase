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
		$this->set('currentRoundId', $this->Auth->user('current_round_id'));
	}
	
	/**
	 *************************************************************************/
	function registration_successful()
	{
		
	}
}