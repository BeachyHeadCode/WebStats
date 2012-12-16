<?php
if(file_exists('../config/config.php'))
	include('../config/config.php');
else
	header("location:setup-config.php");
session_start();
error_reporting(0);
$start_time = explode(" ",microtime()); 
$start_time = $start_time[1] + $start_time[0];
include('../language/en.php');
include('../legacy/decrypt.php');
include('../include/functions.php');
require_once("../include/logonfunctions.php");
if($_GET['LOGOUT'] == 'TRUE')
	require_once('logout.php');

if(!isset($_SESSION['pml_userid'])){
	require_once('login.php');

}
else
{
if(empty($_GET['mode'])) $_GET['mode'] = 'home';
$_SESSION['mode']=$_GET['mode'];
?>
<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en" xmlns="http://www.w3.org/1999/xhtml"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en" xmlns="http://www.w3.org/1999/xhtml"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en" xmlns="http://www.w3.org/1999/xhtml"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" xmlns="http://www.w3.org/1999/xhtml"> <!--<![endif]-->
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
	<meta name="author" lang="en" content="cky2250 (admin@mrplows-server.us)" />
	<meta content='minecraft stats' name='description' />
	<meta content='minecraft, stats, bukkit, mrplow, cky2250' name='keywords'/>
	<title>WebStats &rsaquo; ADMIN PAGE</title>
	<link rel="stylesheet" type="text/css" href="../css/layout_admin.css"/>
	<link rel="SHORTCUT ICON" type='image/x-icon' href="../images/favicon.ico"/>
	<link rel="apple-touch-icon" href="../images/favicon.png" />
  
	<!-- Included CSS Files (Uncompressed) -->
	<link rel="stylesheet" type="text/css" href="../stylesheets/foundation.css">
	<link rel="stylesheet" type="text/css" href="../stylesheets/app.css">

	<script type="text/javascript" src="../javascripts/modernizr.foundation.js"></script>

	<!-- IE Fix for HTML5 Tags -->
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<link rel="stylesheet" href="stylesheets/general_enclosed_foundicons.css">
	<!--[if lt IE 8]>
		<link rel="stylesheet" href="../../stylesheets/general_enclosed_foundicons_ie7.css">
	<![endif]-->
	<script type="text/javascript" src='https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.js'></script>  
</head>
<body style="background-color:rgb(228, 228, 228);">
		<!--Header Start-->
		<div class="row">
			<div class="twelve columns">
				<h2>Welcome, <?php echo $_SESSION['username']; ?> to the admin page</h2>
				<hr />
			</div>
			<div class="row">
				<div class="two columns">
					<div class="head_language"><!--Languages by Google-->
						<div id="google_translate_element"></div>
						<script>
							function googleTranslateElementInit(){new google.translate.TranslateElement({pageLanguage: 'en',includedLanguages: 'en,fr,de,ko,ru,sk,es,sv',gaTrack: true,gaId: 'UA-27405484-1',layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');}
						</script>
						<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
					</div><!--End Languages by Google-->
				</div>
				<div class="two columns">
					<div id="bookmarklet">
						<div onmousedown="return false;" onselectstart="return false;" '.default.'>Drag to your bookmarks bar:<br /><br /></div>
						<a href="<?php echo curPageURL();?>" <?php echo (hover);?>>ADMIN PAGE</a>
					</div>
				</div>
			</div>
      	
		<!--Header End-->
 		<div class="row">
			<div class="nav-bar">
				<li><a href="../"><?php echo translate(var6);?></a></li>
				<li><a href="?mode=home">Home</a></dd>
				<li><a href="ip.php">IP Tracker</a></li>
				<li><a href="setup-config.php">Installer</a></li>
				<li><a href="?mode=settings">Settings</a></li>
				<li><a href="achievements-install/index.php">Achievement - Installer</a></li>
				<li align="right"><a href="?LOGOUT=TRUE">LOGOUT</a></li>
			</div>
		</div>
		<div class="row" style="background-image: url(../images/table_bg.png);"> <!--MAIN-->
			<div style="margin:25px;">
		<p>
				This page is in the making. And will contain all the help information and locations needed. Along with more advance config settings. This will also require mysql write support since it will be used to make logon user and pass. And then read from that.
		</p>
		<?php 	
				include($_SESSION['mode'].'.php');
				$time_end = explode(" ",microtime());
				$time_end = $time_end[1] + $time_end[0];
				$speed = $time_end - $start_time;
				$speed = substr($speed,0,8);
		?>
			</div>
			</div> <!--MAIN END-->
			<div class="row footer" align="center">
		<p>
			<em>
				<a href="http://www.mrplows-server.us" target="_blank">www.mrplows-server.us</a> &#169; <a href="http://forums.bukkit.org/threads/web-webstatistic-for-minecraft-v2-1-mrplows-any-build.60843/">Webstatistic v<?php include('../include/version.php'); echo $version;?></a> for <a href="http://minecraft.net">Minecraft</a>
         		<?php if(date("Y") != '2011') {echo '2011-';}?>
         		<?php echo date("Y"); ?> 
				<a href="termsofuse.php">Terms Of Use</a>
       		</em>
			&nbsp;&nbsp;&nbsp; 
       		<span style="font-size:xx-small">(Loading time: <?php echo $speed; ?>s)</span>
		</p><br/>
			</div>
</div>
  <!-- Included JS Files (Compressed) -->
  <script src="../javascripts/foundation.min.js"></script>  
  <!-- Initialize JS Plugins -->
  <script src="../javascripts/app.js"></script>
</body>
</html>
<?php } ?>