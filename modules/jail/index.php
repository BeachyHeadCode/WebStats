<h2>Jail</h2><br/>

<table style="margin:0px auto;">
	<tr>
        <td>Num:</td>
        <td><a href="index.php?mode=jail&amp;sort=PlayerName"><?php echo translate("var3"); ?>:</a></td>
        <td><a href="index.php?mode=jail&amp;sort=RemainTime"><span>Time:</span></a></td>
        <td><a href="index.php?mode=jail&amp;sort=JailName"><span>Jail:</span></a></td>
        <td><a href="index.php?mode=jail&amp;sort=reason"><span>reason:</span></a></td>
        <td><a href="index.php?mode=jail&amp;sort=Jailer"><span>Jailer:</span></a></td>
        <td><a href="index.php?mode=jail&amp;sort=muted"><span>Muted:</span></a></div>
	</tr>
		<?php	
			if (isset($_GET["page"]) <= 0) {
				$page = '1';
			} if (isset($_GET["page"]) > 0) {	
				$page = $_GET["page"];
			}
			if(isset($_SESSION['page']['numbers'])) {
				$start = $page * $_SESSION['page']['numbers'] - $_SESSION['page']['numbers'];
				$end = $_SESSION['page']['numbers'];
			} else {
				$start = $page * WS_CONFIG_PAGENUM - WS_CONFIG_PAGENUM;
				$end = WS_CONFIG_PAGENUM;
			}
			$sort = $_GET['sort'];
			$players = get_jail_user_stats_order($sort, $start, $end);
			$player_count = get_jail_user_count();
			for($i=0; $i < sizeof($players); $i++) {
				echo (jail_server_player_table($players[$i], $i+$start));
			}				
		?>
</table>
<?php echo (get_pages($player_count, $_GET['mode'], $_GET['sort']));?>