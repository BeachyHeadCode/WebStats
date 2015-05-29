<h2>Server Stats</h2>
<?php if (!isset($_GET['search'])){$bool = true;} else {$bool = false;} ?>
<div>
	<?php echo set_server_details_table(); ?>
</div>
<br /><br />
<div class="content_maintable_stats">                        
	<div class="small-12 columns content_headline">
		<a class="ajax-link" href="index.php?mode=server-stats"><?php echo translate('var1'); ?></a> - <a class="ajax-link" href="index.php?mode=server-stats&search=true"><?php echo translate('var2'); ?></a>
	</div>
	<div style="clear: both; height: 25px;">&nbsp;</div>
	<ul class="tabs" data-tab role="tablist">
		<li class="tab-title active" role="presentational"><a href="#PlayerTab" role="tab" tabindex="0" aria-selected="true" controls="PlayerTab">Player Kills/Deaths</a></li>
		<li class="tab-title" role="presentational"><a href="#BlocksTab" role="tab" tabindex="0" aria-selected="false" controls="BlocksTab">Destroyed/Placed Blocks</a></li>
		<?php if (function_exists('set_server_damagedealt_table') and function_exists('set_server_damagereceived_table')) :?>
		<li class="tab-title" role="presentational"><a href="#DamageTab" role="tab" tabindex="0" aria-selected="false" controls="DamageTab">Dealt/Received Damage</a></li>
		<?php endif;?>
	</ul>
	<div class="tabs-content">
		<?php if(function_exists('set_server_kill_table') and function_exists('set_server_death_table')) :?>
		<div role="tabpanel" aria-hidden="false" class="content active" id="PlayerTab">
			<div class="medium-6 columns">
				<?php echo set_server_kill_table($bool);?>
			</div>
			<div class="medium-6 columns">
				<?php echo set_server_death_table($bool);?>
			</div>
		</div>
		<?php endif; if(function_exists('set_server_destroy_build_table')) :?>
		<div role="tabpanel" aria-hidden="true" class="content"  id="BlocksTab">
			<center>
				<?php echo set_server_destroy_build_table($bool);?>
			</center>
		</div>
		<?php endif; if(function_exists('set_server_destroy_table') and function_exists('set_server_build_table')) :?>
		<div role="tabpanel" aria-hidden="true" class="content"  id="BlocksTab">   
			<table style="margin: 0 auto;">
				<tr>
					<td><?php echo translate('var8');?>:</td>
					<td><?php echo translate('var9');?>:</td>
				</tr>
				<tr>
					<td><?php echo set_server_destroy_table($bool);?></td>
					<td><?php echo set_server_build_table($bool);?></td>
				</tr>
			</table>
		</div>
		<?php endif; if(function_exists('set_server_damagedealt_table') and function_exists('set_server_damagereceived_table')) :?>
		<div role="tabpanel" aria-hidden="true" class="content" id="DamageTab">
			<table style="margin: 0 auto;">
				<tr>
					<td><?php echo translate('var11');?>:</td>
					<td><?php echo translate('var10');?>:</td>
				</tr>
				<tr>
					<td><?php echo set_server_damagedealt_table($bool);?></td>
					<td><?php echo set_server_damagereceived_table($bool);?></td>
				</tr>
			</table>
		</div>
		<?php endif;?>
	</div>
</div>