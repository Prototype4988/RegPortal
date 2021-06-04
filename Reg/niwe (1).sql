-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 04, 2021 at 03:46 AM
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
  `Password` blob NOT NULL,
  `Email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`SI_no`, `Username`, `Password`, `Email`) VALUES
(1, 'Victor', 0xa2d2556617, 'geoffrick7@gmail.com'),
(2, 'Liam', 0xa2d2556617c4, 'georgegeoffrick.22cs@licet.ac.in'),
(3, 'Joshua', 0xdbe6e6784b47, 'joshua.22cs@licet.ac.in'),
(4, 'Ashwin', 0xdbe6e6784b4794, 'aashrith.22cs@licet.ac.in'),
(5, 'Lawrence', 0xdbe6e6784b47946c, 'lawrencemelvin.22cs@licet.ac.in');

-- --------------------------------------------------------

--
-- Table structure for table `otpstore`
--

CREATE TABLE `otpstore` (
  `otp` varchar(10) DEFAULT NULL,
  `is_expired` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `id` int(12) DEFAULT NULL,
  `newid` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `otpstore`
--

INSERT INTO `otpstore` (`otp`, `is_expired`, `create_at`, `id`, `newid`) VALUES
('246446', 0, '2021-05-06 05:12:30', NULL, NULL),
('105577', 0, '2021-05-06 05:14:45', NULL, NULL),
('178326', 0, '2021-05-06 08:18:17', NULL, NULL),
('766003', 1, '2021-05-06 08:20:23', NULL, NULL),
('838059', 1, '2021-05-06 08:25:21', NULL, NULL),
('943148', 1, '2021-05-06 08:27:51', NULL, NULL),
('590032', 1, '2021-05-06 08:31:11', NULL, NULL),
('794109', 1, '2021-05-06 10:45:02', NULL, NULL),
('941383', 1, '2021-05-06 10:47:34', NULL, NULL),
('944715', 1, '2021-05-06 10:49:28', NULL, NULL),
('644679', 1, '2021-06-01 12:48:03', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_temp`
--

CREATE TABLE `password_reset_temp` (
  `email` varchar(250) NOT NULL,
  `key` varchar(250) NOT NULL,
  `expDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(5, '607eed9f2a2a4', 'Tripur', 'Liano', 'Miano', 'Siano', '2119-06-05', 'Caino', 32.714444444444, 12.3775, 23, 200098, '2988-02-08', 234, 'nodea', 'Provided', ''),
(6, '', 'Lucknow', 'Laro', 'Gamora', 'UttarPradesh', '2001-04-09', 'Karina', 0, 0, 33, 200000, '2018-06-05', 89, '', 'Provided', ''),
(7, 'C-WET-PM-R-86', 'Lucknow', 'Laro', 'Gamora', 'UttarPradesh', '2001-04-09', 'Karina', 0, 0, 33, 200000, '2018-06-05', 89, '', 'Provided', ''),
(8, 'C-WET-PM-R-72', 'Lucknow', 'Laro', 'Gamora', 'UttarPradesh', '2001-04-09', 'Karina', 0, 0, 33, 200000, '2018-06-05', 89, 'noisdea', 'Provided', 'nothing'),
(9, 'C-WET-PM-R-74', 'Lucknow', 'Laro', 'Gamora', 'UttarPradesh', '2001-04-09', 'Karina', 0, 0, 33, 200000, '2018-06-05', 89, 'noisdea', 'Provided', 'nothing'),
(10, 'C-WET-PM-R-18', 'Dadari', 'Kira', 'Deego', 'Maharashtra', '2017-03-08', 'Caino', 44.897, 22.98, 39, 200000, '2018-06-05', 89, 'noisdea', 'Provided', 'nothing'),
(11, NULL, 'Telengana', 'Palivakam', 'Ranga', 'Andhra', '2014-09-08', 'Vivica', 23.7897, 34.876, 34, 30000, '2020-05-09', 56, '', 'Provided', ''),
(12, 'C-WET-PM-R-26', 'Telengana', 'Palivakam', 'Ranga', 'Andhra', '2014-09-08', 'Vivica', 23.7897, 34.876, 34, 30000, '2020-05-09', 56, '', 'Provided', '');

-- --------------------------------------------------------

--
-- Table structure for table `registered_users`
--

CREATE TABLE `registered_users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `email`) VALUES
(1, 'Victor', '$2y$10$z2ZNpGSLxm/CTZ4eqPDCk.BL0MPnGfIN11XFU5M76Cu47QOT4Up5u', '2021-05-02 17:27:31', 'georgegeoffrick.22cs@licet.ac.in'),
(2, 'George', '$2y$10$ycUuuTWeaIlJpiCcc/nY5ext8z1C39drG7CdDcyqA27mEM1wyM0eO', '2021-05-02 17:46:02', 'aashrith.22cs@licet.ac.in'),
(3, 'Solomon', '$2y$10$a0ls2lA0tPmGFe3sS3P6ROKxT.zV3jA0eqG9Y/aOAHhEiZu4z4JJm', '2021-06-04 09:07:48', 'joshua.22cs@licet.ac.in');

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

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
  MODIFY `SI_no` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
