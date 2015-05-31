<?php
define('ROOT', '../../../');
if(file_exists(ROOT . 'config/config.php'))
	include_once ROOT . 'config/config.php';

if (isset($_POST['permissionsex_player_table'])) {
	$link = mysqli_connect(WS_CONFIG_DBHOST, WS_CONFIG_DBUNAME, WS_CONFIG_DBPASS, WS_CONFIG_DBNAME, WS_CONFIG_DBPORT);
	echo permissionsex_player_table($_POST['permissionsex_player_table']);
	mysqli_close($link);
}

function permissionsex_player_table($player) {
	$result = mysqli_query($link, "SELECT * FROM `".WS_CONFIG_PERMISSIONS."_inheritance` WHERE `".WS_CONFIG_PERMISSIONS."_inheritance`.`child` = '".$player."'");
	$data = mysqli_fetch_array($result, MYSQLI_BOTH);
	if(isset($data['parent'])) {
		$result = mysqli_query($link, "SELECT * FROM `".WS_CONFIG_PERMISSIONS."` WHERE `".WS_CONFIG_PERMISSIONS."`.`name` = '".$data['parent']."'");
		$time = 0;
		while($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
			$permissiondata[$time] = $row['permission'];
			$time++;
		}
		if($permissiondata['world']=='') {$noworld='ALL';} else {$noworld=$permissiondata['world'];}
				$output = '<div class="large-9 large-centered columns head_maintable">';
				$output .= '<h2>Permissions</h2>';
				$output .= '<table style="margin: 0px auto;"><thead>';
					$output .= '<tr><td>Role(s):</td>';
					$output .= '<td>World(s):</td></tr></thead>';
				$output .= '';
				$output .= '<tbody>';
					$output .= '<tr><td><a class="ajax-link" href="index.php?mode=permissionsex&group='.$data['parent'].'">'.$data['parent'].'</a></td>';
					$output .= '<td>'.$noworld.'</td></tr>';
				$output .= '</tbody>';
			$output .= '</table></div>';
		return $output;
	} else {
		$result = mysqli_query($link, "SELECT * FROM ".WS_CONFIG_PERMISSIONS." WHERE ".WS_CONFIG_PERMISSIONS.".name = '".WS_PERMISSIONS_DEFAULT_GROUP."'");
		$time = 0;
		while($row = mysqlI_fetch_array($result, MYSQLI_BOTH)) {
			$permissiondata[$time] = $row['permission'];
			$time++;
		}
		if($permissiondata['world']=='') {$noworld='ALL';} else {$noworld=$permissiondata['world'];}
			$output = '<div class="large-9 large-centered columns head_maintable">';
				$output .= '<h2>Permissions</h2>';
				$output .= '<table style="margin: 0px auto;"><thead><tr>';
					$output .= '<td>Role(s):</td>';
					$output .= '<td>World(s):</td>';
				$output .= '</tr></thead>';
				$output .= '<tr>';
					$output .= '<td><a class="ajax-link" href="index.php?mode=permissionsex&group='.WS_PERMISSIONS_DEFAULT_GROUP.'">'.WS_PERMISSIONS_DEFAULT_GROUP.'</a></td>';
					$output .= '<td>'.$noworld.'</td>';
				$output .= '</tr>';
			$output .= '</table></div>';
		return $output;
	}
}

function permissionsex_group_table($group) {
		$result = mysqli_query($link, "SELECT * FROM `".WS_CONFIG_PERMISSIONS."` WHERE `".WS_CONFIG_PERMISSIONS."`.`name` = '".$group."'");
		$time = 0;
		
		while($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
			$permissiondata[$time] = $row['permission'];
			$time++;
		}
		$data = mysqli_fetch_array($result, MYSQLI_BOTH);
		if($permissiondata['world']=='') {$noworld='ALL';} else {$noworld=$permissiondata['world'];}
		$output .= '<h2>Permissions For '.$group.'</h2>';
			$output .= '<div class="large-9 large-centered columns head_maintable">';
			
				$output .= '<table style="margin: 0px auto;"><thead><tr>';
					$output .= '<td>Permissions:</td>';
					$output .= '<td>World(s): '.$noworld.'</td>';
				$output .= '</tr></thead>';
				
				$output .= '<tbody>';
					for($i=0; $i < sizeof($permissiondata); $i++) {
						$output .= '<tr><td>'.$permissiondata[$i].'</td></tr>';
					}
				$output .= '</tbody>';
			$output .= '</table></div>';
		return $output;
}
?>