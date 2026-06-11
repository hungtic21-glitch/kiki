-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 11, 2026 lúc 04:07 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `268_gaming`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `contacts`
--

INSERT INTO `contacts` (`id`, `fullname`, `email`, `phone`, `message`, `created_at`) VALUES
(1, 'Nguyễn Văn Tuấn Hưng ', 'hungtic21@gmail.com', '2442424144', 'cccccc', '2026-06-04 10:32:37'),
(2, 'huỳnh phúc hiếu ', 'huynhphuchieu811@gmail.com', '0972167527', 'như chim', '2026-06-08 08:55:26');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `login_log`
--

CREATE TABLE `login_log` (
  `log_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `login_log`
--

INSERT INTO `login_log` (`log_id`, `email`, `status`, `ip_address`, `login_time`) VALUES
(3, 'hungtic21@gmail.com', 'failed', '::1', '2026-06-04 01:26:47'),
(4, 'hungtic21@gmail.com', 'success', '::1', '2026-06-04 01:31:02'),
(5, 'hungtic21@gmail.com', 'success', '::1', '2026-06-04 02:02:53'),
(6, 'hungtic21@gmail.com', 'success', '::1', '2026-06-04 02:32:37'),
(7, 'hungtic21@gmail.com', 'failed', '::1', '2026-06-08 01:01:33'),
(8, 'hungtic21@gmail.com', 'success', '::1', '2026-06-08 01:01:39'),
(9, 'hungtic21@gmail.com', 'success', '::1', '2026-06-08 01:25:26'),
(10, 'hungtic21@gmail.com', 'failed', '::1', '2026-06-08 01:52:11'),
(11, 'hungtic21@gmail.com', 'success', '::1', '2026-06-08 01:52:17'),
(12, 'hungtic21@gmail.com', 'success', '::1', '2026-06-08 02:08:40'),
(13, 'hungtic21@gmail.com', 'success', '::1', '2026-06-08 02:26:44'),
(14, 'hungtic21@gmail.com', 'success', '::1', '2026-06-08 02:43:05'),
(15, 'hungtic21@gmail.com', 'success', '::1', '2026-06-08 02:44:49'),
(16, 'huynhphuchieu@gmail.com', 'failed', '::1', '2026-06-08 02:58:47'),
(17, 'huynhphuchieu811@gmail.com', 'failed', '::1', '2026-06-08 02:58:52'),
(18, 'huynhphuchieu811@gmail.com', 'failed', '::1', '2026-06-08 02:58:57'),
(19, 'hungtic21@gmail.com', 'success', '::1', '2026-06-08 02:59:10'),
(20, 'hungtic21@gmail.com', 'success', '::1', '2026-06-08 03:01:37'),
(21, 'hungtic21@gmail.com', 'success', '::1', '2026-06-08 03:04:00'),
(22, 'hungtic21@gmail.com', 'success', '::1', '2026-06-08 03:04:36'),
(23, 'hungtic21@gmail.com', 'success', '::1', '2026-06-10 01:11:14'),
(24, 'hungtic21@gmail.com', 'success', '::1', '2026-06-10 01:23:00'),
(25, 'hungtic21@gmail.com', 'success', '::1', '2026-06-10 02:22:26'),
(26, 'hungtic21@gmail.com', 'success', '::1', '2026-06-10 02:26:17'),
(27, 'hungtic21@gmail.com', 'success', '::1', '2026-06-10 02:26:25'),
(28, 'hungtic21@gmail.com', 'success', '::1', '2026-06-10 02:26:32'),
(29, 'hungtic21@gmail.com', 'success', '::1', '2026-06-10 02:26:49'),
(30, 'hungtic21@gmail.com', 'success', '::1', '2026-06-10 02:27:01'),
(31, 'hungtic21@gmail.com', 'success', '::1', '2026-06-10 02:31:14'),
(32, 'hungtic21@gmail.com', 'success', '::1', '2026-06-10 02:32:23'),
(33, 'hungtic21@gmail.com', 'success', '::1', '2026-06-10 02:34:10'),
(34, 'hungtic21@gmail.com', 'success', '::1', '2026-06-10 02:34:33'),
(35, 'hungtic21@gmail.com', 'success', '::1', '2026-06-10 02:49:00'),
(36, 'hungtic21@gmail.com', 'success', '::1', '2026-06-10 03:16:00'),
(37, 'hungtic21@gmail.com', 'success', '::1', '2026-06-11 00:05:07'),
(38, 'hungtic21@gmail.com', 'success', '::1', '2026-06-11 00:48:08'),
(39, 'hungtic21@gmail.com', 'success', '::1', '2026-06-11 01:58:13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_phone` varchar(50) NOT NULL,
  `shipping_address` text NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `total_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `cart_details` text DEFAULT NULL,
  `order_status` varchar(50) NOT NULL DEFAULT 'Chờ xử lý',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `customer_name`, `customer_phone`, `shipping_address`, `payment_method`, `total_amount`, `cart_details`, `order_status`, `created_at`) VALUES
(1, 1, 'Nguyễn Văn Tuấn Hưng - WE2401', '679', 'brazil', 'Banking', 37980000.00, NULL, 'Chờ xử lý', '2026-06-04 01:36:02'),
(2, 1, 'NGUYỄN VĂN A', '0987654321', 'Thanh toán trực tiếp Web', 'Banking', 77970000.00, NULL, 'Chờ xử lý', '2026-06-04 01:49:30'),
(3, 1, 'NGUYỄN VĂN A', '0987654321', 'Thanh toán trực tiếp Web', 'Banking', 92160000.00, NULL, 'Chờ xử lý', '2026-06-04 01:53:31'),
(4, 1, 'NGUYỄN VĂN A', '0987654321', 'Thanh toán trực tiếp Web', 'Banking', 33180000.00, NULL, 'Chờ xử lý', '2026-06-04 01:54:12'),
(5, 1, 'NGUYỄN VĂN A', '0987654321', 'Thanh toán trực tiếp Web', 'Banking', 77970000.00, NULL, 'Chờ xử lý', '2026-06-04 02:33:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`detail_id`, `order_id`, `product_id`, `quantity`, `unit_price`) VALUES
(1, 1, 2, 2, 18990000.00),
(2, 2, 3, 1, 25990000.00),
(3, 2, 4, 1, 32990000.00),
(4, 2, 2, 1, 18990000.00),
(5, 3, 1, 1, 14190000.00),
(6, 3, 2, 1, 18990000.00),
(7, 3, 3, 1, 25990000.00),
(8, 3, 4, 1, 32990000.00),
(9, 4, 1, 1, 14190000.00),
(10, 4, 2, 1, 18990000.00),
(11, 5, 2, 1, 18990000.00),
(12, 5, 3, 1, 25990000.00),
(13, 5, 4, 1, 32990000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `price`, `created_at`) VALUES
(1, 'Laptop MSI Modern 14 F13MG 466VN', 'image/msi_modern_14_f13mg_bac_01_66ddd_4e8c1cfbdc6e42309ebb2a32372c638d_grande.png', 14190000.00, '2026-06-04 00:42:07'),
(2, 'Laptop Asus ExpertBook P3 P3405CVA-NZ0027W', 'image/laptop-asus-expertbook-p3-p3405cva-nz0027w-1_c8c90bddf46c42a491694d4d5a4396d2_grande.jpg', 18990000.00, '2026-06-04 00:42:07'),
(3, 'Laptop ASUS ExpertBook P1403CVA-C5H16-50W', 'image/laptop-asus-expertbook-p1403cva-c5h16-50w-1_7b1ab501dd6b44bc822f0fcfc8d15315_grande.jpg', 25990000.00, '2026-06-04 00:42:07'),
(4, 'Laptop MSI Prestige 13 AI Evo A1MG 062VN', 'image/ava_f4961f3432f84674b7d37c5fbeb3aa17_grande.png', 32990000.00, '2026-06-04 00:42:07'),
(5, 'Laptop gaming Acer Nitro Lite 16 NL16 71G 56WQ', 'https://product.hstatic.net/200000722513/product/acer-gaming-nitro-lite-16-nl16-7_b824eccac58d4107b63cd0dc765f6bfd_master.png', 24490000.00, '2026-06-10 02:39:55'),
(6, 'Laptop gaming Lenovo LOQ 15IAX9E 83LK0079VN', 'https://product.hstatic.net/200000722513/product/ava_d4425b2bbd314fb09c178ed716c36c37_grande.png', 23490000.00, '2026-06-10 02:41:25'),
(7, 'Laptop gaming ASUS ROG Zephyrus G14 GA403WR QS156WS', 'https://product.hstatic.net/200000722513/product/asus-rog-zephyrus-g14-ga403uv-qs171w_4aef4676f5ef4fddbb5fd6d0c5fec7d5_295d6371914e47bf83d840031a95751f_master.png', 71280000.00, '2026-06-10 02:42:15'),
(8, 'Laptop gaming Lenovo LOQ 15IRX10 83JE00PEVN', 'https://cdn.hstatic.net/products/200000722513/loq_15irx10_ct1_03_2d0b9f20f60b4d83a6273fc715b1fd74_grande.png', 37368000.00, '2026-06-10 02:45:06'),
(9, 'PC CyberMaster Asus RTX 5080 16G | Intel Ultra 9 285K', 'https://mygear.io.vn/media/lib/13-05-2025/7ecd7510-1f25-4dce-9cba-04541d110b72.png', 108430000.00, '2026-06-11 00:50:46'),
(10, 'PC MyGear x ASUS tản nhiệt nước tùy chỉnh TUF BTF', 'https://mygear.io.vn/media/lib/13-05-2025/e79cbe62-3176-47ad-9e22-30819ec250fe.png', 71990000.00, '2026-06-11 00:51:50'),
(33, 'ROG Astral GeForce RTX 5090 32GB', 'https://mygear.io.vn/media/lib/13-05-2025/e4bf21c1-18ed-4271-a910-07fd97d6e85a.png', 96969000.00, '2026-06-11 00:52:46'),
(34, 'ROG MAXIMUS Z890 EXTREME', 'https://mygear.io.vn/media/lib/09-09-2025/z890-1.png', 28990000.00, '2026-06-11 00:54:19');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `reset_code` varchar(10) DEFAULT NULL,
  `reset_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `email`, `password_hash`, `created_at`, `reset_code`, `reset_expiry`) VALUES
(1, 'Nguyễn Văn Tuấn Hưng', 'hungtic21@gmail.com', '$2y$10$ggOG8NrOklYmhWnfswCpvOKiggpxS.3ASIiL5xYciYK0Y95kEOyO6', '2026-06-04 01:30:46', NULL, NULL),
(2, 'hieu123', 'huynhphuchieu811@gmail.com', '$2y$10$pJmyzpQFf2ZVSCYCzsKgp.zpVTRuSn5axJ.gTpyYoxGJnZBdW4gXu', '2026-06-08 03:24:13', NULL, NULL),
(3, 'hieunek', 'phuchieu2009hph@gmail.com', '$2y$10$MfvMsXREchIlrFSK5Q8NxeTedEtZcaPTM7f0lfSoDW3/EPLzKsJAW', '2026-06-10 02:01:01', NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `login_log`
--
ALTER TABLE `login_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `login_log`
--
ALTER TABLE `login_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
