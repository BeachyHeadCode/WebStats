<?php
	if($stats_control === true && (pluginconfigstatusstats === true || pluginconfigstatusbeardstats === true)) {	
		include('modules/stats/include/functions.php'); include('modules/stats/config/config.php');
	}
	if($statslolmewn_control === true && pluginconfigstatusstatslolmewnstats === true){
		include('modules/stats-lolmewn/include/functions.php'); include('modules/stats-lolmewn/config/config.php');
	}
	$WS_CONFIG_NoMySQL=false;
	$menuname="Creature-Stats";
	$on=false;
	$plugintype["Creature-Stats"]=true;
?>