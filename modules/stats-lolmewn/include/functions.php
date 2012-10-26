<?php

function get_amount($user, $stat, $type)
{
	$query = mysql_query("SELECT value FROM ".WS_CONFIG_STATS." WHERE player='$user' AND stat='$stat' AND category='$type'");
	$daten = @mysql_fetch_array($query);
	return $daten[0];
}

function get_user($sort)
{
	if(!isset($sort)) {$sort = 'player';}
	if($sort == 'player') {$sortkey = 'GROUP BY player ORDER BY player';}
	else {$sortkey = 'WHERE stat LIKE "'.$sort.'" GROUP BY player ORDER BY value DESC';}
	$query = mysql_query("SELECT player, stat, value FROM ".WS_CONFIG_STATS." ".$sortkey."");
	$time = 0;
	while($row = mysql_fetch_array($query)) 
	{
		$players[$time] = $row[0];
		$time++;
	}  
	return $players;	
}

function get_user_stats($sort, $start, $end)
{
	if(!isset($sort)) {$sort = 'player';}
	$deadline = time() - WS_CONFIG_DEADLINE;
	if($sort == 'player') {$sortkey = 'GROUP BY player ORDER BY player';}
	else {$sortkey = 'WHERE stat LIKE "'.$sort.'" GROUP BY player ORDER BY value DESC';}
	$query = mysql_query("SELECT player, stat, value FROM ".WS_CONFIG_STATS." ".$sortkey." LIMIT ".$start.",".$end."");
	$time = 0;
	while($row = mysql_fetch_array($query)) 
	{
		$players[$time] = $row[0];
		$time++;
	}  
	return $players;	
}

function get_played($time)
{
	$hour = $time / 3600;
	$hour_2 = floor($hour);
	$minute_hour = $hour_2 * 60;
	$minute = $time / 60; 
	$minute_2 = $minute - $minute_hour;
	$minute_3 = floor($minute_2);
	$day = $hour_2 / 24;
	$day_2 = floor($day);
	$hour_3 = $hour_2 - ($day_2 * 24) ;
	$dayholder = 0;
	
	if ($minute_3 <= 9){$minute_3 = '0'.$minute_3;};
	if ($day_2 <= 9){$day_2 = ''.$day_2;};
	if ($hour_3 <= 9){$hour_3 = '0'.$hour_3;};
	
	if ($hour_2 < 10 && $minute_3 >= 0)
		{
			$played = "0".$hour_2."<span class='timefont'>h</span> ".$minute_3."<span class='timefont'>m</span>";
	 	}

	if ($hour_2 >= 10)
	 	{
			$played = "".$hour_2."<span class='timefont'>h</span> ".$minute_3."<span class='timefont'>m</span>";
	 	}
	if (WS_CONFIG_PLAYTIME === true)
	{
		if ($hour_2 >= 24)
	 	{
			$played = "".$day_2."<span class='timefont'>d</span> ".$hour_3."<span class='timefont'>h</span> ".$minute_3."<span class='timefont'>m</span>";
	 	}
	}
	return $played;
}

function set_index_table($player, $pos)
{
	$pos++;
	global $image_control;
	if($image_control == true) 
	{
		$image = small_image($player);
	}
	$output .= '<tr><td>'.$pos.'</td>';
	$output .= '<td>&nbsp;&nbsp;'.$image.'<a href="index.php?mode=show-player&user='.$player.'" style="cursor:url(images/cursors/hover.cur),auto;" >'.$player.'</a></td>';
	$output .= '<td>'.get_played(get_amount($player, "playedfor", "stats")).'</td>';
	$output .= '<td>'.get_date(get_amount($player, "lastlogin", "stats")).'</td>';
	$output .= '<td>'.get_status($player).'</td>';
	$output .= "</tr>";
	return $output;
}

function set_player_details_table($player)
{
	global $image_control;
	if($image_control == true) 
	{
		$image = large_image($player);	
	}
	$output = '<div class="head_logo" style="background-image:url(modules/player-image/images/player_bg.png)">'.$image.'</div>';
	$output .= '<div class="head_contentbox">';
	$output .= "\n";
	$output .= '<div style="clear:both">
					<div class="head_stat" style="width:350px; font-weight:bold;"><div align="center">'.$player.':</div></div>
				</div>
				<br/><br/>
				<div style="clear:both">
					<div class="head_stat">'.translate("var5").':</div>
					<div class="head_content"> '.get_date(get_amount($player, "lastlogin", "stats")).'</div>
				</div>
				<div>
					<div class="head_stat">'.translate("var14").':</div>
					<div class="head_content"> '.get_date(get_amount($player, "lastlogout", "stats")).'</div>
				</div>
				<div>
					<div class="head_stat">'.translate("var4").':</div>
					<div class="head_content"> '.get_played(get_amount($player, "playedfor", "stats")).'</div>
				</div>
				<div>
					<div class="head_stat">'.translate("var82").':</div>
					<div class="head_content"> '.get_played(get_amount($player, "login", "stats")).'</div>
				</div>
				<div>
					<div class="head_stat">'.translate("var15").':</div>
					<div class="head_content"> '.get_status($player).'</div>
				</div>
				<div>
					<div class="head_stat">'.translate("var16").':</div>
					<div class="head_content"> '.get_amount($player, "total", "deaths").' '.translate("var16").'</div>
				</div>
				<div>
					<div class="head_stat">'.translate("var17").':</div>
					<div class="head_content">'.get_amount($player, "move", "stats").' '.translate("var18").'</div>
				</div>
				<div>
					<div class="head_stat">'.translate("var81").':</div>
					<div class="head_content">'.get_amount($player, "command", "stats").' '.translate("var81").'</div>
				</div>
				<div>
					<div class="head_stat">'.translate("var19").':</div>
					<div class="head_content"> '.get_amount($player, "totalblockdestroy", "stats").' '.translate("var18").'</div>
				</div>
				<div>
					<div class="head_stat">'.translate("var20").':</div>
					<div class="head_content"> '.get_amount($player, "totalblockcreate", "stats").' '.translate("var18").'</div>
				</div>';
	$output .= "\n";
	$output .= '</div>';
	return $output;
}

function set_player_details_table_3d($player)
{

	global $image_control_3d;
	if($image_control_3d == true) 
	{
		$NAME = $_GET['user'];
		$image = '<iframe frameborder="0" src="modules/player-image/full_player_image.php?user='.$NAME.'" title="skin" width="350px" height="300px"></iframe>';
	}
	$output = '<div class="head_logo">'.$image.'</div>';
	$output .= '<div class="head_contentbox">';
	$output .= "\n";
	$output .= '<div style="clear:both">
					<div class="head_stat" style="width:350px; font-weight:bold;"><div align="center">'.$player.':</div></div>
				</div>
				<br/><br/>
				<div style="clear:both">
					<div class="head_stat">'.translate("var5").':</div>
					<div class="head_content"> '.get_date(get_amount($player, "lastlogin", "stats")).'</div>
				</div>
				<div>
					<div class="head_stat">'.translate("var14").':</div>
					<div class="head_content"> '.get_date(get_amount($player, "lastlogout", "stats")).'</div>
				</div>
				<div>
					<div class="head_stat">'.translate("var4").':</div>
					<div class="head_content"> '.get_played(get_amount($player, "playedfor", "stats")).'</div>
				</div>
				<div>
					<div class="head_stat">'.translate("var82").':</div>
					<div class="head_content"> '.get_played(get_amount($player, "login", "stats")).'</div>
				</div>
				<div>
					<div class="head_stat">'.translate("var15").':</div>
					<div class="head_content"> '.get_status($player).'</div>
				</div>
				<div>
					<div class="head_stat">'.translate("var16").':</div>
					<div class="head_content"> '.get_amount($player, "total", "deaths").' '.translate("var16").'</div>
				</div>
				<div>
					<div class="head_stat">'.translate("var17").':</div>
					<div class="head_content">'.get_amount($player, "move", "stats").' '.translate("var18").'</div>
				</div>
				<div>
					<div class="head_stat">'.translate("var81").':</div>
					<div class="head_content">'.get_amount($player, "command", "stats").' '.translate("var81").'</div>
				</div>
				<div>
					<div class="head_stat">'.translate("var19").':</div>
					<div class="head_content"> '.get_amount($player, "totalblockdestroy", "stats").' '.translate("var18").'</div>
				</div>
				<div>
					<div class="head_stat">'.translate("var20").':</div>
					<div class="head_content"> '.get_amount($player, "totalblockcreate", "stats").' '.translate("var18").'</div>
				</div>';
	$output .= "\n";
	$output .= '</div>';
	return $output;
}


function set_player_destroy_table($player, $search)
{
	$query = mysql_query("SELECT player, category, stat, value FROM ".WS_CONFIG_STATS." WHERE player='".$player."' AND category = 'blockdestroy' ".$search."");
	$output = '';
	while($row = mysql_fetch_array($query)) 
	{
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[2])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a href="index.php?mode=material-stats&material='.decrypt($row[2]).'" style="cursor:url(images/cursors/hover.cur),auto;" >'.translate(''.$row[2].'').':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[3].'</div>';
		$output .= "\n";
		$output .= '</div>';
	}
	return $output;
}

function set_player_build_table($player, $search)
{
	$query = mysql_query("SELECT player, category, stat, value FROM ".WS_CONFIG_STATS." WHERE player='".$player."' AND category = 'blockcreate' ".$search."");
	$output = '';
	while($row = mysql_fetch_array($query)) 
	{
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[2])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a href="index.php?mode=material-stats&material='.decrypt($row[2]).'" style="cursor:url(images/cursors/hover.cur),auto;" >'.translate(''.$row[2].'').':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[3].'</div>';
		$output .= "\n";
		$output .= '</div>';
	}
	return $output;
}

function set_player_damagereceived_table($player, $search)
{
	$query = mysql_query("SELECT player, category, stat, value FROM ".WS_CONFIG_STATS." WHERE player='".$player."' AND category = 'damagetaken' AND stat != 'total' ".$search."");
	$output = '';
	while($row = mysql_fetch_array($query)) 
	{
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[2])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a href="index.php?mode=creature-stats&creature='.decrypt($row[2]).'" style="cursor:url(images/cursors/hover.cur),auto;" >'.translate(''.$row[2].'').':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[3].'</div>';
		$output .= "\n";
		$output .= '</div>';
	} 
	$query = mysql_query("SELECT player, category, stat, value FROM ".WS_CONFIG_STATS." WHERE player='".$player."' AND category = 'damagetaken' AND stat = 'total'");
	while($row = mysql_fetch_array($query)) 
	{
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small content_line_small_sum" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[2])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a href="index.php?mode=creature-stats&creature='.decrypt($row[2]).'" style="cursor:url(images/cursors/hover.cur),auto;" >'.translate(''.$row[2].'').':</a></div>';	
		$output .= '<div class="content_line_small content_line_small_sum" align="left" style="width:100px;">'.$row[3].'</div>';
		$output .= "\n";
		$output .= '</div>';
	}
	return $output;
}

function set_player_damagedealt_table($player, $search)
{
	$query = mysql_query("SELECT player, category, stat, value FROM ".WS_CONFIG_STATS." WHERE player='".$player."' AND category = 'damagedealt' AND stat != 'total' ".$search."");
	$output = '';
	while($row = mysql_fetch_array($query)) 
	{
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[2])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a href="index.php?mode=creature-stats&creature='.decrypt($row[2]).'" style="cursor:url(images/cursors/hover.cur),auto;" >'.translate(''.$row[2].'').':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[3].'</div>';
		$output .= "\n";
		$output .= '</div>';
	}  
	$query = mysql_query("SELECT player, category, stat, value FROM ".WS_CONFIG_STATS." WHERE player='".$player."' AND category = 'damagedealt' AND stat = 'total'");
	while($row = mysql_fetch_array($query)) 
	{
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small content_line_small_sum" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[2])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a href="index.php?mode=creature-stats&creature='.decrypt($row[2]).'" style="cursor:url(images/cursors/hover.cur),auto;" >'.translate(''.$row[2].'').':</a></div>';	
		$output .= '<div class="content_line_small content_line_small_sum" align="left" style="width:100px;">'.$row[3].'</div>';
		$output .= "\n";
		$output .= '</div>';
	}
	return $output;
}

function set_player_didkill_table($player, $search)
{
	$query = mysql_query("SELECT player, category, stat, value FROM ".WS_CONFIG_STATS." WHERE player='".$player."' AND category = 'kills' AND stat != 'total' ".$search."");
	$output = '';
	while($row = mysql_fetch_array($query)) 
	{
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[2])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a href="index.php?mode=creature-stats&creature='.decrypt($row[2]).'" style="cursor:url(images/cursors/hover.cur),auto;" >'.translate(''.$row[2].'').':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[3].'</div>';
		$output .= "\n";
		$output .= '</div>';
	} 	
	$query = mysql_query("SELECT player, category, stat, value FROM ".WS_CONFIG_STATS." WHERE player='".$player."' AND category = 'kills' AND stat = 'total'");
	while($row = mysql_fetch_array($query)) 
	{
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small content_line_small_sum" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[2])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a href="index.php?mode=creature-stats&creature='.decrypt($row[2]).'" style="cursor:url(images/cursors/hover.cur),auto;" >'.translate(''.$row[2].'').':</a></div>';	
		$output .= '<div class="content_line_small content_line_small_sum" align="left" style="width:100px;">'.$row[3].'</div>';
		$output .= "\n";
		$output .= '</div>';
	}
	return $output;
}

function set_player_getkill_table($player, $search)
{
	$query = mysql_query("SELECT player, category, stat, value FROM ".WS_CONFIG_STATS." WHERE player='".$player."' AND category = 'deaths' AND stat != 'total' ".$search."");
	$output = '';
	while($row = mysql_fetch_array($query)) 
	{
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[2])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a href="index.php?mode=creature-stats&creature='.decrypt($row[2]).'" style="cursor:url(images/cursors/hover.cur),auto;" >'.translate(''.$row[2].'').':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[3].'</div>';
		$output .= "\n";
		$output .= '</div>';
	} 	
	$query = mysql_query("SELECT player, category, stat, value FROM ".WS_CONFIG_STATS." WHERE player='".$player."' AND category = 'deaths' AND stat = 'total'");
	while($row = mysql_fetch_array($query)) 
	{
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small content_line_small_sum" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[2])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a href="index.php?mode=creature-stats&creature='.decrypt($row[2]).'" style="cursor:url(images/cursors/hover.cur),auto;" >'.translate(''.$row[2].'').':</a></div>';	
		$output .= '<div class="content_line_small content_line_small_sum" align="left" style="width:100px;">'.$row[3].'</div>';
		$output .= "\n";
		$output .= '</div>';
	}
	return $output;
}

function set_player_founditem_table($player, $search)
{
	$query = mysql_query("SELECT player, category, stat, value FROM ".WS_CONFIG_STATS." WHERE player='".$player."' AND category = 'itempickup' ".$search."");
	$output = '';
	while($row = mysql_fetch_array($query)) 
	{
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[2])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a href="index.php?mode=material-stats&material='.decrypt($row[2]).'" style="cursor:url(images/cursors/hover.cur),auto;" >'.translate(''.$row[2].'').':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[3].'</div>';
		$output .= "\n";
		$output .= '</div>';
	}  	
	return $output;
}

function set_player_dropitem_table($player, $search)
{
	$query = mysql_query("SELECT player, category, stat, value FROM ".WS_CONFIG_STATS." WHERE player='".$player."' AND category = 'itemdrop' ".$search."");
	$output = '';
	while($row = mysql_fetch_array($query)) 
	{
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[2])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a href="index.php?mode=material-stats&material='.decrypt($row[2]).'" style="cursor:url(images/cursors/hover.cur),auto;" >'.translate(''.$row[2].'').':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[3].'</div>';
		$output .= "\n";
		$output .= '</div>';
	}  	
	return $output;
}

function get_server_player()
{
	$query = mysql_query("SELECT player, stat, value FROM ".WS_CONFIG_STATS." GROUP BY player");
	$time = 0;
	while($row = mysql_fetch_array($query)) 
	{
		$players[$time] = $row[0];
		$time++;
	}  
	return $time;
}

function get_server_count($cat, $stat)
{
	$query = mysql_query("SELECT value FROM ".WS_CONFIG_STATS." WHERE category='".$cat."' AND stat LIKE '".$stat."'");
	$time = 0;
	while($row = mysql_fetch_array($query)) 
	{
		$time = $time + $row[0];
	}  
	return $time;
}

function get_server_played()
{
	$query = mysql_query("SELECT value FROM ".WS_CONFIG_STATS." WHERE category='stats' AND stat = 'playedfor'");
	$time = 0;
	while($row = mysql_fetch_array($query)) 
	{
		$time = $time + $row[0];
	} 
	$hour = $time / 3600;
	$hour_2 = floor($hour);
	$minute_hour = $hour_2 * 60;
	$minute = $time / 60; 
	$minute_2 = $minute - $minute_hour;
	$minute_3 = floor($minute_2);
	$day = $hour_2 / 24;
	$day_2 = floor($day);
	$hour_3 = $hour_2 - ($day_2 * 24) ;
	$dayholder = 0;
	
	if ($minute_3 <= 9){$minute_3 = '0'.$minute_3;};
	if ($hour_2 <= 10 && $minute_3 >= 0)
	 {
		$played = "0$hour_2 h $minute_3 m";
	 }

	if ($hour_2 > 10)
	 {
		$played = "$hour_2 h $minute_3 m";
	 }
	 return $played;
}

function set_server_details_table()
{
	$output .= '<div class="head_logo" style="background-image:url('.WS_CONFIG_LOGO.'); background-repeat: no-repeat; background-position: center"></div>';

	$output .= '<div class="head_contentbox">';
	$output .= "\n";
	$output .= '<div style="clear:both">
					<div class="head_stat">'.translate("var23").':</div>
					<div class="head_content"> '.get_server_player().'</div>
				</div>
				
				<div>
					<div class="head_stat">'.translate("var8").':</div>
					<div class="head_content"> '.get_server_count('blockdestroy', '%%').'</div>
				</div>
				
				<div>
					<div class="head_stat">'.translate("var9").':</div>
					<div class="head_content"> '.get_server_count('blockcreate', '%%').'</div>
				</div>
				
				<div>
					<div class="head_stat">'.translate("var24").':</div>
					<div class="head_content"> '.get_server_count('stats', 'armswing').'</div>
				</div>
				
				<div>
					<div class="head_stat">'.translate("var4").':</div>
					<div class="head_content"> '.get_server_played().'</div>
				</div>
				
				<div>
					<div class="head_stat">'.translate("var25").':</div>
					<div class="head_content">'.get_server_count("stats", "login").'</div>
				</div>
				
				<div>
					<div class="head_stat">'.translate("var17").':</div>
					<div class="head_content"> '.get_server_count("stats", "move").' '.translate("var18").'</div>
				</div>
				
				<div>
					<div class="head_stat">'.translate("var26").':</div>
					<div class="head_content"> '.get_server_count("stats", "openchest").'</div>
				</div>
				
				<div>
					<div class="head_stat">'.translate("var27").':</div>
					<div class="head_content"> '.get_server_count("stats", "command").'</div>
				</div>
				
				<div>
					<div class="head_stat">'.translate("var28").':</div>
					<div class="head_content"> '.get_server_count("stats", "chat").'</div>
				</div>
				
				<div>
					<div class="head_stat">'.translate("var29").':</div>
					<div class="head_content">'.get_server_count("stats", "chatletters").'</div>
				</div>';
	$output .= '</div>';
	return $output;
}

function set_server_didkill_table($search)
{
	$query = mysql_query("SELECT category, stat, SUM(value) FROM ".WS_CONFIG_STATS." WHERE category = 'kills' AND stat != 'total' GROUP BY stat ".$search."");
	$output = '';
	while($row = mysql_fetch_array($query)) 
	{
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[1])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a href="index.php?mode=creature-stats&creature='.decrypt($row[1]).'" style="cursor:url(images/cursors/hover.cur),auto;" >'.translate(''.$row[1].'').':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[2].'</div>';
		$output .= "\n";
		$output .= '</div>';
	}	
	$query = mysql_query("SELECT category, stat, SUM(value) FROM ".WS_CONFIG_STATS." WHERE category = 'kills' AND stat = 'total' GROUP BY stat");
	while($row = mysql_fetch_array($query)) 
	{
		
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small content_line_small_sum" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[1])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a href="index.php?mode=creature-stats&creature='.decrypt($row[1]).'" style="cursor:url(images/cursors/hover.cur),auto;" >'.translate(''.$row[1].'').':</a></div>';	
		$output .= '<div class="content_line_small content_line_small_sum" align="left" style="width:100px;">'.$row[2].'</div>';
		$output .= "\n";		
		$output .= '</div>';
	}	
	return $output;
}

function set_server_getkill_table($search)
{
	$query = mysql_query("SELECT category, stat, SUM(value) FROM ".WS_CONFIG_STATS." WHERE category = 'deaths' AND stat != 'total' GROUP BY stat ".$search."");
	$output = '';
	while($row = mysql_fetch_array($query)) 
	{
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[1])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a href="index.php?mode=creature-stats&creature='.decrypt($row[1]).'" style="cursor:url(images/cursors/hover.cur),auto;" >'.translate(''.$row[1].'').':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[2].'</div>';
		$output .= "\n";
		$output .= '</div>';
	}	
	$query = mysql_query("SELECT category, stat, SUM(value) FROM ".WS_CONFIG_STATS." WHERE category = 'deaths' AND stat = 'total' GROUP BY stat");
	while($row = mysql_fetch_array($query)) 
	{
		
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small content_line_small_sum" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[1])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a href="index.php?mode=creature-stats&creature='.decrypt($row[1]).'" style="cursor:url(images/cursors/hover.cur),auto;" >'.translate(''.$row[1].'').':</a></div>';	
		$output .= '<div class="content_line_small content_line_small_sum" align="left" style="width:100px;">'.$row[2].'</div>';
		$output .= "\n";		
		$output .= '</div>';
	}
	return $output;
}

function set_server_destroy_table($search)
{
	$query = mysql_query("SELECT category, stat, SUM(value) FROM ".WS_CONFIG_STATS." WHERE category = 'blockdestroy' GROUP BY stat ".$search."");
	$output = '';
	while($row = mysql_fetch_array($query)) 
	{
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[1])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a href="index.php?mode=material-stats&material='.decrypt($row[1]).'" style="cursor:url(images/cursors/hover.cur),auto;" >'.translate(''.$row[1].'').':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[2].'</div>';
		$output .= "\n";
		$output .= '</div>';
	}	
	return $output;
}

function set_server_build_table($search)
{
	$query = mysql_query("SELECT category, stat, SUM(value) FROM ".WS_CONFIG_STATS." WHERE category = 'blockcreate' GROUP BY stat ".$search."");
	$output = '';
	while($row = mysql_fetch_array($query)) 
	{
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt(''.$row[1].'')).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a href="index.php?mode=material-stats&material='.decrypt(''.$row[1].'').'" style="cursor:url(images/cursors/hover.cur),auto;" >'.translate(''.$row[1].'').':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[2].'</div>';
		$output .= "\n";
		$output .= '</div>';
	}	
	return $output;
}

function set_server_damagereceived_table($search)
{
	$query = mysql_query("SELECT category, stat, SUM(value) FROM ".WS_CONFIG_STATS." WHERE category = 'damagetaken' AND stat != 'total' GROUP BY stat ".$search."");
	$output = '';
	while($row = mysql_fetch_array($query)) 
	{
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt(''.$row[1].'')).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a href="index.php?mode=creature-stats&creature='.decrypt(''.$row[1].'').'" style="cursor:url(images/cursors/hover.cur),auto;" >'.translate(''.$row[1].'').':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[2].'</div>';
		$output .= "\n";
		$output .= '</div>';
	}  
	$query = mysql_query("SELECT category, stat, SUM(value) FROM ".WS_CONFIG_STATS." WHERE category = 'damagetaken' AND stat = 'total' GROUP BY stat");
	while($row = mysql_fetch_array($query)) 
	{
		
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small content_line_small_sum" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[1])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a href="index.php?mode=creature-stats&creature='.decrypt($row[1]).'" style="cursor:url(images/cursors/hover.cur),auto;" >'.translate(''.$row[1].'').':</a></div>';	
		$output .= '<div class="content_line_small content_line_small_sum" align="left" style="width:100px;">'.$row[2].'</div>';
		$output .= "\n";		
		$output .= '</div>';
	}
	return $output;
}

function set_server_damagedealt_table($search)
{
	$query = mysql_query("SELECT category, stat, SUM(value) FROM ".WS_CONFIG_STATS." WHERE category = 'damagedealt' AND stat != 'total' GROUP BY stat ".$search."");
	$output = '';
	while($row = mysql_fetch_array($query)) 
	{
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[1])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a href="index.php?mode=creature-stats&creature='.decrypt($row[1]).'" style="cursor:url(images/cursors/hover.cur),auto;" >'.translate(''.$row[1].'').':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[2].'</div>';
		$output .= "\n";
		$output .= '</div>';
	} 
	$query = mysql_query("SELECT category, stat, SUM(value) FROM ".WS_CONFIG_STATS." WHERE category = 'damagedealt' AND stat = 'total' GROUP BY stat");
	while($row = mysql_fetch_array($query)) 
	{
		
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small content_line_small_sum" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[1])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a href="index.php?mode=creature-stats&creature='.decrypt($row[1]).'" style="cursor:url(images/cursors/hover.cur),auto;" >'.translate(''.$row[1].'').':</a></div>';	
		$output .= '<div class="content_line_small content_line_small_sum" align="left" style="width:100px;">'.$row[2].'</div>';
		$output .= "\n";		
		$output .= '</div>';
	}
	return $output;
}

function set_material_destroy_table($material, $search)
{
	global $image_control;
	$query = mysql_query("SELECT player, category, stat, value FROM ".WS_CONFIG_STATS." WHERE category = 'blockdestroy' AND stat = '".mysql_real_escape_string($material)."' GROUP BY player ".$search."");
	$output = '';
	while($row = mysql_fetch_array($query)) 
	{		
		if($image_control == true) 
		{
			$image = small_image($row[0]);
		}
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;">'.$image.'&nbsp;&nbsp;<a href="index.php?mode=show-player&user='.$row[0].'" '.hover.' >'.$row[0].':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[3].'</div>';
		$output .= "\n";
		$output .= '</div>';
	}  
	return $output;
}

function set_material_build_table($material, $search)
{
	global $image_control;
	$query = mysql_query("SELECT player, category, stat, value FROM ".WS_CONFIG_STATS." WHERE category='blockdestroy' AND stat = '".mysql_real_escape_string($material)."' GROUP BY player ".$search."");
	$output = '';
	while($row = mysql_fetch_array($query)) 
	{
		if($image_control == true) 
		{
			$image = small_image($row['player']);
		}
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;">'.$image.'&nbsp;&nbsp;<a href="index.php?mode=show-player&user='.$row['player'].'" '.hover.' >'.$row['player'].':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row['value'].'</div>';
		$output .= "\n";
		$output .= '</div>';
	} 
	return $output;
}
function set_creature_damagereceived_table($creature, $search)
{
	global $image_control;
	$query = mysql_query("SELECT player, category, stat, value FROM `".WS_CONFIG_STATS."` WHERE `category` = 'damagetaken' AND `stat` = '".encrypt($creature)."' GROUP BY `player` ".$search." ");
	$output = '';
	while($row = mysql_fetch_array($query))
	{
		if($image_control == true) 
		{
			$image = small_image($row['player']);
		}
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;">'.$image.'&nbsp;&nbsp;<a href="index.php?mode=show-player&user='.$row['player'].'" '.hover.'" >'.$row['player'].':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row['value'].'</div>';
		$output .= "\n";
		$output .= '</div>';
	} 
	return $output;
}

function set_creature_damagedealt_table($creature, $search)
{
	global $image_control;
	$query = mysql_query("SELECT player, category, stat, value FROM ".WS_CONFIG_STATS." WHERE category = 'damagedealt' AND stat = '".encrypt($creature)."' GROUP BY player ".$search."");
	$output = '';
	while($row = mysql_fetch_array($query)) 
	{
		if($image_control == true) 
		{
			$image = small_image($row['player']);
		}
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;">'.$image.'&nbsp;&nbsp;<a href="index.php?mode=show-player&user='.$row['player'].'" '.hover.' >'.$row['player'].':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row['value'].'</div>';
		$output .= "\n";
		$output .= '</div>';
	} 
	return $output;
}

// Blacklist for inactive users (using WS_CONFIG_DEADLINE)
function blacklist()
{
	$marker = '~*~';
	$player_all = get_user('player');
	for($i=0; $i < sizeof($player_all); $i++)
	{
		$query = mysql_query("UPDATE ".WS_CONFIG_STATS." SET player='".$marker."".$player_all[$i]."' WHERE player='".$player_all[$i]."'");
	}	
}

?>