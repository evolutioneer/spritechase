<?php 

$partsCt = count($userParts['Part']);
$this->Html->css('parts.min', null, array('inline' => false));
$this->Html->script('parts.min', array('inline' => false));

?>
<?php echo $this->element('menu_title_bar', array('title' => 'Parts Inventory')); ?>
<div id="parts-page">
	<?php if(isset($projectParts)): ?>
	<?php
		$roundPartsLeft = count($projectParts['Part']) - $foundCt;
	?>
	<div class="team-parts header">TEAM PLAY</div>
	<h2>Your <?php echo $projectParts['Project']['name']; ?> Needs <?php echo $roundPartsLeft; ?> More Parts:</h2>
	<div class="parts items">
		<?php $capturedParts = array(); ?>
		<?php foreach($projectParts['Part'] as $i => $part): ?>
		<div class="item <?php echo ($part['found'] ? ' found' : ''); ?>">
			<a class="title button"><?php echo $part['name']; ?></a>
			<div class="body">
				<div class="thumbnail"></div>
				<div class="desc"><?php echo $part['desc']; ?></div>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>
	<div class="user-parts header">PERSONAL INVENTORY</div>
	<h2>You Found <?php echo $partsCt; ?> out of 50 Parts</h2>
	<div class="parts items">
	<?php if(0 == count($userParts['Part'])):?>
		<div class="instructions">Start searching!</div>
	<?php else: ?>
		<?php foreach($userParts['Part'] as $i => $part): ?>
			<div class="item">
				<a class="title button"><?php echo $part['name']; ?></a>
				<div class="body">
					<div class="thumbnail"></div>
					<div class="desc"><?php echo $part['desc']; ?></div>
				</div>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
	</div>
	
</div>