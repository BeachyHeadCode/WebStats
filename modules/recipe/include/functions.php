<?php
//----------------------- RECIPE -----------------------
function recipeparser_fetch($id){
	global $recipe;
	$temp_array = array();
	$i = 0;
	foreach($recipe as $key=>$value_a)
	{
		$first_array = explode('|', $value_a, -1);
		$part_a = explode(',', $first_array[1]);
		$part_b = explode(',', $first_array[2]);
		$part_c = explode(',', $first_array[3]);
		if($first_array[0] == $id or $part_a[0] == $id or $part_b[0] == $id or $part_c[0] == $id or $part_a[1] == $id or $part_b[1] == $id or $part_c[1] == $id or $part_a[2] == $id or $part_b[2] == $id or $part_c[2] == $id or $part_a[3] == $id or $part_b[3] == $id or $part_c[3] == $id)
   		{
			$temp_array[$i] = $key;
			$i++;
		}
	}
	return $temp_array;
}
function recipeparser_crafting($id){
	global $recipe;

	$parser_step_1 = explode("|", $recipe[$id]);
	
	$parser_step_2_line_1 = $parser_step_1[0];
	$parser_step_2_line_2 = explode(",", $parser_step_1[1]);
	$parser_step_2_line_3 = explode(",", $parser_step_1[2]);
	$parser_step_2_line_4 = explode(",", $parser_step_1[3]);	
	$parser_step_2_line_5 = $parser_step_1[4];
	if ($parser_step_2_line_1 == '') 	{$parser_step_2_line_1 	  = 'null';}
	if ($parser_step_2_line_2[0] == '') {$parser_step_2_line_2[0] = 'null';}
	if ($parser_step_2_line_3[0] == '') {$parser_step_2_line_3[0] = 'null';}
	if ($parser_step_2_line_4[0] == '') {$parser_step_2_line_4[0] = 'null';}
	if ($parser_step_2_line_2[1] == '') {$parser_step_2_line_2[1] = 'null';}
	if ($parser_step_2_line_3[1] == '') {$parser_step_2_line_3[1] = 'null';}
	if ($parser_step_2_line_4[1] == '') {$parser_step_2_line_4[1] = 'null';}
	if ($parser_step_2_line_2[2] == '') {$parser_step_2_line_2[2] = 'null';}
	if ($parser_step_2_line_3[2] == '') {$parser_step_2_line_3[2] = 'null';}
	if ($parser_step_2_line_4[2] == '') {$parser_step_2_line_4[2] = 'null';}
	
	$translate_line1_item1 = str_replace("-", ":", $parser_step_2_line_2[0]);
	$translate_line1_item2 = str_replace("-", ":", $parser_step_2_line_2[1]);
	$translate_line1_item3 = str_replace("-", ":", $parser_step_2_line_2[2]);
	$translate_line2_item1 = str_replace("-", ":", $parser_step_2_line_3[0]);
	$translate_line2_item2 = str_replace("-", ":", $parser_step_2_line_3[1]);
	$translate_line2_item3 = str_replace("-", ":", $parser_step_2_line_3[2]);	
	$translate_line3_item1 = str_replace("-", ":", $parser_step_2_line_4[0]);
	$translate_line3_item2 = str_replace("-", ":", $parser_step_2_line_4[1]);
	$translate_line3_item3 = str_replace("-", ":", $parser_step_2_line_4[2]);
	$translate_output = str_replace("-", ":", $parser_step_2_line_1);
	
	echo '<table cellpadding="0" cellspacing="0" class="grid-Crafting_Table" style="width:217px; height:125px; position:relative; float:left; margin:4px;"><tbody>';
		echo '<tr>';
			if($parser_step_2_line_2[0] != 'null'){echo '<td><span class="grid2"><span class="border"><span><span class="image"><a href="index.php?mode=material-stats&material='.$parser_step_2_line_2[0].'" style="cursor:url(images/cursors/hover.cur),auto;" title="'.translate($translate_line1_item1).'"><img src="images/icons/'.$parser_step_2_line_2[0].'.png" width="32px" height="32px" border="0" ></a></span></span></span></span></td>';} else {echo '<td><span class="grid2"><span class="border"><span><span class="image">&nbsp;</span></span></span></span></td>';}
			if($parser_step_2_line_2[1] != 'null'){echo '<td><span class="grid2"><span class="border"><span><span class="image"><a href="index.php?mode=material-stats&material='.$parser_step_2_line_2[1].'" style="cursor:url(images/cursors/hover.cur),auto;" title="'.translate($translate_line1_item2).'"><img src="images/icons/'.$parser_step_2_line_2[1].'.png" width="32px" height="32px" border="0" ></a></span></span></span></span></td>';} else {echo '<td><span class="grid2"><span class="border"><span><span class="image">&nbsp;</span></span></span></span></td>';}
			if($parser_step_2_line_2[2] != 'null'){echo '<td><span class="grid2"><span class="border"><span><span class="image"><a href="index.php?mode=material-stats&material='.$parser_step_2_line_2[2].'" style="cursor:url(images/cursors/hover.cur),auto;" title="'.translate($translate_line1_item3).'"><img src="images/icons/'.$parser_step_2_line_2[2].'.png" width="32px" height="32px" border="0" ></a></span></span></span></span></td>';} else {echo '<td><span class="grid2"><span class="border"><span><span class="image">&nbsp;</span></span></span></span></td>';}
			echo '<td rowspan="2" class="arrow"><img alt="Grid layout Arrow (small).png" src="modules/recipe/images/Grid_layout_Arrow_%28small%29.png"width="32" height="27" /></td>';
			echo '<td rowspan="3"><span class="grid2 output"><span class="border"><span><span class="image" title="'.translate($translate_output).'"><a href="index.php?mode=material-stats&material='.$parser_step_2_line_1.'" style="cursor:url(images/cursors/hover.cur),auto;" ><img src="images/icons/'.$parser_step_2_line_1.'.png" width="32px" height="32px" border="0" ></a><span class="number">'.$parser_step_2_line_5.'</span></span></span></span></span></td>';
		echo '</tr><tr>';
			if($parser_step_2_line_3[0] != 'null'){echo '<td><span class="grid2"><span class="border"><span><span class="image"><a href="index.php?mode=material-stats&material='.$parser_step_2_line_3[0].'" style="cursor:url(images/cursors/hover.cur),auto;" title="'.translate($translate_line2_item1).'"><img src="images/icons/'.$parser_step_2_line_3[0].'.png" width="32px" height="32px" border="0" ></a></span></span></span></span></td>';} else {echo '<td><span class="grid2"><span class="border"><span><span class="image">&nbsp;</span></span></span></span></td>';}
			if($parser_step_2_line_3[1] != 'null'){echo '<td><span class="grid2"><span class="border"><span><span class="image"><a href="index.php?mode=material-stats&material='.$parser_step_2_line_3[1].'" style="cursor:url(images/cursors/hover.cur),auto;" title="'.translate($translate_line2_item2).'"><img src="images/icons/'.$parser_step_2_line_3[1].'.png" width="32px" height="32px" border="0" ></a></span></span></span></span></td>';} else {echo '<td><span class="grid2"><span class="border"><span><span class="image">&nbsp;</span></span></span></span></td>';}
			if($parser_step_2_line_3[2] != 'null'){echo '<td><span class="grid2"><span class="border"><span><span class="image"><a href="index.php?mode=material-stats&material='.$parser_step_2_line_3[2].'" style="cursor:url(images/cursors/hover.cur),auto;" title="'.translate($translate_line2_item3).'"><img src="images/icons/'.$parser_step_2_line_3[2].'.png" width="32px" height="32px" border="0" ></a></span></span></span></span></td>';} else {echo '<td><span class="grid2"><span class="border"><span><span class="image">&nbsp;</span></span></span></span></td>';}
		echo '</tr><tr>';
			if($parser_step_2_line_4[0] != 'null'){echo '<td><span class="grid2"><span class="border"><span><span class="image"><a href="index.php?mode=material-stats&material='.$parser_step_2_line_4[0].'" style="cursor:url(images/cursors/hover.cur),auto;" title="'.translate($translate_line3_item1).'"><img src="images/icons/'.$parser_step_2_line_4[0].'.png" width="32px" height="32px" border="0" ></a></span></span></span></span></td>';} else {echo '<td><span class="grid2"><span class="border"><span><span class="image">&nbsp;</span></span></span></span></td>';}
			if($parser_step_2_line_4[1] != 'null'){echo '<td><span class="grid2"><span class="border"><span><span class="image"><a href="index.php?mode=material-stats&material='.$parser_step_2_line_4[1].'" style="cursor:url(images/cursors/hover.cur),auto;" title="'.translate($translate_line3_item2).'"><img src="images/icons/'.$parser_step_2_line_4[1].'.png" width="32px" height="32px" border="0" ></a></span></span></span></span></td>';} else {echo '<td><span class="grid2"><span class="border"><span><span class="image">&nbsp;</span></span></span></span></td>';}
			if($parser_step_2_line_4[2] != 'null'){echo '<td><span class="grid2"><span class="border"><span><span class="image"><a href="index.php?mode=material-stats&material='.$parser_step_2_line_4[2].'" style="cursor:url(images/cursors/hover.cur),auto;" title="'.translate($translate_line3_item3).'"><img src="images/icons/'.$parser_step_2_line_4[2].'.png" width="32px" height="32px" border="0" ></a></span></span></span></span></td>';} else {echo '<td><span class="grid2"><span class="border"><span><span class="image">&nbsp;</span></span></span></span></td>';}
		echo '</tr>';
	echo '</tbody></table>';
}
function recipeparser_collect($collection){
	global $recipe;
	for($i=0; $i < count($collection); $i++){
		recipeparser_crafting($collection[$i]);
	}
}

//----------------------- BREWING -----------------------

function brewingparser_fetch($id){
	global $brewing;
	$temp_array = array();
	$i = 0;
	foreach($brewing as $key=>$value_a){
		$first_array = explode('|', $value_a);
		$part_a = explode(',', $first_array[1]);
		if($first_array[0] == $id or $part_a[0] == $id or $part_a[1] == $id or $part_a[2] == $id or $first_array[3] == $id){
			$temp_array[$i] = $key;
			$i++;
		}
	}
	return $temp_array;
}
function recipeparser_brewing($id){
	global $brewing;

	$parser_step_1 = explode("|", $brewing[$id]);
	
	$parser_step_2_line_1 = $parser_step_1[0];
	$parser_step_2_line_2 = explode(",", $parser_step_1[1]);	
	$parser_step_2_line_3 = $parser_step_1[2];
	$parser_step_2_line_4 = $parser_step_1[3];
	
	if ($parser_step_2_line_1 == '')	{$parser_step_2_line_1 = 'null';}
	if ($parser_step_2_line_2[0] == '')	{$parser_step_2_line_2[0] = 'null';}
	if ($parser_step_2_line_2[1] == '')	{$parser_step_2_line_2[1] = 'null';}
	if ($parser_step_2_line_2[2] == '')	{$parser_step_2_line_2[2] = 'null';}
	if ($parser_step_2_line_3 == '')	{$parser_step_2_line_3 = 'null';}
	if ($parser_step_2_line_4 == '')	{$parser_step_2_line_4 = 'null';}
	
	$translate_line4 = str_replace("-", ":", $parser_step_2_line_4);
	$translate_line2_item1 = str_replace("-", ":", $parser_step_2_line_2[0]);
	$translate_line2_item2 = str_replace("-", ":", $parser_step_2_line_2[1]);
	$translate_line2_item3 = str_replace("-", ":", $parser_step_2_line_2[2]);
	
	echo '<table cellpadding="0" cellspacing="0" class="grid-Brewing_Stand" style="width:217px; height:125px; position:relative; float:left; margin:4px;"><tbody>';
		echo '<tr>';
			echo '<td class="bubbles"><img alt="Grid layout Brewing Bubbles.gif" src="modules/recipe/images/brewing_bubbles.gif" width="24px" height="57px" border="0" /></td>';
			echo '<td class="input"><span class="grid2"><span class="border"><span><a href="index.php?mode=material-stats&material='.$parser_step_2_line_1.'" style="cursor:url(images/cursors/hover.cur),auto;" class="image" title="'.translate($parser_step_2_line_1).'"><img src="images/icons/'.$parser_step_2_line_1.'.png" width="32px" height="32px" border="0" ></a></span></span></span></td>';
			echo '<td class="arrow"><img alt="Grid layout Brewing Arrow.png" src="modules/recipe/images/Grid_layout_Brewing_Arrow.png"width="18" height="57"></td>';
		echo '</tr><tr>';
			if($parser_step_2_line_2[0] != 'null'){echo '<td class="output1"><span class="grid2"><span class="border"><span><span class="image"><a href="index.php?mode=material-stats&material='.$parser_step_2_line_2[0].'" style="cursor:url(images/cursors/hover.cur),auto;" title="'.translate($translate_line2_item1).'"><img src="images/icons/'.$parser_step_2_line_2[0].'.png" width="32px" height="32px" border="0" /></a></span></span></span></span></td>';} else {echo '<td class="output1"><span class="grid2"><span class="border"><span><span class="default-image"><img src="modules/recipe/images/Grid_layout_Brewing_Empty.png" width="32" height="32" /></span></span></span></span></td>';}
			if($parser_step_2_line_2[1] != 'null'){echo '<td class="output2"><span class="grid2"><span class="border"><span><span class="image"><a href="index.php?mode=material-stats&material='.$parser_step_2_line_2[1].'" style="cursor:url(images/cursors/hover.cur),auto;" title="'.translate($translate_line2_item2).'"><img src="images/icons/'.$parser_step_2_line_2[1].'.png" width="32px" height="32px" border="0" /></a></span></span></span></span></td>';} else {echo '<td class="output2"><span class="grid2"><span class="border"><span><span class="default-image"><img src="modules/recipe/images/Grid_layout_Brewing_Empty.png" width="32" height="32" /></span></span></span></span></td>';}
			if($parser_step_2_line_2[2] != 'null'){echo '<td class="output3"><span class="grid2"><span class="border"><span><span class="image"><a href="index.php?mode=material-stats&material='.$parser_step_2_line_2[2].'" style="cursor:url(images/cursors/hover.cur),auto;" title="'.translate($translate_line2_item3).'"><img src="images/icons/'.$parser_step_2_line_2[2].'.png" width="32px" height="32px" border="0" /></a></span></span></span></span></td>';} else {echo '<td class="output3"><span class="grid2"><span class="border"><span><span class="default-image"><img src="modules/recipe/images/Grid_layout_Brewing_Empty.png" width="32" height="32" /></span></span></span></span></td>';}
		echo '</tr><tr>';
			echo '<td class="paths" colspan="3"><img alt="Grid layout Brewing Paths.png" src="modules/recipe/images/Grid_layout_Brewing_Paths.png" width="60" height="40" /></td>';
			//echo '<td style="position: absolute; top:40px; left:58px; text-align:right; vertical-align:bottom; z-index:5; color:#333333; width:25px; height:25px;"><b>'.$parser_step_2_line_3.'</b></td>';
			echo '<td class="output4"><span>Equals</span><br /><a href="index.php?mode=material-stats&material='.$parser_step_2_line_4.'" style="cursor:url(images/cursors/hover.cur),auto;" title="'.translate($translate_line4).'"><img src="images/icons/'.$parser_step_2_line_4.'.png" width="32px" height="32px" border="0" ></a></td>';
		echo '</tr>';
	echo '</tbody></table>';
}
function brewingparser_collect($collection){
	global $recipe;
	for($i=0; $i < count($collection); $i++){
		recipeparser_brewing($collection[$i]);
	}
}
//----------------------- SMELTING -----------------------
function smeltingparser_fetch($id){
	global $smelting;
	$temp_array = array();
	$i = 0;
	foreach($smelting as $key=>$value_a){
		$first_array = explode('|', $value_a);
		$part_a = explode(',', $first_array[1]);
		if($first_array[0] == $id or $part_a[0] == $id or $part_a[1] == $id){
			$temp_array[$i] = $key;
			$i++;
		}
	}
	return $temp_array;
}
function recipeparser_smelting($id){
	global $smelting;

	$parser_step_1 = explode("|", $smelting[$id]);
	
	$parser_step_2_line_1 = $parser_step_1[0];
	$parser_step_2_line_2 = explode(",", $parser_step_1[1]);
	
	if ($parser_step_2_line_1 == '')	{$parser_step_2_line_1 = 'null';}
	if ($parser_step_2_line_2[0] == '')	{$parser_step_2_line_2[0] = 'null';}
	if ($parser_step_2_line_2[1] == '')	{$parser_step_2_line_2[1] = 'null';}
	
	$translate_output = str_replace("-", ":", $parser_step_2_line_1);
	$translate_input_top = str_replace("-", ":", $parser_step_2_line_2[0]);
	$translate_input_fire = str_replace("-", ":", $parser_step_2_line_2[1]);
	
 	echo '<table cellpadding="0" cellspacing="0" class="grid-Furnace" style="width:217px; height:125px; position:relative; float:left; margin:4px;"><tbody>';
	echo '<tr><td><span class="grid2"><span class="border"><span class="image"><a href="index.php?mode=material-stats&material='.$parser_step_2_line_2[0].'" title="'.translate($translate_input_top).'" style="cursor:url(images/cursors/hover.cur),auto;" ><img alt="'.translate($parser_step_2_line_2[0]).'" src="images/icons/'.$parser_step_2_line_2[0].'.png" width="32px" height="32px" border="0" /></a></span></span></span></td>';
 	echo '<td rowspan="3" class="arrow"><img alt="Grid layout Furnace Progress.png" src="modules/recipe/images/Grid_layout_Furnace_Progress.png" width="44" height="36"></td>';	
	echo '<td rowspan="3" class="output"><span class="grid2 output"><span class="border"><span><span class="image"><a href="index.php?mode=material-stats&material='.$parser_step_2_line_1.'" title="'.translate($translate_output).'" style="cursor:url(images/cursors/hover.cur),auto;" ><img alt="'.translate($parser_step_2_line_1).'" src="images/icons/'.$parser_step_2_line_1.'.png" width="32px" height="32px" border="0" /></a></span></span></span></span></td></tr>';
	echo '<tr><td><span class="image"><img alt="Furnace Grid Fire.png" src="modules/recipe/images/furnace_grid_fire.png" width="36" height="36"></span></td></tr>';
	echo '<tr><td><span class="grid2"><span class="border"><span><span class="image"><a href="index.php?mode=material-stats&material='.$parser_step_2_line_2[1].'" title="'.translate($translate_input_fire).'"><img alt="'.$parser_step_2_line_2[1].'" src="images/icons/'.$parser_step_2_line_2[1].'.png"width="32" height="32"></a></span></span></span></span></td></tr>';
	echo '</tbody></table>'; 
}
function smeltingparser_collect($collection){
	global $recipe;
	for($i=0; $i < count($collection); $i++){
		recipeparser_smelting($collection[$i]);
	}
}
?>