-- WebStats by Nick Smith
-- developed on version 3.0
-- http://cky2250.github.com/WebStats/

--
-- Database: `WebStats`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
	`ID` INT(11) NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(50) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'Username',
	`password` VARCHAR(32) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'Password',
	`IP` VARCHAR(40) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'This is very accurate, since it is decided by PHP. It is unknown to wether it will record IPv6.',
	`hostname` VARCHAR(500) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'This is decided by PHP, so this is very accurate but may go too far and give the ISP hostname for the IP.',
	`location` VARCHAR(500) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'This code is taken from an outside source and is not know to be correct or incorrect.',
	`date` VARCHAR(200) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'This is the current date for which the user has viewed the page.',
	`email` VARCHAR(200) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'NOT IMPLEMENTED.',
	`cookie_pass` VARCHAR(32) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'The cookie created to remember the user and know who they are.',
	`actcode` VARCHAR(32) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'N/A.',
	`rank` VARCHAR(3) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'N/A.',
	`lastactive` datetime NOT NULL COMMENT 'The last date the user was logged viewing the server.',
	`lastlogin` datetime NOT NULL COMMENT 'The last date the user loged into the server.',
	PRIMARY KEY (`ID`)
) ENGINE `InnoDB` CHARACTER SET `ascii` COLLATE `ascii_general_ci`;

--
-- Table structure for table `ip_stats`
--


CREATE TABLE IF NOT EXISTS `ip_stats` (
	`ID` INT AUTO_INCREMENT primary key,
	`username` VARCHAR(40) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'If a stats plugin recoreds the user ingame name with IP.',
	`IP` VARCHAR(40) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'This is very accurate, since it is decided by PHP. It is unknown to wether it will record IPv6.',
	`hostname` VARCHAR(500) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'This is decided by PHP, so this is very accurate but may go too far and give the ISP hostname for the IP.',
	`location` VARCHAR(500) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'This code is taken from an outside source and is not know to be correct or incorrect.',
	`referer` VARCHAR(500) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'This url may not show 100% of the time, for the most part it is due to a direct execution to the site by the user.',
	`pageurl` VARCHAR(500) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'This url is very acurate since the code resides from that location (dynamicly).',
	`date` VARCHAR(200) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'This is the current date for which the user has viewed the page.',
	`pageview` INT(9) NOT NULL DEFAULT '1' COMMENT 'This value is developed by every click that the IP has viewed the site pages monitored by this code.',
	`bot` INT(1) NOT NULL COMMENT 'This value is decided by a list of known bot urls and IPs that have been set.',
	`country` varchar(64) collate utf8_unicode_ci NOT NULL default '' COMMENT 'What Country they are from.',
	`countrycode` varchar(2) collate utf8_unicode_ci NOT NULL default '' COMMENT 'What Country code they are from.',
	`city` varchar(64) collate utf8_unicode_ci NOT NULL default '' COMMENT 'What City they are from.',
	`dt` timestamp NOT NULL default CURRENT_TIMESTAMP COMMENT 'Current timestamp.',
	`online` INT(1) NOT NULL COMMENT 'If the ip is online or not.',
	UNIQUE KEY (`IP`),
	KEY `countrycode` (`countrycode`)
) ENGINE `InnoDB` CHARACTER SET `ascii` COLLATE `ascii_general_ci`;

--
-- Table structure for table `settings`
--

-- TODO

CREATE TABLE IF NOT EXISTS `settings` (
	`ID` INT(11) NOT NULL AUTO_INCREMENT,
	`IP` VARCHAR(40) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'This is very accurate, since it is decided by PHP. It is unknown to wether it will record IPv6.',
	`date` VARCHAR(200) CHARACTER SET `ascii` COLLATE `ascii_general_ci` NOT NULL COMMENT 'This is the current date for which the user has viewed the page.',
	PRIMARY KEY (`ID`)
) ENGINE `InnoDB` CHARACTER SET `ascii` COLLATE `ascii_general_ci`;