<?php
error_reporting(0);
include_once('../config/config.php');
function pingDomain($domain) {
    $starttime = microtime(true);
    $file      = fsockopen ($domain, 80, $errno, $errstr, 1);
    $stoptime  = microtime(true);
    $status    = 0;

    if (!$file) {
		fclose($file);
        $status = -1;  //Site is down
    } else {
        fclose($file);
        $status = ($stoptime - $starttime) * 1000;
        $status = floor($status);
    }
    return $status;
}
function pingMineServ($domain, $port) {
    $starttime = microtime(true);
    $file      = fsockopen ($domain, $port, $errno, $errstr, 1);
    $stoptime  = microtime(true);
    $status    = 0;

    if (!$file) {
		fclose($file);
        $status = -1;
    } else {
        fclose($file);
        $status = ($stoptime - $starttime) * 1000;
        $status = floor($status);
    }
    return $status;
}
$status = pingDomain(MQ_SERVER_ADDR); //This Is To Get The Ping Of The Server - Only use if minecraft server is not hosted near web server. or would resualt in very low ping for everyone
$minecraftServer = pingMineServ(MQ_SERVER_ADDR, MQ_SERVER_PORT);
//$status = pingDomain($_SERVER['REMOTE_ADDR']); //This Is To Get Ping Of The User - use if minecraft server is hosted on the web server.
//echo $minecraftServer;
if($status > 0 && $status <= 45 && $minecraftServer !== -1) {
	$pingtext = 'Ping: '.$status;
	$ping = 5;
} elseif($status > 45 && $status <= 100 && $minecraftServer !== -1) {
	$ping = 4;
	$pingtext = 'Ping: '.$status;
} elseif($status > 100 && $status <= 200 && $minecraftServer !== -1) {
	$ping = 3;
	$pingtext = 'Ping: '.$status;
} elseif($status > 200 && $status <= 300 && $minecraftServer !== -1) {
	$ping = 2;
	$pingtext = 'Ping: '.$status;
} elseif($status > 300 && $status <= 5000 && $minecraftServer !== -1) {
	$ping = 1;
	$pingtext = 'Ping: '.$status;
} else {
	$pingtext = 'Offline';
}
?>