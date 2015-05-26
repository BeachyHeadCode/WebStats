<?php
if (!isset($_GET['search'])) {
	$_GET['search'] = 'ORDER BY `player` ASC';
} else {
	$_GET['search'] = 'ORDER BY `value` DESC';
}				
?>
<div class="row content_maintable_stats">
	<div class="small-12 columns content_headline">
		<b>
			<img src="images/icons/<?php echo $_GET['creature']; ?>.png" width="15px" height="15px">
				<u><a href="http://minecraft.gamepedia.com/<?php echo translate($_GET['creature']);?>"><?php echo translate($_GET['creature']); ?></a></u>
			<img src="images/icons/<?php echo $_GET['creature']; ?>.png" width="15px" height="15px">
		</b>
	</div>
	<div style="clear: both; height: 25px;">&nbsp;</div>
	<div class="small-12 columns content_headline">
		<a class="ajax-link" href="index.php?mode=creature-stats&creature=<?php echo $_GET['creature']; ?>"><?php echo translate('var1'); ?></a> - <a class="ajax-link" href="index.php?mode=creature-stats&search=true&creature=<?php echo $_GET['creature']; ?>"><?php echo translate('var2'); ?></a>
	</div>
	<div style="clear: both; height: 25px;">&nbsp;</div>
	<div class="small-12 columns">
		<div class="row">
			<div class="small-6 columns content_headline_stats"><?php echo translate('var32'); ?>:</div>
			<div class="small-6 columns content_headline_stats"><?php echo translate('var33'); ?></div>
		</div>
		<div class="row">
			<div class="small-6 columns content_headline_small">
				<?php echo (set_creature_damagedealt_table($_GET['creature'], $_GET['search'])); ?>
			</div>
			<div class="small-6 columns content_headline_small">
				<?php echo (set_creature_damagereceived_table($_GET['creature'], $_GET['search'])); ?>
			</div>
		</div>
	</div>
</div>