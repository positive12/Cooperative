-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 18, 2019 at 03:06 AM
-- Server version: 5.7.24-0ubuntu0.18.04.1
-- PHP Version: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `DB-Login`
--

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `Id` int(12) NOT NULL,
  `firstname` varchar(244) NOT NULL,
  `lastname` varchar(244) NOT NULL,
  `middlename` varchar(244) NOT NULL,
  `exname` varchar(244) NOT NULL,
  `address` varchar(244) NOT NULL,
  `age` int(12) NOT NULL,
  `type` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`Id`, `firstname`, `lastname`, `middlename`, `exname`, `address`, `age`, `type`, `date`) VALUES
(14, 'Edison', 'Heramil', 'Filipino', 'mrs', 'Calajuan, Minglanilla Cebu', 21, 'Regular', '2019-01-18 05:30:29'),
(15, 'Sample', 'Sample', 'Sample', 'Jr', 'Talisay, City Cebu', 1, 'Regular', '2019-01-18 03:47:23'),
(16, 'Edisons', 'Heramil', 'Filipino', 'dd', 'Calajuan, Minglanilla Cebu', 21, 'Casual', '2019-01-18 04:16:05'),
(17, 'Samples', 'sss', 'ss', '', 'Calajuan, Minglanilla Cebu', 21, 'Regular', '2019-01-18 11:05:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(12) NOT NULL,
  `Username` varchar(233) NOT NULL,
  `Password` varchar(233) NOT NULL,
  `Role` int(2) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `Username`, `Password`, `Role`, `Date`) VALUES
(6, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 2, '2019-01-06 13:27:02'),
(7, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, '2019-01-13 13:41:46'),
(8, 'adminss', 'fbf66870bfb017bcb13c41f631f74d3f', 1, '2019-01-12 15:56:33'),
(9, 'adminsss', '2aefc34200a294a3cc7db81b43a81873', 1, '2019-01-12 15:58:00'),
(10, 'sample', '5e8ff9bf55ba3508199d22e984129be6', 1, '2019-01-12 15:58:41'),
(11, 'samples', '6ef9161b900632671022358216c7dfe7', 1, '2019-01-12 15:59:03'),
(12, 'adminsssss', 'c4ca4238a0b923820dcc509a6f75849b', 1, '2019-01-15 17:13:53'),
(13, 'adminsssssssssssss', '8f60c8102d29fcd525162d02eed4566b', 1, '2019-01-15 17:15:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `Id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
