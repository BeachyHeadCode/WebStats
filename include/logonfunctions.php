<?php
include("../../config/config.php");
include("../../../language/en.php");
ERROR_REPORTING(E_ALL);

// VARS
// $_SESSION['pml_userid']  ==> the PhpMyLogon userID (only if user is logged on)
// $_SESSION['pml_userrank'] ==> the rank (0=defuser) of the PML user (only if logged on)

// How to use pml_checklogin()?
// pml_checklogin([page to go to when user is not logged in],[minimum required rank])
// The minimum rank is default 0 when there is nothing given (eg. when using like: pml_checklogin("notloggedin.php");).
function pml_checklogin($goto,$status = "0") {
	ob_start();
	if(!isset($_SESSION)) {exit(translate('sessionproblem'));}
	
	if(isset($_SESSION['pml_userid'])) {
		if($_SESSION['pml_userrank'] >= $status) {
			// User logged in with right rank; everything OK, continue
			$link = mysqli_connect(WS_MySQL_DBHOST, WS_MySQL_USERNAME, WS_MySQL_PASSWORD, WS_MySQL_DB, WS_MySQL_PORT);
			mysqli_query($link, "UPDATE `users` SET `lastactive` = NOW() WHERE `id` = '".$_SESSION['pml_userid']."' LIMIT 1");
			mysqli_close($link);
		} else {
			header("Location: ".$goto);
		}
	} elseif(isset($_COOKIE['pml_userid_cookie'])) {
		// Check cookie
		// Check cookie data with data in database
		$link = mysqli_connect('p:'.WS_MySQL_DBHOST, WS_MySQL_USERNAME, WS_MySQL_PASSWORD, WS_MySQL_DB, WS_MySQL_PORT);
		
		$sql = "SELECT * FROM `users` WHERE `id` = '".$_COOKIE['pml_userid_cookie']."' LIMIT 1";
		$query = mysqli_query($link, $sql);
		if(mysqli_num_rows($query) == 1) {
			// User exists
			$row = mysqli_fetch_array($query);
			$id = htmlspecialchars($row['id']);
			$username = htmlspecialchars($row['username']);
			$password_db = htmlspecialchars($row['password']);
			$cookie_pass = htmlspecialchars($row['cookie_pass']);
			$actcode = htmlspecialchars($row['actcode']);
			$rank = htmlspecialchars($row['rank']);
			
			if($actcode == "") {
				// Useraccount is activated
				if($cookie_pass == $_COOKIE['pml_usercode_cookie']) {
					// Everything ok, create sessions
					$_SESSION['pml_userid'] = $id;
					$_SESSION['pml_userrank'] = $rank;
					
					header("Location: ".$_SERVER['REQUEST_URI']);
				} else {
					// Incorrect password
					setcookie("pml_userid_cookie", "", time() - 3600);
					setcookie("pml_usercode_cookie", "", time() - 3600);
					header("Location: ".$_SERVER['REQUEST_URI']);
				}
			} else {
				setcookie("pml_userid_cookie", "", time() - 3600);
				setcookie("pml_usercode_cookie", "", time() - 3600);
				header("Location: ".$_SERVER['REQUEST_URI']);
			}
		} else {
			// User doesn't exists
			setcookie("pml_userid_cookie", "", time() - 3600);
			setcookie("pml_usercode_cookie", "", time() - 3600);
			header("Location: ".$_SERVER['REQUEST_URI']);
		}
		mysqli_close($link);	
	} else {
		// No user logged in
		header("Location: ".$goto);
	}
	ob_end_flush();
}
// # How to use the function pml_login()?
// pml_login([what to do (include|redirect)],[which page])
// When a user is logged in, a message will be displayed that the user is logged in. If you want to redirect the user to a page,
// or if you want to include a page (p.e. a menu), then you can use the function on another way.

//# To INCLUDE A PAGE when the user is LOGGED IN use:
// pml_login('include','path-to-include.php');
// Where pagetoinclude.php the page is which should be included (tip: check on the included page if the user is logged on!)
// When using include, you have to referer to the page from the folder where the PhpMyLogon file is placed. If you have for example PhpMyLogon placed in the folder
// 'pml', and you use it from the root, you have to use ../filename.php if the file is also in the root folder.

// # To REDIRECT when the user is LOGGED IN use:
// pml_login('redirect','redirecttothispage.php');
// Where redirecttothispage.php the page is where the user will be redirected to (tip: check on the redirected page if the user is logged on!)
// When using redirect, you should referer to the page as you should do when you would redirect it from the page where you include PhpMyLogon. This is different then when
// you use the include function!!
function pml_login($todo = "",$action = "") {
	ob_start();
	if(!isset($_SESSION)) { exit(translate('sessionproblem')); }

	$link = mysqli_connect('p:'.WS_MySQL_DBHOST, WS_MySQL_USERNAME, WS_MySQL_PASSWORD, WS_MySQL_DB, WS_MySQL_PORT);
	
	// Check if user is logged in
	if(!isset($_SESSION['pml_userid'])) {
		if(isset($_COOKIE['pml_userid_cookie'])) {
			// Check cookie data with data in database
			$sql = "SELECT `id`,`username`,`password`,`cookie_pass`,`actcode`,`rank` FROM `users` WHERE `id` = '".$_COOKIE['pml_userid_cookie']."' LIMIT 1";
			$query = mysqli_query($link, $sql);
			if(mysqli_num_rows($query) == 1) {
				// User exists
				$row = mysqli_fetch_array($query);
				$id = htmlspecialchars($row['id']);
				$username = htmlspecialchars($row['username']);
				$password_db = htmlspecialchars($row['password']);
				$cookie_pass = htmlspecialchars($row['cookie_pass']);
				$actcode = htmlspecialchars($row['actcode']);
				$rank = htmlspecialchars($row['rank']);
				
				if($actcode == "") {
					// Useraccount is activated
					if($cookie_pass == $_COOKIE['pml_usercode_cookie']) {
						// Everything ok, create sessions
						$_SESSION['pml_userid'] = $id;
						$_SESSION['pml_userrank'] = $rank;
						
						$sql_updateonline = "UPDATE `users` SET `lastactive` = NOW() AND `lastlogin` = NOW() WHERE `id` = '".$id."' LIMIT 1";
						mysqli_query($link, $sql_updateonline);
						
						header("Location: ".$_SERVER['REQUEST_URI']);
					} else {
						// Incorrect password
						setcookie("pml_userid_cookie", "", time() - 3600);
						setcookie("pml_usercode_cookie", "", time() - 3600);
						header("Location: ".$_SERVER['REQUEST_URI']);
					}
				} else {
					setcookie("pml_userid_cookie", "", time() - 3600);
					setcookie("pml_usercode_cookie", "", time() - 3600);
					header("Location: ".$_SERVER['REQUEST_URI']);
				}
			} else {
				// User doesn't exists
				setcookie("pml_userid_cookie", "", time() - 3600);
				setcookie("pml_usercode_cookie", "", time() - 3600);
				header("Location: ".$_SERVER['REQUEST_URI']);
			}
		
		}
			
		if(isset($_POST['submit'])) {
			if($_POST['username'] != "" AND $_POST['password'] != "") {
				// Check submitted data with data in database
				$sql = "SELECT * FROM `users` WHERE `username` = '".$_POST['username']."' LIMIT 1";
				$query = mysqli_query($link, $sql);
				if(mysqli_num_rows($query) == 1) {
					// User exists
					$row = mysqli_fetch_array($query, MYSQLI_BOTH);
					$id = htmlspecialchars($row['id']);
					$username = htmlspecialchars($row['username']);
					$password_db = htmlspecialchars($row['password']);
					$cookie_pass = htmlspecialchars($row['cookie_pass']);
					$actcode = htmlspecialchars($row['actcode']);
					$rank = htmlspecialchars($row['rank']);
					
					if($actcode == "") {
						// User account is activated
						if($password_db == md5($_POST['password'])) {
							// Everything ok, create sessions
							$_SESSION['pml_userid'] = $id;
							$_SESSION['pml_userrank'] = $rank;
							if(isset($_POST['cookie'])) {
								// Also create cookie
								setcookie("pml_userid_cookie", $id, time() + 365 * 86400);
								if($cookie_pass == "") {
									// Create cookie code
									mt_srand((double)microtime()*1000000);
									$pass = 1;
									while(strlen($pass) <= 10) {
										$i = chr(mt_rand(0,255));
										if(eregi("^[a-z0-9]$",$i)) {
											$pass = $pass.$i;
										}
									}
									$cookie_pass = md5($pass);
									$sql_cookiepass = "UPDATE `users` SET `cookie_pass` = '".$cookie_pass."' WHERE `id` = ".$id." LIMIT 1";
									mysqli_query($link, $sql_cookiepass);
								}
								setcookie("pml_usercode_cookie", $cookie_pass, time() + 365 * 86400);
							}
							mysqli_query($link, "UPDATE `users` SET `lastactive` = NOW(),`lastlogin` = NOW() WHERE `id` = '".$id."' LIMIT 1") or trigger_error(mysqli_error($link));
							
							header("Location: ".$_SERVER['REQUEST_URI']);
						} else {
							// Incorrect password
							echo "<div class='row'>".translate('login-incorrect')."</div>";
						}
					} else {
						echo "<div class='row'>".translate('login-notactive')."</div>";
					}
				} else {
					// User doesn't exists
					echo "<div class='row'>".translate('login-incorrect')."</div>";
				}
				
				
			} else {
				echo "<div class='row'>".translate('login-forgotfield')."</div>";
			}
		}
		
		// Login form
		?>
		<form method="post" style="margin-left: auto; margin-right: auto; width:355px;" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
			<table>
				<tr>
					<td><label for="username"><?php echo translate('login-username'); ?>:</label></td>
					<td><input size="32" maxlength="32" placeholder="admin" type="text" id="username" name="username" <?php if(isset($_POST['username'])) { echo 'value="'.$_POST['username'].'"'; } ?> /></td>
				</tr>
				<tr>
					<td><label for="password"><?php echo translate('login-password'); ?>:</label></td>
					<td><input size="24" maxlength="24" placeholder="password" type="password" id="password" name="password" <?php if(isset($_POST['password'])) { echo 'value="'.$_POST['password'].'"'; } ?> /></td>
				</tr>
				<tr>
					<td style="text-align: right;"><input type="checkbox" id="cookie" name="cookie" value="true" <?php if(isset($_POST['cookie'])) { echo "checked"; } ?> /></td>
					<td><label for="cookie"><?php echo translate('login-cookie'); ?></label></td>
				</tr>
				<tr>
					<td></td>
					<td><input class="button" type="submit" name="submit" value="<?php echo translate('login-submitbutton'); ?>" /></td>
				</tr>
			</table>
		</form>
		<?php
		
	} else {
		// User is logged on, redirect to page $goto; if no $goto just view msg that user is logged in
		if($todo != "") {
			if($todo == "include") {
				include($action);
			} elseif($todo == "redirect") {
				header("Location: ".$action);
			} else {
				echo "<div class='row'>".translate('functionproblem')."</div>";
			}
		}else{
			echo "<div class='row'>".translate('login-already')."</div>";
		}
	}
	mysqli_close($link);
	ob_end_flush();
}
// If you want the user to go to an other page when logged out, use pml_logout('pagetogoto.php'). Else just use pml_logout().
function pml_logout($goto = "") {
	ob_start();
	if(!isset($_SESSION)) { exit(translate('sessionproblem')); }
	
	if(isset($_SESSION['pml_userid'])) {
		if(isset($_COOKIE['pml_userid_cookie'])) {
			// Remove cookies if any
			setcookie("pml_userid_cookie", "", time() - 3600);
			setcookie("pml_usercode_cookie", "", time() - 3600);
		}
		session_unset();
		session_destroy(); 
		
		if($goto == "") {
			echo "<div class='row'>".translate('logout-ok')."</div>";
		} else {
			header("Location: ".$goto);
		}
	} else {
		echo "<div class='row'>".translate('logout-nologin')."</div>";
	}
	
	ob_end_flush();
}

// If you have pages that don't have to be secured, but you still want to let the user online in the who's online list, use this function.
function pml_updateonline(){
	// should update lastactive in the database
	// just pml_updateonline()
}

function pml_forgotpass(){
	// should give a form for filling in emailaddress and/or username
	// then e-mail a new password to the user, and set the user to non-active
	// maybe use something like pml_forgotpass('url_to_activate_page')
}

function pml_onlineusers(){
	// view all online users
	// something like: SELECT username FROM pml_table WHERE DATE_SUB(NOW(),INTERVAL 5 MINUTE) <= lastactive ORDER BY lastactive DESC
	// or something like that
	// just pml_onlineusers()
}

function pml_registrate(){
	// Registration form
	// check for already existing usernames, email
	// Create an activation code
	// E-mail user a link with the activation code 
	// maybe use something like pml_registrate('url_to_activate_page')
	
}

function pml_activate(){
	// Page for activating after forgotpass or registrating
	// set active = 1 and blank actcode
	// just pml_activate()
}

function pml_options(){
	// let user change his options (password, email (re-activate it for security reasons), ...)
	// just pml_options()
}

function pml_admin(){
	// check from config which rank is admin, and check if user is admin (security)
	// search for an user (username/emailaddress)
	// edit users
	// delete users
}
?>