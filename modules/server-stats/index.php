<h2>Server Stats</h2><br/>
<?php
if(($stats_control === true) and (pluginconfigstatusstats === true)) {
	if (!isset($_GET['search'])){$_GET['search'] = 'ORDER BY `stat` ASC';}
	else {$_GET['search'] = 'ORDER BY SUM(`value`) DESC';}
} elseif(($statslolmewn_control === true) and (pluginconfigstatusstatslolmewnstats === true)) {
	if (!isset($_GET['search'])){$_GET['search'] = 'ORDER BY `type` ASC';}
	else {$_GET['search'] = 'ORDER BY SUM(`amount`) DESC';}
}
?>
<div class="head_maintable_stats">
	<?php echo (set_server_details_table()); ?>
</div>
<br /><br />
<div class="content_maintable_stats">                        
	<div class="content_headline" style="width:748px;">
		<a href="index.php?mode=server-stats"><?php echo translate('var1'); ?></a> - <a href="index.php?mode=server-stats&search=true"><?php echo translate('var2'); ?></a>
	</div>
	<div style="clear: both; height: 25px;">&nbsp;</div>
	<ul class="tabs" data-tab role="tablist">
		<li class="tab-title active"><a href="#PlayerTab" role="tab" tabindex="0" aria-selected="true" controls="PlayerTab">Player Kills/Deaths</a></li>
		<li class="tab-title"><a href="#BlocksTab" role="tab" tabindex="0" aria-selected="false" controls="BlocksTab">Destroyed/Placed Blocks</a></li>
		<?php if(($stats_control === true) and (pluginconfigstatusstats === true)) {?>
		<li class="tab-title"><a href="#DamageTab" role="tab" tabindex="0" aria-selected="false" controls="DamageTab">Dealt/Received Damage</a></li>
		<?php }?>
	</ul>
	<div class="tabs-content">
		<div role="tabpanel" aria-hidden="false" class="content active" id="PlayerTab">
			<center>
			<table>
				<tr>
					<td><?php echo translate('var21');?>:</td>
					<td><?php echo translate('var22');?>:</td>
				</tr>
				<tr>
					<td><?php echo (set_server_didkill_table($_GET['search'])); ?></td>
					<td><?php echo (set_server_getkill_table($_GET['search'])); ?></td>
				</tr>
			</table>
			</center>
		</div>
		<?php if(($statslolmewn_control === true) and (pluginconfigstatusstatslolmewnstats === true)) {?>
		<div role="tabpanel" aria-hidden="true" class="content"  id="BlocksTab">
			<center>
				<?php echo (set_server_destroy_build_table($_GET['search'])); ?>
			</center>
		</div>
		<?php } else {?>
		<div role="tabpanel" aria-hidden="true" class="content"  id="BlocksTab">   
			<center>
			<table>
				<tr>
					<td><?php echo translate('var8');?>:</td>
					<td><?php echo translate('var9');?>:</td>
				</tr>
				<tr>
					<td><?php echo (set_server_destroy_table($_GET['search']));?></td>
					<td><?php echo (set_server_build_table($_GET['search']));?></td>
				</tr>
			</table>
			</center>
		</div>
		<?php } if(($stats_control === true) and (pluginconfigstatusstats === true)) {?>
		<div role="tabpanel" aria-hidden="true" class="content" id="DamageTab">
			<center>
			<table>
				<tr>
					<td><?php echo translate('var11');?>:</td>
					<td><?php echo translate('var10');?>:</td>
				</tr>
				<tr>
					<td><?php echo (set_server_damagedealt_table($_GET['search']));?></td>
					<td><?php echo (set_server_damagereceived_table($_GET['search']));?></td>
				</tr>
			</table>
			</center>
		</div>
		<?php }?>
	</div>
</div>