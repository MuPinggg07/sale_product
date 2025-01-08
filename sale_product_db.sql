-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2025 at 02:52 PM
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
-- Database: `sale_product_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `banner_system_tb`
--

CREATE TABLE `banner_system_tb` (
  `banner_id` int(20) NOT NULL,
  `banner_image` varchar(250) NOT NULL,
  `upload_date` date NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `banner_system_tb`
--

INSERT INTO `banner_system_tb` (`banner_id`, `banner_image`, `upload_date`, `status`) VALUES
(8, 'eb5d268bf20caaf73e48ad82d9841685.jpg', '2024-09-24', 'active'),
(10, '9d47a48954ceac24f44483900da8024e.jpg', '2024-09-24', 'active'),
(11, 'b68bdc81c2887f1e1879901b160c1e61.jpg', '2024-09-24', 'active'),
(12, '16d88c35168095738e219fdad44cf4d4.jpg', '2024-09-24', 'active'),
(13, 'istockphoto-1428737062-612x612.jpg', '2024-09-24', 'active'),
(15, '2e67a7b482b311f939f45d9298465d91.jpg', '2024-09-24', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `history_tb`
--

CREATE TABLE `history_tb` (
  `order_id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `product_details` text NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `reservation_time` datetime NOT NULL,
  `payment_proof_image` varchar(255) NOT NULL,
  `order_status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `history_tb`
--

INSERT INTO `history_tb` (`order_id`, `user_id`, `product_details`, `total`, `reservation_time`, `payment_proof_image`, `order_status`, `created_at`) VALUES
(676, 4, '{\"20\":1}', 25.00, '2024-12-25 21:37:00', 'uploads/456634378_1243864356588285_6831476204812433035_n.jpg', 'รอดำเนินการ', '2024-12-25 13:36:26');

-- --------------------------------------------------------

--
-- Table structure for table `mook_tb`
--

CREATE TABLE `mook_tb` (
  `mook_id` int(10) NOT NULL,
  `mook_name` varchar(255) NOT NULL,
  `mook_price` int(11) NOT NULL,
  `mook_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `mook_tb`
--

INSERT INTO `mook_tb` (`mook_id`, `mook_name`, `mook_price`, `mook_img`) VALUES
(5, 'ไข่มุกต้นตำรับ', 0, '1735126577_66e81f2778655.JPG'),
(6, 'บุกไข่มุกขาว', 10, 'IMG_4156.JPG'),
(7, 'วุ้นสตอเบอรี่', 10, 'IMG_4159.JPG'),
(8, 'วิปครีม', 10, '1735559593_IMG_4153.JPG'),
(10, 'วุ้นคาราเมล', 5, 'IMG_4157.JPG'),
(11, 'อโรเวร่า', 10, 'IMG_4155.JPG'),
(12, 'วุ้นน้ำผึ้ง', 5, 'IMG_4154.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `news_tb`
--

CREATE TABLE `news_tb` (
  `news_id` int(30) NOT NULL,
  `news_title` varchar(255) NOT NULL,
  `news_description` text NOT NULL,
  `news_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `order_tb`
--

CREATE TABLE `order_tb` (
  `order_id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `product_details` text NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `reservation_time` datetime NOT NULL,
  `payment_proof_image` varchar(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_status` varchar(100) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `mook_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `order_tb`
--

INSERT INTO `order_tb` (`order_id`, `user_id`, `product_details`, `total`, `reservation_time`, `payment_proof_image`, `order_date`, `order_status`, `user_name`, `product_name`, `mook_name`) VALUES
(389, 4, '{\"18\":1}', 30, '2024-12-25 21:23:00', 'images.png', '2024-12-26 04:57:45', 'accepted', '', 'ชานมน้ำผึ้ง x1', '10.00 ฿'),
(390, 4, '{\"15\":1,\"18\":1}', 65, '2024-12-25 21:33:00', 'images.png', '2024-12-26 04:58:40', 'accepted', '', 'ชานมบราวซูก้า พ่นไฟ x1, ชานมน้ำผึ้ง x1', '0.00 ฿, 5.00 ฿'),
(391, 4, '{\"20\":1}', 30, '2024-12-25 21:38:00', 'ดาวน์โหลด.png', '2024-12-26 12:52:17', 'accepted', '', 'ชานมข้าวหอม x1', '10.00 ฿'),
(395, 5, '{\"18\":1,\"19\":1}', 40, '2024-12-26 21:29:00', 'images.png', '2024-12-29 13:30:37', 'accepted', '', 'ชานมน้ำผึ้ง x1, ชานมชมพู x1', '0 ฿, 0 ฿'),
(397, 5, '{\"20\":1,\"23\":1}', 50, '2024-12-26 21:29:00', 'images.png', '2024-12-29 13:26:57', 'accepted', '', 'ชานมข้าวหอม x1, ชามะม่วง x1', '10.00 ฿, 0 ฿'),
(401, 5, '{\"14\":1,\"15\":1}', 95, '2024-12-30 20:47:00', 'unnamed-removebg-preview1.png', '2024-12-30 11:48:00', 'accepted', '', 'ชาไทยบราวซูก้า พ่นไฟ x1, ชานมบราวซูก้า พ่นไฟ x1', '10.00 ฿, 5.00 ฿'),
(402, 4, '{\"14\":1,\"18\":1}', 80, '2024-12-30 20:23:00', 'ดาวน์โหลด.jfif', '2024-12-30 12:27:13', 'accepted', '', 'ชาไทยบราวซูก้า พ่นไฟ x1, ชานมน้ำผึ้ง x1', '10.00 ฿, 10.00 ฿'),
(404, 4, '{\"18\":2,\"19\":1}', 70, '2025-01-02 17:52:00', 'ดาวน์โหลด.jfif', '2025-01-07 09:14:23', 'accepted', '', 'ชานมน้ำผึ้ง x2, ชานมชมพู x1', 'ไม่มีมุก, ไม่มีมุก'),
(407, 4, '{\"19\":1,\"20\":2}', 85, '2025-01-02 18:41:00', 'ดาวน์โหลด.jfif', '2025-01-02 10:45:02', 'accepted', '', 'ชานมชมพู x1, ชานมข้าวหอม x2', '');

-- --------------------------------------------------------

--
-- Table structure for table `product_tb`
--

CREATE TABLE `product_tb` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `product_detail` text NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_img` text NOT NULL,
  `product_type_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `product_tb`
--

INSERT INTO `product_tb` (`product_id`, `product_name`, `product_detail`, `product_price`, `product_img`, `product_type_id`, `user_id`) VALUES
(14, 'ชาไทยบราวซูก้า พ่นไฟ', 'ชาไทยบราวซูก้า พ่นไฟ', 40, '66e81c99da9fa.JPG', 20, 4),
(15, 'ชานมบราวซูก้า พ่นไฟ', 'ชานมบราวซูก้า พ่นไฟ', 40, '66e81ccb58208.JPG', 20, 4),
(18, 'ชานมน้ำผึ้ง', 'ชานมน้ำผึ้ง', 20, '66e81ae972a0b.JPG', 1, 4),
(19, 'ชานมชมพู', 'ชานมชมพู', 20, '66e81b2a6b994.JPG', 1, 4),
(20, 'ชานมข้าวหอม', 'ชานมข้าวหอม', 20, '66e81b823ea07.JPG', 1, 4),
(23, 'ชามะม่วง', 'ชามะม่วง', 20, '66e81da788aff.JPG', 21, 4),
(28, 'ชานม | เผือก', 'ชานม | เผือก', 35, '66e818901fc1a.JPG', 21, 4),
(29, 'ชานมชมพู | เช็อกโกแลต', 'ชานมชมพู |ช็อกโกแลต', 35, '66e81558342fc.JPG', 1, 4),
(33, 'ชานมบราวซูก้า', 'ชานมบราวซูก้า', 20, '66e81ccb58208.JPG', 20, 4),
(34, 'ชาไทยบราวซูก้า', 'ชาไทยบราวซูก้า', 20, '66e81c99da9fa.JPG', 20, 4),
(35, 'ชาเขียว', 'ชาเขียว', 20, '66e817bdb2bcd.JPG', 1, 4),
(36, 'ชานมเผือก', 'ชานมเผือก', 20, '66e8193d450b8.JPG', 1, 4),
(40, 'ชานมซอสชาเขียว', 'ชานมซอสชาเขียว', 40, '66e81c00e6b87.JPG', 1, 4),
(41, 'ชานมซอสช็อกโกแลต', 'ชานมซอสช็อกโกแลต', 40, '66e81bc74db6c.JPG', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `product_type_tb`
--

CREATE TABLE `product_type_tb` (
  `product_type_id` int(11) NOT NULL,
  `product_type_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `product_type_tb`
--

INSERT INTO `product_type_tb` (`product_type_id`, `product_type_name`) VALUES
(1, 'ชานม'),
(18, 'โซดา'),
(19, 'มุก'),
(20, 'บราวซูก้า'),
(21, 'ชา');

-- --------------------------------------------------------

--
-- Table structure for table `user_tb`
--

CREATE TABLE `user_tb` (
  `user_id` int(11) NOT NULL,
  `user_fname` varchar(50) NOT NULL,
  `user_sname` varchar(50) NOT NULL,
  `user_tel` varchar(11) NOT NULL,
  `user_username` varchar(30) NOT NULL,
  `user_password` varchar(30) NOT NULL,
  `user_img` text NOT NULL,
  `user_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user_tb`
--

INSERT INTO `user_tb` (`user_id`, `user_fname`, `user_sname`, `user_tel`, `user_username`, `user_password`, `user_img`, `user_status`) VALUES
(4, 'Chattakan', 'Sriruean', '0909681044', 'admin', 'admin', '6606502218af1.png', 'admin'),
(5, 'N1', 'N1', '31221432432', 'N1', '11111', 'o15x08cjsQHH1k5DTu6-o.jpg', 'user'),
(6, 'N2', 'N2', '0002', 'N2', '22222', 'large.jpg', 'user'),
(7, 'N2', 'nnn', '061616198', 'N2', '123456', '66e9311ece4a3.jpg', 'wait'),
(9, 'N3', 'NNN', '057867554', 'M3', '123456', '66e931a75628e.jpg', 'wait'),
(13, 'อแอแิแ', 'แอิอแอิอแิfdgdfgdg', '43432423', 'vvvvv', 'vvvvv', '66f69e91b5810.jpg', 'wait'),
(14, 'N3', 'N3', '33333', 'N3', '33333', '67726dc2d4e33.jpg', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banner_system_tb`
--
ALTER TABLE `banner_system_tb`
  ADD PRIMARY KEY (`banner_id`);

--
-- Indexes for table `history_tb`
--
ALTER TABLE `history_tb`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `mook_tb`
--
ALTER TABLE `mook_tb`
  ADD PRIMARY KEY (`mook_id`);

--
-- Indexes for table `news_tb`
--
ALTER TABLE `news_tb`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `order_tb`
--
ALTER TABLE `order_tb`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `product_tb`
--
ALTER TABLE `product_tb`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_type_tb`
--
ALTER TABLE `product_type_tb`
  ADD PRIMARY KEY (`product_type_id`);

--
-- Indexes for table `user_tb`
--
ALTER TABLE `user_tb`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banner_system_tb`
--
ALTER TABLE `banner_system_tb`
  MODIFY `banner_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `history_tb`
--
ALTER TABLE `history_tb`
  MODIFY `order_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=677;

--
-- AUTO_INCREMENT for table `mook_tb`
--
ALTER TABLE `mook_tb`
  MODIFY `mook_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `news_tb`
--
ALTER TABLE `news_tb`
  MODIFY `news_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `order_tb`
--
ALTER TABLE `order_tb`
  MODIFY `order_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=417;

--
-- AUTO_INCREMENT for table `product_tb`
--
ALTER TABLE `product_tb`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `product_type_tb`
--
ALTER TABLE `product_type_tb`
  MODIFY `product_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_tb`
--
ALTER TABLE `user_tb`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
