<?php
function small_image($player) {
	$image = '<img src="include/player-image/small_player_image.php?player='.$player.'" width="15" height="15">&nbsp;';
	return $image;
}

function large_image($player) {
	$image = '<img src="include/player-image/'.WS_PHOTO_PHP_CHANGE.'.php?nick='.$player.'" width="128" height="256">';
	return $image;
}

function full_image($player) {
	$image = '<iframe frameborder="0" src="include/player-image/full_player_image.php?user='.$player.'" title="skin" width="350px" height="257px"><p>Your Browser Does Not Support \'iframes\'.</p></iframe>';
	return $image;
}
?>