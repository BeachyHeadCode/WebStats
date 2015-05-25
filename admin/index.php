<?php
define('ROOT', '../');
if(file_exists(ROOT . 'config/config.php'))
	include_once ROOT . 'config/config.php';
else
	header("location:setup-config.php");
session_start();
error_reporting(0);
$start_time = explode(" ",microtime()); 
$start_time = $start_time[1] + $start_time[0];
include_once ROOT . 'include/en.php';
include_once ROOT . 'include/functions.php';
require_once ROOT . "include/logonfunctions.php";
if($_GET['LOGOUT'] == 'TRUE')
	require_once 'logout.php';
if(!isset($_SESSION['pml_userid']) || $_SESSION['pml_userrank'] >= '2') {
	define('WS_OPTICAL_TAB_TITLE','WebStats &rsaquo; ADMIN PAGE &rsaquo; LOGIN');
	require_once 'login.php';
} else {
if(empty($_GET['mode'])) $_GET['mode'] = 'home';
$_SESSION['mode']=$_GET['mode'];
$WS_OPTICAL_TAB_TITLE='WebStats &rsaquo; ADMIN PAGE';
define('layout',ROOT . 'css/layout_admin.css');
include_once ROOT . "assets/header.php";
?>
<body class="off-canvas" style="background-color:rgb(228, 228, 228);">

<!--Main Wrapper Start-->
<div id="main" role="main" style="padding-bottom:50px">
	<!--Header Start-->
	<header id="header" class="header">
		<div class="row">
			<h2>Welcome, <?php echo $_SESSION['pml_username']; ?></h2>
			<hr />
		</div>
		<div class="row">
			<div class="small-8 columns">
				<div name="Languages By Google" class="head_language">
					<div id="google_translate_element"></div>
					<script>
						function googleTranslateElementInit(){new google.translate.TranslateElement({pageLanguage: 'en',includedLanguages: 'en,fr,de,ko,ru,sk,es,sv',gaTrack: true,gaId: 'UA-27405484-1',layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');}
					</script>
					<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
				</div>
			</div>
			<div class="small-3 large-offset-1 columns show-for-medium-up">
				<div id="bookmarklet">
					<div onmousedown="return false;" onselectstart="return false;" '.default.'>Drag to your bookmarks bar:<br /></div>
					<a href="<?php echo curPageURL();?>">ADMIN PAGE</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="contain-to-grid sticky">
				<nav class="top-bar" data-topbar role="navigation" data-options="sticky_on: large">
					<ul class="title-area">
						<li class="name"><h1><a href="?mode=home">Home</a></h1></li>
						<!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
						<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
					</ul>
					<section class="top-bar-section">
						<ul class="left">
							<li><a href="../"><?php echo translate(var6);?></a></li>
							<li><a href="?mode=ip">IP Tracker</a></li>
							<li><a href="setup-config.php">Installer</a></li>
							<li><a href="?mode=settings">Settings</a></li>
							<li><a href="?mode=ini-test">PHP Settings</a></li>
							<li><a href="achievements-install/index.php">Achievement - Installer</a></li>
						</ul>
						<ul class="right">
							<li><a href="?LOGOUT=TRUE">LOGOUT</a></li>
						</ul>
					</section>
				</nav>
			</div>
		</div>
	</header>
	<!--Header End-->

	<!--MAIN-->
	<div class="row" style="background-color:rgba(255, 255, 255, .5);">
			<div style="margin:25px;">
				<div data-alert class="alert-box">
					<strong><i class="fi-alert"></i>Warning:</strong> This page is in the making. It will contain all the help information and locations needed. Along with more advance config page to update settings. This will also require MySQL read and write support since it will be used to make login username and password.
				</div>
				<?php 	
				include($_SESSION['mode'].'.php');
				$time_end = explode(" ",microtime());
				$time_end = $time_end[1] + $time_end[0];
				$speed = $time_end - $start_time;
				$speed = substr($speed,0,8);
				?>
			</div>
	</div>
	<!--MAIN END-->

	<footer class="row footer" align="center">
		<p>
			<em>
				<a href="https://nicholas-smith.tk" target="_blank">nicholas-smith.tk</a> &#169; <a href="http://forums.bukkit.org/threads/60843/">Webstatistic v<?php include('../include/version.php'); echo $version;?></a> for <a href="http://minecraft.net">Minecraft</a>
				<?php if(date("Y") != '2011') {echo '2011-';}?>
				<?php echo date("Y"); ?> 
				<a href="<?php echo ROOT;?>termsofuse.php">Terms Of Use</a>
			</em>
			&nbsp;&nbsp;&nbsp;
			<br class="hide-for-large-up" />
			<span style="font-size:xx-small">(Loading time: <?php echo $speed; ?>s)</span>
		</p>
	</footer>
</div>

	<!-- Included JS Files (Compressed) -->
	<script src="<?php echo ROOT;?>js/foundation.min.js"></script>
	
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
<?php } ?>