<?php
final class ip2location_lite{
	protected $errors = array();
	protected $service = 'api.ipinfodb.com';
	protected $version = 'v3';
	protected $apiKey = '29ec2adfa4bcfbbb7d96d934e800e512b6609fd7c3dee3264ad1c5a899165001';

	public function __construct(){}
	public function __destruct(){}
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
			$xml = @file_get_contents('http://'.$this->service.'/'.$this->version.'/'.$name.'/?key=29ec2adfa4bcfbbb7d96d934e800e512b6609fd7c3dee3264ad1c5a899165001&ip='.$ip.'&format=xml');
			
			if (get_magic_quotes_runtime()){
				$xml = stripslashes($xml);
			}
			try {
				$response = @new SimpleXMLElement($xml);
				foreach($response as $field=>$value){
					$result[(string)$field] = (string)$value;
				}
				return $result;
			} catch(Exception $e) {
				$this->errors[] = $e->getMessage();
				return;
			}
		}
		$this->errors[] = '"' . $host . '" is not a valid IP address or hostname.';
		return;
	}
}

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

	/* Fix for IIS when running with PHP ISAPI */
	if ( empty( $_SERVER['REQUEST_URI'] ) || ( php_sapi_name() != 'cgi-fcgi' && preg_match( '/^Microsoft-IIS\//', $_SERVER['SERVER_SOFTWARE'] ) ) ) {
		/* IIS Mod-Rewrite */
		if (isset($_SERVER['HTTP_X_ORIGINAL_URL'])) {
			$_SERVER['REQUEST_URI'] = $_SERVER['HTTP_X_ORIGINAL_URL'];
		} elseif (isset($_SERVER['HTTP_X_REWRITE_URL'])) {
			/* IIS Isapi_Rewrite */
			$_SERVER['REQUEST_URI'] = $_SERVER['HTTP_X_REWRITE_URL'];
		} else {
			/* Use ORIG_PATH_INFO if there is no PATH_INFO */
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
function ws_check_php_mysql_versions() {
	global $required_php_version;
	$php_version = phpversion();
	if (version_compare($required_php_version, $php_version, '>')) {
		die('Your server is running PHP version $php_version but WebStats $version requires at least $required_php_version.');
	}
	if (!extension_loaded( 'mysql' )) {
		die('Your PHP installation appears to be missing the MySQL extension which is required by WebStats.');
	}
}
/**
 * Sets the current page url
 */
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
/**
 * Sets the current page url
 *
 * From the admin page.
 *
 */
function adminPageURL() {
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80")
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"]."/admin";
	else
		$pageURL .= $_SERVER["SERVER_NAME"]."/admin";
	return $pageURL;
}
/**
 *
 * Sets a database connection
 *
 *
 *
 */
class DBConfig {
	var $host; var $user; var $pass; var $db; var $db_link; var $conn = false; var $persistant = false; public $error = false;
	public function config(){
		$this->error = true; $this->persistant = true;
	} 
	function conn($host, $user, $pass, $db, $createdb){
		$this->host = $host;
		$this->user = $user;
		$this->pass = $pass;
		$this->db = $db;
        /* Establish the connection. */
		if ($this->persistant)
			$this->db_link = mysqli_connect('p:'.$this->host, $this->user, $this->pass);
		else 
			$this->db_link = mysqli_connect($this->host, $this->user, $this->pass);
		if (!$this->db_link) {
			if ($this->error) {
				$this->error($type=1);
			}
			return false;
		} else {
			if (empty($db)) {
				if ($this->error) {
					$this->error($type=2);
				}
			} else {
				$db = mysqli_select_db($this->db_link, $this->db); /* select db */
				if ((!$db) && ($createdb !== true)) {
					if ($this->error) {
						$this->error($type=2);
					}
					return false;
				}
				if((!$db) && ($createdb === true)) {
					if(mysqli_query($this->db_link, "CREATE DATABASE IF NOT EXISTS `".$this->db."`")){
						echo "Database created :) <br />";
						mysqli_select_db($this->db_link, $this->db);
					} else {
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
	function close() { /* close connection */
		if ($this -> conn) { /* check connection */
			if ($this->persistant) {
				$this -> conn = false;
			} else {
				mysqli_close($this->db_link);
				$this -> conn = false;
			}
		} else {
			if ($this->error) {
				return $this->error($type=4);
			}
		}
	}
	public function error($type='') { /* Choose error type */
		if (empty($type)) {
			return false;
		} else {
			if ($type==1) {
				echo "<strong>Database could not connect</strong> " . "<br />";
			} else if ($type==2) {
				echo "<strong>mysql error</strong> " . mysqli_error($this->db_link) . "<br />";
			} else if ($type==3) {
				echo "<strong>error </strong>, Proses has been stopped" . "<br />";
			} else if ($type==4) {
				echo "<span style='color: red;'>There was an error while connnecting to the MySQL database. Please contact the webmaster (user, password or host incorrect).</span>" . "<br />";
			} else if ($type==5) {
				echo "<span style='color: red;'>There was an error while selecting the database. Please contact the webmaster (database name incorrect).</span>";
			} else {
				echo "Error creating database: " . mysqli_error($this->db_link) . "<br />";
			}
		}
	}
}

/**
 * Sets The Date.
 *
 * @since 3.0
 *
 * @param integer $stamp Time in seconds since 1969.
 */
function get_date($stamp) {
	setlocale(LC_TIME, "usa");
	$datum = date ("d. M 'y", $stamp);
	return $datum;
}

/**
 * Sets Output Format.
 *
 * @since 3.2
 *
 * @param integer $time Time in seconds since 1969.
 */
function get_played($time) {
	$hour = $time / 3600;
	$hour_2 = floor($hour);
	$minute_hour = $hour_2 * 60;
	$minute = $time / 60; 
	$minute_2 = $minute - $minute_hour;
	$minute_3 = floor($minute_2);
	$day = $hour_2 / 24;
	$day_2 = floor($day);
	$hour_3 = $hour_2 - ($day_2 * 24) ;
	$dayholder = 0;
	
	if ($minute_3 <= 9){$minute_3 = '0'.$minute_3;};
	if ($day_2 <= 9){$day_2 = ''.$day_2;};
	if ($hour_3 <= 9){$hour_3 = '0'.$hour_3;};
	if ($hour_2 < 10 && $minute_3 >= 0) {
		$played = "0".$hour_2."<span class='timefont'>h</span> ".$minute_3."<span class='timefont'>m</span>";
	}
	if ($hour_2 >= 10) {
		$played = "".$hour_2."<span class='timefont'>h</span> ".$minute_3."<span class='timefont'>m</span>";
	}
	if (WS_CONFIG_PLAYTIME === true) {
		if ($hour_2 >= 24) {
			$played = "".$day_2."<span class='timefont'>d</span> ".$hour_3."<span class='timefont'>h</span> ".$minute_3."<span class='timefont'>m</span>";
	 	}
	}
	return $played;
}
/**
 * Sets the page numbers.
 *
 * @since 3.0
 *
 * @param integer $numbers Amount of items.
 * @param string $mode Page viewed from to set href links.
 * @param string $sort Optional viewing control behavior to keep the way of sort.
 */
function get_pages($numbers, $mode, $sort) {
	
	$setamount = WS_CONFIG_PAGENUM;
	$numberofpages = array(25, 35, 45, 50, 75, 100);
	for($i=0; $i <= sizeof($numberofpages)-1; $i++){
		if($_GET["NPP"] == $numberofpages[$i]) {
			$dropdownselected = ("<option value='".$numberofpages[$i]."' SELECTED>".$numberofpages[$i]."</option>");
		} else 
			$dropdown .= "<option value='".$numberofpages[$i]."'>".$numberofpages[$i]."</option>";
	}
	if(!isset($_GET["page"])){$_GET["page"] = 1;}
	$output = '<div style="margin:auto;" align="center"><form class="custom">';
	if(isset($_GET["mode"])){$inputmode = $_GET["mode"];} else {$inputmode = WS_CONFIG_MODULE;}
	$output .= '<input name="mode" type="hidden" value="'.$inputmode.'"/>';
	if(isset($_GET["sort"])){$inputsort = $_GET["sort"];} else {$inputsort = 'player';}
	$output .= '<input name="sort" type="hidden" value="'.$inputsort.'"/>';
	$output .=	'<select onchange="this.form.submit();" style="display:none;" id="customDropdown" class="select2" title="Number of items per page" name="NPP">
					'.$dropdownselected.$dropdown.'
				 </select>';
	if(isset($_GET["NPP"])) {
		$numbers = ceil($numbers / $_GET["NPP"]);
	} else {
		if(isset($setamount)) {
			$_GET["NPP"] = $setamount;
			$numbers = ceil($numbers / $setamount);
		} else {
			$numbers = ceil($numbers / 25);
		}
	}
	$output .= '<table class="pagination"><tbody><tr valign="top">';
		if(isset($_GET["page"])) {
			if(1 == $numbers) {
				$pages = '<td style="margin-left:50px;" class="arrow unavailable">&laquo;</td>';
				$pages .= '<td style="background: #f5f5f5;" class="current"><a href="#">1</span></td>';
				$pages .='<td class="arrow unavailable">&raquo;</td>';
			} elseif(($_GET["page"] <= 6) && ($_GET["page"] != $numbers)) {
				if($_GET["page"]==1) {
					$pages = '<td style="margin-left:50px;" class="arrow unavailable">&laquo;</td>';
					$pages .= '<td style="background: #f5f5f5;" class="current"><a href="#">1</a></td>';
				} else {
					$pages = '<td class="arrow"><a href="?mode='.$mode.'&page='.($_GET["page"]-1).'&sort='.$sort.'&NPP='.$_GET["NPP"].'">&laquo;</a></td>';
					$pages .= '<td><a href="?mode='.$mode.'&page=1&sort='.$sort.'&NPP='.$_GET["NPP"].'">1</a></td>';
				}
				if($numbers >= 10) {
					for($i=1; $i < 10; $i++) {
						$page = $i + 1;
						if($_GET["page"]==$page) {
							$pages .= '<td style="background: #f5f5f5;" class="current"><a href="#">'.$page.'</a></td>';
						} else {
							$pages .= '<td><a href="?mode='.$mode.'&page='.$page.'&sort='.$sort.'&NPP='.$_GET["NPP"].'">'.$page.'</a></td>';
						}
					}
				} else {
					for($i=2; $i <= $numbers; $i++) {
						if($_GET["page"]==$i) {
							$pages .= '<td style="background: #f5f5f5;" class="current"><a href="#">'.$i.'</a></td>';
						} else {
							$pages .= '<td><a href="?mode='.$mode.'&page='.$i.'&sort='.$sort.'&NPP='.$_GET["NPP"].'">'.$i.'</a></td>';
						}
					}
				}
				if($_GET["page"] < $numbers) {
					$pages .='<td class="arrow"><a href="?mode='.$mode.'&page='.($_GET["page"] + 1).'&sort='.$sort.'&NPP='.$_GET["NPP"].'">&raquo;</a></td>';
				} else {
					$pages .='<td class="arrow unavailable"><a href="">&raquo;</a></td>';
				}
			} elseif(($_GET["page"] >= 7) && ($_GET["page"] <= ($numbers-5))) {
				$pages = '<td class="arrow"><a href="?mode='.$mode.'&page='.($_GET["page"]-1).'&sort='.$sort.'&NPP='.$_GET["NPP"].'">&laquo;</a></td>';
				$pages .= '<td><a href="?mode='.$mode.'&page=1&sort='.$sort.'&NPP='.$_GET["NPP"].'">1</a></td>';
				$pages .= '<td class="unavailable">&hellip;</td>';
				for($i=($_GET["page"]-5); $i < ($_GET["page"]+4); $i++) {
					$page = $i + 1;
					if($_GET["page"]==$page) {
						$pages .= '<td style="background: #f5f5f5;" class="current"><a href="#">'.$page.'</a></td>';
					} else {
						$pages .= '<td><a href="?mode='.$mode.'&page='.$page.'&sort='.$sort.'&NPP='.$_GET["NPP"].'">'.$page.'</a></td>';
					}
				}
				$pages .= '<td class="unavailable">&hellip;</td>';
				$pages .= '<td><a href="?mode='.$mode.'&page='.$numbers.'&sort='.$sort.'&NPP='.$_GET["NPP"].'">'.floor($numbers).'</a></td>';
				$pages .='<td class="arrow"><a href="?mode='.$mode.'&page='.($_GET["page"] + 1).'&sort='.$sort.'&NPP='.$_GET["NPP"].'">&raquo;</a></td>';
			} elseif(($_GET["page"] < $numbers) && ($_GET["page"] >= ($numbers-5))) {
				$pages = '<td class="arrow"><a href="">&laquo;</a></td>';
				$pages .= '<td><a href="?mode='.$mode.'&page=1&sort='.$sort.'&NPP='.$_GET["NPP"].'">1</a></td>';
				$pages .= '<td class="unavailable">&hellip;</td>';
				for($i=($_GET["page"]-5); $i < $numbers; $i++) {
					$page = $i + 1;	
					if($_GET["page"]==$page){
						$pages .= '<td style="background: #f5f5f5;" class="current"><a href="#">'.$page.'</a></td>';
					} else {
						$pages .= '<td><a href="?mode='.$mode.'&page='.$page.'&sort='.$sort.'&NPP='.$_GET["NPP"].'">'.$page.'</a></td>';
					}
				}
				$pages .='<td class="arrow"><a href="">&raquo;</a></td>';
			} elseif($_GET["page"] > $numbers) {
				if (($_GET["page"]-5) == 1) {
					$pages = '<td class="arrow unavailable">&laquo;</td>';
					$pages .= '<td><a href="?mode='.$mode.'&page=1&sort='.$sort.'&NPP='.$_GET["NPP"].'">1</a></td>';
				} else {
					$pages = '<td class="arrow unavailable"><a href="?mode='.$mode.'&page='.($_GET["page"]-1).'&sort='.$sort.'&NPP='.$_GET["NPP"].'">&laquo;</a></td>';
					$pages .= '<td><a href="?mode='.$mode.'&page=1&sort='.$sort.'&NPP='.$_GET["NPP"].'">1</a></td>';
					$pages .= '<td class="unavailable">&hellip;</td>';
					for($i=$size; $i < $numbers; $i++) {
						if($_GET["page"]==$i) {
							$pages .= '<td style="background: #f5f5f5;" class="current"><a href="#">'.$i.'</a></td>';
						} else {
							$pages .= '<td><a href="?mode='.$mode.'&page='.$i.'&sort='.$sort.'&NPP='.$_GET["NPP"].'">'.$i.'</a></td>';
						}
					}
				}
				for($i=5;$i >= 2; $i--) {
					if((($_GET["page"]-$i) >= 1)){$size = $_GET["page"]-$i; break 1;}
				}
				$pages .='<td class="arrow unavailable">&raquo;</td>';
			} elseif(($_GET["page"] == $numbers) && ($numbers <= 9)) {
				$pages = '<td class="arrow"><a href="?mode='.$mode.'&page='.($_GET["page"]-1).'&sort='.$sort.'&NPP='.$_GET["NPP"].'">&laquo;</a></td>';
				$pages .= '<td><a href="?mode='.$mode.'&page=1&sort='.$sort.'&NPP='.$_GET["NPP"].'">1</a></td>';
					for($i=2; $i <= $numbers; $i++) {
						if($_GET["page"]==$i) {
							$pages .= '<td style="background: #f5f5f5;" class="current"><a href="#">'.$i.'</a></td>';
						} else {
							$pages .= '<td><a href="?mode='.$mode.'&page='.$i.'&sort='.$sort.'&NPP='.$_GET["NPP"].'">'.$i.'</a></td>';
						}
					}
				$pages .='<td class="arrow unavailable">&raquo;</td>';
			} elseif(($_GET["page"] == $numbers) && ($numbers > 9)) {
				$pages = '<td class="arrow"><a href="">&laquo;</a></td>';
				$pages .= '<td><a href="?mode='.$mode.'&page=1&sort='.$sort.'&NPP='.$_GET["NPP"].'">1</a></td>';
				$pages .= '<td class="unavailable">&hellip;</td>';
				for($i=($_GET["page"]-5); $i < $numbers; $i++) {
					$page = $i + 1;	
					if($_GET["page"]==$page){
						$pages .= '<td style="background: #f5f5f5;" class="current"><a href="#">'.$page.'</a></td>';
					} else {
						$pages .= '<td><a href="?mode='.$mode.'&page='.$page.'&sort='.$sort.'&NPP='.$_GET["NPP"].'">'.$page.'</a></td>';
					}
				}
				$pages .='<td class="arrow unavailable">&raquo;</td>';
			}
		} else {
			$pages = '<td class="arrow unavailable">&laquo;</td>';
			$pages .= '<td style="background: #f5f5f5;" class="current"><a href="#">1</a></td>';
			if($numbers >= 10) {
				for($i=1; $i <= 10; $i++) {
					if($i==$_GET["page"]){
						$pages .= '<td style="background: #f5f5f5;" class="current"><a href="#">'.$i.'</a></td>';
					} else {
						$pages .= '<td><a href="?mode='.$mode.'&page='.$i.'&sort='.$sort.'&NPP='.$_GET["NPP"].'">'.$i.'</a></td>';
					}
				}
				$pages .='<td class="arrow"><a href="?mode='.$mode.'&page=2&sort='.$sort.'&NPP='.$_GET["NPP"].'">&raquo;</a></td>';
			} else {
				for($i=2; $i <= $numbers; $i++) {
					$pages .= '<td><a href="?mode='.$mode.'&page='.$i.'&sort='.$sort.'&NPP='.$_GET["NPP"].'">'.$i.'</a></td>';
				}
				$pages .='<td class="arrow unavailable">&raquo;</td>';
			}		
		}
		if(isset($_GET["page"])){$inputpage = $_GET["page"];} else {$inputpage = 1;}
		$pages .='<td class="input"><input style="margin:0 0 0 0; width: 40px;" maxlength="20" name="page" type="text" value="'.$inputpage.'"/></td>';
    $output .= $pages.'</tr></tbody></table></form></div>';

	return $output;
}

function get_tag($tag,$xml) {
	preg_match_all('/<'.$tag.'>(.*)<\/'.$tag.'>$/imU',$xml,$match);
	return $match[1];
}
/**
 * This function will check whether the visitor is a search engine robot.
 *
 * @since 3.0
 *
 */
function is_bot() {
	$botlist = array("Teoma", "alexa", "froogle", "Gigabot", "inktomi",
	"looksmart", "URL_Spider_SQL", "Firefly", "NationalDirectory",
	"Ask Jeeves", "TECNOSEEK", "InfoSeek", "WebFindBot", "girafabot",
	"crawler", "www.galaxy.com", "Googlebot", "Scooter", "Slurp",
	"msnbot", "appie", "FAST", "WebBug", "Spade", "ZyBorg", "rabaz",
	"Baiduspider", "Feedfetcher-Google", "TechnoratiSnoop", "Rankivabot",
	"Mediapartners-Google", "Sogou web spider", "WebAlta Crawler","TweetmemeBot",
	"Butterfly","Twitturls","Me.dium","Twiceler");
	foreach($botlist as $bot) {
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
function ws_die($message = '', $title = '', $args = array()) {
	$function ='_default_ws_die_handler';
	call_user_func( $function, $message, $title, $args );
}
/**
 * Kill WebStats execution and display HTML message with error message.
 *
 * This is the default handler for ws_die if you want a custom one for your
 * site then you can overload using the wp_die_handler filter in wp_die
 *
 * @since 3.0
 * @access private
 *
 * @param string $message Error message.
 * @param string $title Error title.
 * @param string|array $args Optional arguments to control behavior.
 */
function _default_ws_die_handler($message, $title = '', $args = array()) {
	$defaults = array( 'response' => 500 );
	$message = "<p>$message</p>";
	$back_text = ('&laquo; Back');
	$message .= "\n<p><a href='javascript:history.back()'>$back_text</a></p>";
	header( 'Content-Type: text/html; charset=utf-8' );
	if(empty($title)) {$title = 'Web Stats &rsaquo; Error';}
echo <<<END
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>$title</title>
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
	$message
</body>
</html>
END;
	die();
}
?>