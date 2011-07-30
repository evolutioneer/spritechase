<?php $this->Html->css('rounds.min', null, array('inline' => false)); ?>
<?php echo $this->Html->script('rounds.min', array('inline' => false)); ?>
<?php echo $this->element('menu_title_bar', array('title' => 'Projects')); ?>
<div id="projects">
	<?php //$$todo if the user is playing a round, let them know here.  If not, say the same. ?>
	<?php
		if(isset($currentProject)):
			$prefix = '';
			$header = '';
			if($currentProject['Round']['is_solo'])
			{
				$header = 'YOU ARE PURSUING A SOLO PROJECT';
				$prefix = 'You have been ';
			}
			else
			{
				$header = 'YOU ARE PURSUING A TEAM PROJECT';
				$prefix = 'Your team,  <span class="em">' . $team['Team']['name'] . ' </span>, has been ';
			}
		?>
		<div class="header"><?php echo $header; ?></div>
		<?php echo $this->Session->flash(); ?>
		<div class="instructions">
			<p><?php echo $prefix; ?> pursuing the <?php echo $currentProject['Project']['name']; ?> for <?php echo $currentProject['Project']['elapsed']; ?>.</p>
			<a class="cancel button" href="/rounds/stop/0" >CANCEL THE HUNT</a>
		</div>
	<?php else: ?>
		<div class="header">YOU ARE NOT CURRENTLY PURSUING A PROJECT</div>
		<div class="instructions">
			<p>
				You are not currently part of a scavenger hunt.  All part codes you scan will be added to the Parts screen but will not count towards completing a project.
			</p>
		<?php if(isset($team)):?>
			<p>
				To start your scavenger hunt, choose a project below.  You will have the option to play <span class="em">SOLO</span> or <span class="em">TEAM</span>.  </p>
			<p>
				Choosing TEAM will start this round of play for <span class="em"><?php echo $team['Team']['name']; ?></span> and everyone on your team will be part of the hunt.
			</p>
		<?php else: ?>
		<p>To start your scavenger hunt, choose a project below.
			You will only have the option to play <span class="em">SOLO</span> until you are part of a team.
		</p>
		<p>
			Visit SpriteChase headquarters in the <span class="em">i3Detroit area</span> of Maker Faire to form a team with your friends.
		</p>
		<?php endif; ?>
		</div>
	<?php endif; ?>
	<div class="header">PROJECT LIST</div>
	<div class="instructions">
		<ul>
			<li><span class="em">Parts</span>: how many are needed</li>
			<li><span class="em">Teams</span>: how many are seeking the project</li>
			<li><span class="em">Wins</span>: how many times the project has been built</li>
		</ul>
	</div>
	<div class="items">
		<?php 
		//$$todo if the user is playing a round, tell them they must cancel it before starting another.
		//$$todo otherwise let the user register for team or solo play depending on what they're signed up for
		?>
		<?php for($i = 0; $i < count($projects); $i++): 
			$row = $projects[$i]['Project'];
		?>
		<div class="item" id="project-<?php echo $row['id']; ?>">
			<div class="title"><?php echo $row['name']; ?></div>
			<div class="stats">
				<div class="completed">
					Wins: <?php echo $row['rounds_completed']; ?>
				</div>
				<div class="started">
					Teams: <?php echo $row['rounds_started']; ?>
				</div>
				<div class="part-ct">
					Parts: <?php echo $projectPartCts[$row['id']]; ?>
				</div>
				<br class="clear" />
			</div>
			<div class="body">
				<div class="description"><?php echo $row['desc']; ?></div>
				<?php if(isset($currentProject)): ?>
					<div class="instructions">You can't start a scavenger hunt for this project until you <a href="/rounds/stop">stop your current one</a>.</div>
				<?php else: ?>
				<?php if(isset($team)): ?>
					<div class="team-play button">START TEAM ROUND</div>
				<?php endif; ?>
					<div class="solo-play button">START SOLO ROUND</div>
				<?php endif; ?>
			</div>
			
		</div>
		<?php endfor; ?>
	</div>
</div>
<form id="form" method="post" action="/rounds/start">
	<input type="hidden" name="data[secret]" value="<?php echo $secret; ?>" />
	<input type="hidden" name="data[Project][id]" id="form-project-id" value="" />
	<input type="hidden" name="data[Project][is_solo]" id="form-project-is-solo" value="" />
	<input type="hidden" name="data[User][id]" id="form-user-id" value="<?php echo $userId; ?>" />
	<input type="hidden" name="data[Team][id]" id="form-team-id" value="<?php if(isset($team)) echo $team['Team']['id']; ?>" />
</form>
