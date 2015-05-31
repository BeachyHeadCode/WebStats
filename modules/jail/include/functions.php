<?php
function get_jail_user_count() {
	$query = mysql_query("SELECT COUNT(`PlayerName`) FROM `".WS_CONFIG_JAIL."prisoners`");
	$row = mysql_fetch_array($query);
	return $row[0];
}
function isjailed($user) {
	$query = mysql_query("SELECT `PlayerName` FROM `".WS_CONFIG_JAIL."prisoners` WHERE `PlayerName` = '".$user."'");
	$row = mysql_fetch_array($query);
	return $row[0];
}
//SETS THE STATS ORDER AND PAGE NUMBERS
function get_jail_user_stats_order($sort, $start, $end) {
	if(isset($sort)) {
		switch($sort) {
			case "PlayerName";
				$sortkey = "ORDER BY `PlayerName` ASC";
			break;
			case "RemainTime";
				$sortkey = "ORDER BY `RemainTime` DESC";
			break;
			case "JailName";
				$sortkey = "ORDER BY `JailName` DESC";
			break;
			case "TransferDest ";
				$sortkey = "ORDER BY `TransferDest`  DESC";
			break;
			case "reason";
				$sortkey = "ORDER BY `reason` DESC";
			break;
			case "muted";
				$sortkey = "ORDER BY `muted` DESC";
			break;
			case "Inventory";
				$sortkey = "ORDER BY `Inventory` DESC";
			break;
			case "Jailer";
				$sortkey = "ORDER BY `Jailer` DESC";
			break;
			case "Permissions";
				$sortkey = "ORDER BY `Permissions` DESC";
			break;
			case "PreviousPosition";
				$sortkey = "ORDER BY `PreviousPosition` DESC";
			break;
		}
	} else {
		$sortkey = 'ORDER BY ORDER BY `PlayerName` ASC';
	}
	$query = mysql_query("SELECT * FROM `".WS_CONFIG_JAIL."prisoners` WHERE `PlayerName` != '' ".$sortkey." LIMIT ".$start.",".$end);
	$time = 0;
	while($row = mysql_fetch_array($query)) {
		$players[$time] = $row[0];
		$time++;
	}  
	return $players;
}
function jail_server_player_table($player, $pos) {
	$pos++;
	$result = mysql_query("SELECT * FROM `".WS_CONFIG_JAIL."prisoners` WHERE `PlayerName` = '".$player."'");
	$data = mysql_fetch_array($result);
	global $image_control;
	if($image_control == true) {
		$image = small_image($player);
		$imagejailer = small_image($data['Jailer']);
	}
	global $stats_control;
	if($stats_control == true) { 
		$stats = '<a class="ajax-link" href="index.php?mode=show-player&user='.$player.'">'.$player.'</a>';
		$jailer ='<a class="ajax-link" href="index.php?mode=show-player&user='.$data['Jailer'].'">'.$data['Jailer'].'</a>';
	} else { 
		$stats = ''.$player.'';
	}
	if($data['muted']=="0"){ $mute ='<img src="modules/jail/images/sound_icon.png" width="18px" height="18px"/>'; }
	else{$mute='<img src="modules/jail/images/mute_icon.png" width="18px" height="18px"/>';}
		$output  = '<td>'.$pos.'</td>';     
		$output .= '<td><span title="'.$data['PreviousPosition'].'">&nbsp;&nbsp;'.$image.' '.$stats.'</span></td>';
		$output .= '<td>'.$data['RemainTime'].'</td>';
		$output .= '<td>'.$data['JailName'].'</td>';
		$output .= '<td>'.$data['reason'].'</td>';
		$output .= '<td>&nbsp;&nbsp;'.$imagejailer.' '.$jailer.'</td>';
		$output .= '<td>'.$mute.'</td>';
     		return $output;
}
function jail_player_table($player) {
	$query = "SELECT * FROM `".WS_CONFIG_JAIL."prisoners` WHERE `PlayerName` = '".$player."'";
	$result = mysql_query($query);
	$data = mysql_fetch_array($result);
	if(isset($data[0])){
		global $image_control;
		if($image_control == true) {
			$imagejailer = small_image($data['Jailer']);
		}
		if($data['muted']=="1") { $mute ='<img src="modules/jail/images/mute_icon.png" width="18px" height="18px"/>';}
		else {$mute='<img src="modules/jail/images/sound_icon.png" width="18px" height="18px"/>';}
			$output .= '<div class="large-9 large-centered columns head_maintable">';
				$output .= '<a title="Who else is in jail?" href="?mode=jail"><h2>Jail</h2></a>';
				$output .= '<table width="100%">
				<tr>
					<td><span>Time:</span></td>
					<td>'.$data['RemainTime'].'</td>
				</tr>
				<tr>
					<td><span>Jail:</span></td>
					<td>'.$data['JailName'].'</td>
				</tr>
				<tr>
					<td><span>reason:</span></td>
					<td>'.$data['reason'].'</td>
				</tr>
				<tr>
					<td><span>Jailer:</span></td>
					<td>&nbsp;&nbsp;'.$imagejailer.' <a class="ajax-link" href="index.php?mode=show-player&user='.$data['Jailer'].'">'.$data['Jailer'].'</a></td>
				</tr>
				<tr>
					<td><span>Muted:</span></td>
					<td>'.$mute.'</td>
				</tr>
				</table>
			</div>';
		return $output;
	}
}
?>