<?php 
//Developed by Nick Smith, 'aka' cky nick254, 'aka' mrplow, 'aka' cky2250, mrplows-server.tk, Webstats for Minecraft (c) 2011-2013
//Please help me out in any way with any *type* ~ hint of payments that do not require paypal. My webstie is http://mrplows-server.tk.
//Current source for info https://github.com/cky2250/WebStats/

//Sets up the MySQL Database and info to reach it to access the MySQL tables used in this project.
define('WS_MySQL_DBHOST', 'localhost');
define('WS_MySQL_PORT', '3306');
define('WS_MySQL_USERNAME', 'root');
define('WS_MySQL_PASSWORD', 'password');
define('WS_MySQL_DB', 'WebStats');

//Sets up the MySQL Database locations for the Minecraft plug-ins.
define('WS_CONFIG_DBHOST', 'localhost');
define('WS_CONFIG_DBPORT', '3306');
define('WS_CONFIG_DBUNAME', 'root');
define('WS_CONFIG_DBPASS', 'password');
define('WS_CONFIG_DBNAME', 'minecraft');

//Sets up the Minecraft Server location for the dynamic photo and popup windows to reach the server.
define('MQ_SERVER_ADDR', 'localhost');
define('MQ_SERVER_PORT', '25565');
define('MQ_TIMEOUT', '1');

//Default Server Name   Just optical, it's shown at the stats-page.
define('WS_CONFIG_SERVER', 'Mr. Plow&#039;s Server');

//Default Title Of The Website.
define('WS_OPTICAL_TITLE', 'Mr. Plow&#039;s Server');

//Default Title Of The Website Tab.
$WS_OPTICAL_TAB_TITLE='Mr. Plow&#039;s Server - Webstatistic for Minecraft';

//Default Module (default: stats)   put in the name of your favorite module (folder-name).
define('WS_CONFIG_MODULE', 'stats3-lolmewn');

//Default Background (e.g. sand, rock, dirt, obsidian, bluefade, grayfade, greenfade, blackfade...).
define('WS_CONFIG_BACKGROUND', 'blackfade');

//Sets the default rows "players" per page.
define('WS_CONFIG_PAGENUM', '25');

//Time in seconds, images are cached 86400 = 1day, 259200 = 3days
define('WS_CONFIG_CACHETIME', '259200');

//If you want a 3d player on the players page set to true.
define('WS_CONFIG_3D_USER', false);

//Search Bar on, true. Off, false.
define('WS_CONFIG_SEARCH_BAR', true);

//Deadline for players, not listed in stats-page: 2678400s = 1 month (inactive at the moment).
define('WS_CONFIG_DEADLINE', '1209600');

//Default Logo "http://....."   Image with max 350x270px
define('WS_CONFIG_LOGO', 'images/LOGO.png');

//The logo header image that will be turned on or off in the define "LOGOIMAGE".
define('WS_HOMEPAGE_LOGO', 'images/header/forum.png');

//If there is a link somewhere it will return you to this location. * currently named Main Site on menu.
define('WS_MAINSITE', 'http://nicholas-smith.tk/webstats/');

//Set to true if you want to have a static photo of your site logo. Else set to false,
//if you want to have a dynamic photo with your site name, online status, and MOTD; this mode will slow down the load time.
define('LOGOIMAGE', false);

//The title to the bookmark quick drag link.
define('WS_BOOKMARK', 'Server Stats');

//Achievements Settings.
define('WS_CONFIG_PLAYERACHIEVEMENTS', 'playerachievements');
define('WS_CONFIG_ACHIEVEMENTS', 'ws_achievements'); 

//Economy
define('WS_CONFIG_ECONOMY_PLUGIN', 'mineconomy');
define('WS_CONFIG_ECONOMY', 'mineconomy_accounts');
define('WS_ECONOMY_OMIT', 'admin');
define('WS_ECONOMY_MAIN', 'Dollar(s)');
define('WS_ECONOMY_SUB', 'Cent(s)');
define('WS_ECONOMY_MAIN_SHORT', '$');
define('WS_ECONOMY_SUB_SHORT', '¢');

//Jail Settings.
define('WS_CONFIG_JAIL', 'jail_');

//Jobs Settings.
define('WS_CONFIG_JOBS', 'jobs');

//McMMO Settings.
define('WS_CONFIG_MCMMO', 'mcmmo_');
define('WS_CONFIG_MCMMO_DEFAULT', 'user ASC');

//PermissionsEX Settings.
define('WS_CONFIG_PERMISSIONS', 'permissions');
define('WS_PERMISSIONS_DEFAULT_GROUP', 'Default');

//Stats Settings.
//Set What Stats Plugin To Use (e.g. stats, stats-lolmewn).
define('WS_CONFIG_STATS_PLUGIN', 'stats3-lolmewn');
define('WS_CONFIG_STATS', 'Stats3_');
define('WS_CONFIG_PLAYTIME', true);

//Google Ads. If you want to support me while I update many features for you keep this here. If you dont want them on, remove the code. If you want your own ads, change the code. 
define('WS_GOOGLE_FOOTER', '<script type="text/javascript">
google_ad_client = "ca-pub-6169723647730707";
/* title ad */
google_ad_slot = "0514393560";
google_ad_width = 468;
google_ad_height = 15;
</script>
<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>'); 
define('WS_GOOGLE_FOOTER_MOBILE', '<script type="text/javascript">
google_ad_client = "ca-pub-6169723647730707";
/* stats footer mobile banner */
google_ad_slot = "2053079046";
google_ad_width = 320;
google_ad_height = 50;
</script>
<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>'); 
define('WS_GOOGLE_ASIDE', '<script type="text/javascript">
google_ad_client = "ca-pub-6169723647730707";
/* Stats Plugin */
google_ad_slot = "4875550823";
google_ad_width = 120;
google_ad_height = 600;
</script>
<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js" >
</script>');

//Set the plugin that you want on to true.
define('pluginconfigstatusachiv', true);			//Achievements
define('pluginconfigstatusiconomy', false);			//iConomy
define('pluginconfigstatusmineconomy', true);		//MineConomy
define('pluginconfigstatusjail', true);				//Jail
define('pluginconfigstatusjobs', true);				//Jobs
define('pluginconfigstatusmcmmo', true);			//McMMO
define('pluginconfigpermissionsex', true);			//PermissionsEX
define('pluginconfigstatusstats', false);			//Stats
define('pluginconfigstatusbeardstats', false);		//BeardStats
define('pluginconfigstatussa', false);				//Stats & Achievements
define('pluginconfigstatusstatslolmewnstats', false);//Stats by lolmewnstats
define('pluginconfigstatusstatslolmewnstats3', true);//Stats3 by lolmewnstats
define('serveraddr','');
define('internetprotest', true);                   //Internet Protest info for everyone.
//ADMIN PAGE SETTINGS
define('iptracker', true);
define('ads', false);
define('bookmark', true);
$theme='default';
?>