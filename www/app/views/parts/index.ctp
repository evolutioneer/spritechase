<?php 

$partsCt = count($userParts['Part']);
$this->Html->css('parts.min', null, array('inline' => false));
$this->Html->script('parts.min', array('inline' => false));

?>
<?php echo $this->element('menu_title_bar', array('title' => 'Parts')); ?>
<div id="parts-page">
	<?php if(isset($projectParts)): ?>
	<?php
		$roundPartsLeft = count($projectParts['Part']) - $foundCt;
	?>
	<div class="header">TEAM INVENTORY</div>
	<h2>Your <?php echo $projectParts['Project']['name']; ?> Needs <?php echo $roundPartsLeft; ?> More Parts:</h2>
	<div class="parts items">
		<?php $capturedParts = array(); ?>
		<?php foreach($projectParts['Part'] as $i => $part): ?>
		<div class="item <?php echo ($part['found'] ? ' found' : ''); ?>">
			<a class="slug">
				<div class="thumbnail"><?php echo $this->Html->image('icons/' . $part['asset_thumb_url'] . '.gif'); ?></div>
				<div class="title"><?php echo $part['name']; ?></div>
			</a>
			<div class="body">
				<div class="desc"><?php echo $part['desc']; ?></div>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>
	<div class="header">PERSONAL INVENTORY</div>
	<h2>You Found <?php echo $partsCt; ?> out of 50 Parts</h2>
	<div class="parts items">
	<?php if(0 == count($userParts['Part'])):?>
		<div class="instructions"><p>Collect project parts by scanning SpriteChase QR Codes all around Maker Faire:Detroit.  As you do, they will appear here.</p><p>When you collect enough to complete a project, visit a SpriteChase kiosk to see it!</p></div>
	<?php else: ?>
		<?php foreach($userParts['Part'] as $i => $part): ?>
			<div class="item">
				<a class="slug">
					<div class="thumbnail"><?php echo $this->Html->image('icons/' . $part['asset_thumb_url'] . '.gif'); ?></div>
					<div class="title"><?php echo $part['name']; ?></div>
				</a>
				<div class="body">
					<div class="desc"><?php echo $part['desc']; ?></div>
				</div>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
	</div>
	
</div>