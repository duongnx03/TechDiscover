-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 24, 2023 at 02:07 PM
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
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `quantity` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`coupon_id`, `code`, `amount`, `expiry_date`, `created_at`, `updated_at`, `quantity`) VALUES
(62, 'CODE01', 50, '2023-08-21 20:22:00', '2023-08-19 08:21:26', '2023-08-19 13:21:26', 2),
(65, 'CODE02', 50, '2023-08-20 19:58:00', '2023-08-20 07:57:06', '2023-08-20 12:57:06', 2);

-- --------------------------------------------------------

--
-- Table structure for table `danhgia`
--

CREATE TABLE `danhgia` (
  `danhgia_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `danhgia`
--

INSERT INTO `danhgia` (`danhgia_id`, `product_id`, `user_id`, `name`, `email`, `rating`, `comment`, `created_at`) VALUES
(119, 4, 1, 'Student1407989', 'votrung10a3nh1@gmail.com', 4, 'ttr', '2023-08-22 05:41:52'),
(121, 4, 1, 'TRUNG', 'admin@gmail.com', 4, 'fede', '2023-08-22 08:31:21'),
(122, 4, 1, 'rfr', 'trungvo.11062004@gmail.com', 4, 'e', '2023-08-22 09:28:45'),
(123, 32, 1, 'tr', 'ew@gmail.com', 4, 'ưe', '2023-08-22 09:39:59'),
(124, 32, 1, 'hegbjhwe', 'a@gmai.com', 5, 'ew', '2023-08-22 09:53:34'),
(125, 32, 1, 'f', 'votrung10a3nh1@gmail.com', 1, '3', '2023-08-22 10:08:11'),
(126, 32, 1, 'f', 'votrung10a3nh1@gmail.com', 1, '3', '2023-08-22 10:09:31'),
(127, 31, 1, 'hdbe', 'votrung10a3nh1@gmail.com', 4, '2', '2023-08-22 10:12:08'),
(128, 20, 1, 'jfbkd', 'votrung10a3nh1@gmail.com', 4, 'ưe', '2023-08-22 10:12:33'),
(129, 31, 1, 'hdbe', 'votrung10a3nh1@gmail.com', 4, '2', '2023-08-22 10:20:23');

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `id` int(11) NOT NULL,
  `discount_code` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`id`, `discount_code`) VALUES
(1, 'tri123'),
(2, 'tri234');

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE `survey` (
  `survey_id` int(11) NOT NULL,
  `web` varchar(222) DEFAULT NULL,
  `gia` varchar(222) DEFAULT NULL,
  `spcu` varchar(222) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(31, 22, 'SAMSUNG', 3),
(32, 22, 'iPhone', 3),
(36, 25, 'MacBook AIR', 2),
(37, 25, 'MacBook Pro', 2),
(39, 20, 'iPad Air', 3),
(40, 20, 'iPad Pro', 3);

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
  `fullname` varchar(250) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(250) NOT NULL,
  `province` varchar(250) NOT NULL,
  `district` varchar(250) NOT NULL,
  `ward` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `status_payment` varchar(250) NOT NULL,
  `total_order` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `user_id`, `order_date`, `payment_method`, `order_status`, `fullname`, `phone`, `email`, `province`, `district`, `ward`, `address`, `status_payment`, `total_order`) VALUES
(89, 5, '2023-08-22 07:40:55', 'COD', 'delivered', 'Nguyễn Minh Trí', '0375703783', 'minhtri120604@gmail.com', 'Thành phố Hồ Chí Minh', 'Quận Bình Thạnh', 'Phường 25', '36/44/10 Nguyen Gia Tri', 'Order has been paid', 361.96);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_items`
--

CREATE TABLE `tbl_order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_img` varchar(250) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `product_color` varchar(50) NOT NULL,
  `product_memory_ram` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order_items`
--

INSERT INTO `tbl_order_items` (`order_item_id`, `order_id`, `product_img`, `product_name`, `product_color`, `product_memory_ram`, `quantity`, `user_id`) VALUES
(79, 89, 'iphone8plusda.png', 'iPhone 8', 'Black', '64GB', 1, 0);

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
  `product_price` float NOT NULL,
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
(20, 'iPhone 13 PRO MAX', 3, 22, 32, 1299.79, '1209.79', '8, 6, 4, 1', '10, 9, 8, 7', 10, 'good', '', '', '', 'iphone13promaxden.jpg'),
(22, 'iPhone 12 PRO MAX', 3, 22, 32, 749.49, '709.79', '8, 6, 3', '9, 8, 7', 2, 'ncc', '', '', '', 'cate2.webp'),
(23, 'iPhone X', 3, 22, 32, 599.79, '549.79', '5', '9, 8, 7', 1, 'ktjbnrs', '', '', '', 'cate10.webp'),
(24, 'iPhone 8', 3, 22, 32, 399.79, '359.79', '6, 4', '9, 8, 7', 2, 'jbkj', '', '', '', 'iphone8plusda.png'),
(26, 'iPhone 14 PRO MAX', 3, 22, 32, 1699.79, '1609.79', '7, 6, 1', '12, 10, 9, 8, 7', 2, 'ncc', '', '', '', 'cate1-gold.webp'),
(30, 'iPad Pro 11 (2020)', 3, 20, 40, 1249.79, '1209.79', '6, 4', '8, 7', 2, '<p>tốt </p>', '', '', '', 'ipad2.webp'),
(31, 'MacBook Air M2', 2, 25, 36, 1499.79, '1449.99', '6, 4', '10', 1, '<p>grvdvd</p>', '', '', '', 'macbook_air_m2_1_1.webp');

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
(27, 'vertu1.webp'),
(28, 'iphone13promax.jpg'),
(28, 'iphone13promaxden.jpg'),
(28, 'iphone13promaxtrang.jpg'),
(28, 'iphone13promaxvang.jpg'),
(20, 'iphone13promaxden.jpg'),
(20, 'iphone13promaxtrang.jpg'),
(20, 'iphone13promaxvang.jpg'),
(29, 'cate1-gold.webp'),
(29, 'cate1-white.webp'),
(29, 'cate1.webp'),
(29, 'cate10.webp'),
(29, 'cate11.webp'),
(29, 'cate12.webp'),
(30, 'ipad2.webp'),
(31, 'macbook_air_m2_1_1.webp'),
(26, 'cate1-gold.webp'),
(26, 'cate1-white.webp'),
(26, 'cate1.webp'),
(26, 'cate2.webp'),
(32, 'vertu1.webp');

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
-- Table structure for table `tbl_wishlist`
--

CREATE TABLE `tbl_wishlist` (
  `wishlist_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_color` varchar(250) NOT NULL,
  `product_memory_ram` varchar(50) NOT NULL,
  `product_img` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `total` int(11) NOT NULL
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `fullname`, `address`, `phone`, `verification_code`, `registration_time`, `role`, `is_online`) VALUES
(1, 'techdiscoverys@gmail.com', 'TechDiscovery', '$2y$10$Eq3ogqWuNsHqkQUPvimUi.09tp0gtFn9TbfUQC86OL7DPqrVqK5rq', 'TECHDISCOVERY', '666/666/666', 901020304, 339147, '2023-08-19 10:47:46', 'admin', 0),
(3, 'phamphudien701@gmail.com', '4444', '$2y$10$Zfyp3xXMRorbUzcs4KfCC.uOxAanftJ7krqowN2r.jg.36.LgYCyy', '4444', '4444', 4444, 0, '2023-08-21 04:01:03', 'user', 0),
(4, 'phamphudien901@gmail.com', '22', '$2y$10$Fp/aWey.IGyrfk5rhz3fYe9/x9CrBl1C7OL3Y4Kz.ohBnibNcq71y', '22', '22', 2147483647, 298827, '2023-08-21 09:04:23', 'user', 0),
(5, 'phamphudien501@gmail.com', '555', '$2y$10$H5ibKZ8PpGtaklHKx/6UDOVZqYZF.h84UZmLy5aFhMuIB9VbDlcSW', '22', '22', 2147483647, 610382, '2023-08-22 10:02:33', 'user', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_discounts`
--

CREATE TABLE `user_discounts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `discount_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Indexes for table `danhgia`
--
ALTER TABLE `danhgia`
  ADD PRIMARY KEY (`danhgia_id`),
  ADD KEY `danhgia_product_id_foreign` (`product_id`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`survey_id`);

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
-- Indexes for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  ADD PRIMARY KEY (`wishlist_id`);

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
  MODIFY `coupon_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `danhgia`
--
ALTER TABLE `danhgia`
  MODIFY `danhgia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `survey`
--
ALTER TABLE `survey`
  MODIFY `survey_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

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
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `tbl_order_items`
--
ALTER TABLE `tbl_order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;


-- --------------------------------------------------------

--
-- Table structure for table `tbl_blog_category`
--

CREATE TABLE `tbl_blog_category` (
  `blog_cate_id` int(11) NOT NULL,
  `blog_cate_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_blog_category`
--

INSERT INTO `tbl_blog_category` (`blog_cate_id`, `blog_cate_name`) VALUES
(1, 'Technology');
(2, 'News');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_blog_category`
--
ALTER TABLE `tbl_blog_category`
  ADD PRIMARY KEY (`blog_cate_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_blog_category`
--
ALTER TABLE `tbl_blog_category`
  MODIFY `blog_cate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

--
-- Table structure for table `tbl_blog`
--

CREATE TABLE `tbl_blog` (
  `blog_id` int(11) NOT NULL,
  `blog_cate_id` int(11) NOT NULL,
  `blog_title` varchar(255) NOT NULL,
  `blog_author` varchar(255) NOT NULL,
  `blog_date` varchar(255) NOT NULL,
  `blog_content` longtext NOT NULL,
  `blog_image` varchar(255) NOT NULL,
  `blog_tags` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_blog`
--

INSERT INTO `tbl_blog` (`blog_id`, `blog_cate_id`, `blog_title`, `blog_author`, `blog_date`, `blog_content`, `blog_image`, `blog_tags`) VALUES
(2, 2, 'Truyền thông phương Tây trái chiều về vụ máy bay nghi chở trùm Wagner rơi', 'DuongNX', '25 August, 2023', '<p>vbb</p>', 'may-bay-1692890770-1568-1692890964.jpg', 'good');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_blog`
--
ALTER TABLE `tbl_blog`
  ADD PRIMARY KEY (`blog_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_blog`
--
ALTER TABLE `tbl_blog`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
