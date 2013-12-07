-- phpMyAdmin SQL Dump
-- version 3.1.5
-- http://www.phpmyadmin.net
--
-- Host: remote-mysql3.servage.net
-- Generation Time: Dec 07, 2013 at 05:15 PM
-- Server version: 5.5.25
-- PHP Version: 5.2.42-servage26

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nov2013meet`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` varchar(100) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `access_level` varchar(50) NOT NULL DEFAULT 'Member',
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `created` bigint(20) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `user_type` int(1) DEFAULT NULL COMMENT '1=''a Job Seeker'',2=''an Employer'',3=''a Staffing Agency Representative''',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
