-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2025 at 07:45 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
(129, 14, 16, 'lavendor rose', 13, 1, 'lavendor rose.jpg'),
(130, 14, 18, 'red tulipa', 11, 1, 'red tulipa.jpg'),
(131, 14, 15, 'cottage rose', 15, 1, 'cottage rose.jpg'),
(132, 15, 13, 'pink rose', 10, 1, 'pink roses.jpg'),
(133, 15, 15, 'cottage rose', 15, 1, 'cottage rose.jpg'),
(134, 15, 16, 'lavendor rose', 13, 3, 'lavendor rose.jpg'),
(160, 20, 90, 'Nhẫn bạc nữ đính kim cương Moissanite Eleanor LILI_054801', 44, 2, 'a20.jpg'),
(161, 16, 3, 'Cá Betta', 10000, 1, 'a9.jpg'),
(162, 16, 6, 'Cá Hồng Két', 12000, 1, 'a12.jpg'),
(163, 16, 10, 'Cá Chuột Mỹ', 7000, 1, 'a16.jpg'),
(164, 23, 3, 'Microphone thu âm không dây Boya BY-V2 V2.0 (Lightning, 2 Mic)', 1000000, 1, 'a9.jpg'),
(165, 23, 19, 'Micro Karaoke tích hợp loa Bluetooth Monster M98 - Chính hãng', 5000000, 1, 'a25.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(13, 14, 'shaikh anas', 'shaikh@gmail.com', '0987654321', 'hi, how are you?');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(24, 16, 'OMEGA', '332', 'zzzz@gmail.com', 'cash on delivery', 'flat no. A, D, B, VIỆT NAM - 222222', ', Bông tai bạc nữ tròn đính đá CZ hình chú bướm xinh LILI_184545 (2) , Dây chuyền bạc nữ đính đá CZ hình trái tim Heart Of The Sea LILI_413928 (3) ', 24978, '18-Sep-2024', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(1000) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `price`, `image`, `category`) VALUES
(1, 'Rolex Oyster Perpetual 41', 'Đồng hồ automatic chính hãng Thụy Sĩ, mặt xanh dương, bộ máy Calibre 3230 với sai số cực thấp và độ bền vượt trội.', 500000, 'a7.jpg', 'Đồng hồ cơ Thụy Sĩ'),
(2, 'Seiko Presage SRPB41J1', 'Dòng cocktail time nổi tiếng của Seiko với mặt số tỏa sáng, máy 4R35 bền bỉ và thiết kế thanh lịch.', 750000, 'a8.jpg', 'Đồng hồ cơ Nhật Bản'),
(3, 'Tissot Le Locle Powermatic 80', 'Đồng hồ Thụy Sĩ chính hãng, dự trữ năng lượng 80 giờ, dây thép không gỉ cao cấp, mặt khắc Guilloche.', 1000000, 'a9.jpg', 'Đồng hồ automatic'),
(4, 'Casio G-Shock GA-2100-1A1', 'Thiết kế carbon core guard chống va đập, đồng hồ thể thao mạnh mẽ, chống nước 200m.', 1250000, 'a10.jpg', 'Đồng hồ thể thao'),
(5, 'Citizen Eco-Drive AW1231-07E', 'Đồng hồ năng lượng ánh sáng, mặt đen lịch lãm, dây da nâu, không cần thay pin.', 1500000, 'a11.jpg', 'Đồng hồ năng lượng mặt trời'),
(6, 'Orient Bambino FAC00008W0', 'Đồng hồ cơ automatic với mặt kính cong cổ điển, mặt số đơn giản dễ đọc, vỏ thép không gỉ.', 1750000, 'a12.jpg', 'Đồng hồ dresswatch'),
(7, 'Fossil Grant FS5151', 'Đồng hồ chronograph dây da, mặt xanh dương cổ điển, cọc số La Mã, phong cách Mỹ hiện đại.', 2000000, 'a13.jpg', 'Đồng hồ thời trang'),
(8, 'Omega Seamaster Diver 300M', 'Đồng hồ lặn chuyên dụng, bộ máy Co-Axial, khả năng chống nước 300m, mặt số sóng xanh.', 2250000, 'a14.jpg', 'Đồng hồ lặn'),
(9, 'Rolex Datejust 36', 'Đồng hồ biểu tượng với mặt số cổ điển, chức năng lịch ngày và bộ vỏ Oyster bền bỉ.', 2500000, 'a15.jpg', 'Đồng hồ sang trọng'),
(10, 'Seiko 5 SNK809', 'Dòng đồng hồ cơ quốc dân, giá tốt, dây nato, máy 7S26 mạnh mẽ, mặt số quân đội.', 2750000, 'a16.jpg', 'Đồng hồ phổ thông'),
(11, 'Tissot PRX Quartz', 'Thiết kế vỏ tích hợp dây thép, mặt số xanh navy, kính sapphire, máy quartz Thụy Sĩ.', 3000000, 'a17.jpg', 'Đồng hồ vintage'),
(12, 'Casio Edifice EFV-100D-1AV', 'Đồng hồ quartz nam mặt đen, thiết kế đơn giản, chống nước 100m, vỏ thép không gỉ.', 3250000, 'a18.jpg', 'Đồng hồ doanh nhân'),
(13, 'Citizen NH8350-59L', 'Đồng hồ cơ mặt xanh navy, dây thép, kính cứng, máy Miyota automatic ổn định.', 3500000, 'a19.jpg', 'Đồng hồ văn phòng'),
(14, 'Orient Kamasu RA-AA0004E19B', 'Đồng hồ lặn mặt xanh lá, viền xoay, kính sapphire, máy cơ có lên cót tay.', 3750000, 'a20.jpg', 'Đồng hồ lặn'),
(15, 'Fossil ME3110 Townsman', 'Đồng hồ lộ cơ, dây da màu nâu cổ điển, mặt kính khoáng, thiết kế thời thượng.', 4000000, 'a21.jpg', 'Đồng hồ thời trang nam'),
(16, 'Omega Speedmaster Moonwatch', 'Đồng hồ chronograph nổi tiếng từng đi cùng NASA lên mặt trăng, thiết kế mang tính biểu tượng.', 4250000, 'a22.jpg', 'Đồng hồ chronograph'),
(17, 'Rolex Submariner Date', 'Mẫu Submariner biểu tượng với bezel gốm đen, chống nước 300m, bộ máy Rolex 3235.', 4500000, 'a23.jpg', 'Đồng hồ lặn cao cấp'),
(18, 'Seiko 5 Sports SRPD55K1', 'Đồng hồ thể thao cơ tự động, mặt số đen, dây thép, khả năng chống nước 100m.', 4750000, 'a24.jpg', 'Đồng hồ thể thao'),
(19, 'Tissot Gentleman Silicium', 'Đồng hồ automatic với dây tóc silicon chống từ, trữ cót 80 giờ, thiết kế thanh lịch.', 5000000, 'a25.jpg', 'Đồng hồ cơ cao cấp'),
(20, 'Casio MTP-V002D-1B3UDF', 'Đồng hồ quartz đơn giản, dây thép bạc, mặt số đen dễ nhìn, phù hợp mọi đối tượng.', 5250000, 's1.jpg', 'Đồng hồ giá rẻ'),
(21, 'Citizen Chronograph AN8170-59E', 'Đồng hồ thể thao 3 sub-dials, dây thép, mặt số đen, bấm giờ chính xác.', 5500000, 's2.jpg', 'Đồng hồ chronograph'),
(22, 'Orient Star Retro-Future', 'Đồng hồ cơ thiết kế đặc biệt lấy cảm hứng từ máy ảnh, mặt số đa tầng, lộ cơ độc đáo.', 5750000, 's3.jpg', 'Đồng hồ lộ cơ'),
(23, 'Fossil Machine FS4656', 'Đồng hồ dây kim loại đen mạnh mẽ, mặt số đơn giản, phong cách công nghiệp.', 6000000, 's4.jpg', 'Đồng hồ nam tính'),
(24, 'Omega De Ville Prestige', 'Đồng hồ thanh lịch mặt số trắng, máy Co-Axial, dây da, dành cho doanh nhân.', 6250000, 's5.jpg', 'Đồng hồ cao cấp'),
(25, 'G-Shock GM-2100', 'Dòng G-Shock vỏ thép cực bền, mặt số analog–digital, chống sốc, chống nước 200m.', 6500000, 's6.jpg', 'Đồng hồ thể thao');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user',
  `sdt` varchar(11) NOT NULL,
  `diachi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `sdt`, `diachi`) VALUES
(10, 'admin A', 'admin@gmail.com', '123456', 'admin', '', ''),
(14, 'user A', 'user01@gmail.com', '698d51a19d8a121ce581499d7b701668', 'user', '', ''),
(15, 'user B', 'user02@gmail.com', '698d51a19d8a121ce581499d7b701668', 'user', '', ''),
(16, 'iminzanti', 'zzzz@gmail.com', '53b57615da056996f4f899af04399c08', 'user', '', ''),
(19, 'van', 'van@gmail.com', '53b57615da056996f4f899af04399c08', 'user', '0333999912', 'Thanh Hóa'),
(20, 'test', 'test@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'admin', '0983844742', 'Thanh Hóa'),
(21, 'phuongthanh', 'phuongthanh@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'user', '03339999124', 'Hà Nội'),
(22, 'huyhai', 'huyhai@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'user', '0983844742', 'Thanh Hóa'),
(23, 'test1', 'test1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'user', '0983544654', 'Yên Bái');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `pid`, `name`, `price`, `image`) VALUES
(60, 14, 19, 'pink bouquet', 15, 'pink bouquet.jpg'),
(71, 20, 5, 'Cá Koi', 15000, 'a11.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
