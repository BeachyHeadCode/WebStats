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

/**
 * Disable error reporting
 *
 * Set this to error_reporting( E_ALL ) or error_reporting( E_ALL | E_STRICT ) for debugging
 */
error_reporting(0);

define('ABSPATH', dirname(dirname(__FILE__)).'/');
define('WPINC', 'include');
require_once("../include/functions.php");

session_start();

if(!empty($_POST["SubmitUserAndPass"])){
	$_SESSION['Username']=$_POST['Username'];
	$_SESSION['Password']=$_POST['Password'];
}

if(!empty($_POST["reload"])){
	session_unset();
	session_destroy();
	session_write_close();
	setcookie(session_name(),'',0,'/');
	session_regenerate_id(true);
	header('Location: setup-config.php?step=1');
}
if(!empty($_POST["SubmitDatabase"])){
	$_SESSION['MySQLHost']=$_POST['MySQLHost'];
	$_SESSION['MySQLPort']=$_POST['MySQLPort'];
	$_SESSION['MySQLUserName']=$_POST['MySQLUserName'];
	$_SESSION['MySQLPassword']=$_POST['MySQLPassword'];
	$_SESSION['MySQLDatabase']=$_POST['MySQLDatabase'];
}

	final class ip2location_lite{
	protected $errors = array();
	protected $service = 'api.ipinfodb.com';
	protected $version = 'v3';
	protected $apiKey = '29ec2adfa4bcfbbb7d96d934e800e512b6609fd7c3dee3264ad1c5a899165001';

	public function __construct(){}
	public function __destruct(){}
	public function setKey($key){
		if(!empty($key)) $this->apiKey = $key;
	}
	public function getError(){
		return implode("\n", $this->errors);
	}
	public function getCountry($host){
		return $this->getResult($host, 'ip-country');
	}
	public function getCity($host){
		return $this->getResult($host, 'ip-city');
	}
	private function getResult($host, $name){
		$ip = @gethostbyname($host);
		if(preg_match('/^(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)(?:[.](?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)){3}$/', $ip)){
			$xml = @file_get_contents('http://' . $this->service . '/' . $this->version . '/' . $name . '/?key=' . $this->apiKey . '&ip=' . $ip . '&format=xml');
			try{
				$response = @new SimpleXMLElement($xml);
				foreach($response as $field=>$value){
					$result[(string)$field] = (string)$value;
				}
				return $result;
			}
			catch(Exception $e){
				$this->errors[] = $e->getMessage();
				return;
			}
		}
		$this->errors[] = '"' . $host . '" is not a valid IP address or hostname.';
		return;
	}
}
//Load the class
	$ipLite = new ip2location_lite;
	$ipLite->setKey('29ec2adfa4bcfbbb7d96d934e800e512b6609fd7c3dee3264ad1c5a899165001');
//Get locations
	$locations = $ipLite->getCity($_SERVER['REMOTE_ADDR']);
//Getting the result
	
$location = $locations['countryCode'].",".$locations['regionName'].','.$locations['cityName'].','.$locations['zipCode'];
$ip=$_SERVER['REMOTE_ADDR'];
$hostname=$_SERVER['REMOTE_HOST'];
$referer=$_SERVER['HTTP_REFERER'];
$pageurl=curPageURL();
$today = date("D M j G:i:s T Y");
$hostname=gethostbyaddr($_SERVER['REMOTE_ADDR']);
$step = isset( $_GET['step'] ) ? (int) $_GET['step'] : 0;

function display_header() {
	header( 'Content-Type: text/html; charset=utf-8' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en" xmlns="http://www.w3.org/1999/xhtml"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en" xmlns="http://www.w3.org/1999/xhtml"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en" xmlns="http://www.w3.org/1999/xhtml"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" xmlns="http://www.w3.org/1999/xhtml"> <!--<![endif]-->
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
	
	<!-- Set the viewport width to device width for mobile -->
	<meta name="viewport" content="width=device-width" />
  
	<meta name="author" lang="en" content="cky2250 (admin@mrplows-server.us)" />
	<meta content='minecraft stats' name='description' />
	<meta content='minecraft, stats, bukkit, mrplow, cky2250' name='keywords' />
	<title><?php echo ('WebStats &rsaquo; Setup Configuration File'); ?></title>
	<link rel="SHORTCUT ICON" type='image/x-icon' href="../../images/favicon.ico" />
	<link rel="apple-touch-icon" href="images/favicon.png" />

	<!-- Included CSS Files (Uncompressed) -->
	<!--
		link rel="stylesheet" href="stylesheets/foundation.css">
	-->
	<!-- Included CSS Files (Compressed) -->
	<link rel="stylesheet" href="../../stylesheets/foundation.min.css">
	<link rel="stylesheet" href="../../stylesheets/app.css">

	<script src="../../javascripts/modernizr.foundation.js"></script>

  <!-- IE Fix for HTML5 Tags -->
  <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
	<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js'></script>
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
    </script>
</head>
<style type="text/css">
body{background-color:rgb(228, 228, 228);}
.inner-wrapper{
			width:						980px;
			position:					relative;
			padding:					5px;
			border-left:					2px solid #DDDDDD;
			border-right:					2px solid #DDDDDD;
			background-image:				url(../../images/table_bg.png);	
			margin: 					0 auto;
			min-height: 					100%;
			height:						auto !important;
			height:						100%;
			overflow:					hidden !important;
			z-index:					1;
}
table{table-layout:fixed;}
table thead th {padding-right:12px;}
table tbody tr td{text-align:center;}
fieldset{
border: 1px solid #000;
padding: 3px;
}
hr{border: 1px solid #000;}
footer{
			width:								980px;
			padding:							5px;
			margin:								0 auto;
			margin-bottom:						20px;
			position:							relative;
			height:								auto;
			border-top:							2px dotted #511B00;
			border:								2px solid #DDDDDD;
			border-top:							none;
			background-image:					url(../../images/table_bg.png);
			border-bottom-left-radius:			30px;
			border-bottom-right-radius:			30px;
			z-index:							1;
			text-align:							center;
}
aside
{
			width:						120px;
			position:					fixed;
			float:						right;
			right:						0px;
			top:						100px;
			padding:					5px;
			background-image:				url(../../images/table_bg.png);	
			margin: 					auto;
			height:						auto !important;
			height:						100%;
			overflow:					hidden !important;
			vertical-align:				top;
			z-index:					1;
			border-bottom-left-radius:				10px;
			border-top-left-radius:				10px;
			border:							2px solid #DDDDDD;
}
asideleft
{
			width:						120px;
			position:					fixed;
			left:						0;
			float:						left;
			top:						100px;
			padding:					5px;
			background-image:				url(../../images/table_bg.png);	
			margin: 					auto;
			height:						auto !important;
			height:						100%;
			overflow:					hidden !important;	
			vertical-align:				top;
			z-index:					1;	
			border-top-right-radius:				10px;
			border-bottom-right-radius:				10px;
			border:							2px solid #DDDDDD;
}
</style>
	<body><!-- BODY -->
		<div class="main-wrapper">
			<div class="inner-wrapper">
				<article>
		<?php
}//end function display_header();
		switch($step) {
			case 0:
				display_header();
		?>
				<p><?php echo( 'Welcome to WebStats. Before getting started, we need some information on the database. You will need to know the following items before proceeding.' ) ?></p>
					<ol>
						<li><?php echo( 'Database name' ); ?></li>
						<li><?php echo( 'Database username' ); ?></li>
						<li><?php echo( 'Database password' ); ?></li>
						<li><?php echo( 'Database host' ); ?></li>
					</ol>
					<p><strong><?php echo( "If for any reason this automatic file creation doesn't work, don't worry. All this does is fill in the database information to a configuration file. You may also simply open <code>config-sample.php</code> in a text editor, fill in your information, and save it as <code>config.php</code>." ); ?></strong></p>
					<p><?php echo( "In all likelihood, these items were supplied to you by your Web Host. If you do not have this information, then you will need to contact them before you can continue. If you&#8217;re all ready&hellip;" ); ?></p>
					<p class="step"><a href="setup-config.php?step=1<?php if ( isset( $_GET['noapi'] ) ) echo '&amp;noapi'; ?>" class="button"><?php echo( 'Let&#8217;s go!' ); ?></a></p>
			<?php	
			break;
			case 1:
				display_header();
			?>
				<form action="setup-config.php?step=2" method="post" class="custom">
					<fieldset>
						<legend style="background: none;"><h3>Lets Setup your Database</h3></legend>
							<label for="MySQLHost">Enter the MySQL I.P. or URL<input name="MySQLHost" placeholder="localhost" value="<?php if(isset($_SESSION['MySQLHost'])){ echo $_SESSION['MySQLHost'];} ?>" type="text" title="Enter the MySQL I.P. or URL" maxlength="60"/></label>
							<label for="MySQLPort">Enter the MySQL Port Number<input name="MySQLPort" placeholder="3306" value="<?php if(isset($_SESSION['MySQLPort'])){ echo $_SESSION['MySQLPort'];} ?>" type="text" title="Enter the MySQL Port Number" maxlength="5"/></label>
							<label for="MySQLUserName">Enter the MySQL User Name<input name="MySQLUserName" accesskey="" placeholder="root" value="<?php if(isset($_SESSION['MySQLUserName'])){ echo $_SESSION['MySQLUserName'];} ?>" type="text" title="Enter the MySQL User Name" maxlength="16"/></label>
							<label for="MySQLPassword">Enter the MySQL Password<input name="MySQLPassword" placeholder="password" value="<?php if(isset($_SESSION['MySQLPassword'])){ echo $_SESSION['MySQLPassword'];} ?>" type="text" title="Enter the MySQL Password" maxlength="64"/></label>
							<label for="MySQLDatabase">Enter Database<input name="MySQLDatabase" placeholder="WebStats" type="text" id="MySQLDatabase" title="MySQL Database" value="<?php if(!isset($_SESSION['MySQLDatabase'])){ echo WebStats;}else{ echo $_SESSION['MySQLDatabase'];} ?>" maxlength="64" /></label>
							<input name="SubmitDatabase" type="submit" title="submit" onclick="MM_validateForm('MySQLHost','','R','MySQLPort','','NisNum','MySQLUserName','','R','MySQLPassword','','R','MySQLDatabase','','R');return document.MM_returnValue" class="small success button"/> 
							<input name="reload" type="submit" title="Reload" value="Reload" onClick="return confirm('Are you sure you want to reset?')"  class="small secondary button" /><br/>
					</fieldset>
				</form>
				
			<?php
			break;
			case 2:
				$tryagain_link = '</p><p class="step"><a href="setup-config.php?step=1" onclick="javascript:history.go(-1);return false;" class="button">Try Again</a>';

				if(empty($_POST["MySQLHost"]))
					ws_die(( '<strong>ERROR</strong>: "Host Location" must not be empty.' . $tryagain_link ));
				if(empty($_POST["MySQLPort"]))
					ws_die(( '<strong>ERROR</strong>: "Host Port" must not be empty.' . $tryagain_link ));
				display_header();
			?>
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
				require_once('configsetup.php');
			break;
		}
		if($step == 1 || $step == 2) {
			$host = $_SESSION['MySQLHost'].":".$_SESSION['MySQLPort'];
			$user = $_SESSION['MySQLUserName'];
			$pass = $_SESSION['MySQLPassword'];
			$db = $_SESSION['MySQLDatabase'];
			$createdb = true;
			$DB = new DBConfig();
			$DB -> config();	
			$DB -> conn($host, $user, $pass, $db, $createdb);
			$username = $_SESSION['Username'];
			$password=$_SESSION['Password'];
			if(!empty($_SESSION['Username']) && !empty($_SESSION['Password'])){
				$finduser = 'SELECT `username` FROM `users` WHERE `username` = "$username"';
				
				if (!mysql_query($finduser)){
					$userinsert = "INSERT INTO users (username, password, IP, hostname, location, date, actcode, rank) VALUES ('$username', '$password', '$ip', '$hostname', '$location', '$today', '', '1')";
				}
				else{
					echo 'Username already exists!';
				}
			}
			else{
				$_SESSION['test']=2;
			}
			if (!mysql_query($userinsert) && !empty($username) && !empty($password))
			{
				if(mysql_query("CREATE TABLE IF NOT EXISTS `users` (
		`ID` INT(11) NOT NULL AUTO_INCREMENT,
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
) ENGINE `InnoDB` CHARACTER SET `ascii` COLLATE `ascii_general_ci`")){
					echo "Table Created :) \n";
				}
				else
				{
					echo('Error Creating Table: ' . mysql_error() . '<br />');
				}
			}
			$DB -> close();
		}
?>
				</article>
			</div>
			<footer>
    <script type="text/javascript">
		google_ad_client = "ca-pub-6169723647730707";
		google_ad_slot = "0514393560";
		google_ad_width = 468;
		google_ad_height = 15;
	</script>
	<script type="text/javascript"
		src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
	</script>
		<p>
			<a href="http://adf.ly/1049208/mr-plows-server" target="_blank">mrplows-server.us</a> &#169;<a href="http://adf.ly/5xvDw">Webstatistic Install v4.0</a> for <a href="http://adf.ly/5xvG7">Minecraft</a>
			<?php if(date("Y") != '2011') {echo '2011-';}?><?php echo date("Y"); ?>&nbsp;<a href="../termsofuse.php">Terms Of Use</a></em>
		</p>
	</footer>
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
		<script src="../../javascripts/jquery.js"></script>
		<script src="../../javascripts/foundation.min.js"></script>
		<!-- Initialize JS Plugins -->
		<script src="../../javascripts/app.js"></script>
	</body>
</html>