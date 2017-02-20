-- phpMyAdmin SQL Dump
-- version 4.4.13.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 20, 2017 at 10:52 PM
-- Server version: 5.6.31-0ubuntu0.15.10.1
-- PHP Version: 5.6.11-1ubuntu3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sadbhaw`
--

-- --------------------------------------------------------

--
-- Table structure for table `wp_sadbhaw_donators`
--

CREATE TABLE IF NOT EXISTS `wp_sadbhaw_donators` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `donated_amount` int(11) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_sadbhaw_donators`
--

INSERT INTO `wp_sadbhaw_donators` (`ID`, `name`, `email`, `address`, `zip`, `phone`, `donated_amount`, `verified`) VALUES
(1, 'Britanni Lynn', 'asd@gmail.com', 'Minim lorem labore consequuntur laboriosam aliquip officia facilis velit adipisci fugiat quasi facilis ipsam esse id', 'Sequi ducimus deserunt dolore velit sed architecto sed consectetur tenetur irure sit provident placeat illum excepteur provident nesciunt doloribus adipisicing', '63', 10000, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wp_sadbhaw_donators`
--
ALTER TABLE `wp_sadbhaw_donators`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wp_sadbhaw_donators`
--
ALTER TABLE `wp_sadbhaw_donators`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
