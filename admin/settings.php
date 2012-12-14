<?php
 if($_SESSION['config'] == 'Yes'){
	 include('config.php');
	 echo '<span><b>You Have Chosen To Edit</b></span>';
	 ?>
	<form action="#" method="post" class="custom">
        <fieldset>
			<legend style="background: none;"><h2>MySQL of Minecraft Plugin(s)</h2></legend>
			<label for="mysql[URL]">Enter URL Of Host:</label> <input type="text" name="mysql[URL]" id="mysql[URL]" title="MySQL URL" value="<?php if(!isset($_SESSION['mysql']['URL'])){ echo WS_CONFIG_DBHOST;}else{ echo $_SESSION['mysql']['URL'];} ?>" maxlength="60"/><br/>
            <label for="mysql[PORT]">Enter Port Of Host:</label> <input name="mysql[PORT]" type="text" id="mysql[PORT]" title="MySQL PORT" value="<?php if(!isset($_SESSION['mysql']['PORT'])){ echo WS_CONFIG_DBPORT;}else{ echo $_SESSION['mysql']['PORT'];} ?>" maxlength="5"/><br/>
			<label for="mysql[user]">Enter Username:</label> <input name="mysql[user]" type="text" id="mysql[user]" accesskey="" title="MySQL Username" value="<?php if(!isset($_SESSION['mysql']['user'])){ echo WS_CONFIG_DBUNAME;}else{ echo $_SESSION['mysql']['user'];} ?>" maxlength="16"/><br/>
			<label for="mysql[pass]">Enter Password:</label> <input name="mysql[pass]" type="password" id="mysql[pass]" title="MySQL Password" value="<?php if(!isset($_SESSION['mysql']['pass'])){ echo WS_CONFIG_DBPASS;}else{ echo $_SESSION['mysql']['pass'];} ?>" maxlength="32"/><br/>
			<label for="mysql[data]">Enter Database:</label> <input name="mysql[data]" type="text" id="mysql[data]" title="MySQL Database" value="<?php if(!isset($_SESSION['mysql']['data'])){ echo WS_CONFIG_DBNAME;}else{ echo $_SESSION['mysql']['data'];} ?>" maxlength="64"/><br/><br/>
            <?php echo noclick ?>What Plugins Would You Like To Use?</span><br/>
            <table>
				<thead>
					<th><?php echo noclick ?>Achievements:</span></th>
					<th><?php echo noclick ?>iConomy:</span></th>
                    <th><?php echo noclick ?>Jail:</span></th>
					<th><?php echo noclick ?>Jobs:</span></th>
					<th><?php echo noclick ?>McMMO:</span></th>
                    <th><?php echo noclick ?>PermissionsEx:</span></th>
                    <th><?php echo noclick ?>Stats:</span></th>
				</thead>
                <tbody>           
				<tr>
					<td><input type="checkbox1" name="pluginconfigachiv" title="Achievements On" value="true" <?php if(pluginconfigstatusachiv === true){ echo 'checked="checked"';} ?> style="display: none;"/></td>
					<td><input type="checkbox" name="pluginconfigiconomy" title="iConomy On" value="true" <?php if(pluginconfigstatusiconomy === true){ echo 'checked="checked"';} ?>/></td>
                    <td><input type="checkbox" name="pluginconfigjail" title="Jail On" value="true" <?php if(pluginconfigstatusjail === true){ echo 'checked="checked"';} ?>/></td>
					<td><input type="checkbox" name="pluginconfigjobs" title="Jobs On" value="true" <?php if(pluginconfigstatusjobs === true){ echo 'checked="checked"';} ?>/></td>
					<td><input type="checkbox" name="pluginconfigmcmmo" title="McMMO On" value="true" <?php if(pluginconfigstatusmcmmo === true){ echo 'checked="checked"';} ?>/></td>
                    <td><input type="checkbox" name="pluginconfigpermissionsex" title="McMMO On" value="true" <?php if(pluginconfigpermissionsex === true){ echo 'checked="checked"';} ?>/></td>
                    <td><input type="checkbox" name="pluginconfigstats" title="Stats On" value="true" <?php if(pluginconfigstatusstats === true){ echo 'checked="checked"';} ?> /></td>
				</tr>
                </tbody>
			</table>
  <input name="submitmysql" type="submit" title="Submit MySQL" onclick="MM_validateForm('mysql[URL]','','R','mysql[PORT]','','NisNum','mysql[user]','','R','mysql[pass]','','R','mysql[data]','','R');return document.MM_returnValue" class="small success button" /><br/>
            </fieldset>
		</form>
      <?php  	
	$host= $_SESSION['mysql'][URL].":".$_SESSION['mysql']['PORT'];
	$user=$_SESSION['mysql']['user'];
	$pass=$_SESSION['mysql']['pass'];
	$db=$_SESSION['mysql']['data'];
	$DB = new DBConfig();$DB -> config();$DB -> conn($host, $user, $pass, $db); $DB -> close(); ?>
      
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
	<select style="display:none;" id="customDropdown" class="select2" title="Background" name="page[default_background]">  
		<?php 
			$filetypes = array('gif', 'jpg', 'png');
			$handle= opendir ("../images/background");
			while ($file = readdir ($handle)){
				$info = pathinfo($file);
				if(!in_array($info['extension'], $filetypes))continue;
					if (!is_dir($file)){
						$background = explode('.', $file);
						$background = str_replace("bg_", "", $background);
						if(WS_CONFIG_BACKGROUND == $background[0])
							echo ('<option value=".$background[0]." SELECTED>'.$background[0]."</option>");
						else 
							echo "<option value='".$background[0]."'>".$background[0]."</option>";
					}
			}closedir($handle);
		?>
    </select><br/>
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
<?php if($_SESSION['pluginconfigachiv'] == true){ ?>
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
			<?php for($i=0;$i<count($McMMOSort);$i++){if(WS_CONFIG_MCMMO_DEFAULT == $McMMOSort[$i]){echo "<option value='".$McMMOSort[$i]."' selected>".$McMMOSort[$i]."</option>";}else{echo "<option value='".$McMMOSort[$i]."'>".$McMMOSort[$i]."</option>";}}echo $i;?>
	</select><br/>
<?php }
if($_SESSION['pluginconfigpermissionsex'] == true){ ?>
	<label for="page">PermissionsEx MySQL Table Name: <input name="page[permissionsex_table_name]" type="text" id="page[permissionsex_table_name]" title="PermissionsEx Table Name" value="<?php if(!isset($_SESSION['page']['permissionsex_table_name'])){ echo WS_CONFIG_PERMISSIONS;}else{ echo $_SESSION['page']['permissionsex_table_name'];} ?>" maxlength="16"/></label>
    <label for="page">PermissionsEx Default Group Name: <input name="page[permissionsex_default_group]" type="text" id="page[permissionsex_default_group]" title="PermissionsEx Default Group Name" value="<?php if(!isset($_SESSION['page']['permissionsex_default_group'])){ echo WS_PERMISSIONS_DEFAULT_GROUP;}else{ echo $_SESSION['page']['permissionsex_default_group'];} ?>" maxlength="25"/></label>
<?php }
if($_SESSION['pluginconfigstats'] == true){ ?>
	<label for="page">Stats MySQL Table: <input name="page[stats_table_name]" type="text" id="page[stats_table_name]" title="Server Name" value="<?php if(!isset($_SESSION['page']['stats_table_name'])){ echo WS_CONFIG_STATS;}else{ echo $_SESSION['page']['stats_table_name'];} ?>" maxlength="16"/></label>
	<label for="page">Stats - Show Played Time In Days, Hours, Minutes : <input type="checkbox" name="page[timechange_on/off]" title="Stats Time Variable" value="<?php if(!isset($_SESSION['page']['timechange_on/off'])){ echo 'true';}else{ echo $_SESSION['page']['timechange_on/off'];} ?>" <?php if(WS_CONFIG_PLAYTIME === true){ echo 'checked="checked"';} ?>/></label> 
<?php } ?>
	<input name="submitconfig" type="submit" title="Submit Config" onclick="MM_validateForm('mysql[URL]','','R','mysql[PORT]','','RisNum','mysql[user]','','R','mysql[pass]','','R','mysql[data]','','R','page[server_name]','','R','page[server_title]','','R','page[MQ_SERVER_ADDR]','','R','page[MQ_SERVER_PORT]','','RisNum','page[tab_title]','','R','page[default_module]','','R','page[users_per_page]','','R','page[2d_cache_time]','','RisNum','page[player_inactivity]','','RisNum','page[logo_image_link]','','R','page[logo_image_filename]','','R','page[homepage_link]','','R','page[bookmark_title]','','R');return document.MM_returnValue" value="Submit Config" class="small success button" />
	</fieldset>
	</form>
<?php
}
	 
}?>