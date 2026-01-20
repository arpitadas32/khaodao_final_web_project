-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2026 at 03:24 PM
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
-- Database: `login_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` varchar(50) NOT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `name`, `price`, `category`, `img`) VALUES
(1, 'Basmati Kacchi (Half)', 299.00, 'Kacchi', 'images/kacchi(bashmati)Half.png'),
(2, 'Basmati Kacchi (1:1)', 499.00, 'Kacchi', 'images/kacchi(bashmati)Full.png'),
(3, 'Chicken Dum Biryani', 199.00, 'Biryani', 'images/chicken Dum Biryani.png'),
(4, 'Mutton Tehari', 250.00, 'Tehari', 'images/muttonTehari.png'),
(5, 'Kacchi Platter (Single)', 999.00, 'Platters', 'images/KacchiPlatter.png'),
(6, 'Chicken Roast', 150.00, 'Add-ons', 'images/chickenRoast.png'),
(7, 'Beef Rezala', 200.00, 'Add-ons', 'images/beefRezala.png'),
(8, 'Plain Polao', 120.00, 'Add-ons', 'images/plainPolao.png'),
(9, 'Beef Chap', 220.00, 'Add-ons', 'images/beefChap.png'),
(10, 'Borhani (250ml)', 70.00, 'Beverages', 'images/Borhani.png'),
(11, 'Zafrani Sharbat', 90.00, 'Beverages', 'images/zafraniSharbat.png'),
(12, 'Firni', 70.00, 'Desserts', 'images/Firni.png'),
(13, 'Shahi Jorda', 70.00, 'Desserts', 'images/Jorda.png');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_data` text NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `delivery_charge` decimal(10,2) NOT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_data`, `total_amount`, `delivery_charge`, `status`, `created_at`) VALUES
(1, 6, '[{\\\"name\\\":\\\"Beef Chap\\\",\\\"price\\\":220,\\\"img\\\":\\\"images\\\\/beefChap.png\\\",\\\"quantity\\\":2}]', 490.00, 50.00, 'Pending', '2026-01-20 09:03:42'),
(2, 6, '[{\\\"name\\\":\\\"Chicken Roast\\\",\\\"price\\\":150,\\\"img\\\":\\\"images\\\\/chickenRoast.png\\\",\\\"quantity\\\":1}]', 200.00, 50.00, 'Pending', '2026-01-20 09:50:17'),
(3, 6, '[{\\\"name\\\":\\\"Beef Chap\\\",\\\"price\\\":220,\\\"img\\\":\\\"images\\\\/beefChap.png\\\",\\\"quantity\\\":1}]', 270.00, 50.00, 'Pending', '2026-01-20 10:17:06'),
(4, 6, '[{\\\"name\\\":\\\"Beef Rezala\\\",\\\"price\\\":200,\\\"img\\\":\\\"images\\\\/beefRezala.png\\\",\\\"quantity\\\":1}]', 250.00, 50.00, 'Pending', '2026-01-20 10:22:30'),
(5, 6, '[{\"name\":\"Chicken Roast\",\"price\":150,\"img\":\"images/chickenRoast.png\",\"quantity\":1}]', 200.00, 50.00, 'Pending', '2026-01-20 10:50:38'),
(6, 6, '[{\\\"name\\\":\\\"Beef Rezala\\\",\\\"price\\\":200,\\\"img\\\":\\\"images\\\\/beefRezala.png\\\",\\\"quantity\\\":1}]', 250.00, 50.00, 'Pending', '2026-01-20 10:51:23'),
(7, 6, '[{\"name\":\"Chicken Roast\",\"price\":150,\"img\":\"images/chickenRoast.png\",\"quantity\":1}]', 200.00, 50.00, 'Pending', '2026-01-20 10:52:44'),
(8, 6, '[{\"name\":\"Chicken Roast\",\"price\":150,\"img\":\"images/chickenRoast.png\",\"quantity\":1}]', 200.00, 50.00, 'Pending', '2026-01-20 10:57:36'),
(9, 1, '[{\"name\":\"Beef Chap\",\"price\":220,\"img\":\"images/beefChap.png\",\"quantity\":1}]', 270.00, 50.00, 'Pending', '2026-01-20 11:00:21'),
(10, 3, '[{\"name\":\"Chicken Roast\",\"price\":150,\"img\":\"images/chickenRoast.png\",\"quantity\":1}]', 200.00, 50.00, 'Pending', '2026-01-20 11:17:42'),
(11, 3, '[{\"name\":\"Beef Chap\",\"price\":220,\"img\":\"images/beefChap.png\",\"quantity\":1}]', 270.00, 50.00, 'Pending', '2026-01-20 11:40:37'),
(12, 3, '[{\"name\":\"Beef Rezala\",\"price\":200,\"img\":\"images/beefRezala.png\",\"quantity\":1}]', 250.00, 50.00, 'Pending', '2026-01-20 12:21:59'),
(13, 3, '[{\"name\":\"Chicken Roast\",\"price\":150,\"img\":\"images/chickenRoast.png\",\"quantity\":1}]', 200.00, 50.00, 'Pending', '2026-01-20 12:22:23'),
(14, 7, '[{\"name\":\"Beef Rezala\",\"price\":200,\"img\":\"images/beefRezala.png\",\"quantity\":1}]', 250.00, 50.00, 'Pending', '2026-01-20 14:20:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `profile_pic`, `created_at`) VALUES
(1, 'samia', 'samiaakterrupa984@gmail.com', '$2y$10$ahPo3gYRQZh4HPGlqXvE5OVCIICQ/JsTVMMMCDog5rUvcOlIKr3Hi', NULL, '2026-01-20 07:30:19'),
(2, 'akter', '23-55216-3@student.aiub.edu', '$2y$10$AIjH8Y9l75ODTmSj.0HfrOSxYCoBvx6YglNSp.35VcZ4WfnAXxmyO', NULL, '2026-01-20 08:12:16'),
(3, 'nisa', 'nisa@gmail.com', '$2y$10$hTSLofSNCFgsydBFzGwL7.7hLkzOt7ZeCsPfB2VrUM837w1zOQQmK', '1768907874_11111.jpg', '2026-01-20 08:18:07'),
(4, 'nisaaa', 'nisaa@gmail.coma', '$2y$10$iiBeISMMKcxgwihb.qJkwO2Xcbx4/anJozg8nCDra2re8XHT/02zO', NULL, '2026-01-20 08:19:03'),
(5, 'rup', 'rupsa@gmail.com', '$2y$10$YwCV1/5wzyYvQ6HJLnLQOeGHVO61YY2ut5kfXaboub6a6Ym9EGYXO', NULL, '2026-01-20 08:24:28'),
(6, 'paps', 'paps@gmail.com', '$2y$10$upydDUQhWCr2rd1otPASYeI.wYprU.JHSMR0.IksZvG/03XuIPXEy', '1768899399_111111111111111111.jpg', '2026-01-20 08:36:16'),
(7, 'sar', 'sar@gmail.com', '$2y$10$02s1MZ8f5gpCP9aqHnVhJelEBMWYBkI/lOSgRPD/l.Hkvp6kFlo5y', '1768918860_41cb901828462890eb91c8b419c42f03.jpg', '2026-01-20 14:20:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
