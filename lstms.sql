-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 21 Bulan Mei 2022 pada 17.57
-- Versi server: 10.3.34-MariaDB-cll-lve
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ueln2381_u-elektrik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `lstms`
--

CREATE TABLE `lstms` (
  `lstm_id` int(10) UNSIGNED NOT NULL,
  `nomorserial_id` bigint(20) UNSIGNED NOT NULL,
  `pemakaian_listrik` double(8,2) DEFAULT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `lstms`
--

INSERT INTO `lstms` (`lstm_id`, `nomorserial_id`, `pemakaian_listrik`, `tanggal`) VALUES
(1, 20220812-1, 0.51, '2022-03-16 22:00:00'),
(2, 20220812-1, 0.43, '2022-03-16 23:00:00'),
(3, 20220812-1, 0.41, '2022-03-17 00:00:00'),
(4, 20220812-1, 0.49, '2022-03-17 01:00:00'),
(5, 20220812-1, 0.48, '2022-03-17 02:00:00'),
(6, 20220812-1, 0.44, '2022-03-17 03:00:00'),
(7, 20220812-1, 0.39, '2022-03-17 04:00:00'),
(8, 20220812-1, 0.30, '2022-03-17 05:00:00'),
(9, 20220812-1, 0.27, '2022-03-17 06:00:00'),
(10, 20220812-1, 0.25, '2022-03-17 07:00:00'),
(11, 20220812-1, 0.24, '2022-03-17 08:00:00'),
(12, 20220812-1, 0.25, '2022-03-17 09:00:00'),
(13, 20220812-1, 0.36, '2022-03-17 10:00:00'),
(14, 20220812-1, 0.35, '2022-03-17 11:00:00'),
(15, 20220812-1, 0.35, '2022-03-17 12:00:00'),
(16, 20220812-1, 0.50, '2022-03-17 13:00:00'),
(17, 20220812-1, 0.52, '2022-03-17 14:00:00'),
(18, 20220812-1, 0.50, '2022-03-17 15:00:00'),
(19, 20220812-1, 0.43, '2022-03-17 16:00:00'),
(20, 20220812-1, 0.45, '2022-03-17 17:00:00'),
(21, 20220812-1, 0.45, '2022-03-17 18:00:00'),
(22, 20220812-1, 0.48, '2022-03-17 19:00:00'),
(23, 20220812-1, 0.58, '2022-03-17 20:00:00'),
(24, 20220812-1, 0.61, '2022-03-17 21:00:00');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `lstms`
--
ALTER TABLE `lstms`
  ADD PRIMARY KEY (`lstm_id`),
  ADD KEY `lstms_nomorserial_id_foreign` (`nomorserial_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `lstms`
--
ALTER TABLE `lstms`
  MODIFY `lstm_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `lstms`
--
ALTER TABLE `lstms`
  ADD CONSTRAINT `lstms_nomorserial_id_foreign` FOREIGN KEY (`nomorserial_id`) REFERENCES `nomorserials` (`nomorserial_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
