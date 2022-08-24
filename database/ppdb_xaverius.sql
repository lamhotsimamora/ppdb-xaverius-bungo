-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Agu 2022 pada 07.00
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ppdb_xaverius`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `token`) VALUES
(1, 'admin', '3221232f297a57a5a743894a0e4a801fc332', 'ff5lo6tmftzp195lipq1kpep4');

-- --------------------------------------------------------

--
-- Struktur dari tabel `file_berkas`
--

CREATE TABLE `file_berkas` (
  `id_file` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `kartu_keluarga` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `file_berkas`
--

INSERT INTO `file_berkas` (`id_file`, `id_peserta`, `kartu_keluarga`) VALUES
(2, 0, 'ow3810ri7e06v0nalmcxwcavo-w3j1lsbm48qj9hecwq4hnuvkq.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peserta`
--

CREATE TABLE `peserta` (
  `id_peserta` int(11) NOT NULL,
  `username` varchar(66) DEFAULT NULL,
  `nama_lengkap` varchar(211) DEFAULT NULL,
  `asal_sekolah` varchar(255) DEFAULT NULL,
  `agama` int(11) DEFAULT NULL COMMENT '1 = Kristen Protestan\r\n2 = Kristen Katolik\r\n3 = Islam\r\n4 = Budha\r\n5 = Hindu',
  `password` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `ayah` varchar(121) DEFAULT NULL,
  `ibu` varchar(121) DEFAULT NULL,
  `hp` varchar(121) DEFAULT NULL,
  `file_kartu_keluarga` text DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `peserta`
--

INSERT INTO `peserta` (`id_peserta`, `username`, `nama_lengkap`, `asal_sekolah`, `agama`, `password`, `alamat`, `ayah`, `ibu`, `hp`, `file_kartu_keluarga`, `token`) VALUES
(32, 'simamora', 'Simamora', 'Jakarta', 2, '32827ccb0eea8a706c4c34a16891f84e7b32', 'Jambi', 'Anton', 'Sarah', '0812121', 'y3v3fwknh0mjs0lmv1t51q3yc-6ooftlgjschxsrce9otbpexcx.PNG', '32372f29e47ea07a411d54801d8ea67fb832');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `view_peserta`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_peserta` (
`id_peserta` int(11)
,`username` varchar(66)
,`nama_lengkap` varchar(211)
,`asal_sekolah` varchar(255)
,`agama` int(11)
,`password` varchar(255)
,`alamat` varchar(255)
,`ayah` varchar(121)
,`ibu` varchar(121)
,`hp` varchar(121)
,`token` varchar(255)
,`kartu_keluarga` varchar(255)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `view_peserta`
--
DROP TABLE IF EXISTS `view_peserta`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_peserta`  AS SELECT `peserta`.`id_peserta` AS `id_peserta`, `peserta`.`username` AS `username`, `peserta`.`nama_lengkap` AS `nama_lengkap`, `peserta`.`asal_sekolah` AS `asal_sekolah`, `peserta`.`agama` AS `agama`, `peserta`.`password` AS `password`, `peserta`.`alamat` AS `alamat`, `peserta`.`ayah` AS `ayah`, `peserta`.`ibu` AS `ibu`, `peserta`.`hp` AS `hp`, `peserta`.`token` AS `token`, `file_berkas`.`kartu_keluarga` AS `kartu_keluarga` FROM (`peserta` join `file_berkas`) WHERE `peserta`.`id_peserta` = `file_berkas`.`id_peserta` ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `file_berkas`
--
ALTER TABLE `file_berkas`
  ADD PRIMARY KEY (`id_file`);

--
-- Indeks untuk tabel `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id_peserta`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `file_berkas`
--
ALTER TABLE `file_berkas`
  MODIFY `id_file` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
