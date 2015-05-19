<?php
if(basename(__FILE__) == basename($_SERVER['PHP_SELF'])){exit();}
$WS_OPTICAL_TAB_TITLE='WebStats &rsaquo; ADMIN PAGE &rsaquo; LOGIN';
include_once ROOT . "assets/header.php";
?>
	<body>
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