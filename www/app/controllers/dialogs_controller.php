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
	
	/**
	 * 
	 */
	function round_started()
	{
		$data = $this->Session->read('Message.data');
		
		$projectId = $data['projectId'];
		$projectParts;
		$projectName;
		$partCt;
		
		$this->loadModel('Project');
		$this->Project->contain('Part');
		$projectParts = $this->Project->find('first', array('conditions' => array('id' => $projectId)));
		$projectName = $projectParts['Project']['name'];
		$partCt = count($projectParts['Part']);
		
		$this->set('projectParts', $projectParts);
		$this->set('projectName', $projectName);
		$this->set('partCt', $partCt);
	}
	
}