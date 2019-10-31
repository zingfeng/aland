-- phpMyAdmin SQL Dump
-- version 4.0.10.20
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 30, 2019 at 03:18 PM
-- Server version: 5.5.31
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `f6vn_garden`
--

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE IF NOT EXISTS `cambridge_test` (
  `test_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `images` varchar(255) DEFAULT NULL,
  `publish_time` int(11) DEFAULT NULL,
  `publish` tinyint(1) unsigned DEFAULT NULL,
  `original_cate` int(10) unsigned NOT NULL DEFAULT '0',
  `isclass` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `share_url` varchar(255) DEFAULT NULL,
  `mon_hoc` int(11) DEFAULT NULL,
  `video_id` int(10) DEFAULT NULL,
  `test_time` int(11) DEFAULT NULL,
  `score` tinyint(3) unsigned DEFAULT NULL,
  `score_params` varchar(255) DEFAULT NULL,
  `total_users` int(11) unsigned NOT NULL DEFAULT '0',
  `total_hit` int(11) unsigned NOT NULL DEFAULT '0',
  `is_room` tinyint(3) unsigned DEFAULT '0',
  `user_id` int(10) DEFAULT NULL,
  `create_time` int(10) unsigned DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`test_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1900 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
