-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 09, 2016 at 12:34 
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `upload_download_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE IF NOT EXISTS `survey` (
  `nama_karyawan` int(11) NOT NULL,
  `tangibles` int(50) NOT NULL,
  `reliability` int(10) NOT NULL,
  `responsiivness` int(15) NOT NULL,
  `assurence` int(10) NOT NULL,
  `emphaty` int(10) NOT NULL,
  PRIMARY KEY (`nama_karyawan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `survey`
--

INSERT INTO `survey` (`nama_karyawan`, `tangibles`, `reliability`, `responsiivness`, `assurence`, `emphaty` ) VALUES
('11012016001', 'Rizaldi Maulidia Achmad', 'Laki-laki', '085733145666', 'Bandung'),
('11012016002', 'Shinta Nur Rahma', 'Perempuan', '089987262516', 'Gresik'),
('11012016003', 'Muhammad Indra Maulana', 'Laki-laki', '082616617711', 'Bandung'),
('11012016004', 'Dicky Setiawan', 'Laki-laki', '089227276166', 'Garut'),
('11012016005', 'Billy Ramadhan', 'Laki-laki', '085241441611', 'Jakarta');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
