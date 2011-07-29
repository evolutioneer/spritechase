var Round = (function()
{
	var $form;
	var $formProjectId;
	var $formUserId;
	var $formTeamid;
	var $formProjectIsSolo;
	
	var init = function()
	{
		$form = $('#form');
		$formProjectId = $('#form-project-id');
		$formUserId = $('#form-user-id');
		$formTeamId = $('#form-team-id');
		$formProjectIsSolo = $('#form-project-is-solo');
		
		$('.team-play.button').bind('click', onTeamPlayStart);
		$('.solo-play.button').bind('click', onSoloPlayStart);
		
		$('.items .title').bind('click', function(evt) { 
			var $item = $(evt.currentTarget);
			console.log('Expanding project: ' + $item.text());
			$item.parent('.item').toggleClass('open');
		});
	};
	
	var onTeamPlayStart = function(evt)
	{ 
		var projectId = getProjectId(evt.currentTarget);
		console.log('onTeamPlayStart(' + projectId + ')');
		$formProjectId.attr('value', projectId);
		$formProjectIsSolo.attr('value', 0);
		$form.submit();
	};
	
	var onSoloPlayStart = function(evt)
	{
		var projectId = getProjectId(evt.currentTarget);
		console.log('onTeamPlayStart(' + projectId + ')');
		$formProjectId.attr('value', projectId);
		$formProjectIsSolo.attr('value', 1);
		$form.submit();
	};
	
	var getProjectId = function(button)
	{
		return parseInt($(button).parents('div.item').attr('id').replace(/project-/gi, ''));
	};
	
	return {
		init: init
	};
})();

$(document).ready(Round.init);