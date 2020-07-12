-- phpMyAdmin SQL Dump
-- version 2.6.0-rc2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Dec 09, 2004 at 02:57 PM
-- Server version: 4.0.22
-- PHP Version: 4.3.9
-- 
-- Database: `dev_xoops`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `digest_categories`
-- 

CREATE TABLE `digest_categories` (
  `category_id` int(8) unsigned NOT NULL auto_increment,
  `image` varchar(255) default NULL,
  `title` varchar(255) NOT NULL default '',
  `category_order` int(8) NOT NULL default '1',
  PRIMARY KEY  (`category_id`)
) TYPE=MyISAM;

-- 
-- Dumping data for table `digest_categories`
-- 

INSERT INTO `digest_categories` VALUES (1, 'xoopschina.gif', 'XOOPS', 1);
INSERT INTO `digest_categories` VALUES (2, 'php.gif', 'PHP+MySQL', 2);
INSERT INTO `digest_categories` VALUES (3, '', 'News', 3);
INSERT INTO `digest_categories` VALUES (4, 'newbb.gif', 'BBS', 4);

-- --------------------------------------------------------

-- 
-- Table structure for table `digest_digests`
-- 

CREATE TABLE `digest_digests` (
  `digest_id` int(8) unsigned NOT NULL auto_increment,
  `category_id` int(8) unsigned NOT NULL default '1',
  `digest_order` int(8) NOT NULL default '1',
  `online` int(1) NOT NULL default '1',
  `title` varchar(40) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `url` varchar(255) NOT NULL default '',
  `image` varchar(255) NOT NULL default '',
  `offset` int(4) unsigned NOT NULL default '0',
  `maxitems` int(4) unsigned NOT NULL default '0',
  `minlength` int(4) NOT NULL default '20',
  `charset` varchar(40) default NULL,
  `charset_inter` varchar(40) default NULL,
  `updatetime` int(4) unsigned NOT NULL default '60',
  `lastupdate` int(11) unsigned NOT NULL default '0',
  `reg_exp` varchar(255) default NULL,
  `criteria` varchar(255) default NULL,
  `items` text,
  PRIMARY KEY  (`digest_id`),
  KEY `category_id` (`category_id`)
) TYPE=MyISAM;

-- 
-- Dumping data for table `digest_digests`
-- 

INSERT INTO `digest_digests` VALUES (1, 1, 1, 1, 'XOOPS', 'XOOPS Official', 'http://xoops.org', 'xoops.gif', 0, 20, 10, '', '', 60, 0, '', 'viewtopic.php\\?topic_id', NULL);
INSERT INTO `digest_digests` VALUES (2, 1, 3, 1, 'XCN', 'XOOPS CHINA', 'http://xoops.org.cn', 'xoopschina.gif', 0, 20, 10, '', '', 60, 0, '', 'viewtopic.php\\?topic_id', NULL);
INSERT INTO `digest_digests` VALUES (3, 1, 5, 1, 'XF', 'XForge', 'http://www.xoopsforge.com', '', 0, 30, 20, '', '', 60, 0, '', 'index.php\\?showtopic=', NULL);
INSERT INTO `digest_digests` VALUES (4, 2, 2, 1, 'SPBLOG', 'SitePoint Blogs', 'http://www.sitepoint.com/blogs/', 'sitepoint.gif', 0, 30, 20, '', '', 60, 0, '', 'blog-post-view.php\\?id=', NULL);
INSERT INTO `digest_digests` VALUES (5, 2, 1, 1, 'SFNEWS', 'Source forge news', 'http://sourceforge.net/news/', 'sf.jpg', 0, 30, 20, '', '', 60, 0, '', 'forum.php\\?forum_id=', NULL);
INSERT INTO `digest_digests` VALUES (6, 3, 2, 1, 'SOHU', 'SOHU News', 'http://news.sohu.com/news_scrollnews.shtml', '', 0, 20, 20, '', '', 60, 0, '', 'shtml', NULL);
INSERT INTO `digest_digests` VALUES (7, 3, 1, 1, 'GOOGLE', 'Google News', 'http://news.google.com/?topic=t', 'google.gif', 0, 40, 20, '', '', 60, 0, '', '', NULL);