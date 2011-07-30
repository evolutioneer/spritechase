<?php $this->Html->css('menus.min', null, array('inline' => false)); ?>
<?php echo $this->element('menu_title_bar', array('title' => 'Success!')); ?>
<div id="registration-successful">
	<div class="header">REGISTRATION SUCCESSFUL</div>
	<div class="about">
		<p><span class="em">Next steps:</span></p>
		<p>1. Watch the game intro (or skip it - your choice)</p>
		<p>2. Choose a project to pursue in your own scavenger hunt from the Projects menu</p>
		<p>3. Visit the i3 Detroit area to learn more and form a team with your friends</p>
		<div class="items">
			<a class="button item" href="/dialogs/intro">
				PLAY GAME INTRO
			</a>
			<a class="button item" href="/menus">
				GO TO MAIN MENU
			</a>
		</div>
	</div>
</div> 