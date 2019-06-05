-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 03, 2019 at 05:13 AM
-- Server version: 5.7.25-0ubuntu0.18.04.2
-- PHP Version: 7.2.15-0ubuntu0.18.04.2

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
(16, '200', 10, '04/02/2019'),
(17, '2000', 10, '04/02/2019');

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
  `contrib` varchar(255) NOT NULL,
  `withdraw` varchar(244) DEFAULT NULL,
  `difference` varchar(244) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`Id`, `firstname`, `lastname`, `middlename`, `exname`, `address`, `age`, `type`, `date`, `contrib`, `withdraw`, `difference`) VALUES
(10, 'Edisons', 'Heramil', 'Filipino', 'Fuck', 'Alcoy, Minglanilla Cebu', 23, 'Regular', '2019-04-03 04:46:23', '2200', '2400', '2000');

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
  `wamount` varchar(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `date` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `withdraw`
--

INSERT INTO `withdraw` (`Idw`, `wamount`, `mid`, `date`) VALUES
(14, '200', 10, '04/02/2019'),
(15, '2000', 10, '04/02/2019'),
(16, '200', 10, '04/02/2019');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Diposit`
--
ALTER TABLE `Diposit`
  ADD PRIMARY KEY (`Idd`),
  ADD KEY `mid` (`mid`);

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
  ADD PRIMARY KEY (`Idw`),
  ADD KEY `mid` (`mid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Diposit`
--
ALTER TABLE `Diposit`
  MODIFY `Idd` int(244) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `Id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `withdraw`
--
ALTER TABLE `withdraw`
  MODIFY `Idw` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Diposit`
--
ALTER TABLE `Diposit`
  ADD CONSTRAINT `Diposit_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `members` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `withdraw`
--
ALTER TABLE `withdraw`
  ADD CONSTRAINT `withdraw_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `members` (`Id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
