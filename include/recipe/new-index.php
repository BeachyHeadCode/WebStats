<script type="text/javascript">
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
	$('<table cellpadding="0" cellspacing="0" class="grid-Crafting_Table" style="width:217px; height:125px; position:relative; float:left; margin:4px;"><tbody></tbody></table>').html(
		'<tr>'
			+ '<td><span class="grid2"><span class="border"><span><span class="image"><a href="index.php?mode=material-stats&material=' + Topleft + '" style="cursor:url(images/cursors/hover.cur),auto;"><img src="images/icons/' + Topleft + '.png" width="32px" height="32px" border="0" ></a></span></span></span></span></td>'
			+ '<td><span class="grid2"><span class="border"><span><span class="image"><a href="index.php?mode=material-stats&material=' + Top + '" style="cursor:url(images/cursors/hover.cur),auto;"><img src="images/icons/' + Top + '.png" width="32px" height="32px" border="0" ></a></span></span></span></span></td>'
			+ '<td><span class="grid2"><span class="border"><span><span class="image"><a href="index.php?mode=material-stats&material=' + Topright + '" style="cursor:url(images/cursors/hover.cur),auto;"><img src="images/icons/' + Topright + '.png" width="32px" height="32px" border="0" ></a></span></span></span></span></td>'
			+ '<td rowspan="2" class="arrow"><img alt="Grid layout Arrow (small).png" src="include/recipe/images/Grid_layout_Arrow_%28small%29.png"width="32" height="27" /></td>'
			+ '<td rowspan="3"><span class="grid2 output"><span class="border"><span><span id="'+Output+'" class="image"><a href="index.php?mode=material-stats&material=' + Output + '" style="cursor:url(images/cursors/hover.cur),auto;" ><img src="images/icons/' + Output + '.png" width="32px" height="32px" border="0" ></a><span class="number">' + NumberOfOutput + '</span></span></span></span></span></td>'
		+ '</tr><tr>'
			+ '<td><span class="grid2"><span class="border"><span><span class="image"><a href="index.php?mode=material-stats&material=' + Left + '" style="cursor:url(images/cursors/hover.cur),auto;"><img src="images/icons/' + Left + '.png" width="32px" height="32px" border="0" ></a></span></span></span></span></td>'
			+ '<td><span class="grid2"><span class="border"><span><span class="image"><a href="index.php?mode=material-stats&material=' + Middle + '" style="cursor:url(images/cursors/hover.cur),auto;"><img src="images/icons/' + Middle + '.png" width="32px" height="32px" border="0" ></a></span></span></span></span></td>'
			+ '<td><span class="grid2"><span class="border"><span><span class="image"><a href="index.php?mode=material-stats&material=' + Right + '" style="cursor:url(images/cursors/hover.cur),auto;"><img src="images/icons/' + Right + '.png" width="32px" height="32px" border="0" ></a></span></span></span></span></td>'
		+ '</tr><tr>'
			+ '<td><span class="grid2"><span class="border"><span><span class="image"><a href="index.php?mode=material-stats&material=' + Bottomleft + '" style="cursor:url(images/cursors/hover.cur),auto;"><img src="images/icons/' + Bottomleft + '.png" width="32px" height="32px" border="0" ></a></span></span></span></span></td>'
			+ '<td><span class="grid2"><span class="border"><span><span class="image"><a href="index.php?mode=material-stats&material=' + Bottom + '" style="cursor:url(images/cursors/hover.cur),auto;"><img src="images/icons/' + Bottom + '.png" width="32px" height="32px" border="0" ></a></span></span></span></span></td>'
			+ '<td><span class="grid2"><span class="border"><span><span class="image"><a href="index.php?mode=material-stats&material=' + Bottomright + '" style="cursor:url(images/cursors/hover.cur),auto;"><img src="images/icons/' + Bottomright + '.png" width="32px" height="32px" border="0" ></a></span></span></span></span></td>'
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

function ItemLookup(item) {
	return $.ajax({
		type: "GET",
		url: "language/items.xml", 
		dataType: "xml",
		error: function() {
			alert("Something went wrong.");
		},
		success: function(xml) {
			$(xml).find('item').each(function(name) {
				if(getValue(this, 'id') == item) {
					name = getValue(this, 'name');
					logInfo(name);
					$("#"+item).attr("title", name);
				}
			});
		}
	}).responseText;
}
$(document).ready(function() {
	addRecipeInfo(function() {
		$("#Recipe").fadeIn("slow");
	});
	addBrewInfo(function() {
		$("#Recipe").fadeIn("slow");
	});
	addSmeltingInfo(function() {
		$("#Recipe").fadeIn("slow");
	});
});
</script>