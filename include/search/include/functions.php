<?php
function search_check_user($user) {
	global $link;
	if($check = mysqli_fetch_array(mysqli_query($link, "SELECT `player` FROM `".WS_CONFIG_STATS."` WHERE `player`='".$user."' GROUP BY `player`"), MYSQLI_NUM)) {
		return true;
	} elseif ($check = mysqli_fetch_array(mysqli_query($link, "SELECT `player` FROM `".WS_CONFIG_STATS."player` WHERE `player`='".$user."' GROUP BY `player`"), MYSQLI_NUM)) {
		return true;
	} elseif ($check = mysqli_fetch_array(mysqli_query($link, "SELECT `player` FROM `".WS_CONFIG_STATS."_sa` WHERE `player`='".$user."' GROUP BY `player`"), MYSQLI_NUM)) {
		return true;
	} elseif($check = mysqli_fetch_array(mysqli_query($link, "SELECT `user` FROM `".WS_CONFIG_MCMMO."users` WHERE `user`='".$user."' GROUP BY `user`"), MYSQLI_NUM)) {
		return true;
	} elseif($check = mysqli_fetch_array(mysqli_query($link, "SELECT `player` FROM `".WS_CONFIG_PLAYERACHIEVEMENTS."` WHERE `player`='".$user."' GROUP BY `player`"), MYSQLI_NUM)) {
		return true;
	} elseif($check = mysqli_fetch_array(mysqli_query($link, "SELECT `username` FROM `".WS_CONFIG_ICONOMY."` WHERE `username`='".$user."' GROUP BY `username`"), MYSQLI_NUM)) {
		return true;
	} elseif($check = mysqli_fetch_array(mysqli_query($link, "SELECT `username` FROM `".WS_CONFIG_JOBS."` WHERE `username`='".$user."' GROUP BY `username`"), MYSQLI_NUM)) {
		return true;
	} elseif($check = mysqli_fetch_array(mysqli_query($link, "SELECT `PlayerName` FROM `".WS_CONFIG_JAIL."prisoners` WHERE `PlayerName` = '".$user."' GROUP BY `PlayerName`"), MYSQLI_NUM)) {
		return true;
	} elseif($check = mysqli_fetch_array(mysqli_query($link, "SELECT `account` FROM `".WS_CONFIG_MINECONOMY."` WHERE `account`='".$user."' GROUP BY `account`"), MYSQLI_NUM)) {
		return true;
	} elseif($check = mysqli_fetch_array(mysqli_query($link, "SELECT `name` FROM `".WS_CONFIG_PERMISSIONS."_entity` WHERE `name` = '".$user."' AND type = '1' GROUP BY `name`"), MYSQLI_NUM)) {
		return true;
	} else {
		return false;
	}
}
?>