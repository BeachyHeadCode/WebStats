<?php	
/**
 * Retrieves and creates the config.php file.
 *
 * The permissions for the base directory must allow for writing files in order
 * for the config.php to be created using this page.
 *
 * @internal This file must be parsable by PHP4.
 *
 * @package WebStats
 * @subpackage Administration
 */
 
/**
 * We are installing.
 *
 * @package WebStats
 */
define('INSTALLING', true);
define('ROOT', '../');
include_once ROOT . 'include/version.php';

/**
 * Disable error reporting
 *
 * Set this to error_reporting( E_ALL ) or error_reporting( E_ALL | E_STRICT ) for debugging
 */
error_reporting(0);

define('ABSPATH', dirname(dirname(__FILE__)).'/');
require_once(ROOT . "include/functions.php");

session_start();

if(!empty($_POST["SubmitUserAndPass"])) {
	$_SESSION['Username']=$_POST['Username'];
	$_SESSION['Password']=$_POST['Password'];

	$host = $_SESSION['MySQLHost'];
	$port = $_SESSION['MySQLPort'];
	$user = $_SESSION['MySQLUserName'];
	$pass = $_SESSION['MySQLPassword'];
	$db = $_SESSION['MySQLDatabase'];
	
	if($persistent === true) {
		$link = mysqli_connect('p:'. $host, $user, $pass, $db, $port);
	} else {
		$link = mysqli_connect($host, $user, $pass, $db, $port);
	}
	// Check connection
	if (mysqli_connect_errno()) {
		ws_die("<i class='fi-alert'></i> Failed to connect to MySQL: Error No. " . mysqli_connect_errno() . ": " . mysqli_connect_error(), "MySQL Error");
	}
	if(!mysqli_select_db($link, $db)) {
		if(mysqli_query($link, "CREATE DATABASE IF NOT EXISTS `".$db."`")) {
			print "<script type=\"text/javascript\">";
			print "alert('Database created :)')";
			print "</script>";
			mysqli_select_db($link, $db);
		} else {ws_die("<i class='fi-alert'></i> Could not make Database (".mysqli_error($link)."). Please manually create the Database named '".$db."' and retry.","MySQL Error");}
	}
	$username = $_SESSION['Username'];
	$password = $_SESSION['Password'];		
	if(!empty($_SESSION['Username']) && !empty($_SESSION['Password'])){
		$query = mysqli_query($link, "SELECT `username` FROM `users` WHERE `username` = '$username' and `username` != ''");
		$row = mysqli_fetch_array($query);
		if (isset($row[0])) {
			$_SESSION['usernameTaken'] = 1;
		} else {
			$_SESSION['usernameTaken'] = 2;
			$userinsert = "INSERT INTO `users`(`username`, `password`, `IP`, `hostname`, `location`, `date`, `email`, `cookie_pass`, `actcode`, `rank`, `lastactive`, `lastlogin`) VALUES ('$username', '".md5($password)."', '$ip', '$hostname', '$location', '$today', '$email', '', '', '1', NOW(), NOW())";
		}
	}
	if (!mysqli_query($link, $userinsert)){
		if(mysqli_query($link, "CREATE TABLE IF NOT EXISTS `users` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(50) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'Username',
	`password` VARCHAR(32) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'Password',
	`IP` VARCHAR(40) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'This is very accurate, since it is decided by PHP. It is unknown to wether it will record IPv6.',
	`hostname` VARCHAR(500) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'This is decided by PHP, so this is very accurate but may go too far and give the ISP hostname for the IP.',
	`location` VARCHAR(500) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'This code is taken from an outside source and is not know to be correct or incorrect.',
	`date` VARCHAR(200) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'This is the current date for which the user has viewed the page.',
	`email` VARCHAR(200) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'NOT IMPLEMENTED.',
	`cookie_pass` VARCHAR(32) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'The cookie created to remember the user and know who they are.',
	`actcode` VARCHAR(32) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'N/A.',
	`rank` VARCHAR(3) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'N/A.',
	`lastactive` datetime NOT NULL COMMENT 'The last date the user was logged viewing the server.',
	`lastlogin` datetime NOT NULL COMMENT 'The last date the user loged into the server.',
	PRIMARY KEY (`ID`)
) ENGINE `InnoDB` CHARACTER SET `ascii` COLLATE `ascii_general_ci`")) {
			mysqli_query($link, $userinsert);
		} else {
			echo('Error Creating Table: ' . mysqli_error($link) . '<br />');
		}
	}
	mysqli_close($link);
}
if(!empty($_POST["reload"])) {
	session_unset();
	session_destroy();
	session_write_close();
	setcookie(session_name(),'',0,'/');
	session_regenerate_id(true);
	header('Location: setup-config.php?step=1');
}
if(!empty($_POST["SubmitDatabase"])) {
	$_SESSION['MySQLHost']=$_POST['MySQLHost'];
	$_SESSION['MySQLPort']=$_POST['MySQLPort'];
	$_SESSION['MySQLUserName']=$_POST['MySQLUserName'];
	$_SESSION['MySQLPassword']=$_POST['MySQLPassword'];
	$_SESSION['MySQLDatabase']=$_POST['MySQLDatabase'];
	
	$host = $_POST['MySQLHost'];
	$port = $_POST['MySQLPort'];
	$user = $_POST['MySQLUserName'];
	$pass = $_POST['MySQLPassword'];
	$db = $_POST['MySQLDatabase'];

	if($persistent === true) {
		$link = mysqli_connect('p:'. $host, $user, $pass, $db, $port);
	} else {
		$link = mysqli_connect($host, $user, $pass, $db, $port);
	}
	// Check connection
	if (mysqli_connect_errno()) {
		ws_die("<i class='fi-alert'></i> Failed to connect to MySQL: Error No. " . mysqli_connect_errno() . ": " . mysqli_connect_error(), "MySQL Error");
	}
	if(!mysqli_select_db($link, $db)) {
		if(mysqli_query($link, "CREATE DATABASE IF NOT EXISTS `".$db."`")) {
			print "<script type=\"text/javascript\">";
			print "alert('Database created :)')";
			print "</script>";
			mysqli_select_db($link, $db);
		} else {ws_die("<i class='fi-alert'></i> Could not make Database (".mysqli_error($link)."). Please manually create the Database named '".$db."' and retry.","MySQL Error");}
	}
	mysqli_close($link);	
}
 //Load the class
	$ipLite = new ip2location_lite;
//Get locations
	$locations = $ipLite->getCity($_SERVER['REMOTE_ADDR']);
//Getting the result
	
//$location = $locations['countryCode'].",".$locations['regionName'].','.$locations['cityName'].','.$locations['zipCode'];
$ip=$_SERVER['REMOTE_ADDR'];
$hostname=$_SERVER['REMOTE_HOST'];
$referer=$_SERVER['HTTP_REFERER'];
$pageurl=curPageURL();
$today = date("D M j G:i:s T Y");
$hostname=gethostbyaddr($_SERVER['REMOTE_ADDR']);
$step = isset( $_GET['step'] ) ? (int) $_GET['step'] : 0;

function display_header() {
	header( 'Content-Type: text/html; charset=utf-8' );
define('layout',ROOT . 'css/layout_admin.css');
include_once ROOT . "assets/header.php";
?>
<script type="text/javascript">
	function MM_validateForm() { //v4.0
	  if (document.getElementById){
		var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
		for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
		  if (val) { nm=val.name; if ((val=val.value)!="") {
			if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
			  if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
			} else if (test!='R') { num = parseFloat(val);
			  if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
			  if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
				min=test.substring(8,p); max=test.substring(p+1);
				if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
		  } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
		} if (errors) alert('The following error(s) occurred:\n'+errors);
		document.MM_returnValue = (errors == '');
	} }
	function MM_popupMsg(msg) { //v1.0
	  alert(msg);
	}
	function displayImage() {
		//var x=document.getElementsByName("page[default_background]");
		//var a=document.getElementById('customDropdown background').value;
		var a = document.getElementById("customDropdown background");
		var b = a.options[a.selectedIndex].text;
		var c="../images/background/bg_";
		var d=".png";
		var e=c.concat(b,d);
		log(e);
		document.getElementById("imageplaceholder").src=e;
	}
</script>
<style type="text/css">
	body {
		background-color:					rgb(228, 228, 228);
	}
	input[type="submit"].button {
		margin:10px 0px 0px 12px;
	}
	.inner-wrapper {
		position:							relative;
		padding:							5px;
		border-left:						2px solid #DDDDDD;
		border-right:						2px solid #DDDDDD;
		background:							rgba(255, 255, 255, .5);	
		margin: 							0 auto;
		min-height: 						100%;
		height:								auto !important;
		height:								100%;
		z-index:							5;
	}
	table {
		table-layout:						fixed;
		margin: 							0px auto;
	}
	table thead th {
		padding-right:						12px;
	}
	table tbody tr td {
		text-align:							center;
	}
	fieldset{
		border:								1px solid #000;
		padding:							3px;
	}
	hr {
		border: 							1px solid #000;
	}
	footer {
		padding:							5px;
		margin:								0 auto;
		margin-bottom:						20px;
		position:							relative;
		height:								auto;
		border-top:							2px dotted #511B00;
		border:								2px solid #DDDDDD;
		border-top:							none;
		background:							rgba(255, 255, 255, .5);
		border-bottom-left-radius:			30px;
		border-bottom-right-radius:			30px;
		z-index:							2;
		text-align:							center;
	}
	aside {
		width:								120px;
		position:							fixed;
		float:								right;
		right:								0px;
		top:								100px;
		padding:							5px;
		background:							rgba(255, 255, 255, .5);	
		margin: 							auto;
		height:								auto !important;
		height:								100%;
		overflow:							hidden !important;
		vertical-align:						top;
		z-index:							1;
		border-bottom-left-radius:			10px;
		border-top-left-radius:				10px;
		border:								2px solid #DDDDDD;
	}
	asideleft {
		width:								120px;
		position:							fixed;
		left:								0;
		float:								left;
		top:								100px;
		padding:							5px;
		background:							rgba(255, 255, 255, .5);
		margin: 							auto;
		height:								auto !important;
		height:								100%;
		overflow:							hidden !important;	
		vertical-align:						top;
		z-index:							1;	
		border-top-right-radius:			10px;
		border-bottom-right-radius:			10px;
		border:								2px solid #DDDDDD;
	}
</style>

<body>
	<div class="row main-wrapper">
		<!--Title-->
		<h3 class="title"><i class="fi-wrench"></i> Install & Configure</h3>
		<!--Body-->
		<div class="row inner-wrapper show-for-medium-up">
			<div class="alert-box">
			 <strong><i class="fi-alert"></i>Warning:</strong> This is beta software. Open an issue on <a href="https://github.com/MrPlow254/WebStats/issues" target="_blank">GitHub</a> if you find any problems and we may try and fix it.
			</div>
			<article>
		<?php
}//end function display_header();
		switch($step) {
			case 0:
				display_header();
		?>
<h1>Welcome to WebStats v<?php echo $version;?>!</h1>
<p>Before getting started, we need some information on the database. You will need to know the following items before proceeding.</p>
<ol>
	<li>Database name</li>
	<li>Database username</li>
	<li>Database password</li>
	<li>Database host</li>
</ol>
<p><strong>If for any reason this automatic file creation doesn't work, don't worry. All this does is fill in the database information to a configuration file. You may also simply open <code>config-sample.php</code> in a text editor, fill in your information, and save it as <code>config.php</code>.</strong></p>
<p> 
	In all likelihood, these items were supplied to you by your Web Host. If you do not have this information, then you will need to contact them before you can continue. If you&#8217;re all ready&hellip;<br /><br />
	<b><i>Do note that text within .htaccess in the 'WebStats' folder needs to be changed to your domain name to prevent <a href='http://www.davidairey.com/stop-image-theft-hotlinking-htaccess/'>hotlinking.</a></i></b>
	<hr />
	<?php 
	if (!function_exists('imagecreatetruecolor')) {echo "<br /><strong class='[success alert secondary] [round radius] label'><i class='step fi-alert size-24'></i>Warning:</strong> <b>PHP GD is not installed or corrupt:</b> <br />For linux users, 'sudo apt-get install php5-gd' then restart apache.<br />";}
	if (!function_exists('curl_init')) {echo "<br /><strong class='[success alert secondary] [round radius] label'><i class='step fi-alert size-24'></i>Warning:</strong> <b>PHP Curl is not installed or corrupt:</b> <br />For linux users, 'sudo apt-get install php5-curl' then restart apache.<br />";}	
	if (ini_get('variables_order') == "GPCS") {echo '<br /><strong class="[success alert secondary] [round radius] label"><i class="step fi-alert size-24"></i>Warning:</strong> Your INI file shows variables_order = "GPCS", however we would like it to be "EGPCS"<br />';}
	?>
	<br />
	You will also need to edit the .htaccess file in the root of this project.<br />
	<h4>Versions of Apache only:</h4>
	<b>Linux:</b> Change your /etc/apache2/sites-enabled/000-default settings within — may look like this.<br />
	<b>Windows:</b> locate your apache 
	<textarea name="comments" cols="60" rows="6">
<Directory /var/www/>
	Options Indexes FollowSymLinks MultiViews
	AllowOverride none
	Order allow,deny
	allow from all
</Directory>
	</textarea>
	<b>and change to...</b>
	<textarea name="comments" cols="60" rows="6">
<Directory /var/www/>
	Options Indexes FollowSymLinks MultiViews
	AllowOverride all
	Order allow,deny
	allow from all
</Directory>
	</textarea>					
</p>
<hr />
<p>
	<i class="fi-bookmark"></i> The next two steps allow for you to have an admin page for this project. If you decide that you would rather not create this you can skip creating the admin page. This can later be added going to you /admin/setup-config.php file. It will then end when you get the step to create the config if the config file exists.
</p>
<p class="step">
	<a href="setup-config.php?step=1<?php if ( isset( $_GET['noapi'] ) ) echo '&amp;noapi'; ?>" class="button"><?php echo( 'Let&#8217;s go!' ); ?></a>
	<a href="setup-config.php?step=3<?php echo '&amp;noapi'; ?>" class="button"><?php echo( 'Skip creating admin page.' ); ?></a>
</p>
			<?php	
			break;
			case 1:
				display_header();
			?>
<h1><i class="fi-clipboard-notes"></i> Configuration</h1>
<p>
	Enter the database details to your the MySQL server where you have created a database for this project's data. <strong>The table and database will be created if it does not exist.</strong> Please note that the user only needs SELECT, and CREATE permissions on the database.
</p>
<form action="setup-config.php?step=2" method="post" class="custom">
	<fieldset>
		<legend style="background: none;"><h3><i class="fi-database"></i> Lets Setup your Database</h3></legend>
			<label for="MySQLHost">*Enter the MySQL I.P. or URL<input name="MySQLHost" placeholder="localhost" value="<?php if(isset($_SESSION['MySQLHost'])){ echo $_SESSION['MySQLHost'];} ?>" type="text" title="Enter the MySQL I.P. or URL" maxlength="60"/></label>
			<label for="MySQLPort">*Enter the MySQL Port Number<input name="MySQLPort" placeholder="3306" value="<?php if(isset($_SESSION['MySQLPort'])){ echo $_SESSION['MySQLPort'];} ?>" type="text" title="Enter the MySQL Port Number" maxlength="5"/></label>
			<label for="MySQLUserName">*Enter the MySQL User Name<input name="MySQLUserName" accesskey="" placeholder="root" value="<?php if(isset($_SESSION['MySQLUserName'])){ echo $_SESSION['MySQLUserName'];} ?>" type="text" title="Enter the MySQL User Name" maxlength="16"/></label>
			<label for="MySQLPassword">*Enter the MySQL Password<input name="MySQLPassword" placeholder="password" value="<?php if(isset($_SESSION['MySQLPassword'])){ echo $_SESSION['MySQLPassword'];} ?>" type="text" title="Enter the MySQL Password" maxlength="64"/></label>
			<label for="MySQLDatabase">*Enter Database<input name="MySQLDatabase" placeholder="WebStats" type="text" id="MySQLDatabase" title="MySQL Database" value="<?php if(!isset($_SESSION['MySQLDatabase'])){ echo 'WebStats';}else{ echo $_SESSION['MySQLDatabase'];} ?>" maxlength="64" /></label>
			<small>All items marked with a star are required items. Please fill them out.</small><br />
			<input name="SubmitDatabase" type="submit" title="submit" onclick="MM_validateForm('MySQLHost','','R','MySQLPort','','NisNum','MySQLUserName','','R','MySQLPassword','','R','MySQLDatabase','','R');return document.MM_returnValue" class="small success button"/> 
			<input name="reload" type="submit" title="Reload" value="Reload" onClick="return confirm('Are you sure you want to reset?')"  class="small secondary button" /><br/>
	</fieldset>
</form>
			<?php
			break;
			case 2:
				display_header();
			?>
<h1><i class="fi-clipboard-notes"></i> Configuration</h1>
<p>
	Enter the username and password you design for logging into the admin page.
</p>
<form action="setup-config.php?step=3" method="post" class="custom">
	<fieldset>
		<legend style="background: none;"><h3>Username & Password</h3></legend>
			<label for="Username">Enter Your Admin Username<input name="Username" placeholder="admin" type="text" id="Username" title="Project's Admin Username" value="<?php if(!isset($_SESSION['Username'])){}else{ echo $_SESSION['Username'];} ?>" maxlength="64" /></label>
			<label for="Password">Enter Your Admin Password<input name="Password" placeholder="Password" type="password" id="Password" title="Project's Admin Username" value="<?php if(!isset($_SESSION['Password'])){}else{ echo $_SESSION['Password'];} ?>" maxlength="64" /></label>
			<input name="SubmitUserAndPass" type="submit" title="submit" class="small success button"/> 
			<input name="reload" type="submit" title="Reload" value="Reload" onClick="return confirm('Are you sure you want to reset?')"  class="small secondary button" /><br/>
	</fieldset>
</form>
			<?php
			break;
			case 3:
				display_header();
				if(isset( $_GET['noapi'] )) {
					require_once('configsetup.php');
				} else {
					if ($_SESSION['usernameTaken'] == 2) {
						require_once('configsetup.php');
					} else {
						ws_die(( '<strong><i class="fi-alert"></i>ERROR</strong>: "Username" ('.$_SESSION['Username'].') was taken.' . $tryagain_link ));
					}
				}
			break;
		}
?>
		</article>
		</div>
		<div class="inner-wrapper show-for-small-only" align="center">
			Please continue the install on a desktop.
		</div>
		<div class="row">
		<footer>
			<script type="text/javascript">
				google_ad_client = "ca-pub-6169723647730707";
				google_ad_slot = "0514393560";
				google_ad_width = 468;
				google_ad_height = 15;
			</script>
			<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
			<p>
				<a href="https://nicholas-smith.tk" target="_blank">nicholas-smith.tk</a> &#169;<a href="http://bukkit.org/threads/web-webstatistic-for-minecraft-v3-1-mrplows.60843/" target="_blank">Webstatistic Install v5.2.1</a> for <a href="https://minecraft.net/" target="_blank">Minecraft</a>
				<?php if(date("Y") != '2011') {echo '2011-';}?><?php echo date("Y"); ?>&nbsp;<a href="../termsofuse.php">Terms Of Use</a></em>
			</p>
		</footer>
		</div>
	</div>
	<aside>
		<script type="text/javascript"><!--
			google_ad_client = "ca-pub-6169723647730707";
			/* Stats Plugin */
			google_ad_slot = "4875550823";
			google_ad_width = 120;
			google_ad_height = 600;
			//-->
		</script>
		<script type="text/javascript"src="http://pagead2.googlesyndication.com/pagead/show_ads.js" ></script>
	</aside>
	<asideleft>
		<script type="text/javascript"><!--
			google_ad_client = "ca-pub-6169723647730707";
			/* Stats Plugin */
			google_ad_slot = "4875550823";
			google_ad_width = 120;
			google_ad_height = 600;
			//-->
		</script>
		<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js" ></script>
	</asideleft>
	<!-- Included JS Files (Compressed) -->
	<script src="<?php echo ROOT;?>js/foundation.min.js"></script>
</body>
</html>