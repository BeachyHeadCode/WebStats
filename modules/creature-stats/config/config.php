<?php
	if($stats_control === true && (pluginconfigstatusstats === true || pluginconfigstatusbeardstats === true)){include('modules/stats/api/api.php');}
	if($statslolmewn_control === true && pluginconfigstatusstatslolmewnstats === true){include('modules/stats-lolmewn/api/api.php');}
?>