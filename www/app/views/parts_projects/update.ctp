<h2>UPDATE PART-TO-PROJECT ASSOCIATIONS</h2>
<p>Select a project from the drop down and check off the parts you want to be associated with that project.  Note that any pre-existing associations will be deleted when you save.</p>

<?php 
	//Build the new team registration form and accompanying details
	echo $this->Form->create('PartsProject', array('action' => 'update'));
?>
	<select multiple size="10" name="data[Project][id]">
		<?php 
			for($i = 0; $i < count($projects); $i++)
			{
				echo "<option value='{$projects[$i]['Project']['id']}'>{$projects[$i]['Project']['name']}</option>";
			}
		?>
	</select>
<?php
	for($i = 0; $i < count($parts); $i++)
	{
		echo
		'<div class="checkbox">' .
			'<input type="checkbox" name="data[Part][' . $parts[$i]['Part']['id'] . ']" value="' . 
				$parts[$i]['Part']['id'] . '" id="PartId' . ($parts[$i]['Part']['id']) . '" />' . 
			'<label for="PartId' . ($parts[$i]['Part']['id']) . '">' . $parts[$i]['Part']['name'] . '</label>' .
		'</div>' . "\r";
	}
?>
<?php echo $this->Form->end('Register'); ?>