-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2015 at 05:11 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `GVC`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `Email` varchar(30) NOT NULL,
  `Password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE IF NOT EXISTS `activity` (
  `Act_Number` int(11) NOT NULL,
  `Place` varchar(80) NOT NULL,
  `Detail` text NOT NULL,
  `StartofTime` time NOT NULL,
  `EndofTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `friend`
--

CREATE TABLE IF NOT EXISTS `friend` (
  `EMail_Fri` int(11) NOT NULL,
  `Friend_Name` varchar(30) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Friend_Recent` text NOT NULL,
  `Friend_Figure` blob NOT NULL,
  `friend_gender` char(1) NOT NULL,
  `friend_birth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `friendactivity`
--

CREATE TABLE IF NOT EXISTS `friendactivity` (
  `Ref_Number_fri` int(11) NOT NULL,
  `Ref_Number` int(11) NOT NULL,
  `fri_Place` varchar(80) NOT NULL,
  `fri_Detail` text NOT NULL,
  `fri_StartTime` time NOT NULL,
  `fri_EndTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `RefNumber2` int(11) NOT NULL,
  `User_Name` varchar(30) NOT NULL,
  `User_Password` varchar(40) NOT NULL,
  `User_Address` varchar(50) NOT NULL,
  `User_DetailInfo` text NOT NULL,
  `User_Figure` blob NOT NULL,
  `GENDER` char(1) NOT NULL,
  `Birth` date NOT NULL,
  `User_Recent` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
 ADD PRIMARY KEY (`Email`), ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
 ADD PRIMARY KEY (`Act_Number`);

--
-- Indexes for table `friend`
--
ALTER TABLE `friend`
 ADD PRIMARY KEY (`EMail_Fri`), ADD KEY `Email` (`Email`);

--
-- Indexes for table `friendactivity`
--
ALTER TABLE `friendactivity`
 ADD PRIMARY KEY (`Ref_Number_fri`), ADD KEY `Ref_Number` (`Ref_Number`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
 ADD PRIMARY KEY (`RefNumber2`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
