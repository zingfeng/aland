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
-- Table structure for table `cambridge_question_answer`
--

CREATE TABLE IF NOT EXISTS `cambridge_question_answer` (
  `answer_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(255) DEFAULT NULL,
  `question_id` int(10) unsigned DEFAULT NULL,
  `correct` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ordering` tinyint(1) unsigned NOT NULL,
  `sound` varchar(255) DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL,
  `object` varchar(255) DEFAULT NULL,
  `parent` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`answer_id`),
  KEY `idx_answer_quesID` (`question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32899 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cambridge_question_answer`
--
ALTER TABLE `cambridge_question_answer`
  ADD CONSTRAINT `fk_question_answer_1` FOREIGN KEY (`question_id`) REFERENCES `cambridge_question` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
