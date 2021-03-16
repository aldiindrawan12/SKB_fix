-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2021 at 01:27 PM
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
(14, 'Rizki Bhaskara', 'Super User', '["1","1","1","1","1"]'),
(17, 'aldi indrawan aja', 'Operator', '["0","0","1","1","0"]');

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
(1, 3600000, 'Pembayaran', '2021-03-11 02:42:06', 'lunas', 5),
(2, 500000, 'Pengajuan', '2021-03-11 19:38:18', 'minjem untuk jalan-jalan', 5);

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
  `customer_bank` varchar(25) NOT NULL,
  `customer_rekening` int(25) NOT NULL,
  `customer_AN` varchar(50) NOT NULL,
  `status_hapus` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skb_customer`
--

INSERT INTO `skb_customer` (`customer_id`, `customer_name`, `customer_alamat`, `customer_kontak_person`, `customer_telp`, `customer_keterangan`, `customer_bank`, `customer_rekening`, `customer_AN`, `status_hapus`) VALUES
(1, 'PT.Gula ku', '', '', '', '', '', 0, '', 'YES'),
(2, 'PT.Gink', '', '', '', '', '', 0, '', 'No'),
(3, 'PT.Gudang Garam', '', '', '', '', '', 0, '', 'No'),
(4, 'PT.AISPS', '', '', '', '', '', 0, '', 'YES'),
(5, 'PT.Philip LPG', '', '', '', '', '', 0, '', 'No'),
(6, 'PT.Jaya Bakery', '', '', '', '', '', 0, '', 'No'),
(7, 'PT.Rumah Kayu', '', '', '', '', '', 0, '', 'No'),
(8, 'PT.SMANLA', '', '', '', '', '', 0, '', 'No'),
(9, 'Toko Adel', '', '', '', '', '', 0, '', 'No'),
(10, 'Wood Steirs', '', '', '', '', '', 0, '', 'No'),
(11, 'Toko Buku Dioni', '', '', '', '', '', 0, '', 'No'),
(12, 'Grosir Iyuz', 'jalan pulau damar ', 'iyuz', '089562372136', 'gorsiran', 'BRI', 2147483647, 'Iyuz SUjana', 'YES'),
(14, 'PT Maju Terang', '', '', '', '', '', 0, '', 'YES'),
(21, 'Mutia Kece', 'Metro Pusat', 'Mutia', '0895232323', 'dari metro', 'BRI', 123456789, 'Mutia Nazila', 'YES'),
(23, 'pt taman indah', 'jalan pulau damar', 'aldi ', '0895620408193', 'bidang taman', 'bri', 2147483647, 'aldi indrawan', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `skb_invoice`
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
-- Dumping data for table `skb_invoice`
--

INSERT INTO `skb_invoice` (`invoice_kode`, `jo_id`, `customer_id`, `tanggal_invoice`, `batas_pembayaran`, `grand_total`, `total`, `ppn`, `status_bayar`) VALUES
(40, 1, 1, '2021-03-10', '2021-04-09', 2750000, 2500000, 250000, 'Lunas'),
(41, 2, 1, '2021-03-11', '2021-04-10', 1650000, 1500000, 150000, 'Lunas');

-- --------------------------------------------------------

--
-- Table structure for table `skb_job_order`
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
  `keterangan` text,
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
-- Dumping data for table `skb_job_order`
--

INSERT INTO `skb_job_order` (`Jo_id`, `mobil_no`, `supir_id`, `muatan`, `asal`, `tujuan`, `uang_jalan`, `terbilang`, `tanggal_surat`, `tanggal_bongkar`, `tonase`, `satuan`, `keterangan`, `harga/kg`, `upah`, `biaya_lain`, `Keterangan_biaya_lain`, `customer_id`, `status`, `bonus`, `status_upah`) VALUES
(1, 'BE 1211 AI', 5, 'gula pasir', 'riau', 'lampung', 2500000, ' Dua Juta Lima Ratus  Ribu  Rupiah', '2021-03-10', '2021-03-10', 25, 'peti', '<strong>Catatan JO : </strong>lewat jalan tol ya ki<br><strong>Catatan Konfirmasi : </strong>mantap', 100000, 1000000, 0, '', 1, 'Sampai Tujuan', 100000, 'Sudah Dibayar'),
(2, 'BE 2213 AA', 5, 'tebu batang', 'sukadana', 'bandar lampung', 500000, ' Lima Ratus  Ribu  Rupiah', '2021-03-10', '2021-03-11', 10, 'ton', '<strong>Catatan JO : </strong>hati-hati begal<br><strong>Catatan Konfirmasi : </strong>mantap', 150000, 250000, 0, '', 1, 'Sampai Tujuan', 50000, 'Sudah Dibayar');

-- --------------------------------------------------------

--
-- Table structure for table `skb_mobil`
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
-- Dumping data for table `skb_mobil`
--

INSERT INTO `skb_mobil` (`mobil_no`, `mobil_jenis`, `mobil_max_load`, `status_jalan`, `status_hapus`, `mobil_keterangan`, `mobil_merk`, `mobil_type`, `mobil_dump`, `mobil_tahun`, `mobil_berlaku`, `mobil_pajak`) VALUES
('BE 1211 AI', 'Besar(Tronton)', 10, 'Tidak Jalan', 'YES', 'mana ni mobil', 'SAN', '123SAN', 'Tidak', 2015, '2021-03-31', '2023-03-31'),
('be 1234 aa', 'Besar(Tronton)', 10, 'Tidak Jalan', 'YES', 'mantap', 'hino', '123hino', 'Ya', 2011, '2021-05-15', '2022-05-15'),
('BE 1510 YY', 'Sedang(Engkel)', 7, 'Tidak Jalan', 'YES', '', 'Mitsubishi', 'AA324', 'Ya', 2010, '2021-03-20', '2024-03-20'),
('BE 2213 AA', 'Sedang(Engkel)', 3, 'Tidak Jalan', 'YES', 'Sipp\r\n', 'Mitsubishi', 'MIS123', 'Ya', 2017, '2021-03-13', '2021-03-20'),
('BE 3322 AS', 'Besar(Tronton)', 10, 'Tidak Jalan', 'YES', '', 'HINO', '999HINO', 'Tidak', 2015, NULL, NULL),
('BE 3422 YI', 'Sedang(Engkel)', 2, 'Tidak Jalan', 'YES', '', 'Xenia', '11Xe', 'Ya', 2012, NULL, NULL),
('BE 4321 YI', 'Besar(Tronton)', 16, 'Tidak Jalan', 'YES', 'Pa10', 'Hino', 'HINO123', 'Ya', 2019, '2021-03-20', '2021-08-21'),
('BE 4566 FA', 'Besar(Tronton)', 20, 'Tidak Jalan', 'NO', '', 'Mitsubishi', '123MIS', 'Tidak', 2014, NULL, NULL),
('BE 5530 PQ', 'Besar(Tronton)', 10, 'Tidak Jalan', 'YES', '', 'SAN', '111SAN', 'Tidak', 2015, NULL, NULL),
('BE 999 RB', 'Besar(Tronton)', 99, 'Tidak Jalan', 'NO', 'P10 ', 'Lamborghini', 'Sports Car', 'Tidak', 2025, '2030-07-26', '2030-08-23'),
('BE 9999 ZZ', 'Besar(Tronton)', 15, 'Tidak Jalan', 'NO', 'mobil baru', 'Hino', '123Hino', 'Ya', 2019, '2021-12-23', '2024-12-23'),
('BG 6543 DD', 'Sedang(Engkel)', 4, 'Tidak Jalan', 'NO', '', 'HINO', '11HINO', 'Ya', 2009, NULL, NULL),
('RI 1', 'Sedang(Engkel)', 60, 'Tidak Jalan', 'NO', 'Mobil Pak Pres', 'LEXUS', 'Sedan', 'Ya', 2099, '2022-02-09', '2021-04-10');

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
  `rute_uj_engkel` int(20) NOT NULL,
  `rute_uj_tronton` int(20) NOT NULL,
  `rute_tagihan` int(20) NOT NULL,
  `rute_gaji_engkel` int(20) NOT NULL,
  `rute_gaji_tronton` int(20) NOT NULL,
  `rute_gaji_rumusan` int(20) NOT NULL,
  `rute_status_hapus` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skb_rute`
--

INSERT INTO `skb_rute` (`rute_id`, `customer_id`, `rute_dari`, `rute_ke`, `rute_muatan`, `rute_uj_engkel`, `rute_uj_tronton`, `rute_tagihan`, `rute_gaji_engkel`, `rute_gaji_tronton`, `rute_gaji_rumusan`, `rute_status_hapus`) VALUES
(1, 1, 'gudang lampung', 'gudang palembang', 'gula', 1500000, 1750000, 5000000, 500000, 750000, 0, 'YES'),
(2, 3, 'gudang jakarta', 'gudang lampung', 'rokok ', 1500000, 2000000, 0, 500000, 1000000, 0, 'YES'),
(3, 1, 'gudang bandung', 'gudang lampung', 'gula', 2000000, 2500000, 0, 1000000, 1500000, 0, 'YES'),
(4, 1, 'gudang lampung', 'gudang bekasi', 'gula', 1500000, 2000000, 0, 750000, 1000000, 0, 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `skb_satuan`
--

CREATE TABLE `skb_satuan` (
  `satuan_id` int(11) NOT NULL,
  `satuan_name` varchar(50) NOT NULL,
  `satuan_simbol` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skb_satuan`
--

INSERT INTO `skb_satuan` (`satuan_id`, `satuan_name`, `satuan_simbol`) VALUES
(1, 'tonase', 'ton'),
(2, 'peti', 'peti'),
(3, 'kardus', 'kardus'),
(4, 'kubik', 'kubik');

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
  `supir_sim` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skb_supir`
--

INSERT INTO `skb_supir` (`supir_id`, `supir_name`, `supir_kasbon`, `status_jalan`, `status_hapus`, `supir_alamat`, `supir_telp`, `supir_keterangan`, `supir_ktp`, `supir_sim`) VALUES
(5, 'Dwiki Martin Prasetya', 200000, 'Tidak Jalan', 'YES', 'bandar lampung', '09849858', 'mantap', '123456789000', '987654321'),
(14, 'Sasuke', 0, 'Tidak Jalan', 'YES', '', '', '', '', ''),
(15, 'Herby', 1000000, 'Tidak Jalan', 'YES', 'metro pusta', '1243253', 'mantap\r\n', '12341234324', '12412312'),
(16, 'Rey', 0, 'Tidak Jalan', 'YES', '', '', '', '', ''),
(19, 'aldi indrawan', 0, 'Tidak Jalan', 'YES', 'jalan pulau damar', '0895620408193', 'bebas ni orang', '1823123313', '123123123'),
(20, 'Bolang', 0, 'Tidak Jalan', 'YES', 'Jalan Wall Street Boulevard', '10021', 'Pa10', '12313132', '132132'),
(21, 'Dakocan', 0, 'Tidak Jalan', 'NO', 'Broadway Street', '08119999999', 'hehe\r\n', '13246578', '156165654'),
(22, 'Pardy', 0, 'Tidak Jalan', 'NO', 'Wall Street', '0555555', 'Hehe\r\n', '1231321321', '54654564');

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
(14, 17, 'aldi12', '7c4a8d09ca3762af61e59520943dc26494f8941b');

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
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `jo_id` (`jo_id`);

--
-- Indexes for table `skb_job_order`
--
ALTER TABLE `skb_job_order`
  ADD PRIMARY KEY (`Jo_id`),
  ADD KEY `mobil_no` (`mobil_no`),
  ADD KEY `supir_id` (`supir_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `skb_mobil`
--
ALTER TABLE `skb_mobil`
  ADD PRIMARY KEY (`mobil_no`);

--
-- Indexes for table `skb_rute`
--
ALTER TABLE `skb_rute`
  ADD PRIMARY KEY (`rute_id`);

--
-- Indexes for table `skb_satuan`
--
ALTER TABLE `skb_satuan`
  ADD PRIMARY KEY (`satuan_id`);

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
  MODIFY `akun_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `skb_bon`
--
ALTER TABLE `skb_bon`
  MODIFY `bon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `skb_customer`
--
ALTER TABLE `skb_customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `skb_invoice`
--
ALTER TABLE `skb_invoice`
  MODIFY `invoice_kode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `skb_job_order`
--
ALTER TABLE `skb_job_order`
  MODIFY `Jo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
--
-- AUTO_INCREMENT for table `skb_rute`
--
ALTER TABLE `skb_rute`
  MODIFY `rute_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `skb_satuan`
--
ALTER TABLE `skb_satuan`
  MODIFY `satuan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `skb_supir`
--
ALTER TABLE `skb_supir`
  MODIFY `supir_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
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
  ADD CONSTRAINT `skb_invoice_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `skb_customer` (`customer_id`),
  ADD CONSTRAINT `skb_invoice_ibfk_2` FOREIGN KEY (`jo_id`) REFERENCES `skb_job_order` (`Jo_id`);

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
