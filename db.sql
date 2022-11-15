-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2021 at 08:21 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cluster`
--

CREATE TABLE IF NOT EXISTS `cluster` (
  `id_cluster` int(11) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `panen` float NOT NULL,
  `produksi` float NOT NULL,
  PRIMARY KEY (`id_cluster`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cluster`
--

INSERT INTO `cluster` (`id_cluster`, `nama`, `panen`, `produksi`) VALUES
(1, 'Banyak', 0, 0),
(2, 'Cukup', 0.729, 0.757),
(3, 'Sedikit', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE IF NOT EXISTS `data` (
  `id_data` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `panen` float NOT NULL,
  `produksi` float NOT NULL,
  `cluster` int(11) NOT NULL,
  PRIMARY KEY (`id_data`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`id_data`, `nama`, `panen`, `produksi`, `cluster`) VALUES
(1, 'Kalijambe', 4255, 26536, 2),
(2, 'Plupuh', 6409, 39830, 1),
(3, 'Masaran', 7794, 52697, 1),
(4, 'Kedawung', 5354, 34261, 2),
(5, 'Sambirejo', 3015, 19278, 3),
(6, 'Gondang', 7217, 45500, 1),
(7, 'Sambungmacan', 6469, 40885, 1),
(8, 'Ngrampal', 6850, 43338, 1),
(9, 'Karangmalang', 6894, 43568, 1),
(10, 'Sragen', 4340, 29227, 2),
(11, 'Sidoharjo', 9161, 61790, 1),
(12, 'Tanon', 7064, 43982, 1),
(13, 'Gemolong', 4224, 26241, 2),
(14, 'Miri', 2485, 15377, 3),
(15, 'Sumberlawang', 3724, 22902, 2),
(16, 'Mondokan', 2374, 14621, 3),
(17, 'Sukodono', 3780, 23225, 2),
(18, 'Gesi', 1744, 10754, 3),
(19, 'Tangen', 1699, 10386, 3),
(20, 'Jenar', 1814, 11311, 3);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `user`, `pass`, `level`) VALUES
(1, 'admin', 'admin', 2),
(2, 'user', 'user', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
