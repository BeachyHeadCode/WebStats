<!--ALLOWS SORD, ORDER BY VALUE-->
<?php
	if (!isset($_GET['search']))
		$_GET['search'] = '';
	else 
		$_GET['search'] = 'ORDER BY value DESC';
	if (isset($_POST['user'])) {
		include_once('include/search/api/api.php');
		$check_user = search_check_user($_POST['user']);
	}
	if ($check_user == false)
		$_POST['user'] = translate('var77');
	if (!isset($_GET['user']))
		$_GET['user'] = $_POST['user'];
?>
<!--MAIN BOX AND PHOTO START-->
<div class="row">
	<div class="row">
		<div style="align:center; font-weight:bold;"><h4><?php echo $_GET['user'];?>:</h4></div>
	</div>
	<hr />
	<div class="row">
<?php
	if($image_control_3d === true && WS_CONFIG_3D_USER === true) {
		$image = full_image($_GET['user']);
	} elseif($image_control === true) {
		$image = large_image($_GET['user']);
	} else { $image = "No Image Controler";}
		echo '<div class="large-6 columns head_logo" style="background-image:url(include/player-image/images/player_bg.png)">'.$image.'</div>';
?>
<?php 
	if(($stats_control === true && (pluginconfigstatusstats === true || pluginconfigstatusbeardstats === true)) || ($statslolmewn_control === true && pluginconfigstatusstatslolmewnstats === true) || ($statslolmewn3_control === true && pluginconfigstatusstatslolmewnstats3 === true) || ($statssa_control === true && pluginconfigstatussa === true))
		//echo (set_player_details_table(htmlentities($_GET['user'])));
?>
	</div>
<?php 
	if($iconomy_control == true && pluginconfigstatusiconomy === true) {
		echo '<div class="row" align="right"><div class="small-12 columns">';
		echo iconomy_player_get_money_table(htmlentities($_GET['user']));
		echo '</div></div>';
	}
	if($mineconomy_control == true && pluginconfigstatusmineconomy === true) {
		echo '<div class="row" align="right"><div class="small-12 columns">';
		echo mineconomy_player_get_money_table(htmlentities($_GET['user']));
		echo '</div></div>';
	}
?>
</div>
<!--MAIN BOX AND PHOTO END-->
<br />
<!-- PERMISSIONS TABLE START -->
<div class="row">
<?php
	if($permissionsex_control == true && pluginconfigpermissionsex===true) {
		echo permissionsex_player_table(htmlentities($_GET['user']));
	}
?>
</div>
<!-- PERMISSIONS TABLE END -->
<br />
<!-- JAIL TABLE START -->
<div class="row">
<?php
	if($plugintype["Jail"]===true) {
		echo jail_player_table(htmlentities($_GET['user']));
	}
?>
</div>
<!-- JAIL TABLE END -->
<br />
<!-- JOBS TABLE START -->
<div class="row">
<?php
	if($job_control == true && pluginconfigstatusjobs===true) {
		echo job_player_details_table(htmlentities($_GET['user']));
	}
?>
</div>
<!-- JOBS TABLE END -->
<br />
<!-- McMMO TABLE START -->
<div class="row">
<?php
	if($plugintype["McMMO"]===true) {
		echo mcmmo_player_skills_table(htmlentities($_GET['user']));
	}
?>
</div>
<!-- McMMO TABLE END -->
<br />
<!-- STATS TABLE START -->

<div class="row">
<?php if($stats_control === true && (pluginconfigstatusstats === true || pluginconfigstatusbeardstats === true)) { ?>
<div class="head_maintable_stats">
	<div class="content_headline" style="width:735px;">
		<a class="ajax-link" href="index.php?mode=show-player&user=<?php echo htmlentities($_GET['user']); ?>"><?php echo translate('var1'); ?></a> - <a class="ajax-link" href="index.php?mode=show-player&user=<?php echo htmlentities($_GET['user']); ?>&search=true"><?php echo translate('var2'); ?></a>
	</div>
	<div style="clear: both; width: 735px; height: 25px;">&nbsp;</div>
	<ul class="tabs" data-tab role="tablist">
		<li class="tab-title active"><a href="#PlayerTab" role="tab" tabindex="0" aria-selected="true" controls="PlayerTab">Player Kills/Deaths</a></li>
		<li class="tab-title"><a href="#BlocksTab" role="tab" tabindex="0" aria-selected="false" controls="BlocksTab">Destroyed/Placed Blocks</a></li>
		<li class="tab-title"><a href="#DamageTab" role="tab" tabindex="0" aria-selected="false" controls="DamageTab">Dealt/Received Damage</a></li>
	</ul>
	<div class="tabs-content">
		<!--Destroyed and Placed Blocks ~ START-->
		<div role="tabpanel" aria-hidden="false" class="content active" id="BlocksTab">
			<table>
				<tr>
					<td style="min-width:363px;"><?php echo translate('var8');?>:</td>
					<td style="min-width:363px;"><?php echo translate('var9');?>:</td>
				</tr>
				<tr>
					<td style="min-width:373px;"><?php echo(set_player_destroy_table(htmlentities($_GET['user']), $_GET['search']));?></td>
					<td style="min-width:373px;"><?php echo(set_player_build_table(htmlentities($_GET['user']), $_GET['search']));?></td>
				</tr>
			</table>
		</div>	
		<!--Destroyed and Placed Blocks ~ END-->
		<!--Received and Dealt Damage ~ START-->
		<div role="tabpanel" aria-hidden="true" class="content" id="DamageTab"> 
			<table>
				<tr>
					<td style="min-width:363px;"><?php echo translate('var10');?>:</td>
					<td style="min-width:363px;"><?php echo translate('var11');?>:</td>
				</tr>
				<tr>
					<td style="min-width:373px;"><?php echo(set_player_damagedealt_table(htmlentities($_GET['user']), $_GET['search']));?></td>
					<td style="min-width:373px;"><?php echo(set_player_damagereceived_table(htmlentities($_GET['user']), $_GET['search']));?></td>	
				</tr>
			</table>
		</div>	
		<!--Received and Dealt Damage ~ END-->
		<!--Killed and Killed By ~ START-->
		<div role="tabpanel" aria-hidden="true" class="content" id="PlayerTab">
			<table>
				<tr>
					<td style="min-width:363px;"><?php echo translate('var12');?>:</td>
					<td style="min-width:363px;"><?php echo translate('var13');?>:</td>
				</tr>
				<tr>
					<td style="min-width:373px;"><?php echo(set_player_didkill_table(htmlentities($_GET['user']), $_GET['search']));?></td>
					<td style="min-width:373px;"><?php echo(set_player_getkill_table(htmlentities($_GET['user']), $_GET['search']));?></td>
				</tr>
			</table>
		</div>	
		<!--Killed and Killed By ~ END-->
	</div>
</div>

<?php } elseif($statslolmewn_control === true && pluginconfigstatusstatslolmewnstats === true) { ?>
<div class="head_maintable_stats">
	<ul class="tabs" data-tab role="tablist">
		<li class="tab-title active" role="presentational"><a href="#PlayerTab" role="tab" tabindex="0" aria-selected="true" controls="PlayerTab">Player Kills/Deaths</a></li>
		<li class="tab-title" role="presentational"><a href="#BlocksTab" role="tab" tabindex="0" aria-selected="false" controls="BlocksTab">Destroyed/Placed Blocks</a></li>
	</ul>
	<div class="tabs-content">
		<!--Killed and Killed By ~ START-->
		<div role="tabpanel" aria-hidden="false" class="content active" id="PlayerTab">
			<table style="margin: 0 auto;">
				<tr>
					<td><?php echo translate('var12');?>:</td>
					<td><?php echo translate('var13');?>:</td>
				</tr>
				<tr>
					<td><?php echo(set_player_didkill_table(htmlentities($_GET['user']), $_GET['search']));?></td>
					<td><?php echo(set_player_getkill_table(htmlentities($_GET['user']), $_GET['search']));?></td>
				</tr>
			</table>
		</div>	
		<!--Killed and Killed By ~ END-->
		<!--Destroyed and Placed Blocks ~ START-->
		<div role="tabpanel" aria-hidden="true" class="content" id="BlocksTab">
			<table style="margin: 0 auto;">
				<tr>
					<td>ID:</td>
					<td><?php echo translate('var8');?>:</td>
					<td><?php echo translate('var9');?>:</td>
				</tr>
				<?php echo(set_player_destroy_build_table(htmlentities($_GET['user'])));?>
			</table>
		</div>	
		<!--Destroyed and Placed Blocks ~ END-->
	</div>
</div>
<?php } elseif($statssa_control === true && pluginconfigstatussa === true) { ?>
		<div class="head_maintable_stats"></div>
<?php } ?>
	</div>
<!-- STATS TABLE END-->
<!-- ACHIEVMENTS START-->
<?php
	if($achievements_control === true && pluginconfigstatusachiv === true) {
		include('modules/show-player/include/functions_achievements.php');
?>	
<br/>						
<table width="740" style="border:1px solid #333333; vertical-align:text-top; margin:auto;">
	<tr>
		<td width="375" style="vertical-align:text-top;" class="Stil2" align="left">
			<strong><u><?php echo translate('var68');?>:<br/><br/></u></strong>
		</td>
	</tr>
	<tr>
		<td width="740" style="vertical-align:text-top;" align="center">
			<div class="gesamtfortschritt" align="left">
				<div class="fortschritttext"><b><?php echo achievements_player_count_table(htmlentities($_GET['user'])).' / '.achievements_server_count_table();?></b></div>
				<div class="fortschritt" style="width:<?php echo (((achievements_player_count_table(htmlentities($_GET['user'])) * 100) / (achievements_server_count_table()))); ?>%">&nbsp;</div>
			</div>
			<br/><br/>
		</td>
	</tr>
	<tr>
		<td width="650" style="vertical-align:text-top;">
			<?php echo(achievements_player_achievement_table(htmlentities($_GET['user'])));?>
		</td>
	</tr>
</table>

<!--todo-->

<script type="text/javascript">
	$(document).ready(function() {
	$("#hidr4").click(function () {$("span4").hide("fast", function () {$(this).prev().hide("fast", arguments.callee); });});
	$("#showr4").click(function () {$("span4").show(1000);});
	});
</script>

<div class="content_maintable_achiev_title">
	<span>Achievements</span><br/>
	<span4_1 id="showr4" class="showhide">Show</span4_1>
	<span4_1 id="hidr4" class="showhide">Hide</span4_1>
</div>
<div class="content_maintable_achiev">
	<div class="slidingDiv_table4">
		<span4><div class="content_maintable_achiev" style="padding-top: 25px; padding-bottom: 25px;"><?php echo (achievements_server_achievement_table());?></div></span4>
	</div>
</div>
<!-- ACHIEVMENTS END -->
<?php } ?>