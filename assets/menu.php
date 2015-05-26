<!-- add if statment if you are on the current page to then have it selected on the menu -->
<?php $dynamicload=true; ?>
<?php 
//Page generated in 0.0004 seconds.
if($dynamicload===false) :
?>
<div class="row">
	<div class="large-12 columns">
	<nav class="top-bar" data-topbar role="navigation">
		<ul class="title-area" id="main-menu">
			<li class="name">
				<h1><a class="ajax-link" href="index.php"><?php echo translate(var6); ?></a></h1>
			</li>
			<!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
			<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
		</ul>
		<section class="top-bar-section">
			<ul class="left" id="main-menu">
				<li class="divider"></li>
<?php if($stats_control === true && (pluginconfigstatusstats === true || pluginconfigstatusbeardstats === true)){echo '<li><a class="ajax-link" href="?mode=server-stats" title="'.translate(var7).'"><span>'.translate(var7).'</span></a></li>';} ?>
<?php if($statslolmewn_control === true && pluginconfigstatusstatslolmewnstats === true){echo '<li><a class="ajax-link" href="?mode=server-stats" title="'.translate(var7).'"><span>'.translate(var7).'</span></a></li>';} ?>
<?php if($statssa_control === true && pluginconfigstatussa === true){echo '<li><a class="ajax-link" href="?mode=server-stats" title="'.translate(var7).'"><span>'.translate(var7).'</span></a></li>';} ?>
<?php if($iconomy_control === true && pluginconfigstatusiconomy === true){echo '<li><a class="ajax-link" href="?mode=iconomy" title="'.translate(var44).'"><span>'.translate(var44).'</span></a></li>';} ?>
<?php if($mineconomy_control === true && pluginconfigstatusmineconomy === true){echo '<li><a class="ajax-link" href="?mode=mineconomy" title="'.translate(var44).'"><span>'.translate(var44).'</span></a></li>';} ?>
<?php if($jail_control === true && pluginconfigstatusjail === true){echo '<li><a class="ajax-link" href="?mode=jail" title="'.translate(var83).'"><span>'.translate(var83).'</span></a></li>';} ?>
<?php if($job_control === true && pluginconfigstatusjobs === true){echo '<li><a class="ajax-link" href="?mode=jobs" title="'.translate(var34).'"><span>'.translate(var34).'</span></a></li>';} ?>
<?php if($mcmmo_control === true && pluginconfigstatusmcmmo === true){echo '<li><a class="ajax-link" href="?mode=mcmmo" title="'.translate(var78).'"><span>'.translate(var78).'</span></a></li>';} ?>
			</ul>
			<ul class="right" id="main-menu">
				<li class="divider"></li>
				<li><a title="Return to Main Site" href="<?php echo WS_MAINSITE;?>"><?php echo translate(var84);?></a></li>
<?php if($idlist_control === true){echo '<li><a class="ajax-link" href="?mode=id-list" title="'.translate(var75).'"><span>'.translate(var75).'</span></a></li>';} ?>
			</ul>
		</section>
	</nav>
	</div>
</div>
<?php 
//Page generated in 0.0016 seconds.
else : ?>
<!-- https://php.net/manual/en/function.scandir.php -->
<div class="row">
	<div class="large-12 columns">
	<nav class="top-bar" data-topbar role="navigation">
		<ul class="title-area" id="main-menu">
			<li class="name">
				<h1><a class="ajax-link" href="index.php"><?php echo translate(var6); ?></a></h1>
			</li>
			<!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
			<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
		</ul>
		<section class="top-bar-section">
			<ul class="left" id="main-menu">
				<li class="divider"></li>
<?php
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
	$array = scandir(getcwd().'\modules');
} else {
	$array = scandir(getcwd().'/modules');
}
for($i=0; $i <= sizeof($array); $i++) {
	
	if($array[$i] !="show-player" and $array[$i] !="id-list" and $array[$i] !="permissionsex" and $array[$i] !="creature-stats" and $array[$i] !="material-stats" and $array[$i] !="." and $array[$i] !=".." and $array[$i] != WS_CONFIG_MODULE) {
		$on=false;
		include_once('modules/'.$array[$i].'/config/config.php');
		if($on===true)
			echo '<li><a class="ajax-link" href="?mode='.$array[$i].'" title="'.$menuname.'"><span>'.$menuname.'</span></a></li>';
	}
}
?>
			</ul>
			<ul class="right" id="main-menu">
				<li class="divider"></li>
				<li><a title="Return to Main Site" href="<?php echo WS_MAINSITE;?>"><?php echo translate(var84);?></a></li>
<?php if($idlist_control === true){echo '<li><a class="ajax-link" href="?mode=id-list" title="'.translate(var75).'"><span>'.translate(var75).'</span></a></li>';} ?>
			</ul>
		</section>
	</nav>
	</div>
</div>
<?php endif; ?>