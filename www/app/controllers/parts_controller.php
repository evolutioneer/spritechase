<?php

class PartsController extends AppController
{
	var $name = 'Parts';
	var $uses = array('Part');
	
	var $adminActions = array(
		'viewall' => true,
		'clear' => true
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
			return $this->Auth->user('role') == 'admin';
		}
		
		return true;
	}
	
	/**
	 *
	 */
	function index()
	{
		$this->_refreshAuth();
		$userId = $this->Auth->user('id');
		
		$this->loadModel('User');
		$this->User->contain('Part');
		
		$userParts = $this->User->find('first', array('id' => $userId));
		if(count($userParts['Part'])) $userParts['Part'] = sortByKey($userParts['Part'], 'name');
		$this->set('userParts', $userParts);
		
		if($userParts['User']['current_round_id'] != null)
		{
			//The user has an active round.  Retrieve the list of parts still needed by their team
			$this->loadModel('Round');
			$this->loadModel('Project');
			$this->Round->contain('Part');
			
			$roundPartsRS = $this->Round->find('first', array(
				'conditions' => array('id' => $userParts['User']['current_round_id'])
			));
			
			$roundPartIDs = array();
			for($i = 0; $i < count($roundPartsRS['Part']); $i++) array_push($roundPartIDs, $roundPartsRS['Part'][$i]['id']);
			$roundPartIDs = array_flip($roundPartIDs);
			
			$this->Project->contain('Part');
			$projectParts = $this->Project->find('first', array(
				'fields' => array('id', 'name'),
				'conditions' => array(
					'id' => $roundPartsRS['Round']['project_id']
				)
			));
			
			//Figure out exactly which parts have been captured, which have not, and sort
			$foundCt = 0;
			
			for($i = 0; $i < count($projectParts['Part']); $i++)
			{
				if(isset($roundPartIDs[$projectParts['Part'][$i]['id']]))
				{
					$projectParts['Part'][$i]['found'] = 1;
					$foundCt++;
				}
				
				else
				{
					$projectParts['Part'][$i]['found'] = 0;
				}
			}
			sortByKey($projectParts['Part'], 'name');
			sortByKey($projectParts['Part'], 'found');
			
			//debug($roundPartsRS);
			//debug($roundPartIDs);
			//debug($projectParts);
			
			$this->set('foundCt', $foundCt);
			$this->set('projectParts', $projectParts);
		}
	}
	
	/**
	 *
	 */
	function viewall()
	{
		$this->Part->contain();
		$this->set('parts', $this->Part->find('all', array('order' => 'name ASC')));
		
		$this->loadModel('PartsUser');
		
		$inventoryRs = $this->PartsUser->find('all', array('conditions' => array('user_id' => $this->Auth->user('id'))));
		$inventory = array();
		
		for($i = 0; $i < count($inventoryRs); $i++)
		{
			$inventory[$inventoryRs[$i]['PartsUser']['part_id']] = true;
		}
		
		$this->set('inventory', $inventory);
	}
	
	/**
	 *
	 */
	function clear()
	{
		$this->loadModel('PartsUser');
		$partsUser = $this->PartsUser->find('all', array('conditions' => array('user_id' => $this->Auth->user('id'))));
		
		for($i = 0; $i < count($partsUser); $i++)
		{
			$this->PartsUser->delete($partsUser[$i]['PartsUser']['id']);
		}
		
		$this->loadModel('ProjectsUser');
		$projectsUser = $this->ProjectsUser->find('all', array('conditions' => array('user_id' => $this->Auth->user('id'))));
		
		for($i = 0; $i < count($projectsUser); $i++)
		{
			$this->ProjectsUser->delete($projectsUser[$i]['ProjectsUser']['id']);
		}
		
		$this->loadModel('PartsRound');
		$partsRound = $this->PartsRound->deleteAll(array('round_id' => $this->Auth->user('current_round_id')));
		
		$this->Session->setFlash('User inventory and projects cleared.');
		$this->_refreshAuth();
		$this->redirect('/parts/viewall');
	}
	
	/**
	 * Called by QR codes that users around Maker Faire will be cappin' with they cams
	 * @param $code String the hash to uniquely identify the part in the QR code
	 */
	function qr($code)
	{
		$part = $this->Part->find('first', array('conditions' => array('qr_value' => $code)));
		if(!empty($part))
		{
			$this->Session->write('Parts.id', $part['Part']['id']);
			$this->redirect('/parts/captured');
		}
		
		$this->render('/parts/bad_qr');
	}
	
	/**
	 * Callback when a good QR code is found
	 */
	function captured()
	{
		$id = $this->Session->read('Parts.id');
		$this->Session->write('Parts.id', '');
		$part = $this->Part->find('first', array('conditions' => array('id' => $id)));
		$this->set('part', $part);
		$roundId = $this->Auth->user('current_round_id');
		$newPartUser = false;
		$newPartRound = false;
		
		//If the user is on a team, add a row for this part to TeamParts table if the part didn't exist
		if(!empty($roundId))
		{
			$this->loadModel('Round');
			$this->Round->contain();
			$round = $this->Round->find('first', array('conditions' => array('Round.id' => $roundId)));
			
			$this->loadModel('PartsRound');
			$partsRound = $this->PartsRound->find('first', array('conditions' => array(
				'part_id' => $part['Part']['id'],
				'round_id' => $roundId
			)));
			
			if(empty($partsRound))
			{
				$this->PartsRound->create();
				$partsRound = array('PartsRound' => array(
					'part_id' => $part['Part']['id'],
					'round_id' => $roundId,
					'dt_found' => date('Y-m-d H:i:s'),
					'ct' => 1
				));
				
				$this->PartsRound->save($partsRound);
				$newPartsRound = true;
			}
			
			else
			{
				$partsRound['PartsRound']['ct']++;
				$this->PartsRound->save($partsRound);
			}
			
			//If the user has scanned the last necessary part for their project, generate the appropriate events
			$this->loadModel('Project');
			$this->Project->contain('Part');
			$projectPartIDs = $this->Project->find('first', array('conditions' => array('id' => $round['Round']['project_id'])));
			
			//Get the IDs of all the parts found in this round
			$this->Round->contain('Part.id');
			$roundPartIDs = $this->Round->find('first', array('conditions' => array('id' => $roundId)));
			$foundIDs = array();
			for($i = 0; $i < count($roundPartIDs['Part']); $i++) $foundIDs[$roundPartIDs['Part'][$i]['id']] = true;
			
			//Identify the parts that remain to be found.  They will be set and used in the sprite dialog for this part.
			$remainingParts = array();
			for($i = 0; $i < count($projectPartIDs['Part']); $i++)
			{
				if(!isset($foundIDs[$projectPartIDs['Part'][$i]['id']]))
				{
					array_push($remainingParts, $projectPartIDs['Part'][$i]);
				}
			}
			
			//debug($roundPartIDs);
			//debug($projectPartIDs);
			//debug('++++++++++++++');
			//debug($remainingParts);
			//debug('?????????????? remainingCt: ' . count($remainingParts));
			
			//If all parts for the project have been found, save the round as completed, send a message to all teammates, and remove the round ID from all teammates
			if(count($remainingParts) == 0)
			{
				//$$todo proceed with the hullaballoo
				$this->loadModel('User');
				$this->User->contain();
				$teammates = $this->User->find('all', array('conditions' => array('current_round_id' => $round['Round']['id'])));
				
				for($i = 0; $i < count($teammates); $i++)
				{
					//$$todo send a message to each teammate
					$teammates[$i]['User']['current_round_id'] = null;
					$this->User->save($teammates[$i]['User']);
				}
				
				//Update the state of the round
				$round['Round']['dt_completed'] = date('Y-m-d H:i:s');
				$this->Round->save($round);
			}
		}
		
		//Add a row for this part to the UserParts table if the row didn't exist
		$this->loadModel('PartsUser');
		$partsUser = $this->PartsUser->find('first', array('conditions' => array(
			'part_id' => $part['Part']['id'],
			'user_id' => $this->Auth->user('id')
		)));
		
		if(empty($partsUser))
		{
			$this->PartsUser->create();
			$partsUser = array('PartsUser' => array(
				'part_id' => $part['Part']['id'],
				'user_id' => $this->Auth->user('id'),
				'dt_found' => date('Y-m-d H:i:s'),
				'ct' => 1
			));
			$this->PartsUser->save($partsUser);
			
			//Need to assign this value for the view setter to use below
			$partsUser['PartsUser']['ct'] = $this->PartsUser->data['PartsUser']['ct'];
			
			$newPartsUser = true;
		}
		
		else
		{
			$partsUser['PartsUser']['ct']++;
			$this->PartsUser->save($partsUser);
		}
		
		//$$testme set all the data we'll need for the view
		$this->set('part', $part);
		$this->set('userTotal', $partsUser['PartsUser']['ct']);
		$this->set('roundTotal', (empty($roundId) ? 0 : $partsRound['PartsRound']['ct']));
		
		$this->_refreshAuth();
	}
}