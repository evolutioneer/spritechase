<?php

class DialogsController extends AppController
{
	var $name = 'Dialogs';
	var $uses = array();
	
	/**
	 * 
	 */
	function beforeFilter()
	{
		parent::beforeFilter();
		$this->layout = 'dialog';
		$this->Auth->allow('intro');
	}
	
	/**
	 * 
	 */
	function intro()
	{
		
	}
	
	/**
	 * 
	 */
	function round_started()
	{
		$data = json_decode($this->Session->read('Message.data'));
		
		$this->loadModel('Round');
		$this->Round->contain();
		$roundId = $data->roundId;
		$round = $this->Round->find('first', array('conditions' => array('id' => $roundId)));
		
		$projectParts;
		$projectName;
		$partCt;
		
		$this->loadModel('Project');
		$this->Project->contain('Part.name');
		$projectParts = $this->Project->find('first', array('conditions' => array('id' => $round['Round']['project_id'])));
		$projectName = $projectParts['Project']['name'];
		$partCt = count($projectParts['Part']);
		
		//$$todo if this is a team round, find the other players and refer to them.
		if($round['Round']['team_id'] == $this->Auth->user('team_id')) $teammates = true;
		
		$this->set('projectParts', $projectParts);
		$this->set('projectName', $projectName);
		$this->set('partCt', $partCt);
		$this->set('teammates', $teammates);
	}
	
	function part_collected()
	{
		$data = json_decode($this->Session->read('Message.data'));
		debug($data);
	}
	
	function round_completed()
	{
		$data = json_decode($this->Session->read('Message.data'));
		
	}
	
}