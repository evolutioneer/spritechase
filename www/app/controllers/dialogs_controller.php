<?php

class DialogsController extends AppController
{
	var $name = 'Dialogs';
	var $uses = array();
	
	function beforeFilter()
	{
		parent::beforeFilter();
		$this->layout = 'dialog';
	}
	
	function intro()
	{
		
	}
}