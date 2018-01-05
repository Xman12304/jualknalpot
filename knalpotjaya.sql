-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2017 at 04:46 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `knalpotjaya`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kd_barang` varchar(20) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `jumlah_barang` varchar(30) NOT NULL,
  `harga_barang` varchar(30) NOT NULL,
  `tgl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kd_barang`, `nama_barang`, `jumlah_barang`, `harga_barang`, `tgl`) VALUES
('BRG000', 'knalpot ultima', '3', '240.000', '2017-12-18'),
('BRG001', 'resonator ultra', '3', '230.000', '2017-12-18'),
('BRG002', 'knalpot stunex', '3', '320.000', '2017-12-18'),
('BRG003', 'knalpot custom', '2', '250.000', '2017-12-18');

-- --------------------------------------------------------

--
-- Table structure for table `bukti_transaksi`
--

CREATE TABLE `bukti_transaksi` (
  `kd_pembelian` varchar(30) NOT NULL,
  `kd_pelanggan` varchar(30) NOT NULL,
  `nopol_pelanggan` varchar(30) NOT NULL,
  `merk_mobil` varchar(30) NOT NULL,
  `tgl_pembelian` varchar(30) NOT NULL,
  `total_pembelian` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detil_pembelian`
--

CREATE TABLE `detil_pembelian` (
  `kd_detilpembelian` int(11) NOT NULL,
  `kd_pelanggan` varchar(20) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `harga_satuan` varchar(20) NOT NULL,
  `harga_pemasangan` varchar(20) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `jml_beli` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `detil_pembelian`
--

INSERT INTO `detil_pembelian` (`kd_detilpembelian`, `kd_pelanggan`, `nama_barang`, `harga_satuan`, `harga_pemasangan`, `tgl_pembelian`, `jml_beli`) VALUES
(25, 'PL000', 'BRG000', '240.000', '300.000', '2017-12-18', '2'),
(26, 'PL000', 'BRG002', '320.000', '300.000', '2017-12-18', '3'),
(28, 'PL001', 'BRG002', '320.000', '300.000', '2017-12-18', '1'),
(29, 'PL001', 'BRG001', '230.000', '300.000', '2017-12-18', '1'),
(31, 'PL002', 'BRG000', '240.000', '300.000', '2017-12-18', '2'),
(32, 'PL002', 'BRG001', '230.000', '300.000', '2017-12-18', '1');

--
-- Triggers `detil_pembelian`
--
DELIMITER $$
CREATE TRIGGER `stok_update` AFTER INSERT ON `detil_pembelian` FOR EACH ROW BEGIN 
UPDATE barang SET jumlah_barang=jumlah_barang-NEW.jml_beli
WHERE kd_barang=NEW.nama_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `kd_keranjang` int(11) NOT NULL,
  `kd_pelanggan` varchar(20) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `harga_satuan` varchar(20) NOT NULL,
  `harga_pemasangan` varchar(20) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `jml_beli` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`kd_keranjang`, `kd_pelanggan`, `nama_barang`, `harga_satuan`, `harga_pemasangan`, `tgl_pembelian`, `jml_beli`) VALUES
(1, 'PL003', 'BRG002', '320.000', '300.000', '2017-12-19', '1');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `kd_pegawai` varchar(30) NOT NULL,
  `namapegawai` varchar(30) NOT NULL,
  `alamat` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`kd_pegawai`, `namapegawai`, `alamat`) VALUES
('PG000', 'doni sujiwo', 'karang tengah'),
('PG001', 'rian', 'jl.ciledug');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `kd_pelanggan` varchar(30) NOT NULL,
  `nama_pelanggan` varchar(40) NOT NULL,
  `nopol_pelanggan` varchar(20) NOT NULL,
  `merk_mobil` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`kd_pelanggan`, `nama_pelanggan`, `nopol_pelanggan`, `merk_mobil`) VALUES
('PL000', 'fauzan hadi', 'b 2543 ve', 'yaris '),
('PL001', 'tita', 'b 6542 cx', 'camry'),
('PL002', 'andika', 'b 5643 ve', 'yaris ');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `kd_pembelian` varchar(30) NOT NULL,
  `kd_pelanggan` varchar(30) NOT NULL,
  `tgl_pembelian` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`kd_pembelian`, `kd_pelanggan`, `tgl_pembelian`) VALUES
('TR000', 'PL000', '2017-12-18'),
('TR001', 'PL001', '2017-12-18'),
('TR002', 'PL002', '2017-12-18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kd_barang`);

--
-- Indexes for table `detil_pembelian`
--
ALTER TABLE `detil_pembelian`
  ADD PRIMARY KEY (`kd_detilpembelian`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`kd_keranjang`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`kd_pegawai`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`kd_pelanggan`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`kd_pembelian`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detil_pembelian`
--
ALTER TABLE `detil_pembelian`
  MODIFY `kd_detilpembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `kd_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
