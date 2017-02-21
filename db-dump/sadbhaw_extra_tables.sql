-- phpMyAdmin SQL Dump
-- version 4.4.13.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 22, 2017 at 12:47 AM
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
-- Table structure for table `wp_sadbhaw_ambassadors`
--

CREATE TABLE IF NOT EXISTS `wp_sadbhaw_ambassadors` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_sadbhaw_ambassadors`
--

INSERT INTO `wp_sadbhaw_ambassadors` (`ID`, `name`, `address`, `email`) VALUES
(1, 'Aladdin Giles', 'Iure anim ipsa voluptas pariatur Itaque id est corporis delectus perferendis eiusmod repellendus Rerum sit neque nihil reprehenderit accusamus', 'davokif@yahoo.com');

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
  `pledged` tinyint(1) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_sadbhaw_donators`
--

INSERT INTO `wp_sadbhaw_donators` (`ID`, `name`, `email`, `address`, `zip`, `phone`, `donated_amount`, `pledged`, `verified`) VALUES
(2, 'Emma Harvey', 'tifebipyg@gmail.com', 'Ex velit qui neque velit ullamco autem occaecat similique quae', 'Facilis dolor reprehenderit pariatur Dolores ducimus incidunt', '10', 10000, 0, 0),
(3, 'Gareth Atkinson', 'dexoxuzor@yahoo.com', 'Nostrud autem laborum provident nostrud eaque exercitation iste aut sed', 'Suscipit quia aliquam aliquam laboris libero earum excepturi id dolores impedit sed veniam deserunt consequatur Incididunt voluptas id', '21', 20000, 0, 1),
(4, 'Silas Cervantes', 'liqupub@hotmail.com', 'Quidem vero est lorem hic fuga Commodo unde aut vitae aut officia cum', 'Excepteur corrupti pariatur Amet sed doloribus sequi ipsum eum', '97', 10000, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `wp_sadbhaw_partners`
--

CREATE TABLE IF NOT EXISTS `wp_sadbhaw_partners` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_sadbhaw_partners`
--

INSERT INTO `wp_sadbhaw_partners` (`ID`, `name`, `address`, `email`) VALUES
(1, 'Linus Tate', 'Proident voluptatem Autem atque proident voluptates duis omnis ea', 'laqubib@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `wp_sadbhaw_volunteers`
--

CREATE TABLE IF NOT EXISTS `wp_sadbhaw_volunteers` (
  `ID` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `gender` enum('male','female') NOT NULL,
  `education` varchar(255) DEFAULT NULL,
  `skill` text NOT NULL,
  `language` text NOT NULL,
  `availability` text NOT NULL,
  `transportation` varchar(255) DEFAULT NULL,
  `emergency` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_sadbhaw_volunteers`
--

INSERT INTO `wp_sadbhaw_volunteers` (`ID`, `first_name`, `last_name`, `email`, `address`, `city`, `phone`, `gender`, `education`, `skill`, `language`, `availability`, `transportation`, `emergency`) VALUES
(3, 'Rylee', 'Monroe', 'mixaduzyqa@yahoo.com', 'Sint quo ut nostrum voluptate quisquam velit in eius dolor ullam reprehenderit voluptas', 'Molestiae placeat perferendis quia sapiente sint alias labore id voluptatem impedit laborum Sit quis quaerat quibusdam', '+637-12-6645787', 'female', 'Graduate School', '[{"name":"Dora Villarreal","proficiency":"Amateur"},{"name":"Joan Holden","proficiency":"Amateur"},{"name":"Clementine Owen","proficiency":"Can Teach"}]', '[{"name":"Brendan Wyatt","proficiency":"Fluent"},{"name":"Brock Hart","proficiency":"Write"}]', '{"no_of_days":"1","days":{"Monday":"on","Tuesday":"on","Wednesday":"on","Thursday":"on"}}', 'Motorcycle', '{"first_name":"Myles","last_name":"Burnett","address":"Ut consequat Nesciunt quae provident minim consequatur Magni necessitatibus est eaque et ut sit sunt velit minim rerum nobis voluptas","city":"Quia dolore voluptatum et vel voluptatibus voluptatem non","phone":"+299-85-6613758"}'),
(4, 'Noelani', 'Sparks', 'faqocubali@gmail.com', 'Possimus est corporis in perferendis dolor delectus nostrud dolor mollit tempore aspernatur deserunt culpa ullam magna molestiae nulla', 'Necessitatibus quia voluptatum provident modi ullam sit doloribus', '+817-80-2610224', 'female', '11-12', '[{"name":"Georgia Coffey","proficiency":"Skilled"},{"name":"Caldwell Tucker","proficiency":"Skilled"},{"name":"Katelyn Richardson","proficiency":"Amateur"}]', '[{"name":"Jescie Snow","proficiency":"Read"},{"name":"Jakeem Le","proficiency":"Write"}]', '{"no_of_days":"2","days":{"Tuesday":"on","Wednesday":"on","Friday":"on"}}', 'Walk', '{"first_name":"Petra","last_name":"Delgado","address":"Dolorum consequatur Ex voluptas culpa aut reprehenderit pariatur Quasi sint omnis occaecat","city":"In quisquam et cum modi earum exercitation consectetur voluptate ea fuga Labore reiciendis rem dolor","phone":"+529-62-5357576"}');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wp_sadbhaw_ambassadors`
--
ALTER TABLE `wp_sadbhaw_ambassadors`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `wp_sadbhaw_donators`
--
ALTER TABLE `wp_sadbhaw_donators`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `wp_sadbhaw_partners`
--
ALTER TABLE `wp_sadbhaw_partners`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `wp_sadbhaw_volunteers`
--
ALTER TABLE `wp_sadbhaw_volunteers`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wp_sadbhaw_ambassadors`
--
ALTER TABLE `wp_sadbhaw_ambassadors`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `wp_sadbhaw_donators`
--
ALTER TABLE `wp_sadbhaw_donators`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `wp_sadbhaw_partners`
--
ALTER TABLE `wp_sadbhaw_partners`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `wp_sadbhaw_volunteers`
--
ALTER TABLE `wp_sadbhaw_volunteers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
