var myScroll;

var DialogScreen = (function() {
	
	var $data;
	var $dialogBox;
	var $nextButton;
	var $name;
	var $face;
	var nextButtonTargetId;
	var skippableTextBuild = false;
	var skipTextBuild = false;
	var textBuildInterval;
	
	// ------------------------------------------------------------------------
	var init = function()
	{
		$data = $('.data');
		$dialogBox = $('#dialog-wrapper .scroller');
		$nextButton = $('.next.button');
		$name = $('.sprite.name span');
		$face = $('.sprite.face');
		
		myScroll = new iScroll('dialog-wrapper');
		$(window).bind('reorient', function() {
			setTimeout(function() {
				window.scrollTo(0, 1);
				myScroll.refresh();
			}, 100);
		});
		$.reorient.start();
		
		//$$todo bind a screen change handler to all screen change buttons
		$('.dialog.button').live('click', function(evt) {
			changeSlide($(evt.target).attr('value'));
		});
		
		changeSlide('main-1');
	};
	
	// ------------------------------------------------------------------------
	var changeSlide = function(newSlideId)
	{
		console.log('changeSlide(' + newSlideId + ')');
		
		//$$testme retrieve the data node for the new slide
		var $slide = $('.slide.' + newSlideId);
		
		//$$debug what have we here?
		console.log('$slide: ' + $slide);
		
		if(!$slide.length)
		{
			console.log('!!! No slide found by id ' + newSlideId + '. Aborting.');
			return;
		}
		
		//$$testme clear the contents of the scroller
		$dialogBox.children().remove();
		
		skippableTextBuild = false;
		
		var $faceData = $('.face', $slide);
		if($faceData) updateFace($faceData.attr('value'));
		
		var $nameData = $('.name', $slide);
		if($nameData) updateName($nameData.attr('value'));
		
		var $nextButtonTarget = $('.next-button-target', $slide);
		if($nextButtonTarget.length) nextButtonTargetId = $nextButtonTarget.attr('value');
		else nextButtonTargetId = null;
		
		if(SlideUpdaters[newSlideId]) SlideUpdaters[newSlideId]($slide);
		
		//$$todo begin appending content in order
		var $toAppend = $('.append', $slide);
		
		$toAppend.each(function(i, elem) {
			//$$debug does this each work the way I think it does?
			console.log('... i, elem: ' + i + ', ' + elem);
			
			if($(elem).hasClass('text'))
			{
				skippableTextBuild = true;
				updateNextButton();
				appendText($('<div />').appendTo($dialogBox), $(elem).text());
			}
			
			else $dialogBox.append($(elem).children());
		});
	};
	
	// ------------------------------------------------------------------------
	var appendText = function($appendTarget, text)
	{
		var $container = $appendTarget.append($('<div class="text-build" />'));
		var nibble;
		textBuildInterval = setInterval(function() {
			if(skipTextBuild || text == '')
			{
				$container.append(text);
				clearInterval(textBuildInterval);
				skippableTextBuild = false;
				skipTextBuild = false;
				updateNextButton();
			}
			
			else
			{
				nibble = text.substring(0, 1);
				text = text.substring(1);
				$container.append(nibble);
			}
			
		}, 50);
	};
	
	// ------------------------------------------------------------------------
	var updateName = function(name)
	{
		$name.text(name);
	}
	
	// ------------------------------------------------------------------------
	var updateFace = function(faceId)
	{
		console.log('[NOT IMPLEMENTED] updateFace(' + faceId + ')');
	};
	
	// ------------------------------------------------------------------------
	var updateNextButton = function()
	{
		$nextButton.unbind('click');
		
		if(skippableTextBuild)
		{
			//console.log('[UPDATE NEXT BUTTON] Skippable text build!');
			$nextButton
				.removeClass('disabled')
				.bind('click', function(evt) { skipTextBuild = true; });
		}
		
		else if(nextButtonTargetId)
		{
			//console.log('[UPDATE NEXT BUTTON] Click to advance!');
			$nextButton
				.removeClass('disabled')
				.bind('click', function(evt) { changeSlide(nextButtonTargetId); });
		}
		
		else
		{
			//console.log('[UPDATE NEXT BUTTON] Can\'t skip ahead, disabling now.');
			$nextButton.addClass('disabled');
		}
	};
	
	// PUBLIC INTERFACE -------------------------------------------------------
	return {
		init: init
	};
})();

$(document).ready(DialogScreen.init);