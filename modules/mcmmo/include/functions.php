<?php
function get_mcmmo_user_count() {
	global $link;
	$query = mysqli_query($link, "SELECT COUNT(`user`) FROM `".WS_CONFIG_MCMMO."users`");
	$row = mysqli_fetch_array($query);
	return $row[0];
}
function get_mcmmo_user_stats_order($sort, $start, $end) {
	global $link;
	if(isset($sort)) {
		switch($sort) {
			case "acrobatics";
				$sortkey = "ORDER BY `acrobatics` DESC";
			break;
			case "archery";
				$sortkey = "ORDER BY `archery` DESC";
			break;
			case "axes";
				$sortkey = "ORDER BY `axes` DESC";
			break;
			case "blast_mining";
				$sortkey = "ORDER BY `blast_mining` DESC";
			break;
			case "excavation";
				$sortkey = "ORDER BY `excavation` DESC";
			break;
			case "fishing";
				$sortkey = "ORDER BY `fishing` DESC";
			break;
			case "herbalism";
				$sortkey = "ORDER BY `herbalism` DESC";
			break;
			case "mining";
				$sortkey = "ORDER BY `mining` DESC";
			break;
			case "repair";
				$sortkey = "ORDER BY `repair` DESC";
			break;
			case "swords";
				$sortkey = "ORDER BY `swords` DESC";
			break;
			case "taming";
				$sortkey = "ORDER BY `taming` DESC";
			break;
			case "unarmed";
				$sortkey = "ORDER BY `unarmed` DESC";
			break;
			case "woodcutting";
				$sortkey = "ORDER BY `woodcutting` DESC";
			break;
			case "user";
				$sortkey = "ORDER BY `user` ASC";
			break;
		}
	} else {
		$sortkey = 'ORDER BY '.WS_CONFIG_MCMMO_DEFAULT.'';
	}
	$result = "SELECT * FROM `".WS_CONFIG_MCMMO."users` LEFT JOIN `".WS_CONFIG_MCMMO."skills` ON `".WS_CONFIG_MCMMO."skills`.`user_id` = `".WS_CONFIG_MCMMO."users`.`id` WHERE `".WS_CONFIG_MCMMO."users`.`user` != '' ".$sortkey." LIMIT ".$start.",".$end."";
	$query = mysqli_query($link, $result);
	$time = 0;
	while($row = mysqli_fetch_array($query)) {
		$players[$time] = $row[1];
		$time++;
	}  
	return $players;
}
function mcmmo_server_player_table($player, $pos) {
	global $link, $stats_control, $image_control;
	$McMMOskill = array("acrobatics","archery","axes","excavation","fishing","herbalism","mining","repair","swords","taming","unarmed","woodcutting");
	$pos++;
	$query = "SELECT * FROM `".WS_CONFIG_MCMMO."users` LEFT JOIN `".WS_CONFIG_MCMMO."skills` ON ".WS_CONFIG_MCMMO."users.id = ".WS_CONFIG_MCMMO."skills.user_id WHERE ".WS_CONFIG_MCMMO."users.user = '".$player."' AND ".WS_CONFIG_MCMMO."users.user != '' ";
	$result = mysqli_query($link, $query) or mysqli_error($link);
	$data = mysqli_fetch_array($result);
	$skilltotal=0;
	for($i=0;$i<count($McMMOskill);$i++){$skilltotal= $skilltotal+$data[$McMMOskill[$i]];}
	if($image_control == true) {
		$image = small_image($player);
	}
	if($stats_control == true) {
		$stats = '<a class="ajax-link" href="index.php?mode=show-player&user='.$player.'">'.$player.'</a>'; 
	} else { 
		$stats = ''.$player.'';
	}
	$output .= '<tr><td>'.$pos.'</td>';     
	$output .= '<td>&nbsp;&nbsp;'.$image.' '.$stats.'</td>';
	for($i=0;$i<count($McMMOskill);$i++) {
		$output .= '<td>'.$data[$McMMOskill[$i]].'</td>';
	}
	$output .= '<td>'.$skilltotal.'</td></tr>';
    
	return $output;
}
function mcmmo_player_xp_pic($player, $skillname) {
	global $link;
	$McMMOskill = array("acrobatics","archery","axes","excavation","fishing","herbalism","mining","repair","swords","taming","unarmed","woodcutting");
	$query = "SELECT * FROM `".WS_CONFIG_MCMMO."users` LEFT JOIN `".WS_CONFIG_MCMMO."skills` ON ".WS_CONFIG_MCMMO."users.id = ".WS_CONFIG_MCMMO."skills.user_id WHERE ".WS_CONFIG_MCMMO."users.user = '".$player."'";
	$result = mysqli_query($link, $query) or mysqli_error($link);
	$data = mysqli_fetch_array($result);
	$query = "SELECT * FROM `".WS_CONFIG_MCMMO."users` LEFT JOIN `".WS_CONFIG_MCMMO."experience` ON ".WS_CONFIG_MCMMO."users.id = ".WS_CONFIG_MCMMO."experience.user_id WHERE ".WS_CONFIG_MCMMO."users.user = '".$player."' AND ".WS_CONFIG_MCMMO."users.user != '' ";
	$result = mysqli_query($link, $query) or mysqli_error($link);
		$mcmmoxp = mysqli_fetch_array($result);
		for($i=0;$i<count($McMMOskill);$i++) {
			if($McMMOskill[$i]==$skillname) {
				$total_xp_for_level_up = 1020+(20*($data[$McMMOskill[$i]]));
				$xpPercent = $mcmmoxp[$McMMOskill[$i]]/$total_xp_for_level_up;//XP RATIO
				$pernum=0;
				for($num=0;$num<=253;$num++) {
					$pernum=($pernum+(100/254));
					if(($xpPercent*100) >= 0 && ($xpPercent*100) <= $pernum) {
						$picnum=$pernum*(254/100);
						if($picnum >=0 && $picnum <=9){$output .= '<img src="modules/mcmmo/images/xp_bar/xpbar_inc00'.$picnum.'.png" height="4" width="128"/>';}
						if($picnum >=10 && $picnum <=99){$output .= '<img src="modules/mcmmo/images/xp_bar/xpbar_inc0'.$picnum.'.png" height="4" width="128" />';}
						if($picnum >=100 && $picnum <=254){$output .= '<img src="modules/mcmmo/images/xp_bar/xpbar_inc'.$picnum.'.png" height="4" width="128" />';}
					break;
					}
					if(($xpPercent*100) >= $pernum && ($xpPercent*100) <= ($pernum+(100/254))) {
						$picnum=$pernum*(254/100);
						if($picnum >=0 && $picnum <=9){$output .= '<img src="modules/mcmmo/images/xp_bar/xpbar_inc00'.$picnum.'.png" height="4" width="128"  />';}
						if($picnum >=10 && $picnum <=99){$output .= '<img src="modules/mcmmo/images/xp_bar/xpbar_inc0'.$picnum.'.png" height="4" width="128" />';}
						if($picnum >=100 && $picnum <=254){$output .= '<img src="modules/mcmmo/images/xp_bar/xpbar_inc'.$picnum.'.png" height="4" width="128" />';}
					break;
					}
				}
			}
		}
	return $output;
}
function mcmmo_player_skills_table($player) {
	global $link;
	$McMMOskill = array("acrobatics","archery","axes","excavation","fishing","herbalism","mining","repair","swords","taming","unarmed","woodcutting","powerlevel");
	$output .= '<div class="head_maintable_mcmmo">';
	$output .= '<h2><a title="McMMO Server Stats" href="?mode=mcmmo">McMMO</a></h2>';
	$output .= '<table style="margin:auto;">'."<tr>\n";
	for($i=0;$i < count($McMMOskill);$i++) {
		$output .= '<td><img src="modules/mcmmo/images/'.$McMMOskill[$i].'.png" width="24px" height="24px" border="0" id="'.$McMMOskill[$i].'" title="'.$McMMOskill[$i].'" />'."</td>\n";
	}
	$output .= "</tr>\n";
	$query = "SELECT * FROM `".WS_CONFIG_MCMMO."users` LEFT JOIN `".WS_CONFIG_MCMMO."skills` ON ".WS_CONFIG_MCMMO."users.id = ".WS_CONFIG_MCMMO."skills.user_id WHERE ".WS_CONFIG_MCMMO."users.user = '".$player."'";
	$result = mysqli_query($link, $query);
	if($result) {
		$data = mysqli_fetch_array($result);
		$skilltotal=0;
		for($i=0;$i<count($McMMOskill);$i++){$skilltotal= $skilltotal+$data[$McMMOskill[$i]];}
		$output .= '<tr>';
		for($i=0;$i<(count($McMMOskill)-1);$i++) {
			$output .= '<td id="'.$McMMOskill[$i].'">'.$data[$McMMOskill[$i]]."</td>\n";
		}
		$output .= '<td>'.$skilltotal."</td></tr>\n";
	} else {
		$output .= '<tr>'.mysqli_error($link)."</tr>\n"; 
	}
	$output .= '</table>
	<div id="xpimage" style="margin:auto;"></div>
	</div>';
	for($i=0;$i<count($McMMOskill);$i++) {
		$output.= '<script type="text/javascript">
		$("#'.$McMMOskill[$i].'").mouseenter(function(){$(\''.mcmmo_player_xp_pic($player, $McMMOskill[$i]).'\').appendTo($("#xpimage"));});
		$("#'.$McMMOskill[$i].'").mouseleave(function(){$("#xpimage").find("img").remove();});
		</script>';		
	}
	return $output;
}
?>