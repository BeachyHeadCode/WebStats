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
for ($i=0;$i<=sizeof($downloads);$i++){	
	$tempsize = $downloads[$i]["size"];
	$tempsize = format_filesize($tempsize);
	$download_size[$i] = "$tempsize";
	$download_url[$i] =  '"'.$downloads[$i]["html_url"].'"';
}
for ($i=0;$i<=sizeof($commits);$i++){
	$commitSHA = $commits[$i]["sha"];
	$commitURL[$i] = "https://github.com/$owner/$repoName/commit/$commitSHA";
}
?>
<div style="margin: 0px auto;width: 478px;">
	<a href="http://mcstats.org/plugin/WebStats">
	<?php if (file_exists('../images/image-cache/webstats.png')){
		echo '<img alt="Graph" src="../images/image-cache/webstats.png" />';
	} else {
		echo '<img alt="Graph" src="http://mcstats.org/signature/webstats.png" />';
	}
	?>
	</a>
</div>
<p>
	<h4>Info</h4>
	<a href="http://www.xml-sitemaps.com/">Create a Sitemap to help google.</a><br />
<?php
	if(ini_get('variables_order') == "GPCS"){
		echo 'Your INI file shows variables_order = "GPCS", however we would like it to be "EGPCS"<br />';
	}
?>
</p>
<h3><a href="<?php echo $repoURL; ?>">Latest Github Activity for <?php echo $repoName; ?></a></h3>
<table>
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
				for ($i=0; $i <= 4; $i++) {
					echo "<tr><td>".$commits[$i]["commit"]["message"]."(<a href=".$commitURL[$i].">see commit</a>) -- ".$commits[$i]["author"]["login"]."</td></tr>";
				}
			?>
			</table>
		</td>
	</tr>
</table>
<div class="three columns centered">
	<iframe width="234" height="60" frameborder="0" scrolling="NO" marginwidth="0" marginheight="0" src="http://my.dot.tk/cgi-bin/amb/ambassador.dottk?nr=494109::11032956::531"></iframe>
</div>
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
					<input type="text" placeholder="e.g. Issue, enhancement, want to buy" class="eight" id="subject" disabled />
				</div>
			</div>
			<div class="row">
				<div class="two mobile-one columns">
					<label class="right inline">Message:</label>
				</div>
				<div class="ten mobile-three columns">
					<textarea placeholder="Message" class="eight" id="body" disabled></textarea>
				</div>
			</div>
			<div class="row">
				<input type="button" onselectstart="return false;" class="button" id="submit" name="submit" value="Send &raquo;" />
			</div>					
	</fieldset>
</form>
<div class="three columns centered">
	<a href="http://tool.motoricerca.info/robots-checker.phtml?checkreferer=1"><img src="http://tool.motoricerca.info/pic/valid-robots.png" border="0" alt="Valid Robots.txt" width="88" height="31"></a>
	<a href="http://internetdefenseleague.org"><img src="http://internetdefenseleague.org/images/badges/final/footer_badge.png" alt="Member of The Internet Defense League" /></a>
</div>
<script>
$('input#submit').click(function() {
    var subject = $('input#subject').val();
	var body = $('textarea#body').val();
    //send to server and process response
	window.open('mailto:admin@mrplows-server.us?subject=' + subject + '&#038;body=' + body + ')
});
</script>