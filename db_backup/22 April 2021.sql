-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2021 at 10:58 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_spa`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill_of_materials`
--

CREATE TABLE `bill_of_materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `detail_produk_id` bigint(20) UNSIGNED DEFAULT NULL,
  `part_eng_id` bigint(20) UNSIGNED DEFAULT NULL,
  `model` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('ada','tidak_ada') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bill_of_materials`
--

INSERT INTO `bill_of_materials` (`id`, `detail_produk_id`, `part_eng_id`, `model`, `jumlah`, `satuan`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(2, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(3, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(4, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(5, NULL, NULL, NULL, 4, 'Pcs', 'ada', NULL, NULL),
(6, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(7, NULL, NULL, NULL, 4, 'Pcs', 'ada', NULL, NULL),
(8, NULL, NULL, NULL, 2, 'Pcs', 'ada', NULL, NULL),
(9, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(10, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(11, NULL, NULL, NULL, 4, 'Pcs', 'ada', NULL, NULL),
(12, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(13, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(14, NULL, NULL, NULL, 1, 'Set', 'ada', NULL, NULL),
(15, NULL, NULL, NULL, 1, 'Set', 'ada', NULL, NULL),
(16, NULL, NULL, NULL, 2, 'Pcs', 'ada', NULL, NULL),
(17, NULL, NULL, NULL, 6, 'Pcs', 'ada', NULL, NULL),
(18, NULL, NULL, NULL, 2, 'Pcs', 'ada', NULL, NULL),
(19, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(20, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(21, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(22, NULL, NULL, NULL, 2, 'Pcs', 'ada', NULL, NULL),
(23, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(24, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(25, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(26, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(27, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(28, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(29, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(30, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(31, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(32, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(33, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(34, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(35, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(36, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(37, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(38, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(39, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(40, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(41, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(42, NULL, NULL, NULL, 2, 'Pcs', 'ada', NULL, NULL),
(43, NULL, NULL, NULL, 1, 'Set', 'ada', NULL, NULL),
(44, NULL, NULL, NULL, 1, 'Set', 'ada', NULL, NULL),
(45, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(46, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(47, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(48, NULL, NULL, NULL, 1, 'Set', 'ada', NULL, NULL),
(49, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(50, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(51, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(52, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(53, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(54, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(55, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(56, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(57, NULL, NULL, NULL, 2, 'Pcs', 'ada', NULL, NULL),
(58, NULL, NULL, NULL, 2, 'Pcs', 'ada', NULL, NULL),
(59, NULL, NULL, NULL, 2, 'Pcs', 'ada', NULL, NULL),
(60, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(61, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(62, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(63, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(64, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(65, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(66, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(67, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(68, NULL, NULL, NULL, 2, 'Pcs', 'ada', NULL, NULL),
(69, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(70, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(71, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(72, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(73, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(74, NULL, NULL, NULL, 4, 'Pcs', 'ada', NULL, NULL),
(75, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(76, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(77, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(78, NULL, NULL, NULL, 1, 'Set', 'ada', NULL, NULL),
(79, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(80, NULL, NULL, NULL, 3, 'Pcs', 'ada', NULL, NULL),
(81, NULL, NULL, NULL, 4, 'Pcs', 'ada', NULL, NULL),
(82, NULL, NULL, NULL, 6, 'Pcs', 'ada', NULL, NULL),
(83, NULL, NULL, NULL, 4, 'Pcs', 'ada', NULL, NULL),
(84, NULL, NULL, NULL, 2, 'Pcs', 'ada', NULL, NULL),
(85, NULL, NULL, NULL, 2, 'Pcs', 'ada', NULL, NULL),
(86, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(87, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(88, NULL, NULL, NULL, 4, 'Pcs', 'ada', NULL, NULL),
(89, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(90, NULL, NULL, NULL, 2, 'Pcs', 'ada', NULL, NULL),
(91, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(92, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(93, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(94, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(95, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(96, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(97, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(98, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(99, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(100, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(101, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(102, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(103, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(104, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(105, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(106, NULL, NULL, NULL, 2, 'Pcs', 'ada', NULL, NULL),
(107, NULL, NULL, NULL, 2, 'Pcs', 'ada', NULL, NULL),
(108, NULL, NULL, NULL, 2, 'Pcs', 'ada', NULL, NULL),
(109, NULL, NULL, NULL, 2, 'Pcs', 'ada', NULL, NULL),
(110, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(111, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(112, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(113, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(114, NULL, NULL, NULL, 2, 'Pcs', 'ada', NULL, NULL),
(115, NULL, NULL, NULL, 2, 'Pcs', 'ada', NULL, NULL),
(116, NULL, NULL, NULL, 2, 'Pcs', 'ada', NULL, NULL),
(117, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(118, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(119, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(120, NULL, NULL, NULL, 4, 'Pcs', 'ada', NULL, NULL),
(121, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(122, NULL, NULL, NULL, 6, 'Pcs', 'ada', NULL, NULL),
(123, NULL, NULL, NULL, 3, 'Pcs', 'ada', NULL, NULL),
(124, NULL, NULL, NULL, 4, 'Pcs', 'ada', NULL, NULL),
(125, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(126, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(127, NULL, NULL, NULL, 1, 'Set', 'ada', NULL, NULL),
(128, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(129, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(130, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(131, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(132, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(133, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(134, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(135, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(136, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(137, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(138, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(139, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(140, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(141, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(142, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(143, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(144, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(145, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(146, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(147, NULL, NULL, NULL, 2, 'Pcs', 'ada', NULL, NULL),
(148, NULL, NULL, NULL, 2, 'Pcs', 'ada', NULL, NULL),
(149, NULL, NULL, NULL, 2, 'Pcs', 'ada', NULL, NULL),
(150, NULL, NULL, NULL, 2, 'Pcs', 'ada', NULL, NULL),
(151, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(152, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(153, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(154, NULL, NULL, NULL, 2, 'Pcs', 'ada', NULL, NULL),
(155, NULL, NULL, NULL, 2, 'Pcs', 'ada', NULL, NULL),
(156, NULL, NULL, NULL, 2, 'Pcs', 'ada', NULL, NULL),
(157, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(158, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(159, NULL, NULL, NULL, 4, 'Pcs', 'ada', NULL, NULL),
(160, NULL, NULL, NULL, 4, 'Pcs', 'ada', NULL, NULL),
(161, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(162, NULL, NULL, NULL, 6, 'Pcs', 'ada', NULL, NULL),
(163, NULL, NULL, NULL, 3, 'Pcs', 'ada', NULL, NULL),
(164, NULL, NULL, NULL, 4, 'Pcs', 'ada', NULL, NULL),
(165, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(166, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(167, NULL, NULL, NULL, 1, 'Set', 'ada', NULL, NULL),
(168, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(169, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(170, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(171, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(172, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(173, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(174, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(175, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(176, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(177, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(178, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL),
(179, NULL, NULL, NULL, 1, 'Pcs', 'ada', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bppbs`
--

CREATE TABLE `bppbs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `detail_produk_id` bigint(20) UNSIGNED DEFAULT NULL,
  `divisi_id` bigint(20) UNSIGNED NOT NULL,
  `no_bppb` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_bppb` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` enum('12','13','9') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bppbs`
--

INSERT INTO `bppbs` (`id`, `detail_produk_id`, `divisi_id`, `no_bppb`, `tanggal_bppb`, `jumlah`, `status`, `created_at`, `updated_at`) VALUES
(28, 1, 17, '0001/TR05/04/21', '2021-04-19', 1, '12', '2021-04-18 17:46:35', '2021-04-18 17:46:35'),
(29, 2, 17, '0001/TR05/04/21', '2021-04-19', 10, '12', '2021-04-18 19:09:02', '2021-04-18 19:18:36');

-- --------------------------------------------------------

--
-- Table structure for table `data_stok_produks`
--

CREATE TABLE `data_stok_produks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stok_produk_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('tersedia','dipinjam','diuji','tidak_tersedia') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_ecommerces`
--

CREATE TABLE `detail_ecommerces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ecommerces_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `harga` double NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_ecommerces`
--

INSERT INTO `detail_ecommerces` (`id`, `ecommerces_id`, `produk_id`, `harga`, `jumlah`, `keterangan`, `created_at`, `updated_at`) VALUES
(25, 30, 3, 3500000, 1, NULL, '2021-04-13 23:09:52', '2021-04-13 23:09:52'),
(26, 30, 13, 3500000, 1, NULL, '2021-04-13 23:09:52', '2021-04-13 23:09:52'),
(27, 31, 34, 3500000, 2, NULL, '2021-04-13 23:10:23', '2021-04-13 23:10:23'),
(28, 32, 44, 3500000, 1, NULL, '2021-04-13 23:11:32', '2021-04-13 23:11:32'),
(29, 32, 43, 3500000, 3, NULL, '2021-04-13 23:11:32', '2021-04-13 23:11:32');

-- --------------------------------------------------------

--
-- Table structure for table `detail_ekatjuals`
--

CREATE TABLE `detail_ekatjuals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ekatjuals_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `harga` double NOT NULL,
  `jumlah` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_ekatjuals`
--

INSERT INTO `detail_ekatjuals` (`id`, `ekatjuals_id`, `produk_id`, `harga`, `jumlah`, `created_at`, `updated_at`) VALUES
(29, 2, 5, 3500000, 2, '2021-04-08 23:04:59', '2021-04-13 01:53:51'),
(30, 3, 9, 1300000, 2, '2021-04-12 20:35:16', '2021-04-12 21:05:01'),
(31, 3, 5, 3800000, 7, '2021-04-12 20:37:54', '2021-04-12 21:04:52');

-- --------------------------------------------------------

--
-- Table structure for table `detail_inventories`
--

CREATE TABLE `detail_inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `inventory_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_offlines`
--

CREATE TABLE `detail_offlines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `offline_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `harga` double NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_offlines`
--

INSERT INTO `detail_offlines` (`id`, `offline_id`, `produk_id`, `harga`, `jumlah`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 3500000, 1, 'koneng', '2021-04-09 01:31:32', '2021-04-13 01:32:10'),
(2, 1, 22, 3500000, 2, 'poteh', '2021-04-09 01:31:32', '2021-04-13 01:54:45'),
(3, 2, 3, 3500000, 10, NULL, '2021-04-09 02:11:19', '2021-04-13 01:38:58'),
(4, 3, 3, 3500000, 1, NULL, '2021-04-09 03:10:25', '2021-04-09 03:10:25');

-- --------------------------------------------------------

--
-- Table structure for table `detail_paket_produks`
--

CREATE TABLE `detail_paket_produks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paket_produk_id` bigint(20) UNSIGNED DEFAULT NULL,
  `produk_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_paket_produks`
--

INSERT INTO `detail_paket_produks` (`id`, `paket_produk_id`, `produk_id`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2021-02-24 11:27:26', '2021-02-25 17:00:00'),
(2, 1, 2, 1, '2021-03-16 06:53:49', '2021-03-15 06:53:49'),
(3, 2, 5, 2, '2021-02-10 17:00:00', '2021-02-24 17:00:45'),
(4, 2, 4, 1, '2021-03-16 06:53:49', '2021-02-10 11:32:02');

-- --------------------------------------------------------

--
-- Table structure for table `detail_peminjaman_karyawans`
--

CREATE TABLE `detail_peminjaman_karyawans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `peminjaman_karyawan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `karyawan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggal_pemberhentian` date DEFAULT NULL,
  `status` enum('draft','menunggu','terima','tolak','berhenti') COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_peminjaman_karyawans`
--

INSERT INTO `detail_peminjaman_karyawans` (`id`, `peminjaman_karyawan_id`, `karyawan_id`, `tanggal_pemberhentian`, `status`, `keterangan`, `created_at`, `updated_at`) VALUES
(10, 1, 7, NULL, 'menunggu', 'Analisa C', '2021-04-08 21:16:16', '2021-04-11 21:32:23'),
(11, 1, 9, NULL, 'menunggu', 'Analisa Jaringan', '2021-04-08 21:17:14', '2021-04-09 03:02:52'),
(12, 3, 1, NULL, 'draft', 'Pengemasan DSPRO', '2021-04-08 21:34:10', '2021-04-08 21:34:10'),
(13, 3, 4, NULL, 'draft', 'Pengemasan FOX', '2021-04-08 21:34:10', '2021-04-08 21:34:10'),
(14, 4, 8, NULL, 'draft', 'Bagian admin, lab, eng', '2021-04-08 23:45:00', '2021-04-08 23:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `detail_produks`
--

CREATE TABLE `detail_produks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `produk_id` bigint(20) UNSIGNED DEFAULT NULL,
  `kode` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int(11) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `berat` double DEFAULT NULL,
  `satuan` enum('pc','pcs','set','unit','dus','roll','meter','pack') COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('ada','tidak_ada') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_produks`
--

INSERT INTO `detail_produks` (`id`, `produk_id`, `kode`, `nama`, `stok`, `harga`, `foto`, `berat`, `satuan`, `keterangan`, `status`, `created_at`, `updated_at`) VALUES
(1, 55, 'BJHH05USG01', 'CMS-600 PLUS', NULL, 106590000, NULL, NULL, 'pc', NULL, 'ada', '2021-04-15 22:04:32', '2021-04-15 22:04:32'),
(2, 55, 'BJHH05USG03', 'CMS-600 PLUS + TROLLEY', NULL, 116270000, NULL, NULL, 'pc', NULL, 'ada', '2021-04-15 22:04:32', '2021-04-15 22:04:32'),
(3, 55, 'BJHH05USG10', 'CMS-600 PLUS + UPS', NULL, 119900000, NULL, NULL, 'pc', NULL, 'ada', '2021-04-15 22:04:32', '2021-04-15 22:04:32'),
(4, 55, 'BJHH05USG02', 'CMS-600 PLUS + PRINTER', NULL, 125950000, NULL, NULL, 'pc', NULL, 'ada', '2021-04-15 22:04:32', '2021-04-15 22:04:32'),
(5, 55, 'BJHH05USG04', 'CMS-600 PLUS + PRINTER + TROLLEY', NULL, 135740000, NULL, NULL, 'pc', NULL, 'ada', '2021-04-15 22:04:32', '2021-04-15 22:04:32'),
(6, 56, 'BJHH05USG01', 'END-1 + ', NULL, 7790000, NULL, 12, 'pc', NULL, 'ada', '2021-04-16 02:00:01', '2021-04-16 02:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `distributors`
--

CREATE TABLE `distributors` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dis_nota` int(11) NOT NULL,
  `dis_uji` int(11) NOT NULL,
  `tempo` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ket` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `distributors`
--

INSERT INTO `distributors` (`id`, `jenis`, `nama`, `telp`, `alamat`, `email`, `dis_nota`, `dis_uji`, `tempo`, `created_at`, `updated_at`, `ket`) VALUES
(2, 'AMI', 'ALKESMART INDONESIA PT', '12', 'dddddfd', 'ALKESMART@gmail.comsx', 0, 0, 30, '0000-00-00 00:00:00', '2021-03-29 20:46:56', 'cdfgdf'),
(3, 'BMI', 'BUMI MENARA INTERNUSA PT', '-', '-', 'YAYAYA@gmail.com', 0, 0, 40, '0000-00-00 00:00:00', '2021-02-22 00:19:05', NULL),
(4, 'BMI-DPT', 'BUMI MENARA INTERNUSA PT (DAMPIT)', '-', '-', 'RERER@gmail.com', 0, 0, 50, '0000-00-00 00:00:00', '2021-02-22 00:20:18', NULL),
(5, 'BMM', 'BINTANG MANDIRI MEDICA PT', '81997821441', 'JL. DIPONEGORO RT.012 KEL. MAJIDI PANCOR KEC. SELONG', 'YAYAYA@gmail.coms', 0, 0, 20, '0000-00-00 00:00:00', '2021-02-22 00:55:05', NULL),
(6, 'BMP', 'BUANA MEDISTRA PHARMA PT', '-', '-', '	pt.buana_med@yahoo.com ', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(10, 'BPPP', 'BEND PEMB PUSKESMAS PUCANGLABAN', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(11, 'CJMA', 'CIPTA JAYA MEDIKA CV', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(12, 'CJMO', 'CIPTAJAYA MEDINDO PT', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(13, 'CMC', 'CAHAYA MURNI CEMERLANG PT', '-', '-', '	cahayamurnicemerlang@gmail.com	cahayamurnipt@gmail.com', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(14, 'CN', 'CAHYO NUGROHO', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(15, 'CRI', 'CIPTAJAYA RETAIL INDONESIA PT', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(16, 'CVAW', 'ADY WATER CV', '022-7238019/022-63724915', 'JL. MADE RAYA NO. 26 RT.001 RW.002', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(17, 'CVHG', 'HAWAII GROUP CV', '', 'JL. DUPAK MUTIARA 63F NO.20 RT.004 RW.005', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(18, 'CVSPM', 'SANI PUTRI MEDIKA', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(19, 'DKK-SUB', 'DINAS KESEHATAN KOTA SURABAYA', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(20, 'DKKT', 'DINAS KESEHATAN KABUPATEN TUBAN', '0356-321479', 'Jalan Brawijaya Nomor 3 Kebonsari Tuban', 'dinkes@tubankab.go.id', 0, 0, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(21, 'DKRS', 'DIASINDO KARYA RISTRADY', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(22, 'DMU', 'DAYA MATAHARI UTAMA', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(23, 'DONGKO', 'BENDAHARA UMUM BLUD PUSKESMAS DONGKO', '', 'JL. RAYA DONGKO PANGGUL RT.069 RW.004 DONGKO', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(24, 'DPKMS', 'DAYA PRIMA KARTIKA MULTI SARANA PT', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(25, 'DPM', 'DAYA PRIMA CV', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(26, 'DPMJ', 'DAYA PRIMA MANDIRI JAYA PT', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(27, 'DR-JPW', 'JOENRY PANGGAWEAN DR', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(28, 'EH', 'EKAWATI HARTONO', '0823-93530838', 'Perum Labuan Indah Blok E-8', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(29, 'EJB', 'EMIINDO JAYA BERSAMA PT', '021-22475355', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(30, 'ERR', 'DSFDFDS', 'dsfdsfsdfdsf', 'sdfsdfsdf', 'sdfsdfsdfd', 12, 15, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(31, 'ESPT', 'ESA SAMPOERNA PT', '', 'ESA SAMPOERNA CENTER LT.5', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(32, 'Etty', 'Dr. Etty Sekardewi', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(33, 'FWH', 'FRESH WATER HILLYUDHA PT', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(34, 'H. ABDUL MUIN', 'H. ABDUL MUIN', '', 'JL. B KATAMSO GG. SALAK NO.251A', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(35, 'HAROLD', 'Harold Immanuel Marcelliano Rumopa', '', 'Perumahan BTN Wale Nusantara Blok B No.51', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(36, 'HENDRO', 'HENDRO', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(37, 'HENDRY', 'CAHYO NUGROHO', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(38, 'HGA', 'HANIFAH GITHA ARIANI', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(39, 'HJ', 'Heroe Joenianto', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(40, 'HS', 'HENDRY SUDIGDO', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(41, 'HXG', 'HEXAGON', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(42, 'IA', 'ILVANA ARDIWIRASTUTI', '', 'JL. JOYOBOYO GG. DAHLIA RT.24 RW.03', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(43, 'IB-SNR', 'SITI NURAINI RINANGSIH IBU', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(44, 'II', 'INDOPASIFIK INDAHTAMA', '', 'JL. JALUR SUTERA BARAT NO.19B', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(45, 'JKUS', 'JETTY KUSUMA', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(46, 'KASUMA', 'KASUMA PT', '85335335446', 'JOJORAN I PERINTIS I/39', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(47, 'KPM', 'KAPUAS PERMATA MEDIFARMA PT', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(48, 'KSS', 'KARSA SEMANGAT SEJAHTERA PT', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(49, 'KTH', 'KENDARI TIRTAKEMAS HUTAMA PT', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(50, 'LJSA', 'LANGGENG JAYA SEMPURNA ABADI PT', '', 'TAMAN PUSPA SARI BLOK E NO.5 RT.32 RW.07', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(51, 'LOTENG', 'BEND. PEMEGANG KAS DINAS KESEHATAN KAB. LOTENG', '', 'JL. SOEKARNO HATTA (KTR DNS KESEHATAN) PRAYA', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(52, 'MAK', 'MAHKOTA ANUGRAH KARYA PT', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(53, 'MARLION', 'MARLION', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(54, 'MAU', 'MITRA ALKESINDO UTAMA PT', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(55, 'MHS', 'MULYO HADI SOESILO', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(56, 'MM', 'MULTI USAHA JAYA CV', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(57, 'MMB', 'MULTIPLUS MEDILAB PT', '061-6640268 / 061-6630090', 'JL. DANAU MARSABUT NO. 4 MEDAN', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(58, 'MMM', 'MULAWARMAN MITRA MEDIKA PT', '0541-4107525 / 0812 54060 2050', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(59, 'MMSB', 'MITRA MEDIKA SEJAHTERA BERSAMA PT', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(60, 'MMSR', 'MURINDO MULTI SARANA PT', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(61, 'MSAS', 'MULTI SARANA ALKESINDO SAMARINDA PT', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(62, 'MSK', 'MARCO SEKAWAN PT', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(63, 'MTI', 'MAKMUR TECHNOLOGY INDONESIA PT', '024-6513192', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(64, 'MTS', 'MITRA TIRTA SUKSES PT', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(65, 'MULIA UTAMA TRASINDO ', 'MULIA UTAMA TRASINDO PT', '021-65850555', 'ANGKASA 1 NO. 5A JAKARTA PUSAT', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(66, 'MULIA UTAMA TRASINDO PT', 'MULIA UTAMA TRASINDO PT', '021-65850555', 'ANGKASA 1 NO 5A JAKARTA PUSAT', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(67, 'NAR', 'NUR ARIF RAHMATULLAH', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(68, 'NIKMAH', 'DR NIKMAH ERNAWATI SpOG', '0811-3330-425', 'DSN BOGO RT.002 RW.008 BULU SEMEN KAB KEDIRI - JAWA TIMUR', '', 0, 0, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(69, 'NON', 'BELUM DIKETAHUI', '', '', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(70, 'NURDIN', 'NURDIN', '', 'JL. KALIANYAR IV NO. 34 RT. 009 RW. 002 JAKARTA BARAT', '', 0, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(71, 'NVP', 'NOVAPHARIN PT', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(72, 'NWU', 'NUGROHO WIDI UTOMO', '85713557014', 'MEDOHO SELECTA NO.17 RT.002 RW.005', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(73, 'PBP', 'PILARINDO BAKTI PERTIWI PT', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(74, 'PEM', 'PRADANA ESTIARA MEDICAL PT', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(75, 'PK', 'PRIYADI KUNCORO', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(76, 'PSA', 'PANASEA PT', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(77, 'PSP', 'PRADANA SIRONA PERSADA PT', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(78, 'PTAHT', 'ABADI HUTAN TROPIS PT', '', 'JL. DHARMAHUSADA UTARA I/50', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(79, 'PTAIGMI', 'ANEKA INDUSTRI GAS MEDIK INDONESIA PT', '', 'KOMPLEK GREEN SEDAYU BIZPARK BLOK GS 5 NO.122', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(80, 'PTAPM', 'ARES PRATAMA MEDIKA', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(81, 'PTBAW', 'BALI AGUNG WATERS PT', '0361-728734', 'JL. BESAKIH NO.4', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(82, 'PTBEM', 'BORNEO ETAM MANDIRI', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(83, 'PTBKE', 'BHINEKA KARYA ELEKTRINDO PT', '024-76438831', 'RE MARTADINATA', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(84, 'PTBMI LAMONGAN', 'BUMI MENARA INTERNUSA PT (LAMONGAN)', '', 'JL. RAYA LAMONGAN GRESIK KM 40', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(85, 'PTBMIDS', 'BUMI MENARA INTERNUSA PT (DELI SERDANG)', '061-42068300', 'JL. PULAU SUMBAWA II NO. 5-A KIM II SAENTIS - DELI SERDANG', '', 0, 0, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(86, 'PTBMILP', 'BUMI MENARA INTERNUSA PT (LAMPUNG)', '', 'IR SUTAMI KM 12', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(87, 'PTBPM', 'BERKAH PRO MEDIKA', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(88, 'PTETI', 'EVERCOSS TECHNOLOGY INDONESIA PT', '0856 4129 2555', 'JL. RE MARTADINATA NO.37', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(89, 'PTGSK', 'GLOBAL SURYA KEMALA PT', '0813-59049074', 'JL. INSPEKSI BRANTAS NO.14 RT.021 RW.007', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(90, 'PTHRC', 'HOTEL RAMAPALACE COTTAGE', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(91, 'PTHRM', 'HARTONO RAYA MOTOR PT', '', 'JL. DEMAK 166-170', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(92, 'PTKI', 'KINGDOM INDAH PT', '', 'Jl. HR. Muhammad 373-383', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(93, 'PTKJM', 'KRISMA JAYA MANDIRI CV', '087-839997078', 'JL. BABARSARI NO.26', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(94, 'PTPHL', 'PERMATA HATI LAMONGAN PT', '', 'RAYA DEANDLES RT. 0 RW. 0', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(95, 'PTSDS', 'SENTRUM DENTAL SENTOSA PT', '031-99244168', 'JL. EMBONG WUNGU NO. 11', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(96, 'PTSJP', 'SAM JAYA PERKASA PT', '022-6123111', 'JL. PAJAJARAN NO.123A', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(97, 'PTSUM', 'SUMBER UTAMA MEDICALINDO PT', '81260068787', 'JL. PROF MH YAMIN SH NO.241', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(98, 'PTTDA', 'TIGA DARMA ABADI PT', '0741-3065106', 'JL. SERSAN MUSLIM RT.07', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(99, 'PTWAM', 'WAHYU ARTA MEDIKA PT', '0361-8491536', 'JL. TUKAD BARITO NO.88', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(100, 'RAHMATULLA', 'RAHMATULLAH Bapak', '', 'SINGOREJO RT.001 RW.004', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(101, 'RAM', 'RIZKI ANUGERAH MULTIKARYA PT', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(102, 'RAU', 'RIDHO AGUNG UTAMA PT', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(103, 'REMSPT', 'RAMA EMERALD MULTI SUKSES PT', '', 'DESA TENARU', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(104, 'ROHAN', 'ROHAN OERSEPUNY', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(105, 'RPK', 'RISKY PUTRA KASIH PT', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(106, 'RSK-BWR', 'RUMAH SAKIT KATOLIK BHAKTI WARA', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(107, 'RSMDGSK', 'RUMAH SAKIT MUHAMMADIYAH GRESIK', '', 'JL. KH KHOLIL NO.88 RT.005 RW.001', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(108, 'Rully', 'Dr. Rully Ferdiansyah', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(109, 'RWB', 'REJEKI WIRA BERSAMA PT', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(110, 'SASC', 'SORINI AGRO ASIA CORPORINDO PT', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(111, 'SB', 'STEVANUS BUDIANTO', '', 'PURI LIDAH KULON INDAH BLOK T2 RT/RW 006/007 KEL.LIDAH KULON KEC.LAKAR SANTRI KOTA SURABAYA', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(112, 'SBM', 'SURYA BALI MAKMUR PT', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(113, 'SBSA', 'SUMBER BAHAGIA SEJAHTERA ABADI PT', '-', '-', '', 20, 0, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(114, 'SDI', 'SANIDATA INDONESIA PT', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(115, 'SEE', 'SHIN E ENGINEERING', '031-70999098', 'Jl. Komp. Juanda Harapan Blok J No. 6', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(116, 'SEI', 'SAM ELEMEN INDONESIA PT', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(117, 'SEPTIAN', 'SEPTIAN AKHMAD SUGIANTO', '', 'DSN KRAJAN TENGAH RT.012 RW.002', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(118, 'SJL', 'SAMUDRA JAYA LISTRIK', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(119, 'SMA VITA', 'SMA VITA', '', 'JL. ARIEF RAHMAN HAKIM 189-191', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(120, 'SMAK', 'SIAGA MEDIKA ABADI KARYA PT', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(121, 'SMM', 'SINARINDO MULTI MEDIKA PT', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(122, 'SMP', 'SINAR MEDIKA PAPUA PT', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(123, 'SPA', 'SINKO PRIMA ALLOY PT', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(124, 'SPB', 'SABURAI PERDANA BAROKAH PT', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(125, 'SPM', 'SANIDATA PUTRI MEDIKA PT', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(126, 'SR', 'SANI RETAILINDO', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(127, 'SRM', 'SUMBER REJEKI MEDIKA JAYA PT', '-', '-', '', 20, 0, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(128, 'SSR', 'SULTRATUNA SAMUDRA PT', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(129, 'STB', 'SENTRASARANA TIRTABENING PT', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(130, 'SURYA DARMA PERKASA', 'SURYA DARMA PERKASA PT', '031-5314417', 'DAAN MOGOT KM 1 NO. 99 KEBON JERUK', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(131, 'TNA', 'TUNAI', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(132, 'TPM', 'TRIAFI PRATAMA MEDIKA PT', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(133, 'TSP', 'TIRTA SUKSES PERKASA PT', '-', '-', '', 0, 20, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(134, 'URSULA', 'J. NUGROHO EKO PUTRANTO/dr. URSULA YUDITH SAWITRI', '', 'JL. PLOSO 9-B/11 RT. 009 RW.005 PLOSO TAMBAKSARI SURABAYA - JAWA TIMUR', '', 0, 0, 30, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(135, 'YAYKM', 'YAY. KARYA MISERICORDIA', '0341-426057 / 081555636881', 'JL. YULIUS USMAN NO.49/ JL. NUSAKAMBANGAN 56 RT.04 RW.04', '', 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(141, 'Pelanggan', 'ddfdf', '42441', 'dfdf', 'fd', 12, 13, 30, '2021-03-18 08:14:16', '2021-03-18 08:14:16', 'dfdf');

-- --------------------------------------------------------

--
-- Table structure for table `divisis`
--

CREATE TABLE `divisis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisis`
--

INSERT INTO `divisis` (`id`, `nama`, `kode`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'sa', NULL, NULL),
(2, 'Direktur Utama', 'dirut', NULL, NULL),
(3, 'Direktur Teknik', 'dirtek', NULL, NULL),
(4, 'Direktur Keuangan', 'dirkeu', NULL, NULL),
(5, 'General Manager', 'gm', NULL, NULL),
(7, 'Administrasi', 'adm', NULL, NULL),
(8, 'After Sales Perbaikan', 'asp', NULL, NULL),
(9, 'Document Control', 'dc', NULL, NULL),
(10, 'Engineering', 'eng', NULL, NULL),
(11, 'Gudang Bahan Material', 'gbmp', NULL, NULL),
(12, 'Gudang Karantina', 'gk', NULL, NULL),
(13, 'Gudang Barang Jadi', 'gbj', NULL, NULL),
(14, 'IT', 'it', NULL, NULL),
(15, 'Logistik', 'log', NULL, NULL),
(16, 'Maintenance', 'mtc', NULL, NULL),
(17, 'Produksi', 'prd', NULL, NULL),
(18, 'Rumah Tangga', 'rt', NULL, NULL),
(19, 'Sarana Lingkungan', 'sarling', NULL, NULL),
(20, 'Sarana Kesehatan', 'sarkes', NULL, NULL),
(21, 'Research Development', 'rnd', NULL, NULL),
(22, 'Laboratorium', 'lab', NULL, NULL),
(23, 'Quality Control', 'qc', NULL, NULL),
(24, 'PPIC', 'ppic', NULL, NULL),
(25, 'K3', 'k3', NULL, NULL),
(26, 'Penjualan', 'jual', NULL, NULL),
(27, 'Pembelian', 'beli', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `divisi_inventories`
--

CREATE TABLE `divisi_inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `divisi_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pic_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisi_inventories`
--

INSERT INTO `divisi_inventories` (`id`, `kode`, `divisi_id`, `pic_id`, `created_at`, `updated_at`) VALUES
(1, '17', 17, 1, NULL, NULL),
(4, '14', 14, 8, '2021-03-22 03:37:39', '2021-03-22 03:37:39');

-- --------------------------------------------------------

--
-- Table structure for table `ecommerces`
--

CREATE TABLE `ecommerces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `market` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bayar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ecommerces`
--

INSERT INTO `ecommerces` (`id`, `order_id`, `market`, `customer_id`, `status`, `bayar`, `created_at`, `updated_at`) VALUES
(30, 'ECOM/BLI/IV/2021/30', 'Bli Bli', 36, 'Lunas', 'Tunai', '2021-04-13 23:09:52', '2021-04-14 01:59:24'),
(31, 'ECOM/TKPD/IV/2021/31', 'Tokopedia', 68, 'Proses', 'Transfer', '2021-04-13 23:10:23', '2021-04-13 23:10:23'),
(32, 'ECOM/INDO/IV/2021/32', 'Bli Bli', 108, 'Proses', 'Transfer', '2021-04-13 23:11:32', '2021-04-13 23:11:45');

-- --------------------------------------------------------

--
-- Table structure for table `ekatjuals`
--

CREATE TABLE `ekatjuals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `distributor_id` int(11) NOT NULL,
  `lkpp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ak1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `despaket` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instansi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuankerja` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tglbuat` date DEFAULT NULL,
  `tgledit` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ekatjuals`
--

INSERT INTO `ekatjuals` (`id`, `distributor_id`, `lkpp`, `ak1`, `despaket`, `instansi`, `satuankerja`, `status`, `tglbuat`, `tgledit`, `created_at`, `updated_at`) VALUES
(2, 38, '1000', 'AK1-111111', 'sdfsdf', 'instansi', 'satuan', 'Batal', '2021-03-31', '2021-04-16', '2021-04-01 01:20:39', '2021-04-13 01:54:26'),
(3, 4, '1001', 'AK1-222222', 'asdas', 'dasd', 'asdasd', 'Masih Negoisasi', '2021-04-15', '2021-04-14', '2021-04-01 01:22:23', '2021-04-01 01:22:23'),
(4, 4, '1002', 'AK1-333333', 'asdasd', 'asdasd', 'asdasd', 'Batal', '2021-04-21', '2021-03-31', '2021-04-01 01:25:42', '2021-04-01 01:25:42'),
(5, 29, '1003', 'AK1-444444', 'Paket Coronas', 'Pemerintah Madiun', 'Dinas kesehatan Madiun', 'Sepakat', '2021-04-08', '2021-05-06', '2021-04-04 18:37:49', '2021-04-12 22:32:19');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_pemeriksaan_rakits`
--

CREATE TABLE `hasil_pemeriksaan_rakits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pemeriksaan_rakit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `hasil_perakitan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `kondisi` enum('ok','nok') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tindak_lanjut` enum('karantina','pengujian') COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hasil_perakitans`
--

CREATE TABLE `hasil_perakitans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `perakitan_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date DEFAULT NULL,
  `no_seri` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kondisi_fisik_bahan_baku` enum('ok','nok') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kondisi_saat_proses_perakitan` enum('ok','nok') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tindak_lanjut_terbuka` enum('operator','perbaikan','karantina','ps') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fungsi` enum('ok','nok') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hasil` enum('ok','nok') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tindak_lanjut_tertutup` enum('operator','perbaikan','karantina','ps') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('dibuat','req_pemeriksaan_terbuka','acc_pemeriksaan_terbuka','rej_pemeriksaan_terbuka','req_pemeriksaan_tertutup','acc_pemeriksaan_tertutup','rej_pemeriksaan_tertutup') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hasil_perakitans`
--

INSERT INTO `hasil_perakitans` (`id`, `perakitan_id`, `tanggal`, `no_seri`, `kondisi_fisik_bahan_baku`, `kondisi_saat_proses_perakitan`, `tindak_lanjut_terbuka`, `fungsi`, `hasil`, `tindak_lanjut_tertutup`, `keterangan`, `status`, `created_at`, `updated_at`) VALUES
(76, 33, '2021-04-19', 'RMIN0001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dibuat', '2021-04-18 18:15:31', '2021-04-18 18:15:31'),
(77, 34, '2021-04-19', 'FRIN00001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'req_pemeriksaan_terbuka', '2021-04-18 19:22:09', '2021-04-22 01:20:46'),
(78, 34, '2021-04-19', 'FRIN00002', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'req_pemeriksaan_terbuka', '2021-04-18 19:22:09', '2021-04-22 01:20:46'),
(80, 35, '2021-04-19', 'FRIN00004', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'req_pemeriksaan_terbuka', '2021-04-18 19:40:33', '2021-04-20 20:51:59'),
(81, 35, '2021-04-19', 'FRIN00005', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'req_pemeriksaan_terbuka', '2021-04-18 19:40:33', '2021-04-20 21:01:41');

-- --------------------------------------------------------

--
-- Table structure for table `histori_hasil_perakitans`
--

CREATE TABLE `histori_hasil_perakitans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hasil_perakitan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `kegiatan` enum('perbaikan_pemeriksaan_terbuka','pemeriksaan_terbuka','perbaikan_pemeriksaan_tertutup','pemeriksaan_tertutup','analisa_pemeriksaan_terbuka_ps','analisa_pemeriksaan_tertutup_ps') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `hasil` enum('ok','nok') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tindak_lanjut` enum('produksi','operator','produksi_perbaikan','produk_spesialis','pengujian') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `histori_hasil_perakitans`
--

INSERT INTO `histori_hasil_perakitans` (`id`, `hasil_perakitan_id`, `kegiatan`, `tanggal`, `hasil`, `keterangan`, `tindak_lanjut`, `created_at`, `updated_at`) VALUES
(4, 80, 'pemeriksaan_terbuka', '2021-04-21', 'ok', NULL, 'produksi', '2021-04-20 21:01:41', '2021-04-20 21:01:41'),
(5, 81, 'pemeriksaan_terbuka', '2021-04-21', 'nok', 'Kabel Rusak', 'produk_spesialis', '2021-04-20 21:01:41', '2021-04-20 21:01:41');

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `divisi_inventory_id` bigint(20) UNSIGNED DEFAULT NULL,
  `kode_barang` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `merk` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lokasi` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `jumlah_tersedia` int(11) DEFAULT NULL,
  `tanggal_perolehan` date DEFAULT NULL,
  `masa_manfaat` int(11) DEFAULT NULL,
  `kondisi` double DEFAULT NULL,
  `harga_perolehan` double(20,2) DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('tersedia','tidak tersedia') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `divisi_inventory_id`, `kode_barang`, `nama_barang`, `merk`, `lokasi`, `jumlah`, `jumlah_tersedia`, `tanggal_perolehan`, `masa_manfaat`, `kondisi`, `harga_perolehan`, `keterangan`, `status`, `created_at`, `updated_at`) VALUES
(3, 4, 'INV14030002', 'Kursi Bulat', '-', 'Ruang IT', 3, 2, '2021-01-01', 4, 90, 150000.00, 'Kursi warna Biru, kaki putih', 'tersedia', '2021-03-22 03:37:39', '2021-04-06 06:57:40'),
(4, 4, 'INV14030003', 'Kursi Biru', 'Informa', 'Ruang IT', 1, 0, '2021-01-01', 4, 90, 1000000.00, NULL, 'tersedia', '2021-03-22 03:37:39', '2021-04-06 09:57:56');

-- --------------------------------------------------------

--
-- Table structure for table `jasa_ekss`
--

CREATE TABLE `jasa_ekss` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `via` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jasa_ekss`
--

INSERT INTO `jasa_ekss` (`id`, `nama`, `telp`, `alamat`, `via`, `jur`, `ket`, `created_at`, `updated_at`) VALUES
(1, 'AFRO TRANS MARITIM', '085102156508, (031)-3539600, 3528364', 'Jl. Jagaraga No. 37h', 'Via Laut', 'Makassar', 'PT. Multiplus, Ridho Agung mgggs', '0000-00-00 00:00:00', '2021-03-29 20:41:20'),
(2, 'AFRO ANGKASA UDARA', '-', 'Jl. Jagalan 115', 'Via Udara', 'RE', '-', '0000-00-00 00:00:00', '2021-03-29 20:41:13'),
(3, 'ALAM JAYA', '(031)-3524553', 'Jl. Sulung No. 89 Ruko Sulung Mas Blok A-15, Surabaya', 'Lain Lain', 'Flores', 'PT. MAHKOTA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'BANDUNG EXPRESS', '(031)-5451211', 'Jl. Arjuno No. 35, Kec. Sawahan Surabaya', 'Lain Lain', '-', '-', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'BANYUWANGI CEPAT', '(031)-3533026, 081336324650 - Pak Afuk', 'Jl. Semut Kali No.22, Bongkaran, Pabean Cantian, Kota Sby, Jawa Timur 60161', 'Lain Lain', 'Banyuwangi', '-', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'WE, TRANSPORT ', '0821-3148-0034', 'Jl. Bhakti Husada III No.15, Mojo, Kec. Gubeng, Kota SBY', 'Lain Lain', '-', '-', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'BIMA PUTRA', '(031)-5320264, 5471706', 'Jl. Demak No. 67', 'Lain Lain', 'Jawa Tengah, Jakarta', 'Per Kg Rp 2.000\nMinimal 0-30 kg  Rp 60.000\nBiaya Penerus 65.000', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'BUNAKEN LESTARI', '(031)-3292049', 'Jl. Hang Tuah No. 6', 'Lain Lain', 'Manado', '-', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'HIMEJI EXPRESS', '0811-3515-153', 'Jl. Karah Agung No.43F, Karah, Kec. Jambangan, Kota SBY', 'Lain Lain', '-', '-', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'DMK', '(031)-5322899', 'Jl. Achmad Jais No.52A, Peneleh, Genteng, Kota Sby, Jawa Timur 60274', 'Lain Lain', 'Makasar', 'Depot Airqu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'DUTA CARGO TRANS', '3529347, 3522873', 'Jl. Krembangan Besar No. 18', 'Lain Lain', 'Banjarmasin', 'PT. Panasea', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'HERONA EXPRESS', '(031)-5472808', 'Jl. Pasar Turi (Stasiun K.A ) ', 'Lain Lain', '-', '-', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'HEXA EXPRESINDO', '(031)-3281563', 'Jl. Kalimas Baru 1 No.3A', 'Lain Lain', '-', '-', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'INDAH CARGO ', '(031)-3550785', 'Jl. Demak 351', 'Lain Lain', '-', '-', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'JATIM PERDANA EXSPRESS', '(031)-3571032, 3533934, 3533932', 'Jl. Pasar Besar Wetan 32/III', 'Via Udara', 'Manado, AMBON', 'Mitra Medika Sejahtera Bersama', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'KARYATI', '(031)-3529662, 3574770', 'Jl. Stasiun Kota, Semut Megah Blok B-3, 5-6', 'Lain Lain', 'Seruyan', '-', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'KI 8 (CV. KARYA INDAH DELAPAN EXPRESS)', '(031)-5324504, 081252665627, (WA)-08883214017', 'Pergudangan Kereta Api Logistic, Jl. Cepu, Gundih, Bubutan, Kota Sby, Jawa Timur 60172', 'Lain Lain', 'Jakarta,Semarang, Yogyakarta, Bandung', '-', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'MEGA BAYA JAYA', '(031)-3550837, 081331206900', 'Jl. Demak No. 250', 'Lain Lain', 'Papua ', 'PT. Sinar Medika Papua', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'MEGA CARGO', '0817304776 - Bp. Sumanto', 'Bandara Udara Surabaya', 'Lain Lain', 'Flores Timur', '-', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'MEX BERLIAN', '-', 'Jl. Sulung Mas Blok A2 Krembangan Selatan', 'Via Udara', '-', '-', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'NIAGA', '85732420224', 'Depo Spil : Jl. Latsda M. Nazir 17', 'Lain Lain', 'Papua, Jayapura', 'PT. Sinar Medika Papua', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'PILARINDO', '(031)-5057778, (031)-99533278', 'Jl. Gubeng Kertajaya 9C No.42A || Jl. Villa Bukit Mas Blok RN. 03', 'Lain Lain', '-', '-', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'PIONER', '08525588297 (Ibu Ina), (031)-352383 (Ibu Donny)', 'Jl. Gatotan No. 38', 'Lain Lain', 'Flores-NTT', 'PT. Mahkota (Pengiriman Lama)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'PLATINUM LOGISTIK', '(031)-99681020, 99681586', 'Jl. Abdul Rachman No. 55A, Alas Tipis ,Pabean ,Sedati Sidoarjo', 'Lain Lain', 'Jember', '-', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'PURNAMA BALI', '(031)-3545486, 081216316771, 081330636255', 'Komp. Semut Indah Jl. Semut Kali Blok C No. 1A Surabaya', 'Lain Lain', 'Denpasar', 'Sumber terang', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'PUTRA KALTIM', '(031)-3537977, (031)-72775254 (Awi)', 'Jl. Sikatan No. 41 || Jl. Tanjung Batu No.9 (Spill)', 'Lain Lain', 'Samarinda', 'PT. Mitra Alkesindo Utama', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'SETYA PERMAI', '081333716363 - Pak Yatno', 'Pelabuhan Kalimas Baru Pos 3 Kiri Gudang No. 152', 'Lain Lain', 'Malinau-Kalimantan Utara', '-', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'SUKMA', '(031)-3559306 (Pontianak) Ibu Nia', '-', 'Lain Lain', 'Pontianak', '-', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'SUMBER TIMUR', '(031)-3286425', 'Jl. Kalimas Baru No.101, Perak Utara', 'Lain Lain', '-', '-', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'TARAKAN EXSPRESS', '(031)-3556929, 3556991', 'Jl. Parang Barong 19A', 'Lain Lain', 'Samarinda', 'PT. Mitra Alkesindo Utama', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'TIRTA JAYA', '(031)-5493888', 'Jl. Embong Gayam 2A', 'Lain Lain', 'Malang', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'TUNGGAL JAYA ', '(031)-3712480', 'Jl. Gembong  No. 40 ', 'Lain Lain', 'Jakarta', 'PT.Marco sekawan', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'WBU', '(031)-3577282, 085102353990', 'Jl. Sulung (Komp. Ruko Sulung Mas B-12)', 'Lain Lain', 'Denpasar', 'Sanidata', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'WIRA AGUNG', '-', 'Jl. Ruko Taman Duta Mas || Jl. Tubagus Angke D1/9 Jakarta Barat', 'Lain Lain', '-', '-', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'WIRA AGUNG (MERATUS)', '08101379903 (Herman)', '1. Depo Meratus', 'Lain Lain', '-', '-', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'WIRA AGUNG (MERATUS PK)', '085100382739 (Aris) || Tj. Sorong : Bapak Arifin (085100824811) / Bp. Ulum (085749271111) || Tj. Jayapura : Bapak Saiful (085103035721, 082257051173)', '2. Depo Meratus Pk, Jl.  Prapat Kurung Selatan 21, Ktr : Jl.  Kalianak No. 51', 'Lain Lain', '-', '-', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 'BIS TIARA MAS', '-', '-', 'Lain Lain', '-', '-', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 'DHARMA SENTOSA', '-', '-', 'Lain Lain', '-', '-', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 'DIAMBIL SENDIRI', '-', '-', 'Lain Lain', '-', '-', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 'DIBAWA BPK ADITYA', '-', '-', 'Lain Lain', '-', '-', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'EKSPEDISI (LAIN LAIN)', '-', '-', 'Lain Lain', '-', '-', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'PT SINKO PRIMA ALLOY', '-', '-', 'Lain Lain', '-', '-', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 'JNE SURABAYA', '-', '-', 'Lain Lain', '-', '-', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'TIKI', '031-3556107', 'Branjangan 18A Surabaya (AGEN 29)', 'Via Udara', 'SELURUH INDONESIA', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'DIBAWA KARYAWAN SINKO', '-', '-', 'Lain Lain', '-', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'PT. SURYAGITA NUSARAYA', '(031) 5451968', 'Jl. Dupak No.21, Gundih, Kec. Bubutan, Kota SBY', 'Lain Lain', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 'POS INDONESIA', '-', 'Jl. Kupang Jaya No.10, Sukomanunggal, Kec. Sukomanunggal, Kota SBY, Jawa Timur 60225', 'Lain Lain', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'LION PARCEL', '', '', 'Via Laut', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 'CITO XPRESS', '031-8495200', 'JL. RAYA PANJANG JIWO PERMAI NO. 16 SURABAYA', 'Via Laut', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 'DOMINAN JAYA (BT)', '031-3523355', 'JL. SEMUT BARU\nRUKO PENGAMPON SQUARE BLOK D NO. 70, SURABAYA', 'Via Darat', 'JAWA DAN BALI', 'TIDAK MENERIMA KIRIMAN SURAT DAN KARTU POS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 'WIDAS (BAYAR TUJUAN)', '087851487418, 082131480034', 'JL. BHAKTI HUSADA III / 15 SURABAYA', 'Via Udara', 'MALANG', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 'MULIA BAKTI EXPRESS (BAYAR TUJUAN)', '031 3538889, 3530260', 'JL. SEMUT KALI KOMPLEK SEMUT INDAH BLOK C 16-17', 'Via Darat', 'BANJARMASIN', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 'BALI PRIMA TRAVEL', '031 5035777, 5027999, 5026999', 'JL. KARANG MENJANGAN 92', 'Via Udara', 'JAWA TIMUR - BALI', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 'MANDIRI AGUNG TRANSPORT', '087852458855, 081385883509', 'JL. CEPU NO. 1 PINTU J', 'Via Udara', 'JAKARTA, CIREBON, SEMARANG', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 'DUTA TRANS JAYA', '031-3551000', 'JL. KREMBANGAN BARU NO. 2', 'Via Laut', 'SAMARINDA', 'MITRA ALKESINDO UTAMA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 'SAKURA EXPRESS', '(031) 3573375', 'Ruko Vira 51, Jl. Raya Penjeran No. 475, Bongkaran, Kec. Pabean Cantian, Kota SBY, Jawa Timur 60161', 'Via Udara', 'BALI', 'PT. SANIDATA INDONESIA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 'ORINDO', '', '', 'Via Udara', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 'BUANA NUSANTARA EKSPRES (BNE)', '0812 1020 2955', 'SAN ANTONIO N4 - 42 PAKUWON CITY, KENJERAN', 'Via Laut', 'SUMATERA, JAWA, KALIMANTAN', 'PT. MULTIPLUS MEDILAB\nminimal 100kg', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 'PRATIWI', '0822 4543 1812 - BAPAK KUSWAN', 'PRATIWI DEPO SARI AMPENAN \nJL. TANJUNG BATU NO. 1', 'Via Darat', 'TARAKAN', 'MITRA ALKESINDO UTAMA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 'BUMI RAYA', '', 'JL. KENJERAN 475, RUKO FIRA 51 BLOK 25', 'Via Darat', 'NTT', 'MAHKOTA ANUGRAH KARYA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 'BUANA LANGGENG JAYA', '031-5353745 ', 'JL. PASAR KEMBANG NO. 4\nRUKO GRAND FLOWER BLOK C-10', 'Via Udara', '', 'AMDK SONGO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 'PT. MPS', '0812 3002 3434', 'JL. TANJUNG BATU 21 P NO. 17', 'Via Darat', 'BALIKPAPAN', 'PT. MITRA ALKESINDO MEDIKA JAYA BALIKPAPAN', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 'MULTI PRIMA SARANA', '081 230 023 434', 'JL. TANJUNG BATU 21 P NO. 17 SURABAYA', 'Via Darat', 'MITRA ALKESINDO UTAMA', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 'DAKOTA CARGO', '031 3552392 / 031-3552393 UP. FAIZAL', 'JL. DEMAK 265 SURABAYA', 'Via Udara', 'JEMBER, JAWA', 'CV. LISA JAYA MANDIRI\nBERAT VOLUME 39 KG = 64.000', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 'BINTANG JASA SAMODRA (BJS)', '85100495704', 'JL. PEGIRIAN NO. 148 B, SIMOLAWANG, SIMOKERTO, ABY', 'Via Darat', 'SUMBA TIMUR', 'PT. MAHKOTA ANUGRAH', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 'ANUGRAH SUNGAI', '85346600208', 'JL. KALIANGET 72', 'Via Darat', 'PAPUA', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 'OLYMPIC ABADI', '3525662 - 3557665', 'BUBUTAN NO. 149 SURABAYA', 'Via Laut', 'SAMARINDA, KALIMANTAN TIMUR', 'CV HIDUP BAHAGIA, PRADANA ESTIARA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 'ANGKASA DIRGA MANDIRI', '031-3525662 / 3557665', 'JL. BUBUTAN 149 SURABAYA', 'Via Udara', 'SAMARINDA', 'CV. HIDUP BAHAGIA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 'MENTARI TRANSPORTATION', '031 - 529165', 'JL. NGAGEL MADYA 60', 'Via Udara', 'BALI', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 'ROSALIA EXPRESS', '0815-6789-8520', 'JL. ARJUNO NO. 11', 'Via Udara', 'BANYUMAS', 'PT. ARES PRATAMA MEDIKA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 'KONSINYASI', '', '', 'Lain Lain', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, 'GUNAWAN SEMBADA (PENGANGKUTAN BARANG SURABAYA MADURA PP)', '0853-3084-8497', 'Jl. Pegirian No.78B, Simolawang, Kec. Simokerto, Kota SBY, Jawa Timur 60144', 'Via Udara', 'MADURA', 'AMDK LABINI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, 'GO-SEND', '', '', 'Via Udara', 'SURABAYA DST', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 'MAKHARYA CARGO', '', '', 'Via Udara', 'BALI', 'PT. SEAFOOD INSPECTION LABORATORY\nPEMESAN PT. GLORIA MEDICA / DAYA PRIMA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, 'DEPO RAHAYU', '81283862674', 'JL. KALIANAK 116 SURABAYA', 'Via Darat', '', 'UP. MAS AJI', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 'J', '', '', 'Via Laut', 'seluruh indonesia', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 'DEPO TEMAS', '85707102551', 'JL. KALIANAK 55 LORONG 7B', 'Via Darat', 'KENDARI', 'UP. BPK BAGUS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 'JNT', '', 'SURABAYA', 'Lain Lain', 'ALL INDONESIA', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 'PANCA KOBRA SAKTI', '', 'JL. KEDUNG COWEK NO. 194A, BULAK, SURABAYA', 'Via Udara', 'JAWA', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(80, 'DIAMBIL EKSPEDISI DARI DISTRIBUTOR', '', '', 'Via Udara', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, 'ABAL ABAL', '', '', 'Lain Lain', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, 'SADANA', '', 'JL. SAMUDRA NO. 43 ', 'Via Udara', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(83, 'LOGAM JAYA BERSAUDARA', '', 'JL. KEBON ROJO NO. 2 SURABAYA', 'Via Darat', 'BALI', 'REQUEST DARI PT CIPTA JAYA DIKIRIM KE SANIDATA BALI', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `karyawans`
--

CREATE TABLE `karyawans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `divisi_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` enum('direktur','manager','asisten manager','supervisor','staff','operator','harian') COLLATE utf8mb4_unicode_ci NOT NULL,
  `ktp` int(11) DEFAULT NULL,
  `bpjs` int(11) DEFAULT NULL,
  `tgl_kerja` date DEFAULT NULL,
  `vaksin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgllahir` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `karyawans`
--

INSERT INTO `karyawans` (`id`, `divisi_id`, `nama`, `foto`, `jabatan`, `ktp`, `bpjs`, `tgl_kerja`, `vaksin`, `tgllahir`, `created_at`, `updated_at`) VALUES
(1, 17, 'Sri Wahyuni', NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 17, 'Mutmainah', NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 17, 'Siti Romlah', NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 17, 'Siti Salimah', NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 17, 'Frida Chrisdianti', NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 14, 'Christio Kharisma Sungkono', NULL, 'manager', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 14, 'Angelicha Aminah Zairuni Ussu', NULL, 'manager', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 14, 'Bartolomeus Wisnu Setyo Wibowo Sunadi', NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 14, 'Adilah Adzhani', NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 2, 'Agus Siek', NULL, 'direktur', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 20, 'Aditya Thamrin', NULL, 'direktur', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_produks`
--

CREATE TABLE `kategori_produks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kelompok_produk_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_produks`
--

INSERT INTO `kategori_produks` (`id`, `kelompok_produk_id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 1, 'Anesthesia', NULL, NULL),
(2, 1, 'Cardiology', NULL, NULL),
(3, 1, 'Central Monitor', NULL, NULL),
(4, 1, 'Dental', NULL, NULL),
(5, 1, 'Destroyer', NULL, NULL),
(6, 1, 'Infant', NULL, NULL),
(7, 1, 'Lamp', NULL, NULL),
(8, 1, 'Measuring, Testing & Calibration', NULL, NULL),
(9, 1, 'Obstetrics & Gynecology', NULL, NULL),
(10, 1, 'Radiology', NULL, NULL),
(11, 1, 'Scale', NULL, NULL),
(12, 1, 'Simulator', NULL, NULL),
(13, 1, 'Sterilizer & Purifier', NULL, NULL),
(14, 1, 'Accessories', NULL, NULL),
(15, 1, 'Others', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kelompok_produks`
--

CREATE TABLE `kelompok_produks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelompok_produks`
--

INSERT INTO `kelompok_produks` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Alat Kesehatan', NULL, NULL),
(2, 'Sarana Kesehatan', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_02_10_021647_create_divisis_table', 1),
(2, '2021_02_10_021837_create_kategori_produks_table', 1),
(3, '2021_02_10_021840_create_sub_kategoris_table', 1),
(8, '2021_02_16_030808_create_distributors', 2),
(9, '2021_02_10_022210_create_produks_table', 3),
(10, '2021_02_10_022223_create_users_table', 3),
(11, '2021_02_10_025756_create_parts_table', 3),
(12, '2021_02_10_025818_create_bill_of_materials_table', 3),
(13, '2021_02_15_061240_create_bppbs_table', 3),
(14, '2021_02_16_040646_create_notifications_table', 4),
(15, '2021_02_16_074450_create_bppbs_table', 5),
(16, '2021_02_17_012125_add_tipe_to_produks_table', 6),
(17, '2021_02_17_013341_update_sub_kategori_id_in_produks_table', 7),
(18, '2021_02_17_015253_update_sub_kategori_id_2_in_produks_table', 8),
(19, '2021_02_17_015402_add_kategori_id_to_produks_table', 9),
(20, '2021_02_17_023257_create_perakitans_table', 10),
(21, '2021_02_17_023418_create_hasil_perakitans_table', 10),
(22, '2021_02_17_024124_add_foto_to_users_table', 10),
(23, '2021_02_17_024604_add_column_to_perakitans_table', 11),
(24, '2021_02_17_025700_add_column_to_hasil_perakitans_table', 12),
(25, '2021_02_17_073242_update_rename_kategori_produks_table', 13),
(26, '2021_02_17_073600_update_rename_sub_kategoris_table', 14),
(27, '2021_02_17_074833_add_column_to_produks_table', 15),
(28, '2021_02_17_082055_update_rename_column_in_produks_table', 16),
(29, '2021_02_17_084903_update_rename_column_in_kategori_produks_table', 17),
(30, '2021_02_18_024421_update_column_to_parts_table', 18),
(31, '2021_02_18_024824_update_column_to_bill_of_materials_table', 19),
(32, '2021_02_18_075050_create_jasa_ekss', 20),
(33, '2021_02_19_062003_update_for_rename_kelompok_barangs_table', 21),
(34, '2021_02_19_062317_update_rename_column_kategori_produks_table', 22),
(35, '2021_02_19_062336_update_rename_column_produks_table', 22),
(36, '2021_02_20_164114_create_notifikasis_table', 23),
(37, '2021_02_21_054103_add_column_to_perakitans_2_table', 24),
(39, '2021_02_21_085916_update_column_to_hasil_perakitans_table', 25),
(40, '2021_02_23_013233_create_user_logs_table', 26),
(41, '2021_02_23_014243_update_user_logs_table', 27),
(42, '2021_02_23_014941_create_karyawans_table', 28),
(43, '2021_02_23_015048_create_hasil_perakitan_karyawans_table', 28),
(44, '2021_02_23_065320_update_column_for_hasil_perakitan_table', 29),
(45, '2021_02_25_081547_add_column_for_produks_table', 30),
(46, '2021_02_25_092040_create_paket_produks_table', 31),
(47, '2021_02_25_092117_create_detail_paket_produks_table', 31),
(48, '2021_02_25_115141_update_column_for_parts_table', 32),
(50, '2021_02_25_125802_update_column_2_for_parts_table', 33),
(51, '2021_02_25_132305_update_column_for_bill_of_materials_table', 34),
(52, '2021_02_25_135413_add_column_paket_produk_id_for_detail_paket_produks_table', 35),
(53, '2021_02_25_135825_drop_column_jumlah_for_detail_paket_produks_table', 36),
(54, '2021_02_25_140115_add_column_jumlah_for_detail_paket_produks_table', 37),
(55, '2014_10_12_100000_create_password_resets_table', 38),
(56, '2021_02_26_034338_create_spaons', 39),
(57, '2021_02_26_040010_create_suppliers_table', 40),
(58, '2021_03_01_095129_update_produks_table', 41),
(59, '2021_03_01_095337_update_detail_paket_produks_table', 42),
(60, '2021_03_03_111721_create_pemeriksaan_rakits_table', 43),
(61, '2021_03_03_111746_create_hasil_pemeriksaan_rakits_table', 43),
(62, '2021_03_05_164420_update_column_for_pemeriksaan_rakits_table', 44),
(63, '2021_03_05_165125_update_2_column_for_pemeriksaan_rakits_table', 45),
(64, '2021_03_08_081019_create_stok_produks_table', 46),
(65, '2021_03_08_081027_create_data_stok_produks_table', 46),
(66, '2021_03_05_013058_insert_column_spaons', 47),
(67, '2021_03_16_082125_create_inventories_table', 47),
(68, '2021_03_16_082159_create_detail_inventories_table', 47),
(69, '2021_03_17_145745_update_distributor_columns_jenis_and_update_null_value', 48),
(70, '2021_03_18_134719_update_distributors_insert_ket', 49),
(71, '2021_03_03_134105_update_distributors', 50),
(72, '2021_03_18_094053_create_divisi_inventories_table', 51),
(73, '2021_03_19_082801_update_column_in_inventories_table', 52),
(74, '2021_03_19_084529_update_column_in_detail_inventories_table', 53),
(76, '2021_03_19_105428_update_column_in_divisi_inventories_table', 54),
(77, '2021_03_24_082910_create_peminjamans_table', 55),
(78, '2021_03_24_082920_create_detail_peminjamans_table', 56),
(79, '2021_03_26_012201_add_column_jumlah_tersedia_on_peminjamans_table', 57),
(80, '2021_03_26_014119_delete_column_jumlah_tersedia_on_peminjamans_table', 58),
(81, '2021_03_26_015738_add_column_jumlah_tersedia_on_inventories_table', 59),
(82, '2021_03_25_075607_update_jasa_eks_ubah_nama_kolom_dan_set_null', 60),
(83, '2021_03_29_023001_remove_column_status_on_peminjamans_table', 61),
(84, '2021_03_29_030147_add_column_tanggal_on_detail_peminjamans_table', 62),
(86, '2021_03_29_032742_add_column_status_on_detail_peminjamans_table', 63),
(87, '2021_03_29_033640_add_column_status_on_peminjamans_table', 64),
(88, '2021_04_01_011451_create_detail_spaons', 65),
(90, '2021_04_01_073347_create_ekatjual', 66),
(91, '2021_04_01_083240_create_detail_ekatjuals', 67),
(92, '2021_04_01_093953_drop_spaons', 68),
(93, '2021_04_02_164313_update_column_detail_ekatalog', 69),
(94, '2021_04_03_080951_update_ekatalogs_tgledit', 69),
(97, '2021_04_05_012242_remove_detail_peminjamans_table', 70),
(99, '2021_04_05_012303_remove_column_in_peminjamans_table', 71),
(100, '2021_04_05_012314_add_column_in_peminjamans_table', 72),
(101, '2021_04_05_064907_update_produk_harga', 73),
(102, '2021_04_05_061323_update_column_date_in_peminjamans', 74),
(103, '2021_04_06_082026_create_peminjaman_karyawans_table', 75),
(104, '2021_04_06_082033_create_detail_peminjaman_karyawans_table', 76),
(105, '2021_04_07_043449_update_rename_peminjamans_table', 77),
(106, '2021_04_07_062541_add_column_user_id_to_peminjaman_karyawans_table', 78),
(107, '2021_04_08_014306_add_column_1_in_peminjaman_karyawans_table', 79),
(108, '2021_04_08_064356_create_ecommerces', 80),
(110, '2021_04_08_075839_create_detail_ecommerces', 81),
(111, '2021_04_09_064109_create_offlines', 82),
(112, '2021_04_09_064644_create_detail_offlines', 83),
(113, '2021_04_13_014403_add_column_in_hasil_perakitans_table', 84),
(114, '2021_04_15_015258_add_column_in_status_hasil_perakitans_table', 85),
(116, '2021_04_15_045735_create_histori_hasil_perakitans_table', 86),
(118, '2021_04_15_062809_remove_column_in_produks_table', 87),
(119, '2021_04_15_064437_create_detail_produks_table', 88),
(120, '2021_04_15_070545_remove_column_in_parts_table', 89),
(121, '2021_04_15_070754_add_column_in_parts_table', 90),
(122, '2021_04_15_071316_drop_foreign_in_parts_table', 91),
(123, '2021_04_15_072708_create_part_engs_table', 92),
(124, '2021_04_15_073945_remove_column_2_in_bill_of_materials_table', 93),
(125, '2021_04_15_074154_add_column_in_bill_of_materials_table', 94),
(126, '2021_04_15_074958_remove_column_3_in_bill_of_materials_table', 95),
(127, '2021_04_16_004458_rename_column_nama_detail_in_detail_produks_table', 96),
(128, '2021_04_16_005233_add_and_remove_column_in_bppbs_table', 97),
(131, '2021_04_16_010923_create_penawaran_offline', 98),
(132, '2021_04_16_044134_add_column_kode_in_detail_produks_table', 99),
(133, '2021_04_19_094640_create_penawaran_ecoms', 100),
(135, '2021_04_19_035019_remove_column_warna_in_hasil_perakitans_table', 101),
(137, '2021_04_19_150444_create_podo_online', 102),
(138, '2021_04_20_033943_update_kondisi_terbuka_column_hasil_perakitans_table', 103),
(139, '2021_04_20_035258_update_tl_terbuka_column_hasil_perakitans_table', 104),
(141, '2021_04_21_123733_create_podo_offlines', 105),
(142, '2021_04_20_040756_update_tl_tertutup_column_hasil_perakitans_table', 106),
(143, '2021_04_21_044920_create_pengemasans_table', 107),
(144, '2021_04_22_023753_remove_column_in_hasil_perakitans_table', 108),
(145, '2021_04_22_021944_update_column_in_hasil_perakitans_table', 109),
(146, '2021_04_22_033016_update_column_hasil_perakitan_karyawans_table', 110),
(147, '2021_04_22_033311_rename_and_update_column_hasil_perakitan_karyawans_table', 111),
(150, '2021_04_22_144659_update_karyawans_column', 112);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifikasis`
--

CREATE TABLE `notifikasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pesan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pengirim_id` bigint(20) UNSIGNED NOT NULL,
  `penerima_id` bigint(20) UNSIGNED NOT NULL,
  `halaman_url` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifikasis`
--

INSERT INTO `notifikasis` (`id`, `judul`, `pesan`, `pengirim_id`, `penerima_id`, `halaman_url`, `read_at`, `created_at`, `updated_at`) VALUES
(1, 'Penambahan BPPB', 'telah menambahkan BPPB', 3, 2, '/bppb', '2021-02-26 07:48:56', '2021-02-20 11:50:08', '2021-02-26 07:48:56'),
(2, 'Penambahan BPPB', 'telah menambahkan BPPB', 3, 2, '/bppb', NULL, '2021-02-23 01:45:09', '2021-02-23 01:45:09'),
(3, 'Penambahan BPPB', 'telah menambahkan BPPB', 3, 2, '/bppb', NULL, '2021-02-23 01:48:48', '2021-02-23 01:48:48'),
(4, 'Perakitan', 'telah menambahkan Laporan Perakitan', 2, 1, '/perakitan', NULL, '2021-02-25 04:44:57', '2021-02-25 04:44:57'),
(5, 'Perakitan', 'telah menambahkan Laporan Perakitan', 2, 1, '/perakitan', NULL, '2021-02-25 04:49:08', '2021-02-25 04:49:08'),
(6, 'Perakitan', 'telah menambahkan Laporan Perakitan', 2, 1, '/perakitan', NULL, '2021-02-25 06:50:58', '2021-02-25 06:50:58'),
(7, 'Perakitan', 'telah menghapus Perakitan 0001/CN01/02/21', 2, 1, '/perakitan', NULL, '2021-02-25 09:54:49', '2021-02-25 09:54:49'),
(8, 'Perakitan', 'telah menghapus Perakitan 0001/CN01/02/21', 2, 1, '/perakitan', NULL, '2021-02-25 09:55:40', '2021-02-25 09:55:40'),
(9, 'Perakitan', 'telah menghapus Perakitan 0006/CN01/02/21', 2, 1, '/perakitan', NULL, '2021-02-26 01:23:12', '2021-02-26 01:23:12'),
(10, 'Penambahan BPPB', 'telah menambahkan BPPB', 3, 2, '/bppb', NULL, '2021-02-26 07:48:04', '2021-02-26 07:48:04'),
(11, 'Perakitan', 'telah menambahkan Laporan Perakitan', 2, 1, '/perakitan', NULL, '2021-02-26 07:54:53', '2021-02-26 07:54:53'),
(12, 'Perakitan', 'telah menghapus Perakitan 0004/CN01/02/21', 2, 1, '/perakitan', NULL, '2021-03-03 01:50:01', '2021-03-03 01:50:01'),
(13, 'Perakitan', 'telah menghapus Perakitan 0004/CN01/02/21', 2, 1, '/perakitan', NULL, '2021-03-03 01:50:10', '2021-03-03 01:50:10'),
(14, 'Perakitan', 'telah menghapus Perakitan 0004/CN01/02/21', 2, 1, '/perakitan', NULL, '2021-03-03 01:50:17', '2021-03-03 01:50:17'),
(15, 'Perakitan', 'telah menghapus Perakitan 0004/CN01/02/21', 2, 1, '/perakitan', NULL, '2021-03-03 01:50:23', '2021-03-03 01:50:23'),
(16, 'Perakitan', 'telah menghapus Perakitan 0004/CN01/02/21', 2, 1, '/perakitan', NULL, '2021-03-03 01:50:36', '2021-03-03 01:50:36'),
(17, 'Penambahan BPPB', 'telah menambahkan BPPB', 3, 2, '/bppb', NULL, '2021-03-09 04:38:56', '2021-03-09 04:38:56'),
(18, 'Penambahan BPPB', 'telah menambahkan BPPB', 3, 2, '/bppb', NULL, '2021-03-09 04:42:47', '2021-03-09 04:42:47'),
(19, 'Perakitan', 'telah menambahkan Laporan Perakitan', 2, 1, '/perakitan', NULL, '2021-03-12 04:19:32', '2021-03-12 04:19:32'),
(20, 'Perakitan', 'telah menambahkan Laporan Perakitan', 2, 1, '/perakitan', NULL, '2021-03-12 04:26:26', '2021-03-12 04:26:26'),
(21, 'Perakitan', 'telah menambahkan Laporan Perakitan', 2, 1, '/perakitan', NULL, '2021-03-12 06:02:51', '2021-03-12 06:02:51'),
(22, 'Perakitan', 'telah menambahkan Laporan Perakitan', 2, 1, '/perakitan', NULL, '2021-03-12 06:15:21', '2021-03-12 06:15:21'),
(23, 'Perakitan', 'telah menambahkan Laporan Perakitan', 2, 1, '/perakitan', NULL, '2021-03-12 06:29:02', '2021-03-12 06:29:02'),
(24, 'Perakitan', 'telah menambahkan Laporan Perakitan', 2, 1, '/perakitan', NULL, '2021-03-12 07:37:04', '2021-03-12 07:37:04'),
(25, 'Perakitan', 'telah menghapus Perakitan ', 2, 1, '/perakitan', NULL, '2021-03-12 07:38:47', '2021-03-12 07:38:47'),
(26, 'Perakitan', 'telah menghapus Perakitan ', 2, 1, '/perakitan', NULL, '2021-03-12 07:40:48', '2021-03-12 07:40:48'),
(27, 'Perakitan', 'telah menghapus Perakitan ', 2, 1, '/perakitan', NULL, '2021-03-12 08:15:08', '2021-03-12 08:15:08'),
(28, 'Perakitan', 'telah menghapus Perakitan ', 2, 1, '/perakitan', NULL, '2021-03-12 08:15:28', '2021-03-12 08:15:28'),
(29, 'Perakitan', 'telah menambahkan Laporan Perakitan', 2, 1, '/perakitan', NULL, '2021-03-15 01:46:24', '2021-03-15 01:46:24'),
(30, 'Perakitan', 'telah menghapus Perakitan ', 2, 1, '/perakitan', NULL, '2021-04-14 00:58:08', '2021-04-14 00:58:08'),
(31, 'Perakitan', 'telah menghapus Perakitan ', 2, 9, '/perakitan', NULL, '2021-04-14 00:58:08', '2021-04-14 00:58:08'),
(32, 'Perakitan', 'telah menghapus Perakitan ', 2, 1, '/perakitan', NULL, '2021-04-14 01:49:52', '2021-04-14 01:49:52'),
(33, 'Perakitan', 'telah menghapus Perakitan ', 2, 9, '/perakitan', NULL, '2021-04-14 01:49:52', '2021-04-14 01:49:52'),
(34, 'Perakitan', 'telah menambahkan Laporan Perakitan', 2, 1, '/perakitan', NULL, '2021-04-18 18:15:31', '2021-04-18 18:15:31'),
(35, 'Perakitan', 'telah menambahkan Laporan Perakitan', 2, 9, '/perakitan', NULL, '2021-04-18 18:15:31', '2021-04-18 18:15:31'),
(36, 'Perakitan', 'telah menambahkan Laporan Perakitan', 2, 1, '/perakitan', NULL, '2021-04-18 19:22:09', '2021-04-18 19:22:09'),
(37, 'Perakitan', 'telah menambahkan Laporan Perakitan', 2, 9, '/perakitan', NULL, '2021-04-18 19:22:09', '2021-04-18 19:22:09'),
(38, 'Perakitan', 'telah menambahkan Laporan Perakitan', 2, 1, '/perakitan', NULL, '2021-04-18 19:40:33', '2021-04-18 19:40:33'),
(39, 'Perakitan', 'telah menambahkan Laporan Perakitan', 2, 9, '/perakitan', NULL, '2021-04-18 19:40:33', '2021-04-18 19:40:33');

-- --------------------------------------------------------

--
-- Table structure for table `offlines`
--

CREATE TABLE `offlines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bayar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offlines`
--

INSERT INTO `offlines` (`id`, `order_id`, `customer_id`, `status`, `bayar`, `created_at`, `updated_at`) VALUES
(1, 'OFF/IV/2021/1', 5, 'Proses', 'Transfer', '2021-04-09 01:31:32', '2021-04-13 19:38:18'),
(2, 'OFF/IV/2021/2', 21, 'Proses', 'Tunai', '2021-04-09 02:11:19', '2021-04-09 02:11:19'),
(3, 'OFF/IV/2021/3', 29, 'Lunas', 'Tunai', '2021-04-09 03:10:25', '2021-04-13 19:38:33');

-- --------------------------------------------------------

--
-- Table structure for table `paket_produks`
--

CREATE TABLE `paket_produks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tipe` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga` double(20,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paket_produks`
--

INSERT INTO `paket_produks` (`id`, `tipe`, `harga`, `created_at`, `updated_at`) VALUES
(1, 'DSPRO 100 + SP10', 500000.00, '2021-02-25 03:31:02', '2021-02-16 03:31:02'),
(2, 'PROMIST 3 + ULTRAMIST', 4600000.00, '2021-02-17 03:31:43', '2021-02-24 03:31:43'),
(3, 'MAP 308 + Ups', 45000.00, '2021-03-02 00:09:07', '2021-03-02 00:09:07');

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

CREATE TABLE `parts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` enum('pcs','set','unit','dus','roll','meter','pack') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `layout` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('ada','tidak_ada') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parts`
--

INSERT INTO `parts` (`id`, `kode`, `nama`, `jumlah`, `satuan`, `layout`, `status`, `created_at`, `updated_at`) VALUES
(1, 'A123', 'Baut', 13, 'pcs', 'L12', 'ada', '2021-02-25 23:52:12', '2021-02-25 23:52:12'),
(2, 'SPBP00A0001', 'APPRON PUTIH SUSU', 1260, '', '', 'ada', NULL, NULL),
(3, 'SPBP00A0002', 'APPRON TRANSPARAN/BENING', 2025, '', '', 'ada', NULL, NULL),
(4, 'SPBP00A0003', 'APPRON DRESS (APPRON-01)', 0, '', '', 'ada', NULL, NULL),
(5, 'SPBP00A0004', 'APPRON CREAM ', 4, '', '', 'ada', NULL, NULL),
(6, 'SPBP00A0005', 'APPRON BIRU', 1, '', '', 'ada', NULL, NULL),
(7, 'SPBP00A0006', 'APPRON MERAH', 418, '', '', 'ada', NULL, NULL),
(8, 'SPBP00B0001', 'BANNER ECG', 0, '', '', 'ada', NULL, NULL),
(9, 'SPBP00B0002', 'BANNER ZTP-80-A', 0, '', '', 'ada', NULL, NULL),
(10, 'SPBP00B0003', 'BROSUR TIMBANGAN  DIGIT PRO', 47, '', 'L23;R1', 'ada', NULL, NULL),
(11, 'SPBP00B0004', 'BROSUR ECG 100 G', 103, '', 'L23;R2', 'ada', NULL, NULL),
(12, 'SPBP00B0005', 'BROSUR FETAL DOPLER SON- A/ B', 557, '', 'L23;R1', 'ada', NULL, NULL),
(13, 'SPBP00B0006', 'BROSUR FETAL DOPLER SON- A', 0, '', '', 'ada', NULL, NULL),
(14, 'SPBP00B0007', 'BROSUR ECG 1200 G', 43, '', 'L23;R2', 'ada', NULL, NULL),
(15, 'SPBP00B0008', 'BROSUR ECG 300 G', 1553, '', 'L23;R1', 'ada', NULL, NULL),
(16, 'SPBP00B0009', 'BROSUR FOX', 1035, '', 'L23;R1', 'ada', NULL, NULL),
(17, 'SPBP00B0010', 'BROSUR NEBULIZER', 3802, '', 'L23;R4', 'ada', NULL, NULL),
(18, 'SPBP00B0011', 'BROSUR PM 9000+', 300, '', 'L23;R1', 'ada', NULL, NULL),
(19, 'SPBP00B0012', 'BROSUR PM 6500', 4, '', 'L23;R4', 'ada', NULL, NULL),
(20, 'SPBP00B0013', 'BROSUR PM VS 5000', 3, '', 'L23;R4', 'ada', NULL, NULL),
(21, 'SPBP00B0014', 'BROSUR  FETAL DOPLER  SON- PRO', 60, '', 'L23;R2', 'ada', NULL, NULL),
(22, 'SPBP00B0015', 'BROSUR ZTP 80 ECO', 77, '', 'L23;R2', 'ada', NULL, NULL),
(23, 'SPBP00B0016', 'BROSUR ZTP 80 UPGRADE', 0, '', '', 'ada', NULL, NULL),
(24, 'SPBP00B0017', 'BROSUR GET 338 UO', 0, '', '', 'ada', NULL, NULL),
(25, 'SPBP00B0018', 'BROSUR LKPP PT. SINKO PRIMA ALLOY VERSI 1', 938, '', 'L23;R2,3', 'ada', NULL, NULL),
(26, 'SPBP00B0019', 'BROSUR EMII LKPP', 188, '', 'L23;R2', 'ada', NULL, NULL),
(27, 'SPBP00B0020', 'BROSUR WT,OZ,OW,& LS', 427, '', '', 'ada', NULL, NULL),
(28, 'SPBP00B0021', 'BROSUR LKPP PT. SINKO PRIMA ALLOY VERSI 2 (2018)', 2857, '', '', 'ada', NULL, NULL),
(29, 'SPBP00B0022', 'BROSUR TIMBANGAN BABY ONE', 3, '', 'L23;R.4', 'ada', NULL, NULL),
(30, 'SPBP00B0023', 'BROSUR PERALATAN ANESTESI', 59, '', 'L23;R2', 'ada', NULL, NULL),
(31, 'SPBP00B0024', 'BROSUR PERALATAN KARDIOLOGI', 54, '', 'L23;R2', 'ada', NULL, NULL),
(32, 'SPBP00B0025', 'BROSUR PERALATAN GIGI', 82, '', 'L23;R2', 'ada', NULL, NULL),
(33, 'SPBP00B0026', 'BROSUR PERALATAN OBSTETRIK,GENEKOLOGI', 80, '', 'L23;R2', 'ada', NULL, NULL),
(34, 'SPBP00B0027', 'BROSUR PERALATAN RSU DAN PERORANGAN', 55, '', 'L23;R4', 'ada', NULL, NULL),
(35, 'SPBP00B0028', 'BROSUR PRODUK LIST CONTECT', 35, '', 'L22;R1', 'ada', NULL, NULL),
(36, 'SPBP00B0029', 'BUKU PHMS CONTEC', 9, '', 'L22;R1', 'ada', NULL, NULL),
(37, 'SPBP00B0031', 'BATERAI VRLA', 0, '', '', 'ada', NULL, NULL),
(38, 'SPBP00B0032', 'BATERAI KOTAK 9V', 48, '', '', 'ada', NULL, NULL),
(39, 'SPBP00K0001', 'KARTU GARANSI ELITECH VANWARD', 5200, '', 'L22;R2', 'ada', NULL, NULL),
(40, 'SPBP00K0002', 'KARTU GARANSI PRODUK ELITECH', 7064, '', '', 'ada', NULL, NULL),
(41, 'SPBP00K0003', 'KABEL POWER SNI 3X1 SQmmX2m', 488, '', '', 'ada', NULL, NULL),
(42, 'SPBP00K0004', 'KABEL POWER SNI 3X0,75 SQmmX2m', 107, '', '', 'ada', NULL, NULL),
(43, 'SPBP00L0001', 'LAKBAN ELITECH', 1146, '', '', 'ada', NULL, NULL),
(44, 'SPBP00O0001', 'OUTER APRON (355X245X75)', 1080, '', '', 'ada', NULL, NULL),
(45, 'SPBP00P0001', 'PLASTIK 16 X 25 (FOX,FD,TO,TM,TD,LS-UO,UP)', 2208, '', '', 'ada', NULL, NULL),
(46, 'SPBP00P0002', 'PLASTIK 11 X 17 (KARTU GARANSI ALL PRODUK)', 4974, '', '', 'ada', NULL, NULL),
(47, 'SPBP00P0003', 'PLASTIK 9 X 14', 0, '', '', 'ada', NULL, NULL),
(48, 'SPBP00P0004', 'PLASTIK 20 X 25 / 30', 4100, '', '', 'ada', NULL, NULL),
(49, 'SPBP00P0005', 'PLASTIK 13 X 20', 4400, '', '', 'ada', NULL, NULL),
(50, 'SPBP00P0006', 'PLASTIK 25 X 35', 3200, '', '', 'ada', NULL, NULL),
(51, 'SPBP00P0007', 'PLASTIK 45 X 75', 90, '', '', 'ada', NULL, NULL),
(52, 'SPBP00P0008', 'PETUNJUK PENGGUNAAN APPRON', 0, '', '', 'ada', NULL, NULL),
(53, 'SPBP00P0009', 'PLASTIK 38,5 X 25', 990, '', '', 'ada', NULL, NULL),
(54, 'SPBP00P0010', 'POWER BANK 8000 mAh (SILVER)', 86, '', '', 'ada', NULL, NULL),
(55, 'SPBP00P0011', 'POWER BANK 12000 mAh (SILVER)', 20, '', '', 'ada', NULL, NULL),
(56, 'SPBP00P0012', 'POWER BANK 12000 mAh (GOLD)', 22, '', '', 'ada', NULL, NULL),
(57, 'SPBP00P0013', 'POWER BANK 12000 mAh (HITAM)', 15, '', '', 'ada', NULL, NULL),
(58, 'SPBP00P0014', 'POWER BANK 12000 mAh (PINK)', 32, '', '', 'ada', NULL, NULL),
(59, 'SPBP00S0001', 'STICKER SEGEL GARANSI ELITECH', 19465, '', '', 'ada', NULL, NULL),
(60, 'SPBP00S0002', 'STICKER SEGEL PRODUKSI', 51951, '', '', 'ada', NULL, NULL),
(61, 'SPCN00C0001', 'CABLE FIXER', 280, '', 'L15; R1B', 'ada', NULL, NULL),
(62, 'SPCN00F0002', 'FILTER COTTON', 7663, '', '', 'ada', NULL, NULL),
(63, 'SPCN00K0001', 'KABEL TIES', 2600, '', 'L15; R1H', 'ada', NULL, NULL),
(64, 'SPCN00R0001', 'ROUND CUSHION', 390, '', 'L15; R1A', 'ada', NULL, NULL),
(65, 'SPCN00S0001', 'SCREW ST 3,5 X 12 ', 1877, '', 'L15; R1H', 'ada', NULL, NULL),
(66, 'SPCN00S0002', 'SCREW ST 2,5 X 7,5 ', 760, '', 'L15; R15H', 'ada', NULL, NULL),
(67, 'SPCN00S0003', 'SQUARE CUSHION', 795, '', 'L15; R1C,D,F', 'ada', NULL, NULL),
(68, 'SPCN00T0001', 'TAS NEBULIZER NEW ( UNTUK PROMIST 1,2,3 )', 556, '', '', 'ada', NULL, NULL),
(69, 'SPCN01A0001', 'ADULT MASK', 100, '', '', 'ada', NULL, NULL),
(70, 'SPCN01A0002', 'ADULT MASK (BIRU HALUS)', 279, '', '', 'ada', NULL, NULL),
(71, 'SPCN01A0003', 'ADULT MASK (BIRU GERIGI)', 328, '', '', 'ada', NULL, NULL),
(72, 'SPCN01B0001', 'BAUT  M3X10', 1848, '', 'L15;R2G', 'ada', NULL, NULL),
(73, 'SPCN01B0002', 'BUKU MANUAL PROMIST 1', 301, '', 'L15;R2G', 'ada', NULL, NULL),
(74, 'SPCN01B0003', 'BUKU MANUAL PROMIST INDONESIA', 100, '', '', 'ada', NULL, NULL),
(75, 'SPCN01C0001', 'CASSING ATAS', 44, '', '', 'ada', NULL, NULL),
(76, 'SPCN01C0002', 'CASSING BAWAH', 60, '', 'L15;R2C', 'ada', NULL, NULL),
(77, 'SPCN01C0002a', 'COMPRESSOR PROMIST 1', 140, '', '', 'ada', NULL, NULL),
(78, 'SPCN01C0003', 'CUP TEMPAT OBAT BARU BESAR', 7, '', 'L15;R2A', 'ada', NULL, NULL),
(79, 'SPCN01C0004', 'CUP LAMA', 1304, '', '', 'ada', NULL, NULL),
(80, 'SPCN01C0005', 'CUP ASESORIES LAMA', 141, '', '', 'ada', NULL, NULL),
(81, 'SPCN01C0007', 'CUP TEMPAT OBAT  ORANGE NEBULIZER (NEW)', 184, '', '', 'ada', NULL, NULL),
(82, 'SPCN01C0008', 'CUP ASESORIES (DARI BIO MEDICAL )', 0, '', 'QC', 'ada', NULL, NULL),
(83, 'SPCN01C0009', 'CHILDREN MASK', 100, '', '', 'ada', NULL, NULL),
(84, 'SPCN01C0010', 'CHILDREN MASK (BIRU)', 509, '', '', 'ada', NULL, NULL),
(85, 'SPCN01F0001', 'FUSE 2A', 3769, '', 'L15; R2A', 'ada', NULL, NULL),
(86, 'SPCN01G0001', 'GABUS PUTIH', 756, '', 'L15; R2E', 'ada', NULL, NULL),
(87, 'SPCN01I0001', 'INER NEBULIZER ', 11, '', 'E-10', 'ada', NULL, NULL),
(88, 'SPCN01I0002', 'ISOLASI BAKAR', 178, '', 'L15;R2D', 'ada', NULL, NULL),
(89, 'SPCN01K0001', 'KABEL FUSE + SOCKET', 0, '', '', 'ada', NULL, NULL),
(90, 'SPCN01K0002', 'KABEL HITAM+ SOCKET', 0, '', '', 'ada', NULL, NULL),
(91, 'SPCN01K0003', 'KABEL MERAH + FUSE HOLDER', 10, '', 'L15;R2D', 'ada', NULL, NULL),
(92, 'SPCN01K0004', 'KABEL POWER HITAM', 0, '', '', 'ada', NULL, NULL),
(93, 'SPCN01K0005', 'KABEL POWER PUTIH', 2, '', 'L15;R2E', 'ada', NULL, NULL),
(94, 'SPCN01K0006', 'KABEL POWER (SUCOFINDO)', 3, '', 'L15;R2B', 'ada', NULL, NULL),
(95, 'SPCN01K0007', 'KAKI BULAT BESAR', 8, '', 'L15;R2B', 'ada', NULL, NULL),
(96, 'SPCN01K0008', 'KARET BULAT KECIL', 71, '', 'L15;R2B', 'ada', NULL, NULL),
(97, 'SPCN01K0009', 'KARET KOTAK BESAR ', 200, '', 'L15;R2B', 'ada', NULL, NULL),
(98, 'SPCN01K0010', 'KABEL POWER PUTIH + KABEL MERAH + FUSE HOLDER', 150, '', '', 'ada', NULL, NULL),
(99, 'SPCN01M0001', 'MIKA PEMBUNGKUS KANAN', 88, '', 'L15;R2D', 'ada', NULL, NULL),
(100, 'SPCN01M0002', 'MIKA PEMBUNGKUS KIRI', 43, '', 'L15;R2E', 'ada', NULL, NULL),
(101, 'SPCN01M0003', 'MOTOR POMPA/ MESIN', 0, '', '', 'ada', NULL, NULL),
(102, 'SPCN01O0001', 'OUTER NEBULIZER NEW (COKLAT)', 457, '', 'E-10', 'ada', NULL, NULL),
(103, 'SPCN01P0001', 'PLASTIK PEMBUNGKUS', 1, '', 'L15;R2B', 'ada', NULL, NULL),
(104, 'SPCN01P0002', 'PACKING FOAM ATAS', 40, '', '', 'ada', NULL, NULL),
(105, 'SPCN01P0003', 'PACKING FOAM BAWAH', 60, '', '', 'ada', NULL, NULL),
(106, 'SPCN01S0001', 'SELANG PUTIH PENDEK', 470, '', 'L15;R2F', 'ada', NULL, NULL),
(107, 'SPCN01S0002', 'SOCKET AC INPUT', 18, '', 'L15;R2B', 'ada', NULL, NULL),
(108, 'SPCN01S0003', 'SPRING PANJANG', 100, '', '', 'ada', NULL, NULL),
(109, 'SPCN01S0004', 'SPRING PENDEK', 650, '', 'L15;R2B', 'ada', NULL, NULL),
(110, 'SPCN01S0005', 'STICKER BACK KOMPRESOR', 1059, '', 'L15;R2B', 'ada', NULL, NULL),
(111, 'SPCN01S0006', 'STICKER ELITECH OVAL', 1004, '', 'L15;R2B', 'ada', NULL, NULL),
(112, 'SPCN01S0007', 'SWITCH ON/ OFF (HIJAU)', 100, '', 'L15;R2D', 'ada', NULL, NULL),
(113, 'SPCN01S0008', 'SELANG PUTIH PANJANG', 0, '', '', 'ada', NULL, NULL),
(114, 'SPCN01S0009', 'SERIAL NUMBER', 100, '', '', 'ada', NULL, NULL),
(115, 'SPCN01T0001', 'TAS PROMIST 1', 11, '', '', 'ada', NULL, NULL),
(116, 'SPCN01T0002', 'TUTUP FILTER', 88, '', 'L15;R2B', 'ada', NULL, NULL),
(117, 'SPCN01T0003', 'TUTUP CUFF', 13, '', 'L15;R2B', 'ada', NULL, NULL),
(118, 'SPCN02A0001', 'ADULT MASK BIRU VERSI 1', 198, '', '', 'ada', NULL, NULL),
(119, 'SPCN02A0002', 'AIR INLET', 300, '', 'L15; R1C', 'ada', NULL, NULL),
(120, 'SPCN02A0003', 'AIR OUTLET', 299, '', 'L15; R1B', 'ada', NULL, NULL),
(121, 'SPCN02A0004', 'AIR OUTLET FIXER', 316, '', 'L15; R1B', 'ada', NULL, NULL),
(122, 'SPCN02A0005', 'ADULT MASK  ORANGE VERSI 2', 151, '', '', 'ada', NULL, NULL),
(123, 'SPCN02C0002', 'CABLE PROTECTIVE COVER', 196, '', 'L15; R1B', 'ada', NULL, NULL),
(124, 'SPCN02C0003', 'CHILDREN MASK ORANGE VERSI 1', 198, '', '', 'ada', NULL, NULL),
(125, 'SPCN02C0004', 'COMPRESSOR', 196, '', '', 'ada', NULL, NULL),
(126, 'SPCN02C0005', 'CHILDREN MASK ORANGE VERSI 2', 152, '', '', 'ada', NULL, NULL),
(127, 'SPCN02F0002', 'FOAM', 298, '', '', 'ada', NULL, NULL),
(128, 'SPCN02F0003', 'FUSE', 598, '', 'L15; R1B', 'ada', NULL, NULL),
(129, 'SPCN02L0001', 'LASDOP', 185, '', 'L15; R1B', 'ada', NULL, NULL),
(130, 'SPCN02L0002', 'LOWER CHASING', 299, '', '', 'ada', NULL, NULL),
(131, 'SPCN02P0001', 'POWER CABLE', 199, '', '', 'ada', NULL, NULL),
(132, 'SPCN02P0002', 'POWER SWITCH', 300, '', 'L15; R1A', 'ada', NULL, NULL),
(133, 'SPCN02S0001', 'SAFETY BAS + FUSE', 198, '', '', 'ada', NULL, NULL),
(134, 'SPCN02S0002', 'SERIAL NUMBER', 298, '', 'L15; R1B', 'ada', NULL, NULL),
(135, 'SPCN02U0001', 'UPPER CHASING', 299, '', '', 'ada', NULL, NULL),
(136, 'SPCN02U0002', 'UPPER COVER', 297, '', '', 'ada', NULL, NULL),
(137, 'SPCN02U0003', 'USER MANUAL', 300, '', 'L15; R1G', 'ada', NULL, NULL),
(138, 'SPCN02W0001', 'WIRE TENSION CAP', 0, '', '', 'ada', NULL, NULL),
(139, 'SPCN03A0001', 'AIR PUMP', 516, '', '', 'ada', NULL, NULL),
(140, 'SPCN03B0001', 'BOTTOM CASE/ LOWER CHASING.', 516, '', '', 'ada', NULL, NULL),
(141, 'SPCN03B0002', 'BOX HANDLE', 996, '', '', 'ada', NULL, NULL),
(142, 'SPCN03B0003', 'BUKU PETUNJUK PENGGUNAAN PROMIST 3', 100, '', '', 'ada', NULL, NULL),
(143, 'SPCN03C0001', 'CABLE TIES', 310, '', 'L15;R4B', 'ada', NULL, NULL),
(144, 'SPCN03C0002', 'CLAMP', 1145, '', 'L15;R4C', 'ada', NULL, NULL),
(145, 'SPCN03C0003', 'CONNECTING LINE 1', 521, '', 'L15;R3G', 'ada', NULL, NULL),
(146, 'SPCN03C0004', 'CONNECTING LINE 2', 529, '', 'L15;R3H', 'ada', NULL, NULL),
(147, 'SPCN03C0005', 'CONNECTING LINE 7', 505, '', 'L15;R3G', 'ada', NULL, NULL),
(148, 'SPCN03F0001', 'FILTER COTTON', 2470, '', '', 'ada', NULL, NULL),
(149, 'SPCN03F0002', 'FILTER COVER', 538, '', '', 'ada', NULL, NULL),
(150, 'SPCN03F0003', 'FUSE  3A', 1558, '', 'L15;R3A', 'ada', NULL, NULL),
(151, 'SPCN03F0004', 'FUSE HOLDER', 518, '', 'L15;R3B', 'ada', NULL, NULL),
(152, 'SPCN03H0001', 'HANDLE BUCKLE', 1000, '', '', 'ada', NULL, NULL),
(153, 'SPCN03I0001', 'IN SPRING', 536, '', 'L15;R3F', 'ada', NULL, NULL),
(154, 'SPCN03M0001', 'MUR M10', 522, '', 'L15;R3A', 'ada', NULL, NULL),
(155, 'SPCN03N0001', 'NEBULIZER KITS', 509, '', '', 'ada', NULL, NULL),
(156, 'SPCN03N0002', 'NASAL SPRAY KITS', 2, '', '', 'ada', NULL, NULL),
(157, 'SPCN03O0001', 'OUT SPRING', 532, '', 'L15;R3F', 'ada', NULL, NULL),
(158, 'SPCN03O0002', 'OUTER NEBULIZER PROMIST 3 (300X260X236)', 526, '', 'E-10', 'ada', NULL, NULL),
(159, 'SPCN03P0001', 'PACKING COTTON', 1042, '', '', 'ada', NULL, NULL),
(160, 'SPCN03P0002', 'PE BAGS FOR FILTER COTTON', 500, '', '', 'ada', NULL, NULL),
(161, 'SPCN03P0003', 'PE BAGS FOR FUSE', 500, '', '', 'ada', NULL, NULL),
(162, 'SPCN03P0004', 'PE BAGS FOR INSTRUCTION', 500, '', '', 'ada', NULL, NULL),
(163, 'SPCN03P0005', 'PE BAGS FOR POWER LINE', 500, '', '', 'ada', NULL, NULL),
(164, 'SPCN03P0006', 'PE FLAT BAGS', 500, '', '', 'ada', NULL, NULL),
(165, 'SPCN03P0007', 'PLASTIC PLATE', 505, '', '', 'ada', NULL, NULL),
(166, 'SPCN03P0008', 'POWER CORD', 525, '', '', 'ada', NULL, NULL),
(167, 'SPCN03P0009', 'PUMP GASKET TC01', 1102, '', 'L15;R4A, B', 'ada', NULL, NULL),
(168, 'SPCN03P0010', 'PUMP GASKET TC02', 1127, '', 'L15;R4A', 'ada', NULL, NULL),
(169, 'SPCN03P0011', 'PUMP GASKET TC03', 1110, '', 'L15;R4C', 'ada', NULL, NULL),
(170, 'SPCN03P0012', 'PUMP SUPPORT', 518, '', '', 'ada', NULL, NULL),
(171, 'SPCN03R0001', 'RING PLASTIK', 522, '', 'L15;R3A', 'ada', NULL, NULL),
(172, 'SPCN03R0002', 'RUBBER GASKET', 2258, '', 'L15;R4D, E, F', 'ada', NULL, NULL),
(173, 'SPCN03S0001', 'SILICONE TUBE PANJANG', 518, '', 'L15;R4G', 'ada', NULL, NULL),
(174, 'SPCN03S0002', 'SILICONE TUBE PENDEK', 535, '', '', 'ada', NULL, NULL),
(175, 'SPCN03S0003', 'SOCKET', 548, '', 'L15;R4G', 'ada', NULL, NULL),
(176, 'SPCN03S0004', 'SWITCH', 516, '', 'L15;R3C,D,E,F', 'ada', NULL, NULL),
(177, 'SPCN03SC001', 'SCREW M3 X10', 2999, '', 'L15;R4F', 'ada', NULL, NULL),
(178, 'SPCN03SC002', 'SCREW M3X8', 1127, '', 'L15;R4F', 'ada', NULL, NULL),
(179, 'SPCN03SC003', 'SCREW M4 X 12', 4107, '', 'L15;R4H', 'ada', NULL, NULL),
(180, 'SPCN03SC004', 'SCREW M4 X 20', 3511, '', 'L15;R4H', 'ada', NULL, NULL),
(181, 'SPCN03SC005', 'SCREW M4 X 18', 4576, '', 'L15;R4H', 'ada', NULL, NULL),
(182, 'SPCN03T0001', 'TUTUP FUSE', 519, '', 'L15;R3B', 'ada', NULL, NULL),
(183, 'SPCN03U0001', 'UPPER CASE', 518, '', '', 'ada', NULL, NULL),
(184, 'SPCN03U0003', 'UPPER HANDLE (COMPRESSOR HANDLE)', 500, '', '', 'ada', NULL, NULL),
(185, 'SPTD00B0001', 'BAUT PCB / M 1,3 X 5', 34064, '', 'L19;R1A', 'ada', NULL, NULL),
(186, 'SPTD00B0002', 'BUKU MANUAL DIGIT-ONE/ DIGIT PRO(INGGRIS)', 6838, '', 'L20;R1', 'ada', NULL, NULL),
(187, 'SPTD00J0001', 'JIG (Alat bantu untuk produksi)', 0, '', '', 'ada', NULL, NULL),
(188, 'SPTD00K0001', 'KOIN SENSOR', 17473, '', 'L19;R1E', 'ada', NULL, NULL),
(189, 'SPTD00O0001', 'OUTER ANTROPOMETRI KIT SET ', 350, '', '', 'ada', NULL, NULL),
(190, 'SPTD00O0002', 'OUTER TIMBANGAN (DIGIT PRO, IDA, BMI, BODY FAT)', 2054, '', '', 'ada', NULL, NULL),
(191, 'SPTD00P0001', 'PLASTIK TIMBANGAN', 8860, '', 'D1;P3', 'ada', NULL, NULL),
(192, 'SPTD00S0001', 'SENSOR TIMBANGAN', 8860, '', 'E9P-', 'ada', NULL, NULL),
(193, 'SPTD00S0002', 'SEGEL GARANSI ELITECH', 226, '', 'L19;R1F', 'ada', NULL, NULL),
(194, 'SPTD00S0003', 'SPON / KARET HITAM/RUBBER PAD', 10758, '', 'D1;P3', 'ada', NULL, NULL),
(195, 'SPTD00S0004', 'SPRING (-)', 9474, '', 'L19;R1H', 'ada', NULL, NULL),
(196, 'SPTD00S0005', 'SPRING (+)', 9186, '', 'L19;R1G', 'ada', NULL, NULL),
(197, 'SPTD00S0006', 'SPRING (+/-)', 9108, '', 'L19;R1G,R2A', 'ada', NULL, NULL),
(198, 'SPTD00S0007', 'STICKER ROLL 3M- LEBAR 0.6mm', 227, '', 'L20;R2', 'ada', NULL, NULL),
(199, 'SPTD00T0001', 'TAS ANTROPROMETRI KIT', 39, '', 'konsinyasi', 'ada', NULL, NULL),
(200, 'SPTD01B0001', 'BACKLIGHT DIGIT ONE', 763, '', 'L19;R1B', 'ada', NULL, NULL),
(201, 'SPTD01CA001', 'CASING ATAS KANAN ABU-ABU ', 0, '', 'D1;P5', 'ada', NULL, NULL),
(202, 'SPTD01CA002', 'CASING ATAS KANAN HIJAU', 0, '', 'D1;P5', 'ada', NULL, NULL),
(203, 'SPTD01CA003', 'CASING ATAS KANAN HITAM', 167, '', 'D1;P5,8', 'ada', NULL, NULL),
(204, 'SPTD01CA004', 'CASING ATAS KANAN KUNING', 0, '', 'D1;P5', 'ada', NULL, NULL),
(205, 'SPTD01CA005', 'CASING ATAS KANAN PINK', 0, '', 'D1;P5', 'ada', NULL, NULL),
(206, 'SPTD01CA006', 'CASING ATAS KANAN PUTIH', 0, '', 'D1;P5', 'ada', NULL, NULL),
(207, 'SPTD01CA007', 'CASING ATAS KIRI ABU-ABU', 438, '', 'D1;P4,8', 'ada', NULL, NULL),
(208, 'SPTD01CA008', 'CASING ATAS KIRI ABU-ABU SABLON NICKEY', 0, '', 'D1;P8', 'ada', NULL, NULL),
(209, 'SPTD01CA009', 'CASING ATAS KIRI ABU-ABU SABLON ELITECH', 0, '', '', 'ada', NULL, NULL),
(210, 'SPTD01CA010', 'CASING ATAS KIRI HIJAU', 44, '', 'D1;P8', 'ada', NULL, NULL),
(211, 'SPTD01CA011', 'CASING ATAS KIRI HIJAU SABLON ELITECH', 81, '', 'D1;P8', 'ada', NULL, NULL),
(212, 'SPTD01CA012', 'CASING ATAS KIRI HIJAU SABLON NICKEY', 104, '', 'D1;P8', 'ada', NULL, NULL),
(213, 'SPTD01CA013', 'CASING ATAS KIRI HITAM', 230, '', 'D1;P4,7,8', 'ada', NULL, NULL),
(214, 'SPTD01CA014', 'CASING ATAS KIRI HITAM SABLON ELITECH', 100, '', 'D1;P8', 'ada', NULL, NULL),
(215, 'SPTD01CA015', 'CASING ATAS KIRI KUNING', 0, '', 'D1;P8', 'ada', NULL, NULL),
(216, 'SPTD01CA016', 'CASING ATAS KIRI KUNING NICKEY', 0, '', 'D1;P8', 'ada', NULL, NULL),
(217, 'SPTD01CA017', 'CASING ATAS KIRI KUNING SABLON ELITECH', 105, '', 'D1;P8', 'ada', NULL, NULL),
(218, 'SPTD01CA018', 'CASING ATAS KIRI PINK', 192, '', 'D1;P4,8', 'ada', NULL, NULL),
(219, 'SPTD01CA019', 'CASING ATAS KIRI PINK SABLON ELITECH', 69, '', '', 'ada', NULL, NULL),
(220, 'SPTD01CA020', 'CASING ATAS KIRI PINK SABLON NICKEY', 0, '', 'D1;P8', 'ada', NULL, NULL),
(221, 'SPTD01CA021', 'CASING ATAS KIRI PUTIH', 119, '', 'D1;P8', 'ada', NULL, NULL),
(222, 'SPTD01CA022', 'CASING ATAS KIRI PUTIH SABLON ELITECH', 202, '', 'D1;P8', 'ada', NULL, NULL),
(223, 'SPTD01CB001', 'CASING BAWAH KANAN ABU-ABU', 0, '', 'D1;P7', 'ada', NULL, NULL),
(224, 'SPTD01CB002', 'CASING BAWAH KANAN HITAM', 220, '', 'D1;P7', 'ada', NULL, NULL),
(225, 'SPTD01CB003', 'CASING BAWAH KANAN KUNING', 163, '', 'D1;P7', 'ada', NULL, NULL),
(226, 'SPTD01CB004', 'CASING BAWAH KANAN PUTIH', 182, '', 'D1;P7', 'ada', NULL, NULL),
(227, 'SPTD01CB005', 'CASING BAWAH KANAN HIJAU', 114, '', 'D1;P7', 'ada', NULL, NULL),
(228, 'SPTD01CB006', 'CASING BAWAH KANAN PINK', 124, '', 'D1;P7', 'ada', NULL, NULL),
(229, 'SPTD01CB007', 'CASING BAWAH KIRI ABU-ABU', 529, '', 'D1;P6', 'ada', NULL, NULL),
(230, 'SPTD01CB008', 'CASING BAWAH KIRI HIJAU', 115, '', 'D1;P6,8', 'ada', NULL, NULL),
(231, 'SPTD01CB009', 'CASING BAWAH KIRI HITAM', 230, '', 'D1;P6', 'ada', NULL, NULL),
(232, 'SPTD01CB010', 'CASING BAWAH KIRI KUNING', 0, '', 'D1;P6', 'ada', NULL, NULL),
(233, 'SPTD01CB011', 'CASING BAWAH KIRI PINK', 0, '', 'D1;P6', 'ada', NULL, NULL),
(234, 'SPTD01CB012', 'CASING BAWAH KIRI PUTIH', 181, '', 'D1;P6', 'ada', NULL, NULL),
(235, 'SPTD01I0001', 'INER DIGIT-ONE', 0, '', '', 'ada', NULL, NULL),
(236, 'SPTD01I0002', 'INER DIGIT-ONE NICKEY', 432, '', 'F2;P7', 'ada', NULL, NULL),
(237, 'SPTD01K0001', 'KABEL HITAM 7 CM', 534, '', 'L19;R1A', 'ada', NULL, NULL),
(238, 'SPTD01K0002', 'KABEL MERAH', 752, '', 'L19;R1C', 'ada', NULL, NULL),
(239, 'SPTD01K0003', 'KACA TIMBANGAN DIGIT-ONE', 0, '', '(BLOK D)', 'ada', NULL, NULL),
(240, 'SPTD01K0004', 'KARET KARBON DIGIT-ONE', 2282, '', 'L19;R1D', 'ada', NULL, NULL),
(241, 'SPTD01L0001', 'LCD DIGIT-ONE', 919, '', 'L19;R3,4,5,L20;R5', 'ada', NULL, NULL),
(242, 'SPTD01L0002', 'LCD DIGIT-ONE + BACKLIGHT', 1890, '', 'L19;R5', 'ada', NULL, NULL),
(243, 'SPTD01O0001', 'OUTER BESAR TIMBANGAN DIGIT ONE', 0, '', 'F1;P3', 'ada', NULL, NULL),
(244, 'SPTD01P0001', 'PANGKON TIMBANGAN(NICKEY)', 56, '', 'D1;P3', 'ada', NULL, NULL),
(245, 'SPTD01P0002', 'PCB DIGIT-ONE', 1665, '', 'L20;R4', 'ada', NULL, NULL),
(246, 'SPTD01P0003', 'PLAT COVER DIGIT-ONE', 725, '', 'L19;R1F& D1;P3', 'ada', NULL, NULL),
(247, 'SPTD01P0004', 'PCB  DIGIT ONE + BACKLIGHT', 0, '', 'L19,R1G', 'ada', NULL, NULL),
(248, 'SPTD01S0001', 'SPON PUTIH', 58, '', 'D1;P3', 'ada', NULL, NULL),
(249, 'SPTD01S0002', 'STICKER BACK DIGIT-ONE', 1664, '', 'L19;2B,D', 'ada', NULL, NULL),
(250, 'SPTD01S0003', 'STICKER PERINGATAN  DIGIT ONE', 0, '', '', 'ada', NULL, NULL),
(251, 'SPTD01S0004', 'STICKER OUTER DIGIT ONE SPESIFIKASI A', 0, '', '', 'ada', NULL, NULL),
(252, 'SPTD01S0005', 'STICKER OUTER DIGIT ONE SPESIFIKASI B', 0, '', '', 'ada', NULL, NULL),
(253, 'SPTD01S0006', 'STICKER NICKEY DIGIT-ONE COKLAT', 0, '', 'D1;P3', 'ada', NULL, NULL),
(254, 'SPTD01S0007', 'STICKER NICKEY KECIL', 440, '', 'L19;R2D', 'ada', NULL, NULL),
(255, 'SPTD01S0009', 'STICKER DIGIT PRO COKLAT', 175, '', '', 'ada', NULL, NULL),
(256, 'SPTD01T0001', 'TUTUP BATTERY ABU-ABU', 362, '', 'L20;R3', 'ada', NULL, NULL),
(257, 'SPTD01T0002', 'TUTUP BATTERY HIJAU', 147, '', '', 'ada', NULL, NULL),
(258, 'SPTD01T0003', 'TUTUP BATTERY HITAM', 335, '', 'L20;R3', 'ada', NULL, NULL),
(259, 'SPTD01T0004', 'TUTUP BATTERY KUNING', 2, '', 'L20;R2', 'ada', NULL, NULL),
(260, 'SPTD01T0005', 'TUTUP BATTERY PINK', 173, '', 'L20;R2', 'ada', NULL, NULL),
(261, 'SPTD01T0006', 'TUTUP BATTERY PUTIH', 220, '', 'L20;R2', 'ada', NULL, NULL),
(262, 'SPTD02A0001', 'ADAPTOR  5V / 2A  DIGIT PRO \"NEW\"', 0, '', 'D1;P2', 'ada', NULL, NULL),
(263, 'SPTD02B0001', 'BACKLIGHT DIGIT-PRO', 0, '', 'L19;R1A', 'ada', NULL, NULL),
(264, 'SPTD02B0002', 'BUKU MANUAL DIGIT PRO \"NEW\" (INDONESIA)', 6612, '', '', 'ada', NULL, NULL),
(265, 'SPTD02C0001', 'CASING BAWAH DIGIT PRO \"NEW\"', 4325, '', 'D1;P2', 'ada', NULL, NULL),
(266, 'SPTD02C0002', 'CASING ATAS DIGIT PRO \"NEW\"', 9756, '', 'D1;P2,4', 'ada', NULL, NULL),
(267, 'SPTD02G0001', 'GABUS  DIGIT PRO  \"NEW\"', 7735, '', '', 'ada', NULL, NULL),
(268, 'SPTD02I0001', 'INER DIGIT PRO LAMA', 1840, '', 'F2;P8', 'ada', NULL, NULL),
(269, 'SPTD02I0002', 'INER DIGIT PRO \"NEW\"', 6538, '', 'F2;P8', 'ada', NULL, NULL),
(270, 'SPTD02K0001', 'KABEL HITAM - 24 cm', 9510, '', '', 'ada', NULL, NULL),
(271, 'SPTD02K0002', 'KABEL HITAM - 15 cm', 52180, '', 'L19;R1A', 'ada', NULL, NULL),
(272, 'SPTD02K0003', 'KACA TIMBANGAN DIGIT PRO COKLAT', 40, '', 'BLOK D', 'ada', NULL, NULL),
(273, 'SPTD02K0004', 'KACA TIMBANGAN DIGIT PRO \"NEW\"  HIJAU', 1491, '', 'B1;P7', 'ada', NULL, NULL),
(274, 'SPTD02K0005', 'KACA TIMBANGAN DIGIT PRO \"NEW\"  COKLAT', 1624, '', 'B1;P7', 'ada', NULL, NULL),
(275, 'SPTD02K0006', 'KACA TIMBANGAN DIGIT PRO \"NEW\" PUTIH', 1506, '', 'B1;P7', 'ada', NULL, NULL),
(276, 'SPTD02K0007', 'KACA TIMBANGAN DIGIT PRO \"NEW\"  UNGU', 1712, '', 'B1;P7', 'ada', NULL, NULL),
(277, 'SPTD02K0008', 'KARET KARBON DIGIT PRO', 0, '', 'L19;R1C', 'ada', NULL, NULL),
(278, 'SPTD02K0009', 'KARET KARBON DIGIT PRO \"NEW\"', 16706, '', 'L19;R1C', 'ada', NULL, NULL),
(279, 'SPTD02L0001', 'LCD DIGIT PRO ', 0, '', '', 'ada', NULL, NULL),
(280, 'SPTD02L0002', 'LCD DIGIT PRO \"NEW\"', 6510, '', 'L20;R5', 'ada', NULL, NULL),
(281, 'SPTD02L0003', 'LCD BACKLIGHT DIGIT PRO \"NEW\"', 4555, '', 'L19;R1C', 'ada', NULL, NULL),
(282, 'SPTD02O0001', 'OUTER TIMBANGAN DIGIT PRO \"NEW\"', 273, '', 'F1;P8', 'ada', NULL, NULL),
(283, 'SPTD02O0002', 'OUTER ADAPTOR TIMBANGAN DIGIT PRO \"NEW\"', 1785, '', 'E1;P1', 'ada', NULL, NULL),
(284, 'SPTD02P0001', 'PCB DIGIT PRO', 0, '', '', 'ada', NULL, NULL),
(285, 'SPTD02P0002', 'PCB DIGIT PRO \"NEW\"', 6215, '', 'L19;R1C', 'ada', NULL, NULL),
(286, 'SPTD02P0003', 'PCB SOCKET BATERAI DIGIT PRO \"NEW\"', 6654, '', 'L19;R1C', 'ada', NULL, NULL),
(287, 'SPTD02P0004', 'PLAT COVER DIGIT PRO', 219, '', 'L19;R1F', 'ada', NULL, NULL),
(288, 'SPTD02P0005', 'PCB DIGIT PRO NEW \"BLUETOOTH\"', 0, '', '', 'ada', NULL, NULL),
(289, 'SPTD02S0001', 'SCREW M2 X 6', 27050, '', 'L19;R1G', 'ada', NULL, NULL),
(290, 'SPTD02S0002', 'SOCKET BATERAI DIGIT PRO \"NEW\"', 5948, '', 'L19;R1G', 'ada', NULL, NULL),
(291, 'SPTD02S0003', 'SPON PUTIH DIGIT PRO \"NEW\"', 37386, '', '', 'ada', NULL, NULL),
(292, 'SPTD02ST001', 'STICKER BACK DIGIT PRO', 7116, '', 'L19;2B', 'ada', NULL, NULL),
(293, 'SPTD02ST002', 'STICKER ADAPTOR DIGIT PRO \"NEW\"', 2724, '', 'L19;2B', 'ada', NULL, NULL),
(294, 'SPTD02ST003', 'STICKER DIGIT PRO HIJAU', 179, '', 'L19;R2B', 'ada', NULL, NULL),
(295, 'SPTD02ST004', 'STICKER DIGIT PRO PINK', 29, '', 'L19;R2C', 'ada', NULL, NULL),
(296, 'SPTD02ST005', 'STICKER DIGIT PRO PUTIH', 472, '', 'L19;R2C', 'ada', NULL, NULL),
(297, 'SPTD02ST006', 'STICKER DIGIT PRO UNGU', 146, '', 'L19;R2C', 'ada', NULL, NULL),
(298, 'SPTD02ST007', 'STICKER OUTER DIGIT PRO', 0, '', '', 'ada', NULL, NULL),
(299, 'SPTD02ST008', 'STICKER PERINGATAN \"AWAS LICIN\"', 488, '', 'L19;R2F,G', 'ada', NULL, NULL),
(300, 'SPTD02ST009', 'STICKER PERINGATAN TIMBANGAN \"NEW\"', 0, '', 'L19;R2H', 'ada', NULL, NULL),
(301, 'SPTD02T0001', 'TUTUP BATTERY DIGIT PRO \"NEW\"', 8063, '', 'L19;R2H', 'ada', NULL, NULL),
(302, 'SPTD02T0002', 'TOMBOL SWITCH DIGIT PRO \"NEW\"', 8290, '', 'L19;R2F', 'ada', NULL, NULL),
(303, 'SPTD02ZZK01', 'KABEL 26/150 WARNA MERAH (m)', 1, '', '', 'ada', NULL, NULL),
(304, 'SPTD02ZZK02', 'KABEL 26/150 WARNA HITAM (m)', 1, '', '', 'ada', NULL, NULL),
(305, 'SPTD02ZZK03', 'KABEL 26/150 WARNA BIRU (m)                PART FOR MODIF ', 1, '', '', 'ada', NULL, NULL),
(306, 'SPTD02ZZR01', 'RELAY SPTD 5V5DC 6 PIN (HUI KE)', 89, '', '', 'ada', NULL, NULL),
(307, 'SPTD02ZZS01', 'SELANG BAKAR 1 mm', 0, '', '', 'ada', NULL, NULL),
(308, 'SPTD03A0001', 'ACRILIC TIMBANGAN DIGIT ONE BABY ', 2305, '', '', 'ada', NULL, NULL),
(309, 'SPTD03A0002', 'ADAPTOR 6V / 2A DIGIT ONE BABY', 304, '', '', 'ada', NULL, NULL),
(310, 'SPTD03B0001', 'BEARING PADS FOR SENSOR', 9980, '', '', 'ada', NULL, NULL),
(311, 'SPTD03B0002', 'BOARD PUSH BUTTON', 2256, '', '', 'ada', NULL, NULL),
(312, 'SPTD03B0003', 'BUKU MANUAL DIGIT-ONE BABY (inggris)', 4872, '', '', 'ada', NULL, NULL),
(313, 'SPTD03B0004', 'BUKU MANUAL DIGIT-ONE BABY (indonesia)', 0, '', '', 'ada', NULL, NULL),
(314, 'SPTD03B0005', 'BUKU PETUNJUK  PENGGUNAAN DIGIT-ONE BABY', 0, '', '', 'ada', NULL, NULL),
(315, 'SPTD03C0001', 'CONNECTING WIRE HIJAU', 0, '', '', 'ada', NULL, NULL),
(316, 'SPTD03C0002', 'CONNECTING WIRE HITAM', 0, '', '', 'ada', NULL, NULL),
(317, 'SPTD03C0003', 'CONNECTING WIRE MERAH', 0, '', '', 'ada', NULL, NULL),
(318, 'SPTD03C0004', 'CONNECTING WIRE PUTIH', 0, '', '', 'ada', NULL, NULL),
(319, 'SPTD03C0005', 'CONNECTOR', 2293, '', '', 'ada', NULL, NULL),
(320, 'SPTD03F0001', 'FRAME FOR BATERAI ( TUTUP BATERAI )', 2598, '', '', 'ada', NULL, NULL),
(321, 'SPTD03F0002', 'FRAME SENSOR', 9233, '', '', 'ada', NULL, NULL),
(322, 'SPTD03I0001', 'INER PUTIH DIGIT-ONE BABY', 0, '', '', 'ada', NULL, NULL),
(323, 'SPTD03K0001', 'KABEL BATERAI PANJANG', 6615, '', '', 'ada', NULL, NULL),
(324, 'SPTD03K0002', 'KABEL BATERAI PENDEK', 2264, '', '', 'ada', NULL, NULL),
(325, 'SPTD03K0003', 'KABEL TIES 2X90', 2000, '', '', 'ada', NULL, NULL),
(326, 'SPTD03L0001', 'LCD DISPLAY', 2259, '', '', 'ada', NULL, NULL),
(327, 'SPTD03L0002', 'LOCK FRAME LCD DISPLAY', 2259, '', '', 'ada', NULL, NULL),
(328, 'SPTD03L0003', 'LOWER CHASING', 2080, '', '', 'ada', NULL, NULL),
(329, 'SPTD03M0001', 'MUR M - 7', 112, '', '', 'ada', NULL, NULL),
(330, 'SPTD03O0001', 'OUTER TIMBANGAN DIGIT ONE BABY', 2290, '', '', 'ada', NULL, NULL),
(331, 'SPTD03P0001', 'PCB MAINBOARD', 2248, '', '', 'ada', NULL, NULL),
(332, 'SPTD03R0001', 'RUBBER CONDUCTOR', 2259, '', '', 'ada', NULL, NULL),
(333, 'SPTD03R0002', 'RULLER / METER', 2657, '', '', 'ada', NULL, NULL),
(334, 'SPTD03R0003', 'RING SPRING M - 8', 0, '', '', 'ada', NULL, NULL),
(335, 'SPTD03S0001', 'STEREFOAM TIMBANGAN DIGIT ONE BABY ', 2489, '', '', 'ada', NULL, NULL),
(336, 'SPTD03S0002', 'SCREW PAYUNG ST 3 X 11', 26780, '', '', 'ada', NULL, NULL),
(337, 'SPTD03S0003', 'SCREW PAYUNG ST 4 X 11', 9255, '', '', 'ada', NULL, NULL),
(338, 'SPTD03S0004', 'SCREW ST 3 X 11', 9000, '', '', 'ada', NULL, NULL),
(339, 'SPTD03S0005', 'SELANG BAKAR', 10835, '', '', 'ada', NULL, NULL),
(340, 'SPTD03S0006', 'STICKER BACK DIGIT-ONE BABY', 2162, '', '', 'ada', NULL, NULL),
(341, 'SPTD03S0007', 'STICKER QC PASS', 2189, '', '', 'ada', NULL, NULL),
(342, 'SPTD03S0008', 'STICKER OUTER SPESIFIKASI DIGIT ONE BABY', 20, '', '', 'ada', NULL, NULL),
(343, 'SPTD03S0009', 'STICKER ADAPTOR DIGIT ONE BABY', 1336, '', '', 'ada', NULL, NULL),
(344, 'SPTD03S0010', 'SCREW ST 2 X 8', 8328, '', '', 'ada', NULL, NULL),
(345, 'SPTD03S0011', 'SOCKET FEMALE ADAPTOR', 2075, '', '', 'ada', NULL, NULL),
(346, 'SPTD03S0012', 'SPRING ( - )', 2000, '', '', 'ada', NULL, NULL),
(347, 'SPTD03S0013', 'SPRING ( + )', 2280, '', '', 'ada', NULL, NULL),
(348, 'SPTD03S0014', 'SPRING ( - / + )', 2290, '', '', 'ada', NULL, NULL),
(349, 'SPTD03S0015', 'SCREW ST 3 X 8', 27150, '', '', 'ada', NULL, NULL),
(350, 'SPTD03T0001', 'TOMBOL BUTTON', 2222, '', '', 'ada', NULL, NULL),
(351, 'SPTD03U0001', 'UNIT SENSOR', 8832, '', '', 'ada', NULL, NULL),
(352, 'SPTD03U0002', 'UPPER CHASING / TOP CASE', 2080, '', '', 'ada', NULL, NULL),
(353, 'SPTD04A0001', 'ADAPTOR TIMBANGAN BABY AND', 0, '', '', 'ada', NULL, NULL),
(354, 'SPTD04A0002', 'ADAPTOR TYPE 280 + STEKER 3 PIN', 0, '', '', 'ada', NULL, NULL),
(355, 'SPTD04A0003', 'ADAPTOR TYPE TB 266', 0, '', '', 'ada', NULL, NULL),
(356, 'SPTD04B0001', 'BUKU MANUAL TIMBANGAN AND', 0, '', 'L24;R5', 'ada', NULL, NULL),
(357, 'SPTD04B0002', 'BATTERAI TYPE D', 90, '', '', 'ada', NULL, NULL),
(358, 'SPTD04B0003', 'BUKU PETUNJUK PENGGUNAAN TIMBANGAN AND', 0, '', '', 'ada', NULL, NULL),
(359, 'SPTD04L0001', 'LOAD CELL BABY ONE AND', 0, '', '', 'ada', NULL, NULL),
(360, 'SPTD04L0002', 'LCD BABY ONE', 0, '', '', 'ada', NULL, NULL),
(361, 'SPTD04P0001', 'PCB MAINBOARD BABY ONE AND', 0, '', '', 'ada', NULL, NULL),
(362, 'SPTD04ST001', 'STICKER PERHATIAN BELAKANG AND', 338, '', 'L19;R2D', 'ada', NULL, NULL),
(363, 'SPTD04ST002', 'STICKER SPESIFIKASI ELITECH SAMPING AND', 211, '', 'L19;R2D', 'ada', NULL, NULL),
(364, 'SPTD04ST003', 'STICKER PERHATIAN ATAS TIMBANGAN AND', 333, '', 'L19;R2D', 'ada', NULL, NULL),
(365, 'SPTD04ST004', 'STICKER PERINGATAN DEPAN TIMBANGAN AND', 268, '', 'L19;R2E', 'ada', NULL, NULL),
(366, 'SPTD04ST005', 'STICKER PANEL DEPAN KUNING TIMBANGAN AND', 205, '', 'L19;R2E', 'ada', NULL, NULL),
(367, 'SPTD04ST006', 'STICKER PERINGATAN KERANJANG ATAS BESAR AND', 334, '', 'L19;R2E', 'ada', NULL, NULL),
(368, 'SPTD04ST007', 'STICKER BATAS TINGGI BAYI KECIL AND', 356, '', 'L19;R2E', 'ada', NULL, NULL),
(369, 'SPTD04ST008', 'STICKER BATAS TINGGI BAYI BESAR AND', 334, '', 'L19;R2E', 'ada', NULL, NULL),
(370, 'SPTD04ST009', 'STICKER PERINGATAN KERNJANG BLKG KCL AND', 149, '', 'L19;R2E', 'ada', NULL, NULL),
(371, 'SPTD04ST010', 'STICKER PERINGATAN KRNJANG BLKG BESAR AND', 268, '', 'L19;R2E', 'ada', NULL, NULL),
(372, 'SPTD04ST011', 'STICKER MEMORY TERAKHIR TARA AND', 156, '', 'L19;R2E', 'ada', NULL, NULL),
(373, 'SPTD04ST012', 'STICKER ELITECH BIRU KECIL', 1991, '', 'L19;R2E', 'ada', NULL, NULL),
(374, 'SPTD04ST013', 'STICKER HOLOGRAM SILVER', 11058, '', 'L19;R2F', 'ada', NULL, NULL),
(375, 'SPTD04ST014', 'STICKER HOLOGRAM EMAS', 12051, '', 'L19;R2F', 'ada', NULL, NULL),
(376, 'SPTD04ST015', 'STICKER OUTER A3 DEPAN BELAKANG', 0, '', '', 'ada', NULL, NULL),
(377, 'SPTD04ST016', 'STICKER OUTER A3 SAMPING', 0, '', '', 'ada', NULL, NULL),
(378, 'SPTD04T0001', 'TIMBANGAN BABY AND (BELUM PACKING)', 0, '', '', 'ada', NULL, NULL),
(379, 'SPTD05B0001', 'BUKU MANUAL INGGRIS DIGIT-PRO BMI', 2368, '', '', 'ada', NULL, NULL),
(380, 'SPTD05B0002', 'BUKU MANUAL INDONESIA DIGIT-PRO BMI', 854, '', '', 'ada', NULL, NULL),
(381, 'SPTD05B0003', 'BUKU PETUNJUK PENGGUNAAN DIGIT-PRO BMI', 100, '', '', 'ada', NULL, NULL),
(382, 'SPTD05C0001', 'CHASING ATAS DIGIT-PRO BMI', 100, '', '', 'ada', NULL, NULL),
(383, 'SPTD05C0002', 'CHASING BAWAH DIGIT-PRO BMI', 1181, '', '', 'ada', NULL, NULL),
(384, 'SPTD05I0001', 'INER TIMBANGAN DIGIT-PRO BMI', 1020, '', '', 'ada', NULL, NULL),
(385, 'SPTD05K0001', 'KABEL BIRU 8 CM', 4946, '', '', 'ada', NULL, NULL),
(386, 'SPTD05K0002', 'KABEL HITAM 15 CM', 100, '', '', 'ada', NULL, NULL),
(387, 'SPTD05K0003', 'KABEL HITAM 25 CM', 100, '', '', 'ada', NULL, NULL),
(388, 'SPTD05K0003a', 'KABEL PUTIH 15 CM', 495, '', '', 'ada', NULL, NULL),
(389, 'SPTD05K0004', 'KACA TIMBANGAN DIGIT-PRO BMI \"HIJAU\"', 470, '', '', 'ada', NULL, NULL),
(390, 'SPTD05K0005', 'KACA TIMBANGAN DIGIT PRO BMI\"COKLAT\"', 267, '', '', 'ada', NULL, NULL),
(391, 'SPTD05K0006', 'KACA TIMBANGAN DIGIT PRO BMI\"PUTIH\"', 125, '', '', 'ada', NULL, NULL),
(392, 'SPTD05K0007', 'KACA TIMBANGAN DIGIT PRO BMI\"UNGU\"', 250, '', '', 'ada', NULL, NULL),
(393, 'SPTD05L0001', 'LCD BACKLIGHT DIGIT-PRO BMI', 234, '', '', 'ada', NULL, NULL),
(394, 'SPTD05L0002', 'LCD DIGIT-PRO BMI', 1000, '', '', 'ada', NULL, NULL),
(395, 'SPTD05L0003', 'LCD LAYAR MERAH BMI ( BLUETOOTH )', 90, '', '', 'ada', NULL, NULL),
(396, 'SPTD05M0001', 'METAL ELECTRODE', 580, '', '', 'ada', NULL, NULL),
(397, 'SPTD05P0001', 'PCB MAINBOARD DIGIT-PRO BMI', 1005, '', '', 'ada', NULL, NULL),
(398, 'SPTD05P0002', 'PCB SENSOR TIMBANGAN BMI', 991, '', '', 'ada', NULL, NULL),
(399, 'SPTD05S0001', 'SPON ABU-ABU', 3913, '', '', 'ada', NULL, NULL),
(400, 'SPTD05S0002', 'SPRING ELECTRODE', 2556, '', '', 'ada', NULL, NULL),
(401, 'SPTD05S0003', 'STICKER BACK DIGIT-PRO BMI', 295, '', '', 'ada', NULL, NULL),
(402, 'SPTD05T0001', 'TOMBOL BUTTON', 462, '', '', 'ada', NULL, NULL),
(403, 'SPTD05T0002', 'TUTUP BATTERY DIGIT-PRO BMI', 100, '', '', 'ada', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `part_engs`
--

CREATE TABLE `part_engs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `part_id` bigint(20) UNSIGNED DEFAULT NULL,
  `kode_part` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spesifikasi` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('ada','tidak_ada') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemeriksaan_rakits`
--

CREATE TABLE `pemeriksaan_rakits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `perakitan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jenis_pemeriksaan` enum('all','sample','no') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kesimpulan` enum('terima','tolak','dipertimbangkan') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('0','12','5','4') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman_alats`
--

CREATE TABLE `peminjaman_alats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `peminjam_id` bigint(20) UNSIGNED DEFAULT NULL,
  `divisi_inventory_id` bigint(20) UNSIGNED DEFAULT NULL,
  `inventory_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `tanggal_pengajuan` date DEFAULT NULL,
  `tanggal_peminjaman` date DEFAULT NULL,
  `tanggal_batas_pengembalian` date DEFAULT NULL,
  `tanggal_perpanjangan` date DEFAULT NULL,
  `tanggal_pengembalian` date DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('draft','wishlist','menunggu','dipinjam','tolak','permintaan_perpanjangan','perpanjangan','tolak_perpanjangan','kembali') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjaman_alats`
--

INSERT INTO `peminjaman_alats` (`id`, `peminjam_id`, `divisi_inventory_id`, `inventory_id`, `jumlah`, `tanggal_pengajuan`, `tanggal_peminjaman`, `tanggal_batas_pengembalian`, `tanggal_perpanjangan`, `tanggal_pengembalian`, `keterangan`, `status`, `created_at`, `updated_at`) VALUES
(4, 1, 4, 4, 3, '2021-04-06', '2021-04-06', '2021-04-15', NULL, NULL, 'Pelatihan', 'dipinjam', '2021-04-06 01:54:56', '2021-04-06 09:57:56'),
(5, 1, 4, 3, 1, '2021-04-06', '2021-04-06', '2021-04-15', NULL, NULL, 'Pelatihan', 'dipinjam', '2021-04-06 01:54:56', '2021-04-06 06:57:40');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman_karyawans`
--

CREATE TABLE `peminjaman_karyawans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `penanggung_jawab_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_penugasan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi_penugasan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pembuatan` date NOT NULL,
  `tanggal_penugasan` date NOT NULL,
  `tanggal_estimasi_selesai` date NOT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjaman_karyawans`
--

INSERT INTO `peminjaman_karyawans` (`id`, `penanggung_jawab_id`, `user_id`, `nama_penugasan`, `lokasi_penugasan`, `tanggal_pembuatan`, `tanggal_penugasan`, `tanggal_estimasi_selesai`, `tanggal_selesai`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 8, 1, 'Perbaikan Jaringan', 'PT Sinko Prima Alloy', '2021-04-08', '2021-04-08', '2021-04-13', NULL, 'Perbaikan Jaringan pada Gudang E8', '2021-04-07 22:58:27', '2021-04-08 00:55:50'),
(3, 5, 1, 'Pengemasan Produk', 'Ruang Pengemasan Produksi', '2021-04-09', '2021-04-09', '2021-04-14', NULL, 'Produk Urgent', '2021-04-08 21:34:10', '2021-04-08 21:34:10'),
(4, 6, NULL, 'Domain', 'PT Sinko Prima Alloy', '2021-04-09', '2021-04-09', '2021-04-12', NULL, 'Register setiap komputer ke domain dan hosting masing-masing', '2021-04-08 23:45:00', '2021-04-08 23:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `penawaran_ecoms`
--

CREATE TABLE `penawaran_ecoms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ecommerce_id` int(11) NOT NULL,
  `tujuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_surat` date NOT NULL,
  `karyawan_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penawaran_ecoms`
--

INSERT INTO `penawaran_ecoms` (`id`, `ecommerce_id`, `tujuan`, `deskripsi`, `tgl_surat`, `karyawan_id`, `created_at`, `updated_at`) VALUES
(1, 30, 'Penawaran Harga', 'Produk ini merupakans', '2021-05-04', 11, '2021-04-19 03:58:07', '2021-04-19 04:58:23'),
(2, 31, 'Penawaran Harga', 'gfbgfbfgb', '2021-04-28', 12, '2021-04-19 08:43:18', '2021-04-19 08:43:18');

-- --------------------------------------------------------

--
-- Table structure for table `penawaran_offlines`
--

CREATE TABLE `penawaran_offlines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `offline_id` int(11) NOT NULL,
  `tujuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_surat` date NOT NULL,
  `karyawan_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penawaran_offlines`
--

INSERT INTO `penawaran_offlines` (`id`, `offline_id`, `tujuan`, `deskripsi`, `tgl_surat`, `karyawan_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Penawaran Harga', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum', '2021-12-19', 12, '2021-04-15 20:29:40', '2021-04-19 02:32:39'),
(2, 2, 'Penawaran Harga', 'Suspendisse hendrerit pretium nibh, in euismod turpis molestie sed. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed et neque ornare, maximus mi in, scelerisque purus. Vestibulum auctor tincidunt blandit. Maecenas posuere mollis lorem, vitae porttitor metus fermentum eu. Donec ut orci sodales, aliquam eros ac, feugiat augue. Aenean nec rhoncus magna. Nulla velit orci, molestie mattis efficitur ultricies, maximus eu leo. Mauris nulla elit, placerat ac dapibus ac, volutpat sed mauris.', '2021-04-16', 11, '2021-04-15 23:24:41', '2021-04-16 00:27:35'),
(3, 3, 'Penawaran Harga', 'Cras imperdiet magna eu enim suscipit convallis. Mauris vitae nisi ante. Morbi vitae posuere nibh. Integer vel egestas sapien. Nulla vel purus velit. Donec viverra nulla vel faucibus posuere. Integer tempor urna felis, et ultrices purus rutrum eget. Quisque et aliquet lacus. Sed sed leo risus. Pellentesque fermentum lacus id urna varius porta. In id pellentesque velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Quisque ultrices lectus nisi, at dapibus purus elementum pretium.', '2021-04-23', 11, '2021-04-16 08:49:21', '2021-04-16 08:49:21');

-- --------------------------------------------------------

--
-- Table structure for table `pengemasans`
--

CREATE TABLE `pengemasans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bppb_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pic_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('dibuat','req_qc','acc_qc','rej_qc','acc_prd','rej_prd') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perakitans`
--

CREATE TABLE `perakitans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bppb_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pic_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('0','12') COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `perakitans`
--

INSERT INTO `perakitans` (`id`, `bppb_id`, `pic_id`, `tanggal`, `created_at`, `updated_at`, `status`) VALUES
(33, 28, 2, '2021-04-19', '2021-04-18 18:15:31', '2021-04-18 18:15:31', '0'),
(34, 29, 2, '2021-04-19', '2021-04-18 19:22:09', '2021-04-22 01:20:46', '12'),
(35, 29, 2, '2021-04-19', '2021-04-18 19:40:33', '2021-04-18 23:37:34', '12');

-- --------------------------------------------------------

--
-- Table structure for table `perakitan_karyawans`
--

CREATE TABLE `perakitan_karyawans` (
  `perakitan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `karyawan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `operator_custom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `perakitan_karyawans`
--

INSERT INTO `perakitan_karyawans` (`perakitan_id`, `karyawan_id`, `operator_custom`, `created_at`, `updated_at`) VALUES
(NULL, 4, NULL, '2021-04-18 18:55:21', '2021-04-18 18:55:21'),
(NULL, 2, NULL, '2021-04-18 18:56:33', '2021-04-18 18:56:33'),
(NULL, 2, NULL, '2021-04-18 19:22:09', '2021-04-18 19:22:09'),
(NULL, 5, NULL, '2021-04-18 19:22:09', '2021-04-18 19:22:09'),
(NULL, 2, NULL, '2021-04-18 19:22:09', '2021-04-18 19:22:09'),
(NULL, 5, NULL, '2021-04-18 19:22:09', '2021-04-18 19:22:09'),
(NULL, 2, NULL, '2021-04-18 19:40:33', '2021-04-18 19:40:33'),
(NULL, 5, NULL, '2021-04-18 19:40:33', '2021-04-18 19:40:33'),
(NULL, 2, NULL, '2021-04-18 19:40:33', '2021-04-18 19:40:33'),
(NULL, 5, NULL, '2021-04-18 19:40:33', '2021-04-18 19:40:33'),
(33, 2, NULL, '2021-04-21 22:32:04', '2021-04-21 22:32:04'),
(33, 3, NULL, '2021-04-21 22:32:04', '2021-04-21 22:32:04'),
(34, 2, NULL, '2021-04-22 01:03:36', '2021-04-22 01:03:36'),
(34, 5, NULL, '2021-04-22 01:03:37', '2021-04-22 01:03:37'),
(35, 1, NULL, '2021-04-22 01:04:04', '2021-04-22 01:04:04'),
(35, 5, NULL, '2021-04-22 01:04:04', '2021-04-22 01:04:04');

-- --------------------------------------------------------

--
-- Table structure for table `podo_offlines`
--

CREATE TABLE `podo_offlines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `offline_id` int(11) NOT NULL,
  `po` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tglpo` date DEFAULT NULL,
  `do` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgldo` date DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `podo_offlines`
--

INSERT INTO `podo_offlines` (`id`, `offline_id`, `po`, `tglpo`, `do`, `tgldo`, `file`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 'PO/333/UU/2021', '2021-04-07', NULL, NULL, '-DataTables example - File export.pdf', NULL, '2021-04-22 01:59:49', '2021-04-22 03:57:43'),
(2, 2, 'PO/544/UUU', '2021-04-01', 'DO/UJ', NULL, '2-penawaran_offline.pdf', 'ujhbjnb', '2021-04-22 02:05:11', '2021-04-22 03:57:11'),
(3, 3, 'PO/544/455', '2021-04-02', NULL, NULL, '3-Nama-Email Sinko.pdf', NULL, '2021-04-22 08:50:12', '2021-04-22 08:50:12');

-- --------------------------------------------------------

--
-- Table structure for table `podo_onlines`
--

CREATE TABLE `podo_onlines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ekatjual_id` int(11) NOT NULL,
  `po` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tglpo` date DEFAULT NULL,
  `do` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgldo` date DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `podo_onlines`
--

INSERT INTO `podo_onlines` (`id`, `ekatjual_id`, `po`, `tglpo`, `do`, `tgldo`, `file`, `keterangan`, `created_at`, `updated_at`) VALUES
(26, 2, 'PO/1111/2021', '2021-04-02', NULL, NULL, '2-0196+KW.pdf', 'sasz', '2021-04-21 03:13:19', '2021-04-21 03:42:48'),
(27, 3, 'PO/544', '2021-04-21', NULL, NULL, '3-PO0000-1212.pdf', 'sdsd', '2021-04-21 03:17:03', '2021-04-21 04:23:06'),
(28, 4, 'PO/544', '2021-04-07', NULL, NULL, NULL, NULL, '2021-04-21 04:30:34', '2021-04-21 04:30:34');

-- --------------------------------------------------------

--
-- Table structure for table `produks`
--

CREATE TABLE `produks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kelompok_produk_id` bigint(20) UNSIGNED DEFAULT NULL,
  `kategori_id` bigint(20) UNSIGNED DEFAULT NULL,
  `merk` enum('elitech','mentor','vanward','aeolus','other') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_barcode` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_coo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_akd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('show','hide') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produks`
--

INSERT INTO `produks` (`id`, `kelompok_produk_id`, `kategori_id`, `merk`, `tipe`, `nama`, `kode_barcode`, `nama_coo`, `no_akd`, `keterangan`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'elitech', 'SP-10', 'Digital Spirometer DS-PRO', 'SP01', 'SP-10', 'KEMENKES RI AKD 20401610237', NULL, 'hide', '2021-02-17 02:10:54', '2021-02-25 08:33:46'),
(2, 1, 1, 'elitech', 'DS-PRO100', 'Portable Spirometer', 'SP02', 'DS-PRO100', 'KEMENKES RI AKD 20401710665', NULL, NULL, '2021-02-17 02:17:06', '2021-02-17 02:17:06'),
(3, 1, 1, 'elitech', 'PROMIST-1', 'Mini Compressor Nebulizer', 'CN01', 'PROMIST-1', 'KEMENKES RI AKD 20403318003', NULL, NULL, '2021-02-17 00:33:42', '2021-02-17 00:33:42'),
(4, 1, 1, 'elitech', 'PROMIST-3', 'Medical Nebulizer', 'MN03', 'PROMIST-3', 'KEMENKES RI AKD 20403710661', NULL, NULL, '2021-02-17 00:43:49', '2021-02-17 00:43:49'),
(5, 1, 1, 'elitech', 'ULTRA MIST', 'Ultrasonic Nebulizer', 'UN01', 'ULTRA MIST', 'KEMENKES RI AKD 20403710663', NULL, NULL, '2021-02-17 00:49:18', '2021-02-17 00:49:18'),
(6, 1, 1, 'elitech', 'MOC-A', 'Oxygen Concentrator', 'OC01', 'MOC-A', 'KEMENKES RI AKD 20403510582', NULL, NULL, '2021-02-17 00:52:30', '2021-02-17 00:52:30'),
(7, 1, 2, 'elitech', 'FOX-BABY', 'Pulse Oximeter', 'FX04', 'FOX-BABY', 'KEMENKES RI AKD 20502318005', NULL, NULL, '2021-02-17 01:01:37', '2021-02-17 01:01:37'),
(8, 1, 2, 'elitech', 'FOX-3', 'Pulse Oximeter', 'FX06', 'FOX-3', 'KEMENKES RI AKD 20502210101', NULL, NULL, '2021-02-17 01:05:31', '2021-02-17 01:05:31'),
(9, 1, 2, 'elitech', 'PM50', 'SPO2 Monitor', 'PM07', 'PM50', '5656', 'we', NULL, '2021-02-17 01:08:00', '2021-04-05 23:24:52'),
(10, 1, 2, 'elitech', 'ABPM50', 'Ambulatory Blood Pressure Monitor', 'PM06', 'ABPM50', 'KEMENKES RI AKD 20501510581', NULL, NULL, '2021-02-17 01:12:41', '2021-02-17 01:12:41'),
(11, 1, 2, 'elitech', 'TENSIONE', 'Electrocardiograph', 'BP01', 'TENSIONE', 'KEMENKES RI AKD 20501318004', NULL, NULL, '2021-02-20 07:20:32', '2021-02-20 07:20:32'),
(12, 1, 2, 'elitech', 'ECG-300G', 'Electrocardiograph', 'EM02', 'ECG-300G', 'KEMENKES RI AKD 21102900255', NULL, NULL, '2021-02-20 07:22:28', '2021-02-20 07:22:28'),
(13, 1, 2, 'elitech', 'ECG-1200G', 'Electrocardiograph', 'EM03', 'ECG-1200G', 'KEMENKES RI AKD 20502310189', NULL, NULL, '2021-02-20 07:24:16', '2021-02-20 07:24:16'),
(14, 1, 2, 'elitech', 'PM-9000+', 'Patient Monitor', 'PM01', 'PM-9000+', 'KEMENKES RI AKD 20903900075', NULL, NULL, '2021-02-20 07:26:16', '2021-02-20 07:26:16'),
(15, 1, 4, 'elitech', 'TS-5830', 'Dental Unit', 'DU01', 'TS-5830', 'KEMENKES RI AKD 10605900071', NULL, NULL, '2021-02-20 07:29:55', '2021-02-20 07:29:55'),
(16, 1, 4, 'elitech', 'TS-8830', 'Dental Unit', 'DU02', 'TS-8830', 'KEMENKES RI AKD 10605810069', NULL, NULL, '2021-02-20 07:31:24', '2021-02-20 07:31:24'),
(17, 1, 4, 'elitech', 'TOP-308', 'Dental Unit', 'DU03', 'TOP-308', 'KEMENKES RI AKD 10605900070', NULL, NULL, '2021-02-20 07:32:48', '2021-02-20 07:32:48'),
(18, 1, 5, 'elitech', 'END-1 (1 Fungsi)', 'Medical Destroyer', 'ND03', 'END-1 (1 Fungsi)', 'KEMENKES RI AKD 20902210075', NULL, NULL, '2021-02-20 07:35:42', '2021-02-20 07:35:42'),
(19, 1, 6, 'elitech', 'BL-50B', 'Infant Phototherapy Unit', 'BL01', 'BL-50B', 'KEMENKES RI AKD 20903900073', NULL, NULL, '2021-02-20 07:38:01', '2021-02-20 07:38:01'),
(20, 1, 6, 'elitech', 'BN-100', 'Infant Warmer', 'BN01', 'BN-100', 'KEMENKES RI AKD 20903900074', NULL, NULL, '2021-02-20 07:40:39', '2021-02-20 07:40:39'),
(21, 1, 6, 'elitech', 'BB-200', 'Infant Incubator', 'BB01', 'BB-200', 'KEMENKES RI AKD 20903900076', NULL, NULL, '2021-02-20 07:42:39', '2021-02-20 07:42:39'),
(22, 1, 6, 'elitech', 'BT-100 (SMALL TROLLEY)', 'Infant Incubator Transport', 'BT01', 'BT-100 (SMALL TROLLEY)', 'KEMENKES RI AKD 20902710901', NULL, NULL, '2021-02-20 07:45:20', '2021-02-20 07:45:20'),
(23, 1, 7, 'elitech', 'MEL-02', 'Lampu Periksa LED', 'ML01', 'MEL-02', 'KEMENKES RI AKD 10903710660', NULL, NULL, '2021-02-20 07:47:22', '2021-02-20 07:47:22'),
(24, 1, 7, 'elitech', 'MOL-01', 'Lampu Operasi LED', 'OL01', 'MOL-01', 'KEMENKES RI AKD 21603710667', NULL, NULL, '2021-02-20 07:49:47', '2021-02-20 07:49:47'),
(25, 1, 7, 'elitech', 'MOL-02', 'Lampu Operasi LED', 'OL21', 'MOL-02', 'KEMENKES RI AKD 21603710788', NULL, NULL, '2021-02-20 07:51:07', '2021-02-20 07:51:07'),
(26, 1, 9, 'elitech', 'SONOTRAX-B', 'Pocket Fetal Doppler', 'FD02', 'SONOTRAX-B', 'KEMENKES RI AKD 21102800003', NULL, NULL, '2021-02-20 07:54:23', '2021-02-20 07:54:23'),
(27, 1, 9, 'elitech', 'SONOTRAX-C', 'Pocket Fetal Doppler', 'FD07', 'SONOTRAX-C', 'KEMENKES RI AKD 21101710077', NULL, NULL, '2021-02-20 07:55:47', '2021-02-20 07:55:47'),
(28, 1, 9, 'elitech', 'SONOTRAX PRO2', 'Ultrasonic Table Doppler', 'FD05', 'SONOTRAX PRO2', 'KEMENKES RI AKD 21101810461', NULL, NULL, '2021-02-20 07:58:46', '2021-02-20 07:58:46'),
(29, 1, 9, 'elitech', 'SONOTRAX MED-01', 'Fetal Monitor', 'SM01', 'SONOTRAX MED-01', 'KEMENKES RI AKD 21101710857', NULL, NULL, '2021-02-20 08:00:53', '2021-02-20 08:00:53'),
(30, 1, 9, 'elitech', 'MATERNAL MED-02', 'Fetal Monitor', 'SM02', 'MATERNAL MED-02', 'KEMENKES RI AKD 21101710864', NULL, NULL, '2021-02-20 08:02:31', '2021-02-20 08:02:31'),
(32, 1, 9, 'elitech', 'PRA-ONE', 'Digital USG Monitor', 'US01', 'PRA-ONE', 'KEMENKES RI AKD 21102410010', NULL, NULL, '2021-02-20 08:06:37', '2021-02-20 08:06:37'),
(33, 1, 9, 'elitech', 'PROMAX', '3D/4D Portable Color Doppler Ultrasound', 'US02', 'PROMAX', 'KEMENKES RI AKD 21102410011', NULL, NULL, '2021-02-20 08:08:08', '2021-02-20 08:08:08'),
(34, 1, 10, 'elitech', 'MFV-01', 'X-Ray Film Viewer', 'MV01', 'MFV-01', 'KEMENKES RI AKD 21501810001', NULL, NULL, '2021-02-20 08:10:24', '2021-02-20 08:10:24'),
(35, 1, 11, 'elitech', 'BABY ONE', 'Baby Scale', 'TD03', 'BABY ONE', 'KEMENKES RI AKD 10901318002', NULL, NULL, '2021-02-20 08:12:05', '2021-02-20 08:12:05'),
(36, 1, 11, 'elitech', 'BABY DIGIT-ONE', 'Timbangan Bayi Mekanik', 'TM01', 'BABY DIGIT-ONE', 'KEMENKES RI AKD 10901410295', NULL, NULL, '2021-02-20 08:13:55', '2021-02-20 08:13:55'),
(37, 1, 11, 'elitech', 'DIGIT-ONE BABY', 'Timbangan Bayi Digital', 'TD05', 'DIGIT-ONE BABY', 'KEMENKES RI AKD 10901410291', NULL, NULL, '2021-02-20 08:15:38', '2021-02-20 08:15:38'),
(38, 1, 11, 'elitech', 'DIGIT-PRO', 'Patient Scale', 'TD02', 'DIGIT-PRO', 'KEMENKES RI AKD 10901318001', NULL, NULL, '2021-02-20 08:18:05', '2021-02-20 08:18:05'),
(39, 1, 12, 'elitech', 'MED-S100', 'SPO2 Simulator', 'MS01', 'MED-S100', 'KEMENKES RI AKD 20401710856', NULL, NULL, '2021-02-20 08:19:27', '2021-02-20 08:19:27'),
(40, 1, 12, 'elitech', 'MED-S200', 'NIBP Simulator', 'MS02', 'MED-S200', 'KEMENKES RI AKD 20501710666', NULL, NULL, '2021-02-20 08:20:55', '2021-02-20 08:20:55'),
(41, 1, 12, 'elitech', 'MED-S400', 'Patient Simulator', 'MS04', 'MED-S400', 'KEMENKES RI AKD 20502710662', NULL, NULL, '2021-02-20 08:22:31', '2021-02-20 08:22:31'),
(42, 1, 13, 'elitech', 'GET 338 UO', 'Sterilisator Kering', 'LS07', 'GET 338 UO', 'KEMENKES RI AKD 20903800291', NULL, NULL, '2021-02-20 08:26:54', '2021-02-20 08:26:54'),
(43, 1, 13, 'elitech', 'GET-80C', 'Sterilisator Kering', 'LS04', 'GET-80C', 'KEMENKES RI AKD 20903800282', NULL, NULL, '2021-02-20 08:28:39', '2021-02-20 08:28:39'),
(44, 1, 13, 'elitech', 'GET-160', 'Sterilisator Kering', 'LS11', 'GET-160', 'KEMENKES RI AKD 20903800287', NULL, NULL, '2021-02-20 08:30:59', '2021-02-20 08:30:59'),
(45, 1, 13, 'elitech', 'ZTP80AS Upgrade', 'Medical Sterilizer', 'LS03', 'ZTP80AS Upgrade', 'KEMENKES RI AKD 20903700359', NULL, NULL, '2021-02-20 08:33:20', '2021-02-20 08:33:20'),
(46, 1, 13, 'elitech', 'ZTP-300', 'Sterilisator Kering', 'LS12', 'ZTP-300', 'KEMENKES RI AKD 20903800288', NULL, NULL, '2021-02-20 08:34:40', '2021-02-20 08:34:40'),
(47, 1, 14, 'elitech', 'ROLL PAPER FOR ECG-300G', 'Kertas ECG / Roll Paper', 'RL01', 'ROLL PAPER FOR ECG-300G', 'KEMENKES RI AKD 21102900255', NULL, NULL, '2021-02-20 08:37:37', '2021-02-20 08:37:37'),
(48, 1, 14, 'elitech', 'ROLL PAPER FOR ECG-1200G', 'Kertas ECG / Roll Paper', 'RL02', 'ROLL PAPER FOR ECG-1200G', 'KEMENKES RI AKD 20502310189', NULL, NULL, '2021-02-20 08:40:38', '2021-02-20 08:40:38'),
(49, 1, 1, 'elitech', 'DP1', 'Ultrasonic Pocket Doppler', 'FD06', 'DP1', 'KEMENKES RI AKD 21101810460', NULL, NULL, '2021-02-25 02:51:47', '2021-02-25 07:56:38'),
(50, 1, 1, 'elitech', 'PM PRO-2', 'Patient Monitor', 'PM09', 'PM PRO-2', 'KEMENKES RI AKD 20502810356', NULL, NULL, '2021-02-25 07:41:39', '2021-03-09 01:17:45'),
(51, 1, 14, 'elitech', 'USG PROMAX Trolley', 'Trolley for Medical Equipment', 'TR02', 'USG PROMAX Trolley', '-', NULL, NULL, '2021-02-25 08:10:13', '2021-03-09 07:41:57'),
(53, NULL, NULL, 'mentor', 'Pensil', 'RAEE', NULL, NULL, NULL, 'fsdfsdf', NULL, '2021-04-05 21:25:32', '2021-04-05 21:25:32'),
(54, NULL, NULL, 'vanward', 'Pensil 2B', 'Pensil 2B Kayu', NULL, NULL, NULL, NULL, NULL, '2021-04-05 21:29:43', '2021-04-05 21:29:43'),
(55, 1, 9, 'elitech', 'CMS-600 PLUS', 'B-Ultrasound Diagnostic System', 'TR05', 'CMS-600 PLUS', 'KEMENKES RI AKD 21102900256', NULL, NULL, '2021-04-15 22:04:32', '2021-04-15 22:04:32'),
(56, 1, 5, 'elitech', 'END-1', 'Needle Destroyer', 'TR05', 'END-1', 'KEMENKES RI AKD 21102900256', 'TEST', NULL, '2021-04-16 02:00:01', '2021-04-16 02:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `stok_produks`
--

CREATE TABLE `stok_produks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `produk_id` bigint(20) UNSIGNED DEFAULT NULL,
  `kode` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stok_tersedia` int(11) DEFAULT NULL,
  `stok_tidak_tersedia` int(11) DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `klasifikasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mata_uang` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pic` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telepon` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `npwp` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nppkp` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pajak_pertama` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_pertama` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_kedua` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_pajak_pertama` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_pajak_kedua` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `divisi_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('online','offline') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `divisi_id`, `nama`, `username`, `email`, `password`, `foto`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 14, 'Dela', 'delait04', 'dela@gmail.com', '$2y$10$iAoWIipcduQIPvYIYxVEs.wDxAMV3dJt.hTh2znjdBtDhY5tWKclO', '', 'offline', NULL, '2021-02-15 23:25:09', '2021-02-15 23:25:09'),
(2, 17, 'Uci Puspita', 'uciprd02', 'uci@gmail.com', '$2y$10$8ge5gLaiS5mKF5Lz6DwhsOUVFMm19ZvW4B0eVAArADBrnSOaGH402', 'Uci Puspita Sari.jpg', 'offline', NULL, '2021-02-15 23:28:06', '2021-02-15 23:28:06'),
(3, 24, 'Farah Diska B', 'farahppic01', 'farah@gmail.com', '$2y$10$p1pBKg1kGFn88H8YwvKPDe7De/RQP4C/szz6tWYcXzZEW4pUm5jMu', NULL, 'offline', NULL, '2021-02-15 23:30:16', '2021-02-15 23:30:16'),
(5, 7, 'Muzdalifah', 'ifaadm05', 'ifa@gmail.com', '$2y$10$97vPP5Zm7sXD0S5BmVxqC.DK/Tzv3/dlZN7V9PF1AactBbNOMompe', NULL, 'online', NULL, '2021-02-24 23:53:37', '2021-02-24 23:53:37'),
(6, 1, 'Ari Wijaya', 'ari_wijaya82', 'ariwijaya.its@gmail.com', '$2y$10$SFitjt0T0Al2UZlq6dslUOP/jZs/E.ZliliZxsmHp8KHtWfgYtar.', NULL, 'online', NULL, '2021-02-25 01:55:17', '2021-02-25 01:55:17'),
(7, 23, 'Septian Achmad S', 'septianqc01', 'septian@gmail.com', '$2y$10$Aut6kCa8dvxbC80bMgJ7GujPhcXW0F0I6/Xrxgg6/78h.84QOVhCm', NULL, 'offline', NULL, '2021-03-02 08:50:35', '2021-03-02 08:50:35'),
(8, 26, 'Nora Novitasari', 'norapenj01', 'nora@gmail.com', '$2y$10$Q9osQ1rCEGIDYasUz6e0s.7IH7AY55bLF361/ZhsdMGYv4wkwwXWa', NULL, 'offline', NULL, '2021-03-17 04:43:06', '2021-03-17 04:43:06'),
(9, 14, 'Wisnu', 'wisnuit03', 'wisnu@gmail.com', '$2y$10$xXSO6ak0QmYLTpIo1IDoq.fROzQu9WhdAEjG80Ki3jHk83POopxz2', NULL, 'offline', NULL, '2021-03-30 04:09:40', '2021-03-30 04:09:40');

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `aksi_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tabel_aksi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aksi` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_logs`
--

INSERT INTO `user_logs` (`id`, `user_id`, `aksi_id`, `tabel_aksi`, `aksi`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 2, '17', 'Perakitan BPPB 0004/CN01/02/21 tanggal 2021-02-26', 'Tambah', '', '2021-02-25 06:50:58', '2021-02-25 06:50:58'),
(2, 1, 'DP1', 'Produk', 'Ubah', '', '2021-02-25 07:56:38', '2021-02-25 07:56:38'),
(3, 1, '0001/PM06/02/21', 'BPPB', 'Hapus', 'salah_input', '2021-02-25 08:28:09', '2021-02-25 08:28:09'),
(4, 1, 'SP-10', 'Produk', 'Hapus', 'salah_input', '2021-02-25 08:33:46', '2021-02-25 08:33:46'),
(5, 2, 'Perakitan 0001/CN01/02/21', 'Perakitan', 'Hapus', 'revisi', '2021-02-25 09:54:49', '2021-02-25 09:54:49'),
(6, 2, 'Perakitan 0001/CN01/02/21', 'Perakitan', 'Hapus', 'salah_input', '2021-02-25 09:55:40', '2021-02-25 09:55:40'),
(7, 2, 'Hasil Perakitan TN01', 'Hasil Perakitan', 'Hapus', 'revisi', '2021-02-26 01:20:16', '2021-02-26 01:20:16'),
(8, 2, 'Perakitan 0006/CN01/02/21', 'Perakitan', 'Hapus', 'pembatalan', '2021-02-26 01:23:12', '2021-02-26 01:23:12'),
(9, 2, '25', 'Perakitan BPPB 0008/CN01/02/21 tanggal 2021-02-26', 'Tambah', '', '2021-02-26 07:54:53', '2021-02-26 07:54:53'),
(10, 2, 'Perakitan 0004/CN01/02/21', 'Perakitan', 'Hapus', 'revisi', '2021-03-03 01:50:01', '2021-03-03 01:50:01'),
(11, 2, 'Perakitan 0004/CN01/02/21', 'Perakitan', 'Hapus', 'revisi', '2021-03-03 01:50:10', '2021-03-03 01:50:10'),
(12, 2, 'Perakitan 0004/CN01/02/21', 'Perakitan', 'Hapus', 'revisi', '2021-03-03 01:50:17', '2021-03-03 01:50:17'),
(13, 2, 'Perakitan 0004/CN01/02/21', 'Perakitan', 'Hapus', 'revisi', '2021-03-03 01:50:23', '2021-03-03 01:50:23'),
(14, 2, 'Perakitan 0004/CN01/02/21', 'Perakitan', 'Hapus', 'revisi', '2021-03-03 01:50:36', '2021-03-03 01:50:36'),
(15, 1, '0006/CN01/02/21', 'BPPB', 'Hapus', 'revisi', '2021-03-08 08:47:34', '2021-03-08 08:47:34'),
(16, 1, 'PM PRO-2', 'Produk', 'Ubah', '', '2021-03-09 01:17:45', '2021-03-09 01:17:45'),
(17, 1, 'yes', 'Produk', 'Tambah', '', '2021-03-09 04:05:34', '2021-03-09 04:05:34'),
(18, 1, 'yes', 'Produk', 'Hapus', 'salah_input', '2021-03-09 04:06:28', '2021-03-09 04:06:28'),
(19, 1, 'USG PROMAX Trolley', 'Produk', 'Ubah', '', '2021-03-09 04:16:35', '2021-03-09 04:16:35'),
(20, 3, 'USG PROMAX Trolley', 'Produk', 'Ubah', '', '2021-03-09 07:41:57', '2021-03-09 07:41:57'),
(21, 2, 'Hasil Perakitan TN04', 'Hasil Perakitan', 'Hapus', 'revisi', '2021-03-10 04:28:54', '2021-03-10 04:28:54'),
(22, 2, '7', 'Perakitan BPPB 0001/OC01/02/21 tanggal 2021-03-12', 'Tambah', '', '2021-03-12 04:26:26', '2021-03-12 04:26:26'),
(23, 2, '8', 'Perakitan BPPB 0001/OC01/02/21 tanggal 2021-03-12', 'Tambah', '', '2021-03-12 06:02:51', '2021-03-12 06:02:51'),
(24, 2, '10', 'Perakitan BPPB 0001/SP02/02/21 tanggal 2021-03-12', 'Tambah', '', '2021-03-12 06:15:21', '2021-03-12 06:15:21'),
(25, 2, '7', 'Perakitan BPPB 0001/OC01/02/21 tanggal 2021-03-12', 'Tambah', '', '2021-03-12 06:29:02', '2021-03-12 06:29:02'),
(26, 2, '9', 'Perakitan BPPB 0002/SP01/02/21 tanggal 2021-03-13', 'Tambah', '', '2021-03-12 07:37:04', '2021-03-12 07:37:04'),
(27, 2, 'Perakitan ', 'Perakitan', 'Hapus', 'salah_input', '2021-03-12 07:38:47', '2021-03-12 07:38:47'),
(28, 2, 'Perakitan ', 'Perakitan', 'Hapus', 'revisi', '2021-03-12 07:40:48', '2021-03-12 07:40:48'),
(29, 2, 'Perakitan ', 'Perakitan', 'Hapus', 'revisi', '2021-03-12 08:15:08', '2021-03-12 08:15:08'),
(30, 2, 'Perakitan ', 'Perakitan', 'Hapus', 'revisi', '2021-03-12 08:15:28', '2021-03-12 08:15:28'),
(31, 2, '17', 'Perakitan BPPB 0004/CN01/02/21 tanggal 2021-03-15', 'Tambah', '', '2021-03-15 01:46:24', '2021-03-15 01:46:24'),
(32, 1, 'INV14030001 Kursi Merah', 'Inventory', 'Hapus', 'salah_input', '2021-03-23 08:30:40', '2021-03-23 08:30:40'),
(33, 1, 'Peminjaman oleh Dela ke Inventory milik IT untuk barang Kursi Bulat, tanggal 2021-03-31', 'Detail Peminjaman', 'Hapus', 'revisi', '2021-03-31 09:10:13', '2021-03-31 09:10:13'),
(34, 1, 'Perbaikan Jaringan tanggal2021-04-08, dengan Penanggung Jawab Bartolomeus Wisnu Setyo Wibowo Sunadi', 'Peminjaman Karyawan', 'Hapus', 'salah_input', '2021-04-08 18:50:25', '2021-04-08 18:50:25'),
(35, 2, 'Perakitan ', 'Perakitan', 'Hapus', 'revisi', '2021-04-14 00:58:08', '2021-04-14 00:58:08'),
(36, 2, 'Hasil Perakitan TN02', 'Hasil Perakitan', 'Hapus', 'salah_input', '2021-04-14 01:15:46', '2021-04-14 01:15:46'),
(37, 2, 'Perakitan ', 'Perakitan', 'Hapus', 'revisi', '2021-04-14 01:49:52', '2021-04-14 01:49:52'),
(38, 2, 'CMS-600 PLUS', 'Produk', 'Tambah', '', '2021-04-15 22:04:32', '2021-04-15 22:04:32'),
(39, 2, 'END-1', 'Produk', 'Tambah', '', '2021-04-16 02:00:01', '2021-04-16 02:00:01'),
(40, 2, '28', 'Perakitan BPPB 0001/TR05/04/21 tanggal 2021-04-19', 'Tambah', '', '2021-04-18 18:15:31', '2021-04-18 18:15:31'),
(41, 2, '29', 'Perakitan BPPB 0001/TR05/04/21 tanggal 2021-04-19', 'Tambah', '', '2021-04-18 19:22:09', '2021-04-18 19:22:09'),
(42, 2, '29', 'Perakitan BPPB 0001/TR05/04/21 tanggal 2021-04-19', 'Tambah', '', '2021-04-18 19:40:33', '2021-04-18 19:40:33'),
(43, 2, 'Hasil Perakitan FRIN00003, untuk BPPB 0001/TR05/04/21', 'Hasil Perakitan', 'Hapus', 'pembatalan', '2021-04-18 19:52:02', '2021-04-18 19:52:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill_of_materials`
--
ALTER TABLE `bill_of_materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_of_materials_detail_produk_id_foreign` (`detail_produk_id`),
  ADD KEY `bill_of_materials_part_eng_id_foreign` (`part_eng_id`);

--
-- Indexes for table `bppbs`
--
ALTER TABLE `bppbs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bppbs_divisi_id_foreign` (`divisi_id`),
  ADD KEY `bppbs_detail_produk_id_foreign` (`detail_produk_id`);

--
-- Indexes for table `data_stok_produks`
--
ALTER TABLE `data_stok_produks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_stok_produks_stok_produk_id_foreign` (`stok_produk_id`);

--
-- Indexes for table `detail_ecommerces`
--
ALTER TABLE `detail_ecommerces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_ekatjuals`
--
ALTER TABLE `detail_ekatjuals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_inventories`
--
ALTER TABLE `detail_inventories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_inventories_inventory_id_foreign` (`inventory_id`);

--
-- Indexes for table `detail_offlines`
--
ALTER TABLE `detail_offlines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_paket_produks`
--
ALTER TABLE `detail_paket_produks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_paket_produks_produk_id_foreign` (`produk_id`),
  ADD KEY `detail_paket_produks_paket_produk_id_foreign` (`paket_produk_id`);

--
-- Indexes for table `detail_peminjaman_karyawans`
--
ALTER TABLE `detail_peminjaman_karyawans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_peminjaman_karyawans_peminjaman_karyawan_id_foreign` (`peminjaman_karyawan_id`),
  ADD KEY `detail_peminjaman_karyawans_karyawan_id_foreign` (`karyawan_id`);

--
-- Indexes for table `detail_produks`
--
ALTER TABLE `detail_produks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_produks_produk_id_foreign` (`produk_id`);

--
-- Indexes for table `distributors`
--
ALTER TABLE `distributors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisis`
--
ALTER TABLE `divisis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisi_inventories`
--
ALTER TABLE `divisi_inventories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `divisi_inventories_divisi_id_foreign` (`divisi_id`),
  ADD KEY `divisi_inventories_pic_id_foreign` (`pic_id`);

--
-- Indexes for table `ecommerces`
--
ALTER TABLE `ecommerces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ekatjuals`
--
ALTER TABLE `ekatjuals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hasil_pemeriksaan_rakits`
--
ALTER TABLE `hasil_pemeriksaan_rakits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hasil_pemeriksaan_rakits_pemeriksaan_rakit_id_foreign` (`pemeriksaan_rakit_id`),
  ADD KEY `hasil_pemeriksaan_rakits_hasil_perakitan_id_foreign` (`hasil_perakitan_id`);

--
-- Indexes for table `hasil_perakitans`
--
ALTER TABLE `hasil_perakitans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hasil_perakitans_perakitan_id_foreign` (`perakitan_id`);

--
-- Indexes for table `histori_hasil_perakitans`
--
ALTER TABLE `histori_hasil_perakitans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `histori_hasil_perakitans_hasil_perakitan_id_foreign` (`hasil_perakitan_id`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventories_divisi_inventory_id_foreign` (`divisi_inventory_id`);

--
-- Indexes for table `jasa_ekss`
--
ALTER TABLE `jasa_ekss`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `karyawans`
--
ALTER TABLE `karyawans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `karyawans_divisi_id_foreign` (`divisi_id`);

--
-- Indexes for table `kategori_produks`
--
ALTER TABLE `kategori_produks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_kategoris_kategori_id_foreign` (`kelompok_produk_id`);

--
-- Indexes for table `kelompok_produks`
--
ALTER TABLE `kelompok_produks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `notifikasis`
--
ALTER TABLE `notifikasis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifikasis_pengirim_id_foreign` (`pengirim_id`),
  ADD KEY `notifikasis_penerima_id_foreign` (`penerima_id`);

--
-- Indexes for table `offlines`
--
ALTER TABLE `offlines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paket_produks`
--
ALTER TABLE `paket_produks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `part_engs`
--
ALTER TABLE `part_engs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `part_engs_part_id_foreign` (`part_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pemeriksaan_rakits`
--
ALTER TABLE `pemeriksaan_rakits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemeriksaan_rakits_perakitan_id_foreign` (`perakitan_id`);

--
-- Indexes for table `peminjaman_alats`
--
ALTER TABLE `peminjaman_alats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peminjamans_peminjam_id_foreign` (`peminjam_id`),
  ADD KEY `peminjamans_divisi_inventory_id_foreign` (`divisi_inventory_id`),
  ADD KEY `peminjamans_inventory_id_foreign` (`inventory_id`);

--
-- Indexes for table `peminjaman_karyawans`
--
ALTER TABLE `peminjaman_karyawans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peminjaman_karyawans_penanggung_jawab_id_foreign` (`penanggung_jawab_id`),
  ADD KEY `peminjaman_karyawans_user_id_foreign` (`user_id`);

--
-- Indexes for table `penawaran_ecoms`
--
ALTER TABLE `penawaran_ecoms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penawaran_offlines`
--
ALTER TABLE `penawaran_offlines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengemasans`
--
ALTER TABLE `pengemasans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengemasans_bppb_id_foreign` (`bppb_id`),
  ADD KEY `pengemasans_pic_id_foreign` (`pic_id`);

--
-- Indexes for table `perakitans`
--
ALTER TABLE `perakitans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `perakitans_bppb_id_foreign` (`bppb_id`),
  ADD KEY `perakitans_pic_id_foreign` (`pic_id`);

--
-- Indexes for table `perakitan_karyawans`
--
ALTER TABLE `perakitan_karyawans`
  ADD KEY `hasil_perakitan_karyawans_karyawan_id_foreign` (`karyawan_id`),
  ADD KEY `hasil_perakitan_karyawans_perakitan_id_foreign` (`perakitan_id`);

--
-- Indexes for table `podo_offlines`
--
ALTER TABLE `podo_offlines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `podo_onlines`
--
ALTER TABLE `podo_onlines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produks`
--
ALTER TABLE `produks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produks_sub_kategori_id_foreign` (`kategori_id`),
  ADD KEY `produks_kategori_id_foreign` (`kelompok_produk_id`);

--
-- Indexes for table `stok_produks`
--
ALTER TABLE `stok_produks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stok_produks_produk_id_foreign` (`produk_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suppliers_kode_unique` (`kode`),
  ADD UNIQUE KEY `suppliers_telepon_unique` (`telepon`),
  ADD UNIQUE KEY `suppliers_fax_unique` (`fax`),
  ADD UNIQUE KEY `suppliers_nama_unique` (`nama`) USING HASH;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_divisi_id_foreign` (`divisi_id`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_logs_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill_of_materials`
--
ALTER TABLE `bill_of_materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `bppbs`
--
ALTER TABLE `bppbs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `data_stok_produks`
--
ALTER TABLE `data_stok_produks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_ecommerces`
--
ALTER TABLE `detail_ecommerces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `detail_ekatjuals`
--
ALTER TABLE `detail_ekatjuals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `detail_inventories`
--
ALTER TABLE `detail_inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_offlines`
--
ALTER TABLE `detail_offlines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `detail_paket_produks`
--
ALTER TABLE `detail_paket_produks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `detail_peminjaman_karyawans`
--
ALTER TABLE `detail_peminjaman_karyawans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `detail_produks`
--
ALTER TABLE `detail_produks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `distributors`
--
ALTER TABLE `distributors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `divisis`
--
ALTER TABLE `divisis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `divisi_inventories`
--
ALTER TABLE `divisi_inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ecommerces`
--
ALTER TABLE `ecommerces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `ekatjuals`
--
ALTER TABLE `ekatjuals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hasil_pemeriksaan_rakits`
--
ALTER TABLE `hasil_pemeriksaan_rakits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hasil_perakitans`
--
ALTER TABLE `hasil_perakitans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `histori_hasil_perakitans`
--
ALTER TABLE `histori_hasil_perakitans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jasa_ekss`
--
ALTER TABLE `jasa_ekss`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `karyawans`
--
ALTER TABLE `karyawans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `kategori_produks`
--
ALTER TABLE `kategori_produks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `kelompok_produks`
--
ALTER TABLE `kelompok_produks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `notifikasis`
--
ALTER TABLE `notifikasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `offlines`
--
ALTER TABLE `offlines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `paket_produks`
--
ALTER TABLE `paket_produks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `parts`
--
ALTER TABLE `parts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=404;

--
-- AUTO_INCREMENT for table `part_engs`
--
ALTER TABLE `part_engs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pemeriksaan_rakits`
--
ALTER TABLE `pemeriksaan_rakits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `peminjaman_alats`
--
ALTER TABLE `peminjaman_alats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `peminjaman_karyawans`
--
ALTER TABLE `peminjaman_karyawans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `penawaran_ecoms`
--
ALTER TABLE `penawaran_ecoms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `penawaran_offlines`
--
ALTER TABLE `penawaran_offlines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pengemasans`
--
ALTER TABLE `pengemasans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `perakitans`
--
ALTER TABLE `perakitans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `podo_offlines`
--
ALTER TABLE `podo_offlines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `podo_onlines`
--
ALTER TABLE `podo_onlines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `produks`
--
ALTER TABLE `produks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `stok_produks`
--
ALTER TABLE `stok_produks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill_of_materials`
--
ALTER TABLE `bill_of_materials`
  ADD CONSTRAINT `bill_of_materials_detail_produk_id_foreign` FOREIGN KEY (`detail_produk_id`) REFERENCES `detail_produks` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `bill_of_materials_part_eng_id_foreign` FOREIGN KEY (`part_eng_id`) REFERENCES `part_engs` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `bppbs`
--
ALTER TABLE `bppbs`
  ADD CONSTRAINT `bppbs_detail_produk_id_foreign` FOREIGN KEY (`detail_produk_id`) REFERENCES `detail_produks` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `bppbs_divisi_id_foreign` FOREIGN KEY (`divisi_id`) REFERENCES `divisis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `data_stok_produks`
--
ALTER TABLE `data_stok_produks`
  ADD CONSTRAINT `data_stok_produks_stok_produk_id_foreign` FOREIGN KEY (`stok_produk_id`) REFERENCES `stok_produks` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `detail_inventories`
--
ALTER TABLE `detail_inventories`
  ADD CONSTRAINT `detail_inventories_inventory_id_foreign` FOREIGN KEY (`inventory_id`) REFERENCES `inventories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `detail_paket_produks`
--
ALTER TABLE `detail_paket_produks`
  ADD CONSTRAINT `detail_paket_produks_paket_produk_id_foreign` FOREIGN KEY (`paket_produk_id`) REFERENCES `paket_produks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_paket_produks_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_peminjaman_karyawans`
--
ALTER TABLE `detail_peminjaman_karyawans`
  ADD CONSTRAINT `detail_peminjaman_karyawans_karyawan_id_foreign` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawans` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `detail_peminjaman_karyawans_peminjaman_karyawan_id_foreign` FOREIGN KEY (`peminjaman_karyawan_id`) REFERENCES `peminjaman_karyawans` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `detail_produks`
--
ALTER TABLE `detail_produks`
  ADD CONSTRAINT `detail_produks_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produks` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `divisi_inventories`
--
ALTER TABLE `divisi_inventories`
  ADD CONSTRAINT `divisi_inventories_divisi_id_foreign` FOREIGN KEY (`divisi_id`) REFERENCES `divisis` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `divisi_inventories_pic_id_foreign` FOREIGN KEY (`pic_id`) REFERENCES `karyawans` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `hasil_pemeriksaan_rakits`
--
ALTER TABLE `hasil_pemeriksaan_rakits`
  ADD CONSTRAINT `hasil_pemeriksaan_rakits_hasil_perakitan_id_foreign` FOREIGN KEY (`hasil_perakitan_id`) REFERENCES `hasil_perakitans` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `hasil_pemeriksaan_rakits_pemeriksaan_rakit_id_foreign` FOREIGN KEY (`pemeriksaan_rakit_id`) REFERENCES `pemeriksaan_rakits` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `hasil_perakitans`
--
ALTER TABLE `hasil_perakitans`
  ADD CONSTRAINT `hasil_perakitans_perakitan_id_foreign` FOREIGN KEY (`perakitan_id`) REFERENCES `perakitans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `histori_hasil_perakitans`
--
ALTER TABLE `histori_hasil_perakitans`
  ADD CONSTRAINT `histori_hasil_perakitans_hasil_perakitan_id_foreign` FOREIGN KEY (`hasil_perakitan_id`) REFERENCES `hasil_perakitans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `inventories`
--
ALTER TABLE `inventories`
  ADD CONSTRAINT `inventories_divisi_inventory_id_foreign` FOREIGN KEY (`divisi_inventory_id`) REFERENCES `divisi_inventories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `karyawans`
--
ALTER TABLE `karyawans`
  ADD CONSTRAINT `karyawans_divisi_id_foreign` FOREIGN KEY (`divisi_id`) REFERENCES `divisis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kategori_produks`
--
ALTER TABLE `kategori_produks`
  ADD CONSTRAINT `sub_kategoris_kategori_id_foreign` FOREIGN KEY (`kelompok_produk_id`) REFERENCES `kelompok_produks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifikasis`
--
ALTER TABLE `notifikasis`
  ADD CONSTRAINT `notifikasis_penerima_id_foreign` FOREIGN KEY (`penerima_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifikasis_pengirim_id_foreign` FOREIGN KEY (`pengirim_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `part_engs`
--
ALTER TABLE `part_engs`
  ADD CONSTRAINT `part_engs_part_id_foreign` FOREIGN KEY (`part_id`) REFERENCES `parts` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `pemeriksaan_rakits`
--
ALTER TABLE `pemeriksaan_rakits`
  ADD CONSTRAINT `pemeriksaan_rakits_perakitan_id_foreign` FOREIGN KEY (`perakitan_id`) REFERENCES `perakitans` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `peminjaman_alats`
--
ALTER TABLE `peminjaman_alats`
  ADD CONSTRAINT `peminjamans_divisi_inventory_id_foreign` FOREIGN KEY (`divisi_inventory_id`) REFERENCES `divisi_inventories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `peminjamans_inventory_id_foreign` FOREIGN KEY (`inventory_id`) REFERENCES `inventories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `peminjamans_peminjam_id_foreign` FOREIGN KEY (`peminjam_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `peminjaman_karyawans`
--
ALTER TABLE `peminjaman_karyawans`
  ADD CONSTRAINT `peminjaman_karyawans_penanggung_jawab_id_foreign` FOREIGN KEY (`penanggung_jawab_id`) REFERENCES `karyawans` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `peminjaman_karyawans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `pengemasans`
--
ALTER TABLE `pengemasans`
  ADD CONSTRAINT `pengemasans_bppb_id_foreign` FOREIGN KEY (`bppb_id`) REFERENCES `bppbs` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `pengemasans_pic_id_foreign` FOREIGN KEY (`pic_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `perakitans`
--
ALTER TABLE `perakitans`
  ADD CONSTRAINT `perakitans_bppb_id_foreign` FOREIGN KEY (`bppb_id`) REFERENCES `bppbs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `perakitans_pic_id_foreign` FOREIGN KEY (`pic_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `perakitan_karyawans`
--
ALTER TABLE `perakitan_karyawans`
  ADD CONSTRAINT `hasil_perakitan_karyawans_karyawan_id_foreign` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hasil_perakitan_karyawans_perakitan_id_foreign` FOREIGN KEY (`perakitan_id`) REFERENCES `perakitans` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `produks`
--
ALTER TABLE `produks`
  ADD CONSTRAINT `produks_kategori_id_foreign` FOREIGN KEY (`kelompok_produk_id`) REFERENCES `kelompok_produks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `produks_sub_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori_produks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stok_produks`
--
ALTER TABLE `stok_produks`
  ADD CONSTRAINT `stok_produks_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produks` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_divisi_id_foreign` FOREIGN KEY (`divisi_id`) REFERENCES `divisis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD CONSTRAINT `user_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
