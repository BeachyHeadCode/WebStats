<h2>MineConomy</h2>
<div class="row">
<?php
	if ($_GET['sort'] != 'balance') {
		$_GET['sort'] = 'username';
	} else {
		$_GET['sort'] = 'balance';
	}
	echo (mineconomy_server_details_table());
?>
</div>
<div class="row"><div class="large-12 columns">
<table style="margin:0px auto;">
	<tr>
		<td>
    		<a class="ajax-link" href="index.php?mode=mineconomy"><?php echo translate('var1'); ?></a> - <a class="ajax-link" href="index.php?mode=mineconomy&sort=balance"><?php echo translate('var2'); ?></a>
		</td>
	</tr>
	<tr>
    	<td><?php echo translate('var3'); ?></td>
        <td><?php echo translate('var50'); ?></td>
    </tr>
<?php	
		if (isset($_GET["page"]) <= 0) {
   			$page = '1';
   		} if (isset($_GET["page"]) > 0) {
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
		$players = get_mineconomy_user_stats($sort, $start, $end);
		$player_count = get_mineconomy_user_count();
		for($i=0; $i < sizeof($players); $i++) {
			echo (mineconomy_server_player_table($players[$i], $i+$start));
		}			
?>
</table>
</div></div>
<div class="row" style="clear:both;">
<?php echo (get_pages(sizeof($player_count), $_GET['mode'], $_GET['sort']));?>
</div>