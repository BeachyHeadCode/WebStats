<a href="http://cky2250.github.com/WebStats/">WebStats</a> ~ <a href="http://forums.bukkit.org/threads/web-webstatistic-for-minecraft.17793/">Bukkit Forum</a>
========

MySQL - PHP web data page for public viewing of Minecraft plugin data

------------------------------------------------------------------------------------------------------------

This was based on <a href="http://forums.bukkit.org/threads/web-webstatistic-for-minecraft-v1-10b-1337.17793/">[WEB] Webstatistic for Minecraft v1.10b [1337]</a> - the code used in this is far more superior. It is being made into a Wordpress or phpwiki or any good website project that has an installer, login, admin page, and many goodies. 

Webstatistic for Minecraft is shortened to WS in the following text:

For issue, suggestion, source code, and other content go HERE

Vote For The Plugin. <a href="http://www.surveymonkey.com/s/8HF72BK">HERE</a>

- Steam Group <a href="http://steamcommunity.com/groups/WSFM">HERE</a>

Cool Links To Use
<a href="http://plugins.maniacraft.de/SaAPlugin/achgen">Achievement Maker</a>
<a href="http://89.144.25.51:8888/convert.php">Database Converter</a>

What's "Webstatistic for Minecraft"?
Every serveradmin wants, at some point, host some statistic data for the players, so that they can compete which each other (who destroyed the most cobblestone blocks or whatever). They can use it as a system to determine prices, or just to have an overview to compare stuff with each other.
If there are plugins WS should support in future, the plugin must be MySQL based, and if there are enough requests.
What you mean with "modular system" ?
WS has a core plugin, which is the above mentioned stats plugin for minecraft. In generall all stats collected by this plugin are evaluable.
Beside this plugin, WS supports other plugins which collects data in MySQL databases. The following plugins are already supported:
- <a href="http://dev.bukkit.org/server-mods/achievements/">Achievements</a> *WORKS (with stats)
- <a href="http://dev.bukkit.org/server-mods/tno-achievements/">Achievements 2.0</a> *PLUGIN DOES NOT WORK IN LATTEST CRAFTBUKKIT BUILD (not WS fault)
- BeardAch * NOT KNOWN YET. Sorry
-----------------------------------------------------------------------------------------------------------------------
- <a href="http://dev.bukkit.org/server-mods/iconomy/">iConomy</a> ~ <a href="https://github.com/iConomy/Core">GitHub</a> *WORKS
- <a href="http://dev.bukkit.org/server-mods/jail/">Jail</a> ~ <a href="https://github.com/matejdro/Jail">GitHub</a> * WORKS
- <a href="http://dev.bukkit.org/server-mods/jobs/">Jobs</a> ~ <a href="https://github.com/phrstbrn/Jobs">GitHub</a> *WORKS
- <a href="http://dev.bukkit.org/server-mods/mcmmo/">McMMO</a> ~ <a href="https://github.com/mcMMO-Dev/mcMMO">GitHub</a> *WORKS
- <a href="http://dev.bukkit.org/server-mods/stats/">Stats</a> *WORKS (In Build 1.1-R6)
- <a href="http://dev.bukkit.org/server-mods/tno-stats/">Stats 2.0</a> *WORKS (Up to Build 1.1-R4)
- <a href="http://dev.bukkit.org/server-mods/beardstat/">BeardStat</a> *WORKS[Known R6-build 2034 (MC:1.2.3)] - Uses same layout as Stats as I know of.
- <a href="http://dev.bukkit.org/server-mods/lolmewnstats/">Stats by lolmewnstats</a> ~ <a href="https://bitbucket.org/Lolmewn/stats/src">source</a> - TBA


What are the requirements of WS?
- PHP (tested with v5.2.5 and above)
- MySQL

And for the noobs use xampp *as seen below

Suggested:
- <a href="http://www.apachefriends.org/en/xampp.html">XAMPP</a> ~ sets up everything for you.
- <a href="http://www.easyphp.org/">EasyPHP</a> ~ sets up everything for you.
- <a href="http://dev.bukkit.org/server-mods/ping-motd/">Ping MOTD</a> ~ Plugin that seems to never brake, try it out.

Installation
1~Extract the zip file in your webserver directory *most likely
2~The directory "image-cache" needs write permission (chmod 777) !
	~'modules\player-image\image-cache'
	~'modules\player-image\image-cache\player-skin'
	~'config\config.php'

To-Do:
- Finish Brewing Pages
- Add Smelting Pages
- Admin Page
- Remove The Achievements Tab and Move It To The Players Page With It Grayed Out and Not Showing The Requirements Until The Player Unlocks The Achievement
- Add Rest Of ID's and Add The Extra ID's To Main ID's Page example ( 15:1 15:2 goes onto 15 page)
- Add InventorySQL
- Add Stats & Achievements Support
- Add BeardStat & BeardAch Support
- Add HawkEye Support
- Add Statistician v2.0 Support
- Add Smart Phone Support * iPhone, Droid.
- Add <a href="http://dev.bukkit.org/server-mods/jailplusplus/">Jail ++</a> ~ <a href="https://github.com/UltimateDev/jailplusplus/">GitHub</a>

Will Not Add:
-Achievement, since it does not support bukkit build 2126
-Logblock, since it does not support bukkit build 2126
Downloads:


v3.0(No ETA)
- Added On/Off for Player Page Plugins, this is dynamic with your selection from the installer.
- Added Admin Page.
- Added Smart Phone Support * iPhone(Added Foundation v3.1)
- Added Sample Config.
- Added IP Tracker.
- Updated A few items photos larger image.
- Updated Brewing Functions
- Added A few Brewing Items
- Removed/Updated ID page functions * still slow (using foundations) due to the amount of css.
- Updated Config Installer with notes on what is what.
- MySQL is much more easy for people to understand *(now once more able to set databases for each plugin verse 1 for all - not recommended).


--------------------------------		OLD 		----------------------------------------------------------
v2.1(4/5/2012 EST 10:23AM)
- Add PermisionsEX Support.
- Fixed PHP Errors Showing For The Banner Photo.
- Fixed McMMO Images Only Showing Under Some Servers. *Thanks To beleg
- Fixed Main Menu Problem.*Thanks To holsamoht
- Added McMMO Skill Bar.
- Added McMMO Power Level. * DOES NOT "SORT BY" YET

v2.0 (3/29/2012 EST 1:--PM)
- Changed PHP Errors.
- Fixed Code Making PHP Errors In Some Settings.
- Added A Background, (not the best shape) For 3D Players

v2.0-Delta (3/26/2012 EST 8:--PM)
- Fixed Players Not Being Shown On Material Page.
- Added Search Feature*works to ID page.
- Added Search For Players in Any Plugin.
- Added Jail.
- Re-Added Return To Homepage.

v2.0-gamma (3/21/2012 EST 4:51PM)
- Added Ping To Website.
- Added Dynamic Photo.
- Added Players Online, MOTD.
- Improved Installer.
- Removed Some Files.
* Please Report Any Problems Since This is Pre-Final.

v1.9.5-source (3/19/2012 EST 11:45AM)
- Removed Uneeded Files
- Fixed Menu jQuery ~ Dynamic Index still needed
- Source Files
* Plugin Is Still Not being Dev. Fully

v1.9 (3/19/2012 EST 11:30AM)
- Added The Installer Locally.
- Reloaded v1.9 - Has Raw Source Data Now ~ Plugin Terminated For Now

v1.8b ~ (3/13/2012 EST: 8:18PM)
- Introducing Install page - Outsourced 
- Minor CSS Fixes
- Fixed No Data In MySQL Loading Crash
- Added Session For Player Search

v1.7.3 ~ (3/9/2012)
- Fixed Style On Player Page.
- Moved Achievements To Player Page.
- Fixed ID Page Dynamic Search Box 90% Done.
- Fixed Background Not Loading On ID Page.
- Fixed Slow Code
* Known Bug ~ Menu No Being Dynamic.

v1.7.1.1 ~ (3/8/2012)
- Shortend some code.
- Fixed Player Page Hide and Show.

v1.7.1 ~ (3/8/2012)
- Added Bookmark - with current page location.
- Added Some Recipes.
- Added Live Search Code To Be Added.
- Changed Location of Player Search Box.
- Changed Background From .jpg To .png ~ Decreased Size.
- Deleted Unused Files.
- Fixed Backgrounds Not changing on click.
- Added Some new Style.
* Known Problem Background Does Not change in ID LIST page.


v1.6.5 ~ (3/3/2012)
- Fixed Some Errors in McMMO.
- Changed Some Photo Sizes.
- Added New Creatures * 'Minecraft V1.2.2'
- Added Some Recipes.
- Added McMMO Onto Profile Page.
- Added Code To Turn Off 3D File From Being Used By Others When Turned Off * will add localhost only if needed.
- Deleted Unneeded Items.


v1.6 ~ (3/1/2012)
- Added Brewing Recipe config
- Added Some Brewing Recipes
- Added Some New Crafting Recipe
- Added Photos of Items
- Cleaned Up Code
- Fixed McMMO


v1.5.2 ~ (2/27/2012)
- Added 3d on and off in the config*
- Added Some Names to ID's in The Stats
- Cleaned up code
* 3d Photos may be slow on some servers.

v1.5.1 ~ (2/27/2012)
- Removed Un-Needed Files
- Removed CSS Widths File to Make Only 1 File
- Deleted Flags Folder

v1.5 ~ (2/26/2012)
- Added 3d players *No config yet to turn on and off. But info on how is in the config file.
- Some Code Fixes
- Added Some New Files That Are Needed.

v1.4.9.5
-3d players almost done works 100% just not linked to player page.
-fixed some code
-fixed cursors not working in all browsers

v1.4.9
-fixed achievement install - will not change unless the MySQL does
-cleaned up code
-Added index.php file change to index.installed when you run the achievements-install and it works (so that you don't have to delete the file)

v1.4.7
- Changed background input option
- Added items to the Stats plugin page
- Fixed item photo viewing in material
- cleaned up code

v1.4.6
- Added cursors for page
- Google translate * just testing this
- added php requirement code
- added MySQL error code
- cleaned up code

v1.4.5 ~ (2/19/2012)
- Updated way to change background
- Added more backgrounds
- Fixed Achievement install
- Added Error Codes for Achievement install page
- Added Code For Ads On The Page
- Changed All Config Files To One Config File in 'config/config.php'
- Cleaned up code
- Added a return to main page icon
- Added new item id's * 381-385 and item 200
- Added new item images
- Added link to http://www.minecraftwiki.net for all English items
- Added titles to all pages
- Added Link To McMMO wiki On The Title
- Added Hover Pop Up Text



What Browser Does This Work With?
Known
*At least... Please Post otherwise. Thank You.
This is using HTML5 in some areas, but the main areas are not so that everyone can view.
- IE9+, Firefox 1.5+, Opera 8+, Safari 3+, Chrome 0.2+

**DOWNLOADING FROM ANY SOURCE, FOR COMMERCIAL USE IS PROHIBITED. IF YOU NEED THIS PROJECT FOR COMMERCIAL USE, YOU WILL NEED TO PURCHASE A LICENSE. BY DOWNLOADING THIS PROJECT YOU AGREE TO THESE TERMS.
**I HAVE A LAWYER, IF THERE IS ANY PROBLEM.