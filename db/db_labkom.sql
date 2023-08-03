-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2023 at 08:38 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_labkom`
--

-- --------------------------------------------------------

--
-- Table structure for table `aset_elektronik`
--

CREATE TABLE `aset_elektronik` (
  `id` varchar(16) NOT NULL,
  `nama_barang` varchar(35) DEFAULT NULL,
  `kategori` varchar(20) DEFAULT NULL,
  `merk` varchar(20) DEFAULT NULL,
  `jumlah_unit` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aset_elektronik`
--

INSERT INTO `aset_elektronik` (`id`, `nama_barang`, `kategori`, `merk`, `jumlah_unit`) VALUES
('E001', 'HP PC AIO cb1015d', 'Komputer', 'HP', '9'),
('E002', 'HP Laser Jet Pro M12w', 'Printer', 'HP', '2'),
('E003', 'Canon Pixma MG2570S', 'Printer', 'Canon', '1'),
('E004', 'Brother DCP-T300', 'Printer', 'Brother', '1'),
('E005', 'Epson L360', 'Printer', 'Epson', '2'),
('E006', 'Epson Projector EB-X500 XGA', 'Projector', 'Epson', '2'),
('E007', 'Tes Barang 2', 'Tester', 'TesCoy', '12');

-- --------------------------------------------------------

--
-- Table structure for table `aset_non_elektronik`
--

CREATE TABLE `aset_non_elektronik` (
  `id` varchar(11) NOT NULL,
  `nama_barang` varchar(35) DEFAULT NULL,
  `kategori` varchar(20) DEFAULT NULL,
  `merk` varchar(20) DEFAULT NULL,
  `jumlah_unit` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aset_non_elektronik`
--

INSERT INTO `aset_non_elektronik` (`id`, `nama_barang`, `kategori`, `merk`, `jumlah_unit`) VALUES
('NE001', 'Meja', 'Meja', 'Ikea', '11'),
('NE002', 'Tang Crimping', 'Tang Crimping', 'UGREEN', '11'),
('NE003', 'Tangga', 'Tangga', 'Krisbow', '3'),
('NE004', 'Kursi', 'Non-Elektronik', 'Informa', '11'),
('NE005', 'Lemari', 'Non-Elektronik', 'Ikea', '4'),
('NE006', 'Tes Barang 2', 'Tester', 'TesCoy', '12'),
('NE007', 'Tes Barang 1', 'Tester', 'TesCoy', '13');

-- --------------------------------------------------------

--
-- Table structure for table `komputer_lab`
--

CREATE TABLE `komputer_lab` (
  `sn` varchar(20) NOT NULL,
  `nama` varchar(20) DEFAULT NULL,
  `merk` varchar(20) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komputer_lab`
--

INSERT INTO `komputer_lab` (`sn`, `nama`, `merk`, `status`) VALUES
('SN123252', 'PC-2', 'HP', 'Active'),
('SN123456', 'PC-1', 'HP', 'Active'),
('SN151245', 'PC-3', 'HP', 'Active'),
('SN184622', 'PC-4', 'HP', 'Active'),
('SN228364', 'PC-5', 'HP', 'Active'),
('SN271651', 'PC-7', 'HP', 'Active'),
('SN394137', 'PC-8', 'HP', 'Active'),
('SN567890', 'PC-9', 'HP', 'Active'),
('SN847185', 'PC-6', 'HP', 'Idle');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `hak_akses` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `hak_akses`) VALUES
(1, 'Admin', 'admin123', 'admin'),
(2, 'guest', 'guest123', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` varchar(12) NOT NULL,
  `nama` varchar(35) DEFAULT NULL,
  `npm` varchar(20) DEFAULT NULL,
  `kelas` varchar(3) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama`, `npm`, `kelas`, `no_hp`) VALUES
('P001', 'Muhammad Dias Firmansyah', '202043500318', 'Y6B', '083872686966'),
('P002', 'Data yang diedit', '202043500313', 'Y6B', '083872686912'),
('P003', 'tes lagi', '202043500001', 'Y6B', '0818'),
('P004', 'tes tambah data', '202043500333', 'Y6B', '0818'),
('P005', 'tes pengguna 3', '202043501325', 'X7B', '08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aset_elektronik`
--
ALTER TABLE `aset_elektronik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aset_non_elektronik`
--
ALTER TABLE `aset_non_elektronik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komputer_lab`
--
ALTER TABLE `komputer_lab`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `npm` (`npm`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
