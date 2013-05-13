<?php
/*  Copyright 2012-2013 Nick Smith. All rights reserved. */

$LOG = false; /* Do you want to run a log on this php file. */
$XML = true;
$PHPTEST = false;
$forever = false;
$DUMP = false;

if(file_exists('config/config.php'))
	include_once('config/config.php');
else
	header("location:admin/setup-config.php");
require_once('include/functions.php');
require_once('include/version.php');

ignore_user_abort(1); /*  run script in background  */
set_time_limit(0); /*  run script forever  */
$interval = 60*30; /*  time in sec...  */
$file = 'include/lastrun.log';
/**
 * Encode text as UTF-8
 *
 * @param text the text to encode
 * @return the encoded text, as UTF-8
 */
function create_guid() {     
	$data = $_SERVER['SERVER_NAME'];
    $hash = strtoupper(hash('md5', md5($data)));
    $guid = substr($hash,  0,  8) . '-' . substr($hash,  8,  4) . '-' . substr($hash, 12,  4) . '-' . substr($hash, 16,  4) . '-' . substr($hash, 20, 12);
    return $guid;
}
final class WebStatsXML{
	protected $errors = array();
	public function __construct(){}
	public function __destruct(){}
	public function getLastRun(){
		return $this->getResult('RequestTime');
	}
	private function getResult($name){
		$xml = @file_get_contents('include/write.xml');
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
	return;
	}
}
$LASTRUNINFO = new WebStatsXML;
$lastRun = $LASTRUNINFO->getLastRun('RequestTime');

function encode($text){
	$encode = htmlentities($text, ENT_NOQUOTES, "UTF-8");
	return $encode;
}
/**
 * <p>Encode a key/value data pair to be used in a HTTP post request. This INCLUDES a & so the first
 * key/value pair MUST be included manually, e.g:</p>
 * <code>
 * StringBuffer data = new StringBuffer();
 * data.append(encode("guid")).append('=').append(encode(guid));
 * encodeDataPair(data, "version", description.getVersion());
 * </code>
 *
 * @param buffer the stringbuilder to append the data pair onto
 * @param key the key value
 * @param value the value
 */
function encodeDataPair($key, $value){
	$buffer = "&".encode($key)."=".encode($value);
	return $buffer;
}
/**
 * The current revision number
 */
define(REVISION, strval("6"));
/**
 * The base url of the metrics domain
 */
define(BASE_URL, "http://mcstats.org");
 /**
 * The url used to report a server's status
 */
define(REPORT_URL, '/report/%s');

/* Server software specific section */
define(description, "Minecraft Stats WebPage");
define(pluginName, "WebStats");
define(onlineMode, true);
define(pluginVersion, $version);
define(serverVersion, phpversion());
/* define(serverVersion, "git-Bukkit-1.4.5-R0.2-b2488jnks+%28MC%3A+1.4.5%29"); */
define(PLOTTER, "1");
/* The plugin's description file containg all of the plugin data such as name, version, author, etc */

/* Users Online */
if(iptracker === true){
	$DB = new DBConfig();
	$DB -> config();
	$DB -> conn(WS_MySQL_DBHOST.":".WS_MySQL_PORT, WS_MySQL_USERNAME, WS_MySQL_PASSWORD, WS_MySQL_DB, true);
	mysql_query("UPDATE stats SET online = 0 WHERE dt<SUBTIME(NOW(),'0 0:30:0')");
	list($playersOnline) = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM stats WHERE online='1'"));
	define(playersOnline, $playersOnline);
	$DB -> close();
}else{define(playersOnline, "1");}
/* New data as of R6 */
if(isset($_ENV["OS"])){
	define(osname, $_ENV["OS"]);
} else {
	define(osname, "Windows+8");
}
$osarch = $_SERVER["PROCESSOR_ARCHITEW6432"];
if($osarch =="AMD64"){$osarch = "x86_64";}
define(osversion, "6.2");
define(java_version, "1.7.0_09");
if(isset($_ENV["NUMBER_OF_PROCESSORS"])){
	define(coreCount, $_ENV["NUMBER_OF_PROCESSORS"]);
} else {
	define(coreCount, 'unknown');
}
/**
 * Data Variable creation start
 */
$data = encode("guid")."=".encode(create_guid());
$data .= encodeDataPair("version", pluginVersion);
$data .= encodeDataPair("server", serverVersion);
$data .= encodeDataPair("players", playersOnline);
$data .= encodeDataPair("revision", REVISION);
$data .= encodeDataPair("osname", osname);
$data .= encodeDataPair("osarch", $osarch);
$data .= encodeDataPair("osversion", osversion);
$data .= encodeDataPair("cores", coreCount);
$data .= encodeDataPair("online-mode", onlineMode);
$data .= encodeDataPair("java_version", java_version);
if (!isset($lastRun["Ping"]) || ($lastRun["Ping"] == "0")) {encodeDataPair(data, "ping", "0");}
else{encodeDataPair(data, "ping", "1");}
/* Create the url */
$URL = BASE_URL.sprintf(REPORT_URL, encode(pluginName));
if($LOG === true){
$current = "---------------------------------------------------\n\nTotal People Online: ".$playersOnline
	."\nServer Name: ".$_SERVER['SERVER_NAME']
	."\nRemote Address: ".$_SERVER['REMOTE_ADDR']
	."\nUser Agent: ".$_SERVER['HTTP_USER_AGENT']
	."\nRemote Port: ".$_SERVER['REMOTE_PORT']
	."\nRequest Time: ".$_SERVER['REQUEST_TIME']
	."\n------------------------------\n\n"
	.create_guid()
	."\n\n------------------------------\n"
	."\nBASE URL + REPORT URL: ".$URL
	."\nData for $_POST: ".$data;
	file_put_contents($file, $current, FILE_APPEND | LOCK_EX);
}

$url = 'http://mcstats.org/signature/webstats.png';
$img = 'images/image-cache/webstats.png';
file_put_contents($img, file_get_contents($url));

if($XML === true && (($lastRun["RequestTime"]+$interval) < time())){
    $domtree = new DOMDocument('1.0', 'UTF-8');
	$domtree->formatOutput = true; 
    $xmlRoot = $domtree->createElement("CURRENTRUN");
    $xmlRoot = $domtree->appendChild($xmlRoot);
	$date= date('l jS \of F Y h:i:s A');
	$xmlRoot->appendChild($domtree->createElement('Date', $date));
	$xmlRoot->appendChild($domtree->createElement('TotalPeopleOnline', $playersOnline));
	$xmlRoot->appendChild($domtree->createElement('ImageCacheTimes', ($lastRun["ImageCacheTimes"]+1)));
	if((($lastRun["RequestTime"]+(60*60*24)) < time()) || !isset($lastRun["Ping"])){
		$xmlRoot->appendChild($domtree->createElement('Ping', '0'));
	}
	else{
		$xmlRoot->appendChild($domtree->createElement('Ping', '1'));
	}
	if($lastRun["Ping"]=="1"){
		$xmlRoot->appendChild($domtree->createElement('NumberOfPings', ($lastRun["NumberOfPings"]+1)));
	} else {
		$xmlRoot->appendChild($domtree->createElement('NumberOfServerStarts', ($lastRun["NumberOfServerStarts"]+1)));
	}
	$xmlRoot->appendChild($domtree->createElement('ServerName', $_SERVER['SERVER_NAME']));
	$xmlRoot->appendChild($domtree->createElement('RemoteAddress', $_SERVER['REMOTE_ADDR']));
    $xmlRoot->appendChild($domtree->createElement('UserAgent', $_SERVER['HTTP_USER_AGENT']));
    $xmlRoot->appendChild($domtree->createElement('RemotePort', $_SERVER['REMOTE_PORT']));
    $xmlRoot->appendChild($domtree->createElement('RequestTime', $_SERVER['REQUEST_TIME']));
	$xmlRoot->appendChild($domtree->createElement('GUID', create_guid()));
	$xmlRoot->appendChild($domtree->createElement('BASEREPORTURL', $URL));
	$xmlRoot->appendChild($domtree->createElement('DATA', $data));
	$domtree->save("include/write.xml");
}
function get_web_page( $URL, $data ){
    $options = array(
		CURLOPT_URL            => $URL,					/* set URL and other appropriate options. */
		CURLOPT_POST           => true,					/* curl_setopt($ch, CURLOPT_POST, true); */
		CURLOPT_POSTFIELDS     => $data,				/* Sets the post fields. */
        CURLOPT_RETURNTRANSFER => true,					/* Should cURL return or print out the data? (true = return, false = print). */
        CURLOPT_HEADER         => false,				/* Include header in result? (0 = yes, 1 = no) */
        CURLOPT_FOLLOWLOCATION => true,					/* follow redirects */
        CURLOPT_ENCODING       => "",					/* handle all encodings */
        CURLOPT_USERAGENT      => $_SERVER["HTTP_USER_AGENT"]." /WebStats Project by cky2250", /* User agent */
        CURLOPT_AUTOREFERER    => true,					/* set referer on redirect */
        CURLOPT_CONNECTTIMEOUT => 2,					/* timeout on connect */
		CURLOPT_HTTPHEADER     => array('Accept-Charset: UTF-8;'),
		CURLOPT_REFERER        => "http://MRPLOWSWEBSTATS.us",	/* Sets a referer. */
    );
    $ch      = curl_init();
    curl_setopt_array( $ch, $options );
    $content = curl_exec($ch);
    $err     = curl_errno($ch);
    $errmsg  = curl_error($ch);
    $header  = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
    curl_close( $ch );
    $header['errno']   = $err;
    $header['errmsg']  = $errmsg;
    $header['content'] = json_decode($content);
    return $header;
}
if(isset($interval) && ($forever === true)){
	while(1){
		if(connection_status() != CONNECTION_NORMAL){break;}
		if (function_exists('curl_init')) {
			$response = get_web_page ($URL, $data);
		}
		sleep($interval);
	}
} elseif(isset($interval) && ($forever === false)) {
	if(($lastRun["RequestTime"]+$interval) < time()){
		if (function_exists('curl_init')) {	 
			$response = get_web_page($URL,$data);
			if($DUMP === true){
				echo var_dump($response);
			}
		}
	}
	if($PHPTEST === true) {
		echo "<br /><br />Total People Online: ".$playersOnline."<br />Server Name: ".$_SERVER['SERVER_NAME']."<br />Remote Address: ".$_SERVER['REMOTE_ADDR']."<br />User Agent: ".$_SERVER['HTTP_USER_AGENT']."<br />Remote Port: ".$_SERVER['REMOTE_PORT']."<br /> Request Time: ".$_SERVER['REQUEST_TIME']."<br />------------------------------<br /><br />".create_guid()."<br /><br />------------------------------<br />".$URL."<br />".$data."<br />".$site."<br />";
	}
} else {
	if (function_exists('curl_init')) {	 
		$response = get_web_page($URL,$data);
		if($DUMP === true){
			echo var_dump($response);
		}
	}
	if($PHPTEST === true){
		echo "<br /><br />Total People Online: ".$playersOnline."<br />Server Name: ".$_SERVER['SERVER_NAME']."<br />Remote Address: ".$_SERVER['REMOTE_ADDR']."<br />User Agent: ".$_SERVER['HTTP_USER_AGENT']."<br />Remote Port: ".$_SERVER['REMOTE_PORT']."<br /> Request Time: ".$_SERVER['REQUEST_TIME']."<br />------------------------------<br /><br />".create_guid()."<br /><br />------------------------------<br />".$URL."<br />".$data."<br />".$site."<br />";
	}
}
?>