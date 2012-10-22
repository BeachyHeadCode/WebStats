<form name="playersearch" method="post" action="index.php?mode=show-player">
	<p>
		<div onmousedown="return false;" onselectstart="return false;" style="cursor:url(images/cursors/default.cur), auto;"><span>Player Search:</span></div>
		<input name="user" type="text" id="user" value="<?php if(!isset($_SESSION['user'])){}else{ echo $_SESSION['user'];} ?>" autocomplete="off"/>
	</p>
</form>
