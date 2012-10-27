<?php

function recipeparser_fetch($id)
{
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

function recipeparser_crafting($id)
{
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
	
	echo '<div style="width:238px; height:132px; background-image:url(modules/recipe/images/crafting_background.png); position:relative; border:1px solid #000000; float:left; margin:4px;">';
		if($parser_step_2_line_2[0] != 'null'){echo '<div style="position: absolute; top:28px; left:10px;"><a href="index.php?mode=material-stats&material='.$parser_step_2_line_2[0].'" style="cursor:url(images/cursors/hover.cur),auto;" ><img src="images/icons/'.$parser_step_2_line_2[0].'.png" width="25px" height="25px" border="0" ></a></div>';} else {echo '<div style="position: absolute; top:28px; left:10px;"></div>';}
		if($parser_step_2_line_3[0] != 'null'){echo '<div style="position: absolute; top:64px; left:10px;"><a href="index.php?mode=material-stats&material='.$parser_step_2_line_3[0].'" style="cursor:url(images/cursors/hover.cur),auto;" ><img src="images/icons/'.$parser_step_2_line_3[0].'.png" width="25px" height="25px" border="0" ></a></div>';} else {echo '<div style="position: absolute; top:64px; left:10px;"></div>';}
		if($parser_step_2_line_4[0] != 'null'){echo '<div style="position: absolute; top:100px; left:10px;"><a href="index.php?mode=material-stats&material='.$parser_step_2_line_4[0].'" style="cursor:url(images/cursors/hover.cur),auto;" ><img src="images/icons/'.$parser_step_2_line_4[0].'.png" width="25px" height="25px" border="0" ></a></div>';} else {echo '<div style="position: absolute; top:100px; left:10px;"></div>';}
	
		if($parser_step_2_line_2[1] != 'null'){echo '<div style="position: absolute; top:28px; left:45px;"><a href="index.php?mode=material-stats&material='.$parser_step_2_line_2[1].'" style="cursor:url(images/cursors/hover.cur),auto;" ><img src="images/icons/'.$parser_step_2_line_2[1].'.png" width="25px" height="25px" border="0" ></a></div>';} else {echo '<div style="position: absolute; top:28px; left:45px;"></div>';}
		if($parser_step_2_line_3[1] != 'null'){echo '<div style="position: absolute; top:64px; left:45px;"><a href="index.php?mode=material-stats&material='.$parser_step_2_line_3[1].'" style="cursor:url(images/cursors/hover.cur),auto;" ><img src="images/icons/'.$parser_step_2_line_3[1].'.png" width="25px" height="25px" border="0" ></a></div>';} else {echo '<div style="position: absolute; top:64px; left:45px;"></div>';}
		if($parser_step_2_line_4[1] != 'null'){echo '<div style="position: absolute; top:100px; left:45px;"><a href="index.php?mode=material-stats&material='.$parser_step_2_line_4[1].'" style="cursor:url(images/cursors/hover.cur),auto;" ><img src="images/icons/'.$parser_step_2_line_4[1].'.png" width="25px" height="25px" border="0" ></a></div>';} else {echo '<div style="position: absolute; top:100px; left:45px;"></div>';}
	
		if($parser_step_2_line_2[2] != 'null'){echo '<div style="position: absolute; top:28px; left:82px;"><a href="index.php?mode=material-stats&material='.$parser_step_2_line_2[2].'" style="cursor:url(images/cursors/hover.cur),auto;" ><img src="images/icons/'.$parser_step_2_line_2[2].'.png" width="25px" height="25px" border="0" ></a></div>';} else {echo '<div style="position: absolute; top:28px; left:82px;"></div>';}
		if($parser_step_2_line_3[2] != 'null'){echo '<div style="position: absolute; top:64px; left:82px;"><a href="index.php?mode=material-stats&material='.$parser_step_2_line_3[2].'" style="cursor:url(images/cursors/hover.cur),auto;" ><img src="images/icons/'.$parser_step_2_line_3[2].'.png" width="25px" height="25px" border="0" ></a></div>';} else {echo '<div style="position: absolute; top:64px; left:82px;"></div>';}
		if($parser_step_2_line_4[2] != 'null'){echo '<div style="position: absolute; top:100px; left:82px;"><a href="index.php?mode=material-stats&material='.$parser_step_2_line_4[2].'" style="cursor:url(images/cursors/hover.cur),auto;" ><img src="images/icons/'.$parser_step_2_line_4[2].'.png" width="25px" height="25px" border="0" ></a></div>';} else {echo '<div style="position: absolute; top:100px; left:82px;"></div>';}
				
		echo '<div style="position: absolute; top:64px; left:198px; z-index:0;" align="right"><a href="index.php?mode=material-stats&material='.$parser_step_2_line_1.'" style="cursor:url(images/cursors/hover.cur),auto;" ><img src="images/icons/'.$parser_step_2_line_1.'.png" width="25px" height="25px" border="0" ></a></div>';
		echo '<div style="position: absolute; top:79px; left:205px; text-align:right; vertical-align:bottom; z-index:5; color:#333333; width:25px; height:25px;"><b>'.$parser_step_2_line_5.'</b></div>';
	echo '</div>';
}

function recipeparser_collect($collection)
{
	global $recipe;
	for($i=0; $i < count($collection); $i++)
	{
		recipeparser_crafting($collection[$i]);
	}
}

function brewingparser_fetch($id)
{
	global $brewing;
	$temp_array = array();
	$i = 0;
	foreach($brewing as $key=>$value_a)
	{
		$first_array = explode('|', $value_a);
		$part_a = explode(',', $first_array[1]);
		if($first_array[0] == $id or $part_a[0] == $id or $part_a[1] == $id or $part_a[2] == $id or $first_array[3] == $id)
   		{
			$temp_array[$i] = $key;
			$i++;
		}
	}
	return $temp_array;
}

function recipeparser_brewing($id)
{
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
	
	echo '<div style="width:144px; height:132px; background-image:url(modules/recipe/images/brewing_grid.png); position:relative; border:1px solid #000000; float:left; margin:4px;">';
	echo '<div style="position: absolute; top:19px; left:21px;"><img src="modules/recipe/images/brewing_bubbles.gif" width="24px" height="57px" border="0" ></div>';

		if($parser_step_2_line_2[0] != 'null'){echo '<div style="position: absolute; top:85px; left:7px;"><a href="index.php?mode=material-stats&material='.$parser_step_2_line_2[0].'" style="cursor:url(images/cursors/hover.cur),auto;" ><img title="" src="images/icons/'.$parser_step_2_line_2[0].'.png" width="25px" height="25px" border="0" /></a></div>';} else {echo '<div style="position: absolute; top:28px; left:10px;"></div>';}
		if($parser_step_2_line_2[1] != 'null'){echo '<div style="position: absolute; top:100px; left:55px;"><a href="index.php?mode=material-stats&material='.$parser_step_2_line_2[1].'" style="cursor:url(images/cursors/hover.cur),auto;" ><img title="" src="images/icons/'.$parser_step_2_line_2[1].'.png" width="25px" height="25px" border="0" /></a></div>';} else {echo '<div style="position: absolute; top:28px; left:45px;"></div>';}
		if($parser_step_2_line_2[2] != 'null'){echo '<div style="position: absolute; top:85px; left:100px;"><a href="index.php?mode=material-stats&material='.$parser_step_2_line_2[2].'" style="cursor:url(images/cursors/hover.cur),auto;" ><img title="" src="images/icons/'.$parser_step_2_line_2[2].'.png" width="25px" height="25px" border="0" /></a></div>';} else {echo '<div style="position: absolute; top:85px; left:100px;"></div>';}
				
		echo '<div style="position: absolute; top:24px; left:54px; z-index:0;" align="right"><a href="index.php?mode=material-stats&material='.$parser_step_2_line_1.'" style="cursor:url(images/cursors/hover.cur),auto;" ><img src="images/icons/'.$parser_step_2_line_1.'.png" width="25px" height="25px" border="0" ></a></div>';
		echo '<div style="position: absolute; top:40px; left:58px; text-align:right; vertical-align:bottom; z-index:5; color:#333333; width:25px; height:25px;"><b>'.$parser_step_2_line_3.'</b></div>';
		echo '<div style="position: absolute; top:35px; left:100px;"><span>Equals</span><br /><a href="index.php?mode=material-stats&material='.$parser_step_2_line_4.'" style="cursor:url(images/cursors/hover.cur),auto;" ><img title="'.translate($translate_line4).'" src="images/icons/'.$parser_step_2_line_4.'.png" width="25px" height="25px" border="0" ></a></div>';
	echo '</div>';
}

function brewingparser_collect($collection)
{
	global $recipe;
	for($i=0; $i < count($collection); $i++)
	{
		recipeparser_brewing($collection[$i]);
	}
}

?>