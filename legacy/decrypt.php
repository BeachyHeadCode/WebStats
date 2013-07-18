<?php

function decrypt($item) {
		if ($item == "Air")							{$item = "0";}

		// Begin of Enemy decryption
		elseif ($item == "Chicken")					{$item = "m1";}
		elseif ($item == "Cow")						{$item = "m2";}
		elseif ($item == "Creeper")					{$item = "m3";}
		elseif ($item == "Ghast")					{$item = "m4";}
		elseif ($item == "Pig")						{$item = "m5";}
		elseif ($item == "PigZombie")				{$item = "m6";}
		elseif ($item == "Sheep")					{$item = "m7";}
		elseif ($item == "Skeleton")				{$item = "m8";}
		elseif ($item == "Spider")					{$item = "m9";}
		elseif ($item == "Zombie")					{$item = "m10";}
		elseif ($item == "Wolf")					{$item = "m11";}
		elseif ($item == "Slime")					{$item = "m12";}
		elseif ($item == "Squid")					{$item = "m13";}
		elseif ($item == "Player")					{$item = "m14";}
		elseif ($item == "player")					{$item = "m14";}
		elseif ($item == "Enderman")				{$item = "m15";}
		elseif ($item == "CaveSpider")				{$item = "m16";}
		elseif ($item == "Spiderjockey")			{$item = "m17";}
		elseif ($item == "Giant")					{$item = "m18";}
		elseif ($item == "Monster")					{$item = "m19";}
		elseif ($item == "Blaze")					{$item = "m20";}
		elseif ($item == "LivingEntity")			{$item = "m21";}
		elseif ($item == "EnderDragon")				{$item = "m22";}
		elseif ($item == "MagmaCube")				{$item = "m23";}
		elseif ($item == "Silverfish")				{$item = "m24";}
		elseif ($item == "Snowman")					{$item = "m25";}
		elseif ($item == "Villager")				{$item = "m26";}
		elseif ($item == "MushroomCow")				{$item = "m27";}

		// Begin of Damage decryption
		elseif ($item == "total")					{$item = "d0";}
		elseif ($item == "drowning")				{$item = "d1";}
		elseif ($item == "suffocation")				{$item = "d2";}
		elseif ($item == "fall")					{$item = "d3";}
		elseif ($item == "unknown")					{$item = "d4";}
		elseif ($item == "explosion")				{$item = "d5";}
		elseif ($item == "firetick")				{$item = "d6";}
		elseif ($item == "unknown")					{$item = "d7";}
		elseif ($item == "CACTUS")					{$item = "81";}
		elseif ($item == "Arrow")					{$item = "262";}
		elseif ($item == "(null)")					{$item = "d4";}
		elseif ($item == "fire")					{$item = "10";}
		elseif ($item == "Fireball")				{$item = "10";}
		elseif ($item == "Fish")					{$item = "349";}
		elseif ($item == "Entity")					{$item = "m18";}
		elseif ($item == "entityattack")			{$item = "m18";}
		elseif ($item == "Snowball")				{$item = "332";}
		elseif ($item == "TNTPrimed")				{$item = "46";}
		elseif ($item == "Egg")						{$item = "344";}
		
		else {$item = "$item";}
		return $item;
}