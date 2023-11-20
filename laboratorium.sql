-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2023 at 05:36 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laboratorium`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangs`
--

CREATE TABLE `barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `laboratorium_id` bigint(20) UNSIGNED NOT NULL,
  `lokasi_penyimpanan_id` bigint(20) UNSIGNED NOT NULL,
  `peminjam_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar_barang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kondisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `part` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangs`
--

INSERT INTO `barangs` (`id`, `laboratorium_id`, `lokasi_penyimpanan_id`, `peminjam_id`, `nama_barang`, `kode_barang`, `gambar_barang`, `kondisi`, `status`, `deskripsi`, `part`, `created_at`, `updated_at`) VALUES
(134, 2, 5, NULL, 'Teknical Teaching equipment', 'tlkm-tte', NULL, 'Bagus', 'Tersedia', NULL, NULL, '2022-12-13 12:58:58', '2022-12-13 12:58:58'),
(135, 2, 5, NULL, 'Teknical Teaching equipment', 'tlkm-tte-2', NULL, 'Bagus', 'Tersedia', NULL, NULL, '2022-12-13 12:58:58', '2022-12-13 12:58:58'),
(136, 2, 5, NULL, 'Teknical Teaching equipment', 'tlkm-tte-3', NULL, 'Bagus', 'Tersedia', NULL, NULL, '2022-12-13 12:58:58', '2022-12-13 12:58:58'),
(177, 1, 5, NULL, 'Power Supply', 'lkom-ps', NULL, 'Bagus', 'Tersedia', NULL, NULL, '2022-12-13 13:03:27', '2022-12-13 13:03:27'),
(178, 1, 5, NULL, 'Power Supply', 'lkom-ps-2', NULL, 'Bagus', 'Tersedia', NULL, NULL, '2022-12-13 13:03:27', '2022-12-13 13:03:27'),
(179, 1, 5, NULL, 'Power Supply', 'lkom-ps-3', NULL, 'Bagus', 'Tersedia', NULL, NULL, '2022-12-13 13:03:27', '2022-12-13 13:03:27'),
(187, 4, 5, NULL, 'Aki-12V-55AH', 'ic-12v-55ah', NULL, 'Bagus', 'Tersedia', NULL, NULL, '2022-12-13 13:06:23', '2022-12-13 13:06:23'),
(188, 4, 5, NULL, 'Aki-12V-55AH', 'ic-12v-55ah-2', NULL, 'Bagus', 'Tersedia', NULL, NULL, '2022-12-13 13:06:23', '2022-12-13 13:06:23'),
(189, 4, 5, NULL, 'Aki-12V-55AH', 'ic-12v-55ah-3', NULL, 'Bagus', 'Tersedia', NULL, NULL, '2022-12-13 13:06:23', '2022-12-13 13:06:23'),
(764, 3, 3, NULL, 'Radio', 'lfe-rd', NULL, 'Bagus', 'Tersedia', NULL, NULL, '2022-12-13 16:08:39', '2022-12-13 16:08:39'),
(765, 3, 3, NULL, 'Power Supply Delta 400W', 'lfe-psd-400w', NULL, 'Bagus', 'Tersedia', NULL, NULL, '2022-12-13 16:09:00', '2022-12-13 16:09:00'),
(766, 3, 3, NULL, 'Modem Radio', 'lfe-mr', NULL, 'Bagus', 'Tersedia', NULL, NULL, '2022-12-13 16:09:14', '2022-12-13 16:09:14'),

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_fakultas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`id`, `nama_fakultas`, `created_at`, `updated_at`) VALUES
(1, 'SAINS DAN TEKNOLOGI', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(2, 'TARBIYAH DAN KEGURUAN', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(3, 'SYARI’AH DAN HUKUM', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(4, 'USHULUDDIN', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(5, 'DAKWAH &  KOMUNIKASI', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(6, 'PSIKOLOGI', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(7, 'EKONOMI DAN ILMU SOSIAL', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(8, 'PERTANIAN DAN PETERNAKAN', '2022-11-22 13:31:14', '2022-11-22 13:31:14');

-- --------------------------------------------------------

--
-- Table structure for table `jurusans`
--

CREATE TABLE `jurusans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fakultas_id` bigint(20) UNSIGNED NOT NULL,
  `nama_jurusan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jurusans`
--

INSERT INTO `jurusans` (`id`, `fakultas_id`, `nama_jurusan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Teknik Elektro', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(2, 1, 'Teknik Industri', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(3, 1, 'Sistem Informasi', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(4, 1, 'Matematika', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(5, 1, 'Teknik Informatika', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(6, 2, 'Pendidikan Agama Islam', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(7, 2, 'Pendidikan Bahasa Arab', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(8, 2, 'Manajemen Pendidikan Islam', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(9, 2, 'Pendidikan Bahasa Inggris', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(10, 2, 'Pendidikan Matematika', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(11, 2, 'Pendidikan Ekonomi', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(12, 2, 'Pendidikan Kimia', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(13, 2, 'Pendidikan Guru Madrasah Ibtidaiyah – S1', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(14, 2, 'Pendidikan Islam Anak Usia Dini', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(15, 2, 'Tadris Ilmu Pengetahuan Alam', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(16, 2, 'Pendidikan Guru Madrasah Ibtidaiyah – S2', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(17, 2, 'Pendidikan Bahasa Indonesia', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(18, 2, 'Pendidikan Geografi', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(19, 2, 'Tadris Ilmu Pengetahuan Sosial', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(20, 3, 'Hukum Keluarga Islam (Ahwal Syakhshiyyah)', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(21, 3, 'Hukum Ekonomi Syari’ah (Mua’malah)', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(22, 3, 'Perbandingan Mazhab', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(23, 3, 'Hukum Tata Negara (Siyasah)', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(24, 3, 'Ekonomi Syariah', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(25, 3, 'Perbankan Syari’ah', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(26, 3, 'Ilmu Hukum', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(27, 4, 'Aqidah dan Filsafat Islam', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(28, 4, 'Ilmu Al Qur’an Dan Tafsir', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(29, 4, 'Studi Agama Agama', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(30, 4, 'Ilmu Hadis', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(31, 5, 'Pengembangan Masyarakat Islam', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(32, 5, 'Bimbingan dan Konseling Islam', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(33, 5, 'Ilmu Komunikasi', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(34, 5, 'Manajemen Dakwah', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(35, 6, 'Psikologi', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(36, 6, 'Psikologi – S2', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(37, 7, 'Manajemen', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(38, 7, 'Manajemen Perusahaan', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(39, 7, 'Akuntansi', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(40, 7, 'Akuntansi D3', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(41, 7, 'Ilmu Administrasi Negara', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(42, 7, 'Administrasi Perpajakan', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(43, 8, 'Peternakan', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(44, 8, 'Agroteknologi', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(45, 8, 'Gizi', '2022-11-22 13:31:14', '2022-11-22 13:31:14');

-- --------------------------------------------------------

--
-- Table structure for table `laboratoria`
--

CREATE TABLE `laboratoria` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_laboratorium` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_laboratorium` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laboratoria`
--

INSERT INTO `laboratoria` (`id`, `nama_laboratorium`, `kode_laboratorium`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Laboratorium Komputer', 'LKOM', 'laboratorium-komputer', '2022-11-22 13:31:14', '2022-12-13 12:57:37'),
(2, 'Laboratorium Telekomunikasi', 'TLKM', 'laboratorium-telekomunikasi', '2022-11-22 13:31:14', '2022-12-13 12:53:13'),
(3, 'Laboratorium Fisika', 'LFE', 'laboratorium-fisika', '2022-11-22 13:31:14', '2022-12-13 12:57:47'),
(4, 'Laboratorium Instrumentasi dan Control', 'IC', 'laboratorium-instrumentasi', '2022-11-22 13:31:14', '2022-12-13 12:58:02');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi_penyimpanans`
--

CREATE TABLE `lokasi_penyimpanans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lokasi_penyimpanans`
--

INSERT INTO `lokasi_penyimpanans` (`id`, `nama_lokasi`, `kode_lokasi`, `slug`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Laboratorium Komputer', 'LKOM', 'laboratorium-komputer', 'nsakdnaskldnaslkjdhasdhasdasda', '2022-11-22 13:31:14', '2022-12-13 12:57:12'),
(2, 'Laboratorium Telekomunikasi', 'TLKM', 'laboratorium-telekomunikasi', 'nsakdnaskldnaslkjdhasdhasdasda', '2022-11-22 13:31:14', '2022-12-13 12:56:24'),
(3, 'Laboratorium Fisika', 'LFE', 'laboratorium-fisika', 'nsakdnaskldnaslkjdhasdhasdasda', '2022-11-22 13:31:14', '2022-12-13 12:56:43'),
(4, 'Laboratorium Instrumen dan Control', 'IC', 'laboratorium-instrumentasi', 'nsakdnaskldnaslkjdhasdhasdasda', '2022-11-22 13:31:14', '2022-12-13 12:55:51'),
(5, 'Gudang Laboratorium Telkom', 'GDTLKM', 'GDTLKM', NULL, '2022-12-13 12:54:47', '2022-12-13 12:54:47');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_08_08_190158_create_barangs_table', 1),
(6, '2022_08_09_100645_create_laboratoria_table', 1),
(7, '2022_08_09_100727_create_lokasi_penyimpanans_table', 1),
(8, '2022_09_29_174214_create_peminjams_table', 1),
(9, '2022_11_04_223110_create_jurusans_table', 1),
(10, '2022_11_04_223129_create_fakultas_table', 1),
(11, '2022_11_08_214845_create_tanggungans_table', 1);

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
-- Table structure for table `peminjams`
--

CREATE TABLE `peminjams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_peminjam` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_peminjam` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dosen_pembimbing` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nip_dosen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keperluan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fakultas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kontak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_peminjaman` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surat_izin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barang` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjams`
--


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
-- Table structure for table `tanggungans`
--

CREATE TABLE `tanggungans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peminjam_id` bigint(20) UNSIGNED NOT NULL,
  `terlambat` int(11) DEFAULT NULL,
  `kondisi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tanggungans`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `level`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'Prof. Audie Jacobson MD', 'Operator', 'celestino04@example.org', '2022-11-22 13:31:14', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'B1XYHxQiow', '2022-11-22 13:31:14', '2022-11-22 13:31:14'),
(7, 'test', 'Admin', 'test@mail.com', NULL, '$2y$10$feahfIM6TJAipLRx2OewKeQPoIBF9lNDx5RoJsb4fvOV61WKic9MK', NULL, '2023-11-20 16:35:50', '2023-11-20 16:35:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `barangs_kode_barang_unique` (`kode_barang`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurusans`
--
ALTER TABLE `jurusans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laboratoria`
--
ALTER TABLE `laboratoria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `laboratoria_kode_laboratorium_unique` (`kode_laboratorium`),
  ADD UNIQUE KEY `laboratoria_slug_unique` (`slug`);

--
-- Indexes for table `lokasi_penyimpanans`
--
ALTER TABLE `lokasi_penyimpanans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lokasi_penyimpanans_kode_lokasi_unique` (`kode_lokasi`),
  ADD UNIQUE KEY `lokasi_penyimpanans_slug_unique` (`slug`);

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
-- Indexes for table `peminjams`
--
ALTER TABLE `peminjams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `peminjams_kode_peminjaman_unique` (`kode_peminjaman`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tanggungans`
--
ALTER TABLE `tanggungans`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=851;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jurusans`
--
ALTER TABLE `jurusans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `laboratoria`
--
ALTER TABLE `laboratoria`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lokasi_penyimpanans`
--
ALTER TABLE `lokasi_penyimpanans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `peminjams`
--
ALTER TABLE `peminjams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tanggungans`
--
ALTER TABLE `tanggungans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
