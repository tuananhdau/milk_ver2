-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2025 at 04:59 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `milk`
--

-- --------------------------------------------------------

--
-- Table structure for table `donhang`
--

CREATE TABLE `donhang` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ten_khachhang` varchar(100) DEFAULT NULL,
  `sdt` varchar(20) DEFAULT NULL,
  `diachi` text DEFAULT NULL,
  `tong_tien` float DEFAULT NULL,
  `ngay_dat` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `donhang`
--

INSERT INTO `donhang` (`id`, `user_id`, `ten_khachhang`, `sdt`, `diachi`, `tong_tien`, `ngay_dat`) VALUES
(5, NULL, 'tuna nah', '29847242', 'aaaa', 347292, '2025-05-02 17:50:47'),
(6, NULL, 'hoang', '08732324', 'tunanh', 45000, '2025-05-02 21:01:08'),
(7, NULL, 'tuan anh', '088927273', 'nam giang', 95000, '2025-05-02 21:36:52'),
(8, NULL, 'tuan', '23832323', 'tuan anh', 20000, '2025-05-02 21:46:37');

-- --------------------------------------------------------

--
-- Table structure for table `donhang_chitiet`
--

CREATE TABLE `donhang_chitiet` (
  `id` int(11) NOT NULL,
  `id_donhang` int(11) DEFAULT NULL,
  `id_sanpham` int(11) DEFAULT NULL,
  `soluong` int(11) DEFAULT NULL,
  `ten_sanpham` varchar(255) DEFAULT NULL,
  `gia` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `donhang_chitiet`
--

INSERT INTO `donhang_chitiet` (`id`, `id_donhang`, `id_sanpham`, `soluong`, `ten_sanpham`, `gia`) VALUES
(5, 5, 4, 1, 'tuananh', 347292),
(6, 6, 9, 1, 'Sữa Thanh Trùng', 45000),
(7, 7, 9, 1, 'Sữa Thanh Trùng', 45000),
(8, 7, 8, 1, 'Sữa Thanh Trùng', 50000),
(9, 8, 1, 1, 'Vinamilk Ít Đường', 20000);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `img` char(50) NOT NULL,
  `gia` int(10) NOT NULL,
  `soluong` int(10) NOT NULL,
  `chitiet` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `img`, `gia`, `soluong`, `chitiet`) VALUES
(1, 'Vinamilk Ít Đường', 'vinamilk.webp', 20000, 1, 'ngon'),
(2, 'TH True Milk', 'thtruemilk.png', 39999, 0, 'ngon'),
(4, 'TH True Milk', 'thtruemilk.png', 347292, 0, 'adad'),
(5, 'Vinamilk Dâu', 'vinamilk_dau.png', 30000, 1, 'vi dau it duong'),
(6, 'Vinamilk Socola', 'vinamilk_socola.png', 25000, 0, 'sieu ngon'),
(8, 'Sữa Thanh Trùng', 'th.png', 50000, 1, 'hang hot'),
(9, 'Sữa Thanh Trùng', 'th2.png', 45000, 1, 'ngonnn'),
(10, 'Sữa Thanh Trùng', 'th3.png', 25000, 1, 'ngonnn');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `role`) VALUES
(17, 'a', 'admin@gmail.com', '$2y$10$MzK7ZHA5jG6Upx6U1Kn0GObaqrumwMumXWoGFb6zF4P3baipHo7tK', 'user'),
(18, 'b', 'b@gmailcom', '$2y$10$EhdIsyDZTKANOFWOaiijROxISSrzggWRPi8SnJDhF5Zkzeg8maRve', 'admin'),
(20, '342', '56@gmail.com', '$2y$10$VA0nWaSDnoQoNIfHwB6ZTu0ALijK7jvdvxNdRn2oML2Blq7Zpjxe6', 'user'),
(21, 'c', 'adad@gmail.com', '$2y$10$SzIxl3mcm/A5vTOR.zxTm.fVX8XbVaduASaYOi43FHlSedTKFzoIa', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `donhang_chitiet`
--
ALTER TABLE `donhang_chitiet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_donhang` (`id_donhang`),
  ADD KEY `id_sanpham` (`id_sanpham`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donhang`
--
ALTER TABLE `donhang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `donhang_chitiet`
--
ALTER TABLE `donhang_chitiet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `donhang_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `donhang_chitiet`
--
ALTER TABLE `donhang_chitiet`
  ADD CONSTRAINT `donhang_chitiet_ibfk_1` FOREIGN KEY (`id_donhang`) REFERENCES `donhang` (`id`),
  ADD CONSTRAINT `donhang_chitiet_ibfk_2` FOREIGN KEY (`id_sanpham`) REFERENCES `product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
