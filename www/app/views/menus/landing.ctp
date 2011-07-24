<?php 
	$this->Html->css('menus.min', null, array('inline' => false));
	$this->Html->script('lib/zepto/ajax.min', array('inline' => false));
	$this->Html->script('landing.min', array('inline' => false));
?>
<div id="landing">
	<div class="title">SPRITECHASE</div>
	<div class="session-flash"><?php echo $this->Session->flash(); ?></div>
	<div class="items">
		<div class="item button">
			<div class="label">Continue (Log In)</div>
			<div class="body">
			<form id="login-form" action="/users/login" method="post">
				<div class="label">Username</div>
				<input type="text" name="data[User][name]" value="username" />
				<div class="label">Password</div>
				<input type="password" name="data[User][password]" value="" />
					<div id="login-submit" class="submit button disabled">Go!</div>
			</form>
			</div>
		</div>
		<div class="item button">
			<div class="label">New Game (Register)</div>
			<div class="body">
				<form id="register-form" action="/users/register" method="post">
					<div id="register-name-message" class="feedback neutral">Claim a username</div>
					<input type="text" id="register-name" name="data[User][name]" value="username" />
					<div id="register-password-message" class="feedback neutral">Enter your password (twice)</div>
					<input type="password" id="register-password-1" name="data[User][password]" value="" />
					<input type="password" id="register-password-2" name="data[User][password2]" value="" />
					<div id="register-email-message" class="feedback neutral">(optional) Enter your email</div>
					<input type="text" id="register-email" name="data[User][email]" value="" />
					<div id="register-submit" class="submit button disabled">Go!</div>
				</form>
			</div>
		</div>
	</div>
</div> 