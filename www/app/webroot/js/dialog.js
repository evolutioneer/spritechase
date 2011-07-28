var myScroll;
var SlideUpdaters = SlideUpdaters || {};

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
	var gumFlapInterval = 5;
	var gumFlapCt = 0;
	
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
		
		//$$todo bind a screen change handler to all screen change buttons
		$('.dialog.button').live('click', function(evt) {
			changeSlide($(evt.target).attr('value'));
		});
		
		currentSlideId = 'main-1';
		changeSlide('main-1');
	};
	
	// ------------------------------------------------------------------------
	var changeSlide = function(newSlideId)
	{
		console.log('changeSlide(' + newSlideId + ')');
		
		//retrieve the data node for the new slide
		var $slide = $('.slide.' + newSlideId);
		
		//what have we here?
		console.log('$slide: ' + $slide);
		
		if(!$slide.length)
		{
			console.log('!!! No slide found by id ' + newSlideId + '. Aborting.');
			return;
		}
		
		//clear the contents of the scroller
		console.log("$dialogBox.children('.append').length: " + $dialogBox.children('.append').length);
		$dialogBox.children().remove();
		
		skippableTextBuild = false;
		
		var $faceData = $('.face', $slide);
		if($faceData.length) updateFace($faceData.attr('value'));
		
		var $nameData = $('.name', $slide);
		if($nameData.length) updateName($nameData.attr('value'));
		
		var $nextButtonTarget = $('.next-button-target', $slide);
		if($nextButtonTarget.length) nextButtonTargetId = $nextButtonTarget.attr('value');
		else nextButtonTargetId = null;
		
		if(SlideUpdaters && SlideUpdaters[newSlideId]) SlideUpdaters[newSlideId]($slide);
		
		//begin appending content in order
		var $toAppend = $('.append', $slide);
		
		$toAppend.each(function(i, elem) {
			//$$debug does this each work the way I think it does?
			console.log('... i, elem: ' + i + ', ' + elem);
			
			if($(elem).hasClass('text'))
			{
				skippableTextBuild = true;
				updateNextButton();
				appendText($('<div class="text" />').appendTo($dialogBox), $(elem).text());
			}
			
			else
			{
				$dialogBox.append($(elem).get(0).cloneNode(true));
			}
		});
	};
	
	// ------------------------------------------------------------------------
	var appendText = function($appendTarget, text)
	{
		var $container = $appendTarget.append($('<div class="text-build" />'));
		var nibble;
		var nibbleCursor = 0;
		
		this.textBuildInterval = setInterval(function() {
			if(skipTextBuild || nibbleCursor == text.length)
			{ 
				clearInterval(this.textBuildInterval);
				console.log('+++ skipTextBuild: ' + skipTextBuild + '; nibbleCursor: ' + nibbleCursor + '; text.length: ' + text.length);
				$container.text(text);
				skippableTextBuild = false;
				skipTextBuild = false;
				updateNextButton();
				
				//$$testme close the mouth when finished
				if($face.hasClass('talking')) $face.removeClass('talking'); 
			}
			
			else
			{
				nibble = text.substring(nibbleCursor, ++nibbleCursor);
				$container.append(nibble);
				
				//$$testme flap those gums!
				gumFlapCt++;
				if(gumFlapCt == gumFlapInterval)
				{
					gumFlapCt = 0;
					$face.toggleClass('talking');
				}
			}
			
		}, 50);
	};
	
	// ------------------------------------------------------------------------
	var updateName = function(name)
	{
		$name.text(name);
	};
	
	// ------------------------------------------------------------------------
	var updateFace = function(faceId)
	{
		//$$testme update the face based on data provided in the dialog slide
		console.log('updateFace(' + faceId + ')');
		if(faceId)
		{
			$face
				.css('background-image', 'url(/img/dialog/' + faceId + '.gif)');
		}
		
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