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
		$this->set('data', $data);
		
		/*
		 * Needful variables:
		 * $partName (derived)
		 * $partDesc (derived)
		 * $partRoundCt (on data)
		 * $relevantPart (on data)
		 * $newPartUser (on data)
		 */
		
		$this->loadModel('Part');
		$this->Part->contain();
		$part = $this->Part->find('first', array('fields' => array('Part.name', 'Part.desc'), 'conditions' => array('id' => $data->partId)));
		
		if($data->roundId == null)
		{
			$this->set('partName', $part['Part']['name']);
			$this->set('partDesc', $part['Part']['desc']);
			
			$this->render('part_collected_no_round');
		}
		
		else
		{
			$this->set('partName', $part['Part']['name']);
			$this->set('partDesc', $part['Part']['desc']);
			$this->set('partsRoundCt', $data->partsRoundCt);
			$this->set('relevantPart', $data->relevantPart);
			$this->set('newPartUser', $data->newPartUser);
			
			$this->render('part_collected_robot');
		}
	}
	
	function round_completed()
	{
		$data = json_decode($this->Session->read('Message.data'));
		
		//data contains:
		//$roundId
		//$projectId
		//$roundTimeTaken
		//$teamPlay
		
		//Dialog also requires:
		//$projectName
		//$teamName, if team play
		//$userName
		//$criticism
		
		//Get the project name
		$this->loadModel('Project');
		$this->Project->contain();
		
		$project = $this->Project->find('first', array(
			'fields' => array('Project.name', 'Project.criticism'),
			'conditions' => array('Project.id' => $data->projectId)
		));
		
		$this->set('projectName', $project['Project']['name']);
		$this->set('criticism', $project['Project']['criticism']);
		
		//If in team mode, get the team name
		if($data->teamPlay)
		{
			$this->loadModel('Team');
			$this->Team->contain();
			$team = $this->Team->find('first', array(
				'fields' => array('Team.name'),
				'conditions' => array('Team.id' => $this->Auth->user('team_id'))
			));
			
			$this->set('teamName', $team['Team']['name']);
		}
		
		//Get the user name
		$this->set('userName', $this->Auth->user('name'));
	}
	
}