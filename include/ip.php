<?php
define('ROOT', '../');
include_once ROOT . 'config/config.php';
require_once ROOT . 'include/functions.php';
session_start();
if (iptracker === true) {
//Load the class
$ipLite = new ip2location_lite;
//Get locations
$locations = $ipLite->getCity($_SERVER['REMOTE_ADDR']);
//Getting the result
$location    = $locations['countryCode'].",".$locations['regionName'].','.$locations['cityName'].','.$locations['zipCode'];
$country     = $locations['regionName'];
$countrycode = $locations['countryCode'];
$city        = $locations['cityName'];
$ip          = $_SERVER['REMOTE_ADDR'];
$hostname    = $_SERVER['REMOTE_HOST'];
$referer     = $_SERVER['HTTP_REFERER'];
$pageurl     = curPageURL();
$today       = date("D M j G:i:s T Y");
$hostname    = gethostbyaddr($_SERVER['REMOTE_ADDR']);
if (!$country) {
	$country='UNKNOWN';
	$countrycode='XX';
	$city='(Unknown City?)';
	$zipcode='UNKNOWN';
	$location = $countrycode.",".$country.','.$city.','.$zipcode;
}
$failed = false;
if($persistent === true) {
	$link = mysqli_connect('p:'.WS_MySQL_DBHOST, WS_MySQL_USERNAME, WS_MySQL_PASSWORD, WS_MySQL_DB, WS_MySQL_PORT);
	if($link == false){
		echo '<script type="text/javascript">logError("Failed to connect.");</script>';
		$failed = true;
	}
} else {
	$link = mysqli_connect(WS_MySQL_DBHOST, WS_MySQL_USERNAME, WS_MySQL_PASSWORD, WS_MySQL_DB, WS_MySQL_PORT);
	if($link == false){
		echo '<script>logError("Failed to connect.");</script>';
		$failed = true;
	}
}
if(isset($_SESSION['pml_username'])) {
	$username = $_SESSION['pml_username'];
} else {
	$username = "default";
}

$field = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM `ip_stats` WHERE `IP`='$ip'"), MYSQLI_BOTH);
if(!isset($field["IP"]) and $failed === false) {
	if(is_bot()) {
		$bot=1;
	} else {
		$bot=0;
	}
	$data = "INSERT INTO `ip_stats` (username, IP, hostname, location, referer, pageurl, date, bot, country, countrycode, city, online) VALUES ('$username', '$ip', '$hostname', '$location', '$referer', '$pageurl', '$today', '$bot', '$country', '$countrycode', '$city', '0')";
	if (!mysqli_query($link, $data)) {
		if(mysqli_query($link, "CREATE TABLE IF NOT EXISTS `ip_stats` (
`ID` INT AUTO_INCREMENT primary key,
`username` VARCHAR(40) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'If a stats plugin recoreds the user ingame name with IP.',
`IP` VARCHAR(40) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'This is very accurate, since it is decided by PHP. It is unknown to wether it will record IPv6.',
`hostname` VARCHAR(500) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'This is decided by PHP, so this is very accurate but may go too far and give the ISP hostname for the IP.',
`location` VARCHAR(500) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'This code is taken from an outside source and is not know to be correct or incorrect.',
`referer` VARCHAR(500) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'This url may not show 100% of the time, for the most part it is due to a direct execution to the site by the user.',
`pageurl` VARCHAR(500) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'This url is very acurate since the code resides from that location (dynamicly).',
`date` VARCHAR(200) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'This is the current date for which the user has viewed the page.',
`pageview` INT(9) NOT NULL DEFAULT '1' COMMENT 'This value is developed by every click that the IP has viewed the site pages monitored by this code.',
`bot` INT(1) NOT NULL COMMENT 'This value is decided by a list of known bot urls and IPs that have been set.',
`country` varchar(64) collate utf8_unicode_ci NOT NULL default '' COMMENT 'What Country they are from.',
`countrycode` varchar(2) collate utf8_unicode_ci NOT NULL default '' COMMENT 'What Country code they are from.',
`city` varchar(64) collate utf8_unicode_ci NOT NULL default '' COMMENT 'What City they are from.',
`dt` timestamp NOT NULL default CURRENT_TIMESTAMP COMMENT 'Current timestamp.',
`online` INT(1) NOT NULL COMMENT 'If the ip is online or not.',
UNIQUE KEY (`IP`),
KEY `countrycode` (`countrycode`)
) ENGINE `InnoDB` CHARACTER SET `ascii` COLLATE `ascii_general_ci`")) {
$TABLESET = true;
		} else {
			ws_die('Error creating `ip_stats` table: '.mysqli_error($link), "MySQL Error");
		}
	}
}
$query = mysqli_query($link, "SELECT `date` FROM `ip_stats` WHERE `IP`='$ip'");
$date = mysqli_fetch_array($query, MYSQLI_NUM);
for($i=0; $i < count($field)/2; $i++){
	if($field[$i]==$ip) {
		$pageview = "UPDATE `ip_stats` SET `username`='$username', `date`='$today', `dt`=NOW(), `pageurl`='$pageurl', `pageview`=`pageview`+1, `online` = 1 WHERE `IP`='$ip'";
		if (!mysqli_query($link, $pageview)) ws_die('Error on $pageview: '.mysqli_error($link), "MySQL Error");
	}
}
$query = mysqli_query($link, "SELECT SUM(IF(`bot`='0', NULL, `pageview`)), SUM(IF(`bot`='1', NULL, `pageview`)), COUNT(`pageview`) FROM `ip_stats`");
$row = mysqli_fetch_array($query, MYSQLI_NUM);

mysqli_query($link, "UPDATE `ip_stats` SET `online` = 0 WHERE `dt`<SUBTIME(NOW(),'0 0:10:0')");

// Counting all the online visitors:
list($totalOnline) = mysqli_fetch_array(mysqli_query($link, "SELECT COUNT(`IP`) FROM `ip_stats` WHERE `online`='1'"), MYSQLI_BOTH);
// Outputting the number as plain text:
mysqli_close($link);

echo "<span class='onlineWidget'><div class='live_panel'><img class='preloader1' src='images/ajax-loaders/preloader.gif' alt='Loading..' width='22' height='22' /></div>Users Online:&nbsp;".$totalOnline."</span>&nbsp;&nbsp;Unique Views:&nbsp;".$row[2]."&nbsp;&nbsp;Total Views:&nbsp;".$row[1]."&nbsp;&nbsp;Total Bot Views:&nbsp;".$row[0];
if(isset($date[0]))
	echo"&nbsp;&nbsp;Your Last Visit Was - ".$date[0];
else
	echo '';
} else {
	echo '';
}
?>