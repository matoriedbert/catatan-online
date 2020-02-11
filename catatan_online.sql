-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 11, 2020 at 05:10 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `catatan_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `catatan`
--

CREATE TABLE `catatan` (
  `id_catatan` int(11) NOT NULL,
  `judul_catatan` varchar(50) NOT NULL,
  `isi_catatan` varchar(200) NOT NULL,
  `waktu_catatan` datetime NOT NULL,
  `password_catatan` varchar(20) NOT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `catatan`
--

INSERT INTO `catatan` (`id_catatan`, `judul_catatan`, `isi_catatan`, `waktu_catatan`, `password_catatan`, `id_user`) VALUES
(1, 'test judul', 'test isi', '2020-02-11 14:57:56', '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pengunjung`
--

CREATE TABLE `pengunjung` (
  `id_pengunjung` int(11) NOT NULL,
  `browser_pengunjung` varchar(50) NOT NULL,
  `so_pengunjung` varchar(50) NOT NULL,
  `ip_pengunjung` varchar(50) NOT NULL,
  `waktu_pengunjung` datetime NOT NULL,
  `id_catatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengunjung`
--

INSERT INTO `pengunjung` (`id_pengunjung`, `browser_pengunjung`, `so_pengunjung`, `ip_pengunjung`, `waktu_pengunjung`, `id_catatan`) VALUES
(1, 'Chrome 79.0.3945.130', 'Windows 10', '::1', '2020-01-28 23:56:18', 1),
(2, 'Chrome 79.0.3945.130', 'Windows 10', '::1', '2020-01-28 23:56:44', 1),
(3, 'Chrome 79.0.3945.130', 'Windows 10', '::1', '2020-01-28 23:59:26', 1),
(4, 'Chrome 79.0.3945.130', 'Windows 10', '::1', '2020-01-29 00:00:00', 1),
(5, 'Chrome 79.0.3945.130', 'Windows 10', '::1', '2020-01-29 00:12:29', 1),
(6, 'Chrome 79.0.3945.130', 'Windows 10', '::1', '2020-01-29 00:13:04', 1),
(7, 'Chrome 79.0.3945.130', 'Windows 10', '::1', '2020-01-29 00:15:12', 1),
(8, 'Chrome 79.0.3945.130', 'Windows 10', '::1', '2020-01-29 00:15:47', 1),
(9, 'Chrome 79.0.3945.130', 'Windows 10', '::1', '2020-01-29 00:15:48', 1),
(10, 'Chrome 79.0.3945.130', 'Windows 10', '::1', '2020-01-29 00:15:48', 1),
(11, 'Chrome 79.0.3945.130', 'Windows 10', '::1', '2020-01-29 00:16:01', 1),
(12, 'Chrome 79.0.3945.130', 'Windows 10', '::1', '2020-01-29 00:16:41', 1),
(13, 'Chrome 79.0.3945.130', 'Windows 10', '::1', '2020-01-29 00:17:01', 1),
(14, 'Chrome 79.0.3945.130', 'Windows 10', '::1', '2020-01-29 00:19:19', 1),
(15, 'Chrome 79.0.3945.130', 'Windows 10', '::1', '2020-01-29 00:19:46', 1),
(16, 'Chrome 79.0.3945.130', 'Windows 10', '::1', '2020-01-29 17:12:29', 2),
(17, 'Chrome 79.0.3945.130', 'Windows 10', '::1', '2020-01-29 17:24:02', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `nama_seo_user` varchar(100) NOT NULL,
  `email_user` varchar(50) NOT NULL,
  `foto_user` varchar(100) NOT NULL,
  `password_user` varchar(50) NOT NULL,
  `key_user` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `nama_seo_user`, `email_user`, `foto_user`, `password_user`, `key_user`) VALUES
(2, 'matori', 'matori', 'matori@gmail.com', 'matori.jpg', '202cb962ac59075b964b07152d234b70', '6YGgKJ4Cky5LeSB9z1FrGKNt87DssIi3h2xHTjAFM9nU8OM3qYPE6yqfQZ2OcpCS'),
(3, 'test', 'test', 'test@gmail.com', 'test.jpg', '202cb962ac59075b964b07152d234b70', 'tIpGrwMeWvoRAViuzNBASk5Y1X3hb2mn7siJUCUj7kp8wm5KV4XfWZaqCPQEQsca'),
(4, 'coeg', 'coeg', 'coeg@gmail.com', '', '202cb962ac59075b964b07152d234b70', ''),
(7, 'a', 'a', 'a@gmail.com', '', '202cb962ac59075b964b07152d234b70', ''),
(8, 'm', 'm', 'm@gmail.com', '', '202cb962ac59075b964b07152d234b70', ''),
(9, 'q', 'q', 'q@gmail.com', '', '202cb962ac59075b964b07152d234b70', 'dcfUMoWFXxFNymvz7s9N38cmZjY6wpyA4e6nQBgnKbLhqtzC4HUPkJbuqLEESxIh');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catatan`
--
ALTER TABLE `catatan`
  ADD PRIMARY KEY (`id_catatan`);

--
-- Indexes for table `pengunjung`
--
ALTER TABLE `pengunjung`
  ADD PRIMARY KEY (`id_pengunjung`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catatan`
--
ALTER TABLE `catatan`
  MODIFY `id_catatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengunjung`
--
ALTER TABLE `pengunjung`
  MODIFY `id_pengunjung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
