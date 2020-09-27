-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Sep 2020 pada 10.10
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_absensi_barcode`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `acara`
--

CREATE TABLE `acara` (
  `id_acara` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `nama_acara` varchar(50) NOT NULL,
  `tanggal_mulai_acara` date NOT NULL,
  `tanggal_selesai_acara` date NOT NULL,
  `waktu_mulai_acara` time NOT NULL,
  `waktu_selesai_acara` time NOT NULL,
  `zona_waktu_acara` varchar(50) NOT NULL,
  `lokasi_acara` varchar(200) NOT NULL,
  `ketentuan_acara` varchar(200) NOT NULL,
  `deskripsi_acara` varchar(200) NOT NULL,
  `pesan_acara` varchar(200) NOT NULL,
  `foto_poster_acara` varchar(200) NOT NULL,
  `jumlah_tamu_acara` int(11) NOT NULL,
  `status_konfirmasi_acara` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `acara`
--

INSERT INTO `acara` (`id_acara`, `id_pengguna`, `nama_acara`, `tanggal_mulai_acara`, `tanggal_selesai_acara`, `waktu_mulai_acara`, `waktu_selesai_acara`, `zona_waktu_acara`, `lokasi_acara`, `ketentuan_acara`, `deskripsi_acara`, `pesan_acara`, `foto_poster_acara`, `jumlah_tamu_acara`, `status_konfirmasi_acara`) VALUES
(2, 8, 'Rapat Kepengurusan Anggota Baru REI Jateng', '2020-09-01', '2020-09-01', '23:30:00', '00:30:00', 'WIB', 'Mantap', 'Harus Disiplin', 'Oke Harus Jalan', 'Mantap Slur', '348-tentang-smp-it.jpg', 25, 'belum'),
(3, 8, 'Rapat Himforma', '2020-09-02', '2020-09-03', '22:49:00', '22:49:00', 'WIB', 'Gedung PKM Lt. 2 UPGRIS.', 'Harus datang tepat waktu.', 'Pelantikan ketua / wakil ketua pengurus yang baru.', 'Saya sangat berharap kedatangan anda sekalian.', '496-banner-bau-islam.jpg', 25, 'sudah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `info`
--

CREATE TABLE `info` (
  `id_info` int(11) NOT NULL,
  `logo_info` text NOT NULL,
  `kabar_fitur_info` text NOT NULL,
  `cara_penggunaan_info` text NOT NULL,
  `informasi_aplikasi_info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `info`
--

INSERT INTO `info` (`id_info`, `logo_info`, `kabar_fitur_info`, `cara_penggunaan_info`, `informasi_aplikasi_info`) VALUES
(1, '495-logo_transjateng.png', 'Fitur Daftar Acara<br>\r\nLihat Acara<br>\r\nAtur Akun dan Info 2.', 'Dwonload Aplikasi, kemudaian gunakan fitur sesuai kebutuahan anda 2.', 'Good Luck 2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nama_pengguna` varchar(50) NOT NULL DEFAULT '0',
  `tempat_lahir_pengguna` varchar(50) NOT NULL DEFAULT '0',
  `tanggal_lahir_pengguna` date NOT NULL,
  `alamat_pengguna` varchar(200) NOT NULL DEFAULT '0',
  `no_hp_pengguna` varchar(50) NOT NULL DEFAULT '0',
  `email_pengguna` varchar(50) NOT NULL DEFAULT '0',
  `password_pengguna` varchar(50) NOT NULL DEFAULT '0',
  `instansi_pengguna` varchar(50) NOT NULL DEFAULT '0',
  `foto_pengguna` varchar(200) NOT NULL DEFAULT '0',
  `logo_instansi_pengguna` varchar(200) NOT NULL DEFAULT '0',
  `kuota_perizinan_pengguna` int(11) NOT NULL DEFAULT '0',
  `status_fitur_chat_pengguna` varchar(20) NOT NULL DEFAULT '0',
  `status_pengguna` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nama_pengguna`, `tempat_lahir_pengguna`, `tanggal_lahir_pengguna`, `alamat_pengguna`, `no_hp_pengguna`, `email_pengguna`, `password_pengguna`, `instansi_pengguna`, `foto_pengguna`, `logo_instansi_pengguna`, `kuota_perizinan_pengguna`, `status_fitur_chat_pengguna`, `status_pengguna`) VALUES
(1, 'SuperAdmin', 'Grobogan', '1999-02-21', 'Dsn. Kenteng RT 01 / RW 09 Ds. Kenteng Kec. Toroh Kab. Grobogan', '085713728021', 'superadmin@gmail.com', '123', 'UPGRIS', '152-pendidikan.jpg', '958-banner-bau-islam.jpg', 10000, 'aktif', 'superadmin'),
(2, 'Admin', 'Grobogan', '1999-02-21', 'Dsn. Kenteng RT 01 / RW 09 Ds. Kenteng Kec. Toroh Kab. Grobogan', '098567980981', 'admin@gmail.com', '123', 'UPGRIS', '553-adit.png', '978-lcc_1.jpg', 400, 'aktif', 'admin'),
(8, 'Panitia', 'Grobogan', '2001-02-07', 'Dsn. Kenteng RT 01 / RW 07 Ds. Kenteng Kec. Toroh Kab. Grobogan', '0987651651616', 'panitia@gmail.com', '123', 'UPGRIS', '223-akademik.jpg', '551-rencana-kegiatan.png', 25, 'aktif', 'panitia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesan`
--

CREATE TABLE `pesan` (
  `id_pesan` int(11) NOT NULL,
  `id_pengirim_pesan` int(11) NOT NULL DEFAULT '0',
  `id_penerima_pesan` int(11) NOT NULL DEFAULT '0',
  `isi_pesan` text NOT NULL,
  `lingkup_pesan` varchar(50) NOT NULL DEFAULT '0',
  `waktu_pesan` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `pesan`
--

INSERT INTO `pesan` (`id_pesan`, `id_pengirim_pesan`, `id_penerima_pesan`, `isi_pesan`, `lingkup_pesan`, `waktu_pesan`) VALUES
(17, 2, 8, 'Perlu Bantuan ?', '5D8Ic', '2020-09-04 00:03:28'),
(18, 8, 2, 'Rak perlu lur, alhamdulillah aman. ', '5D8Ic', '2020-09-04 00:08:22'),
(19, 2, 8, 'oke', '5D8Ic', '2020-09-04 00:08:48'),
(20, 2, 8, 'yqyqyququuququququuququuquq', '5D8Ic', '2020-09-04 00:12:07'),
(21, 8, 2, 'Oke', '5D8Ic', '2020-09-04 00:14:34'),
(22, 2, 8, 'iya', '5D8Ic', '2020-09-04 00:14:47'),
(23, 8, 2, 'Lhos', '5D8Ic', '2020-09-04 10:52:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tamu`
--

CREATE TABLE `tamu` (
  `id_tamu` varchar(50) NOT NULL,
  `id_acara` int(11) NOT NULL,
  `nama_tamu` varchar(50) NOT NULL,
  `alamat_tamu` varchar(200) NOT NULL,
  `no_hp_tamu` varchar(50) NOT NULL,
  `email_tamu` varchar(50) NOT NULL,
  `instansi_tamu` varchar(50) NOT NULL,
  `keterangan_lain_tamu` varchar(200) NOT NULL,
  `gambar_barcode_tamu` varchar(200) NOT NULL,
  `status_kehadiran_tamu` varchar(50) NOT NULL,
  `waktu_kehadiran_tamu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tamu`
--

INSERT INTO `tamu` (`id_tamu`, `id_acara`, `nama_tamu`, `alamat_tamu`, `no_hp_tamu`, `email_tamu`, `instansi_tamu`, `keterangan_lain_tamu`, `gambar_barcode_tamu`, `status_kehadiran_tamu`, `waktu_kehadiran_tamu`) VALUES
('3-1', 3, 'Huda', 'Dsn. Kenteng RT 01 / RW 07', '085713728001', 'hudak006@gmail.com', 'USM', 'Semangat 45 ya.', '3-1.png', 'hadir', '2020-09-04 19:56:47'),
('3-2', 3, 'Khoirul Huda ', 'asda', '09199111991', 'hudak006@gmail.com', 'USM', 'aasaas', '3-2.png', 'hadir', '2020-09-05 02:04:36');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `acara`
--
ALTER TABLE `acara`
  ADD PRIMARY KEY (`id_acara`);

--
-- Indeks untuk tabel `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id_info`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indeks untuk tabel `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id_pesan`);

--
-- Indeks untuk tabel `tamu`
--
ALTER TABLE `tamu`
  ADD PRIMARY KEY (`id_tamu`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `acara`
--
ALTER TABLE `acara`
  MODIFY `id_acara` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `info`
--
ALTER TABLE `info`
  MODIFY `id_info` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id_pesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
