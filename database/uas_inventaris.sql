-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2020 at 11:56 PM
-- Server version: 10.1.39-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uas_inventaris`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `no` int(20) NOT NULL,
  `kodebarang` varchar(20) NOT NULL,
  `namabarang` varchar(20) NOT NULL,
  `kodemerk` int(11) NOT NULL,
  `kodejenis` int(11) DEFAULT NULL,
  `jumlah` varchar(20) NOT NULL,
  `harga` varchar(20) NOT NULL,
  `kondisi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`no`, `kodebarang`, `namabarang`, `kodemerk`, `kodejenis`, `jumlah`, `harga`, `kondisi`) VALUES
(1, 'P100', 'Printer', 2, 1, '10', '2.575.000', 'Normal'),
(2, 'LG201', 'AC 1PK', 4, 1, '3', '6.000.000', 'Baik'),
(3, 'LN001', 'Komputer Desktop', 3, 1, '50', '4.650.000', 'Baru'),
(4, 'ST0201', 'Terminal listrik', 5, 1, '100', '175.000', 'Baik'),
(5, 'IP310', 'Laptop', 3, 1, '2', '6.500.000', '1 Batre Rusak'),
(6, 'LM101', 'Lemari Buku', 6, 2, '33', '5.700.000', 'Masih layak pakai'),
(7, 'D2000', 'Camera DSLR', 1, 1, '1', '9.800.000', 'Lensa kotor');

-- --------------------------------------------------------

--
-- Table structure for table `barangmasuk`
--

CREATE TABLE `barangmasuk` (
  `no` int(20) NOT NULL,
  `kodebarang` varchar(20) NOT NULL,
  `jumlah` varchar(20) NOT NULL,
  `tanggalmasuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `barangmasuk`
--

INSERT INTO `barangmasuk` (`no`, `kodebarang`, `jumlah`, `tanggalmasuk`) VALUES
(1, 'LN001', '150', '2016-12-06'),
(2, 'LG201', '3', '2017-05-01'),
(3, 'LM101', '32', '2010-06-17'),
(4, 'ST0201', '100', '2018-12-10'),
(5, 'P100', '10', '2019-04-20'),
(6, 'D2000', '1', '2010-05-02'),
(7, 'IP310', '2', '2016-08-15');

-- --------------------------------------------------------

--
-- Table structure for table `jenisbarang`
--

CREATE TABLE `jenisbarang` (
  `kodejenis` int(20) NOT NULL,
  `namajenis` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `jenisbarang`
--

INSERT INTO `jenisbarang` (`kodejenis`, `namajenis`) VALUES
(1, 'Elektronik'),
(2, 'Meubelair');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(50) NOT NULL,
  `link` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `main_menu` varchar(11) NOT NULL,
  `level` enum('admin','user') NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `link`, `icon`, `main_menu`, `level`) VALUES
(1, 'Menu Utama', 'admin', '', '0', 'admin'),
(10, 'User', 'users', 'fa fa-user', '13', 'user'),
(11, 'Menu', 'menu', 'fa fa-eye', '13', 'admin'),
(12, 'DATA ', '#', 'fa fa-folder', '0', 'admin'),
(13, 'SETING', '#', 'fa fa-gear', '0', 'admin'),
(28, 'Barang', 'barang', 'fa fa-desktop', '12', 'admin'),
(29, 'Jenis Barang', 'jenisbarang', 'fa fa-bars', '12', 'admin'),
(30, 'Merk', 'Merk', 'fa fa-tags', '12', 'admin'),
(31, 'Barang Masuk', 'barangmasuk', 'fa fa-share', '12', 'admin'),
(32, 'Peminjaman', 'peminjaman', 'fa fa-external-link', '12', 'admin'),
(33, 'LOG OUT', '#', 'fa fa-sign-out', '0', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `merk`
--

CREATE TABLE `merk` (
  `kodemerk` int(20) NOT NULL,
  `namamerk` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `merk`
--

INSERT INTO `merk` (`kodemerk`, `namamerk`) VALUES
(1, 'Canon'),
(2, 'Epson'),
(3, 'Lenovo'),
(4, 'LG'),
(5, 'Broco'),
(6, 'Kayu Jati');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `no` int(11) NOT NULL,
  `namapeminjam` varchar(70) NOT NULL,
  `idpeminjam` varchar(40) DEFAULT NULL,
  `kodebarang` varchar(20) NOT NULL,
  `tanggalpeminjaman` varchar(20) NOT NULL,
  `kondisisebelum` varchar(50) NOT NULL,
  `kondisisesudah` varchar(50) NOT NULL,
  `keterangan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`no`, `namapeminjam`, `idpeminjam`, `kodebarang`, `tanggalpeminjaman`, `kondisisebelum`, `kondisisesudah`, `keterangan`) VALUES
(1, 'Budi Daryanto', '3273001', 'ST0201', '20-02-2020', 'Baik', 'Baik', 'Sudah dikembalikan'),
(2, 'Dudi Irawan', '3273002', 'P100', '20-04-2020', 'Normal', 'Tinta warna hitam habis', 'Sudah dikembalikan'),
(3, 'Saryanto', '3273003', 'IP310', '20-01-2020', 'Normal', 'Kena virus, harus install ulang', 'Belum dikembalikan');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `level` enum('admin','user') NOT NULL DEFAULT 'user',
  `blokir` enum('N','Y') NOT NULL DEFAULT 'N',
  `id_sessions` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `email`, `level`, `blokir`, `id_sessions`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'irpan.budiana@gmail.com', 'admin', 'N', '21232f297a57a5a743894a0e4a801fc3'),
('user1', 'e10adc3949ba59abbe56e057f20f883e', 'user1@gmail.com', 'admin', 'N', 'e10adc3949ba59abbe56e057f20f883e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`no`) USING BTREE,
  ADD KEY `kodemerk` (`kodemerk`) USING BTREE,
  ADD KEY `kodejenis` (`kodejenis`) USING BTREE,
  ADD KEY `kodebarang` (`kodebarang`) USING BTREE;

--
-- Indexes for table `barangmasuk`
--
ALTER TABLE `barangmasuk`
  ADD PRIMARY KEY (`no`) USING BTREE,
  ADD KEY `kodebarang` (`kodebarang`) USING BTREE;

--
-- Indexes for table `jenisbarang`
--
ALTER TABLE `jenisbarang`
  ADD PRIMARY KEY (`kodejenis`) USING BTREE;

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`) USING BTREE;

--
-- Indexes for table `merk`
--
ALTER TABLE `merk`
  ADD PRIMARY KEY (`kodemerk`) USING BTREE;

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`no`) USING BTREE,
  ADD KEY `kodebarang` (`kodebarang`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `no` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jenisbarang`
--
ALTER TABLE `jenisbarang`
  MODIFY `kodejenis` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `merk`
--
ALTER TABLE `merk`
  MODIFY `kodemerk` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`kodemerk`) REFERENCES `merk` (`kodemerk`),
  ADD CONSTRAINT `barang_ibfk_2` FOREIGN KEY (`kodejenis`) REFERENCES `jenisbarang` (`kodejenis`);

--
-- Constraints for table `barangmasuk`
--
ALTER TABLE `barangmasuk`
  ADD CONSTRAINT `barangmasuk_ibfk_1` FOREIGN KEY (`kodebarang`) REFERENCES `barang` (`kodebarang`);

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`kodebarang`) REFERENCES `barang` (`kodebarang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
