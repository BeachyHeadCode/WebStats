<?php
if(basename(__FILE__) == basename($_SERVER['PHP_SELF'])){exit();}
session_start();
error_reporting(0);
$ip=$_SERVER['REMOTE_ADDR'];
require_once ROOT . "include/logonfunctions.php";
require_once ROOT . 'include/functions.php';

if(file_exists(ROOT . 'config/config.php'))
	include ROOT . 'config/config.php';
else
	header("/setup-config.php");
	
if(isset($_SESSION['pml_userid']) || $ip=='127.0.0.1' || $ip=='localhost' || $ip=='::1') {
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
	}
	define('noclick','<span onmousedown="return false;" onselectstart="return false;" style="cursor:default;">');
?>
	<script>
		function displayImage() {
			var a = document.getElementById("customDropdown background");
			var b = a.options[a.selectedIndex].text;
			var c="../images/background/bg_";
			var d=".png";
			var e=c.concat(b,d);
			document.getElementById("imageplaceholder").src=e;
		}
	</script>
	<article>
		<form action="#" method="post" class="custom">
			<fieldset>
				<legend style="background: none;"><h2>MySQL of Minecraft Plugin(s)</h2></legend>
				<label for="mysql[URL]">Enter URL Of Host:</label> <input type="text" name="mysql[URL]" id="mysql[URL]" title="MySQL URL" value="<?php if(!isset($_SESSION['mysql']['URL'])){ echo WS_CONFIG_DBHOST;}else{ echo $_SESSION['mysql']['URL'];} ?>" maxlength="60"/><br/>
				<label for="mysql[PORT]">Enter Port Of Host:</label> <input name="mysql[PORT]" type="text" id="mysql[PORT]" title="MySQL PORT" value="<?php if(!isset($_SESSION['mysql']['PORT'])){ echo WS_CONFIG_DBPORT;}else{ echo $_SESSION['mysql']['PORT'];} ?>" maxlength="5"/><br/>
				<label for="mysql[user]">Enter Username:</label> <input name="mysql[user]" type="text" id="mysql[user]" accesskey="" title="MySQL Username" value="<?php if(!isset($_SESSION['mysql']['user'])){ echo WS_CONFIG_DBUNAME;}else{ echo $_SESSION['mysql']['user'];} ?>" maxlength="16"/><br/>
				<label for="mysql[pass]">Enter Password:</label> <input name="mysql[pass]" type="text" id="mysql[pass]" title="MySQL Password" value="<?php if(!isset($_SESSION['mysql']['pass'])){ echo WS_CONFIG_DBPASS;}else{ echo $_SESSION['mysql']['pass'];} ?>" maxlength="32"/><br/>
				<label for="mysql[data]">Enter Database:</label> <input name="mysql[data]" type="text" id="mysql[data]" title="MySQL Database" value="<?php if(!isset($_SESSION['mysql']['data'])){ echo WS_CONFIG_DBNAME;}else{ echo $_SESSION['mysql']['data'];} ?>" maxlength="64"/><br/><br/>
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
							<td><select id="customDropdown" class="select2" title="Stats Plugin" name="pluginconfigachiv">  
								<?php $achievementstype = array('Chose Plugin', 'Achievements', 'Avhievements 2.0', 'Stats & Achievements');
									for($i=0; $i <= (sizeof($achievementstype)-1); $i++){
										if(pluginconfigstatusachiv === true)
											$pluginachievment = 'Achievements';	
										if ($pluginachievment == $achievementstype[$i])
											echo ("<option value='".$achievementstype[$i]."' SELECTED>".$achievementstype[$i]."</option>");
										else 
											echo "<option value='".$achievementstype[$i]."'>".$achievementstype[$i]."</option>";
								}?>
							</select></td>
							<td><select id="customDropdown" class="select2" title="Economy Plugin" name="pluginconfigeconomy">
								<?php $economytype = array('Chose Plugin', 'iConomy', 'MineConomy');
									for($i=0; $i <= (sizeof($economytype)-1); $i++){
										if(pluginconfigstatusiconomy === true)
											$plugineconomy = 'iConomy';
										if(pluginconfigstatusmineconomy === true)
											$plugineconomy = 'MineConomy';
										if(($plugineconomy == $economytype[$i]) or ($_SESSION['pluginconfigeconomy'] == $economytype[$i]))
											echo ("<option value='".$economytype[$i]."' SELECTED>".$economytype[$i]."</option>");
										else 
											echo "<option value='".$economytype[$i]."'>".$economytype[$i]."</option>";
								}?>	
							</select></td>
							<td><input type="checkbox" name="pluginconfigjail" title="Jail On" value="true" <?php if(pluginconfigstatusjail === true){ echo 'checked="checked"';} ?>/></td>
							<td><input type="checkbox" name="pluginconfigjobs" title="Jobs On" value="true" <?php if(pluginconfigstatusjobs === true){ echo 'checked="checked"';} ?>/></td>
							<td><input type="checkbox" name="pluginconfigmcmmo" title="McMMO On" value="true" <?php if(pluginconfigstatusmcmmo === true){ echo 'checked="checked"';} ?>/></td>
							<td><input type="checkbox" name="pluginconfigpermissionsex" title="McMMO On" value="true" <?php if(pluginconfigpermissionsex === true){ echo 'checked="checked"';} ?>/></td>				
							<td><select style="" id="customDropdown" class="select2" title="Stats Plugin" name="pluginconfigstats">  
								<?php $statstype = array('Chose Plugin', 'BeardStat', 'HawkEye', 'Logblock', 'Stats & Achievements', 'Stats', 'Stats 2.0', 'Stats by lolmewnstats', 'Statistician v2.0');
									for($i=0; $i <= (sizeof($statstype)-1); $i++){
										
										if(pluginconfigstatusstats === true)
											$pluginstat = 'Stats';
										if(pluginconfigstatusbeardstats === true)
											$pluginstat = 'BeardStat';
										if(pluginconfigstatusstatslolmewnstats === true)
											$pluginstat = 'Stats by lolmewnstats';
										if($pluginstat == $statstype[$i])
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
		<?php $DB = new DBConfig();$DB -> config();$DB -> conn($_SESSION['mysql'][URL].":".$_SESSION['mysql']['PORT'], $_SESSION['mysql']['user'], $_SESSION['mysql']['pass'], $_SESSION['mysql']['data']); $DB -> close(); ?>     
<?php if(isset($_POST["submitmysql"])){
	include('config.php');?>
	<form action="#" method="post" class="custom">
		<fieldset>
			<legend style="background: none;"><h2>Config Edit</h2></legend>
			<label for="page[server_name]">Server Name: <input name="page[server_name]" type="text" id="page[server_name]" title="Server Name" value="<?php if(!isset($_SESSION['page']['server_name'])){ echo WS_CONFIG_SERVER;}else{ echo $_SESSION['page']['server_name'];} ?>" maxlength="50"/></label>
			<label for="page[server_title]">Server Title: <input name="page[server_title]" type="text" id="page[server_title]" title="Server Title" value="<?php if(!isset($_SESSION['page']['server_title'])){ echo WS_OPTICAL_TITLE;}else{ echo $_SESSION['page']['server_title'];} ?>" maxlength="50"/></label>
			<label for="page[MQ_SERVER_ADDR]">Minecraft Server Addr.: <input name="page[MQ_SERVER_ADDR]" type="text" id="page[MQ_SERVER_ADDR]" title="Server Title" value="<?php if(!isset($_SESSION['page']['MQ_SERVER_ADDR'])){ echo MQ_SERVER_ADDR;}else{ echo $_SESSION['page']['MQ_SERVER_ADDR'];} ?>" maxlength="50"/></label>
			<label for="page[MQ_SERVER_PORT]">Minecraft Server Port: <input name="page[MQ_SERVER_PORT]" type="text" id="page[MQ_SERVER_PORT]" title="Server Title" value="<?php if(!isset($_SESSION['page']['MQ_SERVER_PORT'])){ echo MQ_SERVER_PORT;}else{ echo $_SESSION['page']['MQ_SERVER_PORT'];} ?>" maxlength="5"/></label>
			<label for="page[tab_title]">Server Tab Title: <input name="page[tab_title]" type="text" id="page[tab_title]" title="Tab Name" value="<?php if(!isset($_SESSION['page']['tab_title'])){ echo WS_OPTICAL_TAB_TITLE;}else{ echo $_SESSION['page']['tab_title'];} ?>" maxlength="70"/></label>
			<label for="page[default_module]">Choose Default Module: <input name="page[default_module]" type="text" id="page[default_module]" title="Server Name" value="<?php if(!isset($_SESSION['page']['default_module'])){ echo WS_CONFIG_MODULE;}else{ echo $_SESSION['page']['default_module'];} ?>" maxlength="64"/></label>
			<label for="customDropdown">Choose Default Background:</label>
			<select class="select2" id="customDropdown background" name="page[default_background]" onchange="displayImage()" title="Background">  
				<?php
					$filetypes = array('gif', 'jpg', 'png');
					$handle= opendir ("../images/background");
					global $currentbackground;
					while ($file = readdir ($handle)) {
						$info = pathinfo($file);
						if(!in_array($info['extension'], $filetypes))continue;
						if (!is_dir($file)) {
							$background = explode('.', $file);
							$background = str_replace("bg_", "", $background);
 						if(WS_CONFIG_BACKGROUND == $background[0]){
							echo '<option value="'.$background[0].'" SELECTED>'.$background[0]."</option>";
							$currentbackground = $background[0];
						}
						else 
							echo "<option value='".$background[0]."'>".$background[0]."</option>";
						}
					}closedir($handle);
				?>
			</select><br />
			<img id="imageplaceholder" src="../images/background/bg_blackfade.png" alt="Background" style="height: 200px; max-width: 100%;" width="300px" />
			<label for="page">Users Per Page Listing: <input name="page[users_per_page]" type="text" id="page[users_per_page]" title="Users Per Page"  value="<?php if(!isset($_SESSION['page']['users_per_page'])){ echo WS_CONFIG_PAGENUM;}else{ echo $_SESSION['page']['users_per_page'];} ?>" maxlength="3" /></label>
			<label for="page">2D Image Cache Time: <input name="page[2d_cache_time]" type="text" id="page[2d_cache_time]" title="Server Name" value="<?php if(!isset($_SESSION['page']['2d_cache_time'])){ echo WS_CONFIG_CACHETIME;}else{ echo $_SESSION['page']['2d_cache_time'];} ?>" maxlength="7"/><br/>
			<label for="page">Turn 3D Player ON: <input type="checkbox" name="page[3d_on/off]" title="Stats LOGO On/Off" value="<?php if(!isset($_SESSION['page']['3d_on/off'])){ echo 'true';}else{ echo $_SESSION['page']['3d_on/off'];} ?>" <?php if(WS_CONFIG_3D_USER === true){ echo 'checked="checked"';} ?>/></label>
			<label for="page">Player Inactivity Timer: <input name="page[player_inactivity]" type="text" id="page[player_inactivity]" title="Player Inactivity" value="<?php if(!isset($_SESSION['page']['player_inactivity'])){ echo WS_CONFIG_DEADLINE;}else{ echo $_SESSION['page']['player_inactivity'];} ?>" maxlength="64"/></label>
			<label for="page">Logo Image Link/Location: <input name="page[logo_image_link]" type="text" id="page[logo_image_link]" title="Logo Location" value="<?php if(!isset($_SESSION['page']['logo_image_link'])){ echo WS_CONFIG_LOGO;}else{ echo $_SESSION['page']['logo_image_link'];} ?>" maxlength="64"/><br/>
			<label for="page">HomePage/Header Logo: <input name="page[logo_image_filename]" type="text" id="page[logo_image_filename]" title="Header Logo Location " value="<?php if(!isset($_SESSION['page']['logo_image_filename'])){ echo WS_HOMEPAGE_LOGO;}else{ echo $_SESSION['page']['logo_image_filename'];} ?>" maxlength="64"/></label>
			<label for="page">Check To Turn Logo On: <input type="checkbox" name="page[logo_on/off]" title="Stats LOGO On/Off" value="<?php if(!isset($_SESSION['page']['logo_on/off'])){ echo 'true';}else{ echo $_SESSION['page']['logo_on/off'];} ?>" <?php if(LOGOIMAGE === true){ echo 'checked="checked"';} ?>/></label>
			<label for="page">Main Page Link: <input name="page[homepage_link]" type="text" id="page[homepage_link]" title="Server Name" value="<?php if(!isset($_SESSION['page']['homepage_link'])){ echo WS_MAINSITE;}else{ echo $_SESSION['page']['homepage_link'];} ?>" maxlength="64"/></label>
			<label for="page">Browser Bookmark Text: <input name="page[bookmark_title]" type="text" id="page[bookmark_title]" title="Server Name" value="<?php if(!isset($_SESSION['page']['bookmark_title'])){ echo WS_BOOKMARK;}else{ echo $_SESSION['page']['bookmark_title'];} ?>" maxlength="40"/></label>
			<span>Plug-ins</span><hr/>
			<?php 
			if($_SESSION['pluginconfigachiv'] == true){ ?>
				<label for="page">Achievments Player Table Name: <input name="page[achiev_player_table_name]" type="text" id="page[achiev_player_table_name]" title="Playertable Name" value="<?php if(!isset($_SESSION['page']['achiev_player_table_name'])){ echo (WS_CONFIG_PLAYERACHIEVEMENTS);}else{ echo $_SESSION['page']['achiev_player_table_name'];} ?>" maxlength="18"/></label>	
			<?php } 
			if($_SESSION['pluginconfigiconomy'] == true){ ?>
					<label for="page">Iconomy Admin User: <input name="page[iconomy_admin]" type="text" id="page[iconomy_admin]" title="Server Name" value="<?php if(!isset($_SESSION['page']['iconomy_admin'])){ echo WS_ICONOMY_OMIT;}else{ echo $_SESSION['page']['iconomy_admin'];} ?>" maxlength="16"/></label>
					<label for="page">Iconomy Mysql Table Name: <input name="page[iconomy_table_name]" type="text" id="page[iconomy_table_name]" title="Server Name" value="<?php if(!isset($_SESSION['page']['iconomy_table_name'])){ echo WS_CONFIG_ICONOMY;}else{ echo $_SESSION['page']['iconomy_table_name'];} ?>" maxlength="16"/></label>
					<label for="page">Iconomy - Name of Major Currency: <input name="page[iconomy_major_currency]" type="text" id="page[iconomy_major_currency]" title="iConomy Major Currency" value="<?php if(!isset($_SESSION['page']['iconomy_major_currency'])){ echo WS_ICONOMY_MAIN;}else{ echo $_SESSION['page']['iconomy_major_currency'];} ?>" maxlength="20"/></label>
					<label for="page">Iconomy - Name of Minor Currency: <input name="page[iconomy_minor_currency]" type="text" id="page[iconomy_minor_currency]" title="iConomy Minor Currency" value="<?php if(!isset($_SESSION['page']['iconomy_minor_currency'])){ echo WS_ICONOMY_SUB;}else{ echo $_SESSION['page']['iconomy_minor_currency'];} ?>" maxlength="20"/></label>
					<label for="page">Iconomy - Major Symbol: <input name="page[iconomy_major_symbol]" type="text" id="page[iconomy_major_symbol]" title="iConomy Major Symbol" value="<?php if(!isset($_SESSION['page']['iconomy_major_symbol'])){ echo WS_ICONOMY_MAIN_SHORT;}else{ echo $_SESSION['page']['iconomy_major_symbol'];} ?>" maxlength="1"/></label>
					<label for="page">Iconomy - Minor Symbol: <input name="page[iconomy_minor_symbol]" type="text" id="page[iconomy_minor_symbol]" title="iConomy Minor Symbol" value="<?php if(!isset($_SESSION['page']['iconomy_minor_symbol'])){ echo WS_ICONOMY_SUB_SHORT;}else{ echo $_SESSION['page']['iconomy_minor_symbol'];} ?>" maxlength="1"/></label>
			<?php }
			if($_SESSION['pluginconfigjail'] == true){ ?>
				<label for="page">Jail MySQL Table Name:</label> <input name="page[jail_table_name]" type="text" id="page[jail_table_name]" title="Jail Table Name" value="<?php if(!isset($_SESSION['page']['jail_table_name'])){ echo WS_CONFIG_JAIL;}else{ echo $_SESSION['page']['jail_table_name'];} ?>" maxlength="16"/></label>
			<?php }
			if($_SESSION['pluginconfigjobs'] == true){?>
				<label for="page">Jobs MySQL Table Name: <input name="page[jobs_table_name]" type="text" id="page[jobs_table_name]" title="Jobs Table Name" value="<?php if(!isset($_SESSION['page']['jobs_table_name'])){ echo WS_CONFIG_JOBS;}else{ echo $_SESSION['page']['jobs_table_name'];} ?>" maxlength="16"/></label>
			<?php }
			if($_SESSION['pluginconfigmcmmo'] == true){ ?>
				<label for="page">McMMO MySQL Table: <input name="page[mcmmo_table_name]" type="text" id="page[mcmmo_table_name]" title="Server Name" value="<?php if(!isset($_SESSION['page']['mcmmo_table_name'])){ echo WS_CONFIG_MCMMO;}else{ echo $_SESSION['page']['mcmmo_table_name'];} ?>" maxlength="16"/></label>    
				<label for="mcmmoSort">McMMO Default Sort:</label>
				<select style="display:none;" id="mcmmoSort" class="select2" name="page[mcmmo_def_sort]">
			<?php $McMMOSort = array("user ASC","taming DESC","mining DESC","woodcutting DESC","repair DESC","unarmed DESC","herbalism DESC","excavation DESC","archery DESC","swords DESC","axes DESC","acrobatics DESC");
				for($i=0;$i<count($McMMOSort);$i++){
					if(WS_CONFIG_MCMMO_DEFAULT == $McMMOSort[$i]){
						echo "<option value='".$McMMOSort[$i]."' selected>".$McMMOSort[$i]."</option>";
					} else {
						echo "<option value='".$McMMOSort[$i]."'>".$McMMOSort[$i]."</option>";
					}
				}?>
				</select><br/>
			<?php }
if($_SESSION['pluginconfigpermissionsex'] == true) : ?>
	<label for="page">PermissionsEx MySQL Table Name: <input name="page[permissionsex_table_name]" type="text" id="page[permissionsex_table_name]" title="PermissionsEx Table Name" value="<?php if(!isset($_SESSION['page']['permissionsex_table_name'])){ echo WS_CONFIG_PERMISSIONS;}else{ echo $_SESSION['page']['permissionsex_table_name'];} ?>" maxlength="16"/></label>
    <label for="page">PermissionsEx Default Group Name: <input name="page[permissionsex_default_group]" type="text" id="page[permissionsex_default_group]" title="PermissionsEx Default Group Name" value="<?php if(!isset($_SESSION['page']['permissionsex_default_group'])){ echo WS_PERMISSIONS_DEFAULT_GROUP;}else{ echo $_SESSION['page']['permissionsex_default_group'];} ?>" maxlength="25"/></label>
<?php endif; if($_SESSION['pluginconfigstats'] == true) : ?>
	<label for="page">Stats MySQL Table: <input name="page[stats_table_name]" type="text" id="page[stats_table_name]" title="Server Name" value="<?php if(!isset($_SESSION['page']['stats_table_name'])){ echo WS_CONFIG_STATS;}else{ echo $_SESSION['page']['stats_table_name'];} ?>" maxlength="16"/></label>
	<label for="page">Stats - Show Played Time In Days, Hours, Minutes : <input type="checkbox" name="page[timechange_on/off]" title="Stats Time Variable" value="<?php if(!isset($_SESSION['page']['timechange_on/off'])){ echo 'true';}else{ echo $_SESSION['page']['timechange_on/off'];} ?>" <?php if(WS_CONFIG_PLAYTIME === true){ echo 'checked="checked"';} ?>/></label> 
<?php endif; ?>
	<input name="submitconfig" type="submit" title="Submit Config" onclick="MM_validateForm('mysql[URL]','','R','mysql[PORT]','','RisNum','mysql[user]','','R','mysql[pass]','','R','mysql[data]','','R','page[server_name]','','R','page[server_title]','','R','page[MQ_SERVER_ADDR]','','R','page[MQ_SERVER_PORT]','','RisNum','page[tab_title]','','R','page[default_module]','','R','page[users_per_page]','','R','page[2d_cache_time]','','RisNum','page[player_inactivity]','','RisNum','page[logo_image_link]','','R','page[logo_image_filename]','','R','page[homepage_link]','','R','page[bookmark_title]','','R');return document.MM_returnValue" value="Submit Config" class="small success button" />
	</fieldset>
	</form>
</article>
		<?php
		//---------PRE-SETS AND IF STATMENTS FOR fwrite END------------------------------------------------------------------------
		if($_POST["submitconfig"] == 'Submit Config') {
			$tempfile = "<?php \n	//Developed by Nick Smith, 'aka' cky nick254, 'aka' mrplow, 'aka' cky2250 \n	//Please help me out in any way with any *type* ~ hint of payments that do not require paypal. my webstie is http://mrplows-server.us \n	define('WS_MySQL_DBHOST', '".$_SESSION['MySQLHost']."');\n define('WS_MySQL_PORT', '".$_SESSION['MySQLPort']."');\n define('WS_MySQL_USERNAME', '".$_SESSION['MySQLUserName']."');\n define('WS_MySQL_PASSWORD', '".$_SESSION['MySQLPassword']."');\n define('WS_MySQL_DB', '".$_SESSION['MySQLDatabase']."');\n define('WS_CONFIG_DBHOST', '".$_SESSION['mysql']['URL']."');\n	define('WS_CONFIG_DBPORT', '".$_SESSION['mysql']['PORT']."');\n	define('WS_CONFIG_DBUNAME', '".$_SESSION['mysql']['user']."');\n	define('MQ_SERVER_ADDR', '".$_SESSION['page']['MQ_SERVER_ADDR']."');\n	define('MQ_SERVER_PORT', '".$_SESSION['page']['MQ_SERVER_PORT']."');\n	define('WS_CONFIG_DBPASS', '".$_SESSION['mysql']['pass']."');\n	define('WS_CONFIG_DBNAME', '".$_SESSION['mysql']['data']."');\n	define('WS_CONFIG_SERVER', '".$_SESSION['page']['server_name']."');\n	define('WS_OPTICAL_TITLE', '".$_SESSION['page']['server_title']."');\n	define('WS_OPTICAL_TAB_TITLE', '".$_SESSION['page']['tab_title']."');\n	define('WS_CONFIG_MODULE', '".$_SESSION['page']['default_module']."');\n	define('WS_CONFIG_BACKGROUND', '".$_SESSION['page']['default_background']."');\n	define('WS_CONFIG_PAGENUM', '".$_SESSION['page']['users_per_page']."');\n	define('WS_CONFIG_CACHETIME', '".$_SESSION['page']['2d_cache_time']."');\n	$threedsetting define('WS_CONFIG_DEADLINE', '".$_SESSION['page']['player_inactivity']."');\n	define('WS_CONFIG_LOGO', '".$_SESSION['page']['logo_image_link']."');\n	define('WS_HOMEPAGE_LOGO', '".$_SESSION['page']['logo_image_filename']."');\n	define('WS_MAINSITE', '".$_SESSION['page']['homepage_link']."');\n	$logoon	define('WS_BOOKMARK', '".$_SESSION['page']['bookmark_title']."');\n	 define('WS_PHOTO_PHP_CHANGE', 'large_player_image'); \n $achievments $economy	$jail $jobs $mcmmo $permissionsex $stats	define('WS_GOOGLE_FOOTER', '$google_footer'); \n define('WS_GOOGLE_FOOTER_MOBILE', '$google_footer_mobile'); \n	define('WS_GOOGLE_ASIDE', '$google_aside'); \n	$pluginconfigstatusachiv	$pluginconfigstatuseconomy	$pluginconfigstatusjail	$pluginconfigjobs	$pluginconfigstatusmcmmo	$pluginconfigstatuspermissionsex	$pluginconfigstatusstats	define('serveraddr','".$SERVERIP."')  ?>";
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
	}
} else {
	header("location:".adminPageURL());
}
?>