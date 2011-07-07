var Round = (function()
{
	
	var selectionId;
	
	var init = function()
	{
		$('.item').each(function(i, elem) {
			$(elem).attr('href', '#start/' + $(elem).attr('id'));
		});
		
		$(window).bind('hashchange', confirm);
		confirmWindow.init();
	};
	
	var confirm = function()
	{
		selectionId = location.hash.match(/#start\/(.*)/)[1];
		confirmWindow.show();
	};
	
	var cancel = function()
	{
		
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
		cancel: cancel
	}
})();

$(document).ready(function() {
	Round.init();
});