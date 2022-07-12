-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2022 at 07:37 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualan_bulumata`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `nama_jenis`) VALUES
(1, '3D Natural'),
(2, 'Artisan'),
(3, 'Natural'),
(4, 'Bawah'),
(7, '3D');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `kode_produk` varchar(128) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `harga_produk` int(100) NOT NULL,
  `stok_produk` int(11) DEFAULT NULL,
  `gambar_produk` varchar(255) NOT NULL,
  `time_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `kode_produk`, `nama_produk`, `deskripsi_produk`, `id_jenis`, `harga_produk`, `stok_produk`, `gambar_produk`, `time_created`) VALUES
(2, '08 Material', 'Barang Satu Dua', '<p>Spasi Satu</p>\n<p>Spasi Dua</p>\n<p>Spasi Tiga</p>', 1, 2000, 40, '1652593374_491cfa7e75d880d61ecf.jpg', '2022-05-04 19:49:10'),
(3, 'G11 Material', 'Barang Satu Satu Edit', '<p>asdasjdkajsdhjasdaskdjhaksjhkajs</p>\r\n<p><strong>asdaskdjasdklasjdkasjdklasjklsa</strong></p>', 1, 2000, 20, '1652623547_aa650cfb04d02c6369c3.jpg', '2022-05-03 19:49:21'),
(6, '05 M Material', 'Bulu Mata Satu 3', '<p>ut sem viverra aliquet eget sit amet tellus cras adipiscing enim eu turpis egestas pretium aenean pharetra magna ac placerat vestibulum lectus mauris ultrices eros in cursus turpis massa tincidunt dui ut ornare lectus sit amet est placerat in egestas erat imperdiet sed euismod nisi porta lorem mollis aliquam ut porttitor leo a diam sollicitudin tempor id eu nisl nunc mi ipsum faucibus vitae aliquet nec ullamcorper sit amet risus nullam eget felis eget nunc lobortis mattis aliquam faucibus purus in massa tempor nec feugiat nisl pretium fusce id velit ut tortor pretium viverra suspendisse potenti nullam ac tortor vitae</p>', 3, 1000, 15, 'default.png', '2022-05-04 19:51:16'),
(7, '747 Material', 'Bulu Mata Satu 4', '<p>ut sem viverra aliquet eget sit amet tellus cras adipiscing enim eu turpis egestas pretium aenean pharetra magna ac placerat vestibulum lectus mauris ultrices eros in cursus turpis massa tincidunt dui ut ornare lectus sit amet est placerat in egestas erat imperdiet sed euismod nisi porta lorem mollis aliquam ut porttitor leo a diam sollicitudin tempor id eu nisl nunc mi ipsum faucibus vitae aliquet nec ullamcorper sit amet risus nullam eget felis eget nunc lobortis mattis aliquam faucibus purus in massa tempor nec feugiat nisl pretium fusce id velit ut tortor pretium viverra suspendisse potenti nullam ac tortor vitae</p>', 4, 2500, 15, 'default.png', '2022-05-09 19:51:26'),
(8, '3D Natural', 'Bulu Mata Satu 5', '<p>ut sem viverra aliquet eget sit amet tellus cras adipiscing enim eu turpis egestas pretium aenean pharetra magna ac placerat vestibulum lectus mauris ultrices eros in cursus turpis massa tincidunt dui ut ornare lectus sit amet est placerat in egestas erat imperdiet sed euismod nisi porta lorem mollis aliquam ut porttitor leo a diam sollicitudin tempor id eu nisl nunc mi ipsum faucibus vitae aliquet nec ullamcorper sit amet risus nullam eget felis eget nunc lobortis mattis aliquam faucibus purus in massa tempor nec feugiat nisl pretium fusce id velit ut tortor pretium viverra suspendisse potenti nullam ac tortor vitae</p>', 2, 2000, 15, 'default.png', '2022-05-06 19:51:45'),
(20, '3D Natural', 'Bulmat', '<p>asdasd</p>', 1, 3000, 20, '1654518381_1c1d160b354bd67b7a35.jpg', '2022-06-06 16:18:55'),
(21, '3D Material', 'Bulmat Palsu', '<p>asdasdas</p>', 1, 2500, 20, '1654679882_cd4fe148d309edfa26ec.jpg', '2022-06-08 16:19:03'),
(22, '3D Material', 'Bulmat', '<p>asdasd</p>', 3, 3000, 102, '1654680053_c7fa24559cddb2d3f099.jpg', '2022-06-08 23:20:53'),
(23, '08 Material', 'Bulu Mata Palsu 3D/08 Halus', '<p>Ukuran : 13mm</p>\r\n<p><span style=\"background-color: #ffffff; font-family: Helvetica, sans-serif; font-size: 14px;\">Bulu mata 3d yang sangat lembut, dan sangat nyaman untuk dipakai sehari - hari atau untuk acara photoshoot/formal/informal. Setiap produk sudah mendapatkan tutup.</span></p>', 7, 3500, 200, '1655736673_0b0bd2ffa7ee680e6ac4.jpg', '2022-06-20 09:51:14'),
(24, '05 Material', 'Bulu Mata Natural 05 M', '<p><span style=\"font-size: 10.5pt; line-height: 107%; font-family: \'Helvetica\',sans-serif; mso-fareast-font-family: Calibri; mso-fareast-theme-font: minor-latin; background: white; mso-ansi-language: EN-US; mso-fareast-language: EN-US; mso-bidi-language: AR-SA;\">Ukuran : Medium 13mm </span></p>\r\n<p><span style=\"font-size: 10.5pt; line-height: 107%; font-family: \'Helvetica\',sans-serif; mso-fareast-font-family: Calibri; mso-fareast-theme-font: minor-latin; background: white; mso-ansi-language: EN-US; mso-fareast-language: EN-US; mso-bidi-language: AR-SA;\">Bulu mata artisan yang sangat natural, lembut, dan sangat nyaman untuk dipakai sehari - hari atau untuk acara tertentu. Dengan kualitas bulu mata yang premium, produk dapat dipakai berkali - kali. Setiap produk sudah mendapatkan tutup.</span></p>', 3, 2700, 130, '1655736749_a0825c106b063829ba7c.jpg', '2022-06-20 09:52:29'),
(25, 'G11', 'Dropship Bulu Mata Halus 3D G11', '<p><span style=\"font-size: 10.5pt; line-height: 107%; font-family: \'Helvetica\',sans-serif; mso-fareast-font-family: Calibri; mso-fareast-theme-font: minor-latin; background: white; mso-ansi-language: EN-US; mso-fareast-language: EN-US; mso-bidi-language: AR-SA;\">Material : Rambut sintetis kualitas terbaik yang paling halus.</span></p>\r\n<p><span style=\"font-size: 10.5pt; line-height: 107%; font-family: \'Helvetica\',sans-serif; mso-fareast-font-family: Calibri; mso-fareast-theme-font: minor-latin; background: white; mso-ansi-language: EN-US; mso-fareast-language: EN-US; mso-bidi-language: AR-SA;\">Ukuran : Medium 14mm </span></p>\r\n<p><span style=\"font-size: 10.5pt; line-height: 107%; font-family: \'Helvetica\',sans-serif; mso-fareast-font-family: Calibri; mso-fareast-theme-font: minor-latin; background: white; mso-ansi-language: EN-US; mso-fareast-language: EN-US; mso-bidi-language: AR-SA;\">Bulu mata 3D yang sangat natural, lembut, dan sangat nyaman untuk dipakai sehari - hari atau untuk acara tertentu. Dengan kualitas bulu mata yang premium, produk dapat dipakai berkali - kali. Setiap produk sudah mendapatkan tutup.</span></p>', 7, 3200, 100, '1655736949_e9a8d9ab82184441a213.jpg', '2022-06-20 09:55:49'),
(26, '747 M', 'Bulu Mata Palsu Natural Halus 747M', '<p><span style=\"font-size: 10.5pt; line-height: 107%; font-family: \'Helvetica\',sans-serif; mso-fareast-font-family: Calibri; mso-fareast-theme-font: minor-latin; background: white; mso-ansi-language: EN-US; mso-fareast-language: EN-US; mso-bidi-language: AR-SA;\">Material : Rambut sintetis kualitas terbaik yang paling halus.</span></p>\r\n<p><span style=\"font-size: 10.5pt; line-height: 107%; font-family: \'Helvetica\',sans-serif; mso-fareast-font-family: Calibri; mso-fareast-theme-font: minor-latin; background: white; mso-ansi-language: EN-US; mso-fareast-language: EN-US; mso-bidi-language: AR-SA;\">Ukuran : Medium 14mm.</span></p>\r\n<p><span style=\"font-size: 10.5pt; line-height: 107%; font-family: \'Helvetica\',sans-serif; mso-fareast-font-family: Calibri; mso-fareast-theme-font: minor-latin; background: white; mso-ansi-language: EN-US; mso-fareast-language: EN-US; mso-bidi-language: AR-SA;\">Bulu mata artisan yang sangat natural, lembut, dan sangat nyaman untuk dipakai sehari - hari atau untuk acara tertentu. Dengan kualitas bulu mata yang premium, produk dapat dipakai berkali - kali. Setiap produk sudah mendapatkan tutup.</span></p>', 3, 2800, 340, '1655737038_9eeb405f61ff72f7b767.jpg', '2022-06-20 09:57:18'),
(27, 'WSP', 'Bulu Mata Palsu 3D WSP', '<p><span style=\"font-size: 10.5pt; line-height: 107%; font-family: \'Helvetica\',sans-serif; mso-fareast-font-family: Calibri; mso-fareast-theme-font: minor-latin; background: white; mso-ansi-language: EN-US; mso-fareast-language: EN-US; mso-bidi-language: AR-SA;\">Material : Rambut sintetis kualitas terbaik yang paling halus.</span></p>\r\n<p><span style=\"font-size: 10.5pt; line-height: 107%; font-family: \'Helvetica\',sans-serif; mso-fareast-font-family: Calibri; mso-fareast-theme-font: minor-latin; background: white; mso-ansi-language: EN-US; mso-fareast-language: EN-US; mso-bidi-language: AR-SA;\">Ukuran : Medium 13mm. </span></p>\r\n<p><span style=\"font-size: 10.5pt; line-height: 107%; font-family: \'Helvetica\',sans-serif; mso-fareast-font-family: Calibri; mso-fareast-theme-font: minor-latin; background: white; mso-ansi-language: EN-US; mso-fareast-language: EN-US; mso-bidi-language: AR-SA;\">Bulu mata artisan yang sangat natural, lembut, dan sangat nyaman untuk dipakai sehari - hari atau untuk acara tertentu. Dengan kualitas bulu mata yang premium, produk dapat dipakai berkali - kali. Setiap produk sudah mendapatkan tutup.</span></p>', 1, 3500, 300, '1655737110_e33e1913830e78273bef.jpg', '2022-06-20 09:58:30'),
(28, 'S64', 'Eyelash Palsu Bawah S64', '<p><span style=\"font-size: 10.5pt; line-height: 107%; font-family: \'Helvetica\',sans-serif; mso-fareast-font-family: Calibri; mso-fareast-theme-font: minor-latin; background: white; mso-ansi-language: EN-US; mso-fareast-language: EN-US; mso-bidi-language: AR-SA;\">Material : Rambut sintetis kualitas terbaik yang paling halus.</span></p>\r\n<p><span style=\"font-size: 10.5pt; line-height: 107%; font-family: \'Helvetica\',sans-serif; mso-fareast-font-family: Calibri; mso-fareast-theme-font: minor-latin; background: white; mso-ansi-language: EN-US; mso-fareast-language: EN-US; mso-bidi-language: AR-SA;\">Ukuran : Standart.</span></p>\r\n<p><span style=\"font-size: 10.5pt; line-height: 107%; font-family: \'Helvetica\',sans-serif; mso-fareast-font-family: Calibri; mso-fareast-theme-font: minor-latin; background: white; mso-ansi-language: EN-US; mso-fareast-language: EN-US; mso-bidi-language: AR-SA;\">Bulu mata bawah yang sangat natural, ringan, lembut, dan sangat nyaman untuk dipakai sehari - hari atau untuk acara tertentu. Dengan kualitas bulu mata yang berkualitas premium, produk dapat dipakai berkali - kali. Setiap produk sudah mendapatkan tutup.</span></p>', 4, 2700, 170, '1655737175_1c00642becc34fa19b2b.jpg', '2022-06-20 09:59:36'),
(29, '04G', 'Bulu Mata Palsu Artisan 04G M', '<p><span style=\"font-size: 10.5pt; line-height: 107%; font-family: \'Helvetica\',sans-serif; mso-fareast-font-family: Calibri; mso-fareast-theme-font: minor-latin; background: white; mso-ansi-language: EN-US; mso-fareast-language: EN-US; mso-bidi-language: AR-SA;\">Material : Rambut sintetis kualitas terbaik yang paling halus.</span></p>\r\n<p><span style=\"font-size: 10.5pt; line-height: 107%; font-family: \'Helvetica\',sans-serif; mso-fareast-font-family: Calibri; mso-fareast-theme-font: minor-latin; background: white; mso-ansi-language: EN-US; mso-fareast-language: EN-US; mso-bidi-language: AR-SA;\">Ukuran : Medium 13mm.</span></p>\r\n<p><span style=\"font-size: 10.5pt; line-height: 107%; font-family: \'Helvetica\',sans-serif; mso-fareast-font-family: Calibri; mso-fareast-theme-font: minor-latin; background: white; mso-ansi-language: EN-US; mso-fareast-language: EN-US; mso-bidi-language: AR-SA;\">Detail : Bulu mata artisan yang sangat natural, lembut, dan sangat nyaman untuk dipakai sehari - hari atau untuk acara tertentu. Dengan kualitas bulu mata yang premium, produk dapat dipakai berkali - kali. Setiap produk sudah mendapatkan tutup.</span></p>', 2, 2800, 289, '1655737247_692c5ead4562345ae79c.jpg', '2022-06-20 10:00:47'),
(30, 'WSP', 'Eyelash Palsu WSP G Ekstra Lentik', '<p><span style=\"font-size: 10.5pt; line-height: 107%; font-family: \'Helvetica\',sans-serif; mso-fareast-font-family: Calibri; mso-fareast-theme-font: minor-latin; background: white; mso-ansi-language: EN-US; mso-fareast-language: EN-US; mso-bidi-language: AR-SA;\">Material : Rambut sintetis kualitas terbaik yang paling halus</span></p>\r\n<p><span style=\"font-size: 10.5pt; line-height: 107%; font-family: \'Helvetica\',sans-serif; mso-fareast-font-family: Calibri; mso-fareast-theme-font: minor-latin; background: white; mso-ansi-language: EN-US; mso-fareast-language: EN-US; mso-bidi-language: AR-SA;\">Ukuran : Medium 13mm</span></p>\r\n<p><span style=\"font-size: 10.5pt; line-height: 107%; font-family: \'Helvetica\',sans-serif; mso-fareast-font-family: Calibri; mso-fareast-theme-font: minor-latin; background: white; mso-ansi-language: EN-US; mso-fareast-language: EN-US; mso-bidi-language: AR-SA;\">Detail : Bulu mata artisan yang sangat natural, lembut, dan sangat nyaman untuk dipakai sehari - hari atau untuk acara tertentu. Dengan kualitas bulu mata yang premium, produk dapat dipakai berkali - kali. Setiap produk sudah mendapatkan tutup.</span></p>', 3, 2700, 389, '1655737359_ef85ab35d567124c67ff.jpg', '2022-06-20 10:02:39'),
(31, 'R20', 'Bulu Mata Palsu R20', '<p><span style=\"font-size: 10.5pt; line-height: 107%; font-family: \'Helvetica\',sans-serif; mso-fareast-font-family: Calibri; mso-fareast-theme-font: minor-latin; background: white; mso-ansi-language: EN-US; mso-fareast-language: EN-US; mso-bidi-language: AR-SA;\">Material : Rambut sintetis kualitas terbaik yang paling halus.</span></p>\r\n<p><span style=\"font-size: 10.5pt; line-height: 107%; font-family: \'Helvetica\',sans-serif; mso-fareast-font-family: Calibri; mso-fareast-theme-font: minor-latin; background: white; mso-ansi-language: EN-US; mso-fareast-language: EN-US; mso-bidi-language: AR-SA;\">Ukuran : Medium 13mm</span></p>\r\n<p><span style=\"font-size: 10.5pt; line-height: 107%; font-family: \'Helvetica\',sans-serif; mso-fareast-font-family: Calibri; mso-fareast-theme-font: minor-latin; background: white; mso-ansi-language: EN-US; mso-fareast-language: EN-US; mso-bidi-language: AR-SA;\">Detail : Bulu mata artisan yang sangat natural, lembut, dan sangat nyaman untuk dipakai sehari - hari atau untuk acara tertentu. Dengan kualitas bulu mata yang premium, produk dapat dipakai berkali - kali. Setiap produk sudah mendapatkan tutup.</span></p>', 3, 2700, 2220, '1655737416_8b454f3524e9538e0727.jpg', '2022-06-20 10:03:36'),
(32, 'CB', 'Coba Barang', '<p>ini adalah deskipsi</p>', 2, 3000, 108, '1655802135_3a1e7a52f79a2590d5ed.jpg', '2022-06-21 04:02:16');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah_produk` int(11) NOT NULL,
  `total_harga` int(255) DEFAULT NULL,
  `ongkir` int(255) DEFAULT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `id_produk`, `jumlah_produk`, `total_harga`, `ongkir`, `bukti_bayar`, `status`, `date_created`) VALUES
(4, 7, 30, 11, 29700, 10000, '1657548580_7d24fc35bf735f0e8bf3.jpg', 'selesai', '2022-07-11 08:46:13'),
(5, 7, 29, 11, 30800, 10000, '1657550094_2158150f23c6ad68296e.jpg', 'selesai', '2022-07-11 09:34:14'),
(6, 7, 32, 12, 36000, 10000, '1657551215_5e01a25e1e030dc93b3f.jpg', 'selesai', '2022-07-11 09:34:28');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(128) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(16) NOT NULL,
  `role` int(11) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `email`, `nama_lengkap`, `alamat`, `no_hp`, `role`, `is_active`) VALUES
(1, 'dimaschronicles', '$2y$10$OLZyoSr5VsOXtftwLT732u4c9m2/UYL09Gop0HeDsdb24DjwkZSAW', 'dimaschronicles@gmail.com', 'Dimas Cahyo', 'null', '123', 1, 1),
(4, 'anggie', '$2y$10$5tv6kvSQQqGTzeYaviKsD.tzNQABMEroZS/vYCXNyNTXycHydU7Ti', 'alkuffar2@gmail.com', 'Anggie Feb', 'Jatinegara, Sempors', '12345678911', 2, 1),
(5, 'farhan', '$2y$10$VD.NlVBNAble/4OoaRSNR.5GnE6kZ5W.yt0jGJtrT/4x/tjjvyTE2', 'farhan@gmail.com', 'Farhan R', 'Bantar Kawung, Bumiayu', '00819044023', 2, 1),
(7, 'dimasc', '$2y$10$qzTSRzx0BsAYTqtY8WUS/O/4Nza3ungnfyif60GP65FZ6axkQvPCq', 'dimas@gmail.com', 'Dimas Cahyo Nur Aditya', 'Pliken RT6/6, Kec. Kembaran, Kab. Banyumas, Jawa Tengah, 53182', '081903304446', 2, 1),
(8, 'pahlevi', '$2y$10$OLZyoSr5VsOXtftwLT732u4c9m2/UYL09Gop0HeDsdb24DjwkZSAW', 'pahlevi@gmail.com', 'Adam', 'Pwt', '123', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id_user_token` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id_user_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id_user_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
