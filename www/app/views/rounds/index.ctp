<?php $this->Html->css('rounds.min', null, array('inline' => false)); ?>
<?php echo $this->Html->script('rounds.min', array('inline' => false)); ?>
<?php echo $this->element('menu_title_bar', array('title' => 'Projects')); ?>
<div id="projects">
	<?php //$$todo if the user is playing a round, let them know here.  If not, say the same. ?>
	<?php if(isset($currentProject)): ?>
		<div class="header">TEAM PROJECT</div>
		<p>Your team has pursued the <?php echo $currentProject['Project']['name']; ?> for <?php echo $currentProject['Project']['elapsed']; ?>.<br/>Your team can only pursue one project at once.  If you selecting another project below, you will cancel the current round and begin your new search.</p>
	<?php else: ?>
	<?php endif; ?>
	<div class="items">
		<?php for($i = 0; $i < count($projects); $i++): 
			$row = $projects[$i]['Project'];
		?>
		<a class="item" id="project-<?php echo $row['id']; ?>">
			<div class="title"><?php echo $row['name']; ?></div>
			<div class="description"><?php echo $row['desc']; ?></div>
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
		</a>
		<?php endfor; ?>
	</div>
</div>
<div id="confirm-window">
	<span class="selection"></span>
	<a class="confirm button">confirm</a>
	<a class="cancel button">cancel</a>
</div>
<form id="form" method="post" action="/rounds/start">
	<input type="hidden" name="data[Project][id]" id="form-project-id" value="" />
</form>