<?php
define('ROOT', './');

require_once ROOT . 'include/version.php';
if (version_compare(PHP_VERSION, $required_php_version) >= 0) {
	$Timer = MicroTime( true );
	if(file_exists(ROOT . 'config/config.php'))
		include_once ROOT . 'config/config.php';
	else
		header("location:admin/setup-config.php");
	define('layout','themes/'.$theme.'/css/layout.css');
	include_once ROOT . 'config/ini.php';
	include_once ROOT . 'include/en.php';
	require_once ROOT . "include/logonfunctions.php";
	require_once ROOT . 'include/functions.php';
	session_start();
	if(!empty($_POST["user"])) $_SESSION['user']=strtolower($_POST['user']);
	if(empty($_GET['mode'])) $_GET['mode'] = WS_CONFIG_MODULE;
	$_SESSION['mode']=$_GET['mode'];
	$_SESSION['page']['numbers']=$_POST['page']['numbers'];

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
<?php elseif($ip=='127.0.0.1' || $ip=='localhost' || $ip=='::1' || strpos($ip,'192.168.')) : ?>
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
		<div id="ip"></div>
		</center>
	</footer>
</div>
<!--Main Wrapper End-->

<!--Side Bar Right-->
<section>
	<?php if($search_control == true and WS_CONFIG_SEARCH_BAR === true) {?>
	<!-- SEARCH BAR -->
	<div role="searchsidebar">
		<?php include ROOT . 'include/search/index.php'; ?>
	</div>
	<?php } if (internetprotest === true or ads === true) { ?>
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
	<script type="text/javascript" src="js/widget.js"></script>
	<script src="js/charisma.js"></script>
	<?php if (iptracker === true) : ?>
	<script type="text/javascript">
	$('#ip').fadeOut().parent().append('<div id="loading-ip" class="center"></div>');
	$.ajax({
		url : 'include/ip.php',
		success:function(msg){
				$( '#ip' ).html(msg);
				$('#loading-ip').remove();
				$('#ip').fadeIn();
				logInfo( "IP Tracker Loaded!" );
				return false;
			},
			error:function (xhr, ajaxOptions, thrownError){
				console.log(xhr.status);
				console.log(xhr.statusText);
				console.log(xhr.responseText);
				if(xhr.status == '404'){
					alert('Page was not found [404], redirecting to dashboard.');
					window.location.href = "index.php";
				}
			}
	})
	</script>
	<?php endif; ?>
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
	<noscript>
		<p>This site uses JavaScript. You must allow JavaScript in your browser.</p>
	</noscript>
</body>
</html>
<?php 
//include ROOT . 'include/mcstats.php';
}else{echo 'Please install php version 5.2.5 or better!';} ?>