<?php

class PartsController extends AppController
{
	var $name = 'Parts';
	var $uses = array('Part');
	
	function beforeFilter()
	{
		//$$testme if this is the user's first visit, AKA no session is found for them on the phone, send them to the opening dialog
		if(!$this->Session->check('Auth.User.id')) $this->redirect('/pages/intro');
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
		$part = $this->Part->find('first', array('conditions' => array('id' => $id)));
		$this->set('part', $part);
		$roundId = $this->Auth->user('current_round_id');
		$newPartUser = false;
		$newPartRound = false;
		
		//Let the cron job handle the leaderboard shifts...  Too many transactions to care about it here.
		
		//$$testme if the user is on a team, add a row for this part to TeamParts table if the part didn't exist
		if(!empty($roundId))
		{
			$this->loadModel('Round');
			$round = $this->Round->find('first', array('conditions' => array('id' => $roundId)));
			
			$this->loadModel('PartRound');
			$partRound = $this->PartRound->find('first', array('conditions' => array(
				'part_id' => $part['Part']['id'],
				'round_id' => $roundId
			)));
			
			if(empty($partRound))
			{
				$this->PartRound->create();
				$partRound = array('PartRound' => array(
					'part_id' => $part['Part']['id'],
					'round_id' => $roundId,
					'dt_found' => date('Y-m-d H:i:s')
				));
				$this->PartRound->save($partRound);
				$newPartRound = true;
			}
			
			else
			{
				$partRound['PartRound']['ct']++;
				$this->PartRound->save($partRound);
			}
		}
		
		//$$testme add a row for this part to the UserParts table if the row didn't exist
		$this->loadModel('PartUser');
		$partUser = $this->PartUser->find('first', array('conditions' => array(
			'part_id' => $part['Part']['id']),
			'user_id' => $this->Auth->user('id')
		));
		
		if(empty($partUser))
		{
			$this->PartUser->create();
			$partUser = array('PartUser' => array(
				'part_id' => $part['Part']['id'],
				'user_id' => $this->Auth->user('id'),
				'dt_found' => date('Y-m-d H:i:s')
			));
			$this->PartUser->save($partUser);
			
			//Need to set this for the view setter below
			$partUser['PartUser']['ct'] = $this->PartUser->data['PartUser']['ct'];
			
			$newPartUser = true;
		}
		
		else
		{
			$partUser['PartUser']['ct']++;
			$this->PartUser->save($partUser);
		}
		
		//$$testme set all the data we'll need for the view
		$this->set('part', $part);
		$this->set('userTotal', $partUser['PartUser']['ct']);
		$this->set('roundTotal', (empty($roundId) ? 0 : $partRound['PartRound']['ct']));
	}
}