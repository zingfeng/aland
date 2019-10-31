-- phpMyAdmin SQL Dump
-- version 4.0.10.20
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 30, 2019 at 03:19 PM
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
-- Table structure for table `cambridge_question`
--

CREATE TABLE IF NOT EXISTS `cambridge_question` (
  `question_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `images` varchar(255) DEFAULT NULL,
  `detail` text,
  `user_id` int(10) unsigned DEFAULT NULL,
  `sound` varchar(255) DEFAULT NULL,
  `publish` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `test_id` int(11) unsigned NOT NULL DEFAULT '0',
  `type` int(10) unsigned DEFAULT '0',
  `ordering` int(11) DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`question_id`),
  KEY `idx_question_id_pub` (`question_id`) USING BTREE,
  KEY `fk_question_1` (`test_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8176 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cambridge_question`
--
ALTER TABLE `cambridge_question`
  ADD CONSTRAINT `fk_question_1` FOREIGN KEY (`test_id`) REFERENCES `cambridge_test` (`test_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
