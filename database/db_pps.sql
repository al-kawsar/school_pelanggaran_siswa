-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2024 at 01:11 PM
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
-- Database: `db_pps`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `c_admin` varchar(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`c_admin`, `nama`, `username`, `password`) VALUES
('1901010069', 'ihwan adli', 'ihwan', 'ihwan069'),
('123456789', 'admin', 'admin', 'bksmansar@2024');

-- --------------------------------------------------------

--
-- Table structure for table `benpel`
--

CREATE TABLE `benpel` (
  `c_benpel` varchar(10) NOT NULL,
  `c_katbenpel` varchar(10) NOT NULL,
  `benpel` text NOT NULL,
  `bobot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `benpel`
--

INSERT INTO `benpel` (`c_benpel`, `c_katbenpel`, `benpel`, `bobot`) VALUES
('5XafCJsV5', 'b4tFXbsU5', 'Berkelahi dengan sekolahan lain', 100),
('cn7rgthJl', 'FSyln8F5q', 'Berkata Kotor Dengan Guru', 50),
('duXCzLrCt', 'b4tFXbsU5', 'Mencuri', 75),
('M8yHhFw6o', 'b4tFXbsU5', 'Terbukti melakukan kejahatan', 50),
('o6zIRf55a', 'wE2hDSZ0H', 'Meninggalkan Kelas Tanpa Izin', 5),
('qlW4RnkLE', 'jGC4JtGo0', 'Tidak Memasukkan Baju (Siswa Putra)', 20),
('rkCV0Qegy', 'jGC4JtGo0', 'Berambut Gondrong (Siswa Putra)/dicat/diwarna', 45),
('UtkxKRhBu', 'wE2hDSZ0H', 'Tidak Mengikuti Pelajaran Tanpa Izin', 10),
('y1Xs82Iud', 'wE2hDSZ0H', 'Tidak Mengikuti Upacara', 5),
('yYuI3otvA', 'FSyln8F5q', 'Mengejek Guru', 10);

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `c_guru` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`c_guru`, `nama`, `username`, `password`, `foto`) VALUES
('7yymBGcYv', 'Delia Sepiana', 'delia', '123', ''),
('XufIJ8kZM', 'Diah putri Lestari', 'uput', '170403', 'foto/smansarImg.png');

-- --------------------------------------------------------

--
-- Table structure for table `katbenpel`
--

CREATE TABLE `katbenpel` (
  `c_katbenpel` varchar(10) NOT NULL,
  `katbenpel` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `katbenpel`
--

INSERT INTO `katbenpel` (`c_katbenpel`, `katbenpel`) VALUES
('b4tFXbsU5', 'KEJAHATAN'),
('FSyln8F5q', 'KESOPANAN'),
('jGC4JtGo0', 'KERAPIAN'),
('wE2hDSZ0H', 'KERAJINAN');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `c_kelas` varchar(10) NOT NULL,
  `kelas` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`c_kelas`, `kelas`) VALUES
('bf14I0amf', 'X IPA 1'),
('EKPhaXSZg', 'X IPA 4'),
('fi5IJXCDs', 'X IPA 2'),
('g20VX0r3h', 'X IPA 3');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggaran`
--

CREATE TABLE `pelanggaran` (
  `c_pelanggaran` varchar(5) NOT NULL,
  `c_siswa` varchar(10) NOT NULL,
  `c_kelas` varchar(10) NOT NULL,
  `c_benpel` varchar(10) NOT NULL,
  `bobot` int(4) NOT NULL,
  `c_guru` varchar(10) NOT NULL,
  `c_sanksi` varchar(10) NOT NULL,
  `at` datetime NOT NULL,
  `periode` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pelanggaran`
--

INSERT INTO `pelanggaran` (`c_pelanggaran`, `c_siswa`, `c_kelas`, `c_benpel`, `bobot`, `c_guru`, `c_sanksi`, `at`, `periode`) VALUES
('Ccal', 'ukxWhAq84', 'bf14I0amf', '5XafCJsV5', 100, 'XufIJ8kZM', '', '2024-05-10 12:47:22', '2024/2025'),
('DAGW', 'vKiF8yWPe', 'bf14I0amf', 'rkCV0Qegy', 45, 'XufIJ8kZM', '', '2024-08-29 16:47:41', '2024/2025'),
('dAQe', 'vKiF8yWPe', 'bf14I0amf', 'duXCzLrCt', 75, 'XufIJ8kZM', '', '2024-05-08 18:09:43', '2023/2024'),
('MOJu', 'vKiF8yWPe', 'bf14I0amf', 'duXCzLrCt', 75, 'XufIJ8kZM', '', '2024-05-10 14:41:15', '2024/2025'),
('OkAa', 'vKiF8yWPe', 'bf14I0amf', 'qlW4RnkLE', 20, '7yymBGcYv', '', '2024-05-19 19:25:18', '2023/2024'),
('vwSu', 'Od9dswSEH', 'g20VX0r3h', 'UtkxKRhBu', 10, 'XufIJ8kZM', '', '2024-05-16 19:02:35', '2022/2023');

-- --------------------------------------------------------

--
-- Table structure for table `sanksi`
--

CREATE TABLE `sanksi` (
  `c_sanksi` varchar(10) NOT NULL,
  `kriteria` varchar(30) NOT NULL,
  `bobot_dari` int(3) NOT NULL,
  `bobot_sampai` int(3) NOT NULL,
  `sanksi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sanksi`
--

INSERT INTO `sanksi` (`c_sanksi`, `kriteria`, `bobot_dari`, `bobot_sampai`, `sanksi`) VALUES
('0DhOeINEy', 'Pelanggaran Ringan', 1, 5, '1. Peringatan Lesan<br>2. Dicatat dalam buku pelanggaran'),
('d3e8l5Jts', 'Pelanggaran Sedang', 6, 20, '1. Dicatat<br>2. Membuat Surat Pernyataan'),
('PqhAh8kmq', 'ringan', 1, 90, 'pindah'),
('Sk8x467Qm', 'Pelanggaran Berat', 50, 100, '1. Diberikan Peringatan dan Surat Perjanjian<br>2. BIla Melanggar Kembali dikeluarkan dari sekolahan');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `c_siswa` varchar(10) NOT NULL,
  `c_kelas` varchar(10) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jk` varchar(1) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `tl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`c_siswa`, `c_kelas`, `nisn`, `nama`, `jk`, `alamat`, `tl`) VALUES
('Od9dswSEH', 'g20VX0r3h', '112121212', 'adelia yunda arianti', 'P', 'selojan', '1998-10-01'),
('ueGyvpS1W', 'fi5IJXCDs', '123', 'M. Diki Iswar', 'L', 'askans', '1998-10-15'),
('ukxWhAq84', 'bf14I0amf', '46346436436', 'NIA', 'P', 'Surabaya', '1997-10-18'),
('vKiF8yWPe', 'bf14I0amf', '1283634', 'azmi', 'L', 'lingsar', '1998-10-14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`c_admin`);

--
-- Indexes for table `benpel`
--
ALTER TABLE `benpel`
  ADD PRIMARY KEY (`c_benpel`),
  ADD KEY `c_katbenpel` (`c_katbenpel`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`c_guru`);

--
-- Indexes for table `katbenpel`
--
ALTER TABLE `katbenpel`
  ADD PRIMARY KEY (`c_katbenpel`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`c_kelas`);

--
-- Indexes for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  ADD PRIMARY KEY (`c_pelanggaran`),
  ADD KEY `c_siswa` (`c_siswa`),
  ADD KEY `c_guru` (`c_guru`),
  ADD KEY `c_kelas` (`c_kelas`),
  ADD KEY `c_benpel` (`c_benpel`),
  ADD KEY `c_sanksi` (`c_sanksi`);

--
-- Indexes for table `sanksi`
--
ALTER TABLE `sanksi`
  ADD PRIMARY KEY (`c_sanksi`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`c_siswa`),
  ADD KEY `c_kelas` (`c_kelas`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `benpel`
--
ALTER TABLE `benpel`
  ADD CONSTRAINT `benpel_ibfk_1` FOREIGN KEY (`c_katbenpel`) REFERENCES `katbenpel` (`c_katbenpel`);

--
-- Constraints for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  ADD CONSTRAINT `pelanggaran_ibfk_1` FOREIGN KEY (`c_siswa`) REFERENCES `siswa` (`c_siswa`),
  ADD CONSTRAINT `pelanggaran_ibfk_2` FOREIGN KEY (`c_guru`) REFERENCES `guru` (`c_guru`),
  ADD CONSTRAINT `pelanggaran_ibfk_3` FOREIGN KEY (`c_kelas`) REFERENCES `kelas` (`c_kelas`),
  ADD CONSTRAINT `pelanggaran_ibfk_4` FOREIGN KEY (`c_benpel`) REFERENCES `benpel` (`c_benpel`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`c_kelas`) REFERENCES `kelas` (`c_kelas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
