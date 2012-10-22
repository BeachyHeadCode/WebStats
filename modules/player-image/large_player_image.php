<?php

	if (function_exists('imagecreatetruecolor'))
	{
	
	header("Content-type: image/png");

	$cache_file = 'image-cache/large_'.$_GET['nick'].'.png';
	$cache_life = '86400'; //caching time, in seconds
	$filemtime = @filemtime($cache_file);
	
	if (!$filemtime or ((time() - $filemtime) >= $cache_life))
	{
		$img=imagecreatetruecolor(16,32);
		imagealphablending($img, false);
		$transparent = imagecolorallocatealpha($img, 0, 0, 0, 127);
		imagefill($img, 0, 0, $transparent);
		imagesavealpha($img,true);
		imagealphablending($img, true);
		$im = imagecreatefrompng('http://s3.amazonaws.com/MinecraftSkins/'.$_GET['nick'].'.png');
		if(!$im) {$im = @imagecreatefrompng('http://s3.amazonaws.com/MinecraftSkins/char.png');}
		imagealphablending($im, true);
		imagecopy($img, $im, 4, 0, 8, 8, 8, 8);
		imagecopy($img, $im, 4, 8, 20, 20, 8, 12);
		imagecopy($img, $im, 4, 20, 4, 20, 4, 12);
		imagecopy($img, $im, 8, 20, 12, 20, 4, 12);
		imagecopy($img, $im, 0, 8, 44, 20, 4, 12);
		imagecopy($img, $im, 12, 8, 52, 20, 4, 12);
	
		$img_2=imagecreatetruecolor(128,256);
		imagealphablending($img_2, false);
		$transparent = imagecolorallocatealpha($img_2, 0, 0, 0, 127);
		imagefill($img_2, 0, 0, $transparent);
		imagesavealpha($img_2,true);
		imagealphablending($img_2, true);
		imagecopyresampled($img_2, $img, 0, 0, 0, 0, 128, 256, 16, 32);
		imagepng($img_2);
		imagepng($img_2, $cache_file);
		imagedestroy($img);
		imagedestroy($im);
		imagedestroy($bg);
		imagedestroy($img_2);		
	}
	else
	{	
		readfile($cache_file);	
	}
	
	}
	
?>