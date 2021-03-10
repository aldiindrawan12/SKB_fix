-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Mar 2021 pada 13.53
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.2.32

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
  `akun_role` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `skb_akun`
--

INSERT INTO `skb_akun` (`akun_id`, `akun_name`, `akun_role`) VALUES
(11, 'aldi', 'Super User'),
(14, 'Rizki Bhaskara', 'Super User'),
(15, 'Operator', 'Operator'),
(16, 'admin', 'Operator');

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
(1, 250000, 'Pengajuan', '2021-02-11 00:00:00', 'beli bensin', 1),
(2, 100000, 'Pembayaran', '2021-02-11 00:00:00', 'cicil', 1),
(3, 150000, 'Pembayaran', '2021-02-11 02:45:23', 'pelunasan', 1),
(4, 500000, 'Pengajuan', '2021-02-11 08:46:24', 'beli bensin', 2),
(5, 1000000, 'Pengajuan', '2021-02-11 10:16:44', 'makan', 2),
(6, 125000, 'Pengajuan', '2021-02-11 10:17:00', 'makan', 1),
(7, 500000, 'Pengajuan', '2021-02-12 14:46:51', 'lamaran', 2),
(8, 125000, 'Pengajuan', '2021-02-13 23:14:35', 'jajan', 1),
(9, 200000, 'Pembayaran', '2021-02-15 23:57:18', 'bayar makan', 1),
(10, 700000, 'Pembayaran', '2021-02-16 03:30:22', 'bayar', 2),
(14, 500000, 'Pengajuan', '2021-02-16 19:21:59', 'pembiayaan motor', 2),
(15, 213123, 'Pembayaran', '2021-02-17 20:22:35', 'sadads', 2),
(16, 100000, 'Pengajuan', '2021-02-17 20:23:13', 'asikasik', 1),
(17, 500000, 'Pengajuan', '2021-02-18 00:06:53', 'bayar listrik cyyyy', 2),
(18, 250000, 'Pengajuan', '2021-02-18 08:10:43', 'uang makan', 1),
(19, 150000, 'Pengajuan', '2021-02-18 11:55:31', 'uang jajan', 1),
(20, 250000, 'Pembayaran', '2021-02-18 11:56:33', 'nyicil', 2),
(21, 100000, 'Pengajuan', '2021-02-18 11:58:21', 'uang jalan tambahan', 1),
(22, 250000, 'Pembayaran', '2021-02-18 11:58:39', 'nyicil', 2),
(23, 100000, 'Pengajuan', '2021-02-18 12:03:32', 'tambah', 1),
(24, 350000, 'Pembayaran', '2021-02-18 12:03:55', 'lunas', 1),
(25, 100000, 'Pembayaran', '2021-02-18 12:04:21', '', 1),
(26, 100000, 'Pengajuan', '2021-02-18 12:04:37', '', 2),
(27, 100000, 'Pengajuan', '2021-02-18 12:04:57', '', 1),
(28, 127, 'Pengajuan', '2021-02-18 12:24:31', '', 1),
(29, 125000, 'Pengajuan', '2021-02-18 12:25:09', '', 2),
(30, 127, 'Pembayaran', '2021-02-18 13:30:00', '', 1),
(31, 225000, 'Pembayaran', '2021-02-18 13:30:12', '', 2),
(32, 666788, 'Pembayaran', '2021-02-18 13:36:27', '', 2),
(33, 668788, 'Pengajuan', '2021-02-18 13:36:43', '', 2),
(34, 2000, 'Pembayaran', '2021-02-18 13:36:59', '', 2),
(35, 500000, 'Pengajuan', '2021-02-19 21:39:39', 'biaya kawin', 2),
(36, 300000, 'Pembayaran', '2021-02-19 21:39:58', 'nyicil', 2),
(37, 123123112, 'Pembayaran', '2021-02-23 22:28:06', '', 2),
(38, 150000, 'Pengajuan', '2021-02-23 22:39:14', 'bayar', 1),
(39, 100000, 'Pengajuan', '2021-02-23 23:33:05', 'ngutang ya mba\r\n', 1),
(40, 100000, 'Pengajuan', '2021-02-24 17:57:51', 'uang makan', 5),
(41, 100000, 'Pengajuan', '2021-02-24 17:59:20', 'berobat', 5),
(42, 100000, 'Pembayaran', '2021-02-24 18:00:02', 'nyicil', 5),
(43, 50000, 'Pengajuan', '2021-02-24 18:05:41', 'rokok ma bro', 5),
(44, 5000000, 'Pengajuan', '2021-03-08 14:44:39', 'BON untuk honeymoon', 5),
(45, 5000000, 'Pengajuan', '2021-03-08 14:47:03', 'bon pesen tiket pesawat', 5),
(46, 1000000, 'Pembayaran', '2021-03-08 14:47:43', 'bayar nih nyicil tpai ya', 5),
(47, 600000, 'Pengajuan', '2021-03-08 16:13:51', 'huha', 16),
(48, 500000, 'Pengajuan', '2021-03-08 16:16:08', 'test', 14),
(49, 500000, 'Pembayaran', '2021-03-08 16:17:11', 'oke', 5),
(50, 500000, 'Pembayaran', '2021-03-08 16:18:26', 'okee', 14),
(51, 850000, 'Pengajuan', '2021-03-08 16:23:05', '', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `skb_customer`
--

CREATE TABLE `skb_customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `skb_customer`
--

INSERT INTO `skb_customer` (`customer_id`, `customer_name`) VALUES
(1, 'PT.Gula ku'),
(2, 'PT.Gink'),
(3, 'PT.Gudang Garam'),
(4, 'PT.AISPS'),
(5, 'PT.Philip LPG'),
(6, 'PT.Jaya Bakery'),
(7, 'PT.Rumah Kayu'),
(8, 'PT.SMANLA'),
(9, 'Toko Adel'),
(10, 'Wood Steirs'),
(11, 'Toko Buku Dioni'),
(12, 'Grosir Iyuz'),
(13, 'ntah ini customer sapa'),
(14, 'PT Maju Terang'),
(15, 'Bhaskara Enterprisesss'),
(16, 's'),
(17, 'Unibis'),
(18, 'Master Geprek');

-- --------------------------------------------------------

--
-- Struktur dari tabel `skb_invoice`
--

CREATE TABLE `skb_invoice` (
  `invoice_kode` int(11) NOT NULL,
  `jo_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `tanggal_invoice` date NOT NULL,
  `batas_pembayaran` date NOT NULL,
  `grand_total` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `ppn` int(11) NOT NULL,
  `status_bayar` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `skb_invoice`
--

INSERT INTO `skb_invoice` (`invoice_kode`, `jo_id`, `customer_id`, `tanggal_invoice`, `batas_pembayaran`, `grand_total`, `total`, `ppn`, `status_bayar`) VALUES
(1, 7, 6, '2021-02-13', '2021-02-27', 4500, 0, 0, 'Lunas'),
(2, 8, 9, '2021-02-13', '2021-02-27', 10000000, 0, 0, 'Lunas'),
(3, 9, 1, '2021-02-13', '2021-02-27', 5000000, 0, 0, 'Lunas'),
(4, 10, 2, '2021-02-13', '2021-02-27', 4500000, 0, 0, 'Lunas'),
(5, 11, 5, '2021-02-13', '2021-02-27', 5000000, 0, 0, 'Lunas'),
(6, 13, 10, '2021-02-14', '2021-02-28', 4900000, 0, 0, 'Belum Lunas'),
(7, 12, 6, '2021-02-14', '2021-02-28', 13500000, 0, 0, 'Belum Lunas'),
(8, 14, 8, '2021-02-14', '2021-02-28', 2500000, 0, 0, 'Belum Lunas'),
(9, 55, 4, '2021-02-14', '2021-02-28', 4500000, 0, 0, 'Lunas'),
(10, 56, 5, '2021-02-14', '2021-02-28', 900000, 0, 0, 'Lunas'),
(11, 57, 2, '2021-02-15', '2021-03-01', 2000000, 0, 0, 'Belum Lunas'),
(12, 58, 1, '2021-02-15', '2021-03-01', 5000000, 0, 0, 'Belum Lunas'),
(13, 59, 3, '2021-02-17', '2021-03-03', 25000000, 0, 0, 'Belum Lunas'),
(14, 60, 3, '2021-02-17', '2021-03-19', 5000000, 0, 0, 'Lunas'),
(15, 61, 11, '2021-02-18', '2021-03-20', 7000000, 0, 0, ''),
(16, 63, 2, '2021-02-18', '2021-03-20', 6000000, 0, 0, ''),
(17, 64, 8, '2021-02-18', '2021-03-20', 7500000, 0, 0, ''),
(18, 62, 9, '2021-02-18', '2021-03-04', 5000000, 0, 0, ''),
(19, 65, 2, '2021-02-19', '2021-03-21', 10000000, 0, 0, ''),
(20, 66, 5, '2021-02-19', '2021-03-21', 11000000, 0, 0, ''),
(21, 67, 5, '2021-02-19', '2021-03-21', 5000000, 0, 0, ''),
(22, 68, 4, '2021-02-19', '2021-03-21', 1500000, 0, 0, ''),
(23, 69, 6, '2021-02-19', '2021-03-21', 5000000, 0, 0, ''),
(24, 70, 7, '2021-02-19', '2021-03-21', 50000000, 0, 0, ''),
(25, 71, 2, '2021-02-19', '2021-03-21', 5000000, 0, 0, ''),
(26, 72, 1, '2021-02-19', '2021-03-21', 60000000, 0, 0, ''),
(27, 73, 3, '2021-02-21', '2021-03-23', 4000000, 0, 0, ''),
(28, 74, 9, '2021-02-21', '2021-03-23', 11000000, 10000000, 1000000, 'Belum Lunas'),
(29, 75, 2, '2021-02-21', '2021-03-23', 5500000, 5000000, 500000, 'Belum Lunas'),
(30, 76, 12, '2021-02-23', '2021-03-25', 11000000, 10000000, 1000000, 'Lunas'),
(31, 77, 4, '2021-02-23', '2021-03-25', 5500000, 5000000, 500000, 'Belum Lunas'),
(32, 78, 3, '2021-02-24', '2021-03-26', 4400000, 4000000, 400000, 'Belum Lunas'),
(33, 80, 14, '2021-03-08', '2021-04-07', 55000000, 50000000, 5000000, 'Belum Lunas'),
(34, 81, 1, '2021-03-08', '2021-04-27', 66000000, 60000000, 6000000, 'Belum Lunas'),
(35, 79, 5, '2021-03-08', '2021-04-07', 55000000, 50000000, 5000000, 'Belum Lunas'),
(36, 82, 3, '2021-03-08', '2021-04-07', 110000000, 100000000, 10000000, 'Belum Lunas'),
(37, 83, 1, '2021-03-08', '2021-04-07', 24750000, 22500000, 2250000, 'Belum Lunas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `skb_job_order`
--

CREATE TABLE `skb_job_order` (
  `Jo_id` int(11) NOT NULL,
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
  `satuan` varchar(50) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `harga/kg` int(11) NOT NULL,
  `upah` int(11) NOT NULL,
  `biaya_lain` int(11) NOT NULL,
  `Keterangan_biaya_lain` text NOT NULL,
  `customer_id` int(11) NOT NULL,
  `status` varchar(25) NOT NULL,
  `bonus` int(11) NOT NULL,
  `status_upah` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `skb_job_order`
--

INSERT INTO `skb_job_order` (`Jo_id`, `mobil_no`, `supir_id`, `muatan`, `asal`, `tujuan`, `uang_jalan`, `terbilang`, `tanggal_surat`, `tanggal_bongkar`, `tonase`, `satuan`, `keterangan`, `harga/kg`, `upah`, `biaya_lain`, `Keterangan_biaya_lain`, `customer_id`, `status`, `bonus`, `status_upah`) VALUES
(2, 'BE 3422 YI', 1, 'gula', 'Sumatera Selatan', 'Sumatera Selatan', 1500000, 'satu juta lima ratus ribu rupiah', '2021-02-10', '2021-02-10', 10, '', '==tambahan:==tambahan:nice nice', 450, 250000, 0, '', 1, 'Sampai Tujuan', 50000, 'Sudah Dibayar'),
(4, 'BE 1234 AA', 1, 'Rokok', 'Aceh', 'Aceh', 2500000, 'dua juta lima ratus ribu rupiah', '2021-02-10', '2021-02-10', 11, '', '==tambahan:dsad', 212, 123, 0, '', 3, 'Sampai Tujuan', 123, 'Sudah Dibayar'),
(5, 'BE 1211 AI', 2, 'komputer', 'Aceh', 'Sumatera Selatan', 1500000, 'satu juta lima ratus ribu rupiah', '2021-02-10', '2021-02-10', 10, '', '==tambahan:nice', 400, 250000, 0, '', 2, 'Sampai Tujuan', 0, 'Sudah Dibayar'),
(6, 'BE 1234 AA', 2, 'buket', 'Sumatera Selatan', 'Jakarta', 500000, 'lima ratus ribu rupiah', '2021-02-11', '2021-02-12', 2, '', '==tambahan:sampai dengan selamat', 500, 250000, 0, '', 4, 'Sampai Tujuan', 0, 'Sudah Dibayar'),
(7, 'BE 1211 AI', 1, 'bahan roti', 'Jakarta', 'Aceh', 1500000, 'satu juta lima ratus ribu rupiah', '2021-02-11', '2021-02-13', 10, '', '==tambahan:', 450, 250000, 0, '', 6, 'Sampai Tujuan', 0, 'Sudah Dibayar'),
(8, 'BE 1234 AA', 2, 'telur ayam potong', 'Sumatera Selatan', 'Aceh', 1000000, 'satu juta rupiah', '2021-02-12', '2021-02-13', 20, '', '1 mobil==tambahan:', 500, 250000, 0, '', 9, 'Sampai Tujuan', 50000, 'Sudah Dibayar'),
(9, 'BE 1234 AA', 2, 'gula merah', 'Aceh', 'Jakarta', 1500000, ' Satu Juta Lima Ratus  Ribu  Rupiah', '2021-02-13', '2021-02-13', 10, '', 'gudang lampung==tambahan:', 500, 250000, 0, '', 1, 'Sampai Tujuan', 0, 'Sudah Dibayar'),
(10, 'BE 1211 AI', 1, 'meja kursi', 'Jakarta', 'Aceh', 1500, ' Satu Juta Lima Ratus  Ribu  Rupiah', '2021-02-13', '2021-02-13', 10, '', '==tambahan:', 450, 250000, 0, '', 2, 'Sampai Tujuan', 0, 'Sudah Dibayar'),
(11, 'BE 1211 AI', 1, 'lampu', 'Jakarta', 'Sumatera Selatan', 1500000, ' Satu Juta Lima Ratus  Ribu  Rupiah', '2021-02-13', '2021-02-13', 10, '', '==tambahan:', 500, 250000, 0, '', 5, 'Sampai Tujuan', 0, 'Sudah Dibayar'),
(12, 'BE 1211 AI', 2, 'bahan kue', 'Jakarta', 'Aceh', 1500000, ' Satu Juta Lima Ratus  Ribu  Rupiah', '2021-02-14', '2021-02-14', 30, '', ',sampai tujuan patah 1', 450, 250000, 0, '', 6, 'Sampai Tujuan', 0, 'Sudah Dibayar'),
(13, 'BE 1510 YY', 1, 'kursi kayu', 'Jakarta', 'Aceh', 2000000, ' Dua Juta  Rupiah', '2021-02-14', '2021-02-14', 7, '', ',sampai tujuan dengan selamat', 700, 450000, 0, '', 10, 'Sampai Tujuan', 50000, 'Sudah Dibayar'),
(14, 'BE 2213 AA', 1, 'komputer', 'Jakarta', 'Aceh', 1500000, ' Satu Juta Lima Ratus  Ribu  Rupiah', '2021-02-14', '2021-02-14', 5, '', ',sampai tujuan pecah monitor 1', 500, 250000, 0, '', 8, 'Sampai Tujuan', 25000, 'Sudah Dibayar'),
(55, 'BE 1510 YY', 2, 'kembang taman', 'Jakarta', 'Aceh', 1500000, ' Satu Juta Lima Ratus  Ribu  Rupiah', '2021-02-14', '2021-02-14', 10, '', ',', 450, 300000, 0, '', 4, 'Sampai Tujuan', 0, 'Sudah Dibayar'),
(56, 'BE 1211 AI', 1, 'gas LPG 3 KG', 'Aceh', 'Aceh', 500000, ' Lima Ratus  Ribu  Rupiah', '2021-02-14', '2021-02-14', 3, '', ',', 300, 250000, 0, '', 5, 'Sampai Tujuan', 0, 'Sudah Dibayar'),
(57, 'BE 1234 AA', 1, 'komputer', 'Aceh', 'Aceh', 500000, ' Lima Ratus  Ribu  Rupiah', '2021-02-14', '2021-02-15', 4, '', ',', 500, 250000, 0, '', 2, 'Sampai Tujuan', 0, 'Sudah Dibayar'),
(58, 'BE 2213 AA', 2, 'gula dan tebu', 'Lampung', 'Sumatera Selatan', 750000, ' Tujuh Ratus Lima Puluh  Ribu  Rupiah', '2021-02-15', '2021-02-15', 10, '', ',', 500, 300000, 0, '', 1, 'Sampai Tujuan', 50000, 'Sudah Dibayar'),
(59, 'BE 1510 YY', 2, 'rokok', 'Jakarta', 'Jakarta', 1500000, ' Satu Juta Lima Ratus  Ribu  Rupiah', '2021-02-15', '2021-02-17', 5, '', ',', 5000, 250000, 0, '', 3, 'Sampai Tujuan', 50000, 'Sudah Dibayar'),
(60, 'BE 4321 YI', 2, 'rokok dji sam soe', 'bandar lampung', 'jakarta', 2000000, ' Dua Juta  Rupiah', '2021-02-17', '2021-02-17', 10, '', 'banyak ada 100 peti,Sampai tujuan', 500, 400000, 0, '', 3, 'Sampai Tujuan', 50000, 'Sudah Dibayar'),
(61, 'BE 1234 AA', 2, 'buku dan ATK', 'jakarta', 'lampung', 750000, ' Tujuh Ratus Lima Puluh  Ribu  Rupiah', '2021-02-18', '2021-02-18', 10, '', ',sampai tujuan', 700, 400000, 0, '', 11, 'Sampai Tujuan', 50000, 'Sudah Dibayar'),
(62, 'BE 1510 YY', 2, 'telor ayam', 'metro', 'bandar lampung', 750000, ' Tujuh Ratus Lima Puluh  Ribu  Rupiah', '2021-02-18', '2021-02-18', 5, '', '10 peti,oke', 1000, 400000, 0, '', 9, 'Sampai Tujuan', 0, 'Sudah Dibayar'),
(63, 'BE 1234 AA', 1, 'meja kantor', 'jakarta', 'lampung', 500000, ' Lima Ratus  Ribu  Rupiah', '2021-02-18', '2021-02-18', 10, '', ',sampai tujuan', 600, 400000, 0, '', 2, 'Sampai Tujuan', 0, 'Sudah Dibayar'),
(64, 'BE 1234 AA', 1, 'kursi meja', 'jakarta', 'lampung', 800000, ' Delapan Ratus  Ribu  Rupiah', '2021-02-18', '2021-02-18', 15, '', ',sip', 500, 500000, 0, '', 8, 'Sampai Tujuan', 50000, 'Sudah Dibayar'),
(65, 'BE 1510 YY', 5, 'komputer', 'bandar lampung', 'jakarta', 1500000, ' Satu Juta Lima Ratus  Ribu  Rupiah', '2021-02-19', '2021-02-19', 10, '', ',', 1000, 450000, 0, '', 2, 'Sampai Tujuan', 50000, 'Sudah Dibayar'),
(66, 'BE 1510 YY', 5, 'lampu bokhlam', 'jakarta', 'bandar Lampung', 500000, ' Lima Ratus  Ribu  Rupiah', '2021-02-19', '2021-02-19', 10, '', ',', 1100, 450000, 0, '', 5, 'Sampai Tujuan', 50000, 'Sudah Dibayar'),
(67, 'BE 3322 AS', 2, 'gas lpg', 'bandar lampung', 'lampung tengah', 1000000, ' Satu Juta  Rupiah', '2021-02-19', '2021-02-19', 10, '', ',', 500, 400000, 0, '', 5, 'Sampai Tujuan', 50000, 'Sudah Dibayar'),
(68, 'BE 1234 AA', 1, 'buket', 'bandar lampung', 'metro', 500000, ' Lima Ratus  Ribu  Rupiah', '2021-02-19', '2021-02-19', 3, '', ',', 500, 450000, 0, '', 4, 'Sampai Tujuan', 25000, 'Sudah Dibayar'),
(69, 'BE 1211 AI', 2, 'bahan rotu', 'jakarta', 'bandar lampugn', 1500000, ' Satu Juta Lima Ratus  Ribu  Rupiah', '2021-02-19', '2021-02-19', 5, '', ',', 1000, 500000, 0, '', 6, 'Sampai Tujuan', 50000, 'Sudah Dibayar'),
(70, 'BE 1211 AI', 2, 'bahan makan', 'bandung', 'jakarta', 1000000, ' Satu Juta  Rupiah', '2021-02-19', '2021-02-19', 10, '', ',', 5000, 400000, 0, '', 7, 'Sampai Tujuan', 50000, 'Sudah Dibayar'),
(71, 'BE 1211 AI', 2, 'apa saja', 'jakarta', 'bandar lampung', 1500000, ' Satu Juta Lima Ratus  Ribu  Rupiah', '2021-02-19', '2021-02-19', 10, '', ',', 500, 450000, 0, '', 2, 'Sampai Tujuan', 25000, 'Sudah Dibayar'),
(72, 'BE 1234 AA', 1, 'gula', 'bandar jaya', 'aceh', 2000000, ' Dua Juta  Rupiah', '2021-02-19', '2021-02-19', 4, '', ',', 15000, 1000000, 0, '', 1, 'Sampai Tujuan', 50000, 'Sudah Dibayar'),
(73, 'BE 1510 YY', 1, 'rokok surya', 'bali', 'surabaya', 1500000, ' Satu Juta Lima Ratus  Ribu  Rupiah', '2021-02-19', '2021-02-21', 10, '', '20 peti,', 400, 400000, 0, '', 3, 'Sampai Tujuan', 50000, 'Sudah Dibayar'),
(74, 'BE 2213 AA', 2, 'telor ayam', 'jakarta', 'lampung', 1500000, ' Satu Juta Lima Ratus  Ribu  Rupiah', '2021-02-21', '2021-02-21', 10, '', ',', 1000, 400000, 0, '', 9, 'Sampai Tujuan', 50000, 'Belum Dibayar'),
(75, 'BE 1510 YY', 1, 'komputer', 'lampung', 'jakarta', 1500000, ' Satu Juta Lima Ratus  Ribu  Rupiah', '2021-02-21', '2021-02-21', 10, '', ',', 500, 450000, 0, '', 2, 'Sampai Tujuan', 0, 'Sudah Dibayar'),
(76, 'BE 1234 AA', 2, 'bangku rotan', 'lampungtengah', 'bandar lalmpung', 500000, ' Lima Ratus  Ribu  Rupiah', '2021-02-23', '2021-02-23', 10, '', 'hati hati dijalan\r\n,mantap slur', 1000, 450000, 0, '', 12, 'Sampai Tujuan', 50000, 'Belum Dibayar'),
(77, 'BE 1234 AA', 2, 'buket', 'bandar lampung', 'metro', 500000, ' Lima Ratus  Ribu  Rupiah', '2021-02-23', '2021-02-23', 10, '', '<strong>Catatan JO : </strong>mantap lus,cepet ya<br><strong>Catatan Konfirmasi : </strong>makasih lur', 500, 450000, 0, '', 4, 'Sampai Tujuan', 50000, 'Belum Dibayar'),
(78, 'BE 3422 YI', 5, 'rokok', 'metro', 'tulang bawang', 750000, ' Tujuh Ratus Lima Puluh  Ribu  Rupiah', '2021-02-24', '2021-02-24', 10, '', '<strong>Catatan JO : </strong>hati hati ma bro<br><strong>Catatan Konfirmasi : </strong>mantap ki', 400, 500000, 0, '', 3, 'Sampai Tujuan', 0, 'Sudah Dibayar'),
(79, 'BE 5530 PQ', 5, 'Lampu', 'Jakarta', 'Medan', 7000000, ' Tujuh Juta  Rupiah', '2021-02-27', '2021-03-08', 10, 'kubik', '<strong>Catatan JO : </strong>Oke<br><strong>Catatan Konfirmasi : </strong>mantap', 5000, 500000, 0, '', 5, 'Sampai Tujuan', 250000, 'Belum Dibayar'),
(80, 'BE 3322 AS', 14, 'Beban Hidup', 'Jawa Barat', 'Lampung', 1500000, ' Satu Juta Lima Ratus  Ribu  Rupiah', '2021-03-08', '2021-03-08', 10, '', '<strong>Catatan JO : </strong>Barang berngkat 10 ton<br><strong>Catatan Konfirmasi : </strong>Barang sampai selamat tidak ada cacat', 5000, 1500000, 0, '', 14, 'Sampai Tujuan', 250000, 'Sudah Dibayar'),
(81, 'BE 3422 YI', 14, 'Beer', 'Lampung', 'Palembang', 2999999, ' Dua Juta Sembilan Ratus Sembilan Puluh Sembilan Ribu Sembilan Ratus Sembilan Puluh Sembilan Rupiah', '2021-03-08', '2021-03-08', 10, '', '<strong>Catatan JO : </strong>Jalan\r\n<br><strong>Catatan Konfirmasi : </strong>Sip', 6000, 250000, 0, '', 1, 'Sampai Tujuan', 250000, 'Sudah Dibayar'),
(82, 'BE 4321 YI', 16, 'Pasir', 'Jambi', 'Medan', 500000, ' Lima Ratus  Ribu  Rupiah', '2021-03-08', '2021-03-08', 10, '', '<strong>Catatan JO : </strong>Okeoke<br><strong>Catatan Konfirmasi : </strong>mantap', 10000, 1000000, 0, '', 3, 'Sampai Tujuan', 100000, 'Belum Dibayar'),
(83, 'BE 4321 YI', 14, 'gula', 'lampung', 'jakarta', 1500000, ' Satu Juta Lima Ratus  Ribu  Rupiah', '2021-03-08', '2021-03-08', 15, 'peti', '<strong>Catatan JO : </strong>segera\r\n<br><strong>Catatan Konfirmasi : </strong>mantap sasuke', 1500, 1000000, 0, '', 1, 'Sampai Tujuan', 100000, 'Belum Dibayar'),
(84, 'be 1111 ai', 14, 'tebu batang', 'lampung', 'lampung barat', 1500000, ' Satu Juta Lima Ratus  Ribu  Rupiah', '2021-03-08', '0000-00-00', 0, '', 'segera ya takut busuk\r\n', 0, 0, 0, '', 1, 'Dalam Perjalanan', 0, 'Belum Dibayar');

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
  `mobil_keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `skb_mobil`
--

INSERT INTO `skb_mobil` (`mobil_no`, `mobil_jenis`, `mobil_max_load`, `status_jalan`, `status_hapus`, `mobil_keterangan`) VALUES
('asdsa', 'adsdsa', 123123, 'Tidak Jalan', 'YES', ''),
('be 1111 ai', 'engkel', 5, 'Jalan', 'NO', 'ini mobil bodong\r\n'),
('BE 1211 AI', 'Box', 4, 'Tidak Jalan', 'YES', ''),
('be 1231 aa', 'truk', 12, 'Tidak Jalan', '', ''),
('be 12312 a', 'truk', 11, 'Tidak Jalan', 'YES', ''),
('BE 1234 AA', 'Pick Up', 2, 'Tidak Jalan', 'YES', ''),
('BE 1510 YY', 'Fuso', 7, 'Tidak Jalan', 'YES', ''),
('BE 2213 AA', 'Grand Max', 3, 'Tidak Jalan', 'YES', ''),
('BE 3322 AS', 'Wing Box', 10, 'Tidak Jalan', 'YES', ''),
('BE 3422 YI', 'Engkel', 2, 'Tidak Jalan', 'NO', ''),
('BE 4321 YI', 'Container', 16, 'Tidak Jalan', 'NO', ''),
('BE 4566 FA', 'Trailer', 20, 'Tidak Jalan', 'NO', ''),
('BE 5530 PQ', 'Tronton', 10, 'Tidak Jalan', 'NO', ''),
('BG 6543 DD', 'Truck L300', 4, 'Tidak Jalan', 'NO', ''),
('RI 1', 'Tank', 100, 'Tidak Jalan', 'YES', ''),
('RI 2', 'Limousine', 99, 'Tidak Jalan', 'YES', 'Mobilnya pak jen nih\r\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `skb_satuan`
--

CREATE TABLE `skb_satuan` (
  `satuan_id` int(11) NOT NULL,
  `satuan_name` varchar(50) NOT NULL,
  `satuan_simbol` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `skb_satuan`
--

INSERT INTO `skb_satuan` (`satuan_id`, `satuan_name`, `satuan_simbol`) VALUES
(1, 'tonase', 'ton'),
(2, 'peti', 'peti'),
(3, 'kardus', 'kardus'),
(4, 'kubik', 'kubik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `skb_supir`
--

CREATE TABLE `skb_supir` (
  `supir_id` int(11) NOT NULL,
  `supir_name` varchar(50) NOT NULL,
  `supir_kasbon` int(11) NOT NULL,
  `status_jalan` varchar(25) NOT NULL,
  `status_hapus` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `skb_supir`
--

INSERT INTO `skb_supir` (`supir_id`, `supir_name`, `supir_kasbon`, `status_jalan`, `status_hapus`) VALUES
(1, 'Rizki aja', 250000, 'Tidak Jalan', 'YES'),
(2, 'Aldi Indrawan', -122923112, 'Tidak Jalan', 'YES'),
(5, 'Dwiki Martin', 9350000, 'Tidak Jalan', 'NO'),
(12, 'Aldi Indrawan aja', 0, 'Tidak Jalan', 'YES'),
(13, 'asdsa', 0, 'Tidak Jalan', 'YES'),
(14, 'Sasuke', 0, 'Jalan', 'NO'),
(15, 'Herby', 0, 'Tidak Jalan', 'NO'),
(16, 'Rey', 600000, 'Tidak Jalan', 'NO');

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
(8, 11, 'aldi12', '123456'),
(11, 14, 'bhaskara', '123456'),
(12, 15, 'operator', '123456'),
(13, 16, 'admin', 'admin');

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
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `jo_id` (`jo_id`);

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
-- Indeks untuk tabel `skb_satuan`
--
ALTER TABLE `skb_satuan`
  ADD PRIMARY KEY (`satuan_id`);

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
  MODIFY `akun_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `skb_bon`
--
ALTER TABLE `skb_bon`
  MODIFY `bon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `skb_customer`
--
ALTER TABLE `skb_customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `skb_invoice`
--
ALTER TABLE `skb_invoice`
  MODIFY `invoice_kode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `skb_job_order`
--
ALTER TABLE `skb_job_order`
  MODIFY `Jo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT untuk tabel `skb_satuan`
--
ALTER TABLE `skb_satuan`
  MODIFY `satuan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `skb_supir`
--
ALTER TABLE `skb_supir`
  MODIFY `supir_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  ADD CONSTRAINT `skb_invoice_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `skb_customer` (`customer_id`),
  ADD CONSTRAINT `skb_invoice_ibfk_2` FOREIGN KEY (`jo_id`) REFERENCES `skb_job_order` (`Jo_id`);

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
