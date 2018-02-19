-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 26, 2013 at 03:53 PM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hrm_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('0442fa996c6c574351127d88ea012a32', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:21.0) Gecko/20100101 Firefox/21.0', 1372254786, 'a:1:{s:9:"user_data";s:0:"";}');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `dept_id` varchar(100) NOT NULL,
  `dept_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dept_id` (`dept_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `dept_id`, `dept_name`) VALUES
(1, '2', 'Research'),
(2, '3', 'Analysis');

-- --------------------------------------------------------

--
-- Table structure for table `emp_info`
--

CREATE TABLE IF NOT EXISTS `emp_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` varchar(10) CHARACTER SET utf8 NOT NULL,
  `emp_full_name` varchar(200) CHARACTER SET utf8 NOT NULL,
  `emp_father_name` varchar(200) NOT NULL,
  `emp_mother_name` varchar(200) NOT NULL,
  `emp_gender` int(1) NOT NULL,
  `emp_blood` varchar(3) NOT NULL,
  `emp_designation` varchar(35) CHARACTER SET utf8 NOT NULL,
  `emp_maritial_status` int(1) NOT NULL,
  `emp_profile_image` varchar(500) NOT NULL,
  `emp_join_date` text NOT NULL,
  `emp_dob` text NOT NULL,
  `emp_address` text CHARACTER SET utf8 NOT NULL,
  `emp_per_address` text NOT NULL,
  `emp_email` varchar(300) NOT NULL,
  `emp_mob_no` varchar(13) CHARACTER SET utf8 NOT NULL,
  `emp_mob_no_own` varchar(15) NOT NULL,
  `emp_extension` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `emp_info`
--

INSERT INTO `emp_info` (`id`, `emp_id`, `emp_full_name`, `emp_father_name`, `emp_mother_name`, `emp_gender`, `emp_blood`, `emp_designation`, `emp_maritial_status`, `emp_profile_image`, `emp_join_date`, `emp_dob`, `emp_address`, `emp_per_address`, `emp_email`, `emp_mob_no`, `emp_mob_no_own`, `emp_extension`) VALUES
(1, '30093', 'A. S. Md. Ferdousul Haque', 'Md. Shamsul Haque', 'Begum Shahana Haque', 1, 'B+', 'Analysis Executive', 1, '30093.jpg', '12334342', '1988-01-16', 'Bangladesh Air Force BAF Falcon sdfadf dfsda', '18,West Hospital Road,Khulna-9100.', 'ferdousul.haque@siriusbd.com', '01711448989', '', '154'),
(2, '34432', 'esdfsd', 'dfasdf', 'sdfasdf', 1, 'f4', 'sdfsdf', 1, 'AnonymousUser.png', '2013', '2013-06-06', 'fasdfsdf', 'sdfasdfasd', '0', '342342345', '3423423', '323'),
(3, '20093', 'esdfsd', 'dfasdf', 'dfgdsfg', 1, 'B+', 'fsafs', 1, 'AnonymousUser.png', '2013-06-01', '2013-06-01', 'dfgsdf', 'dfgsdfg', 'ffer@fsds.com', '132234', '3423423', '233'),
(4, '20012', 'Ismile Hossain', 'N/A', 'n/A', 1, 'B+', 'Analysis Manager', 1, 'AnonymousUser.png', '2011-10-01', '1982-09-03', 'Mirpur', 'Mirpur', 'ismile@siriusbd.com', '523452345', '1345342345', '334');

-- --------------------------------------------------------

--
-- Table structure for table `emp_leave_numbers`
--

CREATE TABLE IF NOT EXISTS `emp_leave_numbers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` varchar(10) CHARACTER SET utf8 NOT NULL,
  `leave_type` int(1) NOT NULL,
  `emp_leave_taken` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `emp_leave_numbers`
--

INSERT INTO `emp_leave_numbers` (`id`, `emp_id`, `leave_type`, `emp_leave_taken`) VALUES
(1, '30093', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `leave_table`
--

CREATE TABLE IF NOT EXISTS `leave_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` varchar(15) NOT NULL,
  `leave_type` int(1) NOT NULL,
  `from_date` varchar(25) NOT NULL,
  `to_date` varchar(25) NOT NULL,
  `no_of_days` int(2) NOT NULL,
  `join_date` varchar(25) NOT NULL,
  `sub_date` varchar(25) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `app_status` int(1) NOT NULL DEFAULT '0',
  `app_by_email` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `leave_table`
--

INSERT INTO `leave_table` (`id`, `emp_id`, `leave_type`, `from_date`, `to_date`, `no_of_days`, `join_date`, `sub_date`, `comment`, `app_status`, `app_by_email`) VALUES
(1, '30093', 1, '2013-07-03', '2013-07-04', 4, '2013-07-07', '2013-6-26', 'rgsgsfg', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `leave_type`
--

CREATE TABLE IF NOT EXISTS `leave_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `leave_name` varchar(50) NOT NULL,
  `total` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `leave_type`
--

INSERT INTO `leave_type` (`id`, `leave_name`, `total`) VALUES
(1, 'Earned/Privilege leave', 20),
(2, 'Sick leave', 14),
(3, 'Casual leave', 10),
(4, 'Maternity leave', 120),
(5, 'Paternity leave', 5);

-- --------------------------------------------------------

--
-- Table structure for table `reporting`
--

CREATE TABLE IF NOT EXISTS `reporting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` varchar(25) NOT NULL,
  `mail_to` varchar(200) NOT NULL,
  `mail_cc` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `reporting`
--

INSERT INTO `reporting` (`id`, `emp_id`, `mail_to`, `mail_cc`) VALUES
(1, '30093', 'shahid@siriusbd.com', 'ismile@siriusbd.com'),
(2, '34432', 'dfsgsdfg', 'fgsdfg'),
(3, '20093', 'shahid@siriusbd.com', 'shahid@siriusbd.com'),
(4, '20012', 'shahid@siriusbd.com', 'sanjay.pal@siriusbd.com');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `user_id` int(5) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(15) NOT NULL,
  `user_pass` varchar(15) NOT NULL,
  `dept_id` varchar(1) NOT NULL,
  `emp_id` varchar(6) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `last_login` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `user_name`, `user_pass`, `dept_id`, `emp_id`, `status`, `last_login`) VALUES
(1, '30093', 'MTIzNDU2', '3', '0093', 1, NULL),
(2, '34432', 'cXdlcnR5', '3', '4432', 1, NULL),
(3, '20093', 'cXdlcnR5', '2', '0093', 1, NULL),
(4, '20012', 'cXdlcnR5', '2', '0012', 1, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
