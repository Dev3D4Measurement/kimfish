-- phpMyAdmin SQL Dump
-- version 3.1.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 16, 2017 at 04:45 PM
-- Server version: 5.1.35
-- PHP Version: 5.2.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_cvseamalaka`
--

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE IF NOT EXISTS `berita` (
  `id_berita` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `judul_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `isi_berita` text COLLATE latin1_general_ci NOT NULL,
  `hari` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `dibaca` int(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_berita`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id_berita`, `username`, `judul`, `judul_seo`, `isi_berita`, `hari`, `tanggal`, `jam`, `gambar`, `dibaca`) VALUES
(1, 'admin', 'Harga Ikan Melambung Tinggi Oktober 2017', 'harga-ikan-melambung-tinggi-oktober-2017', 'Ketikkan isi berita disini...\r\n', 'Rabu', '2017-09-06', '06:39:10', '28ikan.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `carapemesanan`
--

CREATE TABLE IF NOT EXISTS `carapemesanan` (
  `id_pemesanan` int(5) NOT NULL AUTO_INCREMENT,
  `pemesanan` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_pemesanan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `carapemesanan`
--

INSERT INTO `carapemesanan` (`id_pemesanan`, `pemesanan`) VALUES
(1, '<ol>\r\n	<span class="center_content2">\r\n	<li>Klik pada tombol&nbsp;<span style="font-weight: bold">Beli</span> pada produk(ikan) yang ingin Anda pesan.</li>\r\n	<li>Produk(ikan) yang Anda pesan akan masuk ke dalam <span style="font-weight: bold">Keranjang Belanja</span>. Anda dapat melakukan perubahan jumlah produk yang diinginkan dengan mengganti angka di kolom <span style="font-weight: bold">Jumlah</span>, kemudian klik tombol <span style="font-weight: bold">Update</span>. Sedangkan untuk menghapus sebuah produk(ikan) dari Keranjang Belanja, klik tombol Kali yang berada di kolom paling kanan.</li>\r\n	<li>Jika sudah selesai, klik tombol <span style="font-weight: bold">Selesai Belanja</span>, maka akan tampil form untuk pengisian data kustomer/pembeli.</li>\r\n	<li>Setelah data pembeli selesai diisikan, klik tombol <span style="font-weight: bold">Proses</span>,\r\n	maka akan tampil data pembeli beserta produk yang dipesannya (jika \r\n	diperlukan catat nomor ordernya). Juga ada total pembayaran serta \r\n	nomor rekening pembayaran.</li>\r\n	<li>Apabila telah melakukan pembayaran, maka produk/barang akan segera kami kirimkan. </li></span>\r\n</ol>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `download`
--

CREATE TABLE IF NOT EXISTS `download` (
  `id_download` int(5) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `nama_file` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_posting` date NOT NULL,
  `hits` int(3) NOT NULL,
  PRIMARY KEY (`id_download`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `download`
--


-- --------------------------------------------------------

--
-- Table structure for table `halamanstatis`
--

CREATE TABLE IF NOT EXISTS `halamanstatis` (
  `id_halaman` int(5) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) NOT NULL,
  `judul_seo` varchar(100) NOT NULL,
  `isi_halaman` text NOT NULL,
  `tgl_posting` date NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  PRIMARY KEY (`id_halaman`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `halamanstatis`
--

INSERT INTO `halamanstatis` (`id_halaman`, `judul`, `judul_seo`, `isi_halaman`, `tgl_posting`, `gambar`, `username`) VALUES
(1, 'Free Ongkos Kirim', 'free-ongkos-kirim', 'isi keterangan ini untuk melengkapi isi halaman. isi keterangan ini untuk melengkapi isi halaman. isi keterangan ini untuk melengkapi isi halaman. isi keterangan ini untuk melengkapi isi halaman. isi keterangan ini untuk melengkapi isi halaman. isi keterangan ini untuk melengkapi isi halaman. isi keterangan ini untuk melengkapi isi halaman. isi keterangan ini untuk melengkapi isi halaman. isi keterangan ini untuk melengkapi isi halaman. isi keterangan ini untuk melengkapi isi halaman. isi keterangan ini untuk melengkapi isi halaman. isi keterangan ini untuk melengkapi isi halaman. isi keterangan ini untuk melengkapi isi halaman. isi keterangan ini untuk melengkapi isi halaman. isi keterangan ini untuk melengkapi isi halaman. isi keterangan ini untuk melengkapi isi halaman. isi keterangan ini untuk melengkapi isi halaman. isi keterangan ini untuk melengkapi isi halaman. isi keterangan ini untuk melengkapi isi halaman. isi keterangan ini untuk melengkapi isi halaman. isi keterangan ini untuk melengkapi isi halaman. isi keterangan ini untuk melengkapi isi halaman. isi keterangan ini untuk melengkapi isi halaman. isi keterangan ini untuk melengkapi isi halaman. isi keterangan ini untuk melengkapi isi halaman. isi keterangan ini untuk melengkapi isi halaman. isi keterangan ini untuk melengkapi isi halaman. isi keterangan ini untuk melengkapi isi halaman. isi keterangan ini untuk melengkapi isi halaman. isi keterangan ini untuk melengkapi isi halaman.&nbsp;\r\n', '2017-09-06', '16ongkir.jpg', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `header`
--

CREATE TABLE IF NOT EXISTS `header` (
  `id_header` int(5) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(5) NOT NULL,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_posting` date NOT NULL,
  `username` varchar(30) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_header`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `header`
--

INSERT INTO `header` (`id_header`, `id_kategori`, `judul`, `gambar`, `tgl_posting`, `username`) VALUES
(1, 6, 'Banner 2', '8banner.jpg', '2017-09-06', 'admin'),
(2, 5, 'Banner 1', '76banner1.jpg', '2017-09-06', 'admin'),
(3, 6, 'Header 3', '25headerfix3.jpg', '2017-09-06', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `hubungi`
--

CREATE TABLE IF NOT EXISTS `hubungi` (
  `id_hubungi` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `subjek` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `pesan` text COLLATE latin1_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `dibaca` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id_hubungi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `hubungi`
--


-- --------------------------------------------------------

--
-- Table structure for table `identitas`
--

CREATE TABLE IF NOT EXISTS `identitas` (
  `id_identitas` int(5) NOT NULL AUTO_INCREMENT,
  `nama_website` varchar(100) NOT NULL,
  `meta_deskripsi` varchar(250) NOT NULL,
  `meta_keyword` varchar(250) NOT NULL,
  `favicon` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tlp` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `url` varchar(50) NOT NULL,
  `facebook` varchar(100) NOT NULL,
  PRIMARY KEY (`id_identitas`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `identitas`
--

INSERT INTO `identitas` (`id_identitas`, `nama_website`, `meta_deskripsi`, `meta_keyword`, `favicon`, `email`, `tlp`, `alamat`, `url`, `facebook`) VALUES
(1, 'CV. Sea Malaka', 'CV. Sea Malaka adalah salah satu badan usaha yang menjual beraneka garam ikan tentunya.', 'ikan, penjualan, laut, sea, malaka, tanjung, balai', 'favicon.jpg', 'cvseamalaka@gmail.com', '085372532255', 'Tanjungbalai 1b No. 36<br />\r\nSumatera Utara 12740<br />\r\nTelp. 021 92111 24 21<br />\r\nHp. 0857 9487 2517Â <br />\r\nPin BB. 12B233J<span style="white-space: pre">	</span><br />\r\nEmail: cvseamalaka@gmail.com \r\n', 'http://localhost/cvseamalaka', '');

-- --------------------------------------------------------

--
-- Table structure for table `jasa_kirim`
--

CREATE TABLE IF NOT EXISTS `jasa_kirim` (
  `id_jasa` int(10) NOT NULL AUTO_INCREMENT,
  `nama_jasa` varchar(100) NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `link` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  PRIMARY KEY (`id_jasa`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `jasa_kirim`
--

INSERT INTO `jasa_kirim` (`id_jasa`, `nama_jasa`, `gambar`, `link`, `username`) VALUES
(1, 'JNE', '98TIKIJNE.gif', 'http://jne.co.id', 'admin'),
(2, 'TIKI', '60tiki.jpg', 'http://www.tiki-online.com/home', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `kategoriproduk`
--

CREATE TABLE IF NOT EXISTS `kategoriproduk` (
  `id_kategori` int(5) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `kategori_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `gbr_kategori` varchar(50) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `kategoriproduk`
--

INSERT INTO `kategoriproduk` (`id_kategori`, `nama_kategori`, `kategori_seo`, `username`, `gbr_kategori`) VALUES
(6, 'Ikan', 'ikan', 'admin', '69jas.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `konfirmasi`
--

CREATE TABLE IF NOT EXISTS `konfirmasi` (
  `id_konfirmasi` int(5) NOT NULL AUTO_INCREMENT,
  `namalengkap` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `noorder` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tglpembayaran` date NOT NULL,
  `jam` time NOT NULL,
  `jmlhpembayaran` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `namarekening` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `norekening` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `pesan` text COLLATE latin1_general_ci NOT NULL,
  `tlp` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `id_bank` int(5) NOT NULL,
  `dibaca` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id_konfirmasi`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `konfirmasi`
--


-- --------------------------------------------------------

--
-- Table structure for table `konter`
--

CREATE TABLE IF NOT EXISTS `konter` (
  `ip` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `tanggal` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `waktu` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `konter`
--

INSERT INTO `konter` (`ip`, `tanggal`, `waktu`) VALUES
('127.0.0.1', '06-09-2017', '08:40:19'),
('127.0.0.1', '06-09-2017', '08:35:10'),
('127.0.0.1', '06-09-2017', '08:22:35'),
('127.0.0.1', '06-09-2017', '08:13:28'),
('127.0.0.1', '06-09-2017', '07:59:55'),
('127.0.0.1', '06-09-2017', '07:47:16'),
('127.0.0.1', '06-09-2017', '07:08:11'),
('127.0.0.1', '13-09-2017', '07:43:26'),
('127.0.0.1', '13', '07:43:26'),
('127.0.0.1', '13-09-2017', '08:24:35'),
('127.0.0.1', '13-09-2017', '08:30:31'),
('127.0.0.1', '15-09-2017', '11:04:59'),
('127.0.0.1', '15', '11:04:59'),
('127.0.0.1', '15-09-2017', '12:12:27'),
('127.0.0.1', '15-09-2017', '03:27:48'),
('127.0.0.1', '15-09-2017', '04:09:16'),
('127.0.0.1', '15', '04:09:16'),
('127.0.0.1', '15-09-2017', '04:41:13'),
('127.0.0.1', '15', '04:41:13'),
('127.0.0.1', '15-09-2017', '05:02:40'),
('127.0.0.1', '16-09-2017', '10:42:01'),
('127.0.0.1', '16-09-2017', '10:46:50'),
('127.0.0.1', '16-09-2017', '11:16:52');

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

CREATE TABLE IF NOT EXISTS `kota` (
  `id_kota` int(5) NOT NULL AUTO_INCREMENT,
  `nama_kota` varchar(100) NOT NULL,
  `id_propinsi` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kota`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`id_kota`, `nama_kota`, `id_propinsi`, `username`) VALUES
(1, 'Jakarta Selatan', 12, 'admin'),
(2, 'Jakarta Utara', 12, 'admin'),
(3, 'Jakarta Timur', 12, 'admin'),
(4, 'Jakarta Barat', 12, 'admin'),
(5, 'Bogor', 13, 'admin'),
(6, 'Depok', 13, 'admin'),
(7, 'Bekasi', 13, 'admin'),
(8, 'Cikarang', 13, 'admin'),
(9, 'Kerawang', 13, 'admin'),
(10, 'Cikampek', 13, 'admin'),
(11, 'Sukabumi', 13, 'admin'),
(12, 'Cianjur', 13, 'admin'),
(13, 'Bandung', 13, 'admin'),
(14, 'Ciamis', 13, 'admin'),
(15, 'Cimahi', 13, 'admin'),
(16, 'Garut', 13, 'admin'),
(17, 'Puwakarta', 13, 'admin'),
(18, 'Subang', 13, 'admin'),
(19, 'Sumedang', 13, 'admin'),
(20, 'Tasikmalaya', 13, 'admin'),
(21, 'Jatinagor', 13, 'admin'),
(22, 'Indramayu', 13, 'admin'),
(23, 'Cirebon', 13, 'admin'),
(24, 'Kuningan', 13, 'admin'),
(25, 'Majalengka', 13, 'admin'),
(26, 'Cibubur', 13, 'admin'),
(27, 'Citayem', 13, 'admin'),
(28, 'Cileungsi', 13, 'admin'),
(29, 'Cilacap', 14, 'admin'),
(30, 'Solo', 14, 'admin'),
(31, 'Boyolali', 14, 'admin'),
(32, 'Karanganyar', 14, 'admin'),
(33, 'Klaten', 14, 'admin'),
(34, 'Sragen', 14, 'admin'),
(35, 'Sukoharjo', 14, 'admin'),
(36, 'Wonogiri', 14, 'admin'),
(37, 'Banjarnegara', 14, 'admin'),
(38, 'Bayumas', 14, 'admin'),
(39, 'Bojonegoro', 14, 'admin'),
(40, 'Brebes', 14, 'admin'),
(41, 'Kudus', 14, 'admin'),
(42, 'Kendal', 14, 'admin'),
(43, 'Pati', 14, 'admin'),
(44, 'Pekalongan', 14, 'admin'),
(45, 'Purwokerto', 14, 'admin'),
(46, 'Purwodadi', 14, 'admin'),
(47, 'Semarang', 14, 'admin'),
(48, 'Slawi', 14, 'admin'),
(49, 'Tegal', 14, 'admin'),
(50, 'Kebumen', 14, 'admin'),
(51, 'Magelang', 14, 'admin'),
(52, 'Purworejo', 14, 'admin'),
(53, 'Wonosobo', 14, 'admin'),
(54, 'Asahan', 2, 'admin'),
(55, 'Tanjungbalai', 2, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `kd_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(50) NOT NULL,
  `nohp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `username` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  PRIMARY KEY (`kd_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`kd_user`, `nama_lengkap`, `nohp`, `alamat`, `username`, `password`) VALUES
(2, 'Riko Susanto', '082170214455', 'Luwu Timur', 'admin', 'admin'),
(7, 'viewer1', '089', 'al', 'viewer1', 'viewer1'),
(10, 'Andi', '082170215566', 'Luwu Timur', 'andi', '12345'),
(11, 'Jaka Susanto', '082107021', 'Batusangkar', 'jaka', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `logo`
--

CREATE TABLE IF NOT EXISTS `logo` (
  `id_logo` int(5) NOT NULL AUTO_INCREMENT,
  `url` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_posting` date NOT NULL,
  PRIMARY KEY (`id_logo`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `logo`
--

INSERT INTO `logo` (`id_logo`, `url`, `gambar`, `tgl_posting`) VALUES
(1, 'index.php', 'logo.jpg', '2017-09-06');

-- --------------------------------------------------------

--
-- Table structure for table `mainmenu`
--

CREATE TABLE IF NOT EXISTS `mainmenu` (
  `id_main` int(5) NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `link` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `urutan` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_main`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `mainmenu`
--

INSERT INTO `mainmenu` (`id_main`, `nama_menu`, `link`, `urutan`, `username`, `aktif`) VALUES
(5, 'Berita', 'berita.html', 5, 'admin', 'Y'),
(6, 'Testimoni', 'testimonial.html', 6, 'admin', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `modul`
--

CREATE TABLE IF NOT EXISTS `modul` (
  `id_modul` int(5) NOT NULL AUTO_INCREMENT,
  `nama_modul` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `link` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL,
  `publish` enum('Y','N') COLLATE latin1_general_ci NOT NULL,
  `username` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `urutan` int(5) NOT NULL,
  `status` enum('user','admin') COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_modul`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=30 ;

--
-- Dumping data for table `modul`
--

INSERT INTO `modul` (`id_modul`, `nama_modul`, `link`, `aktif`, `publish`, `username`, `urutan`, `status`) VALUES
(1, 'Jajak Pendapat', '?module=poling', 'Y', 'Y', 'admin', 1, 'user'),
(2, 'Menu Utama', '?module=menuutama', 'Y', 'Y', 'admin', 2, 'user'),
(3, 'Submenu', '?module=submenu', 'Y', 'Y', 'admin', 3, 'user'),
(4, 'Konfigurasi Website', '?module=identitas', 'Y', 'Y', 'admin', 4, 'user'),
(5, 'Welcome', '?module=welcome', 'Y', 'Y', 'admin', 5, 'user'),
(6, 'Manajemen Modul', '?module=modul', 'Y', 'Y', 'admin', 6, 'user'),
(7, 'Manajemen User', '?module=user', 'Y', 'Y', 'admin', 7, 'user'),
(8, 'Produk', '?module=produk', 'Y', 'Y', 'admin', 8, 'user'),
(9, 'Kategori Produk', '?module=kategoriproduk', 'Y', 'Y', 'admin', 9, 'user'),
(10, 'Laporan Penjualan', '?module=laporan', 'Y', 'Y', 'admin', 10, 'user'),
(11, 'Berita', '?module=berita', 'Y', 'Y', 'admin', 11, 'user'),
(12, 'Halaman Baru', '?module=halamanstatis', 'Y', 'Y', 'admin', 12, 'user'),
(13, 'Kontak Masuk', '?module=hubungi', 'Y', 'Y', 'admin', 13, 'user'),
(14, 'Order Masuk', '?module=order', 'Y', 'Y', 'admin', 14, 'user'),
(15, 'Konfirmasi Pembayaran', '?module=konfirmasi', 'Y', 'Y', 'admin', 15, 'user'),
(16, 'Testimonial', '?module=testimonial', 'Y', 'Y', 'admin', 16, 'user'),
(17, 'Download', '?module=download', 'Y', 'Y', 'admin', 17, 'user'),
(18, 'Rekening Bank', '?module=bank', 'Y', 'Y', 'admin', 18, 'user'),
(19, 'Banner Promo', '?module=promo', 'Y', 'Y', 'admin', 19, 'user'),
(20, 'Banner Header', '?module=header', 'Y', 'Y', 'admin', 20, 'user'),
(21, 'Logo Web', '?module=logo', 'Y', 'Y', 'admin', 21, 'user'),
(22, 'Kota', '?module=kota', 'Y', 'Y', 'admin', 22, 'user'),
(23, 'Propinsi', '?module=propinsi', 'Y', 'Y', 'admin', 23, 'user'),
(24, 'Ongkos Kirim', '?module=ongkoskirim', 'Y', 'Y', 'admin', 24, 'user'),
(25, 'Jasa Pengiriman', '?module=pengiriman', 'Y', 'Y', 'admin', 25, 'user'),
(26, 'Yahoo Messenger', '?module=ym', 'Y', 'Y', 'admin', 26, 'user'),
(27, 'Templates', '?module=templates', 'Y', 'Y', 'admin', 27, 'user'),
(28, 'Profil', '?module=profil', 'Y', 'Y', 'admin', 28, 'user'),
(29, 'Cara Pemesanan', '?module=pemesanan', 'Y', 'Y', 'admin', 29, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `mod_bank`
--

CREATE TABLE IF NOT EXISTS `mod_bank` (
  `id_bank` int(5) NOT NULL AUTO_INCREMENT,
  `nama_bank` varchar(100) NOT NULL,
  `no_rekening` varchar(100) NOT NULL,
  `pemilik` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  PRIMARY KEY (`id_bank`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `mod_bank`
--

INSERT INTO `mod_bank` (`id_bank`, `nama_bank`, `no_rekening`, `pemilik`, `gambar`, `username`) VALUES
(1, 'Mandiri', 'Mandiri No. Rek 1260005342075', 'A.n. CV. Sea Malaka', 'mandiri.png', 'admin'),
(2, 'BCA', 'BCA No. Rek. 7180178249', 'A.n. CV. Sea Malaka', 'bca.png', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `mod_profil`
--

CREATE TABLE IF NOT EXISTS `mod_profil` (
  `id_profil` int(5) NOT NULL AUTO_INCREMENT,
  `profil` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_profil`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `mod_profil`
--

INSERT INTO `mod_profil` (`id_profil`, `profil`) VALUES
(1, '<p>\r\n<span class="center_content2"><font size="2">CV. Sea Malaka adalah salah satu badan usaha yang menyediakan segala kebutuhan ikan. CV. Sea Malaka&nbsp;</font></span><span class="center_content2"><font size="2">ingin memberikan kemudahan kepada para calon pembeli, cara santai,\r\nmudah dan hemat dalam memesan ikan berkualias dengan harga yang \r\nterjangkau.<br />\r\n<br />\r\nKarena itulah website ini dibuat sedemikian sederhananya sehingga \r\ndiharapkan dapat membantu para pengunjung untuk dapat menelusuri \r\nproduk-produk (ikan) yang ditawarkan secara lebih mudah.<br />\r\n<br />\r\nAkhirnya, kami mengucapkan terima kasih atas kunjungan anda di CV. Sea Malaka</font></span><span class="center_content2"><font size="2">.</font></span>\r\n</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `mod_welcome`
--

CREATE TABLE IF NOT EXISTS `mod_welcome` (
  `id_welcome` int(5) NOT NULL AUTO_INCREMENT,
  `welcome` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_welcome`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `mod_welcome`
--

INSERT INTO `mod_welcome` (`id_welcome`, `welcome`) VALUES
(1, '<p>\r\n<span class="center_content2"><font size="2">CV. Sea Malaka adalah salah satu badan usaha yang menyediakan segala kebutuhan ikan. CV. Sea Malaka&nbsp;</font></span><span class="center_content2"><font size="2">ingin memberikan kemudahan kepada para calon pembeli, cara santai,\r\nmudah dan hemat dalam berbelanja fashion berkualias dengan harga yang \r\nterjangkau.<br />\r\n<br />\r\nKarena itulah website ini dibuat sedemikian sederhananya sehingga \r\ndiharapkan dapat membantu para pengunjung untuk dapat menelusuri \r\nproduk-produk yang ditawarkan secara lebih mudah.</font></span>\r\n</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `mod_ym`
--

CREATE TABLE IF NOT EXISTS `mod_ym` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ym` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `mod_ym`
--

INSERT INTO `mod_ym` (`id`, `nama`, `ym`, `username`) VALUES
(1, 'Marketing', 'cvseamalaka', '');

-- --------------------------------------------------------

--
-- Table structure for table `ongkos_kirim`
--

CREATE TABLE IF NOT EXISTS `ongkos_kirim` (
  `id_ongkir` int(10) NOT NULL AUTO_INCREMENT,
  `id_kota` int(10) DEFAULT NULL,
  `id_jasa` int(10) DEFAULT NULL,
  `biaya` int(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  PRIMARY KEY (`id_ongkir`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=59 ;

--
-- Dumping data for table `ongkos_kirim`
--

INSERT INTO `ongkos_kirim` (`id_ongkir`, `id_kota`, `id_jasa`, `biaya`, `username`) VALUES
(1, 1, 1, 12000, 'admin'),
(2, 1, 2, 12000, 'admin'),
(3, 4, 1, 12000, 'admin'),
(4, 4, 2, 12000, 'admin'),
(5, 3, 1, 12000, 'admin'),
(6, 3, 2, 12000, 'admin'),
(7, 2, 1, 12000, 'admin'),
(8, 2, 2, 12000, 'admin'),
(9, 13, 1, 12500, 'admin'),
(10, 13, 2, 12500, 'admin'),
(11, 37, 1, 25500, 'admin'),
(12, 37, 2, 25500, 'admin'),
(13, 38, 1, 25000, 'admin'),
(14, 38, 2, 25000, 'admin'),
(15, 7, 1, 13500, 'admin'),
(16, 7, 2, 13500, 'admin'),
(17, 5, 1, 17500, 'admin'),
(18, 5, 2, 17500, 'admin'),
(19, 39, 1, 25000, 'admin'),
(20, 39, 2, 25000, 'admin'),
(21, 31, 1, 25000, 'admin'),
(22, 31, 2, 25000, 'admin'),
(23, 40, 1, 25000, 'admin'),
(24, 40, 2, 25000, 'admin'),
(25, 14, 2, 17500, 'admin'),
(26, 12, 1, 17500, 'admin'),
(27, 14, 1, 17500, 'admin'),
(28, 12, 2, 17500, 'admin'),
(29, 26, 1, 13500, 'admin'),
(30, 26, 2, 13500, 'admin'),
(31, 10, 1, 17500, 'admin'),
(32, 10, 2, 17500, 'admin'),
(33, 8, 1, 17500, 'admin'),
(34, 8, 2, 17500, 'admin'),
(35, 29, 1, 17500, 'admin'),
(36, 29, 2, 17500, 'admin'),
(37, 28, 1, 17500, 'admin'),
(38, 28, 2, 17500, 'admin'),
(39, 15, 1, 17500, 'admin'),
(40, 15, 2, 17500, 'admin'),
(41, 23, 1, 17500, 'admin'),
(42, 23, 2, 17500, 'admin'),
(43, 27, 1, 13500, 'admin'),
(44, 27, 2, 13500, 'admin'),
(45, 6, 1, 13500, 'admin'),
(46, 6, 2, 13500, 'admin'),
(47, 16, 1, 13500, 'admin'),
(48, 16, 2, 13500, 'admin'),
(49, 22, 1, 13500, 'admin'),
(50, 22, 2, 13500, 'admin'),
(51, 21, 1, 17500, 'admin'),
(52, 21, 2, 17500, 'admin'),
(53, 32, 1, 17500, 'admin'),
(54, 32, 2, 17500, 'admin'),
(56, 50, 1, 13500, 'admin'),
(57, 54, 1, 50000, 'admin'),
(58, 55, 1, 60000, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id_orders` int(5) NOT NULL AUTO_INCREMENT,
  `nama_kustomer` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `alamat` text COLLATE latin1_general_ci NOT NULL,
  `telpon` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `status_order` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT 'Baru',
  `tgl_order` date NOT NULL,
  `jam_order` time NOT NULL,
  `id_ongkir` int(3) NOT NULL,
  `resi` varchar(30) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_orders`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id_orders`, `nama_kustomer`, `alamat`, `telpon`, `email`, `status_order`, `tgl_order`, `jam_order`, `id_ongkir`, `resi`) VALUES
(2, 'Jhon', 'Kisaran', '085372532517', 'jhon@gmail.com', 'Terkirim', '2017-09-06', '08:25:36', 57, '1234');

-- --------------------------------------------------------

--
-- Table structure for table `orders_detail`
--

CREATE TABLE IF NOT EXISTS `orders_detail` (
  `id_orders` int(5) NOT NULL,
  `id_produk` int(5) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `harga` int(20) NOT NULL,
  `potongan` int(5) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `orders_detail`
--

INSERT INTO `orders_detail` (`id_orders`, `id_produk`, `jumlah`, `harga`, `potongan`) VALUES
(2, 18, 2, 75000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `orders_temp`
--

CREATE TABLE IF NOT EXISTS `orders_temp` (
  `id_orders_temp` int(5) NOT NULL AUTO_INCREMENT,
  `id_produk` int(5) NOT NULL,
  `id_session` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `jumlah` int(5) NOT NULL,
  `tgl_order_temp` date NOT NULL,
  `jam_order_temp` time NOT NULL,
  `stok_temp` int(5) NOT NULL,
  PRIMARY KEY (`id_orders_temp`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `orders_temp`
--

INSERT INTO `orders_temp` (`id_orders_temp`, `id_produk`, `id_session`, `jumlah`, `tgl_order_temp`, `jam_order_temp`, `stok_temp`) VALUES
(1, 18, 'tn5gk9u7mpltpmv2ftk4ui3q20', 1, '2017-09-06', '08:13:51', 14);

-- --------------------------------------------------------

--
-- Table structure for table `poling`
--

CREATE TABLE IF NOT EXISTS `poling` (
  `id_poling` int(5) NOT NULL AUTO_INCREMENT,
  `pilihan` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `rating` int(5) NOT NULL DEFAULT '0',
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL,
  `username` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_poling`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `poling`
--

INSERT INTO `poling` (`id_poling`, `pilihan`, `status`, `rating`, `aktif`, `username`) VALUES
(1, 'Bagaimana Tampilan Web ini ?', 'pertanyaan', 0, 'Y', 'admin'),
(2, 'Bagus', 'jawaban', 0, 'Y', 'admin'),
(3, 'Lumayan', 'jawaban', 0, 'Y', 'admin'),
(4, 'Tidak', 'jawaban', 0, 'Y', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE IF NOT EXISTS `produk` (
  `id_produk` int(5) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(5) NOT NULL,
  `nama_produk` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `produk_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `deskripsi` text COLLATE latin1_general_ci NOT NULL,
  `harga` int(20) NOT NULL,
  `stok` int(5) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `dibeli` int(5) NOT NULL DEFAULT '1',
  `berat` decimal(5,2) unsigned NOT NULL DEFAULT '0.00',
  `discount` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `terbaru` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `terlaris` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `potongan` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_produk`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama_produk`, `produk_seo`, `deskripsi`, `harga`, `stok`, `tgl_masuk`, `gambar`, `username`, `dibeli`, `berat`, `discount`, `terbaru`, `terlaris`, `potongan`) VALUES
(18, 6, 'Ikan Gembung', 'ikan-gembung', '<div align="justify">\r\nIsi keterangan disini untuk melengkapi isi produk. Isi keterangan disini\r\nuntuk melengkapi isi produk. Isi keterangan disini untuk melengkapi isi\r\nproduk. Isi keterangan disini untuk melengkapi isi produk. Isi \r\nketerangan disini untuk melengkapi isi produk. Isi keterangan disini \r\nuntuk melengkapi isi produk.\r\nIsi keterangan disini \r\nuntuk melengkapi isi produk.\r\n</div>\r\n', 75000, 12, '2017-09-06', '13ikangembung.jpg', 'admin', 3, 1.00, 'Y', 'N', 'N', 10);

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

CREATE TABLE IF NOT EXISTS `promo` (
  `id_promo` int(5) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `url` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `tgl_posting` date NOT NULL,
  PRIMARY KEY (`id_promo`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `promo`
--

INSERT INTO `promo` (`id_promo`, `judul`, `url`, `gambar`, `username`, `tgl_posting`) VALUES
(1, 'Gratis Ongkos Kirim', 'page-1-free-ongkos-kirim.html', '53banner-ongkir.jpg', 'admin', '2017-09-06'),
(2, 'Sale Up to 60%', 'produk-10-ikan.html', '8promo.jpg', 'admin', '2017-09-06');

-- --------------------------------------------------------

--
-- Table structure for table `propinsi`
--

CREATE TABLE IF NOT EXISTS `propinsi` (
  `id_propinsi` int(3) NOT NULL AUTO_INCREMENT,
  `nama_propinsi` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  PRIMARY KEY (`id_propinsi`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `propinsi`
--

INSERT INTO `propinsi` (`id_propinsi`, `nama_propinsi`, `username`) VALUES
(1, 'Aceh, Nangro Darussalam', 'admin'),
(2, 'Sumatera Utara', 'admin'),
(3, 'Sumatera Barat', 'admin'),
(4, 'Kepulauan Riau', 'admin'),
(5, 'Riau', 'admin'),
(6, ' Bangka Belitung, Kepulauan', 'admin'),
(7, 'Jambi', 'admin'),
(8, 'Bengkulu', 'admin'),
(9, 'Sumatera Selatan', 'admin'),
(10, 'Lampung', 'admin'),
(11, 'Banten', 'admin'),
(12, 'Jakarta, DKI ', 'admin'),
(13, 'Jawa Barat', 'admin'),
(14, 'Jawa Tengah', 'admin'),
(15, 'Yogyakarta, DI ', 'admin'),
(16, 'Jawa Timur', 'admin'),
(17, 'Kalimantan Barat', 'admin'),
(18, 'Kalimantan Tengah', 'admin'),
(19, 'Kalimantan Selatan', 'admin'),
(20, 'Kalimantan Timur', 'admin'),
(21, 'Bali', 'admin'),
(22, 'Nusa Tenggara Barat', 'admin'),
(23, 'Nusa Tenggara Timur', 'admin'),
(24, 'Sulawesi Utara', 'admin'),
(25, 'Sulawesi Tengah', 'admin'),
(26, 'Sulawesi Selatan', 'admin'),
(27, 'Sulawesi Ttenggara', 'admin'),
(28, 'Gorontalo', 'admin'),
(29, 'Sulawesi Barat', 'admin'),
(30, 'Maluku', 'admin'),
(31, 'Maluku Utara', 'admin'),
(32, 'Papua Barat', 'admin'),
(33, 'Papua', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `submenu`
--

CREATE TABLE IF NOT EXISTS `submenu` (
  `id_sub` int(5) NOT NULL AUTO_INCREMENT,
  `nama_sub` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `link_sub` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `id_main` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  PRIMARY KEY (`id_sub`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `submenu`
--


-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE IF NOT EXISTS `templates` (
  `id_templates` int(5) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `pembuat` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `folder` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(20) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_templates`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id_templates`, `judul`, `pembuat`, `folder`, `aktif`, `username`, `gambar`) VALUES
(1, 'Blue', 'CV Sea Malaka', 'templates/blue', 'Y', 'admin', '98templates.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `testimoni`
--

CREATE TABLE IF NOT EXISTS `testimoni` (
  `id_testimoni` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `pesan` text COLLATE latin1_general_ci NOT NULL,
  `jam` time NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_testimoni`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `testimoni`
--

INSERT INTO `testimoni` (`id_testimoni`, `nama`, `email`, `pesan`, `jam`, `tanggal`) VALUES
(1, 'Andrea Hirata', 'andrea@gmail.com', 'Kualitas ikannya bagus, fast respond. Kompor gas buat CV. Sea Malaka', '04:35:24', '2017-09-06'),
(2, 'Ranti Bella', 'rantibella@gmail.com', 'begitu konfirmasi, langsung di respon, ikan segar-segar. Terimakasih CV. Sea Malaka', '04:23:44', '2017-09-06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `no_telp` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT 'user',
  `blokir` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `foto` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `id_session` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `nama_lengkap`, `email`, `no_telp`, `level`, `blokir`, `foto`, `id_session`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'admin@gmail.com', '085372532516', 'admin', 'N', '63logoadmin.png', 'b2ktnji13jgbati1d0966p8ss0');

-- --------------------------------------------------------

--
-- Table structure for table `usersonline`
--

CREATE TABLE IF NOT EXISTS `usersonline` (
  `timestamp` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `ip` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `file` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `usersonline`
--

INSERT INTO `usersonline` (`timestamp`, `ip`, `file`) VALUES
('1505535412', '127.0.0.1', '/cvseamalaka/media.php');

-- --------------------------------------------------------

--
-- Table structure for table `users_modul`
--

CREATE TABLE IF NOT EXISTS `users_modul` (
  `id_umod` int(11) NOT NULL AUTO_INCREMENT,
  `id_session` varchar(100) NOT NULL,
  `id_modul` int(11) NOT NULL,
  PRIMARY KEY (`id_umod`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `users_modul`
--

INSERT INTO `users_modul` (`id_umod`, `id_session`, `id_modul`) VALUES
(1, 'sfuikuckb828c4cn22sk8elik6', 1),
(2, 'sfuikuckb828c4cn22sk8elik6', 2),
(3, 'sfuikuckb828c4cn22sk8elik6', 3),
(4, 'sfuikuckb828c4cn22sk8elik6', 4),
(5, 'sfuikuckb828c4cn22sk8elik6', 5),
(6, 'sfuikuckb828c4cn22sk8elik6', 6),
(7, 'sfuikuckb828c4cn22sk8elik6', 7),
(8, 'sfuikuckb828c4cn22sk8elik6', 8),
(9, 'sfuikuckb828c4cn22sk8elik6', 9),
(10, 'sfuikuckb828c4cn22sk8elik6', 10),
(11, 'sfuikuckb828c4cn22sk8elik6', 11),
(12, 'sfuikuckb828c4cn22sk8elik6', 12),
(13, 'sfuikuckb828c4cn22sk8elik6', 13),
(14, 'sfuikuckb828c4cn22sk8elik6', 14),
(15, 'sfuikuckb828c4cn22sk8elik6', 15),
(16, 'sfuikuckb828c4cn22sk8elik6', 16),
(17, 'sfuikuckb828c4cn22sk8elik6', 17),
(18, 'sfuikuckb828c4cn22sk8elik6', 18),
(19, 'sfuikuckb828c4cn22sk8elik6', 19),
(20, 'sfuikuckb828c4cn22sk8elik6', 20),
(21, 'sfuikuckb828c4cn22sk8elik6', 21),
(22, 'sfuikuckb828c4cn22sk8elik6', 22),
(23, 'sfuikuckb828c4cn22sk8elik6', 23),
(24, 'sfuikuckb828c4cn22sk8elik6', 24),
(25, 'sfuikuckb828c4cn22sk8elik6', 25);
