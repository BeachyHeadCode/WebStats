<?php
if(basename(__FILE__) == basename($_SERVER['PHP_SELF'])){exit();}
$username="MrPlow254";
$client_id="69af938b474a7afeedf0";
$client_secret="1bb24a05256b654cc5887c9d2d461bf5f5b5d6d5";

function get_json($url, $client_id, $client_secret) {
	$base = "https://api.github.com/";
	if(function_exists('curl_init')) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $base . $url . '?client_id=' . $client_id . '&client_secret=' . $client_secret);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]);

		//curl_setopt($curl, CONNECTTIMEOUT, 1);
		$content = curl_exec($curl);
		curl_close($curl);
	} else {
		echo 'Error: curl_init function does not exist';
		$content = 'Error: curl_init function does not exist';
	}
  return $content;
}

function get_repo($user, $client_id, $client_secret) {
	if(function_exists('json_decode')) {
		// Get the json from github for the repos
		$json = json_decode(get_json("users/$user/repos", $client_id, $client_secret),true);
		// Sort the array returend by name
		function compare_names($a, $b) {
			return strcmp($a['name'], $b['name']);
		}
		usort($json, 'compare_names');
		while (list($key, $value) = each($json))
			if($value["name"]=="WebStats")
				$json = $json[$key];
	} else {
		echo 'Error: json_decode function does not exist';
		$json = 'Error: json_decode function does not exist';
	}
	return $json; //returns the array of WebStats.
}
function get_user_data($user, $client_id, $client_secret) {
	$data = json_decode(get_json("users/$user", $client_id, $client_secret),true);
	return $data;
}
function get_commits($repo, $user, $client_id, $client_secret) {
  // Get the name of the repo that we'll use in the request url
  $repoName = $repo["name"];  //takes the array and only outputs the name of the repo.
  return json_decode(get_json("repos/$user/$repoName/commits", $client_id, $client_secret),true); //returns all commits from the repo.
}
function get_downloads($repo, $user, $client_id, $client_secret) {
	$repoName = $repo["name"];  //takes the array and only outputs the name of the repo.
	return json_decode(get_json("repos/$user/$repoName/downloads", $client_id, $client_secret),true); // returns all the downloadable files.
}
function format_filesize($number, $decimals = 3, $force_unit = false, $dec_char = ',', $thousands_char = ' ') {
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

//API rate limit exceeded
$json = json_decode(get_json("users/$username/repos", $client_id, $client_secret),true);
$json = substr($json["message"],0,23);

if($json!='API rate limit exceeded') {
	$repook=true;
	$repo = get_repo($username, $client_id, $client_secret);//grabs the repo
	$commits = get_commits($repo, $username, $client_id, $client_secret); //holds all the commits from the repo
	$downloads = get_downloads($repo, $username, $client_id, $client_secret); //holds all the downloads from the repo
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
	$data=get_user_data($owner, $client_id, $client_secret);
	$name=$data["name"];
	$location=$data["location"];
	for ($i=0;$i<=sizeof($downloads);$i++) {	
		$tempsize = $downloads[$i]["size"];
		$tempsize = format_filesize($tempsize);
		$download_size[$i] = "$tempsize";
		$download_url[$i] =  '"'.$downloads[$i]["html_url"].'"';
	}
	for ($i=0;$i<=sizeof($commits);$i++){
		$commitSHA = $commits[$i]["sha"];
		$commitURL[$i] = "https://github.com/$owner/$repoName/commit/$commitSHA";
	}
} else {
	$repook=false;
}
?>
<div class="small-12 columns small-centered">
	<center>
		<a href="http://mcstats.org/plugin/WebStats" target="_blank">
		<?php if (file_exists('../images/image-cache/webstats.png')) {
			echo '<img alt="Graph" src="../images/image-cache/webstats.png" width="473px" />';
		} else {
			echo '<img alt="Graph" src="http://mcstats.org/signature/webstats.png" width="473px" />';
		}
		?>
		</a>
	</center>
</div>
<p>
	<h4>Info</h4>
	<a href="http://www.xml-sitemaps.com/" target="_blank">Create a Sitemap to help google.</a><br />
	<?php
	if (!function_exists('imagecreatetruecolor')) {echo "<br /><b>PHP GD is not installed or corrupt:</b> <br />For linux users, 'sudo apt-get install php5-gd' then restart apache.<br />";}
	if (!function_exists('curl_init')) {echo "<br /><b>PHP Curl is not installed or corrupt:</b> <br />For linux users, 'sudo apt-get install php5-curl' then restart apache.<br />";}	
	if (ini_get('variables_order') == "GPCS") {echo '<br />Your INI file shows variables_order = "GPCS", however we would like it to be "EGPCS"<br />';}
	?>
</p>
<h3><a href="<?php echo $repoURL; ?>" target="_blank">Latest Github Activity for <?php echo $repoName; ?></a></h3>
<?php if($repook===true) { ?>
<table>
	<tr colspan="2">
		<td>
			<h3><a href="<?php echo $repoURL; ?>" target="_blank"><?php echo $repoName;?></a></h3>
		</td>
		<td>
			Watchers: <?php echo $repoWatchers;?><br />
			Forks: <a href="https://github.com/<?php echo $username;?>/WebStats/network" target="_blank"><?php echo $repoForks;?></a><br />
			Open Issues: <a href="https://github.com/<?php echo $username;?>/WebStats/issues?state=open" target="_blank"><?php echo $repoOpen_issues;?></a><br />
		</td>
		<td>
			<a href="https://github.com/<?php echo $username;?>/WebStats/zipball/master" target="_blank">Download Latest Version RAW <?php echo file_get_contents("https://raw.github.com/".$username."/WebStats/master/include/version.yml");?></a><br />(<?php echo $repoPushed; ?>)<br />
			--Released--<br />
			<?php
			for ($i=0; $i <= sizeof($downloads)-1;$i++){
				echo "<a href=".$download_url[$i]." target='_blank'>".$downloads[$i]["name"]."</a> --".$download_size[$i]."<br />";
				if($i>2)
					break;
			}
			?>
		</td>
		<td>
			<p>Author:</p>
			<div align="center">
				<img src="<?php echo $gravatar; ?>" width="80px" /><br />
				<a href="<?php echo $userURL; ?>" style="vertical-align: middle;" target="_blank"><?php echo $owner."(".$name.") - ".$location; ?></a>
			</div>
		</td>
	</tr>
	<tr style="vertical-align:top;">
		<td>
			<p>Description:</p>
		</td>
		<td colspan="3">
			<?php echo $repoDescription; ?>
		</td>
	</tr>
	<tr style="vertical-align:top;">
		<td>
			<p>Last Commits:</p>
		</td>
		<td colspan="3">
			<table>
			<?php 
				for ($i=0; $i <= 4; $i++) {
					echo "<tr><td>".$commits[$i]["commit"]["message"]."(<a href=".$commitURL[$i]." target='_blank'>see commit</a>) -- ".$commits[$i]["author"]["login"]."</td></tr>";
				}
			?>
			</table>
		</td>
	</tr>
</table>
<?php
} else {
	echo $json;
}
?>
<div class="small-3 columns small-centered">
	<a href="http://tool.motoricerca.info/robots-checker.phtml?checkreferer=1" target="_blank"><img src="http://tool.motoricerca.info/pic/valid-robots.png" border="0" alt="Valid Robots.txt" width="88" height="31"></a>
	<a href="http://internetdefenseleague.org" target="_blank"><img src="http://internetdefenseleague.org/images/badges/final/footer_badge.png" alt="Member of The Internet Defense League" /></a>
</div>
<form action="" method="post" name="Email">
	<fieldset>
		<legend style="background: none;"><h4>EMAIL ANY QUESTIONS.</h4></legend>
			<div class="row">
				<div class="two mobile-one columns">
					<label class="right inline">Name:</label>
				</div>
				<div class="ten mobile-three columns">
					<input type="text" placeholder="e.g. John Doe" class="eight" id="name" />
				</div>
			</div>
			<div class="row">
				<div class="two mobile-one columns">
					<label class="right inline">Subject:</label>
				</div>
				<div class="ten mobile-three columns">
					<input type="text" placeholder="e.g. Issue, enhancement, want to buy" class="eight" id="subject" />
				</div>
			</div>
			<div class="row">
				<div class="two mobile-one columns">
					<label class="right inline">Message:</label>
				</div>
				<div class="ten mobile-three columns">
					<textarea placeholder="Message" class="eight" id="body"></textarea>
					<!--<input type="text" placeholder="Message" class="eight" id="body" />-->
				</div>
			</div>
			<div class="row">
				<input type="button" onselectstart="return false;" class="button" id="submit" value="Send &raquo;" />
			</div>					
	</fieldset>
</form>

<script>
$('input#submit').click(function() {
    var subject = $('input#subject').val();
	var body = $('textarea#body').val();
	var name = $('input#name').val();
    //send to server and process response
	window.open('mailto:admin@mrplows-server.tk?subject=' + subject + '&body=' + body + ' Thanks, ' + name)
});
</script>