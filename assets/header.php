<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en" xmlns="http://www.w3.org/1999/xhtml"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en" xmlns="http://www.w3.org/1999/xhtml"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en" xmlns="http://www.w3.org/1999/xhtml"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" xmlns="http://www.w3.org/1999/xhtml"> <!--<![endif]-->
<head>
	<meta http-equiv="Cache-control" content="public" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
	<meta name="abstract" content="Webpage plugins that shows the data from MySQL, designed for minecraft." />
	<meta name="author" lang="en" content="MrPlow254 (admin@nicholas-smith.tk)" />
	<meta name="copyright" content="nicholas-smith.tk Copyright (c) 2012-2015" />
	<meta name="description" content="Minecraft Stats: Webpage plugins that shows the data from MySQL, designed for minecraft."	/>
	<meta name="distribution" content="global" />
	<meta name="language" content="English" />
	<meta name="keywords" content="minecraft, stats, bukkit, mrplow, cky2250, html5, foundation, MrPlow254" />
	<meta name="rating" content="general">
	<meta name="revisit-after" content="1 days" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?php if($WS_OPTICAL_TAB_TITLE != 'WS_OPTICAL_TAB_TITLE'){ echo $WS_OPTICAL_TAB_TITLE;}else{echo "Minecraft WebStats";}?></title>
	<?php if(layout != 'layout') : ?>
	<link rel="stylesheet" type="text/css" href="<?php echo layout;?>" />
	<?php endif;?>
	<!-- Included CSS Files (Uncompressed) -->
	<link rel="stylesheet" href="<?php echo ROOT;?>css/foundation.css" />
	<link rel="stylesheet" href="<?php echo ROOT;?>css/foundation-icons.css" />
	<!-- For third-generation iPad with high-resolution Retina display: -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo ROOT;?>images/favicons/apple-touch-icon-144x144-precomposed.png" />
	<!-- For iPhone with high-resolution Retina display: -->
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo ROOT;?>images/favicons/apple-touch-icon-114x114-precomposed.png" />
	<!-- For first- and second-generation iPad: -->
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo ROOT;?>images/favicons/apple-touch-icon-72x72-precomposed.png" />
	<!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
	<link rel="apple-touch-icon-precomposed" href="<?php echo ROOT;?>images/favicon.png" />
	<!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
	<link rel="icon" href="<?php echo ROOT;?>images/favicon.ico" type="image/x-icon" />
  	<script type="text/javascript" src="<?php echo ROOT;?>js/vendor/modernizr.js"></script>
	<script type="text/javascript" src="<?php echo ROOT;?>js/util.js"></script>
	<!-- IE Fix for HTML5 Tags -->
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>