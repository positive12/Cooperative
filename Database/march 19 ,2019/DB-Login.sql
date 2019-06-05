-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 18, 2019 at 06:47 PM
-- Server version: 5.7.25-0ubuntu0.18.04.2
-- PHP Version: 7.2.15-0ubuntu0.18.04.1

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
-- Table structure for table `Diposit`
--

CREATE TABLE `Diposit` (
  `Idd` int(244) NOT NULL,
  `damount` varchar(255) NOT NULL,
  `mid` int(244) NOT NULL,
  `date` varchar(244) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Diposit`
--

INSERT INTO `Diposit` (`Idd`, `damount`, `mid`, `date`) VALUES
(10, '1000', 2, '03/17/2019'),
(11, '1000', 3, '03/17/2019'),
(12, '2000', 4, '03/17/2019'),
(13, '2000', 5, '03/17/2019'),
(15, '2000', 2, '03/18/2019'),
(18, '2000', 1, '03/18/2019'),
(19, '1000', 1, '03/18/2019');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `Id` int(12) NOT NULL,
  `firstname` varchar(244) NOT NULL,
  `lastname` varchar(244) NOT NULL,
  `middlename` varchar(244) NOT NULL,
  `exname` varchar(244) DEFAULT NULL,
  `address` varchar(244) NOT NULL,
  `age` int(2) NOT NULL,
  `type` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `contrib` double NOT NULL,
  `withdraw` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`Id`, `firstname`, `lastname`, `middlename`, `exname`, `address`, `age`, `type`, `date`, `contrib`, `withdraw`) VALUES
(1, 'Edison Paul', 'Heramil', 'Filipino', '', 'Calajuan, Minglanilla Cebu', 23, 'Regular', '2019-03-19 01:46:19', 3000, 0),
(2, 'Flowry May ', 'Filipino', 'Heramil', 'Jr.', 'Poblcaion, Alcoy Cebu', 16, 'Regular', '2019-03-19 01:41:00', 3000, 0),
(3, 'Isabilita', 'Heramil', 'Plando', '', 'Cangcaya, Alcoy Cebu', 59, 'Regular', '2019-03-18 03:20:01', 1000, 0),
(4, 'Elbert', 'Heramil', 'Filipion', '', 'Calajuan, Minglanilla Cebu', 21, 'Regular', '2019-03-18 03:20:16', 2000, 0),
(5, 'Diane', 'Mabini', 'Filipino', '', 'Calajuan, Minglanilla Cebu', 29, 'Regular', '2019-03-18 03:20:24', 2000, 0);

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
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, '2019-02-02 17:44:15'),
(2, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 2, '2019-03-13 09:22:56');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw`
--

CREATE TABLE `withdraw` (
  `Idw` int(255) NOT NULL,
  `wamount` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `date` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Diposit`
--
ALTER TABLE `Diposit`
  ADD PRIMARY KEY (`Idd`);

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
-- Indexes for table `withdraw`
--
ALTER TABLE `withdraw`
  ADD PRIMARY KEY (`Idw`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Diposit`
--
ALTER TABLE `Diposit`
  MODIFY `Idd` int(244) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `Id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `withdraw`
--
ALTER TABLE `withdraw`
  MODIFY `Idw` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
