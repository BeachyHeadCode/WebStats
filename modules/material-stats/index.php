<?php
	if (!isset($_GET['search'])) {$_GET['search'] = 'ORDER BY player ASC';
	} else {$_GET['search'] = 'ORDER BY value DESC';}
	$item = $_GET['material'];
	$item_image = $_GET['material'];
	$item_image = str_replace(":", "-", $item_image);
	$item = str_replace("-", ":", $item);
?>
<article class="content_maintable_stats">
	<section class="twelve columns centered content_headline" id="name">
	</section>
	<div id="ItemInfo"></div>
	<div class="row" style="width:675px; margin:0px auto;" id="Recipe">
		<?php 
		if($recipe_control == true) {
			include('modules/recipe/index.php'); 
		}
		?>
	</div>
		<section class="twelve columns centered content_headline">
			<a href="index.php?mode=material-stats&material=<?php echo $item; ?>" <?php echo (hover);?> ><?php echo translate('var1');?></a> - <a href="index.php?mode=material-stats&search=true&material=<?php echo $item;?>" <?php echo (hover);?>><?php echo translate('var2'); ?></a>
		</section>
			<div class="row">
				<div class="six columns content_headline_stats" style="width:363px;"><?php echo translate('var30'); ?>: </div>
				<div class="six columns content_headline_stats" style="width:363px;"><?php echo translate('var31'); ?> </div>
			</div>
			<div class="row">
				<div class="six columns content_headline_small" style="width:373px;">
					<?php echo (set_material_destroy_table($item, $_GET['search'])); ?>
				</div>
				<div class="six columns content_headline_small" style="width:373px;">
					<?php echo (set_material_build_table($item, $_GET['search'])); ?>
				</div>
			</div>
</article>

<script type="text/javascript">
function addItemInfo(callback) {
	logInfo("Adding item info...");
	$.ajax({
		type: "GET",
		url: "language/items.xml", 
		dataType: "xml",
		success: function(xml) {	
			$(xml).find('item').each(function() {
				if(getValue(this, 'id') == "<?php echo $item; ?>"){
					addItem(getValue(this, 'description'),
							  getValue(this, 'added'),
							  getValue(this, 'type'),
							  getValue(this, 'name'));
				}						  
			});
			logInfo("Done!");
			callback();
		}
	});
}

function addItem(description, added, type, name) {
	$('<p style="text-align:left"></p>').html(
		"Type: " + type + "<br />Added: " + added + "<br /><h4>Description</h4><hr />" + description
	)
	.appendTo('#ItemInfo');
	
	$('<b></b>').html(
			'<img src="images/icons/<?php echo $item_image;?>.png" width="15px" height="15px"><u><a href="http://www.minecraftwiki.net/wiki/' + name + '"<?php echo (hover);?>>' + name + '</a></u><img src="images/icons/<?php echo $item_image; ?>.png" width="15px" height="15px">'
	)
	.appendTo('#name');
}
$(document).ready(function() {
	addItemInfo(function() {
		$("#ItemInfo").fadeIn("slow");
	});
});
</script>