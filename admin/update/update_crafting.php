<?php
//	Start	recipe	declaration
//format id of item:
// output| NumberOfOutput | RecipeType | multi-input |topleft, topmiddle, topright | left, middle, right | bottomleft, bottom, bottomright

//RecipeType 0=Normal, 1=Shapeless, 2=Fixed

//http://minecraft.gamepedia.com/Crafting/Building_blocks		5/23/15
//http://minecraft.gamepedia.com/Crafting/Decoration_blocks		5/24/15
//http://minecraft.gamepedia.com/Crafting/Redstone
//http://minecraft.gamepedia.com/Crafting/Transportation		5/24/15
//http://minecraft.gamepedia.com/Crafting/Foodstuffs			5/23/15
//http://minecraft.gamepedia.com/Crafting/Tools					5/23/15
//http://minecraft.gamepedia.com/Crafting/Combat				5/24/15
//http://minecraft.gamepedia.com/Crafting/Brewing				5/23/15
//http://minecraft.gamepedia.com/Crafting/Materials				5/24/15
//http://minecraft.gamepedia.com/Crafting/Miscellaneous			5/24/15
//
$total=0;
//multi-input=false
$building_blocks =	array(
	0	=>	'1-5|2|1|,,|1-3,4,|,,',							//Andesite
	1   =>  '1-6|4|0|,,|1-5,1-5,|1-5,1-5,',					//Polished Andesite
	2   =>  '173|1|0|263,263,263|263,263,263|263,263,263',	//Block of Coal
	3   =>  '57|1|0|264,264,264|264,264,264|264,264,264',	//Block of Diamond
	4   =>  '41|1|0|266,266,266|266,266,266|266,266,266',	//Block of Gold
	5   =>  '42|1|0|265,265,265|265,265,265|265,265,265',	//Block of Iron
	//Bookshelf start
	6   =>  '47|1|0|5,5,5|340,340,340|5,5,5',
	7   =>  '47|1|0|5-1,5-1,5-1|340,340,340|5-1,5-1,5-1',
	8   =>  '47|1|0|5-2,5-2,5-2|340,340,340|5-2,5-2,5-2',
	9   =>  '47|1|0|5-3,5-3,5-3|340,340,340|5-3,5-3,5-3',
	10  =>  '47|1|0|5-4,5-4,5-4|340,340,340|5-4,5-4,5-4',
	11  =>  '47|1|0|5-5,5-5,5-5|340,340,340|5-5,5-5,5-5',
	//Bookshelf end
	12  =>  '45|1|0|,,|336,336,|336,336,',					//Bricks
	13  =>  '82|1|0|,,|337,337,|337,337,',					//Clay block
	14  =>  '139|6|0|,,|4,4,4|4,4,4',						//Cobblestone Wall
	15  =>  '139-1|6|0|,,|48,48,48|48,48,48',				//Mossy Cobblestone Wall
	16  =>  '1-3|2|0|,,|4,406,|406,4,',						//Diorite
	17  =>  '1-4|4|0|,,|1-3,1-3,|1-3,1-3,',					//Polished Diorite
	18  =>  '91|1|0|,,|,86,|,50,',							//Jack o'Lantern
	19  =>  '22|1|0|351-4,351-4,351-4|351-4,351-4,351-4|351-4,351-4,351-4', //Lapis Lazuli Block
	20  =>  '48|1|1|,,|4,106,|,,',							//Moss Stone
	21  =>  '24|1|0|,,|12,12,|12,12,',						//Sandstone
	22  =>  '24-2|4|0|,,|24,24,|24,24,',					//Smooth Sandstone
	23  =>  '24-1|1|0|,,|,44-1,|,44-1,',					//Chiseled Sandstone
	24  =>  '44|6|0|,,|1,1,1|,,',							//Stone Slab
	//Sandstone Slab start
	25  =>  '44-1|6|0|,,|24,24,24|,,',
	26  =>  '44-1|6|0|,,|24-1,24-1,24-1|,,',
	27  =>  '44-1|6|0|,,|24-2,24-2,24-2|,,',
	//Sandstone Slab end
	28  =>  '44-3|6|0|,,|4,4,4|,,',							//Cobblestone Slab
	29  =>  '44-4|6|0|,,|45,45,45|,,',						//Bricks Slab
	//Stone Bricks Slab start
	30  =>  '44-5|6|0|,,|98,98,98|,,',
	31  =>  '44-5|6|0|,,|98-1,98-1,98-1|,,',
	32  =>  '44-5|6|0|,,|98-2,98-2,98-2|,,',
	33  =>  '44-5|6|0|,,|98-3,98-3,98-3|,,',
	//Stone Bricks Slab end
	//Any Wood Slab start
	34  =>  '44-2|6|0|,,|,,|,,',
	35  =>  '126|6|0|,,|5,5,5|,,',
	36  =>  '126-1|6|0|,,|5-1,5-1,5-1|,,',
	37  =>  '126-2|6|0|,,|5-2,5-2,5-2|,,',
	38  =>  '126-3|6|0|,,|5-3,5-3,5-3|,,',
	39  =>  '126-4|6|0|,,|5-4,5-4,5-4|,,',
	40  =>  '126-5|6|0|,,|5-5,5-5,5-5|,,',
	//Any Wood Slab end
	41  =>  '44-6|6|0|,,|112,112,112|,,',					//Nether Brick Slab
	//Quartz Slab start
	42  =>  '44-7|6|0|,,|155,155,155|,,',
	43  =>  '44-7|6|0|,,|155-1,155-1,155-1|,,',
	44  =>  '44-7|6|0|,,|155-2,155-2,155-2|,,',
	//Quartz Slab end
	//Red Sandstone Slab start
	45  =>  '182|6|0|,,|179,179,179|,,',
	46  =>  '182|6|0|,,|179-1,179-1,179-1|,,',
	47  =>  '182|6|0|,,|179-2,179-2,179-2|,,',
	//Red Sandstone Slab end
	//Any Stained Glass start
	48  =>  '95|8|0|20,20,20|20,351-15,20|20,20,20',
	49  =>  '95-1|8|0|20,20,20|20,351-14,20|20,20,20',
	50  =>  '95-2|8|0|20,20,20|20,351-13,20|20,20,20',
	51  =>  '95-3|8|0|20,20,20|20,351-12,20|20,20,20',
	52  =>  '95-4|8|0|20,20,20|20,351-11,20|20,20,20',
	53  =>  '95-5|8|0|20,20,20|20,351-10,20|20,20,20',
	54  =>  '95-6|8|0|20,20,20|20,351-9,20|20,20,20',
	55  =>  '95-7|8|0|20,20,20|20,351-8,20|20,20,20',
	56  =>  '95-8|8|0|20,20,20|20,351-7,20|20,20,20',
	57  =>  '95-9|8|0|20,20,20|20,351-6,20|20,20,20',
	58  =>  '95-10|8|0|20,20,20|20,351-5,20|20,20,20',
	59  =>  '95-11|8|0|20,20,20|20,351-4,20|20,20,20',
	60  =>  '95-12|8|0|20,20,20|20,351-3,20|20,20,20',
	61  =>  '95-13|8|0|20,20,20|20,351-2,20|20,20,20',
	62  =>  '95-14|8|0|20,20,20|20,351-1,20|20,20,20',
	63  =>  '95-15|8|0|20,20,20|20,351,20|20,20,20',
	//Any Stained Glass end
	//Any Wood Stairs start
	64  =>  '53|4|0|,,5|,5,5|5,5,5',
	65  =>  '134|4|0|,,5-1|,5-1,5-1|5-1,5-1,5-1',
	66  =>  '135|4|0|,,5-2|,5-2,5-2|5-2,5-2,5-2',
	67  =>  '136|4|0|,,5-3|,5-3,5-3|5-3,5-3,5-3',
	68  =>  '163|4|0|,,5-4|,5-4,5-4|5-4,5-4,5-4',
	69  =>  '164|4|0|,,5-5|,5-5,5-5|5-5,5-5,5-5',
	//Any Wood Stairs end
	70  =>  '67|4|0|,,4|,4,4|4,4,4',						//Cobblestone Stairs
	71  =>  '108|4|0|,,45|,45,45|45,45,45',					//Brick Stairs
	//Stone Brick Stairs start
	72  =>  '109|4|0|,,98|,98,98|98,98,98',
	73  =>  '109|4|0|,,98-1|,98-1,98-1|98-1,98-1,98-1',
	74  =>  '109|4|0|,,98-2|,98-2,98-2|98-2,98-2,98-2',
	75  =>  '109|4|0|,,98-3|,98-3,98-3|98-3,98-3,98-3',
	//Stone Brick Stairs end
	76  =>  '114|4|0|,,112|,112,112|112,112,112',			//Nether Brick Stairs
	//Sandstone Stairs start
	77  =>  '128|4|0|,,24|,24,24|24,24,24',
	78  =>  '128|4|0|,,24-1|,24-1,24-1|24-1,24-1,24-1',
	79  =>  '128|4|0|,,24-2|,24-2,24-2|24-2,24-2,24-2',
	//Sandstone Stairs end
	//Quartz Stairs start
	80  =>  '156|4|0|,,155|,155,155|155,155,155',
	81  =>  '156|4|0|,,155-1|,155-1,155-1|155-1,155-1,155-1',
	82  =>  '156|4|0|,,155-2|,155-2,155-2|155-2,155-2,155-2',
	//Quartz Stairs end
	//Red Sandstone Stairs start
	83  =>  '180|4|0|,,179|,179,179|179,179,179',
	84  =>  '180|4|0|,,179-1|,179-1,179-1|179-1,179-1,179-1',
	85  =>  '180|4|0|,,179-2|,179-2,179-2|179-2,179-2,179-2',
	//Red Sandstone Stairs end
	86  =>  '98|4|0|,,|1,1,|1,1,',							//Stone Bricks
	87  =>  '98-1|1|1|,,|98,106,|,,',						//Mossy Stone Bricks
	88  =>  '98-3|1|0|,,|,44-5,|,44-5,',					//Chiseled Stone Bricks
	//Any Stained Clay start
	89  =>  '159|8|0|172,172,172|172,351-15,172|172,172,172',
	90  =>  '159-1|8|0|172,172,172|172,351-14,172|172,172,172',
	91  =>  '159-2|8|0|172,172,172|172,351-13,172|172,172,172',
	92  =>  '159-3|8|0|172,172,172|172,351-12,172|172,172,172',
	93  =>  '159-4|8|0|172,172,172|172,351-11,172|172,172,172',
	94  =>  '159-5|8|0|172,172,172|172,351-10,172|172,172,172',
	95  =>  '159-6|8|0|172,172,172|172,351-9,172|172,172,172',
	96  =>  '159-7|8|0|172,172,172|172,351-8,172|172,172,172',
	97  =>  '159-8|8|0|172,172,172|172,351-7,172|172,172,172',
	98  =>  '159-9|8|0|172,172,172|172,351-6,172|172,172,172',
	99  =>  '159-10|8|0|172,172,172|172,351-5,172|172,172,172',
	100 =>  '159-11|8|0|172,172,172|172,351-4,172|172,172,172',
	101 =>  '159-12|8|0|172,172,172|172,351-3,172|172,172,172',
	102 =>  '159-13|8|0|172,172,172|172,351-2,172|172,172,172',
	103 =>  '159-14|8|0|172,172,172|172,351-1,172|172,172,172',
	104 =>  '159-15|8|0|172,172,172|172,351,172|172,172,172',
	//Any Stained Clay end
	105 =>  '133|1|0|388,388,388|388,388,388|388,388,388',	//Block of Emerald
	106 =>  '179|1|0|,,|12-1,12-1,|12-1,12-1,',				//Red Sandstone
	107 =>  '179-2|4|0|,,|179,179,|179,179,',				//Smooth Red Sandstone
	108 =>  '179-1|1|0|,,|,182,|,182,',						//Chiseled Red Sandstone
	109 =>  '80|1|0|,,|332,332,|332,332,',					//Snow
	110 =>  '155|1|0|,,|406,406,|406,406,',					//Block of Quartz
	111 =>  '155-1|1|0|,,|,44-7,|,44-7,',					//Chiseled Quartz Block
	112 =>  '155-2|2|0|,,|,155,|,155,',						//Pillar Quartz Block
	113 =>  '89|1|0|,,|348,348,|348,348,',					//Glowstone
	114 =>  '1-1|1|1|,,|1-3,406,|,,',						//Granite
	115 =>  '1-2|4|0|,,|1-1,1-1,|1-1,1-1,',					//Polished Granite
	116 =>  '170|1|0|296,296,296|296,296,296|296,296,296',	//Hay Bale
	117 =>  '169|1|0|409,410,409|410,410,410|409,410,409',	//Sea Lantern
	//Any Wood Planks start
	118 =>  '5|4|0|,,|,17,|,,',
	119 =>  '5-1|4|0|,,|,17-1,|,,',
	120 =>  '5-2|4|0|,,|,17-2,|,,',
	121 =>  '5-3|4|0|,,|,17-3,|,,',
	122 =>  '5-4|4|0|,,|,17-4,|,,',
	123 =>  '5-5|4|0|,,|,17-5,|,,',
	//Any Wood Planks end
	124 =>  '112|1|0|,,|405,405,|405,405,',					//Nether Brick
	125 =>  '103|1|0|360,360,360|360,360,360|360,360,360',	//Melon (block)
	126 =>  '168|1|0|,,|409,409,|409,409,',					//Prismarine
	127 =>  '168-1|1|0|409,409,409|409,409,409|409,409,409',//Prismarine Bricks
	126 =>  '168-2|1|0|409,409,409|409,351,409|409,409,409',//Dark Prismarine
	127 =>  '3-1|4|0|,,|3,13,|13,3,',						//Coarse Dirt
	128 =>  '35|1|0|,,|287,287,|287,287,',					//White Wool
	//Any Dyed Wool start
	129 =>  '35-1|1|1|,,|35,351-14,|,,',
	130 =>  '35-2|1|1|,,|35,351-13,|,,',
	131 =>  '35-3|1|1|,,|35,351-12,|,,',
	132 =>  '35-4|1|1|,,|35,351-11,|,,',
	133 =>  '35-5|1|1|,,|35,351-10,|,,',
	134 =>  '35-6|1|1|,,|35,351-9,|,,',
	135 =>  '35-7|1|1|,,|35,351-8,|,,',
	136 =>  '35-8|1|1|,,|35,351-7,|,,',
	137 =>  '35-9|1|1|,,|35,351-6,|,,',
	138 =>  '35-10|1|1|,,|35,351-5,|,,',
	139 =>  '35-11|1|1|,,|35,351-4,|,,',
	140 =>  '35-12|1|1|,,|35,351-3,|,,',
	141 =>  '35-13|1|1|,,|35,351-2,|,,',
	142 =>  '35-14|1|1|,,|35,351-1,|,,',
	143 =>  '35-15|1|1|,,|35,351,|,,'
);

// output| NumberOfOutput | RecipeType | multi-input |topleft, topmiddle, topright | left, middle, right | bottomleft, bottom, bottomright
// defalut = 0 multi-input with multi-output = 1, multi-input with static output = 2, 2multi input 1 static = 3
$decoration_blocks =	array(
	0   =>  '50|4|0|0,|,,|,263,|,280,',							//Torch
	1   =>  '50|4|0|0,|,,|,263-1,|,280,',						//Torch
	2   =>  '61|1|0|0,|4,4,4|4,,4|4,4,4',						//Furnace
	3   =>  '65|3|0|0,|280,,280|280,280,280|,280,',				//Ladder
	4   =>  '85|3|0|0,|,,|5,280,5|5,280,5',						//oak Fence
	5   =>  '188|3|0|0,|,,|5-1,280,5-1|5-1,280,5-1',			//spruce fence
	6   =>  '189|3|0|0,|,,|5-2,280,5-2|5-2,280,5-2',			//birch fence
	7   =>  '190|3|0|0,|,,|5-3,280,5-3|5-3,280,5-3',			//jungle fence
	8   =>  '191|3|0|0,|,,|5-4,280,5-4|5-4,280,5-4',			//dark oak fence
	9   =>  '192|3|0|0,|,,|5-5,280,5-5|5-5,280,5-5',			//acacia fence
	10  =>  '113|6|0|0,|,,|112,112,112|112,112,112',			//Nether Brick Fence
	11  =>  '102|16|0|0,|,,|20,20,20|20,20,20',					//Glass Pane
	12  =>  '146|1|0|0,|,,|131,54,|,,',							//Trapped Chest
	13  =>  '171|3|0|1,35|,,|,,|35,35,',						//Any Carpet
	14  =>  '321|1|0|2,35|280,280,280|280,35,280|280,280,280',	//Painting
	15  =>  '323|3|0|2,5|5,5,5|5,5,5|,280,',					//Sign
	16  =>  '355|1|0|3,5,35|,,|35,35,35|5,5,5',					//Bed
	17  =>  '390|1|0|0,|,,|336,,336|,336,',						//Flower Pot
	18  =>  '425|1|0|1,35,1|35,35,35|35,35,35|,280,',			//Any Banner
	19  =>  '425|1|1|2,425|,,|425,425,|,,',						//Any Banner
	20  =>  '78|6|0|0,|,,|80,80,80|,,',							//Snow (layer)
	21  =>  '101|16|0|0,|,,|265,265,265|265,265,265',			//Iron Bars
	22  =>  '130|1|0|0,|49,49,49|49,381,49|49,49,49',			//Ender Chest
	23  =>  '84|1|0|2,5|5,5,5|5,264,5|5,5,5',					//Jukebox
	24  =>  '165|1|0|0,|341,341,341|341,341,341|341,341,341',	//Slime Block
	25  =>  '116|1|0|0,|,340,|364,49,364|49,49,49',				//Enchantment Table
	26  =>  '58|1|0|2,5|,,|5,5,|5,5,',							//Crafting Table
	27  =>  '389|1|0|0,|280,280,280|280,334,280|280,280,280',	//Item Frame
	28  =>  '416|1|0|0,|280,280,280|,280,|280,44,280',			//Armor Stand
	29  =>  '160|16|0|1,95|,,|95,95,95|95,95,95',				//Any Stained Glass Pane
	30  =>  '145|1|0|0,|42,42,42|,265,|265,265,265',			//Anvil
	31  =>  '54|1|0|1,5|5,5,5|5,,5|5,5,5'						//Chest
);

//multi-input=false
$redstone =	array(
	//Door Start
	0	=>	'64|3|0|0,|5,5,|5,5,|5,5,',									//Oak
	1	=>	'193|3|0|0,|5-1,5-1,|5-1,5-1,|5-1,5-1,',					//Spruce
	2	=>	'194|3|0|0,|5-2,5-2,|5-2,5-2,|5-2,5-2,',					//Birch
	3	=>	'195|3|0|0,|5-3,5-3,|5-3,5-3,|5-3,5-3,',					//Jungle
	4	=>	'196|3|0|0,|5-4,5-4,|5-4,5-4,|5-4,5-4,',					//Acacia
	5	=>	'197|3|0|0,|5-5,5-5,|5-5,5-5,|5-5,5-5,',					//Dark Oak
	6	=>	'71|3|0|0,|265,265,|265,265,|265,265,',						//Iron
	//Door End
	7	=>	'154|1|0|0,|265,,265|265,54,265|,265,', 					//Hopper
	8	=>	'331|9|0|0,|,,|,152,|,,', 									//Redstone
	//Trapdoor Start
	9	=>	'96|2|0|1,5|,,|5,5,5|5,5,5',								//Oak
	10	=>	'167|1|0|0,|,,|265,265,|265,265,',							//Iron
	//Trapdoor End
	11	=>	'46|1|0|1,12|289,12,289|12,289,12|289,12,289'				//TNT sand
	//18	=>	'|1|0|,,|,,|,,',//
	//19	=>	'|1|0|,,|,,|,,',//
		
);

$transportation =	array(
	0  =>  '157|6|0|0,|265,280,265|265,76,265|265,280,265',			//Activator Rail
	1  =>  '398|1|0|0,|,,|346,,|,391,',								//Carrot on a Stick
	2  =>  '398|1|1|0,|,,|398,398,|,,',								//Carrot on a Stick
	3  =>  '328|1|0|0,|,,|265,,265|265,265,265',					//Minecart
	4  =>  '342|1|0|0,|,,|,54,|,328,',								//Minecart with Chest
	5  =>  '343|1|0|0,|,,|,61,|,328,',								//Minecart with Furnace
	6  =>  '407|1|0|0,|,,|,46,|,328,',								//Minecart with TNT
	7  =>  '66|16|0|0,|265,,265|265,280,265|265,,265',				//Rail
	8  =>  '408|1|0|0,|,,|,154,|,328,',								//Minecart with Hopper
	9  =>  '27|6|0|0,|266,,266|266,280,266|266,331,266',			//Powered Rail
	10  => '28|6|0|0,|265,,265|265,,265|265,,265',					//Detector Rail
	11  => '333|1|0|1,5|,,|5,,5|5,5,5'								//Boat
);

//multi-input=false
$foodstuffs =	array(
	0  =>  '282|1|1|,,|40,39,|,281,',						//Mushroom Stew
	1  =>  '297|1|0|,,|296,296,296|,,',						//Bread
	2  =>  '322|1|0|266,266,266|266,260,266|266,266,266',	//Golden Apple
	3  =>  '322-1|1|0|41,41,41|41,260,41|41,41,41',			//Enchanted Golden Apple
	4  =>  '357|8|0|,,|296,351-3,296|,,',					//Cookie
	5  =>  '400|1|0|,,|86,353,|,344,',						//Pumpkin Pie
	6  =>  '396|1|0|371,371,371|371,391,371|371,371,371',	//Golden Carrot
	7  =>  '413|1|0|,412,|391,393,39|,281,',				//Rabbit Stew
	8  =>  '413|1|0|,412,|391,393,40|,281,',				//Rabbit Stew
	9  =>  '354|1|0|335,335,335|353,344,353|296,296,296'	//Cake
);

//multi-input=false
$tools =	array(
	0   =>  '347|1|0|,266,|266,331,266|,266,',					//Clock/watch
	1   =>  '345|1|0|,265,|265,331,265|,265,',					//Compass
	2   =>  '346|1|0|,,280|,280,287|280,,287',					//Fishing Rod
	3   =>  '346|1|1|,,|346,346,|,,',							//Fishing Rod
	4   =>  '259|1|1|,,|265,318,|,,',							//Flint and Steel
	5   =>  '259|1|1|,,|259,259,|,,',							//Flint and Steel
	//Hoe start start
	//any wood plank start
	6   =>  '290|1|0|5,5,|,280,|,280,',
	7   =>  '290|1|0|5-1,5-1,|,280,|,280,',
	8   =>  '290|1|0|5-2,5-2,|,280,|,280,',
	9   =>  '290|1|0|5-3,5-3,|,280,|,280,',
	10  =>  '290|1|0|5-4,5-4,|,280,|,280,',
	11  =>  '290|1|0|5-5,5-5,|,280,|,280,',
	//any wood plank end
	12  =>  '291|1|0|4,4,|,280,|,280,',							//Cobblestone
	13  =>  '292|1|0|265,265,|,280,|,280,',						//Iron Ingot 
	14  =>  '294|1|0|266,266,|,280,|,280,',						//Gold Ingot
	15  =>  '293|1|0|264,264,|,280,|,280,',						//Diamond
	16  =>  '290|1|1|,,|290,290,|,,',							//Wooden hoe
	17  =>  '291|1|1|,,|291,291,|,,',							//stone hoe
	18  =>  '292|1|1|,,|292,292,|,,',							//iron hoe
	19  =>  '293|1|1|,,|293,293,|,,',							//diamond hoe
	20  =>  '294|1|1|,,|294,294,|,,',							//gold hoe
	//Hoe start end
	21  =>  '420|1|1|287,287,|287,341,|,,287',					//Lead
	//Axe start
	22  =>  '258|1|0|265,265,|265,280,|,280,',					//iron
	//any wood plank start
	23  =>  '271|1|0|5,5,|5,280,|,280,',
	24  =>  '271|1|0|5-1,5-1,|5-1,280,|,280,',
	25  =>  '271|1|0|5-2,5-2,|5-2,280,|,280,',
	26  =>  '271|1|0|5-3,5-3,|5-3,280,|,280,',
	27  =>  '271|1|0|5-4,5-4,|5-4,280,|,280,',
	28  =>  '271|1|0|5-5,5-5,|5-5,280,|,280,',
	//any wood plank end
	29  =>  '275|1|0|4,4,|4,280,|,280,',						//stone
	30  =>  '279|1|0|264,264,|264,280,|,280,',					//diamond
	31  =>  '286|1|0|266,266,|266,280,|,280,',					//gold
	32  =>  '258|1|1|,,|258,258,|,,',							//iron axe
	33  =>  '271|1|1|,,|271,271,|,,',							//wood axe
	34  =>  '275|1|1|,,|275,275,|,,',							//stone axe
	35  =>  '279|1|1|,,|279,279,|,,',							//diamond axe
	36  =>  '286|1|1|,,|286,286,|,,',							//gold axe
	//Axe end
	//Pickaxe start
	37  =>  '257|1|0|265,265,265|,280,|,280,',					//iron
	//any wood plank start
	38  =>  '270|1|0|5,5,5|,280,|,280,',
	39  =>  '270|1|0|5-1,5-1,5-1|,280,|,280,',
	40  =>  '270|1|0|5-2,5-2,5-2|,280,|,280,',
	41  =>  '270|1|0|5-3,5-3,5-3|,280,|,280,',
	42  =>  '270|1|0|5-4,5-4,5-4|,280,|,280,',
	43  =>  '270|1|0|5-5,5-5,5-5|,280,|,280,',
	//any wood plank end
	44  =>  '274|1|0|4,4,4|,280,|,280,',						//stone
	45  =>  '278|1|0|264,264,264|,280,|,280,',					//diamond
	46  =>  '285|1|0|266,266,266|,280,|,280,',					//gold
	47  =>  '257|1|1|,,|257,257,|,,',							//iron pickaxe
	48  =>  '270|1|1|,,|270,270,|,,',							//wood pickaxe
	49  =>  '274|1|1|,,|274,274,|,,',							//stone pickaxe
	50  =>  '278|1|1|,,|278,278,|,,',							//diamond pickaxe
	51  =>  '285|1|1|,,|285,285,|,,',							//gold pickaxe
	//Pickaxe end
	52  =>  '359|1|0|,,|,265,|265,,',							//Shears
	53  =>  '359|1|1|,,|359,359,|,,',							//Shears
	//Shovel start
	54  =>  '256|1|0|,265,|,280,|,280,',						//iron
	//any wood plank start
	55  =>  '269|1|0|,5,|,280,|,280,',
	56  =>  '269|1|0|,5-1,|,280,|,280,',
	57  =>  '269|1|0|,5-2,|,280,|,280,',
	58  =>  '269|1|0|,5-3,|,280,|,280,',
	59  =>  '269|1|0|,5-4,|,280,|,280,',
	60  =>  '269|1|0|,5-5,|,280,|,280,',
	//any wood plank end
	61  =>  '273|1|0|,4,|,280,|,280,',							//stone
	62  =>  '277|1|0|,264,|,280,|,280,',						//diamond
	63  =>  '284|1|0|,266,|,280,|,280,',						//gold
	64  =>  '269|1|1|,,|269,269,|,,',							//wood shovel
	65  =>  '273|1|1|,,|273,273,|,,',							//stone shovel
	66  =>  '277|1|1|,,|277,277,|,,',							//diamond shovel
	67  =>  '284|1|1|,,|284,284,|,,',							//gold shovel
	68  =>  '256|1|1|,,|256,256,|,,'							//iron shovel
	//Shovel end
);

$combat =	array(
	0  =>  '261|1|0|0,|,280,287|280,,287|,280,287',			//Bow
	1  =>  '261|1|1|0,|,,|261,261,|,,',						//Bow
	2  =>  '262|4|0|0,|,318,|,280,|,288,',					//Arrow
	3  =>  '300|1|0|0,|334,334,334|334,,334|334,,334',		//Leggings leather
	4  =>  '316|1|0|0,|266,266,266|266,,266|266,,266',		//Leggings gold
	5  =>  '308|1|0|0,|265,265,265|265,,265|265,,265',		//Leggings iron
	6  =>  '312|1|0|0,|264,264,264|264,,264|264,,264',		//Leggings diamond
	7  =>  '300|1|1|0,|,,|300,300,|,,',						//Leather Pants
	8  =>  '316|1|1|0,|,,|316,316,|,,',						//Golden Leggings
	9  =>  '304|1|1|0,|,,|304,304,|,,',						//Chain Leggings
	10 =>  '312|1|1|0,|,,|312,312,|,,',						//Diamond Leggings
	11 =>  '301|1|0|0,|,,|334,,334|334,,334',				//Boots leather
	12 =>  '317|1|0|0,|,,|266,,266|266,,266',				//Boots gold
	13 =>  '309|1|0|0,|,,|265,,265|265,,265',				//Boots iron
	14 =>  '313|1|0|0,|,,|264,,264|264,,264',				//Boots diamond
	15 =>  '301|1|1|0,|,,|301,301,|,,',						//Leather Boots
	16 =>  '317|1|1|0,|,,|317,317,|,,',						//Golden Boots
	17 =>  '305|1|1|0,|,,|305,305,|,,',						//Chain Boots
	18 =>  '309|1|1|0,|,,|309,309,|,,',						//Iron Boots
	19 =>  '313|1|1|0,|,,|313,313,|,,',						//Diamond Boots
	20 =>  '298|1|0|0,|,,|334,334,334|334,,334',			//Helmet leather
	21 =>  '314|1|0|0,|,,|266,266,266|266,,266',			//Helmet gold
	22 =>  '306|1|0|0,|,,|265,265,265|265,,265',			//Helmet iron
	23 =>  '310|1|0|0,|,,|264,264,264|264,,264',			//Helmet diamond
	24 =>  '298|1|1|0,|,,|298,298,|,,',						//Leather Cap
	25 =>  '314|1|1|0,|,,|314,314,|,,',						//Golden Helmet
	26 =>  '302|1|1|0,|,,|302,302,|,,',						//Chain Helmet
	27 =>  '306|1|1|0,|,,|306,306,|,,',						//Iron Helmet
	28 =>  '310|1|1|0,|,,|310,310,|,,',						//Diamond Helmet
	29 =>  '299|1|0|0,|334,,334|334,334,334|334,334,334',	//Chestplate leather
	30 =>  '315|1|0|0,|266,,266|266,266,266|266,266,266',	//Chestplate gold
	31 =>  '307|1|0|0,|265,,265|265,265,265|265,265,265',	//Chestplate iron
	32 =>  '311|1|0|0,|264,,264|264,264,264|264,264,264',	//Chestplate diamond
	33 =>  '299|1|1|0,|,,|299,299,|,,',						//Leather Tunic
	34 =>  '315|1|1|0,|,,|315,315,|,,',						//Golden Chestplate
	35 =>  '303|1|1|0,|,,|303,303,|,,',						//Chain Chestplate
	36 =>  '307|1|1|0,|,,|307,307,|,,',						//Iron Chestplate
	37 =>  '311|1|1|0,|,,|311,311,|,,',						//Diamond Chestplate
	38 =>  '268|1|0|1,5|,5,|,5,|,280,',						//Sword wood planks
	39 =>  '272|1|0|0,|,4,|,4,|,280,',						//Sword cobblestone
	40 =>  '267|1|0|0,|,265,|,265,|,280,',					//Sword iron
	41 =>  '283|1|0|0,|,266,|,266,|,280,',					//Sword gold
	42 =>  '276|1|0|0,|,264,|,264,|,280,',					//Sword diamond
	43 =>  '268|1|1|0,|,,|268,268,|,,',						//Wooden Sword
	44 =>  '272|1|1|0,|,,|272,272,|,,',						//Stone Sword
	45 =>  '267|1|1|0,|,,|267,167,|,,',						//Iron Sword
	46 =>  '283|1|1|0,|,,|283,283,|,,'						//Golden Sword
);

//multi-input=false
$brewing =	array(
	0  =>  '377|2|0|,,|,369,|,,',							//Blaze Powder
	1  =>  '|1|1|,,|39,353,|,375,',							//Fermented Spider Eye
	2  =>  '374|3|0|,,|20,,20|,20,',						//Glass Bottle
	3  =>  '|1|1|,,|377,341,|,,',							//Magma Cream
	4  =>  '379|1|0|,,|,369,|4,4,4',						//Brewing Stand
	5  =>  '380|1|0|265,,265|265,,265|265,265,265',			//Cauldron
	6  =>  '382|1|0|371,371,371|371,360,371|371,371,371'	//Glistering Melon
);

$materials =	array(
	0  =>  '351-15|3|0|0,|,,|,352,|,,',							//Bone Meal
	1  =>  '281|4|0|1,5|,,|5,,5|,5,',							//Bowl
	2  =>  '263|9|0|0,|,,|,173,|,,',							//Coal
	3  =>  '351-6|2|1|0,|,,|351-4,351-2,|,,',					//Cyan Dye
	4  =>  '266|9|0|0,|,,|,41,|,,',								//Gold Ingot
	5  =>  '266|1|0|0,|371,371,371|371,371,371|371,371,371',	//Gold Ingot
	6  =>  '371|9|0|0,|,,|,266,|,,',							//Gold Nugget
	7  =>  '351-8|2|1|0,|,,|351,351-15,|,,',					//Gray Dye
	8  =>  '265|9|0|0,|,,|,42,|,,',								//Iron Ingot
	9  =>  '351-4|9|0|0,|,,|,22,|,,',							//Lapis Lazuli
	10 =>  '351-12|1|0|0,|,,|,38-1,|,,',						//Light Blue Dye
	11 =>  '351-12|2|1|0,|,,|351-4,351-15,|,,',					//Light Blue Dye
	12 =>  '351-7|1|0|0,|,,|,38-3,|,,',							//Light Gray Dye
	13 =>  '351-7|1|0|0,|,,|,38-8,|,,',							//Light Gray Dye
	14 =>  '351-7|1|0|0,|,,|,38-6,|,,',							//Light Gray Dye
	15 =>  '351-7|3|1|0,|,,|351,351-15,|,351-15,',				//Light Gray Dye
	16 =>  '351-7|2|1|0,|,,|351-8,351-15,|,,',					//Light Gray Dye
	17 =>  '351-10|2|1|0,|,,|351-2,351-15,|,,',					//Lime Dye
	18 =>  '351-13|1|0|0,|,,|,38-2,|,,',						//Magenta Dye
	19 =>  '351-13|2|0|0,|,,|,175-1,|,,',						//Magenta Dye
	20 =>  '351-13|2|1|0,|,,|351-5,351-9,|,,',					//Magenta Dye
	21 =>  '351-13|4|1|0,|,,|351-4,351-15,|351-1,351-1,',		//Magenta Dye
	22 =>  '351-13|3|1|0,|,,|351-9,351-1,|,251-4,',				//Magenta Dye
	23 =>  '351-14|1|0|0,|,,|,38-5,|,,',						//Orange Dye
	24 =>  '351-14|2|1|0,|,,|351-1,351-11,|,,',					//Orange Dye
	25 =>  '351-9|1|0|0,|,,|,38-7,|,,',							//Pink Dye
	26 =>  '351-9|2|0|0,|,,|,175-5,|,,',						//Pink Dye
	27 =>  '351-9|2|1|0,|,,|351-1,351-15,|,,',					//Pink Dye
	28 =>  '351-5|2|1|0,|,,|351-4,351-1,|,,',					//Purple Dye
	29 =>  '351-1|1|0|0,|,,|,38,|,,',							//Rose Red
	30 =>  '351-1|1|0|0,|,,|,38-4,|,,',							//Rose Red
	31 =>  '351-1|2|0|0,|,,|,175-4,|,,',						//Rose Red
	32 =>  '280|4|0|1,5|,,|,5,|,5,',							//Stick
	33 =>  '353|1|0|0,|,,|,338,|,,',							//Sugar
	34 =>  '296|9|0|0,|,,|,170,|,,',							//Wheat
	35 =>  '351-11|1|0|0,|,,|,37,|,,',							//Dandelion Yellow
	36 =>  '351-11|2|0|0,|,,|,175,|,,',							//Dandelion Yellow
	37 =>  '264|9|0|0,|,,|,57,|,,',								//Diamond
	38 =>  '334|1|0|0,|,,|415,415,|415,415,',					//Leather
	39 =>  '388|9|0|0,|,,|,133,|,,',							//Emerald
	40 =>  '361|4|0|0,|,,|,86,|,,',								//Pumpkin Seeds
	41 =>  '362|1|0|0,|,,|,360,|,,'								//Melon Seeds
);

$miscellaneous =	array(
	0  =>  '339|3|0|0,|,,|338,338,338|,,',					//Paper
	1  =>  '340|1|1|0,|,,|339,339,|339,334,',				//Book
	2  =>  '341|9|0|0,|,,|,165,|,,',						//Slimeball
	3  =>  '385|3|1|2,263|,,|377,263,|,289,',				//Fire Charge
	4  =>  '386|1|1|0,|,,|340,351,|,288,',					//Book and Quill
	5  =>  '395|1|0|0,|339,339,339|339,345,339|339,339,339',//Empty Map
	6  =>  '358|1|0|0,|339,339,339|339,358,339|339,339,339',//Map(zoomed out)
	7  =>  '358|2|1|0,|,,|358,395,|,,',						//Map(cloned)
	8  =>  '402|1|1|1,351,1|,,|289,351,|,,',				//Any Firework Star
	9  =>  '401|1|1|0,|,,|339,289,|,,',						//Firework Rocket
	10 =>  '401|1|1|2,402|,,|402,339,289|289,289,',			//Firework Rocket
	11 =>  '387|1|1|0,|,,|386,340,|,,',						//Written Book
	12 =>  '138|1|0|0,|20,20,20|20,399,20|49,49,49',		//Beacon
	13 =>  '325|1|0|0,|,,|265,,265|,265,',					//Bucket
	14 =>  '381|1|1|0,|,,|377,368,|,,'						//Eye of Ender
);

$xmlDoc = new DOMDocument('1.0', 'UTF-8');
$xmlDoc->formatOutput = true;
$xmlDoc->preserveWhiteSpace = false;

$xmlRoot = $xmlDoc->createElement("recipes");
$xmlRoot = $xmlDoc->appendChild($xmlRoot);

// -- $building_blocks --
echo '<h3><a href="http://minecraft.gamepedia.com/Crafting/Building_blocks" target="_blank">Building Blocks: '.count($building_blocks).'</a></h3>';
$q=0;
for($i=0; $i <= count($building_blocks)-1; $i++) {
	$total++;
	$parser_step_1 = explode("|", $building_blocks[$i]);

	$parser_step_2_line_1 = $parser_step_1[0];
	$parser_step_2_line_2 = $parser_step_1[1];
	$parser_step_2_line_3 = $parser_step_1[2];
	$parser_step_2_line_4 = explode(",", $parser_step_1[3]);
	$parser_step_2_line_5 = explode(",", $parser_step_1[4]);
	$parser_step_2_line_6 = explode(",", $parser_step_1[5]);

	echo $parser_step_2_line_1."<br />";

	$xmlItem = $xmlDoc->createElement("rec");
	$xmlItem = $xmlRoot->appendChild($xmlItem);
	$xmlItem->setAttribute('BB', $q++);
	$xmlItem->appendChild($xmlDoc->createElement('o', $parser_step_2_line_1));
	$xmlItem->appendChild($xmlDoc->createElement('noo', $parser_step_2_line_2));
	$xmlItem->appendChild($xmlDoc->createElement('rt', $parser_step_2_line_3));
	$xmlItem->appendChild($xmlDoc->createElement('tl', $parser_step_2_line_4[0]));
	$xmlItem->appendChild($xmlDoc->createElement('tm', $parser_step_2_line_4[1]));
	$xmlItem->appendChild($xmlDoc->createElement('tr', $parser_step_2_line_4[2]));
	$xmlItem->appendChild($xmlDoc->createElement('l', $parser_step_2_line_5[0]));
	$xmlItem->appendChild($xmlDoc->createElement('m', $parser_step_2_line_5[1]));
	$xmlItem->appendChild($xmlDoc->createElement('r', $parser_step_2_line_5[2]));
	$xmlItem->appendChild($xmlDoc->createElement('bl', $parser_step_2_line_6[0]));
	$xmlItem->appendChild($xmlDoc->createElement('b', $parser_step_2_line_6[1]));
	$xmlItem->appendChild($xmlDoc->createElement('br', $parser_step_2_line_6[2]));
}

// -- $decoration_blocks --
echo '<h3><a href="http://minecraft.gamepedia.com/Crafting/Decoration_blocks" target="_blank">Decocation Blocks: '.count($decoration_blocks).'</a></h3>';
// output| NumberOfOutput | RecipeType | multi-input,changing item |topleft, topmiddle, topright | left, middle, right | bottomleft, bottom, bottomright

// default = 0, multi-input with multi-output = 1, multi-input with static output = 2
$q=0;
for($i=0; $i <= count($decoration_blocks)-1; $i++) {
	$parser_step_1 = explode("|", $decoration_blocks[$i]);

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
		$xmlItem->setAttribute('DB', $q++);
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
		if($parser_step_2_line_4[1]=='35') {
			$idsize=15;
		} elseif($parser_step_2_line_4[1]=='5') {
			$idsize=5;
		} elseif($parser_step_2_line_4[1]=='95') {
			$idsize=15;
		} else {
			$idsize=2;
		}
		$xmlItem = $xmlDoc->createElement("rec");
		$xmlItem = $xmlRoot->appendChild($xmlItem);
		$xmlItem->setAttribute('DB', $q++);
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
			$xmlItem->setAttribute('DB', $q++);
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
		echo $parser_step_2_line_1."<br />";
		$xmlItem = $xmlDoc->createElement("rec");
		$xmlItem = $xmlRoot->appendChild($xmlItem);
		$xmlItem->setAttribute('DB', $q++);
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
		} else {
			$idsize=2;
		}
		for($j=1; $j <= $idsize; $j++) {
			$total++;
			echo $parser_step_2_line_1."<br />";
			
			$xmlItem = $xmlDoc->createElement("rec");
			$xmlItem = $xmlRoot->appendChild($xmlItem);
			$xmlItem->setAttribute('DB', $q++);
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
	} elseif ($parser_step_2_line_4[0] == '3') {
		$total++;
		echo $parser_step_2_line_1."<br />";
		$xmlItem = $xmlDoc->createElement("rec");
		$xmlItem = $xmlRoot->appendChild($xmlItem);
		$xmlItem->setAttribute('DB', $q++);
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
				$xmlItem->setAttribute('DB', $q++);
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

// -- $redstone --
echo '<h3><a href="http://minecraft.gamepedia.com/Crafting/Redstone" target="_blank">Redstone: '.count($redstone).'</a></h3>';
// output| NumberOfOutput | RecipeType | multi-input,changing item |topleft, topmiddle, topright | left, middle, right | bottomleft, bottom, bottomright

// default = 0, multi-input with multi-output = 1, multi-input with static output = 2
$q=0;
for($i=0; $i <= count($redstone)-1; $i++) {
	$parser_step_1 = explode("|", $redstone[$i]);

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
		$xmlItem->setAttribute('R', $q++);
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
		
	} elseif ($parser_step_2_line_4[0] == '1') {//Static output with dynamic input
		$total++;
		echo $parser_step_2_line_1."<br />";
		$xmlItem = $xmlDoc->createElement("rec");
		$xmlItem = $xmlRoot->appendChild($xmlItem);
		$xmlItem->setAttribute('R', $q++);
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
		} elseif($parser_step_2_line_4[1]=='12') {
			$idsize=1;
		} else {
			$idsize=2;
		}
		for($j=1; $j <= $idsize; $j++) {
			$total++;
			echo $parser_step_2_line_1."<br />";
			
			$xmlItem = $xmlDoc->createElement("rec");
			$xmlItem = $xmlRoot->appendChild($xmlItem);
			$xmlItem->setAttribute('R', $q++);
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
	} else {
		echo 'Fail: (multi-input,changing item) not set<br />'.var_dump($parser_step_1)."<br />";
	}
}

// -- $transportation --
echo '<h3><a href="http://minecraft.gamepedia.com/Crafting/Transportation" target="_blank">Transportation: '.count($transportation).'</a></h3>';
// output| NumberOfOutput | RecipeType | multi-input,changing item |topleft, topmiddle, topright | left, middle, right | bottomleft, bottom, bottomright

// default = 0, multi-input with multi-output = 1, multi-input with static output = 2
$q=0;
for($i=0; $i <= count($transportation)-1; $i++) {
	$parser_step_1 = explode("|", $transportation[$i]);

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
		$xmlItem->setAttribute('T', $q++);
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
		
	} elseif ($parser_step_2_line_4[0] == '1') {//Static output with dynamic input
		$total++;
		echo $parser_step_2_line_1."<br />";
		$xmlItem = $xmlDoc->createElement("rec");
		$xmlItem = $xmlRoot->appendChild($xmlItem);
		$xmlItem->setAttribute('T', $q++);
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
		} else {
			$idsize=2;
		}
		for($j=1; $j <= $idsize; $j++) {
			$total++;
			echo $parser_step_2_line_1."<br />";
			
			$xmlItem = $xmlDoc->createElement("rec");
			$xmlItem = $xmlRoot->appendChild($xmlItem);
			$xmlItem->setAttribute('T', $q++);
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
	} else {
		echo 'Fail: (multi-input,changing item) not set<br />';
	}
}

// -- $foodstuffs --
echo '<h3><a href="" target="_blank">Foodstuff</a></h3>';
$q=0;
for($i=0; $i <= count($foodstuffs)-1; $i++) {
	$parser_step_1 = explode("|", $foodstuffs[$i]);

	$parser_step_2_line_1 = $parser_step_1[0];
	$parser_step_2_line_2 = $parser_step_1[1];
	$parser_step_2_line_3 = $parser_step_1[2];
	$parser_step_2_line_4 = explode(",", $parser_step_1[3]);
	$parser_step_2_line_5 = explode(",", $parser_step_1[4]);
	$parser_step_2_line_6 = explode(",", $parser_step_1[5]);
	$total++;
	echo $parser_step_2_line_1."<br />";

	$xmlItem = $xmlDoc->createElement("rec");
	$xmlItem = $xmlRoot->appendChild($xmlItem);
	$xmlItem->setAttribute('FS', $q++);
	$xmlItem->appendChild($xmlDoc->createElement('o', $parser_step_2_line_1));
	$xmlItem->appendChild($xmlDoc->createElement('noo', $parser_step_2_line_2));
	$xmlItem->appendChild($xmlDoc->createElement('rt', $parser_step_2_line_3));
	$xmlItem->appendChild($xmlDoc->createElement('tl', $parser_step_2_line_4[0]));
	$xmlItem->appendChild($xmlDoc->createElement('tm', $parser_step_2_line_4[1]));
	$xmlItem->appendChild($xmlDoc->createElement('tr', $parser_step_2_line_4[2]));
	$xmlItem->appendChild($xmlDoc->createElement('l', $parser_step_2_line_5[0]));
	$xmlItem->appendChild($xmlDoc->createElement('m', $parser_step_2_line_5[1]));
	$xmlItem->appendChild($xmlDoc->createElement('r', $parser_step_2_line_5[2]));
	$xmlItem->appendChild($xmlDoc->createElement('bl', $parser_step_2_line_6[0]));
	$xmlItem->appendChild($xmlDoc->createElement('b', $parser_step_2_line_6[1]));
	$xmlItem->appendChild($xmlDoc->createElement('br', $parser_step_2_line_6[2]));
}

// -- $tools --
echo '<h3><a href="" target="_blank">Tools: '.count($tools).'</a></h3>';
$q=0;
for($i=0; $i <= count($tools)-1; $i++) {
	$parser_step_1 = explode("|", $tools[$i]);

	$parser_step_2_line_1 = $parser_step_1[0];
	$parser_step_2_line_2 = $parser_step_1[1];
	$parser_step_2_line_3 = $parser_step_1[2];
	$parser_step_2_line_4 = explode(",", $parser_step_1[3]);
	$parser_step_2_line_5 = explode(",", $parser_step_1[4]);
	$parser_step_2_line_6 = explode(",", $parser_step_1[5]);

	echo $parser_step_2_line_1."<br />";
	$total++;
	
	$xmlItem = $xmlDoc->createElement("rec");
	$xmlItem = $xmlRoot->appendChild($xmlItem);
	$xmlItem->setAttribute('T', $q++);
	$xmlItem->appendChild($xmlDoc->createElement('o', $parser_step_2_line_1));
	$xmlItem->appendChild($xmlDoc->createElement('noo', $parser_step_2_line_2));
	$xmlItem->appendChild($xmlDoc->createElement('rt', $parser_step_2_line_3));
	$xmlItem->appendChild($xmlDoc->createElement('tl', $parser_step_2_line_4[0]));
	$xmlItem->appendChild($xmlDoc->createElement('tm', $parser_step_2_line_4[1]));
	$xmlItem->appendChild($xmlDoc->createElement('tr', $parser_step_2_line_4[2]));
	$xmlItem->appendChild($xmlDoc->createElement('l', $parser_step_2_line_5[0]));
	$xmlItem->appendChild($xmlDoc->createElement('m', $parser_step_2_line_5[1]));
	$xmlItem->appendChild($xmlDoc->createElement('r', $parser_step_2_line_5[2]));
	$xmlItem->appendChild($xmlDoc->createElement('bl', $parser_step_2_line_6[0]));
	$xmlItem->appendChild($xmlDoc->createElement('b', $parser_step_2_line_6[1]));
	$xmlItem->appendChild($xmlDoc->createElement('br', $parser_step_2_line_6[2]));
}

// -- $combat --
echo '<h3><a href="http://minecraft.gamepedia.com/Crafting/Combat" target="_blank">Combat: '.count($combat).'</a></h3>';
// output| NumberOfOutput | RecipeType | multi-input,changing item |topleft, topmiddle, topright | left, middle, right | bottomleft, bottom, bottomright

// default = 0, multi-input with multi-output = 1, multi-input with static output = 2
$q=0;
for($i=0; $i <= count($combat)-1; $i++) {
	$parser_step_1 = explode("|", $combat[$i]);

	$parser_step_2_line_1 = $parser_step_1[0];
	$parser_step_2_line_2 = $parser_step_1[1];
	$parser_step_2_line_3 = $parser_step_1[2];
	$parser_step_2_line_4 = explode(",", $parser_step_1[3]);
	$parser_step_2_line_5 = explode(",", $parser_step_1[4]);
	$parser_step_2_line_6 = explode(",", $parser_step_1[5]);
	$parser_step_2_line_7 = explode(",", $parser_step_1[6]);
	if ($parser_step_2_line_4[0] == '0') {//Default
		echo $parser_step_2_line_1."<br />";
		$total++;
		$xmlItem = $xmlDoc->createElement("rec");
		$xmlItem = $xmlRoot->appendChild($xmlItem);
		$xmlItem->setAttribute('C', $q++);
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
	} elseif ($parser_step_2_line_4[0] == '1') {//Static output with dynamic input
		$total++;
		echo $parser_step_2_line_1."<br />";
		$xmlItem = $xmlDoc->createElement("rec");
		$xmlItem = $xmlRoot->appendChild($xmlItem);
		$xmlItem->setAttribute('C', $q++);
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
		} else {
			$idsize=2;
		}
		for($j=1; $j <= $idsize; $j++) {
			$total++;
			echo $parser_step_2_line_1."<br />";
			
			$xmlItem = $xmlDoc->createElement("rec");
			$xmlItem = $xmlRoot->appendChild($xmlItem);
			$xmlItem->setAttribute('C', $q++);
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
	} else {
		echo 'Fail: not set<br />';
	}
}

// -- $brewing --
echo '<h3><a href="http://minecraft.gamepedia.com/Brewing" target="_blank">Brewing: '.count($brewing).'</a></h3>';
$q=0;
for($i=0; $i <= count($brewing)-1; $i++) {
	$parser_step_1 = explode("|", $brewing[$i]);

	$parser_step_2_line_1 = $parser_step_1[0];
	$parser_step_2_line_2 = $parser_step_1[1];
	$parser_step_2_line_3 = $parser_step_1[2];
	$parser_step_2_line_4 = explode(",", $parser_step_1[3]);
	$parser_step_2_line_5 = explode(",", $parser_step_1[4]);
	$parser_step_2_line_6 = explode(",", $parser_step_1[5]);

	echo $parser_step_2_line_1."<br />";

	$xmlItem = $xmlDoc->createElement("rec");
	$xmlItem = $xmlRoot->appendChild($xmlItem);
	$xmlItem->setAttribute('B', $q++);
	$xmlItem->appendChild($xmlDoc->createElement('o', $parser_step_2_line_1));
	$xmlItem->appendChild($xmlDoc->createElement('noo', $parser_step_2_line_2));
	$xmlItem->appendChild($xmlDoc->createElement('rt', $parser_step_2_line_3));
	$xmlItem->appendChild($xmlDoc->createElement('tl', $parser_step_2_line_4[0]));
	$xmlItem->appendChild($xmlDoc->createElement('tm', $parser_step_2_line_4[1]));
	$xmlItem->appendChild($xmlDoc->createElement('tr', $parser_step_2_line_4[2]));
	$xmlItem->appendChild($xmlDoc->createElement('l', $parser_step_2_line_5[0]));
	$xmlItem->appendChild($xmlDoc->createElement('m', $parser_step_2_line_5[1]));
	$xmlItem->appendChild($xmlDoc->createElement('r', $parser_step_2_line_5[2]));
	$xmlItem->appendChild($xmlDoc->createElement('bl', $parser_step_2_line_6[0]));
	$xmlItem->appendChild($xmlDoc->createElement('b', $parser_step_2_line_6[1]));
	$xmlItem->appendChild($xmlDoc->createElement('br', $parser_step_2_line_6[2]));
}

// -- $materials --
echo '<h3><a href="http://minecraft.gamepedia.com/Crafting/Materials" target="_blank">Materials: '.count($materials).'</a></h3>';
// output| NumberOfOutput | RecipeType | multi-input,changing item |topleft, topmiddle, topright | left, middle, right | bottomleft, bottom, bottomright

// default = 0, multi-input with multi-output = 1, multi-input with static output = 2
$q=0;
for($i=0; $i <= count($materials)-1; $i++) {
	$parser_step_1 = explode("|", $materials[$i]);

	$parser_step_2_line_1 = $parser_step_1[0];
	$parser_step_2_line_2 = $parser_step_1[1];
	$parser_step_2_line_3 = $parser_step_1[2];
	$parser_step_2_line_4 = explode(",", $parser_step_1[3]);
	$parser_step_2_line_5 = explode(",", $parser_step_1[4]);
	$parser_step_2_line_6 = explode(",", $parser_step_1[5]);
	$parser_step_2_line_7 = explode(",", $parser_step_1[6]);
	if ($parser_step_2_line_4[0] == '0') {//Default
		echo $parser_step_2_line_1."<br />";
		$total++;
		$xmlItem = $xmlDoc->createElement("rec");
		$xmlItem = $xmlRoot->appendChild($xmlItem);
		$xmlItem->setAttribute('C', $q++);
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
	} elseif ($parser_step_2_line_4[0] == '1') {//Static output with dynamic input
		$total++;
		echo $parser_step_2_line_1."<br />";
		$xmlItem = $xmlDoc->createElement("rec");
		$xmlItem = $xmlRoot->appendChild($xmlItem);
		$xmlItem->setAttribute('C', $q++);
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
		} else {
			$idsize=2;
		}
		for($j=1; $j <= $idsize; $j++) {
			$total++;
			echo $parser_step_2_line_1."<br />";
			
			$xmlItem = $xmlDoc->createElement("rec");
			$xmlItem = $xmlRoot->appendChild($xmlItem);
			$xmlItem->setAttribute('C', $q++);
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
	} else {
		echo 'Fail: not set<br />';
	}
}

// -- $miscellaneous --
echo '<h3><a href="http://minecraft.gamepedia.com/Crafting/Miscellaneous" target="_blank">Miscellaneous: '.count($miscellaneous).'</a></h3>';
// output| NumberOfOutput | RecipeType | multi-input,changing item |topleft, topmiddle, topright | left, middle, right | bottomleft, bottom, bottomright

// default = 0, multi-input with multi-output = 1, multi-input with static output = 2
$q=0;
for($i=0; $i <= count($miscellaneous)-1; $i++) {
	$parser_step_1 = explode("|", $miscellaneous[$i]);

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
		$xmlItem->setAttribute('M', $q++);
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
		if($parser_step_2_line_4[1]=='35' or $parser_step_2_line_4[1]=='95' or $parser_step_2_line_4[1]=='351') {
			$idsize=15;
		} elseif($parser_step_2_line_4[1]=='5') {
			$idsize=5;
		} else {
			$idsize=2;
		}
		$xmlItem = $xmlDoc->createElement("rec");
		$xmlItem = $xmlRoot->appendChild($xmlItem);
		$xmlItem->setAttribute('M', $q++);
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
			$xmlItem->setAttribute('M', $q++);
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
		echo $parser_step_2_line_1."<br />";
		$xmlItem = $xmlDoc->createElement("rec");
		$xmlItem = $xmlRoot->appendChild($xmlItem);
		$xmlItem->setAttribute('M', $q++);
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

		if($parser_step_2_line_4[1]=='35' or $parser_step_2_line_4[1]=='402') {
			$idsize=15;
		} elseif($parser_step_2_line_4[1]=='5') {
			$idsize=5;
		} elseif($parser_step_2_line_4[1]=='263') {
			$idsize=1;
		} else {
			$idsize=2;
		}
		for($j=1; $j <= $idsize; $j++) {
			$total++;
			echo $parser_step_2_line_1."<br />";
			
			$xmlItem = $xmlDoc->createElement("rec");
			$xmlItem = $xmlRoot->appendChild($xmlItem);
			$xmlItem->setAttribute('M', $q++);
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
	} elseif ($parser_step_2_line_4[0] == '3') {
		$total++;
		echo $parser_step_2_line_1."<br />";
		$xmlItem = $xmlDoc->createElement("rec");
		$xmlItem = $xmlRoot->appendChild($xmlItem);
		$xmlItem->setAttribute('M', $q++);
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
				$xmlItem->setAttribute('M', $q++);
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

$xmlDoc->save("crafting.xml");
$total_array = count($building_blocks)+count($decoration_blocks)+count($redstone)+count($transportation)+count($foodstuffs)+count($tools)+count($combat)+count($brewing)+count($materials)+count($miscellaneous);
echo "<h1>Done: ".$total."!</h1>";
?>