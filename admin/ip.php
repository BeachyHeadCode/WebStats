<?php
if(basename(__FILE__) == basename($_SERVER['PHP_SELF'])){exit();}
$ip = $_SERVER['REMOTE_ADDR'];
if (!isset($_GET['sort'])) {$_GET['sort'] = 'IPdesc';}
if((isset($_SESSION['pml_userid']) && $_SESSION['pml_userrank']=='1') || $ip=='127.0.0.1' || $ip=='localhost' || $ip=='::1') {
	if(iptracker === true) {
/* SETS NUMBER OF USERS TO PRINT */
function get_IP_stats_count($link) {
	$query = mysqli_query($link, "SELECT COUNT(`IP`) FROM `ip_stats`");
	$row = mysqli_fetch_array($query, MYSQLI_NUM);
	return $row[0];
}
/* SETS THE STATS ORDER AND PAGE NUMBERS */
function get_IP_stats_order($sort, $start, $end, $link) {
	if(isset($sort)) {
		switch($sort) {
			case "IPdesc";
				$sortkey = "ORDER BY `IP` DESC";
			break;
			case "hostnamedesce";
				$sortkey = "ORDER BY `hostname` DESC";
			break;
			case "locationdesc";
				$sortkey = "ORDER BY `location` DESC";
			break;
			case "refererdesc";
				$sortkey = "ORDER BY `referer` DESC";
			break;
			case "pageurldesc";
				$sortkey = "ORDER BY `pageurl` DESC";
			break;
			case "pageviewsdesc";
				$sortkey = "ORDER BY `pageview` DESC";
			break;
			case "datedesc";
				$sortkey = "ORDER BY `dt` DESC";
			break;
			case "IPasc";
				$sortkey = "ORDER BY `IP` ASC";
			break;
			case "hostnameasc";
				$sortkey = "ORDER BY `hostname` ASC";
			break;
			case "locationasc";
				$sortkey = "ORDER BY `location` ASC";
			break;
			case "refererasc";
				$sortkey = "ORDER BY `referer` ASC";
			break;
			case "pageurlasc";
				$sortkey = "ORDER BY `pageurl` ASC";
			break;
			case "pageviewsasc";
				$sortkey = "ORDER BY `pageview` ASC";
			break;
			case "dateasc";
				$sortkey = "ORDER BY `dt` ASC";
			break;
		}
	} else {
		$sortkey = 'ORDER BY `date` ASC';
	}
	$query = mysqli_query($link, "SELECT * FROM `ip_stats` WHERE `ip_stats`.`IP` != '' ".$sortkey." LIMIT ".$start.",".$end);
	$time = 0;
	while($row = mysqli_fetch_array($query, MYSQLI_BOTH)) {
		$IPs[$time] = $row['IP'];
		$time++;
	}
	return $IPs;
}
/* USED TO PRINT THE VALUES */
function server_IP_table($IP, $pos, $link) {
	$pos++;
	$result = mysqli_query($link, "SELECT * FROM `ip_stats` WHERE `ip_stats`.`IP` = '".$IP."' AND `ip_stats`.`IP` != ''") or ws_die(mysqli_error($link), "MySQL Error");
	$data = mysqli_fetch_array($result, MYSQLI_BOTH);

	$output = '<tr>';
	
	if($data['bot']==1){
			$output  .= '<td style="text-align: center;" bgcolor="#CCCCCC">'.$pos."<br/>BOT</td>\n";
	} else {
		$output  .= '<td style="text-align: center;">'.$pos."</td>\n";     
	}
		$output .= '<td style="text-align: center;">'.$data['IP']."</td>\n";
		$output .= '<td style="text-align: center;"><a href="#" data-reveal-id="a'.md5($data['IP']).'">'.$data['location']."</a></td>\n";
		$output .= '<td style="text-align: center;">'.$data['pageview']."</td>\n";
		$output .= '<td style="text-align: center;">'.$data['date']."</td>\n";
		$output .= '<td style="text-align: center;"><a href="#" data-reveal-id="a'.md5($data['IP']).'"><i class="step fi-target-two size-14"></i></a></td>';
	$output .= '</tr>';
return $output;
}
?>
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
<center>
	<h2>IP Track ( <?php echo $ip;?> ) Welcome</h2>
</center>
<?php
$link = mysqli_connect('p:'.WS_MySQL_DBHOST, WS_MySQL_USERNAME, WS_MySQL_PASSWORD, WS_MySQL_DB, WS_MySQL_PORT);

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
<center>
	<table>
		<thead>
			<th align="left" class="content_headline_num">Num:</th>
			<?php if($_GET['sort']!=='IPdesc') {?>
				<th><a href="?mode=ip&sort=IPdesc&NPP=<?php echo $_GET["NPP"];?>" title="Internet Protocol">IP:</a></th>
			<?php } else {?>
				<th><a href="?mode=ip&sort=IPasc&NPP=<?php echo $_GET["NPP"];?>" title="Internet Protocol">IP:</a></th>
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
			<th title="More Information">More</th>
		</thead>
		<?php	
			$sort = $_GET['sort'];
			$IPs = get_IP_stats_order($sort, $start, $end, $link);
			$IP_count = get_IP_stats_count($link);
		?>
		<tbody>
			<?php
				for($i=0; $i < sizeof($IPs); $i++) {
					echo (server_IP_table($IPs[$i], $i+$start, $link));
				}
			?>
		</tbody>
	</table>
</center>
<?php
	for($i=0; $i < sizeof($IPs); $i++) {
	$result = mysqli_query($link, "SELECT * FROM `ip_stats` WHERE `ip_stats`.`IP` = '".$IPs[$i]."' AND `ip_stats`.`IP` != ''") or ws_die(mysqli_error($link), "MySQL Error");
	$data = mysqli_fetch_array($result, MYSQLI_BOTH);
	$ip = md5($data['IP']);
	$realip = $data['IP'];
	$pageurl = $data['pageurl'];
	$hostname = $data['hostname'];
	$referer = $data['referer'];
	$location = $data['location'];
echo <<< END
	<div id="a$ip" class="reveal-modal" data-reveal aria-labelledby="$realip" aria-hidden="true" role="dialog">
		<h2>$realip</h2>
		<div class="row" style="background: #FFFFFF;border: solid 1px #DDDDDD;margin-bottom: 1.25rem;table-layout: auto;">
			<div class="small-4 columns" style="background:#f5f5f5;color: #222222;font-size: 0.875rem;font-weight: bold;padding: 0.5rem 0.625rem 0.625rem;">Hostname:</div>
			<div class="small-4 columns" style="background:#f5f5f5;color: #222222;font-size: 0.875rem;font-weight: bold;padding: 0.5rem 0.625rem 0.625rem;">Page URL:</div>
			<div class="small-4 columns" style="background:#f5f5f5;color: #222222;font-size: 0.875rem;font-weight: bold;padding: 0.5rem 0.625rem 0.625rem;">Referer:</div>
		</div>
		<div class="row">
			<div class="small-4 columns" style="text-align: center;"><a href="http://$hostname" target="_blank">$hostname</a></div>
			<div class="small-4 columns" style="text-align: center;"><a href="$pageurl" target="_blank">$pageurl</a></div>
			<div class="small-4 columns" style="text-align: center;"><a href="$referer" target="_blank">$referer</a></div>
		</div>
		<hr />
		<div class="row">
			Location: $location<br />
			<center>
				<a href="http://maps.googleapis.com/maps/api/staticmap?center=$location&zoom=7&size=1000x1000&maptype=roadmap&sensor=false" target="_blank"><img src="http://maps.googleapis.com/maps/api/staticmap?center=$location&zoom=7&size=1000x1000&maptype=roadmap&sensor=false" /></a>	
			</center>
		</div>
			<a class="close-reveal-modal" aria-label="Close">&#215;</a>
	</div>
END;
			}
		echo "<div class='row' style='margin:auto;'>" . (get_pages($IP_count, $_SESSION['mode'], $_GET['sort'])) . "</div>";
		mysqli_close($link);
	?>
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