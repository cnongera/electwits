-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 13, 2011 at 08:12 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `twabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `twable`
--

CREATE TABLE IF NOT EXISTS `twable` (
  `twid` int(11) NOT NULL AUTO_INCREMENT,
  `tweet` varchar(255) NOT NULL,
  `twastus` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`twid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `twable`
--

INSERT INTO `twable` (`twid`, `tweet`, `twastus`) VALUES
(1, 'The light is getting brighter', 1),
(2, 'I''m like that', 1);