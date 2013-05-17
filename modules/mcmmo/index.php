<div class="row">
	<h2><a href="http://mcmmo.wikia.com" target="_blank" title="McMMo Wiki" <?php echo (hover);?>>McMMO</a></h2><br/>

	<table>
		<tr>
			<td>Num:</td>
			<td><a href="index.php?mode=mcmmo&amp;sort=user" <?php echo (hover);?>><?php echo translate("var3"); ?>:</a></td>
			<td><a href="index.php?mode=mcmmo&amp;sort=acrobatics" <?php echo (hover);?>><img src="./modules/mcmmo/images/acrobatics.png" width="24px" height="24px" border="0" title="Acrobatics" /></a></td>
			<td><a href="index.php?mode=mcmmo&amp;sort=archery" <?php echo (hover);?>><img src="./modules/mcmmo/images/archery.png" width="24px" height="24px" border="0" title="Archery" /></a></td>
			<td><a href="index.php?mode=mcmmo&amp;sort=axes" <?php echo (hover);?>><img src="./modules/mcmmo/images/axes.png" width="24px" height="24px" border="0" title="Axes" /></a></td>
			<td><a href="index.php?mode=mcmmo&amp;sort=excavation" <?php echo (hover);?>><img src="./modules/mcmmo/images/excavation.png" width="24px" height="24px" border="0" title="Excavation" /></a></td>
			<td><a href="index.php?mode=mcmmo&amp;sort=fishing" <?php echo (hover);?>><img src="./modules/mcmmo/images/fishing.png" width="24px" height="24px" border="0" title="Fishing" /></a></td>
			<td><a href="index.php?mode=mcmmo&amp;sort=herbalism" <?php echo (hover);?>><img src="./modules/mcmmo/images/herbalism.png" width="24px" height="24px" border="0" title="Herbalism" /></a></td>
			<td><a href="index.php?mode=mcmmo&amp;sort=mining" <?php echo (hover);?>><img src="./modules/mcmmo/images/mining.png" width="24px" height="24px" border="0" title="Mining" /></a></td>
			<td><a href="index.php?mode=mcmmo&amp;sort=repair" <?php echo (hover);?>><img src="./modules/mcmmo/images/repair.png" width="24px" height="24px" border="0" title="Repair" /></a></td>
			<td><a href="index.php?mode=mcmmo&amp;sort=swords" <?php echo (hover);?>><img src="./modules/mcmmo/images/swords.png" width="24px" height="24px" border="0" title="Swards" /></a></td>
			<td><a href="index.php?mode=mcmmo&amp;sort=taming" <?php echo (hover);?>><img src="./modules/mcmmo/images/taming.png" width="24px" height="24px" border="0" title="Taming" /></a></td>
			<td><a href="index.php?mode=mcmmo&amp;sort=unarmed" <?php echo (hover);?>><img src="./modules/mcmmo/images/unarmed.png" width="24px" height="24px" border="0" title="Unarmed" /></a></td>
			<td><a href="index.php?mode=mcmmo&amp;sort=woodcutting" <?php echo (hover);?>><img src="./modules/mcmmo/images/woodcutting.png" width="24px" height="24px" border="0" title="Woodcutting" /></a></td>
			<td><a href="index.php?mode=mcmmo&amp;sort=powerlevel" <?php echo (hover);?>><img src="./modules/mcmmo/images/powerlevel.png" width="24px" height="24px" border="0" title="Total Power" /></a></td>
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
				$_GET["NPP"] = WS_CONFIG_PAGENUM;
				$start = $page * WS_CONFIG_PAGENUM - WS_CONFIG_PAGENUM;
				$end = WS_CONFIG_PAGENUM;
			}
			$sort = $_GET['sort'];
			$players = get_mcmmo_user_stats_order($sort, $start, $end);
			$player_count = get_mcmmo_user_count();
			for($i=0; $i < sizeof($players); $i++)
			{
				echo (mcmmo_server_player_table($players[$i], $i+$start));
			}						
	?>
	</table>
</div>
		<?php echo (get_pages($player_count, $_GET['mode'], $_GET['sort']));?>