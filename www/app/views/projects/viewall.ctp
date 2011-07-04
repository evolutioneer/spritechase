<?php $this->Html->css('parts_and_projects_list.min', null, array('inline' => false)); ?>
<h2>MASTER PROJECTS LIST</h2>
<a href="/parts/clear">Click here to erase your inventory and project progress</a>
<div id="projects-list">
	<div class="items">
		<?php
		
			for($i = 0; $i < count($projects); $i++):
				$row = $projects[$i]['Project'];
				$class = 'item';
				if(isset($completed[$row['id']])) $class .= ' captured';
		?>
		<a class="<?php echo $class; ?>" href="/projects/preview/<?php echo $row['id']; ?>">
			<img class="thumbnail" width="200px" height="200px" src="/app/webroot/img/project_thumbnails/<?php echo $row['asset_thumb_url']; ?>"/>
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