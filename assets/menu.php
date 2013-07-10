<!-- http://foundation.zurb.com/old-docs/f3/navigation.php -->
<!-- add if statment if you are on the current page to then have it selected on the menu -->
<div class="row">
	<div class="twelve columns">
		<nav class="top-bar">
			<ul id="main-menu">
<li class="name"><a class="ajax-link" href="index.php"><span><?php echo translate(var6); ?></span></a></li>
<li class="toggle-topbar"><a href="#"></a></li>
			</ul>
			<section>
				<ul class="left" id="main-menu">
<li class="divider"></li>
<?php if($stats_control === true && (pluginconfigstatusstats === true || pluginconfigstatusbeardstats === true)){echo '<li><a class="ajax-link" href="?mode=server-stats" title="'.translate(var7).'"><span>'.translate(var7).'</span></a></li>';} ?>
<?php if($statslolmewn_control === true && pluginconfigstatusstatslolmewnstats === true){echo '<li><a class="ajax-link" href="?mode=server-stats" title="'.translate(var7).'"><span>'.translate(var7).'</span></a></li>';} ?>
<?php if($statssa_control === true && pluginconfigstatussa === true){echo '<li><a class="ajax-link" href="?mode=server-stats" title="'.translate(var7).'"><span>'.translate(var7).'</span></a></li>';} ?>
<?php if($iconomy_control === true && pluginconfigstatusiconomy === true){echo '<li><a class="ajax-link" href="?mode=iconomy" title="'.translate(var44).'"><span>'.translate(var44).'</span></a></li>';} ?>
<?php if($mineconomy_control === true && pluginconfigstatusmineconomy === true){echo '<li><a class="ajax-link" href="?mode=mineconomy" title="'.translate(var44).'"><span>'.translate(var44).'</span></a></li>';} ?>
<?php if($jail_control === true && pluginconfigstatusjail === true){echo '<li><a class="ajax-link" href="?mode=jail" title="'.translate(var83).'"><span>'.translate(var83).'</span></a></li>';} ?>
<?php if($job_control === true && pluginconfigstatusjobs === true){echo '<li><a class="ajax-link" href="?mode=jobs" title="'.translate(var34).'"><span>'.translate(var34).'</span></a></li>';} ?>
<?php if($level_control === true){echo '<li><a class="ajax-link" href="?mode=levelcraft" title="'.translate(var43).'"><span>'.translate(var43).'</span></a></li>';} ?>
<?php if($mcmmo_control === true && pluginconfigstatusmcmmo === true){echo '<li><a class="ajax-link" href="?mode=mcmmo" title="'.translate(var78).'"><span>'.translate(var78).'</span></a></li>';} ?>
<?php if($InventorySQL_control === true){echo '<li><a class="ajax-link" href="?mode=inventorysql" title="'.translate(var79).'"><span>'.translate(var79).'</span></a></li>';} ?>
				</ul>
				<ul class="right" id="main-menu">
<li class="divider show-for-medium-and-up"></li>
<li><a title="Return to Main Site" href="<?php echo WS_MAINSITE;?>"><?php echo translate(var84);?></a></li>
<?php if($idlist_control === true){echo '<li><a href="?mode=id-list" title="'.translate(var75).'"><span>'.translate(var75).'</span></a></li>';} ?>
				</ul>
			</section>
		</nav>
	</div>
</div>