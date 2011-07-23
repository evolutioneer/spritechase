var Parts = (function() {
	
	// ------------------------------------------------------------------------
	var init = function()
	{
		console.log('++++++ Parts.init()');
		$('#parts-page .parts.items .item .title.button').bind('click', function() {
			console.log('click');
			$(this).siblings('.body').toggleClass('open');
		});
	};
	
	// PUBLIC INTERFACE -------------------------------------------------------
	return {
		init: init
	};
	
})();

$(document).ready(Parts.init);