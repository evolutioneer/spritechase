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
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent fringilla suscipit odio et iaculis. Phasellus vehicula dolor nec eros adipiscing eu ultrices augue malesuada. Nam at ante feugiat lorem laoreet molestie vel ut libero. Nam felis justo, interdum eget lobortis sit amet, vulputate at purus. Curabitur vitae lacus consectetur sapien hendrerit imperdiet eget in nunc. Donec posuere, lectus malesuada rutrum aliquam, elit leo pharetra lacus, vitae porttitor metus lorem a risus. Cras id ligula justo. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Ut et elit quis metus feugiat malesuada. Duis vel nisl sed nulla suscipit rutrum eu vel magna. Sed mi est, sollicitudin ac eleifend vitae, porta molestie lacus. Sed varius pellentesque lacus. Morbi eget libero vitae erat venenatis vehicula. In porta imperdiet est, ut adipiscing nibh molestie eget. Vestibulum quis tortor ac metus consequat molestie id et libero. Proin sit amet eros sed diam ultrices consequat. Mauris placerat magna id augue imperdiet ultrices. Mauris tristique molestie orci, non vestibulum dui auctor nec.
	
	Donec in libero tellus. Aliquam pharetra dolor non purus imperdiet in tempor ligula hendrerit. Praesent eget arcu sed dui fringilla placerat. Integer non turpis eget quam porttitor blandit eu nec libero. Mauris pretium mauris in orci aliquet euismod. Proin ut diam eu elit convallis molestie. Sed mi elit, molestie ac ullamcorper vel, aliquet ac lorem. Vivamus varius turpis ac dui adipiscing elementum. Aenean accumsan, neque a ultrices ullamcorper, diam enim venenatis felis, a eleifend neque leo a est. Vivamus adipiscing nisl a augue sagittis pretium. Sed magna dolor, malesuada fermentum accumsan a, pretium in justo. Cras tincidunt lacinia turpis non egestas. In hac habitasse platea dictumst. Nunc porttitor pharetra rutrum. Nam placerat orci sed ligula consectetur vel iaculis odio feugiat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dapibus tempus eros, congue luctus sem feugiat a. Aliquam viverra pellentesque erat, id placerat leo luctus et. Nunc nec magna vitae elit porta varius eget id nisi. Morbi id neque mauris, vitae bibendum metus.
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