<?php 
if(file_exists($_SERVER["DOCUMENT_ROOT"].'\config\config.php')){
//IF YOU DONT KNOW YOU CAN VIEW IP LOG FROM PHP IN THE FOLDER IT WAS INSTALLED.
	echo '<h1><div align="center">Hello if you are reading this your IP is tracked and the admin may ban you for viewing this.<br /> HAVE A GOOD DAY!</div></h1>';
} else {
session_start(); // start or resume a session

// http://stackoverflow.com/questions/1779205/create-temporary-file-and-auto-removed

// always sanitize user input
$fileId  = filter_input(INPUT_GET, 'fileId', FILTER_SANITIZE_NUMBER_INT);
$token   = filter_input(INPUT_GET, 'token', FILTER_UNSAFE_RAW);
$referer = filter_input(INPUT_SERVER, 'HTTP_REFERER', FILTER_SANITIZE_URL);
$script  = filter_input(INPUT_SERVER, 'SCRIPT_NAME', FILTER_SANITIZE_URL);

// mush session_id and fileId into an access token
$secret        = 'i can haz salt?';
$expectedToken = md5($secret . session_id() . $fileId);
if(!empty($_POST["submitmysql"])) { 
	$_SESSION['mysql']['URL']=$_POST['mysql']['URL'];
	$_SESSION['mysql']['PORT']=$_POST['mysql']['PORT'];
	$_SESSION['mysql']['user']=$_POST['mysql']['user'];
	$_SESSION['mysql']['pass']=$_POST['mysql']['pass'];
	$_SESSION['mysql']['data']=$_POST['mysql']['data'];
	$_SESSION['pluginconfigachiv']=$_POST['pluginconfigachiv'];
	$_SESSION['pluginconfigiconomy']=$_POST['pluginconfigiconomy'];
	$_SESSION['pluginconfigjail']=$_POST['pluginconfigjail'];
	$_SESSION['pluginconfigjobs']=$_POST['pluginconfigjobs'];
	$_SESSION['pluginconfigmcmmo']=$_POST['pluginconfigmcmmo'];
	$_SESSION['pluginconfigpermissionsex']=$_POST['pluginconfigpermissionsex'];
	$_SESSION['pluginconfigstats']=$_POST['pluginconfigstats'];
	$_SESSION['pluginconfigeconomy']=$_POST['pluginconfigeconomy'];
}
if(!empty($_POST["submitconfig"])) {
	$server_name = htmlspecialchars($_POST['page']['server_name'], ENT_QUOTES);
	$_SESSION['page']['server_name']=$server_name;
	$server_title = htmlspecialchars($_POST['page']['server_title'], ENT_QUOTES);
	$_SESSION['page']['server_title']=$server_title;
	$_SESSION['page']['MQ_SERVER_ADDR']=$_POST['page']['MQ_SERVER_ADDR'];
	$_SESSION['page']['MQ_SERVER_PORT']=$_POST['page']['MQ_SERVER_PORT'];
	$tab_title = htmlspecialchars($_POST['page']['tab_title'], ENT_QUOTES);
	$_SESSION['page']['tab_title']=$tab_title;
	$_SESSION['page']['default_module']=$_POST['page']['default_module'];
	$_SESSION['page']['default_background']=$_POST['page']['default_background'];
	$_SESSION['page']['users_per_page']=$_POST['page']['users_per_page'];
	$_SESSION['page']['2d_cache_time']=$_POST['page']['2d_cache_time'];
	$_SESSION['page']['3d_on/off']=$_POST['page']['3d_on/off'];
	$_SESSION['page']['search']=$_POST['page']['search'];
	$_SESSION['page']['player_inactivity']=$_POST['page']['player_inactivity'];
	$_SESSION['page']['logo_image_link']=$_POST['page']['logo_image_link'];
	$_SESSION['page']['logo_image_filename']=$_POST['page']['logo_image_filename'];
	$_SESSION['page']['homepage_link']=$_POST['page']['homepage_link'];
	$_SESSION['page']['logo_on/off']=$_POST['page']['logo_on/off'];
	$_SESSION['page']['bookmark_title']=$_POST['page']['bookmark_title'];
	$_SESSION['page']['achiev_player_table_name']=$_POST['page']['achiev_player_table_name'];
	$_SESSION['page']['iconomy_admin']=$_POST['page']['iconomy_admin'];
	$_SESSION['page']['iconomy_table_name']=$_POST['page']['iconomy_table_name'];
	$_SESSION['page']['iconomy_major_currency']=$_POST['page']['iconomy_major_currency'];
	$_SESSION['page']['iconomy_minor_currency']=$_POST['page']['iconomy_minor_currency'];
	$_SESSION['page']['iconomy_major_symbol']=$_POST['page']['iconomy_major_symbol'];
	$_SESSION['page']['iconomy_minor_symbol']=$_POST['page']['iconomy_minor_symbol'];
	$_SESSION['page']['mineconomy_table']=$_POST['page']['mineconomy_table'];
	$_SESSION['page']['jail_table_name']=$_POST['page']['jail_table_name'];
	$_SESSION['page']['jobs_table_name']=$_POST['page']['jobs_table_name'];
	$_SESSION['page']['mcmmo_table_name']=$_POST['page']['mcmmo_table_name'];
	$_SESSION['page']['mcmmo_def_sort']=$_POST['page']['mcmmo_def_sort'];
	$_SESSION['page']['permissionsex_table_name']=$_POST['page']['permissionsex_table_name'];
	$_SESSION['page']['permissionsex_default_group']=$_POST['page']['permissionsex_default_group'];
	$_SESSION['page']['stats_table_name']=$_POST['page']['stats_table_name'];
	$_SESSION['page']['timechange_on/off']=$_POST['page']['timechange_on/off'];
	if($_SESSION['page']['server_name'] && $_SESSION['page']['server_title'] && $_SESSION['page']['tab_title'] && $_SESSION['page']['default_module'] && $_SESSION['page']['default_background'] && $_SESSION['page']['users_per_page'] && $_SESSION['page']['MQ_SERVER_ADDR'] && $_SESSION['page']['MQ_SERVER_PORT'] && $_SESSION['page']['2d_cache_time'])header("location:download.php");
}
if(!empty($_POST["reloadform"])){
	session_unset();
	session_destroy();
	session_write_close();
	setcookie(session_name(),'',0,'/');
	session_regenerate_id(true);
}
$SERVERIP=$_SERVER['SERVER_ADDR'];
?>

<script type="text/javascript">
function noNumbers(e){
var keynum;var keychar;var numcheck;
if(window.event) // IE8 and earlier
{keynum = e.keyCode;}
else if(e.which) // IE9/Firefox/Chrome/Opera/Safari
{keynum = e.which;}
keychar = String.fromCharCode(keynum);
numcheck = /\d/;
return !numcheck.test(keychar);
}
</script>
<?php  
$filename = $_SERVER["DOCUMENT_ROOT"].'\config\config.php';
define('noclick','<span onmousedown="return false;" onselectstart="return false;" style="cursor:default;">');
?>
  	<div align="center"><h1>WebStats Install</h1></div>
<article>
    <p align="center">You Are Here Because Your Config File Is Not Set, or Not Installed. Place The File Created Into The Config Folder.</p>
</article>
<article> 
		<?php $bytes = disk_free_space("/"); $si_prefix = array( 'B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB' );
     			$base = 1024;$class = min((int)log($bytes , $base) , count($si_prefix) - 1);
    			echo '<br/><span>You Have </span>'.sprintf('%1.2f',$bytes/pow($base,$class)).' '.$si_prefix[$class].'<span> Free</span><br/>';
		?> 
<font size="1pt"><?php echo $_SERVER['HTTP_USER_AGENT']; ?></font>
<font size="1pt">IP: <?php echo $_SERVER['REMOTE_ADDR']; ?>:<?php echo $_SERVER['REMOTE_PORT']; ?> is viewing</font>
<font size="1pt"><?php echo $_SERVER['SERVER_NAME']; ?><?php echo $_SERVER['PHP_SELF']; ?> install page.</font>

<form action="#" method="post" class="custom">
	<fieldset>
		<legend style="background: none;"><h2>MySQL</h2></legend>
		<label for="mysql[URL]">Enter URL Of Host: <input type="text" name="mysql[URL]" id="mysql[URL]" title="MySQL URL" value="<?php if(!isset($_SESSION['mysql']['URL'])){ echo 'localhost';}else{ echo $_SESSION['mysql']['URL'];} ?>" maxlength="60"/></label>
		<label for="mysql[PORT]">Enter Port Of Host: <input name="mysql[PORT]" type="number" id="mysql[PORT]" title="MySQL PORT" value="<?php if(!isset($_SESSION['mysql']['PORT'])){ echo '3306';}else{ echo $_SESSION['mysql']['PORT'];} ?>" min="0" max="65535"/></label>
		<label for="mysql[user]">Enter Username: <input name="mysql[user]" type="text" id="mysql[user]" accesskey="" title="MySQL Username" value="<?php if(!isset($_SESSION['mysql']['user'])){ echo 'root';}else{ echo $_SESSION['mysql']['user'];} ?>" maxlength="16"/></label>
		<label for="mysql[pass]">Enter Password: <input name="mysql[pass]" type="password" id="mysql[pass]" title="MySQL Password" value="<?php if(!isset($_SESSION['mysql']['pass'])){ echo '';}else{ echo $_SESSION['mysql']['pass'];} ?>" maxlength="32"/></label>
		<label for="mysql[data]">Enter Database: <input name="mysql[data]" type="text" id="mysql[data]" title="MySQL Database" value="<?php if(!isset($_SESSION['mysql']['data'])){ echo 'minecraft';}else{ echo $_SESSION['mysql']['data'];} ?>" maxlength="64"/></label>
		<?php echo noclick ?>What Plugins Would You Like To Use?</span><br/>
		<table>
			<thead>
				<th><?php echo noclick ?>Achievements:</span></th>
				<th><?php echo noclick ?>Economy:</span></th>
				<th><?php echo noclick ?>Jail:</span></th>
				<th><?php echo noclick ?>Jobs:</span></th>
				<th><?php echo noclick ?>McMMO:</span></th>
				<th><?php echo noclick ?>PermissionsEx:</span></th>
				<th><?php echo noclick ?>Stats:</span></th>
			</thead>
			<tbody>           
				<tr>
					<td><select class="select2" title="Stats Plugin" name="pluginconfigachiv">  
						<?php $achievementstype = array('Chose Plugin', 'Achievements', 'Avhievements 2.0', 'BeardAch', 'Stats & Achievements');
							for($i=0; $i <= (sizeof($achievementstype)-1); $i++){
								if($_SESSION['pluginconfigachiv'] == $achievementstype[$i])
									echo ("<option value='".$achievementstype[$i]."' SELECTED>".$achievementstype[$i]."</option>");
								else 
									echo "<option value='".$achievementstype[$i]."'>".$achievementstype[$i]."</option>";
						}?>
					</select></td>
					<td><select class="select2" title="Economy Plugin" name="pluginconfigeconomy">
						<?php $economytype = array('Chose Plugin', 'iConomy', 'MineConomy');
							for($i=0; $i <= (sizeof($economytype)-1); $i++){
								if($_SESSION['pluginconfigeconomy'] == $economytype[$i])
									echo ("<option value='".$economytype[$i]."' SELECTED>".$economytype[$i]."</option>");
								else 
									echo "<option value='".$economytype[$i]."'>".$economytype[$i]."</option>";
						}?>	
					</select></td>
                    
					<td><input type="checkbox" name="pluginconfigjail" title="Jail On" value="<?php if(!isset($_SESSION['pluginconfigjail'])){ echo 'true';}else{ echo $_SESSION['pluginconfigjail'];} ?>" <?php echo (isset($_SESSION['pluginconfigjail'])?'checked="checked"':'') ?>/></td>
					<td><input type="checkbox" name="pluginconfigjobs" title="Jobs On" value="<?php if(!isset($_SESSION['pluginconfigjobs'])){ echo 'true';}else{ echo $_SESSION['pluginconfigjobs'];} ?>" <?php echo (isset($_SESSION['pluginconfigjobs'])?'checked="checked"':'') ?>/></td>
					<td><input type="checkbox" name="pluginconfigmcmmo" title="McMMO On" value="<?php if(!isset($_SESSION['pluginconfigmcmmo'])){ echo 'true';}else{ echo $_SESSION['pluginconfigmcmmo'];} ?>" <?php echo (isset($_SESSION['pluginconfigmcmmo'])?'checked="checked"':'') ?>/></td>
                    <td><input type="checkbox" name="pluginconfigpermissionsex" title="McMMO On" value="<?php if(!isset($_SESSION['pluginconfigpermissionsex'])){ echo 'true';}else{ echo $_SESSION['pluginconfigpermissionsex'];} ?>" <?php echo (isset($_SESSION['pluginconfigpermissionsex'])?'checked="checked"':'') ?>/></td>
					<td>
						<select class="select2" title="Stats Plugin" name="pluginconfigstats">
						<?php $statstype = array('Chose Plugin', 'BeardStat', 'HawkEye', 'Logblock', 'Stats & Achievements', 'Stats', 'Stats 2.0', 'Stats by lolmewnstats', 'Statistician v2.0');
							for($i=0; $i <= (sizeof($statstype)-1); $i++){
								if($_SESSION['pluginconfigstats'] == $statstype[$i])
									echo ("<option value='".$statstype[$i]."' SELECTED>".$statstype[$i]."</option>");
								else 
									echo "<option value='".$statstype[$i]."'>".$statstype[$i]."</option>";
						}?>
					</select></td>
				</tr>
			</tbody>
		</table>
		<input name="submitmysql" type="submit" title="Submit MySQL" onclick="MM_validateForm('mysql[URL]','','R','mysql[PORT]','','NisNum','mysql[user]','','R','mysql[pass]','','R','mysql[data]','','R');return document.MM_returnValue" class="small success button" /><br/>
	</fieldset>
</form>
<?php if(isset($_POST["submitmysql"])){?>
	<form action="#" method="post" class="custom">
	<fieldset>
	<legend style="background: none;"><h2>Config</h2></legend>
	<label for="page">Server Name: <input name="page[server_name]" type="text" id="page[server_name]" title="Server Name" value="<?php if(!isset($_SESSION['page']['server_name'])){ echo 'Mr. Plow&#39s Server';}else{ echo $_SESSION['page']['server_name'];} ?>" maxlength="50"/></label>
	<label for="page">Server Title: <input name="page[server_title]" type="text" id="page[server_title]" title="Server Title" value="<?php if(!isset($_SESSION['page']['server_title'])){ echo 'Mr. Plow&#39s Server';}else{ echo $_SESSION['page']['server_title'];} ?>" maxlength="50"/></label>
    <label for="page">Minecraft Server Addr.: <input name="page[MQ_SERVER_ADDR]" type="text" id="page[MQ_SERVER_ADDR]" title="Server Title" value="<?php if(!isset($_SESSION['page']['MQ_SERVER_ADDR'])){ echo 'localhost';}else{ echo $_SESSION['page']['MQ_SERVER_ADDR'];} ?>" maxlength="50"/></label>
    <label for="page">Minecraft Server Port: <input name="page[MQ_SERVER_PORT]" type="number" id="page[MQ_SERVER_PORT]" title="Server Title" value="<?php if(!isset($_SESSION['page']['MQ_SERVER_PORT'])){ echo '25565';}else{ echo $_SESSION['page']['MQ_SERVER_PORT'];} ?>" min="0" max="65535"/></label>
	<label for="page">Server Tab Title: <input name="page[tab_title]" type="text" id="page[tab_title]" title="Tab Name" value="<?php if(!isset($_SESSION['page']['tab_title'])){ echo 'Mr. Plow&#39s Server - Webstatistic for Minecraft';}else{ echo $_SESSION['page']['tab_title'];} ?>" maxlength="70"/></label>
	<label for="page">Choose Default Module: <input name="page[default_module]" type="text" id="page[default_module]" title="Server Name" value="<?php if(!isset($_SESSION['page']['default_module'])){ echo 'stats';}else{ echo $_SESSION['page']['default_module'];} ?>" maxlength="64"/></label>
	<label for="customDropdown">Choose Default Background:</label>	
	<select class="select2" id="customDropdown background" name="page[default_background]" onchange="displayImage()" title="Background">  
		<?php 
			$filetypes = array('gif', 'jpg', 'png');
			$handle= opendir ("../images/background");
			while ($file = readdir ($handle)) {
				$info = pathinfo($file);
				if(!in_array($info['extension'], $filetypes))continue;
					if (!is_dir($file)){
						$background = explode('.', $file);
						$background = str_replace("bg_", "", $background);
						if($_SESSION['page']['default_background'] == $background[0])
							echo ("<option value='".$background[0]."' SELECTED>".$background[0]."</option>");
						else 
							echo "<option value='".$background[0]."'>".$background[0]."</option>";
					}
			} closedir($handle);
		?>
    </select>
	<img id="imageplaceholder" src="../images/background/bg_blackfade.png" alt="Background" style="height: 200px; max-width: 100%;" width="300px" />
	<label for="page">Users Per Page Listing: <input name="page[users_per_page]" type="text" id="page[users_per_page]" title="Users Per Page"  value="<?php if(!isset($_SESSION['page']['users_per_page'])){ echo '25';}else{ echo $_SESSION['page']['users_per_page'];} ?>" maxlength="3" /></label>
	<label for="page">2D Image Cache Time: <input name="page[2d_cache_time]" type="text" id="page[2d_cache_time]" title="2D Image Cache Time" value="<?php if(!isset($_SESSION['page']['2d_cache_time'])){ echo '259200';}else{ echo $_SESSION['page']['2d_cache_time'];} ?>" maxlength="7"/></label>
	<label for="page">Turn 3D Player ON: <input type="checkbox" name="page[3d_on/off]" title="Stats LOGO On/Off" value="<?php if(!isset($_SESSION['page']['3d_on/off'])){ echo 'true';}else{ echo $_SESSION['page']['3d_on/off'];} ?>" <?php echo (isset($_SESSION['page']['3d_on/off'])?'checked="checked"':'') ?>/></label><br />
	<label for="page">Turn Search Bar ON: <input type="checkbox" name="page[search]" title="Search Bar on/off" value="<?php if(!isset($_SESSION['page']['search'])){ echo 'true';}else{ echo $_SESSION['page']['search'];} ?>" <?php echo (isset($_SESSION['page']['search'])?'checked="checked"':'') ?>/></label><br />
	<label for="page">Player Inactivity Timer: <input name="page[player_inactivity]" type="text" id="page[player_inactivity]" title="Player Inactivity" value="<?php if(!isset($_SESSION['page']['player_inactivity'])){ echo '1209600';}else{ echo $_SESSION['page']['player_inactivity'];} ?>" maxlength="64"/></label>
	<label for="page">Logo Image Link/Location: <input name="page[logo_image_link]" type="text" id="page[logo_image_link]" title="Logo Location" value="<?php if(!isset($_SESSION['page']['logo_image_link'])){ echo 'images/LOGO.png';}else{ echo $_SESSION['page']['logo_image_link'];} ?>" maxlength="64"/></label>
	<label for="page">HomePage/Header Logo: <input name="page[logo_image_filename]" type="text" id="page[logo_image_filename]" title="Header Logo Location " value="<?php if(!isset($_SESSION['page']['logo_image_filename'])){ echo 'images/header/forum.png';}else{ echo $_SESSION['page']['logo_image_filename'];} ?>" maxlength="64"/></label>
	<label for="page">Check To Turn Logo On: <input type="checkbox" name="page[logo_on/off]" title="Stats LOGO On/Off" value="<?php if(!isset($_SESSION['page']['logo_on/off'])){ echo 'true';}else{ echo $_SESSION['page']['logo_on/off'];} ?>" <?php echo (isset($_SESSION['page']['logo_on/off'])?'checked="checked"':'') ?>/></label><br />
	<label for="page">Main Page Link: <input name="page[homepage_link]" type="text" id="page[homepage_link]" title="Homepage Link" value="<?php if(!isset($_SESSION['page']['homepage_link'])){ echo 'https://mrplows-server.tk';}else{ echo $_SESSION['page']['homepage_link'];} ?>" maxlength="64"/></label>
	<label for="page">Browser Bookmark Text: <input name="page[bookmark_title]" type="text" id="page[bookmark_title]" title="Browser Bookmark Text" value="<?php if(!isset($_SESSION['page']['bookmark_title'])){ echo 'Server Stats';}else{ echo $_SESSION['page']['bookmark_title'];} ?>" maxlength="40"/></label>
	<span>Plug-ins</span><hr/>
<?php if(($_SESSION['pluginconfigachiv'] == true) and ($_SESSION['pluginconfigachiv'] != 'Chose Plugin')){ ?>
	<label for="page">Achievments Player Table Name: <input name="page[achiev_player_table_name]" type="text" id="page[achiev_player_table_name]" title="Playertable Name" value="<?php if(!isset($_SESSION['page']['achiev_player_table_name'])){ echo 'playerachievements';}else{ echo $_SESSION['page']['achiev_player_table_name'];} ?>" maxlength="18"/></label>	
<?php } 
 if(($_SESSION['pluginconfigeconomy'] == true) and ($_SEESION['pluginconfigeconomy'] != 'Chose Plugin')){ ?>
	<label for="page">Economy - Admin User: <input name="page[iconomy_admin]" type="text" id="page[iconomy_admin]" title="Server Name" value="<?php if(!isset($_SESSION['page']['iconomy_admin'])){ echo 'admin';}else{ echo $_SESSION['page']['iconomy_admin'];} ?>" maxlength="16"/></label>
	<label for="page">Economy - Major Symbol: <input name="page[iconomy_major_symbol]" type="text" id="page[iconomy_major_symbol]" title="iConomy Major Symbol" value="<?php if(!isset($_SESSION['page']['iconomy_major_symbol'])){ echo '$';}else{ echo $_SESSION['page']['iconomy_major_symbol'];} ?>" maxlength="1"/></label>
	<label for="page">Economy - Minor Symbol: <input name="page[iconomy_minor_symbol]" type="text" id="page[iconomy_minor_symbol]" title="iConomy Minor Symbol" value="<?php if(!isset($_SESSION['page']['iconomy_minor_symbol'])){ echo '&#162;';}else{ echo $_SESSION['page']['iconomy_minor_symbol'];} ?>" maxlength="1"/></label>
	<?php if($_SESSION['pluginconfigeconomy'] == 'iConomy'){?>
		<label for="page">Iconomy - Mysql Table Name: <input name="page[iconomy_table_name]" type="text" id="page[iconomy_table_name]" title="Server Name" value="<?php if(!isset($_SESSION['page']['iconomy_table_name'])){ echo 'iconomy';}else{ echo $_SESSION['page']['iconomy_table_name'];} ?>" maxlength="16"/></label>
		<label for="page">Iconomy - Name of Major Currency: <input name="page[iconomy_major_currency]" type="text" id="page[iconomy_major_currency]" title="iConomy Major Currency" value="<?php if(!isset($_SESSION['page']['iconomy_major_currency'])){ echo 'Dollar(s)';}else{ echo $_SESSION['page']['iconomy_major_currency'];} ?>" maxlength="20"/></label>
		<label for="page">Iconomy - Name of Minor Currency: <input name="page[iconomy_minor_currency]" type="text" id="page[iconomy_minor_currency]" title="iConomy Minor Currency" value="<?php if(!isset($_SESSION['page']['iconomy_minor_currency'])){ echo 'Cent(s)';}else{ echo $_SESSION['page']['iconomy_minor_currency'];} ?>" maxlength="20"/></label>
	<?php }
		if($_SESSION['pluginconfigeconomy'] == 'MineConomy'){ ?>
	<label for="page">MineConomy - Table Name: <input name="page[mineconomy_table]" type="text" id="page[mineconomy_table]" title="MineConomy Table Name" value="<?php if(!isset($_SESSION['page']['mineconomy_table'])){ echo 'mineconomy_accounts';}else{ echo $_SESSION['page']['mineconomy_table'];} ?>" maxlength="1"/></label>
<?php }}
if($_SESSION['pluginconfigjail'] == true){ ?>
<label for="page">Jail MySQL Table Name: <input name="page[jail_table_name]" type="text" id="page[jail_table_name]" title="Jail Table Name" value="<?php if(!isset($_SESSION['page']['jail_table_name'])){ echo 'jail_';}else{ echo $_SESSION['page']['jail_table_name'];} ?>" maxlength="16"/></label>
<?php }
if($_SESSION['pluginconfigjobs'] == true){ ?>
	<label for="page">Jobs MySQL Table Name: <input name="page[jobs_table_name]" type="text" id="page[jobs_table_name]" title="Jobs Table Name" value="<?php if(!isset($_SESSION['page']['jobs_table_name'])){ echo 'jobs';}else{ echo $_SESSION['page']['jobs_table_name'];} ?>" maxlength="16"/></label>
<?php }
if($_SESSION['pluginconfigmcmmo'] == true){ ?>
	<label for="page">McMMO MySQL Table Prefix: <input name="page[mcmmo_table_name]" type="text" id="page[mcmmo_table_name]" title="McMMO Prefix Name" value="<?php if(!isset($_SESSION['page']['mcmmo_table_name'])){ echo 'mcmmo_';}else{ echo $_SESSION['page']['mcmmo_table_name'];} ?>" maxlength="16"/></label>    
	<label for="mcmmoSort">McMMO Default Sort:</label>
	<select style="display:none;" id="mcmmoSort" class="select2" name="page[mcmmo_def_sort]">
		<?php $McMMOSort = array("user ASC","taming DESC","mining DESC","woodcutting DESC","repair DESC","unarmed DESC","herbalism DESC","excavation DESC","archery DESC","swords DESC","axes DESC","acrobatics DESC");
			for($i=0;$i<count($McMMOSort);$i++){if($_SESSION['page']['mcmmo_def_sort'] == $McMMOSort[$i]){echo "<option value='".$McMMOSort[$i]."' selected>".$McMMOSort[$i]."</option>";}else{echo "<option value='".$McMMOSort[$i]."'>".$McMMOSort[$i]."</option>";}}echo $i;
		?>
	</select>
<?php }
if($_SESSION['pluginconfigpermissionsex'] == true){ ?>
	<label for="page">PermissionsEx MySQL Table Name: <input name="page[permissionsex_table_name]" type="text" id="page[permissionsex_table_name]" title="PermissionsEx Table Name" value="<?php if(!isset($_SESSION['page']['permissionsex_table_name'])){ echo 'permissions';}else{ echo $_SESSION['page']['permissionsex_table_name'];} ?>" maxlength="16"/></label> 
    <label for="page">PermissionsEx Default Group Name: <input name="page[permissionsex_default_group]" type="text" id="page[permissionsex_default_group]" title="PermissionsEx Default Group Name" value="<?php if(!isset($_SESSION['page']['permissionsex_default_group'])){ echo 'Default';}else{ echo $_SESSION['page']['permissionsex_default_group'];} ?>" maxlength="25"/></label>
<?php }
if(($_SESSION['pluginconfigstats'] == true) and ($_SESSION['pluginconfigstats'] != 'Chose Plugin')){ ?>
	<label for="page">Stats MySQL Table Prefix: <input name="page[stats_table_name]" type="text" id="page[stats_table_name]" title="Stats Prefix Name" value="<?php if(!isset($_SESSION['page']['stats_table_name'])){ echo 'stats';}else{ echo $_SESSION['page']['stats_table_name'];} ?>" maxlength="16"/></label>
	<label for="page">Stats - Show Played Time In Days, Hours, Minutes : <input type="checkbox" name="page[timechange_on/off]" title="Stats Time Variable" value="<?php if(!isset($_SESSION['page']['timechange_on/off'])){ echo 'true';}else{ echo $_SESSION['page']['timechange_on/off'];} ?>" <?php echo (isset($_SESSION['page']['timechange_on/off'])?'checked="checked"':'') ?>/></label> 
<?php } ?>
	<input name="submitconfig" type="submit" title="Submit Config" onclick="MM_validateForm('mysql[URL]','','R','mysql[PORT]','','RisNum','mysql[user]','','R','mysql[pass]','','R','mysql[data]','','R','page[server_name]','','R','page[server_title]','','R','page[MQ_SERVER_ADDR]','','R','page[MQ_SERVER_PORT]','','RisNum','page[tab_title]','','R','page[default_module]','','R','page[users_per_page]','','R','page[2d_cache_time]','','RisNum','page[player_inactivity]','','RisNum','page[logo_image_link]','','R','page[logo_image_filename]','','R','page[homepage_link]','','R','page[bookmark_title]','','R');return document.MM_returnValue" value="Submit Config" class="small success button" />
	</fieldset>
	</form>
<?php }//---------PRE-SETS AND IF STATMENTS FOR fwrite START---------------------------------------------------------------
$google_aside='<script type="text/javascript">
google_ad_client = "ca-pub-6169723647730707";
/* Stats Plugin */
google_ad_slot = "4875550823";
google_ad_width = 120;
google_ad_height = 600;
</script>
<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js" >
</script>';
$google_footer='<script type="text/javascript">
google_ad_client = "ca-pub-6169723647730707";
/* title ad */
google_ad_slot = "0514393560";
google_ad_width = 468;
google_ad_height = 15;
</script>
<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>';
$google_footer_mobile='<script type="text/javascript">
google_ad_client = "ca-pub-6169723647730707";
/* stats footer mobile banner */
google_ad_slot = "2053079046";
google_ad_width = 320;
google_ad_height = 50;
</script>
<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>';
if((isset($_SESSION['pluginconfigachiv'])) and ($_SESSION['pluginconfigachiv'] != 'Chose Plugin')) {
	$achievments="define('WS_CONFIG_PLAYERACHIEVEMENTS', '".$_SESSION['page']['achiev_player_table_name']."');\ndefine('WS_CONFIG_ACHIEVEMENTS', 'ws_achievements'); \n";
	$pluginconfigstatusachiv="define('pluginconfigstatusachiv', true);\n";
}
if((isset($_SESSION['pluginconfigeconomy'])) and ($_SESSION['pluginconfigeconomy'] != 'Chose Plugin')) {
	if ($_SESSION['pluginconfigeconomy']=='iConomy') {
		$economy="define('WS_ICONOMY_OMIT', '".$_SESSION['page']['iconomy_admin']."');\ndefine('WS_CONFIG_MINECONOMY', '".$_SESSION['page']['mineconomy_table_name']."');\ndefine('WS_ICONOMY_MAIN_SHORT', '".$_SESSION['page']['iconomy_major_symbol']."');\ndefine('WS_ICONOMY_SUB_SHORT', '".$_SESSION['page']['iconomy_minor_symbol']."');\n";
		$pluginconfigstatuseconomy="define('pluginconfigstatusiconomy', true);\n";
	}
	if ($_SESSION['pluginconfigeconomy']=='MineConomy') {
		$economy="define('WS_ICONOMY_OMIT', '".$_SESSION['page']['iconomy_admin']."');\ndefine('WS_CONFIG_MINECONOMY', '".$_SESSION['page']['mineconomy_table']."');\ndefine('WS_ICONOMY_MAIN_SHORT', '".$_SESSION['page']['iconomy_major_symbol']."');\ndefine('WS_ICONOMY_SUB_SHORT', '".$_SESSION['page']['iconomy_minor_symbol']."');\n";
		$pluginconfigstatuseconomy="define('pluginconfigstatusmineconomy', true);\n";
	}
}
if($_SESSION['pluginconfigjail'] == true) {
	$jail="define('WS_CONFIG_JAIL', '".$_SESSION['page']['jail_table_name']."');\n";
	$pluginconfigstatusjail="define('pluginconfigstatusjail', ".$_SESSION['pluginconfigjail'].");\n";
}
if($_SESSION['pluginconfigjobs'] == true) {
	$jobs="define('WS_CONFIG_JOBS', '".$_SESSION['page']['jobs_table_name']."');\n";
	$pluginconfigjobs="define('pluginconfigstatusjobs', ".$_SESSION['pluginconfigjobs'].");\n";
}
if($_SESSION['pluginconfigmcmmo'] == true) {
	$mcmmo="define('WS_CONFIG_MCMMO', '".$_SESSION['page']['mcmmo_table_name']."');\ndefine('WS_CONFIG_MCMMO_DEFAULT', '".$_SESSION['page']['mcmmo_def_sort']."');\n";
	$pluginconfigstatusmcmmo="define('pluginconfigstatusmcmmo', ".$_SESSION['pluginconfigmcmmo'].");\n";
}
if($_SESSION['pluginconfigpermissionsex'] == true) {
	$permissionsex="define('WS_CONFIG_PERMISSIONS', '".$_SESSION['page']['permissionsex_table_name']."');\ndefine('WS_PERMISSIONS_DEFAULT_GROUP', '".$_SESSION['page']['permissionsex_default_group']."');\n";
	$pluginconfigstatuspermissionsex="define('pluginconfigpermissionsex', ".$_SESSION['pluginconfigpermissionsex'].");\n";
}
if((isset($_SESSION['pluginconfigstats'])) && ($_SESSION['pluginconfigstats'] != 'Chose Plugin')) {
	if($_SESSION['pluginconfigstats'] == "stats") {
		if($_SESSION['page']['timechange_on/off'] == true)
			$stats_time="define('WS_CONFIG_PLAYTIME', ".$_SESSION['page']['timechange_on/off'].");\n";
		$stats="define('WS_CONFIG_STATS', '".$_SESSION['page']['stats_table_name']."');\n$stats_time";
		$pluginconfigstatusstats="define('pluginconfigstatusstats', true);\n";
	} elseif($_SESSION['pluginconfigstats'] == "Stats by lolmewnstats") {
		if($_SESSION['page']['timechange_on/off'] == true)
			$stats_time="define('WS_CONFIG_PLAYTIME', ".$_SESSION['page']['timechange_on/off'].");\n";
		$stats="define('WS_CONFIG_STATS_LOLMEWN_PREFIX', '".$_SESSION['page']['stats_table_name']."');\n$stats_time";
		$pluginconfigstatusstats="define('pluginconfigstatusstatslolmewnstats', true);\n";
	} else {}
}
if($_SESSION['page']['3d_on/off'] == true)
	$threedsetting="define('WS_CONFIG_3D_USER', ".$_SESSION['page']['3d_on/off'].");\n";
if($_SESSION['page']['logo_on/off'] == true)
	$logoon="define('LOGOIMAGE', ".$_SESSION['page']['logo_on/off'].");";
if($_SESSION['page']['search'] == true)
	$search="define('WS_CONFIG_SEARCH_BAR', ".$_SESSION['page']['search'].");";
	
//---------PRE-SETS AND IF STATMENTS FOR fwrite END------------------------------------------------------------------------
if($_POST["submitconfig"] == 'Submit Config'){
	$tempfile  = "<?php \n//Developed by Nick Smith, 'aka' cky nick254, 'aka' mrplow, 'aka' cky2250, mrplows-server.tk, Webstats for Minecraft (c) 2011-2013 \n//Please help me out in any way with any *type* ~ hint of payments that do not require paypal. My webstie is http://mrplows-server.tk. \n//Current source for info https://github.com/cky2250/WebStats/ \n\n";
	$tempfile .= "//Sets up the MySQL Database and info to reach it to access the MySQL tabels used in this project.\ndefine('WS_MySQL_DBHOST', '".$_SESSION['MySQLHost']."');\ndefine('WS_MySQL_PORT', '".$_SESSION['MySQLPort']."');\ndefine('WS_MySQL_USERNAME', '".$_SESSION['MySQLUserName']."');\ndefine('WS_MySQL_PASSWORD', '".$_SESSION['MySQLPassword']."');\ndefine('WS_MySQL_DB', '".$_SESSION['MySQLDatabase']."');\n\n";
	$tempfile .= "//Sets up the MySQL Database locations for the minecraft plugins.\ndefine('WS_CONFIG_DBHOST', '".$_SESSION['mysql']['URL']."');\ndefine('WS_CONFIG_DBPORT', '".$_SESSION['mysql']['PORT']."');\ndefine('WS_CONFIG_DBUNAME', '".$_SESSION['mysql']['user']."');\ndefine('WS_CONFIG_DBPASS', '".$_SESSION['mysql']['pass']."');\ndefine('WS_CONFIG_DBNAME', '".$_SESSION['mysql']['data']."');\n\n";
	$tempfile .= "//Sets up the Minecraft Server location for the dynamic photo and popup windows to reach the server.\ndefine('MQ_SERVER_ADDR', '".$_SESSION['page']['MQ_SERVER_ADDR']."');\ndefine('MQ_SERVER_PORT', '".$_SESSION['page']['MQ_SERVER_PORT']."');\ndefine('MQ_TIMEOUT', 1);\n\n";
	$tempfile .= "define('WS_CONFIG_SERVER', '".$_SESSION['page']['server_name']."');\ndefine('WS_OPTICAL_TITLE', '".$_SESSION['page']['server_title']."');\ndefine('WS_OPTICAL_TAB_TITLE', '".$_SESSION['page']['tab_title']."');\ndefine('WS_CONFIG_MODULE', '".$_SESSION['page']['default_module']."');\ndefine('WS_CONFIG_BACKGROUND', '".$_SESSION['page']['default_background']."');\ndefine('WS_CONFIG_PAGENUM', '".$_SESSION['page']['users_per_page']."');\ndefine('WS_CONFIG_CACHETIME', '".$_SESSION['page']['2d_cache_time']."');\n$threedsetting$search\ndefine('WS_CONFIG_DEADLINE', '".$_SESSION['page']['player_inactivity']."');\ndefine('WS_CONFIG_LOGO', '".$_SESSION['page']['logo_image_link']."');\ndefine('WS_HOMEPAGE_LOGO', '".$_SESSION['page']['logo_image_filename']."');\ndefine('WS_MAINSITE', '".$_SESSION['page']['homepage_link']."');\n$logoon\ndefine('WS_BOOKMARK', '".$_SESSION['page']['bookmark_title']."');\ndefine('WS_PHOTO_PHP_CHANGE', 'large_player_image');\n$achievments$economy$jail$jobs$mcmmo$permissionsex$stats\ndefine('WS_GOOGLE_FOOTER', '$google_footer');\ndefine('WS_GOOGLE_FOOTER_MOBILE', '$google_footer_mobile');\ndefine('WS_GOOGLE_ASIDE', '$google_aside');\n$pluginconfigstatusachiv$pluginconfigstatuseconomy$pluginconfigstatusjail$pluginconfigjobs$pluginconfigstatusmcmmo$pluginconfigstatuspermissionsex$pluginconfigstatusstats\ndefine('serveraddr','".$SERVERIP."');\n\n";
	$tempfile .= "define('internetprotest', true);\ndefine('iptracker', false);\n?>";
	$ourFileHandle = fopen($filename, 'w');
	if (is_writable($filename)) {
		if (!$handle = fopen($filename, 'w')) {
			echo "Cannot open file ($filename) you may need writing permisions. You can however create the <code>$filename</code> manually and paste the following text into it.";
        	?><textarea cols="98" rows="15"><?php echo htmlentities($tempfile, ENT_COMPAT, 'UTF-8');?></textarea><?php
    	}
    	if (fwrite($handle, $tempfile) === FALSE) {
        	echo "Cannot write to file ($filename). You can however create the <code>$filename</code> manually and paste the following text into it.";
        	?><textarea cols="98" rows="15"><?php echo htmlentities($tempfile, ENT_COMPAT, 'UTF-8');?></textarea><?php
    	}
    	fclose($handle);
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
	} else {
		$filenamelocal = 'config.php';
		$ourFileHandle = fopen($filenamelocal, 'w');
		if (is_writable($filenamelocal)) {
			if (!$handle = fopen($filenamelocal, 'w')) {
				echo "Cannot open file ($filenamelocal) you may need writing permisions. You can however create the <code>$filenamelocal</code> manually and paste the following text into it.";
				?><textarea cols="98" rows="15"><?php echo htmlentities($tempfile, ENT_COMPAT, 'UTF-8');?></textarea><?php
			}
			if (fwrite($handle, $tempfile) === FALSE) {
				echo "Cannot write to file ($filenamelocal). You can however create the <code>$filenamelocal</code> manually and paste the following text into it.";
				?><textarea cols="98" rows="15"><?php echo htmlentities($tempfile, ENT_COMPAT, 'UTF-8');?></textarea><?php
			}
			fclose($handle);
		} else {
			echo "Cannot write to file ($filename). You can however create the <code>$filename</code> manually and paste the following text into it.";
			?><textarea cols="98" rows="15"><?php echo htmlentities($tempfile, ENT_COMPAT, 'UTF-8');?></textarea><?php
		}
	}
}
?>
</article>
<?php } ?>