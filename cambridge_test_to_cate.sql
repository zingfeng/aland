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
-- Table structure for table `cambridge_test_to_cate`
--

CREATE TABLE IF NOT EXISTS `cambridge_test_to_cate` (
  `test_id` int(10) unsigned NOT NULL,
  `cate_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`test_id`,`cate_id`),
  KEY `fk_test_to_cate_2` (`cate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `test_to_cate`
--
ALTER TABLE `cambridge_test_to_cate`
  ADD CONSTRAINT `fk_test_to_cate_1` FOREIGN KEY (`test_id`) REFERENCES `cambridge_test` (`test_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_test_to_cate_2` FOREIGN KEY (`cate_id`) REFERENCES `cambridge_test_cate` (`cate_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
