<h2>REGISTER A NEW TEAM</h2>

<?php 
	//Build the new team registration form and accompanying details
	echo $this->Form->create('Team', array('action' => 'register'));
	echo $this->Form->input('name');
?>
<?php
	for($i = 0; $i < count($users); $i++)
	{
		$team = '* no team *';
		if(!empty($users[$i]['User']['team_id'])) $team = $users[$i]['Team']['name'];
		echo
		'<div class="checkbox">' .
			'<input type="checkbox" name="data[User][' . $users[$i]['User']['id'] . ']" value="' . 
				$users[$i]['User']['id'] . '" id="UserId' . ($users[$i]['User']['id']) . '" />' . 
			'<label for="UserId' . ($users[$i]['User']['id']) . '">' . $users[$i]['User']['name'] . ' (' . $team . ')</label>' .
		'</div>' . "\r";
	}
?>
<?php echo $this->Form->end('Register'); ?>