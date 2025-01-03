-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2025 at 04:53 AM
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
-- Database: `plant_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adm_id` int(222) NOT NULL,
  `username` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `code` varchar(222) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adm_id`, `username`, `password`, `email`, `code`, `date`) VALUES
(6, '1', '1', 'admin@gmail.com', '', '2024-10-15 15:49:04'),
(9, 'il', '827ccb0eea8a706c4c34a16891f84e7b', 'il212@gmail.com', 'QSTE52', '2024-01-10 13:48:43'),
(10, 'q', 'c4ca4238a0b923820dcc509a6f75849b', 'aniitah212@gmail.com', 'QMZR92', '2024-10-15 15:50:00');

-- --------------------------------------------------------

--
-- Table structure for table `admin_codes`
--

CREATE TABLE `admin_codes` (
  `id` int(222) NOT NULL,
  `codes` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_codes`
--

INSERT INTO `admin_codes` (`id`, `codes`) VALUES
(1, 'QX5ZMN'),
(2, 'QFE6ZM'),
(3, 'QMZR92'),
(4, 'QPGIOV'),
(5, 'QSTE52'),
(6, 'QMTZ2J');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(222) NOT NULL,
  `o_id` int(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  `quantity` int(222) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `o_id`, `title`, `quantity`, `price`) VALUES
(36, 147, 'Pink Phalaenopsis orchids', 1, 200.00),
(37, 147, 'Echeveria  succulent', 1, 30.00);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `d_id` int(222) NOT NULL,
  `rs_id` int(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  `slogan` varchar(222) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `img` varchar(222) NOT NULL,
  `qr_img` varchar(222) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`d_id`, `rs_id`, `title`, `slogan`, `price`, `img`, `qr_img`) VALUES
(62, 57, 'Pink Phalaenopsis orchids', 'Pink Phalaenopsis orchids are elegant flowers with broad, flat petals, typically arranged in cascading clusters, and are celebrated for their soft, pastel hues and long-lasting blooms.', 200.00, '6720aab68a450.jpg', 'phalaenopsis_qr_code.png'),
(63, 57, 'Snake Plant ', 'The Snake Plant, also known as Sansevieria, is a hardy, low-maintenance indoor plant with upright, sword-like leaves that thrive in low light and purify the air.', 25.00, '672c24f2d64e3.jpg', 'snake_plant_qr_code.png'),
(64, 57, 'Spider Plant ', 'The Spider Plant (Chlorophytum comosum) is a resilient, low-maintenance plant with arching green and white striped leaves that thrives in various lighting conditions and purifies indoor air.', 15.00, '672c252f28f6d.jpg', 'spider_plant_qr_code.png'),
(65, 57, 'Pothos ', 'Pothos is a hardy, trailing plant with heart-shaped leaves that thrives in low to moderate light and is perfect for indoor spaces due to its air-purifying qualities and low-maintenance needs.', 20.00, '672c25932e33b.jpg', 'pothos_qr_code.png'),
(66, 57, 'Echeveria  succulent', 'Echeveria is a charming, low-maintenance succulent known for its rosette-shaped leaves that come in a variety of colors, making it ideal for sunny indoor spots or outdoor rock gardens.', 30.00, '672c25c9ba338.jpg', 'echeveria_succulent_qr_code.png'),
(67, 57, 'Peace Lily ', 'The Peace Lily (Spathiphyllum) is a popular indoor plant known for its glossy green leaves and white, hood-like flowers, which thrive in low to moderate light conditions.', 18.00, '672c25f9a2f55.jpg', 'peace_lily_qr_code.png'),
(68, 57, 'Fiddle Leaf Fig ', 'The Fiddle Leaf Fig is a popular indoor plant known for its large, glossy, violin-shaped leaves and upright growth habit.', 97.00, '672c2624d93d2.jpg', 'fiddle_leaf_qr_code.png'),
(69, 57, 'ZZ Plant ', 'The ZZ plant (Zamioculcas zamiifolia) is a hardy, low-maintenance indoor plant known for its glossy, dark green leaves and tolerance to low light and drought conditions.', 55.00, '672c264aac837.jpg', 'zz_plant_qr_code.png'),
(70, 57, 'Boston Fern ', 'The Boston Fern (Nephrolepis exaltata) is a lush, feathery evergreen fern known for its arching fronds and its ability to thrive in humid, low-light environments, making it a popular houseplant.', 17.00, '672c267f14954.jpg', 'boston_fern_qr_code.png'),
(71, 57, 'Monstera ', 'Monstera is a tropical plant known for its large, glossy, split or hole-punched leaves, often used as an ornamental houseplant.', 68.00, '672c26b012fad.jpg', 'monstera_qr_code.png');

-- --------------------------------------------------------

--
-- Table structure for table `remark`
--

CREATE TABLE `remark` (
  `id` int(11) NOT NULL,
  `frm_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `remark` mediumtext NOT NULL,
  `remarkDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `remark`
--

INSERT INTO `remark` (`id`, `frm_id`, `status`, `remark`, `remarkDate`) VALUES
(81, 108, 'closed', 'Order delivered', '2024-01-10 14:03:51'),
(82, 109, 'in process', 's', '2024-01-13 13:18:15'),
(83, 109, 'rejected', 'habis', '2024-01-13 13:19:03'),
(84, 109, 'in process', 'otw', '2024-01-13 13:21:48'),
(85, 109, 'rejected', 'b', '2024-01-13 13:23:07'),
(86, 63, 'rejected', 'y', '2024-01-13 14:31:54'),
(87, 107, 'in process', 'hh', '2024-01-13 14:46:53'),
(88, 107, 'rejected', 'm', '2024-01-13 14:47:16'),
(89, 107, 'rejected', 'm', '2024-01-13 14:49:37'),
(90, 63, 'rejected', 'k', '2024-01-13 15:37:46'),
(91, 114, 'closed', 'g', '2024-01-13 16:12:35'),
(92, 115, 'in process', 'h', '2024-01-13 16:12:56'),
(93, 117, 'closed', 'jj', '2024-01-13 17:56:03');

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `rs_id` int(222) NOT NULL,
  `c_id` int(222) NOT NULL,
  `title` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `phone` varchar(222) NOT NULL,
  `url` varchar(222) NOT NULL,
  `o_hr` varchar(222) NOT NULL,
  `c_hr` varchar(222) NOT NULL,
  `o_days` varchar(222) NOT NULL,
  `address` text NOT NULL,
  `image` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`rs_id`, `c_id`, `title`, `email`, `phone`, `url`, `o_hr`, `c_hr`, `o_days`, `address`, `image`, `date`) VALUES
(57, 12, 'PLANT SHOP', 'nurazlishafarhana@gmail.com', '011-3630 6284', 'https://www.instagram.com/hanachicken_/', '8am', '11pm', 'mon-sat', '   Tepi Klinik Bidan Jalan Sungai Baru Simpang Ampat, 02700 Kangar, Perlis   ', '6717d18c1a225.jpg', '2024-10-22 16:23:40');

-- --------------------------------------------------------

--
-- Table structure for table `shop_category`
--

CREATE TABLE `shop_category` (
  `c_id` int(222) NOT NULL,
  `c_name` varchar(222) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `shop_category`
--

INSERT INTO `shop_category` (`c_id`, `c_name`, `date`) VALUES
(12, 'shop', '2024-01-10 08:06:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(222) NOT NULL,
  `username` varchar(222) NOT NULL,
  `f_name` varchar(222) NOT NULL,
  `l_name` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `phone` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `address` text NOT NULL,
  `status` int(222) NOT NULL DEFAULT 1,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `username`, `f_name`, `l_name`, `email`, `phone`, `password`, `address`, `status`, `date`) VALUES
(45, 'sara', '2', 'sara', 'anismashitah212@gmail.com', '+60195036379', '2', 'No. 54 Batu 1 Sungai Baru 02700\r\nSimpang Empat Perlis.', 1, '2024-10-15 15:59:40'),
(46, 'izzah', 'izzah', 'ali', 'izzah212@gmail.com', '+60195036379', '8de37172b68fadfc466b7c9ec51fba36', 'No. 54 Batu 1 Sungai Baru 02700\r\nSimpang Empat Perlis.', 1, '2024-01-10 06:18:47'),
(47, 'ami', 'ami', 'ami', 'ami212@gmail.com', '+60195036379', 'd69df3d87667759f3f051d24d7475b14', 'No. 22626 Batu 1 Sungai Baru 02700\r\nSimpang Empat Perlis.', 1, '2024-01-10 10:27:58'),
(48, 'alia', 'ANISbn', 'BINTI AHMAD', 'anismashitahaaq12@gmail.com', '0195036379', 'e10adc3949ba59abbe56e057f20f883e', 'No. 54 Batu 1 Sungai Baru 02700\r\nSimpang Empat Perlis.', 1, '2024-10-29 09:44:06'),
(49, 'fikri', 'Fikri', 'Hasnizam', 'mfikri4499@gmail.com', '0123456789', 'e10adc3949ba59abbe56e057f20f883e', 'asdf', 1, '2025-01-03 03:11:37');

-- --------------------------------------------------------

--
-- Table structure for table `users_orders`
--

CREATE TABLE `users_orders` (
  `o_id` int(222) NOT NULL,
  `u_id` int(222) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` varchar(222) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users_orders`
--

INSERT INTO `users_orders` (`o_id`, `u_id`, `total_price`, `status`, `date`) VALUES
(63, 45, 9.90, 'rejected', '2024-01-09 14:29:41'),
(107, 47, 9.90, 'cancelled', '2024-01-13 16:10:48'),
(108, 47, 8.90, 'cancelled', '2024-01-13 15:41:08'),
(111, 47, 8.90, 'cancelled', '2024-01-13 15:27:44'),
(112, 47, 8.90, 'cancelled', '2024-01-13 15:21:03'),
(113, 47, 8.90, NULL, '2024-01-13 16:11:51'),
(114, 47, 8.90, 'closed', '2024-01-13 16:12:35'),
(115, 47, 7.90, 'in process', '2024-01-13 16:12:56'),
(117, 47, 8.90, 'closed', '2024-01-13 17:56:03'),
(118, 48, 200.00, NULL, '2024-10-30 04:00:31'),
(119, 48, 25.00, NULL, '2024-11-13 04:23:08'),
(120, 48, 200.00, NULL, '2024-12-18 04:14:13'),
(121, 48, 25.00, NULL, '2024-12-18 04:14:13'),
(122, 48, 200.00, NULL, '2024-12-31 17:35:10'),
(123, 48, 200.00, NULL, '2024-12-31 18:31:59'),
(124, 48, 25.00, NULL, '2024-12-31 18:31:59'),
(125, 48, 30.00, NULL, '2024-12-31 23:28:10'),
(126, 48, 20.00, NULL, '2024-12-31 23:28:10'),
(127, 48, 200.00, NULL, '2024-12-31 23:35:29'),
(128, 48, 25.00, NULL, '2024-12-31 23:35:29'),
(129, 48, 200.00, NULL, '2024-12-31 23:36:22'),
(130, 48, 15.00, NULL, '2024-12-31 23:36:22'),
(131, 48, 200.00, NULL, '2024-12-31 23:41:56'),
(132, 48, 25.00, NULL, '2024-12-31 23:41:56'),
(133, 48, 200.00, NULL, '2024-12-31 23:42:17'),
(134, 48, 25.00, NULL, '2024-12-31 23:42:17'),
(135, 48, 200.00, NULL, '2024-12-31 23:42:56'),
(136, 48, 25.00, NULL, '2024-12-31 23:42:56'),
(137, 48, 200.00, NULL, '2024-12-31 23:43:24'),
(138, 48, 25.00, NULL, '2024-12-31 23:43:24'),
(139, 48, 200.00, NULL, '2024-12-31 23:49:34'),
(140, 48, 25.00, NULL, '2024-12-31 23:49:34'),
(141, 48, 200.00, NULL, '2024-12-31 23:51:55'),
(142, 48, 25.00, NULL, '2024-12-31 23:51:55'),
(143, 48, 200.00, NULL, '2025-01-01 00:06:54'),
(144, 48, 25.00, NULL, '2025-01-01 00:06:54'),
(147, 49, 230.00, NULL, '2025-01-03 03:35:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adm_id`);

--
-- Indexes for table `admin_codes`
--
ALTER TABLE `admin_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `o_id` (`o_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `remark`
--
ALTER TABLE `remark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`rs_id`);

--
-- Indexes for table `shop_category`
--
ALTER TABLE `shop_category`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `users_orders`
--
ALTER TABLE `users_orders`
  ADD PRIMARY KEY (`o_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adm_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `admin_codes`
--
ALTER TABLE `admin_codes`
  MODIFY `id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `d_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `remark`
--
ALTER TABLE `remark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `rs_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `shop_category`
--
ALTER TABLE `shop_category`
  MODIFY `c_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `users_orders`
--
ALTER TABLE `users_orders`
  MODIFY `o_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`o_id`) REFERENCES `users_orders` (`o_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
