-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 24-03-2012 a las 10:28:05
-- Versión del servidor: 5.1.37
-- Versión de PHP: 5.2.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `elggbase`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_access_collections`
--

CREATE TABLE `elgg_access_collections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `owner_guid` bigint(20) unsigned NOT NULL,
  `site_guid` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `owner_guid` (`owner_guid`),
  KEY `site_guid` (`site_guid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `elgg_access_collections`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_access_collection_membership`
--

CREATE TABLE `elgg_access_collection_membership` (
  `user_guid` int(11) NOT NULL,
  `access_collection_id` int(11) NOT NULL,
  PRIMARY KEY (`user_guid`,`access_collection_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `elgg_access_collection_membership`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_annotations`
--

CREATE TABLE `elgg_annotations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_guid` bigint(20) unsigned NOT NULL,
  `name_id` int(11) NOT NULL,
  `value_id` int(11) NOT NULL,
  `value_type` enum('integer','text') NOT NULL,
  `owner_guid` bigint(20) unsigned NOT NULL,
  `access_id` int(11) NOT NULL,
  `time_created` int(11) NOT NULL,
  `enabled` enum('yes','no') NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  KEY `entity_guid` (`entity_guid`),
  KEY `name_id` (`name_id`),
  KEY `value_id` (`value_id`),
  KEY `owner_guid` (`owner_guid`),
  KEY `access_id` (`access_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `elgg_annotations`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_api_users`
--

CREATE TABLE `elgg_api_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_guid` bigint(20) unsigned DEFAULT NULL,
  `api_key` varchar(40) DEFAULT NULL,
  `secret` varchar(40) NOT NULL,
  `active` int(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `api_key` (`api_key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `elgg_api_users`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_config`
--

CREATE TABLE `elgg_config` (
  `name` varchar(32) NOT NULL,
  `value` text NOT NULL,
  `site_guid` int(11) NOT NULL,
  PRIMARY KEY (`name`,`site_guid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `elgg_config`
--

INSERT INTO `elgg_config` VALUES('view', 's:7:"default";', 1);
INSERT INTO `elgg_config` VALUES('language', 's:2:"en";', 1);
INSERT INTO `elgg_config` VALUES('default_access', 's:1:"1";', 1);
INSERT INTO `elgg_config` VALUES('disable_api', 's:8:"disabled";', 1);
INSERT INTO `elgg_config` VALUES('allow_user_default_access', 's:1:"0";', 1);
INSERT INTO `elgg_config` VALUES('ping_home', 's:8:"disabled";', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_datalists`
--

CREATE TABLE `elgg_datalists` (
  `name` varchar(32) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `elgg_datalists`
--

INSERT INTO `elgg_datalists` VALUES('__site_secret__', '34537c1ecded635de38dfa2c300e9840');
INSERT INTO `elgg_datalists` VALUES('filestore_run_once', '1270738458');
INSERT INTO `elgg_datalists` VALUES('plugin_run_once', '1270738458');
INSERT INTO `elgg_datalists` VALUES('widget_run_once', '1270738458');
INSERT INTO `elgg_datalists` VALUES('installed', '1270738458');
INSERT INTO `elgg_datalists` VALUES('path', '/Users/development3/Sites/elggbase/');
INSERT INTO `elgg_datalists` VALUES('dataroot', '/Users/development3/Sites/elggdata/elggbase/');
INSERT INTO `elgg_datalists` VALUES('default_site', '1');
INSERT INTO `elgg_datalists` VALUES('version', '2011052801');
INSERT INTO `elgg_datalists` VALUES('simplecache_lastcached_default', '1315419225');
INSERT INTO `elgg_datalists` VALUES('admin_registered', '1');
INSERT INTO `elgg_datalists` VALUES('first_admin_login', '1270738522');
INSERT INTO `elgg_datalists` VALUES('simplecache_lastupdate_failsafe', '1315419225');
INSERT INTO `elgg_datalists` VALUES('viewpath_cache_enabled', '0');
INSERT INTO `elgg_datalists` VALUES('simplecache_enabled', '0');
INSERT INTO `elgg_datalists` VALUES('simplecache_lastupdate_default', '1315419225');
INSERT INTO `elgg_datalists` VALUES('simplecache_lastcached_failsafe', '1315419225');
INSERT INTO `elgg_datalists` VALUES('simplecache_lastupdate_foaf', '1315419225');
INSERT INTO `elgg_datalists` VALUES('simplecache_lastcached_foaf', '1315419225');
INSERT INTO `elgg_datalists` VALUES('simplecache_lastupdate_ical', '1315419225');
INSERT INTO `elgg_datalists` VALUES('simplecache_lastcached_ical', '1315419225');
INSERT INTO `elgg_datalists` VALUES('simplecache_lastupdate_js', '1315419225');
INSERT INTO `elgg_datalists` VALUES('simplecache_lastcached_js', '1315419225');
INSERT INTO `elgg_datalists` VALUES('simplecache_lastupdate_json', '1315419225');
INSERT INTO `elgg_datalists` VALUES('simplecache_lastcached_json', '1315419225');
INSERT INTO `elgg_datalists` VALUES('simplecache_lastupdate_opendd', '1315419225');
INSERT INTO `elgg_datalists` VALUES('simplecache_lastcached_opendd', '1315419225');
INSERT INTO `elgg_datalists` VALUES('simplecache_lastupdate_php', '1315419225');
INSERT INTO `elgg_datalists` VALUES('simplecache_lastcached_php', '1315419225');
INSERT INTO `elgg_datalists` VALUES('simplecache_lastupdate_rss', '1315419225');
INSERT INTO `elgg_datalists` VALUES('simplecache_lastcached_rss', '1315419225');
INSERT INTO `elgg_datalists` VALUES('simplecache_lastupdate_xml', '1315419225');
INSERT INTO `elgg_datalists` VALUES('simplecache_lastcached_xml', '1315419225');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_entities`
--

CREATE TABLE `elgg_entities` (
  `guid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('object','user','group','site') NOT NULL,
  `subtype` int(11) DEFAULT NULL,
  `owner_guid` bigint(20) unsigned NOT NULL,
  `site_guid` bigint(20) unsigned NOT NULL,
  `container_guid` bigint(20) unsigned NOT NULL,
  `access_id` int(11) NOT NULL,
  `time_created` int(11) NOT NULL,
  `time_updated` int(11) NOT NULL,
  `last_action` int(11) NOT NULL DEFAULT '0',
  `enabled` enum('yes','no') NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`guid`),
  KEY `type` (`type`),
  KEY `subtype` (`subtype`),
  KEY `owner_guid` (`owner_guid`),
  KEY `site_guid` (`site_guid`),
  KEY `container_guid` (`container_guid`),
  KEY `access_id` (`access_id`),
  KEY `time_created` (`time_created`),
  KEY `time_updated` (`time_updated`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Volcar la base de datos para la tabla `elgg_entities`
--

INSERT INTO `elgg_entities` VALUES(1, 'site', 0, 0, 0, 0, 2, 1270738458, 1271953163, 0, 'yes');
INSERT INTO `elgg_entities` VALUES(2, 'user', 0, 0, 1, 0, 2, 1270738484, 1332595637, 0, 'yes');
INSERT INTO `elgg_entities` VALUES(3, 'object', 2, 2, 1, 2, 2, 1270738744, 1270738744, 0, 'yes');
INSERT INTO `elgg_entities` VALUES(4, 'user', 0, 0, 1, 0, 2, 1271953203, 1271954231, 0, 'yes');
INSERT INTO `elgg_entities` VALUES(5, 'user', 0, 0, 1, 0, 2, 1271954074, 1271954274, 0, 'yes');
INSERT INTO `elgg_entities` VALUES(6, 'user', 0, 0, 1, 0, 2, 1271954128, 1271954306, 0, 'yes');
INSERT INTO `elgg_entities` VALUES(7, 'user', 0, 0, 1, 0, 2, 1271954151, 1271954395, 0, 'yes');
INSERT INTO `elgg_entities` VALUES(8, 'user', 0, 0, 1, 0, 2, 1271954182, 1271954405, 0, 'yes');
INSERT INTO `elgg_entities` VALUES(9, 'user', 0, 0, 1, 0, 2, 1304619843, 1304684688, 1304619843, 'yes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_entity_relationships`
--

CREATE TABLE `elgg_entity_relationships` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid_one` bigint(20) unsigned NOT NULL,
  `relationship` varchar(50) NOT NULL,
  `guid_two` bigint(20) unsigned NOT NULL,
  `time_created` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `guid_one` (`guid_one`,`relationship`,`guid_two`),
  KEY `relationship` (`relationship`),
  KEY `guid_two` (`guid_two`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Volcar la base de datos para la tabla `elgg_entity_relationships`
--

INSERT INTO `elgg_entity_relationships` VALUES(1, 2, 'member_of_site', 1, 0);
INSERT INTO `elgg_entity_relationships` VALUES(2, 4, 'member_of_site', 1, 0);
INSERT INTO `elgg_entity_relationships` VALUES(3, 5, 'member_of_site', 1, 0);
INSERT INTO `elgg_entity_relationships` VALUES(4, 6, 'member_of_site', 1, 0);
INSERT INTO `elgg_entity_relationships` VALUES(5, 7, 'member_of_site', 1, 0);
INSERT INTO `elgg_entity_relationships` VALUES(6, 8, 'member_of_site', 1, 0);
INSERT INTO `elgg_entity_relationships` VALUES(7, 4, 'friend', 5, 0);
INSERT INTO `elgg_entity_relationships` VALUES(8, 4, 'friend', 6, 0);
INSERT INTO `elgg_entity_relationships` VALUES(9, 5, 'friend', 4, 0);
INSERT INTO `elgg_entity_relationships` VALUES(10, 5, 'friend', 6, 0);
INSERT INTO `elgg_entity_relationships` VALUES(11, 5, 'friend', 7, 0);
INSERT INTO `elgg_entity_relationships` VALUES(12, 6, 'friend', 4, 0);
INSERT INTO `elgg_entity_relationships` VALUES(13, 6, 'friend', 5, 0);
INSERT INTO `elgg_entity_relationships` VALUES(14, 6, 'friend', 7, 0);
INSERT INTO `elgg_entity_relationships` VALUES(15, 7, 'friend', 5, 0);
INSERT INTO `elgg_entity_relationships` VALUES(16, 7, 'friend', 6, 0);
INSERT INTO `elgg_entity_relationships` VALUES(17, 9, 'member_of_site', 1, 1304619843);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_entity_subtypes`
--

CREATE TABLE `elgg_entity_subtypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('object','user','group','site') NOT NULL,
  `subtype` varchar(50) NOT NULL,
  `class` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `type` (`type`,`subtype`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcar la base de datos para la tabla `elgg_entity_subtypes`
--

INSERT INTO `elgg_entity_subtypes` VALUES(1, 'object', 'file', 'ElggFile');
INSERT INTO `elgg_entity_subtypes` VALUES(2, 'object', 'plugin', 'ElggPlugin');
INSERT INTO `elgg_entity_subtypes` VALUES(3, 'object', 'widget', 'ElggWidget');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_geocode_cache`
--

CREATE TABLE `elgg_geocode_cache` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` varchar(128) DEFAULT NULL,
  `lat` varchar(20) DEFAULT NULL,
  `long` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `location` (`location`)
) ENGINE=MEMORY DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `elgg_geocode_cache`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_groups_entity`
--

CREATE TABLE `elgg_groups_entity` (
  `guid` bigint(20) unsigned NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`guid`),
  KEY `name` (`name`(50)),
  KEY `description` (`description`(50)),
  FULLTEXT KEY `name_2` (`name`,`description`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `elgg_groups_entity`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_hmac_cache`
--

CREATE TABLE `elgg_hmac_cache` (
  `hmac` varchar(255) NOT NULL,
  `ts` int(11) NOT NULL,
  PRIMARY KEY (`hmac`),
  KEY `ts` (`ts`)
) ENGINE=MEMORY DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `elgg_hmac_cache`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_metadata`
--

CREATE TABLE `elgg_metadata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_guid` bigint(20) unsigned NOT NULL,
  `name_id` int(11) NOT NULL,
  `value_id` int(11) NOT NULL,
  `value_type` enum('integer','text') NOT NULL,
  `owner_guid` bigint(20) unsigned NOT NULL,
  `access_id` int(11) NOT NULL,
  `time_created` int(11) NOT NULL,
  `enabled` enum('yes','no') NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  KEY `entity_guid` (`entity_guid`),
  KEY `name_id` (`name_id`),
  KEY `value_id` (`value_id`),
  KEY `owner_guid` (`owner_guid`),
  KEY `access_id` (`access_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=352 ;

--
-- Volcar la base de datos para la tabla `elgg_metadata`
--

INSERT INTO `elgg_metadata` VALUES(1, 1, 1, 2, 'text', 2, 2, 1270738458, 'yes');
INSERT INTO `elgg_metadata` VALUES(24, 2, 12, 11, 'text', 0, 2, 1270738484, 'yes');
INSERT INTO `elgg_metadata` VALUES(25, 2, 13, 14, 'text', 0, 2, 1270738484, 'yes');
INSERT INTO `elgg_metadata` VALUES(26, 2, 15, 11, 'text', 2, 2, 1270738484, 'yes');
INSERT INTO `elgg_metadata` VALUES(27, 1, 16, 31, 'text', 2, 2, 1270738522, 'yes');
INSERT INTO `elgg_metadata` VALUES(98, 4, 15, 11, 'text', 4, 2, 1271953203, 'yes');
INSERT INTO `elgg_metadata` VALUES(99, 4, 25, 11, 'text', 4, 2, 1271953203, 'yes');
INSERT INTO `elgg_metadata` VALUES(100, 4, 26, 27, 'text', 4, 2, 1271953203, 'yes');
INSERT INTO `elgg_metadata` VALUES(101, 4, 12, 11, 'text', 2, 2, 1271953203, 'yes');
INSERT INTO `elgg_metadata` VALUES(102, 4, 13, 25, 'text', 2, 2, 1271953203, 'yes');
INSERT INTO `elgg_metadata` VALUES(103, 5, 15, 11, 'text', 5, 2, 1271954074, 'yes');
INSERT INTO `elgg_metadata` VALUES(104, 5, 25, 11, 'text', 5, 2, 1271954074, 'yes');
INSERT INTO `elgg_metadata` VALUES(105, 5, 26, 27, 'text', 5, 2, 1271954074, 'yes');
INSERT INTO `elgg_metadata` VALUES(106, 5, 12, 11, 'text', 2, 2, 1271954074, 'yes');
INSERT INTO `elgg_metadata` VALUES(107, 5, 13, 25, 'text', 2, 2, 1271954074, 'yes');
INSERT INTO `elgg_metadata` VALUES(108, 6, 15, 11, 'text', 6, 2, 1271954128, 'yes');
INSERT INTO `elgg_metadata` VALUES(109, 6, 25, 11, 'text', 6, 2, 1271954128, 'yes');
INSERT INTO `elgg_metadata` VALUES(110, 6, 26, 27, 'text', 6, 2, 1271954128, 'yes');
INSERT INTO `elgg_metadata` VALUES(111, 6, 12, 11, 'text', 2, 2, 1271954128, 'yes');
INSERT INTO `elgg_metadata` VALUES(112, 6, 13, 25, 'text', 2, 2, 1271954128, 'yes');
INSERT INTO `elgg_metadata` VALUES(113, 7, 15, 11, 'text', 7, 2, 1271954151, 'yes');
INSERT INTO `elgg_metadata` VALUES(114, 7, 25, 11, 'text', 7, 2, 1271954151, 'yes');
INSERT INTO `elgg_metadata` VALUES(115, 7, 26, 27, 'text', 7, 2, 1271954151, 'yes');
INSERT INTO `elgg_metadata` VALUES(116, 7, 12, 11, 'text', 2, 2, 1271954151, 'yes');
INSERT INTO `elgg_metadata` VALUES(117, 7, 13, 25, 'text', 2, 2, 1271954151, 'yes');
INSERT INTO `elgg_metadata` VALUES(118, 8, 15, 11, 'text', 8, 2, 1271954182, 'yes');
INSERT INTO `elgg_metadata` VALUES(119, 8, 25, 11, 'text', 8, 2, 1271954182, 'yes');
INSERT INTO `elgg_metadata` VALUES(120, 8, 26, 27, 'text', 8, 2, 1271954182, 'yes');
INSERT INTO `elgg_metadata` VALUES(121, 8, 12, 11, 'text', 2, 2, 1271954182, 'yes');
INSERT INTO `elgg_metadata` VALUES(122, 8, 13, 25, 'text', 2, 2, 1271954182, 'yes');
INSERT INTO `elgg_metadata` VALUES(123, 9, 15, 11, 'text', 9, 2, 1304619843, 'yes');
INSERT INTO `elgg_metadata` VALUES(124, 9, 25, 11, 'text', 9, 2, 1304619843, 'yes');
INSERT INTO `elgg_metadata` VALUES(125, 9, 26, 27, 'text', 9, 2, 1304619843, 'yes');
INSERT INTO `elgg_metadata` VALUES(126, 9, 12, 11, 'text', 2, 2, 1304619843, 'yes');
INSERT INTO `elgg_metadata` VALUES(127, 9, 13, 25, 'text', 2, 2, 1304619843, 'yes');
INSERT INTO `elgg_metadata` VALUES(128, 9, 28, 29, 'integer', 9, 2, 1304684669, 'yes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_metastrings`
--

CREATE TABLE `elgg_metastrings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `string` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `string` (`string`(50))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Volcar la base de datos para la tabla `elgg_metastrings`
--

INSERT INTO `elgg_metastrings` VALUES(1, 'email');
INSERT INTO `elgg_metastrings` VALUES(2, 'socialadmin@keetup.com');
INSERT INTO `elgg_metastrings` VALUES(3, 'enabled_plugins');
INSERT INTO `elgg_metastrings` VALUES(4, 'profile');
INSERT INTO `elgg_metastrings` VALUES(5, 'logbrowser');
INSERT INTO `elgg_metastrings` VALUES(6, 'diagnostics');
INSERT INTO `elgg_metastrings` VALUES(7, 'uservalidationbyemail');
INSERT INTO `elgg_metastrings` VALUES(8, 'htmlawed');
INSERT INTO `elgg_metastrings` VALUES(9, 'search');
INSERT INTO `elgg_metastrings` VALUES(10, 'admin');
INSERT INTO `elgg_metastrings` VALUES(11, '1');
INSERT INTO `elgg_metastrings` VALUES(12, 'validated');
INSERT INTO `elgg_metastrings` VALUES(13, 'validated_method');
INSERT INTO `elgg_metastrings` VALUES(14, 'first_run');
INSERT INTO `elgg_metastrings` VALUES(15, 'notification:method:email');
INSERT INTO `elgg_metastrings` VALUES(16, 'pluginorder');
INSERT INTO `elgg_metastrings` VALUES(17, 'a:33:{i:10;s:4:"blog";i:20;s:9:"bookmarks";i:30;s:7:"captcha";i:40;s:10:"categories";i:50;s:11:"crontrigger";i:60;s:12:"custom_index";i:70;s:14:"defaultwidgets";i:80;s:11:"diagnostics";i:90;s:5:"embed";i:100;s:13:"externalpages";i:110;s:4:"file";i:120;s:7:"friends";i:130;s:16:"garbagecollector";i:140;s:6:"groups";i:150;s:8:"htmlawed";i:160;s:13:"invitefriends";i:170;s:10:"logbrowser";i:180;s:9:"logrotate";i:190;s:7:"members";i:200;s:12:"messageboard";i:210;s:8:"messages";i:220;s:13:"notifications";i:230;s:5:"pages";i:240;s:7:"profile";i:250;s:15:"reportedcontent";i:260;s:14:"riverdashboard";i:270;s:6:"search";i:280;s:7:"thewire";i:290;s:7:"tinymce";i:300;s:7:"twitter";i:310;s:14:"twitterservice";i:320;s:21:"uservalidationbyemail";i:330;s:6:"zaudio";}');
INSERT INTO `elgg_metastrings` VALUES(18, 'captcha');
INSERT INTO `elgg_metastrings` VALUES(19, 'externalpages');
INSERT INTO `elgg_metastrings` VALUES(20, 'friends');
INSERT INTO `elgg_metastrings` VALUES(21, 'members');
INSERT INTO `elgg_metastrings` VALUES(22, 'messages');
INSERT INTO `elgg_metastrings` VALUES(23, 'notifications');
INSERT INTO `elgg_metastrings` VALUES(24, 'riverdashboard');
INSERT INTO `elgg_metastrings` VALUES(25, 'admin_created');
INSERT INTO `elgg_metastrings` VALUES(26, 'created_by_guid');
INSERT INTO `elgg_metastrings` VALUES(27, '2');
INSERT INTO `elgg_metastrings` VALUES(28, 'icontime');
INSERT INTO `elgg_metastrings` VALUES(29, '1304684669');
INSERT INTO `elgg_metastrings` VALUES(30, 'a:34:{i:10;s:4:"blog";i:20;s:9:"bookmarks";i:30;s:7:"captcha";i:40;s:10:"categories";i:50;s:11:"crontrigger";i:60;s:12:"custom_index";i:70;s:14:"defaultwidgets";i:80;s:11:"diagnostics";i:90;s:5:"embed";i:100;s:13:"externalpages";i:110;s:4:"file";i:120;s:7:"friends";i:130;s:16:"garbagecollector";i:140;s:6:"groups";i:150;s:8:"htmlawed";i:160;s:13:"invitefriends";i:170;s:10:"logbrowser";i:180;s:9:"logrotate";i:190;s:7:"members";i:200;s:12:"messageboard";i:210;s:8:"messages";i:220;s:13:"notifications";i:230;s:5:"pages";i:240;s:7:"profile";i:250;s:15:"reportedcontent";i:260;s:14:"riverdashboard";i:270;s:6:"search";i:280;s:7:"thewire";i:290;s:7:"tinymce";i:300;s:7:"twitter";i:310;s:14:"twitterservice";i:320;s:21:"uservalidationbyemail";i:330;s:6:"zaudio";i:340;s:22:"theme_professionalelgg";}');
INSERT INTO `elgg_metastrings` VALUES(31, 'a:34:{i:10;s:4:"blog";i:20;s:9:"bookmarks";i:30;s:7:"captcha";i:40;s:10:"categories";i:50;s:11:"crontrigger";i:60;s:12:"custom_index";i:70;s:14:"defaultwidgets";i:80;s:11:"diagnostics";i:90;s:5:"embed";i:100;s:13:"externalpages";i:110;s:4:"file";i:120;s:7:"friends";i:130;s:16:"garbagecollector";i:140;s:6:"groups";i:150;s:8:"htmlawed";i:160;s:13:"invitefriends";i:170;s:10:"logbrowser";i:180;s:9:"logrotate";i:190;s:7:"members";i:200;s:12:"messageboard";i:210;s:8:"messages";i:220;s:13:"notifications";i:230;s:5:"pages";i:240;s:7:"profile";i:250;s:15:"reportedcontent";i:260;s:14:"riverdashboard";i:270;s:6:"search";i:280;s:7:"thewire";i:290;s:7:"tinymce";i:300;s:7:"twitter";i:310;s:14:"twitterservice";i:320;s:21:"uservalidationbyemail";i:330;s:6:"zaudio";i:340;s:6:"ktform";}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_objects_entity`
--

CREATE TABLE `elgg_objects_entity` (
  `guid` bigint(20) unsigned NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`guid`),
  FULLTEXT KEY `title` (`title`,`description`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `elgg_objects_entity`
--

INSERT INTO `elgg_objects_entity` VALUES(3, 'riverdashboard', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_private_settings`
--

CREATE TABLE `elgg_private_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_guid` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `entity_guid` (`entity_guid`,`name`),
  KEY `name` (`name`),
  KEY `value` (`value`(50))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `elgg_private_settings`
--

INSERT INTO `elgg_private_settings` VALUES(1, 3, 'useasdashboard', 'yes');
INSERT INTO `elgg_private_settings` VALUES(2, 3, 'avatar_icon', 'icon');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_river`
--

CREATE TABLE `elgg_river` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(8) NOT NULL,
  `subtype` varchar(32) NOT NULL,
  `action_type` varchar(32) NOT NULL,
  `access_id` int(11) NOT NULL,
  `view` text NOT NULL,
  `subject_guid` int(11) NOT NULL,
  `object_guid` int(11) NOT NULL,
  `annotation_id` int(11) NOT NULL,
  `posted` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `action_type` (`action_type`),
  KEY `access_id` (`access_id`),
  KEY `subject_guid` (`subject_guid`),
  KEY `object_guid` (`object_guid`),
  KEY `annotation_id` (`annotation_id`),
  KEY `posted` (`posted`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Volcar la base de datos para la tabla `elgg_river`
--

INSERT INTO `elgg_river` VALUES(1, 'user', '', 'friend', 2, 'friends/river/create', 4, 5, 0, 1271954209);
INSERT INTO `elgg_river` VALUES(2, 'user', '', 'friend', 2, 'friends/river/create', 4, 6, 0, 1271954219);
INSERT INTO `elgg_river` VALUES(3, 'user', '', 'friend', 2, 'friends/river/create', 5, 4, 0, 1271954250);
INSERT INTO `elgg_river` VALUES(4, 'user', '', 'friend', 2, 'friends/river/create', 5, 6, 0, 1271954266);
INSERT INTO `elgg_river` VALUES(5, 'user', '', 'friend', 2, 'friends/river/create', 5, 7, 0, 1271954273);
INSERT INTO `elgg_river` VALUES(6, 'user', '', 'friend', 2, 'friends/river/create', 6, 4, 0, 1271954295);
INSERT INTO `elgg_river` VALUES(7, 'user', '', 'friend', 2, 'friends/river/create', 6, 5, 0, 1271954300);
INSERT INTO `elgg_river` VALUES(8, 'user', '', 'friend', 2, 'friends/river/create', 6, 7, 0, 1271954304);
INSERT INTO `elgg_river` VALUES(9, 'user', '', 'friend', 2, 'friends/river/create', 7, 5, 0, 1271954368);
INSERT INTO `elgg_river` VALUES(10, 'user', '', 'friend', 2, 'friends/river/create', 7, 6, 0, 1271954373);
INSERT INTO `elgg_river` VALUES(11, 'user', '', 'update', 2, 'river/user/default/profileiconupdate', 9, 9, 0, 1304684670);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_sites_entity`
--

CREATE TABLE `elgg_sites_entity` (
  `guid` bigint(20) unsigned NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`guid`),
  UNIQUE KEY `url` (`url`),
  FULLTEXT KEY `name` (`name`,`description`,`url`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `elgg_sites_entity`
--

INSERT INTO `elgg_sites_entity` VALUES(1, 'elggbase', '', 'http://local/elggbase/');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_system_log`
--

CREATE TABLE `elgg_system_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `object_id` int(11) NOT NULL,
  `object_class` varchar(50) NOT NULL,
  `object_type` varchar(50) NOT NULL,
  `object_subtype` varchar(50) NOT NULL,
  `event` varchar(50) NOT NULL,
  `performed_by_guid` int(11) NOT NULL,
  `owner_guid` int(11) NOT NULL,
  `access_id` int(11) NOT NULL,
  `enabled` enum('yes','no') NOT NULL DEFAULT 'yes',
  `time_created` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `object_id` (`object_id`),
  KEY `object_class` (`object_class`),
  KEY `object_type` (`object_type`),
  KEY `object_subtype` (`object_subtype`),
  KEY `event` (`event`),
  KEY `performed_by_guid` (`performed_by_guid`),
  KEY `access_id` (`access_id`),
  KEY `time_created` (`time_created`),
  KEY `river_key` (`object_type`,`object_subtype`,`event`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=805 ;

--
-- Volcar la base de datos para la tabla `elgg_system_log`
--

INSERT INTO `elgg_system_log` VALUES(1, 1, 'ElggMetadata', 'metadata', 'email', 'create', 0, 0, 2, 'yes', 1270738458);
INSERT INTO `elgg_system_log` VALUES(2, 2, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 0, 0, 2, 'yes', 1270738459);
INSERT INTO `elgg_system_log` VALUES(3, 2, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 0, 0, 2, 'yes', 1270738459);
INSERT INTO `elgg_system_log` VALUES(4, 3, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 0, 0, 2, 'yes', 1270738459);
INSERT INTO `elgg_system_log` VALUES(5, 4, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 0, 0, 2, 'yes', 1270738459);
INSERT INTO `elgg_system_log` VALUES(6, 3, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 0, 0, 2, 'yes', 1270738459);
INSERT INTO `elgg_system_log` VALUES(7, 4, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 0, 0, 2, 'yes', 1270738459);
INSERT INTO `elgg_system_log` VALUES(8, 5, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 0, 0, 2, 'yes', 1270738459);
INSERT INTO `elgg_system_log` VALUES(9, 6, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 0, 0, 2, 'yes', 1270738459);
INSERT INTO `elgg_system_log` VALUES(10, 7, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 0, 0, 2, 'yes', 1270738459);
INSERT INTO `elgg_system_log` VALUES(11, 6, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 0, 0, 2, 'yes', 1270738459);
INSERT INTO `elgg_system_log` VALUES(12, 5, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 0, 0, 2, 'yes', 1270738459);
INSERT INTO `elgg_system_log` VALUES(13, 7, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 0, 0, 2, 'yes', 1270738459);
INSERT INTO `elgg_system_log` VALUES(14, 8, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 0, 0, 2, 'yes', 1270738459);
INSERT INTO `elgg_system_log` VALUES(15, 9, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 0, 0, 2, 'yes', 1270738459);
INSERT INTO `elgg_system_log` VALUES(16, 10, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 0, 0, 2, 'yes', 1270738459);
INSERT INTO `elgg_system_log` VALUES(17, 11, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 0, 0, 2, 'yes', 1270738459);
INSERT INTO `elgg_system_log` VALUES(18, 10, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 0, 0, 2, 'yes', 1270738459);
INSERT INTO `elgg_system_log` VALUES(19, 9, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 0, 0, 2, 'yes', 1270738459);
INSERT INTO `elgg_system_log` VALUES(20, 8, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 0, 0, 2, 'yes', 1270738459);
INSERT INTO `elgg_system_log` VALUES(21, 11, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 0, 0, 2, 'yes', 1270738459);
INSERT INTO `elgg_system_log` VALUES(22, 12, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 0, 0, 2, 'yes', 1270738459);
INSERT INTO `elgg_system_log` VALUES(23, 13, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 0, 0, 2, 'yes', 1270738459);
INSERT INTO `elgg_system_log` VALUES(24, 14, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 0, 0, 2, 'yes', 1270738459);
INSERT INTO `elgg_system_log` VALUES(25, 15, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 0, 0, 2, 'yes', 1270738459);
INSERT INTO `elgg_system_log` VALUES(26, 16, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 0, 0, 2, 'yes', 1270738459);
INSERT INTO `elgg_system_log` VALUES(27, 15, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 0, 0, 2, 'yes', 1270738459);
INSERT INTO `elgg_system_log` VALUES(28, 14, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 0, 0, 2, 'yes', 1270738459);
INSERT INTO `elgg_system_log` VALUES(29, 13, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 0, 0, 2, 'yes', 1270738459);
INSERT INTO `elgg_system_log` VALUES(30, 12, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 0, 0, 2, 'yes', 1270738459);
INSERT INTO `elgg_system_log` VALUES(31, 16, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 0, 0, 2, 'yes', 1270738459);
INSERT INTO `elgg_system_log` VALUES(32, 17, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 0, 0, 2, 'yes', 1270738459);
INSERT INTO `elgg_system_log` VALUES(33, 18, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 0, 0, 2, 'yes', 1270738459);
INSERT INTO `elgg_system_log` VALUES(34, 19, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 0, 0, 2, 'yes', 1270738459);
INSERT INTO `elgg_system_log` VALUES(35, 20, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 0, 0, 2, 'yes', 1270738459);
INSERT INTO `elgg_system_log` VALUES(36, 21, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 0, 0, 2, 'yes', 1270738459);
INSERT INTO `elgg_system_log` VALUES(37, 22, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 0, 0, 2, 'yes', 1270738459);
INSERT INTO `elgg_system_log` VALUES(38, 1, 'ElggRelationship', 'relationship', 'member_of_site', 'create', 0, 0, 2, 'yes', 1270738484);
INSERT INTO `elgg_system_log` VALUES(39, 2, 'ElggUser', 'user', '', 'create', 0, 0, 2, 'yes', 1270738484);
INSERT INTO `elgg_system_log` VALUES(40, 23, 'ElggMetadata', 'metadata', 'admin', 'create', 0, 0, 2, 'yes', 1270738484);
INSERT INTO `elgg_system_log` VALUES(41, 24, 'ElggMetadata', 'metadata', 'validated', 'create', 0, 0, 2, 'yes', 1270738484);
INSERT INTO `elgg_system_log` VALUES(42, 25, 'ElggMetadata', 'metadata', 'validated_method', 'create', 0, 0, 2, 'yes', 1270738484);
INSERT INTO `elgg_system_log` VALUES(43, 26, 'ElggMetadata', 'metadata', 'notification:method:email', 'create', 0, 0, 2, 'yes', 1270738484);
INSERT INTO `elgg_system_log` VALUES(44, 2, 'ElggUser', 'user', '', 'update', 2, 0, 2, 'yes', 1270738521);
INSERT INTO `elgg_system_log` VALUES(45, 2, 'ElggUser', 'user', '', 'login', 2, 0, 2, 'yes', 1270738521);
INSERT INTO `elgg_system_log` VALUES(46, 27, 'ElggMetadata', 'metadata', 'pluginorder', 'create', 2, 0, 2, 'yes', 1270738522);
INSERT INTO `elgg_system_log` VALUES(47, 21, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738583);
INSERT INTO `elgg_system_log` VALUES(48, 20, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738583);
INSERT INTO `elgg_system_log` VALUES(49, 19, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738583);
INSERT INTO `elgg_system_log` VALUES(50, 18, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738583);
INSERT INTO `elgg_system_log` VALUES(51, 17, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738583);
INSERT INTO `elgg_system_log` VALUES(52, 22, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738583);
INSERT INTO `elgg_system_log` VALUES(53, 28, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738583);
INSERT INTO `elgg_system_log` VALUES(54, 29, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738583);
INSERT INTO `elgg_system_log` VALUES(55, 30, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738583);
INSERT INTO `elgg_system_log` VALUES(56, 31, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738583);
INSERT INTO `elgg_system_log` VALUES(57, 32, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738583);
INSERT INTO `elgg_system_log` VALUES(58, 33, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738584);
INSERT INTO `elgg_system_log` VALUES(59, 34, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738584);
INSERT INTO `elgg_system_log` VALUES(60, 27, 'ElggMetadata', 'metadata', 'pluginorder', 'update', 2, 0, 2, 'yes', 1270738584);
INSERT INTO `elgg_system_log` VALUES(61, 33, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738664);
INSERT INTO `elgg_system_log` VALUES(62, 32, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738664);
INSERT INTO `elgg_system_log` VALUES(63, 31, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738664);
INSERT INTO `elgg_system_log` VALUES(64, 30, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738664);
INSERT INTO `elgg_system_log` VALUES(65, 29, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738664);
INSERT INTO `elgg_system_log` VALUES(66, 28, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738664);
INSERT INTO `elgg_system_log` VALUES(67, 34, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738664);
INSERT INTO `elgg_system_log` VALUES(68, 35, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738664);
INSERT INTO `elgg_system_log` VALUES(69, 36, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738664);
INSERT INTO `elgg_system_log` VALUES(70, 37, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738664);
INSERT INTO `elgg_system_log` VALUES(71, 38, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738664);
INSERT INTO `elgg_system_log` VALUES(72, 39, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738664);
INSERT INTO `elgg_system_log` VALUES(73, 40, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738664);
INSERT INTO `elgg_system_log` VALUES(74, 41, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738664);
INSERT INTO `elgg_system_log` VALUES(75, 42, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738664);
INSERT INTO `elgg_system_log` VALUES(76, 27, 'ElggMetadata', 'metadata', 'pluginorder', 'update', 2, 0, 2, 'yes', 1270738665);
INSERT INTO `elgg_system_log` VALUES(77, 41, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738676);
INSERT INTO `elgg_system_log` VALUES(78, 40, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738676);
INSERT INTO `elgg_system_log` VALUES(79, 39, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738676);
INSERT INTO `elgg_system_log` VALUES(80, 38, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738676);
INSERT INTO `elgg_system_log` VALUES(81, 37, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738676);
INSERT INTO `elgg_system_log` VALUES(82, 36, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738676);
INSERT INTO `elgg_system_log` VALUES(83, 35, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738676);
INSERT INTO `elgg_system_log` VALUES(84, 42, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738676);
INSERT INTO `elgg_system_log` VALUES(85, 43, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738676);
INSERT INTO `elgg_system_log` VALUES(86, 44, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738676);
INSERT INTO `elgg_system_log` VALUES(87, 45, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738676);
INSERT INTO `elgg_system_log` VALUES(88, 46, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738676);
INSERT INTO `elgg_system_log` VALUES(89, 47, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738676);
INSERT INTO `elgg_system_log` VALUES(90, 48, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738676);
INSERT INTO `elgg_system_log` VALUES(91, 49, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738676);
INSERT INTO `elgg_system_log` VALUES(92, 50, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738676);
INSERT INTO `elgg_system_log` VALUES(93, 51, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738676);
INSERT INTO `elgg_system_log` VALUES(94, 27, 'ElggMetadata', 'metadata', 'pluginorder', 'update', 2, 0, 2, 'yes', 1270738676);
INSERT INTO `elgg_system_log` VALUES(95, 50, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738716);
INSERT INTO `elgg_system_log` VALUES(96, 49, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738716);
INSERT INTO `elgg_system_log` VALUES(97, 48, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738716);
INSERT INTO `elgg_system_log` VALUES(98, 47, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738716);
INSERT INTO `elgg_system_log` VALUES(99, 46, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738716);
INSERT INTO `elgg_system_log` VALUES(100, 45, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738716);
INSERT INTO `elgg_system_log` VALUES(101, 44, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738716);
INSERT INTO `elgg_system_log` VALUES(102, 43, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738716);
INSERT INTO `elgg_system_log` VALUES(103, 51, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738716);
INSERT INTO `elgg_system_log` VALUES(104, 52, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738716);
INSERT INTO `elgg_system_log` VALUES(105, 53, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738716);
INSERT INTO `elgg_system_log` VALUES(106, 54, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738716);
INSERT INTO `elgg_system_log` VALUES(107, 55, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738716);
INSERT INTO `elgg_system_log` VALUES(108, 56, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738716);
INSERT INTO `elgg_system_log` VALUES(109, 57, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738716);
INSERT INTO `elgg_system_log` VALUES(110, 58, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738716);
INSERT INTO `elgg_system_log` VALUES(111, 59, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738716);
INSERT INTO `elgg_system_log` VALUES(112, 60, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738716);
INSERT INTO `elgg_system_log` VALUES(113, 61, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738716);
INSERT INTO `elgg_system_log` VALUES(114, 27, 'ElggMetadata', 'metadata', 'pluginorder', 'update', 2, 0, 2, 'yes', 1270738717);
INSERT INTO `elgg_system_log` VALUES(115, 60, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738722);
INSERT INTO `elgg_system_log` VALUES(116, 59, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738722);
INSERT INTO `elgg_system_log` VALUES(117, 58, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738722);
INSERT INTO `elgg_system_log` VALUES(118, 57, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738722);
INSERT INTO `elgg_system_log` VALUES(119, 56, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738722);
INSERT INTO `elgg_system_log` VALUES(120, 55, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738722);
INSERT INTO `elgg_system_log` VALUES(121, 54, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738722);
INSERT INTO `elgg_system_log` VALUES(122, 53, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738722);
INSERT INTO `elgg_system_log` VALUES(123, 52, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738722);
INSERT INTO `elgg_system_log` VALUES(124, 61, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738722);
INSERT INTO `elgg_system_log` VALUES(125, 62, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738722);
INSERT INTO `elgg_system_log` VALUES(126, 63, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738722);
INSERT INTO `elgg_system_log` VALUES(127, 64, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738722);
INSERT INTO `elgg_system_log` VALUES(128, 65, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738722);
INSERT INTO `elgg_system_log` VALUES(129, 66, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738722);
INSERT INTO `elgg_system_log` VALUES(130, 67, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738722);
INSERT INTO `elgg_system_log` VALUES(131, 68, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738722);
INSERT INTO `elgg_system_log` VALUES(132, 69, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738722);
INSERT INTO `elgg_system_log` VALUES(133, 70, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738722);
INSERT INTO `elgg_system_log` VALUES(134, 71, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738722);
INSERT INTO `elgg_system_log` VALUES(135, 72, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738722);
INSERT INTO `elgg_system_log` VALUES(136, 27, 'ElggMetadata', 'metadata', 'pluginorder', 'update', 2, 0, 2, 'yes', 1270738722);
INSERT INTO `elgg_system_log` VALUES(137, 71, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738726);
INSERT INTO `elgg_system_log` VALUES(138, 70, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738726);
INSERT INTO `elgg_system_log` VALUES(139, 69, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738726);
INSERT INTO `elgg_system_log` VALUES(140, 68, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738726);
INSERT INTO `elgg_system_log` VALUES(141, 67, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738726);
INSERT INTO `elgg_system_log` VALUES(142, 66, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738726);
INSERT INTO `elgg_system_log` VALUES(143, 65, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738726);
INSERT INTO `elgg_system_log` VALUES(144, 64, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738726);
INSERT INTO `elgg_system_log` VALUES(145, 63, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738726);
INSERT INTO `elgg_system_log` VALUES(146, 62, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738726);
INSERT INTO `elgg_system_log` VALUES(147, 72, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738726);
INSERT INTO `elgg_system_log` VALUES(148, 73, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738726);
INSERT INTO `elgg_system_log` VALUES(149, 74, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738726);
INSERT INTO `elgg_system_log` VALUES(150, 75, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738726);
INSERT INTO `elgg_system_log` VALUES(151, 76, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738726);
INSERT INTO `elgg_system_log` VALUES(152, 77, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738726);
INSERT INTO `elgg_system_log` VALUES(153, 78, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738726);
INSERT INTO `elgg_system_log` VALUES(154, 79, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738726);
INSERT INTO `elgg_system_log` VALUES(155, 80, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738726);
INSERT INTO `elgg_system_log` VALUES(156, 81, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738726);
INSERT INTO `elgg_system_log` VALUES(157, 82, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738726);
INSERT INTO `elgg_system_log` VALUES(158, 83, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738726);
INSERT INTO `elgg_system_log` VALUES(159, 84, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738726);
INSERT INTO `elgg_system_log` VALUES(160, 27, 'ElggMetadata', 'metadata', 'pluginorder', 'update', 2, 0, 2, 'yes', 1270738727);
INSERT INTO `elgg_system_log` VALUES(161, 83, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738734);
INSERT INTO `elgg_system_log` VALUES(162, 82, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738734);
INSERT INTO `elgg_system_log` VALUES(163, 81, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738734);
INSERT INTO `elgg_system_log` VALUES(164, 80, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738734);
INSERT INTO `elgg_system_log` VALUES(165, 79, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738734);
INSERT INTO `elgg_system_log` VALUES(166, 78, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738734);
INSERT INTO `elgg_system_log` VALUES(167, 77, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738734);
INSERT INTO `elgg_system_log` VALUES(168, 76, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738734);
INSERT INTO `elgg_system_log` VALUES(169, 75, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738734);
INSERT INTO `elgg_system_log` VALUES(170, 74, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738734);
INSERT INTO `elgg_system_log` VALUES(171, 73, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738734);
INSERT INTO `elgg_system_log` VALUES(172, 84, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1270738734);
INSERT INTO `elgg_system_log` VALUES(173, 85, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738734);
INSERT INTO `elgg_system_log` VALUES(174, 86, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738734);
INSERT INTO `elgg_system_log` VALUES(175, 87, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738734);
INSERT INTO `elgg_system_log` VALUES(176, 88, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738734);
INSERT INTO `elgg_system_log` VALUES(177, 89, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738734);
INSERT INTO `elgg_system_log` VALUES(178, 90, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738734);
INSERT INTO `elgg_system_log` VALUES(179, 91, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738734);
INSERT INTO `elgg_system_log` VALUES(180, 92, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738734);
INSERT INTO `elgg_system_log` VALUES(181, 93, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738734);
INSERT INTO `elgg_system_log` VALUES(182, 94, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738734);
INSERT INTO `elgg_system_log` VALUES(183, 95, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738734);
INSERT INTO `elgg_system_log` VALUES(184, 96, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738734);
INSERT INTO `elgg_system_log` VALUES(185, 97, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1270738734);
INSERT INTO `elgg_system_log` VALUES(186, 27, 'ElggMetadata', 'metadata', 'pluginorder', 'update', 2, 0, 2, 'yes', 1270738734);
INSERT INTO `elgg_system_log` VALUES(187, 3, 'ElggPlugin', 'object', 'plugin', 'create', 2, 2, 2, 'yes', 1270738744);
INSERT INTO `elgg_system_log` VALUES(188, 3, 'ElggPlugin', 'object', 'plugin', 'update', 2, 2, 2, 'yes', 1270738744);
INSERT INTO `elgg_system_log` VALUES(189, 27, 'ElggMetadata', 'metadata', 'pluginorder', 'update', 2, 0, 2, 'yes', 1270738744);
INSERT INTO `elgg_system_log` VALUES(190, 2, 'ElggUser', 'user', '', 'update', 2, 0, 2, 'yes', 1271953078);
INSERT INTO `elgg_system_log` VALUES(191, 2, 'ElggUser', 'user', '', 'login', 2, 0, 2, 'yes', 1271953078);
INSERT INTO `elgg_system_log` VALUES(192, 2, 'ElggUser', 'user', '', 'update', 2, 0, 2, 'yes', 1271953149);
INSERT INTO `elgg_system_log` VALUES(193, 1, 'ElggMetadata', 'metadata', 'email', 'update', 2, 0, 2, 'yes', 1271953163);
INSERT INTO `elgg_system_log` VALUES(194, 2, 'ElggRelationship', 'relationship', 'member_of_site', 'create', 2, 0, 2, 'yes', 1271953203);
INSERT INTO `elgg_system_log` VALUES(195, 4, 'ElggUser', 'user', '', 'create', 2, 0, 2, 'yes', 1271953203);
INSERT INTO `elgg_system_log` VALUES(196, 98, 'ElggMetadata', 'metadata', 'notification:method:email', 'create', 2, 0, 2, 'yes', 1271953203);
INSERT INTO `elgg_system_log` VALUES(197, 4, 'ElggUser', 'user', '', 'update', 2, 0, 2, 'yes', 1271953203);
INSERT INTO `elgg_system_log` VALUES(198, 99, 'ElggMetadata', 'metadata', 'admin_created', 'create', 2, 0, 2, 'yes', 1271953203);
INSERT INTO `elgg_system_log` VALUES(199, 100, 'ElggMetadata', 'metadata', 'created_by_guid', 'create', 2, 0, 2, 'yes', 1271953203);
INSERT INTO `elgg_system_log` VALUES(200, 101, 'ElggMetadata', 'metadata', 'validated', 'create', 2, 0, 2, 'yes', 1271953203);
INSERT INTO `elgg_system_log` VALUES(201, 102, 'ElggMetadata', 'metadata', 'validated_method', 'create', 2, 0, 2, 'yes', 1271953203);
INSERT INTO `elgg_system_log` VALUES(202, 3, 'ElggRelationship', 'relationship', 'member_of_site', 'create', 2, 0, 2, 'yes', 1271954074);
INSERT INTO `elgg_system_log` VALUES(203, 5, 'ElggUser', 'user', '', 'create', 2, 0, 2, 'yes', 1271954074);
INSERT INTO `elgg_system_log` VALUES(204, 103, 'ElggMetadata', 'metadata', 'notification:method:email', 'create', 2, 0, 2, 'yes', 1271954074);
INSERT INTO `elgg_system_log` VALUES(205, 5, 'ElggUser', 'user', '', 'update', 2, 0, 2, 'yes', 1271954074);
INSERT INTO `elgg_system_log` VALUES(206, 104, 'ElggMetadata', 'metadata', 'admin_created', 'create', 2, 0, 2, 'yes', 1271954074);
INSERT INTO `elgg_system_log` VALUES(207, 105, 'ElggMetadata', 'metadata', 'created_by_guid', 'create', 2, 0, 2, 'yes', 1271954074);
INSERT INTO `elgg_system_log` VALUES(208, 106, 'ElggMetadata', 'metadata', 'validated', 'create', 2, 0, 2, 'yes', 1271954074);
INSERT INTO `elgg_system_log` VALUES(209, 107, 'ElggMetadata', 'metadata', 'validated_method', 'create', 2, 0, 2, 'yes', 1271954074);
INSERT INTO `elgg_system_log` VALUES(210, 5, 'ElggUser', 'user', '', 'update', 2, 0, 2, 'yes', 1271954086);
INSERT INTO `elgg_system_log` VALUES(211, 27, 'ElggMetadata', 'metadata', 'pluginorder', 'update', 2, 0, 2, 'yes', 1271954100);
INSERT INTO `elgg_system_log` VALUES(212, 4, 'ElggRelationship', 'relationship', 'member_of_site', 'create', 2, 0, 2, 'yes', 1271954128);
INSERT INTO `elgg_system_log` VALUES(213, 6, 'ElggUser', 'user', '', 'create', 2, 0, 2, 'yes', 1271954128);
INSERT INTO `elgg_system_log` VALUES(214, 108, 'ElggMetadata', 'metadata', 'notification:method:email', 'create', 2, 0, 2, 'yes', 1271954128);
INSERT INTO `elgg_system_log` VALUES(215, 6, 'ElggUser', 'user', '', 'update', 2, 0, 2, 'yes', 1271954128);
INSERT INTO `elgg_system_log` VALUES(216, 109, 'ElggMetadata', 'metadata', 'admin_created', 'create', 2, 0, 2, 'yes', 1271954128);
INSERT INTO `elgg_system_log` VALUES(217, 110, 'ElggMetadata', 'metadata', 'created_by_guid', 'create', 2, 0, 2, 'yes', 1271954128);
INSERT INTO `elgg_system_log` VALUES(218, 111, 'ElggMetadata', 'metadata', 'validated', 'create', 2, 0, 2, 'yes', 1271954128);
INSERT INTO `elgg_system_log` VALUES(219, 112, 'ElggMetadata', 'metadata', 'validated_method', 'create', 2, 0, 2, 'yes', 1271954128);
INSERT INTO `elgg_system_log` VALUES(220, 5, 'ElggRelationship', 'relationship', 'member_of_site', 'create', 2, 0, 2, 'yes', 1271954151);
INSERT INTO `elgg_system_log` VALUES(221, 7, 'ElggUser', 'user', '', 'create', 2, 0, 2, 'yes', 1271954151);
INSERT INTO `elgg_system_log` VALUES(222, 113, 'ElggMetadata', 'metadata', 'notification:method:email', 'create', 2, 0, 2, 'yes', 1271954151);
INSERT INTO `elgg_system_log` VALUES(223, 7, 'ElggUser', 'user', '', 'update', 2, 0, 2, 'yes', 1271954151);
INSERT INTO `elgg_system_log` VALUES(224, 114, 'ElggMetadata', 'metadata', 'admin_created', 'create', 2, 0, 2, 'yes', 1271954151);
INSERT INTO `elgg_system_log` VALUES(225, 115, 'ElggMetadata', 'metadata', 'created_by_guid', 'create', 2, 0, 2, 'yes', 1271954151);
INSERT INTO `elgg_system_log` VALUES(226, 116, 'ElggMetadata', 'metadata', 'validated', 'create', 2, 0, 2, 'yes', 1271954151);
INSERT INTO `elgg_system_log` VALUES(227, 117, 'ElggMetadata', 'metadata', 'validated_method', 'create', 2, 0, 2, 'yes', 1271954151);
INSERT INTO `elgg_system_log` VALUES(228, 6, 'ElggRelationship', 'relationship', 'member_of_site', 'create', 2, 0, 2, 'yes', 1271954182);
INSERT INTO `elgg_system_log` VALUES(229, 8, 'ElggUser', 'user', '', 'create', 2, 0, 2, 'yes', 1271954182);
INSERT INTO `elgg_system_log` VALUES(230, 118, 'ElggMetadata', 'metadata', 'notification:method:email', 'create', 2, 0, 2, 'yes', 1271954182);
INSERT INTO `elgg_system_log` VALUES(231, 8, 'ElggUser', 'user', '', 'update', 2, 0, 2, 'yes', 1271954182);
INSERT INTO `elgg_system_log` VALUES(232, 119, 'ElggMetadata', 'metadata', 'admin_created', 'create', 2, 0, 2, 'yes', 1271954182);
INSERT INTO `elgg_system_log` VALUES(233, 120, 'ElggMetadata', 'metadata', 'created_by_guid', 'create', 2, 0, 2, 'yes', 1271954182);
INSERT INTO `elgg_system_log` VALUES(234, 121, 'ElggMetadata', 'metadata', 'validated', 'create', 2, 0, 2, 'yes', 1271954182);
INSERT INTO `elgg_system_log` VALUES(235, 122, 'ElggMetadata', 'metadata', 'validated_method', 'create', 2, 0, 2, 'yes', 1271954182);
INSERT INTO `elgg_system_log` VALUES(236, 2, 'ElggUser', 'user', '', 'logout', 2, 0, 2, 'yes', 1271954187);
INSERT INTO `elgg_system_log` VALUES(237, 2, 'ElggUser', 'user', '', 'update', 2, 0, 2, 'yes', 1271954187);
INSERT INTO `elgg_system_log` VALUES(238, 4, 'ElggUser', 'user', '', 'update', 4, 0, 2, 'yes', 1271954194);
INSERT INTO `elgg_system_log` VALUES(239, 4, 'ElggUser', 'user', '', 'login', 4, 0, 2, 'yes', 1271954194);
INSERT INTO `elgg_system_log` VALUES(240, 7, 'ElggRelationship', 'relationship', 'friend', 'create', 4, 0, 2, 'yes', 1271954209);
INSERT INTO `elgg_system_log` VALUES(241, 8, 'ElggRelationship', 'relationship', 'friend', 'create', 4, 0, 2, 'yes', 1271954219);
INSERT INTO `elgg_system_log` VALUES(242, 4, 'ElggUser', 'user', '', 'logout', 4, 0, 2, 'yes', 1271954231);
INSERT INTO `elgg_system_log` VALUES(243, 4, 'ElggUser', 'user', '', 'update', 4, 0, 2, 'yes', 1271954231);
INSERT INTO `elgg_system_log` VALUES(244, 5, 'ElggUser', 'user', '', 'update', 5, 0, 2, 'yes', 1271954240);
INSERT INTO `elgg_system_log` VALUES(245, 5, 'ElggUser', 'user', '', 'login', 5, 0, 2, 'yes', 1271954240);
INSERT INTO `elgg_system_log` VALUES(246, 9, 'ElggRelationship', 'relationship', 'friend', 'create', 5, 0, 2, 'yes', 1271954250);
INSERT INTO `elgg_system_log` VALUES(247, 10, 'ElggRelationship', 'relationship', 'friend', 'create', 5, 0, 2, 'yes', 1271954266);
INSERT INTO `elgg_system_log` VALUES(248, 11, 'ElggRelationship', 'relationship', 'friend', 'create', 5, 0, 2, 'yes', 1271954273);
INSERT INTO `elgg_system_log` VALUES(249, 5, 'ElggUser', 'user', '', 'logout', 5, 0, 2, 'yes', 1271954274);
INSERT INTO `elgg_system_log` VALUES(250, 5, 'ElggUser', 'user', '', 'update', 5, 0, 2, 'yes', 1271954274);
INSERT INTO `elgg_system_log` VALUES(251, 6, 'ElggUser', 'user', '', 'update', 6, 0, 2, 'yes', 1271954282);
INSERT INTO `elgg_system_log` VALUES(252, 6, 'ElggUser', 'user', '', 'login', 6, 0, 2, 'yes', 1271954282);
INSERT INTO `elgg_system_log` VALUES(253, 12, 'ElggRelationship', 'relationship', 'friend', 'create', 6, 0, 2, 'yes', 1271954295);
INSERT INTO `elgg_system_log` VALUES(254, 13, 'ElggRelationship', 'relationship', 'friend', 'create', 6, 0, 2, 'yes', 1271954300);
INSERT INTO `elgg_system_log` VALUES(255, 14, 'ElggRelationship', 'relationship', 'friend', 'create', 6, 0, 2, 'yes', 1271954304);
INSERT INTO `elgg_system_log` VALUES(256, 6, 'ElggUser', 'user', '', 'logout', 6, 0, 2, 'yes', 1271954306);
INSERT INTO `elgg_system_log` VALUES(257, 6, 'ElggUser', 'user', '', 'update', 6, 0, 2, 'yes', 1271954306);
INSERT INTO `elgg_system_log` VALUES(258, 7, 'ElggUser', 'user', '', 'update', 7, 0, 2, 'yes', 1271954317);
INSERT INTO `elgg_system_log` VALUES(259, 7, 'ElggUser', 'user', '', 'login', 7, 0, 2, 'yes', 1271954317);
INSERT INTO `elgg_system_log` VALUES(260, 15, 'ElggRelationship', 'relationship', 'friend', 'create', 7, 0, 2, 'yes', 1271954368);
INSERT INTO `elgg_system_log` VALUES(261, 16, 'ElggRelationship', 'relationship', 'friend', 'create', 7, 0, 2, 'yes', 1271954373);
INSERT INTO `elgg_system_log` VALUES(262, 7, 'ElggUser', 'user', '', 'logout', 7, 0, 2, 'yes', 1271954395);
INSERT INTO `elgg_system_log` VALUES(263, 7, 'ElggUser', 'user', '', 'update', 7, 0, 2, 'yes', 1271954395);
INSERT INTO `elgg_system_log` VALUES(264, 8, 'ElggUser', 'user', '', 'update', 8, 0, 2, 'yes', 1271954400);
INSERT INTO `elgg_system_log` VALUES(265, 8, 'ElggUser', 'user', '', 'login', 8, 0, 2, 'yes', 1271954400);
INSERT INTO `elgg_system_log` VALUES(266, 8, 'ElggUser', 'user', '', 'logout', 8, 0, 2, 'yes', 1271954405);
INSERT INTO `elgg_system_log` VALUES(267, 8, 'ElggUser', 'user', '', 'update', 8, 0, 2, 'yes', 1271954405);
INSERT INTO `elgg_system_log` VALUES(268, 2, 'ElggUser', 'user', '', 'update', 2, 0, 2, 'yes', 1283196395);
INSERT INTO `elgg_system_log` VALUES(269, 2, 'ElggUser', 'user', '', 'login', 2, 0, 2, 'yes', 1283196395);
INSERT INTO `elgg_system_log` VALUES(270, 2, 'ElggUser', 'user', '', 'logout', 2, 0, 2, 'yes', 1283196403);
INSERT INTO `elgg_system_log` VALUES(271, 2, 'ElggUser', 'user', '', 'update', 2, 0, 2, 'yes', 1283196403);
INSERT INTO `elgg_system_log` VALUES(272, 2, 'ElggUser', 'user', '', 'update', 2, 0, 2, 'yes', 1283196406);
INSERT INTO `elgg_system_log` VALUES(273, 2, 'ElggUser', 'user', '', 'login', 2, 0, 2, 'yes', 1283196406);
INSERT INTO `elgg_system_log` VALUES(274, 2, 'ElggUser', 'user', '', 'logout', 2, 0, 2, 'yes', 1283196412);
INSERT INTO `elgg_system_log` VALUES(275, 2, 'ElggUser', 'user', '', 'update', 2, 0, 2, 'yes', 1283196412);
INSERT INTO `elgg_system_log` VALUES(276, 2, 'ElggUser', 'user', '', 'update', 2, 0, 2, 'yes', 1283971454);
INSERT INTO `elgg_system_log` VALUES(277, 2, 'ElggUser', 'user', '', 'login', 2, 0, 2, 'yes', 1283971454);
INSERT INTO `elgg_system_log` VALUES(278, 2, 'ElggUser', 'user', '', 'logout', 2, 0, 2, 'yes', 1283971465);
INSERT INTO `elgg_system_log` VALUES(279, 2, 'ElggUser', 'user', '', 'update', 2, 0, 2, 'yes', 1283971465);
INSERT INTO `elgg_system_log` VALUES(280, 2, 'ElggUser', 'user', '', 'update', 2, 0, 2, 'yes', 1290799668);
INSERT INTO `elgg_system_log` VALUES(281, 2, 'ElggUser', 'user', '', 'login', 2, 0, 2, 'yes', 1290799668);
INSERT INTO `elgg_system_log` VALUES(282, 2, 'ElggUser', 'user', '', 'logout', 2, 0, 2, 'yes', 1290799676);
INSERT INTO `elgg_system_log` VALUES(283, 2, 'ElggUser', 'user', '', 'update', 2, 0, 2, 'yes', 1290799676);
INSERT INTO `elgg_system_log` VALUES(284, 2, 'ElggUser', 'user', '', 'update', 2, 0, 2, 'yes', 1290799679);
INSERT INTO `elgg_system_log` VALUES(285, 2, 'ElggUser', 'user', '', 'login', 2, 0, 2, 'yes', 1290799679);
INSERT INTO `elgg_system_log` VALUES(286, 2, 'ElggUser', 'user', '', 'logout', 2, 0, 2, 'yes', 1290799685);
INSERT INTO `elgg_system_log` VALUES(287, 2, 'ElggUser', 'user', '', 'update', 2, 0, 2, 'yes', 1290799685);
INSERT INTO `elgg_system_log` VALUES(288, 2, 'ElggUser', 'user', '', 'update', 2, 0, 2, 'yes', 1297861947);
INSERT INTO `elgg_system_log` VALUES(289, 2, 'ElggUser', 'user', '', 'login', 2, 0, 2, 'yes', 1297861947);
INSERT INTO `elgg_system_log` VALUES(290, 2, 'ElggUser', 'user', '', 'update', 2, 0, 2, 'yes', 1304619768);
INSERT INTO `elgg_system_log` VALUES(291, 2, 'ElggUser', 'user', '', 'login', 2, 0, 2, 'yes', 1304619768);
INSERT INTO `elgg_system_log` VALUES(292, 2, 'ElggUser', 'user', '', 'update', 2, 0, 2, 'yes', 1304619791);
INSERT INTO `elgg_system_log` VALUES(293, 2, 'ElggUser', 'user', '', 'logout', 2, 0, 2, 'yes', 1304619794);
INSERT INTO `elgg_system_log` VALUES(294, 2, 'ElggUser', 'user', '', 'update', 2, 0, 2, 'yes', 1304619794);
INSERT INTO `elgg_system_log` VALUES(295, 2, 'ElggUser', 'user', '', 'update', 2, 0, 2, 'yes', 1304619805);
INSERT INTO `elgg_system_log` VALUES(296, 2, 'ElggUser', 'user', '', 'login', 2, 0, 2, 'yes', 1304619805);
INSERT INTO `elgg_system_log` VALUES(297, 17, 'ElggRelationship', 'relationship', 'member_of_site', 'create', 2, 0, 2, 'yes', 1304619843);
INSERT INTO `elgg_system_log` VALUES(298, 9, 'ElggUser', 'user', '', 'create', 2, 0, 2, 'yes', 1304619843);
INSERT INTO `elgg_system_log` VALUES(299, 123, 'ElggMetadata', 'metadata', 'notification:method:email', 'create', 2, 0, 2, 'yes', 1304619843);
INSERT INTO `elgg_system_log` VALUES(300, 9, 'ElggUser', 'user', '', 'update', 2, 0, 2, 'yes', 1304619843);
INSERT INTO `elgg_system_log` VALUES(301, 9, 'ElggUser', 'user', '', 'make_admin', 2, 0, 2, 'yes', 1304619843);
INSERT INTO `elgg_system_log` VALUES(302, 124, 'ElggMetadata', 'metadata', 'admin_created', 'create', 2, 0, 2, 'yes', 1304619843);
INSERT INTO `elgg_system_log` VALUES(303, 125, 'ElggMetadata', 'metadata', 'created_by_guid', 'create', 2, 0, 2, 'yes', 1304619843);
INSERT INTO `elgg_system_log` VALUES(304, 126, 'ElggMetadata', 'metadata', 'validated', 'create', 2, 0, 2, 'yes', 1304619843);
INSERT INTO `elgg_system_log` VALUES(305, 127, 'ElggMetadata', 'metadata', 'validated_method', 'create', 2, 0, 2, 'yes', 1304619843);
INSERT INTO `elgg_system_log` VALUES(306, 2, 'ElggUser', 'user', '', 'logout', 2, 0, 2, 'yes', 1304619845);
INSERT INTO `elgg_system_log` VALUES(307, 2, 'ElggUser', 'user', '', 'update', 2, 0, 2, 'yes', 1304619845);
INSERT INTO `elgg_system_log` VALUES(308, 9, 'ElggUser', 'user', '', 'update', 9, 0, 2, 'yes', 1304619868);
INSERT INTO `elgg_system_log` VALUES(309, 9, 'ElggUser', 'user', '', 'login', 9, 0, 2, 'yes', 1304619868);
INSERT INTO `elgg_system_log` VALUES(310, 9, 'ElggUser', 'user', '', 'logout', 9, 0, 2, 'yes', 1304620139);
INSERT INTO `elgg_system_log` VALUES(311, 9, 'ElggUser', 'user', '', 'update', 9, 0, 2, 'yes', 1304620139);
INSERT INTO `elgg_system_log` VALUES(312, 2, 'ElggUser', 'user', '', 'update', 2, 0, 2, 'yes', 1304684599);
INSERT INTO `elgg_system_log` VALUES(313, 2, 'ElggUser', 'user', '', 'login', 2, 0, 2, 'yes', 1304684599);
INSERT INTO `elgg_system_log` VALUES(314, 2, 'ElggUser', 'user', '', 'logout', 2, 0, 2, 'yes', 1304684606);
INSERT INTO `elgg_system_log` VALUES(315, 2, 'ElggUser', 'user', '', 'update', 2, 0, 2, 'yes', 1304684606);
INSERT INTO `elgg_system_log` VALUES(316, 9, 'ElggUser', 'user', '', 'update', 9, 0, 2, 'yes', 1304684613);
INSERT INTO `elgg_system_log` VALUES(317, 9, 'ElggUser', 'user', '', 'login', 9, 0, 2, 'yes', 1304684613);
INSERT INTO `elgg_system_log` VALUES(318, 9, 'ElggUser', 'user', '', 'update', 9, 0, 2, 'yes', 1304684628);
INSERT INTO `elgg_system_log` VALUES(319, 9, 'ElggUser', 'user', '', 'logout', 9, 0, 2, 'yes', 1304684630);
INSERT INTO `elgg_system_log` VALUES(320, 9, 'ElggUser', 'user', '', 'update', 9, 0, 2, 'yes', 1304684630);
INSERT INTO `elgg_system_log` VALUES(321, 9, 'ElggUser', 'user', '', 'update', 9, 0, 2, 'yes', 1304684635);
INSERT INTO `elgg_system_log` VALUES(322, 9, 'ElggUser', 'user', '', 'login', 9, 0, 2, 'yes', 1304684635);
INSERT INTO `elgg_system_log` VALUES(323, 128, 'ElggMetadata', 'metadata', 'icontime', 'create', 9, 0, 2, 'yes', 1304684669);
INSERT INTO `elgg_system_log` VALUES(324, 9, 'ElggUser', 'user', '', 'profileiconupdate', 9, 0, 2, 'yes', 1304684669);
INSERT INTO `elgg_system_log` VALUES(325, 9, 'ElggUser', 'user', '', 'logout', 9, 0, 2, 'yes', 1304684679);
INSERT INTO `elgg_system_log` VALUES(326, 9, 'ElggUser', 'user', '', 'update', 9, 0, 2, 'yes', 1304684679);
INSERT INTO `elgg_system_log` VALUES(327, 9, 'ElggUser', 'user', '', 'update', 9, 0, 2, 'yes', 1304684685);
INSERT INTO `elgg_system_log` VALUES(328, 9, 'ElggUser', 'user', '', 'login', 9, 0, 2, 'yes', 1304684685);
INSERT INTO `elgg_system_log` VALUES(329, 9, 'ElggUser', 'user', '', 'logout', 9, 0, 2, 'yes', 1304684688);
INSERT INTO `elgg_system_log` VALUES(330, 9, 'ElggUser', 'user', '', 'update', 9, 0, 2, 'yes', 1304684688);
INSERT INTO `elgg_system_log` VALUES(331, 2, 'ElggUser', 'user', '', 'update', 2, 0, 2, 'yes', 1307031537);
INSERT INTO `elgg_system_log` VALUES(332, 2, 'ElggUser', 'user', '', 'login', 2, 0, 2, 'yes', 1307031537);
INSERT INTO `elgg_system_log` VALUES(333, 2, 'ElggUser', 'user', '', 'update', 2, 0, 2, 'yes', 1308593561);
INSERT INTO `elgg_system_log` VALUES(334, 2, 'ElggUser', 'user', '', 'login', 2, 0, 2, 'yes', 1308593561);
INSERT INTO `elgg_system_log` VALUES(335, 2, 'ElggUser', 'user', '', 'logout', 2, 0, 2, 'yes', 1308593564);
INSERT INTO `elgg_system_log` VALUES(336, 2, 'ElggUser', 'user', '', 'update', 2, 0, 2, 'yes', 1308593564);
INSERT INTO `elgg_system_log` VALUES(337, 2, 'ElggUser', 'user', '', 'update', 2, 0, 2, 'yes', 1315419235);
INSERT INTO `elgg_system_log` VALUES(338, 2, 'ElggUser', 'user', '', 'login', 2, 0, 2, 'yes', 1315419235);
INSERT INTO `elgg_system_log` VALUES(339, 27, 'ElggMetadata', 'metadata', 'pluginorder', 'update', 2, 0, 2, 'yes', 1315419238);
INSERT INTO `elgg_system_log` VALUES(340, 2, 'ElggUser', 'user', '', 'logout', 2, 0, 2, 'yes', 1315419244);
INSERT INTO `elgg_system_log` VALUES(341, 2, 'ElggUser', 'user', '', 'update', 2, 0, 2, 'yes', 1315419244);
INSERT INTO `elgg_system_log` VALUES(342, 2, 'ElggUser', 'user', '', 'update', 2, 0, 2, 'yes', 1332595637);
INSERT INTO `elgg_system_log` VALUES(343, 2, 'ElggUser', 'user', '', 'login', 2, 0, 2, 'yes', 1332595637);
INSERT INTO `elgg_system_log` VALUES(344, 27, 'ElggMetadata', 'metadata', 'pluginorder', 'update', 2, 0, 2, 'yes', 1332595637);
INSERT INTO `elgg_system_log` VALUES(345, 96, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(346, 95, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(347, 94, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(348, 93, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(349, 92, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(350, 91, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(351, 90, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(352, 89, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(353, 88, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(354, 87, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(355, 86, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(356, 85, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(357, 97, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(358, 129, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(359, 130, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(360, 131, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(361, 132, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(362, 133, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(363, 134, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(364, 135, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(365, 136, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(366, 137, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(367, 138, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(368, 139, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(369, 140, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(370, 141, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(371, 141, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(372, 140, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(373, 139, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(374, 138, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(375, 137, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(376, 136, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(377, 135, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(378, 134, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(379, 133, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(380, 132, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(381, 131, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(382, 130, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(383, 129, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(384, 142, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(385, 143, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(386, 144, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(387, 145, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(388, 146, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(389, 147, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(390, 148, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(391, 149, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(392, 150, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(393, 151, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(394, 152, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(395, 153, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(396, 154, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(397, 154, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(398, 153, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(399, 152, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(400, 151, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(401, 150, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(402, 149, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(403, 148, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(404, 147, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(405, 146, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(406, 145, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(407, 144, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(408, 143, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(409, 142, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(410, 155, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(411, 156, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(412, 157, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(413, 158, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(414, 159, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(415, 160, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(416, 161, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(417, 162, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(418, 163, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(419, 164, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(420, 165, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(421, 166, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(422, 166, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(423, 165, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(424, 164, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(425, 163, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(426, 162, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(427, 161, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(428, 160, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(429, 159, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(430, 158, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(431, 157, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(432, 156, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(433, 155, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(434, 167, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(435, 168, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(436, 169, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(437, 170, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(438, 171, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(439, 172, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(440, 173, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(441, 174, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(442, 175, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(443, 176, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(444, 177, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(445, 178, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(446, 178, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(447, 177, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(448, 176, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(449, 175, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(450, 174, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(451, 173, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(452, 172, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(453, 171, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(454, 170, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(455, 169, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(456, 168, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(457, 167, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(458, 179, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(459, 180, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(460, 181, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(461, 182, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(462, 183, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(463, 184, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(464, 185, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(465, 186, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(466, 187, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(467, 188, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(468, 189, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(469, 190, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(470, 190, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(471, 189, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(472, 188, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(473, 187, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(474, 186, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(475, 185, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(476, 184, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(477, 183, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(478, 182, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(479, 181, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(480, 180, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(481, 179, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(482, 191, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(483, 192, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(484, 193, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(485, 194, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(486, 195, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(487, 196, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(488, 197, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(489, 198, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(490, 199, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(491, 200, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(492, 201, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(493, 202, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(494, 202, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(495, 201, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(496, 200, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(497, 199, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(498, 198, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(499, 197, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(500, 196, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(501, 195, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(502, 194, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(503, 193, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(504, 192, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(505, 191, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(506, 203, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(507, 204, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(508, 205, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(509, 206, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(510, 207, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(511, 208, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(512, 209, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(513, 210, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(514, 211, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(515, 212, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(516, 213, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(517, 214, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(518, 214, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(519, 213, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(520, 212, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(521, 211, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(522, 210, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(523, 209, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(524, 208, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(525, 207, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(526, 206, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(527, 205, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(528, 204, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(529, 203, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(530, 215, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(531, 216, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(532, 217, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(533, 218, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(534, 219, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(535, 220, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(536, 221, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(537, 222, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(538, 223, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(539, 224, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(540, 225, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(541, 225, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(542, 224, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(543, 223, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(544, 222, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(545, 221, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(546, 220, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(547, 219, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(548, 218, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(549, 217, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(550, 216, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(551, 215, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(552, 226, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(553, 227, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(554, 228, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(555, 229, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(556, 230, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(557, 231, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(558, 232, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(559, 233, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(560, 234, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(561, 235, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(562, 236, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(563, 236, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(564, 235, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(565, 234, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(566, 233, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(567, 232, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(568, 231, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(569, 230, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(570, 229, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(571, 228, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(572, 227, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(573, 226, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(574, 237, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(575, 238, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(576, 239, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(577, 240, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(578, 241, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(579, 242, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(580, 243, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(581, 244, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(582, 245, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(583, 246, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(584, 246, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(585, 245, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(586, 244, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(587, 243, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(588, 242, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(589, 241, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(590, 240, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(591, 239, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(592, 238, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(593, 237, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(594, 247, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(595, 248, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(596, 249, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(597, 250, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(598, 251, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(599, 252, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(600, 253, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(601, 254, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(602, 255, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(603, 256, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(604, 256, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(605, 255, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(606, 254, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(607, 253, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(608, 252, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(609, 251, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(610, 250, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(611, 249, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(612, 248, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(613, 247, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(614, 257, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(615, 258, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(616, 259, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(617, 260, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(618, 261, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(619, 262, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(620, 263, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(621, 264, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(622, 265, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(623, 265, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(624, 264, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(625, 263, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(626, 262, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(627, 261, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(628, 260, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(629, 259, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(630, 258, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(631, 257, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(632, 266, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(633, 267, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(634, 268, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(635, 269, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(636, 270, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(637, 271, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(638, 272, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(639, 273, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(640, 274, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(641, 274, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(642, 273, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(643, 272, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(644, 271, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(645, 270, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595641);
INSERT INTO `elgg_system_log` VALUES(646, 269, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(647, 268, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(648, 267, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(649, 266, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(650, 275, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(651, 276, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(652, 277, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(653, 278, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(654, 279, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(655, 280, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(656, 281, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(657, 282, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(658, 283, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(659, 283, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(660, 282, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(661, 281, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(662, 280, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(663, 279, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(664, 278, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(665, 277, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(666, 276, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(667, 275, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(668, 284, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(669, 285, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(670, 286, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(671, 287, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(672, 288, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(673, 289, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(674, 290, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(675, 291, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(676, 291, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(677, 290, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(678, 289, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(679, 288, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(680, 287, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(681, 286, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(682, 285, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(683, 284, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(684, 292, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(685, 293, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(686, 294, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(687, 295, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(688, 296, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(689, 297, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(690, 298, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(691, 299, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(692, 299, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(693, 298, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(694, 297, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(695, 296, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(696, 295, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(697, 294, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(698, 293, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(699, 292, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(700, 300, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(701, 301, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(702, 302, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(703, 303, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(704, 304, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(705, 305, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(706, 306, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(707, 306, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(708, 305, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(709, 304, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(710, 303, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(711, 302, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(712, 301, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(713, 300, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(714, 307, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(715, 308, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(716, 309, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(717, 310, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(718, 311, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(719, 312, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(720, 313, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(721, 313, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(722, 312, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(723, 311, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(724, 310, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(725, 309, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(726, 308, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(727, 307, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(728, 314, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(729, 315, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(730, 316, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(731, 317, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(732, 318, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(733, 319, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(734, 319, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(735, 318, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(736, 317, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(737, 316, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(738, 315, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(739, 314, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(740, 320, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(741, 321, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(742, 322, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(743, 323, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(744, 324, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(745, 325, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(746, 325, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(747, 324, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(748, 323, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(749, 322, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(750, 321, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(751, 320, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(752, 326, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(753, 327, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(754, 328, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(755, 329, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(756, 330, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(757, 330, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(758, 329, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(759, 328, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(760, 327, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(761, 326, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(762, 331, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(763, 332, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(764, 333, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(765, 334, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(766, 334, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(767, 333, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(768, 332, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(769, 331, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(770, 335, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(771, 336, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(772, 337, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(773, 338, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(774, 338, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(775, 337, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(776, 336, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(777, 335, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(778, 339, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(779, 340, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(780, 341, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(781, 341, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(782, 340, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(783, 339, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(784, 342, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(785, 343, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(786, 344, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(787, 344, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(788, 343, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(789, 342, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(790, 345, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(791, 346, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(792, 346, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(793, 345, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(794, 347, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(795, 347, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(796, 348, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(797, 348, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(798, 349, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(799, 349, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(800, 350, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(801, 350, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(802, 351, 'ElggMetadata', 'metadata', 'enabled_plugins', 'create', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(803, 351, 'ElggMetadata', 'metadata', 'enabled_plugins', 'delete', 2, 0, 2, 'yes', 1332595642);
INSERT INTO `elgg_system_log` VALUES(804, 27, 'ElggMetadata', 'metadata', 'pluginorder', 'update', 2, 0, 2, 'yes', 1332595642);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_users_apisessions`
--

CREATE TABLE `elgg_users_apisessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_guid` bigint(20) unsigned NOT NULL,
  `site_guid` bigint(20) unsigned NOT NULL,
  `token` varchar(40) DEFAULT NULL,
  `expires` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_guid` (`user_guid`,`site_guid`),
  KEY `token` (`token`)
) ENGINE=MEMORY DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `elgg_users_apisessions`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_users_entity`
--

CREATE TABLE `elgg_users_entity` (
  `guid` bigint(20) unsigned NOT NULL,
  `name` text NOT NULL,
  `username` varchar(128) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `salt` varchar(8) NOT NULL DEFAULT '',
  `email` text NOT NULL,
  `language` varchar(6) NOT NULL DEFAULT '',
  `code` varchar(32) NOT NULL DEFAULT '',
  `banned` enum('yes','no') NOT NULL DEFAULT 'no',
  `admin` enum('yes','no') NOT NULL DEFAULT 'no',
  `last_action` int(11) NOT NULL DEFAULT '0',
  `prev_last_action` int(11) NOT NULL DEFAULT '0',
  `last_login` int(11) NOT NULL DEFAULT '0',
  `prev_last_login` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`guid`),
  UNIQUE KEY `username` (`username`),
  KEY `password` (`password`),
  KEY `email` (`email`(50)),
  KEY `code` (`code`),
  KEY `last_action` (`last_action`),
  KEY `last_login` (`last_login`),
  KEY `admin` (`admin`),
  FULLTEXT KEY `name` (`name`),
  FULLTEXT KEY `name_2` (`name`,`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `elgg_users_entity`
--

INSERT INTO `elgg_users_entity` VALUES(2, 'Administrator', 'socialadmin', '1f0f4a37684df8bbcf26f84e5cd577ef', '0deebb91', 'socialadmin@keetup.com', 'en', '', 'no', 'yes', 1332595642, 1332595642, 1332595637, 1315419235);
INSERT INTO `elgg_users_entity` VALUES(4, 'User1', 'user1', '26e5a569f4fcadbbd1a64a0cea351ce2', '2dccedff', 'user1@keetup.com', '', '', 'no', 'no', 1271954231, 1271954231, 1271954194, 0);
INSERT INTO `elgg_users_entity` VALUES(5, 'User2', 'user2', 'd643d6714b31c450ae26a2a2364bf026', '2e9a8372', 'user2@keetup.com', 'en', '', 'no', 'no', 1271954274, 1271954274, 1271954240, 0);
INSERT INTO `elgg_users_entity` VALUES(6, 'User3', 'user3', 'e17b5b6bd12bbbf834a5a6cca22069ca', '416189d9', 'user3@keetup.com', '', '', 'no', 'no', 1271954306, 1271954306, 1271954282, 0);
INSERT INTO `elgg_users_entity` VALUES(7, 'User4', 'user4', 'd9cde3065b0e8ccd4193f8cfad39614b', '50581f20', 'user4@keetup.com', '', '', 'no', 'no', 1271954394, 1271954395, 1271954317, 0);
INSERT INTO `elgg_users_entity` VALUES(8, 'Social Demo', 'socialdemo', 'c0e33f7874b4346ecd025b92fa455ac4', '22d507dd', 'demo@keetup.com', '', '', 'no', 'no', 1271954404, 1271954405, 1271954400, 0);
INSERT INTO `elgg_users_entity` VALUES(9, 'User Admin', 'useradmin', '63f085f969c1763c73d429fe8c632802', '82b73ac2', 'useradmin@keetup.com', 'en', '', 'no', 'yes', 1304684688, 1304684688, 1304684685, 1304684635);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elgg_users_sessions`
--

CREATE TABLE `elgg_users_sessions` (
  `session` varchar(255) NOT NULL,
  `ts` int(11) unsigned NOT NULL DEFAULT '0',
  `data` mediumblob,
  PRIMARY KEY (`session`),
  KEY `ts` (`ts`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `elgg_users_sessions`
--

INSERT INTO `elgg_users_sessions` VALUES('6c8865ac02d45d5cecba2e9e15f20ac7', 1315419225, 0x5f5f656c67675f73657373696f6e7c733a33323a223966366139386333643661633737333833663638613464383736373563386366223b766965777c733a373a2264656661756c74223b6d73677c613a303a7b7d);
INSERT INTO `elgg_users_sessions` VALUES('f9d50a3121bdbeb8cc8500755b534bb0', 1315419244, 0x5f5f656c67675f73657373696f6e7c733a33323a226534326530616530393230346563636435366530376135313331356430323137223b6d73677c613a303a7b7d766965777c733a373a2264656661756c74223b);
INSERT INTO `elgg_users_sessions` VALUES('875491a7832e03a175960fc2e67b4a1d', 1332595630, 0x5f5f656c67675f73657373696f6e7c733a33323a223434303931326438373333363265323236366161623330346638353238643035223b6c6173745f666f72776172645f66726f6d7c733a33393a22687474703a2f2f6c6f63616c2f656c6767626173652f70672f61646d696e2f706c7567696e732f223b6d73677c613a303a7b7d766965777c733a373a2264656661756c74223b);
INSERT INTO `elgg_users_sessions` VALUES('854a84b17812c7ddff55246f7d75d0aa', 1332595642, 0x5f5f656c67675f73657373696f6e7c733a33323a223434303931326438373333363265323236366161623330346638353238643035223b6d73677c613a303a7b7d766965777c733a373a2264656661756c74223b757365727c4f3a383a22456c676755736572223a373a7b733a31333a22002a0061747472696275746573223b613a32353a7b733a343a2267756964223b733a313a2232223b733a343a2274797065223b733a343a2275736572223b733a373a2273756274797065223b733a313a2230223b733a31303a226f776e65725f67756964223b733a313a2230223b733a31343a22636f6e7461696e65725f67756964223b733a313a2230223b733a393a22736974655f67756964223b733a313a2231223b733a393a226163636573735f6964223b733a313a2232223b733a31323a2274696d655f63726561746564223b733a31303a2231323730373338343834223b733a31323a2274696d655f75706461746564223b733a31303a2231333332353935363337223b733a31313a226c6173745f616374696f6e223b733a31303a2231333332353935363432223b733a373a22656e61626c6564223b733a333a22796573223b733a31323a227461626c65735f73706c6974223b693a323b733a31333a227461626c65735f6c6f61646564223b693a323b733a343a226e616d65223b733a31333a2241646d696e6973747261746f72223b733a383a22757365726e616d65223b733a31313a22736f6369616c61646d696e223b733a383a2270617373776f7264223b733a33323a223166306634613337363834646638626263663236663834653563643537376566223b733a343a2273616c74223b733a383a223064656562623931223b733a353a22656d61696c223b733a32323a22736f6369616c61646d696e406b65657475702e636f6d223b733a383a226c616e6775616765223b733a323a22656e223b733a343a22636f6465223b733a303a22223b733a363a2262616e6e6564223b733a323a226e6f223b733a353a2261646d696e223b733a333a22796573223b733a31363a22707265765f6c6173745f616374696f6e223b733a31303a2231333332353935363431223b733a31303a226c6173745f6c6f67696e223b733a31303a2231333332353935363337223b733a31353a22707265765f6c6173745f6c6f67696e223b733a31303a2231333135343139323335223b7d733a31353a22002a0075726c5f6f76657272696465223b4e3b733a31363a22002a0069636f6e5f6f76657272696465223b4e3b733a31363a22002a0074656d705f6d65746164617461223b613a303a7b7d733a31393a22002a0074656d705f616e6e6f746174696f6e73223b613a303a7b7d733a31313a22002a00766f6c6174696c65223b613a303a7b7d733a31373a2200456c6767456e746974790076616c6964223b623a303b7d677569647c733a313a2232223b69647c733a313a2232223b757365726e616d657c733a31313a22736f6369616c61646d696e223b6e616d657c733a31333a2241646d696e6973747261746f72223b);
