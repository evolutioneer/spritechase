<div class="slide main-1">
	<div class="face" value="imp"></div>
	<div class="name" value="Technician Imp"></div>
	<div class="next-button-target" value="main-2"></div>
	<div class="append text">Oh, thank you, thank you!  You just picked up the last part to finish the <?php echo $projectName?>!</div>
	<script type="text/javascript">
		var SlideUpdaters = {};
	</script>
</div>
<div class="slide main-2">
	<div class="next-button-target" value="main-3"></div>
	<div class="append text">Let me get the commander on the line.</div>
</div>
<div class="slide main-3">
	<div class="face" value="irmo"></div>
	<div class="name" value="Funky Pants"></div>
	<div class="next-button-target" value="main-4"></div>
	<div class="append text">Well done, <?php isset($teamName) ? 'Team ' . $teamName : $userName?>!  You really did pull through, though really at the last minute.</div>
</div>
<div class="slide main-4">
	<div class="next-button-target" value="main-5"></div>
	<div class="append text"><?php echo $criticism; ?></div>
</div>
<div class="slide main-5">
	<div class="next-button-target" value="main-6"></div>
	<div class="append text">But don't take me too seriously.  Anyhow, Skipper, you managed to completed your project in <?php echo $roundTimeTaken; ?>.</div>
</div>
<div class="slide main-6">
	<div class="next-button-target" value="main-7"></div>
	<div class="append text">Wait 'til the guys at the hackerspace see this!  Okay, I'll turn you back over to the imp.  Ta ta.</div>
</div>
<div class="slide main-7">
	<div class="face" value="imp"></div>
	<div class="name" value="Technician Imp"></div>
	<div class="next-button-target" value="main-6"></div>
	<div class="append text">Thanks for playing SpriteChase.  You can always pick another project and play again.  If you are keen on winning a few prizes, keep an eye on the leaderboards - you might be there.  Take care!</div>
</div>