<?php
function search_check_user($user) {
	if($check = mysql_fetch_array(mysql_query("SELECT `player` FROM `".WS_CONFIG_STATS."` WHERE `player`='".$user."' GROUP BY `player`"))) {
		return true;
	} elseif ($check = mysql_fetch_array(mysql_query("SELECT `player` FROM `".WS_CONFIG_STATS_LOLMEWN_PREFIX."player` WHERE `player`='".$user."' GROUP BY `player`"))) {
		return true;
	} elseif($check = mysql_fetch_array(mysql_query("SELECT `user` FROM `".WS_CONFIG_MCMMO."users` WHERE `user`='".$user."' GROUP BY `user`"))) {
		return true;
	} elseif($check = mysql_fetch_array(mysql_query("SELECT `player` FROM `".WS_CONFIG_PLAYERACHIEVEMENTS."` WHERE `player`='".$user."' GROUP BY `player`"))) {
		return true;
	} elseif($check = mysql_fetch_array(mysql_query("SELECT `username` FROM `".WS_CONFIG_ICONOMY."` WHERE `username`='".$user."' GROUP BY `username`"))) {
		return true;
	} elseif($check = mysql_fetch_array(mysql_query("SELECT `username` FROM `".WS_CONFIG_JOBS."` WHERE `username`='".$user."' GROUP BY `username`"))) {
		return true;
	} elseif($check = mysql_fetch_array(mysql_query("SELECT `PlayerName` FROM `".WS_CONFIG_JAIL."prisoners` WHERE `PlayerName` = '".$user."' GROUP BY `PlayerName`"))) {
		return true;
	} elseif($check = mysql_fetch_array(mysql_query("SELECT `account` FROM `".WS_CONFIG_MINECONOMY."` WHERE `account`='".$user."' GROUP BY `account`"))) {
		return true;
	} elseif($check = mysql_fetch_array(mysql_query("SELECT `name` FROM `".WS_CONFIG_PERMISSIONS."_entity` WHERE `name` = '".$user."' AND type = '1' GROUP BY `name`"))) {
		return true;
	} else {
		return false;
	}
}
?>