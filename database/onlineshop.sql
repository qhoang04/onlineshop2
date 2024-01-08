-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:4306
-- Generation Time: Jan 08, 2024 at 04:46 PM
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
-- Database: `onlineshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `ip_address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `pro_id`, `qty`, `ip_address`, `user_id`) VALUES
(123, 16, 16, '::1', 1),
(124, 17, 4, '::1', 1),
(127, 17, 3, '::1', 11),
(128, 18, 3, '::1', 11),
(130, 17, 3, '::1', 12),
(131, 18, 2, '::1', 12),
(151, 18, 1, '127.0.0.1', 10),
(152, 29, 2, '127.0.0.1', 10),
(153, 28, 1, '127.0.0.1', 10),
(154, 27, 1, '127.0.0.1', 10),
(155, 23, 1, '127.0.0.1', 10),
(156, 24, 1, '127.0.0.1', 10),
(157, 26, 1, '127.0.0.1', 10),
(163, 31, 2, '127.0.0.1', 10),
(164, 20, 1, '127.0.0.1', 11);

-- --------------------------------------------------------

--
-- Table structure for table `main_cat`
--

CREATE TABLE `main_cat` (
  `cat_id` int(11) NOT NULL,
  `category_name` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `main_cat`
--

INSERT INTO `main_cat` (`cat_id`, `category_name`) VALUES
(35, 'Tranh'),
(36, 'Mô hình');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_amount` float DEFAULT NULL,
  `order_status` varchar(50) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `product_id`, `quantity`, `total_amount`, `order_status`, `order_date`, `address`, `city`) VALUES
(774, 9, 22, 1, 632000, 'Đang xử lý', '2023-12-24 15:12:05', '470 Trần Đại Nghĩa', 'Đà Nẵng'),
(775, 9, 17, 1, 1200000, 'Đang xử lý', '2023-12-24 15:12:05', '470 Trần Đại Nghĩa', 'Đà Nẵng'),
(776, 9, 27, 1, 550000, 'Đang xử lý', '2023-12-24 15:12:05', '470 Trần Đại Nghĩa', 'Đà Nẵng'),
(777, 9, 22, 1, 632000, 'Đang xử lý', '2023-12-30 03:17:12', '470 Trần Đại Nghĩa', 'Đà Nẵng'),
(778, 9, 17, 1, 1200000, 'Đang xử lý', '2023-12-30 03:17:12', '470 Trần Đại Nghĩa', 'Đà Nẵng'),
(779, 9, 27, 1, 550000, 'Đang xử lý', '2023-12-30 03:17:12', '470 Trần Đại Nghĩa', 'Đà Nẵng'),
(780, 9, 20, 2, 1770000, 'Đang xử lý', '2024-01-06 07:42:42', '470 Trần Đại Nghĩa', 'Đà Nẵng');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pro_id` int(11) NOT NULL,
  `product_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `cat_id` int(11) NOT NULL,
  `subcat_id` int(11) NOT NULL,
  `img1` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `img2` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `img3` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `img4` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `feature1` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `feature2` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `feature3` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `feature4` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `price` float NOT NULL,
  `pro_model` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `warranty` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `keyword` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pro_id`, `product_name`, `cat_id`, `subcat_id`, `img1`, `img2`, `img3`, `img4`, `feature1`, `feature2`, `feature3`, `feature4`, `price`, `pro_model`, `warranty`, `keyword`, `date_added`) VALUES
(17, 'Gundam kim loại', 36, 25, 'ececool-bandai-namco-freedom-gundam-zgmf-x10a-vergcp-ip075-sb-mp1159-3_f22f9b5c52874201870500e903842f64_master.webp', 'ececool-bandai-namco-freedom-gundam-zgmf-x10a-vergcp-ip075-sb-mp1159-4_039082db546543a8a9257e90f7cc4754_master.jpg', 'piececool-bandai-namco-freedom-gundam-zgmf-x10a-vergcp-ip075-sb-mp1159_35206c2e33404cf78f81ca789107cfde_master.webp', ' db5fefa47e4f44eb852a457baf051de6_03a13547fa4b409989a099b15cd8cb00_master.jpg', 'Chất liệu kim loại không gỉ', 'Kích thước 20x30cm', 'Phù hợp với người 14+', 'Sản phẩm chính hãng từ Bandai Namco', 1200000, ' ', ' 24 tháng', ' gundam mo hinh', '2023-11-29 00:41:48'),
(18, 'Luffy Gear 4', 36, 26, '250-3717-30.jpg', '250-3717-o1cn01szi0mu26nosw5iqiz_--2894937706.jpg', '250-3717-o1cn015jgdrf26nospr1nop_--2894937706.jpg', ' ', 'Chiều cao: 33cm', 'Cân nặng 2kg8', 'Chất liệu: PVC Nhựa cao cấp', 'Nhân vật Luffy - OnePiece', 1090000, ' luffy1', ' 24 tháng', 'onepiece luffy haitac mo hinh', '2023-11-29 00:54:05'),
(20, 'Tranh Cô Gái Và Lá Xanh', 35, 29, 'tranh-treo-tuong-co-gai-va-la-xanh-1_900x540.jpg', 'tranh-treo-tuong-co-gai-va-la-xanh-2_900x540.jpg', 'tranh-treo-tuong-co-gai-va-la-xanh-tg466-1_900x540.jpg', ' tranh-treo-tuong-co-gai-va-la-xanh-tg466-2_900x540.jpg', 'Trang trí căn nhà', 'Là dòng tranh công nghệ mới', 'Canva kích thước 30x40cm', 'Với nội dung, mẫu mã vô cùng đa dạng và phong phú', 885000, ' ', '    2 Năm', 'tranh thien nhien', '2023-12-09 20:30:01'),
(21, 'Tranh Thuyền Vàng Phát Tài', 35, 23, 'tranh-treo-tuong-thuyen-vang-phat-tai-2_900x540.jpg', 'tranh-treo-tuong-thuyen-vang-phat-tai-1_900x540 (1).jpg', 'tranh-treo-tuong-thuyen-vang-phat-tai-3_900x540.jpg', ' tranh-treo-tuong-thuyen-vang-phat-tai-1_900x540.jpg', 'Làm quà hoặc trang trí', 'Phù hợp với văn phòng', 'Thu hút tài lộc', 'Canva 30x40cm', 495000, ' ', '  12 Tháng', ' tranh phong thuy', '2023-12-09 20:42:58'),
(22, 'Tranh Hưu Cây Vàng', 35, 24, 'bo-3-tranh-treo-tuong-huou-vang-ben-dong-suoi-mau-24_900x540.jpg', 'bo-3-tranh-treo-tuong-huou-vang-ben-dong-suoi-mau-25_900x540.jpg', 'bo-3-tranh-treo-tuong-huou-vang-ben-dong-suoi-mau-23_900x540.jpg', ' bo-3-tranh-treo-tuong-huou-vang-ben-dong-suoi-mau-22_900x540.jpg', 'Mang đến tài lộc, tiền tài', 'Phù hợp làm quà, trang trí', 'Công nghệ mới xu hướng', 'Hiện đại sang trọng', 632000, ' ', ' 12 Tháng', ' tranh huu vang', '2023-12-09 20:23:17'),
(23, 'Tranh Chim Công xanh', 35, 24, 'tranh-chim-cong-xanh-treo-tuong-phong-thuy-phong-khach-mau-937-3_900x540.jpg', 'tranh-chim-cong-xanh-treo-tuong-phong-thuy-phong-khach-mau-937-4_900x540.jpg', 'tranh-chim-cong-xanh-treo-tuong-phong-thuy-phong-khach-mau-937-2_900x540.jpg', ' tranh-chim-cong-xanh-treo-tuong-phong-thuy-phong-khach-mau-937-1_900x540.jpg', 'Vẻ đẹp ấn tượng độc đáo', 'Phù hợp làm quà hoặc trang trí', 'Công nghệ mới xu hướng', 'Hiện đại sang trọng', 315000, ' TG3937', ' 12 Tháng', 'tranh chim cong', '2023-12-09 20:25:51'),
(24, 'Tranh Like Is Better U', 35, 23, 'tranh-treo-tuong-like-is-better-u-the-lake-2_900x540.jpg', 'tranh-treo-tuong-like-is-better-u-the-lake-3_900x540.jpg', 'tranh-treo-tuong-like-is-better-u-the-lake-1_900x540.jpg', ' ', 'Màu sắc xanh mát mẻ', 'Phù hợp làm quà hoặc trang trí', 'Vẻ đep hiện đại sang trọng', 'Được ưa chuộng và thịnh hành', 590000, ' TG1125', ' 12 Tháng', 'tranh like is bettter u', '2023-12-09 20:37:13'),
(25, 'Tranh Hoa Anh Đào', 35, 23, 'tranh-treo-tuong-nui-phu-si-va-hoa-anh-dao-10_900x540.jpg', 'tranh-treo-tuong-nui-phu-si-va-hoa-anh-dao-13_900x540.jpg', 'tranh-treo-tuong-nui-phu-si-va-hoa-anh-dao-12_900x540.jpg', ' tranh-treo-tuong-nui-phu-si-va-hoa-anh-dao-11_900x540.jpg', 'Thẫm mĩ cao, mang nhiều ý nghĩa', 'Phù hợp làm quà và trang trí', 'Mang không khí nước Nhật bản', 'Vẻ đẹp hiện đại sang trọng', 245000, ' TG3115', ' 12 Tháng', 'tranh hoa anh dao', '2023-12-09 20:42:01'),
(26, 'Kaido Dragon Resin (Bootleg)', 36, 26, '950-4-510x510.jpg', '950-1-510x510.jpg', '950-3-510x510.jpg', ' 950-2-510x510.jpg', 'Chi tiết sắc nét', 'Cân nặng 3kg', 'Chất liệu: PVC Nhựa cao cấp', 'Nhân vật Kaido - OnePiece', 5500000, ' kaido1', ' 24 Tháng', 'kaido onepiece mo hinh', '2023-12-09 21:02:27'),
(27, 'Genshin Impact: Ningguang / Condensed', 36, 30, 's-l1600-510x453.jpg', 'O1CN01uArUmn26a7NZwRzan_2947437677-510x510.jpg', 'O1CN019xrXtK26a7NZwRFra_2947437677-510x510.jpg', ' O1CN01yf1Bq226a7NehNmxW_2947437677-510x510.jpg', 'Chi tiết sắc nét', 'Cân nặng 1kg2', 'Chất liệu: PVC Nhựa cao cấp', 'Nhân vật: Ningguang', 550000, ' genshin1', ' 12 Tháng', 'genshin impact mo hinh', '2023-12-09 21:08:47'),
(28, 'Super Saiyan Goku', 36, 27, '22050009_1434874759952984_8594916537163973843_n-510x510.jpg', '22045669_1434874856619641_3723800487612031034_n-510x510.jpg', '22049892_1434875036619623_7702792011677998677_n-510x510.jpg', ' 22049800_1434875029952957_7395196597764955001_n-510x510.jpg', 'Chất liệu: PVC Nhựa cao cấp', 'Full box, new', 'Sắc nét chi tiết', 'Nhân vật: Goku', 480000, ' goku1', ' 12 Tháng', 'dragon ball goku mo hinh', '2023-12-09 21:12:15'),
(29, 'Nezuko Kamado 1/8 (Bootleg)', 36, 31, 'FIGURE-053294-510x510.jpg', 'FIGURE-053294_01-510x583.jpg', 'FIGURE-053294_02-510x478.jpg', ' FIGURE-053294_04-510x583.jpg', 'Full box, new', 'Chất liệu: PVC Nhựa cao cấp', 'Cân nặng 800g', 'Sắc nét chi tiết', 490000, ' nezuko1', ' 12 Tháng ', 'demon slayer nezuko mo hinh', '2023-12-09 21:17:29'),
(31, 'Mô hình mèo thất vọng', 36, 32, 'dc74606a31e52061f5c7bfd387aee761.jpg', '8229cf180f90a85b053addd8f67c5804.jpg', '873c183f6cc1d7215cf1c915b3e4d820.jpg', ' 1ea9ca0219c4a052fac3eb42b2ea29b8.jpg', 'Chất liệu nhựa PVC thân thiện', 'Mỗi em cao 5cm kèm đồ ăn', 'Thâm Quyến Yike Technology Co., Ltd.', '', 130000, ' ', '  3 Tháng', 'meo mo hinh', '2023-12-09 21:27:25'),
(33, 'Chỉ thêu tím', 38, 34, 'ab67616d00001e02dba06a7b8563e26c1e315bf6.jpg', '8229cf180f90a85b053addd8f67c5804.jpg', '', ' ', 'Chỉ thêu', 'pháp', '', '', 20000, ' chỉ', ' ', 'chi theu', '2023-12-22 21:17:51'),
(34, 'Zoro Dragon Tarnado', 36, 26, 'O1CN01itogVl2DM6NU4S2KW_80578594-510x510.jpg', 'O1CN01ts6a0j1YZThLbhfby_2269763073-510x510.jpg', 'O1CN01Zqalva1YZThP4tzVj_2269763073-510x510.png', ' ', 'Mô hình OnePiece', 'Chất lượng nhựa cao cấp', 'Tỉ lệ 1:1', 'Thích hợp để trang trí', 12439000, ' zoro resin', ' 24 Tháng', 'zoro onepiece mo hinh', '2024-01-05 03:06:18');

-- --------------------------------------------------------

--
-- Table structure for table `sub_cat`
--

CREATE TABLE `sub_cat` (
  `subcat_id` int(11) NOT NULL,
  `subcat_name` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `maincat_id` int(11) NOT NULL,
  `subcat_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sub_cat`
--

INSERT INTO `sub_cat` (`subcat_id`, `subcat_name`, `maincat_id`, `subcat_img`) VALUES
(23, 'Tranh phong cảnh', 35, 'tranhphongcanh.jpg'),
(24, 'Tranh phong thủy', 35, 'PT6673.jpg'),
(25, 'Gundam', 36, '326719-1.png'),
(26, 'One Piece', 36, 'onepiece.jpg'),
(27, 'Dragon Ball', 36, 'iqtrd5g4p8ax.jpg'),
(29, 'Tranh thiên nhiên', 35, 'ab67616d00001e02dba06a7b8563e26c1e315bf6.jpg'),
(30, 'Genshin Impact', 36, 'genshintall_1200x1600-4a5697be3925e8cb1f59725a9830cafc.jpg'),
(31, 'Demon Slayer', 36, 'demon-slayer-kimetsu-no-yaiba-the-hinokami-chronicles-review-featured.jpg'),
(32, 'Mèo', 36, 'pngtree-cute-little-cat-read-a-book-3d-model-render-digital-artwork-png-image_9051036.png');

-- --------------------------------------------------------

--
-- Table structure for table `super_admin`
--

CREATE TABLE `super_admin` (
  `super_id` int(11) NOT NULL,
  `super_name` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `phone` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `gender` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `city` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `user_img` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `dob` date NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `email`, `city`, `user_img`, `address`, `dob`, `phone`, `password`, `reg_date`) VALUES
(9, 'Quốc Hoàng', 'qhoang01@gmail.com', 'Đà Nẵng', NULL, '470 Trần Đại Nghĩa', '3222-12-31', '123123', '$2y$10$4qX4p1Yiytqku5.1zHK8heUgsPbjOkOYSiu1SORvQUWarmF3MITZ2', '2023-12-22 20:50:40'),
(10, 'Quốc Hoàng2', 'qhoang02@gmail.com', 'DN', NULL, 'DN', '0231-02-01', '123123', '$2y$10$mkAVTplBk7KC9WwM0PIJ3uWPjs7M3dfy.FgxmtlHXS4aWhdczFxUi', '2023-12-04 01:41:52'),
(11, 'Quốc Hoàng 3', 'qhoang03@gmail.com', '', NULL, 'DN', '2023-12-11', '1231122312', '$2y$10$L/lcz52PH8HCNMdYgnV7meuAfOJL7.iHpO2cWEGgTyRCPvJhfCL/q', '2023-12-06 00:47:48'),
(12, 'qhoang04', 'qhoang04@gmail.com', '', NULL, 'DN', '0000-00-00', '12312321312', '$2y$10$31jaMTeFcOiLbjvlwH0rs./V0nbzqctHwiH0Iipc3lwLvEcF3DeQi', '2023-12-06 21:51:34'),
(13, 'hoang', 'uuuu@gmail.com', '', NULL, 'DN', '2004-09-10', '123', '$2y$10$Qvpz5Yuy6hc8qygHNpHzFenQIHjQMqJOc9MRVh6rvdm.3yUF3CMVy', '2023-12-14 00:14:11'),
(14, 'yyyy', 'ttt@gmail.com', '', NULL, 'DD', '2023-12-18', '123', '$2y$10$0CMS.yDiLL45wgYKVCqk0OUlt/mK9tGlqE6aJfg342qw7gOG9kC/q', '2023-12-14 00:18:42'),
(15, 'qhoang', 'hhh@gmail.com', '', NULL, 'DD', '2023-12-19', '123', '$2y$10$w5mrMsdA4zentRmc4hSof.HoZ/ioXiwZI.PrstKPaSfytKNfe...y', '2023-12-14 00:33:50'),
(16, 'Võ Quốc Hoàng', 'quochoang@gmail.com', '', NULL, 'Đà Nẵng', '0000-00-00', '123123', '$2y$10$gxtrMufoONS3XJL5l5isdOnYw5YiS5fj/MJNFR8EiiSoMpJNks8TG', '2023-12-20 20:43:00'),
(17, 'Võ Quốc Hoàng', 'quochoang2@gmail.com', '', NULL, 'Đà Nẵng', '2004-09-12', '123', '$2y$10$eeeLRSBVmB0T3xTjZ7XeKuyAUHQaK/q5poU2iDR4csEnHZ6mT5E2K', '2023-12-20 20:49:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `main_cat`
--
ALTER TABLE `main_cat`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pro_id`),
  ADD KEY `pro_cat` (`cat_id`),
  ADD KEY `pro_subcat` (`subcat_id`);

--
-- Indexes for table `sub_cat`
--
ALTER TABLE `sub_cat`
  ADD PRIMARY KEY (`subcat_id`),
  ADD KEY `main_cat_fk` (`maincat_id`);

--
-- Indexes for table `super_admin`
--
ALTER TABLE `super_admin`
  ADD PRIMARY KEY (`super_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

--
-- AUTO_INCREMENT for table `main_cat`
--
ALTER TABLE `main_cat`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=781;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `sub_cat`
--
ALTER TABLE `sub_cat`
  MODIFY `subcat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `super_admin`
--
ALTER TABLE `super_admin`
  MODIFY `super_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`pro_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
