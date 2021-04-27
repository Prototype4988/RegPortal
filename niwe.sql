-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 27, 2021 at 05:46 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `niwe`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `SI_no` int(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`SI_no`, `Username`, `Password`) VALUES
(1, 'Victor', 0xa2d2556617),
(2, 'Liam', 0xa2d2556617c4),
(3, 'Joshua', 0xdbe6e6784b47),
(4, 'Ashwin', 0xdbe6e6784b4794),
(5, 'Lawrence', 0xdbe6e6784b47946c);

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `SI_no` int(255) NOT NULL,
  `NIWE_Reg_No` varchar(255) DEFAULT NULL,
  `Station_name` varchar(255) DEFAULT NULL,
  `village` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `commision_date` date DEFAULT NULL,
  `Client` varchar(255) DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `mast_height` int(255) DEFAULT NULL,
  `amount` int(255) DEFAULT NULL,
  `date_receipt` date DEFAULT NULL,
  `ddno` int(255) DEFAULT NULL,
  `followup` varchar(255) DEFAULT NULL,
  `survey_map` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`SI_no`, `NIWE_Reg_No`, `Station_name`, `village`, `district`, `state`, `commision_date`, `Client`, `latitude`, `longitude`, `mast_height`, `amount`, `date_receipt`, `ddno`, `followup`, `survey_map`, `comment`) VALUES
(1, '607ebcc63e3ed', 'Madripoor', 'Marina', 'Tarina', 'Tamil Nadu', '2001-07-07', 'Karina', 90, 24, 23, 1900, '2020-09-08', 23, 'noisdea', 'Provided', 'Bean'),
(4, '607ebf8b748c1', 'Nirapoor', 'Mamo', 'Lamo', 'Teromo', '5007-04-03', 'Karina', 89.898, 23.567, 78, 1000, '2030-06-05', 45, 'nolan', 'Not Provided', 'Perry'),
(5, '607eed9f2a2a4', 'Tripur', 'Liano', 'Miano', 'Siano', '2119-06-05', 'Caino', 32.714444444444, 12.3775, 23, 200098, '2988-02-08', 234, 'nodea', 'Provided', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`SI_no`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`SI_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `SI_no` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `SI_no` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
