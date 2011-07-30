<?php $this->Html->css('messages.min', null, array('inline' => false)); ?>
<?php echo $this->element('menu_title_bar', array('title' => 'Messages')); ?>
<div id="messages">
	<div class="items">
	
		<?php if(!count($messages)): ?>
		<div class="header">NO MESSAGES</div>
		<div class="instructions">As you play the game you will receive messages about your progress - gathering parts, completing projects, and advancing in the leaderboards.  You can view these messages any time here.</div>
		<?php endif; ?>
		<?php for($i = 0; $i < count($messages); $i++): 
			$row = $messages[$i]['Message'];
			$classes = 'item' . ($row['dt_opened'] ? ' opened' : '');
		?>
		<a class="<?php echo $classes?>" href="/messages/view/<?php echo $row['id']; ?>">
			<div class="time"><?php echo date('D, M j, g:i A', strtotime($row['dt_sent'])); ?></div>
			<div class="title"><?php echo $row['title']; ?></div>
		</a>
		<?php endfor; ?>
	</div>
</div>