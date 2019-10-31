-- phpMyAdmin SQL Dump
-- version 4.0.10.20
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 31, 2019 at 09:58 AM
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
-- Table structure for table `cambridge_test_cate`
--

CREATE TABLE IF NOT EXISTS `cambridge_test_cate` (
  `cate_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL,
  `description` text,
  `ordering` int(10) unsigned NOT NULL DEFAULT '0',
  `parent` int(20) unsigned NOT NULL DEFAULT '0',
  `type` int(10) unsigned DEFAULT '1' COMMENT '1: nomal',
  `share_url` varchar(255) DEFAULT NULL,
  `seo_title` varchar(255) DEFAULT NULL,
  `seo_description` varchar(255) DEFAULT NULL,
  `seo_keyword` varchar(255) DEFAULT NULL,
  `create_time` int(10) unsigned DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `lang` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`cate_id`),
  KEY `fk_news_cate_1` (`parent`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=180 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
