<?php echo $this->element('menu_title_bar', array('title' => 'Confirm')); ?>
<?php $this->Html->script('rounds_stop.min', array('inline' => false)); ?>
<div class="header">CANCEL HUNT</div>
<p>Are you sure?  All progress on your current project will be lost.</p>
<a class="button" id="submit-button" >Confirm</a>
<form id="form" method="post" action="/rounds/stop">
	<input type="hidden" name="data[confirmed]" value="true" />
	<input type="hidden" name="data[secret]" value="<?php echo $secret; ?>" />
</form>