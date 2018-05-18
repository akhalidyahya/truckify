-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2018 at 06:50 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_truckify`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `nama`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES
(4, 'khalid Yahya', 'yahya', 'c4ca4238a0b923820dcc509a6f75849b', 'admin', '2018-03-26 21:37:31', '2018-03-26 22:42:16'),
(5, 'Udin Dinamo', 'dinamo', 'c4ca4238a0b923820dcc509a6f75849b', 'pegawai', '2018-04-27 08:13:46', '2018-04-27 08:13:46');

-- --------------------------------------------------------

--
-- Table structure for table `datascripts`
--

CREATE TABLE `datascripts` (
  `id` int(10) UNSIGNED NOT NULL,
  `tanggal` date DEFAULT NULL,
  `tipe` int(10) UNSIGNED NOT NULL,
  `no_truck` int(10) UNSIGNED NOT NULL,
  `no_do` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barang` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `daerah` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lain` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `datascripts`
--

INSERT INTO `datascripts` (`id`, `tanggal`, `tipe`, `no_truck`, `no_do`, `barang`, `customer`, `daerah`, `lain`, `cost`, `created_at`, `updated_at`) VALUES
(2, '2018-04-27', 3, 17, '11255426', '343', 'Jack Lee', 'Depok', '1000', '20000', '2018-04-27 12:14:59', '2018-04-27 12:14:59');

-- --------------------------------------------------------

--
-- Table structure for table `hargas`
--

CREATE TABLE `hargas` (
  `id` int(10) UNSIGNED NOT NULL,
  `daerah` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hargas`
--

INSERT INTO `hargas` (`id`, `daerah`, `harga`, `created_at`, `updated_at`) VALUES
(1, 'Jakarta', '50000', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(10) UNSIGNED NOT NULL,
  `no` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nominal` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_invoice` date DEFAULT NULL,
  `tgl_tempo` date DEFAULT NULL,
  `tgl_do` date DEFAULT NULL,
  `tgl_bayar` date DEFAULT NULL,
  `logistik` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `no`, `nominal`, `tgl_invoice`, `tgl_tempo`, `tgl_do`, `tgl_bayar`, `logistik`, `created_at`, `updated_at`) VALUES
(1, '012', '54000000', '2018-04-03', '2018-04-04', '2018-04-04', '2018-04-04', 'Kamadjaya', NULL, '2018-04-26 09:18:12'),
(5, '035', '20000000', '2018-04-03', '2018-04-06', '2018-04-11', '2018-04-12', 'Data Script', '2018-04-03 07:32:05', '2018-04-03 07:32:05'),
(6, '40', '14000000', '2018-04-03', '2018-05-16', '2018-05-24', '2018-05-31', 'So Good', '2018-05-07 03:19:17', '2018-05-07 03:19:59'),
(7, '51', '23000000', '2018-04-03', '2018-04-06', '2018-04-11', '2018-04-12', 'So Good', '2018-05-07 03:19:17', '2018-05-07 03:19:17');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kendaraans`
--

CREATE TABLE `jenis_kendaraans` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis_kendaraan` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `daerah` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_kendaraans`
--

INSERT INTO `jenis_kendaraans` (`id`, `jenis_kendaraan`, `daerah`, `harga`, `created_at`, `updated_at`) VALUES
(1, 'GGG', 'jakarta', '80000', NULL, NULL),
(3, 'WWW', 'Bogor', '100000', '2018-04-02 04:10:24', '2018-04-02 04:25:48');

-- --------------------------------------------------------

--
-- Table structure for table `kamadjayas`
--

CREATE TABLE `kamadjayas` (
  `id` int(10) UNSIGNED NOT NULL,
  `tanggal` date DEFAULT NULL,
  `no_truck` int(10) UNSIGNED NOT NULL,
  `no_do` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipe` int(10) UNSIGNED NOT NULL,
  `customer` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `destinasi` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wilayah` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `daerah` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_do` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kamadjayas`
--

INSERT INTO `kamadjayas` (`id`, `tanggal`, `no_truck`, `no_do`, `tipe`, `customer`, `destinasi`, `wilayah`, `daerah`, `qty`, `total_do`, `desc`, `cost`, `created_at`, `updated_at`) VALUES
(1, '2018-04-25', 17, '1241415', 1, 'jane Doe', 'jl. kenanga', 'kab bogor', 'jabar', '10', '1', 'contoh desc', '12000', NULL, '2018-04-26 08:45:20');

-- --------------------------------------------------------

--
-- Table structure for table `kendaraans`
--

CREATE TABLE `kendaraans` (
  `id` int(10) UNSIGNED NOT NULL,
  `nopol` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stnk` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `merk` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `daerah` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kir` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sipa` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ibm` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kiu` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kendaraans`
--

INSERT INTO `kendaraans` (`id`, `nopol`, `stnk`, `tahun`, `merk`, `daerah`, `foto`, `kir`, `sipa`, `ibm`, `kiu`, `created_at`, `updated_at`) VALUES
(17, 'B 7879 ZX', '123456789', '2014', 'Yamaha', 'Depok', '8.jpg', '126451', '127468', '891624', '7812423', '2018-03-26 09:25:14', '2018-04-26 07:15:03'),
(19, 'D 3332 WE', '124124235', '2015', 'Toyota', 'Bali', '800px-Padang_opelet.JPG', '34534', '34634', '346346', '4576745', '2018-05-02 12:33:36', '2018-05-02 14:27:48'),
(20, 'B 9743 OP', '12435346356', '2019', 'Hyundai', 'jakarta', 'Delman_in_Blitar.jpg', '34634', '346346', '536357', '3463465', '2018-05-02 12:33:36', '2018-05-02 12:33:36');

-- --------------------------------------------------------

--
-- Table structure for table `mekaniks`
--

CREATE TABLE `mekaniks` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mekaniks`
--

INSERT INTO `mekaniks` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(4, 'Willl Smith', '2018-03-26 10:16:51', '2018-03-26 22:32:41'),
(5, 'John doe', '2018-03-26 22:40:59', '2018-03-26 22:40:59');

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
(3, '2014_10_12_000000_create_users_table', 1),
(4, '2014_10_12_100000_create_password_resets_table', 1),
(5, '2018_03_24_190541_create_datakendaraans_table', 2),
(6, '2018_03_26_042811_create_storings_table', 3),
(7, '2018_03_26_062426_create_storings_table', 4),
(8, '2018_03_26_065435_create_mekaniks_table', 5),
(9, '2018_03_27_042647_create_admin_table', 6),
(10, '2018_03_27_062048_tes', 7),
(11, '2018_03_27_072720_create_pengeluarans_table', 8),
(12, '2018_03_28_043339_create_invoices_table', 9),
(13, '2018_04_02_033029_add_fk_to_storings_table', 10),
(14, '2018_04_02_035637_add_fk_storings', 11),
(15, '2018_04_02_083842_create_jenis_kendaraans_table', 12),
(16, '2018_04_02_084145_create_hargas_table', 13),
(17, '2018_04_02_130058_create_pengeluarans_table', 14),
(18, '2018_04_02_131040_create_pengeluarans_table', 15),
(19, '2018_04_02_132842_create_table_pengeluaran', 16),
(20, '2018_04_02_132955_create_table_pengeluaran', 17),
(21, '2018_04_02_145159_update_table_pengeluaran', 18),
(22, '2018_04_03_003141_create_invoices_table', 19),
(25, '2018_04_25_185216_create_table_kamadjayas', 20),
(26, '2018_04_26_231543_create_datascripts_table', 21),
(28, '2018_04_26_235606_edit_table_datascript', 22),
(29, '2018_04_27_131019_create_sogoods_table', 23);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengeluarans`
--

CREATE TABLE `pengeluarans` (
  `id` int(10) UNSIGNED NOT NULL,
  `tanggal` date DEFAULT NULL,
  `ujskamadjaya` double DEFAULT NULL,
  `ujsdatascript` double DEFAULT NULL,
  `ujssogood` double DEFAULT NULL,
  `storing` double DEFAULT NULL,
  `lain` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `keterangan` varchar(1500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pemasukan` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengeluarans`
--

INSERT INTO `pengeluarans` (`id`, `tanggal`, `ujskamadjaya`, `ujsdatascript`, `ujssogood`, `storing`, `lain`, `total`, `keterangan`, `pemasukan`, `created_at`, `updated_at`) VALUES
(16, '2018-04-03', 1000, 1000, 1000, 12000, 1000, 16000, NULL, NULL, NULL, '2018-05-07 04:55:04'),
(18, '2018-04-27', 1000, 1000, 1000, 20000, 1000, 24000, NULL, NULL, NULL, '2018-05-07 04:56:52'),
(19, '2018-05-07', 5000, 5000, 5000, 80000, 5000, 100000, NULL, NULL, '2018-05-07 08:08:07', '2018-05-07 08:08:07'),
(20, '2018-06-01', 10000, 10000, 20000, 0, 10000, 50000, NULL, NULL, NULL, '2018-05-08 15:03:49'),
(21, '2018-03-01', 1000, 1000, 1000, 0, 1000, 4000, NULL, NULL, NULL, '2018-05-08 15:12:58');

-- --------------------------------------------------------

--
-- Table structure for table `sogoods`
--

CREATE TABLE `sogoods` (
  `id` int(10) UNSIGNED NOT NULL,
  `tanggal` date DEFAULT NULL,
  `tipe` int(10) UNSIGNED NOT NULL,
  `no_truck` int(10) UNSIGNED NOT NULL,
  `no_do` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barang` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `daerah` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lain` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `storings`
--

CREATE TABLE `storings` (
  `id` int(10) UNSIGNED NOT NULL,
  `kendaraan` int(10) UNSIGNED DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jenis` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `biaya` double DEFAULT NULL,
  `biaya_mekanik` double DEFAULT NULL,
  `mekanik` int(10) UNSIGNED DEFAULT NULL,
  `foto` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_bon` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `storings`
--

INSERT INTO `storings` (`id`, `kendaraan`, `tanggal`, `jenis`, `biaya`, `biaya_mekanik`, `mekanik`, `foto`, `foto_bon`, `created_at`, `updated_at`) VALUES
(9, 17, '2018-04-02', 'Ganti ban dan oli', 50000, 20000, 4, '11.png', '31.jpg', '2018-04-01 22:40:18', '2018-04-01 22:54:27'),
(10, 17, '2018-04-03', 'Ganti Ban', 10000, 2000, 5, 'a.jpg', 'a.jpg', NULL, '2018-05-07 04:33:51'),
(12, 20, '2018-05-07', 'Tune Up', 50000, 20000, 4, '', '', '2018-05-07 04:39:47', '2018-05-07 04:39:47'),
(14, 19, '2018-04-27', 'Ganti oli', 10000, 10000, 5, '', '', '2018-05-07 04:45:28', '2018-05-07 04:45:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `datascripts`
--
ALTER TABLE `datascripts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `datascripts_no_truck_foreign` (`no_truck`),
  ADD KEY `datascripts_tipe_foreign` (`tipe`);

--
-- Indexes for table `hargas`
--
ALTER TABLE `hargas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_kendaraans`
--
ALTER TABLE `jenis_kendaraans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kamadjayas`
--
ALTER TABLE `kamadjayas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kamadjayas_no_truck_foreign` (`no_truck`),
  ADD KEY `kamadjayas_tipe_foreign` (`tipe`);

--
-- Indexes for table `kendaraans`
--
ALTER TABLE `kendaraans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mekaniks`
--
ALTER TABLE `mekaniks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pengeluarans`
--
ALTER TABLE `pengeluarans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sogoods`
--
ALTER TABLE `sogoods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sogoods_no_truck_foreign` (`no_truck`),
  ADD KEY `sogoods_tipe_foreign` (`tipe`);

--
-- Indexes for table `storings`
--
ALTER TABLE `storings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `storings_kendaraan_foreign` (`kendaraan`),
  ADD KEY `storings_mekanik_foreign` (`mekanik`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `datascripts`
--
ALTER TABLE `datascripts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hargas`
--
ALTER TABLE `hargas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jenis_kendaraans`
--
ALTER TABLE `jenis_kendaraans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kamadjayas`
--
ALTER TABLE `kamadjayas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kendaraans`
--
ALTER TABLE `kendaraans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `mekaniks`
--
ALTER TABLE `mekaniks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `pengeluarans`
--
ALTER TABLE `pengeluarans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `sogoods`
--
ALTER TABLE `sogoods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `storings`
--
ALTER TABLE `storings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `datascripts`
--
ALTER TABLE `datascripts`
  ADD CONSTRAINT `datascripts_no_truck_foreign` FOREIGN KEY (`no_truck`) REFERENCES `kendaraans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `datascripts_tipe_foreign` FOREIGN KEY (`tipe`) REFERENCES `jenis_kendaraans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kamadjayas`
--
ALTER TABLE `kamadjayas`
  ADD CONSTRAINT `kamadjayas_no_truck_foreign` FOREIGN KEY (`no_truck`) REFERENCES `kendaraans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kamadjayas_tipe_foreign` FOREIGN KEY (`tipe`) REFERENCES `jenis_kendaraans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sogoods`
--
ALTER TABLE `sogoods`
  ADD CONSTRAINT `sogoods_no_truck_foreign` FOREIGN KEY (`no_truck`) REFERENCES `kendaraans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sogoods_tipe_foreign` FOREIGN KEY (`tipe`) REFERENCES `jenis_kendaraans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `storings`
--
ALTER TABLE `storings`
  ADD CONSTRAINT `storings_kendaraan_foreign` FOREIGN KEY (`kendaraan`) REFERENCES `kendaraans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `storings_mekanik_foreign` FOREIGN KEY (`mekanik`) REFERENCES `mekaniks` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
