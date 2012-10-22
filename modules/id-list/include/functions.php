<?php

function id_index_table(){
	global $stats_control;
	for ($i=0; $i <= 2300; $i++){
   		if($i == 6 or $i == 17 or $i == 18 or $i == 31 or $i == 35 or $i == 43 or $i == 44 or $i == 97 or $i == 98 or $i == 263 or $i == 351){
			for ($x=0; $x <= 15; $x++){
				if($x == 0) 
					$z = '';
				else 
					$z = ':'.$x.'';
				$item_name = translate(''.$i.''.$z.'');
				$item_id = $i;
				if($item_name != $item_id){						
					if($stats_control == true){ 	
						$z = str_replace(":", "-", $z);
						$stats = '<a href="index.php?mode=material-stats&material='.$item_id.''.$z.'" '.hover.' ><t>'.$item_name.'</t></a>'; 
					} 
					else 
						$stats = $item_name; 
				$searchitem = strtolower($item_name);
					$output .= '<tr class="item">';
				$z = str_replace("-", ":", $z); 
					$output .= '<td align="left" class="id">'.$item_id.''.$z.'</td>';
				$z = str_replace(":", "-", $z);
					$output .= '<td align="center" class="icon"><a href="http://www.minecraftwiki.net/wiki/'.$item_name.'" target="_blank" '.hover.' ><img src="images/icons/'.$item_id.''.$z.'.png" width="24px" height="24px" border="0" /></a></td>';
    				$output .= '<td align="left" class="name" title="'.$item_name.'">'.$stats.'</td>';
					$output .= "</tr>";
				}
			}
		}
		else{
			$item_name = translate($i);
			$item_id = $i;
			if($item_name != $item_id)
			{
				if($stats_control == true)
					$stats = '<a href="index.php?mode=material-stats&material='.$item_id.'" '.hover.'><t>'.$item_name.'</t></a>';
				else 
					$stats = $item_name;
				$searchitem = strtolower($item_name);
				$output .= '<tr class="item">';
				$output .= '<td id="id-page" align="left" class="id">'.$item_id.'</td>';
				if($item_id == 383 or item_id == 373)
					$output .= '<td id="id-page" align="center" class="content_line" id="icon" style="width:80px; height:25px;"><a href="http://www.minecraftwiki.net/wiki/'.$item_name.'" target="_blank" '.hover.' ><img src="images/icons/'.$item_id.'.gif" width="24px" height="24px" border="0" /></a></td>';
				else{
					$output .= '<td id="id-page" align="center" class="icon"><a href="http://www.minecraftwiki.net/wiki/'.$item_name.'" target="_blank" '.hover.' ><img src="images/icons/'.$item_id.'.png" width="24px" height="24px" border="0" /></a></td>';
					$output .= '<td id="id-page" align="left" class="name" title="'.$item_name.'">'.$stats.'</td>';
					$output .= "</tr>";
				}
			}
		}		
	}
	return $output;
}
?>