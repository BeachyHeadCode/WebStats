<?php
session_start();
error_reporting(0);
$ip = $_SERVER['REMOTE_ADDR'];
require_once "../include/logonfunctions.php";
require_once '../include/functions.php';
if(file_exists('../config/config.php'))
	include_once '../config/config.php';
else
	header("setup-config.php");
if (!isset($_GET['sort'])) {$_GET['sort'] = 'IPdesc';}
if(isset($_SESSION['pml_userid']) || $ip=='127.0.0.1' || $ip=='localhost' || $ip=='::1') {
	if(iptracker === true) {
/* SETS NUMBER OF USERS TO PRINT */
function get_IP_stats_count() {
	$query = mysql_query("SELECT COUNT(`IP`) FROM `ip_stats`");
	$row = mysql_fetch_array($query);
	return $row[0];
}
/* SETS THE STATS ORDER AND PAGE NUMBERS */
function get_IP_stats_order($sort, $start, $end) {
	if(isset($sort)) {
		switch($sort) {
			case "IPdesc";
				$sortkey = "ORDER BY IP DESC";
			break;
			case "hostnamedesce";
				$sortkey = "ORDER BY hostname DESC";
			break;
			case "locationdesc";
				$sortkey = "ORDER BY location DESC";
			break;
			case "refererdesc";
				$sortkey = "ORDER BY referer DESC";
			break;
			case "pageurldesc";
				$sortkey = "ORDER BY pageurl DESC";
			break;
			case "pageviewsdesc";
				$sortkey = "ORDER BY pageview DESC";
			break;
			case "datedesc";
				$sortkey = "ORDER BY date DESC";
			break;
			case "IPasc";
				$sortkey = "ORDER BY IP ASC";
			break;
			case "hostnameasc";
				$sortkey = "ORDER BY hostname ASC";
			break;
			case "locationasc";
				$sortkey = "ORDER BY location ASC";
			break;
			case "refererasc";
				$sortkey = "ORDER BY referer ASC";
			break;
			case "pageurlasc";
				$sortkey = "ORDER BY pageurl ASC";
			break;
			case "pageviewsasc";
				$sortkey = "ORDER BY pageview ASC";
			break;
			case "dateasc";
				$sortkey = "ORDER BY date ASC";
			break;
		}
	} else {
		$sortkey = 'ORDER BY date ASC';
	}
	$result = "SELECT * FROM `ip_stats` WHERE `ip_stats`.`IP` != '' ".$sortkey." LIMIT ".$start.",".$end."";
	$query = mysql_query($result);
	$time = 0;
	while($row = mysql_fetch_array($query)) {
		$IPs[$time] = $row['IP'];
		$time++;
	}
	return $IPs;
}
/* USED TO PRINT THE VALUES */
function server_IP_table($IP, $pos) {
	$pos++;
	$query = "SELECT * FROM `ip_stats` WHERE `ip_stats`.`IP` = '".$IP."' AND `ip_stats`.`IP` != ''";
	$result = mysql_query($query) or die(mysql_error());
	$data = mysql_fetch_array($result);

	$output = '<tr>';
	
	if($data['bot']==1){
			$output  .= '<td style="text-align: center;" bgcolor="#CCCCCC">'.$pos."<br/>BOT</td>\n";
	} else {
		$output  .= '<td style="text-align: center;">'.$pos."</td>\n";     
	}
		$output .= '<td style="text-align: center;">'.$data['IP']."</td>\n";
		$output .= '<td style="text-align: center;"><a href="#" data-reveal-id="'.md5($data['IP']).'">'.$data['location']."</a></td>\n";
		$output .= '<td style="text-align: center;">'.$data['pageview']."</td>\n";
		$output .= '<td style="text-align: center;">'.$data['date']."</td>\n";
		$output .= '<td style="text-align: center;"><a href="#" data-reveal-id="'.md5($data['IP']).'">More +</a></td>';
	$output .= '</tr>';
return $output;
}
?>
<body style="background-color:rgb(228, 228, 228);">
<style>
	.nav-bar{
		margin-top: 0px !important;
	}
	a:link {
				color:						black;
				text-decoration:			none;
				font-weight: 				bold;
	}
	a:visited {
				color: 						black;
				text-decoration: 			none;
				font-weight: 				bold;
	}
	a:hover {
				color:						black;
				text-decoration: 			underline;
				font-weight: 				bold;				
	}
</style>
<div style="text-align: center;">
	<h2>IP Track ( <?php echo $ip;?> ) Welcome</h2>
</div>
<?php 
$DB = new DBConfig();$DB -> config();	$DB -> conn(WS_MySQL_DBHOST, WS_MySQL_USERNAME, WS_MySQL_PASSWORD, WS_MySQL_DB);

if (isset($_GET["page"]) <= 0) {
	$page = '1';
}
if (isset($_GET["page"]) > 0) {
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
?>
<table style="margin:auto;">
	<thead>
        <th align="left" class="content_headline_num" style="">Num:</th>
        <?php if($_GET['sort']!=='IPdesc') {?>
        	<th><a href="?mode=ip&sort=IPdesc&NPP=<?php echo $_GET["NPP"];?>">IP:</a></th>
        <?php } else {?>
        	<th><a href="?mode=ip&sort=IPasc&NPP=<?php echo $_GET["NPP"];?>">IP:</a></th>
		<?php } if($_GET['sort']!=='locationdesc') {?>
        	<th><a href="?mode=ip&sort=locationdesc&NPP=<?php echo $_GET["NPP"];?>">Location:</a></th>
        <?php } else {?>
        	<th><a href="?mode=ip&sort=locationasc&NPP=<?php echo $_GET["NPP"];?>">Location:</a></th>
        <?php }if($_GET['sort']!=='pageviewsdesc') {?>
        	<th><a href="?mode=ip&sort=pageviewsdesc&NPP=<?php echo $_GET["NPP"];?>">Page views:</a></th>
        <?php } else {?>
       		<th><a href="?mode=ip&sort=pageviewsasc&NPP=<?php echo $_GET["NPP"];?>">Page views:</a></th>
        <?php } if($_GET['sort']!=='datedesc') {?>
        	<th><a href="?mode=ip&sort=datedesc&NPP=<?php echo $_GET["NPP"];?>">Date:</a></th>
        <?php } else {?>
        	<th><a href="?mode=ip&sort=dateasc&NPP=<?php echo $_GET["NPP"];?>">Date:</a></th>
        <?php }?>
	</thead>
	<?php	
		$sort = $_GET['sort'];
		$IPs = get_IP_stats_order($sort, $start, $end);
		$IP_count = get_IP_stats_count();
	?>
	<tbody>
		<?php
			for($i=0; $i < sizeof($IPs); $i++) {
				echo (server_IP_table($IPs[$i], $i+$start));
			}
		?>
	</tbody>
</table>
<?php
	for($i=0; $i < sizeof($IPs); $i++) {
	$query = "SELECT * FROM `ip_stats` WHERE `ip_stats`.`IP` = '".$IPs[$i]."' AND `ip_stats`.`IP` != ''";
	$result = mysql_query($query) or die(mysql_error());
	$data = mysql_fetch_array($result);
	$ip = md5($data['IP']);
	$realip = $data['IP'];
	$pageurl = $data['pageurl'];
	$hostname = $data['hostname'];
	$referer = $data['referer'];
	$location = $data['location'];
echo <<< END
	<div id="$ip" class="reveal-modal">
		<h2>$realip</h2>
			<p>
				<table>
					<thead>
						<th>Hostname:</th>
						<th>Page URL:</th>
						<th>Referer:</th>
					</thead>
					<tbody>
					<tr>
						<td style="text-align: center;"><a href="http://$hostname" target="_blank">$hostname</a></td>
						<td style="text-align: center;"><a href="$pageurl" target="_blank">$pageurl</a></td>
						<td style="text-align: center;"><a href="$referer" target="_blank">$referer</a></td>
					</tbody>
				</table>
				Location: $location<br/>
				<a href="http://maps.googleapis.com/maps/api/staticmap?center=$location&zoom=7&size=1000x1000&maptype=roadmap&sensor=false" target="_blank"><img src="http://maps.googleapis.com/maps/api/staticmap?center=$location&zoom=7&size=1000x1000&maptype=roadmap&sensor=false" /></a>	
			</p>
			<a class="close-reveal-modal">&#215;</a>
	</div>
END;
			}
		echo "<div class='row' style='margin:auto;'>" . (get_pages($IP_count, $_SESSION['mode'], $_GET['sort'])) . "</div>";
		$DB -> close();	
	?>
</body>
</html>
<?php 
	} else {
echo <<< END
<p>
	<form action="#" method="post" class="custom">
		<fieldset>
			<legend style="background: none;"><h5>Check to allow IP track to track your users. This is personal and is in your own records only.</h5></legend>
			<label for="Username">Allow: <input type="checkbox" title="IP Tracker Allow" name="Allow" value="true" /></label>
			<input name="SubmitAllowIP" type="submit" title="submit" class="small success button"/>
		</fieldset>
	</form>
</p>
END;
		if($_POST["Allow"] == 'true') {
			$filename = '../config/config.php';
			$temp = file_get_contents($filename);
			$temp = str_replace("define('iptracker', false);","define('iptracker', true);",$temp);
			file_put_contents($filename, $temp);
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
		}
	}
} else {
	header("location:".adminPageURL());
}
?>