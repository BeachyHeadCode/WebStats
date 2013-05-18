<?php
function small_image($player) {
	$image = '<img src="modules/player-image/small_player_image.php?player='.$player.'" width="15" height="15">&nbsp;';
	return $image;
}

function large_image($player) {
	$image = '<img src="modules/player-image/'.WS_PHOTO_PHP_CHANGE.'.php?nick='.$player.'" width="128" height="256">';
	return $image;
}

function full_image($player) {
	$image = '<img src="modules/player-image/full_player_image.php?user='.$player.'" width="350" height="275">';
	return $image;
}
?>