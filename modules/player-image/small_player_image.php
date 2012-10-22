<?php
	if (function_exists('imagecreatetruecolor'))
	{

	$player = $_GET['player'];
	
	$cache_file = 'image-cache/'.$player.'.png';
	$cache_life = 86400; //caching time, in seconds
	$filemtime = @filemtime($cache_file);
	
	if (!$filemtime or (time() - $filemtime >= $cache_life))
	//if (!file_exists($cache_file))
	{
		$img=imagecreatetruecolor(8,8);
		imagealphablending($img, false);
		$transparent = imagecolorallocatealpha($img, 0, 0, 0, 127);
		imagefill($img, 0, 0, $transparent);
		imagesavealpha($img,true);
		imagealphablending($img, true);
		$im = @imagecreatefrompng('http://s3.amazonaws.com/MinecraftSkins/'.$player.'.png');
		if(!$im) {$im = imagecreatefrompng('http://s3.amazonaws.com/MinecraftSkins/char.png');}
		imagealphablending($im, true);
		imagecopy($img, $im, 0, 0, 8, 8, 8, 8);
		
		imagepng($img);
		imagepng($img, $cache_file);
		imagedestroy($img);
		imagedestroy($im);			
	}
	else
	{	
		readfile($cache_file);
	}
	
	}
?>