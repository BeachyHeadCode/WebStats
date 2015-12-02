<?php
//http://minecraft.gamepedia.com/Smelting 12/1/15

$smelting	=	array(
	//--- Ores & Materials ---
	'265|15,263',//Iron Ingot
	'266|14,263',//Gold Ingot
	'20|12,263',//Glass
	'1|4,263',//Stone
	'336|337,263',//Clay Brick
	'405|87,263',//Nether Brick
	'172|82,263',//Hardened Clay
	'98-2|98,263',//Cracked Stone Bricks
	'264|56,263',//Diamond Gem
	'351-4|21,263',//Lapis Lazuli
	'331|73,263',//Redstone Dust
	'263|16,263',//Coal
	'388|129,263',//Emerald
	'406|153,263',//Nether Quartz
	'263-1|17,263',//Charcoal
	'263-1|17-1,263',//Charcoal
	'263-1|17-2,263',//Charcoal
	'263-1|17-3,263',//Charcoal
	'263-1|17-4,263',//Charcoal
	'263-1|17-5,263',//Charcoal
	'351-2|81,263',//Cactus Green
	'19|19-2,263',//Sponge
	//---END Ores & Materials ---
	//--- FOOD ---
	'320|319,263',//Cooked Porkchop
	'364|363,263',//Steak
	'366|365,263',//Cooked Chicken
	'350|349,263',//Cooked Fish
	'393|392,263',//Baked Potato
	'350-1|349-1,263',//Cooked Salmon
	'424|423,263',//Cooked Mutton
	'412|411,263',//Cooked Rabbit
	//--- END FOOD ---
);

$xmlDoc = new DOMDocument('1.0', 'UTF-8');
$xmlDoc->formatOutput = true;
$xmlDoc->preserveWhiteSpace = false;

$xmlRoot = $xmlDoc->createElement("SmeltingItems");
$xmlRoot = $xmlDoc->appendChild($xmlRoot);

$q=0;
for($i=1; $i <= count($smelting); $i++) {


	$parser_step_1 = explode("|", $smelting[$i]);
	
	$parser_step_2_line_1 = $parser_step_1[0];
	$parser_step_2_line_2 = explode(",", $parser_step_1[1]);	
	
	
	echo $parser_step_2_line_1."<br />";
	
	
	$xmlItem = $xmlDoc->createElement("SmeltingItem");
	$xmlItem = $xmlRoot->appendChild($xmlItem);
	$xmlItem->setAttribute('SmeltNumber', $q++);
	$xmlItem->appendChild($xmlDoc->createElement('Output', $parser_step_2_line_1));
	$xmlItem->appendChild($xmlDoc->createElement('NumberOfOutput', '1'));
	$xmlItem->appendChild($xmlDoc->createElement('Input1', $parser_step_2_line_2[0]));
	$xmlItem->appendChild($xmlDoc->createElement('Input2', $parser_step_2_line_2[1]));
}

$xmlDoc->save("smelting.xml");
echo "Done!";
?>