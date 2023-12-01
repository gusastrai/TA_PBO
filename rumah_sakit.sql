-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Des 2023 pada 09.03
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rumah_sakit`
--
CREATE DATABASE IF NOT EXISTS `rumah_sakit` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `rumah_sakit`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_obat`
--

CREATE TABLE `detail_obat` (
  `id_detail` int(11) NOT NULL,
  `id_inap` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `detail_obat`
--

INSERT INTO `detail_obat` (`id_detail`, `id_inap`, `id_obat`) VALUES
(6, 1, 996),
(7, 2, 996),
(8, 3, 997),
(9, 1, 997);

-- --------------------------------------------------------

--
-- Struktur dari tabel `inap`
--

CREATE TABLE `inap` (
  `id_inap` int(11) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `tgl_keluar` date NOT NULL,
  `lama` int(10) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `inap`
--

INSERT INTO `inap` (`id_inap`, `tgl_masuk`, `tgl_keluar`, `lama`, `id_pasien`, `id_kamar`, `status`) VALUES
(1, '2023-11-23', '2023-11-25', 2, 132, 1239, 1),
(2, '2023-11-22', '2023-11-24', 2, 133, 1240, 1),
(3, '2023-11-26', '2023-11-27', 1, 134, 1239, 1),
(4, '2023-12-03', '2023-12-13', 10, 139, 1240, 0);

--
-- Trigger `inap`
--
DELIMITER $$
CREATE TRIGGER `penambahan kapasitas kamar` AFTER DELETE ON `inap` FOR EACH ROW BEGIN
	UPDATE kamar SET kamar.kapasitas = kamar.kapasitas + 1 WHERE kamar.id_kamar = OLD.id_kamar;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `pengurangan kapasitas kamar` AFTER INSERT ON `inap` FOR EACH ROW BEGIN
	UPDATE kamar SET kamar.kapasitas = kamar.kapasitas - 1 WHERE kamar.id_kamar = NEW.id_kamar;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kamar`
--

CREATE TABLE `kamar` (
  `id_kamar` int(11) NOT NULL,
  `nama_kamar` varchar(20) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `kapasitas` int(10) NOT NULL,
  `harga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `kamar`
--

INSERT INTO `kamar` (`id_kamar`, `nama_kamar`, `kelas`, `kapasitas`, `harga`) VALUES
(1239, 'Anggrek', 'Ekonomi', 9, 200000),
(1240, 'Melati', 'VIP', 9, 300000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `id_obat` int(11) NOT NULL,
  `nama_obat` varchar(20) NOT NULL,
  `harga` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id_obat`, `nama_obat`, `harga`) VALUES
(996, 'mixagrip', 2000),
(997, 'bodrex', 3000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(11) NOT NULL,
  `nama_pasien` varchar(50) NOT NULL,
  `jk` varchar(12) NOT NULL,
  `no_telp` varchar(12) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `nama_pasien`, `jk`, `no_telp`, `alamat`, `id_user`) VALUES
(132, 'ulva dwi', 'Perempuan', '098777888987', 'malang', 11),
(133, 'siti afin', 'Perempuan', '087654345667', 'surabaya', 12),
(134, 'abc', 'Perempuan', '098', 'malang', 13),
(138, 'jonyyy', 'laki-laki', '097438157018', 'jl.munggugianti no.24', 10),
(139, 'tesa', 'laki-laki', '029473713248', 'jl mawar', 14);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_inap` int(11) NOT NULL,
  `total` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `tanggal`, `id_inap`, `total`) VALUES
(4, '2023-11-29', 2, 602000),
(5, '2023-11-21', 4, 3000000),
(8, '2023-12-06', 4, 3000000),
(9, '2023-12-02', 1, 405000);

--
-- Trigger `pembayaran`
--
DELIMITER $$
CREATE TRIGGER `bayarlunas` AFTER INSERT ON `pembayaran` FOR EACH ROW BEGIN
	UPDATE inap set inap.status = '1' where inap.id_inap = new.id_inap;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `status pembayaran` AFTER DELETE ON `pembayaran` FOR EACH ROW BEGIN
	update inap set inap.status = 0 where id_inap=old.id_inap;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `uname` varchar(20) NOT NULL,
  `upass` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`uid`, `uname`, `upass`) VALUES
(0, 'admin', 'admin123'),
(10, 'jonyyy', 'jonyyy'),
(11, 'ulvadwi', 'ulvadwi123'),
(12, 'sitiafin', 'sitiafin123'),
(13, 'abc', 'abc123'),
(14, 'tess', '123');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `view_passien`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_passien` (
`id_inap` int(11)
,`idpasien` int(11)
,`nama_pasien` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `view_pembayarankamar`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_pembayarankamar` (
`id_inap` int(11)
,`lama` int(10)
,`harga` int(10)
,`bayarkamar` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `view_pembayaranobat`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_pembayaranobat` (
`id_inap` int(11)
,`totalObat` decimal(41,0)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `view_passien`
--
DROP TABLE IF EXISTS `view_passien`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_passien`  AS SELECT `inap`.`id_inap` AS `id_inap`, `pasien`.`id_pasien` AS `idpasien`, `pasien`.`nama_pasien` AS `nama_pasien` FROM (`inap` join `pasien` on(`inap`.`id_pasien` = `pasien`.`id_pasien`))  ;

-- --------------------------------------------------------

--
-- Struktur untuk view `view_pembayarankamar`
--
DROP TABLE IF EXISTS `view_pembayarankamar`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_pembayarankamar`  AS SELECT `inap`.`id_inap` AS `id_inap`, `inap`.`lama` AS `lama`, `kamar`.`harga` AS `harga`, `inap`.`lama`* `kamar`.`harga` AS `bayarkamar` FROM (`inap` join `kamar` on(`inap`.`id_kamar` = `kamar`.`id_kamar`))  ;

-- --------------------------------------------------------

--
-- Struktur untuk view `view_pembayaranobat`
--
DROP TABLE IF EXISTS `view_pembayaranobat`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_pembayaranobat`  AS SELECT `inap`.`id_inap` AS `id_inap`, sum(`obat`.`harga`) AS `totalObat` FROM ((`inap` join `detail_obat` on(`inap`.`id_inap` = `detail_obat`.`id_inap`)) join `obat` on(`detail_obat`.`id_obat` = `obat`.`id_obat`)) GROUP BY `inap`.`id_inap``id_inap`  ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_obat`
--
ALTER TABLE `detail_obat`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_inap` (`id_inap`),
  ADD KEY `id_obat` (`id_obat`);

--
-- Indeks untuk tabel `inap`
--
ALTER TABLE `inap`
  ADD PRIMARY KEY (`id_inap`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_kamar` (`id_kamar`);

--
-- Indeks untuk tabel `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id_kamar`);

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id_obat`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_inap` (`id_inap`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_obat`
--
ALTER TABLE `detail_obat`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `inap`
--
ALTER TABLE `inap`
  MODIFY `id_inap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1244;

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=999;

--
-- AUTO_INCREMENT untuk tabel `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_obat`
--
ALTER TABLE `detail_obat`
  ADD CONSTRAINT `FK_detail_obat_inap` FOREIGN KEY (`id_inap`) REFERENCES `inap` (`id_inap`),
  ADD CONSTRAINT `FK_detail_obat_obat` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id_obat`);

--
-- Ketidakleluasaan untuk tabel `inap`
--
ALTER TABLE `inap`
  ADD CONSTRAINT `FK_inap_kamar` FOREIGN KEY (`id_kamar`) REFERENCES `kamar` (`id_kamar`),
  ADD CONSTRAINT `FK_inap_pasien` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`);

--
-- Ketidakleluasaan untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD CONSTRAINT `FK_iduser` FOREIGN KEY (`id_user`) REFERENCES `users` (`uid`);

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `FK_pembayaran_inap` FOREIGN KEY (`id_inap`) REFERENCES `inap` (`id_inap`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
