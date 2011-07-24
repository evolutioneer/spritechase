<?php echo $this->element('menu_title_bar', array('title' => 'Confirm')); ?>
<div class="header"><?php if(isset($project)) echo 'START NEW ROUND'; else echo 'STOP ROUND'?></div>
<?php if(isset($project)): ?>
<p>You have selected the <?php echo $project['Project']['name']; ?> as your team's new target project.</p>
<?php endif; ?>
<p>Are you sure?  All progress on your current project will be lost.</p>
<a class="button" href="/rounds/stop/1<?php if($project) echo $project['Project']['id']; ?>">Confirm</a>