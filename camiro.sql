-- phpMyAdmin SQL Dump
-- version 3.0.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 26, 2009 at 11:32 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `camiro`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `email` varchar(255) character set utf8 collate utf8_unicode_ci default NULL,
  `comment` text,
  `created` datetime default NULL,
  `content_id` int(11) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=81 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `name`, `email`, `comment`, `created`, `content_id`) VALUES
(70, 'mn', 'nm', 'nm', '2009-02-24 22:25:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

DROP TABLE IF EXISTS `contents`;
CREATE TABLE IF NOT EXISTS `contents` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(100) NOT NULL default '',
  `slug` varchar(100) NOT NULL,
  `contentbody` text NOT NULL,
  `state` tinyint(3) NOT NULL default '0',
  `parent_id` int(10) unsigned NOT NULL default '0',
  `created` datetime default NULL,
  `created_by` int(11) unsigned NOT NULL default '0',
  `modified` datetime default NULL,
  `modified_by` int(11) unsigned NOT NULL default '0',
  `version` int(11) unsigned NOT NULL default '1',
  `ordering` int(11) NOT NULL default '0',
  `metakey` varchar(255) default NULL,
  `metadesc` varchar(255) default NULL,
  `access` int(11) unsigned NOT NULL default '0',
  `comment` tinyint(1) default NULL,
  `hits` int(11) unsigned NOT NULL default '0',
  `properties` varchar(50) default NULL,
  PRIMARY KEY  (`id`),
  KEY `idx_parent` (`parent_id`),
  KEY `idx_access` (`access`),
  KEY `idx_state` (`state`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `title`, `slug`, `contentbody`, `state`, `parent_id`, `created`, `created_by`, `modified`, `modified_by`, `version`, `ordering`, `metakey`, `metadesc`, `access`, `comment`, `hits`, `properties`) VALUES
(1, 'Welcome to Camiro-CMS!', 'welcome-to-camiro-cms', '<p><b>Camiro-CMS</b> is a lightweight, modular and minimalist CMS written on top the CakePHP Framework.</p>\r\n<p>Unique CMS Features Include:</p>\r\n<ol>\r\n    <li>Robust ACL System taking advantage of native CakePHP''s ACL Component, manage who sees what</li>\r\n    <li>N-Level Content Hierarchy Structure, allowing you to organize your content as you demand it</li>\r\n    <li>Easy Skinning allows you to show your website as you want it</li>\r\n    <li>Fully Localizable Interface, and natively supports multilingual content</li>\r\n</ol>\r\n<p>A CMS that will not dictate you how to do things. Its time to take control, your CMS, your rules, your way!</p>', 1, 9, '2008-08-30 01:30:00', 1, '2009-02-24 18:44:17', 1, 1, 1, 'Sample Content Only', 'Sample Content Only', 4, 1, 1, 'frontpage=1'),
(9, 'CamiroCMS Features', 'camirocms-features', '<p>Lorem ipsum dolor sit amet, <a href="file:///C:/Documents%20and%20Settings/Meesheill/Desktop/Camiro/Camiro/index.html#"> adipisicing</a> elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>\r\n<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. <br />\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>', 1, 9, '2008-12-17 10:25:19', 1, '2009-02-23 22:37:23', 1, 1, 1, 'features', 'CamiroCMS Features', 6, 1, 1, ''),
(10, 'this is for the comments', 'this-is-for-the-comments', '<p>comment me slkfjasklfsjk</p>', 1, 0, '2009-02-12 00:05:48', 1, '2009-02-24 18:44:07', 1, 1, 1, '1', '1', 6, 1, 1, '1'),
(11, 'My first Content', 'my-first-content', '<p>the quick brown fox jumps over the lazy dog near the bank of the reiver...&nbsp; Ooops, i mispeeleed the river... oppps, agained.... syet....</p>', 1, 6, '2009-02-24 18:22:46', 1, '2009-02-24 18:23:00', 1, 1, 2, '1', '11', 6, 1, 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `content_containers`
--

DROP TABLE IF EXISTS `content_containers`;
CREATE TABLE IF NOT EXISTS `content_containers` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(50) NOT NULL default '',
  `created` datetime default NULL,
  `created_by` int(11) unsigned NOT NULL default '0',
  `modified` datetime default NULL,
  `modified_by` int(11) unsigned NOT NULL default '0',
  `description` text NOT NULL,
  `state` tinyint(3) NOT NULL default '0',
  `parent_id` int(10) unsigned NOT NULL,
  `lft` int(11) default NULL,
  `rght` int(11) default NULL,
  `access` tinyint(3) unsigned NOT NULL default '0',
  `properties` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `content_containers`
--

INSERT INTO `content_containers` (`id`, `title`, `created`, `created_by`, `modified`, `modified_by`, `description`, `state`, `parent_id`, `lft`, `rght`, `access`, `properties`) VALUES
(6, 'FAQ''s', '0000-00-00 00:00:00', 1, '2008-09-21 07:27:59', 1, '<p>This is a category for articles about man&nbsp;&nbsp;  &nbsp;</p>', 1, 0, 3, 4, 3, '1'),
(9, 'Introductions', '2008-09-21 07:16:56', 0, '2008-09-21 07:34:44', 0, '', 0, 0, 1, 2, 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Administrator', '2008-09-02 09:49:28', '2008-09-02 09:49:28'),
(3, 'Author', '2008-09-03 07:43:53', '2008-09-03 07:44:04'),
(4, 'Registered', '2008-09-03 07:44:26', '2008-09-03 07:44:26'),
(6, 'Public', '2008-09-18 13:56:37', '2008-09-18 13:56:37');

-- --------------------------------------------------------

--
-- Table structure for table `groups_permissions`
--

DROP TABLE IF EXISTS `groups_permissions`;
CREATE TABLE IF NOT EXISTS `groups_permissions` (
  `group_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups_permissions`
--

INSERT INTO `groups_permissions` (`group_id`, `permission_id`) VALUES
(1, 1),
(3, 7),
(3, 8),
(3, 9),
(3, 10),
(4, 11),
(4, 12);

-- --------------------------------------------------------

--
-- Table structure for table `groups_users`
--

DROP TABLE IF EXISTS `groups_users`;
CREATE TABLE IF NOT EXISTS `groups_users` (
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups_users`
--

INSERT INTO `groups_users` (`group_id`, `user_id`) VALUES
(4, 15),
(3, 2),
(4, 3),
(1, 1),
(4, 16),
(4, 17),
(4, 21);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) default NULL,
  `link` varchar(255) default NULL,
  `state` tinyint(3) NOT NULL default '0',
  `parentid` int(11) unsigned NOT NULL default '0',
  `container` int(11) unsigned NOT NULL default '0',
  `ordering` int(11) default '0',
  `access` int(11) unsigned NOT NULL default '0',
  `properties` varchar(255) default NULL,
  PRIMARY KEY  (`id`),
  KEY `container` (`container`),
  KEY `parentid` (`parentid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `link`, `state`, `parentid`, `container`, `ordering`, `access`, `properties`) VALUES
(2, 'All Contents', '/contents/index/all', 1, 2, 1, 2, 4, 'blog=1 external=0 special=0'),
(3, 'X-Project WebSite', 'http://x-project.site40.net', 1, 2, 2, 2, 4, 'blog=0 external=1 special=0'),
(1, 'Home', '/contents/index/front', 1, 0, 1, 1, 4, 'blog=0\nexternal=0\nspecial=home_link'),
(11, 'Features', '/contents/view/camirocms-features', 1, 2, 1, 1, 4, 'blog=0 external=0'),
(8, 'Join The Forum', 'http://x-project.site40.net/forums', 1, 2, 2, 2, 4, ''),
(9, 'Report BUGS!', 'http://x-project.site40.net/flyspray', 1, 2, 2, 3, 4, ''),
(10, 'Camiro CMS', 'http://code.google.com/p/camiro-cms/', 1, 0, 2, 1, 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu_containers`
--

DROP TABLE IF EXISTS `menu_containers`;
CREATE TABLE IF NOT EXISTS `menu_containers` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) default NULL,
  `state` tinyint(3) NOT NULL default '0',
  `parentid` int(10) unsigned NOT NULL,
  `ordering` int(11) default '0',
  `access` int(11) unsigned NOT NULL default '0',
  `properties` mediumtext,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `menu_containers`
--

INSERT INTO `menu_containers` (`id`, `name`, `state`, `parentid`, `ordering`, `access`, `properties`) VALUES
(2, 'External Links', 1, 0, 1, 4, NULL),
(1, 'Main Menu', 1, 0, 1, 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `created`, `modified`) VALUES
(1, '*', '2008-09-02 09:48:38', '2008-09-02 09:48:38'),
(4, 'users:*', '2008-09-03 07:41:49', '2008-09-03 07:41:49'),
(5, 'groups:*', '2008-09-03 07:42:05', '2008-09-03 07:42:05'),
(6, 'permissions:*', '2008-09-03 07:42:21', '2008-09-03 07:42:21'),
(7, 'contents:*', '2008-09-03 07:43:01', '2008-09-03 07:43:01'),
(8, 'menus:*', '2007-01-12 12:16:57', '2007-01-12 12:16:57'),
(9, 'trash:*', '2007-01-12 12:17:11', '2007-01-12 12:17:11'),
(10, 'main:*', '2007-01-12 12:27:31', '2007-01-12 12:27:31'),
(11, 'users:view', '2008-09-14 05:31:11', '2008-09-14 05:31:11'),
(12, 'users:edit', '2008-09-14 05:31:25', '2008-09-14 05:31:25'),
(13, 'contents:view', '2008-09-15 08:46:44', '2008-09-15 08:46:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `passwd` varchar(50) NOT NULL,
  `active` tinyint(3) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email_address`, `passwd`, `active`, `created`, `modified`) VALUES
(1, 'User Administrator', 'admin@x-project.com', '176ea2fbb1697cd3acd67bd187f12548c39dc0cb', 1, '2008-09-02 09:53:44', '2008-09-18 12:33:27'),
(2, 'User Author', 'author@x-project.com', '176ea2fbb1697cd3acd67bd187f12548c39dc0cb', 1, '2008-09-02 10:02:03', '2008-09-18 12:33:38'),
(3, 'User Registered', 'registered@x-project.com', '1b1fcba1d727077b564254fdaa9f0b0a', 1, '2008-09-03 07:51:59', '2008-09-18 12:51:36'),
(15, 'James Louie', 'test@x-project.com', 'a46e346c01e55be0c535c7789ca1fc29', 0, '2008-09-03 21:04:53', '2008-09-18 13:15:56'),
(16, 'LOuiek', '1dd@adf.com', '6c3cd8f3afcb330e0f8abbdf924f599dd3881c72', -2, '2008-09-14 05:28:52', '2008-09-18 12:33:55'),
(17, 'ttes', 'test@test.com', '6c3cd8f3afcb330e0f8abbdf924f599dd3881c72', -2, '2008-09-18 07:26:32', '2008-09-18 07:37:46'),
(21, 'asfafhjk', 'as@1ass.com', '61d401d87241eb2f65d7d46f6d64c2db', 0, '2008-09-18 12:52:31', '2008-09-18 13:01:49');
