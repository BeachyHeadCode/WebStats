<!--ALLOWS SORD, ORDER BY VALUE-->
<?php
	if (!isset($_GET['search']))
		$_GET['search'] = '';
	else 
		$_GET['search'] = 'ORDER BY value DESC';
	if (isset($_POST['user']))
	{
		include('modules/search/api/api.php');
		$check_user = search_check_user($_POST['user']);
	}
	if ($check_user == false)
		$_POST['user'] = translate('var77');
	if (!isset($_GET['user']))
		$_GET['user'] = $_POST['user'];
?>
<!--MAIN BOX AND PHOTO START-->
<div class="row">
<div class="head_maintable_stats">
	<?php 
		if($image_control_3d == true && WS_CONFIG_3D_USER === true)
		{
			echo (set_player_details_table_3d(htmlentities($_GET['user']))); 
		}
		else
		{
			echo (set_player_details_table(htmlentities($_GET['user'])));
		} 
	?>
	<?php 
		if($iconomy_control == true && pluginconfigstatusiconomy===true) 
		{
			echo '<div align="right" style="clear:both;">';
			echo (iconomy_player_get_money_table(htmlentities($_GET['user'])));
			echo '</div>';
		}
	?>
</div>
</div>
<!--MAIN BOX AND PHOTO END-->
<br />
<!-- PERMISSIONS TABLE START -->
<div class="row">
<?php
	if($permissionsex_control == true && pluginconfigpermissionsex===true)
	{
		echo (permissionsex_player_table(htmlentities($_GET['user'])));
	}
?>
</div>
<!-- PERMISSIONS TABLE END -->
<br />
<!-- JAIL TABLE START -->
<div class="row">
<?php
	if($jail_control == true && pluginconfigstatusjail===true)
	{
		echo (jail_player_table(htmlentities($_GET['user'])));
	}
?>
</div>
<!-- JAIL TABLE END -->
<br />
<!-- JOBS TABLE START -->
<div class="row">
<?php
	if($job_control == true && pluginconfigstatusjobs===true)
	{
		echo (job_player_details_table(htmlentities($_GET['user'])));
	}
?>
</div>
<!-- JOBS TABLE END -->
<br />
<!-- McMMO TABLE START -->
<div class="row">
<?php
	if($mcmmo_control == true && pluginconfigstatusmcmmo===true)
	{
		echo (mcmmo_player_skills_table(htmlentities($_GET['user'])));
	}
?>
</div>
<!-- McMMO TABLE END -->
<br />
<!-- STATS TABLE START -->
<div class="row">
<?php
	if($stats_control == true && pluginconfigstatusstats===true)
	{
?>
<div class="content_maintable_stats">
	<div class="content_headline" style="width:748px;">
		<a href="index.php?mode=show-player&user=<?php echo htmlentities($_GET['user']); ?>" <?php echo (hover);?>><?php echo translate('var1'); ?></a> - <a href="index.php?mode=show-player&user=<?php echo htmlentities($_GET['user']); ?>&search=true" style="cursor:url(images/cursors/hover.cur),auto;" ><?php echo translate('var2'); ?></a>
	</div>
	<div style="clear: both; width: 748px; height: 25px;">&nbsp;</div>
	<dl class="tabs">
		<dd class="active"><a href="#Player">Player Kills/Deaths</a></dd>
		<dd><a href="#Blocks">Destroyed/Placed Blocks</a></dd>
		<dd><a href="#Damage">Dealt/Received Damage</a></dd>
	</dl>
	<ul class="tabs-content">
	<!--Destroyed and Placed Blocks ~ START-->
	<li class="active" id="BlocksTab">
	<table>
		<tr>
			<td style="min-width:363px;"><?php echo translate('var8'); ?>:</td>
			<td style="min-width:363px;"><?php echo translate('var9');?></td>
		</tr>
		<tr>
			<td style="min-width:373px;"><?php echo(set_player_destroy_table(htmlentities($_GET['user']), $_GET['search']));?></td>
			<td style="min-width:373px;"><?php echo(set_player_build_table(htmlentities($_GET['user']), $_GET['search']));?></td>
		</tr>
	</table>
	</li>	
	<!--Destroyed and Placed Blocks ~ END-->
	<!--Received and Dealt Damage ~ START-->
	<li id="DamageTab"> 
	<table>
		<tr>
			<td style="min-width:363px;"><?php echo translate('var10'); ?>:</td>
			<td style="min-width:363px;"><?php echo translate('var11'); ?>:</td>
		</tr>
		<tr>
			<td style="min-width:373px;"><?php echo(set_player_damagedealt_table(htmlentities($_GET['user']), $_GET['search']));?></td>
			<td style="min-width:373px;"><?php echo(set_player_damagereceived_table(htmlentities($_GET['user']), $_GET['search']));?></td>	
		</tr>
	</table>
	</li>	
	<!--Received and Dealt Damage ~ END-->
	<!--Killed and Killed By ~ START-->
	<li id="PlayerTab">
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
	</li>	
	<!--Killed and Killed By ~ END-->
	</ul>
</div>
</div>
<!-- STATS TABLE END-->
<!-- ACHIEVMENTS START -->
<?php
	if($achievements_control == true && pluginconfigstatusachiv===true)
	{
		include('modules/show-player/include/functions_achievements.php');
	}
?>
<?php
	}
	if($achievements_control == true)
	{
?>	
<br/><br/>								
<table width="650" style="border:1px solid #333333; vertical-align:text-top;">
	<tr>
		<td width="375" style="vertical-align:text-top;" class="Stil2" align="left">
			<strong><u><?php echo translate('var68');?>:<br/><br/></u></strong>
		</td>
	</tr>
	<tr>
		<td width="600" style="vertical-align:text-top;" align="center">
			<div class="gesamtfortschritt" align="left">
				<div class="fortschritttext"><b><?php echo ''.achievements_player_count_table(htmlentities($_GET['user'])).' / '.achievements_server_count_table().'';?></b></div>
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
$(document).ready(function(){
$("#hidr4").click(function () {$("span4").hide("fast", function () {$(this).prev().hide("fast", arguments.callee); });});
$("#showr4").click(function () {$("span4").show(1000);});
});
</script>

<div class="content_maintable_achiev_title">
	<span>Achievements</span><br/>
	<span4_1 id="showr4" class="showhide" <?php echo (hover);?>>Show</span4_1>
	<span4_1 id="hidr4" class="showhide" <?php echo (hover);?>>Hide</span4_1>
</div>
<div class="content_maintable_achiev">
	<div class="slidingDiv_table4">
		<span4><div class="content_maintable_achiev" style="padding-top: 25px; padding-bottom: 25px;"><?php echo (achievements_server_achievement_table());?></div></span4>
	</div>
</div>
<!-- ACHIEVMENTS END -->
<?php
}
?>