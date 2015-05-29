<?php
	$WS_CONFIG_NoMySQL=false;
	if($iconomy_control === true and pluginconfigstatusiconomy === true){include_once('modules/iconomy/api/api.php');}
	if($permissionsex_control === true){include_once('modules/permissionsex/api/api.php');}
	if($jail_control === true){include_once('modules/jail/api/api.php');}
	if($job_control === true){include_once('modules/jobs/api/api.php');}
	if($mcmmo_control === true){include_once('modules/mcmmo/api/api.php');}
	if($mineconomy_control === true and pluginconfigstatusmineconomy === true){include_once('modules/mineconomy/api/api.php');}
	if($stats_control === true && (pluginconfigstatusstats === true || pluginconfigstatusbeardstats === true)){include_once('modules/stats/api/api.php');}
	if($statslolmewn_control === true && pluginconfigstatusstatslolmewnstats === true){include_once('modules/stats-lolmewn/api/api.php');}
	if($statslolmewn3_control === true && pluginconfigstatusstatslolmewnstats3 === true){include_once('modules/stats3-lolmewn/api/api.php');}
	if($statssa_control === true && pluginconfigstatussa === true){include_once('modules/stats-sa/api/api.php');}
?>