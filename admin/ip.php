<?php
session_start();
error_reporting(0);
$ip=$_SERVER['REMOTE_ADDR'];
require_once("../include/logonfunctions.php");
require_once('../include/functions.php');

if(file_exists('../config/config.php'))
	include('../config/config.php');
else
	header("/setup-config.php");
		

if(isset($_SESSION['pml_userid']) || $ip=='127.0.0.1' || $ip=='localhost' || $ip=='::1')
{
//SETS NUMBER OF USERS TO PRINT
function get_IP_stats_count(){
	$query = mysql_query("SELECT COUNT(IP) FROM stats");
	$row = mysql_fetch_array($query);
	return $row[0];
}
//SETS THE STATS ORDER AND PAGE NUMBERS
function get_IP_stats_order($sort, $start, $end){
	if(isset($sort))
	{
		switch($sort)
		{
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
	}
	else 	
	{
		$sortkey = 'ORDER BY date ASC';
	}
	$result = "SELECT * FROM stats WHERE stats.IP != '' ".$sortkey." LIMIT ".$start.",".$end."";
	$query = mysql_query($result);
	$time = 0;
	while($row = mysql_fetch_array($query)) 
	{
		$IPs[$time] = $row['IP'];
		$time++;
	}
	return $IPs;
}
//USED TO PRINT THE VALUES
function server_IP_table($IP, $pos){
	$height='height:40px;';
	$pos++;
	$query = "SELECT * FROM stats WHERE stats.IP = '".$IP."' AND stats.IP != ''";
	$result = mysql_query($query) or die(mysql_error());
	$data = mysql_fetch_array($result);
	if($data['bot']==1){
	$output .= '<tr class="item">';
			$output  = '<td align="center" class="content_headline_num" style="'.$height.'" bgcolor="#CCCCCC">'.$pos.'<br/>BOT</td>';     
		$output .= '<td align="center" class="content_headline_IP" style="'.$height.'">'.$data['IP'].'</td>';
		$output .= '<td align="center" class="content_headline_hostname" style="'.$height.'"><a href="http://'.$data['hostname'].'" target="_blank">'.$data['hostname'].'</a></td>';
		$output .= '<td align="center" class="content_headline_location" style="'.$height.'"><a href="http://maps.googleapis.com/maps/api/staticmap?center='.$data['location'].'&zoom=7&size=1000x1000&maptype=roadmap&sensor=false" target="_blank">'.$data['location'].'</a></td>';
		$output .= '<td align="center" class="content_headline_referer" style="'.$height.'"><a href="'.$data['referer'].'" target="_blank">'.$data['referer'].'</a></td>';
		$output .= '<td align="center" class="content_headline_pageurl" style="'.$height.'"><a href="'.$data['pageurl'].'" target="_blank">'.$data['pageurl'].'</a></td>';
		$output .= '<td align="center" class="content_headline_pageviews" style="'.$height.'">'.$data['pageview'].'</td>';
		$output .= '<td align="center" class="content_headline_date" style="'.$height.'">'.$data['date'].'</td>';
	$output .= "</tr>";
	}
	else{
		$output .= '<tr class="item">';
		$output  = '<td align="center" class="content_headline_num" style="'.$height.'">'.$pos.'</td>';     
		$output .= '<td align="center" class="content_headline_IP" style="'.$height.'">'.$data['IP'].'</td>';
		$output .= '<td align="center" class="content_headline_hostname" style="'.$height.'"><a href="http://'.$data['hostname'].'" target="_blank">'.$data['hostname'].'</a></td>';
		$output .= '<td align="center" class="content_headline_location" style="'.$height.'"><a href="http://maps.googleapis.com/maps/api/staticmap?center='.$data['location'].'&zoom=7&size=1000x1000&maptype=roadmap&sensor=false" target="_blank">'.$data['location'].'</a></td>';
		$output .= '<td align="center" class="content_headline_referer" style="'.$height.'"><a href="'.$data['referer'].'" target="_blank">'.$data['referer'].'</a></td>';
		$output .= '<td align="center" class="content_headline_pageurl" style="'.$height.'"><a href="'.$data['pageurl'].'" target="_blank">'.$data['pageurl'].'</a></td>';
		$output .= '<td align="center" class="content_headline_pageviews" style="'.$height.'">'.$data['pageview'].'</td>';
		$output .= '<td align="center" class="content_headline_date" style="'.$height.'">'.$data['date'].'</td>';
	$output .= "</tr>";
	}
return $output;
}
?>
<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en" xmlns="http://www.w3.org/1999/xhtml"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en" xmlns="http://www.w3.org/1999/xhtml"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en" xmlns="http://www.w3.org/1999/xhtml"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" xmlns="http://www.w3.org/1999/xhtml"> <!--<![endif]-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" lang="en" />
<title>WebStats &rsaquo; ADMIN PAGE &rsaquo; IP Track</title>
	<link rel="SHORTCUT ICON" type='image/x-icon' href="../images/favicon.ico"/>
	<link rel="apple-touch-icon" href="../images/favicon.png" />
  
	<!-- Included CSS Files (Compressed) -->
	<link rel="stylesheet" href="../stylesheets/foundation.css">
	<link rel="stylesheet" href="../stylesheets/app.css">
	<script src="javascripts/modernizr.foundation.js"></script>

	<!-- IE Fix for HTML5 Tags -->
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body style="background-color:rgb(228, 228, 228);">
<style>
.content_maintable{
			width:						660px; 
			border:						1px solid #333333; 
			background-image:			url(../images/table_bg.png);	
			margin: 					auto;
			min-height: 				100%;
			height:						auto !important;
			height:						100%;
			overflow:					hidden !important;	
}
.content_headline_num {
			font-size: 					14px; 
			font-weight: 				bold;
			height: 					25px;
			float:						left;
			width:						35px;
}
.content_headline_IP {
			font-size: 					14px; 
			font-weight: 				bold;
			height: 					25px;
			float:						left;
			width:						150px;
}
.content_headline_hostname {
			font-size: 					14px; 
			font-weight: 				bold;
			height: 					25px;
			float:						left;
			width:						250px;
}
.content_headline_location {
			font-size: 					14px; 
			font-weight: 				bold;
			height: 					25px;
			float:						left;
			width:320px;
}
.content_headline_referer {
			font-size: 					14px; 
			font-weight: 				bold;
			height: 					25px;
			float:						left;
			width:						280px;
}
.content_headline_pageurl {
			font-size: 					14px; 
			font-weight: 				bold;
			height: 					25px;
			float:						left;
			width:						300px;
}
.content_headline_pageviews {
			font-size: 					14px; 
			font-weight: 				bold;
			height: 					25px;
			float:						left;
			width:						80px;
}
.content_headline_date {
			font-size: 					14px; 
			font-weight: 				bold;
			height: 					25px;
			float:						left;
			width:						210px;
}
a:link {
			color:						black;
			text-decoration:			none;
        	font-weight: 				bold;
}

a:visited {
			color: 						black;
			text-decoration: 				none;
			font-weight: 					bold;
}
a:hover {
			color:						black;
			text-decoration: 				underline;
			font-weight: 					bold;				
}
</style>
<nav class="nav-bar">
	<li class="name"><a href="index.php">Admin Page</a></li>
</nav>
<div align="center">
	<h2>IP Track<br/>
    <?php echo ''.$ip.'  Welcome';?></h2>
</div>
<?php 
$DB = new DBConfig();$DB -> config();	$DB -> conn(WS_MySQL_DBHOST, WS_MySQL_USERNAME, WS_MySQL_PASSWORD, WS_MySQL_DB); 
?>
<div class="content_maintable" style="width:1700px;">
<table style="margin:auto;">
	<thead>
        <th align="left" class="content_headline_num" style="">Num:</th>
        <?php
		if($_GET['sort']!=='IPdesc'){
		?>
        	<th align="left" class="content_headline_IP"><a href="ip.php?sort=IPdesc">IP:</a></th>
        <?php }else{?>
        	<th align="left" class="content_headline_IP"><a href="ip.php?sort=IPasc">IP:</a></th>
        <?php }if($_GET['sort']!=='hostnamedesc'){?>
        	<th align="left" class="content_headline_hostname"><a href="ip.php?sort=hostnamedesc">Hostname:</a></th>
        <?php }else{?>
        	<th align="left" class="content_headline_hostname"><a href="ip.php?sort=hostnameasc">Hostname:</a></th>
		<?php }if($_GET['sort']!=='locationdesc'){?>
        	<th align="left" class="content_headline_location"><a href="ip.php?sort=locationdesc">Location:</a></th>
        <?php }else{?>
        	<th align="left" class="content_headline_location"><a href="ip.php?sort=locationasc">Location:</a></th>
        <?php }if($_GET['sort']!=='refererdesc'){?>
       		<th align="left" class="content_headline_referer"><a href="ip.php?sort=refererdesc">Referer:</a></th>
        <?php }else{?>
        	<th align="left" class="content_headline_referer"><a href="ip.php?sort=refererasc">Referer:</a></th>
        <?php }if($_GET['sort']!=='pageurldesc'){?>
        	<th align="left" class="content_headline_pageurl"><a href="ip.php?sort=pageurldesc">Page URL:</a></th>
        <?php }else{?>
        	<th align="left" class="content_headline_pageurl"><a href="ip.php?sort=pageurlasc">Page URL:</a></th>
        <?php }if($_GET['sort']!=='pageviewsdesc'){?>
        	<th align="left" class="content_headline_pageviews"><a href="ip.php?sort=pageviewsdesc">Page views:</a></th>
        <?php }else{?>
       		<th align="left" class="content_headline_pageviews"><a href="ip.php?sort=pageviewsasc">Page views:</a></th>
        <?php }if($_GET['sort']!=='datedesc'){?>
        	<th align="left" class="content_headline_date"><a href="ip.php?sort=datedesc">Date:</a></th>
        <?php }else{?>
        	<th align="left" class="content_headline_date"><a href="ip.php?sort=dateasc">Date:</a></th>
        <?php } ?>
        
	</thead>
		<?php

			if (isset($_GET["page"]) <= 0)
			{
				$page = '1';
			}
			if (isset($_GET["page"]) > 0)
			{	
				$page = $_GET["page"];
			}
			
			$start = $page * WS_CONFIG_PAGENUM - WS_CONFIG_PAGENUM;
			$end = WS_CONFIG_PAGENUM;
			
			$sort = $_GET['sort'];
			$IPs = get_IP_stats_order($sort, $start, $end);
			$IP_count = get_IP_stats_count();
			?>
            <tbody id="names" align="center">
            <?php
			for($i=0; $i < sizeof($IPs); $i++)
			{
				echo (server_IP_table($IPs[$i], $i+$start));
			}
			?>
            </tbody>
            </table>
			<?php
			
			echo "<div class='row' style='margin:auto;'>" . (get_pages($IP_count, $_GET['sort'])) . "</div>";
			$DB -> close();			
		?>
</div>
</body>
</html>

<?php }
else{
header("location:".adminPageURL());
	}
?>