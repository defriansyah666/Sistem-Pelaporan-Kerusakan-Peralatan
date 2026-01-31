-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 19, 2025 at 11:45 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pa_lubuksikaping`
--

-- --------------------------------------------------------

--
-- Table structure for table `approvals`
--

CREATE TABLE `approvals` (
  `id` int UNSIGNED NOT NULL,
  `report_id` int UNSIGNED NOT NULL,
  `status_approval` enum('disetujui','ditolak') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `catatan_atasan` text COLLATE utf8mb4_general_ci,
  `approved_by` int UNSIGNED DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `approvals`
--

INSERT INTO `approvals` (`id`, `report_id`, `status_approval`, `catatan_atasan`, `approved_by`, `approved_at`) VALUES
(1, 1, 'disetujui', 'Mantap', 3, '2025-11-19 09:12:10'),
(2, 2, 'disetujui', 'Keren', 3, '2025-11-19 10:47:33'),
(3, 3, 'disetujui', 'Kerjakan sekarang', 3, '2025-11-19 10:58:27'),
(4, 4, 'disetujui', 'Mantap', 3, '2025-11-19 11:09:13');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `timestamp` int UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `it_estimations`
--

CREATE TABLE `it_estimations` (
  `id` int UNSIGNED NOT NULL,
  `report_id` int UNSIGNED NOT NULL,
  `estimasi_biaya` decimal(15,2) DEFAULT NULL,
  `estimasi_waktu` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `catatan_it` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `it_estimations`
--

INSERT INTO `it_estimations` (`id`, `report_id`, `estimasi_biaya`, `estimasi_waktu`, `catatan_it`, `created_at`, `updated_at`) VALUES
(1, 1, 2500000.00, '5 hari kerja', 'Perlu ganti mainboard', '2025-11-19 09:11:25', '2025-11-19 09:11:25'),
(2, 2, 150000.00, '2', 'Ditunggu', '2025-11-19 10:46:13', '2025-11-19 10:46:13'),
(3, 3, 500000.00, '1', 'harus segera dperbaiki cepat setujui', '2025-11-19 10:57:57', '2025-11-19 10:57:57'),
(4, 4, 70000.00, '1', 'harus di ganti cip', '2025-11-19 11:08:41', '2025-11-19 11:08:41');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2025-11-19-000001', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1763541095, 1),
(2, '2025-11-19-000002', 'App\\Database\\Migrations\\CreateReportsTable', 'default', 'App', 1763541095, 1),
(3, '2025-11-19-000003', 'App\\Database\\Migrations\\CreateItEstimationsTable', 'default', 'App', 1763541095, 1),
(4, '2025-11-19-000004', 'App\\Database\\Migrations\\CreateApprovalsTable', 'default', 'App', 1763541095, 1),
(5, '2025-11-19-000005', 'App\\Database\\Migrations\\CreateSessionsTable', 'default', 'App', 1763541095, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int UNSIGNED NOT NULL,
  `nama_pelapor` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `unit_kerja` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_barang` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` enum('baru','diproses','estimasi','disetujui','ditolak','selesai') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'baru',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `nama_pelapor`, `unit_kerja`, `jenis_barang`, `deskripsi`, `foto`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Budi Santoso', 'Kepaniteraan', 'Printer HP LaserJet rusak', 'Tidak bisa print, lampu merah', '1763541889_7c0f4388fae802922192.jpeg', 'disetujui', '2025-11-19 08:44:49', '2025-11-19 09:12:10'),
(2, 'Doni', 'Testing', 'Leptop Rusak', 'Tidak mau dinyalakan', '1763548792_5f689ddc756224361ad8.jpg', 'disetujui', '2025-11-19 10:39:52', '2025-11-19 10:47:33'),
(3, 'Joni', 'Kantor A', 'Komputer', 'Tadi menyala tiba tiba mati ', '1763549813_1e150f9c1af9da4d0cd7.jpeg', 'disetujui', '2025-11-19 10:56:53', '2025-11-19 10:58:27'),
(4, 'Amat', 'Kepaniteraan', 'Monitor', 'Tiba-tiba mati', '1763550470_521344a9d05a81eb18d4.jpeg', 'disetujui', '2025-11-19 11:07:50', '2025-11-19 11:09:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('admin','it','atasan') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'it',
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `nama_lengkap`, `role`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator PA Lubuksikaping', 'admin', '$2y$10$ydn84X8UNi1RuxwWZMKLD.xmiLdXmgvhUQPEYguM1D2ubCLDSjrxK', '2025-11-19 08:31:40', NULL),
(2, 'it', 'Tim IT PA Lubuksikaping', 'it', '$2y$10$8phmfwMYK7W/NAqc9IIsS.u0KbO1w9/MsDBvxdWwQKhaQB6qXcieG', '2025-11-19 08:31:40', NULL),
(3, 'atasan', 'Kepala Tata Usaha', 'atasan', '$2y$10$yNd.Wa1BKmeuJzCnk6Yxx.ZrAL0HiYUzKYfTo/tDha5OMxW9f0lEW', '2025-11-19 08:31:40', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approvals`
--
ALTER TABLE `approvals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `approvals_report_id_foreign` (`report_id`),
  ADD KEY `approvals_approved_by_foreign` (`approved_by`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `timestamp` (`timestamp`);

--
-- Indexes for table `it_estimations`
--
ALTER TABLE `it_estimations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `it_estimations_report_id_foreign` (`report_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approvals`
--
ALTER TABLE `approvals`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `it_estimations`
--
ALTER TABLE `it_estimations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `approvals`
--
ALTER TABLE `approvals`
  ADD CONSTRAINT `approvals_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `approvals_report_id_foreign` FOREIGN KEY (`report_id`) REFERENCES `reports` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `it_estimations`
--
ALTER TABLE `it_estimations`
  ADD CONSTRAINT `it_estimations_report_id_foreign` FOREIGN KEY (`report_id`) REFERENCES `reports` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
