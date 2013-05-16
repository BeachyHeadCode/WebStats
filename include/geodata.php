<?php
require_once 'functions.php';
if(file_exists('../config/config.php'))
	include_once '../config/config.php';
// We don't want web bots accessing this page:
if(is_bot()) die();

$DB = new DBConfig();
	$DB -> config();
	$DB -> conn(WS_MySQL_DBHOST.":".WS_MySQL_PORT, WS_MySQL_USERNAME, WS_MySQL_PASSWORD, WS_MySQL_DB, true);
// Selecting the top 15 countries with the most visitors:
$result = mysql_query("	SELECT `countrycode`,`country`, COUNT(`IP`) AS `total`
						FROM `ip_stats`
						WHERE `online` = 1
						GROUP BY `countrycode`
						ORDER BY `total` DESC
						LIMIT 15");

while($row=mysql_fetch_assoc($result))
{
	echo '
	<div class="geoRow">
		<div class="flag"><img src="images/countryflags/'.strtolower($row['countrycode']).'.gif" width="16" height="11" /></div>
		<div class="country" title="'.htmlspecialchars($row['country']).'">'.$row['country'].'</div>
		<div class="people">'.$row['total'].'</div>
	</div>
	';
}
$DB -> close();
?>