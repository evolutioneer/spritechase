<?php

class User extends AppModel
{
	var $name = 'User';
	var $a_z = "abcdefghijklmnopqrstuvwxyz";
	var $validate = array(
		'name' => array(
            'alphaNumeric' => array(
                'rule' => array('cleanCharacters'/*'custom', '/^[- .,?!@#$%^&*()_+=0-9a-z]+$/i'*/),
                'message' => 'Please use simpler characters for your handle'
            ),
            'clean' => array(
                'rule' => array('cleanWordFilter'),
            	'message' => 'We detected a dirty word in your username...  Please keep it clean!'
            ),
            'between' => array(
                'rule' => array('longEnough'/*'between', 3, 15*/),
                'message' => 'Your handle must be 3-15 characters long.'
            )
        )/*,
        'password' => array(
            'alphaNumeric' => array(
                'rule' => array('cleanCharacters'),//, '/^[- .,?!@#$%^&*()_+=0-9a-z]+$/i'),
                'message' => 'Please use simpler characters for your passcode.'
            )
        )*/
    );
    var $belongsTo = array('Team');
    var $hasMany = array('Message');
    var $hasAndBelongsToMany = array('Part');
    
    /**
     * 
     */
    function cleanWordFilter($check)
    {
    	$check = $check['name'];
    	$check = Sanitize::stripAll($check);
    	$dirtyPattern = '/(she*[i!1]t|([a@][s$]{2})|(fu+c?[k]+)|pron|porn|g[o0][a4]ts[e3]|dyk[e3]|f[a4]g+[0o]t|f[4a]g|c[o0]ck|d[i1]ck|pu[s$]{2}y)/i';
    	$output = preg_match($dirtyPattern, $check);
    	
    	if($output != 0) return false;
    	
    	//Yet harsher testing!
    	$check = Sanitize::paranoid($check);
    	$output = preg_match($dirtyPattern, $check);
    	
    	return $output == 0;
    }
    
    /**
     * 
     */
    function cleanCharacters($check)
    {
    	$check = $check['name'];
    	return 0 == preg_match('/^[\'";\r\n%]+$/i', $check);
    }
    /**
     * 
     */
    function longEnough($check)
    {
    	$check = $check['name'];
    	$length = strlen($check);
    	return ($length < 16 && $length > 2);
    }
    /**
     * 
     */
    function validName($check)
    {
    	$check = array('name' => $check);
    	if(!$this->cleanWordFilter($check)) return 'We detected a dirty word in your username...  Please keep it clean!';
    	if(!$this->cleanCharacters($check)) return 'Please use simpler characters for your handle';
    	if(!$this->longEnough($check)) return 'Your handle must be 3-15 characters long.';
    	
    	return 1;
    }
    
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
			
			$this->data['User']['dt_created'] = date('Y-m-d H:i:s');
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