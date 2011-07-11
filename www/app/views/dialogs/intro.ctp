<div class="slide main-1">
	<div class="face" value="robot"></div>
	<div class="name" value="Technician Imp"></div>
	<div class="next-button-target" value="main-2"></div>
	<div class="append text">... Wait a moment... We've established a connection!  Whoever you are, please, don't hang up!</div>
	<script type="text/javascript">
		var SlideUpdaters = {};
		
		SlideUpdaters['main-1'] = function(node)
		{
			//$$debug is we being called??
			console.log('***** Slide updater for main 1 called.');
			//$$todo update the state of the menu button to show the help screen
			//$$todo flash the "press here to advance" bubble over the next button
		}; 
	</script>
</div>
<div class="slide main-2">
	<div class="next-button-target" value="main-3"></div>
	<div class="append text">There isn't much time.  We're low on supplies and we need volunteers on the other side.  I want to put you through to our commander; he can explain the situation.</div>
</div>
<div class="slide main-3">
	<div class="append text">Will you help us?</div>
	<div class="append">
		<div class="green dialog button" value="yes-1">YES</div>
		<div class="red dialog button" value="no-1">NO</div>
	</div>
	<div class="append"><span class="instructions">Make your choice and press a button to continue.</span></div>
</div>
<div class="slide no-1">
	<div class="face" value="robot_panic"></div>
	<div class="append text">Our supplies are running low!  Please, don't hang up ... uh oh, the signal is -- </div>
	<div class="append">
		<div class="yellow dialog button" value="no-2">JUST KIDDING</div>
	</div>
</div>
<div class="slide no-2">
	<div class="next-button-target" value="main-4"></div>
	<div class="face" value="robot_annoyed"></div>
	<div class="append text">Thanks for the ulcer, Mac.  I mean, thanks for volunteering.  I'll patch you through to the commander.</div>
</div>
<div class="slide yes-1">
	<div class="next-button-target" value="yes-2"></div>
	<div class="face" value="robot_happy"></div>
	<div class="append text">Thank goodness!  A sucker really IS born every minute!  I mean, you are a kind and generous soul.</div>
</div>
<div class="slide yes-2">
	<div class="next-button-target" value="main-4"></div>
	<div class="face" value="robot"></div>
	<div class="append text">I'll patch you through to the commander now.  Hold please!</div>
</div>
<div class="slide main-4">
	<div class="next-button-target" value="main-5"></div>
	<div class="face" value="irmo"></div>
	<div class="name" value="Commander Irmo"></div>
	<div class="append text">I am Commander McFunkyPants.  Prepare to party hardy.  [END OF DEMO; INSERT 2 COINS]</div>
</div>