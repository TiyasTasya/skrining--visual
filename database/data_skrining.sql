-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2025 at 05:20 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `data_skrining`
--

-- --------------------------------------------------------

--
-- Table structure for table `skrining`
--

CREATE TABLE `skrining` (
  `tanggal` date NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tanda_gejala` enum('1','2','3','4','5') NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skrining`
--

INSERT INTO `skrining` (`tanggal`, `nama`, `tanda_gejala`, `keterangan`) VALUES
('2025-08-23', 'BN', '5', 'Gangguan pola berjalan'),
('2025-09-22', 'CV', '4', 'Kondisi stabil'),
('2025-09-22', 'NN', '5', 'Menggunakan penutup pada setidaknya satu mata'),
('2025-09-23', 'VB', '2', 'Nyeri hebat'),
('2025-09-24', 'CK', '3', 'Tampak pucat'),
('2025-09-24', 'NY', '1', 'Tidak bernafas atau kesulitan bernafas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `skrining`
--
ALTER TABLE `skrining`
  ADD PRIMARY KEY (`tanggal`,`nama`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
