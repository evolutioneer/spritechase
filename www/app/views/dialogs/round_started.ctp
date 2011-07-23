<?php 

//Fields needed for this dialog: $projectName, $partCt, $projectParts

$greeting = array(
	'Let\'s chat, sport.',
	'Okay, chief.',
	'Simmer down, there.',
	'Buckle up your safety belt.',
	'Let\'s get down to brass tacks.',
	'Ahoy, there!',
	'Aaaanyway.',
	'Let\'s get this train a-rollin.',
	'Eat this message after reading.'
);

$understand = array(
	'Capieche?',
	'Comprendez?',
	'Savvy?',
	'Catch my drift?',
	'Smell what I\'m cookin?',
	'See what I\'m getting at?',
	'Understand?',
	'Follow me?',
	'Got that?',
	'Clear as crystal?'
);

$goodbye = array(
	'Sayonara!',
	'Auf Wiedersehen!',
	'Ciao!',
	'Buh-bye now!',
	'Take care!',
	'Run along now!',
	'Catch ya later!',
	'Peace out!',
	'Smell ya later!',
	'See ya later, Alligator!',
	'Now, into the breach!'
);

$myGreeting = $greeting[floor(rand(0, count($greeting)))];
$myUnderstand = $understand[floor(rand(0, count($understand)))];
$myGoodbye = $goodbye[round(floor(0, count($goodbye)))];

?>
<div class="slide main-1">
	<div class="face" value="commander"></div>
	<div class="name" value="Commander MacFunky"></div>
	<div class="next-button-target" value="main-2"></div>
	<div class="append text"><?php echo $myGreeting; ?>  It's time to start your next mission.</div>
</div>
<div class="slide main-2">
	<div class="next-button-target" value="main-3"></div>
	<div class="append text">Because you picked the <span class="em"><?php echo $projectName; ?></span>, you need to find a total of <span class="em"><?php echo $partCt; ?></span> parts.</div>
</div>
<div class="slide main-3">
	<div class="next-button-target" value="main-4"></div>
	<div class="append text">They are as follows:</div>
	<div class="append"><span class="instructions">Keep an eye out for these parts around Maker Faire.</span></div>
	<div class="append">
		<?php //$$todo echo out all the parts necessary for this project in a tidy list. ?>
	</div>
</div>
<div class="slide main-4">
	<div class="next-button-target" value="main-5"></div>
	<div class="append text">Whenever you want to check your progress, visit an Inspiration Station kiosk, or consult the <span class="em">Parts</span> menu of your portable communicator.</div>
</div>
<div class="slide main-5">
	<div class="append text">That's the long and the short of it.  <?php echo $myUnderstand; ?></div>
	<div class="append">
		<div class="green dialog button" value="yes-1">YES SIR</div>
		<div class="red dialog button" value="no-1">NOT REALLY</div>
	</div>
</div>
<div class="slide yes-1">
	<div class="append text">Great!  I knew you were smarter than that other player.  You always pull through.  <?php echo $myGoodbye; ?></div>
</div>
<div class="slide no-1">
	<div class="append text">Don't stress out, this is just a video game.  You want I should 'splain it to you again?</div>
	<div class="append">
		<div class="green dialog button" value="main-2">THAT WOULD BE NICE</div>
		<div class="red dialog button" value="no-2">NO, I'M GOOD</div>
	</div>
</div>
<div class="slide no-2">
	<div class="append text">Suit yourself.  <?php echo $myGoodbye; ?></div>
</div>