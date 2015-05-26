<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
	<meta name="author" lang="en" content="cky2250 (admin@mrplows-server.tk)" />
	<meta content='minecraft stats' name='description' />
	<meta content='minecraft, stats, bukkit, mrplow, cky2250' name='keywords'/>
	<title>ADMIN PAGE - ACHIEVEMENT-INSTALLER</title>
	<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js'></script>
	<link rel="stylesheet" type="text/css" href="../../css/layout.css"/>
	<link rel="SHORTCUT ICON" type='image/x-icon' href="../../images/favicon.ico"/>
	<link rel="apple-touch-icon" href="../../images/favicon.png" />
	<!--[if lt IE 9]> <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script> <![endif]-->
</head>
<body style="background-color:rgb(228, 228, 228);">

<div class="content_maintable_stats" style="padding-top: 25px; padding-bottom: 25px;">  

<?php

include('../../config/config.php');
include('../../include/functions.php');

$testing = $_GET['alert'];
$testing = (string)$testing;
if($testing == 'FALSE') {$testing=FALSE;}
else{}

if($testing == FALSE) {
?>
	<p>This will Delete your data in the achievements MySQL. Do you confirm?</p>
	<form>
		<button type="button" style="cursor:url(../../images/cursors/hover.cur),auto;" onClick="location.href='index.php?alert=TRUE'">Yes</button>
		<button type="button" style="cursor:url(../../images/cursors/hover.cur),auto;" onClick="location.href='../index.php'" >No</button>
	</form>
<?php
} else {
	echo 'installing...<br/><br/>';
}

$bool = strtolower($_GET['alert']);

$bool = ($bool=='yes' or $bool=='true'  or $bool=='correct'
       or $bool=='on'  or $bool=='right'  or $bool=='positive'
       or $bool=='yup' or $bool=='uh-huh' or $bool=='sure'
       or $bool===true);

if($bool === TRUE)
{
?>
	<div style="clear:both; text-align:left;">
		<table>
			<tr> 
				<td width="30px" style="padding: 2px; vertical-align: middle; height: 10px; border-left:2px solid #511B00; border-top:2px solid #511B00; border-bottom:2px solid #511B00;">
					<div align="left"><b>Num:</b></div>
				</td>
				<td width="175px" style="padding: 2px; vertical-align: middle; height: 25px; border-top:2px solid #511B00; border-bottom:2px solid #511B00;">
					<div align="center"><b>Name:</b></div>
				</td>
				<td width="25px" style="padding: 2px; vertical-align: middle; height: 25px; border-top:2px solid #511B00; border-bottom:2px solid #511B00;">
					<div align="center"><b>Points:</b></div>
				</td>
				<td width="100px" style="padding: 2px; vertical-align: middle; height: 25px; border-top:2px solid #511B00; border-bottom:2px solid #511B00;">
					<div align="center"><b>Category:</b></div>
				</td>
				<td width="50px" style="padding: 2px; vertical-align: middle; height: 25px; border-top:2px solid #511B00; border-bottom:2px solid #511B00;">
					<div align="center"><b>Stat:</b></div>
				</td>
				<td width="100px" style="padding: 2px; vertical-align: middle; height: 25px; border-top:2px solid #511B00; border-bottom:2px solid #511B00;">
					<div align="center"><b>Value:</b></div>
				</td>
				<td width="125px" style="padding: 2px; vertical-align: middle; height: 25px; border-top:2px solid #511B00; border-bottom:2px solid #511B00;">
					<div align="center"><b>Reward:</b></div> 
				</td>
				<td width="85px" style="padding: 2px; vertical-align: middle; height: 25px; border-right:2px solid #511B00; border-top:2px solid #511B00; border-bottom:2px solid #511B00;">
					<div align="right"><b>Amount:</b></div>
				</td>
           	</tr>
		</table>
		<br/><br/>
	</div>
<?php

$link = mysqli_connect(WS_CONFIG_DBHOST, WS_CONFIG_DBUNAME, WS_CONFIG_DBPASS, WS_CONFIG_DBNAME, WS_CONFIG_DBPORT);

$query = mysqli_query($link, "DROP TABLE IF EXISTS ".WS_CONFIG_ACHIEVEMENTS."");

$query2 = mysqli_query($link, "CREATE TABLE ".WS_CONFIG_ACHIEVEMENTS." (
`ws_a_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`ws_a_name` TEXT NOT NULL ,
`ws_a_points` INT NULL ,
`ws_a_category` TEXT NOT NULL ,
`ws_a_stat` TEXT NULL ,
`ws_a_value` INT NOT NULL ,
`ws_a_description` TEXT NULL ,
`ws_a_reward` TEXT NULL ,
`ws_a_amount` INT NULL 
)");

if($query) {}
else {echo mysqli_error($link); echo '$query';}
if($query2) {}
else {echo mysqli_error($link); echo '$query2';}

$row = 1;                        
$handle = fopen ("achievements.txt","r");            
while ( ($data = fgetcsv ($handle, 1000, ":")) !== FALSE ) {
   $num = count ($data);                     
                                               
   if((strpos($data[0],"#")!==false) or (!isset($data[0]))) {
   
   }
   else {
	$data[7] = str_replace(' ', '*', $data[7]);
	$reward = explode('*',$data[7]);
	if ($reward[2] == '' or !isset($reward[2])) {
		$reward[2] = ''.$reward[1].'';
	}
	else {
		$reward[0] = ''.$reward[0].' '.$reward[1].''; 
		$temp = explode(' ', $reward[0]); 
		$reward[0] = $temp[1];
	}

	$iquery = mysqli_query($link, "INSERT INTO ".WS_CONFIG_ACHIEVEMENTS." (ws_a_name, ws_a_points, ws_a_category, ws_a_stat, ws_a_value, ws_a_description, ws_a_reward, ws_a_amount) VALUES ('$data[1]', '$data[2]', '$data[3]', '$data[4]', '$data[5]', '$data[6]', '$reward[0]', '$reward[2]')");

	echo'
	<div class="content_maintable_stats" style="padding-top: 5px; padding-bottom: 5px; clear:both; text-align:left;">
		<table>
			<tr> 
				<td width="30px" style="padding: 2px; vertical-align: middle; height: 10px; border-left:2px solid #511B00; border-top:2px solid #511B00; border-bottom:2px solid #511B00;">
					<div align="left"><b>'.$row.'</b></div>
				</td>
				<td width="175px" style="padding: 2px; vertical-align: middle; height: 25px; border-top:2px solid #511B00; border-bottom:2px solid #511B00;">
					<div align="center"><b>'.$data[1].'</b></div>
				</td>
				<td width="25px" style="padding: 2px; vertical-align: middle; height: 25px; border-top:2px solid #511B00; border-bottom:2px solid #511B00;">
					<div align="center"><b>'.$data[2].'</b></div>
				</td>
				<td width="100px" style="padding: 2px; vertical-align: middle; height: 25px; border-top:2px solid #511B00; border-bottom:2px solid #511B00;">
					<div align="center"><b>'.$data[3].'</b></div>
				</td>
				<td width="50px" style="padding: 2px; vertical-align: middle; height: 25px; border-top:2px solid #511B00; border-bottom:2px solid #511B00;">
					<div align="center"><b>'.$data[4].'</b></div>
				</td>
				<td width="100px" style="padding: 2px; vertical-align: middle; height: 25px; border-top:2px solid #511B00; border-bottom:2px solid #511B00;">
					<div align="center"><b>'.$data[5].'</b></div>
				</td>
				<td width="125px" style="padding: 2px; vertical-align: middle; height: 25px; border-top:2px solid #511B00; border-bottom:2px solid #511B00;">

					<div align="center"><b>'.$reward[0].'</b></div>
				</td>
				<td width="85px" style="padding: 2px; vertical-align: middle; height: 25px; border-right:2px solid #511B00; border-top:2px solid #511B00; border-bottom:2px solid #511B00;">
					<div align="right"><b>'.$reward[2].'</b></div>
				</td>
           	</tr>
		</table>
	</div>';
	$row++;
   }
}
	if($iquery) {
		echo ("<script type='text/javascript' src='js/Success.js'></script>");
		mysqli_close($link);
		rename("index.php", "index.installed"); 
	} else {
		echo mysqli_error($link);
		mysqli_close($link);
	}
fclose ($handle);
}
?>
</div>
</body>
</html>