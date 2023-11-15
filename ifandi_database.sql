-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2023 at 03:57 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ifandi_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id_rating` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `id_resep` int(11) NOT NULL,
  `rating` int(1) NOT NULL,
  `komentar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id_rating`, `uid`, `id_resep`, `rating`, `komentar`) VALUES
(3, 3, 2, 3, 'kayak asu'),
(4, 3, 3, 3, 'kelass'),
(6, 4, 2, 5, 'kayak ifandi'),
(7, 5, 2, 5, '');

-- --------------------------------------------------------

--
-- Table structure for table `resep`
--

CREATE TABLE `resep` (
  `id_resep` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `nama_resep` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `instruksi` varchar(255) NOT NULL,
  `bahan` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resep`
--

INSERT INTO `resep` (`id_resep`, `uid`, `nama_resep`, `deskripsi`, `instruksi`, `bahan`, `gambar`) VALUES
(2, 3, 'Nasi Goreng', 'Nasi dengan cita rasa bumbu ala tenggarong yang diambli dari resep leluhur chef Ifandi', '- Nikahkan Ayam dan Ifandi\r\n- Buat anak\r\n- titit', '- Ifandi\r\n-Ayam', '2023-11-15 10-16-55.Nasi Goreng.jpg'),
(3, 3, 'Roti', 'Itu pastel anjay', '', '', '2023-11-14 09-49-02.Roti.jpg'),
(4, 1, 'MMK', 'yang tau tau aja', '', '', 'NoImage.png'),
(5, 1, 'logo', 'Tampang Rupawan Chef', '', '', 'ifandi.jpg'),
(6, 1, 'lasagna', 'Makanan favorit kucing oren gendut', '', '', 'NoImage.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `username`, `email`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$V8k9G383svAvc0JZVOAqpO0OOL2Yh9.eoF4dVQNSPwGiWkxxqkrRG'),
(2, 'Aldi', 'aldisolihin12@gmail.com', '$2y$10$62wAyDSsNzKVqOVsrieTPu5mYXhQQzbMjnS4kC55OJ/K0nbU6Y5sa'),
(3, 'ifandi', 'ifandi@gmail.com', '$2y$10$NADZES63/XLCSxCk43ya7eqMBx6hQJalYy6gMnhW6dm4xNZYtd0.S'),
(4, 'bima', 'bima@gmail.com', '$2y$10$2eON/Kd80xwGGuwTu/kN4ezsazglHfspsA5EwwFzkjkc8p2XTyEzW'),
(5, 'bima2', 'bima2@gmail.com', '$2y$10$mTWYcuyIGdx3kd.Qt4f68esdVRXguMR/SH.yZVMVN5mHhaK8kIv7u');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id_rating`),
  ADD KEY `uid` (`uid`,`id_resep`),
  ADD KEY `id_resep` (`id_resep`);

--
-- Indexes for table `resep`
--
ALTER TABLE `resep`
  ADD PRIMARY KEY (`id_resep`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id_rating` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `resep`
--
ALTER TABLE `resep`
  MODIFY `id_resep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`id_resep`) REFERENCES `resep` (`id_resep`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `resep`
--
ALTER TABLE `resep`
  ADD CONSTRAINT `resep_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
