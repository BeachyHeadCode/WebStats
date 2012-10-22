<?php

function search_check_user($user)
{
	$stats = mysql_query("SELECT player FROM ".WS_CONFIG_STATS." WHERE player='".$user."' GROUP BY player");
	$mcmmo = mysql_query("SELECT user FROM ".WS_CONFIG_MCMMO."users WHERE user='".$user."' GROUP BY user");
	$achievements = mysql_query("SELECT player FROM ".WS_CONFIG_PLAYERACHIEVEMENTS." WHERE player='".$user."' GROUP BY player");
	$iconomy = mysql_query("SELECT username FROM ".WS_CONFIG_ICONOMY." WHERE username='".$user."' GROUP BY username");
	$jobs = mysql_query("SELECT username FROM ".WS_CONFIG_JOBS." WHERE username='".$user."' GROUP BY username");
	$jail = "SELECT PlayerName FROM ".WS_CONFIG_JAIL."prisoners WHERE PlayerName = '".$user."' GROUP BY PlayerName";
	if($check = mysql_fetch_array($stats))
	{
		return true;
	}
	elseif($check = mysql_fetch_array($mcmmo))
	{
		return true;
	}
	elseif($check = mysql_fetch_array($achievements))
	{
		return true;
	}
	elseif($check = mysql_fetch_array($iconomy))
	{
		return true;
	}
	elseif($check = mysql_fetch_array($jobs))
	{
		return true;
	}
	elseif($check = mysql_fetch_array($jail))
	{
		return true;
	}
	else
	{
		return false;
	}
}

?>