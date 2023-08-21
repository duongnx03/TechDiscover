-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 20, 2023 at 12:37 PM
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
-- Database: `website_TD`
--

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `coupon_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(50) NOT NULL,
  `amount` double UNSIGNED DEFAULT NULL,
  `expiry_date` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`coupon_id`, `code`, `amount`, `expiry_date`, `created_at`, `updated_at`) VALUES
(40, 'adfgh', 234, '2023-08-24 22:37:00', '2023-08-15 10:37:18', '2023-08-15 15:37:18'),
(41, 'dxfcgvhb', 456, '2023-08-25 22:38:00', '2023-08-15 10:38:48', '2023-08-15 15:38:48'),
(43, 'drtfyg', 67, '2023-08-25 22:43:00', '2023-08-15 10:43:17', '2023-08-15 15:43:17'),
(45, 'rdrd', 5, '2023-08-18 22:51:00', '2023-08-15 10:51:48', '2023-08-15 15:51:48'),
(46, 'xcgvhbj', 2, '2023-09-02 22:55:00', '2023-08-15 10:55:11', '2023-08-15 15:55:11'),
(47, 'rctvybunimkl', 5, '2023-08-16 22:56:00', '2023-08-15 10:56:10', '2023-08-15 15:56:10'),
(48, 'dsds', 3, '2023-09-01 23:22:00', '2023-08-15 11:22:14', '2023-08-15 16:22:14'),
(49, 'ryghu', 32, '2023-08-17 23:23:00', '2023-08-15 11:23:18', '2023-08-15 16:23:18'),
(51, 'rcgtvhbjn', 6, '2023-08-17 23:25:00', '2023-08-15 11:25:53', '2023-08-15 16:25:53'),
(52, 'ẻuio', 3, '2023-08-17 23:26:00', '2023-08-15 11:26:43', '2023-08-15 16:26:43'),
(53, 'dsfghh', 23, '2023-08-18 13:54:00', '2023-08-16 01:54:59', '2023-08-16 06:54:59'),
(54, 'xcfgvhbjnkm', 4567, '2023-09-01 13:57:00', '2023-08-16 01:57:57', '2023-08-16 06:57:57'),
(55, 'fdghjkk', 5, '2023-09-01 13:08:00', '2023-08-17 01:08:43', '2023-08-17 06:08:43'),
(56, 'ryui', 45678, '2023-08-18 14:11:00', '2023-08-17 02:11:54', '2023-08-17 07:11:54');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brand_id` int(11) NOT NULL,
  `cartegory_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `cartegory_main_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brand_id`, `cartegory_id`, `brand_name`, `cartegory_main_id`) VALUES
(27, 22, 'Xiaomi', 3),
(28, 22, 'Realme', 3),
(29, 22, 'NOKIA', 3),
(30, 22, 'Vertu', 3),
(31, 22, 'SAMSUNG', 3),
(32, 22, 'iPhone', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_color` varchar(50) NOT NULL,
  `product_memory_ram` varchar(50) NOT NULL,
  `product_img` varchar(250) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cartegory`
--

CREATE TABLE `tbl_cartegory` (
  `cartegory_id` int(11) NOT NULL,
  `cartegory_name` varchar(255) NOT NULL,
  `cartegory_main_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_cartegory`
--

INSERT INTO `tbl_cartegory` (`cartegory_id`, `cartegory_name`, `cartegory_main_id`) VALUES
(20, 'iPad', 3),
(21, 'Cellphones', 3),
(22, 'Smartphones', 3),
(23, 'ASUS', 2),
(24, 'DELL', 2),
(25, 'MacBook ', 2),
(26, 'Earphones', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cartegory_main`
--

CREATE TABLE `tbl_cartegory_main` (
  `cartegory_main_id` int(11) NOT NULL,
  `cartegory_main_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_cartegory_main`
--

INSERT INTO `tbl_cartegory_main` (`cartegory_main_id`, `cartegory_main_name`) VALUES
(1, 'Accessories'),
(2, 'Laptop'),
(3, 'Phone');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_color`
--

CREATE TABLE `tbl_color` (
  `color_id` int(11) NOT NULL,
  `color_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_color`
--

INSERT INTO `tbl_color` (`color_id`, `color_name`) VALUES
(1, 'Gold'),
(3, 'Blue'),
(4, 'Black'),
(5, 'Pink'),
(6, 'White'),
(7, 'Violet'),
(8, 'Yellow');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_memory_ram`
--

CREATE TABLE `tbl_memory_ram` (
  `memory_ram_id` int(11) NOT NULL,
  `memory_ram_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_memory_ram`
--

INSERT INTO `tbl_memory_ram` (`memory_ram_id`, `memory_ram_name`) VALUES
(7, '64GB'),
(8, '128GB'),
(9, '256GB'),
(10, '512TB'),
(12, '1TB');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` varchar(50) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `order_status` varchar(50) NOT NULL,
  `user_info` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_items`
--

CREATE TABLE `tbl_order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_img` varchar(250) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `product_color` varchar(50) NOT NULL,
  `product_memory_ram` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `cartegory_main_id` int(11) NOT NULL,
  `cartegory_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `product_price_sale` varchar(255) NOT NULL,
  `product_color` varchar(255) NOT NULL,
  `product_memory_ram` varchar(255) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_intro` varchar(5000) NOT NULL,
  `product_detail` text NOT NULL,
  `product_accessory` text NOT NULL,
  `product_guarantee` text NOT NULL,
  `product_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `product_name`, `cartegory_main_id`, `cartegory_id`, `brand_id`, `product_price`, `product_price_sale`, `product_color`, `product_memory_ram`, `product_quantity`, `product_intro`, `product_detail`, `product_accessory`, `product_guarantee`, `product_img`) VALUES
(20, 'iPhone 13 PRO MAX', 3, 22, 32, '1299.79', '1209.79', '8, 6, 4, 1', '10, 9, 8, 7', 10, 'good', '', '', '', 'iphone13promaxden.jpg'),
(22, 'iPhone 12 PRO MAX', 3, 22, 32, '749.49', '709.79', '8, 6, 3', '9, 8, 7', 2, 'ncc', '', '', '', 'cate2.webp'),
(23, 'iPhone X', 3, 22, 32, '599.79', '549.79', '5', '9, 8, 7', 1, 'ktjbnrs', '', '', '', 'cate10.webp'),
(24, 'iPhone 8', 3, 22, 32, '399.79', '359.79', '6, 4', '9, 8, 7', 2, 'jbkj', '', '', '', 'iphone8plusda.png'),
(26, 'iPhone 14 PRO MAX', 3, 22, 32, '1699.79', '1609.79', '7, 6, 1', '12, 10, 9, 8, 7', 2, 'ncc', '', '', '', 'cate1-gold.webp'),
(30, 'iPad Pro 11 (2020)', 3, 20, 40, '1249.79', '1209.79', '6, 4', '8, 7', 2, '<p>tốt </p>', '', '', '', 'ipad2.webp'),
(31, 'MacBook Air M2', 2, 25, 36, '1499.79', '1449.99', '6, 4', '10', 1, '<p>grvdvd</p>', '', '', '', 'macbook_air_m2_1_1.webp'),
(32, 'Vertu Signature S Full Gold Diamond', 3, 21, 38, '48999.79', '48699.79', '1', '8, 7', 1, '<p>dfsbsdb</p>', '', '', '', 'vertu1.webp');
-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_img_desc`
--

CREATE TABLE `tbl_product_img_desc` (
  `product_id` int(11) NOT NULL,
  `product_img_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_product_img_desc`
--

INSERT INTO `tbl_product_img_desc` (`product_id`, `product_img_desc`) VALUES
(1, 'iphone8plusda.png'),
(1, 'iphone8plusden.png'),
(1, 'iphone8plusminhhoa.png'),
(1, 'iphone8plusminhhoa2.png'),
(3, 'iphone13promax.jpg'),
(3, 'iphone13promaxden.jpg'),
(3, 'iphone13promaxtrang.jpg'),
(3, 'iphone13promaxvang.jpg'),
(4, 'iphone14promax.png'),
(4, 'iphone14promaxtrang.png'),
(4, 'iphone14promaxvang.png'),
(4, 'thongtiniphone14promax.png'),
(7, 'iphone13promax.jpg'),
(7, 'iphone13promaxden.jpg'),
(7, 'iphone13promaxtrang.jpg'),
(7, 'iphone13promaxvang.jpg'),
(8, 'iphone8plus.png'),
(8, 'iphone8plusda.png'),
(8, 'iphone8plusden.png'),
(8, 'iphone8plusminhhoa.png'),
(9, 'iphone13promax.jpg'),
(9, 'iphone13promaxden.jpg'),
(9, 'iphone13promaxtrang.jpg'),
(9, 'iphone13promaxvang.jpg'),
(10, 'iphone13promax.jpg'),
(10, 'iphone13promaxden.jpg'),
(10, 'iphone13promaxtrang.jpg'),
(10, 'iphone13promaxvang.jpg'),
(11, 'iphone14promax.png'),
(11, 'iphone14promaxtrang.png'),
(11, 'iphone14promaxvang.png'),
(12, 'iphone13promax.jpg'),
(12, 'iphone13promaxden.jpg'),
(12, 'iphone13promaxtrang.jpg'),
(12, 'iphone13promaxvang.jpg'),
(13, 'iphone13promax.jpg'),
(13, 'iphone13promaxden.jpg'),
(13, 'iphone13promaxtrang.jpg'),
(13, 'iphone13promaxvang.jpg'),
(14, 'iphone13promax.jpg'),
(14, 'iphone13promaxden.jpg'),
(14, 'iphone13promaxtrang.jpg'),
(14, 'iphone13promaxvang.jpg'),
(15, 'iphone13promax.jpg'),
(15, 'iphone13promaxden.jpg'),
(15, 'iphone13promaxtrang.jpg'),
(15, 'iphone13promaxvang.jpg'),
(16, 'cate1-black.webp'),
(16, 'cate1-gold.webp'),
(16, 'cate2.webp'),
(16, 'cate3.webp'),
(6, 'cate1-black.webp'),
(6, 'cate1-gold.webp'),
(6, 'cate1-sm-tim.webp'),
(17, 'cate1-black.webp'),
(17, 'cate1-gold.webp'),
(17, 'cate2.webp'),
(17, 'cate3.webp'),
(18, 'cate5.webp'),
(18, 'cate10.webp'),
(18, 'cate11.webp'),
(18, 'cate12.webp'),
(19, 'cate1-gold.webp'),
(19, 'cate1-white.webp'),
(19, 'cate1.webp'),
(19, 'cate2.webp'),
(20, 'iphone13promax.jpg'),
(20, 'iphone13promaxden.jpg'),
(20, 'iphone13promaxtrang.jpg'),
(20, 'iphone13promaxvang.jpg'),
(21, 'iphone14promax.png'),
(21, 'iphone14promaxtrang.png'),
(21, 'iphone14promaxvang.png'),
(22, 'cate5.webp'),
(22, 'cate10.webp'),
(22, 'cate11.webp'),
(23, 'cate5.webp'),
(23, 'cate10.webp'),
(23, 'cate11.webp'),
(24, 'cate5.webp'),
(24, 'cate10.webp'),
(24, 'cate11.webp'),
(25, 'iphone13den.jpg'),
(25, 'iphone13promax.jpg'),
(25, 'iphone13promaxden.jpg'),
(25, 'iphone13promaxtrang.jpg'),
(25, 'iphone13promaxvang.jpg'),
(26, 'cate1-gold.webp'),
(26, 'cate1-white.webp'),
(26, 'cate1.webp'),
(27, 'vertu1.webp'),
(28, 'iphone13promax.jpg'),
(28, 'iphone13promaxden.jpg'),
(28, 'iphone13promaxtrang.jpg'),
(28, 'iphone13promaxvang.jpg'),
(29, 'cate5.webp');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock`
--

CREATE TABLE `tbl_stock` (
  `stock_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(3) NOT NULL,
  `email` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` int(10) NOT NULL,
  `verification_code` int(6) NOT NULL,
  `registration_time` datetime NOT NULL DEFAULT current_timestamp(),
  `role` varchar(255) DEFAULT 'user',
  `is_online` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `fullname`, `address`, `phone`, `verification_code`, `registration_time`, `role`, `is_online`) VALUES
(1, 'techdiscoverys@gmail.com', 'TechDiscovery', '$2y$10$Eq3ogqWuNsHqkQUPvimUi.09tp0gtFn9TbfUQC86OL7DPqrVqK5rq', 'TECHDISCOVERY', '666/666/666', 901020304, 339147, '2023-08-19 10:47:46', 'admin', 1),
(2, 'phamphudien601@gmail.com', '44', '$2y$10$GMpRtdb0ONzPl1KETLGqIuTqs97euRbOy7WxNn32KOR16WhDeKeQ2', '44', '44', 44, 0, '2023-08-21 03:58:45', 'user', 0),
(3, 'phamphudien701@gmail.com', '4444', '$2y$10$V9MXBeC2Eub2vioWWaK0iOpMSVbppSbbHtV7T6XCcyBuoqXvYLK2C', '4444', '4444', 4444, 0, '2023-08-21 04:01:03', 'user', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `tbl_cartegory`
--
ALTER TABLE `tbl_cartegory`
  ADD PRIMARY KEY (`cartegory_id`);

--
-- Indexes for table `tbl_cartegory_main`
--
ALTER TABLE `tbl_cartegory_main`
  ADD PRIMARY KEY (`cartegory_main_id`);

--
-- Indexes for table `tbl_color`
--
ALTER TABLE `tbl_color`
  ADD PRIMARY KEY (`color_id`);

--
-- Indexes for table `tbl_memory_ram`
--
ALTER TABLE `tbl_memory_ram`
  ADD PRIMARY KEY (`memory_ram_id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tbl_order_items`
--
ALTER TABLE `tbl_order_items`
  ADD PRIMARY KEY (`order_item_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `coupon_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tbl_cartegory`
--
ALTER TABLE `tbl_cartegory`
  MODIFY `cartegory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_cartegory_main`
--
ALTER TABLE `tbl_cartegory_main`
  MODIFY `cartegory_main_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_color`
--
ALTER TABLE `tbl_color`
  MODIFY `color_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_memory_ram`
--
ALTER TABLE `tbl_memory_ram`
  MODIFY `memory_ram_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_order_items`
--
ALTER TABLE `tbl_order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
