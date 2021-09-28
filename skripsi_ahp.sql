-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 28 Sep 2021 pada 07.25
-- Versi Server: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi_ahp2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` int(11) NOT NULL,
  `id_pantai` int(11) NOT NULL,
  `nilai_hasil` float NOT NULL,
  `id_jenis` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `hasil`
--

INSERT INTO `hasil` (`id_hasil`, `id_pantai`, `nilai_hasil`, `id_jenis`) VALUES
(232, 6, 0.26949, 4),
(233, 7, 0.65155, 4),
(234, 8, 0.41388, 4),
(235, 10, 0.71012, 4),
(236, 12, 0.33165, 4),
(237, 13, 0.36773, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` int(11) NOT NULL,
  `jenis_wisata` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `jenis_wisata`) VALUES
(4, 'Wisata Alam');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id_kecamatan` int(11) NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `geojson` text NOT NULL,
  `warna` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kecamatan`
--

INSERT INTO `kecamatan` (`id_kecamatan`, `kecamatan`, `geojson`, `warna`) VALUES
(15, 'Tanggunggunung', 'tanggunggunung.json', '#bb0000'),
(16, 'Besuki', 'Besuki.json', '#00ff40'),
(17, 'Kalidawir', 'Kalidawir.json', '#0080ff'),
(18, 'Pucanglaban', 'Pucanglaban.json', '#ff00ff');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kode_kriteria` varchar(10) NOT NULL,
  `nama_kriteria` varchar(50) NOT NULL,
  `prioritas` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kode_kriteria`, `nama_kriteria`, `prioritas`) VALUES
(3, 'K01', 'Atraksi Wisata', 0.60338),
(4, 'K02', 'Amenitas', 0.25799),
(5, 'K03', 'Aksebilitas', 0.13863);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria_ahp`
--

CREATE TABLE `kriteria_ahp` (
  `id` int(11) NOT NULL,
  `id_kriteria_1` int(11) NOT NULL,
  `id_kriteria_2` int(11) NOT NULL,
  `nilai_1` float NOT NULL,
  `nilai_2` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria_ahp`
--

INSERT INTO `kriteria_ahp` (`id`, `id_kriteria_1`, `id_kriteria_2`, `nilai_1`, `nilai_2`) VALUES
(223, 3, 4, 4, 0.25),
(224, 3, 5, 3, 0.33333),
(225, 4, 5, 3, 0.33333);

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `id_pengguna` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Pegawai','User') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`id_pengguna`, `nama_lengkap`, `username`, `email`, `password`, `role`) VALUES
(1, 'Administrator', 'admin', 'admin@gmail.com', '$2y$10$j.093Q1Fzo/GHTxuLqgcluPxfOebCxTQYC4GICL2JDm6UL40sbtcu', 'Admin'),
(2, 'Arifanny Sukma', 'pegawai', 'arifannyrs@gmail.com', '$2y$10$aYdvCI8G/DHMvUPYXc/pWOekKy9JkCiBtvJeffwsLjz2QtryltCE2', 'Pegawai'),
(4, 'Arifanny', 'Arifanny', 'arifanny@gmail.com', '$2y$10$xJBXoWwz9G40TWm9qHIJ1uBnw2PGsY5Vgme81KwbzU1ufHzL2TX7.', 'User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `batas_1` float NOT NULL,
  `batas_2` float NOT NULL,
  `nama` varchar(50) NOT NULL,
  `prioritas` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `batas_1`, `batas_2`, `nama`, `prioritas`) VALUES
(2, 91, 100, 'Sangat Bagus', 1),
(3, 81, 90, 'Bagus', 0.50903),
(4, 71, 80, 'Cukup', 0.33165),
(5, 61, 70, 'Kurang', 0.15278),
(6, 0, 60, 'Buruk', 0.06314);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_ahp`
--

CREATE TABLE `nilai_ahp` (
  `id` int(11) NOT NULL,
  `id_nilai_1` int(11) NOT NULL,
  `id_nilai_2` int(11) NOT NULL,
  `nilai_1` float NOT NULL,
  `nilai_2` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nilai_ahp`
--

INSERT INTO `nilai_ahp` (`id`, `id_nilai_1`, `id_nilai_2`, `nilai_1`, `nilai_2`) VALUES
(51, 2, 3, 3, 0.33333),
(52, 2, 4, 5, 0.2),
(53, 2, 5, 7, 0.14286),
(54, 2, 6, 9, 0.11111),
(55, 3, 4, 3, 0.33333),
(56, 3, 5, 5, 0.2),
(57, 3, 6, 7, 0.14286),
(58, 4, 5, 5, 0.2),
(59, 4, 6, 7, 0.14286),
(60, 5, 6, 5, 0.2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pantai`
--

CREATE TABLE `pantai` (
  `id_pantai` int(11) NOT NULL,
  `nama_pantai` varchar(50) NOT NULL,
  `alamat` text,
  `latitude` double(20,5) DEFAULT NULL,
  `longitude` double(20,5) DEFAULT NULL,
  `id_kecamatan` int(11) DEFAULT NULL,
  `foto` varchar(500) NOT NULL,
  `foto1` varchar(500) NOT NULL,
  `foto2` varchar(500) NOT NULL,
  `foto3` varchar(500) NOT NULL,
  `id_jenis` int(11) DEFAULT NULL,
  `peringkat` int(11) NOT NULL,
  `peringkat_keindahan` int(11) NOT NULL,
  `peringkat_fasilitas` int(11) NOT NULL,
  `peringkat_akses` int(11) NOT NULL,
  `fasilitas` varchar(500) NOT NULL,
  `tiket` varchar(255) NOT NULL,
  `akses` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pantai`
--

INSERT INTO `pantai` (`id_pantai`, `nama_pantai`, `alamat`, `latitude`, `longitude`, `id_kecamatan`, `foto`, `foto1`, `foto2`, `foto3`, `id_jenis`, `peringkat`, `peringkat_keindahan`, `peringkat_fasilitas`, `peringkat_akses`, `fasilitas`, `tiket`, `akses`) VALUES
(6, 'Pantai Brumbun', 'Kawasan Pegunungan , Desa Ngrejo, Kecamatan Tulungagung, Kabupaten Tulungagung, Jawa Timur ', -8.26244, 111.83522, 15, '20170812_100757.jpg', '20170812_100758.jpg', '20170812_100761.png', '20170812_100759.png', 4, 6, 6, 1, 2, 'Mushola, Gazebo, Warung Makan, Toilet, Spot Foto', '5.000', 'Mobil dan Sepeda Motor'),
(7, 'Pantai Ngalur', 'Area Pegunungan, Jengglungharjo, Tanggung Gn., Kabupaten Tulungagung, Jawa Timur 66283', -8.29732, 111.91544, 15, 'IMG_20210303_084789.jpg', 'IMG_20210303_084893.jpg', 'IMG_20210303_084983.jpeg', 'IMG20190224102901_0893.jpg', 4, 2, 2, 5, 6, 'Gazebo, Toilet, Warung', '5.000', 'Sepeda Motor Atau Jalan Kaki'),
(8, 'Pantai Sanggar', 'Area Pegunungan, Jengglungharjo, Tanggung Gn., Kabupaten Tulungagung, Jawa Timur 66283', -8.29797, 111.90996, 15, 'IMG_20210303_091456.jpg', 'IMG_20210303_094722.jpg', 'IMG_20210303_092732.jpg', 'IMG_20210303_090857.jpg', 4, 3, 3, 3, 4, 'Gazebo, Toilet, Warung', 'Gratis', 'Sepeda Motor'),
(10, 'Pantai Pacar', 'Area Perkebunan Dan P, Pucanglaban, Pucang Laban, Kabupaten Tulungagung, Jawa Timur 66284', -8.30793, 112.02460, 18, 'Pantai-Pacar-Tulungagung-730x4004.jpg', '', '', '', 4, 1, 1, 4, 5, 'Toilet dan Warung', '3000', 'Sepeda Motor'),
(12, 'Pantai Sine', 'Sine, Kalibatur, Kalidawir, Kabupaten Tulungagung, Jawa Timur 66281', -8.28062, 111.94022, 17, 'F-pantai-sine.jpg', '', '', '', 4, 5, 5, 2, 1, 'Kamar mandi, Mushola, Warung, dan Area Parkir', '10000', 'Sepeda motor dan Mobil'),
(13, 'Pantai Coro', 'Jl. Pantai Popoh, Popoh, Besole, Besuki, Kabupaten Tulungagung, Jawa Timur 66275', -8.26678, 111.81608, 16, 'Pantai-Coro-Tulung-Agung.jpg', '', '', '', 4, 4, 4, 6, 3, 'Toilet dan Warung', '5000', 'Sepeda motor dan Mobil');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pantai_kriteria`
--

CREATE TABLE `pantai_kriteria` (
  `id` int(11) NOT NULL,
  `id_pantai` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_nilai` int(11) DEFAULT NULL,
  `nilai` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pantai_kriteria`
--

INSERT INTO `pantai_kriteria` (`id`, `id_pantai`, `id_kriteria`, `id_nilai`, `nilai`) VALUES
(36, 6, 3, 5, 69),
(37, 6, 4, 3, 85),
(38, 6, 5, 4, 73),
(43, 7, 3, 2, 91),
(44, 7, 4, 5, 70),
(45, 7, 5, 6, 60),
(50, 8, 3, 3, 89),
(51, 8, 4, 4, 78),
(52, 8, 5, 5, 66),
(53, 10, 3, 2, 92),
(54, 10, 4, 4, 75),
(55, 10, 5, 5, 65),
(56, 13, 3, 3, 85),
(57, 13, 4, 5, 65),
(58, 13, 5, 5, 70),
(59, 12, 3, 4, 75),
(60, 12, 4, 4, 80),
(61, 12, 5, 4, 75);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `id_karyawan` (`id_pantai`),
  ADD KEY `id_periode` (`id_jenis`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id_kecamatan`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `kriteria_ahp`
--
ALTER TABLE `kriteria_ahp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kriteria_1` (`id_kriteria_1`),
  ADD KEY `id_kriteria_2` (`id_kriteria_2`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `nilai_ahp`
--
ALTER TABLE `nilai_ahp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_nilai_1` (`id_nilai_1`),
  ADD KEY `id_nilai_2` (`id_nilai_2`);

--
-- Indexes for table `pantai`
--
ALTER TABLE `pantai`
  ADD PRIMARY KEY (`id_pantai`),
  ADD KEY `id_bidang` (`id_kecamatan`),
  ADD KEY `id_periode` (`id_jenis`);

--
-- Indexes for table `pantai_kriteria`
--
ALTER TABLE `pantai_kriteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_karyawan` (`id_pantai`),
  ADD KEY `id_kriteria` (`id_kriteria`),
  ADD KEY `id_nilai` (`id_nilai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `id_kecamatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kriteria_ahp`
--
ALTER TABLE `kriteria_ahp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=226;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nilai_ahp`
--
ALTER TABLE `nilai_ahp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `pantai`
--
ALTER TABLE `pantai`
  MODIFY `id_pantai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pantai_kriteria`
--
ALTER TABLE `pantai_kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD CONSTRAINT `hasil_ibfk_1` FOREIGN KEY (`id_pantai`) REFERENCES `pantai` (`id_pantai`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `hasil_ibfk_2` FOREIGN KEY (`id_jenis`) REFERENCES `jenis` (`id_jenis`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `kriteria_ahp`
--
ALTER TABLE `kriteria_ahp`
  ADD CONSTRAINT `kriteria_ahp_ibfk_1` FOREIGN KEY (`id_kriteria_1`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `kriteria_ahp_ibfk_2` FOREIGN KEY (`id_kriteria_2`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `nilai_ahp`
--
ALTER TABLE `nilai_ahp`
  ADD CONSTRAINT `nilai_ahp_ibfk_1` FOREIGN KEY (`id_nilai_1`) REFERENCES `nilai` (`id_nilai`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `nilai_ahp_ibfk_2` FOREIGN KEY (`id_nilai_2`) REFERENCES `nilai` (`id_nilai`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `pantai`
--
ALTER TABLE `pantai`
  ADD CONSTRAINT `pantai_ibfk_1` FOREIGN KEY (`id_kecamatan`) REFERENCES `kecamatan` (`id_kecamatan`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `pantai_ibfk_2` FOREIGN KEY (`id_jenis`) REFERENCES `jenis` (`id_jenis`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `pantai_kriteria`
--
ALTER TABLE `pantai_kriteria`
  ADD CONSTRAINT `pantai_kriteria_ibfk_1` FOREIGN KEY (`id_pantai`) REFERENCES `pantai` (`id_pantai`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `pantai_kriteria_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `pantai_kriteria_ibfk_3` FOREIGN KEY (`id_nilai`) REFERENCES `nilai` (`id_nilai`) ON DELETE SET NULL ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
