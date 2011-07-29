<?php

class PartsController extends AppController
{
	var $name = 'Parts';
	var $uses = array('Part');
	
	var $adminActions = array(
		'viewall' => true,
		'clear' => true
	);
	
	var $components = array('Session', 'Cookie', 'Auth', 'Messager');
	
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
		
		$userParts = $this->User->find('first', array('conditions' => array('User.id' => $userId)));
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
			$this->Session->write('Part.id', $part['Part']['id']);
			$this->redirect('/parts/captured');
		}
		
		$this->render('/parts/bad_qr');
	}
	
	/**
	 * Callback when a good QR code is found
	 */
	function captured()
	{
		//Recall the captured part ID from session, prior to the redirect
		$id = $this->Session->read('Part.id');
		$this->Session->write('Part.id', '');
		
		$this->Part->contain();
		$part = $this->Part->find('first', array('conditions' => array('id' => $id)));
		$this->set('part', $part);
		$roundId = $this->Auth->user('current_round_id');
		
		//Stateful variables of interest for the message
		$partsRoundCt = 1;
		$relevantPart = false;
		$isChasing = !empty($roundId);
		$partsRemaining = array();
		$newPartUser = false;
		$newPartRound = false;
		$roundTimeTaken = -1;
		
		// ========================================== RECORDING THE PART AS CAPTURED FOR THE USER
		//Add a row for this part to the PartsUser table if the row didn't exist
		$this->loadModel('PartsUser');
		$partsUser = $this->PartsUser->find('first', array('conditions' => array(
			'part_id' => $part['Part']['id'],
			'user_id' => $this->Auth->user('id')
		)));
		
		if(empty($partsUser))
		{
			$newPartUser = true;
			$this->PartsUser->create();
			$partsUser = array('PartsUser' => array(
				'part_id' => $part['Part']['id'],
				'user_id' => $this->Auth->user('id'),
				'dt_found' => date('Y-m-d H:i:s'),
				'ct' => 1
			));
			$this->PartsUser->save($partsUser);
		}
		
		else
		{
			$partsUser['PartsUser']['ct']++;
			$this->PartsUser->save($partsUser);
		}
		
		// ============================== RECORDING THE PART AS CAPTURED FOR A ROUND OF PLAY
		//Add a row for this part to the PartsRound table if the part was not there before for this user
		if(!empty($roundId))
		{
			$this->loadModel('Round');
			$this->Round->contain('Part.id');
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
				$newPartCount = ++$partsRound['PartsRound']['ct'];
				$this->PartsRound->save($partsRound);
			}
			
			//================ PROJECT COMPLETION TEST
			//If the user has scanned the last necessary part for their project, generate the appropriate events
			$this->loadModel('Project');
			$this->Project->contain('Part');
			$project = $this->Project->find('first', array('conditions' => array('id' => $round['Round']['project_id'])));
			
			//Get the IDs of all the parts found in this round
			$foundIDs = array();
			for($i = 0; $i < count($round['Part']); $i++) $foundIDs[$round['Part'][$i]['id']] = true;
			
			//Identify the parts that remain to be found.  They will be set and used in the sprite dialog for this part.
			$remainingParts = array();
			for($i = 0; $i < count($project['Part']); $i++)
			{
				//If a needed project part isn't in the project parts found this round, put it in the remaining list.
				if(!isset($foundIDs[$project['Part'][$i]['id']])) array_push($remainingParts, $project['Part'][$i]);
				
				//Otherwise, if a needed part was found *AND* it is this part, flag it as such for the dialog
				else if($foundIDs[$project['Part'][$i]['id']]) $relevantPart = true;
			}
			
			// ======================================= PROJECT COMPLETED
			//If all parts for the project have been found, save the round as completed, 
			//send a message to all teammates, and remove the round ID from all teammates
			if(count($remainingParts) == 0)
			{
				//Update the state of the round
				$round['Round']['dt_completed'] = date('Y-m-d H:i:s');
				$this->Round->save($round);
				
				//$$testme loop over all members of the team and remove their current_round_id
				$this->User->contain();
				$users = $this->User->find('all', array('conditions' => array('current_round_id' => $roundId)));
				for($i = 0; $i < count($users); $i++)
				{
					$users[$i]['User']['current_round_id'] = null;
					$this->User->save($users[$i]['User']);
				}
				
				//$$testme calculate the overall time taken for the round
				$roundTimeTaken = date_diff(new DateTime($round['Round']['dt_completed']), new DateTime($round['Round']['dt_started']));
				$roundTimeTaken = $elapsed->format('%d days, %h hours, %i minutes, %s seconds');
				$roundTimeTaken = str_replace(array('0 days, ', '0 hours, ', '0 minutes, '), '', $elapsed);
				
				$this->_refreshAuth();
				
				$recipient;
				if($round['Round']['user_id'] == $this->Auth->user('id')) $recipient = array('User' => array('id' => $round['Round']['user_id']));
				else $recipient = array('Team' => array('id' => $round['Round']['team_id']));
				
				//$$testme If for a user, simply deliver a message to this user
				$this->Messager->deliver(
					'round_completed',
					array(
						'projectId' => $projectId,
						'roundTimeTaken' => $roundTimeTaken,
						'teamPlay' => false
					),
					'Round Complete: ' . $project['Project']['name'],
					recipient, false//true
				);
			}
			
			// ======================== PROJECT NOT COMPLETED
			//Deliver a message to the user or the team, depending on the mode of the round
			else
			{
				$this->_refreshAuth();
				
				$recipient;
				//$$testme If for a user, simply deliver a message to this user
				if($round['Round']['user_id'] == $this->Auth->user('id')) $recipient = array('User' => array('id' => $round['Round']['user_id']));
				else $recipient = array('Team' => array('id' => $round['Round']['team_id']));
				
				$this->Messager->deliver(
					'part_collected',
					array(
						'roundId' => $this->Auth->user('current_round_id'),
						'partId' => $part['Part']['id'],
						'partsRoundCt' => $partsRoundCt,
						'relevantPart' => $relevantPart,
						'newPartUser' => $newPartUser,
						'newPartRound' => $newPartRound,
					),
					'Part Collected: ' . $part['Part']['name'],
					$recipient, false//true
				);
			}
		}
		
		// ============================ USER NOT PLAYING A ROUND
		else
		{
			$this->_refreshAuth();
			
			$this->Messager->deliver(
				'part_collected',
				array(
					'roundId' => null,
					'partId' => $part['Part']['id'],
					'projectId' => $project['Project']['id'],
					'partsRoundCt' => $partsRoundCt,
					'relevantPart' => $relevantPart,
					'newPartUser' => $newPartUser,
					'newPartRound' => $newPartRound,
					'teamPlay' => false
				),
				'Part Collected: ' . $part['Part']['name'],
				array('User' => array('id' => $this->Auth->user('id'))),
				false//true
			);
		}
	}
}