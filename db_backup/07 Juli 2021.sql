-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2021 at 11:09 AM
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
-- Table structure for table `analisa_ps_pengemasans`
--

CREATE TABLE `analisa_ps_pengemasans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hasil_pengemasan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `analisa` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `realisasi_pengerjaan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tindak_lanjut` enum('operator','perbaikan','karantina') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `analisa_ps_pengemasans`
--

INSERT INTO `analisa_ps_pengemasans` (`id`, `hasil_pengemasan_id`, `analisa`, `realisasi_pengerjaan`, `tindak_lanjut`, `created_at`, `updated_at`) VALUES
(2, 18, 'LCD Lecet', 'Mengganti LCD Baru', 'perbaikan', '2021-07-05 00:20:59', '2021-07-05 00:20:59');

-- --------------------------------------------------------

--
-- Table structure for table `analisa_ps_pengemasan_parts`
--

CREATE TABLE `analisa_ps_pengemasan_parts` (
  `bill_of_material_id` bigint(20) UNSIGNED DEFAULT NULL,
  `analisa_ps_pengemasan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `analisa_ps_pengemasan_parts`
--

INSERT INTO `analisa_ps_pengemasan_parts` (`bill_of_material_id`, `analisa_ps_pengemasan_id`, `created_at`, `updated_at`) VALUES
(218, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `analisa_ps_pengujians`
--

CREATE TABLE `analisa_ps_pengujians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hasil_monitoring_proses_id` bigint(20) UNSIGNED DEFAULT NULL,
  `analisa` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `realisasi_pengerjaan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tindak_lanjut` enum('operator','perbaikan','karantina') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `analisa_ps_pengujians`
--

INSERT INTO `analisa_ps_pengujians` (`id`, `hasil_monitoring_proses_id`, `analisa`, `realisasi_pengerjaan`, `tindak_lanjut`, `created_at`, `updated_at`) VALUES
(1, 45, 'TES', 'TES', 'perbaikan', '2021-06-21 04:43:49', '2021-06-21 04:43:49');

-- --------------------------------------------------------

--
-- Table structure for table `analisa_ps_pengujian_parts`
--

CREATE TABLE `analisa_ps_pengujian_parts` (
  `bill_of_material_id` bigint(20) UNSIGNED DEFAULT NULL,
  `analisa_ps_pengujian_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `analisa_ps_pengujian_parts`
--

INSERT INTO `analisa_ps_pengujian_parts` (`bill_of_material_id`, `analisa_ps_pengujian_id`, `created_at`, `updated_at`) VALUES
(227, 1, NULL, NULL),
(228, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `analisa_ps_perakitans`
--

CREATE TABLE `analisa_ps_perakitans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ppic_id` bigint(20) UNSIGNED DEFAULT NULL,
  `hasil_perakitan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `analisa` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `realisasi_pengerjaan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tindak_lanjut` enum('operator','perbaikan','karantina') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `analisa_ps_perakitans`
--

INSERT INTO `analisa_ps_perakitans` (`id`, `ppic_id`, `hasil_perakitan_id`, `analisa`, `realisasi_pengerjaan`, `tindak_lanjut`, `created_at`, `updated_at`) VALUES
(2, NULL, 91, 'Casing Patah', 'Mengganti Casing', 'operator', '2021-06-10 09:50:46', '2021-06-10 09:50:46'),
(3, NULL, 93, 'Baut patah', 'Mengganti dengan baut yang baru', 'operator', '2021-06-15 04:55:15', '2021-06-15 04:55:15'),
(7, NULL, 93, 'Casing Patah', 'Ganti Casing', 'perbaikan', '2021-06-15 06:51:25', '2021-06-15 06:51:25');

-- --------------------------------------------------------

--
-- Table structure for table `analisa_ps_perakitan_parts`
--

CREATE TABLE `analisa_ps_perakitan_parts` (
  `bill_of_material_id` bigint(20) UNSIGNED DEFAULT NULL,
  `analisa_ps_perakitan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `analisa_ps_perakitan_parts`
--

INSERT INTO `analisa_ps_perakitan_parts` (`bill_of_material_id`, `analisa_ps_perakitan_id`, `created_at`, `updated_at`) VALUES
(217, 2, NULL, NULL),
(219, 2, NULL, NULL),
(242, 3, NULL, NULL),
(217, NULL, NULL, NULL),
(217, NULL, NULL, NULL),
(217, NULL, NULL, NULL),
(217, 7, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `berat_karyawans`
--

CREATE TABLE `berat_karyawans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `karyawan_id` int(11) NOT NULL,
  `tgl_cek` date NOT NULL,
  `berat` double NOT NULL,
  `lemak` double DEFAULT NULL,
  `kandungan_air` double DEFAULT NULL,
  `otot` double DEFAULT NULL,
  `tulang` double DEFAULT NULL,
  `kalori` double DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `berat_karyawans`
--

INSERT INTO `berat_karyawans` (`id`, `karyawan_id`, `tgl_cek`, `berat`, `lemak`, `kandungan_air`, `otot`, `tulang`, `kalori`, `keterangan`, `created_at`, `updated_at`) VALUES
(4, 7, '2021-06-07', 62, 34, 34, 23, 23, 700, NULL, '2021-06-07 09:21:28', '2021-06-08 04:21:12'),
(5, 6, '2021-06-07', 57, 37, 53, 35, 23, 800, NULL, '2021-06-07 09:21:28', '2021-06-07 09:21:28'),
(6, 7, '2021-06-08', 70, 65, 20, 1, 30, 1000, NULL, '2021-06-08 02:16:33', '2021-06-08 02:16:33'),
(7, 6, '2021-06-08', 65, 37, 1, 20, 25, 2000, 'd', '2021-06-08 02:16:33', '2021-06-08 04:21:24'),
(8, 7, '2021-06-23', 80, 35, NULL, NULL, NULL, NULL, NULL, '2021-06-09 01:18:07', '2021-06-09 01:18:07'),
(9, 6, '2021-06-23', 90, 34, 20, NULL, NULL, NULL, NULL, '2021-06-09 01:18:07', '2021-06-09 01:18:32'),
(10, 46, '2021-06-17', 100, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-16 04:32:22', '2021-06-16 04:32:22'),
(11, 18, '2021-06-17', 40, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-16 04:32:22', '2021-06-16 04:32:22'),
(12, 88, '2021-06-17', 58, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-16 04:32:22', '2021-06-16 04:32:22'),
(13, 46, '2021-06-23', 78, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-16 04:34:20', '2021-06-16 04:34:20'),
(14, 18, '2021-06-23', 80, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-16 04:34:20', '2021-06-16 04:34:20'),
(15, 88, '2021-06-23', 40, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-16 04:34:20', '2021-06-16 04:34:20'),
(16, 46, '2021-06-25', 70, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-16 04:36:39', '2021-06-16 04:36:39'),
(17, 18, '2021-06-25', 60, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-16 04:36:39', '2021-06-16 04:36:39'),
(18, 88, '2021-06-25', 50, NULL, NULL, NULL, NULL, NULL, NULL, '2021-06-16 04:36:39', '2021-06-16 04:36:39');

-- --------------------------------------------------------

--
-- Table structure for table `bill_of_materials`
--

CREATE TABLE `bill_of_materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `produk_bill_of_material_id` bigint(20) UNSIGNED DEFAULT NULL,
  `part_eng_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `satuan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('ada','tidak_ada') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bill_of_materials`
--

INSERT INTO `bill_of_materials` (`id`, `produk_bill_of_material_id`, `part_eng_id`, `model`, `jumlah`, `satuan`, `status`, `created_at`, `updated_at`) VALUES
(217, 1, 'A10140401', NULL, 1, NULL, NULL, NULL, NULL),
(218, 1, 'A10140404', NULL, 1, NULL, NULL, NULL, NULL),
(219, 1, 'A10140405', NULL, 1, NULL, NULL, NULL, NULL),
(220, 1, 'A10140406', NULL, 1, NULL, NULL, NULL, NULL),
(221, 1, 'A10140407', NULL, 1, NULL, NULL, NULL, NULL),
(222, 1, 'A10140408', NULL, 1, NULL, NULL, NULL, NULL),
(223, 1, 'A10140409', NULL, 1, NULL, NULL, NULL, NULL),
(224, 1, 'B10140401', NULL, 1, NULL, NULL, NULL, NULL),
(225, 1, 'B10140402', NULL, 1, NULL, NULL, NULL, NULL),
(226, 1, 'B10140403', NULL, 1, NULL, NULL, NULL, NULL),
(227, 1, 'B10140404', NULL, 2, NULL, NULL, NULL, NULL),
(228, 1, 'B10140405', NULL, 1, NULL, NULL, NULL, NULL),
(229, 1, 'B10140406', NULL, 1, NULL, NULL, NULL, NULL),
(230, 1, 'B10140407', NULL, 1, NULL, NULL, NULL, NULL),
(231, 1, 'C10140401', NULL, 1, NULL, NULL, NULL, NULL),
(232, 1, 'C10140402', NULL, 1, NULL, NULL, NULL, NULL),
(233, 1, 'C10140403', NULL, 1, NULL, NULL, NULL, NULL),
(234, 1, 'C10140404', NULL, 1, NULL, NULL, NULL, NULL),
(235, 1, 'C10140405', NULL, 1, NULL, NULL, NULL, NULL),
(236, 1, 'C10140406', NULL, 1, NULL, NULL, NULL, NULL),
(237, 1, 'C10140407', NULL, 1, NULL, NULL, NULL, NULL),
(238, 1, 'C10140408', NULL, 1, NULL, NULL, NULL, NULL),
(239, 1, 'C10140409', NULL, 2, NULL, NULL, NULL, NULL),
(240, 1, 'C101404', NULL, 1, NULL, NULL, NULL, NULL),
(241, 1, 'S16061', NULL, 1, NULL, NULL, NULL, NULL),
(242, 1, 'S012030130200060', NULL, 2, NULL, NULL, NULL, NULL),
(243, 2, 'A10140401', NULL, 1, NULL, NULL, NULL, NULL),
(244, 2, 'A10140404', NULL, 1, NULL, NULL, NULL, NULL),
(245, 2, 'A10140405', NULL, 1, NULL, NULL, NULL, NULL),
(246, 2, 'A10140406', NULL, 1, NULL, NULL, NULL, NULL),
(247, 2, 'A10140407', NULL, 1, NULL, NULL, NULL, NULL),
(248, 2, 'A10140408', NULL, 1, NULL, NULL, NULL, NULL),
(249, 2, 'A10140409', NULL, 1, NULL, NULL, NULL, NULL),
(250, 2, 'B10140401', NULL, 1, NULL, NULL, NULL, NULL),
(251, 2, 'B10140402', NULL, 1, NULL, NULL, NULL, NULL),
(252, 2, 'B10140403', NULL, 1, NULL, NULL, NULL, NULL),
(253, 2, 'B10140404', NULL, 2, NULL, NULL, NULL, NULL),
(254, 2, 'B10140405', NULL, 1, NULL, NULL, NULL, NULL),
(255, 2, 'B10140406', NULL, 1, NULL, NULL, NULL, NULL),
(256, 2, 'B10140407', NULL, 1, NULL, NULL, NULL, NULL),
(257, 2, 'C10140401', NULL, 1, NULL, NULL, NULL, NULL),
(258, 2, 'C10140402', NULL, 1, NULL, NULL, NULL, NULL),
(259, 2, 'C10140403', NULL, 1, NULL, NULL, NULL, NULL),
(260, 2, 'C10140404', NULL, 1, NULL, NULL, NULL, NULL),
(261, 2, 'C10140405', NULL, 1, NULL, NULL, NULL, NULL),
(262, 2, 'C10140406', NULL, 1, NULL, NULL, NULL, NULL),
(263, 2, 'C10140407', NULL, 1, NULL, NULL, NULL, NULL),
(264, 2, 'C10140408', NULL, 1, NULL, NULL, NULL, NULL),
(265, 2, 'C10140409', NULL, 2, NULL, NULL, NULL, NULL),
(266, 3, 'A10140402', NULL, 1, NULL, NULL, NULL, NULL),
(267, 3, 'A10140404', NULL, 1, NULL, NULL, NULL, NULL),
(268, 3, 'A10140405', NULL, 1, NULL, NULL, NULL, NULL),
(269, 3, 'A10140406', NULL, 1, NULL, NULL, NULL, NULL),
(270, 3, 'A10140407', NULL, 1, NULL, NULL, NULL, NULL),
(271, 3, 'A10140408', NULL, 1, NULL, NULL, NULL, NULL),
(272, 3, 'A10140409', NULL, 1, NULL, NULL, NULL, NULL),
(273, 3, 'B10140401', NULL, 1, NULL, NULL, NULL, NULL),
(274, 3, 'B10140402', NULL, 1, NULL, NULL, NULL, NULL),
(275, 3, 'B10140403', NULL, 1, NULL, NULL, NULL, NULL),
(276, 3, 'B10140404', NULL, 2, NULL, NULL, NULL, NULL),
(277, 3, 'B10140405', NULL, 1, NULL, NULL, NULL, NULL),
(278, 3, 'B10140406', NULL, 1, NULL, NULL, NULL, NULL),
(279, 3, 'B10140407', NULL, 1, NULL, NULL, NULL, NULL),
(280, 3, 'C10140401', NULL, 1, NULL, NULL, NULL, NULL),
(281, 3, 'C10140402', NULL, 1, NULL, NULL, NULL, NULL),
(282, 3, 'C10140403', NULL, 1, NULL, NULL, NULL, NULL),
(283, 3, 'C10140404', NULL, 1, NULL, NULL, NULL, NULL),
(284, 3, 'C10140405', NULL, 1, NULL, NULL, NULL, NULL),
(285, 3, 'C10140406', NULL, 1, NULL, NULL, NULL, NULL),
(286, 3, 'C10140407', NULL, 1, NULL, NULL, NULL, NULL),
(287, 3, 'C10140408', NULL, 1, NULL, NULL, NULL, NULL),
(288, 3, 'C10140409', NULL, 2, NULL, NULL, NULL, NULL),
(289, 3, 'C101404', NULL, 1, NULL, NULL, NULL, NULL),
(290, 3, 'S16061', NULL, 1, NULL, NULL, NULL, NULL),
(291, 3, 'S012030130200060', NULL, 2, NULL, NULL, NULL, NULL),
(292, 4, 'A10140402', NULL, 1, NULL, NULL, NULL, NULL),
(293, 4, 'A10140404', NULL, 1, NULL, NULL, NULL, NULL),
(294, 4, 'A10140405', NULL, 1, NULL, NULL, NULL, NULL),
(295, 4, 'A10140406', NULL, 1, NULL, NULL, NULL, NULL),
(296, 4, 'A10140407', NULL, 1, NULL, NULL, NULL, NULL),
(297, 4, 'A10140408', NULL, 1, NULL, NULL, NULL, NULL),
(298, 4, 'A10140409', NULL, 1, NULL, NULL, NULL, NULL),
(299, 4, 'B10140401', NULL, 1, NULL, NULL, NULL, NULL),
(300, 4, 'B10140402', NULL, 1, NULL, NULL, NULL, NULL),
(301, 4, 'B10140403', NULL, 1, NULL, NULL, NULL, NULL),
(302, 4, 'B10140404', NULL, 2, NULL, NULL, NULL, NULL),
(303, 4, 'B10140405', NULL, 1, NULL, NULL, NULL, NULL),
(304, 4, 'B10140406', NULL, 1, NULL, NULL, NULL, NULL),
(305, 4, 'B10140407', NULL, 1, NULL, NULL, NULL, NULL),
(306, 4, 'C10140401', NULL, 1, NULL, NULL, NULL, NULL),
(307, 4, 'C10140402', NULL, 1, NULL, NULL, NULL, NULL),
(308, 4, 'C10140403', NULL, 1, NULL, NULL, NULL, NULL),
(309, 4, 'C10140404', NULL, 1, NULL, NULL, NULL, NULL),
(310, 4, 'C10140405', NULL, 1, NULL, NULL, NULL, NULL),
(311, 4, 'C10140406', NULL, 1, NULL, NULL, NULL, NULL),
(312, 4, 'C10140407', NULL, 1, NULL, NULL, NULL, NULL),
(313, 4, 'C10140408', NULL, 1, NULL, NULL, NULL, NULL),
(314, 4, 'C10140409', NULL, 2, NULL, NULL, NULL, NULL),
(315, 5, 'A10140403', NULL, 1, NULL, NULL, NULL, NULL),
(316, 5, 'A10140404', NULL, 1, NULL, NULL, NULL, NULL),
(317, 5, 'A10140405', NULL, 1, NULL, NULL, NULL, NULL),
(318, 5, 'A10140406', NULL, 1, NULL, NULL, NULL, NULL),
(319, 5, 'A10140407', NULL, 1, NULL, NULL, NULL, NULL),
(320, 5, 'A10140408', NULL, 1, NULL, NULL, NULL, NULL),
(321, 5, 'A10140409', NULL, 1, NULL, NULL, NULL, NULL),
(322, 5, 'B10140401', NULL, 1, NULL, NULL, NULL, NULL),
(323, 5, 'B10140402', NULL, 1, NULL, NULL, NULL, NULL),
(324, 5, 'B10140403', NULL, 1, NULL, NULL, NULL, NULL),
(325, 5, 'B10140404', NULL, 2, NULL, NULL, NULL, NULL),
(326, 5, 'B10140405', NULL, 1, NULL, NULL, NULL, NULL),
(327, 5, 'B10140406', NULL, 1, NULL, NULL, NULL, NULL),
(328, 5, 'B10140407', NULL, 1, NULL, NULL, NULL, NULL),
(329, 5, 'C10140401', NULL, 1, NULL, NULL, NULL, NULL),
(330, 5, 'C10140402', NULL, 1, NULL, NULL, NULL, NULL),
(331, 5, 'C10140403', NULL, 1, NULL, NULL, NULL, NULL),
(332, 5, 'C10140404', NULL, 1, NULL, NULL, NULL, NULL),
(333, 5, 'C10140405', NULL, 1, NULL, NULL, NULL, NULL),
(334, 5, 'C10140406', NULL, 1, NULL, NULL, NULL, NULL),
(335, 5, 'C10140407', NULL, 1, NULL, NULL, NULL, NULL),
(336, 5, 'C10140408', NULL, 1, NULL, NULL, NULL, NULL),
(337, 5, 'C10140409', NULL, 2, NULL, NULL, NULL, NULL),
(338, 5, 'C101404', NULL, 1, NULL, NULL, NULL, NULL),
(339, 5, 'S16061', NULL, 1, NULL, NULL, NULL, NULL),
(340, 5, 'S012030130200060', NULL, 2, NULL, NULL, NULL, NULL),
(341, 6, 'A10140403', NULL, 1, NULL, NULL, NULL, NULL),
(342, 6, 'A10140404', NULL, 1, NULL, NULL, NULL, NULL),
(343, 6, 'A10140405', NULL, 1, NULL, NULL, NULL, NULL),
(344, 6, 'A10140406', NULL, 1, NULL, NULL, NULL, NULL),
(345, 6, 'A10140407', NULL, 1, NULL, NULL, NULL, NULL),
(346, 6, 'A10140408', NULL, 1, NULL, NULL, NULL, NULL),
(347, 6, 'A10140409', NULL, 1, NULL, NULL, NULL, NULL),
(348, 6, 'B10140401', NULL, 1, NULL, NULL, NULL, NULL),
(349, 6, 'B10140402', NULL, 1, NULL, NULL, NULL, NULL),
(350, 6, 'B10140403', NULL, 1, NULL, NULL, NULL, NULL),
(351, 6, 'B10140404', NULL, 2, NULL, NULL, NULL, NULL),
(352, 6, 'B10140405', NULL, 1, NULL, NULL, NULL, NULL),
(353, 6, 'B10140406', NULL, 1, NULL, NULL, NULL, NULL),
(354, 6, 'B10140407', NULL, 1, NULL, NULL, NULL, NULL),
(355, 6, 'C10140401', NULL, 1, NULL, NULL, NULL, NULL),
(356, 6, 'C10140402', NULL, 1, NULL, NULL, NULL, NULL),
(357, 6, 'C10140403', NULL, 1, NULL, NULL, NULL, NULL),
(358, 6, 'C10140404', NULL, 1, NULL, NULL, NULL, NULL),
(359, 6, 'C10140405', NULL, 1, NULL, NULL, NULL, NULL),
(360, 6, 'C10140406', NULL, 1, NULL, NULL, NULL, NULL),
(361, 6, 'C10140407', NULL, 1, NULL, NULL, NULL, NULL),
(362, 6, 'C10140408', NULL, 1, NULL, NULL, NULL, NULL),
(363, 6, 'C10140409', NULL, 2, NULL, NULL, NULL, NULL);

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
(29, 2, 17, '0001/TR05/04/21', '2021-04-19', 10, '12', '2021-04-18 19:09:02', '2021-04-18 19:18:36'),
(32, 7, 17, '0001/FX04/06/21', '2021-06-04', 10, '12', '2021-06-04 06:05:28', '2021-06-04 06:05:28');

-- --------------------------------------------------------

--
-- Table structure for table `cek_pengemasans`
--

CREATE TABLE `cek_pengemasans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `detail_produk_id` bigint(20) UNSIGNED DEFAULT NULL,
  `perlengkapan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cek_pengemasans`
--

INSERT INTO `cek_pengemasans` (`id`, `detail_produk_id`, `perlengkapan`, `created_at`, `updated_at`) VALUES
(3, 1, 'Stiker', '2021-05-10 04:45:53', '2021-05-10 04:45:53'),
(4, 1, 'Segel', '2021-05-10 04:45:53', '2021-05-10 04:45:53'),
(5, 1, 'Kelengkapan', '2021-05-10 04:45:53', '2021-05-10 04:45:53'),
(6, 2, 'Stiker', '2021-05-10 04:55:59', '2021-05-10 04:55:59'),
(7, 2, 'Segel', '2021-05-10 04:55:59', '2021-05-10 04:55:59'),
(8, 2, 'Kelengkapan', '2021-05-10 04:55:59', '2021-05-10 04:55:59'),
(9, 7, 'Stiker', '2021-06-14 06:22:08', '2021-06-14 06:22:08');

-- --------------------------------------------------------

--
-- Table structure for table `custom_fields`
--

CREATE TABLE `custom_fields` (
  `id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `validation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `detail_cek_pengemasans`
--

CREATE TABLE `detail_cek_pengemasans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cek_pengemasan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_barang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_cek_pengemasans`
--

INSERT INTO `detail_cek_pengemasans` (`id`, `cek_pengemasan_id`, `nama_barang`, `created_at`, `updated_at`) VALUES
(5, 3, 'Inner', '2021-05-10 04:45:53', '2021-05-10 04:45:53'),
(6, 3, 'Outer', '2021-05-10 04:45:53', '2021-05-10 04:45:53'),
(7, 4, 'QC Pass', '2021-05-10 04:45:53', '2021-05-10 04:45:53'),
(8, 4, 'Plastik', '2021-05-10 04:45:53', '2021-05-10 04:45:53'),
(9, 5, 'Unit', '2021-05-10 04:45:53', '2021-05-10 04:45:53'),
(10, 5, 'Buku Manual', '2021-05-10 04:45:53', '2021-05-10 04:45:53'),
(11, 5, 'Packing List', '2021-05-10 04:45:53', '2021-05-10 04:45:53'),
(12, 5, 'Kartu Garansi', '2021-05-10 04:45:53', '2021-05-10 04:45:53'),
(13, 6, 'Inner', '2021-05-10 04:55:59', '2021-05-10 04:55:59'),
(14, 6, 'Outer', '2021-05-10 04:55:59', '2021-05-10 04:55:59'),
(15, 6, 'QC Pass', '2021-05-10 04:55:59', '2021-05-10 04:55:59'),
(16, 7, 'QC Pass', '2021-05-10 04:55:59', '2021-05-10 04:55:59'),
(17, 7, 'Plastik', '2021-05-10 04:55:59', '2021-05-10 04:55:59'),
(18, 8, 'Unit', '2021-05-10 04:55:59', '2021-05-10 04:55:59'),
(19, 8, 'Buku Manual', '2021-05-10 04:55:59', '2021-05-10 04:55:59'),
(20, 8, 'Packing List', '2021-05-10 04:55:59', '2021-05-10 04:55:59'),
(21, 8, 'Kartu Garansi', '2021-05-10 04:55:59', '2021-05-10 04:55:59'),
(22, 9, 'QC Pass', '2021-06-14 06:22:08', '2021-06-14 06:22:08'),
(23, 9, 'Outer', '2021-06-14 06:22:08', '2021-06-14 06:22:08'),
(24, 9, 'Inner', '2021-06-14 06:22:08', '2021-06-14 06:22:08');

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
-- Table structure for table `detail_pengembalian_barang_gudangs`
--

CREATE TABLE `detail_pengembalian_barang_gudangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pengembalian_id` bigint(20) UNSIGNED NOT NULL,
  `bill_of_material_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jumlah_ok` int(11) DEFAULT NULL,
  `jumlah_nok` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_penyerahan_barang_jadis`
--

CREATE TABLE `detail_penyerahan_barang_jadis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `penyerahan_barang_jadi_id` bigint(20) UNSIGNED NOT NULL,
  `hasil_perakitan_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_penyerahan_barang_jadis`
--

INSERT INTO `detail_penyerahan_barang_jadis` (`id`, `penyerahan_barang_jadi_id`, `hasil_perakitan_id`, `created_at`, `updated_at`) VALUES
(9, 8, 92, '2021-06-28 06:23:25', '2021-06-28 06:23:25'),
(11, 10, 92, '2021-07-07 04:07:38', '2021-07-07 04:07:38');

-- --------------------------------------------------------

--
-- Table structure for table `detail_permintaan_bahan_bakus`
--

CREATE TABLE `detail_permintaan_bahan_bakus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bill_of_material_id` bigint(20) UNSIGNED NOT NULL,
  `permintaan_bahan_baku_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah_diminta` int(11) NOT NULL,
  `jumlah_diterima` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_permintaan_bahan_bakus`
--

INSERT INTO `detail_permintaan_bahan_bakus` (`id`, `bill_of_material_id`, `permintaan_bahan_baku_id`, `jumlah_diminta`, `jumlah_diterima`, `created_at`, `updated_at`) VALUES
(1, 217, 2, 10, 10, '2021-06-04 06:05:28', '2021-06-04 08:55:52'),
(2, 218, 2, 10, 10, '2021-06-04 06:05:28', '2021-06-08 02:18:47'),
(3, 219, 2, 10, 10, '2021-06-04 06:05:28', '2021-06-08 02:18:47'),
(4, 220, 2, 10, 10, '2021-06-04 06:05:28', '2021-06-08 02:18:47'),
(5, 221, 2, 10, 10, '2021-06-04 06:05:28', '2021-06-08 02:18:47'),
(6, 222, 2, 10, 10, '2021-06-04 06:05:28', '2021-06-08 02:18:47'),
(7, 223, 2, 10, 10, '2021-06-04 06:05:28', '2021-06-08 02:18:47'),
(8, 224, 2, 10, 10, '2021-06-04 06:05:28', '2021-06-08 02:18:47'),
(9, 225, 2, 10, 10, '2021-06-04 06:05:28', '2021-06-08 02:18:47'),
(10, 226, 2, 10, 10, '2021-06-04 06:05:28', '2021-06-08 02:18:47'),
(11, 227, 2, 20, 20, '2021-06-04 06:05:28', '2021-06-08 02:18:47'),
(12, 228, 2, 10, 10, '2021-06-04 06:05:28', '2021-06-08 02:18:47'),
(13, 229, 2, 10, 10, '2021-06-04 06:05:28', '2021-06-08 02:18:47'),
(14, 230, 2, 10, 10, '2021-06-04 06:05:28', '2021-06-08 02:18:47'),
(15, 231, 2, 10, 10, '2021-06-04 06:05:28', '2021-06-08 02:18:47'),
(16, 232, 2, 10, 10, '2021-06-04 06:05:28', '2021-06-08 02:18:47'),
(17, 233, 2, 10, 10, '2021-06-04 06:05:28', '2021-06-08 02:18:47'),
(18, 234, 2, 10, 10, '2021-06-04 06:05:28', '2021-06-08 02:18:47'),
(19, 235, 2, 10, 10, '2021-06-04 06:05:28', '2021-06-08 02:18:47'),
(20, 236, 2, 10, 10, '2021-06-04 06:05:28', '2021-06-08 02:18:47'),
(21, 237, 2, 10, 10, '2021-06-04 06:05:28', '2021-06-08 02:18:47'),
(22, 238, 2, 10, 10, '2021-06-04 06:05:28', '2021-06-08 02:18:47'),
(23, 239, 2, 20, 20, '2021-06-04 06:05:28', '2021-06-08 02:18:47'),
(24, 240, 2, 10, 10, '2021-06-04 06:05:28', '2021-06-08 02:18:47'),
(25, 241, 2, 10, 10, '2021-06-04 06:05:28', '2021-06-08 02:18:47'),
(26, 242, 2, 20, 20, '2021-06-04 06:05:28', '2021-06-08 02:18:47');

-- --------------------------------------------------------

--
-- Table structure for table `detail_persiapan_packing_produks`
--

CREATE TABLE `detail_persiapan_packing_produks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `persiapan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `dokumen` enum('manual_book_id','manual_book_eng','sop','packing_list','sticker') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ketersediaan` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ukuran` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warna_kertas` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warna_tinta` enum('hitam_putih','warna') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verifikasi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_persiapan_packing_produks`
--

INSERT INTO `detail_persiapan_packing_produks` (`id`, `persiapan_id`, `dokumen`, `ketersediaan`, `keterangan`, `ukuran`, `model`, `warna_kertas`, `warna_tinta`, `verifikasi`, `created_at`, `updated_at`) VALUES
(4, 6, 'manual_book_id', '1', NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-21 07:30:56', '2021-05-21 07:30:56'),
(5, 6, 'manual_book_eng', '1', NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-21 07:30:56', '2021-05-21 07:30:56'),
(6, 6, 'sop', '1', NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-21 07:30:56', '2021-05-21 07:30:56'),
(7, 6, 'packing_list', '1', NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-21 07:30:56', '2021-05-21 07:30:56'),
(8, 6, 'sticker', '1', NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-21 07:30:56', '2021-05-21 07:30:56');

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
  `satuan` enum('pc','pcs','set','unit','dus','roll','meter','pack') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('ada','tidak_ada') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(6, 56, 'BJHH05USG01', 'END-1 + ', NULL, 7790000, NULL, 12, 'pc', NULL, 'ada', '2021-04-16 02:00:01', '2021-04-16 02:00:01'),
(7, 7, 'FXB-Blue', 'FOX-BABY BLUE', NULL, NULL, NULL, NULL, '', NULL, '', NULL, NULL),
(8, 7, 'FXB-Yellow', 'FOX-BABY YELLOW', NULL, NULL, NULL, NULL, '', NULL, '', NULL, NULL),
(9, 7, 'FXB-Pink', 'FOX-BABY PINK', NULL, NULL, NULL, NULL, '', NULL, '', NULL, NULL);

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
(27, 'Pembelian', 'beli', NULL, NULL),
(28, 'Kesehatan', 'kes', NULL, NULL);

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
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `custom_fields` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified_by` bigint(20) UNSIGNED DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documents_tags`
--

CREATE TABLE `documents_tags` (
  `document_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_engs`
--

CREATE TABLE `dokumen_engs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_id` int(10) UNSIGNED NOT NULL,
  `file_type_id` int(10) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `custom_fields` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `file_types`
--

CREATE TABLE `file_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_of_files` int(11) NOT NULL,
  `labels` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_validations` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_maxsize` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gcu_karyawans`
--

CREATE TABLE `gcu_karyawans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `karyawan_id` int(11) NOT NULL,
  `tgl_cek` date NOT NULL,
  `glukosa` int(11) DEFAULT NULL,
  `kolesterol` int(11) DEFAULT NULL,
  `asam_urat` int(11) DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gcu_karyawans`
--

INSERT INTO `gcu_karyawans` (`id`, `karyawan_id`, `tgl_cek`, `glukosa`, `kolesterol`, `asam_urat`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 11, '2021-05-18', 100, 120, 8, 'hbhn', '2021-05-18 07:42:45', '2021-05-19 02:13:59'),
(2, 6, '2021-05-18', 150, 300, 6, 'sad', '2021-05-18 07:43:48', '2021-05-18 07:43:48'),
(3, 7, '2021-05-18', 210, NULL, 5, 'asd', '2021-05-18 07:43:48', '2021-05-18 07:43:48'),
(4, 8, '2021-05-18', 50, 160, 23, 'asd', '2021-05-18 07:43:48', '2021-05-18 07:43:48'),
(5, 9, '2021-05-18', 100, 100, NULL, 'ads', '2021-05-18 07:43:48', '2021-05-19 02:14:12'),
(6, 6, '2021-05-20', 100, 160, 60, NULL, '2021-05-19 08:26:02', '2021-05-19 08:26:02'),
(7, 7, '2021-05-20', 210, 180, 5, NULL, '2021-05-19 08:26:02', '2021-05-19 08:26:02'),
(8, 8, '2021-05-20', 50, 160, 4, NULL, '2021-05-19 08:26:02', '2021-05-19 08:26:02'),
(9, 9, '2021-05-20', 200, 210, 20, NULL, '2021-05-19 08:26:02', '2021-05-19 08:26:02'),
(10, 6, '2021-05-20', 150, 300, 6, NULL, '2021-05-19 08:26:29', '2021-05-19 08:26:29'),
(11, 7, '2021-05-20', 150, 100, 10, NULL, '2021-05-19 08:26:29', '2021-05-19 08:26:29'),
(12, 8, '2021-05-20', 300, 132, 4, NULL, '2021-05-19 08:26:29', '2021-05-19 08:26:29'),
(13, 9, '2021-05-20', 150, 210, 20, NULL, '2021-05-19 08:26:29', '2021-05-19 08:26:29'),
(14, 6, '2021-05-22', 150, 123, 20, 'tes', '2021-05-19 08:27:44', '2021-05-19 09:51:51'),
(15, 7, '2021-05-22', 150, 100, 5, NULL, '2021-05-19 08:27:44', '2021-05-19 08:27:44'),
(16, 8, '2021-05-22', 300, 132, 23, NULL, '2021-05-19 08:27:44', '2021-05-19 08:27:44'),
(17, 9, '2021-05-22', 150, 210, 20, NULL, '2021-05-19 08:27:44', '2021-05-19 08:27:44'),
(18, 11, '2021-06-02', 100, 160, 10, NULL, '2021-06-02 01:31:05', '2021-06-08 02:59:35'),
(19, 46, '2021-06-17', 139, 199, 5, NULL, '2021-06-16 04:49:06', '2021-06-16 04:49:06'),
(20, 18, '2021-06-17', 140, 200, 8, NULL, '2021-06-16 04:49:06', '2021-06-16 04:49:06'),
(21, 88, '2021-06-17', 200, 240, 10, NULL, '2021-06-16 04:49:06', '2021-06-16 04:49:06'),
(22, 46, '2021-06-21', 140, 210, 3, NULL, '2021-06-16 04:51:28', '2021-06-16 04:51:28'),
(23, 7, '2021-06-10', 100, 100, 3, NULL, '2021-06-23 02:41:55', '2021-06-23 02:41:55'),
(24, 6, '2021-06-10', NULL, NULL, NULL, NULL, '2021-06-23 02:41:55', '2021-06-23 02:41:55');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_ik_pemeriksaan_pengujians`
--

CREATE TABLE `hasil_ik_pemeriksaan_pengujians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ik_pemeriksaan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `standar_keberterimaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hasil_ik_pemeriksaan_pengujians`
--

INSERT INTO `hasil_ik_pemeriksaan_pengujians` (`id`, `ik_pemeriksaan_id`, `standar_keberterimaan`, `created_at`, `updated_at`) VALUES
(13, 5, 'pemasangan sesuai dengan instruksi kerja', '2021-05-03 07:21:03', '2021-05-03 07:21:03'),
(14, 5, 'pemasangan chasing tidak terbalik', '2021-05-03 07:21:03', '2021-05-03 07:21:03'),
(15, 6, 'pemasangan sesuai dengan instruksi kerja', '2021-05-03 07:21:03', '2021-05-03 07:21:03'),
(16, 6, 'pemasangan tidak terbalik', '2021-05-03 07:21:03', '2021-05-03 07:21:03'),
(17, 7, 'Tes', '2021-05-03 08:51:41', '2021-05-03 08:51:41'),
(18, 7, 'Tes2', '2021-05-03 08:51:41', '2021-05-03 08:51:41'),
(19, 8, 'Tes21', '2021-05-03 08:51:41', '2021-05-03 08:51:41'),
(20, 8, 'Tes22', '2021-05-03 08:51:41', '2021-05-03 08:51:41');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_monitoring_proses`
--

CREATE TABLE `hasil_monitoring_proses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `monitoring_proses_id` bigint(20) UNSIGNED NOT NULL,
  `hasil_perakitan_id` bigint(20) UNSIGNED NOT NULL,
  `no_barcode` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hasil` enum('ok','nok') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tindak_lanjut` enum('pengemasan','perbaikan','produk_spesialis','karantina') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('req_monitoring_proses','acc_monitoring_proses','rej_monitoring_proses','perbaikan_monitoring_proses','analisa_monitoring_proses','pengemasan') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hasil_monitoring_proses`
--

INSERT INTO `hasil_monitoring_proses` (`id`, `monitoring_proses_id`, `hasil_perakitan_id`, `no_barcode`, `hasil`, `keterangan`, `tindak_lanjut`, `status`, `created_at`, `updated_at`) VALUES
(36, 16, 92, NULL, 'ok', NULL, 'pengemasan', 'pengemasan', '2021-06-14 04:38:16', '2021-06-14 04:38:16'),
(45, 22, 94, '00001', 'nok', 'Tes', 'produk_spesialis', 'req_monitoring_proses', '2021-06-17 08:51:15', '2021-06-21 07:42:43'),
(46, 22, 95, '00002', 'ok', 'Tes', 'pengemasan', 'pengemasan', '2021-06-17 08:51:15', '2021-06-17 08:51:15'),
(47, 23, 103, NULL, 'ok', NULL, 'pengemasan', 'pengemasan', '2021-06-23 04:53:58', '2021-06-23 04:53:58'),
(48, 24, 102, '00006', 'ok', NULL, 'pengemasan', 'pengemasan', '2021-06-29 03:45:42', '2021-06-29 03:45:42'),
(49, 24, 104, '00007', 'ok', NULL, 'pengemasan', 'pengemasan', '2021-06-29 03:45:42', '2021-06-29 03:45:42');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_pemeriksaan_proses_pengujians`
--

CREATE TABLE `hasil_pemeriksaan_proses_pengujians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pemeriksaan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `hasil_ik_id` bigint(20) UNSIGNED DEFAULT NULL,
  `hasil_ok` int(11) DEFAULT NULL,
  `hasil_nok` int(11) DEFAULT NULL,
  `karantina` int(11) DEFAULT NULL,
  `perbaikan` int(11) DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hasil_pemeriksaan_proses_pengujians`
--

INSERT INTO `hasil_pemeriksaan_proses_pengujians` (`id`, `pemeriksaan_id`, `hasil_ik_id`, `hasil_ok`, `hasil_nok`, `karantina`, `perbaikan`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, NULL, 13, 10, 0, 0, 0, NULL, '2021-05-04 06:55:52', '2021-05-04 06:55:52'),
(2, NULL, 14, 10, 0, 0, 0, NULL, '2021-05-04 06:55:52', '2021-05-04 06:55:52'),
(3, NULL, 15, 10, 0, 0, 0, NULL, '2021-05-04 06:55:52', '2021-05-04 06:55:52'),
(4, NULL, 16, 10, 0, 0, 0, NULL, '2021-05-04 06:55:52', '2021-05-04 06:55:52'),
(5, 5, 13, 10, 0, 0, 0, NULL, '2021-05-04 07:11:31', '2021-05-04 07:11:31'),
(6, 5, 14, 10, 0, 0, 0, NULL, '2021-05-04 07:11:31', '2021-05-04 07:11:31'),
(7, 5, 15, 10, 0, 0, 0, NULL, '2021-05-04 07:11:31', '2021-05-04 07:11:31'),
(8, 5, 16, 10, 0, 0, 0, NULL, '2021-05-04 07:11:31', '2021-05-04 07:11:31');

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
-- Table structure for table `hasil_pengemasans`
--

CREATE TABLE `hasil_pengemasans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pengemasan_id` bigint(20) UNSIGNED NOT NULL,
  `hasil_perakitan_id` bigint(20) UNSIGNED NOT NULL,
  `no_barcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kondisi_unit` enum('baik','kurang','tidak') COLLATE utf8mb4_unicode_ci NOT NULL,
  `hasil` enum('ok','nok') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tindak_lanjut` enum('ok','perbaikan','pengujian','karantina','produk_spesialis') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('req_pengemasan','rej_pengemasan','perbaikan_pengemasan','analisa_pengemasan_ps','ok','proses_penyerahan','penyerahan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hasil_pengemasans`
--

INSERT INTO `hasil_pengemasans` (`id`, `pengemasan_id`, `hasil_perakitan_id`, `no_barcode`, `kondisi_unit`, `hasil`, `keterangan`, `tindak_lanjut`, `status`, `created_at`, `updated_at`) VALUES
(13, 14, 92, '00003', 'baik', 'ok', NULL, 'ok', 'proses_penyerahan', '2021-06-15 03:30:34', '2021-07-07 04:07:38'),
(16, 17, 103, '00004', 'baik', NULL, NULL, NULL, '', '2021-06-28 09:29:00', '2021-06-28 09:29:00');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_pengemasan_detail_cek_pengemasans`
--

CREATE TABLE `hasil_pengemasan_detail_cek_pengemasans` (
  `hasil_id` bigint(20) UNSIGNED NOT NULL,
  `detail_cek_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hasil_pengemasan_detail_cek_pengemasans`
--

INSERT INTO `hasil_pengemasan_detail_cek_pengemasans` (`hasil_id`, `detail_cek_id`, `created_at`, `updated_at`) VALUES
(13, 22, '2021-06-15 03:30:34', '2021-06-15 03:30:34'),
(13, 23, '2021-06-15 03:30:34', '2021-06-15 03:30:34'),
(13, 24, '2021-06-15 03:30:34', '2021-06-15 03:30:34'),
(16, 22, '2021-06-28 09:29:00', '2021-06-28 09:29:00'),
(16, 23, '2021-06-28 09:29:00', '2021-06-28 09:29:00'),
(16, 24, '2021-06-28 09:29:00', '2021-06-28 09:29:00');

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
  `hasil_terbuka` enum('ok','nok') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tindak_lanjut_terbuka` enum('ok','operator','produk_spesialis','perbaikan','karantina','ps') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan_tindak_lanjut_terbuka` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fungsi` enum('ok','nok') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kondisi_setelah_proses` enum('ok','nok') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hasil_tertutup` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tindak_lanjut_tertutup` enum('ok','operator','produk_spesialis','perbaikan','karantina','ps','aging') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan_tindak_lanjut_tertutup` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('dibuat','req_pemeriksaan_terbuka','acc_pemeriksaan_terbuka','perbaikan_pemeriksaan_terbuka','analisa_pemeriksaan_terbuka_ps','rej_pemeriksaan_terbuka','req_pemeriksaan_tertutup','acc_pemeriksaan_tertutup','perbaikan_pemeriksaan_tertutup','analisa_pemeriksaan_tertutup_ps','rej_pemeriksaan_tertutup','acc_analisa_pemeriksaan_terbuka_ps','rej_analisa_pemeriksaan_terbuka_ps','acc_analisa_pemeriksaan_tertutup_ps','rej_analisa_pemeriksaan_tertutup_ps','req_analisa_pemeriksaan_terbuka_ps','req_analisa_pemeriksaan_tertutup_ps') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hasil_perakitans`
--

INSERT INTO `hasil_perakitans` (`id`, `perakitan_id`, `tanggal`, `no_seri`, `kondisi_fisik_bahan_baku`, `kondisi_saat_proses_perakitan`, `hasil_terbuka`, `tindak_lanjut_terbuka`, `keterangan_tindak_lanjut_terbuka`, `fungsi`, `kondisi_setelah_proses`, `hasil_tertutup`, `tindak_lanjut_tertutup`, `keterangan_tindak_lanjut_tertutup`, `keterangan`, `status`, `created_at`, `updated_at`) VALUES
(91, 41, '2021-06-09', '00001', 'ok', 'ok', 'nok', 'produk_spesialis', 'tes', NULL, NULL, NULL, NULL, NULL, NULL, 'req_pemeriksaan_terbuka', '2021-06-09 09:07:15', '2021-06-11 03:48:16'),
(92, 41, '2021-06-09', '00002', 'ok', 'ok', 'ok', 'ok', NULL, 'ok', 'ok', 'ok', 'aging', NULL, NULL, 'acc_pemeriksaan_tertutup', '2021-06-09 09:07:15', '2021-06-14 02:04:19'),
(93, 41, '2021-06-09', '00003', 'ok', 'ok', 'ok', 'ok', NULL, 'ok', 'nok', 'nok', 'produk_spesialis', 'Casing tidak mau menutup rapat', NULL, 'analisa_pemeriksaan_tertutup_ps', '2021-06-10 01:32:06', '2021-06-15 06:51:25'),
(94, 41, '2021-06-09', '00004', 'ok', 'ok', 'ok', 'ok', 'Tes', 'ok', 'ok', 'ok', 'aging', NULL, NULL, 'acc_pemeriksaan_tertutup', '2021-06-10 01:32:06', '2021-06-17 04:44:23'),
(95, 41, '2021-06-09', '00005', 'ok', 'ok', 'ok', 'ok', 'Tes', 'ok', 'ok', 'ok', 'aging', 'Tes', NULL, 'acc_pemeriksaan_tertutup', '2021-06-10 01:32:06', '2021-06-17 06:07:53'),
(96, 41, '2021-06-10', '00006', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'req_pemeriksaan_terbuka', '2021-06-10 03:58:42', '2021-06-10 03:58:42'),
(98, 42, '2021-06-10', '00001', 'ok', 'ok', 'ok', 'ok', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'acc_pemeriksaan_terbuka', '2021-06-10 07:01:12', '2021-06-23 04:28:25'),
(102, 59, '2021-06-17', '00001', 'ok', 'ok', 'ok', 'ok', NULL, 'ok', 'ok', 'ok', 'aging', NULL, NULL, 'acc_pemeriksaan_tertutup', '2021-06-17 01:41:18', '2021-06-24 06:18:33'),
(103, 65, '2021-06-23', '00001', 'ok', 'ok', 'ok', 'ok', NULL, 'ok', 'ok', 'ok', 'aging', NULL, NULL, 'acc_pemeriksaan_tertutup', '2021-06-23 03:09:42', '2021-06-23 04:30:48'),
(104, 65, '2021-06-23', '00002', 'ok', 'ok', 'ok', 'ok', NULL, 'ok', 'ok', 'ok', 'aging', 'tes', NULL, 'acc_pemeriksaan_tertutup', '2021-06-23 03:09:42', '2021-06-24 06:56:24');

-- --------------------------------------------------------

--
-- Table structure for table `histori_hasil_perakitans`
--

CREATE TABLE `histori_hasil_perakitans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hasil_perakitan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `kegiatan` enum('perbaikan_pemeriksaan_terbuka','pemeriksaan_terbuka','perbaikan_pemeriksaan_tertutup','pemeriksaan_tertutup','analisa_pemeriksaan_terbuka_ps','analisa_pemeriksaan_tertutup_ps','pemeriksaan_pengujian','perbaikan_pengujian','analisa_pengujian_ps','pemeriksaan_pengemasan','perbaikan_pengemasan','analisa_pengemasan_ps') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `hasil` enum('ok','nok') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tindak_lanjut` enum('ok','operator','produk_spesialis','perbaikan','karantina','ps','aging','pengemasan','pengujian') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `histori_hasil_perakitans`
--

INSERT INTO `histori_hasil_perakitans` (`id`, `hasil_perakitan_id`, `kegiatan`, `tanggal`, `hasil`, `keterangan`, `tindak_lanjut`, `created_at`, `updated_at`) VALUES
(36, NULL, 'pemeriksaan_pengujian', '2021-05-06', 'ok', NULL, 'pengemasan', '2021-05-06 06:54:52', '2021-05-06 06:54:52'),
(69, 92, 'pemeriksaan_terbuka', '2021-06-10', 'ok', NULL, 'ok', '2021-06-10 01:38:53', '2021-06-10 01:38:53'),
(70, 92, 'pemeriksaan_tertutup', '2021-06-10', 'nok', 'tes', 'perbaikan', '2021-06-10 01:40:09', '2021-06-10 01:40:09'),
(74, 91, 'pemeriksaan_terbuka', '2021-06-10', 'nok', 'tes', 'operator', '2021-06-10 08:51:44', '2021-06-10 08:51:44'),
(75, 91, 'perbaikan_pemeriksaan_terbuka', '2021-06-10', 'ok', '', 'ok', '2021-06-10 08:52:57', '2021-06-10 08:52:57'),
(76, 91, 'pemeriksaan_terbuka', '2021-06-10', 'nok', 'tes', 'operator', '2021-06-10 08:53:27', '2021-06-10 08:53:27'),
(77, 91, 'perbaikan_pemeriksaan_terbuka', '2021-06-10', 'ok', '', 'ok', '2021-06-10 08:53:34', '2021-06-10 08:53:34'),
(78, 91, 'pemeriksaan_terbuka', '2021-06-10', 'nok', 'tes', 'produk_spesialis', '2021-06-10 08:56:33', '2021-06-10 08:56:33'),
(79, 91, 'analisa_pemeriksaan_terbuka_ps', '2021-06-10', 'ok', '', 'operator', '2021-06-10 09:50:46', '2021-06-10 09:50:46'),
(80, 91, 'perbaikan_pemeriksaan_terbuka', '2021-06-11', 'ok', '', 'ok', '2021-06-11 03:45:15', '2021-06-11 03:45:15'),
(81, 92, 'perbaikan_pemeriksaan_tertutup', '2021-06-11', 'ok', '', 'ok', '2021-06-11 08:35:18', '2021-06-11 08:35:18'),
(82, 92, 'pemeriksaan_tertutup', '2021-06-14', 'ok', NULL, 'aging', '2021-06-14 02:04:19', '2021-06-14 02:04:19'),
(83, NULL, 'pemeriksaan_pengujian', '2021-06-14', 'ok', NULL, 'pengemasan', '2021-06-14 04:38:16', '2021-06-14 04:38:16'),
(84, 92, 'pemeriksaan_pengemasan', '2021-06-15', 'ok', NULL, 'ok', '2021-06-15 03:31:37', '2021-06-15 03:31:37'),
(85, 93, 'pemeriksaan_terbuka', '2021-06-15', 'nok', 'Baut tidak rapat', 'operator', '2021-06-15 04:34:04', '2021-06-15 04:34:04'),
(86, 93, 'perbaikan_pemeriksaan_terbuka', '2021-06-15', 'ok', '', 'ok', '2021-06-15 04:34:43', '2021-06-15 04:34:43'),
(87, 93, 'pemeriksaan_terbuka', '2021-06-15', 'nok', 'Masih tidak rapat', 'operator', '2021-06-15 04:35:35', '2021-06-15 04:35:35'),
(88, 93, 'perbaikan_pemeriksaan_terbuka', '2021-06-15', 'ok', '', 'ok', '2021-06-15 04:36:29', '2021-06-15 04:36:29'),
(89, 93, 'pemeriksaan_terbuka', '2021-06-15', 'nok', 'Masalah baut', 'produk_spesialis', '2021-06-15 04:39:19', '2021-06-15 04:39:19'),
(90, 93, 'analisa_pemeriksaan_terbuka_ps', '2021-06-15', 'ok', '', 'operator', '2021-06-15 04:55:15', '2021-06-15 04:55:15'),
(91, 93, 'perbaikan_pemeriksaan_terbuka', '2021-06-15', 'ok', '', 'ok', '2021-06-15 06:02:45', '2021-06-15 06:02:45'),
(92, 93, 'pemeriksaan_terbuka', '2021-06-15', 'ok', NULL, 'ok', '2021-06-15 06:18:41', '2021-06-15 06:18:41'),
(93, 93, 'pemeriksaan_tertutup', '2021-06-15', 'nok', 'Tutup tidak rapat', 'perbaikan', '2021-06-15 06:20:05', '2021-06-15 06:20:05'),
(94, 93, 'perbaikan_pemeriksaan_tertutup', '2021-06-15', 'ok', '', 'ok', '2021-06-15 06:24:46', '2021-06-15 06:24:46'),
(95, 93, 'pemeriksaan_tertutup', '2021-06-15', 'nok', 'Casing tidak mau menutup rapat', 'produk_spesialis', '2021-06-15 06:33:32', '2021-06-15 06:33:32'),
(96, 93, 'analisa_pemeriksaan_tertutup_ps', '2021-06-15', 'ok', '', 'perbaikan', '2021-06-15 06:51:25', '2021-06-15 06:51:25'),
(97, 94, 'pemeriksaan_terbuka', '2021-06-17', 'ok', 'Tes', 'ok', '2021-06-17 04:23:49', '2021-06-17 04:23:49'),
(98, 94, 'pemeriksaan_tertutup', '2021-06-17', 'ok', NULL, 'aging', '2021-06-17 04:44:23', '2021-06-17 04:44:23'),
(99, 95, 'pemeriksaan_terbuka', '2021-06-17', 'ok', 'Tes', 'ok', '2021-06-17 06:05:27', '2021-06-17 06:05:27'),
(100, 95, 'pemeriksaan_tertutup', '2021-06-17', 'ok', 'Tes', 'aging', '2021-06-17 06:07:53', '2021-06-17 06:07:53'),
(103, 94, 'pemeriksaan_pengujian', '2021-06-17', 'nok', 'Tes', 'perbaikan', '2021-06-17 08:32:49', '2021-06-17 08:32:49'),
(104, 95, 'pemeriksaan_pengujian', '2021-06-17', 'ok', 'Tes', 'pengemasan', '2021-06-17 08:32:49', '2021-06-17 08:32:49'),
(105, 94, 'pemeriksaan_pengujian', '2021-06-17', 'nok', 'Tes', 'perbaikan', '2021-06-17 08:43:11', '2021-06-17 08:43:11'),
(106, 95, 'pemeriksaan_pengujian', '2021-06-17', 'ok', 'Tes', 'pengemasan', '2021-06-17 08:43:11', '2021-06-17 08:43:11'),
(107, 94, 'pemeriksaan_pengujian', '2021-06-17', 'nok', 'Tes', 'perbaikan', '2021-06-17 08:46:08', '2021-06-17 08:46:08'),
(108, 95, 'pemeriksaan_pengujian', '2021-06-17', 'ok', 'Tes', 'pengemasan', '2021-06-17 08:46:08', '2021-06-17 08:46:08'),
(109, 94, 'pemeriksaan_pengujian', '2021-06-17', 'nok', 'Tes', 'perbaikan', '2021-06-17 08:51:15', '2021-06-17 08:51:15'),
(110, 95, 'pemeriksaan_pengujian', '2021-06-17', 'ok', 'Tes', 'pengemasan', '2021-06-17 08:51:15', '2021-06-17 08:51:15'),
(111, 94, 'perbaikan_pengujian', '2021-06-18', 'ok', '', 'ok', '2021-06-18 04:29:11', '2021-06-18 04:29:11'),
(112, 94, 'pemeriksaan_pengujian', '2021-06-18', 'nok', 'Tes', 'produk_spesialis', '2021-06-18 08:47:16', '2021-06-18 08:47:16'),
(113, 94, 'analisa_pengujian_ps', '2021-06-21', 'nok', '', 'perbaikan', '2021-06-21 04:43:49', '2021-06-21 04:43:49'),
(114, 94, 'perbaikan_pengujian', '2021-06-21', 'ok', '', 'ok', '2021-06-21 07:19:35', '2021-06-21 07:19:35'),
(115, 98, 'pemeriksaan_terbuka', '2021-06-23', 'ok', NULL, 'ok', '2021-06-23 04:28:25', '2021-06-23 04:28:25'),
(116, 103, 'pemeriksaan_terbuka', '2021-06-23', 'ok', NULL, 'ok', '2021-06-23 04:29:01', '2021-06-23 04:29:01'),
(117, 103, 'pemeriksaan_tertutup', '2021-06-23', 'ok', NULL, 'aging', '2021-06-23 04:30:48', '2021-06-23 04:30:48'),
(118, 103, 'pemeriksaan_pengujian', '2021-06-23', 'ok', NULL, 'pengemasan', '2021-06-23 04:53:58', '2021-06-23 04:53:58'),
(119, 102, 'pemeriksaan_terbuka', '2021-06-24', 'ok', NULL, 'ok', '2021-06-24 06:17:02', '2021-06-24 06:17:02'),
(120, 102, 'pemeriksaan_tertutup', '2021-06-24', 'ok', NULL, 'aging', '2021-06-24 06:18:33', '2021-06-24 06:18:33'),
(121, 104, 'pemeriksaan_terbuka', '2021-06-24', 'ok', NULL, 'ok', '2021-06-24 06:53:26', '2021-06-24 06:53:26'),
(122, 104, 'pemeriksaan_tertutup', '2021-06-24', 'ok', 'tes', 'aging', '2021-06-24 06:56:24', '2021-06-24 06:56:24'),
(123, 102, 'pemeriksaan_pengujian', '2021-06-29', 'ok', NULL, 'pengemasan', '2021-06-29 03:45:42', '2021-06-29 03:45:42'),
(124, 104, 'pemeriksaan_pengujian', '2021-06-29', 'ok', NULL, 'pengemasan', '2021-06-29 03:45:42', '2021-06-29 03:45:42');

-- --------------------------------------------------------

--
-- Table structure for table `ik_pemeriksaan_pengujians`
--

CREATE TABLE `ik_pemeriksaan_pengujians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `detail_produk_id` bigint(20) UNSIGNED DEFAULT NULL,
  `hal_yang_diperiksa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ik_pemeriksaan_pengujians`
--

INSERT INTO `ik_pemeriksaan_pengujians` (`id`, `detail_produk_id`, `hal_yang_diperiksa`, `created_at`, `updated_at`) VALUES
(5, 2, 'Hasil pemasangan casing atas', '2021-05-03 07:21:03', '2021-05-03 07:21:03'),
(6, 2, 'Hasil pemasangan air filter pada lubang air inlet', '2021-05-03 07:21:03', '2021-05-03 07:21:03'),
(7, 5, 'Tes', '2021-05-03 08:51:41', '2021-05-03 08:51:41'),
(8, 5, 'Tes1', '2021-05-03 08:51:41', '2021-05-03 08:51:41');

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
-- Table structure for table `jadwal_produksi`
--

CREATE TABLE `jadwal_produksi` (
  `id` int(11) NOT NULL,
  `detail_produk_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah_produksi` int(11) DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `status` enum('penyusunan','disetujui','permintaan','pelaksanaan','selesai') DEFAULT NULL,
  `warna` varchar(255) DEFAULT NULL,
  `versi_bom` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwal_produksi`
--

INSERT INTO `jadwal_produksi` (`id`, `detail_produk_id`, `jumlah_produksi`, `tanggal_mulai`, `tanggal_selesai`, `status`, `warna`, `versi_bom`, `created_at`, `updated_at`) VALUES
(18, 9, 123, '2021-06-02', '2021-06-10', 'permintaan', 'rgb(204, 193, 50)', 1, '2021-06-09 02:39:13', '2021-06-09 08:09:11'),
(25, 8, 345, '2021-06-08', '2021-06-16', 'permintaan', 'rgb(143, 204, 29)', 2, '2021-06-09 08:35:24', '2021-06-10 01:24:59'),
(29, 7, 324, '2021-06-09', '2021-06-23', 'disetujui', 'rgb(177, 216, 13)', 2, '2021-06-10 01:24:35', '2021-06-10 01:24:43'),
(30, 9, NULL, '2021-05-31', '2021-05-31', NULL, NULL, 1, NULL, NULL),
(31, 9, NULL, '2021-07-01', '2021-07-01', NULL, NULL, NULL, NULL, NULL);

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
  `kode_karyawan` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

INSERT INTO `karyawans` (`id`, `divisi_id`, `nama`, `kode_karyawan`, `foto`, `jabatan`, `ktp`, `bpjs`, `tgl_kerja`, `vaksin`, `tgllahir`, `created_at`, `updated_at`) VALUES
(1, 17, 'Sri Wahyuni', 'SW', NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 17, 'Mutmainah', 'IN', NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 17, 'Siti Romlah', 'RL', NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 17, 'Siti Salimah', 'SL', NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 17, 'Frida Chrisdianti', 'FD', NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 14, 'Christio Kharisma Sungkono', NULL, NULL, 'manager', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 14, 'Angelicha Aminah Zairuni Ussu', NULL, NULL, 'manager', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 14, 'Bartolomeus Wisnu Setyo Wibowo Sunadi', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 14, 'Adilah Adzhani', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 2, 'Agus Siek', NULL, NULL, 'direktur', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 20, 'Aditya Thamrin', NULL, NULL, 'direktur', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 23, 'Septian Akhmad S', NULL, NULL, 'supervisor', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 23, 'Kristin Purnama S', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 23, 'Mariatun', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 23, 'Lailatul Komariyah', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 28, 'Hana Restiati', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 10, 'Elvina Ambarwati', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 10, 'Ardhiefa Rachmana Rahman', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 22, 'Roichatun Nasicha', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 22, 'Dinda Trisakti', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 15, 'Abdul Rohman', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 17, 'Achmad Agus Basori', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 16, 'Adi Putra Firmantika', 'AP', NULL, 'supervisor', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 17, 'Agnes Marsellania', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 15, 'Agus Wibowo', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 17, 'Ahmad Siddiq', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 17, 'Ahmat Fahrusi Syakirin Lendar Ali', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 10, 'Akhmad Fathur', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 13, 'Ali Sukoco', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 17, 'Angga Prasetya', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 20, 'Anggy A', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 17, 'Aprlia Inge', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 10, 'Ardhiefa R', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 20, 'Ardianto', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 10, 'Aulia Rahmawati', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 17, 'Ayu Novi', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 19, 'Agus Setiawan', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 10, 'Bangkit Nata Satria', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 10, 'Basofi', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 10, 'Bella Alfi', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 17, 'Busiah', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 7, 'Christhoper Tjhandra', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 21, 'Daniel Dicky Khristian', NULL, NULL, 'manager', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 10, 'Dedy Adi Nugroho', NULL, NULL, 'manager', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(47, 17, 'Dedy Setiawan', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(48, 9, 'Devy Maharani', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(49, 22, 'Dewi Nofitasari', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 15, 'Dwi Slamet Hariadi', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(52, 17, 'Eki Dwi', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(53, 17, 'Erik Dani Yolanda', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(54, 15, 'Erna Cantika Agustina', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(55, 17, 'Erni Ernawati', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(56, 17, 'Fachrul', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(57, 17, 'Fahrizal Bryan SA', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58, 19, 'Fajar', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59, 24, 'Farah Diska Bestari', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(60, 17, 'Farhan Adji', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(61, 16, 'Fatur Anas Widiansyah', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(62, 20, 'Febri', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(63, 17, 'Ginanjar', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(64, 10, 'Gracy Andarista Baskoro', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(65, 28, 'Hana', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(66, 19, 'Handoko', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(67, 14, 'I Made Pande Ari Wijaya', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(68, 23, 'I Putu Dedy Semara Putra', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(69, 10, 'I Wayan Nudra B P', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(70, 17, 'Ibnu Affan', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(71, 10, 'Ilham Hadi Pramana', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(72, 8, 'Inayati Rosyida', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(73, 7, 'Irene Karunia A.', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(74, 23, 'Kristin Purnama Sari', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(75, 10, 'Kusmardiana Rahayu', NULL, NULL, 'manager', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(76, 17, 'Kusmiyati', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(77, 19, 'Kusnul Yulianto', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(78, 19, 'Kuswinarto', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(79, 11, 'Lailatul Wiwin', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(80, 19, 'Leo Agung Eko Nugraha', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(81, 17, 'M. Aulia Safich', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(82, 13, 'M. Choiron Ashari', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(83, 17, 'Marcelllinus D', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(84, 9, 'Maria Cicilia Budhi Eksi Widayanti', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(85, 27, 'Marsela Hadi W', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(86, 19, 'Masjuki', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(87, 11, 'Miftaviansyah Rezza Abdillah (Ivan)', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(88, 10, 'Milla Rahmadiva', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(89, 19, 'Miranda Sesar', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(90, 10, 'Moch Arif F', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(91, 11, 'Moch Wahyudi Stiawan', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(92, 17, 'Moch. Afandi', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(93, 17, 'Moch. Bilal', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(94, 20, 'Moch. Raffi Ramadhan', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(95, 21, 'Moh. Khoerudin Mz', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(96, 17, 'Muhammad Alii Tofa', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(97, 17, 'Muhammad Alvin Rinaldi', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(98, 17, 'Muhammad Matin Sugiti Al Majid', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(99, 17, 'Muhammad Rizky Bahtiar', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(100, 10, 'Multazam Fauzi Utama', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(101, 17, 'Mutmainah (Iin)', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(102, 27, 'Muzdalifah Hilal Lailliyah', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(103, 17, 'Nina Novita', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(104, 21, 'Nofian', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(105, 26, 'Nora Novitasari', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(106, 13, 'Nur Kholidah', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(107, 19, 'Nurhuda', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(108, 15, 'Nuri', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(109, 15, 'Prita Hanifah Novitasari', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(110, 18, 'Purwanto Wiji', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(111, 17, 'Putri Antonia D', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(112, 10, 'Putri Norma Aprilia', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(113, 17, 'Rachmad Juli Purnomo', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(114, 10, 'Raga Rizki Nugraha', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(115, 17, 'Ramadhan Nur Ilham', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(116, 13, 'Rendy', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(117, 10, 'Ricki Rizkyandi', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(118, 11, 'Riky', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(119, 10, 'Rizky Amalia', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(120, 10, 'Rizky Aulia', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(121, 10, 'Robert Stevanus Ramu', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(123, 17, 'Rosyidi', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(124, 17, 'Rusmini', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(125, 17, 'Salimah', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(126, 23, 'Septian Ahmad S', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(127, 23, 'Sevtiyan Sandriya', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(128, 23, 'Sherly Margaretha', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(129, 19, 'Sholikin', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(130, 26, 'Siska Wulandari', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(131, 17, 'Sodiq', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(132, 7, 'Stephanie Kotani Suparno', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(133, 10, 'Steven Seaver Wiarta', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(134, 10, 'Suci Intan Prativy', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(135, 11, 'Sulistiani', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(136, 20, 'Sumariyono', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(137, 19, 'Sunaryo', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(138, 10, 'Supriyadi', NULL, NULL, 'manager', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(139, 20, 'Suwandi', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(140, 7, 'Tan Evi Anggraini', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(141, 19, 'Taufik', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(142, 19, 'Taukid', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(143, 17, 'Tegar Kevin', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(144, 17, 'Tegar Yonata', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(145, 11, 'Teguh Hermawanto', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(146, 17, 'Teotimothy S', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(147, 17, 'Titik Istanti', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(148, 17, 'Uci Puspita Sari', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(149, 20, 'Ummiyati', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(150, 16, 'Viky Maulana M', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(152, 7, 'Vira Aulidiya Sukma', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(153, 17, 'Waqiah', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(154, 8, 'Yarno', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(155, 17, 'Yoel Anstyo', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(156, 17, 'Yoga Pratama', NULL, NULL, 'operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(157, 12, 'Yulianah', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(158, 15, 'Zainal Abidin', NULL, NULL, 'staff', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan_masuks`
--

CREATE TABLE `karyawan_masuks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `karyawan_id` int(11) NOT NULL,
  `pemeriksa_id` int(11) NOT NULL,
  `karyawan_sakit_id` int(11) DEFAULT NULL,
  `tgl_cek` date NOT NULL,
  `alasan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `karyawan_masuks`
--

INSERT INTO `karyawan_masuks` (`id`, `karyawan_id`, `pemeriksa_id`, `karyawan_sakit_id`, `tgl_cek`, `alasan`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 17, NULL, '2021-05-25', 'Ijin', 'aa', '2021-05-25 06:56:58', '2021-05-25 06:56:58'),
(2, 2, 17, 18, '2021-05-25', 'Sakit', NULL, '2021-05-25 06:59:14', '2021-05-25 06:59:14'),
(3, 5, 17, 19, '2021-05-25', 'Sakit', NULL, '2021-05-25 07:03:30', '2021-05-25 07:03:30'),
(4, 4, 17, NULL, '2021-05-25', 'Cuti', 'Cuti Melahirkan', '2021-05-25 07:03:53', '2021-05-25 07:03:53'),
(5, 13, 17, 20, '2021-05-25', 'Sakit', NULL, '2021-05-25 09:54:24', '2021-05-25 09:54:24'),
(6, 4, 17, NULL, '2021-05-25', 'Cuti', 'Nikah', '2021-05-25 09:55:07', '2021-05-25 09:55:07'),
(7, 8, 17, 23, '2021-05-31', 'Sakit', NULL, '2021-05-31 07:26:19', '2021-05-31 07:26:19'),
(8, 2, 65, 30, '2021-06-03', 'Sakit', NULL, '2021-06-03 09:07:00', '2021-06-03 09:07:00');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan_sakits`
--

CREATE TABLE `karyawan_sakits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tgl_cek` date NOT NULL,
  `karyawan_id` int(11) NOT NULL,
  `pemeriksa_id` int(11) NOT NULL,
  `analisa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diagnosa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tindakan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `terapi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `obat_id` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `aturan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `konsumsi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keputusan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `karyawan_sakits`
--

INSERT INTO `karyawan_sakits` (`id`, `tgl_cek`, `karyawan_id`, `pemeriksa_id`, `analisa`, `diagnosa`, `tindakan`, `terapi`, `obat_id`, `jumlah`, `aturan`, `konsumsi`, `keputusan`, `created_at`, `updated_at`) VALUES
(1, '2021-05-21', 1, 17, 'Pusing', 'DD', 'Pengobatan', NULL, 2, NULL, 'Sesudah Makan', '2x1', 'Dipulangkan', '2021-05-21 07:11:24', '2021-05-21 07:11:24'),
(2, '2021-05-21', 2, 17, 'Mual', 'Diagnosa', 'Pengobatan', NULL, 3, NULL, 'Sesudah Makan', '2x1', 'Dipulangkan', '2021-05-21 07:14:40', '2021-05-21 07:14:40'),
(3, '2021-05-21', 5, 17, 'Pilek ', 'Diagnosa', 'Terapi', 'Pijet Pijet', NULL, NULL, NULL, NULL, 'Lanjut bekerja', '2021-05-21 07:15:13', '2021-05-21 07:15:13'),
(4, '2021-05-21', 6, 17, NULL, NULL, 'Pengobatan', NULL, 4, NULL, 'Sebelum Makan', '1x1', 'Lanjut bekerja', '2021-05-21 07:35:45', '2021-05-21 07:35:45'),
(7, '2021-05-12', 13, 17, NULL, NULL, 'Pengobatan', NULL, 2, NULL, 'Sesudah Makan', '1x3', 'Lanjut bekerja', '2021-05-21 09:42:17', '2021-05-21 09:42:17'),
(13, '2021-05-24', 15, 17, 'A', 'D', 'Pengobatan', NULL, 3, NULL, 'Sesudah Makan', '2x1', 'Lanjut bekerja', '2021-05-24 01:30:05', '2021-05-24 01:30:05'),
(15, '2021-05-24', 14, 17, 'Sakit Pilek', 'Diagnosa', 'Pengobatan', NULL, 4, NULL, 'Sesudah Makan', '7x2', 'Lanjut bekerja', '2021-05-24 01:37:25', '2021-05-24 01:37:25'),
(16, '2021-05-24', 7, 17, 'Meriang', 'Masuk Angin', 'Pengobatan', NULL, 1, NULL, 'Sesudah Makan', '1x1', 'Lanjut bekerja', '2021-05-24 07:03:12', '2021-05-24 07:03:12'),
(17, '2021-05-25', 5, 17, 'Sakit Panas', NULL, 'Pengobatan', NULL, 2, NULL, 'Sesudah Makan', '2x1', 'Lanjut bekerja', '2021-05-25 06:49:22', '2021-05-25 06:49:22'),
(18, '2021-05-25', 2, 17, 'Pilek', 'Diagnosa', 'Pengobatan', NULL, 2, NULL, 'Sesudah Makan', '2x1', 'Lanjut bekerja', '2021-05-25 06:59:14', '2021-05-25 06:59:14'),
(19, '2021-05-25', 5, 17, 'Sakit Meriang', NULL, 'Pengobatan', NULL, 5, NULL, 'Sesudah Makan', '7x2', 'Dipulangkan', '2021-05-25 07:03:30', '2021-05-25 07:03:30'),
(20, '2021-05-25', 13, 17, 'Sakit Perut', 'Sakit', 'Pengobatan', NULL, 2, NULL, 'Sesudah Makan', '2x1', 'Dipulangkan', '2021-05-25 09:54:24', '2021-05-25 09:54:24'),
(22, '2021-05-31', 8, 17, 'Ana', 'Diag', 'Pengobatan', NULL, 1, NULL, 'Sebelum Makan', '1x1', 'Lanjut bekerja', '2021-05-31 02:19:56', '2021-05-31 02:19:56'),
(23, '2021-05-31', 8, 17, 'MUal Mual', 'Gak tahu', 'Pengobatan', NULL, 3, NULL, 'Sebelum Makan', '1x1', 'Lanjut bekerja', '2021-05-31 07:26:19', '2021-05-31 07:26:19'),
(24, '2021-06-23', 2, 17, 'Analisa', 'Diagnosa', 'Pengobatan', NULL, 3, NULL, 'Sesudah Makan', '1x1', 'Lanjut bekerja', '2021-06-02 01:34:10', '2021-06-02 01:34:10'),
(25, '2021-06-03', 59, 17, 'Sakit Perut', 'diagnosa', 'Pengobatan', NULL, 2, NULL, 'Sesudah Makan', '1x1', 'Lanjut bekerja', '2021-06-03 06:51:20', '2021-06-03 06:51:20'),
(26, '2021-06-03', 15, 65, 'Perbaikan', 'DIagnosa Diagnosa', 'Pengobatan', NULL, 3, NULL, 'Sesudah Makan', '2x1', 'Lanjut bekerja', '2021-06-03 08:25:23', '2021-06-03 08:25:23'),
(27, '2021-06-03', 7, 17, 'Analisa', 'Diagnosa', 'Pengobatan', NULL, 1, NULL, 'Sebelum Makan', '1x1', 'Lanjut bekerja', '2021-06-03 08:48:51', '2021-06-03 08:48:51'),
(28, '2021-06-24', 28, 17, 'Ana', 'Diag', 'Terapi', 'Tera', NULL, NULL, NULL, NULL, 'Dipulangkan', '2021-06-03 08:49:35', '2021-06-03 08:49:35'),
(29, '2021-06-03', 22, 17, 'Analisa', 'Diagnosa', 'Pengobatan', NULL, 1, 1, 'Sebelum Makan', '4x6', 'Lanjut bekerja', '2021-06-03 08:57:21', '2021-06-03 08:57:21'),
(30, '2021-06-03', 2, 65, 'A', 'D', 'Pengobatan', NULL, 4, 2, 'Sebelum Makan', '1x1', 'Lanjut bekerja', '2021-06-03 09:07:00', '2021-06-03 09:07:00'),
(31, '2021-06-16', 24, 17, 'Pegel-pegel', 'abc', 'Pengobatan', NULL, 1, 1, 'Sesudah Makan', '1x1', 'Lanjut bekerja', '2021-06-16 06:42:56', '2021-06-16 06:42:56');

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
-- Table structure for table `kesehatan_awals`
--

CREATE TABLE `kesehatan_awals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `karyawan_id` int(11) NOT NULL,
  `vaksin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket_vaksin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tinggi` double NOT NULL,
  `berat` double NOT NULL,
  `lemak` double DEFAULT NULL,
  `kandungan_air` double DEFAULT NULL,
  `otot` double DEFAULT NULL,
  `tulang` double DEFAULT NULL,
  `kalori` double DEFAULT NULL,
  `status_mata` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mata_kiri` int(11) DEFAULT NULL,
  `mata_kanan` int(11) DEFAULT NULL,
  `suhu` double NOT NULL,
  `spo2` int(11) NOT NULL,
  `pr` int(11) NOT NULL,
  `tes_covid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hasil_covid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_covid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_mcu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kesehatan_awals`
--

INSERT INTO `kesehatan_awals` (`id`, `karyawan_id`, `vaksin`, `ket_vaksin`, `tinggi`, `berat`, `lemak`, `kandungan_air`, `otot`, `tulang`, `kalori`, `status_mata`, `mata_kiri`, `mata_kanan`, `suhu`, `spo2`, `pr`, `tes_covid`, `hasil_covid`, `file_covid`, `file_mcu`, `created_at`, `updated_at`) VALUES
(1, 5, 'Belum', NULL, 175, 85, NULL, NULL, NULL, NULL, NULL, 'Normal', NULL, NULL, 0, 0, 0, 'Saliva', 'negatif', NULL, NULL, '2021-04-27 03:27:28', '2021-04-27 03:27:28'),
(2, 2, 'Belum', NULL, 168, 80, NULL, NULL, NULL, NULL, NULL, 'Normal', NULL, NULL, 0, 0, 0, 'Saliva', 'negatif', NULL, NULL, '2021-04-27 03:32:22', '2021-04-27 03:32:22'),
(3, 1, 'Sudah', 'Disuntik aja', 165, 54, 20, 32, 21, 22, 1131, 'Normal', NULL, NULL, 0, 0, 0, 'Antibody', 'reaktif', NULL, NULL, '2021-05-04 03:02:58', '2021-05-04 03:02:58'),
(4, 6, 'Belum', NULL, 180, 60, NULL, NULL, NULL, NULL, NULL, 'Normal', NULL, NULL, 0, 0, 0, NULL, NULL, NULL, 'Christio Kharisma Sungkono_MCU_PO0000-1212.pdf', '2021-05-17 02:25:16', '2021-05-17 02:25:16'),
(5, 13, 'Belum', NULL, 170, 60, NULL, NULL, NULL, NULL, NULL, 'Normal', 5, 6, 0, 0, 0, NULL, NULL, NULL, 'Septian Akhmad S_MCU_Outer 1000+(Depan).pdf', '2021-05-17 02:29:32', '2021-05-17 02:29:32'),
(6, 7, 'Sudah', 'asdasd', 176, 50, 121, 12, 11.3, 13.2, 1900, 'Normal', 2, 6, 0, 0, 0, 'Genose / PCR', 'Positif', NULL, NULL, '2021-05-17 04:58:50', '2021-05-17 04:58:50'),
(7, 14, 'Belum', NULL, 150, 30, NULL, NULL, NULL, NULL, NULL, 'Normal', 7, 8, 0, 0, 0, 'Genose / PCR', 'Positif', 'Kristin Purnama S_COVID_Price List TRAY & LADDER 2021.pdf', 'Kristin Purnama S_MCU_Kalender Akademik Untag Surabaya-29 Juli 2020.pdf', '2021-05-18 09:47:35', '2021-05-18 09:47:35'),
(8, 46, 'Belum', NULL, 160, 60, NULL, NULL, NULL, NULL, NULL, 'Normal', 7, 4, 0, 0, 0, 'Saliva', 'C', NULL, NULL, '2021-06-02 01:24:00', '2021-06-02 01:24:00'),
(9, 18, 'Belum', NULL, 170, 50, NULL, NULL, NULL, NULL, NULL, 'Normal', 7, 6, 30, 100, 110, 'Antibody', 'C/IG', NULL, NULL, '2021-06-02 04:39:24', '2021-06-02 04:39:24'),
(10, 24, 'Belum', NULL, 12, 12, NULL, NULL, NULL, NULL, NULL, 'Abnormal', 12, 12, 12, 12, 12, 'Antigen', 'C/T', NULL, NULL, '2021-06-09 01:09:54', '2021-06-09 01:09:54'),
(11, 88, 'Sudah', 'Vaksin pertama', 160, 50, 15, 30, 12, 30, 22, 'Normal', 9, 9, 36, 90, 120, 'Antigen', 'C', NULL, NULL, '2021-06-15 09:48:36', '2021-06-15 09:48:36'),
(12, 25, 'Belum', NULL, 170, 70, NULL, NULL, NULL, NULL, NULL, 'Normal', 1, 10, 37, 100, 98, NULL, NULL, NULL, NULL, '2021-06-23 09:14:23', '2021-06-23 09:14:23');

-- --------------------------------------------------------

--
-- Table structure for table `kesehatan_harians`
--

CREATE TABLE `kesehatan_harians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tgl_cek` date NOT NULL,
  `karyawan_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suhu_pagi` double DEFAULT NULL,
  `suhu_siang` double DEFAULT NULL,
  `spo2` int(11) DEFAULT NULL,
  `pr` int(11) DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kesehatan_harians`
--

INSERT INTO `kesehatan_harians` (`id`, `tgl_cek`, `karyawan_id`, `suhu_pagi`, `suhu_siang`, `spo2`, `pr`, `keterangan`, `created_at`, `updated_at`) VALUES
(6, '2021-04-29', '6', 42, 36, 105, 95, 'a', '2021-04-29 03:06:46', '2021-04-30 06:41:11'),
(7, '2021-04-29', '7', 35, 36, 104, 97, 'b', '2021-04-29 03:06:46', '2021-04-29 03:06:46'),
(8, '2021-04-29', '8', 35, 36, 98, 97, 'c', '2021-04-29 03:06:46', '2021-04-29 03:06:46'),
(9, '2021-04-29', '9', 35, 36, 98, 97, 's', '2021-04-29 03:06:46', '2021-04-29 03:06:46'),
(17, '2021-04-28', '6', 37, 46, 13, 13, NULL, '2021-04-29 03:45:27', '2021-04-29 03:45:27'),
(18, '2021-04-28', '7', 34.3, 36, 13, 13, NULL, '2021-04-29 03:45:27', '2021-04-29 03:45:27'),
(19, '2021-04-28', '8', 35.2, 34, 13, 13, NULL, '2021-04-29 03:45:27', '2021-04-29 03:45:27'),
(20, '2021-04-28', '9', 38.2, 37, 13, 58, NULL, '2021-04-29 03:45:27', '2021-04-29 03:45:27'),
(21, '2021-04-01', '1', 34, 36, 98, 96, NULL, '2021-04-29 04:17:53', '2021-04-29 04:17:53'),
(22, '2021-04-01', '2', 36.8, 32, 98, 94, NULL, '2021-04-29 04:17:53', '2021-04-29 04:17:53'),
(23, '2021-04-01', '3', 36.2, 32, 98, 98, NULL, '2021-04-29 04:17:53', '2021-04-29 04:17:53'),
(24, '2021-04-01', '4', 34, 36, 98, 95, NULL, '2021-04-29 04:17:53', '2021-04-29 04:17:53'),
(25, '2021-04-01', '5', 36, 36, 98, 96, NULL, '2021-04-29 04:17:53', '2021-04-29 04:17:53'),
(26, '2021-04-29', '1', 37.1, 32, 98, 103, 'sdf', '2021-04-29 09:01:20', '2021-04-30 06:41:21'),
(27, '2021-04-29', '2', 36.1, 38.1, 98, 101, 'sdfsdf', '2021-04-29 09:01:20', '2021-04-30 06:41:45'),
(28, '2021-04-29', '3', 32, 32, 14, 98, 'sdfsdf', '2021-04-29 09:01:20', '2021-04-30 03:34:59'),
(29, '2021-04-29', '4', 40, 32, 80, 101, 'fsdfs', '2021-04-29 09:01:20', '2021-04-30 03:33:29'),
(30, '2021-04-29', '5', 37.9, 32, 90, 101, 'sdfsd', '2021-04-29 09:01:20', '2021-04-30 08:49:13'),
(31, '2021-05-03', '1', NULL, NULL, NULL, NULL, NULL, '2021-05-03 04:46:43', '2021-05-03 04:46:43'),
(32, '2021-05-03', '2', NULL, NULL, NULL, NULL, NULL, '2021-05-03 04:46:43', '2021-05-03 04:46:43'),
(33, '2021-05-03', '3', NULL, NULL, NULL, NULL, NULL, '2021-05-03 04:46:43', '2021-05-03 04:46:43'),
(34, '2021-05-03', '4', 37, 37, 99, 81, NULL, '2021-05-03 04:46:43', '2021-05-03 04:46:43'),
(35, '2021-05-03', '5', NULL, NULL, NULL, NULL, NULL, '2021-05-03 04:46:43', '2021-05-03 04:46:43'),
(36, '2021-05-04', '1', NULL, NULL, NULL, NULL, NULL, '2021-05-03 04:47:11', '2021-05-03 04:47:11'),
(37, '2021-05-04', '2', NULL, NULL, NULL, NULL, NULL, '2021-05-03 04:47:11', '2021-05-03 04:47:11'),
(38, '2021-05-04', '3', NULL, NULL, NULL, NULL, NULL, '2021-05-03 04:47:11', '2021-05-03 04:47:11'),
(39, '2021-05-04', '4', 36, 37, 99, 75, NULL, '2021-05-03 04:47:11', '2021-05-03 04:47:11'),
(40, '2021-05-04', '5', NULL, NULL, NULL, NULL, NULL, '2021-05-03 04:47:11', '2021-05-03 04:47:11'),
(41, '2021-06-02', '18', NULL, NULL, NULL, NULL, NULL, '2021-06-02 01:25:20', '2021-06-02 01:25:20'),
(42, '2021-06-02', '19', NULL, NULL, NULL, NULL, NULL, '2021-06-02 01:25:20', '2021-06-02 01:25:20'),
(43, '2021-06-02', '29', NULL, NULL, NULL, NULL, NULL, '2021-06-02 01:25:20', '2021-06-02 01:25:20'),
(44, '2021-06-02', '34', NULL, NULL, NULL, NULL, NULL, '2021-06-02 01:25:20', '2021-06-02 01:25:20'),
(45, '2021-06-02', '36', NULL, NULL, NULL, NULL, NULL, '2021-06-02 01:25:20', '2021-06-02 01:25:20'),
(46, '2021-06-02', '39', NULL, NULL, NULL, NULL, NULL, '2021-06-02 01:25:20', '2021-06-02 01:25:20'),
(47, '2021-06-02', '41', NULL, NULL, NULL, NULL, NULL, '2021-06-02 01:25:20', '2021-06-02 01:25:20'),
(48, '2021-06-02', '42', NULL, NULL, NULL, NULL, NULL, '2021-06-02 01:25:20', '2021-06-02 01:25:20'),
(49, '2021-06-02', '46', 32, NULL, NULL, NULL, NULL, '2021-06-02 01:25:20', '2021-06-02 01:25:20'),
(50, '2021-06-02', '64', NULL, NULL, NULL, NULL, NULL, '2021-06-02 01:25:20', '2021-06-02 01:25:20'),
(51, '2021-06-02', '69', NULL, NULL, NULL, NULL, NULL, '2021-06-02 01:25:20', '2021-06-02 01:25:20'),
(52, '2021-06-02', '71', NULL, NULL, NULL, NULL, NULL, '2021-06-02 01:25:20', '2021-06-02 01:25:20'),
(53, '2021-06-02', '75', NULL, NULL, NULL, NULL, NULL, '2021-06-02 01:25:20', '2021-06-02 01:25:20'),
(54, '2021-06-02', '88', 35, 32, 100, 40, NULL, '2021-06-02 01:25:20', '2021-06-16 03:06:03'),
(55, '2021-06-02', '90', NULL, NULL, NULL, NULL, NULL, '2021-06-02 01:25:20', '2021-06-02 01:25:20'),
(56, '2021-06-02', '100', NULL, NULL, NULL, NULL, NULL, '2021-06-02 01:25:20', '2021-06-02 01:25:20'),
(57, '2021-06-02', '112', NULL, NULL, NULL, NULL, NULL, '2021-06-02 01:25:20', '2021-06-02 01:25:20'),
(58, '2021-06-02', '114', NULL, NULL, NULL, NULL, NULL, '2021-06-02 01:25:20', '2021-06-02 01:25:20'),
(59, '2021-06-02', '117', NULL, NULL, NULL, NULL, NULL, '2021-06-02 01:25:20', '2021-06-02 01:25:20'),
(60, '2021-06-02', '119', NULL, NULL, NULL, NULL, NULL, '2021-06-02 01:25:20', '2021-06-02 01:25:20'),
(61, '2021-06-02', '120', NULL, NULL, NULL, NULL, NULL, '2021-06-02 01:25:20', '2021-06-02 01:25:20'),
(62, '2021-06-02', '121', NULL, NULL, NULL, NULL, NULL, '2021-06-02 01:25:20', '2021-06-02 01:25:20'),
(63, '2021-06-02', '133', NULL, NULL, NULL, NULL, NULL, '2021-06-02 01:25:20', '2021-06-02 01:25:20'),
(64, '2021-06-02', '134', NULL, NULL, NULL, NULL, NULL, '2021-06-02 01:25:20', '2021-06-02 01:25:20'),
(65, '2021-06-02', '138', NULL, NULL, NULL, NULL, NULL, '2021-06-02 01:25:20', '2021-06-02 01:25:20'),
(66, '2021-06-15', '46', NULL, NULL, NULL, NULL, NULL, '2021-06-15 09:51:17', '2021-06-15 09:51:17'),
(67, '2021-06-15', '18', NULL, NULL, NULL, NULL, NULL, '2021-06-15 09:51:17', '2021-06-15 09:51:17'),
(68, '2021-06-15', '88', 38, 36, 85, 110, NULL, '2021-06-15 09:51:17', '2021-06-16 02:49:47'),
(69, '2021-06-16', '46', NULL, NULL, NULL, NULL, NULL, '2021-06-16 03:02:17', '2021-06-16 03:02:17'),
(70, '2021-06-16', '18', NULL, NULL, NULL, NULL, NULL, '2021-06-16 03:02:17', '2021-06-16 03:02:17'),
(71, '2021-06-16', '88', 32, 35, 99, 80, NULL, '2021-06-16 03:02:17', '2021-06-16 03:02:17'),
(72, '2021-06-16', '46', NULL, NULL, NULL, NULL, NULL, '2021-06-16 03:03:17', '2021-06-16 03:03:17'),
(73, '2021-06-16', '18', NULL, NULL, NULL, NULL, NULL, '2021-06-16 03:03:17', '2021-06-16 03:03:17'),
(74, '2021-06-16', '88', 33, 41, 80, 99, NULL, '2021-06-16 03:03:17', '2021-06-16 03:26:03');

-- --------------------------------------------------------

--
-- Table structure for table `kesehatan_mingguan_rapids`
--

CREATE TABLE `kesehatan_mingguan_rapids` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `karyawan_id` int(11) NOT NULL,
  `pemeriksa_id` int(11) NOT NULL,
  `tgl_cek` date NOT NULL,
  `hasil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kesehatan_mingguan_rapids`
--

INSERT INTO `kesehatan_mingguan_rapids` (`id`, `karyawan_id`, `pemeriksa_id`, `tgl_cek`, `hasil`, `jenis`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 13, 20, '2021-05-31', 'Non reaktif', 'Rapid', NULL, '2021-05-31 03:55:43', '2021-05-31 03:55:43'),
(2, 14, 21, '2021-05-31', 'Non reaktif', 'Rapid', NULL, '2021-05-31 03:55:43', '2021-05-31 03:55:43'),
(3, 15, 17, '2021-05-31', 'Non reaktif', 'Rapid', NULL, '2021-05-31 03:55:43', '2021-05-31 03:55:43'),
(4, 16, 21, '2021-05-31', 'Non reaktif', 'Rapid', NULL, '2021-05-31 03:55:43', '2021-05-31 03:55:43'),
(5, 6, 21, '2021-05-31', 'Non reaktif', 'Rapid', NULL, '2021-05-31 04:28:14', '2021-05-31 04:28:14'),
(6, 7, 17, '2021-05-31', 'Non reaktif', 'Rapid', NULL, '2021-05-31 04:28:14', '2021-05-31 04:28:14'),
(7, 8, 21, '2021-05-31', 'Non reaktif', 'Rapid', NULL, '2021-05-31 04:28:14', '2021-05-31 04:28:14'),
(8, 9, 17, '2021-05-31', 'Non reaktif', 'Rapid', NULL, '2021-05-31 04:28:14', '2021-05-31 04:28:14'),
(9, 11, 21, '2021-06-03', 'Non reaktif', 'Rapid', NULL, '2021-06-02 01:29:02', '2021-06-02 01:29:02'),
(11, 6, 21, '2021-06-25', 'IgG-IgM', 'Rapid', NULL, '2021-06-25 06:28:43', '2021-06-25 08:43:13'),
(12, 7, 21, '2021-06-25', 'Non reaktif', 'Rapid', NULL, '2021-06-25 07:26:08', '2021-06-25 07:26:08'),
(14, 7, 21, '2021-06-25', 'Non reaktif', 'Rapid', NULL, '2021-06-25 07:31:43', '2021-06-25 07:31:43'),
(15, 6, 21, '2021-06-25', 'C', 'Antigen', NULL, '2021-06-25 07:31:43', '2021-06-25 07:31:43');

-- --------------------------------------------------------

--
-- Table structure for table `kesehatan_mingguan_tensis`
--

CREATE TABLE `kesehatan_mingguan_tensis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `karyawan_id` int(11) NOT NULL,
  `tgl_cek` date NOT NULL,
  `sistolik` int(11) DEFAULT NULL,
  `diastolik` int(11) DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kesehatan_mingguan_tensis`
--

INSERT INTO `kesehatan_mingguan_tensis` (`id`, `karyawan_id`, `tgl_cek`, `sistolik`, `diastolik`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 7, '2021-06-21', 129, 84, NULL, '2021-06-21 06:00:33', '2021-06-21 06:00:33'),
(2, 6, '2021-06-21', 160, 100, NULL, '2021-06-21 06:00:33', '2021-06-21 06:00:33'),
(3, 5, '2021-06-18', 110, 84, NULL, '2021-06-21 06:28:40', '2021-06-21 06:28:40'),
(4, 2, '2021-06-18', 141, 91, NULL, '2021-06-21 06:28:40', '2021-06-21 06:28:40'),
(5, 1, '2021-06-18', 130, 85, NULL, '2021-06-21 06:28:40', '2021-06-21 06:28:40'),
(16, 7, '2021-06-22', 110, 84, NULL, '2021-06-23 02:36:03', '2021-06-23 04:05:25'),
(17, 6, '2021-06-22', 105, 90, NULL, '2021-06-23 02:36:03', '2021-06-23 02:36:03');

-- --------------------------------------------------------

--
-- Table structure for table `kesehatan_tahunans`
--

CREATE TABLE `kesehatan_tahunans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `karyawan_id` int(11) NOT NULL,
  `pemeriksa_id` int(11) NOT NULL,
  `tgl_cek` date NOT NULL,
  `mata_kiri` int(11) NOT NULL,
  `mata_kanan` int(11) NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kesehatan_tahunans`
--

INSERT INTO `kesehatan_tahunans` (`id`, `karyawan_id`, `pemeriksa_id`, `tgl_cek`, `mata_kiri`, `mata_kanan`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 2, 17, '2021-05-28', 7, 4, NULL, '2021-05-28 02:35:21', '2021-05-31 01:39:17'),
(2, 5, 17, '2021-05-28', 8, 8, NULL, '2021-05-28 02:35:51', '2021-05-28 02:35:51'),
(3, 3, 17, '2021-05-25', 4, 7, 'Rabun jauh', '2021-05-28 02:36:15', '2021-05-31 01:39:31'),
(4, 2, 17, '2021-06-18', 7, 4, NULL, '2021-06-02 01:32:06', '2021-06-02 01:32:06'),
(5, 88, 17, '2021-06-16', 6, 7, NULL, '2021-06-16 06:31:57', '2021-06-16 06:31:57'),
(6, 88, 17, '2021-06-16', 8, 9, NULL, '2021-06-16 06:32:20', '2021-06-16 06:32:20');

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
(150, '2021_04_22_144659_update_karyawans_column', 112),
(153, '2021_04_23_090424_add_and_update_column_in_hasil_perakitans_table', 113),
(155, '2021_04_23_123905_update_column_status_in_hasil_perakitans_table', 114),
(156, '2021_04_23_130524_update_column_status_in_histori_hasil_perakitans_table', 115),
(160, '2021_04_25_141800_update_hasil_column_in_hasil_perakitans_table', 116),
(164, '2021_04_23_150203_create_kesehatan_awals', 117),
(165, '2021_04_27_113636_create_monitoring_proses_table', 118),
(166, '2021_04_27_114626_create_hasil_monitoring_proses_table', 119),
(168, '2021_04_27_143711_create_tim_kesehatans', 120),
(169, '2019_11_09_055735_create_settings_table', 121),
(170, '2019_11_11_170438_create_custom_fields_table', 121),
(171, '2019_11_12_122144_create_file_types_table', 121),
(172, '2019_11_12_155907_create_tags_table', 121),
(173, '2019_11_13_150331_create_documents_table', 121),
(174, '2019_11_14_144921_create_documents_tags_table', 121),
(175, '2019_11_15_122537_create_files_table', 121),
(182, '2021_04_20_043558_create_dokumen_engs_table', 122),
(183, '2021_04_29_090010_create_kesehatan_harians', 122),
(186, '2021_05_03_092726_create_permissions_table', 123),
(189, '2021_05_03_120115_create_ik_pemeriksaan_pengujians_table', 124),
(190, '2021_05_03_124120_create_hasil_ik_pemeriksaan_pengujians_table', 125),
(191, '2021_05_03_144057_create_pemeriksaan_proses_pengujians_table', 126),
(192, '2021_05_03_144145_create_hasil_pemeriksaan_proses_pengujians_table', 127),
(193, '2021_05_05_075411_create_monitoring_proses_ik_pengujians_table', 128),
(196, '2021_05_05_082048_create_kesehatan_mingguan_tensis', 129),
(197, '2021_05_05_105515_create_kesehatan_mingguan_rapids', 130),
(198, '2021_05_07_143701_update_status_in_hasil_monitoring_proses_table', 131),
(199, '2021_05_10_090801_update_operator_in_pengemasans_table', 132),
(200, '2021_05_10_090851_create_hasil_pengemasans_table', 133),
(201, '2021_05_10_091027_create_cek_pengemasans_table', 134),
(202, '2021_05_10_091056_create_detail_cek_pengemasans_table', 135),
(203, '2021_05_10_091152_create_hasil_pengemasan_detail_cek_pengemasans_table', 136),
(204, '2021_05_10_102709_add_nama_barang_in_detail_cek_pengemasans_table', 137),
(206, '2021_05_10_123513_create_berat_karyawans', 138),
(207, '2021_05_11_080524_add_tanggal_column_pengemasans_table', 139),
(208, '2021_05_17_082906_create_perbaikan_produksis_table', 140),
(209, '2021_05_17_090430_create_perbaikan_produksi_no_seris_table', 141),
(210, '2021_05_17_090442_create_perbaikan_produksi_parts_table', 142),
(211, '2021_05_17_091633_update_kesehatan', 143),
(213, '2021_05_18_140222_create_gcu_karyawans', 144),
(214, '2021_05_20_085215_create_persiapan_packing_produks_table', 145),
(215, '2021_05_20_110256_create_detail_persiapan_packing_produks_table', 146),
(216, '2021_05_21_090032_create_obats', 147),
(218, '2021_05_21_102213_create_karyawan_sakits', 148),
(220, '2021_05_24_081511_add_ppic_id_on_produks_table', 149),
(221, '2021_05_24_100801_update_obats', 150),
(222, '2021_05_24_114238_create_perbaikan_produksi_perakitans_table', 151),
(223, '2021_05_24_114252_create_perbaikan_produksi_pengujians_table', 152),
(224, '2021_05_24_114408_create_perbaikan_produksi_pengemasans_table', 153),
(226, '2021_05_25_084452_create_karyawan_masuks', 154),
(229, '2021_05_28_085511_create_kesehatan_tahunans', 155),
(230, '2021_05_28_081823_create_penyerahan_barang_jadis_table', 156),
(231, '2021_05_28_082242_create_detail_penyerahan_barang_jadis_table', 157),
(233, '2021_05_31_102503_update_kesehatan_migguan_rapid', 158),
(234, '2021_05_31_104611_update_kesehatan_mingguab_rapids', 159),
(235, '2021_06_02_101831_create_produk_bill_of_materials_table', 160),
(236, '2021_06_02_102739_update_column_in_bill_of_materials_table', 161),
(237, '2021_06_02_102235_create_update_kesehatan_awals', 162),
(238, '2021_06_02_131041_create_permintaan_bahan_bakus_table', 163),
(239, '2021_06_02_131052_create_detail_permintaan_bahan_bakus_table', 164),
(241, '2021_06_03_112712_update_foreign_in_bill_of_materials_table', 166),
(242, '2021_06_03_114619_create_part_gudang_part_engs_table', 167),
(243, '2021_06_03_132608_update_foreign_part_eng_in_bill_of_materials_table', 168),
(244, '2021_06_03_111619_update_kesehatan_jumlah', 169),
(247, '2021_06_07_102156_create_pengembalian_barang_gudangs_table', 170),
(248, '2021_06_07_103202_create_detail_pengembalian_barang_gudangs_table', 171),
(249, '2021_06_07_154958_update_rename_and_add_jumlah_on_detail_pengembalian_barang_gudangs_table', 172),
(250, '0000_00_00_000000_create_websockets_statistics_entries_table', 173),
(251, '2021_06_07_155454_update_berat_karyawan', 174),
(253, '2021_06_08_115905_create_analisa_ps_perakitans_table', 175),
(254, '2021_06_08_130459_create_analisa_ps_perakitan_parts_table', 176),
(255, '2021_06_08_130729_create_analisa_ps_pengujians_table', 177),
(256, '2021_06_08_130818_create_analisa_ps_pengujian_parts_table', 178),
(257, '2021_06_08_130923_create_analisa_ps_pengemasans_table', 179),
(258, '2021_06_08_131055_create_analisa_ps_pengemasan_parts_table', 180),
(259, '2021_06_09_101758_update_kode_karyawan_in_karyawans_table', 181),
(260, '2021_06_09_103358_update_alias_in_perakitans_table', 182),
(261, '2021_06_11_092302_add_ppic_id_analisa_ps_perakitans_table', 183),
(262, '2021_06_11_144946_update_part_in_perbaikan_produksi_parts_table', 184),
(263, '2021_06_14_142809_update_barcode_monitoring_proses_table', 185),
(264, '2021_06_14_144517_update_barcode_pengemasans_table', 186),
(266, '2021_06_25_135317_update_mingguan_rapid', 187);

-- --------------------------------------------------------

--
-- Table structure for table `monitoring_proses`
--

CREATE TABLE `monitoring_proses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bppb_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggal` date NOT NULL,
  `alias_barcode` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `karyawan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `monitoring_proses`
--

INSERT INTO `monitoring_proses` (`id`, `bppb_id`, `tanggal`, `alias_barcode`, `karyawan_id`, `user_id`, `created_at`, `updated_at`) VALUES
(3, 29, '2021-04-28', NULL, 16, 7, '2021-04-28 04:55:45', '2021-04-29 07:11:20'),
(9, 29, '2021-04-29', NULL, 15, 7, '2021-04-29 01:01:38', '2021-04-29 01:01:38'),
(10, 29, '2021-04-29', NULL, 15, 7, '2021-04-29 09:07:28', '2021-04-29 09:07:28'),
(13, 29, '2021-05-19', NULL, NULL, 2, '2021-05-19 09:40:44', '2021-05-19 09:40:44'),
(14, 29, '2021-05-25', NULL, NULL, 2, '2021-05-25 02:08:51', '2021-05-25 02:08:51'),
(15, 29, '2021-05-27', NULL, NULL, 2, '2021-05-27 09:44:52', '2021-05-27 09:44:52'),
(16, 32, '2021-06-14', NULL, 120, 7, '2021-06-14 04:38:16', '2021-06-14 04:38:16'),
(18, 32, '2021-06-17', 'FB/01/0621/A', 14, 7, '2021-06-17 06:47:36', '2021-06-17 06:47:36'),
(22, 32, '2021-06-17', 'FB/01/0621/A', 53, 7, '2021-06-17 08:51:15', '2021-06-17 08:51:15'),
(23, 32, '2021-06-23', '', 2, 7, '2021-06-23 04:53:58', '2021-06-23 04:53:58'),
(24, 32, '2021-06-29', 'FB/01/0621/A', 14, 7, '2021-06-29 03:45:42', '2021-06-29 03:45:42');

-- --------------------------------------------------------

--
-- Table structure for table `monitoring_proses_ik_pengujians`
--

CREATE TABLE `monitoring_proses_ik_pengujians` (
  `monitoring_id` bigint(20) UNSIGNED NOT NULL,
  `hasil_ik_id` bigint(20) UNSIGNED NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(39, 'Perakitan', 'telah menambahkan Laporan Perakitan', 2, 9, '/perakitan', NULL, '2021-04-18 19:40:33', '2021-04-18 19:40:33'),
(40, 'Perakitan', 'telah menambahkan Laporan Perakitan', 2, 1, '/perakitan', NULL, '2021-06-09 01:41:27', '2021-06-09 01:41:27'),
(41, 'Perakitan', 'telah menambahkan Laporan Perakitan', 2, 9, '/perakitan', NULL, '2021-06-09 01:41:27', '2021-06-09 01:41:27'),
(42, 'Perakitan', 'telah menambahkan Laporan Perakitan', 2, 1, '/perakitan', NULL, '2021-06-09 01:44:43', '2021-06-09 01:44:43'),
(43, 'Perakitan', 'telah menambahkan Laporan Perakitan', 2, 9, '/perakitan', NULL, '2021-06-09 01:44:43', '2021-06-09 01:44:43'),
(44, 'Perakitan', 'telah menghapus Perakitan ', 2, 1, '/perakitan', NULL, '2021-06-10 04:51:25', '2021-06-10 04:51:25'),
(45, 'Perakitan', 'telah menghapus Perakitan ', 2, 9, '/perakitan', NULL, '2021-06-10 04:51:25', '2021-06-10 04:51:25'),
(46, 'Perakitan', 'telah menghapus Perakitan ', 2, 1, '/perakitan', NULL, '2021-06-16 07:23:15', '2021-06-16 07:23:15'),
(47, 'Perakitan', 'telah menghapus Perakitan ', 2, 9, '/perakitan', NULL, '2021-06-16 07:23:15', '2021-06-16 07:23:15'),
(48, 'Perakitan', 'telah menghapus Perakitan ', 2, 1, '/perakitan', NULL, '2021-06-16 07:23:22', '2021-06-16 07:23:22'),
(49, 'Perakitan', 'telah menghapus Perakitan ', 2, 9, '/perakitan', NULL, '2021-06-16 07:23:23', '2021-06-16 07:23:23'),
(50, 'Perakitan', 'telah menghapus Perakitan ', 2, 1, '/perakitan', NULL, '2021-06-16 07:23:31', '2021-06-16 07:23:31'),
(51, 'Perakitan', 'telah menghapus Perakitan ', 2, 9, '/perakitan', NULL, '2021-06-16 07:23:31', '2021-06-16 07:23:31'),
(52, 'Perakitan', 'telah menghapus Perakitan ', 2, 1, '/perakitan', NULL, '2021-06-16 07:23:41', '2021-06-16 07:23:41'),
(53, 'Perakitan', 'telah menghapus Perakitan ', 2, 9, '/perakitan', NULL, '2021-06-16 07:23:41', '2021-06-16 07:23:41'),
(54, 'Perakitan', 'telah menghapus Perakitan ', 2, 1, '/perakitan', NULL, '2021-06-16 07:23:50', '2021-06-16 07:23:50'),
(55, 'Perakitan', 'telah menghapus Perakitan ', 2, 9, '/perakitan', NULL, '2021-06-16 07:23:50', '2021-06-16 07:23:50'),
(56, 'Perakitan', 'telah menghapus Perakitan ', 2, 1, '/perakitan', NULL, '2021-06-16 07:23:59', '2021-06-16 07:23:59'),
(57, 'Perakitan', 'telah menghapus Perakitan ', 2, 9, '/perakitan', NULL, '2021-06-16 07:23:59', '2021-06-16 07:23:59'),
(58, 'Perakitan', 'telah menghapus Perakitan ', 2, 1, '/perakitan', NULL, '2021-06-16 07:24:11', '2021-06-16 07:24:11'),
(59, 'Perakitan', 'telah menghapus Perakitan ', 2, 9, '/perakitan', NULL, '2021-06-16 07:24:11', '2021-06-16 07:24:11'),
(60, 'Perakitan', 'telah menghapus Perakitan ', 2, 1, '/perakitan', NULL, '2021-06-16 07:24:20', '2021-06-16 07:24:20'),
(61, 'Perakitan', 'telah menghapus Perakitan ', 2, 9, '/perakitan', NULL, '2021-06-16 07:24:20', '2021-06-16 07:24:20'),
(62, 'Perakitan', 'telah menghapus Perakitan ', 2, 1, '/perakitan', NULL, '2021-06-16 07:24:29', '2021-06-16 07:24:29'),
(63, 'Perakitan', 'telah menghapus Perakitan ', 2, 9, '/perakitan', NULL, '2021-06-16 07:24:29', '2021-06-16 07:24:29'),
(64, 'Perakitan', 'telah menghapus Perakitan ', 2, 1, '/perakitan', NULL, '2021-06-16 07:24:37', '2021-06-16 07:24:37'),
(65, 'Perakitan', 'telah menghapus Perakitan ', 2, 9, '/perakitan', NULL, '2021-06-16 07:24:37', '2021-06-16 07:24:37'),
(66, 'Perakitan', 'telah menghapus Perakitan ', 2, 1, '/perakitan', NULL, '2021-06-17 04:40:52', '2021-06-17 04:40:52'),
(67, 'Perakitan', 'telah menghapus Perakitan ', 2, 9, '/perakitan', NULL, '2021-06-17 04:40:52', '2021-06-17 04:40:52'),
(68, 'Perakitan', 'telah menghapus Perakitan ', 2, 1, '/perakitan', NULL, '2021-06-17 04:42:48', '2021-06-17 04:42:48'),
(69, 'Perakitan', 'telah menghapus Perakitan ', 2, 9, '/perakitan', NULL, '2021-06-17 04:42:48', '2021-06-17 04:42:48'),
(70, 'Perakitan', 'telah menghapus Perakitan ', 2, 1, '/perakitan', NULL, '2021-06-17 04:42:55', '2021-06-17 04:42:55'),
(71, 'Perakitan', 'telah menghapus Perakitan ', 2, 9, '/perakitan', NULL, '2021-06-17 04:42:55', '2021-06-17 04:42:55'),
(72, 'Perakitan', 'telah menghapus Perakitan ', 2, 1, '/perakitan', NULL, '2021-06-17 04:43:03', '2021-06-17 04:43:03'),
(73, 'Perakitan', 'telah menghapus Perakitan ', 2, 9, '/perakitan', NULL, '2021-06-17 04:43:03', '2021-06-17 04:43:03'),
(74, 'Perakitan', 'telah menghapus Perakitan ', 2, 1, '/perakitan', NULL, '2021-06-17 04:43:10', '2021-06-17 04:43:10'),
(75, 'Perakitan', 'telah menghapus Perakitan ', 2, 9, '/perakitan', NULL, '2021-06-17 04:43:10', '2021-06-17 04:43:10'),
(76, 'Perakitan', 'telah menghapus Perakitan ', 2, 1, '/perakitan', NULL, '2021-06-17 04:43:20', '2021-06-17 04:43:20'),
(77, 'Perakitan', 'telah menghapus Perakitan ', 2, 9, '/perakitan', NULL, '2021-06-17 04:43:20', '2021-06-17 04:43:20'),
(78, 'Perakitan', 'telah menghapus Perakitan ', 2, 1, '/perakitan', NULL, '2021-06-17 04:43:28', '2021-06-17 04:43:28'),
(79, 'Perakitan', 'telah menghapus Perakitan ', 2, 9, '/perakitan', NULL, '2021-06-17 04:43:28', '2021-06-17 04:43:28'),
(80, 'Perakitan', 'telah menghapus Perakitan ', 2, 1, '/perakitan', NULL, '2021-06-17 04:43:35', '2021-06-17 04:43:35'),
(81, 'Perakitan', 'telah menghapus Perakitan ', 2, 9, '/perakitan', NULL, '2021-06-17 04:43:35', '2021-06-17 04:43:35'),
(82, 'Perakitan', 'telah menghapus Perakitan ', 2, 1, '/perakitan', NULL, '2021-06-17 04:43:43', '2021-06-17 04:43:43'),
(83, 'Perakitan', 'telah menghapus Perakitan ', 2, 9, '/perakitan', NULL, '2021-06-17 04:43:43', '2021-06-17 04:43:43'),
(84, 'Perakitan', 'telah menghapus Perakitan ', 2, 1, '/perakitan', NULL, '2021-06-17 04:43:50', '2021-06-17 04:43:50'),
(85, 'Perakitan', 'telah menghapus Perakitan ', 2, 9, '/perakitan', NULL, '2021-06-17 04:43:50', '2021-06-17 04:43:50');

-- --------------------------------------------------------

--
-- Table structure for table `obats`
--

CREATE TABLE `obats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int(11) NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `obats`
--

INSERT INTO `obats` (`id`, `nama`, `stok`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Antangin', 0, NULL, NULL, '2021-06-16 06:42:57'),
(2, 'Promag 5g', 1, NULL, NULL, '2021-06-03 06:51:20'),
(3, 'Decolgen Flu', 2, NULL, NULL, '2021-06-03 08:25:23'),
(4, 'Panadol Sakit Kepala', 1, NULL, NULL, '2021-06-03 09:07:00'),
(5, 'Mixagrip Flu dan Batuk', 1, NULL, '2021-05-24 03:10:59', '2021-05-24 03:10:59');

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
  `kode` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` enum('pcs','set','unit','dus','roll','meter','pack') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `layout` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('ada','tidak_ada') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parts`
--

INSERT INTO `parts` (`kode`, `nama`, `jumlah`, `satuan`, `layout`, `status`, `created_at`, `updated_at`) VALUES
('SPFX00A0001', 'ADAPTOR', 167, NULL, NULL, NULL, NULL, NULL),
('SPFX00A0002', 'ACRILIC/LCD PROTECTIVE', 83, NULL, NULL, NULL, NULL, NULL),
('SPFX00B0001', 'BATTERY LITHIUM', 154, NULL, NULL, NULL, NULL, NULL),
('SPFX00B0002', 'BAUT (Size;          )', 2407, NULL, NULL, NULL, NULL, NULL),
('SPFX00B0003', 'BUKU MANUAL FOX BABY', 123, NULL, NULL, NULL, NULL, NULL),
('SPFX00C0001', 'CASING DEPAN BIRU', 34, NULL, NULL, NULL, NULL, NULL),
('SPFX00C0002', 'CASING DEPAN KUNING', 42, NULL, NULL, NULL, NULL, NULL),
('SPFX00C0003', 'CASING DEPAN PINK', 35, NULL, NULL, NULL, NULL, NULL),
('SPFX00C0004', 'CASING BELAKANG', 88, NULL, NULL, NULL, NULL, NULL),
('SPFX00C0005', 'CHARGER', 102, NULL, NULL, NULL, NULL, NULL),
('SPFX00I0001', 'INNER FOX BABY             (689pcs  Model lama)', 1092, NULL, NULL, NULL, NULL, NULL),
('SPFX00K0001', 'KABEL DATA USB', 124, NULL, NULL, NULL, NULL, NULL),
('SPFX00K0002', 'KARET HITAM ATAS', 101, NULL, NULL, NULL, NULL, NULL),
('SPFX00K0003', 'KARET HITAM BAWAH', 96, NULL, NULL, NULL, NULL, NULL),
('SPFX00K0004', 'KOTAK PACKING ABU\" (FOX BABY )', 122, NULL, NULL, NULL, NULL, NULL),
('SPFX00K0005', 'KARET SENSOR ATAS', 432, NULL, NULL, NULL, NULL, NULL),
('SPFX00K0006', 'KARET SENSOR BAWAH', 70, NULL, NULL, NULL, NULL, NULL),
('SPFX00O0001', 'OUTER FOX 3, FOX BABY(520x330x290)', 423, NULL, NULL, NULL, NULL, NULL),
('SPFX00O0002', 'OUTER FOX 3, FOX BABY(390x320x380)', 595, NULL, NULL, NULL, NULL, NULL),
('SPFX00P0001', 'PCB BATERAI', 231, NULL, NULL, NULL, NULL, NULL),
('SPFX00P0002', 'PCB MAINBOARD FOX BABY', 88, NULL, NULL, NULL, NULL, NULL),
('SPFX00R0001', 'RANGKA+ LCD + PCB BATERY', 123, NULL, NULL, NULL, NULL, NULL),
('SPFX00R0002', 'RANGKA + LCD', 123, NULL, NULL, NULL, NULL, NULL),
('SPFX00R0003', 'RANGKA TENGAH', 95, NULL, NULL, NULL, NULL, NULL),
('SPFX00R0004', 'RANGKA BAWAH(casing bawah+rangka tengah)', 123, NULL, NULL, NULL, NULL, NULL),
('SPFX00S0001', 'STICKER BACK CHARGER', 45, NULL, NULL, NULL, NULL, NULL),
('SPFX00S0002', 'STICKER SERIAL NUMBER ', 88, NULL, NULL, NULL, NULL, NULL),
('SPFX00S0003', 'STICKER LABEL USB', 360, NULL, NULL, NULL, NULL, NULL),
('SPFX00S0004', 'SPRING FOX BABY', 193, NULL, NULL, NULL, NULL, NULL),
('SPFX00T0001', 'TALI GANTUNG', 301, NULL, NULL, NULL, NULL, NULL),
('SPFX00T0002', 'TOMBOL ON/ OFF', 91, NULL, NULL, NULL, NULL, NULL),
('SPFX00T0003', 'TUTUP BATTERY BIRU', 31, NULL, NULL, NULL, NULL, NULL),
('SPFX00T0004', 'TUTUP BATTERY KUNING', 43, NULL, NULL, NULL, NULL, NULL),
('SPFX00T0005', 'TUTUP BATTERY PINK', 30, NULL, NULL, NULL, NULL, NULL),
('SPFX00U0001', 'UPPER COVER', 110, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `part_engs`
--

CREATE TABLE `part_engs` (
  `kode_part` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spesifikasi` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('ada','tidak_ada') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `part_engs`
--

INSERT INTO `part_engs` (`kode_part`, `nama`, `foto`, `deskripsi`, `spesifikasi`, `status`, `created_at`, `updated_at`) VALUES
('A10140401', 'TOP CASING (BLUE)', NULL, NULL, NULL, NULL, NULL, NULL),
('A10140402', 'TOP CASING (YELLOW)', NULL, NULL, NULL, NULL, NULL, NULL),
('A10140403', 'TOP CASING (PINK)', NULL, NULL, NULL, NULL, NULL, NULL),
('A10140404', 'LCD COVER', NULL, NULL, NULL, NULL, NULL, NULL),
('A10140405', 'BUTTON', NULL, NULL, NULL, NULL, NULL, NULL),
('A10140406', 'MAINBOARD', NULL, NULL, NULL, NULL, NULL, NULL),
('A10140407', 'MAINBOARD COVER', NULL, NULL, NULL, NULL, NULL, NULL),
('A10140408', 'SENSOR COVER (TOP)', NULL, NULL, NULL, NULL, NULL, NULL),
('A10140409', 'LCD  ', NULL, NULL, NULL, NULL, NULL, NULL),
('B10140401', 'BOTTOM CASING', NULL, NULL, NULL, NULL, NULL, NULL),
('B10140402', 'MAINBOARD HOLDER', NULL, NULL, NULL, NULL, NULL, NULL),
('B10140403', 'SENSOR COVER (BOTTOM)', NULL, NULL, NULL, NULL, NULL, NULL),
('B10140404', 'SPRING', NULL, NULL, NULL, NULL, NULL, NULL),
('B10140405', 'BATTERY COVER (BLUE)', NULL, NULL, NULL, NULL, NULL, NULL),
('B10140406', 'BATTERY COVER (YELLOW)', NULL, NULL, NULL, NULL, NULL, NULL),
('B10140407', 'BATTERY COVER (PINK)', NULL, NULL, NULL, NULL, NULL, NULL),
('C101404', 'OUTER', NULL, NULL, NULL, NULL, NULL, NULL),
('C10140401', 'BOX FOR UNIT', NULL, NULL, NULL, NULL, NULL, NULL),
('C10140402', 'PACKING MICA', NULL, NULL, NULL, NULL, NULL, NULL),
('C10140403', 'ADAPTOR', NULL, NULL, NULL, NULL, NULL, NULL),
('C10140404', 'USB CABLE', NULL, NULL, NULL, NULL, NULL, NULL),
('C10140405', 'CHARGER', NULL, NULL, NULL, NULL, NULL, NULL),
('C10140406', 'LANYARD', NULL, NULL, NULL, NULL, NULL, NULL),
('C10140407', 'MANUAL BOOK (ENG)', NULL, NULL, NULL, NULL, NULL, NULL),
('C10140408', 'MANUAL BOOK (IND)', NULL, NULL, NULL, NULL, NULL, NULL),
('C10140409', 'COLOR BOX', NULL, NULL, NULL, NULL, NULL, NULL),
('S012030130200060', 'PAN HEAD SCREW (3)\r\n ST2 X 6 mm', NULL, NULL, NULL, NULL, NULL, NULL),
('S16061', 'COIN BATTERY', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `part_gudang_part_engs`
--

CREATE TABLE `part_gudang_part_engs` (
  `kode_gudang` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_eng` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `part_gudang_part_engs`
--

INSERT INTO `part_gudang_part_engs` (`kode_gudang`, `kode_eng`, `created_at`, `updated_at`) VALUES
('SPFX00A0001', 'C10140403', NULL, NULL),
('SPFX00A0002', 'A10140404', NULL, NULL),
('SPFX00B0001', 'S16061', NULL, NULL),
('SPFX00B0002', 'S012030130200060', NULL, NULL),
('SPFX00B0003', 'C10140408', NULL, NULL),
('SPFX00B0003', 'C10140402', NULL, NULL),
('SPFX00C0001', 'A10140401', NULL, NULL),
('SPFX00C0002', 'A10140402', NULL, NULL),
('SPFX00C0003', 'A10140403', NULL, NULL),
('SPFX00C0004', 'B10140401', NULL, NULL),
('SPFX00C0005', 'C10140405', NULL, NULL),
('SPFX00I0001', 'C10140409', NULL, NULL),
('SPFX00K0001', 'C10140404', NULL, NULL),
('SPFX00K0002', 'A10140408', NULL, NULL),
('SPFX00K0003', 'B10140403', NULL, NULL),
('SPFX00K0004', 'C10140401', NULL, NULL),
('SPFX00K0004', 'C10140402', NULL, NULL),
('SPFX00O0002', 'C101404', NULL, NULL),
('SPFX00P0002', 'A10140406', NULL, NULL),
('SPFX00R0002', 'A10140409', NULL, NULL),
('SPFX00R0003', 'B10140402', NULL, NULL),
('SPFX00S0004', 'B10140404', NULL, NULL),
('SPFX00T0001', 'C10140406', NULL, NULL),
('SPFX00T0002', 'A10140405', NULL, NULL),
('SPFX00T0003', 'B10140405', NULL, NULL),
('SPFX00T0004', 'B10140406', NULL, NULL),
('SPFX00T0005', 'B10140407', NULL, NULL),
('SPFX00U0001', 'A10140407', NULL, NULL);

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
-- Table structure for table `pemeriksaan_proses_pengujians`
--

CREATE TABLE `pemeriksaan_proses_pengujians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bppb_id` bigint(20) UNSIGNED DEFAULT NULL,
  `no_pemeriksaan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal` date NOT NULL,
  `jumlah_produksi` int(11) DEFAULT NULL,
  `jumlah_sampling` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemeriksaan_proses_pengujians`
--

INSERT INTO `pemeriksaan_proses_pengujians` (`id`, `bppb_id`, `no_pemeriksaan`, `tanggal`, `jumlah_produksi`, `jumlah_sampling`, `created_at`, `updated_at`) VALUES
(4, 29, 'TR05001', '2021-05-05', 10, 10, '2021-05-04 06:55:52', '2021-05-04 06:55:52'),
(5, 29, 'TR05001', '2021-05-04', 10, 10, '2021-05-04 07:11:31', '2021-05-04 07:11:31');

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
  `karyawan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggal` date NOT NULL,
  `alias_barcode` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('dibuat','penyerahan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengemasans`
--

INSERT INTO `pengemasans` (`id`, `bppb_id`, `pic_id`, `karyawan_id`, `tanggal`, `alias_barcode`, `status`, `created_at`, `updated_at`) VALUES
(11, 29, 2, 1, '2021-05-11', NULL, 'penyerahan', '2021-05-11 01:49:31', '2021-06-03 08:34:19'),
(12, 29, 2, 1, '2021-05-18', NULL, 'penyerahan', '2021-05-18 09:43:30', '2021-06-07 09:38:37'),
(13, 29, 2, 3, '2021-05-27', NULL, 'penyerahan', '2021-05-27 04:05:26', '2021-06-03 09:05:33'),
(14, 32, 2, 1, '2021-06-15', 'FB/01/2106/A', 'penyerahan', '2021-06-15 03:30:34', '2021-06-28 06:23:25'),
(17, 32, 2, 1, '2021-06-28', 'FB/01/0621/A', 'dibuat', '2021-06-28 09:29:00', '2021-06-28 09:29:00');

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian_barang_gudangs`
--

CREATE TABLE `pengembalian_barang_gudangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bppb_id` bigint(20) UNSIGNED DEFAULT NULL,
  `divisi_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('dibuat','req_pengembalian','acc_pengembalian','rej_pengembalian') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penyerahan_barang_jadis`
--

CREATE TABLE `penyerahan_barang_jadis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bppb_id` bigint(20) UNSIGNED NOT NULL,
  `divisi_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('dibuat','req_penyerahan','penyerahan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penyerahan_barang_jadis`
--

INSERT INTO `penyerahan_barang_jadis` (`id`, `bppb_id`, `divisi_id`, `tanggal`, `status`, `created_at`, `updated_at`) VALUES
(6, 29, 12, '2021-06-03', 'req_penyerahan', '2021-06-03 08:34:19', '2021-06-03 08:34:19'),
(7, 29, 12, '2021-06-07', 'req_penyerahan', '2021-06-07 09:38:37', '2021-06-07 09:38:37'),
(8, 32, 13, '2021-06-28', 'req_penyerahan', '2021-06-28 06:23:25', '2021-06-28 06:23:25'),
(10, 32, 13, '2021-07-07', 'req_penyerahan', '2021-07-07 04:07:38', '2021-07-07 04:07:38');

-- --------------------------------------------------------

--
-- Table structure for table `perakitans`
--

CREATE TABLE `perakitans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bppb_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pic_id` bigint(20) UNSIGNED DEFAULT NULL,
  `alias_tim` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('0','12') COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `perakitans`
--

INSERT INTO `perakitans` (`id`, `bppb_id`, `pic_id`, `alias_tim`, `tanggal`, `created_at`, `updated_at`, `status`) VALUES
(41, 32, 2, 'SWIN', '2021-06-09', '2021-06-09 06:55:57', '2021-06-09 06:55:57', '0'),
(42, 32, 2, 'RLSL', '2021-06-09', '2021-06-09 06:55:57', '2021-06-09 06:55:57', '0'),
(59, 32, 2, 'ANED', '2021-06-17', '2021-06-17 01:40:37', '2021-06-17 01:40:37', '0'),
(65, 32, 2, 'ASAP', '2021-06-23', '2021-06-23 03:08:21', '2021-06-23 03:08:21', '0');

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
(NULL, 2, NULL, '2021-04-21 22:32:04', '2021-04-21 22:32:04'),
(NULL, 3, NULL, '2021-04-21 22:32:04', '2021-04-21 22:32:04'),
(NULL, 2, NULL, '2021-04-22 01:03:36', '2021-04-22 01:03:36'),
(NULL, 5, NULL, '2021-04-22 01:03:37', '2021-04-22 01:03:37'),
(NULL, 1, NULL, '2021-04-22 01:04:04', '2021-04-22 01:04:04'),
(NULL, 5, NULL, '2021-04-22 01:04:04', '2021-04-22 01:04:04'),
(NULL, 1, NULL, '2021-06-09 01:41:27', '2021-06-09 01:41:27'),
(NULL, 31, NULL, '2021-06-09 01:41:27', '2021-06-09 01:41:27'),
(NULL, 1, NULL, '2021-06-09 01:44:43', '2021-06-09 01:44:43'),
(NULL, 2, NULL, '2021-06-09 01:44:43', '2021-06-09 01:44:43'),
(41, 1, NULL, '2021-06-09 06:55:57', '2021-06-09 06:55:57'),
(41, 2, NULL, '2021-06-09 06:55:57', '2021-06-09 06:55:57'),
(42, 3, NULL, '2021-06-09 06:55:57', '2021-06-09 06:55:57'),
(42, 4, NULL, '2021-06-09 06:55:57', '2021-06-09 06:55:57'),
(NULL, 1, NULL, '2021-06-10 01:30:18', '2021-06-10 01:30:18'),
(NULL, 5, NULL, '2021-06-15 07:55:32', '2021-06-15 07:55:32'),
(NULL, 43, NULL, '2021-06-15 07:55:32', '2021-06-15 07:55:32'),
(NULL, 22, NULL, '2021-06-15 07:57:25', '2021-06-15 07:57:25'),
(NULL, 23, NULL, '2021-06-15 07:57:25', '2021-06-15 07:57:25'),
(NULL, 17, NULL, '2021-06-15 08:00:16', '2021-06-15 08:00:16'),
(NULL, 19, NULL, '2021-06-15 08:00:16', '2021-06-15 08:00:16'),
(NULL, 14, NULL, '2021-06-15 09:20:08', '2021-06-15 09:20:08'),
(NULL, 15, NULL, '2021-06-15 09:20:08', '2021-06-15 09:20:08'),
(NULL, 7, NULL, '2021-06-16 01:51:17', '2021-06-16 01:51:17'),
(NULL, 6, NULL, '2021-06-16 01:51:39', '2021-06-16 01:51:39'),
(NULL, 28, NULL, '2021-06-16 07:22:22', '2021-06-16 07:22:22'),
(NULL, 31, NULL, '2021-06-16 07:22:22', '2021-06-16 07:22:22'),
(NULL, 25, NULL, '2021-06-16 07:22:22', '2021-06-16 07:22:22'),
(NULL, 70, NULL, '2021-06-16 07:22:22', '2021-06-16 07:22:22'),
(NULL, 5, NULL, '2021-06-16 07:27:22', '2021-06-16 07:27:22'),
(NULL, 23, NULL, '2021-06-16 07:27:22', '2021-06-16 07:27:22'),
(NULL, 27, NULL, '2021-06-16 07:27:22', '2021-06-16 07:27:22'),
(NULL, 52, NULL, '2021-06-16 07:27:22', '2021-06-16 07:27:22'),
(NULL, 74, NULL, '2021-06-16 09:49:49', '2021-06-16 09:49:49'),
(59, 37, NULL, '2021-06-17 01:40:37', '2021-06-17 01:40:37'),
(NULL, 73, NULL, '2021-06-17 01:49:28', '2021-06-17 01:49:28'),
(NULL, 43, NULL, '2021-06-17 03:15:15', '2021-06-17 03:15:15'),
(NULL, 22, NULL, '2021-06-17 03:16:03', '2021-06-17 03:16:03'),
(NULL, 26, NULL, '2021-06-17 03:16:03', '2021-06-17 03:16:03'),
(NULL, 51, NULL, '2021-06-17 03:16:03', '2021-06-17 03:16:03'),
(NULL, 158, NULL, '2021-06-17 03:16:03', '2021-06-17 03:16:03'),
(NULL, 152, NULL, '2021-06-17 03:17:43', '2021-06-17 03:17:43'),
(NULL, 48, NULL, '2021-06-17 03:17:43', '2021-06-17 03:17:43'),
(65, 27, NULL, '2021-06-23 03:08:21', '2021-06-23 03:08:21'),
(65, 31, NULL, '2021-06-23 03:08:21', '2021-06-23 03:08:21');

-- --------------------------------------------------------

--
-- Table structure for table `perbaikan_perakitans`
--

CREATE TABLE `perbaikan_perakitans` (
  `perbaikan_id` bigint(20) UNSIGNED NOT NULL,
  `hasil_perakitan_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perbaikan_produksis`
--

CREATE TABLE `perbaikan_produksis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bppb_id` bigint(20) UNSIGNED DEFAULT NULL,
  `karyawan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `kondisi_produk` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ketidaksesuaian_proses` enum('perakitan','pengujian','pengemasan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `sebab_ketidaksesuaian` enum('bahan_baku','operator') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_permintaan` date NOT NULL,
  `nomor` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_pengerjaan` date DEFAULT NULL,
  `analisa` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `realisasi_pengerjaan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('req_perbaikan','acc_perbaikan','rej_perbaikan','do_perbaikan','done_perbaikan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `perbaikan_produksis`
--

INSERT INTO `perbaikan_produksis` (`id`, `bppb_id`, `karyawan_id`, `kondisi_produk`, `ketidaksesuaian_proses`, `sebab_ketidaksesuaian`, `tanggal_permintaan`, `nomor`, `tanggal_pengerjaan`, `analisa`, `realisasi_pengerjaan`, `status`, `created_at`, `updated_at`) VALUES
(2, 29, 1, 'Perlu Perbaikan', 'perakitan', 'operator', '2021-05-17', 'PB/PR/0001/05/21', '2021-05-18', 'Blabla', 'Blabla', 'acc_perbaikan', '2021-05-17 09:39:43', '2021-05-18 06:03:55'),
(4, 29, 3, 'Tes', 'perakitan', 'operator', '2021-05-18', 'PB/PR/0001/05/21', '2021-05-18', 'Tes', 'Tes', 'acc_perbaikan', '2021-05-18 08:44:00', '2021-05-18 09:42:06'),
(5, 29, 1, 'Perbaikan Pengujian', 'pengujian', 'operator', '2021-05-19', 'PB/PR/0001/05/21', '2021-05-19', 'Perbaikan Pengujian TES', 'TESTESTESTES', 'acc_perbaikan', '2021-05-19 01:22:24', '2021-05-19 01:22:24'),
(13, 29, 2, 'Tidak Baik', 'pengemasan', 'operator', '2021-05-19', 'PB/PR/0002/05/21', '2021-05-19', 'Manual Book tidak ada', 'Manual Books', 'acc_perbaikan', '2021-05-19 09:40:44', '2021-05-19 09:40:44'),
(14, 29, 3, 'Tes', 'pengujian', 'bahan_baku', '2021-05-19', 'PB/PR/0002/05/21', '2021-05-19', 'Tes', 'Tes', 'acc_perbaikan', '2021-05-19 09:54:24', '2021-05-19 09:54:24'),
(19, 29, 1, 'Tdk bisa nyala', 'pengemasan', 'bahan_baku', '2021-05-25', 'PB/PR/0002/05/21', '2021-05-25', 'bahan baku', 'Pengganti bahan baku', 'acc_perbaikan', '2021-05-25 02:08:51', '2021-05-25 02:08:51'),
(20, 29, 3, 'Perbaikan', 'perakitan', 'bahan_baku', '2021-05-25', 'PB/PR/0001/25/05/21', '2021-05-25', 'Perbaikan 2', 'Perbaikan 2', 'acc_perbaikan', '2021-05-25 04:12:50', '2021-05-25 04:12:50'),
(21, 29, 18, 'Kabel putus', 'perakitan', 'operator', '2021-05-25', 'PB/PR/0001/05/21', '2021-05-25', 'Pengecekan Kabel', 'Mengganti Kabel', 'acc_perbaikan', '2021-05-25 08:58:14', '2021-05-25 08:58:14'),
(22, 29, 4, 'Tes', 'pengemasan', 'bahan_baku', '2021-05-27', 'PB/PR/0002/05/21', '2021-05-27', 'Tes', 'tes', 'acc_perbaikan', '2021-05-27 09:44:52', '2021-05-27 09:44:52'),
(24, 32, 24, 'LCD Lecet', 'perakitan', 'bahan_baku', '2021-06-11', 'PB/FX04/0001/06/21', '2021-06-11', 'LCD Cover sobek', 'Mengganti LCD Cover Baru', 'acc_perbaikan', '2021-06-11 08:35:18', '2021-06-11 08:35:18'),
(25, 32, 24, 'Casing tutup tidak rapat', 'perakitan', 'operator', '2021-06-15', 'PB/PR/0002/05/21', '2021-06-15', 'Casing tutup tidak rapat', 'Mengganti casing', 'acc_perbaikan', '2021-06-15 06:24:46', '2021-06-15 06:24:46'),
(27, 32, 1, 'Tes', 'pengujian', 'operator', '2021-06-18', 'FB/PR/0001/06/21', '2021-06-18', 'Tes', 'Tes', 'acc_perbaikan', '2021-06-18 04:29:11', '2021-06-18 04:29:11'),
(28, 32, 24, 'Tidak Baik', 'pengujian', 'operator', '2021-06-21', 'FB/PR/0002/06/21', '2021-06-21', 'LCD Cover', 'LCD Diganti', 'acc_perbaikan', '2021-06-21 07:19:35', '2021-06-21 07:19:35');

-- --------------------------------------------------------

--
-- Table structure for table `perbaikan_produksi_no_seris`
--

CREATE TABLE `perbaikan_produksi_no_seris` (
  `perbaikan_produksi_id` bigint(20) UNSIGNED NOT NULL,
  `hasil_perakitan_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perbaikan_produksi_parts`
--

CREATE TABLE `perbaikan_produksi_parts` (
  `perbaikan_produksi_id` bigint(20) UNSIGNED NOT NULL,
  `bill_of_material_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `perbaikan_produksi_parts`
--

INSERT INTO `perbaikan_produksi_parts` (`perbaikan_produksi_id`, `bill_of_material_id`, `created_at`, `updated_at`) VALUES
(24, 218, '2021-06-11 08:35:18', '2021-06-11 08:35:18'),
(24, 240, '2021-06-11 08:35:18', '2021-06-11 08:35:18'),
(25, 217, '2021-06-15 06:24:46', '2021-06-15 06:24:46'),
(27, 231, '2021-06-18 04:29:11', '2021-06-18 04:29:11'),
(27, 232, '2021-06-18 04:29:11', '2021-06-18 04:29:11'),
(27, 233, '2021-06-18 04:29:11', '2021-06-18 04:29:11'),
(27, 234, '2021-06-18 04:29:11', '2021-06-18 04:29:11'),
(27, 235, '2021-06-18 04:29:11', '2021-06-18 04:29:11'),
(28, 218, '2021-06-21 07:19:35', '2021-06-21 07:19:35'),
(28, 223, '2021-06-21 07:19:35', '2021-06-21 07:19:35');

-- --------------------------------------------------------

--
-- Table structure for table `perbaikan_produksi_pengemasans`
--

CREATE TABLE `perbaikan_produksi_pengemasans` (
  `perbaikan_produksi_id` bigint(20) UNSIGNED NOT NULL,
  `hasil_pengemasan_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perbaikan_produksi_pengujians`
--

CREATE TABLE `perbaikan_produksi_pengujians` (
  `perbaikan_produksi_id` bigint(20) UNSIGNED NOT NULL,
  `hasil_monitoring_proses_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `perbaikan_produksi_pengujians`
--

INSERT INTO `perbaikan_produksi_pengujians` (`perbaikan_produksi_id`, `hasil_monitoring_proses_id`, `created_at`, `updated_at`) VALUES
(27, 45, '2021-06-18 04:29:11', '2021-06-18 04:29:11'),
(28, 45, '2021-06-21 07:19:35', '2021-06-21 07:19:35');

-- --------------------------------------------------------

--
-- Table structure for table `perbaikan_produksi_perakitans`
--

CREATE TABLE `perbaikan_produksi_perakitans` (
  `perbaikan_produksi_id` bigint(20) UNSIGNED NOT NULL,
  `hasil_perakitan_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `perbaikan_produksi_perakitans`
--

INSERT INTO `perbaikan_produksi_perakitans` (`perbaikan_produksi_id`, `hasil_perakitan_id`, `created_at`, `updated_at`) VALUES
(24, 92, '2021-06-11 08:35:18', '2021-06-11 08:35:18'),
(25, 93, '2021-06-15 06:24:46', '2021-06-15 06:24:46');

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_bahan_bakus`
--

CREATE TABLE `permintaan_bahan_bakus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bppb_id` bigint(20) UNSIGNED NOT NULL,
  `divisi_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` enum('dibuat','req_permintaan','acc_permintaan','rej_permintaan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permintaan_bahan_bakus`
--

INSERT INTO `permintaan_bahan_bakus` (`id`, `bppb_id`, `divisi_id`, `tanggal`, `jumlah`, `status`, `created_at`, `updated_at`) VALUES
(2, 32, 11, '2021-06-04', 10, 'acc_permintaan', '2021-06-04 06:05:28', '2021-06-04 07:15:44');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `persiapan_packing_produks`
--

CREATE TABLE `persiapan_packing_produks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bppb_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('req_persiapan','acc_persiapan','rej_persiapan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `persiapan_packing_produks`
--

INSERT INTO `persiapan_packing_produks` (`id`, `bppb_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(6, 28, 2, 'req_persiapan', '2021-05-21 07:30:56', '2021-05-21 07:30:56');

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
  `ppic_id` bigint(20) UNSIGNED DEFAULT NULL,
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

INSERT INTO `produks` (`id`, `kelompok_produk_id`, `kategori_id`, `ppic_id`, `merk`, `tipe`, `nama`, `kode_barcode`, `nama_coo`, `no_akd`, `keterangan`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, 'elitech', 'SP-10', 'Digital Spirometer DS-PRO', 'SP01', 'SP-10', 'KEMENKES RI AKD 20401610237', NULL, 'hide', '2021-02-17 02:10:54', '2021-02-25 08:33:46'),
(2, 1, 1, NULL, 'elitech', 'DS-PRO100', 'Portable Spirometer', 'SP02', 'DS-PRO100', 'KEMENKES RI AKD 20401710665', NULL, NULL, '2021-02-17 02:17:06', '2021-02-17 02:17:06'),
(3, 1, 1, NULL, 'elitech', 'PROMIST-1', 'Mini Compressor Nebulizer', 'CN01', 'PROMIST-1', 'KEMENKES RI AKD 20403318003', NULL, NULL, '2021-02-17 00:33:42', '2021-02-17 00:33:42'),
(4, 1, 1, NULL, 'elitech', 'PROMIST-3', 'Medical Nebulizer', 'MN03', 'PROMIST-3', 'KEMENKES RI AKD 20403710661', NULL, NULL, '2021-02-17 00:43:49', '2021-02-17 00:43:49'),
(5, 1, 1, NULL, 'elitech', 'ULTRA MIST', 'Ultrasonic Nebulizer', 'UN01', 'ULTRA MIST', 'KEMENKES RI AKD 20403710663', NULL, NULL, '2021-02-17 00:49:18', '2021-02-17 00:49:18'),
(6, 1, 1, NULL, 'elitech', 'MOC-A', 'Oxygen Concentrator', 'OC01', 'MOC-A', 'KEMENKES RI AKD 20403510582', NULL, NULL, '2021-02-17 00:52:30', '2021-02-17 00:52:30'),
(7, 1, 2, 11, 'elitech', 'FOX-BABY', 'Pulse Oximeter', 'FX04', 'FOX-BABY', 'KEMENKES RI AKD 20502318005', NULL, NULL, '2021-02-17 01:01:37', '2021-02-17 01:01:37'),
(8, 1, 2, NULL, 'elitech', 'FOX-3', 'Pulse Oximeter', 'FX06', 'FOX-3', 'KEMENKES RI AKD 20502210101', NULL, NULL, '2021-02-17 01:05:31', '2021-02-17 01:05:31'),
(9, 1, 2, NULL, 'elitech', 'PM50', 'SPO2 Monitor', 'PM07', 'PM50', '5656', 'we', NULL, '2021-02-17 01:08:00', '2021-04-05 23:24:52'),
(10, 1, 2, NULL, 'elitech', 'ABPM50', 'Ambulatory Blood Pressure Monitor', 'PM06', 'ABPM50', 'KEMENKES RI AKD 20501510581', NULL, NULL, '2021-02-17 01:12:41', '2021-02-17 01:12:41'),
(11, 1, 2, NULL, 'elitech', 'TENSIONE', 'Electrocardiograph', 'BP01', 'TENSIONE', 'KEMENKES RI AKD 20501318004', NULL, NULL, '2021-02-20 07:20:32', '2021-02-20 07:20:32'),
(12, 1, 2, NULL, 'elitech', 'ECG-300G', 'Electrocardiograph', 'EM02', 'ECG-300G', 'KEMENKES RI AKD 21102900255', NULL, NULL, '2021-02-20 07:22:28', '2021-02-20 07:22:28'),
(13, 1, 2, NULL, 'elitech', 'ECG-1200G', 'Electrocardiograph', 'EM03', 'ECG-1200G', 'KEMENKES RI AKD 20502310189', NULL, NULL, '2021-02-20 07:24:16', '2021-02-20 07:24:16'),
(14, 1, 2, NULL, 'elitech', 'PM-9000+', 'Patient Monitor', 'PM01', 'PM-9000+', 'KEMENKES RI AKD 20903900075', NULL, NULL, '2021-02-20 07:26:16', '2021-02-20 07:26:16'),
(15, 1, 4, NULL, 'elitech', 'TS-5830', 'Dental Unit', 'DU01', 'TS-5830', 'KEMENKES RI AKD 10605900071', NULL, NULL, '2021-02-20 07:29:55', '2021-02-20 07:29:55'),
(16, 1, 4, NULL, 'elitech', 'TS-8830', 'Dental Unit', 'DU02', 'TS-8830', 'KEMENKES RI AKD 10605810069', NULL, NULL, '2021-02-20 07:31:24', '2021-02-20 07:31:24'),
(17, 1, 4, NULL, 'elitech', 'TOP-308', 'Dental Unit', 'DU03', 'TOP-308', 'KEMENKES RI AKD 10605900070', NULL, NULL, '2021-02-20 07:32:48', '2021-02-20 07:32:48'),
(18, 1, 5, NULL, 'elitech', 'END-1 (1 Fungsi)', 'Medical Destroyer', 'ND03', 'END-1 (1 Fungsi)', 'KEMENKES RI AKD 20902210075', NULL, NULL, '2021-02-20 07:35:42', '2021-02-20 07:35:42'),
(19, 1, 6, NULL, 'elitech', 'BL-50B', 'Infant Phototherapy Unit', 'BL01', 'BL-50B', 'KEMENKES RI AKD 20903900073', NULL, NULL, '2021-02-20 07:38:01', '2021-02-20 07:38:01'),
(20, 1, 6, NULL, 'elitech', 'BN-100', 'Infant Warmer', 'BN01', 'BN-100', 'KEMENKES RI AKD 20903900074', NULL, NULL, '2021-02-20 07:40:39', '2021-02-20 07:40:39'),
(21, 1, 6, NULL, 'elitech', 'BB-200', 'Infant Incubator', 'BB01', 'BB-200', 'KEMENKES RI AKD 20903900076', NULL, NULL, '2021-02-20 07:42:39', '2021-02-20 07:42:39'),
(22, 1, 6, NULL, 'elitech', 'BT-100 (SMALL TROLLEY)', 'Infant Incubator Transport', 'BT01', 'BT-100 (SMALL TROLLEY)', 'KEMENKES RI AKD 20902710901', NULL, NULL, '2021-02-20 07:45:20', '2021-02-20 07:45:20'),
(23, 1, 7, NULL, 'elitech', 'MEL-02', 'Lampu Periksa LED', 'ML01', 'MEL-02', 'KEMENKES RI AKD 10903710660', NULL, NULL, '2021-02-20 07:47:22', '2021-02-20 07:47:22'),
(24, 1, 7, NULL, 'elitech', 'MOL-01', 'Lampu Operasi LED', 'OL01', 'MOL-01', 'KEMENKES RI AKD 21603710667', NULL, NULL, '2021-02-20 07:49:47', '2021-02-20 07:49:47'),
(25, 1, 7, NULL, 'elitech', 'MOL-02', 'Lampu Operasi LED', 'OL21', 'MOL-02', 'KEMENKES RI AKD 21603710788', NULL, NULL, '2021-02-20 07:51:07', '2021-02-20 07:51:07'),
(26, 1, 9, NULL, 'elitech', 'SONOTRAX-B', 'Pocket Fetal Doppler', 'FD02', 'SONOTRAX-B', 'KEMENKES RI AKD 21102800003', NULL, NULL, '2021-02-20 07:54:23', '2021-02-20 07:54:23'),
(27, 1, 9, NULL, 'elitech', 'SONOTRAX-C', 'Pocket Fetal Doppler', 'FD07', 'SONOTRAX-C', 'KEMENKES RI AKD 21101710077', NULL, NULL, '2021-02-20 07:55:47', '2021-02-20 07:55:47'),
(28, 1, 9, NULL, 'elitech', 'SONOTRAX PRO2', 'Ultrasonic Table Doppler', 'FD05', 'SONOTRAX PRO2', 'KEMENKES RI AKD 21101810461', NULL, NULL, '2021-02-20 07:58:46', '2021-02-20 07:58:46'),
(29, 1, 9, NULL, 'elitech', 'SONOTRAX MED-01', 'Fetal Monitor', 'SM01', 'SONOTRAX MED-01', 'KEMENKES RI AKD 21101710857', NULL, NULL, '2021-02-20 08:00:53', '2021-02-20 08:00:53'),
(30, 1, 9, NULL, 'elitech', 'MATERNAL MED-02', 'Fetal Monitor', 'SM02', 'MATERNAL MED-02', 'KEMENKES RI AKD 21101710864', NULL, NULL, '2021-02-20 08:02:31', '2021-02-20 08:02:31'),
(32, 1, 9, NULL, 'elitech', 'PRA-ONE', 'Digital USG Monitor', 'US01', 'PRA-ONE', 'KEMENKES RI AKD 21102410010', NULL, NULL, '2021-02-20 08:06:37', '2021-02-20 08:06:37'),
(33, 1, 9, NULL, 'elitech', 'PROMAX', '3D/4D Portable Color Doppler Ultrasound', 'US02', 'PROMAX', 'KEMENKES RI AKD 21102410011', NULL, NULL, '2021-02-20 08:08:08', '2021-02-20 08:08:08'),
(34, 1, 10, NULL, 'elitech', 'MFV-01', 'X-Ray Film Viewer', 'MV01', 'MFV-01', 'KEMENKES RI AKD 21501810001', NULL, NULL, '2021-02-20 08:10:24', '2021-02-20 08:10:24'),
(35, 1, 11, NULL, 'elitech', 'BABY ONE', 'Baby Scale', 'TD03', 'BABY ONE', 'KEMENKES RI AKD 10901318002', NULL, NULL, '2021-02-20 08:12:05', '2021-02-20 08:12:05'),
(36, 1, 11, NULL, 'elitech', 'BABY DIGIT-ONE', 'Timbangan Bayi Mekanik', 'TM01', 'BABY DIGIT-ONE', 'KEMENKES RI AKD 10901410295', NULL, NULL, '2021-02-20 08:13:55', '2021-02-20 08:13:55'),
(37, 1, 11, NULL, 'elitech', 'DIGIT-ONE BABY', 'Timbangan Bayi Digital', 'TD05', 'DIGIT-ONE BABY', 'KEMENKES RI AKD 10901410291', NULL, NULL, '2021-02-20 08:15:38', '2021-02-20 08:15:38'),
(38, 1, 11, NULL, 'elitech', 'DIGIT-PRO', 'Patient Scale', 'TD02', 'DIGIT-PRO', 'KEMENKES RI AKD 10901318001', NULL, NULL, '2021-02-20 08:18:05', '2021-02-20 08:18:05'),
(39, 1, 12, NULL, 'elitech', 'MED-S100', 'SPO2 Simulator', 'MS01', 'MED-S100', 'KEMENKES RI AKD 20401710856', NULL, NULL, '2021-02-20 08:19:27', '2021-02-20 08:19:27'),
(40, 1, 12, NULL, 'elitech', 'MED-S200', 'NIBP Simulator', 'MS02', 'MED-S200', 'KEMENKES RI AKD 20501710666', NULL, NULL, '2021-02-20 08:20:55', '2021-02-20 08:20:55'),
(41, 1, 12, NULL, 'elitech', 'MED-S400', 'Patient Simulator', 'MS04', 'MED-S400', 'KEMENKES RI AKD 20502710662', NULL, NULL, '2021-02-20 08:22:31', '2021-02-20 08:22:31'),
(42, 1, 13, NULL, 'elitech', 'GET 338 UO', 'Sterilisator Kering', 'LS07', 'GET 338 UO', 'KEMENKES RI AKD 20903800291', NULL, NULL, '2021-02-20 08:26:54', '2021-02-20 08:26:54'),
(43, 1, 13, NULL, 'elitech', 'GET-80C', 'Sterilisator Kering', 'LS04', 'GET-80C', 'KEMENKES RI AKD 20903800282', NULL, NULL, '2021-02-20 08:28:39', '2021-02-20 08:28:39'),
(44, 1, 13, NULL, 'elitech', 'GET-160', 'Sterilisator Kering', 'LS11', 'GET-160', 'KEMENKES RI AKD 20903800287', NULL, NULL, '2021-02-20 08:30:59', '2021-02-20 08:30:59'),
(45, 1, 13, NULL, 'elitech', 'ZTP80AS Upgrade', 'Medical Sterilizer', 'LS03', 'ZTP80AS Upgrade', 'KEMENKES RI AKD 20903700359', NULL, NULL, '2021-02-20 08:33:20', '2021-02-20 08:33:20'),
(46, 1, 13, NULL, 'elitech', 'ZTP-300', 'Sterilisator Kering', 'LS12', 'ZTP-300', 'KEMENKES RI AKD 20903800288', NULL, NULL, '2021-02-20 08:34:40', '2021-02-20 08:34:40'),
(47, 1, 14, NULL, 'elitech', 'ROLL PAPER FOR ECG-300G', 'Kertas ECG / Roll Paper', 'RL01', 'ROLL PAPER FOR ECG-300G', 'KEMENKES RI AKD 21102900255', NULL, NULL, '2021-02-20 08:37:37', '2021-02-20 08:37:37'),
(48, 1, 14, NULL, 'elitech', 'ROLL PAPER FOR ECG-1200G', 'Kertas ECG / Roll Paper', 'RL02', 'ROLL PAPER FOR ECG-1200G', 'KEMENKES RI AKD 20502310189', NULL, NULL, '2021-02-20 08:40:38', '2021-02-20 08:40:38'),
(49, 1, 1, NULL, 'elitech', 'DP1', 'Ultrasonic Pocket Doppler', 'FD06', 'DP1', 'KEMENKES RI AKD 21101810460', NULL, NULL, '2021-02-25 02:51:47', '2021-02-25 07:56:38'),
(50, 1, 1, NULL, 'elitech', 'PM PRO-2', 'Patient Monitor', 'PM09', 'PM PRO-2', 'KEMENKES RI AKD 20502810356', NULL, NULL, '2021-02-25 07:41:39', '2021-03-09 01:17:45'),
(51, 1, 14, NULL, 'elitech', 'USG PROMAX Trolley', 'Trolley for Medical Equipment', 'TR02', 'USG PROMAX Trolley', '-', NULL, NULL, '2021-02-25 08:10:13', '2021-03-09 07:41:57'),
(53, NULL, NULL, NULL, 'mentor', 'Pensil', 'RAEE', NULL, NULL, NULL, 'fsdfsdf', NULL, '2021-04-05 21:25:32', '2021-04-05 21:25:32'),
(54, NULL, NULL, NULL, 'vanward', 'Pensil 2B', 'Pensil 2B Kayu', NULL, NULL, NULL, NULL, NULL, '2021-04-05 21:29:43', '2021-04-05 21:29:43'),
(55, 1, 9, 11, 'elitech', 'CMS-600 PLUS', 'B-Ultrasound Diagnostic System', 'TR05', 'CMS-600 PLUS', 'KEMENKES RI AKD 21102900256', NULL, NULL, '2021-04-15 22:04:32', '2021-04-15 22:04:32'),
(56, 1, 5, 12, 'elitech', 'END-1', 'Needle Destroyer', 'TR05', 'END-1', 'KEMENKES RI AKD 21102900256', 'TEST', NULL, '2021-04-16 02:00:01', '2021-04-16 02:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `produk_bill_of_materials`
--

CREATE TABLE `produk_bill_of_materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `detail_produk_id` bigint(20) UNSIGNED DEFAULT NULL,
  `versi` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produk_bill_of_materials`
--

INSERT INTO `produk_bill_of_materials` (`id`, `detail_produk_id`, `versi`, `created_at`, `updated_at`) VALUES
(1, 7, '1', NULL, NULL),
(2, 7, '2', NULL, NULL),
(3, 8, '1', NULL, NULL),
(4, 8, '2', NULL, NULL),
(5, 9, '1', NULL, NULL),
(6, 9, '2', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `custom_fields` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tim_kesehatans`
--

CREATE TABLE `tim_kesehatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `divisi_id` int(11) NOT NULL,
  `tim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(9, 14, 'Wisnu', 'wisnuit03', 'wisnu@gmail.com', '$2y$10$xXSO6ak0QmYLTpIo1IDoq.fROzQu9WhdAEjG80Ki3jHk83POopxz2', NULL, 'offline', NULL, '2021-03-30 04:09:40', '2021-03-30 04:09:40'),
(10, 28, 'Hana', 'hana', 'hana@gmail.com', '$2y$10$EhyPPPA/HT9foUwbRXKraeGmA51hns1i7VUfCKZIbkV6p62C9lS4K', 'hana.png', 'online', NULL, '2021-05-10 07:11:40', '2021-05-10 07:11:40'),
(11, 10, 'Elvina Ambarwati', 'elvinaeng11', 'elvinaeng11@gmail.com', '$2y$10$E1hK8WNsA8LUm8xTkQeYaeYA8VcbllRubzjL9bPZI0nsBMbW/bXfa', NULL, 'online', NULL, '2021-05-24 01:08:13', '2021-05-24 01:08:13'),
(12, 10, 'Ardhiefa R', 'ardhiefaeng12', 'ardhiefaeng12@gmail.com', '$2y$10$yJ3f/jQDXhw/As8Bo0iiuOJibrZFwCBVjgil6IdPfEGtTRYaS4b2q', NULL, 'online', NULL, '2021-05-24 01:09:25', '2021-05-24 01:09:25'),
(13, 16, 'Adi Putra Firmantika', 'adimtc02', 'adi@gmail.com', '$2y$10$oj9N1CE89n5hFFVYSEhZxeB252OI09aKtu0bxj5hIPUxqn5UDmAw2', NULL, 'online', NULL, '2021-06-11 03:56:36', '2021-06-11 03:56:36'),
(14, 11, 'wiwin', 'wiwin', 'wiwin@gmail.com', '$2y$10$xoiAzaqOFkveK.YODKPjleZuDtEK3UCQ5xJhWbunblFJmXwVijSvK', NULL, 'online', NULL, '2021-06-29 03:47:35', '2021-06-29 03:47:35');

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
(43, 2, 'Hasil Perakitan FRIN00003, untuk BPPB 0001/TR05/04/21', 'Hasil Perakitan', 'Hapus', 'pembatalan', '2021-04-18 19:52:02', '2021-04-18 19:52:02'),
(44, 7, 'Hasil Monitoring Proses SWFR00002, untuk BPPB 0001/TR05/04/21', 'Hasil Monitoring Proses', 'Hapus', 'pembatalan', '2021-05-06 04:52:23', '2021-05-06 04:52:23'),
(45, 7, 'Hasil Monitoring Proses SWFR00001, untuk BPPB 0001/TR05/04/21', 'Hasil Monitoring Proses', 'Hapus', 'salah_input', '2021-05-06 05:38:27', '2021-05-06 05:38:27'),
(46, 2, '32', 'Perakitan BPPB 0001/FX04/06/21 tanggal 2021-06-09', 'Tambah', '', '2021-06-09 01:41:27', '2021-06-09 01:41:27'),
(47, 2, '32', 'Perakitan BPPB 0001/FX04/06/21 tanggal 2021-06-09', 'Tambah', '', '2021-06-09 01:44:43', '2021-06-09 01:44:43'),
(48, 2, 'Perakitan untuk BPPB 0001/FX04/06/21', 'Perakitan', 'Hapus', 'revisi', '2021-06-10 04:51:25', '2021-06-10 04:51:25'),
(49, 2, 'Perakitan untuk BPPB 0001/FX04/06/21', 'Perakitan', 'Hapus', 'revisi', '2021-06-16 07:23:15', '2021-06-16 07:23:15'),
(50, 2, 'Perakitan untuk BPPB 0001/FX04/06/21', 'Perakitan', 'Hapus', 'revisi', '2021-06-16 07:23:22', '2021-06-16 07:23:22'),
(51, 2, 'Perakitan untuk BPPB 0001/FX04/06/21', 'Perakitan', 'Hapus', 'revisi', '2021-06-16 07:23:31', '2021-06-16 07:23:31'),
(52, 2, 'Perakitan untuk BPPB 0001/FX04/06/21', 'Perakitan', 'Hapus', 'revisi', '2021-06-16 07:23:41', '2021-06-16 07:23:41'),
(53, 2, 'Perakitan untuk BPPB 0001/FX04/06/21', 'Perakitan', 'Hapus', 'revisi', '2021-06-16 07:23:50', '2021-06-16 07:23:50'),
(54, 2, 'Perakitan untuk BPPB 0001/FX04/06/21', 'Perakitan', 'Hapus', 'revisi', '2021-06-16 07:23:59', '2021-06-16 07:23:59'),
(55, 2, 'Perakitan untuk BPPB 0001/FX04/06/21', 'Perakitan', 'Hapus', 'pembatalan', '2021-06-16 07:24:11', '2021-06-16 07:24:11'),
(56, 2, 'Perakitan untuk BPPB 0001/FX04/06/21', 'Perakitan', 'Hapus', 'revisi', '2021-06-16 07:24:20', '2021-06-16 07:24:20'),
(57, 2, 'Perakitan untuk BPPB 0001/FX04/06/21', 'Perakitan', 'Hapus', 'revisi', '2021-06-16 07:24:29', '2021-06-16 07:24:29'),
(58, 2, 'Perakitan untuk BPPB 0001/FX04/06/21', 'Perakitan', 'Hapus', 'revisi', '2021-06-16 07:24:37', '2021-06-16 07:24:37'),
(59, 2, 'Perakitan untuk BPPB 0001/FX04/06/21', 'Perakitan', 'Hapus', 'revisi', '2021-06-17 04:40:52', '2021-06-17 04:40:52'),
(60, 2, 'Perakitan untuk BPPB 0001/FX04/06/21', 'Perakitan', 'Hapus', 'revisi', '2021-06-17 04:42:48', '2021-06-17 04:42:48'),
(61, 2, 'Perakitan untuk BPPB 0001/FX04/06/21', 'Perakitan', 'Hapus', 'revisi', '2021-06-17 04:42:55', '2021-06-17 04:42:55'),
(62, 2, 'Perakitan untuk BPPB 0001/FX04/06/21', 'Perakitan', 'Hapus', 'revisi', '2021-06-17 04:43:03', '2021-06-17 04:43:03'),
(63, 2, 'Perakitan untuk BPPB 0001/FX04/06/21', 'Perakitan', 'Hapus', 'revisi', '2021-06-17 04:43:10', '2021-06-17 04:43:10'),
(64, 2, 'Perakitan untuk BPPB 0001/FX04/06/21', 'Perakitan', 'Hapus', 'revisi', '2021-06-17 04:43:20', '2021-06-17 04:43:20'),
(65, 2, 'Perakitan untuk BPPB 0001/FX04/06/21', 'Perakitan', 'Hapus', 'revisi', '2021-06-17 04:43:28', '2021-06-17 04:43:28'),
(66, 2, 'Perakitan untuk BPPB 0001/FX04/06/21', 'Perakitan', 'Hapus', 'revisi', '2021-06-17 04:43:35', '2021-06-17 04:43:35'),
(67, 2, 'Perakitan untuk BPPB 0001/FX04/06/21', 'Perakitan', 'Hapus', 'revisi', '2021-06-17 04:43:43', '2021-06-17 04:43:43'),
(68, 2, 'Perakitan untuk BPPB 0001/FX04/06/21', 'Perakitan', 'Hapus', 'revisi', '2021-06-17 04:43:50', '2021-06-17 04:43:50');

-- --------------------------------------------------------

--
-- Table structure for table `websockets_statistics_entries`
--

CREATE TABLE `websockets_statistics_entries` (
  `id` int(10) UNSIGNED NOT NULL,
  `app_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peak_connection_count` int(11) NOT NULL,
  `websocket_message_count` int(11) NOT NULL,
  `api_message_count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analisa_ps_pengujians`
--
ALTER TABLE `analisa_ps_pengujians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `analisa_ps_pengujians_hasil_monitoring_proses_id_foreign` (`hasil_monitoring_proses_id`);

--
-- Indexes for table `analisa_ps_pengujian_parts`
--
ALTER TABLE `analisa_ps_pengujian_parts`
  ADD KEY `analisa_ps_pengujian_parts_bill_of_material_id_foreign` (`bill_of_material_id`),
  ADD KEY `analisa_ps_pengujian_parts_analisa_ps_pengujian_id_foreign` (`analisa_ps_pengujian_id`);

--
-- Indexes for table `analisa_ps_perakitans`
--
ALTER TABLE `analisa_ps_perakitans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `analisa_ps_perakitans_hasil_perakitan_id_foreign` (`hasil_perakitan_id`),
  ADD KEY `analisa_ps_perakitans_ppic_id_foreign` (`ppic_id`);

--
-- Indexes for table `analisa_ps_perakitan_parts`
--
ALTER TABLE `analisa_ps_perakitan_parts`
  ADD KEY `analisa_ps_perakitan_parts_bill_of_material_id_foreign` (`bill_of_material_id`),
  ADD KEY `analisa_ps_perakitan_parts_analisa_ps_perakitan_id_foreign` (`analisa_ps_perakitan_id`);

--
-- Indexes for table `berat_karyawans`
--
ALTER TABLE `berat_karyawans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill_of_materials`
--
ALTER TABLE `bill_of_materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_of_materials_produk_bill_of_material_id_foreign` (`produk_bill_of_material_id`),
  ADD KEY `bill_of_materials_part_eng_id_foreign` (`part_eng_id`);

--
-- Indexes for table `bppbs`
--
ALTER TABLE `bppbs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bppbs_divisi_id_foreign` (`divisi_id`),
  ADD KEY `bppbs_detail_produk_id_foreign` (`detail_produk_id`);

--
-- Indexes for table `cek_pengemasans`
--
ALTER TABLE `cek_pengemasans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cek_pengemasans_detail_produk_id_foreign` (`detail_produk_id`);

--
-- Indexes for table `custom_fields`
--
ALTER TABLE `custom_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_stok_produks`
--
ALTER TABLE `data_stok_produks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_stok_produks_stok_produk_id_foreign` (`stok_produk_id`);

--
-- Indexes for table `detail_cek_pengemasans`
--
ALTER TABLE `detail_cek_pengemasans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_cek_pengemasans_cek_pengemasan_id_foreign` (`cek_pengemasan_id`);

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
-- Indexes for table `detail_pengembalian_barang_gudangs`
--
ALTER TABLE `detail_pengembalian_barang_gudangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_pengembalian_barang_gudangs_pengembalian_id_foreign` (`pengembalian_id`),
  ADD KEY `detail_pengembalian_barang_gudangs_bill_of_material_id_foreign` (`bill_of_material_id`);

--
-- Indexes for table `detail_penyerahan_barang_jadis`
--
ALTER TABLE `detail_penyerahan_barang_jadis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_penyerahan_barang_jadis_penyerahan_barang_jadi_id_foreign` (`penyerahan_barang_jadi_id`),
  ADD KEY `detail_penyerahan_barang_jadis_hasil_perakitan_id_foreign` (`hasil_perakitan_id`);

--
-- Indexes for table `detail_permintaan_bahan_bakus`
--
ALTER TABLE `detail_permintaan_bahan_bakus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_permintaan_bahan_bakus_bill_of_material_id_foreign` (`bill_of_material_id`),
  ADD KEY `detail_permintaan_bahan_bakus_permintaan_bahan_baku_id_foreign` (`permintaan_bahan_baku_id`);

--
-- Indexes for table `detail_persiapan_packing_produks`
--
ALTER TABLE `detail_persiapan_packing_produks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_persiapan_packing_produks_persiapan_id_foreign` (`persiapan_id`);

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
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documents_created_by_foreign` (`created_by`),
  ADD KEY `documents_verified_by_foreign` (`verified_by`);

--
-- Indexes for table `documents_tags`
--
ALTER TABLE `documents_tags`
  ADD PRIMARY KEY (`document_id`,`tag_id`),
  ADD KEY `documents_tags_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `dokumen_engs`
--
ALTER TABLE `dokumen_engs`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `files_document_id_foreign` (`document_id`),
  ADD KEY `files_file_type_id_foreign` (`file_type_id`),
  ADD KEY `files_created_by_foreign` (`created_by`);

--
-- Indexes for table `file_types`
--
ALTER TABLE `file_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gcu_karyawans`
--
ALTER TABLE `gcu_karyawans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hasil_ik_pemeriksaan_pengujians`
--
ALTER TABLE `hasil_ik_pemeriksaan_pengujians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hasil_ik_pemeriksaan_pengujians_ik_pemeriksaan_id_foreign` (`ik_pemeriksaan_id`);

--
-- Indexes for table `hasil_monitoring_proses`
--
ALTER TABLE `hasil_monitoring_proses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hasil_monitoring_proses_hasil_perakitan_id_foreign` (`hasil_perakitan_id`),
  ADD KEY `hasil_monitoring_proses_monitoring_proses_id_foreign` (`monitoring_proses_id`);

--
-- Indexes for table `hasil_pemeriksaan_proses_pengujians`
--
ALTER TABLE `hasil_pemeriksaan_proses_pengujians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hasil_pemeriksaan_proses_pengujians_pemeriksaan_id_foreign` (`pemeriksaan_id`),
  ADD KEY `hasil_pemeriksaan_proses_pengujians_hasil_ik_id_foreign` (`hasil_ik_id`);

--
-- Indexes for table `hasil_pemeriksaan_rakits`
--
ALTER TABLE `hasil_pemeriksaan_rakits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hasil_pemeriksaan_rakits_pemeriksaan_rakit_id_foreign` (`pemeriksaan_rakit_id`),
  ADD KEY `hasil_pemeriksaan_rakits_hasil_perakitan_id_foreign` (`hasil_perakitan_id`);

--
-- Indexes for table `hasil_pengemasans`
--
ALTER TABLE `hasil_pengemasans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hasil_pengemasans_hasil_perakitan_id_foreign` (`hasil_perakitan_id`),
  ADD KEY `hasil_pengemasans_pengemasan_id_foreign` (`pengemasan_id`);

--
-- Indexes for table `hasil_pengemasan_detail_cek_pengemasans`
--
ALTER TABLE `hasil_pengemasan_detail_cek_pengemasans`
  ADD KEY `hasil_pengemasan_detail_cek_pengemasans_hasil_id_foreign` (`hasil_id`),
  ADD KEY `hasil_pengemasan_detail_cek_pengemasans_detail_cek_id_foreign` (`detail_cek_id`);

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
-- Indexes for table `ik_pemeriksaan_pengujians`
--
ALTER TABLE `ik_pemeriksaan_pengujians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ik_pemeriksaan_pengujians_detail_produk_id_foreign` (`detail_produk_id`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventories_divisi_inventory_id_foreign` (`divisi_inventory_id`);

--
-- Indexes for table `jadwal_produksi`
--
ALTER TABLE `jadwal_produksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_produk_id` (`detail_produk_id`);

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
-- Indexes for table `karyawan_masuks`
--
ALTER TABLE `karyawan_masuks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `karyawan_sakits`
--
ALTER TABLE `karyawan_sakits`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `kesehatan_awals`
--
ALTER TABLE `kesehatan_awals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kesehatan_harians`
--
ALTER TABLE `kesehatan_harians`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kesehatan_mingguan_rapids`
--
ALTER TABLE `kesehatan_mingguan_rapids`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kesehatan_mingguan_tensis`
--
ALTER TABLE `kesehatan_mingguan_tensis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kesehatan_tahunans`
--
ALTER TABLE `kesehatan_tahunans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monitoring_proses`
--
ALTER TABLE `monitoring_proses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `monitoring_proses_bppb_id_foreign` (`bppb_id`),
  ADD KEY `monitoring_proses_karyawan_id_foreign` (`karyawan_id`),
  ADD KEY `monitoring_proses_user_id_foreign` (`user_id`);

--
-- Indexes for table `monitoring_proses_ik_pengujians`
--
ALTER TABLE `monitoring_proses_ik_pengujians`
  ADD KEY `monitoring_proses_ik_pengujians_monitoring_id_foreign` (`monitoring_id`),
  ADD KEY `monitoring_proses_ik_pengujians_hasil_ik_id_foreign` (`hasil_ik_id`);

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
-- Indexes for table `obats`
--
ALTER TABLE `obats`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `part_engs`
--
ALTER TABLE `part_engs`
  ADD PRIMARY KEY (`kode_part`);

--
-- Indexes for table `part_gudang_part_engs`
--
ALTER TABLE `part_gudang_part_engs`
  ADD KEY `part_gudang_part_engs_kode_gudang_foreign` (`kode_gudang`),
  ADD KEY `part_gudang_part_engs_kode_eng_foreign` (`kode_eng`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pemeriksaan_proses_pengujians`
--
ALTER TABLE `pemeriksaan_proses_pengujians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemeriksaan_proses_pengujians_bppb_id_foreign` (`bppb_id`);

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
  ADD KEY `pengemasans_pic_id_foreign` (`pic_id`),
  ADD KEY `pengemasans_karyawan_id_foreign` (`karyawan_id`);

--
-- Indexes for table `pengembalian_barang_gudangs`
--
ALTER TABLE `pengembalian_barang_gudangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengembalian_barang_gudangs_bppb_id_foreign` (`bppb_id`),
  ADD KEY `pengembalian_barang_gudangs_divisi_id_foreign` (`divisi_id`);

--
-- Indexes for table `penyerahan_barang_jadis`
--
ALTER TABLE `penyerahan_barang_jadis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penyerahan_barang_jadis_bppb_id_foreign` (`bppb_id`),
  ADD KEY `penyerahan_barang_jadis_divisi_id_foreign` (`divisi_id`);

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
-- Indexes for table `perbaikan_produksis`
--
ALTER TABLE `perbaikan_produksis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `perbaikan_produksis_bppb_id_foreign` (`bppb_id`),
  ADD KEY `perbaikan_produksis_karyawan_id_foreign` (`karyawan_id`);

--
-- Indexes for table `perbaikan_produksi_no_seris`
--
ALTER TABLE `perbaikan_produksi_no_seris`
  ADD KEY `perbaikan_produksi_no_seris_perbaikan_produksi_id_foreign` (`perbaikan_produksi_id`),
  ADD KEY `perbaikan_produksi_no_seris_hasil_perakitan_id_foreign` (`hasil_perakitan_id`);

--
-- Indexes for table `perbaikan_produksi_parts`
--
ALTER TABLE `perbaikan_produksi_parts`
  ADD KEY `perbaikan_produksi_parts_perbaikan_produksi_id_foreign` (`perbaikan_produksi_id`),
  ADD KEY `perbaikan_produksi_parts_bill_of_material_id_foreign` (`bill_of_material_id`);

--
-- Indexes for table `perbaikan_produksi_pengemasans`
--
ALTER TABLE `perbaikan_produksi_pengemasans`
  ADD KEY `perbaikan_produksi_pengemasans_perbaikan_produksi_id_foreign` (`perbaikan_produksi_id`),
  ADD KEY `perbaikan_produksi_pengemasans_hasil_pengemasan_id_foreign` (`hasil_pengemasan_id`);

--
-- Indexes for table `perbaikan_produksi_pengujians`
--
ALTER TABLE `perbaikan_produksi_pengujians`
  ADD KEY `perbaikan_produksi_pengujians_perbaikan_produksi_id_foreign` (`perbaikan_produksi_id`),
  ADD KEY `perbaikan_produksi_pengujians_hasil_monitoring_proses_id_foreign` (`hasil_monitoring_proses_id`);

--
-- Indexes for table `perbaikan_produksi_perakitans`
--
ALTER TABLE `perbaikan_produksi_perakitans`
  ADD KEY `perbaikan_produksi_perakitans_perbaikan_produksi_id_foreign` (`perbaikan_produksi_id`),
  ADD KEY `perbaikan_produksi_perakitans_hasil_perakitan_id_foreign` (`hasil_perakitan_id`);

--
-- Indexes for table `permintaan_bahan_bakus`
--
ALTER TABLE `permintaan_bahan_bakus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permintaan_bahan_bakus_bppb_id_foreign` (`bppb_id`),
  ADD KEY `permintaan_bahan_bakus_divisi_id_foreign` (`divisi_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `persiapan_packing_produks`
--
ALTER TABLE `persiapan_packing_produks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `persiapan_packing_produks_bppb_id_foreign` (`bppb_id`),
  ADD KEY `persiapan_packing_produks_user_id_foreign` (`user_id`);

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
  ADD KEY `produks_kategori_id_foreign` (`kelompok_produk_id`),
  ADD KEY `produks_ppic_id_foreign` (`ppic_id`);

--
-- Indexes for table `produk_bill_of_materials`
--
ALTER TABLE `produk_bill_of_materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produk_bill_of_materials_detail_produk_id_foreign` (`detail_produk_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_name_unique` (`name`);

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
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tags_created_by_foreign` (`created_by`);

--
-- Indexes for table `tim_kesehatans`
--
ALTER TABLE `tim_kesehatans`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `websockets_statistics_entries`
--
ALTER TABLE `websockets_statistics_entries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `analisa_ps_pengujians`
--
ALTER TABLE `analisa_ps_pengujians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `analisa_ps_perakitans`
--
ALTER TABLE `analisa_ps_perakitans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `berat_karyawans`
--
ALTER TABLE `berat_karyawans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `bill_of_materials`
--
ALTER TABLE `bill_of_materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=364;

--
-- AUTO_INCREMENT for table `bppbs`
--
ALTER TABLE `bppbs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `cek_pengemasans`
--
ALTER TABLE `cek_pengemasans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `custom_fields`
--
ALTER TABLE `custom_fields`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_stok_produks`
--
ALTER TABLE `data_stok_produks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_cek_pengemasans`
--
ALTER TABLE `detail_cek_pengemasans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
-- AUTO_INCREMENT for table `detail_pengembalian_barang_gudangs`
--
ALTER TABLE `detail_pengembalian_barang_gudangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_penyerahan_barang_jadis`
--
ALTER TABLE `detail_penyerahan_barang_jadis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `detail_permintaan_bahan_bakus`
--
ALTER TABLE `detail_permintaan_bahan_bakus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `detail_persiapan_packing_produks`
--
ALTER TABLE `detail_persiapan_packing_produks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `detail_produks`
--
ALTER TABLE `detail_produks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `distributors`
--
ALTER TABLE `distributors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `divisis`
--
ALTER TABLE `divisis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `divisi_inventories`
--
ALTER TABLE `divisi_inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dokumen_engs`
--
ALTER TABLE `dokumen_engs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `file_types`
--
ALTER TABLE `file_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gcu_karyawans`
--
ALTER TABLE `gcu_karyawans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `hasil_ik_pemeriksaan_pengujians`
--
ALTER TABLE `hasil_ik_pemeriksaan_pengujians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `hasil_monitoring_proses`
--
ALTER TABLE `hasil_monitoring_proses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `hasil_pemeriksaan_proses_pengujians`
--
ALTER TABLE `hasil_pemeriksaan_proses_pengujians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `hasil_pemeriksaan_rakits`
--
ALTER TABLE `hasil_pemeriksaan_rakits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hasil_pengemasans`
--
ALTER TABLE `hasil_pengemasans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `hasil_perakitans`
--
ALTER TABLE `hasil_perakitans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `histori_hasil_perakitans`
--
ALTER TABLE `histori_hasil_perakitans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `ik_pemeriksaan_pengujians`
--
ALTER TABLE `ik_pemeriksaan_pengujians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jadwal_produksi`
--
ALTER TABLE `jadwal_produksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `jasa_ekss`
--
ALTER TABLE `jasa_ekss`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `karyawans`
--
ALTER TABLE `karyawans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `karyawan_masuks`
--
ALTER TABLE `karyawan_masuks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `karyawan_sakits`
--
ALTER TABLE `karyawan_sakits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

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
-- AUTO_INCREMENT for table `kesehatan_awals`
--
ALTER TABLE `kesehatan_awals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `kesehatan_harians`
--
ALTER TABLE `kesehatan_harians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `kesehatan_mingguan_rapids`
--
ALTER TABLE `kesehatan_mingguan_rapids`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `kesehatan_mingguan_tensis`
--
ALTER TABLE `kesehatan_mingguan_tensis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `kesehatan_tahunans`
--
ALTER TABLE `kesehatan_tahunans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=267;

--
-- AUTO_INCREMENT for table `monitoring_proses`
--
ALTER TABLE `monitoring_proses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `notifikasis`
--
ALTER TABLE `notifikasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `obats`
--
ALTER TABLE `obats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- AUTO_INCREMENT for table `pemeriksaan_proses_pengujians`
--
ALTER TABLE `pemeriksaan_proses_pengujians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pengembalian_barang_gudangs`
--
ALTER TABLE `pengembalian_barang_gudangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penyerahan_barang_jadis`
--
ALTER TABLE `penyerahan_barang_jadis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `perakitans`
--
ALTER TABLE `perakitans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `perbaikan_produksis`
--
ALTER TABLE `perbaikan_produksis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `permintaan_bahan_bakus`
--
ALTER TABLE `permintaan_bahan_bakus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `persiapan_packing_produks`
--
ALTER TABLE `persiapan_packing_produks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- AUTO_INCREMENT for table `produk_bill_of_materials`
--
ALTER TABLE `produk_bill_of_materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tim_kesehatans`
--
ALTER TABLE `tim_kesehatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `websockets_statistics_entries`
--
ALTER TABLE `websockets_statistics_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `analisa_ps_pengujians`
--
ALTER TABLE `analisa_ps_pengujians`
  ADD CONSTRAINT `analisa_ps_pengujians_hasil_monitoring_proses_id_foreign` FOREIGN KEY (`hasil_monitoring_proses_id`) REFERENCES `hasil_monitoring_proses` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `analisa_ps_pengujian_parts`
--
ALTER TABLE `analisa_ps_pengujian_parts`
  ADD CONSTRAINT `analisa_ps_pengujian_parts_analisa_ps_pengujian_id_foreign` FOREIGN KEY (`analisa_ps_pengujian_id`) REFERENCES `analisa_ps_pengujians` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `analisa_ps_pengujian_parts_bill_of_material_id_foreign` FOREIGN KEY (`bill_of_material_id`) REFERENCES `bill_of_materials` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `analisa_ps_perakitans`
--
ALTER TABLE `analisa_ps_perakitans`
  ADD CONSTRAINT `analisa_ps_perakitans_hasil_perakitan_id_foreign` FOREIGN KEY (`hasil_perakitan_id`) REFERENCES `hasil_perakitans` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `analisa_ps_perakitans_ppic_id_foreign` FOREIGN KEY (`ppic_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `analisa_ps_perakitan_parts`
--
ALTER TABLE `analisa_ps_perakitan_parts`
  ADD CONSTRAINT `analisa_ps_perakitan_parts_analisa_ps_perakitan_id_foreign` FOREIGN KEY (`analisa_ps_perakitan_id`) REFERENCES `analisa_ps_perakitans` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `analisa_ps_perakitan_parts_bill_of_material_id_foreign` FOREIGN KEY (`bill_of_material_id`) REFERENCES `bill_of_materials` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `bill_of_materials`
--
ALTER TABLE `bill_of_materials`
  ADD CONSTRAINT `bill_of_materials_part_eng_id_foreign` FOREIGN KEY (`part_eng_id`) REFERENCES `part_engs` (`kode_part`) ON DELETE SET NULL,
  ADD CONSTRAINT `bill_of_materials_produk_bill_of_material_id_foreign` FOREIGN KEY (`produk_bill_of_material_id`) REFERENCES `produk_bill_of_materials` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `bppbs`
--
ALTER TABLE `bppbs`
  ADD CONSTRAINT `bppbs_detail_produk_id_foreign` FOREIGN KEY (`detail_produk_id`) REFERENCES `detail_produks` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `bppbs_divisi_id_foreign` FOREIGN KEY (`divisi_id`) REFERENCES `divisis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cek_pengemasans`
--
ALTER TABLE `cek_pengemasans`
  ADD CONSTRAINT `cek_pengemasans_detail_produk_id_foreign` FOREIGN KEY (`detail_produk_id`) REFERENCES `detail_produks` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `data_stok_produks`
--
ALTER TABLE `data_stok_produks`
  ADD CONSTRAINT `data_stok_produks_stok_produk_id_foreign` FOREIGN KEY (`stok_produk_id`) REFERENCES `stok_produks` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `detail_cek_pengemasans`
--
ALTER TABLE `detail_cek_pengemasans`
  ADD CONSTRAINT `detail_cek_pengemasans_cek_pengemasan_id_foreign` FOREIGN KEY (`cek_pengemasan_id`) REFERENCES `cek_pengemasans` (`id`) ON DELETE SET NULL;

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
-- Constraints for table `detail_pengembalian_barang_gudangs`
--
ALTER TABLE `detail_pengembalian_barang_gudangs`
  ADD CONSTRAINT `detail_pengembalian_barang_gudangs_bill_of_material_id_foreign` FOREIGN KEY (`bill_of_material_id`) REFERENCES `pengembalian_barang_gudangs` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `detail_pengembalian_barang_gudangs_pengembalian_id_foreign` FOREIGN KEY (`pengembalian_id`) REFERENCES `pengembalian_barang_gudangs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_penyerahan_barang_jadis`
--
ALTER TABLE `detail_penyerahan_barang_jadis`
  ADD CONSTRAINT `detail_penyerahan_barang_jadis_hasil_perakitan_id_foreign` FOREIGN KEY (`hasil_perakitan_id`) REFERENCES `hasil_perakitans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_penyerahan_barang_jadis_penyerahan_barang_jadi_id_foreign` FOREIGN KEY (`penyerahan_barang_jadi_id`) REFERENCES `penyerahan_barang_jadis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_permintaan_bahan_bakus`
--
ALTER TABLE `detail_permintaan_bahan_bakus`
  ADD CONSTRAINT `detail_permintaan_bahan_bakus_bill_of_material_id_foreign` FOREIGN KEY (`bill_of_material_id`) REFERENCES `bill_of_materials` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_permintaan_bahan_bakus_permintaan_bahan_baku_id_foreign` FOREIGN KEY (`permintaan_bahan_baku_id`) REFERENCES `permintaan_bahan_bakus` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_persiapan_packing_produks`
--
ALTER TABLE `detail_persiapan_packing_produks`
  ADD CONSTRAINT `detail_persiapan_packing_produks_persiapan_id_foreign` FOREIGN KEY (`persiapan_id`) REFERENCES `persiapan_packing_produks` (`id`) ON DELETE SET NULL;

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
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `documents_verified_by_foreign` FOREIGN KEY (`verified_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `documents_tags`
--
ALTER TABLE `documents_tags`
  ADD CONSTRAINT `documents_tags_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `documents_tags_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `files_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `files_file_type_id_foreign` FOREIGN KEY (`file_type_id`) REFERENCES `file_types` (`id`);

--
-- Constraints for table `hasil_ik_pemeriksaan_pengujians`
--
ALTER TABLE `hasil_ik_pemeriksaan_pengujians`
  ADD CONSTRAINT `hasil_ik_pemeriksaan_pengujians_ik_pemeriksaan_id_foreign` FOREIGN KEY (`ik_pemeriksaan_id`) REFERENCES `ik_pemeriksaan_pengujians` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `hasil_monitoring_proses`
--
ALTER TABLE `hasil_monitoring_proses`
  ADD CONSTRAINT `hasil_monitoring_proses_hasil_perakitan_id_foreign` FOREIGN KEY (`hasil_perakitan_id`) REFERENCES `hasil_perakitans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hasil_monitoring_proses_monitoring_proses_id_foreign` FOREIGN KEY (`monitoring_proses_id`) REFERENCES `monitoring_proses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hasil_pemeriksaan_proses_pengujians`
--
ALTER TABLE `hasil_pemeriksaan_proses_pengujians`
  ADD CONSTRAINT `hasil_pemeriksaan_proses_pengujians_hasil_ik_id_foreign` FOREIGN KEY (`hasil_ik_id`) REFERENCES `hasil_ik_pemeriksaan_pengujians` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `hasil_pemeriksaan_proses_pengujians_pemeriksaan_id_foreign` FOREIGN KEY (`pemeriksaan_id`) REFERENCES `pemeriksaan_proses_pengujians` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `hasil_pemeriksaan_rakits`
--
ALTER TABLE `hasil_pemeriksaan_rakits`
  ADD CONSTRAINT `hasil_pemeriksaan_rakits_hasil_perakitan_id_foreign` FOREIGN KEY (`hasil_perakitan_id`) REFERENCES `hasil_perakitans` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `hasil_pemeriksaan_rakits_pemeriksaan_rakit_id_foreign` FOREIGN KEY (`pemeriksaan_rakit_id`) REFERENCES `pemeriksaan_rakits` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `hasil_pengemasans`
--
ALTER TABLE `hasil_pengemasans`
  ADD CONSTRAINT `hasil_pengemasans_hasil_perakitan_id_foreign` FOREIGN KEY (`hasil_perakitan_id`) REFERENCES `hasil_perakitans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hasil_pengemasans_pengemasan_id_foreign` FOREIGN KEY (`pengemasan_id`) REFERENCES `pengemasans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hasil_pengemasan_detail_cek_pengemasans`
--
ALTER TABLE `hasil_pengemasan_detail_cek_pengemasans`
  ADD CONSTRAINT `hasil_pengemasan_detail_cek_pengemasans_detail_cek_id_foreign` FOREIGN KEY (`detail_cek_id`) REFERENCES `detail_cek_pengemasans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hasil_pengemasan_detail_cek_pengemasans_hasil_id_foreign` FOREIGN KEY (`hasil_id`) REFERENCES `hasil_pengemasans` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `ik_pemeriksaan_pengujians`
--
ALTER TABLE `ik_pemeriksaan_pengujians`
  ADD CONSTRAINT `ik_pemeriksaan_pengujians_detail_produk_id_foreign` FOREIGN KEY (`detail_produk_id`) REFERENCES `detail_produks` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `inventories`
--
ALTER TABLE `inventories`
  ADD CONSTRAINT `inventories_divisi_inventory_id_foreign` FOREIGN KEY (`divisi_inventory_id`) REFERENCES `divisi_inventories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `jadwal_produksi`
--
ALTER TABLE `jadwal_produksi`
  ADD CONSTRAINT `jadwal_produksi_ibfk_1` FOREIGN KEY (`detail_produk_id`) REFERENCES `detail_produks` (`id`);

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
-- Constraints for table `monitoring_proses`
--
ALTER TABLE `monitoring_proses`
  ADD CONSTRAINT `monitoring_proses_bppb_id_foreign` FOREIGN KEY (`bppb_id`) REFERENCES `bppbs` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `monitoring_proses_karyawan_id_foreign` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawans` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `monitoring_proses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `monitoring_proses_ik_pengujians`
--
ALTER TABLE `monitoring_proses_ik_pengujians`
  ADD CONSTRAINT `monitoring_proses_ik_pengujians_hasil_ik_id_foreign` FOREIGN KEY (`hasil_ik_id`) REFERENCES `hasil_ik_pemeriksaan_pengujians` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `monitoring_proses_ik_pengujians_monitoring_id_foreign` FOREIGN KEY (`monitoring_id`) REFERENCES `hasil_monitoring_proses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifikasis`
--
ALTER TABLE `notifikasis`
  ADD CONSTRAINT `notifikasis_penerima_id_foreign` FOREIGN KEY (`penerima_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifikasis_pengirim_id_foreign` FOREIGN KEY (`pengirim_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `part_gudang_part_engs`
--
ALTER TABLE `part_gudang_part_engs`
  ADD CONSTRAINT `part_gudang_part_engs_kode_eng_foreign` FOREIGN KEY (`kode_eng`) REFERENCES `part_engs` (`kode_part`) ON DELETE CASCADE,
  ADD CONSTRAINT `part_gudang_part_engs_kode_gudang_foreign` FOREIGN KEY (`kode_gudang`) REFERENCES `parts` (`kode`) ON DELETE CASCADE;

--
-- Constraints for table `pemeriksaan_proses_pengujians`
--
ALTER TABLE `pemeriksaan_proses_pengujians`
  ADD CONSTRAINT `pemeriksaan_proses_pengujians_bppb_id_foreign` FOREIGN KEY (`bppb_id`) REFERENCES `bppbs` (`id`) ON DELETE SET NULL;

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
  ADD CONSTRAINT `pengemasans_karyawan_id_foreign` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawans` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `pengemasans_pic_id_foreign` FOREIGN KEY (`pic_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `pengembalian_barang_gudangs`
--
ALTER TABLE `pengembalian_barang_gudangs`
  ADD CONSTRAINT `pengembalian_barang_gudangs_bppb_id_foreign` FOREIGN KEY (`bppb_id`) REFERENCES `bppbs` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `pengembalian_barang_gudangs_divisi_id_foreign` FOREIGN KEY (`divisi_id`) REFERENCES `divisis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `penyerahan_barang_jadis`
--
ALTER TABLE `penyerahan_barang_jadis`
  ADD CONSTRAINT `penyerahan_barang_jadis_bppb_id_foreign` FOREIGN KEY (`bppb_id`) REFERENCES `bppbs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penyerahan_barang_jadis_divisi_id_foreign` FOREIGN KEY (`divisi_id`) REFERENCES `divisis` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `perbaikan_produksis`
--
ALTER TABLE `perbaikan_produksis`
  ADD CONSTRAINT `perbaikan_produksis_bppb_id_foreign` FOREIGN KEY (`bppb_id`) REFERENCES `bppbs` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `perbaikan_produksis_karyawan_id_foreign` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawans` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `perbaikan_produksi_no_seris`
--
ALTER TABLE `perbaikan_produksi_no_seris`
  ADD CONSTRAINT `perbaikan_produksi_no_seris_hasil_perakitan_id_foreign` FOREIGN KEY (`hasil_perakitan_id`) REFERENCES `hasil_perakitans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `perbaikan_produksi_no_seris_perbaikan_produksi_id_foreign` FOREIGN KEY (`perbaikan_produksi_id`) REFERENCES `perbaikan_produksis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `perbaikan_produksi_parts`
--
ALTER TABLE `perbaikan_produksi_parts`
  ADD CONSTRAINT `perbaikan_produksi_parts_bill_of_material_id_foreign` FOREIGN KEY (`bill_of_material_id`) REFERENCES `bill_of_materials` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `perbaikan_produksi_parts_perbaikan_produksi_id_foreign` FOREIGN KEY (`perbaikan_produksi_id`) REFERENCES `perbaikan_produksis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `perbaikan_produksi_pengemasans`
--
ALTER TABLE `perbaikan_produksi_pengemasans`
  ADD CONSTRAINT `perbaikan_produksi_pengemasans_hasil_pengemasan_id_foreign` FOREIGN KEY (`hasil_pengemasan_id`) REFERENCES `hasil_pengemasans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `perbaikan_produksi_pengemasans_perbaikan_produksi_id_foreign` FOREIGN KEY (`perbaikan_produksi_id`) REFERENCES `perbaikan_produksis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `perbaikan_produksi_pengujians`
--
ALTER TABLE `perbaikan_produksi_pengujians`
  ADD CONSTRAINT `perbaikan_produksi_pengujians_hasil_monitoring_proses_id_foreign` FOREIGN KEY (`hasil_monitoring_proses_id`) REFERENCES `hasil_monitoring_proses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `perbaikan_produksi_pengujians_perbaikan_produksi_id_foreign` FOREIGN KEY (`perbaikan_produksi_id`) REFERENCES `perbaikan_produksis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `perbaikan_produksi_perakitans`
--
ALTER TABLE `perbaikan_produksi_perakitans`
  ADD CONSTRAINT `perbaikan_produksi_perakitans_hasil_perakitan_id_foreign` FOREIGN KEY (`hasil_perakitan_id`) REFERENCES `hasil_perakitans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `perbaikan_produksi_perakitans_perbaikan_produksi_id_foreign` FOREIGN KEY (`perbaikan_produksi_id`) REFERENCES `perbaikan_produksis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permintaan_bahan_bakus`
--
ALTER TABLE `permintaan_bahan_bakus`
  ADD CONSTRAINT `permintaan_bahan_bakus_bppb_id_foreign` FOREIGN KEY (`bppb_id`) REFERENCES `bppbs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permintaan_bahan_bakus_divisi_id_foreign` FOREIGN KEY (`divisi_id`) REFERENCES `divisis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `persiapan_packing_produks`
--
ALTER TABLE `persiapan_packing_produks`
  ADD CONSTRAINT `persiapan_packing_produks_bppb_id_foreign` FOREIGN KEY (`bppb_id`) REFERENCES `bppbs` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `persiapan_packing_produks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `produks`
--
ALTER TABLE `produks`
  ADD CONSTRAINT `produks_kategori_id_foreign` FOREIGN KEY (`kelompok_produk_id`) REFERENCES `kelompok_produks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `produks_ppic_id_foreign` FOREIGN KEY (`ppic_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `produks_sub_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori_produks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `produk_bill_of_materials`
--
ALTER TABLE `produk_bill_of_materials`
  ADD CONSTRAINT `produk_bill_of_materials_detail_produk_id_foreign` FOREIGN KEY (`detail_produk_id`) REFERENCES `detail_produks` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `stok_produks`
--
ALTER TABLE `stok_produks`
  ADD CONSTRAINT `stok_produks_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produks` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `tags_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

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
