<?php
	if(file_exists('../config/config.php'))
		include('../config/config.php');
	else
		header("location:setup-config.php");
session_start();
error_reporting(0);
$start_time = explode(" ",microtime()); 
$start_time = $start_time[1] + $start_time[0];
include('../language/en.php');
include('../legacy/decrypt.php');
include('../include/functions.php');
require_once("../include/logonfunctions.php");
if($_GET['LOGOUT'] == 'TRUE')
	require_once('logout.php');

if(!isset($_SESSION['pml_userid'])){
	require_once('login.php');

}
else
{
?>
<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en" xmlns="http://www.w3.org/1999/xhtml"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en" xmlns="http://www.w3.org/1999/xhtml"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en" xmlns="http://www.w3.org/1999/xhtml"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" xmlns="http://www.w3.org/1999/xhtml"> <!--<![endif]-->
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
	<meta name="author" lang="en" content="cky2250 (admin@mrplows-server.us)" />
	<meta content='minecraft stats' name='description' />
	<meta content='minecraft, stats, bukkit, mrplow, cky2250' name='keywords'/>
	<title>WebStats &rsaquo; ADMIN PAGE</title>
	<link rel="stylesheet" type="text/css" href="../css/layout_admin.css"/>
	<link rel="SHORTCUT ICON" type='image/x-icon' href="../images/favicon.ico"/>
	<link rel="apple-touch-icon" href="../images/favicon.png" />
  
	<!-- Included CSS Files (Uncompressed) -->
	<link rel="stylesheet" type="text/css" href="../stylesheets/foundation.css">
	<link rel="stylesheet" type="text/css" href="../stylesheets/app.css">

	<script type="text/javascript" src="../javascripts/modernizr.foundation.js"></script>

	<!-- IE Fix for HTML5 Tags -->
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<link rel="stylesheet" href="stylesheets/general_enclosed_foundicons.css">
	<!--[if lt IE 8]>
		<link rel="stylesheet" href="../../stylesheets/general_enclosed_foundicons_ie7.css">
	<![endif]-->
	<script type="text/javascript" src='https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.js'></script>  
</head>
<body style="background-color:rgb(228, 228, 228);">
		<!--Header Start-->
		<div class="row">
			<div class="twelve columns">
				<h2>Welcome, <?php echo $_SESSION['username']; ?> to the admin page</h2>
				<hr />
			</div>
			<div class="row">
				<div class="two columns">
					<div class="head_language"><!--Languages by Google-->
						<div id="google_translate_element"></div>
						<script>
							function googleTranslateElementInit(){new google.translate.TranslateElement({pageLanguage: 'en',includedLanguages: 'en,fr,de,ko,ru,sk,es,sv',gaTrack: true,gaId: 'UA-27405484-1',layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');}
						</script>
						<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
					</div><!--End Languages by Google-->
				</div>
				<div class="two columns">
					<div id="bookmarklet">
						<div onmousedown="return false;" onselectstart="return false;" '.default.'>Drag to your bookmarks bar:<br /><br /></div>
						<a href="<?php echo curPageURL();?>" <?php echo (hover);?>>ADMIN PAGE</a>
					</div>
				</div>
			</div>
      	
		<!--Header End-->
		<div class="row">
			<div class="nav-bar">
				<li><a href="../"><?php echo translate(var6);?></a></li>
				<li><a href="ip.php">IP Tracker</a></li>
				<li><a href="setup-config.php">Installer</a></li>
				<li><a href="#">Settings</a></li>
				<li><a href="achievements-install/index.php">Achievement - Installer</a></li>
				<li align="right"><a href="?LOGOUT=TRUE">LOGOUT</a></li>
			</div>
		</div>
		<div class="row" style="background-image: url(../images/table_bg.png);"> <!--MAIN-->
			<div style="margin:25px;">
		<p>
				This page is in the making. And will contain all the help information and locations needed. Along with more advance config settings. This will also require mysql write support since it will be used to make logon user and pass. And then read from that.
			</p>
<p>
<?php
function get_json($url){
  $base = "https://api.github.com/";
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $base . $url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

   //curl_setopt($curl, CONNECTTIMEOUT, 1);
  $content = curl_exec($curl);
  curl_close($curl);
  return $content;
}
$user='cky2250';
function get_repo($user) {
	// Get the json from github for the repos
    $json = json_decode(get_json("users/$user/repos"),true);
	// Sort the array returend by name
	function compare_names($a, $b){
		return strcmp($a['name'], $b['name']);
	}
	usort($json, 'compare_names');
	while (list($key, $value) = each($json))
		if($value["name"]=="WebStats")
			$json = $json[$key];
			
return $json; //returns the array of WebStats.
}
function get_user_data($user) {
	$data = json_decode(get_json("users/$user"),true);
return $data;
}
function get_commits($repo, $user){
  // Get the name of the repo that we'll use in the request url
  $repoName = $repo["name"];  //takes the array and only outputs the name of the repo.
  return json_decode(get_json("repos/$user/$repoName/commits"),true); //returns all commits from the repo.
}
function get_downloads($repo, $user){
	$repoName = $repo["name"];  //takes the array and only outputs the name of the repo.
return json_decode(get_json("repos/$user/$repoName/downloads"),true); // returns all the downloadable files.
}
function format_filesize($number, $decimals = 3, $force_unit = false, $dec_char = ',', $thousands_char = ' '){
//string format_filesize(int(0,) $number, (bool(0), int(0,4)) $force_unit, int $decimals, char $dec_char, char $thousands_char)
        $units = array('Byte','KB','MB','GB','TB','PB');
        if($force_unit === false)
            $unit = floor(log($number, 2) / 10);
        else
            $unit = $force_unit;
        if($unit == 0)
            $decimals = 0;
        return number_format($number / pow(1024, $unit), $decimals, $dec_char, $thousands_char).' '.$units[$unit];
}
$username="cky2250";
$repo = get_repo($username);//grabs the repo
$commits = get_commits($repo, $username); //holds all the commits from the repo
$downloads = get_downloads($repo, $username); //holds all the downloads from the repo
// Relevant information -------------------------------------
$repoURL = $repo["html_url"];
$repoName = $repo["name"];
$repoPushed = $repo["pushed_at"];
$repoForks = $repo["forks"];
$repoWatchers = $repo["watchers_count"];
$repoDescription = $repo["description"];
$repoOpen_issues = $repo["open_issues"];
$gravatar = $repo["owner"]["avatar_url"];
$owner = $repo["owner"]["login"];
$userURL = "https://github.com/$owner";
$data=get_user_data($owner);
$name=$data["name"];
$location=$data["location"];
for ($i=0;$i<=sizeof($downloads);$i++)
{	
	$tempsize = $downloads[$i]["size"];
	$tempsize = format_filesize($tempsize);
	$download_size[$i] = "$tempsize";
	$download_url[$i] =  '"'.$downloads[$i]["html_url"].'"';
}
for ($i=0;$i<=sizeof($commits);$i++)
{
	$commitSHA = $commits[$i]["sha"];
	$commitURL[$i] = "https://github.com/$owner/$repoName/commit/$commitSHA";
}
?>

<h3><a href="<?php echo $repoURL; ?>">Latest Github Activity for <?php echo $repoName; ?></a></h3>
<table >
	<tr style="vertical-align:top;">
		<td>
			<h3><a href="<?php echo $repoURL; ?>"><?php echo $repoName;?></a></h3>
		</td>
		<td>
			<div style="height:75px;width:125px;float:left;">
			Watchers: <?php echo $repoWatchers;?><br />
			Forks: <a href="https://github.com/cky2250/WebStats/network"><?php echo $repoForks;?></a><br />
			Open Issues: <a href="https://github.com/cky2250/WebStats/issues?state=open"><?php echo $repoOpen_issues;?></a><br />
			</div>
			<div style="height:75px;width:300px;float:left;">
				<a href="https://github.com/cky2250/WebStats/zipball/master">Download Latest Version RAW <?php echo file_get_contents("https://raw.github.com/cky2250/WebStats/master/include/version.yml");?></a> (<?php echo $repoPushed; ?>)<br />
				--Released--<br />
				<?php
				for ($i=0; $i <= sizeof($downloads)-1;$i++){
					echo "<a href=".$download_url[$i].">".$downloads[$i]["name"]."</a> --".$download_size[$i]."<br />";
					if($i>2)
						break;
				}
				?>
			</div>
			<div style="height:125px;width:200px;float:left;">
				<p>Author:</p>
				<div align="center">
					<img src="<?php echo $gravatar; ?>" /><br />
					<a href="<?php echo $userURL; ?>" style="vertical-align: middle;"><?php echo $owner."(".$name.") - ".$location; ?></a>
				</div>
			</div>
		</td>
	</tr>
	<tr style="vertical-align:top;">
		<td>
			<p>Description:</p>
		</td>
		<td>
			<?php echo $repoDescription; ?>
		</td>
	</tr>
	<tr style="vertical-align:top;">
		<td>
			<p>Last Commits:</p>
		</td>
		<td>
			<table>
	
<?php 
	for ($i=0; $i <= 4; $i++)
	{
		echo "<tr><td>".$commits[$i]["commit"]["message"]."(<a href=".$commitURL[$i].">see commit</a>) -- ".$commits[$i]["author"]["login"]."</td></tr>";
	}
?>
	
			</table>
		</td>
	</tr>
</table>

			<form action="" method="post" name="Email">
				<fieldset>
					<legend style="background: none;"><h4>EMAIL ANY QUESTIONS.</h4></legend>
					<div class="row">
						<div class="two mobile-one columns">
							<label class="right inline">Name:</label>
						</div>
						<div class="ten mobile-three columns">
							<input type="text" placeholder="e.g. John Doe" class="eight" disabled />
						</div>
					</div>
					<div class="row">
						<div class="two mobile-one columns">
							<label class="right inline">Email:</label>
						</div>
						<div class="ten mobile-three columns">
							<input type="text" placeholder="e.g. admin@mrplows-server.us" class="eight" disabled />
						</div>
					</div>
					<div class="row">
						<div class="two mobile-one columns">
							<label class="right inline">Subject:</label>
						</div>
						<div class="ten mobile-three columns">
							<input type="text" placeholder="e.g. Issue, enhancement, want to buy" class="eight" disabled/>
						</div>
					</div>
					<div class="row">
						<div class="two mobile-one columns">
							<label class="right inline">Message:</label>
						</div>
						<div class="ten mobile-three columns">
							<textarea placeholder="Message" class="eight" disabled></textarea>
						</div>
					</div>	
					<div class="row">
						<input type="submit" onselectstart="return false;" class="button" value="Send &raquo;" />
					</div>					
				</fieldset>
			</form>
   	  		<?php
				$time_end = explode(" ",microtime());
				$time_end = $time_end[1] + $time_end[0];
				$speed = $time_end - $start_time;
				$speed = substr($speed,0,8);
			?>
			</div>
			</div> <!--MAIN END-->
			<div class="row footer" align="center">
		<p>
			<em>
				<a href="http://www.mrplows-server.us" target="_blank">www.mrplows-server.us</a> &#169; <a href="http://forums.bukkit.org/threads/web-webstatistic-for-minecraft-v2-1-mrplows-any-build.60843/">Webstatistic v<?php include('../include/version.php'); echo $version;?></a> for <a href="http://minecraft.net">Minecraft</a>
         		<?php if(date("Y") != '2011') {echo '2011-';}?>
         		<?php echo date("Y"); ?> 
				<a href="termsofuse.php">Terms Of Use</a>
       		</em>
			&nbsp;&nbsp;&nbsp; 
       		<span style="font-size:xx-small">(Loading time: <?php echo $speed; ?>s)</span>
		</p><br/>
			</div>
</div>
  <!-- Included JS Files (Compressed) -->
  <script src="../javascripts/foundation.min.js"></script>  
  <!-- Initialize JS Plugins -->
  <script src="../javascripts/app.js"></script>
</body>
</html>
<?php } ?>