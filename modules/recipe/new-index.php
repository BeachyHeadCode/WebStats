<script type="text/javascript">
function addRecipeInfo(callback) {
	$.ajax({
		type: "GET",
		url: "modules/recipe/include/recipes.xml", 
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
	
function addRecipeItem(Output, NumberOfOutput, Topleft, Top, Topright, Left, Middle, Right, Bottomleft, Bottom, Bottomright) {
	$('<table cellpadding="0" cellspacing="0" class="grid-Crafting_Table" style="width:217px; height:125px; position:relative; float:left; margin:4px;"><tbody></tbody></table>').html(
		'<tr>'
			+ '<td><span class="grid2"><span class="border"><span><span class="image"><a href="index.php?mode=material-stats&material=' + Topleft + '" style="cursor:url(images/cursors/hover.cur),auto;"><img src="images/icons/' + Topleft + '.png" width="32px" height="32px" border="0" ></a></span></span></span></span></td>'
			+ '<td><span class="grid2"><span class="border"><span><span class="image"><a href="index.php?mode=material-stats&material=' + Top + '" style="cursor:url(images/cursors/hover.cur),auto;"><img src="images/icons/' + Top + '.png" width="32px" height="32px" border="0" ></a></span></span></span></span></td>'
			+ '<td><span class="grid2"><span class="border"><span><span class="image"><a href="index.php?mode=material-stats&material=' + Topright + '" style="cursor:url(images/cursors/hover.cur),auto;"><img src="images/icons/' + Topright + '.png" width="32px" height="32px" border="0" ></a></span></span></span></span></td>'
			+ '<td rowspan="2" class="arrow"><img alt="Grid layout Arrow (small).png" src="modules/recipe/images/Grid_layout_Arrow_%28small%29.png"width="32" height="27" /></td>'
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
});
</script>