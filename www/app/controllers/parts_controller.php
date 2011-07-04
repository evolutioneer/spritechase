<?php

class PartsController extends AppController
{
	var $name = 'Parts';
	var $uses = array('Part');
	
	var $adminActions = array(
		'index' => true,
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
			return $this->Auth->user('role') == admin;
		}
		
		return true;
	}
	
	/**
	 *
	 */
	function index()
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
		
		$this->Session->setFlash('User inventory and projects cleared.');
		$this->redirect('/parts');
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
		
		//Let the cron job handle the leaderboard shifts...  Traffic on this method would incur too many transactions to handle it here.
		
		//$$testme if the user is on a team, add a row for this part to TeamParts table if the part didn't exist
		if(!empty($roundId))
		{
			$this->loadModel('Round');
			$round = $this->Round->find('first', array('conditions' => array('id' => $roundId)));
			
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
					'dt_found' => date('Y-m-d H:i:s')
				));
				$this->PartsRound->save($partsRound);
				$newPartsRound = true;
			}
			
			else
			{
				$partsRound['PartsRound']['ct']++;
				$this->PartsRound->save($partsRound);
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
				'dt_found' => date('Y-m-d H:i:s')
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
	}
}