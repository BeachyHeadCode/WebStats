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
	$image = '<script type="text/javascript">
function getDocHeight(doc) {
    doc = doc || document;
    // from http://stackoverflow.com/questions/1145850/get-height-of-entire-document-with-javascript
    var body = doc.body, html = doc.documentElement;
    var height = Math.max( body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight );
    return height;
}
function setIframeHeight(id) {
    var ifrm = document.getElementById(id);
    var doc = ifrm.contentDocument? ifrm.contentDocument: ifrm.contentWindow.document;
    ifrm.style.height = "10px"; // reset to minimal height in case going from longer to shorter doc
    ifrm.style.height = getDocHeight( doc ) + 10 + "px";
}
</script>
<iframe id="ifrm1" onload="setIframeHeight(\'ifrm1\')" scrolling="no" frameborder="0" src="include/player-image/full_player_image.php?user='.$player.'" title="skin" width="350px" height="260px" style = ""><p>Your Browser Does Not Support \'iframes\'.</p></iframe>';
	return $image;
}
?>