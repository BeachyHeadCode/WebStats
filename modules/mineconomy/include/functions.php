<?php
//SETS NUMBER OF USERS TO PRINT
function get_mineconomy_user_count(){
	$query = mysql_query("SELECT COUNT(`account`) FROM ".WS_CONFIG_MINECONOMY);
	$row = mysql_fetch_array($query);
	return $row[0];
}

//ICONOMY SORT
function get_mineconomy_user_stats($sort, $start, $end){
	if($sort != 'balance') {
		$sortkey = 'ORDER BY account ASC';
	}
	elseif($sort == 'balance') {
		$sortkey = 'ORDER BY balance DESC';
	}
	$query = mysql_query("SELECT `account`, `balance` FROM `".WS_CONFIG_MINECONOMY."` ".$sortkey." LIMIT ".$start.",".$end);
	$time = 0;
	while($row = mysql_fetch_array($query)) {
		$players[$time] = $row[0];
		$time++;
	}  
	return $players;	
}

//PLAYER MONEY COUNT
function mineconomy_player_get_money($player) {
	$query = mysql_query("SELECT `account`, `balance`, `currency` FROM `".WS_CONFIG_MINECONOMY."` WHERE `account` = '".$player."'");
	$row = mysql_fetch_array($query);
	$money = explode('.', $row[1]);
	$money[1] = $row[0];
	$money[2] = $row[2];
	return $money;
}

//SERVER MONEY COUNT
function mineconomy_server_get_money() {
	$query = mysql_query("SELECT COUNT(`account`), SUM(`balance`), `currency` FROM `".WS_CONFIG_MINECONOMY."` WHERE `account` != '".WS_ICONOMY_OMIT."'");
	$row = mysql_fetch_array($query);
	$money = explode('.', $row[1]);
	$money[1] = $row[0];
	$money[2] = $row[2];
	return $money;
}

//PLAYER BOX MONEY COUNT
function mineconomy_player_get_money_table($player) {
	$money = mineconomy_player_get_money($player);
	$output .= '<div class="head_contentbox_iconomy" style="clear:both">
					<div class="head_stat">'.translate("var50").':</div>
					<div class="head_content"> '.$money[0].' '.$money[2].'</div>
				</div>';
	$output .= "\n";
	return $output;
}

//SERVER BOX MONEY COUNT
function mineconomy_server_get_money_table() {
	$money = mineconomy_server_get_money();
	$output .= '<div class="head_contentbox_iconomy" style="clear:both">
					<div class="head_stat">'.translate("var47").':</div>
					<div class="head_content">'.$money[0].$money[2].'</div>
				</div>';
	$output .= "\n";
	return $output;
}

//SERVER TOP PLAYER
function mineconomy_server_top_money() {
	$query = mysql_query("SELECT `account`, MAX(`balance`) as `balance`, `currency` FROM `".WS_CONFIG_MINECONOMY."` WHERE `account` != '".WS_ICONOMY_OMIT."'");
	$row = mysql_fetch_array($query);
	$money = explode('.', $row[1]);
	$money[1] = $row[0];
	$money[2] = $row[2];
	return $money;
}

//TOP BOX
function mineconomy_server_details_table() {
	$money = mineconomy_server_get_money();
	$row = mineconomy_server_top_money();
	global $image_control;
	global $image_control_3d;
	if($image_control_3d == true && WS_CONFIG_3D_USER === true) {
		$image = full_image($row[1]);
		$output = '<div class="row" style="margin:0 auto;"><div class="six columns head_logo" style="background-image:url(include/player-image/images/player_bg.png)">'.$image.'</div>';
	} elseif($image_control == true) {
		$image = large_image($row[1]);	
		$output = '<div class="row" style="margin:0 auto;"><div class="six columns head_logo" style="background-image:url(include/player-image/images/player_bg.png)">'.$image.'</div>';
	} else {
		$output = '<div class="row" style="margin:0 auto;"><div class="six columns head_logo" style="background-image:url('.WS_CONFIG_LOGO.');"><img src=""/></div>';
	}
	$output .= '<div class="six columns head_contentbox">';
	$output .= '<div style="clear:both">
					<div class="head_stat" style="width:350px; font-weight:bold;"><div align="center">'.translate('var44').':</div></div>
				</div>
				<div style="clear:both">
					<div class="head_stat">'.translate("var45").':</div>
					<div class="head_content">'.$money[2].'</div>
				</div>
				
				<div style="clear:both">
					<div class="head_stat">'.translate("var46").':</div>
					<div class="head_content">'.WS_ICONOMY_SUB.'</div>
				</div>
				
				<div style="clear:both">
					<div class="head_stat">'.translate("var47").':</div>
					<div class="head_content">'.$money[0].' '.$money[2].'</div>
				</div>
				
				<div style="clear:both">
					<div class="head_stat">'.translate("var48").':</div>
					<div class="head_content"> '.floor($money[0] / $money[1]) .' '.$money[2].'</div>
				</div>';
	$output .= '</div></div>';
	return $output;
}

//LOWER PAGE PLAYER TABLE
function mineconomy_server_player_table($player, $money) {
	global $image_control;
	global $stats_control;
	
	if($image_control == true) {
		$image = small_image($player);
	}
	if($stats_control == true) { 
		$stats = '<a href="index.php?mode=show-player&user='.$player.'">'.$player.'</a>'; 
	} else { 
		$stats = ''.$player.'';
	}

	$money = mineconomy_player_get_money($player);
	$output .= '<tr><td>&nbsp;&nbsp;'.$image.''.$stats.'</td>';
   	$output .= '<td>'.$money[0].' '.$money[2].'</td>';
	$output .= "</tr>";
	return $output;
}
?>