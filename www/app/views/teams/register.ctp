<h2>REGISTER A NEW TEAM</h2>

<?php 
	//$$todo build the new team registration form and accompanying details
	echo $this->Form->create('Team', array('action' => 'register'));
	echo $this->Form->input('name');
?>
<?php
	//$$todo as users are selected here, push their info to a little sidebar list so we can keep track of them all
	for($i = 0; $i < count($users); $i++)
	{
		$team = '* no team *';
		if(!empty($users[$i]['User']['team_id'])) $team = $users[$i]['Team']['name'];
		echo
		'<div class="checkbox">' .
			'<input type="checkbox" name="data[User][' . $i . '][id]" value="' . 
				$users[$i]['User']['id'] . '" id="UserId' . ($i + 1) . '" />' . 
			'<label for="UserId' . ($i + 1) . '">' . $users[$i]['User']['name'] . ' (' . $team . ')</label>' .
		'</div>' . "\r";
	}
?>
<?php echo $this->Form->end('Register'); ?>