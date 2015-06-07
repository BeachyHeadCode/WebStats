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

if (isset($_POST['player_get_money_table'])) {
	$link = mysqli_connect(WS_CONFIG_DBHOST, WS_CONFIG_DBUNAME, WS_CONFIG_DBPASS, WS_CONFIG_DBNAME, WS_CONFIG_DBPORT);
	echo player_get_money_table($_POST['player_get_money_table']);
	mysqli_close($link);
}

//SETS NUMBER OF USERS TO PRINT
function get_iconomy_user_count() {
	global $link;
	$query = mysqli_query($link, "SELECT COUNT(`username`) FROM `".WS_CONFIG_ECONOMY."`");
	$row = mysqli_fetch_array($query, MYSQLI_NUM);
	return $row[0];
}

//ICONOMY SORT
function get_iconomy_user_stats($sort, $start, $end) {
	global $link;
	if($sort != 'balance') {
		$sortkey = 'ORDER BY username ASC';
	}
	elseif($sort == 'balance') {
		$sortkey = 'ORDER BY balance DESC';
	}
	$query = mysqli_query($link, "SELECT `username`, `balance` FROM ".WS_CONFIG_ECONOMY." ".$sortkey." LIMIT ".$start.",".$end);
	$time = 0;
	while($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
		$players[$time] = $row[0];
		$time++;
	}  
	return $players;	
}

//PLAYER MONEY COUNT
function iconomy_player_get_money($player) {
	global $link;
	$query = mysqli_query($link, "SELECT `username`, `balance` FROM `".WS_CONFIG_ECONOMY."` WHERE `username` = '".$player."'");
	$row = mysqli_fetch_array($query, MYSQLI_NUM);
	$money = explode('.', $row[1]);
	$money[2] = $row[0];
	return $money;
}

//SERVER MONEY COUNT
function iconomy_server_get_money() {
	global $link;
	$query = mysqli_query($link, "SELECT COUNT(`username`), SUM(`balance`) FROM `".WS_CONFIG_ECONOMY."` WHERE `username` != '".WS_ECONOMY_OMIT."'");
	$row = mysqli_fetch_array($query, MYSQLI_NUM);
	$money = explode('.', $row[1]);
	$money[2] = $row[0];
	return $money;
}

//PLAYER BOX MONEY COUNT
function player_get_money_table($player) {
	$money = iconomy_player_get_money($player);
	$output .= '<div class="head_contentbox_iconomy" style="clear:both">
					<div class="head_stat">'.translate("var50").':</div>
					<div class="head_content"> '.$money[0].' '.WS_ECONOMY_MAIN."</div>
				</div>\n";
	return $output;
}

//SERVER BOX MONEY COUNT
function iconomy_server_get_money_table() {
	$money = iconomy_server_get_money();
	$output .= '<div class="head_contentbox_iconomy" style="clear:both">
					<div class="head_stat">'.translate("var47").':</div>
					<div class="head_content"> '.$money[0].' '.WS_ECONOMY_MAIN."</div>
				</div>\n";
	return $output;
}

//TOP BOX
function iconomy_server_details_table() {
	$money = iconomy_server_get_money();
	$output = '<div class="small-6 columns head_logo" style="background-image:url('.WS_CONFIG_LOGO.');"></div>';
	$output .= '<div class="small-6 columns head_contentbox">'."\n";
	$output .= '<div style="clear:both">
					<div class="head_stat" style="width:350px; font-weight:bold;"><div align="center">'.translate('var44').':</div></div>
				</div>
				<br /><br />
				<div style="clear:both">
					<div class="head_stat">'.translate("var45").':</div>
					<div class="head_content"> '.WS_ECONOMY_MAIN.'</div>
				</div>
				
				<div>
					<div class="head_stat">'.translate("var46").':</div>
					<div class="head_content"> '.WS_ECONOMY_SUB.'</div>
				</div>
				
				<div>
					<div class="head_stat">'.translate("var47").':</div>
					<div class="head_content"> '.$money[0].' '.WS_ECONOMY_MAIN.'</div>
				</div>
				
				<div>
					<div class="head_stat">'.translate("var48").':</div>
					<div class="head_content"> '.floor($money[0] / $money[2]) .' '.WS_ECONOMY_MAIN.'</div>
				</div>';
	$output .= "\n";
	$output .= '</div>';
	return $output;
}

//LOWER PAGE PLAYER TABLE
function iconomy_server_player_table($player, $money) {
	global $image_control, $stats_control;
	if($image_control == true) {
		$image = small_image($player);
	}
	if($stats_control == true) { 
		$stats = '<a class="ajax-link" href="index.php?mode=show-player&user='.$player.'">'.$player.'</a>'; 
	} else { 
		$stats = ''.$player.'';
	}
	$money = iconomy_player_get_money($player);
   	$output .= '<tr><td>&nbsp;&nbsp;'.$image.''.$stats.'</td>';
    	$output .= '<td>'.$money[0].' '.WS_ECONOMY_MAIN.'</td>';
	$output .= "</tr>";
	return $output;
}
?>