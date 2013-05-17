<a href="http://dev.bukkit.org/server-mods/jobs/pages/permissions/"><h2>Jobs</h2></a><br/>

<?php echo (job_server_details_table()); ?>

<br/><br/>

<table style="width:100%;" >
	<tr style="text-align:center;">
		<td style="text-align:center;">
			<?php echo translate('var42'); ?>
		</td>
    </tr>
    <tr>
    	<td><a href="index.php?mode=jobs&sort=player"><?php echo translate('var3'); ?></a></td>
        <td><a href="index.php?mode=jobs&sort=job"><?php echo translate('var35'); ?></a></td>
        <td><a href="index.php?mode=jobs&sort=level"><?php echo translate('var38'); ?></a></td>
        <td><a href="index.php?mode=jobs&sort=experience"><?php echo translate('var39'); ?></a></td>
    </tr>
<?php	
			if (isset($_GET["page"]) <= 0){
   				$page = '1';
   			}
   			if (isset($_GET["page"]) > 0){	
   				$page = $_GET["page"];
			}
			if(isset($_GET["NPP"]) && $_GET["NPP"] != '') {
				$start = $page * $_GET["NPP"] - $_GET["NPP"];
				$end = $_GET["NPP"];
			} else {
				$start = $page * WS_CONFIG_PAGENUM - WS_CONFIG_PAGENUM;
				$end = WS_CONFIG_PAGENUM;
			}
			$sort = $_GET['sort'];
			$players = get_jobs_user_stats($sort, $start, $end);
			$player_count = get_jobs_user_count();
			for($i=0; $i < sizeof($players); $i++)
			{
				echo (job_player_list_table($players[$i], $i+$start));
			}		 	
?>
</table>
<div class="row" style="clear:both;">
<?php echo (get_pages(sizeof($player_count), $_GET['mode'], $_GET['sort'])); ?>
</div>