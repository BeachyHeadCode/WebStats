<?php
define('ROOT', './');
require_once ROOT . 'include/version.php';
if (version_compare(PHP_VERSION, $required_php_version) >= 0){
	$Timer = MicroTime( true );
	if(file_exists('config/config.php'))
		include_once ROOT . 'config/config.php';
	else
		header("location:admin/setup-config.php");
	include_once ROOT . 'config/ini.php';
	include_once ROOT . 'legacy/decrypt.php';
	include_once ROOT . 'legacy/encrypt.php';
	include_once ROOT . 'language/en.php';
	require_once ROOT . "include/logonfunctions.php";
	require_once ROOT . 'include/functions.php';
	if(WS_CONFIG_3D_USER === false){rename("modules/player-image/full_player_image.php", "modules/player-image/full_player_image.off");}
	if(WS_CONFIG_3D_USER === true){rename("modules/player-image/full_player_image.off", "modules/player-image/full_player_image.php");}
	if($image_control == true) {include('modules/player-image/include/functions.php');}
	define('hover', 'style="cursor:url(images/cursors/hover.cur), auto;"');
	define('defaultt', 'cursor:url(images/cursors/default.cur), auto;');
	session_start();
	if(!empty($_POST["user"])) $test = strtolower($_POST['user']);
	$_SESSION['user']=$test;
	if(empty($_GET['mode'])) $_GET['mode'] = WS_CONFIG_MODULE;
	$_SESSION['mode']=$_GET['mode'];
	$_SESSION['page']['numbers']=$_POST['page']['numbers'];
if(iptracker === true){ // to be added to allow this to be toggled on and off withing the admin page
//Load the class
	$ipLite = new ip2location_lite;
	//$ipLite->setKey('29ec2adfa4bcfbbb7d96d934e800e512b6609fd7c3dee3264ad1c5a899165001');
//Get locations
	$locations = $ipLite->getCity($_SERVER['REMOTE_ADDR']);
//Getting the result
	
$location = $locations['countryCode'].",".$locations['regionName'].','.$locations['cityName'].','.$locations['zipCode'];
$country = $locations['regionName'];
$countrycode = $locations['countryCode'];
$city = $locations['cityName'];
$ip=$_SERVER['REMOTE_ADDR'];
$hostname=$_SERVER['REMOTE_HOST'];
$referer=$_SERVER['HTTP_REFERER'];
$pageurl=curPageURL();
$today = date("D M j G:i:s T Y");
$hostname=gethostbyaddr($_SERVER['REMOTE_ADDR']);

$result="SELECT * FROM stats WHERE IP='$ip'";	
	
	if (!$country){
		$country='UNKNOWN';
		$countrycode='XX';
		$city='(Unknown City?)';
		$zipcode='UNKNOWN';
		$location = $countrycode.",".$country.','.$city.','.$zipcode;
	}
$DB = new DBConfig();
$DB -> config();
$DB -> conn(WS_MySQL_DBHOST.":".WS_MySQL_PORT, WS_MySQL_USERNAME, WS_MySQL_PASSWORD, WS_MySQL_DB, true);

$query = mysql_query("SELECT * FROM `stats` WHERE IP='$ip'");
$field = mysql_fetch_array($query);
if(!isset($field[IP])){if(is_bot()){$bot=1;}else{$bot=0;}
		$data="INSERT INTO stats (IP, hostname, location, referer, pageurl, date, bot, country, countrycode, city, online) VALUES ('$ip', '$hostname', '$location', '$referer', '$pageurl', '$today', '$bot', '$country', '$countrycode', '$city', '0')";
		if (!mysql_query($data)){
			if(mysql_query("CREATE TABLE IF NOT EXISTS `stats` (
`ID` INT(11) NOT NULL AUTO_INCREMENT,
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
`online INT(1) NOT NULL COMMENT 'If the ip is online or not.',
PRIMARY KEY (`ID`),
UNIQUE KEY `ip` (`ip`),
KEY `countrycode` (`countrycode`)
) ENGINE `InnoDB` CHARACTER SET `ascii` COLLATE `ascii_general_ci`")){
				echo "table created :) \n";
			}else{ die('Error creating table: ' . mysql_error());}
		}
}
	$query = mysql_query("SELECT date FROM `stats` WHERE IP='$ip'");
	$date = mysql_fetch_array($query);
for($i=0; $i < count($field)/2; $i++){
	if($field[$i]==$ip){
		$pageview = "UPDATE stats SET pageview = pageview+1, online = 1 WHERE IP='$ip'";
		$update_date = "UPDATE stats SET date='$today' WHERE IP='$ip'";
		$currentpageurl = "UPDATE stats SET pageurl='$pageurl' WHERE IP='$ip'";
		$query = mysql_query("UPDATE stats SET dt=NOW() WHERE ip='$ip'");
		
		if (!mysql_query($update_date))die('Error on $update_date: ' . mysql_error());
		if (!mysql_query($pageview))die('Error on $pageview: ' . mysql_error());
		if (!mysql_query($currentpageurl))die('Error on $currentpageurl: ' . mysql_error());
	}
}
	$totalbotpageviews = "SELECT SUM(pageview) FROM stats WHERE bot='1'";
	$totalbotquery=mysql_query($totalbotpageviews);
	$totalbot =mysql_fetch_array($totalbotquery);
	
	$totalpageviews = "SELECT SUM(pageview) FROM stats WHERE bot='0'";
	$totalviewquery=mysql_query($totalpageviews);
	$total = mysql_fetch_array($totalviewquery);
	
	$queryentrie ="SELECT COUNT(pageview) FROM stats";
	$query = mysql_query($queryentrie);
	$row = mysql_fetch_array($query);
	mysql_query("UPDATE stats SET online = 0 WHERE dt<SUBTIME(NOW(),'0 0:10:0')");

	// Counting all the online visitors:
list($totalOnline) = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM stats WHERE online='1'"));

// Outputting the number as plain text:

$DB -> close();}

include("assets/header.php");
?>
<body class="off-canvas" style="background-repeat:repeat;text-align:center;color:#333322;background-attachment:fixed;background-image: url('images/background/bg_<?php echo (WS_CONFIG_BACKGROUND); ?>.png'); <?php echo (defaultt); ?>">
<?php
$ip=$_SERVER['REMOTE_ADDR'];
if(isset($_SESSION['pml_userid'])){
?>
<div class="admin-bar">
	<ul>
		<li class="name"><h1><a href="/admin">Admin Page</a></h1></li>
		<li class="toggle-topbar"><a href="#"></a></li>
	</ul>
	<section>
		<ul class="left">
		<li><a href="/admin/ip.php">IP Tracker</a></li>
    </ul>
	<ul class="left">
		<li><a href="/admin/?mode=settings">Settings</a></li>
	</ul>
	<ul class="right">
		<li><a href="/admin/?LOGOUT=TRUE">LOGOUT</a></li>
	</ul>
	</section>
</div>
<?php
}
else if($ip=='127.0.0.1' || $ip=='localhost' || $ip=='::1'){
?>
<div class="admin-bar">
	<ul>
		<li class="name"><h1><a href="/admin">Admin Page</a></h1></li>
		<li class="toggle-topbar"><a href="#"></a></li>
	</ul>
</div>
<?php } ?>
	<section id="sidebar" role="complementaryleft">
		<div onmousedown="return false;" onselectstart="return false;">
			<b>Ads</b>
		</div>
		<?php echo (WS_GOOGLE_ASIDE);?>
	</section>
<!-- SEARCH BAR -->
<div id="main" role="main" class="row" style="padding-bottom:50px"><!--Main Wrapper Start-->
	<div class="twelve columns centered" style="min-width:780px">
	<header id="header" class="row" style="margin-top:1cm;">
			<div class="twelve columns centered">
				<div class="row">
				<?php
				if(LOGOIMAGE === true)
					echo '<a href="'.WS_MAINSITE.'" '.hover.'><img src="'.WS_HOMEPAGE_LOGO.'" width="615px" height="100px" border="0"></a>';
				else{
					
					?><a href="#" data-reveal-id="serverModal" <?php echo (hover);?>><?php
					echo '<img id="pic" src="include/pic.php" />';
					?></a><?php
				}	
				?>
              <a href="#" data-reveal-id="serverModal"><div id="status"><?php require('include/online_status.php');?></div></a>
                <div id="serverModal" class="reveal-modal">
					<h2>Minecraft Server</h2>
					<p>
						<table>
							<tr><th><span>Minecraft Server: </span><?php echo MQ_SERVER_ADDR.":".MQ_SERVER_PORT?></th></tr>
							<tr><th><span>Teamspeak: </span></th></tr>
                        <?php    $minecraftServer = pingMineServ(MQ_SERVER_ADDR, MQ_SERVER_PORT);
								if($minecraftServer !== -1){?>
                            <tr><th><a href="include/minecraftquery/index.php"<span>Click Here For More Server Info</span></a><br/></th></tr>
                            <?php } ?>
						</table>
					</p>
					<a class="close-reveal-modal">&#215;</a>
				</div>
				</div>
				<div class="row">
					<div class="nine columns">
						<div name="Languages By Google" class="head_language">
							<div id="google_translate_element"></div>
							<script>
								function googleTranslateElementInit(){new google.translate.TranslateElement({pageLanguage: 'en',includedLanguages: 'en,fr,de,ko,ru,sk,es,sv',gaTrack: true,gaId: 'UA-27405484-1',layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');}
							</script>
							<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
						</div>
					</div>
					<div class="three column">
						<div class="head_language">
							<span>Drag to your bookmark bar:</span><br /><br />
							<a id="bookmarklet" href="<?php echo curPageURL();?>" <?php echo (hover);?> title="Drag to your bookmarks bar."><?php echo(WS_BOOKMARK);?></a>
						</div>
					</div>
				</div>
			</div>			    
	</header>
	<div class="row" style="background-image:url(../images/table_bg.png);border-right:2px solid #DDDDDD;border-left:2px solid #DDDDDD;padding-top:30px;">
		<?php include('assets/menu.php'); ?>
	</div>
	<div class="row" role="searchbar">
		<?php if($search_control == true)include('modules/search/index.php'); ?>
	</div>
	<section class="row main" style="min-width:780px">
   	  	<div class="ten columns centered">
		<?php
			include('modules/'.$_SESSION['mode'].'/config/config.php');
			include('modules/'.$_SESSION['mode'].'/include/functions.php');
			$db_host		= WS_CONFIG_DBHOST.":".WS_CONFIG_DBPORT;
			$db_user		= WS_CONFIG_DBUNAME;
			$db_pass		= WS_CONFIG_DBPASS; 
			$db				= WS_CONFIG_DBNAME;
			$createdb		= false;
			if (WS_CONFIG_NoMySQL != true) {$DB = new DBConfig();$DB -> config();$DB -> conn($db_host, $db_user, $db_pass, $db, $createdb);}
				include('modules/'.$_SESSION['mode'].'/index.php');
			if (WS_CONFIG_NoMySQL != true) {$DB -> close();}
			?>
		</div>
	</section>
    <footer class="row footer" style="clear:both">
		<br/>
		<div role="footerAD"><?php echo (WS_GOOGLE_FOOTER); ?></div>
		<div role="footerADMobile"><?php echo (WS_GOOGLE_FOOTER_MOBILE); ?></div>
		<p><em>
				<a href="http://cky2250.github.com/WebStats/" target="_blank">mrplows-server.us</a> &#169;<a href="http://adf.ly/5xvDw">Webstatistic v<?php include('include/version.php'); echo $version;?></a> for <a href="http://minecraft.net">Minecraft</a>
         		<?php if(date("Y") != '2011') {echo '2011-';}?>
         		<?php echo date("Y"); ?> 
				<a href="termsofuse.php">Terms Of Use</a>
       	</em>
		&nbsp;&nbsp;&nbsp; 
       	<span style="font-size:xx-small">(Loading time: <?php echo Number_Format( ( MicroTime( true ) - $Timer ), 4, '.', '' ); ?>s)</span>
		</p>
		<?php 
			$mcstats = false;
			if($mcstats === true){
				include_once("admin/test.php");
			}
			if (iptracker === true){
					echo"&nbsp;&nbsp;Users Online:&nbsp;".$totalOnline."&nbsp;&nbsp;Unique Views:&nbsp;".$row[0]."&nbsp;&nbsp;Total Views:&nbsp;".$total[0]."&nbsp;&nbsp;Total Bot Views:&nbsp;".$totalbot[0];
					if(isset($date[0]))
						echo"&nbsp;&nbsp;Your Last Visit Was - ".$date[0];
					else { echo '';}
			}
?>
	</footer>
	</div>
</div><!--Main Wrapper End-->
<section>
		<div role="searchsidebar">
		<?php if($search_control == true)include('modules/search/index.php'); ?>
		</div>
		<div onmousedown="return false;" onselectstart="return false;" role="complementaryright">
			<b>Ads</b>
			<?php echo (WS_GOOGLE_ASIDE);?>
		</div>
</section>
  <!-- Included JS Files (Uncompressed) -->
  <!--
  
  <script src="javascripts/jquery.js"></script>
  <script src="javascripts/jquery.foundation.mediaQueryToggle.js"></script>
  <script src="javascripts/jquery.foundation.forms.js"></script>
  <script src="javascripts/jquery.foundation.reveal.js"></script>
  <script src="javascripts/jquery.foundation.orbit.js"></script>
  <script src="javascripts/jquery.foundation.navigation.js"></script>
  <script src="javascripts/jquery.foundation.buttons.js"></script>
  <script src="javascripts/jquery.foundation.tabs.js"></script>
  <script src="javascripts/jquery.foundation.tooltips.js"></script>
  <script src="javascripts/jquery.foundation.accordion.js"></script>
  <script src="javascripts/jquery.placeholder.js"></script>
  <script src="javascripts/jquery.foundation.alerts.js"></script>
  <script src="javascripts/jquery.foundation.topbar.js"></script>
  <script src="javascripts/jquery.foundation.joyride.js"></script>
  <script src="javascripts/jquery.foundation.clearing.js"></script>
  <script src="javascripts/jquery.foundation.magellan.js"></script>
  
  -->
  
  <!-- Included JS Files (Compressed) -->
  <script src="javascripts/foundation.min.js"></script>
  <!-- Initialize JS Plugins -->
  <script src="javascripts/app.js"></script>
</body>
</html>
<?php 
	require('include/mcstats.php');
} else { ECHO ('Please install php version 5.2.5 or better!');}
?>