var Landing = (function() {

	var $registerNameMessage;
	var $registerPasswordMessage;
	var $registerEmailMessage;
	var $registerSubmit;
	var $loginSubmit;
	
	// ------------------------------------------------------------------------
	var init = function()
	{
		debug('Landing.init()');
		
		$registerNameMessage = $('#register-name-message');
		$registerPasswordMessage = $('#register-password-message');
		$registerEmailMessage = $('#register-email-message');
		$registerSubmit = $('#register-submit');
		$loginSubmit = $('#login-submit');
		
		$('#login-name,#register-name').bind('focus', removeInstructionText);
		
		$('#register-name').bind('blur', onRegisterNameBlur);
		$('#register-password-1,#register-password-2').bind('blur', onRegisterPasswordBlur);
		$('#register-email').bind('blur', onRegisterEmailBlur);
		
		$registerSubmit.bind('click', onRegisterSubmit);
		$loginSubmit.bind('click', onLoginSubmit);
		
		$('#login-name').bind('blur', onLoginBlur);
		$('#login-password').bind('blur', onLoginBlur);
	};
	
	// ------------------------------------------------------------------------
	var removeInstructionText = function(evt)
	{
		console.log('removeInstructionText');
		if($(evt.currentTarget).attr('value') == 'enter your username')
		{
			$(evt.currentTarget).attr('value', '');
		}
	};

	// ------------------------------------------------------------------------
	var onLoginBlur = function(evt)
	{
		debug('onLoginBlur()');
		debug('name: "' + 
				$('#login-name').attr('value') + '", pass: "' + 
				$('#login-password').attr('value') + '"');
		
		if($('#login-name').attr('value') && $('#login-password').attr('value'))
		{
			debug('++++ Eh, good enough');
			$loginSubmit.removeClass('disabled');
		}
		
		else $loginSubmit.addClass('disabled');
	};
	
	// ------------------------------------------------------------------------
	var onRegisterNameBlur = function(evt)
	{
		$registerNameMessage.removeClass('valid').text('Checking...');
		$.ajax({
			url: '/users/isFree/' + $('#register-name').attr("value"),
			datatype: 'json',
			success: function(body) { 
				body = JSON.parse(body);
				
				if(body.response == '1')
				{
					debug('+++ Name is available!');
					
					$registerNameMessage
						.addClass('valid')
						.removeClass('neutral')
						.text('"' + $('#register-name').attr("value") + '" is available');
					
					registrationReadyCheck();
				}
				
				else if(body.response == '0')
				{
					$('#register-user-message')
						.removeClass('valid')
						.removeClass('neutral')
						.text('"' + $('#register-name').attr("value") + '" is already taken');
				}
				
				else
				{
					$('#register-user-message')
						.removeClass('valid')
						.removeClass('neutral')
						.text(body.response);
				}
			},
			error: function(xhr, type) {
				debug('!!! error: '. type);
			}
		});
	};
	
	// ------------------------------------------------------------------------
	var onRegisterPasswordBlur = function(evt)
	{
		$registerPasswordMessage.text('Checking...');
		var pass1 = $('#register-password-1').attr("value");
		var pass2 = $('#register-password-2').attr("value");
		
		if(pass1 == '' || pass2 == '')
		{
			$registerPasswordMessage
			.removeClass('valid')
			.addClass('neutral')
			.text('Enter your password (twice)');
		}
		
		else if(pass1 != pass2)
		{
			$registerPasswordMessage
				.removeClass('valid')
				.removeClass('neutral')
				.text('The password fields do not match');
		}
		
		else
		{
			$registerPasswordMessage
				.addClass('valid')
				.removeClass('neutral')
				.text('They match!');
			
			registrationReadyCheck();
		}
	};
	
	// ------------------------------------------------------------------------
	var onRegisterEmailBlur = function(evt)
	{
		debug('onRegisterEmailBlur()');
		var email = $('#register-email').attr('value');
		
		if(validateEmail(email))
		{
			$registerEmailMessage
				.addClass('valid')
				.removeClass('neutral')
				.text('Thanks!  We will keep it private');
		}
		
		else if(email == '')
		{
			$registerEmailMessage
			.removeClass('valid')
			.addClass('neutral')
			.text('(optional) Enter your email');
		}
			
		else
		{
			$registerEmailMessage
				.removeClass('valid')
				.removeClass('neutral')
				.text('You did not enter a valid email address');
		}
	};
	
	// ------------------------------------------------------------------------
	var registrationReadyCheck = function()
	{
		debug('registrationReadyCheck()');
		if($registerNameMessage.hasClass('valid') && $registerPasswordMessage.hasClass('valid'))
		{
			$registerSubmit.removeClass('disabled');
		}
		
		else $registerSubmit.addClass('disabled');
	};
	
	// ------------------------------------------------------------------------
	var onRegisterSubmit = function(evt)
	{
		debug('onRegisterSubmit()');
		if($registerSubmit.hasClass('disabled')) return;
		$('#register-form').submit();
	};
	
	// ------------------------------------------------------------------------
	var onLoginSubmit = function(evt)
	{
		debug('onLoginSubmit()');
		if($loginSubmit.hasClass('disabled')) return;
		$('#login-form').submit();
	};
	
	// ------------------------------------------------------------------------
	var validateEmail = function(email)
	{
	 var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/; 
	 return email.match(re);
	};
	
	// PUBLIC INTERFACE -------------------------------------------------------
	return {
		init: init
	};
})();

$(document).ready(Landing.init);