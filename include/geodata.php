<?php
if(file_exists('../config/config.php'))
	include_once '../config/config.php';
require "../include/functions.php";
// We don't want web bots accessing this page:
if(is_bot()) die();

$link = mysqli_connect('p:'.WS_CONFIG_DBHOST, WS_CONFIG_DBUNAME, WS_CONFIG_DBPASS, WS_CONFIG_DBNAME, WS_CONFIG_DBPORT);

// Selecting the top 15 countries with the most visitors:

$result = mysqli_query($link, "	SELECT `countrycode`,`country`, COUNT(`IP`) AS `total`
						FROM `ip_stats`
						WHERE `online` = 1
						GROUP BY `countrycode`
						ORDER BY `total` DESC
						LIMIT 15");
while($row=mysqli_fetch_array($result, MYSQLI_BOTH)) {
	echo '
	<div class="geoRow">
		<div class="flag"><img src="images/countryflags/'.strtolower($row['countrycode']).'.gif" width="16" height="11" /></div>
		<div class="country" title="'.htmlspecialchars($row['country']).'">'.$row['country'].'</div>
		<div class="people">'.$row['total'].'</div>
	</div>
	';
}
mysqli_close($link);
?>