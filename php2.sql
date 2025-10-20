-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 20, 2025 lúc 03:10 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `php2`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Laptop', 'Máy tính xách tay', '2025-10-20 18:52:23', '2025-10-20 18:52:23'),
(2, 'Smartphone', 'Điện thoại thông minh', '2025-10-20 18:52:23', '2025-10-20 18:52:23'),
(3, 'Accessories', 'Phụ kiện điện tử', '2025-10-20 18:52:23', '2025-10-20 18:52:23'),
(4, 'zxc', 'zxc', '2025-10-20 14:34:42', '2025-10-20 14:34:42'),
(5, 'Tablet', 'Máy tính bảng', '2025-10-20 19:42:36', '2025-10-20 19:42:36'),
(6, 'Smartwatch', 'Đồng hồ thông minh', '2025-10-20 19:42:36', '2025-10-20 19:42:36'),
(7, 'Camera', 'Máy ảnh và camera', '2025-10-20 19:42:36', '2025-10-20 19:42:36'),
(8, 'Printer', 'Máy in và scanner', '2025-10-20 19:42:36', '2025-10-20 19:42:36'),
(9, 'Gaming Gear', 'Thiết bị chơi game', '2025-10-20 19:42:36', '2025-10-20 19:42:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('pending','processing','completed','cancelled') DEFAULT 'pending',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_amount`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 3000.00, 'processing', '2025-10-20 14:33:41', '2025-10-20 14:34:33'),
(3, 1, 3000.00, 'pending', '2025-10-20 15:09:17', '2025-10-20 15:09:17');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(3, 2, 2, 3, 1000.00),
(4, 3, 1, 2, 1500.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `img_thumbnail` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `stock` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `img_thumbnail`, `description`, `price`, `stock`, `created_at`, `updated_at`) VALUES
(1, 'Laptop Dell XPS', 1, 'storage/uploads/products/1760965245-52746-laptop-dell-xps-13-plus-9320-1y0wg-oled-4_f4925cade64849d0bc11aa8b43319607_1024x1024.jpg', 'Laptop cao cấp', 1500.00, 6, '2025-10-20 18:52:23', '2025-10-20 20:09:17'),
(2, 'iPhone 14', 2, 'storage/uploads/products/1760962843-52746-laptop-dell-xps-13-plus-9320-1y0wg-oled-4_f4925cade64849d0bc11aa8b43319607_1024x1024.jpg', 'Điện thoại Apple', 1000.00, 17, '2025-10-20 18:52:23', '2025-10-20 19:33:41'),
(3, 'Tai nghe Bluetooth', 3, 'storage/uploads/products/1760962843-52746-laptop-dell-xps-13-plus-9320-1y0wg-oled-4_f4925cade64849d0bc11aa8b43319607_1024x1024.jpg', 'Tai nghe không dây', 50.00, 50, '2025-10-20 18:52:23', '2025-10-20 19:31:22'),
(4, 'Laptop Dell XPS1', 1, 'storage/uploads/products/1760965235-52746-laptop-dell-xps-13-plus-9320-1y0wg-oled-4_f4925cade64849d0bc11aa8b43319607_1024x1024.jpg', 'zxczxc', 123450.00, 2, '2025-10-20 14:32:22', '2025-10-20 15:00:35'),
(5, 'iPad Pro 2024', 4, 'storage/uploads/products/1760965249-52746-laptop-dell-xps-13-plus-9320-1y0wg-oled-4_f4925cade64849d0bc11aa8b43319607_1024x1024.jpg', 'Máy tính bảng cao cấp Apple', 1200.00, 15, '2025-10-20 19:42:36', '2025-10-20 15:00:49'),
(6, 'Samsung Galaxy Tab S9', 4, 'storage/uploads/products/1760965242-52746-laptop-dell-xps-13-plus-9320-1y0wg-oled-4_f4925cade64849d0bc11aa8b43319607_1024x1024.jpg', 'Tablet Android mạnh mẽ', 900.00, 20, '2025-10-20 19:42:36', '2025-10-20 15:00:42'),
(8, 'Samsung Galaxy Watch 7', 5, 'storage/uploads/products/1760963542-52746-laptop-dell-xps-13-plus-9320-1y0wg-oled-4_f4925cade64849d0bc11aa8b43319607_1024x1024.jpg', 'Smartwatch với GPS', 350.00, 25, '2025-10-20 19:42:36', '2025-10-20 19:59:08'),
(9, 'Canon EOS R5', 6, 'https://cdn2.fptshop.com.vn/unsafe/828x0/filters:format(webp):quality(75)/2024_4_16_638488768365442895_6.jpg', 'Máy ảnh mirrorless chuyên nghiệp', 3500.00, 5, '2025-10-20 19:42:36', '2025-10-20 19:59:46'),
(10, 'Sony A7IV', 6, 'https://cdn2.fptshop.com.vn/unsafe/828x0/filters:format(webp):quality(75)/2024_4_16_638488768365442895_6.jpg', 'Máy ảnh full-frame', 2500.00, 8, '2025-10-20 19:42:36', '2025-10-20 19:59:50');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` enum('admin','user') DEFAULT 'user',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `type`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@example.com', '$2y$10$VO3fps/4/xvfHQ57l2rjW.rd5kbplyDWx7QjLmZBTUf.G89vxJ7EC', 'admin', '2025-10-20 18:52:23', '2025-10-20 18:52:48'),
(3, 'Admin Test', 'admin@test.com', '$2y$10$K0mX.0fYVqJ0Z0Z0Z0Z0Z0Z0Z0Z0Z0Z0Z0Z0Z0Z0', 'admin', '2025-10-20 19:42:36', '2025-10-20 19:42:36'),
(4, 'User Test', 'user@test.com', '$2y$10$K0mX.0fYVqJ0Z0Z0Z0Z0Z0Z0Z0Z0Z0Z0Z0Z0Z0Z0', 'user', '2025-10-20 19:42:36', '2025-10-20 19:42:36');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
