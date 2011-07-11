<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php __('SpriteChase - '); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('style.min');
		echo $this->Html->css('dialog.min');
	?>
	 <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
	 <meta name="apple-mobile-web-app-capable" content="yes" />
	 <meta name="apple-mobile-web-app-status-bar-style" content="black" />
</head>
<body class="no-orientation">
	<div id="container">
		<div id="content" class="dialog">
			<?php echo $this->Session->flash(); ?>
			<div class="loading">
				LOADING
			</div>
			<div class="dialog-top">
				<div class="row-1">
					<div class="sprite face">
					</div>
					<div class="next button">
					</div>
					<div class="lights">
					</div>
					<div class="login button">
					</div>
				</div>
				<div class="row-2">
					<div class="sprite name"><span>
						<?php 
							//$$debug let's set a sprite name to see how it looks
							$spriteName = 'Commander Irmo';
							if(!isset($spriteName)) $spriteName = '???';
							echo $spriteName;
						?>
					</span></div>
				</div>
			</div>
			<div class="dialog-screen">
				<div class="dialog-box" id="dialog-wrapper">
					<div class="scroller">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="data">
		<?php echo $content_for_layout; ?>
	</div>
	<?php 
	    echo $this->Html->script('lib/zepto/zepto.min');
	    echo $this->Html->script('lib/zepto/event.min');
	    echo $this->Html->script('lib/reorient.min');
	    echo $this->Html->script('lib/iscroll.min');
	    echo $this->Html->script('lib/modernizr-2.0.min');
	    echo $this->Html->script('dialog.min');
		echo $scripts_for_layout;
	?>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>