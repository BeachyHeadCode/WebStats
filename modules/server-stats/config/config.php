<?php
	include_once('modules/'.WS_CONFIG_STATS_PLUGIN.'/config/config.php');
	$menuname='Server statistics';
	if ($plugintype["Stats"]===true) {
		$on=true;
		$plugintype["SERVER-STATS"]=true;
	}
?>