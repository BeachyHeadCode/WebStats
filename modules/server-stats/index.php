<h2>Server Stats</h2><br/>
<?php
if (!isset($_GET['search'])){$_GET['search'] = 'ORDER BY stat ASC';}
else {$_GET['search'] = 'ORDER BY SUM(value) DESC';}					
?>
<div class="head_maintable_stats">
	<?php echo (set_server_details_table()); ?>
	<?php if($iconomy_control == true) 
	{
		include('modules/iconomy/api/api.php');
		echo'<div align="right" style="clear:both;">'; 
		echo (iconomy_server_get_money_table()); 
		echo'</div>';
	} 
	?>
</div>
<br /><br />
<div class="content_maintable_stats">                        
	<div class="content_headline" style="width:748px;">
		<a href="index.php?mode=server-stats" style="cursor:url(images/cursors/hover.cur),auto;" ><?php echo translate('var1'); ?></a> - <a href="index.php?mode=server-stats&search=true" style="cursor:url(images/cursors/hover.cur),auto;" ><?php echo translate('var2'); ?></a>
	</div>
	<div style="clear: both; width: 748px; height: 25px;">&nbsp;</div>
	<dl class="tabs">
		<dd class="active"><a href="#Player">Player Kills/Deaths</a></dd>
		<dd><a href="#Blocks">Destroyed/Placed Blocks</a></dd>
		<dd><a href="#Damage">Dealt/Received Damage</a></dd>
	</dl>
	<ul class="tabs-content">
		<li class="active" id="PlayerTab">
			<table>
				<tr>
					<td style="min-width:363px;"><?php echo translate('var21');?>:</td>
					<td style="min-width:363px;"><?php echo translate('var22');?>:</td>
				</tr>
				<tr>
					<td style="min-width:373px;"><?php echo (set_server_didkill_table($_GET['search'])); ?></td>
					<td style="min-width:373px;"><?php echo (set_server_getkill_table($_GET['search'])); ?></td>
				</tr>
			</table>
		</li>
		<li id="BlocksTab">   
			<table>
				<tr>
					<td style="min-width:363px;"><?php echo translate('var8');?>:</td>
					<td style="min-width:363px;"><?php echo translate('var9');?>:</td>
				</tr>
				<tr>
					<td style="min-width:373px;"><?php echo (set_server_destroy_table($_GET['search']));?></td>
					<td style="min-width:373px;"><?php echo (set_server_build_table($_GET['search']));?></td>
				</tr>
			</table>
		</li>
		<li id="DamageTab">
			<table>                
				<tr>
					<td style="min-width:363px;"><?php echo translate('var11');?>:</td>
					<td style="min-width:363px;"><?php echo translate('var10');?>:</td>
				</tr>					
				<tr>
					<td style="min-width:373px;"><?php echo (set_server_damagedealt_table($_GET['search']));?></td>
					<td style="min-width:373px;"><?php echo (set_server_damagereceived_table($_GET['search']));?></td>
				</tr>
			</table>
		</li>	
	</ul>
</div>