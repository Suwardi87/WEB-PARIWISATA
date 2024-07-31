-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Jul 2024 pada 06.12
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_parawisata`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `searchhistory`
--

CREATE TABLE `searchhistory` (
  `id` int(11) NOT NULL,
  `query` varchar(255) NOT NULL,
  `search_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `searchhistory`
--

INSERT INTO `searchhistory` (`id`, `query`, `search_date`) VALUES
(6, 'ssa', '2024-07-06 03:37:07'),
(7, 'sss', '2024-07-06 03:38:58'),
(8, '9', '2024-07-06 03:39:04'),
(9, 'wisata', '2024-07-06 03:44:21'),
(10, 'swah', '2024-07-06 03:44:28'),
(11, 'sawah', '2024-07-06 03:44:40'),
(12, 'sawah', '2024-07-06 03:46:23'),
(13, '9', '2024-07-06 03:46:55'),
(14, '9', '2024-07-06 03:47:26'),
(15, '9', '2024-07-06 03:47:48'),
(16, '9', '2024-07-06 03:49:04'),
(17, '9', '2024-07-06 03:49:06'),
(18, 'sawah', '2024-07-06 03:49:09'),
(19, 'sawah', '2024-07-06 03:50:16'),
(20, 'sawah', '2024-07-06 03:50:48'),
(21, 'sawah', '2024-07-06 03:52:27'),
(22, 'sawah', '2024-07-06 03:55:33'),
(23, 'sawah', '2024-07-06 03:55:50'),
(24, 'sawah', '2024-07-06 03:56:53'),
(25, 'sawah', '2024-07-06 03:56:54'),
(26, 'sawah', '2024-07-06 03:57:11'),
(27, 'margin', '2024-07-06 03:57:21'),
(28, 'objek', '2024-07-06 03:59:12'),
(29, 'objek', '2024-07-06 03:59:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tempatwisata`
--

CREATE TABLE `tempatwisata` (
  `idTempatWisata` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `informasi` text NOT NULL,
  `fotoTempat` varchar(255) NOT NULL,
  `linkMap` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tempatwisata`
--

INSERT INTO `tempatwisata` (`idTempatWisata`, `nama`, `lokasi`, `deskripsi`, `informasi`, `fotoTempat`, `linkMap`) VALUES
(16, 'sawah 9', 'Terletak di Nagari Aie Angek, Kecamatan Sepuluh Koto, Kabupaten Tanah datar', 'sa', 'a', '[\"uploads\\/IMG-20240703-WA0006.jpg\"]', 'https://maps.app.goo.gl/PeymEYADn9sXnW6w7');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ulasan`
--

CREATE TABLE `ulasan` (
  `idUlasan` int(11) NOT NULL,
  `idWisatawan` int(11) NOT NULL,
  `idTempatWisata` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `komentar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `level`) VALUES
(8, 'admin', 'admin', 'admin123', 'admin'),
(13, 'wisatawan', 'wisatawan', 'wisatawan123', 'wisatawan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wisatawan`
--

CREATE TABLE `wisatawan` (
  `idWisatawan` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `wisatawan`
--

INSERT INTO `wisatawan` (`idWisatawan`, `nama`, `username`, `password`) VALUES
(9, 'fiqih', 'fiqih', 'fiqih');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `searchhistory`
--
ALTER TABLE `searchhistory`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tempatwisata`
--
ALTER TABLE `tempatwisata`
  ADD PRIMARY KEY (`idTempatWisata`);

--
-- Indeks untuk tabel `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`idUlasan`),
  ADD KEY `idWisatawan` (`idWisatawan`),
  ADD KEY `idTempatWisata` (`idTempatWisata`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `wisatawan`
--
ALTER TABLE `wisatawan`
  ADD PRIMARY KEY (`idWisatawan`),
  ADD UNIQUE KEY `email` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `searchhistory`
--
ALTER TABLE `searchhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `tempatwisata`
--
ALTER TABLE `tempatwisata`
  MODIFY `idTempatWisata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `idUlasan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `wisatawan`
--
ALTER TABLE `wisatawan`
  MODIFY `idWisatawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `ulasan`
--
ALTER TABLE `ulasan`
  ADD CONSTRAINT `ulasan_ibfk_1` FOREIGN KEY (`idWisatawan`) REFERENCES `wisatawan` (`idWisatawan`),
  ADD CONSTRAINT `ulasan_ibfk_2` FOREIGN KEY (`idTempatWisata`) REFERENCES `tempatwisata` (`idTempatWisata`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
