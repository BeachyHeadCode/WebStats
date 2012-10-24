<?php
	session_start();
	if(file_exists('config/config.php'))
		include('config/config.php');
	else
		header("location:admin/install/setup-config.php");
	include('config/ini.php');
	include('legacy/decrypt.php');
	include('legacy/encrypt.php');
	include('language/en.php');
	include('include/functions.php');
// create function that takes input of location for title page layout.

?>

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