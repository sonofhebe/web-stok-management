-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 13, 2023 at 09:14 AM
-- Server version: 10.5.16-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u175901041_stok`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan`
--

CREATE TABLE `bahan` (
  `id_bahan` int(10) NOT NULL,
  `id_kategori` int(10) NOT NULL,
  `id_satuan` int(10) NOT NULL,
  `nama_bahan` varchar(150) NOT NULL,
  `stok` int(50) NOT NULL,
  `harga` int(50) NOT NULL,
  `per` int(11) NOT NULL,
  `tgl_input` datetime NOT NULL,
  `tgl_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bahan`
--

INSERT INTO `bahan` (`id_bahan`, `id_kategori`, `id_satuan`, `nama_bahan`, `stok`, `harga`, `per`, `tgl_input`, `tgl_update`) VALUES
(1, 6, 6, 'Beras Putih', 177600, 12320, 1000, '2022-08-11 15:47:46', '2022-12-30 21:06:57'),
(2, 6, 6, 'Beras Merah', 1800, 20000, 1000, '2022-08-11 15:47:46', '2022-12-30 21:33:27'),
(3, 6, 6, 'Daging Sapi Giling', 234500, 20000, 250, '2022-08-11 15:47:46', '2022-12-30 21:04:50'),
(4, 6, 6, 'Daging Ayam Giling', 63000, 5000, 100, '2022-08-11 15:47:46', '2022-12-30 21:30:15'),
(5, 6, 6, 'Ikan Tuna', 10500, 7500, 100, '2022-08-11 15:47:46', '2022-12-30 21:10:16'),
(6, 6, 6, 'Ikan Salmon', 6350, 30000, 100, '2022-08-11 15:47:46', '2022-12-30 21:09:26'),
(7, 6, 6, 'Ceker Ayam', 9000000, 10000, 1000, '2022-08-11 15:47:46', '2022-08-11 15:47:46'),
(8, 6, 6, 'Hati Ayam', 9000000, 10000, 1000, '2022-08-11 15:47:46', '2022-08-11 15:47:46'),
(9, 6, 6, 'Kacang Hijau', 1460, 2500, 100, '2022-08-11 15:47:46', '2022-12-30 20:58:10'),
(10, 6, 6, 'Kacang Merah', 3800, 2500, 100, '2022-08-11 15:47:46', '2022-12-30 20:57:11'),
(11, 6, 6, 'Tahu Putih', 15250, 7370, 250, '2022-08-11 15:47:46', '2022-12-30 20:56:13'),
(12, 6, 6, 'Tofu udang', 5600, 5500, 140, '2022-08-11 15:47:46', '2022-12-30 20:54:10'),
(13, 6, 6, 'Keju', 7500, 85000, 2000, '2022-08-11 15:47:46', '2022-12-30 21:11:32'),
(14, 6, 6, 'Wortel', 8995000, 10000, 1000, '2022-08-11 15:47:46', '2022-08-29 19:38:25'),
(15, 6, 6, 'Jagung Manis', 9000000, 10000, 1000, '2022-08-11 15:47:46', '2022-08-11 15:47:46'),
(16, 6, 6, 'labu parang/Kuning', 9000000, 10000, 1000, '2022-08-11 15:47:46', '2022-08-11 15:47:46'),
(17, 6, 6, 'Labu Siam', 9000000, 10000, 1000, '2022-08-11 15:47:46', '2022-08-11 15:47:46'),
(18, 6, 6, 'Buncis', 9000000, 10000, 1000, '2022-08-11 15:47:46', '2022-08-11 15:47:46'),
(19, 6, 6, 'Kacang Panjang', 9000202, 10000, 1000, '2022-08-11 15:47:46', '2022-08-09 17:23:37'),
(20, 6, 6, 'Sawi Hijau', 9000000, 10000, 1000, '2022-08-11 15:47:46', '2022-08-11 15:47:46'),
(21, 6, 6, 'Brokoli', 9000000, 10000, 1000, '2022-08-11 15:47:46', '2022-08-11 15:47:46'),
(22, 6, 6, 'Kentang', 9000000, 10000, 1000, '2022-08-11 15:47:46', '2022-08-11 15:47:46'),
(23, 6, 6, 'Ubi Ungu', 9000000, 10000, 1000, '2022-08-11 15:47:46', '2022-08-11 15:47:46'),
(24, 6, 6, 'UBI KUNING', 9000000, 10000, 1000, '2022-08-11 15:47:46', '2022-08-11 15:47:46'),
(25, 6, 6, 'Ubi Merah', 9000000, 10000, 1000, '2022-08-11 15:47:46', '2022-08-11 15:47:46'),
(26, 6, 6, 'KACANG KEDELAI', 9000000, 10000, 1000, '2022-08-11 15:47:46', '2022-08-11 15:47:46'),
(27, 6, 6, 'Kacang Merah Basah', 9000000, 10000, 1000, '2022-08-11 15:47:46', '2022-08-11 15:47:46'),
(28, 6, 6, 'KACANG IJO KUPAS', 9000000, 10000, 1000, '2022-08-11 15:47:46', '2022-08-11 15:47:46'),
(29, 6, 6, 'UNSALTED BUTTER', 9000000, 10000, 1000, '2022-08-11 15:47:46', '2022-08-11 15:47:46'),
(30, 6, 6, 'OATMEAL', 0, 10000, 100, '2022-08-11 15:47:46', '2022-12-30 20:48:07'),
(31, 6, 8, 'AGAR SWALLOW MERAH', 0, 3000, 1, '2022-08-11 15:47:46', '2022-12-30 20:47:33'),
(32, 6, 8, 'AGAR SWALLOW PLAIN', 0, 3000, 1, '2022-08-11 15:47:46', '2022-12-30 20:47:09'),
(33, 6, 8, 'PUDING MANGGA', 134, 6800, 1, '2022-08-11 15:47:46', '2022-12-30 20:46:41'),
(34, 6, 8, 'PUDING STRAWBERI', 138, 6800, 1, '2022-08-11 15:47:46', '2022-12-30 20:46:04'),
(35, 6, 8, 'PUDING COKLAT', 232, 7000, 1, '2022-08-11 15:47:46', '2022-12-30 20:45:28'),
(37, 6, 8, 'PUDING MELON', 172, 6800, 1, '2022-08-11 15:47:46', '2022-12-30 20:44:13'),
(38, 6, 6, 'BUAH NAGA', 0, 10000, 1000, '2022-08-11 15:47:46', '2022-12-30 20:41:22'),
(39, 6, 6, 'BUAH JERUK', 0, 10000, 1000, '2022-08-11 15:47:46', '2022-12-30 20:41:06'),
(41, 6, 6, 'LABU KUNING', 0, 10000, 1000, '2022-08-18 16:36:39', '2022-12-30 20:40:47'),
(42, 6, 6, 'Ikan Dori', 0, 3700, 1, '2022-12-29 17:41:05', '2022-12-30 20:40:06'),
(43, 7, 7, 'Paper Cup 180 ml', 17132, 585, 1, '2022-12-29 17:44:20', '2022-12-30 20:38:17'),
(44, 7, 7, 'Paper Cup 120  ml', 23040, 515, 1, '2022-12-29 17:44:56', '2022-12-30 20:37:38'),
(45, 7, 7, 'Cup Puding 100 ml', 4135, 200, 1, '2022-12-29 17:45:32', '2022-12-30 20:35:11'),
(46, 7, 7, 'Lid Paper Cup 180 ml', 17926, 195, 1, '2022-12-29 17:46:18', '2022-12-30 20:39:38'),
(47, 7, 7, 'Lid Paper Cup 120 ml', 22999, 170, 1, '2022-12-29 17:46:57', '2022-12-30 20:38:53'),
(48, 7, 8, 'Kantung Plastik', 465, 3800, 1, '2022-12-29 17:47:51', '2022-12-30 20:02:16'),
(49, 7, 7, 'Cup Thinwall 200 ml', 10000, 560, 1, '2022-12-29 17:48:37', '0000-00-00 00:00:00'),
(50, 7, 7, 'Lid Cup Thinwall 200 ml', 10000, 100, 1, '2022-12-29 17:49:21', '0000-00-00 00:00:00'),
(51, 7, 7, 'Sendok Puding', 12800, 35, 1, '2022-12-29 17:49:55', '2022-12-30 19:56:48'),
(52, 7, 7, 'Lid Cup Puding 100 ml', 4085, 100, 1, '2022-12-30 20:35:52', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `dapur`
--

CREATE TABLE `dapur` (
  `id_dapur` int(11) NOT NULL,
  `nama_dapur` varchar(55) NOT NULL,
  `alamat_dapur` text NOT NULL,
  `is_active_dapur` enum('1','0') NOT NULL,
  `tgl_input` datetime NOT NULL,
  `tgl_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dapur`
--

INSERT INTO `dapur` (`id_dapur`, `nama_dapur`, `alamat_dapur`, `is_active_dapur`, `tgl_input`, `tgl_update`) VALUES
(2, 'Dapur Bogor Ciomas', 'Laladaon Permai - Ciomas . Bogor', '1', '2022-08-29 18:53:33', '0000-00-00 00:00:00'),
(3, 'Dapur Harapan Indah', 'Pejuang pratama - Harapan indah', '1', '2022-08-29 18:52:45', '0000-00-00 00:00:00'),
(4, 'Dapur Gamprit ', 'Jl. Gamprit 2 No. 48 Jatiwaringin - Pondok Gede', '1', '2022-08-29 18:52:10', '0000-00-00 00:00:00'),
(5, 'Dapur Kalisari', 'Kalisari - Jakarta Timur', '1', '2022-08-29 18:54:11', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `drop_stok`
--

CREATE TABLE `drop_stok` (
  `id_drop_stok` int(11) NOT NULL,
  `id_dapur` int(11) NOT NULL,
  `id_bahan` int(11) NOT NULL,
  `jumlah` int(50) DEFAULT NULL,
  `total_harga` int(50) NOT NULL,
  `cpsa` int(50) NOT NULL,
  `tanggal` date NOT NULL,
  `tgl_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `drop_stok`
--

INSERT INTO `drop_stok` (`id_drop_stok`, `id_dapur`, `id_bahan`, `jumlah`, `total_harga`, `cpsa`, `tanggal`, `tgl_input`) VALUES
(221, 5, 2, 2, 20, 0, '2022-08-29', '2022-08-29 19:14:58'),
(222, 4, 14, 5000, 50000, 0, '2022-08-29', '2022-08-29 19:38:25'),
(223, 2, 6, 1200, 360000, 0, '2022-12-30', '2022-12-30 21:09:26'),
(224, 2, 5, 3500, 262500, 0, '2022-12-30', '2022-12-30 21:10:16'),
(225, 2, 13, 6000, 255000, 0, '2022-12-30', '2022-12-30 21:11:32'),
(226, 3, 4, 2000, 100000, 0, '2022-12-30', '2022-12-30 21:30:15'),
(227, 2, 2, 2000, 40000, 0, '2022-12-30', '2022-12-30 21:33:27');

--
-- Triggers `drop_stok`
--
DELIMITER $$
CREATE TRIGGER `delete_drop_stok` AFTER DELETE ON `drop_stok` FOR EACH ROW BEGIN
UPDATE stok SET jumlah = jumlah - OLD.jumlah, tgl_update = OLD.tgl_input WHERE id_dapur = OLD.id_dapur AND id_bahan = OLD.id_bahan;
UPDATE bahan SET stok = stok + OLD.jumlah, tgl_update = OLD.tgl_input WHERE id_bahan = OLD.id_bahan;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `drop_dapur_utama` AFTER INSERT ON `drop_stok` FOR EACH ROW BEGIN
UPDATE bahan SET stok = stok -NEW.jumlah, tgl_update = NEW.tgl_input WHERE id_bahan = NEW.id_bahan;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `drop_stok` AFTER INSERT ON `drop_stok` FOR EACH ROW BEGIN
UPDATE stok SET jumlah = jumlah +NEW.jumlah, tgl_update = NEW.tgl_input WHERE id_dapur = NEW.id_dapur AND id_bahan = NEW.id_bahan;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `hari` varchar(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `tgl_input` datetime NOT NULL,
  `tgl_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `hari`, `id_produk`, `tgl_input`, `tgl_update`) VALUES
(11, 'Sabtu', 1, '2022-08-18 17:44:28', '0000-00-00 00:00:00'),
(12, 'Sabtu', 2, '2022-08-18 17:44:36', '0000-00-00 00:00:00'),
(13, 'Sabtu', 3, '2022-08-18 17:44:43', '0000-00-00 00:00:00'),
(14, 'Minggu', 4, '2022-08-18 17:44:56', '0000-00-00 00:00:00'),
(15, 'Minggu', 5, '2022-08-18 17:45:07', '0000-00-00 00:00:00'),
(16, 'Minggu', 12, '2022-08-18 17:46:08', '0000-00-00 00:00:00'),
(17, 'Senin', 7, '2022-08-18 17:46:39', '0000-00-00 00:00:00'),
(18, 'Senin', 8, '2022-08-18 17:46:52', '0000-00-00 00:00:00'),
(19, 'Senin', 9, '2022-08-18 17:47:01', '0000-00-00 00:00:00'),
(20, 'Selasa', 10, '2022-08-18 17:47:15', '0000-00-00 00:00:00'),
(21, 'Selasa', 11, '2022-08-18 17:47:23', '0000-00-00 00:00:00'),
(22, 'Selasa', 12, '2022-08-18 17:47:30', '0000-00-00 00:00:00'),
(23, 'Rabu', 13, '2022-08-18 17:47:41', '0000-00-00 00:00:00'),
(24, 'Rabu', 14, '2022-08-18 17:47:48', '0000-00-00 00:00:00'),
(26, 'Kamis', 16, '2022-08-18 17:48:21', '0000-00-00 00:00:00'),
(27, 'Kamis', 17, '2022-08-18 17:48:58', '0000-00-00 00:00:00'),
(28, 'Kamis', 18, '2022-08-18 17:49:04', '0000-00-00 00:00:00'),
(29, 'Jum\'at', 11, '2022-08-18 17:50:26', '0000-00-00 00:00:00'),
(30, 'Jum\'at', 19, '2022-08-18 17:50:33', '0000-00-00 00:00:00'),
(31, 'Jum\'at', 20, '2022-08-18 17:50:43', '0000-00-00 00:00:00'),
(32, 'Senin', 27, '2022-12-29 17:52:46', '0000-00-00 00:00:00'),
(33, 'Senin', 23, '2022-12-29 17:53:05', '0000-00-00 00:00:00'),
(34, 'Senin', 22, '2022-12-30 14:39:16', '0000-00-00 00:00:00'),
(35, 'Senin', 24, '2022-12-30 14:39:23', '0000-00-00 00:00:00'),
(36, 'Senin', 26, '2022-12-30 14:39:29', '0000-00-00 00:00:00'),
(37, 'Selasa', 27, '2022-12-30 14:39:59', '0000-00-00 00:00:00'),
(38, 'Selasa', 23, '2022-12-30 14:40:06', '0000-00-00 00:00:00'),
(39, 'Selasa', 22, '2022-12-30 14:40:11', '0000-00-00 00:00:00'),
(40, 'Selasa', 24, '2022-12-30 14:40:17', '0000-00-00 00:00:00'),
(41, 'Selasa', 26, '2022-12-30 14:40:21', '0000-00-00 00:00:00'),
(42, 'Rabu', 23, '2022-12-30 14:40:34', '0000-00-00 00:00:00'),
(43, 'Rabu', 27, '2022-12-30 14:40:47', '0000-00-00 00:00:00'),
(44, 'Rabu', 22, '2022-12-30 14:41:34', '0000-00-00 00:00:00'),
(45, 'Rabu', 24, '2022-12-30 14:41:48', '0000-00-00 00:00:00'),
(46, 'Rabu', 26, '2022-12-30 14:41:58', '0000-00-00 00:00:00'),
(47, 'Rabu', 25, '2022-12-30 14:42:06', '0000-00-00 00:00:00'),
(48, 'Senin', 25, '2022-12-30 14:42:21', '0000-00-00 00:00:00'),
(49, 'Selasa', 25, '2022-12-30 14:42:40', '0000-00-00 00:00:00'),
(50, 'Kamis', 27, '2022-12-30 14:42:55', '0000-00-00 00:00:00'),
(51, 'Kamis', 23, '2022-12-30 14:43:03', '0000-00-00 00:00:00'),
(52, 'Kamis', 22, '2022-12-30 14:43:10', '0000-00-00 00:00:00'),
(53, 'Kamis', 24, '2022-12-30 14:43:14', '0000-00-00 00:00:00'),
(54, 'Kamis', 26, '2022-12-30 14:43:18', '0000-00-00 00:00:00'),
(55, 'Kamis', 25, '2022-12-30 14:43:23', '0000-00-00 00:00:00'),
(56, 'Jum\'at', 27, '2022-12-30 14:43:46', '0000-00-00 00:00:00'),
(57, 'Jum\'at', 23, '2022-12-30 14:43:57', '0000-00-00 00:00:00'),
(58, 'Jum\'at', 22, '2022-12-30 14:44:04', '0000-00-00 00:00:00'),
(59, 'Jum\'at', 24, '2022-12-30 14:44:17', '0000-00-00 00:00:00'),
(60, 'Jum\'at', 26, '2022-12-30 14:44:33', '0000-00-00 00:00:00'),
(61, 'Jum\'at', 25, '2022-12-30 14:44:37', '0000-00-00 00:00:00'),
(62, 'Sabtu', 27, '2022-12-30 14:45:09', '0000-00-00 00:00:00'),
(63, 'Sabtu', 23, '2022-12-30 14:45:29', '0000-00-00 00:00:00'),
(64, 'Sabtu', 22, '2022-12-30 14:45:37', '0000-00-00 00:00:00'),
(65, 'Sabtu', 24, '2022-12-30 14:45:42', '0000-00-00 00:00:00'),
(66, 'Sabtu', 26, '2022-12-30 14:45:47', '0000-00-00 00:00:00'),
(67, 'Sabtu', 25, '2022-12-30 14:45:53', '0000-00-00 00:00:00'),
(68, 'Minggu', 27, '2022-12-30 14:46:03', '0000-00-00 00:00:00'),
(69, 'Minggu', 23, '2022-12-30 14:46:08', '0000-00-00 00:00:00'),
(70, 'Minggu', 22, '2022-12-30 14:46:15', '0000-00-00 00:00:00'),
(71, 'Minggu', 24, '2022-12-30 14:46:20', '0000-00-00 00:00:00'),
(72, 'Minggu', 26, '2022-12-30 14:46:24', '0000-00-00 00:00:00'),
(73, 'Minggu', 25, '2022-12-30 14:46:29', '0000-00-00 00:00:00'),
(74, 'Rabu', 28, '2022-12-30 18:48:36', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `tgl_input` datetime NOT NULL,
  `tgl_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `tgl_input`, `tgl_update`) VALUES
(6, 'Bahan Baku', '2022-08-11 15:44:31', '0000-00-00 00:00:00'),
(7, 'Packaging', '2022-08-11 15:44:38', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `kategoriproduk`
--

CREATE TABLE `kategoriproduk` (
  `id_kategoriproduk` int(10) NOT NULL,
  `nama_kategoriproduk` varchar(50) NOT NULL,
  `tgl_input` datetime NOT NULL,
  `tgl_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategoriproduk`
--

INSERT INTO `kategoriproduk` (`id_kategoriproduk`, `nama_kategoriproduk`, `tgl_input`, `tgl_update`) VALUES
(4, 'Bubur Pagi', '2022-08-11 15:43:08', '2022-08-29 20:31:40'),
(5, 'Nasi Tim', '2022-08-11 15:43:18', '2022-08-29 20:30:55'),
(6, 'Puding', '2022-08-11 15:43:26', '2022-08-11 15:43:40'),
(7, 'Bubur Siang', '2022-08-29 20:31:54', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pemakaian`
--

CREATE TABLE `pemakaian` (
  `id_pemakaian` int(11) NOT NULL,
  `id_dapur` int(11) NOT NULL,
  `id_resep` int(11) NOT NULL,
  `id_bahan` int(11) NOT NULL,
  `sc` int(25) NOT NULL,
  `jumlah` int(50) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemakaian`
--

INSERT INTO `pemakaian` (`id_pemakaian`, `id_dapur`, `id_resep`, `id_bahan`, `sc`, `jumlah`, `tanggal`) VALUES
(42, 4, 153, 14, 2, 250, '2022-08-29');

--
-- Triggers `pemakaian`
--
DELIMITER $$
CREATE TRIGGER `delete_pemakaian` AFTER DELETE ON `pemakaian` FOR EACH ROW BEGIN
UPDATE stok SET jumlah = jumlah + OLD.jumlah WHERE id_dapur = OLD.id_dapur AND id_bahan = OLD.id_bahan;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `pemakaian` AFTER INSERT ON `pemakaian` FOR EACH ROW BEGIN
UPDATE stok SET jumlah = jumlah -NEW.jumlah WHERE id_dapur = NEW.id_dapur AND id_bahan = NEW.id_bahan;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `id_dapur` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(50) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `id_dapur`, `id_produk`, `jumlah`, `tanggal`) VALUES
(23, 2, 5, 1, '2022-08-29'),
(24, 5, 19, 20, '2022-08-29');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_kategoriproduk` int(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `tgl_input` datetime NOT NULL,
  `tgl_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategoriproduk`, `nama_produk`, `tgl_input`, `tgl_update`) VALUES
(1, 4, 'BUBUR AYAM MERAH', '2022-08-11 15:47:46', '2022-08-11 15:47:46'),
(2, 7, 'BUBUR TUNA BROKOLI', '2022-08-11 15:47:46', '2022-12-08 17:13:19'),
(3, 5, 'TIM CEKER BUNCIS', '2022-08-11 15:47:46', '2022-08-18 16:48:48'),
(4, 4, 'BUBUR SALMON BROKOLI', '2022-08-11 15:47:46', '2022-08-11 15:47:46'),
(5, 7, 'BUBUR AYAM JAGUNG', '2022-08-11 15:47:46', '2022-12-29 04:36:29'),
(7, 4, 'BUBUR DAGING KACANG IJO', '2022-08-11 15:47:46', '2022-08-11 15:47:46'),
(8, 7, 'BUBUR TOFU UDANG', '2022-08-11 15:47:46', '2022-12-29 04:36:49'),
(9, 5, 'TIM AYAM MERAH PUTIH', '2022-08-11 15:47:46', '2022-08-18 16:48:58'),
(10, 4, 'BUBUR MERAH KEJU', '2022-08-11 15:47:46', '2022-08-11 21:01:46'),
(11, 7, 'BUBUR DAGING LABU KUNING', '2022-08-11 15:47:46', '2022-12-29 04:37:06'),
(12, 5, 'TIM DAGING KEJU', '2022-08-11 15:47:46', '2022-08-18 16:48:39'),
(13, 4, 'BUBUR UBI TUNA', '2022-08-11 15:47:46', '2022-08-11 15:47:46'),
(14, 7, 'BUBUR CEKER WORTEL', '2022-08-11 15:47:46', '2022-12-29 04:37:18'),
(15, 5, 'TIM SEMUR HATI AYAM', '2022-08-11 15:47:46', '2022-08-11 20:46:02'),
(16, 4, 'BUBUR JAGUNG CEKER', '2022-08-11 15:47:46', '2022-08-11 15:47:46'),
(17, 7, 'BUBUR DAGING TARO', '2022-08-11 15:47:46', '2022-12-29 04:37:35'),
(18, 5, 'TIM TUNA BROKOLI', '2022-08-11 15:47:46', '2022-08-18 16:48:27'),
(19, 7, ' BUBUR KENTANG WORTEL ', '2022-08-18 16:49:39', '2022-12-29 04:37:58'),
(20, 5, ' TIM KENTANG AYAM KEJU ', '2022-08-18 16:49:49', '0000-00-00 00:00:00'),
(22, 6, 'PUDING MANGGA', '2022-08-29 20:33:17', '2022-12-29 17:51:23'),
(23, 6, 'PUDING COKLAT', '2022-12-29 17:51:39', '0000-00-00 00:00:00'),
(24, 6, 'PUDING MELON', '2022-12-29 17:51:48', '0000-00-00 00:00:00'),
(25, 6, 'PUDING STRAWBERRY', '2022-12-29 17:52:14', '0000-00-00 00:00:00'),
(26, 6, 'PUDING PANDAN', '2022-12-29 17:52:25', '0000-00-00 00:00:00'),
(27, 6, 'PUDING BUAH NAGA', '2022-12-29 17:52:34', '0000-00-00 00:00:00'),
(28, 5, 'TIM HATI AYAM', '2022-12-30 18:48:12', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `req`
--

CREATE TABLE `req` (
  `id_req` int(11) NOT NULL,
  `id_dapur` int(11) NOT NULL,
  `id_bahan` int(11) NOT NULL,
  `jumlah` int(50) NOT NULL,
  `total_harga` int(50) NOT NULL,
  `status` varchar(22) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `req`
--

INSERT INTO `req` (`id_req`, `id_dapur`, `id_bahan`, `jumlah`, `total_harga`, `status`, `tanggal`) VALUES
(11, 5, 2, 2, 20, 'Terkirim', '2022-08-29'),
(12, 4, 14, 5000, 50000, 'Terkirim', '2022-08-29'),
(13, 2, 1, 25000, 308000, 'Tunggu', '2022-12-30'),
(14, 2, 35, 60, 420000, 'Tunggu', '2022-12-30'),
(15, 2, 21, 5000, 50000, 'Tunggu', '2022-12-30'),
(19, 3, 4, 2000, 100000, 'Terkirim', '2022-12-30'),
(21, 2, 2, 2000, 40000, 'Terkirim', '2022-12-30');

-- --------------------------------------------------------

--
-- Table structure for table `resep`
--

CREATE TABLE `resep` (
  `id_resep` int(10) NOT NULL,
  `id_produk` int(10) NOT NULL,
  `id_takaran` int(11) NOT NULL,
  `id_bahan` int(10) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `tgl_input` datetime NOT NULL,
  `tgl_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resep`
--

INSERT INTO `resep` (`id_resep`, `id_produk`, `id_takaran`, `id_bahan`, `jumlah`, `tgl_input`, `tgl_update`) VALUES
(54, 1, 47, 1, 550, '2022-08-11 17:23:23', '0000-00-00 00:00:00'),
(55, 1, 48, 2, 150, '2022-08-11 17:23:35', '0000-00-00 00:00:00'),
(56, 1, 49, 1, 450, '2022-08-11 17:24:05', '0000-00-00 00:00:00'),
(57, 1, 50, 2, 100, '2022-08-11 17:24:15', '0000-00-00 00:00:00'),
(58, 1, 11, 4, 80, '2022-08-11 17:24:37', '0000-00-00 00:00:00'),
(59, 1, 24, 17, 150, '2022-08-11 17:24:52', '0000-00-00 00:00:00'),
(60, 1, 21, 14, 125, '2022-08-11 17:25:07', '0000-00-00 00:00:00'),
(61, 18, 51, 40, 100, '2022-08-18 15:28:17', '0000-00-00 00:00:00'),
(62, 2, 47, 1, 650, '2022-08-18 15:41:07', '0000-00-00 00:00:00'),
(63, 2, 49, 1, 525, '2022-08-18 15:41:25', '0000-00-00 00:00:00'),
(64, 2, 29, 22, 200, '2022-08-18 15:42:36', '0000-00-00 00:00:00'),
(65, 2, 28, 21, 60, '2022-08-18 15:42:46', '0000-00-00 00:00:00'),
(66, 2, 16, 9, 25, '2022-08-18 15:44:03', '0000-00-00 00:00:00'),
(67, 2, 12, 5, 60, '2022-08-18 15:44:13', '0000-00-00 00:00:00'),
(68, 3, 8, 1, 7550, '2022-08-18 15:51:56', '0000-00-00 00:00:00'),
(69, 3, 14, 7, 20, '2022-08-18 15:52:12', '0000-00-00 00:00:00'),
(70, 3, 25, 18, 20, '2022-08-18 15:52:36', '0000-00-00 00:00:00'),
(71, 3, 21, 14, 50, '2022-08-18 15:52:49', '0000-00-00 00:00:00'),
(72, 3, 17, 10, 50, '2022-08-18 15:53:05', '0000-00-00 00:00:00'),
(73, 4, 47, 1, 650, '2022-08-18 15:54:02', '0000-00-00 00:00:00'),
(74, 4, 49, 1, 525, '2022-08-18 15:54:16', '0000-00-00 00:00:00'),
(75, 4, 13, 6, 50, '2022-08-18 15:54:31', '0000-00-00 00:00:00'),
(76, 4, 28, 21, 60, '2022-08-18 15:54:41', '0000-00-00 00:00:00'),
(77, 4, 17, 10, 30, '2022-08-18 15:55:08', '0000-00-00 00:00:00'),
(78, 4, 32, 25, 150, '2022-08-18 15:55:24', '0000-00-00 00:00:00'),
(79, 5, 47, 1, 650, '2022-08-18 15:55:56', '0000-00-00 00:00:00'),
(80, 5, 49, 1, 525, '2022-08-18 15:56:06', '0000-00-00 00:00:00'),
(81, 5, 53, 15, 400, '2022-08-18 15:58:03', '0000-00-00 00:00:00'),
(82, 5, 25, 18, 100, '2022-08-18 15:58:13', '0000-00-00 00:00:00'),
(83, 5, 18, 11, 83, '2022-08-18 15:59:02', '0000-00-00 00:00:00'),
(84, 5, 11, 4, 80, '2022-08-18 15:59:15', '0000-00-00 00:00:00'),
(85, 12, 8, 1, 7550, '2022-08-18 16:00:25', '0000-00-00 00:00:00'),
(86, 12, 21, 14, 50, '2022-08-18 16:00:39', '0000-00-00 00:00:00'),
(87, 12, 54, 15, 80, '2022-08-18 16:00:52', '0000-00-00 00:00:00'),
(88, 12, 10, 3, 25, '2022-08-18 16:01:03', '0000-00-00 00:00:00'),
(89, 12, 55, 13, 14, '2022-08-18 16:01:44', '0000-00-00 00:00:00'),
(90, 7, 47, 1, 650, '2022-08-18 16:02:13', '0000-00-00 00:00:00'),
(91, 7, 49, 1, 525, '2022-08-18 16:02:23', '0000-00-00 00:00:00'),
(92, 7, 10, 3, 80, '2022-08-18 16:02:37', '0000-00-00 00:00:00'),
(93, 7, 22, 15, 400, '2022-08-18 16:02:49', '0000-00-00 00:00:00'),
(94, 7, 16, 9, 25, '2022-08-18 16:03:07', '0000-00-00 00:00:00'),
(95, 8, 47, 1, 650, '2022-08-18 16:03:34', '0000-00-00 00:00:00'),
(96, 8, 49, 1, 525, '2022-08-18 16:03:43', '0000-00-00 00:00:00'),
(97, 8, 24, 17, 150, '2022-08-18 16:05:29', '0000-00-00 00:00:00'),
(98, 8, 21, 14, 125, '2022-08-18 16:05:41', '0000-00-00 00:00:00'),
(99, 8, 19, 12, 70, '2022-08-18 16:05:54', '0000-00-00 00:00:00'),
(100, 8, 20, 13, 27, '2022-08-18 16:07:15', '0000-00-00 00:00:00'),
(101, 9, 8, 1, 106, '2022-08-18 16:07:45', '0000-00-00 00:00:00'),
(102, 9, 9, 2, 45, '2022-08-18 16:08:00', '0000-00-00 00:00:00'),
(103, 9, 18, 11, 10, '2022-08-18 16:08:16', '2022-12-30 21:44:47'),
(104, 9, 11, 4, 25, '2022-08-18 16:08:30', '0000-00-00 00:00:00'),
(105, 9, 24, 17, 30, '2022-08-18 16:08:45', '0000-00-00 00:00:00'),
(106, 10, 47, 1, 550, '2022-08-18 16:32:33', '0000-00-00 00:00:00'),
(107, 10, 48, 2, 150, '2022-08-18 16:32:45', '0000-00-00 00:00:00'),
(108, 10, 49, 1, 450, '2022-08-18 16:32:57', '0000-00-00 00:00:00'),
(109, 10, 50, 2, 150, '2022-08-18 16:33:07', '0000-00-00 00:00:00'),
(110, 10, 11, 4, 80, '2022-08-18 16:33:18', '0000-00-00 00:00:00'),
(111, 10, 25, 18, 100, '2022-08-18 16:33:29', '0000-00-00 00:00:00'),
(112, 10, 20, 13, 27, '2022-08-18 16:33:44', '0000-00-00 00:00:00'),
(113, 11, 47, 1, 650, '2022-08-18 16:34:31', '0000-00-00 00:00:00'),
(114, 11, 49, 1, 525, '2022-08-18 16:34:43', '0000-00-00 00:00:00'),
(115, 11, 57, 41, 200, '2022-08-18 16:37:00', '0000-00-00 00:00:00'),
(116, 11, 18, 11, 125, '2022-08-18 16:37:18', '2022-12-30 21:48:09'),
(117, 11, 10, 3, 80, '2022-08-18 16:37:29', '0000-00-00 00:00:00'),
(118, 13, 47, 1, 650, '2022-08-18 16:38:19', '0000-00-00 00:00:00'),
(119, 13, 49, 1, 525, '2022-08-18 16:38:30', '0000-00-00 00:00:00'),
(120, 13, 12, 5, 60, '2022-08-18 16:38:45', '0000-00-00 00:00:00'),
(121, 13, 26, 19, 70, '2022-08-18 16:38:56', '0000-00-00 00:00:00'),
(122, 13, 31, 24, 150, '2022-08-18 16:39:09', '0000-00-00 00:00:00'),
(123, 14, 47, 1, 650, '2022-08-18 16:39:31', '0000-00-00 00:00:00'),
(124, 14, 49, 1, 525, '2022-08-18 16:39:39', '0000-00-00 00:00:00'),
(125, 14, 27, 20, 60, '2022-08-18 16:39:50', '0000-00-00 00:00:00'),
(126, 14, 14, 7, 85, '2022-08-18 16:40:05', '2022-12-30 21:52:40'),
(127, 14, 21, 14, 125, '2022-08-18 16:40:15', '0000-00-00 00:00:00'),
(128, 14, 17, 10, 30, '2022-08-18 16:40:30', '0000-00-00 00:00:00'),
(129, 15, 8, 1, 7550, '2022-08-18 16:40:54', '0000-00-00 00:00:00'),
(130, 15, 15, 8, 25, '2022-08-18 16:41:12', '0000-00-00 00:00:00'),
(131, 15, 57, 41, 80, '2022-08-18 16:41:24', '0000-00-00 00:00:00'),
(132, 15, 25, 18, 20, '2022-08-18 16:41:32', '0000-00-00 00:00:00'),
(133, 16, 47, 1, 650, '2022-08-18 16:41:55', '0000-00-00 00:00:00'),
(134, 16, 49, 1, 525, '2022-08-18 16:42:04', '0000-00-00 00:00:00'),
(135, 16, 14, 7, 100, '2022-08-18 16:42:13', '0000-00-00 00:00:00'),
(136, 16, 21, 14, 125, '2022-08-18 16:42:22', '0000-00-00 00:00:00'),
(137, 16, 22, 15, 400, '2022-08-18 16:42:40', '0000-00-00 00:00:00'),
(138, 16, 33, 26, 25, '2022-08-18 16:42:52', '0000-00-00 00:00:00'),
(139, 17, 47, 1, 650, '2022-08-18 16:43:08', '0000-00-00 00:00:00'),
(140, 17, 49, 1, 525, '2022-08-18 16:43:15', '0000-00-00 00:00:00'),
(141, 17, 10, 3, 80, '2022-08-18 16:43:27', '0000-00-00 00:00:00'),
(142, 17, 30, 23, 150, '2022-08-18 16:43:41', '0000-00-00 00:00:00'),
(143, 17, 24, 17, 150, '2022-08-18 16:43:54', '0000-00-00 00:00:00'),
(144, 17, 18, 11, 83, '2022-08-18 16:44:07', '0000-00-00 00:00:00'),
(145, 18, 8, 1, 7550, '2022-08-18 16:44:34', '0000-00-00 00:00:00'),
(146, 18, 12, 5, 20, '2022-08-18 16:44:43', '0000-00-00 00:00:00'),
(147, 18, 28, 21, 20, '2022-08-18 16:44:52', '0000-00-00 00:00:00'),
(148, 18, 18, 11, 20, '2022-08-18 16:45:56', '0000-00-00 00:00:00'),
(149, 18, 55, 13, 14, '2022-08-18 16:46:21', '0000-00-00 00:00:00'),
(150, 19, 47, 1, 650, '2022-08-18 16:50:09', '2022-08-29 19:20:58'),
(151, 19, 49, 1, 525, '2022-08-18 16:50:17', '0000-00-00 00:00:00'),
(152, 19, 29, 22, 200, '2022-08-18 16:50:29', '0000-00-00 00:00:00'),
(153, 19, 21, 14, 125, '2022-08-18 16:50:39', '0000-00-00 00:00:00'),
(154, 19, 20, 13, 27, '2022-08-18 16:50:56', '0000-00-00 00:00:00'),
(155, 20, 8, 1, 7550, '2022-08-18 16:51:25', '0000-00-00 00:00:00'),
(156, 20, 11, 4, 25, '2022-08-18 16:51:37', '0000-00-00 00:00:00'),
(157, 20, 29, 22, 50, '2022-08-18 16:52:11', '0000-00-00 00:00:00'),
(158, 20, 21, 14, 50, '2022-08-18 16:52:21', '0000-00-00 00:00:00'),
(159, 20, 55, 13, 14, '2022-08-18 16:52:31', '0000-00-00 00:00:00'),
(160, 22, 40, 33, 1, '2022-08-29 20:35:11', '2022-08-29 20:35:40'),
(161, 19, 58, 42, 50, '2022-12-29 17:43:24', '0000-00-00 00:00:00'),
(162, 28, 8, 1, 170, '2022-12-30 18:50:18', '0000-00-00 00:00:00'),
(163, 28, 15, 8, 25, '2022-12-30 18:51:06', '2022-12-30 18:55:15'),
(164, 28, 25, 18, 15, '2022-12-30 18:52:44', '2022-12-30 18:53:01'),
(165, 28, 57, 41, 80, '2022-12-30 18:58:55', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(100) NOT NULL,
  `tgl_input` datetime NOT NULL,
  `tgl_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `nama_satuan`, `tgl_input`, `tgl_update`) VALUES
(6, 'Gram', '2022-08-11 15:44:56', '0000-00-00 00:00:00'),
(7, 'Pieces', '2022-08-29 20:37:02', '2022-12-08 17:27:11'),
(8, 'Bungkus', '2022-12-30 17:45:44', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE `stok` (
  `id_stok` int(11) NOT NULL,
  `id_dapur` int(10) NOT NULL,
  `id_bahan` int(10) NOT NULL,
  `jumlah` int(50) NOT NULL,
  `tgl_input` date NOT NULL,
  `tgl_update` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`id_stok`, `id_dapur`, `id_bahan`, `jumlah`, `tgl_input`, `tgl_update`) VALUES
(96, 2, 6, 1200, '2022-12-30', '2022-12-30'),
(97, 2, 5, 3500, '2022-12-30', '2022-12-30'),
(98, 2, 13, 6000, '2022-12-30', '2022-12-30'),
(99, 3, 4, 2000, '2022-12-30', '2022-12-30'),
(100, 2, 2, 2000, '2022-12-30', '2022-12-30');

-- --------------------------------------------------------

--
-- Table structure for table `takaran`
--

CREATE TABLE `takaran` (
  `id_takaran` int(11) NOT NULL,
  `nama_takaran` varchar(55) NOT NULL,
  `id_bahan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `takaran`
--

INSERT INTO `takaran` (`id_takaran`, `nama_takaran`, `id_bahan`) VALUES
(8, 'Beras Putih', 1),
(9, 'Beras Merah', 2),
(10, 'Daging Sapi Giling', 3),
(11, 'Daging Ayam Giling', 4),
(12, 'Ikan Tuna', 5),
(13, 'Ikan Salmon', 6),
(14, 'Ceker Ayam', 7),
(15, 'Hati Ayam', 8),
(16, 'Kacang Hijau', 9),
(17, 'Kacang Merah', 10),
(18, 'Tahu Putih', 11),
(19, 'Tofu udang', 12),
(20, 'Keju', 13),
(21, 'Wortel', 14),
(22, 'Jagung Manis', 15),
(23, 'labu parang/Kuning', 16),
(24, 'Labu Siam', 17),
(25, 'Buncis', 18),
(26, 'Kacang Panjang', 19),
(27, 'Sawi Hijau', 20),
(28, 'Brokoli', 21),
(29, 'Kentang', 22),
(30, 'Ubi Ungu', 23),
(31, 'UBI KUNING', 24),
(32, 'Ubi Merah', 25),
(33, 'KACANG KEDELAI', 26),
(34, 'Kacang Merah Basah', 27),
(35, 'KACANG IJO KUPAS', 28),
(36, 'UNSALTED BUTTER', 29),
(37, 'OATMEAL', 30),
(38, 'AGAR SWALLOW MERAH', 31),
(39, 'AGAR SWALLOW PLAIN', 32),
(40, 'PUDING MANGGA', 33),
(41, 'PUDING STRAWBERI', 34),
(42, 'PUDING COKLAT', 35),
(44, 'PUDING MELON', 37),
(45, 'BUAH NAGA', 38),
(46, 'BUAH JERUK', 39),
(47, 'Beras Putih SC Besar', 1),
(48, 'Beras Merah SC Besar', 2),
(49, 'Beras Putih SC Kecil', 1),
(50, 'Beras Merah SC Kecil', 2),
(53, 'Jagung manis bubur', 15),
(54, 'Jagung Manis Tim', 15),
(55, 'Keju Tim', 13),
(57, 'LABU KUNING', 41),
(58, 'Ikan Dori', 42),
(59, 'Paper Cup 180 ml', 43),
(60, 'Paper Cup 120  ml', 44),
(61, 'Cup Puding 100 ml', 45),
(62, 'Lid Paper Cup 180 ml', 46),
(63, 'Lid Paper Cup 110 ml', 47),
(64, 'Kantung Plastik', 48),
(65, 'Cup Thinwall 200 ml', 49),
(66, 'Lid Cup Thinwall 200 ml', 50),
(67, 'Sendok Puding', 51),
(68, 'Lid Cup Puding 100 ml', 52);

--
-- Triggers `takaran`
--
DELIMITER $$
CREATE TRIGGER `bahan` AFTER UPDATE ON `takaran` FOR EACH ROW BEGIN
UPDATE resep SET id_bahan = NEW.id_bahan WHERE id_takaran = NEW.id_takaran;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `profile` varchar(100) NOT NULL,
  `password` varchar(225) NOT NULL,
  `alamat` text NOT NULL,
  `role_id` enum('1','2','3','4') NOT NULL,
  `id_dapur` int(11) NOT NULL,
  `is_active` enum('0','1') NOT NULL,
  `tgl_input` datetime NOT NULL,
  `tgl_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `nama`, `no_hp`, `profile`, `password`, `alamat`, `role_id`, `id_dapur`, `is_active`, `tgl_input`, `tgl_update`) VALUES
(13, 'Muara 1 Prima', 'Miftah Aulia Ibrahim', '081211040812', 'default.png', '$2y$10$ohy3j2EfcYjzdRNSDIWWKOFD/TH5aKRegbLUfpZsb2mvNVctaF0FG', 'Jl. Gamprit 1 no. 25 A Jatiwaringin - Bekasi', '1', 1, '1', '2022-08-29 18:56:34', '0000-00-00 00:00:00'),
(14, 'Admin Bogor', 'Budi', '081367662194', 'default.png', '$2y$10$rCbGl06Akqthe6oUTRdViO02Kjl.wRkykspEoYr.pFwQgYlbIz.P.', 'Laladon Permai Ciomas Bogor', '2', 2, '1', '2022-08-29 19:03:10', '0000-00-00 00:00:00'),
(15, 'Admin Gamprit', 'Ary Nurita', '082241641161', 'default.png', '$2y$10$jBOSJ9S4y.0fVeMOSsk2quhVm6w9qEP8d4tg1IgIbhgXIW3rrCElm', 'Jl.Gamprit 2 No.48 Jatiwaringin Pondok Gede', '2', 4, '1', '2022-08-29 19:06:03', '0000-00-00 00:00:00'),
(16, 'Admin HI', 'Figik', '08811586739', 'default.png', '$2y$10$H3rs8y2nBEkJ3JJb8Ttm9OrTZzS60s.wv9.ocBrxWIZsyWMdcbpnW', 'Duta Bumi 3 Blok F No.09 Harapan Indah', '2', 3, '1', '2022-08-29 19:08:17', '0000-00-00 00:00:00'),
(17, 'Admin Kalisari', 'R Wanda', '082375620737', 'default.png', '$2y$10$KuCf4DBdkUEszNGKxzaMvOZ7gO4nfjv5mZWhjzfaPfIpNSSOB2erq', 'Kalisari 3 Jakarta Timur', '2', 5, '1', '2022-08-29 19:09:40', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan`
--
ALTER TABLE `bahan`
  ADD PRIMARY KEY (`id_bahan`);

--
-- Indexes for table `dapur`
--
ALTER TABLE `dapur`
  ADD PRIMARY KEY (`id_dapur`);

--
-- Indexes for table `drop_stok`
--
ALTER TABLE `drop_stok`
  ADD PRIMARY KEY (`id_drop_stok`),
  ADD KEY `id_pm` (`id_bahan`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kategoriproduk`
--
ALTER TABLE `kategoriproduk`
  ADD PRIMARY KEY (`id_kategoriproduk`);

--
-- Indexes for table `pemakaian`
--
ALTER TABLE `pemakaian`
  ADD PRIMARY KEY (`id_pemakaian`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `kategori` (`id_kategoriproduk`);

--
-- Indexes for table `req`
--
ALTER TABLE `req`
  ADD PRIMARY KEY (`id_req`);

--
-- Indexes for table `resep`
--
ALTER TABLE `resep`
  ADD PRIMARY KEY (`id_resep`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`id_stok`);

--
-- Indexes for table `takaran`
--
ALTER TABLE `takaran`
  ADD PRIMARY KEY (`id_takaran`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bahan`
--
ALTER TABLE `bahan`
  MODIFY `id_bahan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `dapur`
--
ALTER TABLE `dapur`
  MODIFY `id_dapur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `drop_stok`
--
ALTER TABLE `drop_stok`
  MODIFY `id_drop_stok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kategoriproduk`
--
ALTER TABLE `kategoriproduk`
  MODIFY `id_kategoriproduk` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pemakaian`
--
ALTER TABLE `pemakaian`
  MODIFY `id_pemakaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `req`
--
ALTER TABLE `req`
  MODIFY `id_req` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `resep`
--
ALTER TABLE `resep`
  MODIFY `id_resep` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `takaran`
--
ALTER TABLE `takaran`
  MODIFY `id_takaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
