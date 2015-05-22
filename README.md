<a href="https://mrplows-server.tk">WebStats</a> ~ <a href="http://forums.bukkit.org/threads/60843/">Bukkit Forum</a>
<hr />
MySQL - PHP web data page for public viewing of Minecraft plugin data
<hr />
This was based on <a href="http://forums.bukkit.org/threads/17793/">[WEB] Webstatistic for Minecraft v1.10b [1337]</a> - the code used in this is far more superior. It is being made into a Wordpress or phpwiki or any good website project that has an installer, login, admin page, and many goodies.

Beside this plugin, WS supports other plugins which collects data in MySQL databases. The following plugins are already supported:

<ul>
	<li><a href="http://dev.bukkit.org/server-mods/achievements/">Achievements</a> *WORKS (with stats)</li>
	<li><a href="http://dev.bukkit.org/server-mods/tno-achievements/">Achievements 2.0</a> *PLUGIN DOES NOT WORK IN LATTEST CRAFTBUKKIT BUILD (not WS fault)</li>
	<li>BeardAch * NOT KNOWN YET. Sorry</li>
	<li><a href="http://dev.bukkit.org/server-mods/iconomy/">iConomy</a> ~ <a href="https://github.com/iConomy/Core">GitHub</a> *WORKS</li>
	<li><a href="http://dev.bukkit.org/server-mods/iconomy-continued/">iConomy [Continued]</a> ~ <a href="https://github.com/rtainc/iCo">GitHub</a> *WORKS</li>
	<li><a href="http://dev.bukkit.org/server-mods/jail/">Jail</a> ~ <a href="https://github.com/matejdro/Jail">GitHub</a> * WORKS</li>
	<li>Add <a href="http://dev.bukkit.org/server-mods/jailplusplus/">Jail ++</a> ~ <a href="https://github.com/UltimateDev/jailplusplus/">GitHub</a></li>
	<li><a href="http://dev.bukkit.org/server-mods/jobs/">Jobs</a> ~ <a href="https://github.com/phrstbrn/Jobs">GitHub</a> *WORKS</li>
	<li><a href="http://dev.bukkit.org/server-mods/mcmmo/">McMMO</a> ~ <a href="https://github.com/mcMMO-Dev/mcMMO">GitHub</a> *WORKS</li>
	<li><a href="http://dev.bukkit.org/server-mods/mineconomy/">MineConomy</a> ~ <a href="https://github.com/MjolnirCommando/MineConomy">GitHub</a> *WORKS</li>
	<li><a href="http://dev.bukkit.org/server-mods/stats/">Stats</a> *WORKS (In Build 1.1-R6)</li>
	<li><a href="http://dev.bukkit.org/server-mods/tno-stats/">Stats 2.0</a> *WORKS (Up to Build 1.1-R4)</li>
	<li><a href="http://dev.bukkit.org/server-mods/lolmewnstats/">Stats by lolmewnstats</a> ~ <a href="https://bitbucket.org/Lolmewn/stats/src">source</a> - TBA</li>
</ul>
<hr />

<h3>What are the requirements of WS?</h3>
<ul>
	<li><a href="http://www.php.net/downloads.php">PHP</a> (tested with v5.2.5 and above)</li>
	<li><a href="http://dev.mysql.com/downloads/">MySQL</a></li>
</ul>

<h2>And for the noobs use xampp *as seen below</h2>

<h3>Suggested:</h3>
<ul>
	<li><a href="http://www.apachefriends.org/en/xampp.html">XAMPP</a> ~ sets up everything for you.</li>
	<li><a href="http://www.easyphp.org/">EasyPHP</a> ~ sets up everything for you.</li>
	<li><a href="http://dev.bukkit.org/server-mods/ping-motd/">Ping MOTD</a> ~ Plugin that seems to never break, try it out.</li>
</ul>
					
<h3>Installation</h3>
<p>
1~Extract the zip file in your webserver directory *most likely<br />
2~The directory "image-cache" needs write permission (chmod 777) !<br />
~'include\player-image\image-cache'<br />
~'include\player-image\image-cache\player-skin'<br />
~'config\config.php'<br />
</p>

<h3>To-Do:</h3>
<ul>
	<li>Add a chat system connecting to the game, and linking that persons name to the ip tracker.</li>
	<strike><li>Option for Photo "banner reload" with server online stats.</li></strike>
	<li>Remove The Achievements Tab and Move It To The Players Page With It Grayed Out and Not Showing The Requirements Until The Player Unlocks The Achievement</li>
	<li>Add Rest Of ID's and Add The Extra ID's To Main ID's Page example ( 15:1 15:2 goes onto 15 page)</li>
	<li>Add <a href="http://dev.bukkit.org/server-mods/inventorysql/">InventorySQL</a> ~ <a href="https://github.com/ThisIsAreku/InventorySQL">GitHub</a></li>
	<li><a href="http://dev.bukkit.org/server-mods/beardach/">BeardAch</a> ~ <a href="https://github.com/tehbeard/BeardAch">GitHub</a></li>
	<li><a href="http://dev.bukkit.org/server-mods/beardstat/">BeardStat</a> ~ <a href="https://github.com/tehbeard/BeardStat">GitHub</a></li>
	<li>Add <a href="http://dev.bukkit.org/server-mods/hawkeye/">HawkEye</a> ~ <a href="https://github.com/oliverw92/HawkEye">GitHub</a></li>
	<li>Add <a href="http://dev.bukkit.org/server-mods/statisticianv2/">Statistician v2.0</a> ~ <a href="https://github.com/Crimsonfoxy/Statistician-v2">GitHub</a></li>
	<strike><li>Add Smart Phone Support * iPhone, Droid.</li></strike>
	<li>Added On/Off for Player Page Plugins, this is dynamic with your selection from the installer.</li>
	<li>Add User login to make an about me page for their account, along with some other features.</li>
</ul>
			
<h3>Current Pending Update:</h3>
<h4>v4(No ETA) - Changelog bellow is current GitHub Source changes</h4>
<ul>
	<li>Moved all MySQL function to mysqli since mysql was deprecated as of PHP 5.5.0.</li>
	<li>IP page sort function changes for the date.</li>
	<li>Updated to latest minecraft items 5/18/15</li>
	<li>JavaScript materials page.</li>
	<li>Updated to Foundation 5.5.2</li>
	<li>Optimized CSS for multi-platform</li>
	<li>ajax usage</li>
	<li>dynamic menu</li>
<h4>Known Problems</h4>
<ul>
	<li>Tables don't fit mobile.</li>
</ul>
<hr />

What Browser Does This Work With?
Known
*At least... Please Post otherwise. Thank You.
This is using HTML5 in some areas, but the main areas are not so that everyone can view.
<ul>
	<li>IE9+</li>
	<li>Firefox 1.5+</li>
	<li>Opera 8+</li>
	<li>Safari 3+</li>
	<li>Chrome 0.2+</li>
</ul>

**DOWNLOADING FROM ANY SOURCE, FOR COMMERCIAL USE IS PROHIBITED. IF YOU NEED THIS PROJECT FOR COMMERCIAL USE, YOU WILL NEED TO PURCHASE A LICENSE. BY DOWNLOADING THIS PROJECT YOU AGREE TO THESE TERMS.