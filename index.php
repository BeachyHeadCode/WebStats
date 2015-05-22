<?php
define('ROOT', './');
define('layout','css/layout.css');
require_once ROOT . 'include/version.php';
if (version_compare(PHP_VERSION, $required_php_version) >= 0) {
	$Timer = MicroTime( true );
	if(file_exists(ROOT . 'config/config.php'))
		include_once ROOT . 'config/config.php';
	else
		header("location:admin/setup-config.php");
	include_once ROOT . 'config/ini.php';
	include_once ROOT . 'legacy/decrypt.php';
	include_once ROOT . 'legacy/encrypt.php';
	include_once ROOT . 'language/en.php';
	require_once ROOT . "include/logonfunctions.php";
	require_once ROOT . 'include/functions.php';
	session_start();
	if(!empty($_POST["user"])) $_SESSION['user']=strtolower($_POST['user']);
	if(empty($_GET['mode'])) $_GET['mode'] = WS_CONFIG_MODULE;
	$_SESSION['mode']=$_GET['mode'];
	$_SESSION['page']['numbers']=$_POST['page']['numbers'];
if(iptracker === true) {
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
			echo '<script>console.error("Failed to connect.");</script>';
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
}
header('Cache-control: max-age='.(60*60*24*365));
include_once ROOT . "assets/header.php";
?>
<body class="off-canvas" style="background-image: url('images/background/bg_<?php echo (WS_CONFIG_BACKGROUND); ?>.png');">
<?php if($TABLESET === true) : ?>
	<script type="text/javascript">
	$(document).ready(function() {
		$("#tableCreated").reveal();
	});
	</script>
	<div id="tableCreated" class="reveal-modal">
		<p>Table Created!</p>
		<a class="close-reveal-modal">&#215;</a>
	</div>
<?php endif;
$ip=$_SERVER['REMOTE_ADDR'];
if(isset($_SESSION['pml_userid']) && $_SESSION['pml_userrank']=='1') :
?>
<!-- ADMIN BAR -->
<div class="admin-bar fixed">
	<nav class="top-bar" data-topbar role="navigation">
		<ul class="title-area">
			<li class="name"><h1><a href="admin/">Admin Page</a></h1></li>
			<!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
			<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
		</ul>
		<section class="top-bar-section">
			<ul class="left">
				<li><a href="admin/?mode=ip">IP Tracker</a></li>
			</ul>
			<ul class="left">
				<li><a href="admin/?mode=settings">Settings</a></li>
			</ul>
			<ul class="right">
				<li><a href="admin/?LOGOUT=TRUE">LOGOUT</a></li>
			</ul>
		</section>
	</nav>
</div>
<?php elseif($ip=='127.0.0.1' || $ip=='localhost' || $ip=='::1' || '192.168.1.1') : ?>
<!-- ADMIN BAR -->
<div class="admin-bar fixed">
	<nav class="top-bar" data-topbar role="navigation">
		<ul class="title-area">
			<li class="name"><h1><a href="admin">Admin Page</a></h1></li>
		</ul>
	</nav>
</div>
<?php endif; if(ads === true) : ?>
<section id="sidebar" role="complementaryleft">
	<div onmousedown="return false;" onselectstart="return false;">
		<b>Ads</b>
	</div>
	<?php echo WS_GOOGLE_ASIDE;?>
</section>
<?php endif; ?>
<!--Main Wrapper Start-->
<div id="main" role="main" style="padding-bottom:50px">
	<!--Header-->
	<header id="header" class="row header">
		<div class="row">
			<div class="large-12 large-centered columns">
				<?php
				if(LOGOIMAGE === true) {
					echo '<center><a href="'.WS_MAINSITE.'"><img src="'.WS_HOMEPAGE_LOGO.'" width="615px" height="100px" border="0" /></a></center>';
				} else {
					
					?><center><a href="#" data-reveal-id="serverModal"><img id="pic" /></a></center><?php
				}
				?>
				<!--Reveal Modal-->
				<a href="#" data-reveal-id="serverModal"><div id="status"><?php require('include/online_status.php'); ?></div></a>
				<div id="serverModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
					<h2 id="modalTitle">Minecraft Server</h2>
					<p class="lead">
						<b>Minecraft Server: </b><?php echo MQ_SERVER_ADDR.":".MQ_SERVER_PORT; ?>
						<br />
						<b>Teamspeak: </b>
							<?php
								$minecraftServer = pingMineServ(MQ_SERVER_ADDR, MQ_SERVER_PORT);
								if($minecraftServer !== -1) :
							?>
							<a href="include/minecraftquery/index.php" target="_blank">Click Here For More Server Info</a>
							<?php endif; ?>
					</p>
					<a class="close-reveal-modal" aria-label="Close">&#215;</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="small-8 columns">
				<br />
				<div name="Languages By Google" class="head_language">
					<div id="google_translate_element"></div>
					<script>
						function googleTranslateElementInit(){new google.translate.TranslateElement({pageLanguage: 'en',includedLanguages: 'en,fr,de,ko,ru,sk,es,sv',gaTrack: true,gaId: 'UA-27405484-1',layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');}
					</script>
					<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
				</div>
			</div>
			<?php if(bookmark === true) {?>
			<div class="small-3 large-offset-1 columns show-for-medium-up">
					<span>Drag to your bookmark bar:</span><br />
					<a id="bookmarklet" href="<?php echo curPageURL();?>" title="Drag to your bookmarks bar."><?php echo WS_BOOKMARK;?></a>
			</div>
			<?php }?>
		</div>
	</header>

	<!--Menu-->
	<div class="row" style="border-right:2px solid #DDDDDD;border-left:2px solid #DDDDDD;">
		<?php include('assets/menu.php'); ?>
	</div>

	<?php if($search_control === true && WS_CONFIG_SEARCH_BAR === true) { ?>
	<!--Search Bar for Mobile-->
	<div class="row" role="searchbar">
		<?php include('include/search/index.php'); ?>
	</div>
	<?php } ?>

	<section class="row main">
   	  	<div class="small-12 small-centered columns" id="modules">
			<?php
			if(file_exists(ROOT . 'modules/'.$_SESSION['mode'].'/index.php')) {
				if($image_control == true) {
					include('include/player-image/include/functions.php');
				}
				include_once ROOT . 'modules/'.$_SESSION['mode'].'/config/config.php';
				include_once ROOT . 'modules/'.$_SESSION['mode'].'/include/functions.php';
				if ($WS_CONFIG_NoMySQL != true) {
					if($persistent === true) {
						$link = mysqli_connect('p:'.WS_CONFIG_DBHOST, WS_CONFIG_DBUNAME, WS_CONFIG_DBPASS, WS_CONFIG_DBNAME, WS_CONFIG_DBPORT);
					} else {
						$link = mysqli_connect(WS_CONFIG_DBHOST, WS_CONFIG_DBUNAME, WS_CONFIG_DBPASS, WS_CONFIG_DBNAME, WS_CONFIG_DBPORT);
					}
				}
				include_once ROOT . 'modules/'.$_SESSION['mode'].'/index.php';
				if ($WS_CONFIG_NoMySQL != true) {mysqli_close($link);}
			} else {include_once ROOT . 'assets/404.html'; }
			?>
		</div>
	</section>

	<!-- Footer -->
	<footer class="row footer">
		<center>
		<?php if(ads === true) { ?><div role="footerAD"><?php echo (WS_GOOGLE_FOOTER); ?></div>
		<div role="footerADMobile"><?php echo (WS_GOOGLE_FOOTER_MOBILE); ?></div><?php }?>
		<p>
			<em>
				<a href="https://nicholas-smith.tk/webstats/" target="_blank">nicholas-smith.tk</a> &#169;<a href="http://bukkit.org/threads/web-webstatistic-for-minecraft-v3-1-mrplows.60843/" target="_blank" title="[WEB] Webstatistic for Minecraft">Webstatistic v<?php include('include/version.php'); echo $version;?></a> for <a href="https://minecraft.net" target="_blank" title="Minecraft">Minecraft</a>
         		<?php if(date("Y") != '2011') {echo '2011-';}?>
         		<?php echo date("Y"); ?> 
				<a href="termsofuse.php">Terms Of Use</a>
			</em>
			&nbsp;&nbsp;&nbsp; 
			<span style="font-size:xx-small">(Loading time: <?php echo Number_Format( ( MicroTime( true ) - $Timer ), 4, '.', '' ); ?>s)</span>
		</p>
		<?php
		if (iptracker === true) {
			echo "<span class='onlineWidget'><div class='live_panel'><img class='preloader1' src='images/ajax-loaders/preloader.gif' alt='Loading..' width='22' height='22' /></div>Users Online:&nbsp;".$totalOnline."</span>&nbsp;&nbsp;Unique Views:&nbsp;".$row[2]."&nbsp;&nbsp;Total Views:&nbsp;".$row[1]."&nbsp;&nbsp;Total Bot Views:&nbsp;".$row[0];
			if(isset($date[0]))
				echo"&nbsp;&nbsp;Your Last Visit Was - ".$date[0];
			else
				echo '';
		}
		?>
		</center>
	</footer>
</div>
<!--Main Wrapper End-->

<!--Side Bar Right-->
<section>
	<?php if($search_control == true && WS_CONFIG_SEARCH_BAR === true) {?>
	<!-- SEARCH BAR -->
	<div role="searchsidebar">
		<?php include ROOT . 'include/search/index.php'; ?>
	</div>
	<?php } if (internetprotest === true && ads === true) { ?>
	<div onmousedown="return false;" onselectstart="return false;" role="complementaryright">
	<?php if (internetprotest === true) {?>
		<a href="http://internetdefenseleague.org"><img src="http://internetdefenseleague.org/images/badges/final/banner_right.png" alt="Member of The Internet Defense League" /></a>
	<?php }?>
		<?php if(ads === true) {?>
		<b>Ads</b>
		<?php echo WS_GOOGLE_ASIDE;}?>
	</div><?php }?>
</section>

	<!--Included JS Files (Compressed)-->
	<script src="js/foundation.min.js"></script>
	<!--Initialize JS Plugins-->
	<!-- library for cookie management -->
	<script src="js/vendor/jquery.cookie.js"></script>
	<!-- data table plugin -->
	<script src='js/vendor/jquery.dataTables.min.js'></script>
	<!-- history.js for cross-browser state change on ajax -->
	<script src="js/vendor/jquery.history.js"></script>
	<!--Migrate older jQuery code to jQuery 1.9+-->
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>
	<!--ajax-->
	<script src="js/charisma.js"></script>
	<script type="text/javascript" src="js/widget.js"></script>

	<script type="text/javascript">
		window._idl = {};
		_idl.variant = "banner";
		(function() {
			var idl = document.createElement('script');
			idl.type = 'text/javascript';
			idl.async = true;
			idl.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'members.internetdefenseleague.org/include/?url=' + (_idl.url || '') + '&campaign=' + (_idl.campaign || '') + '&variant=' + (_idl.variant || 'banner');
			document.getElementsByTagName('body')[0].appendChild(idl);
		})();
	</script>
	<script type="text/javascript">
		$.ajax({ 
			url : 'include/pic.php', 
			processData : false,
		}).always(function(){
			$("#pic").attr("src", "include/pic.php");
		});
	</script>
	<script type="text/javascript">
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-27405484-1']);
		_gaq.push(['_trackPageview']);
		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	</script>
    <script>
      $(document).foundation();
    </script>
</body>
</html>
<?php 
	require_once ROOT . 'include/mcstats.php';
} else { echo 'Please install php version 5.2.5 or better!';} ?>