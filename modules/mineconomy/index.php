<h2>Mine Conomy</h2><br/>
<?php
	if ($_GET['sort'] != 'balance'){
		$_GET['sort'] = 'username';
	} else {
		$_GET['sort'] = 'balance';
	}	
?>
<?php 
	echo (mineconomy_server_details_table());
?>

<br/><br/>

<table style="margin:0px auto;">
	<tr>
		<td>
    		<a href="index.php?mode=mineconomy"><?php echo translate('var1'); ?></a> - <a href="index.php?mode=mineconomy&sort=balance"><?php echo translate('var2'); ?></a>
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
<?php echo (get_pages(sizeof($player_count), $_GET['mode'], $_GET['sort']));?>