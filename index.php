<?php
if (version_compare(PHP_VERSION, '5.2.4') >= 0)
{
	$start_time = explode(" ",microtime()); 
	$start_time = $start_time[1] + $start_time[0]; 	
	if(file_exists('config/config.php'))
		include('config/config.php');
	else
		header("location:admin/install/setup-config.php");
	include('config/ini.php');
	include('legacy/decrypt.php');
	include('legacy/encrypt.php');
	include('language/en.php');
	include('include/functions.php');
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

if(iptracker === true) // to be added to allow this to be toggled on and off withing the admin page
{	
	final class ip2location_lite{
	protected $errors = array();
	protected $service = 'api.ipinfodb.com';
	protected $version = 'v3';
	protected $apiKey = '29ec2adfa4bcfbbb7d96d934e800e512b6609fd7c3dee3264ad1c5a899165001';

	public function __construct(){}
	public function __destruct(){}
	public function setKey($key){
		if(!empty($key)) $this->apiKey = $key;
	}
	public function getError(){
		return implode("\n", $this->errors);
	}
	public function getCountry($host){
		return $this->getResult($host, 'ip-country');
	}
	public function getCity($host){
		return $this->getResult($host, 'ip-city');
	}
	private function getResult($host, $name){
		$ip = @gethostbyname($host);

		if(preg_match('/^(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)(?:[.](?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)){3}$/', $ip)){
			$xml = @file_get_contents('http://' . $this->service . '/' . $this->version . '/' . $name . '/?key=' . $this->apiKey . '&ip=' . $ip . '&format=xml');

			try{
				$response = @new SimpleXMLElement($xml);

				foreach($response as $field=>$value){
					$result[(string)$field] = (string)$value;
				}

				return $result;
			}
			catch(Exception $e){
				$this->errors[] = $e->getMessage();
				return;
			}
		}
		$this->errors[] = '"' . $host . '" is not a valid IP address or hostname.';
		return;
	}
}
//Load the class
	$ipLite = new ip2location_lite;
	$ipLite->setKey('29ec2adfa4bcfbbb7d96d934e800e512b6609fd7c3dee3264ad1c5a899165001');
//Get locations
	$locations = $ipLite->getCity($_SERVER['REMOTE_ADDR']);
//Getting the result
	
$location = $locations['countryCode'].",".$locations['regionName'].','.$locations['cityName'].','.$locations['zipCode'];
$ip=$_SERVER['REMOTE_ADDR'];
$hostname=$_SERVER['REMOTE_HOST'];
$referer=$_SERVER['HTTP_REFERER'];
$pageurl=curPageURL();
$today = date("D M j G:i:s T Y");
$hostname=gethostbyaddr($_SERVER['REMOTE_ADDR']);

$result="SELECT * FROM stats WHERE IP='$ip'";	

$db_host		= WS_CONFIG_DBHOST.":".WS_CONFIG_DBPORT;
$db_user		= WS_CONFIG_DBUNAME;
$db_pass		= WS_CONFIG_DBPASS; 
$ws_stats		= 'WebStats';

$link = @mysql_connect($db_host,$db_user,$db_pass) or die('Unable to establish a connection');
mysql_set_charset('ascii');

//CHANGED DATABASE TO "WebStats"
	$test_db =	mysql_select_db($ws_stats,$link);
	if(!$test_db)
	{
		if(mysql_query("CREATE DATABASE IF NOT EXISTS `WebStats`",$link))
		{
			echo "Database created :) \n";
		}
		else
		{
			echo "Error creating database: " . mysql_error();
		}
	}
	$query = mysql_query($result,$link);
	$field = mysql_fetch_array($query);

if(!isset($field[IP])){
		if(is_bot()){
			$bot=1;
		}
		else{
			$bot=0;
		}
		$data="INSERT INTO stats (IP, hostname, location, referer, pageurl, date, bot) VALUES ('$ip', '$hostname', '$location', '$referer', '$pageurl', '$today' ,'$bot')";
		if (!mysql_query($data,$link))
		{
			if(mysql_query("CREATE TABLE IF NOT EXISTS `stats` (
`ID` INT(11) NOT NULL AUTO_INCREMENT,
`IP` VARCHAR(40) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'This is very accurate, since it is decided by PHP. It is unknown to wether it will record IPv6.',
`hostname` VARCHAR(500) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'This is decided by PHP, so this is very accurate but may go too far and give the ISP hostname for the IP.',
`location` VARCHAR(500) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'This code is taken from an outside source and is not know to be correct or incorrect.',
`referer` VARCHAR(500) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'This url may not show 100% of the time, for the most part it is due to a direct execution to the site by the user.',
`pageurl` VARCHAR(500) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'This url is very acurate since the code resides from that location (dynamicly).',
`date` VARCHAR(200) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'This is the current date for which the user has viewed the page.',
`pageview` INT(9) NOT NULL DEFAULT '1' COMMENT 'This value is developed by every click that the IP has viewed the site pages monitored by this code.',
`bot` INT(1) NOT NULL COMMENT 'This value is decided by a list of known bot urls and IPs that have been set.',
PRIMARY KEY (`ID`)
) ENGINE `InnoDB` CHARACTER SET `ascii` COLLATE `ascii_general_ci`",$link))
			{
				echo "table created :) \n";
			}
			else
			{
				die('Error creating table: ' . mysql_error());
			}
		}
}
	$query = mysql_query("SELECT date FROM stats WHERE IP='$ip'",$link);
	$date = mysql_fetch_array($query);
for($i=0; $i < count($field)/2; $i++)
{
	if($field[$i]==$ip)
	{
		$pageview = "UPDATE stats SET pageview = pageview+1 WHERE IP='$ip'";
		$update_date = "UPDATE stats SET date='$today' WHERE IP='$ip'";
		$currentpageurl = "UPDATE stats SET pageurl='$pageurl' WHERE IP='$ip'";
		if (!mysql_query($update_date,$link))
		{
			die('Error: ' . mysql_error());
		}
		if (!mysql_query($pageview,$link))
		{
			die('Error: ' . mysql_error());
		}
		if (!mysql_query($currentpageurl,$link))
		{
			die('Error: ' . mysql_error());
		}
	}
}
	$totalbotpageviews = "SELECT SUM(pageview) FROM stats WHERE bot='1'";
	$totalbotquery=mysql_query($totalbotpageviews,$link);
	$totalbot =mysql_fetch_array($totalbotquery);
	
	$totalpageviews = "SELECT SUM(pageview) FROM stats WHERE bot='0'";
	$totalviewquery=mysql_query($totalpageviews,$link);
	$total = mysql_fetch_array($totalviewquery);
	
	$queryentrie ="SELECT COUNT(pageview) FROM stats";
	$query = mysql_query($queryentrie,$link);
	$row = mysql_fetch_array($query);

}
// mysql_close($link) needs to be after if close
mysql_close($link)

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en" xmlns="http://www.w3.org/1999/xhtml"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en" xmlns="http://www.w3.org/1999/xhtml"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en" xmlns="http://www.w3.org/1999/xhtml"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" xmlns="http://www.w3.org/1999/xhtml"> <!--<![endif]-->
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
	
	<!-- Set the viewport width to device width for mobile -->
	<meta name="viewport" content="width=device-width" />
  
	<meta name="author" lang="en" content="cky2250 (admin@mrplows-server.us)" />
	<meta content='minecraft stats' name='description' />
	<meta name="keywords" content="minecraft, stats, bukkit, mrplow, cky2250, html5, foundation" />
	<meta name="copyright" content="mrplows-server.us Copyright (c) 2012" />
	<title><?php echo (WS_OPTICAL_TAB_TITLE);?></title>
	<link rel="stylesheet" type="text/css" href="css/layout.css"/>
	<!-- Set the viewport width to device width for mobile -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<!-- For third-generation iPad with high-resolution Retina display: -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/favicons/apple-touch-icon-144x144-precomposed.png">
	<!-- For iPhone with high-resolution Retina display: -->
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/favicons/apple-touch-icon-114x114-precomposed.png">
	<!-- For first- and second-generation iPad: -->
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/favicons/apple-touch-icon-72x72-precomposed.png">
	<!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
	<link rel="apple-touch-icon-precomposed" href="images/favicon.png">
	<!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
	<link rel="icon" href="images/favicon.ico" type="image/x-icon" />
  
	<!-- Included CSS Files (Uncompressed) -->
	<!--
	<link rel="stylesheet" href="stylesheets/foundation.css">
	-->
	<!-- Included CSS Files (Compressed) -->
	<link rel="stylesheet" href="stylesheets/foundation.min.css">
	<link rel="stylesheet" href="stylesheets/app.css">

	<script src="javascripts/modernizr.foundation.js"></script>

	<!-- IE Fix for HTML5 Tags -->
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js'></script>
    <script type="text/javascript" src="javascripts/jquery.easing.1.3.js"></script>
	<script type='text/javascript' src="javascripts/jquery-cookie.min.js"></script>              
</head>
<body class="off-canvas" style="background-repeat:repeat;text-align:center;color:#333322;background-attachment:fixed;background-image: url('images/background/bg_<?php echo (WS_CONFIG_BACKGROUND); ?>.png'); <?php echo (defaultt); ?>">

	<section id="sidebar" role="complementaryleft">
		<div onmousedown="return false;" onselectstart="return false;">
			<b>Ads</b>
		</div>
		<?php echo (WS_GOOGLE_ASIDE);?>
	</section>
<!-- SEARCH BAR -->
<div id="main" role="main" class="row"><!--Main Wrapper Start-->
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
							<tr><th><span>Minecraft Server:</span><br/><?php echo MQ_SERVER_ADDR.":".MQ_SERVER_PORT?></th></tr>
							<tr><th><span>Teamspeak:</span><br/></th></tr>
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
					<div class="ten columns">
						<div name="Languages By Google" class="head_language">
							<div id="google_translate_element"></div>
							<script>
								function googleTranslateElementInit(){new google.translate.TranslateElement({pageLanguage: 'en',includedLanguages: 'en,fr,de,ko,ru,sk,es,sv',gaTrack: true,gaId: 'UA-27405484-1',layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');}
							</script>
							<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
						</div>
					</div>
					<div class="two column">
						<div class="head_language">
							<span>Drag to your bookmark bar:</span><br />
							<a id="bookmarklet" href="<?php echo curPageURL();?>" <?php echo (hover);?> title="Drag to your bookmarks bar."><?php echo(WS_BOOKMARK);?></a>
						</div>
					</div>
				</div>
			</div>			    
	</header>
	<div class="row" style="background-image:url(../images/table_bg.png);border-right:2px solid #DDDDDD;border-left:2px solid #DDDDDD;">
		<?php include('include/menu.php'); ?>
	</div>
	<div class="row" role="searchbar">
		<?php if($search_control == true)include('modules/search/index.php'); ?>
	</div>
	<section class="row main" style="min-width:780px">
   	  	<div class="ten columns centered">
		<?php
			include('modules/'.$_SESSION['mode'].'/config/config.php');
			include('modules/'.$_SESSION['mode'].'/include/functions.php');
			if (WS_CONFIG_NoMySQL != true) {$DB = new DBConfig();$DB -> config();$DB -> conn();}
				include('modules/'.$_SESSION['mode'].'/index.php');
			if (WS_CONFIG_NoMySQL != true) {$DB -> close();}
			$time_end = explode(" ",microtime());
			$time_end = $time_end[1] + $time_end[0];
			$speed = $time_end - $start_time;
			$speed = substr($speed,0,8);
			?>
		</div>
	</section>
    <footer class="row footer" style="clear:both">
		<br/>
		<div role="footerAD"><?php echo (WS_GOOGLE_FOOTER); ?></div>
		<div role="footerADMobile"><?php echo (WS_GOOGLE_FOOTER_MOBILE); ?></div>
		<p><em>
				<a href="http://mrplows-server.us" target="_blank">mrplows-server.us</a> &#169;<a href="http://adf.ly/5xvDw">Webstatistic v<?php include('include/version.php'); echo $version;?></a> for <a href="http://minecraft.net">Minecraft</a>
         		<?php if(date("Y") != '2011') {echo '2011-';}?>
         		<?php echo date("Y"); ?> 
				<a href="termsofuse.php">Terms Of Use</a>
       	</em>
		&nbsp;&nbsp;&nbsp; 
       	<span style="font-size:xx-small">(Loading time: <?php echo $speed; ?>s)</span>
		</p>
		<?php 
	//		if (iptracker === true)
	//				echo"&nbsp;&nbsp;Unique Views:&nbsp;".$row[0]."&nbsp;&nbsp;Total Views:&nbsp;".$total[0]."&nbsp;&nbsp;Total Bot Views:&nbsp;".$totalbot[0];
	//				if(isset($date[0]))
	//					echo"&nbsp;&nbsp;Your Last Visit Was - ".$date[0];
	//				else
	//				{ echo '';}
	//		}
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
  <script src="javascripts/modernizr.foundation.js"></script>
  <script src="javascripts/jquery.js"></script>
  <script src="javascripts/jquery.foundation.mediaQueryToggle.js"></script>
  <script src="javascripts/jquery.foundation.reveal.js"></script>
  <script src="javascripts/jquery.foundation.orbit.js"></script>
  <script src="javascripts/jquery.foundation.navigation.js"></script>
  <script src="javascripts/jquery.foundation.buttons.js"></script>
  <script src="javascripts/jquery.foundation.tabs.js"></script>
  <script src="javascripts/jquery.foundation.forms.js"></script>
  <script src="javascripts/jquery.foundation.tooltips.js"></script>
  <script src="javascripts/jquery.foundation.accordion.js"></script>
  <script src="javascripts/jquery.placeholder.js"></script>
  <script src="javascripts/jquery.foundation.alerts.js"></script>
  -->
  <!-- Included JS Files (Compressed) -->
  <script src="javascripts/foundation.min.js"></script>
  <!-- Initialize JS Plugins -->
  <script src="javascripts/app.js"></script>
</body>
</html>
<?php } else echo 'Please install php version 5.2.5 or better!'; ?>
