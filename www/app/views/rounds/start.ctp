<?php $this->Html->css('rounds.min', null, array('inline' => false)); ?>
<?php echo $this->Html->script('rounds.min', array('inline' => false)); ?>
<h2>START A NEW ROUND</h2>
<div id="projects">
	<div class="items">
		<?php for($i = 0; $i < count($projects); $i++): 
			$row = $projects[$i]['Project'];
		?>
		<a class="item" id="project-<?php echo $row['id']; ?>">
			<img class="thumbnail" width="100" height="100" src="<?php echo $row['asset_thumb_url']; ?>" />
			<div class="title"><?php echo $row['name']; ?></div>
			<div class="description"><?php echo $row['desc']; ?></div>
			<div class="stats">
				<div class="started">
					<?php echo $row['rounds_started']; ?>
				</div>
				<div class="completed">
					<?php echo $row['rounds_completed']; ?>
				</div>
			</div>
		</a>
		<?php endfor; ?>
	</div>
</div>
<div id="confirm-window">
	<p>
		Confirm round selection: <span class="selection"></span>
	</p>
	<a class="confirm button">confirm</a>
	<a class="cancel button">cancel</a>
</div>
<form id="form" method="post" action="<?php echo $this->here; ?>">
	<input type="hidden" name="data[Project][id]" id="form-project-id" value="" />
</form>