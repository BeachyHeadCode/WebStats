<?php
function achievements_server_achievement_table() {
	$query = mysql_query("SELECT * FROM ".WS_CONFIG_ACHIEVEMENTS." ORDER BY ws_a_category, ws_a_stat");
	$output = '<table cellspacing="0">';    
	while($row = mysql_fetch_array($query)) {
		$output .= '<tr class="'.$row[3].'">';
		$output .= '<td width="300px" style="padding: 2px; vertical-align: middle; height: 25px; border-left:2px solid #511B00; border-top:2px solid #511B00; border-bottom:2px solid #511B00;">';
		$output .= '<div align="left"><b>'.$row[1].'</b></div>';
		$output .= '</td>';
		$output .= '<td width="50px" style="padding: 2px; vertical-align: middle; border-left:2px solid #511B00; border-right:2px solid #511B00; height: 25px; border-top:2px solid #511B00; border-bottom:2px solid #511B00;">';
		$output .= '<div align="center"><b>'.$row[2].'</b></div>';
		$output .= '</td>';
		$output .= '<td width="300px" style="padding: 2px; vertical-align: middle; height: 25px; border-right:2px solid #511B00; border-top:2px solid #511B00; border-bottom:2px solid #511B00;">';
		$output .= '<div align="left"><b>'.$row[6].'</b></div>';
		$output .= '</td>';
		$output .= '</tr>';
		$output .= '<tr>';
		$output .= '<td>';
		$output .= '&nbsp;';
		$output .= '</td>';
		$output .= '</tr>';
	}	
	$output .= '</table>'; 
	return $output;
}

function achievements_player_achievement_table($player) {
	$query = mysql_query("SELECT * FROM ".WS_CONFIG_PLAYERACHIEVEMENTS." LEFT JOIN ".WS_CONFIG_ACHIEVEMENTS." ON ".WS_CONFIG_PLAYERACHIEVEMENTS.".achievement = ".WS_CONFIG_ACHIEVEMENTS.".ws_a_name WHERE player = '".$player."' ORDER BY ".WS_CONFIG_ACHIEVEMENTS.".ws_a_id ASC");
	$output = '<table cellspacing="0">';    
	while($row = mysql_fetch_array($query)) {
		$output .= '<tr class="'.$row[6].'">';
		$output .= '<td width="300px" style="padding: 2px; vertical-align: middle; height: 25px; border-left:2px solid #511B00; border-top:2px solid #511B00; border-bottom:2px solid #511B00;">';
		$output .= '<div align="left"><b>'.$row[4].'</b></div>';
		$output .= '</td>';
		$output .= '<td width="50px" style="padding: 2px; vertical-align: middle; border-left:2px solid #511B00; border-right:2px solid #511B00; height: 25px; border-top:2px solid #511B00; border-bottom:2px solid #511B00;">';
		$output .= '<div align="center"><b>'.$row[5].'</b></div>';
		$output .= '</td>';
		$output .= '<td width="300px" style="padding: 2px; vertical-align: middle; height: 25px; border-right:2px solid #511B00; border-top:2px solid #511B00; border-bottom:2px solid #511B00;">';
		$output .= '<div align="left"><b>'.$row[9].'</b></div>';
		$output .= '</td>';
		$output .= '</tr>';
		$output .= '<tr>';
		$output .= '<td>';
		$output .= '&nbsp;';
		$output .= '</td>';
		$output .= '</tr>';
	}	
	$output .= '</table>';
				
	return $output;
}

function achievements_player_count_table($player) {
	global $ws_config;
	$query = mysql_query("SELECT SUM(ws_a_points) FROM ".WS_CONFIG_PLAYERACHIEVEMENTS." LEFT JOIN ".WS_CONFIG_ACHIEVEMENTS." ON ".WS_CONFIG_PLAYERACHIEVEMENTS.".achievement = ".WS_CONFIG_ACHIEVEMENTS.".ws_a_name WHERE player = '".$player."' ORDER BY ".WS_CONFIG_ACHIEVEMENTS.".ws_a_id ASC");
	$row = mysql_fetch_array($query);
	return $row[0];
}

function achievements_server_count_table() {
	global $ws_config;
	$query = mysql_query("SELECT SUM(ws_a_points) FROM ".WS_CONFIG_ACHIEVEMENTS." ORDER BY ws_a_category ".$search."");
	$output = '<table>';    
	$row = mysql_fetch_array($query); 
	return $row[0];
}

?>