<?php 

//Fields needed for this dialog: $projectName, $partCt, $projectParts

$greeting = array(
	'Let\'s chat, sport.',
	'Okay, chief.',
	'Howdy, Skipper.',
	'Alrighty, Squire.',
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

$teammatesMessage = '';
if(isset($teammates)) $teammatesMessage = 'Oh, and don\'t forget about your teammates - work together to find those parts!';

?>
<div class="slide main-1">
	<div class="face" value="irmo"></div>
	<div class="name" value="Funky Pants"></div>
	<div class="next-button-target" value="main-2"></div>
	<div class="append text"><?php echo $myGreeting; ?>  It's time for you to start a new Maker Faire project for me.</div>
</div>
<div class="slide main-2">
	<div class="next-button-target" value="main-3"></div>
	<div class="append text">Because you picked the <span class="em"><?php echo $projectName; ?></span>, you need to find a total of <span class="em"><?php echo $partCt; ?></span> parts.  They are:
	<?php 
		$listString = '';
	
		for($i = 0; $i < count($projectParts['Part']) - 1; $i++)
		{
			$listString .= $projectParts['Part'][$i]['name'] . ', ';
		}
		
		$listString = substr($listString, 0, strlen($listString) - 2) . ' and ' . $projectParts['Part'][$i]['name'] . '.';
		echo $listString;
	?>
	</div>
</div>
<div class="slide main-3">
	<div class="next-button-target" value="main-4"></div>
	<div class="append text">
		Whenever you want to check your progress, consult the <span class="em">Parts</span> menu of your PORTABLE COMMUNICATOR.
		<?php echo $teammatesMessage; ?>
	</div>
</div>
<div class="slide main-4">
	<div class="append text">That's about it.  Just make sure the project looks good - this is my reputation we're talking about.  <?php echo $myGoodbye; ?></div>
</div>