<?php
/**
 * The fallowing if statements will allow for Ajax to call the functions externally.
 *
 * @since 4.0
 *
 */
define('ROOT', '../../../');
if(file_exists(ROOT . 'config/config.php'))
	include_once ROOT . 'config/config.php';
include_once ROOT . 'include/en.php';
require_once ROOT . 'include/functions.php';

if (isset($_POST['set_player_details_table'])) {
	$link = mysqli_connect(WS_CONFIG_DBHOST, WS_CONFIG_DBUNAME, WS_CONFIG_DBPASS, WS_CONFIG_DBNAME, WS_CONFIG_DBPORT);
	echo set_player_details_table($_POST['set_player_details_table']);
	mysqli_close($link);
}

if (isset($_POST['set_player_tables'])) {
	if (!isset($_POST['search']))
		$_POST['search'] = '';
	else 
		$_POST['search'] = 'ORDER BY value DESC';

	$link = mysqli_connect(WS_CONFIG_DBHOST, WS_CONFIG_DBUNAME, WS_CONFIG_DBPASS, WS_CONFIG_DBNAME, WS_CONFIG_DBPORT);
	echo '<div class="large-9 large-centered columns head_maintable">
	<ul class="tabs" data-tab role="tablist">
		<li class="tab-title active" role="presentational"><a href="#PlayerTab" role="tab" tabindex="0" aria-selected="true" controls="PlayerTab">Player Kills/Deaths</a></li>
		<li class="tab-title" role="presentational"><a href="#BlocksTab" role="tab" tabindex="0" aria-selected="false" controls="BlocksTab">Destroyed/Placed Blocks</a></li>
	</ul>
	<div class="tabs-content">
		<!--Killed and Killed By ~ START-->
		<div role="tabpanel" aria-hidden="false" class="content active" id="PlayerTab">
			<table style="margin: 0 auto;">
				<tr>
					<td>'.translate('var12').':</td>
					<td>'.translate('var13').':</td>
				</tr>
				<tr>	
					<td>'.set_player_didkill_table($_POST['set_player_tables'], $_POST['search']).'</td>
					<td>'.set_player_getkill_table($_POST['set_player_tables'], $_POST['search']).'</td>
				</tr>
			</table>
		</div>
		<!--Killed and Killed By ~ END-->
		<!--Destroyed and Placed Blocks ~ START-->
		<div role="tabpanel" aria-hidden="true" class="content" id="BlocksTab">
			<table style="margin: 0 auto;">
				<tr>
					<td>ID:</td>
					<td>'.translate('var8').':</td>
					<td>'.translate('var9').':</td>
				</tr>
				'.set_player_destroy_build_table($_POST['set_player_tables']).'
			</table>
		</div>
		<!--Destroyed and Placed Blocks ~ END-->
	</div>
</div>';
	mysqli_close($link);
}

function get_amount($user, $stat, $location) {
	global $link;
	$query = mysqli_query($link, "SELECT `$stat` FROM `".WS_CONFIG_STATS."$location` WHERE `player`='$user'");
	$data = @mysqli_fetch_array($query, MYSQLI_NUM);
	return $data[0];
}

function get_amount_break_place_sum($user, $type) {
	global $link;
	$query = mysqli_query($link, "SELECT SUM(`amount`) FROM `".WS_CONFIG_STATS."block` WHERE `player`='$user' AND `break`='$type'");
	$data = @mysqli_fetch_array($query, MYSQLI_NUM);
	return $data[0];
}

function get_amount_sum($user, $stat, $location) {
	global $link;
	$query = mysqli_query($link, "SELECT SUM(`$stat`) FROM `".WS_CONFIG_STATS."$location` WHERE `player`='$user'");
	$data = @mysqli_fetch_array($query, MYSQLI_NUM);
	return $data[0];
}

function get_movement($user, $type) {
	if($type > 3 || $type < 0){
		return "Error! No movement of this type exists.";
	} else {
		global $link;
		$query = mysqli_query($link, "SELECT `distance` FROM `".WS_CONFIG_STATS."move` WHERE `player` = '$user' AND `type` = '$type'");
		$data = @mysqli_fetch_array($query, MYSQLI_NUM);
		return $data[0];
	}
}

/**
 * This function will check whether the player is online or not.
 *
 * @since 3.2
 *
 * @param string $lastlogout Name of last logout column.
 * @param string $lastlogin Name of last login column.
 */
function get_status($lastlogout, $lastlogin) {
	if(strtotime($lastlogin) >= strtotime($lastlogout))
		$status = '<span class="online">Online</span>';
	else
		$status = '<span class="offline">Offline</span>';
	return $status;
}

function get_user($sort) {
	global $link;
	if(!isset($sort)) {$sort = 'player';}
	$sortkey = "ORDER BY $sort";

	$query = mysqli_query($link, "SELECT * FROM `".WS_CONFIG_STATS."player` ".$sortkey."");
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
		$sort = 'player';
	}
	$deadline = time() - WS_CONFIG_DEADLINE;
	$sortkey = "ORDER BY $sort";
	$query = mysqli_query($link, "SELECT $sort FROM `".WS_CONFIG_STATS."player` ".$sortkey." LIMIT ".$start.",".$end);
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
	$output .= '<td>&nbsp;&nbsp;'.$image.'<a class="ajax-link" href="index.php?mode=show-player&user='.$player.'"  >'.$player.'</a></td>';
	$output .= '<td>'.get_played(get_amount($player, "playtime", "player")).'</td>';
	$output .= '<td>'.get_amount($player, "lastjoin", "player").'</td>';
	$output .= '<td>'.get_status(get_amount($player, "lastleave", "player"), get_amount($player, "lastjoin", "player")).'</td>';
	$output .= "</tr>";
	return $output;
}

function set_player_details_table($player) {
	global $image_control, $image_control_3d;
	$foot = get_movement($player, "0");
	$boat = get_movement($player, "1");
	$pig = get_movement($player, "2");
	$cart = get_movement($player, "3");
	$output = '<div class="small-6 columns">
				<h6>Movement</h6>
				<table style="margin: 0 auto;">
					<thead>
						<tr>
							<th>Total:</th>
							<th>'. number_format(($foot+$boat+$pig+$cart), 2, '.', '').'</th>
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
	$output .= '<div class="small-6 columns">';
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
					<td>'.get_status(get_amount($player, "lastleave", "player"), get_amount($player, "lastjoin", "player")).'</td>
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
					<td>'.get_amount_break_place_sum($player, "1").' '.translate("var18").'</td>
				</tr>
				<tr>
					<td>'.translate("var20").':</td>
					<td>'.get_amount_break_place_sum($player, "0").' '.translate("var18").'</td>
				</tr>
					</tbody>
				</table>';
	$output .= '</div>';
	return $output;
}

function set_player_destroy_build_table($player) {
	global $link;
	$query = mysqli_query($link, "SELECT `sbo`.`blockID`, `q1`.`amn`, `q2`.`brk` FROM (SELECT `blockID` FROM `".WS_CONFIG_STATS."block` WHERE `player` = '".$player."' GROUP BY `blockID` ORDER BY `blockID` asc) as sbo LEFT JOIN (SELECT `blockID`, SUM(`amount`) as amn FROM `".WS_CONFIG_STATS."block` WHERE `player` = '".$player."' AND break = 0 GROUP BY blockID ORDER BY blockID asc) as q1 ON sbo.blockID = q1.blockID LEFT JOIN (SELECT blockID, SUM(`amount`) as brk FROM `".WS_CONFIG_STATS."block` WHERE `player` = '".$player."' AND `break` = 1 GROUP BY `blockID` ORDER BY `blockID` asc) as q2 ON sbo.blockID = q2.blockID");
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)){
		$output .= '<tr><td><img src="images/icons/'.$row[0].'.png" width="16px" height="16px" />&nbsp;&nbsp;<a class="ajax-link" href="index.php?mode=material-stats&material='.$row[0].'"  >'.translate($row[0]).':</a></td>';	
		$output .= '<td>'.$row[2].'</td>';
		$output .= '<td>'.$row[1].'</td></tr>';
	}
	return $output;
}

function set_player_didkill_table($player, $search) {
	global $link;
	$query = mysqli_query($link, "SELECT `type`, `amount` FROM `".WS_CONFIG_STATS."kill` WHERE `player`='".$player."'");
	$output = '<table>';
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		$output .= '<tr>';
		$output .= '<td><img src="images/icons/'.strtolower(decrypt($row[0])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a class="ajax-link" href="index.php?mode=creature-stats&creature='.decrypt($row[0]).'"  >'.translate($row[0]).':</a></td>';	
		$output .= '<td>'.$row[1].'</td>';
		$output .= '</tr>';
	}
	$output .= '</table>';
	return $output;
}

function set_player_getkill_table($player, $search) {
	global $link;
	$query = mysqli_query($link, "SELECT `entity`, `amount`, `cause` FROM `".WS_CONFIG_STATS."death` WHERE player='".$player."'");
	$output = '<table>';
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		$output .= '<tr>';
		$output .= '<td><img src="images/icons/'.strtolower(decrypt($row[0])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a class="ajax-link" href="index.php?mode=creature-stats&creature='.decrypt($row[0]).'"  >'.translate($row[0]).':</a></td>';	
		$output .= '<td>'.$row[1].'</td>';
		$output .= '</tr>';
	}
	$output .= '</table>';
	return $output;
}

function get_server_player() {
	global $link;
	$query = mysqli_query($link, "SELECT COUNT(`player`) FROM `".WS_CONFIG_STATS."player`");
	$row = mysqli_fetch_array($query, MYSQLI_NUM);
	return $row[0];
}

function get_server_count_block($column) {
	global $link;
	$query = mysqli_query($link, "SELECT SUM(`$column`) FROM `".WS_CONFIG_STATS."block` ");
	$row = mysqli_fetch_array($query, MYSQLI_NUM);
	return $row[0];
}

function get_server_count_player($column) {
	global $link;
	$query = mysqli_query($link, "SELECT SUM(`$column`) FROM `".WS_CONFIG_STATS."player`");
	$row = mysqli_fetch_array($query, MYSQLI_NUM);
	return $row[0];
}

function get_server_count_player_move($type) {
	global $link;
	$query = mysqli_query($link, "SELECT SUM(`distance`) FROM `".WS_CONFIG_STATS."move` WHERE `type`=$type");
	$row = mysqli_fetch_array($query, MYSQLI_NUM);
	return $row[0];
}

function get_server_played() {
	global $link;
	$query = mysqli_query($link, "SELECT SUM(`playtime`) FROM `".WS_CONFIG_STATS."player`");
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
	$output = '<div class="row head_logo" style="margin: 0 0;background-image:url('.WS_CONFIG_LOGO.');"></div>';
	$output .= '<div class="row" style="margin: 0 0;"><table class="small-6 columns head_contentbox">';
	$output .= '<tr>
					<td>'.translate("var23").':</td>
					<td> '.get_server_player().'</td>
				</tr>
				
				<tr>
					<td>'.translate("var8").':</td>
					<td> '.get_server_count_block('break').'</td>
				</tr>
				
				<tr>
					<td>'.translate("var9").':</td>
					<td> '.get_server_count_block('amount').'</td>
				</tr>
				
				<!--<div>
					<div class="head_stat">'.translate("var24").':</div>
					<div class="head_content"> '.get_server_count_player('armswing').'</div>
				</div>-->
				
				<tr>
					<td>'.translate("var4").':</td>
					<td> '.get_server_played().'</td>
				</tr>
				
				<tr>
					<td>'.translate("var25").':</td>
					<td>'.get_server_count_player("joins").'</td>
				</tr>
				
				<tr>
					<td>'.translate("var17").' '.translate("var85").':</div>
					<td> '.round(get_server_count_player_move(0), 2).' '.translate("var18").'</td>
				</tr>
				<tr>
					<td>'.translate("var17").' '.translate("var86").':</div>
					<td> '.round(get_server_count_player_move(1), 2).' '.translate("var18").'</td>
				</tr>
				<tr>
					<td>'.translate("var17").' '.translate("var87").':</div>
					<td> '.round(get_server_count_player_move(2), 2).' '.translate("var18").'</td>
				</tr>
				<tr>
					<td>'.translate("var17").' '.translate("var88").':</div>
					<td> '.round(get_server_count_player_move(3), 2).' '.translate("var18").'</td>
				</tr>
				<!--<div>
					<div class="head_stat">'.translate("var26").':</div>
					<div class="head_content"> '.get_server_count_player("openchest").'</div>
				</div>-->
				
				<tr>
					<td>'.translate("var27").':</td>
					<td> '.get_server_count_player("commandsdone").'</td>
				</tr>
				
				<tr>
					<td>'.translate("var93").':</td>
					<td> '.get_server_count_player("arrows").'</td>
				</tr>
				
				<tr>
					<td>'.translate("var89").':</td>
					<td> '.get_server_count_player("xpgained").'</td>
				</tr>
				
				<tr>
					<td>'.translate("var90").':</td>
					<td> '.get_server_count_player("fishcatch").'</td>
				</tr>
				
				<tr>
					<td>'.translate("var91").':</td>
					<td> '.get_server_count_player("damagetaken").'</td>
				</tr>
				
				<tr>
					<td>'.translate("var92").':</td>
					<td> '.get_server_count_player("timeskicked").'</td>
				</tr>

				<!--<div>
					<div class="head_stat">'.translate("var28").':</div>
					<div class="head_content"> '.get_server_count_player("chat").'</div>
				</div>-->
				
				<!--<tr>
					<td>'.translate("var29").':</td>
					<td>'.get_server_count_player("chatletters").'</td>
				</tr>-->';
	$output .= '</table>';
	$output .= '<table class="small-6 columns head_contentbox">';
	$output .= '<tr>
					<td>'.translate("var94").':</td>
					<td> '.get_server_count_player("toolsbroken").'</td>
				</tr>
				
				<tr>
					<td>'.translate("var95").':</td>
					<td> '.get_server_count_player("eggsthrown").'</td>
				</tr>
				<tr>
					<td>'.translate("var96").':</td>
					<td> '.get_server_count_player("itemscrafted").'</td>
				</tr>
				
				<tr>
					<td>'.translate("var97").':</td>
					<td> '.get_server_count_player("omnomnom").'</td>
				</tr>
				<tr>
					<td>'.translate("var98").':</td>
					<td> '.get_server_count_player("onfire").'</td>
				</tr>
				<tr>
					<td>'.translate("var28").':</td>
					<td> '.get_server_count_player("wordssaid").'</td>
				</tr>
				<tr>
					<td>'.translate("var99").':</td>
					<td> '.get_server_count_player("votes").'</td>
				</tr>
				<tr>
					<td>'.translate("var100").':</td>
					<td> '.get_server_count_player("teleports").'</td>
				</tr>
				<tr>
					<td>'.translate("var101").':</td>
					<td> '.get_server_count_player("itempickups").'</td>
				</tr>
				<tr>
					<td>'.translate("var104").':</td>
					<td> '.get_server_count_player("itemdrops").'</td>
				</tr>
				<tr>
					<td>'.translate("var102").':</td>
					<td> '.get_server_count_player("bedenter").'</td>
				</tr>
				<tr>
					<td>'.translate("var106").':</td>
					<td> '.get_server_count_player("bucketempty").'</td>
				</tr>
				<tr>
					<td>'.translate("var103").':</td>
					<td> '.get_server_count_player("worldchange").'</td>
				</tr>
				<tr>
					<td>'.translate("var105").':</td>
					<td> '.get_server_count_player("shear").'</td>
				</tr>
				';
	$output .= '</table></div>';
	return $output;
}

function set_server_kill_table($bool) {
	global $link;
	if($bool==true) {$search='ORDER BY `type` ASC';}
	else {$search='ORDER BY SUM(`amount`) DESC';}
	$query = mysqli_query($link, "SELECT `type`, SUM(`amount`) FROM `".WS_CONFIG_STATS."kill` GROUP BY `type` ".$search);
	$output = '';
	$output .= '<table class="head_contentbox">';
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		$output .= '<tr><td><img src="images/icons/'.strtolower(decrypt($row[0])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a class="ajax-link" href="index.php?mode=creature-stats&creature='.decrypt($row[0]).'"  >'.translate($row[0]).':</a></td>';	
		$output .= '<td>'.$row[1].'</td></tr>';
	}
	$output .= '</table>';
	return $output;
}

function set_server_death_table($bool) {
	global $link;
	if($bool==true) {$search='ORDER BY `type` ASC';}
	else {$search='ORDER BY SUM(`amount`) DESC';}
	$query = mysqli_query($link, "SELECT `entity`, `cause`, SUM(`amount`) FROM `".WS_CONFIG_STATS."death` GROUP BY `entity` ".$search);
	$output = '';
	$output .= '<table class="head_contentbox">';
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		$output .= '<tr><td><img src="images/icons/'.strtolower(decrypt($row[0])).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a class="ajax-link" href="index.php?mode=creature-stats&creature='.decrypt($row[0]).'"  >'.translate($row[0]).':</a></td>';	
		$output .= '<td>'.$row[2].'</td></tr>';
	}
	$output .= '</table>';
	return $output;
}

function set_server_destroy_build_table($bool) {
	global $link;
	if($bool==true) {$search='ORDER BY `type` ASC';}
	else {$search='ORDER BY SUM(`amount`) DESC';}
	$query = mysqli_query($link, "SELECT `sbo`.`blockID`, `q1`.`amn`, `q2`.`brk` FROM (SELECT `blockID` FROM `".WS_CONFIG_STATS."block` GROUP BY `blockID` ORDER BY `blockID` asc) as sbo LEFT JOIN (SELECT `blockID`, SUM(`amount`) as amn FROM `".WS_CONFIG_STATS."block` WHERE break = 0 GROUP BY blockID ORDER BY blockID asc) as q1 ON sbo.blockID = q1.blockID LEFT JOIN (SELECT blockID, SUM(`amount`) as brk FROM `".WS_CONFIG_STATS."block` WHERE `break` = 1 GROUP BY `blockID` ORDER BY `blockID` asc) as q2 ON sbo.blockID = q2.blockID");
	$output = '<table>';
	$output .= '<tr><td>ID:</td><td>'.translate('var8').':</td><td>'.translate('var9').':</td></tr>';
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		$output .= '<tr><td><img src="images/icons/'.str_replace(":", "-", $row[0]).'.png" width="16px" height="16px" />&nbsp;&nbsp;<a class="ajax-link" href="index.php?mode=material-stats&material='.$row[0].'"  >'.translate($row[0]).':</a></td>';	
		$output .= '<td>'.$row[2].'</td>';
		$output .= '<td>'.$row[1].'</td></tr>';
	}
	$output .= '</table>';
	return $output;
}

function set_material_destroy_table($material, $search) {
	global $image_control, $link;
	$query = mysqli_query($link, "SELECT `player`, `amount` FROM `".WS_CONFIG_STATS."block` WHERE `blockID` = '".mysqli_real_escape_string($link, $material)."' AND `break` = 1 GROUP BY `player` ORDER BY `player` ".$search);
	$output = '<table>';
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {		
		if($image_control == true) {
			$image = small_image($row[0]);
		}
		$output .= '<tr><td style="width:250px;">'.$image.'&nbsp;&nbsp;<a class="ajax-link" href="index.php?mode=show-player&user='.$row[0].'">'.$row[0].':</a></td>';	
		$output .= '<td style="width:100px;">'.$row[1].'</td></tr>';
	}
	$output .= '</table>';
	return $output;
}

function set_material_build_table($material, $search) {
	global $image_control, $link;
	$query = mysqli_query($link, "SELECT `player`, `amount` FROM `".WS_CONFIG_STATS."block` WHERE `blockID` = '".mysqli_real_escape_string($link, $material)."' AND `break` = 0 GROUP BY `player` ORDER BY `player` ".$search);
	$output = '<table>';
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		if($image_control == true) {
			$image = small_image($row[0]);
		}
		$output .= '<tr><td style="width:250px;">'.$image.'&nbsp;&nbsp;<a class="ajax-link" href="index.php?mode=show-player&user='.$row[0].'">'.$row[0].':</a></td>';	
		$output .= '<td style="width:100px;">'.$row[1].'</td></tr>';
	}
	$output .= '</table>';
	return $output;
}

function set_creature_damagereceived_table($creature, $search) {
	global $image_control, $link;
	$query = mysqli_query($link, "SELECT `player`, `amount` FROM `".WS_CONFIG_STATS."death` WHERE `entity` = '".encrypt($creature)."' GROUP BY `player` ".$search);
	$output = '';
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		if($image_control == true) {
			$image = small_image($row[0]);
		}
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;">'.$image.'&nbsp;&nbsp;<a class="ajax-link" href="index.php?mode=show-player&user='.$row[0].'">'.$row[0].':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[1].'</div>';
		$output .= "\n";
		$output .= '</div>';
	} 
	return $output;
}

function set_creature_damagedealt_table($creature, $search) {
	global $image_control, $link;
	$query = mysqli_query($link, "SELECT `player`, `amount` FROM `".WS_CONFIG_STATS."kill` WHERE `type` = '".encrypt($creature)."' GROUP BY `player` ".$search);
	$output = '';
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		if($image_control == true) {
			$image = small_image($row[0]);
		}
		$output .= '<div style="clear: both;">';
		$output .= '<div class="content_line_small" align="left" style="width:250px;">'.$image.'&nbsp;&nbsp;<a class="ajax-link" href="index.php?mode=show-player&user='.$row[0].'">'.$row[0].':</a></div>';	
		$output .= '<div class="content_line_small" align="left" style="width:100px;">'.$row[1].'</div>';
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
		$query = mysqli_query($link, "UPDATE `".WS_CONFIG_STATS."player` SET player='".$marker."".$player_all[$i]."' WHERE player='".$player_all[$i]."'");
	}	
}
?>