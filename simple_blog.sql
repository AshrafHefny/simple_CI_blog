-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 14, 2015 at 02:17 AM
-- Server version: 5.5.41-0ubuntu0.14.04.1
-- PHP Version: 5.6.14-1+deb.sury.org~trusty+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `simple_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cat_icon` varchar(200) DEFAULT NULL,
  `cat_name_en` varchar(400) DEFAULT NULL,
  `cat_name_ar` varchar(500) DEFAULT NULL,
  `cat_created` datetime NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_icon`, `cat_name_en`, `cat_name_ar`, `cat_created`) VALUES
(18, NULL, 'Category 1', NULL, '2015-11-13 22:39:21'),
(19, NULL, 'Category 2', NULL, '2015-11-13 22:43:45'),
(20, NULL, 'Category 3', NULL, '2015-11-13 22:51:14'),
(22, NULL, 'Category 5', NULL, '2015-11-13 22:51:25'),
(23, NULL, 'Category 6', NULL, '2015-11-13 22:51:30');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `gro_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gro_name_en` varchar(250) NOT NULL,
  `gro_name_ar` varchar(250) NOT NULL,
  `gro_created` datetime DEFAULT NULL,
  `gro_lastUpdate` datetime DEFAULT NULL,
  `gro_super_role` tinyint(1) NOT NULL DEFAULT '0',
  `gro_va` tinyint(4) NOT NULL DEFAULT '0',
  `gro_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `permission` longtext,
  PRIMARY KEY (`gro_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`gro_id`, `gro_name_en`, `gro_name_ar`, `gro_created`, `gro_lastUpdate`, `gro_super_role`, `gro_va`, `gro_deleted`, `permission`) VALUES
(1, 'super admin', 'الشركة', '2013-04-27 00:00:00', NULL, 1, 0, 0, NULL),
(2, 'admin', 'الادارة', '2013-04-27 00:00:00', NULL, 0, 0, 0, NULL),
(3, 'customer', 'عميل', '2013-04-27 00:00:00', NULL, 0, 0, 0, 'a:1:{i:0;s:15:"limitedRequests";}');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `img_id` int(11) NOT NULL AUTO_INCREMENT,
  `img_post_id` smallint(6) NOT NULL,
  `img_path` varchar(255) NOT NULL,
  `img_type` varchar(255) NOT NULL,
  `img_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`img_id`),
  KEY `img_post_id` (`img_post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE IF NOT EXISTS `language` (
  `lan_name_en` varchar(100) NOT NULL,
  `lan_name_ar` varchar(100) NOT NULL,
  UNIQUE KEY `name` (`lan_name_en`,`lan_name_ar`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`lan_name_en`, `lan_name_ar`) VALUES
('arabic', 'العربية'),
('english', 'الانجليزية');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `post_title` varchar(256) NOT NULL,
  `post_body` text NOT NULL,
  `post_category_id` smallint(6) NOT NULL,
  `post_created_date` datetime NOT NULL,
  `post_last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post_user_id` smallint(6) NOT NULL,
  `post_deleted` tinyint(2) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_title`, `post_body`, `post_category_id`, `post_created_date`, `post_last_updated`, `post_user_id`, `post_deleted`) VALUES
(1, 'Post One 1', '<p>Simple content for post one Simple content for post one Simple content for post one</p>', 22, '2015-11-14 00:21:00', '2015-11-13 22:21:00', 1, 0),
(2, 'Post Two', '<p>Simple Text for post Two&nbsp;</p>\n\n<p>Simple Text for post Two&nbsp;</p>', 18, '2015-11-14 00:38:46', '2015-11-13 22:38:46', 1, 0),
(3, 'Post By Editor', '<p>This post has been added by user with editor permission&nbsp;</p>', 20, '2015-11-14 01:05:56', '2015-11-13 23:05:56', 292, 0),
(4, 'test pagination', '<p>this post to test pagination in posts page</p>', 22, '2015-11-14 01:06:38', '2015-11-13 23:06:38', 292, 0),
(5, 'test post', '<p>test post &nbsp;test post &nbsp;test post&nbsp;</p>', 23, '2015-11-14 01:08:03', '2015-11-13 23:08:03', 292, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rules`
--

CREATE TABLE IF NOT EXISTS `rules` (
  `rul_id` int(11) NOT NULL AUTO_INCREMENT,
  `rul_slug` varchar(200) NOT NULL,
  `rul_name_en` varchar(300) NOT NULL,
  `rul_name_ar` varchar(300) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`rul_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=81 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `usr_id` smallint(20) NOT NULL AUTO_INCREMENT,
  `usr_name` varchar(200) NOT NULL,
  `usr_fname` varchar(50) NOT NULL,
  `usr_lname` varchar(50) NOT NULL,
  `usr_email` varchar(250) NOT NULL,
  `usr_password` varchar(250) NOT NULL,
  `gro_id` int(10) unsigned NOT NULL,
  `language` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `usr_created` datetime DEFAULT NULL,
  `usr_lastUpdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usr_insertedUser_id` bigint(20) unsigned NOT NULL,
  `usr_block` datetime DEFAULT NULL,
  `usr_userDoBlock` bigint(20) unsigned NOT NULL DEFAULT '0',
  `random` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`usr_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=293 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usr_id`, `usr_name`, `usr_fname`, `usr_lname`, `usr_email`, `usr_password`, `gro_id`, `language`, `active`, `usr_created`, `usr_lastUpdate`, `usr_insertedUser_id`, `usr_block`, `usr_userDoBlock`, `random`) VALUES
(1, 'ashrafhefny', 'Ashraf', 'Hefny ', 'company@system.com', '167ed033d3bcb4d842657b123559e1de', 2, 'english', 1, '2013-11-29 15:40:01', NULL, 0, NULL, 0, 'j1Svq8Epk35M7Z0AnFKichbSc'),
(292, 'islam', 'islam', 'Moahmmed', 'islam@php.net', '167ed033d3bcb4d842657b123559e1de', 3, '', 0, '2015-11-13 22:17:32', '2015-11-13 20:17:32', 0, NULL, 0, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`img_post_id`) REFERENCES `posts` (`post_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
