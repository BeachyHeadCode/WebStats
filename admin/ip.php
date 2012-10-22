<?php
	error_reporting(E_ALL^E_NOTICE);
	$ip=$_SERVER['REMOTE_ADDR'];
	if($_SEESION['LOGINTEST'] == 'on' || $ip=='127.0.0.1' || $ip=='localhost' || $ip=='::1')
	{
	if(file_exists('../config/config.php'))
		include('../config/config.php');
	else
		header("admin/install/");
	define('IP_CONFIG_DBNAME', 'stats');
	class DBConfig {
		var $db;
		var $db_link;
		var $conn = false;
		var $persistant = false;
		public $error = false;
		public function config(){
			$this->error = true;
			$this->persistant = false;
		}
		function conn()
		{
			$this->host = WS_CONFIG_DBHOST.":".WS_CONFIG_DBPORT;
			$this->user = IP_CONFIG_DBUNAME;
			$this->pass = WS_CONFIG_DBPASS;
			$db=WS_CONFIG_DBNAME;
			$this->db = $db;
    
			// Establish the connection.
			if ($this->persistant)
				$this->db_link = mysql_pconnect($this->host, $this->user, $this->pass, true);
			else 
				$this->db_link = mysql_connect($this->host, $this->user, $this->pass, true);
 
			if (!$this->db_link) {
				if ($this->error) {
					$this->error($type=1);
				}
				return false;
			}
			else {
				if (empty($db)) {
					if ($this->error) {
						$this->error($type=2);
					}
				}
				else {
					$db = mysql_select_db($this->db, $this->db_link); // select db
					if (!$db) {
						if ($this->error) {
							$this->error($type=2);
						}
						return false;
					}
					$this -> conn = true;
				}
				return $this->db_link;
			}
		}
		
		// close connection
		function close() 
		{ 
			if ($this -> conn){ // check connection
				if ($this->persistant) {
					$this -> conn = false;
				}
				else {
					mysql_close($this->db_link);
					$this -> conn = false;
				}
			}
			else {
				if ($this->error) {
					return $this->error($type=4);
				}
			}
		}
		public function error($type=''){ //Choose error type
			if (empty($type)) {
				return false;
			}
			else {
				if ($type==1)
					echo "<strong>Database could not connect</strong> ";
				else if ($type==2)
					echo "<strong>mysql error</strong> " . mysql_error();
				else if ($type==3)
					echo "<strong>error </strong>, Proses has been stopped";
				else
					echo "<strong>error </strong>, no connection !!!";
			}
		}
	}
	
	
	
	
	
	
	
	
	function get_pages($numbers, $sort)
	{
		$pages = '<a href="ip.php?page=1&sort='.$sort.'" '.hover.' >1</a>';
		$numbers = $numbers / WS_CONFIG_PAGENUM;
		for($i=1; $i < $numbers; $i++)
		{
			$page = $i + 1;
			$pages .= ', <a href="ip.php?page='.$page.'&sort='.$sort.'" '.hover.' >'.$page.'</a>';
		}	
		$output = '<div style="clear:both; width:710px; padding-left:40px; height:55px; vertical-align:middle; text-align:left"><br /><b><u>Page(s)</u>: '.$pages.'</b></div>';
		return $output;
	}
//SETS NUMBER OF USERS TO PRINT
function get_IP_stats_count()
{
	$query = mysql_query("SELECT COUNT(IP) FROM stats");
	$row = mysql_fetch_array($query);
	return $row[0];
}

//SETS THE STATS ORDER AND PAGE NUMBERS
function get_IP_stats_order($sort, $start, $end)
{
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
function server_IP_table($IP, $pos)
{
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" lang="en" />
<title>IP Track</title>
</head>
<body>
<style>
body{
	background-color:rgb(228, 228, 228);
}
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
			border:						1px dotted #888888;
			height: 					25px;
			float:						left;
			width:						35px;
}
.content_headline_IP {
			font-size: 					14px; 
			font-weight: 				bold; 
			border:						1px dotted #888888;
			height: 					25px;
			float:						left;
			width:						150px;
}
.content_headline_hostname {
			font-size: 					14px; 
			font-weight: 				bold; 
			border:						1px dotted #888888;
			height: 					25px;
			float:						left;
			width:						250px;
}
.content_headline_location {
			font-size: 					14px; 
			font-weight: 				bold; 
			border:						1px dotted #888888;
			height: 					25px;
			float:						left;
			width:320px;
}
.content_headline_referer {
			font-size: 					14px; 
			font-weight: 				bold; 
			border:						1px dotted #888888;
			height: 					25px;
			float:						left;
			width:						280px;
}
.content_headline_pageurl {
			font-size: 					14px; 
			font-weight: 				bold; 
			border:						1px dotted #888888;
			height: 					25px;
			float:						left;
			width:						300px;
}
.content_headline_pageviews {
			font-size: 					14px; 
			font-weight: 				bold; 
			border:						1px dotted #888888;
			height: 					25px;
			float:						left;
			width:						80px;
}
.content_headline_date {
			font-size: 					14px; 
			font-weight: 				bold; 
			border:						1px dotted #888888;
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
<div align="left"><a href="index.php">Home</a></div>
<div align="center">
	<h2>IP Track<br/>
    <?php echo ''.$ip.'  Welcome';?></h2>
</div>
<?php 
$DB = new DBConfig();$DB -> config();$DB -> conn(); 
?>
<div class="content_maintable" style="width:1700px;">
<table>
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
			echo (get_pages($IP_count, $_GET['sort']));
			$DB -> close();			
		?>
</div>
</body>
</html>

<?php }
else{
header("location:admin/");
	}
?>