<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

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
	<title>WebStats &rsaquo; ADMIN PAGE &rsaquo; LOGIN</title>
	<link rel="stylesheet" type="text/css" href="../css/layout.css"/>
	<link rel="SHORTCUT ICON" type='image/x-icon' href="../images/favicon.ico"/>
	<link rel="apple-touch-icon" href="../images/favicon.png" />

	<!-- Included CSS Files (Uncompressed) -->
	<!--
	<link rel="stylesheet" href="stylesheets/foundation.css">
	-->
	<!-- Included CSS Files (Compressed) -->
	<link rel="stylesheet" href="../stylesheets/foundation.min.css">
	<link rel="stylesheet" href="../stylesheets/app.css">

	<script src="javascripts/modernizr.foundation.js"></script>

	<!-- IE Fix for HTML5 Tags -->
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
	<body style="background-color:rgb(228, 228, 228);">
		<section style="width: 500px; margin: auto;">
			<?php pml_login(); ?>
		</section>
	</body>
</html>
<?php if(isset($_GET['logout'])) {
	pml_logout();
}
?>