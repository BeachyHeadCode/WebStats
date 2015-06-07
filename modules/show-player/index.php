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
		<div class="large-12 columns small-centered large-uncentered player_economy" align="right"></div>
	</div>
</div>
<br />
<!--MAIN BOX AND PHOTO END-->
<div class="row permissions"></div>
<div class="row jail"></div>
<div class="row jobs"></div>
<div class="row mcmmo"></div>
<div class="row stats"></div>
<?php
	if($achievements_control === true && pluginconfigstatusachiv === true) {
		include('modules/show-player/include/functions_achievements.php');
?>
<!-- ACHIEVMENTS START-->
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
				<div class="fortschritt" style="width:<?php echo (((achievements_player_count_table(htmlentities($_GET['user'])) * 100) / achievements_server_count_table())); ?>%">&nbsp;</div>
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
			<span4><div class="content_maintable_achiev" style="padding-top: 25px; padding-bottom: 25px;"><?php echo achievements_server_achievement_table();?></div></span4>
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
				$('.mcmmo').css("margin-top","10px");
				$('.mcmmo').fadeIn();
				logInfo( "McMMO loaded!" );
				return false;
		}
	});
	<?php endif; if($plugintype["PermissionsEx"]===true) :?>
	$.ajax({
		url : 'modules/permissionsex/include/functions.php',
		type: 'post',
		data: {permissionsex_player_table: '<?php echo htmlentities($_GET['user']);?>'},
		success:function(msg){
				$('.permissions').html(msg);
				$('.permissions').css("margin-top","10px");
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
				$('.jail').css("margin-top","10px");
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
				$('.jobs').css("margin-top","10px");
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
		data: {set_player_tables: '<?php echo htmlentities($_GET['user']);?>', search: '<?php echo htmlentities($_GET['search']);?>'},
		success:function(msg){
				$('.stats').html(msg);
				$('.stats').css("margin-top","10px");
				$('.stats').fadeIn();
				$(document).foundation();
				logInfo( "Player Stats Table loaded!" );
				return false;
		}
	});
	<?php endif; if($plugintype["Economy"]===true) :?>
	$.ajax({
		url : 'modules/<?php echo WS_CONFIG_ECONOMY_PLUGIN;?>/include/functions.php',
		type: 'post',
		data: {player_get_money_table: '<?php echo htmlentities($_GET['user']);?>'},
		success:function(msg){
				$('.player_economy').html(msg);
				$('.player_economy').fadeIn();
				logInfo( "Economy loaded!" );
				return false;
		}
	});
	<?php endif;?>
</script>