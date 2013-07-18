<?php
function encrypt($item) {

		//Begin of Enemy encryption
		if ($item == "m1")			{$item = "Chicken";}
		elseif ($item == "m2")			{$item = "Cow";}
		elseif ($item == "m3")			{$item = "Creeper";}
		elseif ($item == "m4")			{$item = "Ghast";}
		elseif ($item == "m5")           {$item = "Pig";}
		elseif ($item == "m6")           {$item = "PigZombie";}
		elseif ($item == "m7")           {$item = "Sheep";}
		elseif ($item == "m8")           {$item = "Skeleton";}
		elseif ($item == "m9")           {$item = "Spider";}
		elseif ($item == "m10")           {$item = "Zombie";}
		elseif ($item == "m11")           {$item = "Wolf";}
		elseif ($item == "m12")           {$item = "Slime";}
		elseif ($item == "m13")           {$item = "Squid";}
		elseif ($item == "m14")           {$item = "Player";}
		elseif ($item == "m14")           {$item = "player";}
		elseif ($item == "m15")           {$item = "Enderman";}
		elseif ($item == "m16")           {$item = "CaveSpider";}
		elseif ($item == "m17")           {$item = "Spiderjockey";}
		elseif ($item == "m18")				{$item = "Giant";}
		elseif ($item == "m19")           {$item = "Monster";}
		elseif ($item == "m20")				{$item = "Blaze";}
		elseif ($item == "m21")						{$item = "Living Entity";}
		elseif ($item == "m22")						{$item = "Ender Dragon";}
		elseif ($item == "m23")						{$item = "Magma Cube";}
		elseif ($item == "m24")						{$item = "Silverfish";}
		elseif ($item == "m25")						{$item = "Snow Golem";}
		elseif ($item == "m26")						{$item = "Villager";}
		elseif ($item == "m27")						{$item = "Mooshroom";}
		
		//Begin of Damage encryption
		elseif ($item == "d0")						{$item = "total";}
		elseif ($item == "d1")						{$item = "drowning";}
		elseif ($item == "d2n")						{$item = "suffocation";}
		elseif ($item == "d3")						{$item = "fall";}
		elseif ($item == "d4")						{$item = "unknown";}
		elseif ($item == "d5")						{$item = "explosion";}
		else { $item = "$item";}
return $item;
}