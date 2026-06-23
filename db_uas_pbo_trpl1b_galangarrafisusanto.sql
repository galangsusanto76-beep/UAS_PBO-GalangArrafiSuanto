-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 23, 2026 at 01:24 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_uas_pbo_trpl1b_galangarrafisusanto`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_karyawan`
--

CREATE TABLE `tabel_karyawan` (
  `id_karyawan` int NOT NULL,
  `nama_karyawan` varchar(150) NOT NULL,
  `jenis_karyawan` enum('kontrak','tetap','magang') NOT NULL,
  `durasi_kontrak_bulan` int DEFAULT NULL,
  `agensi_karyawan` varchar(100) DEFAULT NULL
) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_karyawan`
--
ALTER TABLE `tabel_karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_karyawan`
--
ALTER TABLE `tabel_karyawan`
  MODIFY `id_karyawan` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

INSERT INTO tabel_karyawan (nama_karyawan, jenis_karyawan, durasi_kontrak_bulan, agensi_karyawan) VALUES
-- 1. Karyawan Tetap (Atribut spesifik diisi NULL)
('Aditya Pratama', 'tetap', NULL, NULL),
('Budi Santoso', 'tetap', NULL, NULL),
('Citra Dewi', 'tetap', NULL, NULL),
('Deni Setiawan', 'tetap', NULL, NULL),
('Eka Putri', 'tetap', NULL, NULL),
('Fajar Nugroho', 'tetap', NULL, NULL),
('Gita Permata', 'tetap', NULL, NULL),

-- 2. Karyawan Kontrak (Atribut spesifik wajib diisi)
('Hendra Wijaya', 'kontrak', 12, 'PT Sumber Daya Insani'),
('Indah Lestari', 'kontrak', 6, 'PT Mitra Kerja Utama'),
('Joko Susilo', 'kontrak', 24, 'PT Global Talent Solusi'),
('Kurniawan', 'kontrak', 12, 'PT Sumber Daya Insani'),
('Larasati', 'kontrak', 6, 'PT Mitra Kerja Utama'),
('Muhammad Rizky', 'kontrak', 24, 'PT Global Talent Solusi'),
('Nadia Utami', 'kontrak', 12, 'PT Sumber Daya Insani'),

-- 3. Karyawan Magang (Atribut spesifik diisi NULL)
('Oki Setiawan', 'magang', NULL, NULL),
('Putri Ayu', 'magang', NULL, NULL),
('Qori Ahmad', 'magang', NULL, NULL),
('Rian Hidayat', 'magang', NULL, NULL),
('Siti Aminah', 'magang', NULL, NULL),
('Taufik Hidayat', 'magang', NULL, NULL),
('Vina Panduwinata', 'magang', NULL, NULL);