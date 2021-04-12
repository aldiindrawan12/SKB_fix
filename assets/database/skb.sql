-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2021 at 07:08 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `skb_akun`
--

CREATE TABLE `skb_akun` (
  `akun_id` int(11) NOT NULL,
  `akun_name` varchar(25) NOT NULL,
  `akun_role` varchar(25) NOT NULL,
  `akun_akses` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skb_akun`
--

INSERT INTO `skb_akun` (`akun_id`, `akun_name`, `akun_role`, `akun_akses`) VALUES
(14, 'Rizki Bhaskara aa', 'Super User', '["1","1","1","1","1"]'),
(17, 'aldi indrawan aja', 'Operator', '["0","0","1","1","0"]'),
(19, 'shanti', 'Operator', '["1","0","0","0","0"]'),
(20, 'CEO skb', 'Supervisor', '["1","1","1","1","1"]'),
(21, 'supervisor', 'Supervisor', '["1","1","1","1","1"]'),
(22, 'hallohallo', 'Supervisor', '["1","1","1","1","1"]'),
(23, 'admin', 'Super User', '["1","1","1","1","1"]');

-- --------------------------------------------------------

--
-- Table structure for table `skb_bon`
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
-- Dumping data for table `skb_bon`
--

INSERT INTO `skb_bon` (`bon_id`, `bon_nominal`, `bon_jenis`, `bon_tanggal`, `bon_keterangan`, `supir_id`) VALUES
(1, 3000000, 'Pembatalan JO', '2021-04-09 12:32:19', 'Pembatalan JO', 21),
(2, 1500000, 'Pembayaran', '2021-04-09 12:35:25', 'pengembalian uj', 21),
(3, 1500000, 'Potong Gaji', '2021-04-09 12:36:20', 'Potongan Kasbon Dari Pembayaran Gaji', 21),
(4, 500000, 'Pengajuan', '2021-04-09 12:49:23', 'ok', 5),
(5, 500000, 'Potong Gaji', '2021-04-09 12:49:34', 'Potongan Kasbon Dari Pembayaran Gaji', 5);

-- --------------------------------------------------------

--
-- Table structure for table `skb_customer`
--

CREATE TABLE `skb_customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_alamat` text NOT NULL,
  `customer_kontak_person` varchar(50) NOT NULL,
  `customer_telp` varchar(20) NOT NULL,
  `customer_keterangan` text NOT NULL,
  `status_hapus` varchar(5) NOT NULL,
  `validasi` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skb_customer`
--

INSERT INTO `skb_customer` (`customer_id`, `customer_name`, `customer_alamat`, `customer_kontak_person`, `customer_telp`, `customer_keterangan`, `status_hapus`, `validasi`) VALUES
(30, 'PT.Gula Ku', 'Lampung Selatan', 'Aldi', '0895620408193', 'Pabrik Gula', 'No', 'ACC'),
(31, 'PT Gudang Garam', 'Jalan Way Pangubuan', 'Heri', '089612312317', 'contact person adalah Supervisor', 'No', 'ACC');

-- --------------------------------------------------------

--
-- Table structure for table `skb_invoice`
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
-- Dumping data for table `skb_invoice`
--

INSERT INTO `skb_invoice` (`invoice_kode`, `customer_id`, `tanggal_invoice`, `batas_pembayaran`, `grand_total`, `total`, `ppn`, `status_bayar`, `total_tonase`, `invoice_keterangan`) VALUES
('111-PT Gudang Garam-03-2021', 31, '2021-04-09', '14', 7500000, 7500000, 0, 'Lunas', 10, 'rokok keliling'),
('111-PT.Gula Ku-03-2021', 30, '2021-04-09', '14', 14850000, 13500000, 1350000, 'Lunas', 10, 'muatan kopi'),
('213-PT.Gula Ku-03-2021', 30, '2021-04-12', '14', 13500000, 13500000, 0, 'Belum Lunas', 10, 'ok\r\n'),
('999-PT.Gula Ku-03-2021', 30, '2021-03-12', '14', 5000000, 5000000, 0, 'Belum Lunas', 10, 'ok');

-- --------------------------------------------------------

--
-- Table structure for table `skb_job_order`
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
  `uang_jalan_bayar` int(11) NOT NULL,
  `terbilang` text NOT NULL,
  `tanggal_surat` date NOT NULL,
  `tanggal_bongkar` date NOT NULL,
  `tonase` int(11) NOT NULL,
  `keterangan` text,
  `upah` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `status` varchar(25) NOT NULL,
  `bonus` int(11) NOT NULL,
  `status_upah` varchar(25) NOT NULL,
  `pembayaran_upah_id` int(11) NOT NULL,
  `tagihan` varchar(20) NOT NULL,
  `kosongan_id` varchar(10) NOT NULL,
  `uang_kosongan` varchar(20) DEFAULT NULL,
  `paketan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skb_job_order`
--

INSERT INTO `skb_job_order` (`Jo_id`, `invoice_id`, `mobil_no`, `supir_id`, `muatan`, `asal`, `tujuan`, `uang_jalan`, `uang_jalan_bayar`, `terbilang`, `tanggal_surat`, `tanggal_bongkar`, `tonase`, `keterangan`, `upah`, `customer_id`, `status`, `bonus`, `status_upah`, `pembayaran_upah_id`, `tagihan`, `kosongan_id`, `uang_kosongan`, `paketan_id`) VALUES
(1, '111-PT.Gula Ku-03-2021', 'BE 1234 YI', 5, '', '', '', 5500000, 5500000, ' Lima Juta Lima Ratus  Ribu  Rupiah', '2021-04-09', '2021-04-09', 10, '<strong>Catatan JO : </strong>Uj di tf<br><strong>Catatan Konfirmasi : </strong>ok', 4000000, 30, 'Sampai Tujuan', 0, 'Sudah Dibayar', 0, '13500000', '0', '0', 2),
(2, '111-PT Gudang Garam-03-2021', 'BE 1111 Z', 14, 'Rokok', 'Gudang Lelang', 'Gudang Metro', 3000000, 3500000, ' Tiga Juta  Rupiah', '2021-04-09', '2021-04-09', 10, '<strong>Catatan JO : </strong>ok<br><strong>Catatan Bayar UJ : </strong>uang kosongan<br><strong>Catatan Konfirmasi : </strong>ok', 1500000, 31, 'Sampai Tujuan', 0, 'Sudah Dibayar', 0, '7500000', '2', '500000', 0),
(4, '', 'BE 1 AI', 21, 'Tebu', 'Palembang', 'Jakarta', 3000000, 3000000, ' Tiga Juta  Rupiah', '2021-04-09', '0000-00-00', 0, 'ok', 1500000, 30, 'Dibatalkan', 0, 'Sudah Dibayar', 0, '7500000', '0', '0', 0),
(5, '999-PT.Gula Ku-03-2021', 'BE 1234 YI', 5, 'gula', 'lampung', 'palembang', 2000000, 2000000, ' Dua Juta  Rupiah', '2021-04-09', '2021-04-09', 10, '<strong>Catatan JO : </strong>ok<br><strong>Catatan Konfirmasi : </strong>mantap', 1000000, 30, 'Sampai Tujuan', 0, 'Sudah Dibayar', 0, '5000000', '0', '0', 0),
(6, '213-PT.Gula Ku-03-2021', 'BE 1234 YI', 5, '', '', '', 5500000, 6000000, ' Lima Juta Lima Ratus  Ribu  Rupiah', '2021-04-12', '2021-04-12', 10, '<strong>Catatan JO : </strong>ok<br><strong>Catatan Konfirmasi : </strong>sampe\r\n<br><strong>Catatan Bayar UJ : </strong>bonus', 4000000, 30, 'Sampai Tujuan', 0, 'Belum Dibayar', 0, '13500000', '0', '0', 2);

-- --------------------------------------------------------

--
-- Table structure for table `skb_kosongan`
--

CREATE TABLE `skb_kosongan` (
  `kosongan_id` int(11) NOT NULL,
  `kosongan_dari` varchar(50) NOT NULL,
  `kosongan_ke` varchar(50) NOT NULL,
  `kosongan_uang` varchar(25) NOT NULL,
  `status_hapus` varchar(5) NOT NULL,
  `validasi` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skb_kosongan`
--

INSERT INTO `skb_kosongan` (`kosongan_id`, `kosongan_dari`, `kosongan_ke`, `kosongan_uang`, `status_hapus`, `validasi`) VALUES
(1, 'palembang', 'lampung', '1150000', 'NO', 'ACC'),
(2, 'Lampung', 'Palembang', '500000', 'NO', 'ACC'),
(3, 'lampung', 'jakarta', '1500000', 'NO', 'ACC'),
(4, 'jakarta', 'bandung', '1500000', 'NO', 'ACC');

-- --------------------------------------------------------

--
-- Table structure for table `skb_merk_kendaraan`
--

CREATE TABLE `skb_merk_kendaraan` (
  `merk_id` int(11) NOT NULL,
  `merk_nama` varchar(50) NOT NULL,
  `merk_type` varchar(50) NOT NULL,
  `merk_jenis` varchar(50) NOT NULL,
  `merk_dump` varchar(5) NOT NULL,
  `status_hapus` varchar(10) NOT NULL,
  `validasi` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skb_merk_kendaraan`
--

INSERT INTO `skb_merk_kendaraan` (`merk_id`, `merk_nama`, `merk_type`, `merk_jenis`, `merk_dump`, `status_hapus`, `validasi`) VALUES
(1, 'HINO', 'HI123', 'Sedang(Engkel)', 'Ya', 'YES', 'ACC'),
(2, 'SAN', 'SA123', 'Besar(Tronton)', 'Ya', 'YES', 'ACC'),
(3, 'HINO', 'HI123', 'Box', 'Tidak', 'NO', 'ACC'),
(4, 'Mitsubishi', 'MI111', 'Sedang(Engkel)', 'Ya', 'NO', 'ACC'),
(5, 'mitsubishi', 'Wing123', 'Model Wings', 'Ya', 'NO', 'ACC');

-- --------------------------------------------------------

--
-- Table structure for table `skb_mobil`
--

CREATE TABLE `skb_mobil` (
  `mobil_no` varchar(20) NOT NULL,
  `mobil_jenis` varchar(50) NOT NULL,
  `mobil_max_load` int(11) NOT NULL,
  `status_jalan` varchar(25) NOT NULL,
  `status_hapus` varchar(15) NOT NULL,
  `mobil_keterangan` varchar(255) NOT NULL,
  `merk_id` int(11) NOT NULL,
  `mobil_merk` varchar(20) NOT NULL,
  `mobil_type` varchar(20) NOT NULL,
  `mobil_dump` varchar(20) NOT NULL,
  `mobil_tahun` int(4) NOT NULL,
  `mobil_berlaku` date DEFAULT NULL,
  `mobil_pajak` date DEFAULT NULL,
  `validasi` varchar(10) NOT NULL,
  `mobil_kir` varchar(25) NOT NULL,
  `mobil_berlaku_kir` date DEFAULT NULL,
  `mobil_ijin_bongkar` varchar(25) NOT NULL,
  `mobil_berlaku_ijin_bongkar` date DEFAULT NULL,
  `file_foto` varchar(50) NOT NULL,
  `file_stnk` varchar(50) NOT NULL,
  `mobil_stnk` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skb_mobil`
--

INSERT INTO `skb_mobil` (`mobil_no`, `mobil_jenis`, `mobil_max_load`, `status_jalan`, `status_hapus`, `mobil_keterangan`, `merk_id`, `mobil_merk`, `mobil_type`, `mobil_dump`, `mobil_tahun`, `mobil_berlaku`, `mobil_pajak`, `validasi`, `mobil_kir`, `mobil_berlaku_kir`, `mobil_ijin_bongkar`, `mobil_berlaku_ijin_bongkar`, `file_foto`, `file_stnk`, `mobil_stnk`) VALUES
('BE 1 AI', 'Box', 10, 'Tidak Jalan', 'NO', 'mobil hino', 3, 'HINO', 'HI123', 'Tidak', 2015, '2022-04-08', '2021-04-08', 'ACC', 'Kir-BE1AI', '2021-03-22', 'BM-BE1AI', '2021-03-29', '6978385-fresh-fruit-hd-wallpapers.jpg', '6978385-fresh-fruit-hd-wallpapers1.jpg', 'BE 1 AI'),
('BE 1111 Z', 'Sedang(Engkel)', 10, 'Tidak Jalan', 'NO', 'mobil engkel', 4, 'Mitsubishi', 'MI111', 'Ya', 2010, '2023-05-08', '2021-05-08', 'ACC', '87654232', '2021-07-09', '123243456', '2021-11-11', 'Cute_And_Funny.jpg', '1366_768_441015095.jpg', '12324546578'),
('BE 1234 YI', 'Model Wings', 10, 'Tidak Jalan', 'NO', 'mobul baru ok', 5, 'mitsubishi', 'Wing123', 'Ya', 2018, '2021-04-20', '2022-04-20', 'ACC', '123456789', '2021-04-20', '000000000000000', '2021-05-08', '____soon_____by_sonyrootkit-d4s0wlb.jpg', '1366_768_21027243.jpg', '987654321');

-- --------------------------------------------------------

--
-- Table structure for table `skb_paketan`
--

CREATE TABLE `skb_paketan` (
  `paketan_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `jenis_mobil` varchar(50) NOT NULL,
  `paketan_uj` varchar(25) NOT NULL,
  `paketan_tagihan` varchar(25) NOT NULL,
  `paketan_gaji` varchar(25) NOT NULL,
  `paketan_tonase` varchar(25) NOT NULL,
  `paketan_gaji_rumusan` varchar(25) NOT NULL,
  `paketan_keterangan` text NOT NULL,
  `ritase` varchar(10) NOT NULL,
  `paketan_status_hapus` varchar(10) NOT NULL,
  `validasi_paketan` varchar(10) NOT NULL,
  `paketan_data_rute` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skb_paketan`
--

INSERT INTO `skb_paketan` (`paketan_id`, `customer_id`, `jenis_mobil`, `paketan_uj`, `paketan_tagihan`, `paketan_gaji`, `paketan_tonase`, `paketan_gaji_rumusan`, `paketan_keterangan`, `ritase`, `paketan_status_hapus`, `validasi_paketan`, `paketan_data_rute`) VALUES
(1, 30, 'Besar(Tronton)', '5000000', '10000000', '2500000', '0', '0', 'keliling sumatera', 'Ritase', 'NO', 'ACC', '[{"dari":"lampung","ke":"palembang","muatan":"gula"},{"dari":"palembang","ke":"bengkulu","muatan":"gula"},{"dari":"bengkulu","ke":"lampung","muatan":"tebu"}]'),
(2, 30, 'Model Wings', '5500000', '13500000', '0', '10', '4000000', '10 ton ke palembang', 'Tonase', 'NO', 'ACC', '[{"dari":"lampung","ke":"palembang","muatan":"kopi"},{"dari":"palembang","ke":"lampung","muatan":"kopi"}]'),
(3, 31, 'Besar(Tronton)', '15000000', '30000000', '0', '10', '5000000', 'Rute ada 4', 'Tonase', 'NO', 'ACC', '[{"dari":"lampung","ke":"jakarta","muatan":"rokok surya"},{"dari":"jakarta","ke":"bandung","muatan":"rokok mild"},{"dari":"bandung","ke":"jakarta","muatan":"rokok surya"},{"dari":"jakarta","ke":"lampung","muatan":"rokok apa aja"}]'),
(4, 30, 'Box', '242124214', '12321313', '14124124', '0', '0', 'PATENNNN', 'Ritase', 'NO', 'ACC', '[{"dari":"Bandung","ke":"Cibubur","muatan":"Pop Mie"},{"dari":"Kendal","ke":"Surabaya","muatan":"Coklat"}]'),
(5, 30, 'Sedang(Engkel)', '1231223', '123213123', '12312313', '0', '0', 'sdadsa', 'Ritase', 'NO', 'ACC', '[{"dari":"Lampung","ke":"Jepara","muatan":"Coklat"},{"dari":"Ombay","ke":"Popay","muatan":"KokaKola"}]'),
(6, 30, 'Model Wings', '13123232', '12321321', '1232131', '0', '0', 'yoo', 'Ritase', 'NO', 'ACC', '[{"dari":"Jambi","ke":"Lampung ","muatan":"Kopi"},{"dari":"Aceh","ke":"Metro","muatan":"Coklat"}]');

-- --------------------------------------------------------

--
-- Table structure for table `skb_pembayaran_upah`
--

CREATE TABLE `skb_pembayaran_upah` (
  `pembayaran_upah_id` int(11) NOT NULL,
  `supir_id` int(11) NOT NULL,
  `pembayaran_upah_nominal` int(11) NOT NULL,
  `pembayaran_upah_tanggal` date NOT NULL,
  `pembayaran_upah_bonus` int(11) NOT NULL,
  `pembayaran_upah_bon` int(11) NOT NULL,
  `pembayaran_upah_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skb_pembayaran_upah`
--

INSERT INTO `skb_pembayaran_upah` (`pembayaran_upah_id`, `supir_id`, `pembayaran_upah_nominal`, `pembayaran_upah_tanggal`, `pembayaran_upah_bonus`, `pembayaran_upah_bon`, `pembayaran_upah_total`) VALUES
(10, 5, 4000000, '2021-04-09', 100000, 0, 4100000),
(11, 14, 1500000, '2021-04-09', 0, 0, 1500000),
(12, 21, 1500000, '2021-04-09', 500000, 1500000, 500000),
(13, 5, 1000000, '2021-04-09', 150000, 500000, 650000);

-- --------------------------------------------------------

--
-- Table structure for table `skb_rute`
--

CREATE TABLE `skb_rute` (
  `rute_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `rute_dari` varchar(50) NOT NULL,
  `rute_ke` varchar(50) NOT NULL,
  `rute_muatan` varchar(50) NOT NULL,
  `jenis_mobil` varchar(50) NOT NULL,
  `rute_uj_engkel` int(20) NOT NULL,
  `rute_uj_tronton` int(20) NOT NULL,
  `rute_tagihan` int(20) NOT NULL,
  `rute_gaji_engkel` int(20) DEFAULT NULL,
  `rute_gaji_tronton` int(20) DEFAULT NULL,
  `rute_gaji_engkel_rumusan` int(20) DEFAULT NULL,
  `rute_gaji_tronton_rumusan` int(11) DEFAULT NULL,
  `rute_status_hapus` varchar(5) NOT NULL,
  `rute_tonase` varchar(8) NOT NULL,
  `validasi_rute` varchar(10) NOT NULL,
  `rute_keterangan` text NOT NULL,
  `ritase` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skb_rute`
--

INSERT INTO `skb_rute` (`rute_id`, `customer_id`, `rute_dari`, `rute_ke`, `rute_muatan`, `jenis_mobil`, `rute_uj_engkel`, `rute_uj_tronton`, `rute_tagihan`, `rute_gaji_engkel`, `rute_gaji_tronton`, `rute_gaji_engkel_rumusan`, `rute_gaji_tronton_rumusan`, `rute_status_hapus`, `rute_tonase`, `validasi_rute`, `rute_keterangan`, `ritase`) VALUES
(16, 30, 'lampung', 'palembang', 'gula', 'Model Wings', 2000000, 0, 5000000, 1000000, NULL, 0, NULL, 'NO', '0', 'ACC', 'rute baru', 'Ritase'),
(17, 30, 'Palembang', 'Jakarta', 'Tebu', 'Box', 3000000, 0, 7500000, 0, NULL, 1500000, NULL, 'NO', '10', 'ACC', 'ok', 'Tonase'),
(18, 31, 'Gudang Lelang', 'Gudang Metro', 'Rokok', 'Sedang(Engkel)', 3000000, 0, 7500000, 1500000, NULL, 0, NULL, 'NO', '0', 'ACC', 'muatan rokok', 'Ritase');

-- --------------------------------------------------------

--
-- Table structure for table `skb_supir`
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
  `supir_sim` varchar(20) NOT NULL,
  `supir_panggilan` varchar(25) NOT NULL,
  `status_aktif` varchar(25) NOT NULL,
  `supir_tgl_aktif` date DEFAULT NULL,
  `supir_tgl_nonaktif` date DEFAULT NULL,
  `supir_tgl_lahir` date DEFAULT NULL,
  `supir_tempat_lahir` varchar(50) NOT NULL,
  `file_foto` varchar(50) NOT NULL,
  `file_sim` varchar(50) NOT NULL,
  `file_ktp` varchar(50) NOT NULL,
  `darurat_nama` varchar(50) NOT NULL,
  `darurat_telp` varchar(15) NOT NULL,
  `darurat_referensi` varchar(100) NOT NULL,
  `supir_tgl_sim` date DEFAULT NULL,
  `validasi` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skb_supir`
--

INSERT INTO `skb_supir` (`supir_id`, `supir_name`, `supir_kasbon`, `status_jalan`, `status_hapus`, `supir_alamat`, `supir_telp`, `supir_keterangan`, `supir_ktp`, `supir_sim`, `supir_panggilan`, `status_aktif`, `supir_tgl_aktif`, `supir_tgl_nonaktif`, `supir_tgl_lahir`, `supir_tempat_lahir`, `file_foto`, `file_sim`, `file_ktp`, `darurat_nama`, `darurat_telp`, `darurat_referensi`, `supir_tgl_sim`, `validasi`) VALUES
(5, 'Dwiki Martin Prasetya', 0, 'Tidak Jalan', 'NO', 'bandar lampung', '09849858', 'mantap', '123456789000', '987654321', 'dwiki', 'Aktif', '2021-03-29', NULL, '1995-03-02', 'sukarame', '', '', '', 'iqbal', '0896851736', 'galih(teman)', '2021-03-14', 'ACC'),
(14, 'Sasuke', 0, 'Tidak Jalan', 'NO', 'jalan medan merdeka', '089673737373', 'supir medan nihhh', '18710211211331112', '10238120481203102', 'suke', 'Aktif', '2021-03-29', NULL, '1995-11-02', 'metro', '', '', '', 'naruto', '978968757', 'tsunade(teman)', '2021-05-11', 'ACC'),
(15, 'Herby', 0, 'Tidak Jalan', 'NO', 'metro pusta', '1243253', 'mantap\r\n', '12341234', '12412312', 'her', 'Aktif', '2021-03-09', NULL, '1995-05-22', 'Cabang', '', '', '', 'desi', '980906987098', 'rehan(teman)', '2021-07-22', 'ACC'),
(16, 'Rey', 0, 'Tidak Jalan', 'YES', '', '', '', '', '', '', 'Aktif', '2021-03-29', NULL, NULL, '', '', '', '', '', '', '', '0000-00-00', 'ACC'),
(19, 'aldi indrawan', 0, 'Tidak Jalan', 'YES', 'jalan pulau damar', '0895620408193', 'bebas ni orang', '1823123313', '123123123', 'aldi', 'Aktif', '2021-03-29', NULL, '1995-11-12', 'sukarame', '', '', '', 'shanti', '080970980970', 'riski(teman)', '2022-03-31', 'ACC'),
(20, 'riski hermawan', 0, 'Tidak Jalan', 'NO', 'metro', '08969748', 'supur handal', '123456789', '987654321', 'riski', 'Aktif', '2021-03-31', NULL, '1995-01-01', 'sukarame', '20_foto.jpg', '20_sim.jpg', '20_ktp.png', 'noop', '9080980890', 'iwan(teman)\r\n', '2022-03-11', 'ACC'),
(21, 'samingun', 0, 'Tidak Jalan', 'NO', 'jalan melati no 38', '089673736262', 'sesepuh nih guys', '1234567890', '0987654321', 'mingun', 'Aktif', '2021-03-12', NULL, '1980-03-31', 'bandar lampung', '____soon_____by_sonyrootkit-d4s0wlb1.jpg', '1366_768_4410252801.jpg', '6856588-fresh-wallpapers1.jpg', 'aini istigh', '09u0869898687', 'hilda eriya', '2021-07-07', 'ACC');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `akun_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `akun_id`, `username`, `password`) VALUES
(11, 14, 'bhaskara', '7c4a8d09ca3762af61e59520943dc26494f8941b'),
(14, 17, 'aldi12', '7c4a8d09ca3762af61e59520943dc26494f8941b'),
(16, 19, 'shanti12', '7c4a8d09ca3762af61e59520943dc26494f8941b'),
(17, 20, 'supervisor', '7c4a8d09ca3762af61e59520943dc26494f8941b'),
(18, 21, 'supervisor', '0f4d09e43d208d5e9222322fbc7091ceea1a78c3'),
(19, 22, 'hallohallo', '689668308ccb66ff5b9dfb81ff52f94a83c715bd'),
(20, 23, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `skb_akun`
--
ALTER TABLE `skb_akun`
  ADD PRIMARY KEY (`akun_id`);

--
-- Indexes for table `skb_bon`
--
ALTER TABLE `skb_bon`
  ADD PRIMARY KEY (`bon_id`),
  ADD KEY `supir_id` (`supir_id`);

--
-- Indexes for table `skb_customer`
--
ALTER TABLE `skb_customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `skb_invoice`
--
ALTER TABLE `skb_invoice`
  ADD PRIMARY KEY (`invoice_kode`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `skb_job_order`
--
ALTER TABLE `skb_job_order`
  ADD PRIMARY KEY (`Jo_id`),
  ADD KEY `mobil_no` (`mobil_no`),
  ADD KEY `supir_id` (`supir_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `skb_kosongan`
--
ALTER TABLE `skb_kosongan`
  ADD PRIMARY KEY (`kosongan_id`);

--
-- Indexes for table `skb_merk_kendaraan`
--
ALTER TABLE `skb_merk_kendaraan`
  ADD PRIMARY KEY (`merk_id`);

--
-- Indexes for table `skb_mobil`
--
ALTER TABLE `skb_mobil`
  ADD PRIMARY KEY (`mobil_no`);

--
-- Indexes for table `skb_paketan`
--
ALTER TABLE `skb_paketan`
  ADD PRIMARY KEY (`paketan_id`);

--
-- Indexes for table `skb_pembayaran_upah`
--
ALTER TABLE `skb_pembayaran_upah`
  ADD PRIMARY KEY (`pembayaran_upah_id`);

--
-- Indexes for table `skb_rute`
--
ALTER TABLE `skb_rute`
  ADD PRIMARY KEY (`rute_id`);

--
-- Indexes for table `skb_supir`
--
ALTER TABLE `skb_supir`
  ADD PRIMARY KEY (`supir_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `akun_id` (`akun_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `skb_akun`
--
ALTER TABLE `skb_akun`
  MODIFY `akun_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `skb_bon`
--
ALTER TABLE `skb_bon`
  MODIFY `bon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `skb_customer`
--
ALTER TABLE `skb_customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `skb_job_order`
--
ALTER TABLE `skb_job_order`
  MODIFY `Jo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
--
-- AUTO_INCREMENT for table `skb_kosongan`
--
ALTER TABLE `skb_kosongan`
  MODIFY `kosongan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `skb_merk_kendaraan`
--
ALTER TABLE `skb_merk_kendaraan`
  MODIFY `merk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `skb_paketan`
--
ALTER TABLE `skb_paketan`
  MODIFY `paketan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `skb_pembayaran_upah`
--
ALTER TABLE `skb_pembayaran_upah`
  MODIFY `pembayaran_upah_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `skb_rute`
--
ALTER TABLE `skb_rute`
  MODIFY `rute_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `skb_supir`
--
ALTER TABLE `skb_supir`
  MODIFY `supir_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `skb_bon`
--
ALTER TABLE `skb_bon`
  ADD CONSTRAINT `skb_bon_ibfk_1` FOREIGN KEY (`supir_id`) REFERENCES `skb_supir` (`supir_id`);

--
-- Constraints for table `skb_invoice`
--
ALTER TABLE `skb_invoice`
  ADD CONSTRAINT `skb_invoice_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `skb_customer` (`customer_id`);

--
-- Constraints for table `skb_job_order`
--
ALTER TABLE `skb_job_order`
  ADD CONSTRAINT `skb_job_order_ibfk_1` FOREIGN KEY (`mobil_no`) REFERENCES `skb_mobil` (`mobil_no`),
  ADD CONSTRAINT `skb_job_order_ibfk_2` FOREIGN KEY (`supir_id`) REFERENCES `skb_supir` (`supir_id`),
  ADD CONSTRAINT `skb_job_order_ibfk_3` FOREIGN KEY (`customer_id`) REFERENCES `skb_customer` (`customer_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`akun_id`) REFERENCES `skb_akun` (`akun_id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
