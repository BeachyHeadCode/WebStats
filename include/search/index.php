<form name="playersearch" method="post" action="index.php?mode=show-player">
	<div class="row collapse prefix-radius">
		<div class="small-2 columns"><span class="prefix"><i class="fi-torso"></i></span></div>
		<div class="small-10 columns"><input name="user" type="text" id="user" value="<?php if(!isset($_SESSION['user'])){}else{ echo $_SESSION['user'];} ?>" placeholder="Player Search..." autocomplete="off" /></div>
	</div>
</form>