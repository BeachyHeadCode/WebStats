<table style="margin: 25px auto 0;">
	<tr>
		<td>Num:</td>
		<td><a class="ajax-link" href="index.php?sort=player"><?php echo translate('var3'); ?>:</a></td>
		<td><a class="ajax-link" href="index.php?sort=playtime"><?php echo translate('var4'); ?>:</a></td>
		<td><a class="ajax-link" href="index.php?sort=lastjoin"><?php echo translate('var5'); ?>:</a></td>
		<td><?php echo translate('var15'); ?>:</td>
	</tr><?php
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
		$players = get_user_stats($sort, $start, $end);
		$player_all = get_user($sort);
		for($i=0; $i < sizeof($players); $i++) {
			echo (set_index_table($players[$i], $i+$start));
		}?>
</table>
<?php echo (get_pages(sizeof($player_all), $_GET['mode'], $_GET['sort'])); ?>

