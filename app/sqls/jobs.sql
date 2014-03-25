-- phpMyAdmin SQL Dump
-- version 3.1.5
-- http://www.phpmyadmin.net
--
-- Host: remote-mysql3.servage.net
-- Generation Time: Mar 25, 2014 at 06:21 AM
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
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `job_id` varchar(100) NOT NULL,
  `user_id` varchar(100) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `position_type` int(4) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `area_code` varchar(50) DEFAULT NULL,
  `zipcode` varchar(50) DEFAULT NULL,
  `skills` varchar(255) DEFAULT NULL,
  `description` text,
  `application_method` varchar(10) DEFAULT NULL,
  `application_email` varchar(150) DEFAULT NULL,
  `application_email_cc` varchar(150) DEFAULT NULL,
  `application_url` varchar(500) DEFAULT NULL,
  `show_name` tinyint(1) DEFAULT NULL,
  `show_address1` tinyint(1) DEFAULT NULL,
  `show_address_2` tinyint(1) DEFAULT NULL,
  `show_city` tinyint(1) DEFAULT NULL,
  `show_state` tinyint(1) DEFAULT NULL,
  `show_zipcode` tinyint(1) DEFAULT NULL,
  `show_phone` tinyint(1) DEFAULT NULL,
  `show_email` tinyint(1) DEFAULT NULL,
  `job_created_dt` bigint(20) DEFAULT NULL,
  `job_modified_dt` bigint(20) DEFAULT NULL,
  `job_deleted_dt` bigint(20) DEFAULT NULL,
  `job_deleted` int(1) NOT NULL DEFAULT '0',
  `job_status` int(1) NOT NULL DEFAULT '1',
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  PRIMARY KEY (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
