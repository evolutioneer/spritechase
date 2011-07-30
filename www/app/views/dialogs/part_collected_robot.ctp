<?php 
		//$$testme echo the description
		//$$todo if the part was relevant and the first, congratulate user
		//$$todo if the part is relevant but not the first, say so
		//$$todo if the part is not relevant, tell the user that
		//$$todo if the part is new to their inventory, say so
	?>
<div class="slide main-1">
	<div class="face" value="robot"></div>
	<div class="name" value="Robo-Ben"></div>
	<div class="next-button-target" value="main-2"></div>
	<div class="append text">Beep Beep.  Resource acquired: <?php echo $partName; ?>.</div>
	<script type="text/javascript">
		var SlideUpdaters = {};
	</script>
</div>
<div class="slide main-2">
	<div class="next-button-target" value="main-3"></div>
	<div class="append text">Resource description: "<?php echo $partDesc; ?>".</div>
</div>
<div class="slide main-3">
	<div class="next-button-target" value="main-4"></div>
	<div class="append text"><?php 
	echo "relevant part: '" . $relevantPart . "'  ";
	//$$testme If the part was relevant and the first, congratulate user
	if($relevantPart):
	?>Resource is necessary for fabrication of your target.  <?php 
	
	if($partsRoundCt > 1):?>You now have <?php echo $partsRoundCt; ?> and only require 1.  Advise you seek new parts, beep beep. <?php 
	endif;
	else: ?>Resource not necessary for your target.  Advise you seek parts required for your project, beep beep.<?php 
	endif;
	?>
	</div>
</div>
<div class="slide main-4">
	<div class="next-button-target" value="main-5"></div>
	<div class="append text"><?php 
	if($newPartUser): ?>The new resource has been added to your personal inventory.  <?php endif; ?>
	Good luck on your quest, beep beep.  End transmission.
	</div>
</div>