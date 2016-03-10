-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 03, 2015 at 04:48 AM
-- Server version: 5.5.44-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `epam_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `flags`
--

CREATE TABLE IF NOT EXISTS `flags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `flags`
--

INSERT INTO `flags` (`id`, `name`, `value`) VALUES
(1, 'morning_water_last_notification', ''),
(2, 'noon_water_last_notification', ''),
(3, 'afternoon_water_last_notification', '');

-- --------------------------------------------------------

--
-- Table structure for table `flower_pots`
--

CREATE TABLE IF NOT EXISTS `flower_pots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `water_morning` smallint(6) DEFAULT '0',
  `water_noon` smallint(6) NOT NULL DEFAULT '0',
  `water_afternoon` smallint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`,`water_morning`,`created_at`,`updated_at`),
  KEY `water_morning` (`water_morning`),
  KEY `water_noon` (`water_noon`),
  KEY `water_afternoon` (`water_afternoon`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `flower_pots`
--

INSERT INTO `flower_pots` (`id`, `name`, `water_morning`, `water_noon`, `water_afternoon`, `created_at`, `updated_at`) VALUES
(2, 'Aster', 1, 0, 0, '2015-10-03 02:49:43', '0000-00-00 00:00:00'),
(3, 'Bird of Paradise', 0, 0, 1, '2015-10-03 02:49:54', '0000-00-00 00:00:00'),
(4, 'Blazing Star', 0, 0, 1, '2015-10-03 02:50:04', '0000-00-00 00:00:00'),
(5, 'Christmas Bells', 0, 1, 0, '2015-10-03 02:51:34', '0000-00-00 00:00:00'),
(6, 'Contra Costa Goldfields', 0, 0, 1, '2015-10-03 02:51:42', '0000-00-00 00:00:00'),
(7, 'Chilean Jasmine', 1, 1, 1, '2015-10-03 02:51:52', '0000-00-00 00:00:00'),
(8, 'Delphinium', 1, 0, 1, '2015-10-03 02:52:01', '0000-00-00 00:00:00'),
(9, 'Sunflowers', 0, 1, 0, '2015-10-03 02:57:49', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`) VALUES
(1, 'user_email', 'test@mail.com'),
(2, 'morning_water_time', '6:10 AM'),
(3, 'noon_water_time', '12:00 PM'),
(4, 'afternoon_water_time', '4:30 PM'),
(5, 'alert_advance_minutes', '30');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
