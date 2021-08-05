-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2021 at 04:02 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ta`
--

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

CREATE TABLE `device` (
  `id_device` int(10) NOT NULL,
  `username` varchar(60) CHARACTER SET latin1 NOT NULL,
  `nama` varchar(50) CHARACTER SET latin1 NOT NULL,
  `daya` int(5) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `jam` int(2) NOT NULL,
  `prioritas` int(2) NOT NULL,
  `total_daya` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `device`
--

INSERT INTO `device` (`id_device`, `username`, `nama`, `daya`, `jumlah`, `jam`, `prioritas`, `total_daya`) VALUES
(9, 'user', 'Komputer', 200, 5, 8, 2, 1),
(11, 'user', 'Mesin Fotocopy', 400, 3, 8, 3, 1.2),
(13, 'user', 'Speaker', 30, 3, 2, 8, 0.09),
(14, 'user', 'Printer', 10, 5, 8, 4, 0.05),
(15, 'user', 'Lampu', 15, 10, 12, 9, 0.15),
(16, 'user', 'Dispenser', 100, 3, 8, 10, 0.3),
(17, 'user', 'Server', 450, 2, 24, 1, 0.9),
(18, 'user', 'AC', 200, 3, 8, 6, 0.6),
(19, 'user', 'Amplifier', 230, 1, 24, 7, 0.23),
(23, 'user', 'Pompa Air', 125, 1, 24, 5, 0.125);

-- --------------------------------------------------------

--
-- Table structure for table `device_pb`
--

CREATE TABLE `device_pb` (
  `id_device_pb` int(10) NOT NULL,
  `username` varchar(60) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `daya` int(5) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `jam` int(2) NOT NULL,
  `prioritas` int(2) NOT NULL,
  `total_daya` float NOT NULL,
  `nilai` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `device_pb`
--

INSERT INTO `device_pb` (`id_device_pb`, `username`, `nama`, `daya`, `jumlah`, `jam`, `prioritas`, `total_daya`, `nilai`) VALUES
(1, 'user', 'Server', 450, 2, 0, 1, 0.9, 1000),
(2, 'user', 'Komputer', 200, 5, 0, 2, 1, 900),
(3, 'user', 'Mesin Fotocopy', 400, 3, 0, 3, 1.2, 800),
(4, 'user', 'Printer', 10, 5, 0, 4, 0.05, 700),
(5, 'user', 'Pompa Air', 125, 1, 0, 5, 0.125, 600),
(6, 'user', 'AC', 200, 3, 0, 6, 0.6, 500),
(7, 'user', 'Amplifier', 230, 1, 0, 7, 0.23, 400),
(8, 'user', 'Speaker', 30, 3, 0, 8, 0.09, 300),
(9, 'user', 'Lampu', 15, 10, 0, 9, 0.15, 200),
(10, 'user', 'Dispenser', 100, 3, 0, 10, 0.3, 100);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id_login` int(10) NOT NULL,
  `level` int(2) NOT NULL,
  `username` varchar(60) DEFAULT NULL,
  `pass` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_login`, `level`, `username`, `pass`) VALUES
(10002, 1, 'admin', 'admin'),
(10003, 2, 'peneliti', 'peneliti'),
(10005, 2, 'user', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `pascabayar`
--

CREATE TABLE `pascabayar` (
  `id_pb` int(10) NOT NULL,
  `username` varchar(60) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `kwatt` float(10,5) NOT NULL,
  `hari` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pascabayar`
--

INSERT INTO `pascabayar` (`id_pb`, `username`, `jumlah`, `kwatt`, `hari`) VALUES
(1, 'user', 500000, 340.76660, 30);

-- --------------------------------------------------------

--
-- Table structure for table `rekomendasi`
--

CREATE TABLE `rekomendasi` (
  `id_rek` int(2) NOT NULL,
  `prioritas` int(2) NOT NULL,
  `Device` varchar(10) NOT NULL,
  `jam_rek` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rekomendasi`
--

INSERT INTO `rekomendasi` (`id_rek`, `prioritas`, `Device`, `jam_rek`) VALUES
(1, 1, 'Device 1', '7'),
(2, 2, 'Device 2', '7'),
(3, 3, 'Device 3', '2'),
(4, 4, 'Device 4', '5'),
(5, 5, 'Device 5', '2'),
(6, 6, 'Device 6', '2'),
(7, 7, 'Device 7', '1'),
(8, 8, 'Device 8', '4'),
(9, 9, 'Device 9', '3'),
(10, 10, 'Device 10', '2');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id_status` int(10) NOT NULL,
  `prioritas` int(2) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id_status`, `prioritas`, `status`) VALUES
(1, 1, 0),
(2, 2, 0),
(3, 3, 0),
(4, 4, 0),
(5, 5, 0),
(6, 6, 0),
(7, 7, 0),
(8, 8, 0),
(9, 9, 0),
(10, 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `id_token` int(10) NOT NULL,
  `username` varchar(60) CHARACTER SET latin1 NOT NULL,
  `jumlah` int(10) NOT NULL,
  `kwatt` float(10,5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`id_token`, `username`, `jumlah`, `kwatt`) VALUES
(1, 'user', 700000, 477.07321);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`id_device`);

--
-- Indexes for table `device_pb`
--
ALTER TABLE `device_pb`
  ADD PRIMARY KEY (`id_device_pb`),
  ADD UNIQUE KEY `prioritas` (`prioritas`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `pascabayar`
--
ALTER TABLE `pascabayar`
  ADD PRIMARY KEY (`id_pb`);

--
-- Indexes for table `rekomendasi`
--
ALTER TABLE `rekomendasi`
  ADD PRIMARY KEY (`id_rek`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `device`
--
ALTER TABLE `device`
  MODIFY `id_device` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `device_pb`
--
ALTER TABLE `device_pb`
  MODIFY `id_device_pb` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10006;

--
-- AUTO_INCREMENT for table `pascabayar`
--
ALTER TABLE `pascabayar`
  MODIFY `id_pb` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rekomendasi`
--
ALTER TABLE `rekomendasi`
  MODIFY `id_rek` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id_token` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
