<?php
// DEFAULT LANGUAGE FILE PHPMYLOGON
// English
function translate($item)
{
		$item = decrypt($item);
		
		if ($item == "0")			{$item = "Air";}
		elseif ($item == "1")			{$item = "Stone";}
		elseif ($item == "2")			{$item = "Grass";}
		elseif ($item == "3")			{$item = "Dirt";}
		elseif ($item == "3")			{$item = "Dirt";}
		elseif ($item == "4")			{$item = "Cobblestone";}
		elseif ($item == "5")			{$item = "Wooden Plank";}
		elseif ($item == "6")			{$item = "Sapling";}
		elseif ($item == "6:1")		{$item = "Redwood Sapling";}
		elseif ($item == "6:2")         {$item = "Birch Sapling";}
		elseif ($item == "7")			{$item = "Bedrock";}
		elseif ($item == "8")			{$item = "Water";}
		elseif ($item == "9")           {$item = "Stationary Water";}
		elseif ($item == "10")		{$item = "Lava";}
		elseif ($item == "11")		{$item = "Stationary Lava";}
		elseif ($item == "12")		{$item = "Sand";}
		elseif ($item == "13")		{$item = "Gravel";}
		elseif ($item == "14")		{$item = "Gold Ore";}
		elseif ($item == "15")		{$item = "Iron Ore";}
		elseif ($item == "16")		{$item = "Coal Ore";}
		elseif ($item == "17")          {$item = "Wood";}
		elseif ($item == "17:1")        {$item = "Redwood";}
		elseif ($item == "17:2")        {$item = "Birchwood";}
		elseif ($item == "18")          {$item = "Leaves";}
		elseif ($item == "18:1")        {$item = "Redwood Leaves";}
		elseif ($item == "18:2")        {$item = "Birchwood Leaves";}
		elseif ($item == "19")          {$item = "Sponge";}
		elseif ($item == "20")          {$item = "Glass";}
		elseif ($item == "21")          {$item = "Lapis Lazuli Ore";}
		elseif ($item == "22")          {$item = "Lapis Lazuli Block";}
		elseif ($item == "23")          {$item = "Dispenser";}
		elseif ($item == "24")          {$item = "Sandstone";}
		elseif ($item == "25")          {$item = "Note Block";}
		elseif ($item == "26")          {$item = "Bed Block";}
		elseif ($item == "27")          {$item = "Powered Rail";}
		elseif ($item == "28")          {$item = "Detector Rail";}
		elseif ($item == "29")          {$item = "Sticky Piston";}
		elseif ($item == "30")          {$item = "Web";}
		elseif ($item == "31")          {$item = "Dead Shrub";}
		elseif ($item == "31:1")        {$item = "Tall Grass";}
		elseif ($item == "31:2")        {$item = "Live Shrub";}
		elseif ($item == "32")          {$item = "Dead Shrub";}
		elseif ($item == "33")          {$item = "Piston";}
		elseif ($item == "34")          {$item = "Piston Head";}
		elseif ($item == "35")          {$item = "White Wool";}
		elseif ($item == "35:1")        {$item = "Orange Wool";}
		elseif ($item == "35:2")        {$item = "Magenta Wool";}
		elseif ($item == "35:3")        {$item = "Light Blue Wool";}
		elseif ($item == "35:4")        {$item = "Yellow Wool";}
		elseif ($item == "35:5")        {$item = "Light Green Wool";}
		elseif ($item == "35:6")        {$item = "Pink Wool";}
		elseif ($item == "35:7")        {$item = "Gray Wool";}
		elseif ($item == "35:8")        {$item = "Light Gray Wool";}
		elseif ($item == "35:9")        {$item = "Cyan Wool";}
		elseif ($item == "35:10")       {$item = "Purple Wool";}
		elseif ($item == "35:11")       {$item = "Blue Wool";}
		elseif ($item == "35:12")       {$item = "Brown Wool";}
		elseif ($item == "35:13")       {$item = "Dark Green Wool";}
		elseif ($item == "35:14")       {$item = "Red Wool";}
		elseif ($item == "35:15")       {$item = "Black Wool";}
		elseif ($item == "37")          {$item = "Dandelion";}
		elseif ($item == "38")          {$item = "Rose";}
		elseif ($item == "39")          {$item = "Brown Mushroom";}
		elseif ($item == "40")          {$item = "Red Mushroom";}
		elseif ($item == "41")          {$item = "Gold Block";}
		elseif ($item == "42")          {$item = "Iron Block";}
		elseif ($item == "43")          {$item = "Double Stone Slab";}
		elseif ($item == "43:1")        {$item = "Double Sandstone Slab";}
		elseif ($item == "43:2")        {$item = "Double Wooden Slab";}
		elseif ($item == "43:3")        {$item = "Double Cobblestone Slab";}
		elseif ($item == "43:4")        {$item = "Double Brick Slab";}
		elseif ($item == "43:5")        {$item = "Double Stone Brick Slab";}
		elseif ($item == "44")          {$item = "Stone Slab";}
		elseif ($item == "44:1")        {$item = "Sandstone Slab";}
		elseif ($item == "44:2")        {$item = "Wooden Slab";}
		elseif ($item == "44:3")        {$item = "Cobblestone Slab";}
		elseif ($item == "44:4")        {$item = "Brick Slab";}
		elseif ($item == "44:5")        {$item = "Stone Brick Slab";}
		elseif ($item == "45")          {$item = "Brick";}
		elseif ($item == "46")          {$item = "TNT";}
		elseif ($item == "47")          {$item = "Bookshelf";}
		elseif ($item == "48")          {$item = "Mossy Cobblestone";}
		elseif ($item == "49")          {$item = "Obsidian";}
		elseif ($item == "50")          {$item = "Torch";}
		elseif ($item == "51")          {$item = "Fire";}
		elseif ($item == "52")          {$item = "Monster Spawner";}
		elseif ($item == "53")          {$item = "Wooden Stairs";}
		elseif ($item == "54")          {$item = "Chest";}
		elseif ($item == "55")          {$item = "Redstone Wire";}
		elseif ($item == "56")          {$item = "Diamond Ore";}
		elseif ($item == "57")          {$item = "Diamond Block";}
		elseif ($item == "58")          {$item = "Workbench";}
		elseif ($item == "59")          {$item = "Wheat Crops";}
		elseif ($item == "60")          {$item = "Soil";}
		elseif ($item == "61")          {$item = "Furnace";}
		elseif ($item == "62")          {$item = "Burning Furnace";}
		elseif ($item == "63")          {$item = "Sign Post";}
		elseif ($item == "64")          {$item = "Wooden Door Block";}
		elseif ($item == "65")          {$item = "Ladder";}
		elseif ($item == "66")          {$item = "Rails";}
		elseif ($item == "67")          {$item = "Cobblestone Stairs";}
		elseif ($item == "68")          {$item = "Wall Sign";}
		elseif ($item == "69")          {$item = "Lever";}
		elseif ($item == "70")          {$item = "Stone Pressure Plate";}
		elseif ($item == "71")          {$item = "Iron Door Block";}
		elseif ($item == "72")          {$item = "Wooden Pressure Plate";}
		elseif ($item == "73")          {$item = "Redstone Ore";}
		elseif ($item == "74")          {$item = "Glowing Redstone Ore";}
		elseif ($item == "75")          {$item = "Redstone Torch (off)";}
		elseif ($item == "76")          {$item = "Redstone Torch (on)";}
		elseif ($item == "77")          {$item = "Stone Button";}
		elseif ($item == "78")          {$item = "Snow";}
		elseif ($item == "79")          {$item = "Ice";}
		elseif ($item == "80")          {$item = "Snow Block";}
		elseif ($item == "81")          {$item = "Cactus";}
		elseif ($item == "82")          {$item = "Clay";}
		elseif ($item == "83")          {$item = "Sugar Cane";}
		elseif ($item == "84")          {$item = "Jukebox";}
		elseif ($item == "85")          {$item = "Fence";}
		elseif ($item == "86")          {$item = "Pumpkin";}
		elseif ($item == "87")          {$item = "Netherrack";}
		elseif ($item == "88")          {$item = "Soul Sand";}
		elseif ($item == "89")          {$item = "Glowstone";}
		elseif ($item == "90")          {$item = "Portal";}
		elseif ($item == "91")          {$item = "Jack-O-Lantern";}
		elseif ($item == "92")          {$item = "Cake Block";}
		elseif ($item == "93")          {$item = "Redstone Repeater Block (off)";}
		elseif ($item == "94")          {$item = "Redstone Repeater Block (on)";}
		elseif ($item == "95")          {$item = "Locked Chest";}
		elseif ($item == "96")          {$item = "Trapdoor";}
		elseif ($item == "97")          {$item = "Stone (Silverfish)";}
		elseif ($item == "97:1")        {$item = "Cobblestone (Silverfish)";}
		elseif ($item == "97:2")        {$item = "Stone Brick (Silverfish)";}
		elseif ($item == "98")          {$item = "Stone Brick";}
		elseif ($item == "98:1")        {$item = "Mossy Stone Brick";}
		elseif ($item == "98:2")        {$item = "Cracked Stone Brick";}
		elseif ($item == "99")          {$item = "Red Mushroom Cap";}
		elseif ($item == "100")         {$item = "Brown Mushroom Cap";}
		elseif ($item == "100:1")       {$item = "Brown Mushroom Cap";}
		elseif ($item == "100:2")       {$item = "Brown Mushroom Cap";}
		elseif ($item == "100:3")       {$item = "Brown Mushroom Cap";}
		elseif ($item == "100:4")       {$item = "Brown Mushroom Cap";}
		elseif ($item == "100:5")       {$item = "Brown Mushroom Cap";}
		elseif ($item == "100:6")        {$item = "Brown Mushroom Cap";}
		elseif ($item == "100:7")         {$item = "Brown Mushroom Cap";}
		elseif ($item == "100:8")           {$item = "Brown Mushroom Cap";}
		elseif ($item == "100:9")           {$item = "Brown Mushroom Cap";}
		elseif ($item == "100:10")           {$item = "Brown Mushroom Stem";}
		elseif ($item == "101")           {$item = "Iron Bars";}
		elseif ($item == "102")           {$item = "Glass Pane";}
		elseif ($item == "103")           {$item = "Melon Block";}
		elseif ($item == "104")           {$item = "Pumpkin Stem";}
		elseif ($item == "104:1")           {$item = "Pumpkin Stem - Stage 1";}
		elseif ($item == "104:2")           {$item = "Pumpkin Stem - Stage 2";}
		elseif ($item == "104:3")           {$item = "Pumpkin Stem - Stage 3";}
		elseif ($item == "104:4")           {$item = "Pumpkin Stem - Stage 4";}
		elseif ($item == "104:5")           {$item = "Pumpkin Stem - Stage 5";}
		elseif ($item == "104:6")           {$item = "Pumpkin Stem - Stage 6";}
		elseif ($item == "104:7")           {$item = "Pumpkin Stem - Stage 7";}
		elseif ($item == "105")           {$item = "Melon Stem";}
		elseif ($item == "105:1")           {$item = "Melon Stem - Stage 1";}
		elseif ($item == "105:2")           {$item = "Melon Stem - Stage 2";}
		elseif ($item == "105:3")           {$item = "Melon Stem - Stage 3";}
		elseif ($item == "105:4")           {$item = "Melon Stem - Stage 4";}
		elseif ($item == "105:5")           {$item = "Melon Stem - Stage 5";}
		elseif ($item == "105:6")           {$item = "Melon Stem - Stage 6";}
		elseif ($item == "105:7")           {$item = "Melon Stem - Stage 7";}
		elseif ($item == "106")           {$item = "Vines";}
		elseif ($item == "106:1")           {$item = "Vines - South";}
		elseif ($item == "106:2")           {$item = "Vines - West";}
		elseif ($item == "106:4")           {$item = "Vines - North";}
		elseif ($item == "106:8")           {$item = "Vines - East";}
		elseif ($item == "107")           {$item = "Fence Gate";}
		elseif ($item == "107:1")           {$item = "Fence Gate - West";}
		elseif ($item == "107:2")           {$item = "Fence Gate - North";}
		elseif ($item == "107:3")           {$item = "Fence Gate - East";}
		elseif ($item == "108")           {$item = "Brick Stairs";}
		elseif ($item == "109")           {$item = "Stone Brick Stairs";}
		elseif ($item == "110")           {$item = "Mycelium";}
		elseif ($item == "111")           {$item = "Lily Pad";}
		elseif ($item == "112")           {$item = "Nether Brick";}
		elseif ($item == "113")           {$item = "Nether Brick Fence";}
		elseif ($item == "114")           {$item = "Nether Brick Stairs";}
		elseif ($item == "115")           {$item = "Nether Wart";}
		elseif ($item == "116")           {$item = "Enchantment Table";}
		elseif ($item == "117")           {$item = "Brewing Stand - Block";}
		elseif ($item == "118")           {$item = "Cauldron - Block";}
		elseif ($item == "119")           {$item = "End Portal - Block";}
		elseif ($item == "120")           {$item = "End Portal Frame";}
		elseif ($item == "121")           {$item = "End Stone";}
		elseif ($item == "122")           {$item = "Dragon Egg";}
		elseif ($item == "123")           {$item = "Redstone Lamp (inactive)";}
		elseif ($item == "124")           {$item = "Redstone Lamp (active)";}
		elseif ($item == "200")           {$item = "Ender Crystal";}
		elseif ($item == "256")           {$item = "Iron Shovel";}
		elseif ($item == "257")           {$item = "Iron Pickaxe";}
		elseif ($item == "258")           {$item = "Iron Axe";}
		elseif ($item == "259")           {$item = "Flint and Steel";}
		elseif ($item == "260")           {$item = "Apple";}
		elseif ($item == "261")           {$item = "Bow";}
		elseif ($item == "262")           {$item = "Arrow";}
		elseif ($item == "263")           {$item = "Coal";}
		elseif ($item == "263:1")         {$item = "Charcoal";}
		elseif ($item == "264")           {$item = "Diamond";}
		elseif ($item == "265")           {$item = "Iron Ingot";}
		elseif ($item == "266")           {$item = "Gold Ingot";}
		elseif ($item == "267")           {$item = "Iron Sword";}
		elseif ($item == "268")           {$item = "Wooden Sword";}
		elseif ($item == "269")           {$item = "Wooden Shovel";}
		elseif ($item == "270")           {$item = "Wooden Pickaxe";}
		elseif ($item == "271")           {$item = "Wooden Axe";}
		elseif ($item == "272")           {$item = "Stone Sword";}
		elseif ($item == "273")           {$item = "Stone Shovel";}
		elseif ($item == "274")           {$item = "Stone Pickaxe";}
		elseif ($item == "275")           {$item = "Stone Axe";}
		elseif ($item == "276")           {$item = "Diamond Sword";}
		elseif ($item == "277")           {$item = "Diamond Shovel";}
		elseif ($item == "278")           {$item = "Diamond Pickaxe";}
		elseif ($item == "279")           {$item = "Diamond Axe";}
		elseif ($item == "280")           {$item = "Stick";}
		elseif ($item == "281")           {$item = "Bowl";}
		elseif ($item == "282")           {$item = "Mushroom Soup";}
		elseif ($item == "283")           {$item = "Gold Sword";}
		elseif ($item == "284")           {$item = "Gold Shovel";}
		elseif ($item == "285")           {$item = "Gold Pickaxe";}
		elseif ($item == "286")           {$item = "Gold Axe";}
		elseif ($item == "287")           {$item = "String";}
		elseif ($item == "288")           {$item = "Feather";}
		elseif ($item == "289")           {$item = "Sulphur";}
		elseif ($item == "290")           {$item = "Wooden Hoe";}
		elseif ($item == "291")           {$item = "Stone Hoe";}
		elseif ($item == "292")           {$item = "Iron Hoe";}
		elseif ($item == "293")           {$item = "Diamond Hoe";}
		elseif ($item == "294")           {$item = "Gold Hoe";}
		elseif ($item == "295")           {$item = "Wheat Seeds";}
		elseif ($item == "296")           {$item = "Wheat";}
		elseif ($item == "297")           {$item = "Bread";}
		elseif ($item == "298")           {$item = "Leather Helmet";}
		elseif ($item == "299")           {$item = "Leather Chestplate";}
		elseif ($item == "300")           {$item = "Leather Leggings";}
		elseif ($item == "301")           {$item = "Leather Boots";}
		elseif ($item == "302")           {$item = "Chainmail Helmet";}
		elseif ($item == "303")           {$item = "Chainmail Chestplate";}
		elseif ($item == "304")           {$item = "Chainmail Leggings";}
		elseif ($item == "305")           {$item = "Chainmail Boots";}
		elseif ($item == "306")           {$item = "Iron Helmet";}
		elseif ($item == "307")           {$item = "Iron Chestplate";}
		elseif ($item == "308")           {$item = "Iron Leggings";}
		elseif ($item == "309")           {$item = "Iron Boots";}
		elseif ($item == "310")           {$item = "Diamond Helmet";}
		elseif ($item == "311")           {$item = "Diamond Chestplate";}
		elseif ($item == "312")           {$item = "Diamond Leggings";}
		elseif ($item == "313")           {$item = "Diamond Boots";}
		elseif ($item == "314")           {$item = "Gold Helmet";}
		elseif ($item == "315")           {$item = "Gold Chestplate";}
		elseif ($item == "316")           {$item = "Gold Leggings";}
		elseif ($item == "317")           {$item = "Gold Boots";}
		elseif ($item == "318")           {$item = "Flint";}
		elseif ($item == "319")           {$item = "Raw Porkchop";}
		elseif ($item == "320")           {$item = "Cooked Porkchop";}
		elseif ($item == "321")           {$item = "Painting";}
		elseif ($item == "322")           {$item = "Golden Apple";}
		elseif ($item == "323")           {$item = "Sign";}
		elseif ($item == "324")           {$item = "Wooden Door";}
		elseif ($item == "325")           {$item = "Bucket";}
		elseif ($item == "326")           {$item = "Water Bucket";}
		elseif ($item == "327")           {$item = "Lava Bucket";}
		elseif ($item == "328")           {$item = "Minecart";}
		elseif ($item == "329")           {$item = "Saddle";}
		elseif ($item == "330")           {$item = "Iron Door";}
		elseif ($item == "331")           {$item = "Redstone";}
		elseif ($item == "332")           {$item = "Snowball";}
		elseif ($item == "333")           {$item = "Boat";}
		elseif ($item == "334")           {$item = "Leather";}
		elseif ($item == "335")           {$item = "Milk Bucket";}
		elseif ($item == "336")           {$item = "Clay Brick";}
		elseif ($item == "337")           {$item = "Clay Balls";}
		elseif ($item == "338")           {$item = "Sugarcane";}
		elseif ($item == "339")           {$item = "Paper";}
		elseif ($item == "340")           {$item = "Book";}
		elseif ($item == "341")           {$item = "Slimeball";}
		elseif ($item == "342")           {$item = "Storage Minecart";}
		elseif ($item == "343")           {$item = "Powered Minecart";}
		elseif ($item == "344")           {$item = "Egg";}
		elseif ($item == "345")           {$item = "Compass";}
		elseif ($item == "346")           {$item = "Fishing Rod";}
		elseif ($item == "347")           {$item = "Clock";}
		elseif ($item == "348")           {$item = "Glowstone Dust";}
		elseif ($item == "349")           {$item = "Raw Fish";}
		elseif ($item == "350")           {$item = "Cooked Fish";}
		elseif ($item == "351")           {$item = "Ink Sack";}
		elseif ($item == "351:1")           {$item = "Rose Red";}
		elseif ($item == "351:2")           {$item = "Cactus Green";}
		elseif ($item == "351:3")           {$item = "Coco Beans";}
		elseif ($item == "351:4")           {$item = "Lapis Lazuli";}
		elseif ($item == "351:5")           {$item = "Purple Dye";}
		elseif ($item == "351:6")           {$item = "Cyan Dye";}
		elseif ($item == "351:7")           {$item = "Light Gray Dye";}
		elseif ($item == "351:8")           {$item = "Gray Dye";}
		elseif ($item == "351:9")           {$item = "Pink Dye";}
		elseif ($item == "351:10")           {$item = "Lime Dye";}
		elseif ($item == "351:11")           {$item = "Dandelion Yellow";}
		elseif ($item == "351:12")           {$item = "Light Blue Dye";}
		elseif ($item == "351:13")           {$item = "Magenta Dye";}
		elseif ($item == "351:14")           {$item = "Orange Dye";}
		elseif ($item == "351:15")           {$item = "Bone Meal";}
		elseif ($item == "352")           		{$item = "Bone";}
		elseif ($item == "353")           {$item = "Sugar";}
		elseif ($item == "354")           {$item = "Cake";}
		elseif ($item == "355")           {$item = "Bed";}
		elseif ($item == "356")           {$item = "Redstone Repeater";}
		elseif ($item == "357")           {$item = "Cookie";}
		elseif ($item == "358")           {$item = "Map";}
		elseif ($item == "359")           {$item = "Shears";}
		elseif ($item == "360")           {$item = "Melon";}
		elseif ($item == "361")           {$item = "Pumpkin Seeds";}
		elseif ($item == "362")           {$item = "Melon Seeds";}
		elseif ($item == "363")           {$item = "Raw Beef";}
		elseif ($item == "364")           {$item = "Steak";}
		elseif ($item == "365")           {$item = "Raw Chicken";}
		elseif ($item == "366")           {$item = "Cooked Chicken";}
		elseif ($item == "367")           {$item = "Rotten Flesh";}
		elseif ($item == "368")           {$item = "Ender Pearl";}
		elseif ($item == "369")           {$item = "Blaze Rod";}
		elseif ($item == "370")           {$item = "Ghast Tear";}
		elseif ($item == "371")				{$item = "Gold Nugget";}
		elseif ($item == "372")				{$item = "Nether Wart Seeds";}
		//------------------------------- START POTIONS -----------------------------------------
		elseif ($item == "373")				{$item = "Potion";}
		//--------- BASE POTIONS ---------
		elseif ($item == "373:0")			{$item = "Water Bottle";}
		elseif ($item == "373:16")			{$item = "Awkward Potion";}
		elseif ($item == "373:32")			{$item = "Thick Potion";}
		elseif ($item == "373:64")			{$item = "Mundane Potion (extended)";}
		elseif ($item == "373:8192")		{$item = "Mundane Potion";}
		// --------------------- PRIMARY POTIONS ---------------------
		//--------- POSITIVE EFFECTS ---------
		elseif ($item == "373:8193")		{$item = "Potion of Regeneration";}
		elseif ($item == "373:8257")		{$item = "Potion of Regeneration (extended)";}
		elseif ($item == "373:8255")		{$item = "Potion of Regeneration II";}
		elseif ($item == "373:8194")		{$item = "Potion of Swiftness";}
		elseif ($item == "373:8258")		{$item = "Potion of Swiftness (extended)";}
		elseif ($item == "373:8226")		{$item = "Potion of Swiftness II";}
		elseif ($item == "373:8195")		{$item = "Potion of Fire Resistance";}
		elseif ($item == "373:8259")		{$item = "Potion of Fire Resistance (extended)";}
		elseif ($item == "373:8227")		{$item = "Potion of Fire Resistance II (reverted)";}
		elseif ($item == "373:8197")		{$item = "Potion of Healing";}
		elseif ($item == "373:8261")		{$item = "Potion of Healing (reverted)";}
		elseif ($item == "373:8229")		{$item = "Potion of Healing II";}
		elseif ($item == "373:8198")		{$item = "Potion of Night Vision";}
		elseif ($item == "373:8262")		{$item = "Potion of Night Vision";}
		elseif ($item == "373:8201")		{$item = "Potion of Strength";}
		elseif ($item == "373:8265")		{$item = "Potion of Strength";}
		elseif ($item == "373:8233")		{$item = "Potion of Strength II";}
		elseif ($item == "373:8206")		{$item = "Potion of Invisibility";}
		elseif ($item == "373:8270")		{$item = "Potion of Invisibility";}
		//--------- NEGATIVE EFFECTS ---------
		elseif ($item == "373:8196")		{$item = "Potion of Poison";}
		elseif ($item == "373:8260")		{$item = "Potion of Poison";}
		elseif ($item == "373:8228")		{$item = "Potion of Poison II";}
		elseif ($item == "373:8200")		{$item = "Potion of Weakness";}
		elseif ($item == "373:8264")		{$item = "Potion of Weakness";}
		elseif ($item == "373:8232")		{$item = "Potion of Weakness II (reverted)";}
		elseif ($item == "373:8202")		{$item = "Potion of Slowness";}
		elseif ($item == "373:8266")		{$item = "Potion of Slowness";}
		elseif ($item == "373:8234")		{$item = "Potion of Slowness II (reverted)";}
		elseif ($item == "373:8204")		{$item = "Potion of Harming";}
		elseif ($item == "373:8268")		{$item = "Potion of Harming (reverted)";}
		elseif ($item == "373:8236")		{$item = "Potion of Harming II";}
		//--------- UNBREWABLE POTIONS ---------
		elseif ($item == "373:8289")		{$item = "Potion of Regeneration II (extended)";}
		elseif ($item == "373:8290")		{$item = "Potion of Swiftness II (extended)";}
		elseif ($item == "373:8297")		{$item = "Potion of Strength II (extended)";}
		elseif ($item == "373:8292")		{$item = "Potion of Poison II (extended)";}
		//------------------------------- END POTIONS -----------------------------------------
		elseif ($item == "374")				{$item = "Glass Bottle";}
		elseif ($item == "375")				{$item = "Spider Eye";}
		elseif ($item == "376")				{$item = "Fermented Spider Eye";}
		elseif ($item == "377")				{$item = "Blaze Powder";}
		elseif ($item == "378")           {$item = "Magma Cream";}
		elseif ($item == "379")           {$item = "Brewing Stand";}
		elseif ($item == "380")           {$item = "Cauldron";}
		elseif ($item == "381")           {$item = "Eye of Ender";}
		elseif ($item == "382")           {$item = "Glistering Melon";}
		elseif ($item == "383")           {$item = "Spawn Egg ";}
		elseif ($item == "384")           {$item = "Bottle o' Enchanting";}
		elseif ($item == "385")           {$item = "Fire Charge";}
		elseif ($item == "2256")           {$item = "Gold Music Disc";}
		elseif ($item == "2257")           {$item = "Green Music Disc";}
		elseif ($item == "2258")           {$item = "Blocks Disc";}
		elseif ($item == "2259")           {$item = "Chirp Disc";}
		elseif ($item == "2260")           {$item = "Far Disc";}
		elseif ($item == "2261")           {$item = "Mall Disc";}
		elseif ($item == "2262")           {$item = "Mellohi Disc";}
		elseif ($item == "2263")           {$item = "Stal Disc";}
		elseif ($item == "2264")           {$item = "Strad Disc";}
		elseif ($item == "2265")           {$item = "Ward Disc";}
		elseif ($item == "2266")           {$item = "11 Disc";}
		
		// Begin of Enemy translation
		elseif ($item == "m1")						{$item = "Chicken";}
		elseif ($item == "m2")						{$item = "Cow";}
		elseif ($item == "m3")						{$item = "Creeper";}
		elseif ($item == "m4")						{$item = "Ghast";}
		elseif ($item == "m5")						{$item = "Pig";}
		elseif ($item == "m6")						{$item = "Pig Zombie";}
		elseif ($item == "m7")						{$item = "Sheep";}
		elseif ($item == "m8")						{$item = "Skeleton";}
		elseif ($item == "m9")						{$item = "Spider";}
		elseif ($item == "m10")						{$item = "Zombie";}
		elseif ($item == "m11")						{$item = "Wolf";}
		elseif ($item == "m12")						{$item = "Slime";}
		elseif ($item == "m13")						{$item = "Squid";}
		elseif ($item == "m14")						{$item = "Player";}
		elseif ($item == "m15")						{$item = "Enderman";}
		elseif ($item == "m16")						{$item = "Cave Spider";}
		elseif ($item == "m17")						{$item = "Spider Jockey";}
		elseif ($item == "m18")						{$item = "Entity Attack";}
		elseif ($item == "m19")						{$item = "Monster";}
		elseif ($item == "m20")						{$item = "Blaze";}
		elseif ($item == "m21")						{$item = "Living Entity";}
		elseif ($item == "m22")						{$item = "Ender Dragon";}
		elseif ($item == "m23")						{$item = "Magma Cube";}
		elseif ($item == "m24")						{$item = "Silverfish";}
		elseif ($item == "m25")						{$item = "Snow Golem";}
		elseif ($item == "m26")						{$item = "Villager";}
		elseif ($item == "m27")						{$item = "Mooshroom";}
		elseif ($item == "m28")						{$item = "Ocelot";}
		elseif ($item == "m29")						{$item = "Iron Golem";}
		elseif ($item == "m30")						{$item = "Wither";}
		elseif ($item == "m31")						{$item = "Wither Skeleton";}
		elseif ($item == "m32")						{$item = "Zombie Villager";}
		elseif ($item == "m33")						{$item = "Bat";}

		// Begin of Damagesource translation
		elseif ($item == "d0")						{$item = "Total";}
		elseif ($item == "d1")						{$item = "Drowning";}
		elseif ($item == "d2")						{$item = "Suffocation";}
		elseif ($item == "d3")						{$item = "Falling";}
		elseif ($item == "d4")						{$item = "Unknown";}
		elseif ($item == "d5")						{$item = "Explosion";}
		elseif ($item == "d6")						{$item = "Fire Stick";}
		
		// Begin of Website translation
		elseif ($item == "var1") 					{$item = "Order by name";}
		elseif ($item == "var2")					{$item = "Order by value";}
		elseif ($item == "var3") 					{$item = "Player";}
		elseif ($item == "var4") 					{$item = "Playtime";}
		elseif ($item == "var5") 					{$item = "Last Login";}
		elseif ($item == "var6") 					{$item = "Homepage";}
		elseif ($item == "var7") 					{$item = "Server statistics";}
		elseif ($item == "var8") 					{$item = "Destroyed blocks";}
		elseif ($item == "var9") 					{$item = "Placed blocks";}
		elseif ($item == "var10") 					{$item = "Received damage";}
		elseif ($item == "var11") 					{$item = "Dealt damage";}
		elseif ($item == "var12") 					{$item = "Killed";}
		elseif ($item == "var13") 					{$item = "Was killed by";}
		elseif ($item == "var14") 					{$item = "Last logout";}
		elseif ($item == "var15") 					{$item = "Status";}
		elseif ($item == "var16") 					{$item = "Deaths";}
		elseif ($item == "var17") 					{$item = "Moved";}
		elseif ($item == "var18") 					{$item = "Blocks";}
		elseif ($item == "var19") 					{$item = "Destroyed blocks";}
		elseif ($item == "var20") 					{$item = "Placed blocks";}
		elseif ($item == "var21") 					{$item = "Players killed";}
		elseif ($item == "var22") 					{$item = "Players were killed by";}
		elseif ($item == "var23") 					{$item = "Users";}
		elseif ($item == "var24") 					{$item = "Armswings";}
		elseif ($item == "var25") 					{$item = "Logins";}
		elseif ($item == "var26") 					{$item = "Opened chests";}
		elseif ($item == "var27") 					{$item = "Commands";}
		elseif ($item == "var28") 					{$item = "Messages";}
		elseif ($item == "var29") 					{$item = "Letters";}
		elseif ($item == "var30") 					{$item = "Destroyed by players";}
		elseif ($item == "var31") 					{$item = "Placed by players";}
		elseif ($item == "var32") 					{$item = "Damage by players";}
		elseif ($item == "var33") 					{$item = "Damage at players";}
		elseif ($item == "var34") 					{$item = "Jobs";}
		elseif ($item == "var35") 					{$item = "Job";}
		elseif ($item == "var36") 					{$item = "Level";}
		elseif ($item == "var37") 					{$item = "Experience";}
		elseif ($item == "var38") 					{$item = "Job level";}
		elseif ($item == "var39") 					{$item = "Job experience";}
		elseif ($item == "var40")					{$item = "Order by experience";}
		elseif ($item == "var41")					{$item = "Order by level";}
		elseif ($item == "var42")					{$item = "Who's what?";}
		elseif ($item == "var43")					{$item = "Skills";}
		elseif ($item == "var44")					{$item = "Currency";}
		elseif ($item == "var45")					{$item = "Main server currency";}
		elseif ($item == "var46")					{$item = "Small server currency";}
		elseif ($item == "var47")					{$item = "Money at server";}
		elseif ($item == "var48")					{$item = "Players average";}
		elseif ($item == "var49")					{$item = "Order by money";}
		elseif ($item == "var50")					{$item = "Credit";}
		elseif ($item == "var51")					{$item = "Players with full access";}
		elseif ($item == "var52")					{$item = "Players with limited access";}
		elseif ($item == "var53")					{$item = "Range exp.";}
		elseif ($item == "var54")					{$item = "Woodcutting exp.";}
		elseif ($item == "var55")					{$item = "Mining exp.";}
		elseif ($item == "var56")					{$item = "Combat exp.";}
		elseif ($item == "var57")					{$item = "Health exp.";}
		elseif ($item == "var58")					{$item = "Excavation exp.";}
		elseif ($item == "var59")					{$item = "Farming exp.";}
		elseif ($item == "var60")					{$item = "Forgery exp.";}
		elseif ($item == "var61")					{$item = "Scavenger exp.";}
		elseif ($item == "var62")					{$item = "Dexterity exp.";}
		elseif ($item == "var63")					{$item = "Explosives exp.";}
		elseif ($item == "var64")					{$item = "Swimming exp.";}
		elseif ($item == "var65")					{$item = "Defence exp.";}
		elseif ($item == "var66")					{$item = "Skill";}
		elseif ($item == "var67")					{$item = "Database created successfully!";}
		elseif ($item == "var68")					{$item = "Achievements";}
		elseif ($item == "var69")					{$item = "Score";}
		elseif ($item == "var70")					{$item = "Number of achievements";}
		elseif ($item == "var71")					{$item = "Page(s)";}
		elseif ($item == "var72")					{$item = "Prayer exp.";}
		elseif ($item == "var73")					{$item = "Item ID";}
		elseif ($item == "var74")					{$item = "Item Name";}
		elseif ($item == "var75")					{$item = "ID Index";}
		elseif ($item == "var76")					{$item = "Search for player";}
		elseif ($item == "var77")					{$item = "Player not found!";}
		elseif ($item == "var78")					{$item = "McMMO";}
		elseif ($item == "var79")					{$item = "InventorySQL";}
		elseif ($item == "var80")					{$item = "Achievement";}
		elseif ($item == "var81")					{$item = "Command(s)";}
		elseif ($item == "var82")					{$item = "# of Logins";}
		elseif ($item == "var83")					{$item = "Jail";}
		elseif ($item == "var84") 					{$item = "Main Site";}
		//---------------	LOGIN RELATED	--------------------------------
		elseif ($item == "login-incorrect")			{$item = "<span style='color: red;'>The username or password you entered is incorrect. Please try again.</span>";}
		elseif ($item == "login-notactive")			{$item = "<span style='color: red;'>You're account isn't activated. Please activate your account and try again. Check your inbox for an activation e-mail if you've used the Forgot password-function.</span>";}	
		elseif ($item == "sessionproblem")			{$item = "There is a problem with the sessions from PHP. Please make sure 'session_start();' is placed on the top of the page where you use PhpMyLogon!";}
		elseif ($item == "functionproblem")			{$item = "You didn't use the function as it should. Please read the readme or the text which describes the function before using it. Check if you use the right variables and names.";}
		elseif ($item == "selectdberror")			{$item = "<span style='color: red;'>There was an error while selecting the database. Please contact the webmaster (database name incorrect).</span>";}
		elseif ($item == "connecterror")			{$item = "<span style='color: red;'>There was an error while connnecting to the MySQL database. Please contact the webmaster (user, password or host incorrect).</span>";}
		elseif ($item == "login-already")			{$item = "You are logged in.";}
		elseif ($item == "login-submitbutton")		{$item = "Login";}
		elseif ($item == "login-username")			{$item = "Username";}
		elseif ($item == "login-password")			{$item = "Password";}
		elseif ($item == "login-cookie")			{$item = "Remember me";}
		elseif ($item == "login-forgotfield")		{$item = "<span style='color: red;'>You forgot to fill in one or more field(s).</span>";}
		elseif ($item == "logout-ok")				{$item = "You're logged out.";}
		elseif ($item == "logout-nologin")			{$item = "You're not logged in, so there's nothing to log out.";}
		//------------------------------------------------------------------
		else{$item ="$item";}
		
		return $item;
}
?>