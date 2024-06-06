-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Jun 2024 pada 09.58
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siakus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detailpenerimaan`
--

CREATE TABLE `detailpenerimaan` (
  `pnm_kd` varchar(12) NOT NULL,
  `sw_kd` varchar(8) NOT NULL,
  `kl_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detailpenerimaan`
--

INSERT INTO `detailpenerimaan` (`pnm_kd`, `sw_kd`, `kl_id`) VALUES
('PNM202400002', '20240001', 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_penerimaan`
--

CREATE TABLE `kategori_penerimaan` (
  `kpn_id` int(11) NOT NULL,
  `kpn_nama` varchar(50) NOT NULL,
  `kpn_nominal` int(11) NOT NULL,
  `kpn_ket` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori_penerimaan`
--

INSERT INTO `kategori_penerimaan` (`kpn_id`, `kpn_nama`, `kpn_nominal`, `kpn_ket`) VALUES
(31, 'SP24 - JANUARI', 80000, 'SPP JANUARI 2024'),
(32, 'SP24 - FEBRUARI', 75000, 'SPP  2024 FEBRUARI');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_pengeluaran`
--

CREATE TABLE `kategori_pengeluaran` (
  `kpr_id` int(11) NOT NULL,
  `kpr_nama` varchar(50) NOT NULL,
  `kpr_ket` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori_pengeluaran`
--

INSERT INTO `kategori_pengeluaran` (`kpr_id`, `kpr_nama`, `kpr_ket`) VALUES
(1, 'SARPRAS', 'Bagian Sarana dan Prasarana'),
(2, 'KURIKULUM', 'Bagian Waka Kurikulum'),
(3, 'KESISWAAN', 'Bagian Waka Kesiswaan'),
(4, 'BK / HUMAS', 'Bagian Humas'),
(5, 'PERPUSTAKAAN', 'Bagian Bidang Perpustakaan'),
(6, 'KEBERSIHAN', 'Bagian Bidang Kebersihan'),
(7, 'KEPRAMUKAAN', 'Anggaran Bagian Kepramukaan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `kl_id` int(11) NOT NULL,
  `kl_nama` varchar(50) NOT NULL,
  `kl_ket` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`kl_id`, `kl_nama`, `kl_ket`) VALUES
(9, 'X IPA 1', '-'),
(10, 'X IPA 2', '-'),
(11, 'X IPA 3', '-'),
(12, 'X IPA 4', '-'),
(13, 'X IPA 5', '-'),
(14, 'X IPS 1', '-'),
(15, 'X IPS 2', '-'),
(16, 'X IPS 3', '-'),
(17, 'X IPS 4', '-'),
(18, 'AL LYN', 's'),
(19, 'arsip', 'arsip');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penerimaan`
--

CREATE TABLE `penerimaan` (
  `pnm_kd` varchar(12) NOT NULL,
  `pnm_nama` varchar(50) NOT NULL,
  `pnm_tanggal` date NOT NULL,
  `pnm_ket` text NOT NULL,
  `pnm_nominal` int(11) NOT NULL,
  `pnm_jenis` varchar(15) NOT NULL,
  `kpn_id` int(11) DEFAULT NULL,
  `pg_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penerimaan`
--

INSERT INTO `penerimaan` (`pnm_kd`, `pnm_nama`, `pnm_tanggal`, `pnm_ket`, `pnm_nominal`, `pnm_jenis`, `kpn_id`, `pg_id`) VALUES
('PNM202400001', 'KEMENDIKBUD', '2024-05-01', 'DAN BOS BULAN MEI 2024', 25000000, 'Bantuan', NULL, 1),
('PNM202400002', 'Rizki Maulana', '2024-06-03', 'SP24 - FEBRUARI', 75000, 'Pembayaran', 32, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan`
--

CREATE TABLE `pengajuan` (
  `pgj_kd` varchar(10) NOT NULL,
  `pgj_nama` varchar(50) NOT NULL,
  `pgj_tanggal` date NOT NULL,
  `pgj_nominal` int(11) NOT NULL,
  `pgj_ket` varchar(200) NOT NULL,
  `pgj_pj` varchar(200) NOT NULL,
  `pgj_file` varchar(200) DEFAULT NULL,
  `pgj_status` varchar(15) NOT NULL,
  `kpr_id` int(11) NOT NULL,
  `pg_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengajuan`
--

INSERT INTO `pengajuan` (`pgj_kd`, `pgj_nama`, `pgj_tanggal`, `pgj_nominal`, `pgj_ket`, `pgj_pj`, `pgj_file`, `pgj_status`, `kpr_id`, `pg_id`) VALUES
('PGJ2024001', 'PENGADAAN KIPAS ANGIN', '2024-06-04', 450000, 'Kipas Angin di kelas X IPS 2 Sudah Rusak', 'Rohman, S.Pd.', 'PGJ2024001.pdf', '4', 1, 10),
('PGJ2024002', 'KEMAH PRADIKCAM MA YAFALAH 2024', '2024-06-04', 2000000, 'Kemah bakti diadakan setiap awal tahun pembelajaran baru, sebagai menyambut anggota ambalan pramuka baru di MA YAFALAH selama satu hari satu malam', 'Siti Aliyah, S.Pd.', 'PGJ2024002.pdf', '4', 7, 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `pgr_kd` varchar(10) NOT NULL,
  `pgr_tanggal` date NOT NULL,
  `pgr_ket` varchar(200) NOT NULL,
  `pgr_nominal` int(11) NOT NULL,
  `pgj_kd` varchar(10) NOT NULL,
  `pg_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengeluaran`
--

INSERT INTO `pengeluaran` (`pgr_kd`, `pgr_tanggal`, `pgr_ket`, `pgr_nominal`, `pgj_kd`, `pg_id`) VALUES
('PGR2024001', '2024-06-05', 'PENGADAAN KIPAS ANGIN', 450000, 'PGJ2024001', 1),
('PGR2024002', '2024-06-04', 'KEMAH PRADIKCAM MA YAFALAH 2024', 2000000, 'PGJ2024002', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `pg_id` int(11) NOT NULL,
  `pg_nama` varchar(50) NOT NULL,
  `pg_kontak` varchar(100) NOT NULL,
  `pg_pj` varchar(50) NOT NULL,
  `pg_level` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL,
  `pg_status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`pg_id`, `pg_nama`, `pg_kontak`, `pg_pj`, `pg_level`, `username`, `password`, `pg_status`) VALUES
(1, 'Admin', 'ulinnuhaulin48@gmail.com', 'Budi Santoso, S.Pd.', 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', '1'),
(8, 'Keuangan 1', 'budisantoso@gmail.com', 'NamaPenanggungjawab', 'Kepala Sekolah', 'budisan', '25d55ad283aa400af464c76d713c07ad', '1'),
(9, 'Keuangan 2', 'rahmaanisa123@gmail.com', 'NamaPenanggungjawab', 'Keuangan', 'rahmanisa', '25d55ad283aa400af464c76d713c07ad', '1'),
(10, 'Waka Sarana Prasarana', 'sarprasyafalah@gmail.com', 'Rohman, S.Pd.', 'Pengaju', 'sarpras', '25d55ad283aa400af464c76d713c07ad', '1'),
(11, 'Pramuka Yafalah', 'ambalanyafalah@gmail.com', 'Siti Aliyah, S.Pd.', 'Pengaju', 'pramuka', '25d55ad283aa400af464c76d713c07ad', '1'),
(12, 'Osis Yafalah', 'osisiyafalah@gmail.com', 'Nur Aini, S.Pd.', 'WAKA KURIKULUM', 'osis', '21232f297a57a5a743894a0e4a801fc3', '1'),
(13, 'ulinnuha ulin', 'ulinnuhaulin48@gmail.com', 'NamaPenanggungjawab', 'Pengaju', 'ulinnuha', '722a49f019c1a77157417223521ee845', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `sw_kd` varchar(8) NOT NULL,
  `sw_nama` varchar(50) NOT NULL,
  `sw_jk` varchar(9) NOT NULL,
  `sw_alamat` varchar(200) NOT NULL,
  `sw_kontak` varchar(15) NOT NULL,
  `kl_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`sw_kd`, `sw_nama`, `sw_jk`, `sw_alamat`, `sw_kontak`, `kl_id`) VALUES
('20240001', 'Rizki Maulana', 'Laki-laki', 'Kembang Gading RT.01/RW.04 Ginggangtani, Kec. Gubug, Kabupaten Grobogan, Jawa Tengah 58164', '08129362728', 9),
('20240002', 'Dian Puspita', 'Perempuan', 'Ploso, Kec. Gubug, Kabupaten Grobogan, Jawa Tengah 58164', '08214567890', 9),
('20240003', 'Ahmad Rifai', 'Laki-laki', 'Sidomulyo, Kec. Gubug, Kabupaten Grobogan, Jawa Tengah 58164', '08571234567', 13),
('20240004', 'Siti Aisyah', 'Perempuan', 'Sumberan, Kec. Gubug, Kabupaten Grobogan, Jawa Tengah 58164', '08123456789', 9),
('20240005', 'M. Iqbal', 'Laki-laki', 'Karanganyar, Kec. Gubug, Kabupaten Grobogan, Jawa Tengah 58164', '08567891234', 10),
('20240006', 'Novi Indriani', 'Perempuan', 'Kedungbener, Kec. Gubug, Kabupaten Grobogan, Jawa Tengah 58164', '08135467890', 9),
('20240007', 'Bayu Nugroho', 'Laki-laki', 'Ngemplak, Kec. Gubug, Kabupaten Grobogan, Jawa Tengah 58164', '08236789012', 11),
('20240008', 'Dewi Lestari', 'Perempuan', 'Wangunan, Kec. Gubug, Kabupaten Grobogan, Jawa Tengah 58164', '08567890123', 9),
('20240009', 'Firman Jaya', 'Laki-laki', 'Plaosan, Kec. Gubug, Kabupaten Grobogan, Jawa Tengah 58164', '08147890123', 14),
('20240010', 'Fitri Nurhayati', 'Perempuan', 'Pucanganom, Kec. Gubug, Kabupaten Grobogan, Jawa Tengah 58164', '08158901234', 9),
('20240011', 'Surya Pratama', 'Laki-laki', 'Sendangharjo, Kec. Gubug, Kabupaten Grobogan, Jawa Tengah 58164', '08269012345', 9),
('20240012', 'Rina Wulandari', 'Perempuan', 'Mergojoyo, Kec. Gubug, Kabupaten Grobogan, Jawa Tengah 58164', '08123456789', 14),
('20240013', 'Hadi Siswanto', 'Laki-laki', 'Brangkal, Kec. Gubug, Kabupaten Grobogan, Jawa Tengah 58164', '08234567890', 14),
('20240014', 'Siti Mulyani', 'Perempuan', 'Lorog, Kec. Gubug, Kabupaten Grobogan, Jawa Tengah 58164', '08345678901', 14),
('20240015', 'Aditya Saputra', 'Laki-laki', 'Klampok, Kec. Gubug, Kabupaten Grobogan, Jawa Tengah 58164', '08556789012', 14),
('20240016', 'Sri Rahayu', 'Perempuan', 'Sugihan, Kec. Gubug, Kabupaten Grobogan, Jawa Tengah 58164', '08267890123', 14),
('20240017', 'Ridwan Saputro', 'Laki-laki', 'Sudimoro, Kec. Gubug, Kabupaten Grobogan, Jawa Tengah 58164', '08178901234', 15),
('20240018', 'Dewi Kusumawati', 'Perempuan', 'Tlogosari, Kec. Gubug, Kabupaten Grobogan, Jawa Tengah 58164', '08289012345', 15),
('20240019', 'Arief Wibowo', 'Laki-laki', 'Gedangan, Kec. Gubug, Kabupaten Grobogan, Jawa Tengah 58164', '08590123456', 15),
('20240020', 'Anisa Fitriani', 'Perempuan', 'Tunjungrejo, Kec. Gubug, Kabupaten Grobogan, Jawa Tengah 58164', '08101234567', 15),
('20240021', 'Agus Setiawan', 'Laki-laki', 'Kedungtukang, Kec. Gubug, Kabupaten Grobogan, Jawa Tengah 58164', '08212345678', 15),
('20240022', 'Aulia Ummu Fatimah Az Zahra', 'Perempuan', 'Dusun Peresen Kelurahan Krangkeng Kec Kedung Jati', '0819281928921', 15);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detailpenerimaan`
--
ALTER TABLE `detailpenerimaan`
  ADD KEY `sw_kd` (`sw_kd`),
  ADD KEY `pnm_kd` (`pnm_kd`),
  ADD KEY `kl_id` (`kl_id`);

--
-- Indeks untuk tabel `kategori_penerimaan`
--
ALTER TABLE `kategori_penerimaan`
  ADD PRIMARY KEY (`kpn_id`);

--
-- Indeks untuk tabel `kategori_pengeluaran`
--
ALTER TABLE `kategori_pengeluaran`
  ADD PRIMARY KEY (`kpr_id`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`kl_id`);

--
-- Indeks untuk tabel `penerimaan`
--
ALTER TABLE `penerimaan`
  ADD PRIMARY KEY (`pnm_kd`),
  ADD KEY `pg_id` (`pg_id`),
  ADD KEY `kpn_id` (`kpn_id`);

--
-- Indeks untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`pgj_kd`),
  ADD KEY `pg_id` (`pg_id`),
  ADD KEY `kpr_id` (`kpr_id`);

--
-- Indeks untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`pgr_kd`),
  ADD UNIQUE KEY `pgj_kd_2` (`pgj_kd`),
  ADD KEY `pg_id` (`pg_id`),
  ADD KEY `pgj_kd` (`pgj_kd`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`pg_id`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`sw_kd`),
  ADD KEY `kl_id` (`kl_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kategori_penerimaan`
--
ALTER TABLE `kategori_penerimaan`
  MODIFY `kpn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `kategori_pengeluaran`
--
ALTER TABLE `kategori_pengeluaran`
  MODIFY `kpr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `kl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `pg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detailpenerimaan`
--
ALTER TABLE `detailpenerimaan`
  ADD CONSTRAINT `detailpenerimaan_ibfk_1` FOREIGN KEY (`sw_kd`) REFERENCES `siswa` (`sw_kd`),
  ADD CONSTRAINT `detailpenerimaan_ibfk_2` FOREIGN KEY (`kl_id`) REFERENCES `kelas` (`kl_id`),
  ADD CONSTRAINT `detailpenerimaan_ibfk_3` FOREIGN KEY (`pnm_kd`) REFERENCES `penerimaan` (`pnm_kd`);

--
-- Ketidakleluasaan untuk tabel `penerimaan`
--
ALTER TABLE `penerimaan`
  ADD CONSTRAINT `penerimaan_ibfk_1` FOREIGN KEY (`pg_id`) REFERENCES `pengguna` (`pg_id`),
  ADD CONSTRAINT `penerimaan_ibfk_2` FOREIGN KEY (`pg_id`) REFERENCES `pengguna` (`pg_id`),
  ADD CONSTRAINT `penerimaan_ibfk_4` FOREIGN KEY (`kpn_id`) REFERENCES `kategori_penerimaan` (`kpn_id`);

--
-- Ketidakleluasaan untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD CONSTRAINT `pengajuan_ibfk_1` FOREIGN KEY (`pg_id`) REFERENCES `pengguna` (`pg_id`),
  ADD CONSTRAINT `pengajuan_ibfk_2` FOREIGN KEY (`kpr_id`) REFERENCES `kategori_pengeluaran` (`kpr_id`);

--
-- Ketidakleluasaan untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD CONSTRAINT `pengeluaran_ibfk_1` FOREIGN KEY (`pg_id`) REFERENCES `pengguna` (`pg_id`),
  ADD CONSTRAINT `pengeluaran_ibfk_2` FOREIGN KEY (`pgj_kd`) REFERENCES `pengajuan` (`pgj_kd`);

--
-- Ketidakleluasaan untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`kl_id`) REFERENCES `kelas` (`kl_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
