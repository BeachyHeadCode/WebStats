<?php

/**
 * Fix $_SERVER variables for various setups.
 *
 */
function fix_server_vars() {
	global $PHP_SELF;

	$default_server_values = array(
		'SERVER_SOFTWARE' => '',
		'REQUEST_URI' => '',
	);
	$_SERVER = array_merge( $default_server_values, $_SERVER );

	// Fix for IIS when running with PHP ISAPI
	if ( empty( $_SERVER['REQUEST_URI'] ) || ( php_sapi_name() != 'cgi-fcgi' && preg_match( '/^Microsoft-IIS\//', $_SERVER['SERVER_SOFTWARE'] ) ) ) {

		// IIS Mod-Rewrite
		if ( isset( $_SERVER['HTTP_X_ORIGINAL_URL'] ) ) {
			$_SERVER['REQUEST_URI'] = $_SERVER['HTTP_X_ORIGINAL_URL'];
		}
		// IIS Isapi_Rewrite
		else if ( isset( $_SERVER['HTTP_X_REWRITE_URL'] ) ) {
			$_SERVER['REQUEST_URI'] = $_SERVER['HTTP_X_REWRITE_URL'];
		} else {
			// Use ORIG_PATH_INFO if there is no PATH_INFO
			if ( !isset( $_SERVER['PATH_INFO'] ) && isset( $_SERVER['ORIG_PATH_INFO'] ) )
				$_SERVER['PATH_INFO'] = $_SERVER['ORIG_PATH_INFO'];

			// Some IIS + PHP configurations puts the script-name in the path-info (No need to append it twice)
			if ( isset( $_SERVER['PATH_INFO'] ) ) {
				if ( $_SERVER['PATH_INFO'] == $_SERVER['SCRIPT_NAME'] )
					$_SERVER['REQUEST_URI'] = $_SERVER['PATH_INFO'];
				else
					$_SERVER['REQUEST_URI'] = $_SERVER['SCRIPT_NAME'] . $_SERVER['PATH_INFO'];
			}

			// Append the query string if it exists and isn't null
			if ( ! empty( $_SERVER['QUERY_STRING'] ) ) {
				$_SERVER['REQUEST_URI'] .= '?' . $_SERVER['QUERY_STRING'];
			}
		}
	}

	// Fix for PHP as CGI hosts that set SCRIPT_FILENAME to something ending in php.cgi for all requests
	if ( isset( $_SERVER['SCRIPT_FILENAME'] ) && ( strpos( $_SERVER['SCRIPT_FILENAME'], 'php.cgi' ) == strlen( $_SERVER['SCRIPT_FILENAME'] ) - 7 ) )
		$_SERVER['SCRIPT_FILENAME'] = $_SERVER['PATH_TRANSLATED'];

	// Fix for Dreamhost and other PHP as CGI hosts
	if ( strpos( $_SERVER['SCRIPT_NAME'], 'php.cgi' ) !== false )
		unset( $_SERVER['PATH_INFO'] );

	// Fix empty PHP_SELF
	$PHP_SELF = $_SERVER['PHP_SELF'];
	if ( empty( $PHP_SELF ) )
		$_SERVER['PHP_SELF'] = $PHP_SELF = preg_replace( '/(\?.*)?$/', '', $_SERVER["REQUEST_URI"] );
}

/**
 * Check for the required PHP version, and the MySQL extension or a database drop-in.
 *
 * Dies if requirements are not met.
 *
 */
function wp_check_php_mysql_versions() {
	global $required_php_version;
	$php_version = phpversion();
	if ( version_compare( $required_php_version, $php_version, '>' ) ) {
		die('Your server is running PHP version $php_version but WebStats $version requires at least $required_php_version.');
	}

	if (! extension_loaded( 'mysql' )) {
		die('Your PHP installation appears to be missing the MySQL extension which is required by WebStats.');
	}
}

function curPageURL() {
$pageURL = 'http';
if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://";
if ($_SERVER["SERVER_PORT"] != "80")
	$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
else
	$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
return $pageURL;
}
class DBConfig {
	var $host; var $user; var $pass; var $db; var $db_link; var $conn = false; var $persistant = false; public $error = false;
	public function config(){
		$this->error = true; $this->persistant = false;
	} 
	function conn($host, $user, $pass, $db, $createdb){
		$this->host = $host;
		$this->user = $user;
		$this->pass = $pass;
		$this->db = $db;
        // Establish the connection.
		if ($this->persistant)
			$this->db_link = mysql_pconnect($this->host, $this->user, $this->pass, true);
		else 
			$this->db_link = mysql_connect($this->host, $this->user, $this->pass, true);
		if (!$this->db_link) {
			if ($this->error){
				$this->error($type=1);
			}
			return false;
		}
		else {
			if (empty($db)) {
				if ($this->error){
					$this->error($type=2);
				}
			}
			else {
				$db = mysql_select_db($this->db, $this->db_link); // select db
				if ((!$db) && ($createdb !== true)){
					if ($this->error){
						$this->error($type=2);
					}
					return false;
				}
				if((!$db) && ($createdb === true)){
					if(mysql_query("CREATE DATABASE IF NOT EXISTS `".$this->db."`", $this->db_link)){
						echo "Database created :) <br />";
					}
					else{
						if ($this->error){
							$this->error($type=5);
						}
					}	
				}
				$this -> conn = true;
			}
			return $this->db_link;
		}
	}
	function close() { // close connection
		if ($this -> conn){ // check connection
			if ($this->persistant) {
				$this -> conn = false;
			}
			else {
				mysql_close($this->db_link);
				$this -> conn = false;
			}
		}
		else {
			if ($this->error){
				return $this->error($type=4);
			}
		}
	}
	public function error($type=''){ //Choose error type
		if (empty($type)) {
			return false;
		}
		else {
			if ($type==1){
				echo "<strong>Database could not connect</strong> " . "<br />";
			}
			else if ($type==2){
				echo "<strong>mysql error</strong> " . mysql_error() . "<br />";
			}
			else if ($type==3){
				echo "<strong>error </strong>, Proses has been stopped" . "<br />";
			}
			else if ($type==4){
				echo "<strong>error </strong>, no connection !!! Make sure your username password and host are correct!" . "<br />";
			}
			else{
				echo "Error creating database: " . mysql_error() . "<br />";
			}
		}
	}
}
//Sets The Date
function get_date($stamp)
{
	setlocale(LC_TIME, "de_DE");
	$datum = date ("d. M 'y", $stamp);
	return $datum;
}
//Gets Online/Offline Status of The Player
//Sets the page numbers
function get_pages($numbers, $mode, $sort)
{	
	$setamount = WS_CONFIG_PAGENUM;
	$numberofpages = array(25, 35, 45, 50, 75, 100);
	for($i=0; $i <= sizeof($numberofpages)-1; $i++){
		if($_SESSION['page']['numbers'] == $numberofpages[$i])
			$dropdownselected = ("<option value='".$numberofpages[$i]."' SELECTED>".$numberofpages[$i]."</option>");
		else 
			$dropdown .= "<option value='".$numberofpages[$i]."'>".$numberofpages[$i]."</option>";
	}	
	$output =	'<div style="margin:auto;" align="center">
	<form class="custom" method="post" action="">	
		<select onchange="this.form.submit();" style="display:none;" id="customDropdown" class="select2" title="Number of items per page" name="page[numbers]">
'.$dropdownselected.$dropdown.'</select>';
	if(isset($_SESSION['page']['numbers'])){
		$numbers = $numbers / $_SESSION['page']['numbers'];
	}
	else{
		if(isset($setamount)){
			$numbers = $numbers / $setamount;
		}
		else{
			$numbers = $numbers / 25;
		}
	}
	$output .= '<ul class="pagination">';
		if(isset($_GET["page"])){
			
			if(($_GET["page"] <= 6) && ($_GET["page"] != $numbers)){
				
				if($_GET["page"]==1){
					$pages = '<li class="arrow unavailable"><a href="">&laquo;</a></li>';
					$pages .= '<li class="current"><a href="index.php?mode='.$mode.'&page=1&sort='.$sort.'" '.hover.' >1</a></li>';
				}
				else{
					$pages = '<li class="arrow"><a href="index.php?mode='.$mode.'&page='.($_GET["page"]-1).'&sort='.$sort.'">&laquo;</a></li>';
					$pages .= '<li><a href="index.php?mode='.$mode.'&page=1&sort='.$sort.'" '.hover.' >1</a></li>';
				}
				if($numbers >= 10){
					for($i=1; $i < 10; $i++){
						$page = $i + 1;
						if($_GET["page"]==$page){
							$pages .= '<li class="current"><a href="index.php?mode='.$mode.'&page='.$page.'&sort='.$sort.'" '.hover.' >'.$page.'</a></li>';
						}
						else{
							$pages .= '<li><a href="index.php?mode='.$mode.'&page='.$page.'&sort='.$sort.'" '.hover.' >'.$page.'</a></li>';
						}
					}
				}
				else{
					for($i=1; $i <= $numbers; $i++){
						$page = $i + 1;
						if($_GET["page"]==$page){
							$pages .= '<li class="current"><a href="index.php?mode='.$mode.'&page='.$page.'&sort='.$sort.'" '.hover.' >'.$page.'</a></li>';
						}
						else{
							$pages .= '<li><a href="index.php?mode='.$mode.'&page='.$page.'&sort='.$sort.'" '.hover.' >'.$page.'</a></li>';
						}
					}
				}
				if($_GET["page"] < $numbers){
					$pages .='<li class="arrow"><a href="index.php?mode='.$mode.'&page='.($_GET["page"] + 1).'&sort='.$sort.'">&raquo;</a></li>';
				}
				else{
					$pages .='<li class="arrow unavailable"><a href="">&raquo;</a></li>';
				}
			}
			elseif(($_GET["page"] >= 7) && ($_GET["page"] <= ($numbers-6))){
				$pages = '<li class="arrow"><a href="index.php?mode='.$mode.'&page='.($_GET["page"]-1).'&sort='.$sort.'">&laquo;</a></li>';
				$pages .= '<li><a href="index.php?mode='.$mode.'&page=1&sort='.$sort.'" '.hover.' >1</a></li>';
				$pages .= '<li class="unavailable"><a href="">&hellip;</a></li>';
				for($i=($_GET["page"]-5); $i < ($_GET["page"]+4); $i++){
					$page = $i + 1;
					if($_GET["page"]==$page){
						$pages .= '<li class="current"><a href="index.php?mode='.$mode.'&page='.$page.'&sort='.$sort.'" '.hover.' >'.$page.'</a></li>';
					}
					else{
						$pages .= '<li><a href="index.php?mode='.$mode.'&page='.$page.'&sort='.$sort.'" '.hover.' >'.$page.'</a></li>';
					}
				}
				$pages .= '<li class="unavailable"><a href="">&hellip;</a></li>';
				$pages .= '<li><a href="index.php?mode='.$mode.'&page='.$numbers.'&sort='.$sort.'" '.hover.' >'.$numbers.'</a></li>';
				$pages .='<li class="arrow"><a href="index.php?mode='.$mode.'&page='.($_GET["page"] + 1).'&sort='.$sort.'">&raquo;</a></li>';
			}
			elseif($_GET["page"] == $numbers){
				$pages = '<li class="arrow"><a href="index.php?mode='.$mode.'&page='.($_GET["page"]-1).'&sort='.$sort.'">&laquo;</a></li>';
				$pages .= '<li><a href="index.php?mode='.$mode.'&page=1&sort='.$sort.'" '.hover.' >1</a></li>';
				$pages .= '<li class="unavailable"><a href="">&hellip;</a></li>';
				for($i=($_GET["page"]-5); $i < $numbers; $i++){
					$page = $i + 1;
					if($_GET["page"]==$page){
						$pages .= '<li class="current"><a href="index.php?mode='.$mode.'&page='.$page.'&sort='.$sort.'" '.hover.' >'.$page.'</a></li>';
					}
					else{
						$pages .= '<li><a href="index.php?mode='.$mode.'&page='.$page.'&sort='.$sort.'" '.hover.' >'.$page.'</a></li>';
					}
				}
				$pages .='<li class="arrow unavailable"><a href="">&raquo;</a></li>';
			}
			/*if(($_GET["page"] < $numbers) && ($_GET["page"] >= ($numbers-5))){
				$pages = '<li class="arrow"><a href="">&laquo;</a></li>';
				$pages .= '<li><a href="index.php?mode='.$mode.'&page=1&sort='.$sort.'" '.hover.' >1</a></li>';
				$pages .= '<li class="unavailable"><a href="">&hellip;</a></li>';
				for($i=($_GET["page"]-5); $i < $numbers; $i++)
				{
					$page = $i + 1;
					
					if($_GET["page"]==$page){
						$pages .= '<li class="current"><a href="index.php?mode='.$mode.'&page='.$page.'&sort='.$sort.'" '.hover.' >'.$page.'</a></li>';
					}
					else{
						$pages .= '<li><a href="index.php?mode='.$mode.'&page='.$page.'&sort='.$sort.'" '.hover.' >'.$page.'</a></li>';
					}
				}
				$pages .='<li class="arrow"><a href="">&raquo;</a></li>';
			}*/
		}
		else{
			$pages = '<li class="arrow unavailable"><a href="">&laquo;</a></li>';
			$pages .= '<li class="current"><a href="index.php?mode='.$mode.'&page=1&sort='.$sort.'" '.hover.' >1</a></li>';
			if($numbers >= 10){
				for($i=1; $i <= 10; $i++){
					$page = $i + 1;
					if(1==$page){
						$pages .= '<li class="current"><a href="index.php?mode='.$mode.'&page='.$page.'&sort='.$sort.'" '.hover.' >'.$page.'</a></li>';
					}
					else{
						$pages .= '<li><a href="index.php?mode='.$mode.'&page='.$page.'&sort='.$sort.'" '.hover.' >'.$page.'</a></li>';
					}
				}
			}
			else{
				for($i=1; $i <= $numbers; $i++){
					$page = $i + 1;
					$pages .= '<li><a href="index.php?mode='.$mode.'&page='.$page.'&sort='.$sort.'" '.hover.' >'.$page.'</a></li>';
				}
			}
			$pages .='<li class="arrow"><a href="index.php?mode='.$mode.'&page=2&sort='.$sort.'">&raquo;</a></li>';		
		}
    $output .= $pages.'</ul></form></div>';
	return $output;
}
function get_status($player){
	$logout = get_amount($player, "lastlogout", "stats");
	$login = get_amount($player, "lastlogin", "stats");
	if ($logout <= $login)
		$status = '<span class="online">Online</span>';
	else
		$status = '<span class="offline">Offline</span>';
	return $status;
}
function is_bot(){
	/* This function will check whether the visitor is a search engine robot */
	$botlist = array("Teoma", "alexa", "froogle", "Gigabot", "inktomi",
	"looksmart", "URL_Spider_SQL", "Firefly", "NationalDirectory",
	"Ask Jeeves", "TECNOSEEK", "InfoSeek", "WebFindBot", "girafabot",
	"crawler", "www.galaxy.com", "Googlebot", "Scooter", "Slurp",
	"msnbot", "appie", "FAST", "WebBug", "Spade", "ZyBorg", "rabaz",
	"Baiduspider", "Feedfetcher-Google", "TechnoratiSnoop", "Rankivabot",
	"Mediapartners-Google", "Sogou web spider", "WebAlta Crawler","TweetmemeBot",
	"Butterfly","Twitturls","Me.dium","Twiceler");

	foreach($botlist as $bot){
		if(strpos($_SERVER['HTTP_USER_AGENT'],$bot)!==false)
		return true;	// Is a bot
	}
	return false;	// Not a bot
}
/**
 * Kill WebStats execution and display HTML message with error message.
 *
 * This function complements the die() PHP function. The difference is that
 * HTML will be displayed to the user. It is recommended to use this function
 * only, when the execution should not continue any further. It is not
 * recommended to call this function very often and try to handle as many errors
 * as possible silently.
 *
 * @since 3.0
 *
 * @param string $message Error message.
 * @param string $title Error title.
 * @param string|array $args Optional arguments to control behavior.
 */
function ws_die( $message = '', $title = '', $args = array() ) {
	$function ='_default_ws_die_handler';
	call_user_func( $function, $message, $title, $args );
}
/**
 * Kill WebStats execution and display HTML message with error message.
 *
 * This is the default handler for wp_die if you want a custom one for your
 * site then you can overload using the wp_die_handler filter in wp_die
 *
 * @since 3.0
 * @access private
 *
 * @param string $message Error message.
 * @param string $title Error title.
 * @param string|array $args Optional arguments to control behavior.
 */
function _default_ws_die_handler( $message, $title = '', $args = array() ) {
	$defaults = array( 'response' => 500 );
	$message = "<p>$message</p>";
	$back_text = ('&laquo; Back');
	$message .= "\n<p><a href='javascript:history.back()'>$back_text</a></p>";
	header( 'Content-Type: text/html; charset=utf-8' );
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php //if(empty($title)){echo 'Web Stats &rsaquo; Error';}else{ echo $title}?></title>
	<style type="text/css">
		body {
			background: #fff;
			color: #333;
			font-family: sans-serif;
			margin: 2em auto;
			padding: 1em 2em;
			-webkit-border-radius: 3px;
			border-radius: 3px;
			border: 1px solid #dfdfdf;
			max-width: 700px;
		}
		h1 {
			border-bottom: 1px solid #dadada;
			clear: both;
			color: #666;
			font: 24px Georgia, "Times New Roman", Times, serif;
			margin: 30px 0 0 0;
			padding: 0;
			padding-bottom: 7px;
		}
		#error-page {
			margin-top: 50px;
		}
		#error-page p {
			font-size: 14px;
			line-height: 1.5;
			margin: 25px 0 20px;
		}
		#error-page code {
			font-family: Consolas, Monaco, monospace;
		}
		ul li {
			margin-bottom: 10px;
			font-size: 14px ;
		}
		a {
			color: #21759B;
			text-decoration: none;
		}
		a:hover {
			color: #D54E21;
		}
		.button {
			font-family: sans-serif;
			text-decoration: none;
			font-size: 14px !important;
			line-height: 16px;
			padding: 6px 12px;
			cursor: pointer;
			border: 1px solid #bbb;
			color: #464646;
			-webkit-border-radius: 15px;
			border-radius: 15px;
			-moz-box-sizing: content-box;
			-webkit-box-sizing: content-box;
			box-sizing: content-box;
			background-color: #f5f5f5;
			background-image: -ms-linear-gradient(top, #ffffff, #f2f2f2);
			background-image: -moz-linear-gradient(top, #ffffff, #f2f2f2);
			background-image: -o-linear-gradient(top, #ffffff, #f2f2f2);
			background-image: -webkit-gradient(linear, left top, left bottom, from(#ffffff), to(#f2f2f2));
			background-image: -webkit-linear-gradient(top, #ffffff, #f2f2f2);
			background-image: linear-gradient(top, #ffffff, #f2f2f2);
		}
		.button:hover {
			color: #000;
			border-color: #666;
		}
		.button:active {
			background-image: -ms-linear-gradient(top, #f2f2f2, #ffffff);
			background-image: -moz-linear-gradient(top, #f2f2f2, #ffffff);
			background-image: -o-linear-gradient(top, #f2f2f2, #ffffff);
			background-image: -webkit-gradient(linear, left top, left bottom, from(#f2f2f2), to(#ffffff));
			background-image: -webkit-linear-gradient(top, #f2f2f2, #ffffff);
			background-image: linear-gradient(top, #f2f2f2, #ffffff);
		}
	</style>
</head>
<body id="error-page">
	<?php echo $message; ?>
</body>
</html>
<?php
	die();
}
?>