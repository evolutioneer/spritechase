var Round = (function()
{
	var hash;
	var hashInterval;
	var selectionId;
	
	var init = function()
	{
		confirmWindow.init();
		
		hash = window.location.hash;
		hashInterval = setInterval('Round.checkHash()', 250);
		
		$('.item').each(function(i, elem) {
			$(elem).attr('href', '#start/' + $(elem).attr('id'));
		});
	};
	
	var confirm = function()
	{
		selectionId = window.location.hash.match(/#start\/(.*)/)[1];
		confirmWindow.show();
	};
	
	var cancel = function()
	{
		
	};
	
	var checkHash = function()
	{
		if(window.location.hash != hash)
		{
			hash = window.location.hash;
			confirm();
		}
	};
	
	var confirmWindow = (function()
	{
		var $elem;
		
		var init = function()
		{
			$elem = $('#confirm-window');
			$elem.find('.confirm.button').bind('click', confirm);
			$elem.find('.cancel.button').bind('click', function(evt) { 
				hide();
			});
		};
		
		//---------------------------------------------------------------------
		var show = function()
		{
			var projectName = $('#' + selectionId).find('.title').text();
			console.log('projectName: ' + projectName);
			$elem.find('.selection').text(projectName);
			$elem.css('display', 'block');
		};
		
		//---------------------------------------------------------------------
		var hide = function()
		{
			$elem.css('display', 'none');
		};
		
		//---------------------------------------------------------------------
		var confirm = function()
		{
			$('#form-project-id').attr('value', selectionId);
			$('#form').submit();
		};
		
		return {
			init: init,
			show: show,
			hide: hide,
			confirm: confirm
		};
	})();
	
	return {
		init: init,
		confirm: confirm,
		cancel: cancel,
		checkHash: checkHash
	};
})();

$(document).ready(Round.init);