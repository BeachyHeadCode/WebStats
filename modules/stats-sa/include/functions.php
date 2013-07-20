<?php
function get_amount($user, $stat, $location) {
	global $link;
	$query = mysqli_query($link, "SELECT `$stat` FROM `".WS_CONFIG_STATS."$location` WHERE `name`='$user'");
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

function get_amount_sum($user, $stat, $location) {
	global $link;
	$query = mysqli_query($link, "SELECT SUM(`$stat`) FROM `".WS_CONFIG_STATS."$location` WHERE `name`='$user'");
	$data = @mysqli_fetch_array($query, MYSQLI_NUM);
	return $data[0];
}

function get_movement($user) {
	global $link;
	$query = mysqli_query($link, "SELECT `MOVE` FROM `".WS_CONFIG_STATS."_players` WHERE `name` = '$user'");
	$data = @mysqli_fetch_array($query, MYSQLI_NUM);
	return $data[0];
}
	
function get_amount_break($user) {
	global $link;
	$query = mysqli_query($link, "SELECT `BLOCKDESTROY_TOTAL` FROM `".WS_CONFIG_STATS."_players` WHERE `name`='$user'");
	$data = @mysqli_fetch_array($query, MYSQLI_NUM);
	return $data[0];
}

function get_amount_create($user) {
	global $link;
	$query = mysqli_query($link, "SELECT `BLOCKCREATE_TOTAL` FROM `".WS_CONFIG_STATS."_players` WHERE `name`='$user'");
	$data = @mysqli_fetch_array($query, MYSQLI_NUM);
	return $data[0];
}

function get_user($sort) {
	global $link;
	if(!isset($sort)) {$sort = 'player';}
	$sortkey = "ORDER BY $sort";

	$query = mysqli_query($link, "SELECT * FROM `".WS_CONFIG_STATS."_players` ".$sortkey."");
	$time = 0;
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		$players[$time] = $row[0];
		$time++;
	}
	return $players;
}

function get_user_stats($sort, $start, $end) {
	global $link;
	if(!isset($sort)) {
		$sort = 'name';
	}
	//$deadline = time() - WS_CONFIG_DEADLINE;
	$sortkey = "ORDER BY `$sort`";
	$query = mysqli_query($link, "SELECT `$sort` FROM `".WS_CONFIG_STATS."_players` ".$sortkey." LIMIT ".$start.",".$end."");
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
	$output .= '<td>&nbsp;&nbsp;'.$image.'<a href="index.php?mode=show-player&user='.$player.'"  >'.$player.'</a></td>';
	$output .= '<td>'.get_played(get_amount($player, "PLAYTIME", "_players")).'</td>';
	$output .= '<td>'.get_date(get_amount($player, "LASTLOGIN", "_players")).'</td>';
	$output .= '<td>'.get_status($player).'</td>';
	$output .= "</tr>";
	return $output;
}

function set_player_details_table($player) {
	global $image_control, $image_control_3d;
	$output = '<div class="row">';
	$output .= '<div class="three columns">
				<h6>Movement</h6>
				<table style="margin: 0 auto;">
					<thead>
						<tr>
							<th>Total:</th>
							<th>'. get_movement($player).'</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>'.translate("var85").':</td>
							<td>'. number_format($foot, 2, '.', '').'</td>
						</tr>
						<tr>
							<td>'.translate("var86").':</td>
							<td>'.number_format($boat, 2, '.', '').'</td>
						</tr>
						<tr>
							<td>'.translate("var87").':</td>
							<td>'.number_format($cart, 2, '.', '').'</td>
						</tr>
						<tr>
							<td>'.translate("var88").':</td>
							<td>'.number_format($pig, 2, '.', '').'</td>
						</tr>
					</tbody>
				</table>
			</div>';
	$output .= '<div class="three columns">';
	$output .= '<table>
					<tbody>
				<tr>
					<td>'.translate("var5").':</td>
					<td>'.get_amount($player, "lastjoin", "player").'</td>
				</tr>
				<tr>
					<td>'.translate("var14").':</td>
					<td>'.get_amount($player, "lastleave", "player").'</td>
				</tr>
				<tr>
					<td>'.translate("var4").':</td>
					<td>'.get_played(get_amount($player, "playtime", "player")).'</td>
				</tr>
				<tr>
					<td>'.translate("var82").':</td>
					<td>'.get_amount($player, "joins", "player").'</td>
				</tr>
				<tr>
					<td>'.translate("var15").':</td>
					<td>'.get_status($player).'</td>
				</tr>
				<tr>
					<td>'.translate("var16").':</td>
					<td>'.get_amount_sum($player, "amount", "kill").' '.translate("var16").'</td>
				</tr>
				<tr>
					<td>'.translate("var81").':</td>
					<td>'.get_amount($player, "commandsdone", "player").' '.translate("var81").'</td>
				</tr>
				<tr>
					<td>'.translate("var19").':</td>
					<td>'.get_amount_break($player).' '.translate("var18").'</td>
				</tr>
				<tr>
					<td>'.translate("var20").':</td>
					<td>'.get_amount_create($player).' '.translate("var18").'</td>
				</tr>
					</tbody>
				</table>';
	$output .= '</div>';
	return $output;
}

function set_player_destroy_build_table($player) {
	global $link;
	$query = mysqli_query($link, "SELECT sbo.blockID, q1.amn, q2.brk FROM (SELECT `blockID` FROM `".WS_CONFIG_STATS."block` WHERE `player` = '".$player."' GROUP BY `blockID` ORDER BY `blockID` asc) as sbo LEFT JOIN (SELECT `blockID`, SUM(`amount`) as amn FROM `".WS_CONFIG_STATS."block` WHERE `player` = '".$player."' AND break = 0 GROUP BY blockID ORDER BY blockID asc) as q1 ON sbo.blockID = q1.blockID LEFT JOIN (SELECT blockID, SUM(`amount`) as brk FROM `".WS_CONFIG_STATS."block` WHERE `player` = '".$player."' AND `break` = 1 GROUP BY `blockID` ORDER BY `blockID` asc) as q2 ON sbo.blockID = q2.blockID");
	while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
		$output .= '<tr><td><img src="images/icons/'.$row['blockID'].'.png" width="16px" height="16px" />&nbsp;&nbsp;<a href="index.php?mode=material-stats&material='.$row['blockID'].'"  >'.translate(''.$row['blockID'].'').':</a></td>';	
		$output .= '<td>'.$row['brk'].'</td>';
		$output .= '<td>'.$row['amn'].'</td></tr>';
	}
	return $output;
}

function set_player_didkill_table($player, $search) {
	global $link;
	$query = mysqli_query($link, "SELECT `type`, `amount` FROM `".WS_CONFIG_STATS."kill` WHERE `player`='".$player."'");
	$output = '';
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[0])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a href="index.php?mode=creature-stats&creature='.decrypt($row[0]).'"  >'.translate(''.$row[0].'').':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[1].'</div>';
		$output .= '</div>';
	}
	return $output;
}

function set_player_getkill_table($player, $search) {
	global $link;
	$query = mysqli_query($link, "SELECT `entity`, `amount`, `cause` FROM `".WS_CONFIG_STATS."death` WHERE player='".$player."'");
	$output = '';
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[0])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a href="index.php?mode=creature-stats&creature='.decrypt($row[0]).'"  >'.translate(''.$row[0].'').':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[1].'</div>';
		$output .= '</div>';
	}
	return $output;
}

function get_server_player() {
	global $link;
	$query = mysqli_query($link, "SELECT COUNT(`name`) FROM `".WS_CONFIG_STATS."_players`");
	$row = mysqli_fetch_array($query, MYSQLI_NUM);
	return $row[0];
}

function get_server_count_player($column) {
	global $link;
	$query = mysqli_query($link, "SELECT SUM(`$column`) FROM `".WS_CONFIG_STATS."_players`");
	$row = mysqli_fetch_array($query, MYSQLI_NUM);
	return $row[0];
}

function get_server_played() {
	global $link;
	$query = mysqli_query($link, "SELECT SUM(`PLAYTIME`) FROM `".WS_CONFIG_STATS."_players`");
	$row = mysqli_fetch_array($query, MYSQLI_NUM);
	$time = $row[0];
	
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
	$output = '<div class="row head_logo" style="margin: 0 0;background-image:url('.WS_CONFIG_LOGO.'); background-repeat: no-repeat; background-position: center"></div>';
	$output .= '<div class="row" style="margin: 0 0;"><table class="six columns head_contentbox">';
	$output .= '<tr>
					<td>'.translate("var23").':</td>
					<td> '.get_server_player().'</td>
				</tr>
				
				<tr>
					<td>'.translate("var8").':</td>
					<td> '.get_server_count_player('BLOCKDESTROY_TOTAL').'</td>
				</tr>
				
				<tr>
					<td>'.translate("var9").':</td>
					<td> '.get_server_count_player('BLOCKCREATE_TOTAL').'</td>
				</tr>
				
				<tr>
					<td>'.translate("var24").':</td>
					<td> '.get_server_count_player('ARMSWING').'</td>
				</tr>
				
				<tr>
					<td>'.translate("var4").':</td>
					<td> '.get_server_played().'</td>
				</tr>
				
				<tr>
					<td>'.translate("var25").':</td>
					<td>'.get_server_count_player("LOGIN").'</td>
				</tr>
				
				<tr>
					<td>'.translate("var26").':</td>
					<td> '.get_server_count_player("OPENCHEST").'</td>
				</tr>
				
				<tr>
					<td>'.translate("var27").':</td>
					<td> '.get_server_count_player("COMMAND").'</td>
				</tr>
				
				<tr>
					<td>'.translate("var89").':</td>
					<td> '.get_server_count_player("EXP_CURRENT").'</td>
				</tr>
				
				<tr>
					<td>'.translate("var90").':</td>
					<td> '.get_server_count_player("FISHCAUGHT").'</td>
				</tr>
				
				<tr>
					<td>'.translate("var92").':</td>
					<td> '.get_server_count_player("KICK").'</td>
				</tr>

				<tr>
					<td>'.translate("var28").':</td>
					<td> '.get_server_count_player("CHAT").'</td>
				</tr>
				
				<tr>
					<td>'.translate("var29").':</td>
					<td>'.get_server_count_player("CHATLETTERS").'</td>
				</tr>';
	$output .= '</table>';
	$output .= '<table class="six columns head_contentbox">';
	$output .= '<tr>
					<td>'.translate("var95").':</td>
					<td> '.get_server_count_player("EGGTHROW").'</td>
				</tr>
				
				<tr>
					<td>'.translate("var96").':</td>
					<td> '.get_server_count_player("CRAFTING_TOTAL").'</td>
				</tr>
				
				<tr>
					<td>'.translate("var107").':</td>
					<td> '.get_server_count_player("SMELTING_TOTAL").'</td>
				</tr>
				
				<tr>
					<td>'.translate("var108").':</td>
					<td> '.get_server_count_player("BREWING_TOTAL").'</td>
				</tr>
				
				<tr>
					<td>'.translate("var100").':</td>
					<td> '.get_server_count_player("TELEPORT").'</td>
				</tr>

				<tr>
					<td>'.translate("var102").':</td>
					<td> '.get_server_count_player("BEDUSED").'</td>
				</tr>

				<tr>
					<td>'.translate("var105").':</td>
					<td> '.get_server_count_player("SHEEPSHEARED").'</td>
				</tr>
				';
	$output .= '</table></div>';
	return $output;
}

function set_server_didkill_table($search) {
	global $link;
	$query = mysqli_query($link, "SELECT `type`, SUM(`amount`) FROM `".WS_CONFIG_STATS."kill` GROUP BY `type` ".$search."");
	$output = '';
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[0])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a href="index.php?mode=creature-stats&creature='.decrypt($row[0]).'"  >'.translate(''.$row[0].'').':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[1].'</div>';
		$output .= '</div>';
	}
	return $output;
}

function set_server_getkill_table($search) {
	global $link;
	$query = mysqli_query($link, "SELECT `entity`, `cause`, SUM(`amount`) FROM `".WS_CONFIG_STATS."death` GROUP BY `entity` ".$search."");
	$output = '';
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($row[0])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a href="index.php?mode=creature-stats&creature='.decrypt($row[0]).'"  >'.translate(''.$row[0].'').':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[2].'</div>';
		$output .= '</div>';
	}
	return $output;
}

function set_server_destroy_table($search) {
	global $link;
	$query = mysqli_query($link, "SELECT `sbo`.`blockID`, `q2`.`brk` FROM (SELECT `blockID` FROM `".WS_CONFIG_STATS."block` GROUP BY `blockID` ORDER BY `blockID` asc) as `sbo` LEFT JOIN (SELECT `blockID`, SUM(`amount`) as `brk` FROM `".WS_CONFIG_STATS."block` WHERE `break` = 1 GROUP BY `blockID` ORDER BY `blockID` asc) as `q2` ON `sbo`.`blockID` = `q2`.`blockID`");
	$output = '';
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		$image = str_replace(":", "-", $row[0]); 
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($image)).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a href="index.php?mode=material-stats&material='.$row[0].'"  >'.translate(''.$row[0].'').':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[1].'</div>';
		$output .= "\n";
		$output .= '</div>';
	}
	return $output;
}

function set_server_build_table($search) {
	global $link;
	$query = mysqli_query($link, "SELECT `sbo`.`blockID`, `q1`.`amn` FROM (SELECT `blockID` FROM `".WS_CONFIG_STATS."block` GROUP BY `blockID` ORDER BY `blockID` asc) as `sbo` LEFT JOIN (SELECT `blockID`, SUM(`amount`) as `amn` FROM `".WS_CONFIG_STATS."block` WHERE `break` = 0 GROUP BY `blockID` ORDER BY `blockID` asc) as `q1` ON `sbo`.`blockID` = `q1`.`blockID`");
	$output = '';
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		$image = str_replace(":", "-", $row[0]); 
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;"><img src="images/icons/'.strtolower(decrypt($image)).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a href="index.php?mode=material-stats&material='.$row[0].'"  >'.translate(''.$row[0].'').':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[1].'</div>';
		$output .= "\n";
		$output .= '</div>';
	}	
	return $output;
}

function set_material_destroy_table($material, $search) {
	global $image_control, $link;
	$query = mysqli_query($link, "SELECT `player`, `amount` FROM `".WS_CONFIG_STATS."block` WHERE `blockID` = '".mysql_real_escape_string($material)."' AND `break` = 1 GROUP BY `blockID` ORDER BY `blockID` ".$search);
	$output = '<table>';
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {		
		if($image_control == true) {
			$image = small_image($row[0]);
		}
		$output .= '<tr>';
		$output .= '<td style="width:250px;">'.$image.'&nbsp;&nbsp;<a href="index.php?mode=show-player&user='.$row[0].'">'.$row[0].':</a></td>';	
		$output .= '<td style="width:100px;">'.$row[1].'</td>';
		$output .= '</tr>';
	}
	$output .= '</table>';
	return $output;
}

function set_material_build_table($material, $search) {
	global $image_control, $link;
	$query = mysqli_query($link, "SELECT `player`, `amount` FROM `".WS_CONFIG_STATS."block` WHERE `blockID` = '".mysql_real_escape_string($material)."' AND `break` = 0 GROUP BY `blockID` ORDER BY `blockID` ".$search);
	$output = '<table>';
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		if($image_control == true) {
			$image = small_image($row[0]);
		}
		$output .= '<tr>';
		$output .= '<td style="width:250px;">'.$image.'&nbsp;&nbsp;<a href="index.php?mode=show-player&user='.$row[0].'">'.$row[0].':</a></td>';	
		$output .= '<td style="width:100px;">'.$row[1].'</td>';
		$output .= '</tr>';
	}
	$output .= '</table>';
	return $output;
}

function set_creature_damagereceived_table($creature, $search) {
	global $image_control, $link;
	$query = mysqli_query($link, "SELECT player, category, stat, value FROM `".WS_CONFIG_STATS."player` WHERE `stat` = '".encrypt($creature)."' GROUP BY `player` ".$search." ");
	$output = '';
	while($row = mysqli_fetch_array($query)) {
		if($image_control == true) {
			$image = small_image($row['player']);
		}
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;">'.$image.'&nbsp;&nbsp;<a href="index.php?mode=show-player&user='.$row[0].'">'.$row[0].':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row['value'].'</div>';
		$output .= "\n";
		$output .= '</div>';
	} 
	return $output;
}

function set_creature_damagedealt_table($creature, $search) {
	global $image_control, $link;
	$query = mysqli_query($link, "SELECT player, category, stat, value FROM `".WS_CONFIG_STATS."player` WHERE stat = '".encrypt($creature)."' GROUP BY player ".$search."");
	$output = '';
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		if($image_control == true) {
			$image = small_image($row['player']);
		}
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;">'.$image.'&nbsp;&nbsp;<a href="index.php?mode=show-player&user='.$row[0].'">'.$row[0].':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row['value'].'</div>';
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
		$query = mysqli_query($link, "UPDATE `".WS_CONFIG_STATS."player` SET player='".$marker."".$player_all[$i]."' WHERE `name`='".$player_all[$i]."'");
	}	
}
?>