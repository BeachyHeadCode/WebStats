<?php
	if (!isset($_GET['search'])) {$_GET['search'] = 'ASC';} else {$_GET['search'] = 'DESC';}
	$item = $_GET['material'];
	$item_image = $_GET['material'];
	$item_image = str_replace(":", "-", $item_image);
	$item = str_replace("-", ":", $item);
?>
<article class="content_maintable_stats">
	<section class="small-12 small-centered columns content_headline" id="name">
	</section>
	<div id="ItemInfo"></div>
	<div class="row" id="RecipeTables">
		<div class="small-12 small-centered columns" id="Recipe"></div>
	</div>
	<div class="row" id="BrewTables">
		<div class="small-12 small-centered columns" id="Brew"></div>
	</div>
	<div class="row" id="SmeltingTables">
		<div class="small-12 small-centered columns" id="Smelting"></div>
	</div>
	<?php if(function_exists(set_material_destroy_table) and function_exists(set_material_build_table)) : ?>
	<section class="small-12 small-centered columns content_headline">
		<a class="ajax-link" href="index.php?mode=material-stats&material=<?php echo $item; ?>"><?php echo translate('var1');?></a> - <a class="ajax-link" href="index.php?mode=material-stats&search=true&material=<?php echo $item;?>"><?php echo translate('var2'); ?></a>
	</section>
	<div class="row">
		<div class="small-6 columns content_headline_stats" style="width:363px;"><?php echo translate('var30'); ?>: </div>
		<div class="small-6 columns content_headline_stats" style="width:363px;"><?php echo translate('var31'); ?> </div>
	</div>
	<div class="row">
		<div class="small-6 columns content_headline_small">
			<?php echo (set_material_destroy_table($item, $_GET['search'])); ?>
		</div>
		<div class="small-6 columns content_headline_small">
			<?php echo (set_material_build_table($item, $_GET['search'])); ?>
		</div>
	</div>
	<?php endif; ?>
</article>

<script type="text/javascript">
function addItemInfo(callback) {
	logInfo("Adding item info...");
	$.ajax({
		type: "GET",
		async: false,
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
			logInfo("Add Item Info: <?php echo $item;?> - Done!");
			callback();
		}
	});
}

function addItemName(id) {
	var name;
	$.ajax({
		type: "GET",
		async: false,
		url: "language/items.xml",
		dataType: "xml",
		success: function(xml) {	
			$(xml).find('item').each(function() {
				if(getValue(this, 'id') == id) {
					name = getValue(this, 'name');
				}
			});
		}
	}); return name;
}

function addItem(description, added, type, name, id) {
	$('<p style="text-align:left"></p>').html(
		"<b>Type:</b> " + type + "<br /><b>Added:</b> " + added + "<br /><b>ID:</b>" + id + "<h4>Description:</h4><hr />" + description
	)
	.appendTo('#ItemInfo');
	
	$('<b></b>').html(
			'<img src="images/icons/<?php echo $item_image;?>.png" width="15px" height="15px"><u><a href="http://minecraft.gamepedia.com/' + name + '">' + name + '</a></u><img src="images/icons/<?php echo $item_image; ?>.png" width="15px" height="15px">'
	)
	.appendTo('#name');
}

function addRecipeInfo(callback) {
	$.ajax({
		type: "GET",
		url: "include/recipe/include/recipes.xml",
		dataType: "xml",
		success: function(xml) {
			id=false;
			$(xml).find('rec').each(
				function() {
					if((getValue(this, 'o') == "<?php echo $item; ?>") || (getValue(this, 'tl') == "<?php echo $item; ?>") || (getValue(this, 'tm') == "<?php echo $item; ?>") || (getValue(this, 'tr') == "<?php echo $item; ?>") || (getValue(this, 'l') == "<?php echo $item; ?>") || (getValue(this, 'm') == "<?php echo $item; ?>") || (getValue(this, 'r') == "<?php echo $item; ?>") || (getValue(this, 'bl') == "<?php echo $item; ?>") || (getValue(this, 'b') == "<?php echo $item; ?>") || (getValue(this, 'br') == "<?php echo $item; ?>")) {
						addRecipeItem(getValue(this, 'o'),
							  getValue(this, 'noo'),
							  getValue(this, 'rt'),
							  getValue(this, 'tl'),
							  getValue(this, 'tm'),
							  getValue(this, 'tr'),
							  getValue(this, 'l'),
							  getValue(this, 'm'),
							  getValue(this, 'r'),
							  getValue(this, 'bl'),
							  getValue(this, 'b'),
							  getValue(this, 'br'));
						id=true;
					}
				}
			);
			if(id==true) {
				$('<h2>Recipe</h2><hr />').prependTo('#RecipeTables');
			}
			logInfo("Add Recipe <?php echo $item; ?> - Done!");
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
			id=false;
			$(xml).find('Brew').each(
				function() {
					if((getValue(this, 'Output') == "<?php echo $item; ?>") || (getValue(this, 'MainInput') == "<?php echo $item; ?>") || (getValue(this, 'Input1') == "<?php echo $item; ?>") || (getValue(this, 'Input2') == "<?php echo $item; ?>") || (getValue(this, 'Input3') == "<?php echo $item; ?>")) {
						addBrewItem(getValue(this, 'Output'),
							  getValue(this, 'NumberOfOutput'),
							  getValue(this, 'MainInput'),
							  getValue(this, 'Input1'),
							  getValue(this, 'Input2'),
							  getValue(this, 'Input3'));
						id=true;
					}
				}
			);
			if(id==true) {
				$('<h2>Brewing</h2><hr />').prependTo('#BrewTables');
			}
			logInfo("Add Brew <?php echo $item; ?> - Done!");
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
			id=false;
			$(xml).find('SmeltingItem').each(
				function() {
					if((getValue(this, 'Output') == "<?php echo $item; ?>") || (getValue(this, 'Input1') == "<?php echo $item; ?>") || (getValue(this, 'Input2') == "<?php echo $item; ?>")) {
						addSmeltingItem(getValue(this, 'Output'),
							  getValue(this, 'NumberOfOutput'),
							  getValue(this, 'Input1'),
							  getValue(this, 'Input2'));
						id=true;
					}
				}
			);
			if(id==true) {
				$('<h2>Smelting</h2><hr />').prependTo('#SmeltingTables');
			}
			logInfo("Add Smelting <?php echo $item; ?> - Done!");
			callback();
		}
	});
}

function addRecipeItem(Output, NumberOfOutput, RecipeType, Topleft, Top, Topright, Left, Middle, Right, Bottomleft, Bottom, Bottomright) {
	if(Topleft != '') {
		Topleft = '<td><span class="grid2"><span class="border"><span><span class="image"><a class="ajax-link" href="index.php?mode=material-stats&material=' + Topleft + '" title="' + addItemName(Topleft) + '"><img src="images/icons/' + Topleft + '.png" width="32px" height="32px" border="0" ></a></span></span></span></span></td>';
	} else {
		Topleft = '<td><span class="grid2"><span class="border"><span><span class="image"></span></span></span></span></td>';
	}
	if(Top != '') {
		Top = '<td><span class="grid2"><span class="border"><span><span class="image"><a class="ajax-link" href="index.php?mode=material-stats&material=' + Top + '" title="' + addItemName(Top) + '"><img src="images/icons/' + Top + '.png" width="32px" height="32px" border="0" ></a></span></span></span></span></td>';
	} else {
		Top = '<td><span class="grid2"><span class="border"><span><span class="image"></span></span></span></span></td>';
	}
	if(Topright != '') {
		Topright = '<td><span class="grid2"><span class="border"><span><span class="image"><a class="ajax-link" href="index.php?mode=material-stats&material=' + Topright + '" title="' + addItemName(Topright) + '"><img src="images/icons/' + Topright + '.png" width="32px" height="32px" border="0" ></a></span></span></span></span></td>';
	} else {
		Topright = '<td><span class="grid2"><span class="border"><span><span class="image"></span></span></span></span></td>';
	}
	if(Left != '') {
		Left = '<td><span class="grid2"><span class="border"><span><span class="image"><a class="ajax-link" href="index.php?mode=material-stats&material=' + Left + '" title="' + addItemName(Left) + '"><img src="images/icons/' + Left + '.png" width="32px" height="32px" border="0" ></a></span></span></span></span></td>';
	} else {
		Left = '<td><span class="grid2"><span class="border"><span><span class="image"></span></span></span></span></td>';
	}
	if(Middle != '') {
		Middle = '<td><span class="grid2"><span class="border"><span><span class="image"><a class="ajax-link" href="index.php?mode=material-stats&material=' + Middle + '" title="' + addItemName(Middle) + '"><img src="images/icons/' + Middle + '.png" width="32px" height="32px" border="0" ></a></span></span></span></span></td>';
	} else {
		Middle = '<td><span class="grid2"><span class="border"><span><span class="image"></span></span></span></span></td>';
	}
	if(Right != '') {
		Right = '<td><span class="grid2"><span class="border"><span><span class="image"><a class="ajax-link" href="index.php?mode=material-stats&material=' + Right + '" title="' + addItemName(Right) + '"><img src="images/icons/' + Right + '.png" width="32px" height="32px" border="0" ></a></span></span></span></span></td>';
	} else {
		Right = '<td><span class="grid2"><span class="border"><span><span class="image"></span></span></span></span></td>';
	}
	if(Bottomleft != '') {
		Bottomleft = '<td><span class="grid2"><span class="border"><span><span class="image"><a class="ajax-link" href="index.php?mode=material-stats&material=' + Bottomleft + '" title="' + addItemName(Bottomleft) + '"><img src="images/icons/' + Bottomleft + '.png" width="32px" height="32px" border="0" ></a></span></span></span></span></td>';
	} else {
		Bottomleft = '<td><span class="grid2"><span class="border"><span><span class="image"></span></span></span></span></td>';
	}
	if(Bottom != '') {
		Bottom = '<td><span class="grid2"><span class="border"><span><span class="image"><a class="ajax-link" href="index.php?mode=material-stats&material=' + Bottom + '" title="' + addItemName(Bottom) + '"><img src="images/icons/' + Bottom + '.png" width="32px" height="32px" border="0" ></a></span></span></span></span></td>';
	} else {
		Bottom = '<td><span class="grid2"><span class="border"><span><span class="image"></span></span></span></span></td>';
	}
	if(Bottomright != '') {
		Bottomright = '<td><span class="grid2"><span class="border"><span><span class="image"><a class="ajax-link" href="index.php?mode=material-stats&material=' + Bottomright + '" title="' + addItemName(Bottomright) + '"><img src="images/icons/' + Bottomright + '.png" width="32px" height="32px" border="0" ></a></span></span></span></span></td>';
	} else {
		Bottomright = '<td><span class="grid2"><span class="border"><span><span class="image"></span></span></span></span></td>';
	}
	//RecipeType 0=Normal, 1=Shapeless, 2=Fixed
	if(RecipeType == '1') {
		RecipeType = '<td class="shapeless" title="This recipe is shapeless; the inputs may be placed in any arrangement in the crafting grid."><img alt="Grid layout Shapeless.png" src="include/recipe/images/Grid_layout_Shapeless.png" width="19" height="15" /></td>';
	} else if(RecipeType == '2') {
		RecipeType = '<td class="fixed" title="This recipe is fixed, the input arrangement may not be moved or mirrored."><img alt="Grid layout Fixed.png" src="include/recipe/images/Grid_layout_Fixed.png" width="19" height="15" /></td>';
	} else {
		RecipeType = '<td></td>';
	}
	$('<table cellpadding="0" cellspacing="0" class="grid-Crafting_Table" style="width:217px; height:125px; position:relative; float:left; margin:4px;"><tbody></tbody></table>').html(
		'<tr>'
			+ Topleft 
			+ Top 
			+ Topright 
			+ '<td rowspan="2" class="arrow"><img alt="Grid layout Arrow (small).png" src="include/recipe/images/Grid_layout_Arrow_%28small%29.png"width="32" height="27" /></td>'
			+ '<td rowspan="3"><span class="grid2 output"><span class="border"><span><span id="'+Output+'" class="image"><a class="ajax-link" href="index.php?mode=material-stats&material=' + Output + '" title="' + addItemName(Output) + '"><img src="images/icons/' + Output + '.png" width="32px" height="32px" border="0" ></a><span class="number">' + NumberOfOutput + '</span></span></span></span></span></td>'
		+ '</tr><tr>'
			+ Left
			+ Middle
			+ Right
		+ '</tr><tr>'
			+ Bottomleft
			+ Bottom
			+ Bottomright
			+ RecipeType
		+ '</tr>'
	)
	.appendTo('#Recipe');
}

function addBrewItem(Output, NumberOfOutput, MainInput, Input1, Input2, Input3) {
	if(Input1 != '') {
		Input1 = '<td class="output1"><span class="grid2"><span class="border"><span><span class="image"><a href="index.php?mode=material-stats&material=' + Input1 + '" title="' + addItemName(Input1) + '"><img src="images/icons/' + Input1 + '.png" width="32px" height="32px" border="0" /></a></span></span></span></span></td>';
	} else {
		Input1 = '<td class="output1"><span class="grid2"><span class="border"><span><span class="default-image"><img src="include/recipe/images/Grid_layout_Brewing_Empty.png" width="32" height="32" /></span></span></span></span></td>';
	}
	if(Input2 != '') {
		Input2 = '<td class="output2"><span class="grid2"><span class="border"><span><span class="image"><a href="index.php?mode=material-stats&material=' + Input2 + '" title="' + addItemName(Input2) + '"><img src="images/icons/' + Input2 + '.png" width="32px" height="32px" border="0" /></a></span></span></span></span></td>';
	} else {
		Input2 = '<td class="output2"><span class="grid2"><span class="border"><span><span class="default-image"><img src="include/recipe/images/Grid_layout_Brewing_Empty.png" width="32" height="32" /></span></span></span></span></td>';
	}
	if(Input3 != '') {
		Input3 = '<td class="output3"><span class="grid2"><span class="border"><span><span class="image"><a href="index.php?mode=material-stats&material=' + Input3 + '" title="' + addItemName(Input3) + '"><img src="images/icons/' + Input3 + '.png" width="32px" height="32px" border="0" /></a></span></span></span></span></td>';
	} else {
		Input3 = '<td class="output3"><span class="grid2"><span class="border"><span><span class="default-image"><img src="include/recipe/images/Grid_layout_Brewing_Empty.png" width="32" height="32" /></span></span></span></span></td>';
	}
	$('<table cellpadding="0" cellspacing="0" class="grid-Brewing_Stand" style="width:217px; height:125px; position:relative; float:left; margin:4px;"><tbody></tbody></table>').html(
		'<tr>'
			+ '<td class="bubbles"><img alt="Grid layout Brewing Bubbles.gif" src="include/recipe/images/brewing_bubbles.gif" width="24px" height="57px" border="0" /></td>'
			+ '<td class="input"><span class="grid2"><span class="border"><span><a class="ajax-link" href="index.php?mode=material-stats&material=' + MainInput + '" class="image"><img src="images/icons/' + MainInput + '.png" width="32px" height="32px" border="0" ></a></span></span></span></td>'
			+ '<td class="arrow"><img alt="Grid layout Brewing Arrow.png" src="include/recipe/images/Grid_layout_Brewing_Arrow.png"width="18" height="57"></td>'
		+ '</tr><tr>'
		+ Input1
		+ Input2
		+ Input3
		+ '</tr><tr>'
			+ '<td class="paths" colspan="3"><img alt="Grid layout Brewing Paths.png" src="include/recipe/images/Grid_layout_Brewing_Paths.png" width="60" height="40" /></td>'
		+ '</tr>'
	)
	.appendTo('#Brew');
}

function addSmeltingItem(Output, NumberOfOutput, Input1, Input2) {
	if(Output != '') {
		Output = '<td rowspan="3" class="output"><span class="grid2 output"><span class="border"><span><span class="image"><a class="ajax-link" href="index.php?mode=material-stats&material=' + Output + '" title="' + addItemName(Output) + '"><img alt="' + Output + '" src="images/icons/' + Output + '.png" width="32px" height="32px" border="0" /></a></span></span></span></span></td>';
	} else {
		Output = '<td rowspan="3" class="output"><span class="grid2 output"><span class="border"><span><span class="image"></span></span></span></span></td>';
	}
	if(Input1 != '') {
		Input1 = '<td><span class="grid2"><span class="border"><span><span class="image"><a class="ajax-link" href="index.php?mode=material-stats&material=' + Input1 + '" title="' + addItemName(Input1) + '"><img alt="' + Input1 + '" src="images/icons/' + Input1 + '.png"width="32" height="32"></a></span></span></span></span></td>';
	} else {
		Input1 = '<td><span class="grid2"><span class="border"><span><span class="image"></span></span></span></span></td>';
	}
	if(Input2 != '') {
		Input2 = '<td><span class="grid2"><span class="border"><span class="image"><a class="ajax-link" href="index.php?mode=material-stats&material=' + Input2 + '" title="' + addItemName(Input2) + '"><img src="images/icons/' + Input2 + '.png" width="32px" height="32px" border="0" /></a></span></span></span></td>';
	} else {
		Input2 = '<td><span class="grid2"><span class="border"><span class="image"></span></span></span></td>';
	}
	$('<table cellpadding="0" cellspacing="0" class="grid-Furnace" style="width:217px; height:125px; position:relative; float:left; margin:4px;"><tbody></tbody></table>').html(
		'<tr>'
			+ Input1
			+ '<td rowspan="3" class="arrow"><img alt="Grid layout Furnace Progress.png" src="include/recipe/images/Grid_layout_Furnace_Progress.png" width="44" height="36"></td>'
			+ Output
		+ '</tr><tr><td><span class="image"><img alt="Furnace Grid Fire.png" src="include/recipe/images/furnace_grid_fire.png" width="36" height="36"></span></td></tr><tr>'
			+ Input2
		+ '</tr>'
	)
	.appendTo('#Smelting');
}

$(document).ready(function() {
	addItemInfo(function() {
		$("#ItemInfo").fadeIn("slow");
	});
 	addRecipeInfo(function() {
		$("#Recipe").fadeIn("slow");
	});
	addBrewInfo(function() {
		$("#Brew").fadeIn("slow");
	});
	addSmeltingInfo(function() {
		$("#Smelting").fadeIn("slow");
	});
});
</script>