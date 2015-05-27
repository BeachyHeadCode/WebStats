<?php

@error_reporting ( E_ALL ^ E_WARNING ^ E_NOTICE );
@ini_set ( 'display_errors', false );
@ini_set ( 'html_errors', false );
@ini_set ( 'error_reporting', E_ALL ^ E_WARNING ^ E_NOTICE );
@ini_set ( 'variables_order', "EGPCS" ); // this will not work

	//START STATS PLUGIN TYPE ----------------
	if(file_exists('modules/stats/index.php')) {
		$stats_control = true;
	}
	if(file_exists('modules/stats-lolmewn/index.php')) {
		$statslolmewn_control = true;
	}
	if(file_exists('modules/stats-lolmewn3/index.php')) {
		$statslolmewn3_control = true;
	}
	if(file_exists('modules/stats-sa/index.php')) {
		$statssa_control = true;
	}
	//END STATS PLUGIN TYPE ----------------
	if(file_exists('modules/jail/index.php')) {
		$jail_control = true;
	}
	if(file_exists('modules/jobs/index.php')) {
		$job_control = true;
	}
	//START CURRENCY PLUGIN TYPES -----------
	if(file_exists('modules/iconomy/index.php')) {
		$iconomy_control = true;
	}
	if(file_exists('modules/mineconomy/index.php')) {
		$mineconomy_control = true;
	}
	//END CURRENCY PLUGIN TYPES -----------
	if(file_exists('modules/show-player/include/functions_achievements.php')) {
		$achievements_control = true;
	}
	//START PLAYER IMAGES TYPES-----------------------------------------------
	if(file_exists('include/player-image/large_player_image.php')) {
		$image_control = true;
	}
	if(file_exists('include/player-image/full_player_image.php')){
		$image_control_3d = true;
	}
	//END PLAYER IMAGES TYPES-------------------------------------------------
	if(file_exists('modules/id-list/index.php')){
		$idlist_control = true;
	}	
	if(file_exists('include/search/index.php')){
		$search_control = true;
	}	
	if(file_exists('include/recipe/index.php')){
		$recipe_control = true;
	}	
	if(file_exists('modules/mcmmo/index.php')){
		$mcmmo_control = true;
	}
	if(file_exists('modules/permissionsex/include/functions.php')){
		$permissionsex_control = true;
	}
	if(file_exists('modules/InventorySQL/index.php')) { //TO BE ADDED------------
		$inventorySQL_control = true;
	}
	if(file_exists('modules/logblock/index.php')) { //TO BE ADDED------------
		$logblock = true;
	}
	if(file_exists('modules/achievement/index.php')) { //TO BE ADDED------------
		$achievement_control = true;
	}
?>