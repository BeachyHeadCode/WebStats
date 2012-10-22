<?php
function permissionsex_player_table($player)
{
	$query = "SELECT * FROM ".WS_CONFIG_PERMISSIONS."_inheritance WHERE ".WS_CONFIG_PERMISSIONS."_inheritance.child = '".$player."'";
	$result = mysql_query($query);
	$data = mysql_fetch_array($result);
	if(isset($data['parent'])){
		$query = "SELECT * FROM ".WS_CONFIG_PERMISSIONS." WHERE ".WS_CONFIG_PERMISSIONS.".name = '".$data['parent']."'";
		$result = mysql_query($query);
		$time = 0;
		while($row = mysql_fetch_array($result)) 
		{
			$permissiondata[$time] = $row['permission'];
			$time++;
		}
		if($permissiondata['world']==''){$noworld='ALL';}else{$noworld=$permissiondata['world'];}
			$output .= '<div class="head_maintable_permissionsex">';	
			
				$output .= '<h2>Permissions</h2>';
				$output .= '<div style="clear:both;" class="mcmmo_player_table">';
					$output .= '<div align="left" class="content_headline" id="permissionsex_role"><span>Role(s):</span></div>';
					$output .= '<div align="left" class="content_headline" id="permissionsex_world"><span>World(s):</span></div>';
				$output .= '</div>';
				$output .= '<div style="clear:both;" class="mcmmo_player_table">';
					$output .= '<div align="left" class="content_line" id="permissionsex_role"><a href="index.php?mode=permissionsex&group='.$data['parent'].'">'.$data['parent'].'</a></div>';
					$output .= '<div align="left" class="content_line" id="permissionsex_world">'.$noworld.'</div>';
				$output .= '</div><br />';
			$output .= '</div>';
		return $output;
	}
	else{
		$query = "SELECT * FROM ".WS_CONFIG_PERMISSIONS." WHERE ".WS_CONFIG_PERMISSIONS.".name = '".WS_PERMISSIONS_DEFAULT_GROUP."'";
		$result = mysql_query($query);
		$time = 0;
		while($row = mysql_fetch_array($result)) 
		{
			$permissiondata[$time] = $row['permission'];
			$time++;
		}
		if($permissiondata['world']==''){$noworld='ALL';}else{$noworld=$permissiondata['world'];}
			$output .= '<div class="head_maintable_permissionsex">';
				$output .= '<h2>Permissions</h2>';
				$output .= '<div style="clear:both;" class="mcmmo_player_table">';
					$output .= '<div align="left" class="content_headline" id="permissionsex_role"><span>Role(s):</span></div>';
					$output .= '<div align="left" class="content_headline" id="permissionsex_world"><span>World(s):</span></div>';
				$output .= '</div>';
				$output .= '<div style="clear:both;" class="mcmmo_player_table">';
					$output .= '<div align="left" class="content_line" id="permissionsex_role"><a href="index.php?mode=permissionsex&group='.WS_PERMISSIONS_DEFAULT_GROUP.'">'.WS_PERMISSIONS_DEFAULT_GROUP.'</a></div>';
					$output .= '<div align="left" class="content_line" id="permissionsex_world">'.$noworld.'</div>';
				$output .= '</div><br />';
			$output .= '</div>';
		return $output;
	}
}
function permissionsex_group_table($group)
{
		$query = "SELECT * FROM ".WS_CONFIG_PERMISSIONS." WHERE ".WS_CONFIG_PERMISSIONS.".name = '".$group."'";
		$result = mysql_query($query);
		$time = 0;
		
		while($row = mysql_fetch_array($result)) 
		{
			$permissiondata[$time] = $row['permission'];
			$time++;
		}
		$data = mysql_fetch_array($result);
		if($permissiondata['world']==''){$noworld='ALL';}else{$noworld=$permissiondata['world'];}
		$output .= '<h2>Permissions For '.$group.'</h2>';
			$output .= '<div class="head_maintable_permissionsex">';
			
				$output .= '<div style="clear:both;" class="mcmmo_player_table">';
					$output .= '<div align="left" class="content_headline" id="permissionsex_permissions">Permissions:</div>';
					$output .= '<div align="left" class="content_headline" id="permissionsex_world">World(s): '.$noworld.'</div>';
				$output .= '</div>';
				
				$output .= '<div class="permissions_player_table">';
					for($i=0; $i < sizeof($permissiondata); $i++)
					{
						$output .= '<div style="clear:both;" align="left" class="content_line" id="permissionsex_permissions">'.$permissiondata[$i].'</div>';
					}
				$output .= '</div>';
			$output .= '</div>';
		return $output;
}
?>