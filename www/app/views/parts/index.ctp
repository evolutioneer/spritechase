<?php $this->Html->css('parts_list.min', null, array('inline' => false)); ?>
<h2>MASTER PARTS LIST</h2>
<a href="/parts/clear">Click here to erase your inventory and project progress</a>
<div id="parts-list">
	<div class="items">
		<?php
		
			for($i = 0; $i < count($parts); $i++):
				$row = $parts[$i]['Part'];
				$class = 'item';
				if(isset($inventory[$row['id']])) $class .= ' captured';
		?>
		<a class="<?php echo $class; ?>" href="/parts/qr/<?php echo $row['qr_value']; ?>">
			<img class="thumbnail" width="48px" height="48px" src="/app/webroot/img/part_thumbnails/<?php echo $row['asset_thumb_url']; ?>"/>
			<div class="title">
				<?php echo $row['name']; ?>
			</div>
			<div class="description">
				<?php echo $row['desc']; ?>
			</div>
		</a>
		<?php 
			endfor;
		?>
	</div>
	<br style="clear: both;" />
</div>