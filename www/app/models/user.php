<?php

class User extends AppModel
{
	var $name = 'User';
	var $a_z = "abcdefghijklmnopqrstuvwxyz";
	var $validate = array(
		'name' => array(
            'alphaNumeric' => array(
                'rule' => array('custom', '/^[- .,?!@#$%^&*()_+=0-9a-z]+$/i'),
                'message' => 'Please use simpler characters for your handle'
                ),
            'between' => array(
                'rule' => array('between', 3, 15),
                'message' => 'Your handle must be 3-15 characters long.'
            )
        ),
        'password' => array(
            'alphaNumeric' => array(
                'rule' => array('custom', '/^[- .,?!@#$%^&*()_+=0-9a-z]+$/i'),
                'message' => 'Please use simpler characters for your passcode.'
                )
        )
    );
    var $belongsTo = array('Team');
    var $hasMany = array('Message');
    var $hasAndBelongsToMany = array('Part');
    
    /**
     * 
     */
	function beforeSave($options)
	{
		//If we're creating this guy, set some defaults.
		if(!isset($this->data['User']['id']))
		{
			$this->data['User']['ar_marker_id'] = 
				$this->_getArMarkerId(rand(0,99999));
			
			$this->data['User']['dt_created'] = 
			$this->data['User']['dt_last_active'] = date('Y-m-d H:i:s');
			$this->data['User']['ct_active'] = 1;
		}
		
		return true;
	}
	
	/**
     * 
     */
	function _getArMarkerid($id)
	{
		$output = 0 + $id;
		for($i = strlen($id); $i < 5; $i++) $output = '0' . $output;
		$output .= $this->_randLetter();
		$output .= $this->_randLetter();
		$output .= $this->_randLetter();
		return $output;
	}
	
	/**
     * 
     */
	function _randLetter()
	{
	    $int = rand(0,25);
	    $rand_letter = $this->a_z[$int];
	    return $rand_letter;
	}
}