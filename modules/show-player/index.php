<!--ALLOWS SORD, ORDER BY VALUE-->
<?php
	if (!isset($_GET['search']))
		$_GET['search'] = '';
	else 
		$_GET['search'] = 'ORDER BY value DESC';
	if (isset($_POST['user'])) {
		include_once('include/search/include/functions.php');
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
		<div class="large-6 columns small-centered large-uncentered player_background" style="background-image:url(include/player-image/images/player_bg.png)"></div>
		<div class="large-6 columns small-centered large-uncentered player_stats"></div>
<?php 
	if($plugintype["Stats"] === true)
		if(function_exists('set_player_details_table')) { echo set_player_details_table(htmlentities($_GET['user'])); }
?>
	</div>
<?php 
	if($plugintype["Economy"] === true) {
		echo '<div class="row" align="right"><div class="small-12 columns">';
		echo player_get_money_table(htmlentities($_GET['user']));
		echo '</div></div>';
	}
?>
</div><br />
<!--MAIN BOX AND PHOTO END-->
<div class="row permissions"></div><br />
<div class="row jail"></div><br />
<div class="row jobs"></div><br />
<div class="row mcmmo"></div><br />
<!-- STATS TABLE START -->
<div class="row stats">
	<div class="large-9 large-centered columns head_maintable">
<?php if($stats_control === true && (pluginconfigstatusstats === true || pluginconfigstatusbeardstats === true)) { ?>

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

<?php } elseif($statslolmewn_control === true && pluginconfigstatusstatslolmewnstats === true) { ?>

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
<?php } elseif($statssa_control === true && pluginconfigstatussa === true) { ?>
		<div class="large-9 large-centered columns head_maintable"></div>
<?php } ?>
</div>
	</div>
<!-- STATS TABLE END-->
<!-- ACHIEVMENTS START-->
<?php
	if($achievements_control === true && pluginconfigstatusachiv === true) {
		include('modules/show-player/include/functions_achievements.php');
?>	
<br/>
<div class="row"><div class="large-9 large-centered columns head_maintable">
<table style="border:1px solid #333333; vertical-align:text-top; margin:auto;">
	<tr>
		<td style="vertical-align:text-top;" class="Stil2" align="left">
			<strong><u><?php echo translate('var68');?>:<br/><br/></u></strong>
		</td>
	</tr>
	<tr>
		<td style="vertical-align:text-top;" align="center">
			<div class="gesamtfortschritt" align="left">
				<div class="fortschritttext"><b><?php echo achievements_player_count_table(htmlentities($_GET['user'])).' / '.achievements_server_count_table();?></b></div>
				<div class="fortschritt" style="width:<?php echo (((achievements_player_count_table(htmlentities($_GET['user'])) * 100) / (achievements_server_count_table()))); ?>%">&nbsp;</div>
			</div>
		</td>
	</tr>
	<tr>
		<td width="650" style="vertical-align:text-top;">
			<?php echo(achievements_player_achievement_table(htmlentities($_GET['user'])));?>
		</td>
	</tr>
</table>
</div></div>
<!--todo-->

<script type="text/javascript">
	$(document).ready(function() {
	$("#hidr4").click(function () {$("span4").hide("fast", function () {$(this).prev().hide("fast", arguments.callee); });});
	$("#showr4").click(function () {$("span4").show(500);});
	});
</script>
<div class="row">
	<div class="large-9 large-centered columns content_maintable_achiev_title">
		<span>Achievements</span><br />
		<span4_1 id="showr4" class="showhide">Show</span4_1>
		<span4_1 id="hidr4" class="showhide">Hide</span4_1>
	</div>
	<div class="large-9 large-centered columns content_maintable_achiev">
		<div class="slidingDiv_table4">
			<span4><div class="content_maintable_achiev" style="padding-top: 25px; padding-bottom: 25px;"><?php echo (achievements_server_achievement_table());?></div></span4>
		</div>
	</div>
</div>
<!-- ACHIEVMENTS END -->
<?php } ?>
<script type="text/javascript">
	//Player Image
	<?php if($image_control_3d === true && WS_CONFIG_3D_USER === true) : ?>
	$.ajax({
		url : 'include/player-image/include/functions.php',
		type: 'post',
		data: {full_image: '<?php echo $_GET['user'];?>'},
		success:function(msg){
				$('.player_background').html(msg);
				$('.player_background').fadeIn();
				logInfo( "Player Full Image loaded!" );
				return false;
		}
	});
	<?php elseif($image_control === true) :?>
	$.ajax({
		url : 'include/player-image/include/functions.php',
		type: 'post',
		data: {large_image: '<?php echo $_GET['user'];?>'},
		success:function(msg){
				$('.player_background').html(msg);
				$('.player_background').fadeIn();
				logInfo( "Large Image loaded!" );
				return false;
		}
	});
	<?php endif; if($plugintype["McMMO"]===true) :?>
	$.ajax({
		url : 'modules/mcmmo/include/functions.php',
		type: 'post',
		data: {mcmmo_player_skills_table: '<?php echo htmlentities($_GET['user']);?>'},
		success:function(msg){
				$('.mcmmo').html(msg);
				$('.mcmmo').fadeIn();
				logInfo( "McMMO loaded!" );
				return false;
		}
	});
	<?php endif; if($permissionsex_control == true && pluginconfigpermissionsex===true) :?>
	$.ajax({
		url : 'modules/permissionsex/include/functions.php',
		type: 'post',
		data: {permissionsex_player_table: '<?php echo htmlentities($_GET['user']);?>'},
		success:function(msg){
				$('.permissions').html(msg);
				$('.permissions').fadeIn();
				logInfo( "PermissionsEx loaded!" );
				return false;
		}
	});
	<?php endif; if($plugintype["Jail"]===true) :?>
	$.ajax({
		url : 'modules/jail/include/functions.php',
		type: 'post',
		data: {jail_player_table: '<?php echo htmlentities($_GET['user']);?>'},
		success:function(msg){
				$('.jail').html(msg);
				$('.jail').fadeIn();
				logInfo( "Jail loaded!" );
				return false;
		}
	});
	<?php endif; if($plugintype["Jobs"]===true) :?>
	$.ajax({
		url : 'modules/jobs/include/functions.php',
		type: 'post',
		data: {job_player_details_table: '<?php echo htmlentities($_GET['user']);?>'},
		success:function(msg){
				$('.jobs').html(msg);
				$('.jobs').fadeIn();
				logInfo( "Jobs loaded!" );
				return false;
		}
	});
	<?php endif; if($plugintype["Stats"]===true) :?>
	$.ajax({
		url : 'modules/<?php echo WS_CONFIG_STATS_PLUGIN;?>/include/functions.php',
		type: 'post',
		data: {set_player_details_table: '<?php echo htmlentities($_GET['user']);?>'},
		success:function(msg){
				$('.player_stats').html(msg);
				$('.player_stats').fadeIn();
				logInfo( "Player Details Stats loaded!" );
				return false;
		}
	});
	$.ajax({
		url : 'modules/<?php echo WS_CONFIG_STATS_PLUGIN;?>/include/functions.php',
		type: 'post',
		data: {set_player_tables: '<?php echo htmlentities($_GET['user']);?>'},
		success:function(msg){
				$('.stats').html(msg);
				$('.stats').fadeIn();
				logInfo( "Player Stats Table loaded!" );
				return false;
		}
	});
	<?php endif;?>
</script>