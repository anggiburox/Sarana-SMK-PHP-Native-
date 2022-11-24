-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2019 at 04:40 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `inventaris`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
  `id_barang` char(15) NOT NULL,
  `nama_barang` char(50) NOT NULL,
  `spesifikasi` char(50) NOT NULL,
  `lokasi` char(50) NOT NULL,
  `kondisi` char(50) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `sumber_dana` char(50) NOT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `spesifikasi`, `lokasi`, `kondisi`, `jumlah_barang`, `sumber_dana`) VALUES
('IB001', 'Meja', 'SNI', 'Gudang', 'Baik', 517, 'Sekolah'),
('IB002', 'Kursi', 'SNI', 'Gudang', 'Baik', 267, 'Sekolah'),
('IB003', 'Infocus', 'SNI', 'Gudang', 'Baik', 99, 'Sekolah'),
('IB004', 'Bola basket', 'SNI', 'Gudang', 'Baik', 97, 'Bos'),
('IB005', 'Bola sepak', 'SNI', 'Gudang', 'Baik', 96, 'Bos');

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE IF NOT EXISTS `barang_keluar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` char(15) NOT NULL,
  `tgl_keluar` date NOT NULL,
  `jml_keluar` int(11) NOT NULL,
  `lokasi` char(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id`, `id_barang`, `tgl_keluar`, `jml_keluar`, `lokasi`) VALUES
(21, 'IB001', '2019-04-06', 33, 'XII RPL 2'),
(22, 'IB002', '2019-04-06', 33, 'XII RPL 2');

--
-- Triggers `barang_keluar`
--
DROP TRIGGER IF EXISTS `tg_barang_keluar`;
DELIMITER //
CREATE TRIGGER `tg_barang_keluar` AFTER INSERT ON `barang_keluar`
 FOR EACH ROW begin
update barang set jumlah_barang = jumlah_barang-NEW.jml_keluar 
WHERE barang.id_barang=NEW.id_barang;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE IF NOT EXISTS `barang_masuk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` char(15) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `jml_masuk` int(11) NOT NULL,
  `id_suplier` char(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id`, `id_barang`, `tgl_masuk`, `jml_masuk`, `id_suplier`) VALUES
(13, 'IB001', '2019-04-06', 50, 'IS001'),
(14, 'IB002', '2019-04-06', 50, 'IS001');

--
-- Triggers `barang_masuk`
--
DROP TRIGGER IF EXISTS `tg_kurang_stok_barang`;
DELIMITER //
CREATE TRIGGER `tg_kurang_stok_barang` AFTER DELETE ON `barang_masuk`
 FOR EACH ROW begin
update barang set jumlah_barang = jumlah_barang-OLD.jml_masuk
where barang.id_barang=OLD.id_barang;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `tg_tambah_stok_barang_masuk`;
DELIMITER //
CREATE TRIGGER `tg_tambah_stok_barang_masuk` AFTER INSERT ON `barang_masuk`
 FOR EACH ROW begin
update barang set jumlah_barang = jumlah_barang+NEW.jml_masuk WHERE id_barang=NEW.id_barang;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `detail_pinjam_barang`
--

CREATE TABLE IF NOT EXISTS `detail_pinjam_barang` (
  `id_detail` char(25) NOT NULL,
  `id_pinjam` char(25) NOT NULL,
  `id_peminjam` char(15) NOT NULL,
  `id_barang` char(25) NOT NULL,
  `jumlah` int(11) NOT NULL,
  PRIMARY KEY (`id_detail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pinjam_barang`
--

INSERT INTO `detail_pinjam_barang` (`id_detail`, `id_pinjam`, `id_peminjam`, `id_barang`, `jumlah`) VALUES
('ID001', 'IP001', 'PM001', 'IB004', 1),
('ID002', 'IP002', 'PM001', 'IB005', 3),
('ID003', 'IP003', 'PM002', 'IB004', 3),
('ID004', 'IP004', 'PM002', 'IB005', 1),
('ID005', 'IP005', 'PM003', 'IB003', 1);

--
-- Triggers `detail_pinjam_barang`
--
DROP TRIGGER IF EXISTS `tg_kurang_stok_pinjam_barang`;
DELIMITER //
CREATE TRIGGER `tg_kurang_stok_pinjam_barang` AFTER INSERT ON `detail_pinjam_barang`
 FOR EACH ROW begin
update barang set jumlah_barang = jumlah_barang-NEW.jumlah
where barang.id_barang=NEW.id_barang;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE IF NOT EXISTS `lokasi` (
  `lokasi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`lokasi`) VALUES
('X RPL 1'),
('X RPL 2'),
('X RPL 3'),
('X RPL 4'),
('X RPL 5'),
('X AKT 1'),
('X AKT 2'),
('X AKT 3'),
('X AKT 4'),
('X DKV 1'),
('X DKV 2'),
('X ANM 1'),
('XII RPL 2');

-- --------------------------------------------------------

--
-- Table structure for table `peminjam`
--

CREATE TABLE IF NOT EXISTS `peminjam` (
  `id_peminjam` char(15) NOT NULL,
  `nama_peminjam` varchar(100) NOT NULL,
  `no_tlp` char(15) NOT NULL,
  `lokasi` char(50) NOT NULL,
  PRIMARY KEY (`id_peminjam`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminjam`
--

INSERT INTO `peminjam` (`id_peminjam`, `nama_peminjam`, `no_tlp`, `lokasi`) VALUES
('PM001', 'Anggi', '0891-2316-3816', 'XII RPL 2'),
('PM002', 'Agung', '0898-9812-8328', 'X DKV 2'),
('PM003', 'Aan', '0896-6237-6125', 'X RPL 1');

-- --------------------------------------------------------

--
-- Table structure for table `pinjam_barang`
--

CREATE TABLE IF NOT EXISTS `pinjam_barang` (
  `id_pinjam` char(25) NOT NULL,
  `id_peminjam` char(25) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` char(25) NOT NULL,
  `status` char(25) NOT NULL,
  PRIMARY KEY (`id_pinjam`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pinjam_barang`
--

INSERT INTO `pinjam_barang` (`id_pinjam`, `id_peminjam`, `tgl_pinjam`, `tgl_kembali`, `status`) VALUES
('IP001', 'PM001', '2019-04-06', '07.04.2019', 'Sudah dikembalikan'),
('IP002', 'PM001', '2019-04-06', '07.04.2019', 'Dipinjam'),
('IP003', 'PM002', '2019-04-06', '07.04.2019', 'Dipinjam'),
('IP004', 'PM002', '2019-04-06', '07.04.2019', 'Dipinjam'),
('IP005', 'PM003', '2019-04-06', '07.04.2019', 'Dipinjam');

-- --------------------------------------------------------

--
-- Table structure for table `suplier`
--

CREATE TABLE IF NOT EXISTS `suplier` (
  `id_suplier` varchar(50) NOT NULL,
  `nama_suplier` varchar(100) NOT NULL,
  `alamat_suplier` text NOT NULL,
  `telp_suplier` varchar(12) NOT NULL,
  PRIMARY KEY (`id_suplier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suplier`
--

INSERT INTO `suplier` (`id_suplier`, `nama_suplier`, `alamat_suplier`, `telp_suplier`) VALUES
('IS001', 'Aan Nurjaman', 'Rancaekek', '0898-9862-37'),
('IS002', 'Gunawan', 'Cileunyi', '0887-6757-35');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `level`) VALUES
('IU001', 'Anggi Dwi S', 'anggi', 'admin', 'Admin'),
('IU002', 'Bagus Budi W', 'bagus', 'petugas', 'Petugas');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
