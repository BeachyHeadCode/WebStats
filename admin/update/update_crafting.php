<?php
//*************************************************
//********* Start	recipe	declaration ***********
//*************************************************

//http://minecraft.gamepedia.com/Crafting/Building_blocks		11/23/15
//http://minecraft.gamepedia.com/Crafting/Decoration_blocks		11/24/15
//http://minecraft.gamepedia.com/Crafting/Redstone				12/1/15
//http://minecraft.gamepedia.com/Crafting/Transportation		11/24/15
//http://minecraft.gamepedia.com/Crafting/Foodstuffs			11/23/15
//http://minecraft.gamepedia.com/Crafting/Tools					11/23/15
//http://minecraft.gamepedia.com/Crafting/Combat				11/24/15
//http://minecraft.gamepedia.com/Crafting/Brewing				11/23/15
//http://minecraft.gamepedia.com/Crafting/Materials				11/24/15
//http://minecraft.gamepedia.com/Crafting/Miscellaneous			11/24/15
//
//format id of item:
//output| NumberOfOutput | RecipeType | multi-input,changing item |topleft, topmiddle, topright | left, middle, right | bottomleft, bottom, bottomright
//RecipeType 0=Normal, 1=Shapeless, 2=Fixed

//*************************************************
//$array=input array, $name=name of array

function xmlcreate($array, $name, $xmlDoc, $xmlRoot) {
	$q=0;
	//xml attribute name creator
	if($name=='building_blocks'){
		$name='BB';
	}elseif($name=='decoration_blocks'){
		$name='DB';
	}elseif($name=='redstone'){
		$name='R';
	}elseif($name=='transportation'){
		$name='TR';
	}elseif($name=='foodstuffs'){
		$name='F';
	}elseif($name=='tools'){
		$name='T';
	}elseif($name=='combat'){
		$name='C';
	}elseif($name=='brewing'){
		$name='B';
	}elseif($name=='materials'){
		$name='MA';
	}elseif($name=='miscellaneous'){
		$name='MS';
	}else{
		$name='';
	}
	
// output| NumberOfOutput | RecipeType | multi-input,changing item*optional,reversed*optional |topleft, topmiddle, topright | left, middle, right | bottomleft, bottom, bottomright
// default = 0, multi-input with multi-output = 1, multi-input with static output = 2, multi-input inverse with multi-output = 3
for($i=0; $i <= count($array)-1; $i++) {
	$parser_step_1 = explode("|", $array[$i]);

	$parser_step_2_line_1 = $parser_step_1[0];
	$parser_step_2_line_2 = $parser_step_1[1];
	$parser_step_2_line_3 = $parser_step_1[2];
	$parser_step_2_line_4 = explode(",", $parser_step_1[3]);
	$parser_step_2_line_5 = explode(",", $parser_step_1[4]);
	$parser_step_2_line_6 = explode(",", $parser_step_1[5]);
	$parser_step_2_line_7 = explode(",", $parser_step_1[6]);
	if ($parser_step_2_line_4[0] == '0') {//Default
		$total++;
		echo $parser_step_2_line_1."<br />";

		$xmlItem = $xmlDoc->createElement("rec");
		$xmlItem = $xmlRoot->appendChild($xmlItem);
		$xmlItem->setAttribute($name, $q++);
		$xmlItem->appendChild($xmlDoc->createElement('o', $parser_step_2_line_1));
		$xmlItem->appendChild($xmlDoc->createElement('noo', $parser_step_2_line_2));
		$xmlItem->appendChild($xmlDoc->createElement('rt', $parser_step_2_line_3));
		$xmlItem->appendChild($xmlDoc->createElement('tl', $parser_step_2_line_5[0]));
		$xmlItem->appendChild($xmlDoc->createElement('tm', $parser_step_2_line_5[1]));
		$xmlItem->appendChild($xmlDoc->createElement('tr', $parser_step_2_line_5[2]));
		$xmlItem->appendChild($xmlDoc->createElement('l', $parser_step_2_line_6[0]));
		$xmlItem->appendChild($xmlDoc->createElement('m', $parser_step_2_line_6[1]));
		$xmlItem->appendChild($xmlDoc->createElement('r', $parser_step_2_line_6[2]));
		$xmlItem->appendChild($xmlDoc->createElement('bl', $parser_step_2_line_7[0]));
		$xmlItem->appendChild($xmlDoc->createElement('b', $parser_step_2_line_7[1]));
		$xmlItem->appendChild($xmlDoc->createElement('br', $parser_step_2_line_7[2]));
		
	} elseif ($parser_step_2_line_4[0] == '1') {//dynamic output with dynamic input
		$total++;
		echo '<hr />';
		echo $parser_step_2_line_1."<br />";
		if($parser_step_2_line_4[1]=='5' || $parser_step_2_line_4[1]=='17') {
			$idsize=5;
		} elseif($parser_step_2_line_4[1]=='35' || $parser_step_2_line_4[1]=='95' || $parser_step_2_line_4[1]=='351') {
			$idsize=15;
		} elseif($parser_step_2_line_4[1]=='98') {
			$idsize=3;
		} else {
			$idsize=2;
		}
		$xmlItem = $xmlDoc->createElement("rec");
		$xmlItem = $xmlRoot->appendChild($xmlItem);
		$xmlItem->setAttribute($name, $q++);
		$xmlItem->appendChild($xmlDoc->createElement('o', $parser_step_2_line_1));
		$xmlItem->appendChild($xmlDoc->createElement('noo', $parser_step_2_line_2));
		$xmlItem->appendChild($xmlDoc->createElement('rt', $parser_step_2_line_3));
		if($parser_step_2_line_4[2] == '1') {//reverse
			$k=$idsize;
			if($parser_step_2_line_5[0]==$parser_step_2_line_4[1])
				$xmlItem->appendChild($xmlDoc->createElement('tl', $parser_step_2_line_5[0].'-'.$k));
			else
				$xmlItem->appendChild($xmlDoc->createElement('tl', $parser_step_2_line_5[0]));
			if($parser_step_2_line_5[1]==$parser_step_2_line_4[1])
				$xmlItem->appendChild($xmlDoc->createElement('tm', $parser_step_2_line_5[1].'-'.$k));
			else
				$xmlItem->appendChild($xmlDoc->createElement('tm', $parser_step_2_line_5[1]));
			if($parser_step_2_line_5[2]==$parser_step_2_line_4[1])
				$xmlItem->appendChild($xmlDoc->createElement('tr', $parser_step_2_line_5[2].'-'.$k));
			else
				$xmlItem->appendChild($xmlDoc->createElement('tr', $parser_step_2_line_5[2]));
			if($parser_step_2_line_6[0]==$parser_step_2_line_4[1])
				$xmlItem->appendChild($xmlDoc->createElement('l', $parser_step_2_line_6[0].'-'.$k));
			else
				$xmlItem->appendChild($xmlDoc->createElement('l', $parser_step_2_line_6[0]));
			if($parser_step_2_line_6[1]==$parser_step_2_line_4[1])
				$xmlItem->appendChild($xmlDoc->createElement('m', $parser_step_2_line_6[1].'-'.$k));
			else
				$xmlItem->appendChild($xmlDoc->createElement('m', $parser_step_2_line_6[1]));
			if($parser_step_2_line_6[2]==$parser_step_2_line_4[1])
				$xmlItem->appendChild($xmlDoc->createElement('r', $parser_step_2_line_6[2].'-'.$k));
			else
				$xmlItem->appendChild($xmlDoc->createElement('r', $parser_step_2_line_6[2]));
			if($parser_step_2_line_7[0]==$parser_step_2_line_4[1])
				$xmlItem->appendChild($xmlDoc->createElement('bl', $parser_step_2_line_7[0].'-'.$k));
			else
				$xmlItem->appendChild($xmlDoc->createElement('bl', $parser_step_2_line_7[0]));
			if($parser_step_2_line_7[1]==$parser_step_2_line_4[1])
				$xmlItem->appendChild($xmlDoc->createElement('b', $parser_step_2_line_7[1].'-'.$k));
			else
				$xmlItem->appendChild($xmlDoc->createElement('b', $parser_step_2_line_7[1]));
			if($parser_step_2_line_7[2]==$parser_step_2_line_4[1])
				$xmlItem->appendChild($xmlDoc->createElement('br', $parser_step_2_line_7[2].'-'.$k));
			else
				$xmlItem->appendChild($xmlDoc->createElement('br', $parser_step_2_line_7[2]));
		} else {
			$k=0;
			$xmlItem->appendChild($xmlDoc->createElement('tl', $parser_step_2_line_5[0]));
			$xmlItem->appendChild($xmlDoc->createElement('tm', $parser_step_2_line_5[1]));
			$xmlItem->appendChild($xmlDoc->createElement('tr', $parser_step_2_line_5[2]));
			$xmlItem->appendChild($xmlDoc->createElement('l', $parser_step_2_line_6[0]));
			$xmlItem->appendChild($xmlDoc->createElement('m', $parser_step_2_line_6[1]));
			$xmlItem->appendChild($xmlDoc->createElement('r', $parser_step_2_line_6[2]));
			$xmlItem->appendChild($xmlDoc->createElement('bl', $parser_step_2_line_7[0]));
			$xmlItem->appendChild($xmlDoc->createElement('b', $parser_step_2_line_7[1]));
			$xmlItem->appendChild($xmlDoc->createElement('br', $parser_step_2_line_7[2]));
		}
		for($j=1; $j <= $idsize; $j++) {
			$total++;
			if($parser_step_2_line_4[2] == '1')
				$k--;
			else
				$k++;
			echo $parser_step_2_line_1."-".$j."<br />";
			$xmlItem = $xmlDoc->createElement("rec");
			$xmlItem = $xmlRoot->appendChild($xmlItem);
			$xmlItem->setAttribute($name, $q++);
			$xmlItem->appendChild($xmlDoc->createElement('o', $parser_step_2_line_1.'-'.$j));
			$xmlItem->appendChild($xmlDoc->createElement('noo', $parser_step_2_line_2));
			$xmlItem->appendChild($xmlDoc->createElement('rt', $parser_step_2_line_3));
			if($parser_step_2_line_5[0]==$parser_step_2_line_4[1] and $k!=0)
				$xmlItem->appendChild($xmlDoc->createElement('tl', $parser_step_2_line_5[0].'-'.$k));
			else
				$xmlItem->appendChild($xmlDoc->createElement('tl', $parser_step_2_line_5[0]));
			if($parser_step_2_line_5[1]==$parser_step_2_line_4[1] and $k!=0)
				$xmlItem->appendChild($xmlDoc->createElement('tm', $parser_step_2_line_5[1].'-'.$k));
			else
				$xmlItem->appendChild($xmlDoc->createElement('tm', $parser_step_2_line_5[1]));
			if($parser_step_2_line_5[2]==$parser_step_2_line_4[1] and $k!=0)
				$xmlItem->appendChild($xmlDoc->createElement('tr', $parser_step_2_line_5[2].'-'.$k));
			else
				$xmlItem->appendChild($xmlDoc->createElement('tr', $parser_step_2_line_5[2]));
			if($parser_step_2_line_6[0]==$parser_step_2_line_4[1] and $k!=0)
				$xmlItem->appendChild($xmlDoc->createElement('l', $parser_step_2_line_6[0].'-'.$k));
			else
				$xmlItem->appendChild($xmlDoc->createElement('l', $parser_step_2_line_6[0]));
			if($parser_step_2_line_6[1]==$parser_step_2_line_4[1] and $k!=0)
				$xmlItem->appendChild($xmlDoc->createElement('m', $parser_step_2_line_6[1].'-'.$k));
			else
				$xmlItem->appendChild($xmlDoc->createElement('m', $parser_step_2_line_6[1]));
			if($parser_step_2_line_6[2]==$parser_step_2_line_4[1] and $k!=0)
				$xmlItem->appendChild($xmlDoc->createElement('r', $parser_step_2_line_6[2].'-'.$k));
			else
				$xmlItem->appendChild($xmlDoc->createElement('r', $parser_step_2_line_6[2]));
			if($parser_step_2_line_7[0]==$parser_step_2_line_4[1] and $k!=0)
				$xmlItem->appendChild($xmlDoc->createElement('bl', $parser_step_2_line_7[0].'-'.$k));
			else
				$xmlItem->appendChild($xmlDoc->createElement('bl', $parser_step_2_line_7[0]));
			if($parser_step_2_line_7[1]==$parser_step_2_line_4[1] and $k!=0)
				$xmlItem->appendChild($xmlDoc->createElement('b', $parser_step_2_line_7[1].'-'.$k));
			else
				$xmlItem->appendChild($xmlDoc->createElement('b', $parser_step_2_line_7[1]));
			if($parser_step_2_line_7[2]==$parser_step_2_line_4[1] and $k!=0)
				$xmlItem->appendChild($xmlDoc->createElement('br', $parser_step_2_line_7[2].'-'.$k));
			else
				$xmlItem->appendChild($xmlDoc->createElement('br', $parser_step_2_line_7[2]));
		}
		echo '<hr />';
	} elseif ($parser_step_2_line_4[0] == '2') {//Static output with dynamic input
		$total++;
		echo '<hr />';
		echo $parser_step_2_line_1."<br />";
		$xmlItem = $xmlDoc->createElement("rec");
		$xmlItem = $xmlRoot->appendChild($xmlItem);
		$xmlItem->setAttribute($name, $q++);
		$xmlItem->appendChild($xmlDoc->createElement('o', $parser_step_2_line_1));
		$xmlItem->appendChild($xmlDoc->createElement('noo', $parser_step_2_line_2));
		$xmlItem->appendChild($xmlDoc->createElement('rt', $parser_step_2_line_3));
		$xmlItem->appendChild($xmlDoc->createElement('tl', $parser_step_2_line_5[0]));
		$xmlItem->appendChild($xmlDoc->createElement('tm', $parser_step_2_line_5[1]));
		$xmlItem->appendChild($xmlDoc->createElement('tr', $parser_step_2_line_5[2]));
		$xmlItem->appendChild($xmlDoc->createElement('l', $parser_step_2_line_6[0]));
		$xmlItem->appendChild($xmlDoc->createElement('m', $parser_step_2_line_6[1]));
		$xmlItem->appendChild($xmlDoc->createElement('r', $parser_step_2_line_6[2]));
		$xmlItem->appendChild($xmlDoc->createElement('bl', $parser_step_2_line_7[0]));
		$xmlItem->appendChild($xmlDoc->createElement('b', $parser_step_2_line_7[1]));
		$xmlItem->appendChild($xmlDoc->createElement('br', $parser_step_2_line_7[2]));

		if($parser_step_2_line_4[1]=='35') {
			$idsize=15;
		} elseif($parser_step_2_line_4[1]=='5') {
			$idsize=5;
		} elseif($parser_step_2_line_4[1]=='98') {
			$idsize=3;
		} else {
			$idsize=2;
		}
		for($j=1; $j <= $idsize; $j++) {
			$total++;
			echo $parser_step_2_line_1."<br />";
			
			$xmlItem = $xmlDoc->createElement("rec");
			$xmlItem = $xmlRoot->appendChild($xmlItem);
			$xmlItem->setAttribute($name, $q++);
			$xmlItem->appendChild($xmlDoc->createElement('o', $parser_step_2_line_1));
			$xmlItem->appendChild($xmlDoc->createElement('noo', $parser_step_2_line_2));
			$xmlItem->appendChild($xmlDoc->createElement('rt', $parser_step_2_line_3));
			if($parser_step_2_line_5[0]==$parser_step_2_line_4[1])
				$xmlItem->appendChild($xmlDoc->createElement('tl', $parser_step_2_line_5[0].'-'.$j));
			else
				$xmlItem->appendChild($xmlDoc->createElement('tl', $parser_step_2_line_5[0]));
			if($parser_step_2_line_5[1]==$parser_step_2_line_4[1])
				$xmlItem->appendChild($xmlDoc->createElement('tm', $parser_step_2_line_5[1].'-'.$j));
			else
				$xmlItem->appendChild($xmlDoc->createElement('tm', $parser_step_2_line_5[1]));
			if($parser_step_2_line_5[2]==$parser_step_2_line_4[1])
				$xmlItem->appendChild($xmlDoc->createElement('tr', $parser_step_2_line_5[2].'-'.$j));
			else
				$xmlItem->appendChild($xmlDoc->createElement('tr', $parser_step_2_line_5[2]));
			if($parser_step_2_line_6[0]==$parser_step_2_line_4[1])
				$xmlItem->appendChild($xmlDoc->createElement('l', $parser_step_2_line_6[0].'-'.$j));
			else
				$xmlItem->appendChild($xmlDoc->createElement('l', $parser_step_2_line_6[0]));
			if($parser_step_2_line_6[1]==$parser_step_2_line_4[1])
				$xmlItem->appendChild($xmlDoc->createElement('m', $parser_step_2_line_6[1].'-'.$j));
			else
				$xmlItem->appendChild($xmlDoc->createElement('m', $parser_step_2_line_6[1]));
			if($parser_step_2_line_6[2]==$parser_step_2_line_4[1])
				$xmlItem->appendChild($xmlDoc->createElement('r', $parser_step_2_line_6[2].'-'.$j));
			else
				$xmlItem->appendChild($xmlDoc->createElement('r', $parser_step_2_line_6[2]));
			if($parser_step_2_line_7[0]==$parser_step_2_line_4[1])
				$xmlItem->appendChild($xmlDoc->createElement('bl', $parser_step_2_line_7[0].'-'.$j));
			else
				$xmlItem->appendChild($xmlDoc->createElement('bl', $parser_step_2_line_7[0]));
			if($parser_step_2_line_7[1]==$parser_step_2_line_4[1])
				$xmlItem->appendChild($xmlDoc->createElement('b', $parser_step_2_line_7[1].'-'.$j));
			else
				$xmlItem->appendChild($xmlDoc->createElement('b', $parser_step_2_line_7[1]));
			if($parser_step_2_line_7[2]==$parser_step_2_line_4[1])
				$xmlItem->appendChild($xmlDoc->createElement('br', $parser_step_2_line_7[2].'-'.$j));
			else
				$xmlItem->appendChild($xmlDoc->createElement('br', $parser_step_2_line_7[2]));
		}
		echo '<hr />';
	} elseif ($parser_step_2_line_4[0] == '3') {
		$total++;
		echo $parser_step_2_line_1."<br />";
		$xmlItem = $xmlDoc->createElement("rec");
		$xmlItem = $xmlRoot->appendChild($xmlItem);
		$xmlItem->setAttribute($name, $q++);
		$xmlItem->appendChild($xmlDoc->createElement('o', $parser_step_2_line_1));
		$xmlItem->appendChild($xmlDoc->createElement('noo', $parser_step_2_line_2));
		$xmlItem->appendChild($xmlDoc->createElement('rt', $parser_step_2_line_3));
		$xmlItem->appendChild($xmlDoc->createElement('tl', $parser_step_2_line_5[0]));
		$xmlItem->appendChild($xmlDoc->createElement('tm', $parser_step_2_line_5[1]));
		$xmlItem->appendChild($xmlDoc->createElement('tr', $parser_step_2_line_5[2]));
		$xmlItem->appendChild($xmlDoc->createElement('l', $parser_step_2_line_6[0]));
		$xmlItem->appendChild($xmlDoc->createElement('m', $parser_step_2_line_6[1]));
		$xmlItem->appendChild($xmlDoc->createElement('r', $parser_step_2_line_6[2]));
		$xmlItem->appendChild($xmlDoc->createElement('bl', $parser_step_2_line_7[0]));
		$xmlItem->appendChild($xmlDoc->createElement('b', $parser_step_2_line_7[1]));
		$xmlItem->appendChild($xmlDoc->createElement('br', $parser_step_2_line_7[2]));
		
		if($parser_step_2_line_4[1]=='35') {
			$idsize1=15;
		} elseif($parser_step_2_line_4[1]=='5') {
			$idsize1=5;
		} else {
			$idsize1=2;
		}
		if($parser_step_2_line_4[2]=='35') {
			$idsize2=15;
		} elseif($parser_step_2_line_4[2]=='5') {
			$idsize2=5;
		} else {
			$idsize2=2;
		}
		//bed
		for($j=1; $j <= $idsize1; $j++) {
			for($k=1; $k <= $idsize2; $k++) {
				$total++;
				echo $parser_step_2_line_1."<br />";
				$xmlItem = $xmlDoc->createElement("rec");
				$xmlItem = $xmlRoot->appendChild($xmlItem);
				$xmlItem->setAttribute($name, $q++);
				$xmlItem->appendChild($xmlDoc->createElement('o', $parser_step_2_line_1));
				$xmlItem->appendChild($xmlDoc->createElement('noo', $parser_step_2_line_2));
				$xmlItem->appendChild($xmlDoc->createElement('rt', $parser_step_2_line_3));
				$xmlItem->appendChild($xmlDoc->createElement('tl', $parser_step_2_line_5[0]));
				$xmlItem->appendChild($xmlDoc->createElement('tm', $parser_step_2_line_5[1]));
				$xmlItem->appendChild($xmlDoc->createElement('tr', $parser_step_2_line_5[2]));
				if($parser_step_2_line_6[0]==$parser_step_2_line_4[2])
					$xmlItem->appendChild($xmlDoc->createElement('l', $parser_step_2_line_6[0].'-'.$k));
				else
					$xmlItem->appendChild($xmlDoc->createElement('l', $parser_step_2_line_6[0]));
				if($parser_step_2_line_6[1]==$parser_step_2_line_4[2])
					$xmlItem->appendChild($xmlDoc->createElement('m', $parser_step_2_line_6[1].'-'.$k));
				else
					$xmlItem->appendChild($xmlDoc->createElement('m', $parser_step_2_line_6[1]));
				if($parser_step_2_line_6[2]==$parser_step_2_line_4[2])
					$xmlItem->appendChild($xmlDoc->createElement('r', $parser_step_2_line_6[2].'-'.$k));
				else
					$xmlItem->appendChild($xmlDoc->createElement('r', $parser_step_2_line_6[2]));
				if($parser_step_2_line_7[0]==$parser_step_2_line_4[1])
					$xmlItem->appendChild($xmlDoc->createElement('bl', $parser_step_2_line_7[0].'-'.$j));
				else
					$xmlItem->appendChild($xmlDoc->createElement('bl', $parser_step_2_line_7[0]));
				if($parser_step_2_line_7[1]==$parser_step_2_line_4[1])
					$xmlItem->appendChild($xmlDoc->createElement('b', $parser_step_2_line_7[1].'-'.$j));
				else
					$xmlItem->appendChild($xmlDoc->createElement('b', $parser_step_2_line_7[1]));
				if($parser_step_2_line_7[2]==$parser_step_2_line_4[1])
					$xmlItem->appendChild($xmlDoc->createElement('br', $parser_step_2_line_7[2].'-'.$j));
				else
					$xmlItem->appendChild($xmlDoc->createElement('br', $parser_step_2_line_7[2]));
			}
		}
	} else {
		echo 'Fail: (multi-input,changing item) not set<br />';
	}
}
return $total;
}
$total=0;
//multi-input=false
$building_blocks =	array(
	'1-5|2|1|0,|,,|1-3,4,|,,',							//Andesite
	'1-6|4|0|0,|,,|1-5,1-5,|1-5,1-5,',					//Polished Andesite
	'173|1|0|0,|263,263,263|263,263,263|263,263,263',	//Block of Coal
	'57|1|0|0,|264,264,264|264,264,264|264,264,264',	//Block of Diamond
	'41|1|0|0,|266,266,266|266,266,266|266,266,266',	//Block of Gold
	'42|1|0|0,|265,265,265|265,265,265|265,265,265',	//Block of Iron
	'47|1|0|2,5|5,5,5|340,340,340|5,5,5',				//Bookshelf
	'45|1|0|0,|,,|336,336,|336,336,',					//Bricks
	'82|1|0|0,|,,|337,337,|337,337,',					//Clay block
	'139|6|0|0,|,,|4,4,4|4,4,4',						//Cobblestone Wall
	'139-1|6|0|0,|,,|48,48,48|48,48,48',				//Mossy Cobblestone Wall
	'1-3|2|0|0,|,,|4,406,|406,4,',						//Diorite
	'1-4|4|0|0,|,,|1-3,1-3,|1-3,1-3,',					//Polished Diorite
	'91|1|0|0,|,,|,86,|,50,',							//Jack o'Lantern
	'22|1|0|0,|351-4,351-4,351-4|351-4,351-4,351-4|351-4,351-4,351-4', //Lapis Lazuli Block
	'48|1|1|0,|,,|4,106,|,,',							//Moss Stone
	'24|1|0|0,|,,|12,12,|12,12,',						//Sandstone
	'24-2|4|0|0,|,,|24,24,|24,24,',						//Smooth Sandstone
	'24-1|1|0|0,|,,|,44-1,|,44-1,',						//Chiseled Sandstone
	'44|6|0|0,|,,|1,1,1|,,',							//Stone Slab
	'44-1|6|0|2,24|,,|24,24,24|,,',						//Sandstone Slab
	'44-2|6|0|0,|,,|5,5,5|,,',							//Wooden Slab
	'44-3|6|0|0,|,,|4,4,4|,,',							//Cobblestone Slab
	'44-4|6|0|0,|,,|45,45,45|,,',						//Bricks Slab
	'44-5|6|0|2,98|,,|98,98,98|,,',						//Stone Bricks Slab
	'126|6|0|1,5|,,|5,5,5|,,',							//Any Wood Slab
	'44-6|6|0|0,|,,|112,112,112|,,',					//Nether Brick Slab
	'44-7|6|0|2,155|,,|155,155,155|,,',					//Quartz Slab
	'182|6|0|2,179|,,|179,179,179|,,',					//Red Sandstone Slab
	'95|8|0|1,351,1|20,20,20|20,351,20|20,20,20',		//Any Stained Glass
	//Any Wood Stairs start
	'53|4|0|0,|,,5|,5,5|5,5,5',
	'134|4|0|0,|,,5-1|,5-1,5-1|5-1,5-1,5-1',
	'135|4|0|0,|,,5-2|,5-2,5-2|5-2,5-2,5-2',
	'136|4|0|0,|,,5-3|,5-3,5-3|5-3,5-3,5-3',
	'163|4|0|0,|,,5-4|,5-4,5-4|5-4,5-4,5-4',
	'164|4|0|0,|,,5-5|,5-5,5-5|5-5,5-5,5-5',
	//Any Wood Stairs end
	'67|4|0|0,|,,4|,4,4|4,4,4',								//Cobblestone Stairs
	'108|4|0|0,|,,45|,45,45|45,45,45',						//Brick Stairs
	'109|4|0|2,98|,,98|,98,98|98,98,98',					//Stone Brick Stairs
	'114|4|0|0,|,,112|,112,112|112,112,112',				//Nether Brick Stairs
	'128|4|0|2,24|,,24|,24,24|24,24,24',					//Sandstone Stairs
	'156|4|0|2,155|,,155|,155,155|155,155,155',				//Quartz Stairs
	'180|4|0|2,179|,,179|,179,179|179,179,179',				//Red Sandstone Stairs
	'98|4|0|0,|,,|1,1,|1,1,',								//Stone Bricks
	'98-1|1|1|0,|,,|98,106,|,,',							//Mossy Stone Bricks
	'98-3|1|0|0,|,,|,44-5,|,44-5,',							//Chiseled Stone Bricks
	'159|8|0|1,351,1|172,172,172|172,351,172|172,172,172',	//Any Stained Clay
	'133|1|0|0,|388,388,388|388,388,388|388,388,388',		//Block of Emerald
	'179|1|0|0,|,,|12-1,12-1,|12-1,12-1,',					//Red Sandstone
	'179-2|4|0|0,|,,|179,179,|179,179,',					//Smooth Red Sandstone
	'179-1|1|0|0,|,,|,182,|,182,',							//Chiseled Red Sandstone
	'80|1|0|0,|,,|332,332,|332,332,',						//Snow
	'155|1|0|0,|,,|406,406,|406,406,',						//Block of Quartz
	'155-1|1|0|0,|,,|,44-7,|,44-7,',						//Chiseled Quartz Block
	'155-2|2|0|0,|,,|,155,|,155,',							//Pillar Quartz Block
	'89|1|0|0,|,,|348,348,|348,348,',						//Glowstone
	'1-1|1|1|0,|,,|1-3,406,|,,',							//Granite
	'1-2|4|0|0,|,,|1-1,1-1,|1-1,1-1,',						//Polished Granite
	'170|1|0|0,|296,296,296|296,296,296|296,296,296',		//Hay Bale
	'169|1|0|0,|409,410,409|410,410,410|409,410,409',		//Sea Lantern
	'5|4|0|1,17|,,|,17,|,,',								//Any Wood Planks
	'112|1|0|0,|,,|405,405,|405,405,',						//Nether Brick
	'103|1|0|0,|360,360,360|360,360,360|360,360,360',		//Melon (block)
	'168|1|0|0,|,,|409,409,|409,409,',						//Prismarine
	'168-1|1|0|0,|409,409,409|409,409,409|409,409,409',		//Prismarine Bricks
	'168-2|1|0|0,|409,409,409|409,351,409|409,409,409',		//Dark Prismarine
	'3-1|4|0|0,|,,|3,13,|13,3,',							//Coarse Dirt
	'35|1|0|0,|,,|287,287,|287,287,',						//White Wool
	//Any Dyed Wool start
	'35-1|1|1|0,|,,|35,351-14,|,,',
	'35-2|1|1|0,|,,|35,351-13,|,,',
	'35-3|1|1|0,|,,|35,351-12,|,,',
	'35-4|1|1|0,|,,|35,351-11,|,,',
	'35-5|1|1|0,|,,|35,351-10,|,,',
	'35-6|1|1|0,|,,|35,351-9,|,,',
	'35-7|1|1|0,|,,|35,351-8,|,,',
	'35-8|1|1|0,|,,|35,351-7,|,,',
	'35-9|1|1|0,|,,|35,351-6,|,,',
	'35-10|1|1|0,|,,|35,351-5,|,,',
	'35-11|1|1|0,|,,|35,351-4,|,,',
	'35-12|1|1|0,|,,|35,351-3,|,,',
	'35-13|1|1|0,|,,|35,351-2,|,,',
	'35-14|1|1|0,|,,|35,351-1,|,,',
	'35-15|1|1|0,|,,|35,351,|,,'
);

// output| NumberOfOutput | RecipeType | multi-input |topleft, topmiddle, topright | left, middle, right | bottomleft, bottom, bottomright
// defalut = 0 multi-input with multi-output = 1, multi-input with static output = 2, 2multi input 1 static = 3
$decoration_blocks =	array(
	'50|4|0|0,|,,|,263,|,280,',							//Torch
	'50|4|0|0,|,,|,263-1,|,280,',						//Torch
	'61|1|0|0,|4,4,4|4,,4|4,4,4',						//Furnace
	'65|3|0|0,|280,,280|280,280,280|,280,',				//Ladder
	'85|3|0|0,|,,|5,280,5|5,280,5',						//oak Fence
	'188|3|0|0,|,,|5-1,280,5-1|5-1,280,5-1',			//spruce fence
	'189|3|0|0,|,,|5-2,280,5-2|5-2,280,5-2',			//birch fence
	'190|3|0|0,|,,|5-3,280,5-3|5-3,280,5-3',			//jungle fence
	'191|3|0|0,|,,|5-4,280,5-4|5-4,280,5-4',			//dark oak fence
	'192|3|0|0,|,,|5-5,280,5-5|5-5,280,5-5',			//acacia fence
	'113|6|0|0,|,,|112,112,112|112,112,112',			//Nether Brick Fence
	'102|16|0|0,|,,|20,20,20|20,20,20',					//Glass Pane
	'146|1|0|0,|,,|131,54,|,,',							//Trapped Chest
	'171|3|0|1,35|,,|,,|35,35,',						//Any Carpet
	'321|1|0|2,35|280,280,280|280,35,280|280,280,280',	//Painting
	'323|3|0|2,5|5,5,5|5,5,5|,280,',					//Sign
	'355|1|0|3,5,35|,,|35,35,35|5,5,5',					//Bed
	'390|1|0|0,|,,|336,,336|,336,',						//Flower Pot
	'425|1|0|1,35,1|35,35,35|35,35,35|,280,',			//Any Banner
	'425|1|1|2,425|,,|425,425,|,,',						//Any Banner
	'78|6|0|0,|,,|80,80,80|,,',							//Snow (layer)
	'101|16|0|0,|,,|265,265,265|265,265,265',			//Iron Bars
	'130|1|0|0,|49,49,49|49,381,49|49,49,49',			//Ender Chest
	'84|1|0|2,5|5,5,5|5,264,5|5,5,5',					//Jukebox
	'165|1|0|0,|341,341,341|341,341,341|341,341,341',	//Slime Block
	'116|1|0|0,|,340,|264,49,264|49,49,49',				//Enchantment Table
	'58|1|0|2,5|,,|5,5,|5,5,',							//Crafting Table
	'389|1|0|0,|280,280,280|280,334,280|280,280,280',	//Item Frame
	'416|1|0|0,|280,280,280|,280,|280,44,280',			//Armor Stand
	'160|16|0|1,95|,,|95,95,95|95,95,95',				//Any Stained Glass Pane
	'145|1|0|0,|42,42,42|,265,|265,265,265',			//Anvil
	'54|1|0|2,5|5,5,5|5,,5|5,5,5'						//Chest
);

//multi-input=false
$redstone =	array(
	//Door Start
	'64|3|0|0,|5,5,|5,5,|5,5,',							//Oak
	'193|3|0|0,|5-1,5-1,|5-1,5-1,|5-1,5-1,',			//Spruce
	'194|3|0|0,|5-2,5-2,|5-2,5-2,|5-2,5-2,',			//Birch
	'195|3|0|0,|5-3,5-3,|5-3,5-3,|5-3,5-3,',			//Jungle
	'196|3|0|0,|5-4,5-4,|5-4,5-4,|5-4,5-4,',			//Acacia
	'197|3|0|0,|5-5,5-5,|5-5,5-5,|5-5,5-5,',			//Dark Oak
	'71|3|0|0,|265,265,|265,265,|265,265,',				//Iron
	//Door End
	'154|1|0|0,|265,,265|265,54,265|,265,', 			//Hopper
	'331|9|0|0,|,,|,152,|,,', 							//Redstone
	//Trapdoor Start
	'96|2|0|2,5|,,|5,5,5|5,5,5',						//Oak
	'167|1|0|0,|,,|265,265,|265,265,',					//Iron
	//Trapdoor End
	'46|1|0|2,12|289,12,289|12,289,12|289,12,289',		//TNT Sand
	'151|1|0|2,43|20,20,20|406,406,406|43,43,43',		//Daylight Sensor
	'356|1|0|0,|,,|76,331,76|1,1,1',					//Redstone Repeater
	'148|1|0|0,|,,|265,265,|,,',						//Weighted Pressure Plate (Heavy)
	'147|1|0|0,|,,|266,266,|,,',						//Weighted Pressure Plate (Light)
	'158|1|0|0,|4,4,4|4,,4|4,331,4',					//Dropper
	'404|1|0|0,|,76,|76,406,76|1,1,1',					//Redstone Comparator
	'33|1|0|2,5|5,5,5|4,265,4|4,331,4',					//Piston
	'29|1|0|0,|,,|,341,|,33,',							//Sticky Piston
	'23|1|0|0,|4,4,4|4,261,4|4,331,4',					//Dispenser
	'123|1|0|0,|,331,|331,89,331|,331,',				//Redstone Lamp
	//Fence Gate Start
	'107|1|0|0,|,,|280,5,280|280,5,280',				//Oak
	'183|1|0|0,|,,|280,5-1,280|280,5-1,280',			//Spruce
	'184|1|0|0,|,,|280,5-2,280|280,5-2,280',			//Birch
	'185|1|0|0,|,,|280,5-3,280|280,5-3,280',			//Jungle
	'186|1|0|0,|,,|280,5-5,280|280,5-5,280',			//Dark Oak
	'187|1|0|0,|,,|280,5-4,280|280,5-4,280',			//Acacia
	//Fence Gate End
	'70|1|0|0,|,,|1,1,|,,',								//Stone Pressure Plate
	'72|1|0|2,5|,,|5,5,|,,',							//Wooden Pressure Plate
	'131|2|0|2,5|,265,|,280,|,5,',						//Tripwire Hook
	'152|1|0|0,|331,331,331|331,331,331|331,331,331',	//Block of Redstone
	'25|1|0|2,5|5,5,5|5,331,5|5,5,5',					//Note Block
	'77|1|0|0,|,,|,1,|,,',								//Stone Button
	'143|1|0|2,5|,,|,5,|,,',							//Wooden button
	'76|1|0|0,|,,|,331,|,280,',							//Redstone Torch
	'69|1|0|0,|,,|,280,|,4,'							//Lever
);

$transportation =	array(
	'157|6|0|0,|265,280,265|265,76,265|265,280,265',	//Activator Rail
	'398|1|0|0,|,,|346,,|,391,',						//Carrot on a Stick
	'398|1|1|0,|,,|398,398,|,,',						//Carrot on a Stick
	'328|1|0|0,|,,|265,,265|265,265,265',				//Minecart
	'342|1|0|0,|,,|,54,|,328,',							//Minecart with Chest
	'343|1|0|0,|,,|,61,|,328,',							//Minecart with Furnace
	'407|1|0|0,|,,|,46,|,328,',							//Minecart with TNT
	'66|16|0|0,|265,,265|265,280,265|265,,265',			//Rail
	'408|1|0|0,|,,|,154,|,328,',						//Minecart with Hopper
	'27|6|0|0,|266,,266|266,280,266|266,331,266',		//Powered Rail
	'28|6|0|0,|265,,265|265,,265|265,,265',				//Detector Rail
	'333|1|0|2,5|,,|5,,5|5,5,5'							//Boat
);

//multi-input=false
$foodstuffs =	array(
	'282|1|1|0,|,,|40,39,|,281,',						//Mushroom Stew
	'297|1|0|0,|,,|296,296,296|,,',						//Bread
	'322|1|0|0,|266,266,266|266,260,266|266,266,266',	//Golden Bar Apple
	'322-1|1|0,|0|41,41,41|41,260,41|41,41,41',			//Enchanted Golden Apple
	'357|8|0|0,|,,|296,351-3,296|,,',					//Cookie
	'400|1|0|0,|,,|86,353,|,344,',						//Pumpkin Pie
	'396|1|0|0,|371,371,371|371,391,371|371,371,371',	//Golden Carrot
	'413|1|0|0,|,412,|391,393,39|,281,',				//Rabbit Stew
	'413|1|0|0,|,412,|391,393,40|,281,',				//Rabbit Stew
	'354|1|0|0,|335,335,335|353,344,353|296,296,296',	//Cake
	'322|1|0|0,|371,371,371|371,260,371|371,371,371'	//Golden Nugget Apple
);

//multi-input=false
$tools =	array(
	'347|1|0|0,|,266,|266,331,266|,266,',				//Clock/watch
	'345|1|0|0,|,265,|265,331,265|,265,',				//Compass
	'346|1|0|0,|,,280|,280,287|280,,287',				//Fishing Rod
	'346|1|1|0,|,,|346,346,|,,',						//Fishing Rod
	'259|1|1|0,|,,|265,318,|,,',						//Flint and Steel
	'259|1|1|0,|,,|259,259,|,,',						//Flint and Steel
	//Hoe start start
	'290|1|0|0,|2,5|5,5,|,280,|,280,',					//Any wood plank
	'291|1|0|0,|4,4,|,280,|,280,',						//Cobblestone
	'292|1|0|0,|265,265,|,280,|,280,',					//Iron Ingot 
	'294|1|0|0,|266,266,|,280,|,280,',					//Gold Ingot
	'293|1|0|0,|264,264,|,280,|,280,',					//Diamond
	'290|1|1|0,|,,|290,290,|,,',						//Wooden hoe
	'291|1|1|0,|,,|291,291,|,,',						//stone hoe
	'292|1|1|0,|,,|292,292,|,,',						//iron hoe
	'293|1|1|0,|,,|293,293,|,,',						//diamond hoe
	'294|1|1|0,|,,|294,294,|,,',						//gold hoe
	//Hoe start end
	'420|1|1|0,|287,287,|287,341,|,,287',				//Lead
	//Axe start
	'258|1|0|0,|265,265,|265,280,|,280,',				//iron
	'271|1|0|2,5|5,5,|5,280,|,280,',					//Any wood plank
	//any wood plank end
	'275|1|0|0,|4,4,|4,280,|,280,',						//stone
	'279|1|0|0,|264,264,|264,280,|,280,',				//diamond
	'286|1|0|0,|266,266,|266,280,|,280,',				//gold
	'258|1|1|0,|,,|258,258,|,,',						//iron axe
	'271|1|1|0,|,,|271,271,|,,',						//wood axe
	'275|1|1|0,|,,|275,275,|,,',						//stone axe
	'279|1|1|0,|,,|279,279,|,,',						//diamond axe
	'286|1|1|0,|,,|286,286,|,,',						//gold axe
	//Axe end
	//Pickaxe start
	'257|1|0|0,|265,265,265|,280,|,280,',				//iron
	'270|1|0|2,5|5,5,5|,280,|,280,',					//any wood plank
	//any wood plank end
	'274|1|0|0,|4,4,4|,280,|,280,',						//stone
	'278|1|0|0,|264,264,264|,280,|,280,',				//diamond
	'285|1|0|0,|266,266,266|,280,|,280,',				//gold
	'257|1|1|0,|,,|257,257,|,,',						//iron pickaxe
	'270|1|1|0,|,,|270,270,|,,',						//wood pickaxe
	'274|1|1|0,|,,|274,274,|,,',						//stone pickaxe
	'278|1|1|0,|,,|278,278,|,,',						//diamond pickaxe
	'285|1|1|0,|,,|285,285,|,,',						//gold pickaxe
	//Pickaxe end
	'359|1|0|0,|,,|,265,|265,,',						//Shears
	'359|1|1|0,|,,|359,359,|,,',						//Shears
	//Shovel start
	'256|1|0|0,|,265,|,280,|,280,',						//iron
	'269|1|0|2,5|,5,|,280,|,280,',						//any wood plank
	'273|1|0|0,|,4,|,280,|,280,',						//stone
	'277|1|0|0,|,264,|,280,|,280,',						//diamond
	'284|1|0|0,|,266,|,280,|,280,',						//gold
	'269|1|1|0,|,,|269,269,|,,',						//wood shovel
	'273|1|1|0,|,,|273,273,|,,',						//stone shovel
	'277|1|1|0,|,,|277,277,|,,',						//diamond shovel
	'284|1|1|0,|,,|284,284,|,,',						//gold shovel
	'256|1|1|0,|,,|256,256,|,,'							//iron shovel
	//Shovel end
);

$combat =	array(
	'261|1|0|0,|,280,287|280,,287|,280,287',			//Bow
	'261|1|1|0,|,,|261,261,|,,',						//Bow
	'262|4|0|0,|,318,|,280,|,288,',						//Arrow
	'300|1|0|0,|334,334,334|334,,334|334,,334',			//Leggings leather
	'316|1|0|0,|266,266,266|266,,266|266,,266',			//Leggings gold
	'308|1|0|0,|265,265,265|265,,265|265,,265',			//Leggings iron
	'312|1|0|0,|264,264,264|264,,264|264,,264',			//Leggings diamond
	'300|1|1|0,|,,|300,300,|,,',						//Leather Pants
	'316|1|1|0,|,,|316,316,|,,',						//Golden Leggings
	'304|1|1|0,|,,|304,304,|,,',						//Chain Leggings
	'312|1|1|0,|,,|312,312,|,,',						//Diamond Leggings
	'301|1|0|0,|,,|334,,334|334,,334',					//Boots leather
	'317|1|0|0,|,,|266,,266|266,,266',					//Boots gold
	'309|1|0|0,|,,|265,,265|265,,265',					//Boots iron
	'313|1|0|0,|,,|264,,264|264,,264',					//Boots diamond
	'301|1|1|0,|,,|301,301,|,,',						//Leather Boots
	'317|1|1|0,|,,|317,317,|,,',						//Golden Boots
	'305|1|1|0,|,,|305,305,|,,',						//Chain Boots
	'309|1|1|0,|,,|309,309,|,,',						//Iron Boots
	'313|1|1|0,|,,|313,313,|,,',						//Diamond Boots
	'298|1|0|0,|,,|334,334,334|334,,334',				//Helmet leather
	'314|1|0|0,|,,|266,266,266|266,,266',				//Helmet gold
	'306|1|0|0,|,,|265,265,265|265,,265',				//Helmet iron
	'310|1|0|0,|,,|264,264,264|264,,264',				//Helmet diamond
	'298|1|1|0,|,,|298,298,|,,',						//Leather Cap
	'314|1|1|0,|,,|314,314,|,,',						//Golden Helmet
	'302|1|1|0,|,,|302,302,|,,',						//Chain Helmet
	'306|1|1|0,|,,|306,306,|,,',						//Iron Helmet
	'310|1|1|0,|,,|310,310,|,,',						//Diamond Helmet
	'299|1|0|0,|334,,334|334,334,334|334,334,334',		//Chestplate leather
	'315|1|0|0,|266,,266|266,266,266|266,266,266',		//Chestplate gold
	'307|1|0|0,|265,,265|265,265,265|265,265,265',		//Chestplate iron
	'311|1|0|0,|264,,264|264,264,264|264,264,264',		//Chestplate diamond
	'299|1|1|0,|,,|299,299,|,,',						//Leather Tunic
	'315|1|1|0,|,,|315,315,|,,',						//Golden Chestplate
	'303|1|1|0,|,,|303,303,|,,',						//Chain Chestplate
	'307|1|1|0,|,,|307,307,|,,',						//Iron Chestplate
	'311|1|1|0,|,,|311,311,|,,',						//Diamond Chestplate
	'268|1|0|2,5|,5,|,5,|,280,',						//Sword wood planks
	'272|1|0|0,|,4,|,4,|,280,',							//Sword cobblestone
	'267|1|0|0,|,265,|,265,|,280,',						//Sword iron
	'283|1|0|0,|,266,|,266,|,280,',						//Sword gold
	'276|1|0|0,|,264,|,264,|,280,',						//Sword diamond
	'268|1|1|0,|,,|268,268,|,,',						//Wooden Sword
	'272|1|1|0,|,,|272,272,|,,',						//Stone Sword
	'267|1|1|0,|,,|267,167,|,,',						//Iron Sword
	'283|1|1|0,|,,|283,283,|,,'							//Golden Sword
);

//multi-input=false
$brewing =	array(
	'377|2|0|0,|,,|,369,|,,',							//Blaze Powder
	'376|1|1|0,|,,|39,353,|,375,',						//Fermented Spider Eye
	'374|3|0|0,|,,|20,,20|,20,',						//Glass Bottle
	'378|1|1|0,|,,|377,341,|,,',						//Magma Cream
	'379|1|0|0,|,,|,369,|4,4,4',						//Brewing Stand
	'380|1|0|0,|265,,265|265,,265|265,265,265',			//Cauldron
	'382|1|0|0,|371,371,371|371,360,371|371,371,371'	//Glistering Melon
);

$materials =	array(
	'351-15|3|0|0,|,,|,352,|,,',						//Bone Meal
	'281|4|0|2,5|,,|5,,5|,5,',							//Bowl
	'263|9|0|0,|,,|,173,|,,',							//Coal
	'351-6|2|1|0,|,,|351-4,351-2,|,,',					//Cyan Dye
	'266|9|0|0,|,,|,41,|,,',							//Gold Ingot
	'266|1|0|0,|371,371,371|371,371,371|371,371,371',	//Gold Ingot
	'371|9|0|0,|,,|,266,|,,',							//Gold Nugget
	'351-8|2|1|0,|,,|351,351-15,|,,',					//Gray Dye
	'265|9|0|0,|,,|,42,|,,',							//Iron Ingot
	'351-4|9|0|0,|,,|,22,|,,',							//Lapis Lazuli
	'351-12|1|0|0,|,,|,38-1,|,,',						//Light Blue Dye
	'351-12|2|1|0,|,,|351-4,351-15,|,,',				//Light Blue Dye
	'351-7|1|0|0,|,,|,38-3,|,,',						//Light Gray Dye
	'351-7|1|0|0,|,,|,38-8,|,,',						//Light Gray Dye
	'351-7|1|0|0,|,,|,38-6,|,,',						//Light Gray Dye
	'351-7|3|1|0,|,,|351,351-15,|,351-15,',				//Light Gray Dye
	'351-7|2|1|0,|,,|351-8,351-15,|,,',					//Light Gray Dye
	'351-10|2|1|0,|,,|351-2,351-15,|,,',				//Lime Dye
	'351-13|1|0|0,|,,|,38-2,|,,',						//Magenta Dye
	'351-13|2|0|0,|,,|,175-1,|,,',						//Magenta Dye
	'351-13|2|1|0,|,,|351-5,351-9,|,,',					//Magenta Dye
	'351-13|4|1|0,|,,|351-4,351-15,|351-1,351-1,',		//Magenta Dye
	'351-13|3|1|0,|,,|351-9,351-1,|,251-4,',			//Magenta Dye
	'351-14|1|0|0,|,,|,38-5,|,,',						//Orange Dye
	'351-14|2|1|0,|,,|351-1,351-11,|,,',				//Orange Dye
	'351-9|1|0|0,|,,|,38-7,|,,',						//Pink Dye
	'351-9|2|0|0,|,,|,175-5,|,,',						//Pink Dye
	'351-9|2|1|0,|,,|351-1,351-15,|,,',					//Pink Dye
	'351-5|2|1|0,|,,|351-4,351-1,|,,',					//Purple Dye
	'351-1|1|0|0,|,,|,38,|,,',							//Rose Red
	'351-1|1|0|0,|,,|,38-4,|,,',						//Rose Red
	'351-1|2|0|0,|,,|,175-4,|,,',						//Rose Red
	'280|4|0|2,5|,,|,5,|,5,',							//Stick
	'353|1|0|0,|,,|,338,|,,',							//Sugar
	'296|9|0|0,|,,|,170,|,,',							//Wheat
	'351-11|1|0|0,|,,|,37,|,,',							//Dandelion Yellow
	'351-11|2|0|0,|,,|,175,|,,',						//Dandelion Yellow
	'264|9|0|0,|,,|,57,|,,',							//Diamond
	'334|1|0|0,|,,|415,415,|415,415,',					//Leather
	'388|9|0|0,|,,|,133,|,,',							//Emerald
	'361|4|0|0,|,,|,86,|,,',							//Pumpkin Seeds
	'362|1|0|0,|,,|,360,|,,'							//Melon Seeds
);

$miscellaneous =	array(
	'339|3|0|0,|,,|338,338,338|,,',						//Paper
	'340|1|1|0,|,,|339,339,|339,334,',					//Book
	'341|9|0|0,|,,|,165,|,,',							//Slimeball
	'385|3|1|2,263|,,|377,263,|,289,',					//Fire Charge
	'386|1|1|0,|,,|340,351,|,288,',						//Book and Quill
	'395|1|0|0,|339,339,339|339,345,339|339,339,339',	//Empty Map
	'358|1|0|0,|339,339,339|339,358,339|339,339,339',	//Map(zoomed out)
	'358|2|1|0,|,,|358,395,|,,',						//Map(cloned)
	'402|1|1|1,351,1|,,|289,351,|,,',					//Any Firework Star
	'401|1|1|0,|,,|339,289,|,,',						//Firework Rocket
	'401|1|1|2,402|,,|402,339,289|289,289,',			//Firework Rocket
	'387|1|1|0,|,,|386,340,|,,',						//Written Book
	'138|1|0|0,|20,20,20|20,399,20|49,49,49',			//Beacon
	'325|1|0|0,|,,|265,,265|,265,',						//Bucket
	'381|1|1|0,|,,|377,368,|,,'							//Eye of Ender
);

$xmlDoc = new DOMDocument('1.0', 'UTF-8');
$xmlDoc->formatOutput = true;
$xmlDoc->preserveWhiteSpace = false;

$xmlRoot = $xmlDoc->createElement("recipes");
$xmlRoot = $xmlDoc->appendChild($xmlRoot);

// -- $building_blocks --
echo '<h3><a href="http://minecraft.gamepedia.com/Crafting/Building_blocks" target="_blank">Building Blocks: '.count($building_blocks).'</a></h3>';
$total=xmlcreate($building_blocks,'building_blocks', $xmlDoc, $xmlRoot)+$total;

// -- $decoration_blocks --
echo '<h3><a href="http://minecraft.gamepedia.com/Crafting/Decoration_blocks" target="_blank">Decocation Blocks: '.count($decoration_blocks).'</a></h3>';
$total=xmlcreate($decoration_blocks,'decoration_blocks',$xmlDoc,$xmlRoot)+$total;

// -- $redstone --
echo '<h3><a href="http://minecraft.gamepedia.com/Crafting/Redstone" target="_blank">Redstone: '.count($redstone).'</a></h3>';
$total=xmlcreate($redstone,'redstone',$xmlDoc,$xmlRoot)+$total;

// -- $transportation --
echo '<h3><a href="http://minecraft.gamepedia.com/Crafting/Transportation" target="_blank">Transportation: '.count($transportation).'</a></h3>';
$total=xmlcreate($transportation,'transportation',$xmlDoc,$xmlRoot)+$total;

// -- $foodstuffs --
echo '<h3><a href="" target="_blank">Foodstuff:'.count($foodstuffs).'</a></h3>';
$total=xmlcreate($foodstuffs,'foodstuffs',$xmlDoc,$xmlRoot)+$total;

// -- $tools --
echo '<h3><a href="" target="_blank">Tools: '.count($tools).'</a></h3>';
$total=xmlcreate($tools,'tools',$xmlDoc,$xmlRoot)+$total;

// -- $combat --
echo '<h3><a href="http://minecraft.gamepedia.com/Crafting/Combat" target="_blank">Combat: '.count($combat).'</a></h3>';
$total=xmlcreate($combat,'combat',$xmlDoc,$xmlRoot)+$total;

// -- $brewing --
echo '<h3><a href="http://minecraft.gamepedia.com/Brewing" target="_blank">Brewing: '.count($brewing).'</a></h3>';
$total=xmlcreate($brewing,'brewing',$xmlDoc,$xmlRoot)+$total;

// -- $materials --
echo '<h3><a href="http://minecraft.gamepedia.com/Crafting/Materials" target="_blank">Materials: '.count($materials).'</a></h3>';
$total=xmlcreate($materials,'materials',$xmlDoc,$xmlRoot)+$total;

// -- $miscellaneous --
echo '<h3><a href="http://minecraft.gamepedia.com/Crafting/Miscellaneous" target="_blank">Miscellaneous: '.count($miscellaneous).'</a></h3>';
$total=xmlcreate($miscellaneous,'miscellaneous',$xmlDoc,$xmlRoot)+$total;

$xmlDoc->save("recipes.xml");
$total_array = count($building_blocks)+count($decoration_blocks)+count($redstone)+count($transportation)+count($foodstuffs)+count($tools)+count($combat)+count($brewing)+count($materials)+count($miscellaneous);
echo "<h1>Done: ".$total."!</h1>";
?>