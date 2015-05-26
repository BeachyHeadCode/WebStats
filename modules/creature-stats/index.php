<?php
if (!isset($_GET['search'])) {
	$_GET['search'] = 'ORDER BY `player` ASC';
} else {
	$_GET['search'] = 'ORDER BY `value` DESC';
}				
?>
<div class="content_maintable_stats">
	<div class="content_headline" style="width:748px;">
		<b>
			<img src="images/icons/<?php echo $_GET['creature']; ?>.png" width="15px" height="15px">
				<u><a href="http://minecraft.gamepedia.com/<?php echo translate($_GET['creature']);?>"><?php echo translate($_GET['creature']); ?></a></u>
			<img src="images/icons/<?php echo $_GET['creature']; ?>.png" width="15px" height="15px">
		</b>
	</div>
	<br/><br/>
	<div class="content_headline" style="width:748px;">
		<a class="ajax-link" href="index.php?mode=creature-stats&creature=<?php echo $_GET['creature']; ?>"><?php echo translate('var1'); ?></a> - <a class="ajax-link" href="index.php?mode=creature-stats&search=true&creature=<?php echo $_GET['creature']; ?>"><?php echo translate('var2'); ?></a>
	</div>
	<div style="clear: both; width: 748px; height: 25px;">&nbsp;</div>
	<div style="clear:both;">
		<div>
			<div class="content_headline_stats" style="width:363px;"><?php echo translate('var32'); ?>:</div>
			<div class="content_headline_stats" style="width:363px;"><?php echo translate('var33'); ?></div>
		</div>
		<div style="clear:both;">
			<div class="content_headline_small" style="width:373px;">
				<?php echo (set_creature_damagedealt_table($_GET['creature'], $_GET['search'])); ?>
			</div>
			<div class="content_headline_small" style="width:373px;">
				<?php echo (set_creature_damagereceived_table($_GET['creature'], $_GET['search'])); ?>
			</div>
		</div>
	</div>
</div>