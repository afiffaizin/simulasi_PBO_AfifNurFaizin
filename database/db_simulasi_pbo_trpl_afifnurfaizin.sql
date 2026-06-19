-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 19, 2026 at 03:05 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_simulasi_pbo_trpl_afifnurfaizin`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_pendaftaran`
--

CREATE TABLE `tabel_pendaftaran` (
  `id_pendaftaran` int NOT NULL,
  `nama_calon` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `asal_sekolah` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `nilai_ujian` decimal(5,2) NOT NULL,
  `biaya_pendaftaran_dasar` int NOT NULL,
  `jalur_pendaftaran` enum('Reguler','Prestasi','Kedinasan') COLLATE utf8mb4_general_ci NOT NULL,
  `pilihan_prodi` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lokasi_kampus` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenis_prestasi` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tingkat_prestasi` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sk_ikatan_dinas` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `instansi_sponsor` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabel_pendaftaran`
--

INSERT INTO `tabel_pendaftaran` (`id_pendaftaran`, `nama_calon`, `asal_sekolah`, `nilai_ujian`, `biaya_pendaftaran_dasar`, `jalur_pendaftaran`, `pilihan_prodi`, `lokasi_kampus`, `jenis_prestasi`, `tingkat_prestasi`, `sk_ikatan_dinas`, `instansi_sponsor`) VALUES
(1, 'Ahmad Fauzi', 'SMAN 1 Jakarta', 85.50, 500000, 'Reguler', 'Teknik Informatika', 'Kampus A - Jakarta', NULL, NULL, NULL, NULL),
(2, 'Budi Santoso', 'SMAN 3 Bandung', 78.25, 500000, 'Reguler', 'Sistem Informasi', 'Kampus B - Bandung', NULL, NULL, NULL, NULL),
(3, 'Citra Dewi', 'SMAN 5 Surabaya', 90.00, 500000, 'Reguler', 'Teknik Elektro', 'Kampus C - Surabaya', NULL, NULL, NULL, NULL),
(4, 'Dian Permata', 'SMKN 2 Yogyakarta', 82.75, 500000, 'Reguler', 'Manajemen Informatika', 'Kampus A - Jakarta', NULL, NULL, NULL, NULL),
(5, 'Eka Prasetya', 'SMAN 1 Semarang', 88.00, 500000, 'Reguler', 'Teknik Informatika', 'Kampus D - Semarang', NULL, NULL, NULL, NULL),
(6, 'Fajar Ramadhan', 'SMAN 2 Malang', 76.50, 500000, 'Reguler', 'Sistem Informasi', 'Kampus C - Surabaya', NULL, NULL, NULL, NULL),
(7, 'Gita Nuraini', 'SMKN 1 Bekasi', 81.00, 500000, 'Reguler', 'Teknik Komputer', 'Kampus A - Jakarta', NULL, NULL, NULL, NULL),
(8, 'Hana Safitri', 'SMAN 1 Depok', 92.50, 500000, 'Prestasi', NULL, NULL, 'Olimpiade Matematika', 'Nasional', NULL, NULL),
(9, 'Irfan Maulana', 'SMAN 4 Bogor', 89.75, 500000, 'Prestasi', NULL, NULL, 'Lomba Robotika', 'Provinsi', NULL, NULL),
(10, 'Jasmine Putri', 'SMKN 3 Tangerang', 91.00, 500000, 'Prestasi', NULL, NULL, 'Olimpiade Fisika', 'Internasional', NULL, NULL),
(11, 'Kevin Aditya', 'SMAN 2 Medan', 87.50, 500000, 'Prestasi', NULL, NULL, 'Kompetisi Programming', 'Nasional', NULL, NULL),
(12, 'Laila Husna', 'SMAN 1 Makassar', 93.25, 500000, 'Prestasi', NULL, NULL, 'Olimpiade Kimia', 'Provinsi', NULL, NULL),
(13, 'Muhammad Rizki', 'SMKN 5 Palembang', 86.00, 500000, 'Prestasi', NULL, NULL, 'Lomba Desain Grafis', 'Kota/Kabupaten', NULL, NULL),
(14, 'Nabila Azzahra', 'SMAN 3 Denpasar', 94.50, 500000, 'Prestasi', NULL, NULL, 'Olimpiade Informatika', 'Internasional', NULL, NULL),
(15, 'Oscar Pratama', 'SMAN 1 Bandung', 88.00, 500000, 'Kedinasan', NULL, NULL, NULL, NULL, 'SK/2025/DIN/001', 'Kementerian Kominfo'),
(16, 'Putri Handayani', 'SMAN 2 Jakarta', 85.75, 500000, 'Kedinasan', NULL, NULL, NULL, NULL, 'SK/2025/DIN/002', 'BSSN'),
(17, 'Qori Setiawan', 'SMKN 1 Surabaya', 90.50, 500000, 'Kedinasan', NULL, NULL, NULL, NULL, 'SK/2025/DIN/003', 'BPS'),
(18, 'Ratna Sari', 'SMAN 4 Semarang', 83.25, 500000, 'Kedinasan', NULL, NULL, NULL, NULL, 'SK/2025/DIN/004', 'Kementerian PUPR'),
(19, 'Satria Wibowo', 'SMAN 1 Yogyakarta', 87.00, 500000, 'Kedinasan', NULL, NULL, NULL, NULL, 'SK/2025/DIN/005', 'Kementerian Keuangan'),
(20, 'Tiara Anggraeni', 'SMKN 2 Malang', 91.25, 500000, 'Kedinasan', NULL, NULL, NULL, NULL, 'SK/2025/DIN/006', 'BMKG'),
(21, 'Umar Hakim', 'SMAN 3 Makassar', 84.50, 500000, 'Kedinasan', NULL, NULL, NULL, NULL, 'SK/2025/DIN/007', 'Kementerian Pertahanan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_pendaftaran`
--
ALTER TABLE `tabel_pendaftaran`
  ADD PRIMARY KEY (`id_pendaftaran`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_pendaftaran`
--
ALTER TABLE `tabel_pendaftaran`
  MODIFY `id_pendaftaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
