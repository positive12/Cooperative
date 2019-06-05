--
-- Database: `easyloanman`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `ACCOUNTID` int(11) NOT NULL AUTO_INCREMENT,
  `TYPEID` int(11) NOT NULL,
  `ACCOUNT_NAME` varchar(50) NOT NULL,
  `ACCOUNT_DESC` varchar(250) NOT NULL,
  `COMPANYID` int(11) NOT NULL,
  `BALANCE` decimal(10,2) NOT NULL,
  `STARTDATE` datetime NOT NULL,
  `DUEDATE` tinyint(4) NOT NULL,
  PRIMARY KEY (`ACCOUNTID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

-- --------------------------------------------------------

--
-- Table structure for table `accounttype`
--

DROP TABLE IF EXISTS `accounttype`;
CREATE TABLE IF NOT EXISTS `accounttype` (
  `TYPEID` int(11) NOT NULL AUTO_INCREMENT,
  `TYPENAME` varchar(50) NOT NULL,
  PRIMARY KEY (`TYPEID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `COMPANYID` int(11) NOT NULL AUTO_INCREMENT,
  `COMPANY_NAME` varchar(50) NOT NULL,
  `COMPANY_DESC` varchar(250) NOT NULL,
  `TYPEID` int(11) NOT NULL,
  PRIMARY KEY (`COMPANYID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `companytype`
--

DROP TABLE IF EXISTS `companytype`;
CREATE TABLE IF NOT EXISTS `companytype` (
  `TYPEID` int(11) NOT NULL AUTO_INCREMENT,
  `COMP_TYPENAME` varchar(50) NOT NULL,
  PRIMARY KEY (`TYPEID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

DROP TABLE IF EXISTS `loan`;
CREATE TABLE IF NOT EXISTS `loan` (
  `LOANID` int(11) NOT NULL AUTO_INCREMENT,
  `LOAN_NAME` varchar(50) NOT NULL,
  `ACCOUNTID` int(11) NOT NULL,
  `STARTDATE` datetime NOT NULL,
  `AMOUNT` decimal(10,2) NOT NULL,
  `BALANCE` decimal(10,2) NOT NULL,
  `TERM` smallint(11) NOT NULL,
  PRIMARY KEY (`LOANID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `TRANID` int(11) NOT NULL AUTO_INCREMENT,
  `LOANID` int(11) NOT NULL,
  `TRANDATE` datetime NOT NULL,
  `TRANTYPE` smallint(6) NOT NULL,
  `AMOUNT` decimal(10,2) NOT NULL,
  PRIMARY KEY (`TRANID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `USERID` int(11) NOT NULL AUTO_INCREMENT,
  `FIRST_NAME` varchar(50) NOT NULL,
  `LAST_NAME` varchar(50) NOT NULL,
  PRIMARY KEY (`USERID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


--
-- Dumping data for table `accounttype`
--

INSERT INTO `accounttype` (`TYPEID`, `TYPENAME`) VALUES
(1, 'Personal Loan'),
(2, 'Credit Card');

--
-- Dumping data for table `companytype`
--

INSERT INTO `companytype` (`TYPEID`, `COMP_TYPENAME`) VALUES
(1, 'Bank');