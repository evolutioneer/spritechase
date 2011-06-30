<h2>PLEASE FOR TO REGISTER</h2>

<?php 
	echo $this->Form->create('User', array('action' => 'register'));
	echo $this->Form->input('name');
	echo $this->Form->input('password');
	echo $this->Form->end('Register');
?>