<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en" xmlns="http://www.w3.org/1999/xhtml"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en" xmlns="http://www.w3.org/1999/xhtml"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en" xmlns="http://www.w3.org/1999/xhtml"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" xmlns="http://www.w3.org/1999/xhtml"> <!--<![endif]-->
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
	<meta name="author" lang="en" content="cky2250 (admin@mrplows-server.tk)" />
	<meta content='minecraft stats' name='description' />
	<meta content='minecraft, stats, bukkit, mrplow, cky2250' name='keywords'/>
	<title>WebStats &rsaquo; ADMIN PAGE &rsaquo; LOGIN</title>
	<link rel="stylesheet" type="text/css" href="../css/layout.css"/>
	<link rel="SHORTCUT ICON" type='image/x-icon' href="../images/favicon.ico"/>
	<link rel="apple-touch-icon" href="../images/favicon.png" />

	<!-- Included CSS Files (Compressed) -->
	<link rel="stylesheet" href="../stylesheets/foundation.css">
	<link rel="stylesheet" href="../stylesheets/app.css">

	<script src="javascripts/modernizr.foundation.js"></script>

	<!-- IE Fix for HTML5 Tags -->
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
    <style type="text/css">
	html, body {
		height: 100%;
	}
	body {
		background-color:rgb(228, 228, 228);
		margin: 0;
	}
	#container[id] {
		top: 50%;
		margin-top: -200px;
		position: absolute;
		left:0;
		
		width:100%;
		min-height: 100%;
		padding: 10px;
	}
	#middle[id] {
		text-align: center;
		margin-left: auto;
		margin-right: auto;
		width:	500px;
		vertical-align: middle;
		position: static;
	}
	</style>
</head>
	<body>
		<section id="container">
			<div id="middle">
				<h3>Login</h3>
				<?php pml_login(); ?>
			</div>
		</section>
	</body>
</html>
<?php if(isset($_GET['logout'])) {
	pml_logout();
}
?>