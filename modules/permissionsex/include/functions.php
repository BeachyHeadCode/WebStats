<?php
function permissionsex_player_table($player)
{
	$query = "SELECT * FROM ".WS_CONFIG_PERMISSIONS."_inheritance WHERE ".WS_CONFIG_PERMISSIONS."_inheritance.child = '".$player."'";
	$result = mysql_query($query);
	$data = mysql_fetch_array($result);
	if(isset($data['parent'])) {
		$query = "SELECT * FROM ".WS_CONFIG_PERMISSIONS." WHERE ".WS_CONFIG_PERMISSIONS.".name = '".$data['parent']."'";
		$result = mysql_query($query);
		$time = 0;
		while($row = mysql_fetch_array($result)) {
			$permissiondata[$time] = $row['permission'];
			$time++;
		}
		if($permissiondata['world']=='') {$noworld='ALL';} else {$noworld=$permissiondata['world'];}
				$output = '<h2>Permissions</h2>';
				$output .= '<table><thead>';
					$output .= '<tr><td>Role(s):</td>';
					$output .= '<td>World(s):</td></tr></thead>';
				$output .= '';
				$output .= '<tbody>';
					$output .= '<tr><td><a href="index.php?mode=permissionsex&group='.$data['parent'].'">'.$data['parent'].'</a></td>';
					$output .= '<td>'.$noworld.'</td></tr>';
				$output .= '</tbody>';
			$output .= '</table>';
		return $output;
	} else {
		$query = "SELECT * FROM ".WS_CONFIG_PERMISSIONS." WHERE ".WS_CONFIG_PERMISSIONS.".name = '".WS_PERMISSIONS_DEFAULT_GROUP."'";
		$result = mysql_query($query);
		$time = 0;
		while($row = mysql_fetch_array($result)) {
			$permissiondata[$time] = $row['permission'];
			$time++;
		}
		if($permissiondata['world']=='') {$noworld='ALL';} else {$noworld=$permissiondata['world'];}
			$output = '<div class="head_maintable_permissionsex">';
				$output .= '<h2>Permissions</h2>';
				$output .= '<table style="margin: 0px auto;"><thead><tr>';
					$output .= '<td>Role(s):</td>';
					$output .= '<td>World(s):</td>';
				$output .= '</tr></thead>';
				$output .= '<tr>';
					$output .= '<td><a href="index.php?mode=permissionsex&group='.WS_PERMISSIONS_DEFAULT_GROUP.'">'.WS_PERMISSIONS_DEFAULT_GROUP.'</a></td>';
					$output .= '<td>'.$noworld.'</td>';
				$output .= '</tr>';
			$output .= '</table></div>';
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
		if($permissiondata['world']=='') {$noworld='ALL';} else {$noworld=$permissiondata['world'];}
		$output .= '<h2>Permissions For '.$group.'</h2>';
			$output .= '<div class="head_maintable_permissionsex">';
			
				$output .= '<table style="margin: 0px auto;"><thead><tr>';
					$output .= '<td>Permissions:</td>';
					$output .= '<td>World(s): '.$noworld.'</td>';
				$output .= '</tr></thead>';
				
				$output .= '<tbody>';
					for($i=0; $i < sizeof($permissiondata); $i++)
					{
						$output .= '<tr><td>'.$permissiondata[$i].'</td></tr>';
					}
				$output .= '</tbody>';
			$output .= '</table></div>';
		return $output;
}
?>