<form name="playersearch" method="post" action="index.php?mode=show-player">
	<input name="user" type="text" id="user" value="<?php if(!isset($_SESSION['user'])){}else{ echo $_SESSION['user'];} ?>" placeholder="Player Search..." autocomplete="off"/>
</form>
