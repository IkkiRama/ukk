-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Bulan Mei 2022 pada 06.18
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `buku`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `pengarang` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `pengarang`, `penerbit`, `gambar`, `created_at`, `updated_at`) VALUES
(4, 'anjay', 'anjay', 'anjay', '6234217ef28e8.jpg', '2022-03-18 06:14:11', '2022-03-18 06:06:54'),
(11, 'akasnadknasd', 'lkasnkandkasd', 'asmldkadlad', '6270a3dc8ee25.png', '2022-05-03 03:39:08', '2022-05-03 03:39:08'),
(12, 'kontol', 'kontol', 'kontol', '6271ede6d69b2.jpg', '2022-05-04 03:07:18', '2022-05-04 03:07:18'),
(13, 'JOkontol', 'Joko wokwok', 'Joko wikwik', '6271f3b6926ef.jpg', '2022-05-04 03:32:06', '2022-05-04 03:32:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`) VALUES
(4, 'asu', 'asu@gmail.com', '$2y$10$HquKV/djHfM5DS7UAv5HYuGeE4.0AYevttaOkPs/gpT'),
(7, 'luhut', 'luhut@gmail.com', '$2y$10$6xhECP5utVoRLll2QC.nUuAEUX8s7uw8QiNpQmnGWX7'),
(8, 'Jokontol', 'asds@asdasd', '$2y$10$MEz5ezBtaObHnFelCBHYjOqYx54kPXdElUmrjaXV9Fs'),
(15, 'b', 'b@gmail.com', '$2y$10$wF7ChsepAA/7c5Ij08y9yeuB70zYDwn0DcO/9wA6PQM'),
(19, 'a', 'a@gmail.com', '$2y$10$6UVj1eRCNCTuiWPh7ufU/.H2.MlE9oVOZq/j7ek5D/.');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
