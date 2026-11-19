-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 19, 2026 at 02:00 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id` bigint UNSIGNED NOT NULL,
  `sesi_absensi_id` bigint UNSIGNED NOT NULL,
  `siswa_id` bigint UNSIGNED NOT NULL,
  `waktu_absen` datetime DEFAULT NULL,
  `status` enum('hadir','izin','sakit','alpa') NOT NULL DEFAULT 'alpa',
  `metode` enum('langsung','koreksi','manual_guru') NOT NULL DEFAULT 'langsung',
  `bukti_sakit` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id`, `sesi_absensi_id`, `siswa_id`, `waktu_absen`, `status`, `metode`, `bukti_sakit`, `created_at`, `updated_at`, `latitude`, `longitude`) VALUES
(1, 1, 54, '2026-11-07 10:43:24', 'hadir', 'langsung', NULL, '2026-11-07 03:43:24', '2026-11-07 03:43:24', NULL, NULL),
(2, 2, 54, '2026-11-08 10:39:16', 'sakit', 'langsung', 'surat-sakit/NgJr24qACZV9bcoKgVgcLHUZqbbKBEiRCCp065gc.png', '2026-11-08 03:39:16', '2026-11-08 03:39:16', NULL, NULL),
(3, 4, 54, '2026-11-11 22:18:39', 'hadir', 'langsung', NULL, '2026-11-11 15:18:39', '2026-11-11 15:18:39', -2.4495620, 114.9134140),
(4, 5, 54, '2026-11-11 22:28:29', 'izin', 'langsung', NULL, '2026-11-11 15:28:29', '2026-11-11 15:28:29', NULL, NULL),
(5, 3, 54, '2026-11-11 22:33:13', 'sakit', 'langsung', 'surat-sakit/fcWVJ6yojLqxbMmj6ES9kiDfx7NglTN9oiJQnUVu.png', '2026-11-11 15:33:13', '2026-11-11 15:33:13', NULL, NULL),
(6, 6, 54, '2026-11-12 09:02:35', 'izin', 'langsung', NULL, '2026-11-12 02:02:35', '2026-11-12 02:02:35', NULL, NULL),
(7, 9, 3, '2026-11-14 00:33:25', 'hadir', 'manual_guru', NULL, '2026-11-13 17:33:25', '2026-11-13 17:33:25', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `absensi_guru`
--

CREATE TABLE `absensi_guru` (
  `id` bigint UNSIGNED NOT NULL,
  `guru_id` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `jam_masuk` datetime DEFAULT NULL,
  `latitude_masuk` decimal(10,7) DEFAULT NULL,
  `longitude_masuk` decimal(10,7) DEFAULT NULL,
  `jam_pulang` datetime DEFAULT NULL,
  `latitude_pulang` decimal(10,7) DEFAULT NULL,
  `longitude_pulang` decimal(10,7) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `absensi_guru`
--

INSERT INTO `absensi_guru` (`id`, `guru_id`, `tanggal`, `jam_masuk`, `latitude_masuk`, `longitude_masuk`, `jam_pulang`, `latitude_pulang`, `longitude_pulang`, `created_at`, `updated_at`) VALUES
(1, 13, '2026-11-07', '2026-11-07 03:12:25', -2.4495620, 114.9134140, NULL, NULL, NULL, '2026-11-06 20:12:25', '2026-11-06 20:12:25'),
(2, 13, '2026-11-08', '2026-11-08 10:37:22', -2.4495620, 114.9134140, NULL, NULL, NULL, '2026-11-08 03:37:22', '2026-11-08 03:37:22'),
(3, 13, '2026-11-12', '2026-11-12 09:38:24', -2.4497310, 114.9136580, '2026-11-12 10:32:21', -1.7212872, 114.8364502, '2026-11-12 02:38:24', '2026-11-12 03:32:21'),
(4, 5, '2026-11-12', '2026-11-12 10:51:50', -2.4500262, 114.9136486, '2026-11-12 10:52:39', -2.4500246, 114.9136486, '2026-11-12 03:51:50', '2026-11-12 03:52:39');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `nip` varchar(30) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `user_id`, `nip`, `nama`, `created_at`, `updated_at`, `jabatan`, `jenis_kelamin`) VALUES
(1, 143, '197511092009042003', 'Aminah, SE.', '2026-11-04 02:00:01', '2026-11-04 02:00:01', NULL, NULL),
(2, 144, '198101102008022001', 'Laily Farida, S.Hut.', '2026-11-04 02:00:01', '2026-11-04 02:00:01', NULL, NULL),
(3, 145, '197809072010011008', 'Bratha El Rasyid, S.Pd.I.', '2026-11-04 02:00:01', '2026-11-04 02:00:01', NULL, NULL),
(4, 146, '198411072011011002', 'M. Hari Laksono, S.Pd.', '2026-11-04 02:00:01', '2026-11-04 02:00:01', NULL, NULL),
(5, 147, '198812102020122014', 'Lita Andini, S.Pd.', '2026-11-04 02:00:01', '2026-11-04 02:00:01', NULL, NULL),
(6, 148, '198912042020122014', 'Desi Intan Sari, S.Pd.', '2026-11-04 02:00:01', '2026-11-04 02:00:01', NULL, NULL),
(7, 149, '197905312022212007', 'Khalimatu Zahroh, S.S.', '2026-11-04 02:00:01', '2026-11-04 02:00:01', NULL, NULL),
(8, 150, '198807272022211005', 'Vicky S. Menteng, S.Pd.', '2026-11-04 02:00:01', '2026-11-04 02:00:01', NULL, NULL),
(9, 151, '199307262022211003', 'Leo Saputra, S.Pd.', '2026-11-04 02:00:01', '2026-11-04 02:00:01', NULL, NULL),
(10, 152, '199611292022212005', 'Jurniah, S.Pd.', '2026-11-04 02:00:01', '2026-11-04 02:00:01', NULL, NULL),
(11, 153, '198909132024212008', 'Yulia Fitri, S.Pd.', '2026-11-04 02:00:01', '2026-11-04 02:00:01', NULL, NULL),
(12, 154, '199410102024212009', 'Siti Rahmah, S.Pd.', '2026-11-04 02:00:01', '2026-11-04 02:00:01', NULL, NULL),
(13, 155, '199211252025211004', 'Satriady, S.AB.', '2026-11-04 02:00:01', '2026-11-04 02:00:01', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_kelas` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `created_at`, `updated_at`) VALUES
(1, 'X A', '2026-11-04 01:17:31', '2026-11-04 01:17:31'),
(2, 'X B', '2026-11-04 01:17:31', '2026-11-04 01:17:31'),
(3, 'XI A', '2026-11-04 01:17:31', '2026-11-04 01:17:31'),
(4, 'XI B', '2026-11-04 01:17:31', '2026-11-04 01:17:31'),
(5, 'XII A', '2026-11-04 01:17:31', '2026-11-04 01:17:31'),
(6, 'XII B', '2026-11-04 01:17:31', '2026-11-04 01:17:31');

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Matematika', '2026-11-04 02:29:31', '2026-11-04 02:29:31'),
(2, 'Matematika Tingkat Lanjut', '2026-11-04 02:29:31', '2026-11-04 02:29:31'),
(3, 'Prakarya Kerajinan', '2026-11-04 02:29:31', '2026-11-04 02:29:31'),
(4, 'Pend.Agama Islam dan Budi Pekerti', '2026-11-04 02:29:31', '2026-11-04 02:29:31'),
(5, 'Sosiologi (IPS)', '2026-11-04 02:29:31', '2026-11-04 02:29:31'),
(6, 'Sosiologi Mapel Pilihan', '2026-11-04 02:29:31', '2026-11-04 02:29:31'),
(7, 'Bahasa Indonesia', '2026-11-04 02:29:31', '2026-11-04 02:29:31'),
(8, 'Bahasa Indonesia Tingkat Lanjut', '2026-11-04 02:29:31', '2026-11-04 02:29:31'),
(9, 'Fisika (IPA)', '2026-11-04 02:29:31', '2026-11-04 02:29:31'),
(10, 'Informatika', '2026-11-04 02:29:31', '2026-11-04 02:29:31'),
(11, 'Bahasa Inggris', '2026-11-04 02:29:31', '2026-11-04 02:29:31'),
(12, 'Seni dan Budaya (Seni Rupa)', '2026-11-04 02:29:31', '2026-11-04 02:29:31'),
(13, 'Pend. Pancasila', '2026-11-04 02:29:31', '2026-11-04 02:29:31'),
(14, 'Mulok', '2026-11-04 02:29:31', '2026-11-04 02:29:31'),
(15, 'PJOK', '2026-11-04 02:29:31', '2026-11-04 02:29:31'),
(16, 'Kimia (IPA)', '2026-11-04 02:29:31', '2026-11-04 02:29:31'),
(17, 'Kimia Mapel Pilihan', '2026-11-04 02:29:31', '2026-11-04 02:29:31'),
(18, 'Prakarya Budi Daya', '2026-11-04 02:29:31', '2026-11-04 02:29:31'),
(19, 'Prakarya Pengolahan', '2026-11-04 02:29:31', '2026-11-04 02:29:31'),
(20, 'Bimbingan dan Konseling', '2026-11-04 02:29:31', '2026-11-04 02:29:31'),
(21, 'Geografi', '2026-11-04 02:29:31', '2026-11-04 02:29:31'),
(22, 'Sejarah (IPS)', '2026-11-04 02:29:31', '2026-11-04 02:29:31'),
(23, 'Biologi (IPA)', '2026-11-04 02:29:31', '2026-11-04 02:29:31'),
(24, 'Biologi Mapel Pilihan', '2026-11-04 02:29:31', '2026-11-04 02:29:31'),
(25, 'Ekonomi (IPS)', '2026-11-04 02:29:31', '2026-11-04 02:29:31'),
(26, 'Ekonomi Mapel Pilihan', '2026-11-04 02:29:31', '2026-11-04 02:29:31');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_koreksi`
--

CREATE TABLE `pengajuan_koreksi` (
  `id` bigint UNSIGNED NOT NULL,
  `absensi_id` bigint UNSIGNED NOT NULL,
  `siswa_id` bigint UNSIGNED NOT NULL,
  `alasan` text NOT NULL,
  `keterangan` text,
  `status` enum('menunggu','diterima','ditolak') NOT NULL DEFAULT 'menunggu',
  `diproses_oleh` bigint UNSIGNED DEFAULT NULL,
  `diproses_pada` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_absensi`
--

CREATE TABLE `riwayat_absensi` (
  `id` bigint UNSIGNED NOT NULL,
  `absensi_id` bigint UNSIGNED NOT NULL,
  `status_lama` varchar(20) NOT NULL,
  `status_baru` varchar(20) NOT NULL,
  `alasan` text,
  `diubah_oleh` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_kelas`
--

CREATE TABLE `riwayat_kelas` (
  `id` bigint UNSIGNED NOT NULL,
  `siswa_id` bigint UNSIGNED NOT NULL,
  `kelas_id` bigint UNSIGNED NOT NULL,
  `tahun_ajaran` varchar(20) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sesi_absensi`
--

CREATE TABLE `sesi_absensi` (
  `id` bigint UNSIGNED NOT NULL,
  `kelas_id` bigint UNSIGNED NOT NULL,
  `guru_id` bigint UNSIGNED NOT NULL,
  `mata_pelajaran_id` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `status` enum('dibuka','ditutup') DEFAULT 'dibuka',
  `kode_absensi` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sesi_absensi`
--

INSERT INTO `sesi_absensi` (`id`, `kelas_id`, `guru_id`, `mata_pelajaran_id`, `tanggal`, `jam_mulai`, `jam_selesai`, `status`, `kode_absensi`, `created_at`, `updated_at`) VALUES
(1, 1, 13, 25, '2026-11-07', '08:00:00', '11:00:00', 'dibuka', 'A8EUT1', '2026-11-07 03:31:37', '2026-11-07 03:42:37'),
(2, 1, 13, 25, '2026-11-08', '10:00:00', '11:00:00', 'dibuka', 'MPUA5V', '2026-11-08 03:38:03', '2026-11-08 03:38:03'),
(3, 3, 13, 10, '2026-11-11', '10:00:00', '23:00:00', 'dibuka', '8WN4KW', '2026-11-11 15:16:55', '2026-11-11 15:16:55'),
(4, 3, 13, 10, '2026-11-11', '10:00:00', '23:00:00', 'dibuka', 'ECUNUH', '2026-11-11 15:16:57', '2026-11-11 15:16:57'),
(5, 2, 13, 13, '2026-11-11', '22:00:00', '23:00:00', 'dibuka', 'EIQ6N8', '2026-11-11 15:27:21', '2026-11-11 15:27:21'),
(6, 4, 13, 11, '2026-11-12', '09:00:00', '10:00:00', 'dibuka', 'L5DNUE', '2026-11-12 02:00:22', '2026-11-12 02:00:22'),
(7, 6, 13, 3, '2026-11-12', '09:00:00', '10:00:00', 'dibuka', '5WT4HN', '2026-11-12 02:39:02', '2026-11-12 02:39:02'),
(8, 1, 5, 7, '2026-11-12', '10:53:00', '11:53:00', 'dibuka', '4AM2ND', '2026-11-12 03:56:11', '2026-11-12 03:56:11'),
(9, 1, 13, 7, '2026-11-14', '00:33:25', '00:33:25', 'ditutup', NULL, '2026-11-13 17:33:25', '2026-11-13 17:33:25');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kelas_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `user_id`, `nisn`, `nama`, `kelas_id`, `created_at`, `updated_at`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`) VALUES
(2, 1, '0102189281', 'Adelia', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(3, 2, '0109756156', 'Adhitya Pratama Tombokan', 1, '2026-11-04 02:10:25', '2026-11-13 16:31:31', NULL, NULL, NULL),
(4, 3, '0105376225', 'Adila Alzahrah', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(5, 4, '0102418037', 'Afrisa Paramidana', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(6, 5, '0092441914', 'Ahmad Afghan', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(7, 6, '0084941437', 'Ahmad Badali', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(8, 7, '0088575167', 'Ahmad Hafi Badali', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(9, 8, '0074087261', 'Ahmad Hidayat', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(10, 9, '0081272770', 'Ahmad Jaini', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(11, 10, '0111135700', 'Ahmad Rifa\'I', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(12, 11, '0117829640', 'Ahmad Rifa\'I', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(13, 12, '0081818536', 'Ahmad Ripani', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(14, 13, '0117170390', 'Ahmad Rizal', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(15, 14, '0076318528', 'Ahmad Said', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(16, 15, '0114778913', 'Ainun Jakiah', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(17, 16, '0116391133', 'Akhmad Rafiq Azizi', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(18, 17, '0095202403', 'Akhmad Satria Ramadhani', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(19, 18, '0089482029', 'Alfianor', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(20, 19, '0104241142', 'Alicia Desiana Putri', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(21, 20, '0108128468', 'Alif Al Rizky', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(22, 21, '0108342373', 'Alifvia', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(23, 22, '0109574953', 'Alisia Julimayanti', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(24, 23, '0102462509', 'Aminullah', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(25, 24, '0118048672', 'Amrih Nauval', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(26, 25, '0094462917', 'Aprilia', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(27, 26, '3097642430', 'Arbain', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(28, 27, '0096483060', 'Arreira Wirasta', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(29, 28, '0104309157', 'Asyifa', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(30, 29, '0105265484', 'Asysyifa Qurratu\'In', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(31, 30, '0092135589', 'Aulia Rahmah', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(32, 31, '0093806646', 'Azkya Amalia', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(33, 32, '3075412543', 'Bagas Pratama', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(34, 33, '0102359019', 'Bahrul Ilmi', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(35, 34, '0095313301', 'Bekti Akbar', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(36, 35, '0103096947', 'Cintiya Bella', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(37, 36, '0104007033', 'Dina Septiana', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(38, 37, '0099889794', 'Fitri', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(39, 38, '0103638293', 'Hafizah', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(40, 39, '0091296877', 'Hafizah', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(41, 40, '0075532510', 'Hafna Afina', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(42, 41, '0096309415', 'Hapiz Mujahipi', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(43, 42, '0103942087', 'Helma Livia', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(44, 43, '0114614957', 'Herlinda', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(45, 44, '0116735370', 'Hidayah', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(46, 45, '0108669485', 'Hilyatol Aulia', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(47, 46, '0119819080', 'Himawan Genandra Adrafi', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(48, 47, '0111316935', 'Husna', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(49, 48, '0082496720', 'Imam Samudra', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(50, 49, '0109649329', 'Irfan', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(51, 50, '0101531011', 'Jely Adilla', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(52, 51, '0114338432', 'Khadijah', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(53, 52, '0092898164', 'Khafidz Akhfa Ananda', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(54, 53, '0103342607', 'Laiyon Agil Kusuma', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(55, 54, '3119578372', 'Linda', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(56, 55, '3081439928', 'M. Muchlas', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(57, 56, '0105116341', 'M. Rafi Hidayat', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(58, 57, '0095930874', 'M. Rendi', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(59, 58, '0101285689', 'M. Wildan', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(60, 59, '0116502337', 'Maeda Latifa', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(61, 60, '0115252286', 'Mariani', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(62, 61, '0086847494', 'Maulida Aulia Rahmah', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(63, 62, '0092141446', 'Maulida Keyshia', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(64, 63, '0094124091', 'Maulidah', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(65, 64, '0092836669', 'Mawarti', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(66, 65, '0075841253', 'Mia', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(67, 66, '0094564350', 'Muhamad Firzatulah', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(68, 67, '0097638534', 'Muhamad Hafizh', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(69, 68, '3103024078', 'Muhammad Abrar', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(70, 69, '0115889871', 'Muhammad Abrar Khalifi', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(71, 70, '0089095387', 'Muhammad Anas', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(72, 71, '0104469758', 'Muhammad Bakhid', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(73, 72, '0107040523', 'Muhammad Fadil', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(74, 73, '0087956928', 'Muhammad Kholis', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(75, 74, '0082690192', 'Muhammad Padli', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(76, 75, '0088363387', 'Muhammad Perdi', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(77, 76, '0103625380', 'Muhammad Raditya', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(78, 77, '0117019338', 'Muhammad Ridha\'I', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(79, 78, '0098707120', 'Muhammad Riski', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(80, 79, '0108925359', 'Muhammad Risky', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(81, 80, '0107374128', 'Muhammad Rizky', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(82, 81, '0097478336', 'Muhammad Safari', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(83, 82, '0092313355', 'Muhammad Safawi', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(84, 83, '0097438738', 'Muhammad Syarkawi', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(85, 84, '3121592985', 'Muhammad Syukran', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(86, 85, '0105389515', 'Muhammad Wildan', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(87, 86, '0116013394', 'Muhammad Zacky Alia', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(88, 87, '0095294498', 'Mukaramah', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(89, 88, '0087927831', 'Mupidah', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(90, 89, '0081589357', 'Muthia Salma', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(91, 90, '0095474635', 'Nabila', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(92, 91, '0092746470', 'Nabila Putri', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(93, 92, '0119757353', 'Nadia', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(94, 93, '0106203375', 'Najma Alia', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(95, 94, '0117215254', 'Ni Made Eka Wati', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(96, 95, '0114944918', 'Nia Pertiwi', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(97, 96, '0095278115', 'Nida Alvera', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(98, 97, '3095511088', 'Noor Siti Amelia', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(99, 98, '3093318852', 'Noorhayah', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(100, 99, '0109280198', 'Nor Aida', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(101, 100, '0119694577', 'Nor Syifa', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(102, 101, '0114488884', 'Nor Vizia', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(103, 102, '0102957952', 'Norhafizah', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(104, 103, '0091559817', 'Norhikmah', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(105, 104, '0102772794', 'Noupal. A.Z', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(106, 105, '0107511189', 'Nourhafizah', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(107, 106, '0098306953', 'Nur Aini', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(108, 107, '0097643831', 'Nur Aini', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(109, 108, '0111817132', 'Nur Asyfa', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(110, 109, '0075265485', 'Nuzurul', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(111, 110, '0094338691', 'Potri', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(112, 111, '0159545761', 'Rama', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(113, 112, '3102416166', 'Rendy Alviannor', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(114, 113, '0103960662', 'Renia', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(115, 114, '3094785803', 'Rifqi Arifin', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(116, 115, '0101860608', 'Riswan', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(117, 116, '0118199489', 'Risya', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(118, 117, '0104741932', 'Royyan Albar', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(119, 118, '0093057835', 'Rustati', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(120, 119, '0102314821', 'Sabrina', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(121, 120, '3101237458', 'Saidatunnisa', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(122, 121, '3076288139', 'Saini', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(123, 122, '0107743501', 'Saira', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(124, 123, '0104690810', 'Salsa Bila Shofa Azra', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(125, 124, '0102357788', 'Salsabila', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(126, 125, '0109180713', 'Samiah', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(127, 126, '0108876885', 'Saputra', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(128, 127, '0107610714', 'Saskia Apriliyanti', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(129, 128, '0104677351', 'Septia Maharani', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(130, 129, '0095554467', 'Shefti Ana Safitri', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(131, 130, '0094779966', 'Silviatul Azizah', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(132, 131, '0103874098', 'Siti Maulida', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(133, 132, '0101112309', 'Suci Ramadhani', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(134, 133, '0078032137', 'Sulaiman', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(135, 134, '0098531591', 'Sunia', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(136, 135, '0091774442', 'Syahriannor', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(137, 136, '0089883458', 'Ulvia Noor Aini', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(138, 137, '0115525097', 'Vatla Yanti', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(139, 138, '0083035975', 'Wafa Atqia', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(140, 139, '3106028277', 'Wajihaturrafifah', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(141, 140, '0086538197', 'Wedia', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(142, 141, '0115029758', 'Willy Wida Yanti', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL),
(143, 142, '0084968390', 'Yolanda', NULL, '2026-11-04 02:10:25', '2026-11-04 02:10:25', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','guru','siswa') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Adelia', 'Adelia', '0102189281', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(2, 'Adhitya Pratama Tombokan', 'Adhitya Pratama Tombokan', '0109756156', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(3, 'Adila Alzahrah', 'Adila Alzahrah', '0105376225', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(4, 'Afrisa Paramidana', 'Afrisa Paramidana', '0102418037', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(5, 'Ahmad Afghan', 'Ahmad Afghan', '0092441914', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(6, 'Ahmad Badali', 'Ahmad Badali', '0084941437', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(7, 'Ahmad Hafi Badali', 'Ahmad Hafi Badali', '0088575167', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(8, 'Ahmad Hidayat', 'Ahmad Hidayat', '0074087261', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(9, 'Ahmad Jaini', 'Ahmad Jaini', '0081272770', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(10, 'Ahmad Rifa\'I', 'Ahmad Rifa\'I', '0111135700', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(11, 'Ahmad Rifa\'I', 'Ahmad Rifa\'I', '0117829640', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(12, 'Ahmad Ripani', 'Ahmad Ripani', '0081818536', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(13, 'Ahmad Rizal', 'Ahmad Rizal', '0117170390', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(14, 'Ahmad Said', 'Ahmad Said', '0076318528', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(15, 'Ainun Jakiah', 'Ainun Jakiah', '0114778913', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(16, 'Akhmad Rafiq Azizi', 'Akhmad Rafiq Azizi', '0116391133', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(17, 'Akhmad Satria Ramadhani', 'Akhmad Satria Ramadhani', '0095202403', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(18, 'Alfianor', 'Alfianor', '0089482029', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(19, 'Alicia Desiana Putri', 'Alicia Desiana Putri', '0104241142', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(20, 'Alif Al Rizky', 'Alif Al Rizky', '0108128468', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(21, 'Alifvia', 'Alifvia', '0108342373', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(22, 'Alisia Julimayanti', 'Alisia Julimayanti', '0109574953', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(23, 'Aminullah', 'Aminullah', '0102462509', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(24, 'Amrih Nauval', 'Amrih Nauval', '0118048672', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(25, 'Aprilia', 'Aprilia', '0094462917', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(26, 'Arbain', 'Arbain', '3097642430', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(27, 'Arreira Wirasta', 'Arreira Wirasta', '0096483060', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(28, 'Asyifa', 'Asyifa', '0104309157', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(29, 'Asysyifa Qurratu\'In', 'Asysyifa Qurratu\'In', '0105265484', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(30, 'Aulia Rahmah', 'Aulia Rahmah', '0092135589', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(31, 'Azkya Amalia', 'Azkya Amalia', '0093806646', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(32, 'Bagas Pratama', 'Bagas Pratama', '3075412543', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(33, 'Bahrul Ilmi', 'Bahrul Ilmi', '0102359019', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(34, 'Bekti Akbar', 'Bekti Akbar', '0095313301', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(35, 'Cintiya Bella', 'Cintiya Bella', '0103096947', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(36, 'Dina Septiana', 'Dina Septiana', '0104007033', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(37, 'Fitri', 'Fitri', '0099889794', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(38, 'Hafizah', 'Hafizah', '0103638293', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(39, 'Hafizah', 'Hafizah', '0091296877', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(40, 'Hafna Afina', 'Hafna Afina', '0075532510', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(41, 'Hapiz Mujahipi', 'Hapiz Mujahipi', '0096309415', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(42, 'Helma Livia', 'Helma Livia', '0103942087', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(43, 'Herlinda', 'Herlinda', '0114614957', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(44, 'Hidayah', 'Hidayah', '0116735370', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(45, 'Hilyatol Aulia', 'Hilyatol Aulia', '0108669485', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(46, 'Himawan Genandra Adrafi', 'Himawan Genandra Adrafi', '0119819080', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(47, 'Husna', 'Husna', '0111316935', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(48, 'Imam Samudra', 'Imam Samudra', '0082496720', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(49, 'Irfan', 'Irfan', '0109649329', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(50, 'Jely Adilla', 'Jely Adilla', '0101531011', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(51, 'Khadijah', 'Khadijah', '0114338432', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(52, 'Khafidz Akhfa Ananda', 'Khafidz Akhfa Ananda', '0092898164', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(53, 'Laiyon Agil Kusuma', 'Laiyon Agil Kusuma', '0103342607', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(54, 'Linda', 'Linda', '3119578372', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(55, 'M. Muchlas', 'M. Muchlas', '3081439928', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(56, 'M. Rafi Hidayat', 'M. Rafi Hidayat', '0105116341', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(57, 'M. Rendi', 'M. Rendi', '0095930874', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(58, 'M. Wildan', 'M. Wildan', '0101285689', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(59, 'Maeda Latifa', 'Maeda Latifa', '0116502337', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(60, 'Mariani', 'Mariani', '0115252286', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(61, 'Maulida Aulia Rahmah', 'Maulida Aulia Rahmah', '0086847494', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(62, 'Maulida Keyshia', 'Maulida Keyshia', '0092141446', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(63, 'Maulidah', 'Maulidah', '0094124091', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(64, 'Mawarti', 'Mawarti', '0092836669', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(65, 'Mia', 'Mia', '0075841253', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(66, 'Muhamad Firzatulah', 'Muhamad Firzatulah', '0094564350', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(67, 'Muhamad Hafizh', 'Muhamad Hafizh', '0097638534', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(68, 'Muhammad Abrar', 'Muhammad Abrar', '3103024078', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(69, 'Muhammad Abrar Khalifi', 'Muhammad Abrar Khalifi', '0115889871', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(70, 'Muhammad Anas', 'Muhammad Anas', '0089095387', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(71, 'Muhammad Bakhid', 'Muhammad Bakhid', '0104469758', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(72, 'Muhammad Fadil', 'Muhammad Fadil', '0107040523', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(73, 'Muhammad Kholis', 'Muhammad Kholis', '0087956928', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(74, 'Muhammad Padli', 'Muhammad Padli', '0082690192', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(75, 'Muhammad Perdi', 'Muhammad Perdi', '0088363387', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(76, 'Muhammad Raditya', 'Muhammad Raditya', '0103625380', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(77, 'Muhammad Ridha\'I', 'Muhammad Ridha\'I', '0117019338', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(78, 'Muhammad Riski', 'Muhammad Riski', '0098707120', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(79, 'Muhammad Risky', 'Muhammad Risky', '0108925359', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(80, 'Muhammad Rizky', 'Muhammad Rizky', '0107374128', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(81, 'Muhammad Safari', 'Muhammad Safari', '0097478336', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(82, 'Muhammad Safawi', 'Muhammad Safawi', '0092313355', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(83, 'Muhammad Syarkawi', 'Muhammad Syarkawi', '0097438738', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(84, 'Muhammad Syukran', 'Muhammad Syukran', '3121592985', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(85, 'Muhammad Wildan', 'Muhammad Wildan', '0105389515', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(86, 'Muhammad Zacky Alia', 'Muhammad Zacky Alia', '0116013394', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(87, 'Mukaramah', 'Mukaramah', '0095294498', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(88, 'Mupidah', 'Mupidah', '0087927831', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(89, 'Muthia Salma', 'Muthia Salma', '0081589357', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(90, 'Nabila', 'Nabila', '0095474635', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(91, 'Nabila Putri', 'Nabila Putri', '0092746470', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(92, 'Nadia', 'Nadia', '0119757353', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(93, 'Najma Alia', 'Najma Alia', '0106203375', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(94, 'Ni Made Eka Wati', 'Ni Made Eka Wati', '0117215254', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(95, 'Nia Pertiwi', 'Nia Pertiwi', '0114944918', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(96, 'Nida Alvera', 'Nida Alvera', '0095278115', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(97, 'Noor Siti Amelia', 'Noor Siti Amelia', '3095511088', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(98, 'Noorhayah', 'Noorhayah', '3093318852', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(99, 'Nor Aida', 'Nor Aida', '0109280198', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(100, 'Nor Syifa', 'Nor Syifa', '0119694577', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(101, 'Nor Vizia', 'Nor Vizia', '0114488884', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(102, 'Norhafizah', 'Norhafizah', '0102957952', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(103, 'Norhikmah', 'Norhikmah', '0091559817', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(104, 'Noupal. A.Z', 'Noupal. A.Z', '0102772794', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(105, 'Nourhafizah', 'Nourhafizah', '0107511189', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(106, 'Nur Aini', 'Nur Aini', '0098306953', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(107, 'Nur Aini', 'Nur Aini', '0097643831', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(108, 'Nur Asyfa', 'Nur Asyfa', '0111817132', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(109, 'Nuzurul', 'Nuzurul', '0075265485', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(110, 'Potri', 'Potri', '0094338691', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(111, 'Rama', 'Rama', '0159545761', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(112, 'Rendy Alviannor', 'Rendy Alviannor', '3102416166', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(113, 'Renia', 'Renia', '0103960662', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(114, 'Rifqi Arifin', 'Rifqi Arifin', '3094785803', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(115, 'Riswan', 'Riswan', '0101860608', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(116, 'Risya', 'Risya', '0118199489', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(117, 'Royyan Albar', 'Royyan Albar', '0104741932', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(118, 'Rustati', 'Rustati', '0093057835', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(119, 'Sabrina', 'Sabrina', '0102314821', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(120, 'Saidatunnisa', 'Saidatunnisa', '3101237458', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(121, 'Saini', 'Saini', '3076288139', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(122, 'Saira', 'Saira', '0107743501', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(123, 'Salsa Bila Shofa Azra', 'Salsa Bila Shofa Azra', '0104690810', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(124, 'Salsabila', 'Salsabila', '0102357788', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(125, 'Samiah', 'Samiah', '0109180713', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(126, 'Saputra', 'Saputra', '0108876885', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(127, 'Saskia Apriliyanti', 'Saskia Apriliyanti', '0107610714', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(128, 'Septia Maharani', 'Septia Maharani', '0104677351', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(129, 'Shefti Ana Safitri', 'Shefti Ana Safitri', '0095554467', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(130, 'Silviatul Azizah', 'Silviatul Azizah', '0094779966', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(131, 'Siti Maulida', 'Siti Maulida', '0103874098', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(132, 'Suci Ramadhani', 'Suci Ramadhani', '0101112309', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(133, 'Sulaiman', 'Sulaiman', '0078032137', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(134, 'Sunia', 'Sunia', '0098531591', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(135, 'Syahriannor', 'Syahriannor', '0091774442', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(136, 'Ulvia Noor Aini', 'Ulvia Noor Aini', '0089883458', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(137, 'Vatla Yanti', 'Vatla Yanti', '0115525097', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(138, 'Wafa Atqia', 'Wafa Atqia', '0083035975', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(139, 'Wajihaturrafifah', 'Wajihaturrafifah', '3106028277', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(140, 'Wedia', 'Wedia', '0086538197', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(141, 'Willy Wida Yanti', 'Willy Wida Yanti', '0115029758', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(142, 'Yolanda', 'Yolanda', '0084968390', 'siswa', '2026-11-04 01:15:34', '2026-11-04 01:15:34'),
(143, 'Aminah, SE.', 'Aminah', '197511092009042003', 'guru', '2026-11-04 01:54:50', '2026-11-04 01:54:50'),
(144, 'Laily Farida, S.Hut.', 'Laily Farida', '198101102008022001', 'guru', '2026-11-04 01:54:50', '2026-11-04 01:54:50'),
(145, 'Bratha El Rasyid, S.Pd.I.', 'Bratha El Rasyid', '197809072010011008', 'guru', '2026-11-04 01:54:50', '2026-11-04 01:54:50'),
(146, 'M. Hari Laksono, S.Pd.', 'M. Hari Laksono', '198411072011011002', 'guru', '2026-11-04 01:54:50', '2026-11-04 01:54:50'),
(147, 'Lita Andini, S.Pd.', 'Lita Andini', '198812102020122014', 'guru', '2026-11-04 01:54:50', '2026-11-04 01:54:50'),
(148, 'Desi Intan Sari, S.Pd.', 'Desi Intan Sari', '198912042020122014', 'guru', '2026-11-04 01:54:50', '2026-11-04 01:54:50'),
(149, 'Khalimatu Zahroh, S.S.', 'Khalimatu Zahroh', '197905312022212007', 'guru', '2026-11-04 01:54:50', '2026-11-04 01:54:50'),
(150, 'Vicky S. Menteng, S.Pd.', 'Vicky S. Menteng', '198807272022211005', 'guru', '2026-11-04 01:54:50', '2026-11-04 01:54:50'),
(151, 'Leo Saputra, S.Pd.', 'Leo Saputra', '199307262022211003', 'guru', '2026-11-04 01:54:50', '2026-11-04 01:54:50'),
(152, 'Jurniah, S.Pd.', 'Jurniah', '199611292022212005', 'guru', '2026-11-04 01:54:50', '2026-11-04 01:54:50'),
(153, 'Yulia Fitri, S.Pd.', 'Yulia Fitri', '198909132024212008', 'guru', '2026-11-04 01:54:50', '2026-11-04 01:54:50'),
(154, 'Siti Rahmah, S.Pd.', 'Siti Rahmah', '199410102024212009', 'guru', '2026-11-04 01:54:50', '2026-11-04 01:54:50'),
(155, 'Satriady, S.AB.', 'Satriady', '199211252025211004', 'guru', '2026-11-04 01:54:50', '2026-11-04 01:54:50'),
(156, 'Aditya Rahmani S.Kom.', 'Aditya Rahmani', 'AdityaRahmani1223', 'admin', '2026-11-04 01:54:50', '2026-11-04 01:54:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unik_absensi` (`sesi_absensi_id`,`siswa_id`),
  ADD KEY `siswa_id` (`siswa_id`);

--
-- Indexes for table `absensi_guru`
--
ALTER TABLE `absensi_guru`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unik_absensi_guru_harian` (`guru_id`,`tanggal`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nip` (`nip`),
  ADD KEY `fk_guru_user` (`user_id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengajuan_koreksi`
--
ALTER TABLE `pengajuan_koreksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_koreksi_absensi` (`absensi_id`),
  ADD KEY `fk_koreksi_siswa` (`siswa_id`),
  ADD KEY `fk_koreksi_user` (`diproses_oleh`);

--
-- Indexes for table `riwayat_absensi`
--
ALTER TABLE `riwayat_absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_riwayat_absensi` (`absensi_id`),
  ADD KEY `fk_riwayat_user` (`diubah_oleh`);

--
-- Indexes for table `riwayat_kelas`
--
ALTER TABLE `riwayat_kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_riwayat_siswa` (`siswa_id`),
  ADD KEY `fk_riwayat_kelas` (`kelas_id`);

--
-- Indexes for table `sesi_absensi`
--
ALTER TABLE `sesi_absensi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_absensi` (`kode_absensi`),
  ADD KEY `kelas_id` (`kelas_id`),
  ADD KEY `guru_id` (`guru_id`),
  ADD KEY `mata_pelajaran_id` (`mata_pelajaran_id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nisn` (`nisn`),
  ADD KEY `fk_siswa_user` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `absensi_guru`
--
ALTER TABLE `absensi_guru`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `pengajuan_koreksi`
--
ALTER TABLE `pengajuan_koreksi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `riwayat_absensi`
--
ALTER TABLE `riwayat_absensi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `riwayat_kelas`
--
ALTER TABLE `riwayat_kelas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sesi_absensi`
--
ALTER TABLE `sesi_absensi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`sesi_absensi_id`) REFERENCES `sesi_absensi` (`id`),
  ADD CONSTRAINT `absensi_ibfk_2` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`);

--
-- Constraints for table `absensi_guru`
--
ALTER TABLE `absensi_guru`
  ADD CONSTRAINT `fk_absensi_guru_guru` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `fk_guru_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengajuan_koreksi`
--
ALTER TABLE `pengajuan_koreksi`
  ADD CONSTRAINT `fk_koreksi_absensi` FOREIGN KEY (`absensi_id`) REFERENCES `absensi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_koreksi_siswa` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_koreksi_user` FOREIGN KEY (`diproses_oleh`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `riwayat_absensi`
--
ALTER TABLE `riwayat_absensi`
  ADD CONSTRAINT `fk_riwayat_absensi` FOREIGN KEY (`absensi_id`) REFERENCES `absensi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_riwayat_user` FOREIGN KEY (`diubah_oleh`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `riwayat_kelas`
--
ALTER TABLE `riwayat_kelas`
  ADD CONSTRAINT `fk_riwayat_kelas` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `fk_riwayat_siswa` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sesi_absensi`
--
ALTER TABLE `sesi_absensi`
  ADD CONSTRAINT `sesi_absensi_ibfk_1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`),
  ADD CONSTRAINT `sesi_absensi_ibfk_2` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`),
  ADD CONSTRAINT `sesi_absensi_ibfk_3` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `mata_pelajaran` (`id`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `fk_siswa_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
