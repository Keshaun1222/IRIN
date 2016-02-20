-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 15, 2016 at 07:34 AM
-- Server version: 5.5.45-cll-lve
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `irin`
--

-- --------------------------------------------------------

--
-- Table structure for table `codegen`
--

CREATE TABLE IF NOT EXISTS `codegen` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `code` varchar(15) NOT NULL,
  `user` int(7) NOT NULL,
  `purpose` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `awards`
--

CREATE TABLE IF NOT EXISTS `awards` (
  `userid` int(3) NOT NULL,
  `awards` varchar(150) DEFAULT NULL,
  `multi` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `awards`
--

INSERT INTO `awards` (`userid`) SELECT `id` FROM `users`;

-- --------------------------------------------------------

--
-- Table structure for table `awardslist`
--

CREATE TABLE IF NOT EXISTS `awardslist` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `abbrev` varchar(5) NOT NULL,
  `multi` tinyint(1) NOT NULL,
  `max` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`,`abbrev`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `awardslist`
--

INSERT INTO `awardslist` (`id`, `name`, `abbrev`, `multi`, `max`) VALUES
(1, 'Medal of Honor', 'HON', 0, NULL),
(2, 'Order of the Supreme Ruler''s Seal', 'OSRS', 0, NULL),
(3, 'Distinguished Service Medal', 'DSM', 0, NULL),
(4, 'Imperial Republic Cross', 'CRS', 0, NULL),
(5, 'Imperial Republic Gold Star', 'IRGS', 0, NULL),
(6, 'Imperial Republic Silver Star', 'IRSS', 0, NULL),
(7, 'Imperial Republic Bronze Star', 'IRBS', 0, NULL),
(8, 'Order of the Imperial Seal', 'OIRS', 0, NULL),
(9, 'Obsidian Crescent', 'OBC', 0, NULL),
(10, 'IRIS Cross', 'IRIC', 0, NULL),
(11, 'Army Cross', 'IRAC', 0, NULL),
(12, 'Navy Cross', 'IRNC', 0, NULL),
(13, 'COMPNOR Cross', 'CC', 0, NULL),
(14, 'Government Cross', 'IRGC', 0, NULL),
(15, 'Bravery Medal', 'IRBM', 0, NULL),
(16, 'Achievement Medal', 'ACH', 0, NULL),
(17, 'Army Betterment Award', 'A-BET', 0, NULL),
(18, 'Government Betterment Award', 'G-BET', 0, NULL),
(19, 'Navy Betterment Award', 'N-BET', 0, NULL),
(20, 'Commissioner of Betterment', 'COB', 0, NULL),
(21, 'Active Service Medal', 'IASM', 0, NULL),
(22, 'Defense Medal', 'IRDM', 0, NULL),
(23, 'Battle Efficiency Award', 'BEA', 0, NULL),
(24, 'Unit Distinguished Service Medal', 'UDS', 0, NULL),
(25, 'Exercise Achievement Medal', 'EAM', 0, NULL),
(26, 'Medical Performance Medal', 'MPM', 0, NULL),
(27, 'His Majesty''s Personal Staff', 'HMPS', 0, NULL),
(28, 'Certified Imperial Republic Security Agent', 'CIRSA', 0, NULL),
(29, 'Certified Imperial Republic Intelligence Agent', 'CIRIA', 0, NULL),
(30, 'COMPNOR Member Medal', 'HMNO', 0, NULL),
(31, 'StormCorps Member Medal', 'SCM', 0, NULL),
(32, 'Diplomatic Corps Medal', 'IRDC', 0, NULL),
(33, 'Ministry of Health Level 1', 'IMD-M', 0, NULL),
(34, 'Ministry of Health Level 2', 'IMD-A', 0, NULL),
(35, 'Ministry of Health Level 3', 'IMD-S', 0, NULL),
(36, 'Organizational Success Award', 'OSA', 1, 5),
(37, 'Literacy Award', 'IRLA', 0, NULL),
(38, 'Recruitment Award', 'IRR', 0, NULL),
(39, 'Letter of Commendation', 'LOC', 1, 5),
(40, 'Imperial Republic Service Medal', 'ISM', 1, 8),
(41, 'Corporate Service Award', 'CSA', 1, 8),
(42, 'IRIS Service Medal', 'IISM', 1, 24),
(43, 'COMPNOR Service Medal', 'CSM', 1, 24),
(44, 'Citizenship Award', 'IRCA', 0, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
