<?php

//SETS NUMBER OF USERS TO PRINT
function get_jobs_user_count() {
	$query = mysqli_query($link, "SELECT COUNT(`username`) FROM `".WS_CONFIG_JOBS."`");
	$row = mysqli_fetch_array($query);
	return $row[0];
}	

function get_jobs_user_stats($sort, $start, $end) {
	if($sort != 'job' AND $sort != 'level' AND $sort != 'experience') {$sortkey = 'ORDER BY `username` ASC';}
	elseif($sort == 'job') {$sortkey = 'ORDER BY `job` ASC';}
	elseif($sort == 'level') {$sortkey = 'ORDER BY `level` DESC';}
	elseif($sort == 'experience') {$sortkey = 'ORDER BY `experience` DESC';}
	$query = mysqli_query($link, "SELECT * FROM `".WS_CONFIG_JOBS."` GROUP BY `username` ".$sortkey." LIMIT ".$start.",".$end."");
	$time = 0;
	while($row = mysqli_fetch_array($query)) {
		$players[$time] = $row[0];
		$time++;
	}  
	return $players;	
}

function job_player_info_table($player) {
	$count = 0;
	$query = mysqli_query($link, "SELECT * FROM `".WS_CONFIG_JOBS."` WHERE `username`='".$player."'");
	while($daten = mysqli_fetch_array($query)) {
		$container[$count] = $daten;
		$count++;
	};
	return $container;
}

function job_server_info_table() {
	$query = mysqli_query($link, "SELECT COUNT(`username`), SUM(`experience`), SUM(`level`), `job` FROM `".WS_CONFIG_JOBS."` GROUP BY `job`");
	while($row = mysqli_fetch_array($query)) {
		$output .= '<div>';
		$output .= '<div style="width:100px; height:25px; float:left;"><b>'.$row[3].'</b></div>';						
		$output .= '<div style="width:50px; height:25px; float:left;">'.$row[0].'x</div>';
		$output .= '</div>';
	}	
	$output .= "\n"; 
	return $output;
}

function job_experience_info_table() {
	$query = mysqli_query($link, "SELECT COUNT(`username`), SUM(`experience`), SUM(`level`), `job` FROM `".WS_CONFIG_JOBS."` GROUP BY `job`");
	while($row = mysqli_fetch_array($query)) {
		$output .= '<div style="width:120px; height:25px;"><b>'.$row[1].'</b></div>';
	}	
	$output .= "\n"; 
	return $output;
}

function job_level_info_table() {
	$query = mysqli_query($link, "SELECT COUNT(`username`), SUM(`experience`), SUM(`level`), `job` FROM `".WS_CONFIG_JOBS."` GROUP BY `job`");
	while($row = mysqli_fetch_array($query)) {
		$output .= '<div style="width:80px; height:25px;"><b>'.$row[2].'</b></div>';
	}	
	$output .= "\n"; 
	return $output;
}

function job_player_list_table($player, $dummy) {
	global $image_control;
	global $stats_control;
	$query = mysqli_query($link, "SELECT * FROM `".WS_CONFIG_JOBS."` WHERE `username`='".$player."'");
	while ($info = mysqli_fetch_array($query)) {
		if($image_control == true) {
			$image = small_image($player);
		}
		if($stats_control == true) { $stats = '<a class="ajax-link" href="index.php?mode=show-player&user='.$player.'">'.$player.'</a>'; } else { $stats = ''.$player.''; }
		$output .= '<tr><td>&nbsp;&nbsp;'.$image.''.$stats.'</td>';
    		$output .= '<td>'.$info[3].'</td>';
    		$output .= '<td>'.$info[2].'</td>';
    		$output .= '<td>'.$info[1].'</td>';
		$output .= "</tr>";
	}
	return $output;
}

function job_player_details_table($player) {
	$controller = 0;
	$output = '<div class="head_maintable_stats">';
				$output .= '<h2><a title="Jobs Server Stats" href="?mode=jobs">Jobs</a></h2>';
	$output .= '<table width="100%">';
	$jobinfo = job_player_info_table($player);
	for($i=0; $i < sizeof($jobinfo); $i++) {
					
			$output .= '
				<tr>
					<td width="170px"><b>'.translate('var35').':</b></td>
					<td><a class="ajax-link" href="index.php?mode=jobs">'.$jobinfo[$i][3].'</a></td>
				</tr>
				<tr>
					<td align="left"><b>'.translate('var36').':</b></td>
					<td align="center"> '.$jobinfo[$i][2].'</td>
				</tr>
				<tr>
					<td align="left"><b>'.translate('var37').':</b></td>
					<td align="center"> '.$jobinfo[$i][1].'</td>
				</tr>';
			$output .= '</td>';	
		$output .= '</tr>';
	}
	$output .= '</table></div>';
	return $output;
}

function job_server_details_table() {
	$output = '<div class="large-6 columns head_logo" style="background-image:url('.WS_CONFIG_LOGO.');"></div>';

	$output .= '<div class="large-6 columns head_contentbox">';
	$output .= '<div style="clear:both">
					<div class="head_stat" style="width:350px; font-weight:bold;">
						<div class="head_stat" style="width:150px;">'.translate("var34").':</div>
						<div class="head_stat" style="width:80px; text-align:center;">'.translate("var38").':</div>
						<div class="head_stat" style="width:120px; text-align:center;">'.translate("var39").':</div>
					</div>
				</div>
				<br /><br />
				<div style="clear:both; float:left;">					
					<div class="head_content" style="width:150px;"> '.job_server_info_table().'</div>
				</div>
				
				<div style="float:left;">					
					<div class="head_content" style="width:80px; text-align:center;"> '.job_level_info_table().'</div>
				</div>
				
				<div style="float:left;">					
					<div class="head_content" style="width:120px; text-align:center;"> '.job_experience_info_table().'</div>
				</div>';
	$output .= '</div>';
	return $output;
}
?>