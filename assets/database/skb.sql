-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Mar 2021 pada 03.24
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `skb_akun`
--

CREATE TABLE `skb_akun` (
  `akun_id` int(11) NOT NULL,
  `akun_name` varchar(25) NOT NULL,
  `akun_role` varchar(25) NOT NULL,
  `akun_akses` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `skb_akun`
--

INSERT INTO `skb_akun` (`akun_id`, `akun_name`, `akun_role`, `akun_akses`) VALUES
(14, 'Rizki Bhaskara aa', 'Super User', '[\"1\",\"1\",\"1\",\"1\",\"1\"]'),
(17, 'aldi indrawan aja', 'Operator', '[\"0\",\"0\",\"1\",\"1\",\"0\"]'),
(19, 'shanti', 'Operator', '[\"1\",\"0\",\"0\",\"0\",\"0\"]');

-- --------------------------------------------------------

--
-- Struktur dari tabel `skb_bon`
--

CREATE TABLE `skb_bon` (
  `bon_id` int(11) NOT NULL,
  `bon_nominal` int(11) NOT NULL,
  `bon_jenis` varchar(25) NOT NULL,
  `bon_tanggal` datetime NOT NULL,
  `bon_keterangan` text NOT NULL,
  `supir_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `skb_bon`
--

INSERT INTO `skb_bon` (`bon_id`, `bon_nominal`, `bon_jenis`, `bon_tanggal`, `bon_keterangan`, `supir_id`) VALUES
(1, 3600000, 'Pembayaran', '2021-03-11 02:42:06', 'lunas', 5),
(2, 500000, 'Pengajuan', '2021-03-11 19:38:18', 'minjem untuk jalan-jalan', 5),
(3, 1000000, 'Pengajuan', '2021-03-17 18:10:39', 'biaya bensin', 14),
(4, 1000000, 'Pembayaran', '2021-03-17 18:12:30', 'pelunasan', 14),
(5, 2000000, 'Pembatalan JO', '2021-03-22 23:23:05', 'Pembatalan JO', 14),
(6, 1500000, 'Pembatalan JO', '2021-03-22 23:23:28', 'Pembatalan JO', 5),
(7, 3000000, 'Pembatalan JO', '2021-03-22 23:26:31', 'Pembatalan JO', 15),
(8, 2000000, 'Pembatalan JO', '2021-03-22 23:31:01', 'Pembatalan JO', 14),
(9, 3000000, 'Pembatalan JO', '2021-03-22 23:31:48', 'Pembatalan JO', 15),
(10, 1500000, 'Pembatalan JO', '2021-03-22 23:32:03', 'Pembatalan JO', 5),
(11, 1800000, 'Pembayaran', '2021-03-23 00:01:59', 'lunas cuy', 5),
(12, 100000, 'Pengajuan', '2021-03-23 00:03:41', 'minjem', 5),
(13, 100000, 'Pengajuan', '2021-03-23 00:03:50', 'minjem', 5),
(14, 100000, 'Pengajuan', '2021-03-23 00:03:55', 'minjem', 5),
(15, 100000, 'Pengajuan', '2021-03-23 00:04:05', 'minjem', 5),
(16, 100000, 'Pengajuan', '2021-03-23 00:04:14', 'minjem', 5),
(17, 100000, 'Pengajuan', '2021-03-23 00:04:45', 'minjem', 5),
(18, 600000, 'Pembayaran', '2021-03-23 00:05:00', 'kunas', 5),
(19, 300000, 'Pembayaran', '2021-03-23 00:05:50', 'ok', 14),
(20, 2500000, 'Pembatalan JO', '2021-03-27 09:10:10', 'Pembatalan JO', 14),
(21, 2500000, 'Pembatalan JO', '2021-03-27 09:10:34', 'Pembatalan JO', 14),
(22, 1500000, 'Pembatalan JO', '2021-03-27 09:21:48', 'Pembatalan JO', 5),
(23, 3000000, 'Pembatalan JO', '2021-03-27 09:24:00', 'Pembatalan JO', 20);

-- --------------------------------------------------------

--
-- Struktur dari tabel `skb_customer`
--

CREATE TABLE `skb_customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_alamat` text NOT NULL,
  `customer_kontak_person` varchar(50) NOT NULL,
  `customer_telp` varchar(20) NOT NULL,
  `customer_keterangan` text NOT NULL,
  `customer_bank` varchar(25) NOT NULL,
  `customer_rekening` varchar(50) NOT NULL,
  `customer_AN` varchar(50) NOT NULL,
  `status_hapus` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `skb_customer`
--

INSERT INTO `skb_customer` (`customer_id`, `customer_name`, `customer_alamat`, `customer_kontak_person`, `customer_telp`, `customer_keterangan`, `customer_bank`, `customer_rekening`, `customer_AN`, `status_hapus`) VALUES
(1, 'PT.Gula ku', '', '', '', '', '', '0', '', 'No'),
(2, 'PT.Gink', '', '', '', '', '', '0', '', 'No'),
(3, 'PT.Gudang Garam', '', '', '', '', '', '0', '', 'No'),
(4, 'PT.AISPS', '', '', '', '', '', '0', '', 'No'),
(5, 'PT.Philip LPG', '', '', '', '', '', '0', '', 'No'),
(6, 'PT.Jaya Bakery', '', '', '', '', '', '0', '', 'No'),
(7, 'PT.Rumah Kayu', '', '', '', '', '', '0', '', 'No'),
(8, 'PT.SMANLA', '', '', '', '', '', '0', '', 'No'),
(9, 'Toko Adel', '', '', '', '', '', '0', '', 'No'),
(10, 'Wood Steirs', '', '', '', '', '', '0', '', 'No'),
(11, 'Toko Buku Dioni', '', '', '', '', '', '0', '', 'No'),
(12, 'Grosir Iyuz', 'jalan pulau damar ', 'iyuz', '089562372136', 'gorsiran', 'BRI', '2147483647', 'Iyuz SUjana', 'YES'),
(14, 'PT Maju Terang', '', '', '', '', '', '0', '', 'YES'),
(21, 'Mutia Kece', 'Metro Pusat', 'Mutia', '0895232323', 'dari metro', 'BRI', '123456789', 'Mutia Nazila', 'YES'),
(23, 'pt taman indah', 'jalan pulau damar', 'aldi ', '0895620408193', 'bidang taman', 'bri', '2147483647', 'aldi indrawan', 'No'),
(24, 'aldi', 'lampung', 'aldi indrawan', '009709-09008', 'mantap', 'bri', '0', 'aldi', 'No'),
(25, 'galih', 'bandar jaya', 'galih', '0980798080', 'baru', 'bri', '98798', 'galih', 'No'),
(26, 'metro gmbi', 'metro pusat', 'andre', '1234124', 'ok', 'bri', '123123', 'andreanto', 'No');

-- --------------------------------------------------------

--
-- Struktur dari tabel `skb_invoice`
--

CREATE TABLE `skb_invoice` (
  `invoice_kode` varchar(50) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `tanggal_invoice` date NOT NULL,
  `batas_pembayaran` varchar(25) NOT NULL,
  `grand_total` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `ppn` int(11) NOT NULL,
  `status_bayar` varchar(25) NOT NULL,
  `total_tonase` int(11) NOT NULL,
  `invoice_keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `skb_invoice`
--

INSERT INTO `skb_invoice` (`invoice_kode`, `customer_id`, `tanggal_invoice`, `batas_pembayaran`, `grand_total`, `total`, `ppn`, `status_bayar`, `total_tonase`, `invoice_keterangan`) VALUES
('123-PT.Gudang Garam-02-2021', 3, '2021-03-26', '14', 100000, 100000, 0, 'Belum Lunas', 10, 'rokok'),
('123-PT.Gula ku-02-2021', 1, '2021-03-26', '14', 110000, 100000, 10000, 'Lunas', 10, 'mesin giling'),
('222-PT.Gula ku-02-2021', 1, '2021-03-26', '14', 660000, 600000, 60000, 'Belum Lunas', 60, 'gula (lampung-medan)'),
('333-PT.Gula ku-02-2021', 1, '2021-03-26', '14', 385000, 350000, 35000, 'Belum Lunas', 35, 'gula dan tebu dari lampung ke palembang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `skb_job_order`
--

CREATE TABLE `skb_job_order` (
  `Jo_id` int(11) NOT NULL,
  `invoice_id` varchar(50) NOT NULL,
  `mobil_no` varchar(20) NOT NULL,
  `supir_id` int(11) NOT NULL,
  `muatan` varchar(50) NOT NULL,
  `asal` varchar(50) NOT NULL,
  `tujuan` varchar(50) NOT NULL,
  `uang_jalan` int(11) NOT NULL,
  `terbilang` text NOT NULL,
  `tanggal_surat` date NOT NULL,
  `tanggal_bongkar` date NOT NULL,
  `tonase` int(11) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `upah` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `status` varchar(25) NOT NULL,
  `bonus` int(11) NOT NULL,
  `status_upah` varchar(25) NOT NULL,
  `harga` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `skb_job_order`
--

INSERT INTO `skb_job_order` (`Jo_id`, `invoice_id`, `mobil_no`, `supir_id`, `muatan`, `asal`, `tujuan`, `uang_jalan`, `terbilang`, `tanggal_surat`, `tanggal_bongkar`, `tonase`, `keterangan`, `upah`, `customer_id`, `status`, `bonus`, `status_upah`, `harga`) VALUES
(1, '', 'BE 1510 YY', 5, 'gula', 'gudang lampung', 'gudang bekasi', 1500000, ' Satu Juta Lima Ratus  Ribu  Rupiah', '2021-03-19', '2021-03-22', 10, '<strong>Catatan JO : </strong>hatihati<br><strong>Catatan Konfirmasi : </strong>oke\r\n', 750000, 1, 'Sampai Tujuan', 100000, 'Sudah Dibayar', '10000'),
(2, '333-PT.Gula ku-02-2021', 'BE 2213 AA', 14, 'gula', 'gudang lampung', 'gudang palembang', 1500000, ' Satu Juta Lima Ratus  Ribu  Rupiah', '2021-03-19', '2021-03-22', 10, '<strong>Catatan JO : </strong>oke<br><strong>Catatan Konfirmasi : </strong>ok', 500000, 1, 'Sampai Tujuan', 250000, 'Belum Dibayar', '10000'),
(3, '123-PT.Gula ku-02-2021', 'BE 3422 YI', 15, 'mesin giling', 'gudang bandung', 'gudang jakarta', 1000000, ' Satu Juta  Rupiah', '2021-03-19', '2021-03-19', 10, '<strong>Catatan JO : </strong>weqwe<br><strong>Catatan Konfirmasi : </strong>mantap', 500, 1, 'Sampai Tujuan', 50000, 'Sudah Dibayar', '10000'),
(4, '123-PT.Gudang Garam-02-2021', 'BE 5530 PQ', 15, 'rokok', 'gudang jakarta', 'gudang palembang', 2500000, ' Dua Juta Lima Ratus  Ribu  Rupiah', '2021-03-19', '2021-03-19', 10, '<strong>Catatan JO : </strong>segera<br><strong>Catatan Konfirmasi : </strong>mantap', 1500000, 3, 'Sampai Tujuan', 150000, 'Sudah Dibayar', '10000'),
(5, '', 'BE 4321 YI', 15, 'gula', 'gudang bandung', 'gudang lampung', 2500000, ' Dua Juta Lima Ratus  Ribu  Rupiah', '2021-03-19', '2021-03-19', 10, '<strong>Catatan JO : </strong>hati hati bray<br><strong>Catatan Konfirmasi : </strong>mantap', 1500000, 1, 'Sampai Tujuan', 250000, 'Sudah Dibayar', '10000'),
(6, '222-PT.Gula ku-02-2021', 'BE 3422 YI', 15, 'gula', 'gudang lampung', 'gudang medan', 3000000, ' Tiga Juta  Rupiah', '2021-03-22', '2021-03-22', 10, '<strong>Catatan JO : </strong>asd<br><strong>Catatan Konfirmasi : </strong>oke', 0, 1, 'Sampai Tujuan', 250000, 'Belum Dibayar', '10000'),
(7, '222-PT.Gula ku-02-2021', 'BE 1211 AI', 5, 'gula', 'gudang lampung', 'gudang medan', 3500000, ' Tiga Juta Lima Ratus  Ribu  Rupiah', '2021-03-22', '2021-03-22', 10, '<strong>Catatan JO : </strong>hati hati<br><strong>Catatan Konfirmasi : </strong>ok', 2000000, 1, 'Sampai Tujuan', 100000, 'Sudah Dibayar', '10000'),
(8, '222-PT.Gula ku-02-2021', 'BE 2213 AA', 5, 'gula', 'gudang lampung', 'gudang medan', 3000000, ' Tiga Juta  Rupiah', '2021-03-22', '2021-03-22', 25, '<strong>Catatan JO : </strong>hati hati<br><strong>Catatan Konfirmasi : </strong>ok', 1000000, 1, 'Sampai Tujuan', 200000, 'Sudah Dibayar', '10000'),
(9, '222-PT.Gula ku-02-2021', 'BE 3422 YI', 14, 'gula', 'gudang lampung', 'gudang medan', 3000000, ' Tiga Juta  Rupiah', '2021-03-22', '2021-03-22', 15, '<strong>Catatan JO : </strong>jauh ni kemedan<br><strong>Catatan Konfirmasi : </strong>ok', 1500000, 1, 'Sampai Tujuan', 250000, 'Belum Dibayar', '10000'),
(10, '333-PT.Gula ku-02-2021', 'BE 1510 YY', 14, 'tebu', 'gudang lampung', 'gudang palembang', 1500000, ' Satu Juta Lima Ratus  Ribu  Rupiah', '2021-03-22', '2021-03-22', 25, '<strong>Catatan JO : </strong><br><strong>Catatan Konfirmasi : </strong>mantap', 500000, 1, 'Sampai Tujuan', 250000, 'Belum Dibayar', '10000'),
(11, '', 'BE 4321 YI', 5, 'gula', 'gudang lampung', 'gudang medan', 3500000, ' Tiga Juta Lima Ratus  Ribu  Rupiah', '2021-03-22', '0000-00-00', 0, 'mantap,hati hati ya', 2000000, 1, 'Dibatalkan', 0, 'Sudah Dibayar', '10000'),
(12, '', 'BE 2213 AA', 14, 'rokok', 'gudang jakarta', 'gudang palembang', 2000000, ' Dua Juta  Rupiah', '2021-03-22', '0000-00-00', 0, 'ok', 1000000, 3, 'Dibatalkan', 0, 'Belum Dibayar', '10000'),
(13, '', 'BE 1510 YY', 15, 'gula', 'gudang lampung', 'gudang medan', 3000000, ' Tiga Juta  Rupiah', '2021-03-22', '0000-00-00', 0, 'ok', 1500000, 1, 'Dibatalkan', 0, 'Sudah Dibayar', '10000'),
(14, '', 'BE 3322 AS', 5, 'mesin giling', 'gudang bandung', 'gudang jakarta', 1500000, ' Satu Juta Lima Ratus  Ribu  Rupiah', '2021-03-22', '0000-00-00', 0, 'ok', 750000, 1, 'Dibatalkan', 0, 'Sudah Dibayar', '10000'),
(15, '', 'BE 1510 YY', 5, 'gula', 'gudang lampung', 'gudang medan', 3000000, ' Tiga Juta  Rupiah', '2021-03-26', '2021-03-26', 10, '<strong>Catatan JO : </strong>hati-hati<br><strong>Catatan Konfirmasi : </strong>mantap', 1500000, 1, 'Sampai Tujuan', 250000, 'Belum Dibayar', '10000'),
(16, '', 'BE 1510 YY', 5, 'mesin giling', 'gudang bandung', 'gudang jakarta', 1000000, ' Satu Juta  Rupiah', '2021-03-27', '2021-03-27', 10, '<strong>Catatan JO : </strong>ok<br><strong>Catatan Konfirmasi : </strong>250k ganti ban', 500000, 1, 'Sampai Tujuan', 250000, 'Belum Dibayar', '150000'),
(17, '', 'BE 3322 AS', 14, 'rokok', 'gudang jakarta', 'gudang palembang', 2500000, ' Dua Juta Lima Ratus  Ribu  Rupiah', '2021-03-27', '2021-03-27', 0, '<strong>Catatan JO : </strong><strong>Catatan JO : </strong><strong>Catatan JO : </strong>ambil rokok<br><strong>Catatan Konfirmasi : </strong><br><strong>Catatan Konfirmasi : </strong><br><strong>Catatan Konfirmasi : </strong>', 1500000, 3, 'Dibatalkan', 0, 'Belum Dibayar', ''),
(18, '', 'BE 1211 AI', 15, 'gula', 'gudang lampung', 'gudang medan', 3500000, ' Tiga Juta Lima Ratus  Ribu  Rupiah', '2021-03-27', '2021-03-27', 15, '<strong>Catatan JO : </strong>jauh ini<br><strong>Catatan Konfirmasi : </strong>laper', 2000000, 1, 'Sampai Tujuan', 100000, 'Belum Dibayar', '150000'),
(19, '', 'BE 1510 YY', 5, 'tebu', 'gudang lampung', 'gudang palembang', 1500000, ' Satu Juta Lima Ratus  Ribu  Rupiah', '2021-03-27', '0000-00-00', 0, 'ok', 500000, 1, 'Dibatalkan', 0, 'Belum Dibayar', ''),
(20, '', 'be 1234 aa', 14, 'rokok', 'gudang jakarta', 'gudang lampung', 2000000, ' Dua Juta  Rupiah', '2021-03-27', '2021-03-27', 10, '<strong>Catatan JO : </strong><br><strong>Catatan Konfirmasi : </strong>mantap', 1000000, 3, 'Sampai Tujuan', 0, 'Belum Dibayar', '100000'),
(21, '', 'BE 2213 AA', 20, 'gula', 'gudang lampung', 'gudang medan', 3000000, ' Tiga Juta  Rupiah', '2021-03-27', '0000-00-00', 0, '', 1000000, 1, 'Dibatalkan', 0, 'Belum Dibayar', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `skb_mobil`
--

CREATE TABLE `skb_mobil` (
  `mobil_no` varchar(10) NOT NULL,
  `mobil_jenis` varchar(50) NOT NULL,
  `mobil_max_load` int(11) NOT NULL,
  `status_jalan` varchar(25) NOT NULL,
  `status_hapus` varchar(15) NOT NULL,
  `mobil_keterangan` varchar(255) NOT NULL,
  `mobil_merk` varchar(20) NOT NULL,
  `mobil_type` varchar(20) NOT NULL,
  `mobil_dump` varchar(20) NOT NULL,
  `mobil_tahun` int(4) NOT NULL,
  `mobil_berlaku` date DEFAULT NULL,
  `mobil_pajak` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `skb_mobil`
--

INSERT INTO `skb_mobil` (`mobil_no`, `mobil_jenis`, `mobil_max_load`, `status_jalan`, `status_hapus`, `mobil_keterangan`, `mobil_merk`, `mobil_type`, `mobil_dump`, `mobil_tahun`, `mobil_berlaku`, `mobil_pajak`) VALUES
('BE 1211 AI', 'Besar(Tronton)', 10, 'Tidak Jalan', 'YES', 'mana ni mobil', 'SAN', '123SAN', 'Tidak', 2015, '2021-03-31', '2023-03-31'),
('be 1234 aa', 'Besar(Tronton)', 10, 'Tidak Jalan', 'YES', 'mantap', 'hino', '123hino', 'Ya', 2011, '2021-05-12', '2022-05-12'),
('BE 1510 YY', 'Sedang(Engkel)', 7, 'Tidak Jalan', 'NO', 'mobil kuat', 'Mitsubishi', 'AA324', 'Ya', 2010, '2021-03-20', '2026-03-20'),
('BE 2213 AA', 'Sedang(Engkel)', 3, 'Tidak Jalan', 'NO', '', 'Mitsubishi', 'MIS123', 'Ya', 2017, NULL, NULL),
('BE 3322 AS', 'Besar(Tronton)', 10, 'Tidak Jalan', 'YES', '', 'HINO', '999HINO', 'Tidak', 2015, NULL, NULL),
('BE 3422 YI', 'Sedang(Engkel)', 2, 'Tidak Jalan', 'YES', '', 'Xenia', '11Xe', 'Ya', 2012, NULL, NULL),
('BE 4321 YI', 'Besar(Tronton)', 16, 'Tidak Jalan', 'NO', '', 'Hino', 'HINO123', 'Ya', 2019, NULL, NULL),
('BE 4566 FA', 'Besar(Tronton)', 20, 'Tidak Jalan', 'NO', '', 'Mitsubishi', '123MIS', 'Tidak', 2014, NULL, NULL),
('BE 5530 PQ', 'Besar(Tronton)', 10, 'Tidak Jalan', 'NO', '', 'SAN', '111SAN', 'Tidak', 2015, NULL, NULL),
('BE 9999 ZZ', 'Besar(Tronton)', 15, 'Tidak Jalan', 'NO', 'mobil baru', 'Hino', '123Hino', 'Ya', 2019, '2021-12-23', '2024-12-23'),
('BG 6543 DD', 'Sedang(Engkel)', 4, 'Tidak Jalan', 'NO', '', 'HINO', '11HINO', 'Ya', 2009, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `skb_rute`
--

CREATE TABLE `skb_rute` (
  `rute_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `rute_dari` varchar(50) NOT NULL,
  `rute_ke` varchar(50) NOT NULL,
  `rute_muatan` varchar(50) NOT NULL,
  `rute_uj_engkel` int(20) NOT NULL,
  `rute_uj_tronton` int(20) NOT NULL,
  `rute_tagihan` int(20) NOT NULL,
  `rute_gaji_engkel` int(20) DEFAULT NULL,
  `rute_gaji_tronton` int(20) DEFAULT NULL,
  `rute_gaji_engkel_rumusan` int(20) DEFAULT NULL,
  `rute_gaji_tronton_rumusan` int(11) DEFAULT NULL,
  `rute_status_hapus` varchar(5) NOT NULL,
  `rute_tonase` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `skb_rute`
--

INSERT INTO `skb_rute` (`rute_id`, `customer_id`, `rute_dari`, `rute_ke`, `rute_muatan`, `rute_uj_engkel`, `rute_uj_tronton`, `rute_tagihan`, `rute_gaji_engkel`, `rute_gaji_tronton`, `rute_gaji_engkel_rumusan`, `rute_gaji_tronton_rumusan`, `rute_status_hapus`, `rute_tonase`) VALUES
(1, 1, 'gudang lampung', 'gudang palembang', 'gula', 1500000, 1750000, 5000000, 500000, 750000, 0, 0, 'NO', '0'),
(2, 3, 'gudang jakarta', 'gudang lampung', 'rokok', 1500000, 2000000, 0, 500000, 1000000, 0, 0, 'NO', '0'),
(3, 1, 'gudang bandung', 'gudang lampung', 'gula', 2000000, 2500000, 0, 1000000, 1500000, 0, 0, 'NO', '0'),
(4, 1, 'gudang lampung', 'gudang bekasi', 'gula', 1500000, 2000000, 0, 750000, 1000000, 0, 0, 'NO', '0'),
(5, 1, 'gudang lampung', 'gudang palembang', 'tebu', 1500000, 2000000, 0, 500000, 750000, 0, 0, 'NO', '0'),
(6, 1, 'gudang bandung', 'gudang jakarta', 'mesin giling', 1000000, 1500000, 0, 500000, 750000, 0, 0, 'NO', '0'),
(7, 3, 'gudang jakarta', 'gudang palembang', 'rokok', 2000000, 2500000, 0, 1000000, 1500000, 0, 0, 'NO', '0'),
(8, 1, 'gudang lampung', 'gudang medan', 'gula', 3000000, 3500000, 0, 0, 0, 1500000, 2000000, 'NO', '16'),
(9, 1, 'gudang lampung', 'gudang medan', 'gula', 3000000, 3500000, 0, 1000000, 1500000, 0, 0, 'NO', '0'),
(10, 2, 'lampung', 'metro', 'komputer', 500000, 750000, 0, 250000, 350000, 0, 0, 'YES', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `skb_supir`
--

CREATE TABLE `skb_supir` (
  `supir_id` int(11) NOT NULL,
  `supir_name` varchar(50) NOT NULL,
  `supir_kasbon` int(11) NOT NULL,
  `status_jalan` varchar(25) NOT NULL,
  `status_hapus` varchar(15) NOT NULL,
  `supir_alamat` text NOT NULL,
  `supir_telp` varchar(15) NOT NULL,
  `supir_keterangan` text NOT NULL,
  `supir_ktp` varchar(20) NOT NULL,
  `supir_sim` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `skb_supir`
--

INSERT INTO `skb_supir` (`supir_id`, `supir_name`, `supir_kasbon`, `status_jalan`, `status_hapus`, `supir_alamat`, `supir_telp`, `supir_keterangan`, `supir_ktp`, `supir_sim`) VALUES
(5, 'Dwiki Martin Prasetya', 1500000, 'Tidak Jalan', 'NO', 'bandar lampung', '09849858', 'mantap', '123456789000', '987654321'),
(14, 'Sasuke', 0, 'Tidak Jalan', 'NO', 'jalan medan merdeka', '089673737373', 'supir medan nihhh', '18710211211331112', '10238120481203102'),
(15, 'Herby', 0, 'Tidak Jalan', 'NO', 'metro pusta', '1243253', 'mantap\r\n', '12341234', '12412312'),
(16, 'Rey', 0, 'Tidak Jalan', 'YES', '', '', '', '', ''),
(19, 'aldi indrawan', 0, 'Tidak Jalan', 'YES', 'jalan pulau damar', '0895620408193', 'bebas ni orang', '1823123313', '123123123'),
(20, 'riski hermawan', 3000000, 'Tidak Jalan', 'NO', 'metro', '08969748', 'supur handal', '123456789', '987654321');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `akun_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `akun_id`, `username`, `password`) VALUES
(11, 14, 'bhaskara', '7c4a8d09ca3762af61e59520943dc26494f8941b'),
(14, 17, 'aldi12', '7c4a8d09ca3762af61e59520943dc26494f8941b'),
(16, 19, 'shanti12', '7c4a8d09ca3762af61e59520943dc26494f8941b');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `skb_akun`
--
ALTER TABLE `skb_akun`
  ADD PRIMARY KEY (`akun_id`);

--
-- Indeks untuk tabel `skb_bon`
--
ALTER TABLE `skb_bon`
  ADD PRIMARY KEY (`bon_id`),
  ADD KEY `supir_id` (`supir_id`);

--
-- Indeks untuk tabel `skb_customer`
--
ALTER TABLE `skb_customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indeks untuk tabel `skb_invoice`
--
ALTER TABLE `skb_invoice`
  ADD PRIMARY KEY (`invoice_kode`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indeks untuk tabel `skb_job_order`
--
ALTER TABLE `skb_job_order`
  ADD PRIMARY KEY (`Jo_id`),
  ADD KEY `mobil_no` (`mobil_no`),
  ADD KEY `supir_id` (`supir_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indeks untuk tabel `skb_mobil`
--
ALTER TABLE `skb_mobil`
  ADD PRIMARY KEY (`mobil_no`);

--
-- Indeks untuk tabel `skb_rute`
--
ALTER TABLE `skb_rute`
  ADD PRIMARY KEY (`rute_id`);

--
-- Indeks untuk tabel `skb_supir`
--
ALTER TABLE `skb_supir`
  ADD PRIMARY KEY (`supir_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `akun_id` (`akun_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `skb_akun`
--
ALTER TABLE `skb_akun`
  MODIFY `akun_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `skb_bon`
--
ALTER TABLE `skb_bon`
  MODIFY `bon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `skb_customer`
--
ALTER TABLE `skb_customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `skb_job_order`
--
ALTER TABLE `skb_job_order`
  MODIFY `Jo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT untuk tabel `skb_rute`
--
ALTER TABLE `skb_rute`
  MODIFY `rute_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `skb_supir`
--
ALTER TABLE `skb_supir`
  MODIFY `supir_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `skb_bon`
--
ALTER TABLE `skb_bon`
  ADD CONSTRAINT `skb_bon_ibfk_1` FOREIGN KEY (`supir_id`) REFERENCES `skb_supir` (`supir_id`);

--
-- Ketidakleluasaan untuk tabel `skb_invoice`
--
ALTER TABLE `skb_invoice`
  ADD CONSTRAINT `skb_invoice_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `skb_customer` (`customer_id`);

--
-- Ketidakleluasaan untuk tabel `skb_job_order`
--
ALTER TABLE `skb_job_order`
  ADD CONSTRAINT `skb_job_order_ibfk_1` FOREIGN KEY (`mobil_no`) REFERENCES `skb_mobil` (`mobil_no`),
  ADD CONSTRAINT `skb_job_order_ibfk_2` FOREIGN KEY (`supir_id`) REFERENCES `skb_supir` (`supir_id`),
  ADD CONSTRAINT `skb_job_order_ibfk_3` FOREIGN KEY (`customer_id`) REFERENCES `skb_customer` (`customer_id`);

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`akun_id`) REFERENCES `skb_akun` (`akun_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
