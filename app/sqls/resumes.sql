-- phpMyAdmin SQL Dump
-- version 3.1.5
-- http://www.phpmyadmin.net
--
-- Host: remote-mysql3.servage.net
-- Generation Time: Dec 08, 2013 at 02:30 AM
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
-- Table structure for table `resumes`
--

CREATE TABLE IF NOT EXISTS `resumes` (
  `resume_id` varchar(100) NOT NULL,
  `user_id` varchar(100) DEFAULT NULL,
  `resume_title` varchar(200) DEFAULT NULL,
  `resume_show` int(1) DEFAULT '1',
  `resume_content` longtext,
  `resume_type` int(4) NOT NULL DEFAULT '1',
  `resume_skills` varchar(255) DEFAULT NULL,
  `resume_created_dt` bigint(20) DEFAULT NULL,
  `resume_modified_dt` bigint(20) DEFAULT NULL,
  `resume_deleted_td` bigint(20) DEFAULT NULL,
  `resume_status` int(1) NOT NULL DEFAULT '1',
  `resume_deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`resume_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
