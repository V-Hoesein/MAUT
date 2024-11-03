-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2024 at 05:36 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ku`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_alternatif`
--

CREATE TABLE `tb_alternatif` (
  `kode_alternatif` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_alternatif` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maut_total` double DEFAULT NULL,
  `maut_rank` int(11) DEFAULT NULL,
  `maut_hasil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `waspas_total` double DEFAULT NULL,
  `waspas_rank` int(11) DEFAULT NULL,
  `waspas_hasil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_alternatif`
--

INSERT INTO `tb_alternatif` (`kode_alternatif`, `nama_alternatif`, `keterangan`, `maut_total`, `maut_rank`, `maut_hasil`, `waspas_total`, `waspas_rank`, `waspas_hasil`, `created_at`, `updated_at`) VALUES
('A001', 'Project Bassed Learning', NULL, 0.3469387755102, 4, NULL, NULL, NULL, NULL, '2024-06-21 23:42:37', '2024-07-31 10:16:20'),
('A002', 'Problem Bassed Learning', NULL, 1, 1, NULL, NULL, NULL, NULL, '2024-06-21 23:42:47', '2024-07-04 20:36:05'),
('A003', 'Inquiry Bassed Learning', NULL, 0.64625850340136, 2, NULL, NULL, NULL, NULL, '2024-06-21 23:42:57', '2024-07-31 10:16:20'),
('A004', 'Discovery Learning', NULL, 0.22448979591837, 6, NULL, NULL, NULL, NULL, '2024-06-21 23:43:07', '2024-07-31 10:16:20'),
('A005', 'Literature Circle', NULL, 0.57142857142857, 3, NULL, NULL, NULL, NULL, '2024-06-21 23:43:16', '2024-07-31 10:16:20'),
('A006', 'Design Instruksional', NULL, 0.27891156462585, 5, NULL, NULL, NULL, NULL, '2024-06-21 23:43:26', '2024-07-31 10:16:20');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `kode_kriteria` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_kriteria` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bobot` double DEFAULT NULL,
  `atribut` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`kode_kriteria`, `nama_kriteria`, `bobot`, `atribut`, `created_at`, `updated_at`) VALUES
('C01', 'Keaktifan Siswa', 0.32, 'benefit', '2024-06-21 23:36:09', '2024-07-31 10:09:03'),
('C02', 'Kemampuan Kolaborasi dan Kerja Tim', 0.22, 'benefit', '2024-06-21 23:36:28', '2024-07-31 10:09:15'),
('C03', 'Inisiatif dan Kreatifitas', 0.24, 'benefit', '2024-06-21 23:36:56', '2024-07-31 10:09:30'),
('C04', 'Komunikasi Guru dengan Murid', 0.2, 'benefit', '2024-06-21 23:37:16', '2024-07-31 10:09:52');

-- --------------------------------------------------------

--
-- Table structure for table `tb_rel_alternatif`
--

CREATE TABLE `tb_rel_alternatif` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `kode_alternatif` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_kriteria` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_subkriteria` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_rel_alternatif`
--

INSERT INTO `tb_rel_alternatif` (`ID`, `kode_alternatif`, `kode_kriteria`, `id_subkriteria`, `created_at`, `updated_at`) VALUES
(12622, 'A001', 'C01', 35, NULL, '2024-07-04 21:26:04'),
(12623, 'A001', 'C02', 42, NULL, '2024-06-21 23:44:04'),
(12624, 'A001', 'C03', 43, NULL, '2024-06-21 23:44:04'),
(12625, 'A001', 'C04', 47, NULL, '2024-06-21 23:44:04'),
(12629, 'A002', 'C01', 34, NULL, '2024-06-21 23:44:25'),
(12630, 'A002', 'C02', 39, NULL, '2024-06-22 22:32:59'),
(12631, 'A002', 'C03', 43, NULL, '2024-07-04 20:33:24'),
(12632, 'A002', 'C04', 46, NULL, '2024-06-21 23:44:25'),
(12636, 'A003', 'C01', 34, NULL, '2024-07-04 20:33:50'),
(12637, 'A003', 'C02', 41, NULL, '2024-07-04 20:33:50'),
(12638, 'A003', 'C03', 43, NULL, '2024-07-04 20:33:50'),
(12639, 'A003', 'C04', 48, NULL, '2024-06-21 23:44:50'),
(12643, 'A004', 'C01', 35, NULL, '2024-07-04 20:34:23'),
(12644, 'A004', 'C02', 42, NULL, '2024-06-21 23:45:08'),
(12645, 'A004', 'C03', 44, NULL, '2024-06-21 23:45:08'),
(12646, 'A004', 'C04', 47, NULL, '2024-06-21 23:45:08'),
(12650, 'A005', 'C01', 35, NULL, '2024-07-04 20:34:52'),
(12651, 'A005', 'C02', 39, NULL, '2024-07-04 20:34:52'),
(12652, 'A005', 'C03', 43, NULL, '2024-07-04 20:34:52'),
(12653, 'A005', 'C04', 47, NULL, '2024-06-21 23:45:25'),
(12657, 'A006', 'C01', 35, NULL, '2024-07-04 20:35:24'),
(12658, 'A006', 'C02', 41, NULL, '2024-06-22 22:34:06'),
(12659, 'A006', 'C03', 45, NULL, '2024-06-21 23:45:40'),
(12660, 'A006', 'C04', 46, NULL, '2024-06-21 23:45:40');

-- --------------------------------------------------------

--
-- Table structure for table `tb_subkriteria`
--

CREATE TABLE `tb_subkriteria` (
  `id_subkriteria` bigint(20) UNSIGNED NOT NULL,
  `nama_subkriteria` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_kriteria` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bobot_subkriteria` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_subkriteria`
--

INSERT INTO `tb_subkriteria` (`id_subkriteria`, `nama_subkriteria`, `kode_kriteria`, `bobot_subkriteria`, `created_at`, `updated_at`) VALUES
(34, 'Bagus Sekali', 'C01', 4, '2024-06-21 23:38:02', '2024-07-04 20:30:46'),
(35, 'Bagus', 'C01', 3, '2024-06-21 23:38:16', '2024-07-04 20:30:35'),
(36, 'Cukup Bagus', 'C01', 2, '2024-06-21 23:38:27', '2024-07-04 20:30:21'),
(38, 'Kurang Bagus', 'C01', 1, '2024-06-21 23:38:38', '2024-07-04 20:30:00'),
(39, 'Bagus Sekali', 'C02', 4, '2024-06-21 23:39:19', '2024-07-04 20:31:34'),
(40, 'Bagus', 'C02', 3, '2024-06-21 23:39:32', '2024-07-04 20:31:21'),
(41, 'Cukup Bagus', 'C02', 2, '2024-06-21 23:39:50', '2024-07-04 20:31:09'),
(42, 'Kurang Bagus', 'C02', 1, '2024-06-21 23:40:25', '2024-07-04 20:30:57'),
(43, 'Bagus', 'C03', 3, '2024-06-21 23:40:51', '2024-06-21 23:40:51'),
(44, 'Cukup Bagus', 'C03', 2, '2024-06-21 23:41:14', '2024-06-21 23:41:14'),
(45, 'Kurang Bagus', 'C03', 1, '2024-06-21 23:41:25', '2024-06-21 23:41:25'),
(46, 'Bagus', 'C04', 3, '2024-06-21 23:41:42', '2024-06-21 23:41:42'),
(47, 'Cukup Bagus', 'C04', 2, '2024-06-21 23:41:57', '2024-06-21 23:41:57'),
(48, 'Kurang Bagus', 'C04', 1, '2024-06-21 23:42:08', '2024-06-21 23:42:08'),
(49, 'Bagus Sekali', 'C03', 4, '2024-07-04 20:31:58', '2024-07-04 20:31:58'),
(50, 'Bagus Sekali', 'C04', 4, '2024-07-04 20:32:20', '2024-07-04 20:32:20');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `nama_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_user` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_user`, `username`, `password`, `level`, `status_user`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin', '$2y$10$mW/G0Z.cxywdZVS/vPECd.6iDdaWSKcZm/WBHFfi5j.4.3/K.oEwS', 'Admin', 1, NULL, '2022-04-08 07:23:31'),
(2, 'User', 'user', '$2y$10$v9NJUwUoaxfcL6O.ZfWukegFB2YUTcP/LU8t0RJrIByIpGl..0gHG', 'User', 1, NULL, '2023-06-28 21:13:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tb_alternatif`
--
ALTER TABLE `tb_alternatif`
  ADD PRIMARY KEY (`kode_alternatif`);

--
-- Indexes for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  ADD PRIMARY KEY (`kode_kriteria`);

--
-- Indexes for table `tb_rel_alternatif`
--
ALTER TABLE `tb_rel_alternatif`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tb_subkriteria`
--
ALTER TABLE `tb_subkriteria`
  ADD PRIMARY KEY (`id_subkriteria`),
  ADD KEY `kode_kriteria` (`kode_kriteria`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `tb_user_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_rel_alternatif`
--
ALTER TABLE `tb_rel_alternatif`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12661;

--
-- AUTO_INCREMENT for table `tb_subkriteria`
--
ALTER TABLE `tb_subkriteria`
  MODIFY `id_subkriteria` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_subkriteria`
--
ALTER TABLE `tb_subkriteria`
  ADD CONSTRAINT `tb_subkriteria_ibfk_1` FOREIGN KEY (`kode_kriteria`) REFERENCES `tb_kriteria` (`kode_kriteria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
