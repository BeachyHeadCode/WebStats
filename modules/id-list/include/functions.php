<?php

function id_index_table(){
	global $stats_control;
	for ($i=0; $i <= 2300; $i++){
   		if($i == 6 or $i == 17 or $i == 18 or $i == 31 or $i == 35 or $i == 43 or $i == 44 or $i == 97 or $i == 98 or $i == 263 or $i == 351 or $i == 373 or $i == 383) {
			for ($x=0; $x <= 8300; $x++) {
				if($x == 0) {
					$z = '';
					$item_name = translate($i.$z);
					$item_id = $i;
					$item_img = $i.$z;
				} else {
					$z = ':'.$x;
					$item_name = translate($i.$z);
					$item_id = $i.$z;
					$z = '-'.$x;
					$item_img = $i.$z;
				}
				if($item_name != $item_id){						
					if($stats_control == true){ 	
						$stats = '<a href="index.php?mode=material-stats&material='.$item_id.'" '.hover.' ><t>'.$item_name.'</t></a>'; 
					} else 
						$stats = $item_name; 
					$searchitem = strtolower($item_name);
					$output .= '<tr class="item">';
					$output .= '<td class="id">'.$item_id.'</td>';
					$output .= '<td class="icon"><a href="http://www.minecraftwiki.net/wiki/'.$item_name.'" target="_blank" '.hover.' ><img src="images/icons/'.$item_img.'.png" width="24px" height="24px" border="0" /></a></td>';
    				$output .= '<td class="name" title="'.$item_name.'">'.$stats.'</td>';
					$output .= "</tr>";
				}
			}
		} else {
			$item_name = translate($i);
			$item_id = $i;
			if($item_name != $item_id) {
				if($stats_control == true)
					$stats = '<a href="index.php?mode=material-stats&material='.$item_id.'" '.hover.'><t>'.$item_name.'</t></a>';
				else 
					$stats = $item_name;
				$searchitem = strtolower($item_name);
				$output .= '<tr class="item">';
				$output .= '<td id="id-page" class="id">'.$item_id.'</td>';
				if($item_id == 383){
					$output .= '<td id="id-page" class="content_line" id="icon" style="width:80px; height:25px;"><a href="http://www.minecraftwiki.net/wiki/'.$item_name.'" target="_blank" '.hover.' ><img src="images/icons/'.$item_id.'.gif" width="24px" height="24px" border="0" /></a></td>';
					$output .= '<td id="id-page" class="name" title="'.$item_name.'">'.$stats.'</td>';
					$output .= "</tr>";
				} else {
					$output .= '<td id="id-page" class="icon"><a href="http://www.minecraftwiki.net/wiki/'.$item_name.'" target="_blank" '.hover.' ><img src="images/icons/'.$item_id.'.png" width="24px" height="24px" border="0" /></a></td>';
					$output .= '<td id="id-page" class="name" title="'.$item_name.'">'.$stats.'</td>';
					$output .= "</tr>";
				}
			}
		}		
	}
	return $output;
}
?>