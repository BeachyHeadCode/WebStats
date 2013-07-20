<?php
	if (!isset($_GET['search'])) {$_GET['search'] = 'ASC';} else {$_GET['search'] = 'DESC';}
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
			include('include/recipe/index.php'); 
		}?>
	</div>
		<section class="twelve columns centered content_headline">
			<a href="index.php?mode=material-stats&material=<?php echo $item; ?>"><?php echo translate('var1');?></a> - <a href="index.php?mode=material-stats&search=true&material=<?php echo $item;?>"><?php echo translate('var2'); ?></a>
		</section>
			<div class="row">
				<div class="six columns content_headline_stats" style="width:363px;"><?php echo translate('var30'); ?>: </div>
				<div class="six columns content_headline_stats" style="width:363px;"><?php echo translate('var31'); ?> </div>
			</div>
			<div class="row">
				<div class="six columns content_headline_small">
					<?php echo (set_material_destroy_table($item, $_GET['search'])); ?>
				</div>
				<div class="six columns content_headline_small">
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
							  getValue(this, 'name'),
							  getValue(this, 'id'));
				}						  
			});
			logInfo("Done!");
			callback();
		}
	});
}

function addItem(description, added, type, name, id) {
	$('<p style="text-align:left"></p>').html(
		"<b>Type:</b> " + type + "<br /><b>Added:</b> " + added + "<br /><b>ID:</b>" + id + "<h4>Description:</h4><hr />" + description
	)
	.appendTo('#ItemInfo');
	
	$('<b></b>').html(
			'<img src="images/icons/<?php echo $item_image;?>.png" width="15px" height="15px"><u><a href="http://www.minecraftwiki.net/wiki/' + name + '">' + name + '</a></u><img src="images/icons/<?php echo $item_image; ?>.png" width="15px" height="15px">'
	)
	.appendTo('#name');
}
function addRecipeInfo(callback) {
	$.ajax({
		type: "GET",
		url: "include/recipe/include/recipes.xml", 
		dataType: "xml",
		success: function(xml) {	
			$(xml).find('recipe').each(
				function() {
					if((getValue(this, 'Output') == "<?php echo $item; ?>") || (getValue(this, 'Topleft') == "<?php echo $item; ?>") || (getValue(this, 'Topmiddle') == "<?php echo $item; ?>") || (getValue(this, 'Topright') == "<?php echo $item; ?>") || (getValue(this, 'Left') == "<?php echo $item; ?>") || (getValue(this, 'Middle') == "<?php echo $item; ?>") || (getValue(this, 'Right') == "<?php echo $item; ?>") || (getValue(this, 'Bottomleft') == "<?php echo $item; ?>") || (getValue(this, 'Bottom') == "<?php echo $item; ?>") || (getValue(this, 'Bottomright') == "<?php echo $item; ?>")) {
					addRecipeItem(getValue(this, 'Output'),
							  getValue(this, 'NumberOfOutput'),
							  getValue(this, 'Topleft'),
							  getValue(this, 'Topmiddle'),
							  getValue(this, 'Topright'),
							  getValue(this, 'Left'),
							  getValue(this, 'Middle'),
							  getValue(this, 'Right'),
							  getValue(this, 'Bottomleft'),
							  getValue(this, 'Bottom'),
							  getValue(this, 'Bottomright'));
					}
				}
			);
			callback();
		}
	});
}

function addBrewInfo(callback) {
	$.ajax({
		type: "GET",
		url: "include/recipe/include/brew.xml", 
		dataType: "xml",
		success: function(xml) {	
			$(xml).find('Brew').each(
				function() {
					if((getValue(this, 'Output') == "<?php echo $item; ?>") || (getValue(this, 'MainInput') == "<?php echo $item; ?>") || (getValue(this, 'Input1') == "<?php echo $item; ?>") || (getValue(this, 'Input2') == "<?php echo $item; ?>") || (getValue(this, 'Input3') == "<?php echo $item; ?>")) {
					addBrewItem(getValue(this, 'Output'),
							  getValue(this, 'NumberOfOutput'),
							  getValue(this, 'MainInput'),
							  getValue(this, 'Input1'),
							  getValue(this, 'Input2'),
							  getValue(this, 'Input3'));
					}
				}
			);
			callback();
		}
	});
}

function addSmeltingInfo(callback) {
	$.ajax({
		type: "GET",
		url: "include/recipe/include/smelting.xml", 
		dataType: "xml",
		success: function(xml) {	
			$(xml).find('SmeltingItem').each(
				function() {
					if((getValue(this, 'Output') == "<?php echo $item; ?>") || (getValue(this, 'Input1') == "<?php echo $item; ?>") || (getValue(this, 'Input2') == "<?php echo $item; ?>")) {
					addSmeltingItem(getValue(this, 'Output'),
							  getValue(this, 'NumberOfOutput'),
							  getValue(this, 'MainInput'),
							  getValue(this, 'Input1'),
							  getValue(this, 'Input2'));
					}
				}
			);
			callback();
		}
	});
}

function addRecipeItem(Output, NumberOfOutput, Topleft, Top, Topright, Left, Middle, Right, Bottomleft, Bottom, Bottomright) {
	if(Topleft != '') {
		Topleft = '<td><span class="grid2"><span class="border"><span><span class="image"><a href="index.php?mode=material-stats&material=' + Topleft + '" style="cursor:url(images/cursors/hover.cur),auto;"><img src="images/icons/' + Topleft + '.png" width="32px" height="32px" border="0" ></a></span></span></span></span></td>';
	} else {
		Topleft = '<td><span class="grid2"><span class="border"><span><span class="image"></span></span></span></span></td>';
	}
	if(Top != '') {
		Top = '<td><span class="grid2"><span class="border"><span><span class="image"><a href="index.php?mode=material-stats&material=' + Top + '" style="cursor:url(images/cursors/hover.cur),auto;"><img src="images/icons/' + Top + '.png" width="32px" height="32px" border="0" ></a></span></span></span></span></td>';
	} else {
		Top = '<td><span class="grid2"><span class="border"><span><span class="image"></span></span></span></span></td>';
	}
	if(Topright != '') {
		Topright = '<td><span class="grid2"><span class="border"><span><span class="image"><a href="index.php?mode=material-stats&material=' + Topright + '" style="cursor:url(images/cursors/hover.cur),auto;"><img src="images/icons/' + Topright + '.png" width="32px" height="32px" border="0" ></a></span></span></span></span></td>';
	} else {
		Topright = '<td><span class="grid2"><span class="border"><span><span class="image"></span></span></span></span></td>';
	}
	if(Left != '') {
		Left = '<td><span class="grid2"><span class="border"><span><span class="image"><a href="index.php?mode=material-stats&material=' + Left + '" style="cursor:url(images/cursors/hover.cur),auto;"><img src="images/icons/' + Left + '.png" width="32px" height="32px" border="0" ></a></span></span></span></span></td>';
	} else {
		Left = '<td><span class="grid2"><span class="border"><span><span class="image"></span></span></span></span></td>';
	}
	if(Middle != '') {
		Middle = '<td><span class="grid2"><span class="border"><span><span class="image"><a href="index.php?mode=material-stats&material=' + Middle + '" style="cursor:url(images/cursors/hover.cur),auto;"><img src="images/icons/' + Middle + '.png" width="32px" height="32px" border="0" ></a></span></span></span></span></td>';
	} else {
		Middle = '<td><span class="grid2"><span class="border"><span><span class="image"></span></span></span></span></td>';
	}
	if(Right != '') {
		Right = '<td><span class="grid2"><span class="border"><span><span class="image"><a href="index.php?mode=material-stats&material=' + Right + '" style="cursor:url(images/cursors/hover.cur),auto;"><img src="images/icons/' + Right + '.png" width="32px" height="32px" border="0" ></a></span></span></span></span></td>';
	} else {
		Right = '<td><span class="grid2"><span class="border"><span><span class="image"></span></span></span></span></td>';
	}
	if(Bottomleft != '') {
		Bottomleft = '<td><span class="grid2"><span class="border"><span><span class="image"><a href="index.php?mode=material-stats&material=' + Bottomleft + '" style="cursor:url(images/cursors/hover.cur),auto;"><img src="images/icons/' + Bottomleft + '.png" width="32px" height="32px" border="0" ></a></span></span></span></span></td>';
	} else {
		Bottomleft = '<td><span class="grid2"><span class="border"><span><span class="image"></span></span></span></span></td>';
	}
	if(Bottom != '') {
		Bottom = '<td><span class="grid2"><span class="border"><span><span class="image"><a href="index.php?mode=material-stats&material=' + Bottom + '" style="cursor:url(images/cursors/hover.cur),auto;"><img src="images/icons/' + Bottom + '.png" width="32px" height="32px" border="0" ></a></span></span></span></span></td>';
	} else {
		Bottom = '<td><span class="grid2"><span class="border"><span><span class="image"></span></span></span></span></td>';
	}
	if(Bottomright != '') {
		Bottomright = '<td><span class="grid2"><span class="border"><span><span class="image"><a href="index.php?mode=material-stats&material=' + Bottomright + '" style="cursor:url(images/cursors/hover.cur),auto;"><img src="images/icons/' + Bottomright + '.png" width="32px" height="32px" border="0" ></a></span></span></span></span></td>';
	} else {
		Bottomright = '<td><span class="grid2"><span class="border"><span><span class="image"></span></span></span></span></td>';
	}
	$('<table cellpadding="0" cellspacing="0" class="grid-Crafting_Table" style="width:217px; height:125px; position:relative; float:left; margin:4px;"><tbody></tbody></table>').html(
		'<tr>'
			+ Topleft 
			+ Top 
			+ Topright 
			+ '<td rowspan="2" class="arrow"><img alt="Grid layout Arrow (small).png" src="include/recipe/images/Grid_layout_Arrow_%28small%29.png"width="32" height="27" /></td>'
			+ '<td rowspan="3"><span class="grid2 output"><span class="border"><span><span id="'+Output+'" class="image"><a href="index.php?mode=material-stats&material=' + Output + '" style="cursor:url(images/cursors/hover.cur),auto;" ><img src="images/icons/' + Output + '.png" width="32px" height="32px" border="0" ></a><span class="number">' + NumberOfOutput + '</span></span></span></span></span></td>'
		+ '</tr><tr>'
			+ Left
			+ Middle
			+ Right
		+ '</tr><tr>'
			+ Bottomleft
			+ Bottom
			+ Bottomright
		+ '</tr>'
	)
	.appendTo('#Recipe');
}

function addBrewItem(Output, NumberOfOutput, MainInput, Input1, Input2, Input3) {
	$('<table cellpadding="0" cellspacing="0" class="grid-Brewing_Stand" style="width:217px; height:125px; position:relative; float:left; margin:4px;"><tbody></tbody></table>').html(
		'<tr>'
			+ '<td class="bubbles"><img alt="Grid layout Brewing Bubbles.gif" src="include/recipe/images/brewing_bubbles.gif" width="24px" height="57px" border="0" /></td>'
			+ '<td class="input"><span class="grid2"><span class="border"><span><a href="index.php?mode=material-stats&material=' + MainInput + '" style="cursor:url(images/cursors/hover.cur),auto;" class="image"><img src="images/icons/' + MainInput + '.png" width="32px" height="32px" border="0" ></a></span></span></span></td>'
			+ '<td class="arrow"><img alt="Grid layout Brewing Arrow.png" src="include/recipe/images/Grid_layout_Brewing_Arrow.png"width="18" height="57"></td>'
		+ '</tr><tr>'
		+ '</tr><tr>'
			+ '<td class="paths" colspan="3"><img alt="Grid layout Brewing Paths.png" src="include/recipe/images/Grid_layout_Brewing_Paths.png" width="60" height="40" /></td>'
		+ '</tr>'
	)
	.appendTo('#Recipe');
}

function addSmeltingItem(Output, NumberOfOutput, Input1, Input2) {
	$('<table cellpadding="0" cellspacing="0" class="grid-Furnace" style="width:217px; height:125px; position:relative; float:left; margin:4px;"><tbody></tbody></table>').html(
		'<tr>'
			+ '<td><span class="grid2"><span class="border"><span class="image"><a href="index.php?mode=material-stats&material=' + Input2 + '" title="' + Input2 + '" style="cursor:url(images/cursors/hover.cur),auto;" ><img src="images/icons/' + Input2 + '.png" width="32px" height="32px" border="0" /></a></span></span></span></td>'
			+ '<td rowspan="3" class="arrow"><img alt="Grid layout Furnace Progress.png" src="include/recipe/images/Grid_layout_Furnace_Progress.png" width="44" height="36"></td>'
			+ '<td rowspan="3" class="output"><span class="grid2 output"><span class="border"><span><span class="image"><a href="index.php?mode=material-stats&material=' + Output + '" title="' + Output + '" style="cursor:url(images/cursors/hover.cur),auto;" ><img alt="' + Output + '" src="images/icons/' + Output + '.png" width="32px" height="32px" border="0" /></a></span></span></span></span></td>'
		+ '</tr><tr><td><span class="image"><img alt="Furnace Grid Fire.png" src="include/recipe/images/furnace_grid_fire.png" width="36" height="36"></span></td></tr><tr>'
			+ '<td><span class="grid2"><span class="border"><span><span class="image"><a href="index.php?mode=material-stats&material=' + Input1 + '" title="' + Input1 + '"><img alt="' + Input1 + '" src="images/icons/' + Input1 + '.png"width="32" height="32"></a></span></span></span></span></td>'
		+ '</tr>'
	)
	.appendTo('#Recipe');
}

$(document).ready(function() {
	addItemInfo(function() {
		$("#ItemInfo").fadeIn("slow");
	});
/* 	addRecipeInfo(function() {
		$("#Recipe").fadeIn("slow");
	});
	addBrewInfo(function() {
		$("#Recipe").fadeIn("slow");
	});
	addSmeltingInfo(function() {
		$("#Recipe").fadeIn("slow");
	}); */
});
</script>