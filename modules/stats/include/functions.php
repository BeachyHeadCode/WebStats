<?php
function get_amount($user, $stat, $type) {
	global $link;
	$query = mysqli_query($link, "SELECT `value` FROM `".WS_CONFIG_STATS."` WHERE `player`='$user' AND `stat`='$stat' AND `category`='$type'");
	$data = @mysqli_fetch_array($query, MYSQLI_NUM);
	return $data[0];
}

/**
 * This function will check whether the player is online or not.
 *
 * @since 3.0
 *
 * @param string $player Player name.
 * @param string $lastlogout Name of last logout column.
 * @param string $lastlogin Name of last login column.
 * @param string $table Name of the table.
 */
function get_status($player, $lastlogout, $lastlogin, $table) {
	if (get_amount($player, $lastlogout, $table) <= get_amount($player, $lastlogin, $table))
		$status = '<span class="online">Online</span>';
	else
		$status = '<span class="offline">Offline</span>';
	return $status;
}

function get_user($sort) {
	global $link;
	if(!isset($sort)) {$sort = 'player';}
	if($sort == 'player') {$sortkey = 'GROUP BY `player` ORDER BY `player`';}
	else {$sortkey = 'WHERE stat LIKE "'.$sort.'" GROUP BY `player` ORDER BY `value` DESC';}
	$query = mysqli_query($link, "SELECT `player` FROM `".WS_CONFIG_STATS."` ".$sortkey."");
	$time = 0;
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		$players[$time] = $row[0];
		$time++;
	}  
	return $players;	
}

function get_user_stats($sort, $start, $end) {
	global $link;
	if(!isset($sort)) {$sort = 'player';}
	$deadline = time() - WS_CONFIG_DEADLINE;
	if($sort == 'player') {$sortkey = 'GROUP BY `player` ORDER BY `player`';}
	else {$sortkey = 'WHERE `stat` LIKE "'.$sort.'" GROUP BY `player` ORDER BY `value` DESC';}
	$query = mysqli_query($link, "SELECT `player` FROM `".WS_CONFIG_STATS."` ".$sortkey." LIMIT ".$start.",".$end."");
	$time = 0;
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		$players[$time] = $row[0];
		$time++;
	}  
	return $players;	
}

function set_index_table($player, $pos) {
	$pos++;
	global $image_control;
	if($image_control == true) {
		$image = small_image($player);
	}
	$output .= '<tr><td>'.$pos.'</td>';
	$output .= '<td>&nbsp;&nbsp;'.$image.'<a class="ajax-link" href="index.php?mode=show-player&user='.$player.'">'.$player.'</a></td>';
	$output .= '<td>'.get_played(get_amount($player, "playedfor", "stats")).'</td>';
	$output .= '<td>'.get_date(get_amount($player, "lastlogin", "stats")).'</td>';
	$output .= '<td>'.get_status($player, 'LASTLOGIN', 'LASTLOGOUT', '_players').'</td>';
	$output .= "</tr>";
	return $output;
}

function set_player_details_table($player) {
	$output = '<div class="small-6 columns head_contentbox">'."\n";
	$output .= '<div style="clear:both">
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
					<div class="head_content"> '.get_amount($player, "totalblockcreate", "stats").' '.translate("var18")."</div>
				</div>\n";
	$output .= '</div>';
	return $output;
}

function set_player_destroy_table($player, $search) {
	global $link;
	$query = mysqli_query($link, "SELECT `stat`, `value` FROM `".WS_CONFIG_STATS."` WHERE `player`='".$player."' AND `category` = 'blockdestroy' ".$search."");
	$output = '';
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[0])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a class="ajax-link" href="index.php?mode=material-stats&material='.decrypt($row[0]).'"  >'.translate(''.$row[0].'').':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[1]."</div>\n";
		$output .= '</div>';
	}
	return $output;
}

function set_player_build_table($player, $search) {
	global $link;
	$query = mysqli_query($link, "SELECT `player`, `category`, `stat`, `value` FROM `".WS_CONFIG_STATS."` WHERE `player`='".$player."' AND `category` = 'blockcreate' ".$search."");
	$output = '';
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[2])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a class="ajax-link" href="index.php?mode=material-stats&material='.decrypt($row[2]).'"  >'.translate(''.$row[2].'').':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[3]."</div>\n";
		$output .= '</div>';
	}
	return $output;
}

function set_player_damagereceived_table($player, $search) {
	global $link;
	$query = mysqli_query($link, "SELECT `stat`, `value` FROM `".WS_CONFIG_STATS."` WHERE `player`='".$player."' AND `category` = 'damagetaken' AND `stat` != 'total' ".$search."");
	$output = '';
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[0])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a class="ajax-link" href="index.php?mode=creature-stats&creature='.decrypt($row[0]).'"  >'.translate(''.$row[0].'').':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[1]."</div>\n";
		$output .= '</div>';
	} 
	$query = mysqli_query($link, "SELECT `stat`, `value` FROM `".WS_CONFIG_STATS."` WHERE `player`='".$player."' AND `category` = 'damagetaken' AND `stat` = 'total'");
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small content_line_small_sum" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[0])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a class="ajax-link" href="index.php?mode=creature-stats&creature='.decrypt($row[0]).'"  >'.translate(''.$row[0].'').':</a></div>';	
		$output .= '<div class="content_line_small content_line_small_sum" align="left" style="width:100px;">'.$row[1]."</div>\n";
		$output .= '</div>';
	}
	return $output;
}

function set_player_damagedealt_table($player, $search) {
	global $link;
	$query = mysqli_query($link, "SELECT `stat`, `value` FROM `".WS_CONFIG_STATS."` WHERE `player`='".$player."' AND `category` = 'damagedealt' AND `stat` != 'total' ".$search."");
	$output = '';
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[0])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a class="ajax-link" href="index.php?mode=creature-stats&creature='.decrypt($row[0]).'"  >'.translate(''.$row[0].'').':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[1]."</div>\n";
		$output .= '</div>';
	}  
	$query = mysqli_query($link, "SELECT `stat`, `value` FROM `".WS_CONFIG_STATS."` WHERE `player`='".$player."' AND `category` = 'damagedealt' AND `stat` = 'total'");
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small content_line_small_sum" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[0])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a class="ajax-link" href="index.php?mode=creature-stats&creature='.decrypt($row[0]).'"  >'.translate(''.$row[0].'').':</a></div>';	
		$output .= '<div class="content_line_small content_line_small_sum" align="left" style="width:100px;">'.$row[1]."</div>\n";
		$output .= '</div>';
	}
	return $output;
}

function set_player_didkill_table($player, $search) {
	global $link;
	$query = mysqli_query($link, "SELECT player, category, stat, value FROM `".WS_CONFIG_STATS."` WHERE player='".$player."' AND category = 'kills' AND stat != 'total' ".$search."");
	$output = '';
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[2])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a class="ajax-link" href="index.php?mode=creature-stats&creature='.decrypt($row[2]).'"  >'.translate(''.$row[2].'').':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[3]."</div>\n";
		$output .= '</div>';
	} 	
	$query = mysqli_query($link, "SELECT player, category, stat, value FROM `".WS_CONFIG_STATS."` WHERE player='".$player."' AND category = 'kills' AND stat = 'total'");
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small content_line_small_sum" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[2])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a class="ajax-link" href="index.php?mode=creature-stats&creature='.decrypt($row[2]).'"  >'.translate(''.$row[2].'').':</a></div>';	
		$output .= '<div class="content_line_small content_line_small_sum" align="left" style="width:100px;">'.$row[3]."</div>\n";
		$output .= '</div>';
	}
	return $output;
}

function set_player_getkill_table($player, $search) {
	global $link;
	$query = mysqli_query($link, "SELECT `stat`, `value` FROM `".WS_CONFIG_STATS."` WHERE `player`='".$player."' AND `category` = 'deaths' AND `stat` != 'total' ".$search."");
	$output = '';
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[0])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a class="ajax-link" href="index.php?mode=creature-stats&creature='.decrypt($row[0]).'"  >'.translate(''.$row[1].'').':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[1]."</div>\n";
		$output .= '</div>';
	} 	
	$query = mysqli_query($link, "SELECT player, category, stat, value FROM `".WS_CONFIG_STATS."` WHERE player='".$player."' AND category = 'deaths' AND stat = 'total'");
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small content_line_small_sum" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[2])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a class="ajax-link" href="index.php?mode=creature-stats&creature='.decrypt($row[2]).'"  >'.translate(''.$row[2].'').':</a></div>';	
		$output .= '<div class="content_line_small content_line_small_sum" align="left" style="width:100px;">'.$row[3]."</div>\n";
		$output .= '</div>';
	}
	return $output;
}

function set_player_founditem_table($player, $search) {
	global $link;
	$query = mysqli_query($link, "SELECT player, category, stat, value FROM `".WS_CONFIG_STATS."` WHERE player='".$player."' AND category = 'itempickup' ".$search."");
	$output = '';
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[2])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a class="ajax-link" href="index.php?mode=material-stats&material='.decrypt($row[2]).'"  >'.translate(''.$row[2].'').':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[3]."</div>\n";
		$output .= '</div>';
	}  	
	return $output;
}

function set_player_dropitem_table($player, $search) {
	global $link;
	$query = mysqli_query($link, "SELECT `stat`, `value` FROM `".WS_CONFIG_STATS."` WHERE `player`='".$player."' AND `category` = 'itemdrop' ".$search."");
	$output = '';
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[0])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a class="ajax-link" href="index.php?mode=material-stats&material='.decrypt($row[0]).'"  >'.translate(''.$row[0].'').':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[1]."</div>\n";
		$output .= '</div>';
	}  	
	return $output;
}

function get_server_player() {
	global $link;
	$query = mysqli_query($link, "SELECT `player` FROM `".WS_CONFIG_STATS."` GROUP BY `player`");
	$time = 0;
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		$players[$time] = $row[0];
		$time++;
	}  
	return $time;
}

function get_server_count($cat, $stat) {
	global $link;
	$query = mysqli_query($link, "SELECT `value` FROM `".WS_CONFIG_STATS."` WHERE `category`='".$cat."' AND `stat` LIKE '".$stat."'");
	$time = 0;
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		$time = $time + $row[0];
	}  
	return $time;
}

function get_server_played() {
	global $link;
	$query = mysqli_query($link, "SELECT `value` FROM `".WS_CONFIG_STATS."` WHERE `category`='stats' AND `stat` = 'playedfor'");
	$time = 0;
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
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
	if ($hour_2 <= 10 && $minute_3 >= 0) {
		$played = "0$hour_2 h $minute_3 m";
	}
	if ($hour_2 > 10) {
		$played = "$hour_2 h $minute_3 m";
	 }
	 return $played;
}

function set_server_details_table() {
	$output = '<div class="small-6 columns head_logo" style="background-image:url('.WS_CONFIG_LOGO.'); background-repeat: no-repeat; background-position: center"></div>';
	$output .= '<div class="small-6 columns head_contentbox">'."\n";
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

function set_server_didkill_table($search) {
	global $link;
	$query = mysqli_query($link, "SELECT `stat`, SUM(`value`) FROM `".WS_CONFIG_STATS."` WHERE `category` = 'kills' AND `stat` != 'total' GROUP BY `stat` ".$search."");
	$output = '';
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[0])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a class="ajax-link" href="index.php?mode=creature-stats&creature='.decrypt($row[0]).'"  >'.translate(''.$row[0].'').':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[1]."</div>\n";
		$output .= '</div>';
	}	
	$query = mysqli_query($link, "SELECT `category`, `stat`, SUM(`value`) FROM `".WS_CONFIG_STATS."` WHERE `category` = 'kills' AND `stat` = 'total' GROUP BY stat");
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small content_line_small_sum" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[1])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a class="ajax-link" href="index.php?mode=creature-stats&creature='.decrypt($row[1]).'"  >'.translate(''.$row[1].'').':</a></div>';	
		$output .= '<div class="content_line_small content_line_small_sum" align="left" style="width:100px;">'.$row[2]."</div>\n";		
		$output .= '</div>';
	}	
	return $output;
}

function set_server_getkill_table($search) {
	global $link;
	$query = mysqli_query($link, "SELECT `stat`, SUM(`value`) FROM `".WS_CONFIG_STATS."` WHERE `category` = 'deaths' AND `stat` != 'total' GROUP BY `stat` ".$search."");
	$output = '';
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[0])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a class="ajax-link" href="index.php?mode=creature-stats&creature='.decrypt($row[0]).'"  >'.translate(''.$row[0].'').':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[1]."</div>\n";
		$output .= '</div>';
	}	
	$query = mysqli_query($link, "SELECT `stat`, SUM(`value`) FROM `".WS_CONFIG_STATS."` WHERE category = 'deaths' AND `stat` = 'total' GROUP BY `stat`");
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small content_line_small_sum" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[0])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a class="ajax-link" href="index.php?mode=creature-stats&creature='.decrypt($row[0]).'"  >'.translate(''.$row[0].'').':</a></div>';	
		$output .= '<div class="content_line_small content_line_small_sum" align="left" style="width:100px;">'.$row[1]."</div>\n";	
		$output .= '</div>';
	}
	return $output;
}

function set_server_destroy_table($search) {
	global $link;
	$query = mysqli_query($link, "SELECT `stat`, SUM(`value`) FROM ".WS_CONFIG_STATS." WHERE `category` = 'blockdestroy' GROUP BY `stat` ".$search."");
	$output = '';
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		$image = str_replace(":", "-", $row[0]); 
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($image)).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a class="ajax-link" href="index.php?mode=material-stats&material='.$row[0].'"  >'.translate(''.$row[0].'').':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[1].'</div>';
		$output .= "\n";
		$output .= '</div>';
	}	
	return $output;
}

function set_server_build_table($search) {
	global $link;
	$query = mysqli_query($link, "SELECT `stat`, SUM(`value`) FROM ".WS_CONFIG_STATS." WHERE `category` = 'blockcreate' GROUP BY `stat` ".$search."");
	$output = '';
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		$image = str_replace(":", "-", $row[0]); 
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($image)).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a class="ajax-link" href="index.php?mode=material-stats&material='.$row[0].'"  >'.translate(''.$row[0].'').':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[1].'</div>';
		$output .= "\n";
		$output .= '</div>';
	}	
	return $output;
}

function set_server_damagereceived_table($search) {
	global $link;
	$query = mysqli_query($link, "SELECT `category`, `stat`, SUM(`value`) FROM `".WS_CONFIG_STATS."` WHERE `category` = 'damagetaken' AND `stat` != 'total' GROUP BY `stat` ".$search."");
	$output = '';
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt(''.$row[1].'')).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a class="ajax-link" href="index.php?mode=creature-stats&creature='.decrypt(''.$row[1].'').'"  >'.translate(''.$row[1].'').':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[2]."</div>\n";
		$output .= '</div>';
	}  
	$query = mysqli_query($link, "SELECT category, stat, SUM(value) FROM ".WS_CONFIG_STATS." WHERE category = 'damagetaken' AND stat = 'total' GROUP BY stat");
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small content_line_small_sum" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[1])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a class="ajax-link" href="index.php?mode=creature-stats&creature='.decrypt($row[1]).'"  >'.translate(''.$row[1].'').':</a></div>';	
		$output .= '<div class="content_line_small content_line_small_sum" align="left" style="width:100px;">'.$row[2]."</div>\n";	
		$output .= '</div>';
	}
	return $output;
}

function set_server_damagedealt_table($search) {
	global $link;
	$query = mysqli_query($link, "SELECT `stat`, SUM(`value`) FROM `".WS_CONFIG_STATS."` WHERE `category` = 'damagedealt' AND `stat` != 'total' GROUP BY `stat` ".$search."");
	$output = '';
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[0])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a class="ajax-link" href="index.php?mode=creature-stats&creature='.decrypt($row[0]).'"  >'.translate(''.$row[0].'').':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[1]."</div>\n";
		$output .= '</div>';
	} 
	$query = mysqli_query($link, "SELECT `stat`, SUM(`value`) FROM ".WS_CONFIG_STATS." WHERE `category` = 'damagedealt' AND `stat` = 'total' GROUP BY `stat`");
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small content_line_small_sum" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[0])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a class="ajax-link" href="index.php?mode=creature-stats&creature='.decrypt($row[0]).'"  >'.translate(''.$row[0].'').':</a></div>';	
		$output .= '<div class="content_line_small content_line_small_sum" align="left" style="width:100px;">'.$row[1]."</div>\n";	
		$output .= '</div>';
	}
	return $output;
}

function set_material_destroy_table($material, $search) {
	global $image_control, $link;
	$query = mysqli_query($link, "SELECT `player`, `value` FROM `".WS_CONFIG_STATS."` WHERE `category` = 'blockdestroy' AND `stat` = '".mysqli_real_escape_string($link, $material)."' GROUP BY `player` ORDER BY `value` ".$search);
	$output = '';
	while($row = mysqli_fetch_array($query)) {		
		if($image_control == true) {
			$image = small_image($row[0]);
		}
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;">'.$image.'&nbsp;&nbsp;<a class="ajax-link" href="index.php?mode=show-player&user='.$row[0].'">'.$row[0].':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[1]."</div>\n";
		$output .= '</div>';
	}  
	return $output;
}

function set_material_build_table($material, $search) {
	global $image_control, $link;
	$query = mysqli_query($link, "SELECT `player`, `value` FROM `".WS_CONFIG_STATS."` WHERE `category` = 'blockdestroy' AND `stat` = '".mysql_real_escape_string($material)."' GROUP BY `player` ORDER BY `value` ".$search);
	$output = '';
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		if($image_control == true) {
			$image = small_image($row['player']);
		}
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;">'.$image.'&nbsp;&nbsp;<a class="ajax-link" href="index.php?mode=show-player&user='.$row[0].'">'.$row[0].':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[1]."</div>\n";
		$output .= '</div>';
	} 
	return $output;
}
function set_creature_damagereceived_table($creature, $search) {
	global $image_control, $link;
	$query = mysqli_query($link, "SELECT `player`, `value` FROM `".WS_CONFIG_STATS."` WHERE `category` = 'damagetaken' AND `stat` = '".encrypt($creature)."' GROUP BY `player` ".$search." ");
	$output = '';
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		if($image_control == true) {
			$image = small_image($row[0]);
		}
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;">'.$image.'&nbsp;&nbsp;<a class="ajax-link" href="index.php?mode=show-player&user='.$row[0].'">'.$row[0].':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[1]."</div>\n";
		$output .= '</div>';
	} 
	return $output;
}

function set_creature_damagedealt_table($creature, $search) {
	global $image_control, $link;
	$query = mysqli_query($link, "SELECT `player`, `value` FROM ".WS_CONFIG_STATS." WHERE `category` = 'damagedealt' AND `stat` = '".encrypt($creature)."' GROUP BY `player` ".$search."");
	$output = '';
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		if($image_control == true) {
			$image = small_image($row[0]);
		}
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;">'.$image.'&nbsp;&nbsp;<a class="ajax-link" href="index.php?mode=show-player&user='.$row[0].'">'.$row[0].':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[1]."</div>\n";
		$output .= '</div>';
	} 
	return $output;
}

// Blacklist for inactive users (using WS_CONFIG_DEADLINE)
function blacklist() {
	global $link;
	$marker = '~*~';
	$player_all = get_user('player');
	for($i=0; $i < sizeof($player_all); $i++) {
		$query = mysqli_query($link, "UPDATE `".WS_CONFIG_STATS."` SET `player`='".$marker."".$player_all[$i]."' WHERE `player`='".$player_all[$i]."'");
	}	
}
?>