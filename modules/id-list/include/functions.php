<?php

function id_index_table(){
	global $stats_control;
	for ($i=0; $i <= 2300; $i++){
   		if($i == 6 or $i == 17 or $i == 18 or $i == 31 or $i == 35 or $i == 43 or $i == 44 or $i == 97 or $i == 98 or $i == 263 or $i == 351 or $i == 373){
			for ($x=0; $x <= 8300; $x++){
				
				if($x == 0 and $x != 373){
					$z = '';
					$item_name = translate($i.$z);
					$item_id = $i;
					$item_img = $i.$z;
				}
				else if(($x == 0 and $i== 373) or $x == 16 or $x == 32 or $x == 64 or $x == 8192){  
					$z = '';
					$item_id = $i;
					$item_img = $i.$z;
					$z = ':'.$x;
					$item_name = translate($i.$z);
				}
				else if($x == 8195 or $x == 8227 or $x == 8259){  // Potion of Fire Resistance
					$z = '-2';
					$item_id = $i;
					$item_img = $i.$z;
					$z = ':'.$x;
					$item_name = translate($i.$z);
				}
				else if($x == 8193 or $x == 8255 or $x == 8257){  // Potion of Regeneration
					$z = '-5';
					$item_id = $i;
					$item_img = $i.$z;
					$z = ':'.$x;
					$item_name = translate($i.$z);
				}
				else if($x == 8229 or $x == 8261 or $x == 8197){  // Potion of Healing
					$z = '-7';
					$item_id = $i;
					$item_img = $i.$z;
					$z = ':'.$x;
					$item_name = translate($i.$z);
				}
				else if($x == 8194 or $x == 8226 or $x == 8258){  // Potion of Swiftness
					$z = '-11';
					$item_id = $i;
					$item_img = $i.$z;
					$z = ':'.$x;
					$item_name = translate($i.$z);
				}
				else{
					$z = ':'.$x;
					$item_name = translate($i.$z);
					$item_id = $i;
					$z = '-'.$x;
					$item_img = $i.$z;
				}
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
					$output .= '<td align="center" class="icon"><a href="http://www.minecraftwiki.net/wiki/'.$item_name.'" target="_blank" '.hover.' ><img src="images/icons/'.$item_img.'.png" width="24px" height="24px" border="0" /></a></td>';
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
				if($item_id == 383){
					$output .= '<td id="id-page" align="center" class="content_line" id="icon" style="width:80px; height:25px;"><a href="http://www.minecraftwiki.net/wiki/'.$item_name.'" target="_blank" '.hover.' ><img src="images/icons/'.$item_id.'.gif" width="24px" height="24px" border="0" /></a></td>';
					$output .= '<td id="id-page" align="left" class="name" title="'.$item_name.'">'.$stats.'</td>';
					$output .= "</tr>";
				}
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