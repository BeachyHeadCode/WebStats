<div class="content_maintable_stats" style="width:500px;">
	<table style="margin:auto;">
		<tr>
			<td>Num:</td>
			<td><a href="index.php?sort=player" style="cursor:url(images/cursors/hover.cur),auto;" ><?php echo translate('var3'); ?>:</a></td>
			<td><a href="index.php?sort=playedfor" style="cursor:url(images/cursors/hover.cur),auto;" ><?php echo translate('var4'); ?>:</a></td>
			<!--<td><a href="index.php?sort=lastlogin" style="cursor:url(images/cursors/hover.cur),auto;" >< ?php echo translate('var5'); ?>:</a></td>
			<td>< ?php echo translate('var15'); ?>:</td>-->
		</tr><?php
			if (isset($_GET["page"]) <= 0){
				$page = '1';
			}
			if (isset($_GET["page"]) > 0){	
				$page = $_GET["page"];
			}
			if(isset($_SESSION['page']['numbers'])){
				$start = $page * $_SESSION['page']['numbers'] - $_SESSION['page']['numbers'];
				$end = $_SESSION['page']['numbers'];
			} else {
				$start = $page * WS_CONFIG_PAGENUM - WS_CONFIG_PAGENUM;
				$end = WS_CONFIG_PAGENUM;
			}
			$sort = $_GET['sort'];	
			$players = get_user_stats($sort, $start, $end);
			$player_all = get_user($sort);
			for($i=0; $i < sizeof($players); $i++){
				echo (set_index_table($players[$i], $i+$start));
			}?>
	</table>
	<?php echo (get_pages(sizeof($player_all), $_GET['mode'], $_GET['sort'])); ?>
</div>
