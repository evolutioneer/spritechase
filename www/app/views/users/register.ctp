<h2>PLEASE FOR TO REGISTER</h2>
<?php /*<form action="/users/register" method="post">
	<input type="text" name="data[User][name]" value="Enter Nickname"></input>
	<input type="text" name="data[User][password]" value="" />
	<input type="submit" value="Register Nickname"/>
</form> */ ?>

<?php 
	echo $this->Form->create('User', array('action' => 'register'));
	echo $this->Form->input('name');
	echo $this->Form->input('password');
	echo $this->Form->end('Register');
?>