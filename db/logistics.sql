-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2023 at 11:14 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logistics`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `photo`, `created_by`) VALUES
(9, 'Bike', '1695398880.jpg', 'admin001'),
(10, 'Mobiles', '1694609989.jpg', 'admin001'),
(24, 'Drum Pads', '1695400751.jpg', 'admin001');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_no` varchar(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `notes` text NOT NULL,
  `total_price` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `invoice_no`, `customer_name`, `phone`, `notes`, `total_price`, `balance`, `payment_mode`, `status`, `created_at`) VALUES
(31, 1, '#121677', 'Hope Kim', '', 'Great', 60000, 1000, 'Cash', 1, '2023-09-18 12:31:21'),
(32, 1, '#125863', 'Hope Kim', '', 'Normal', 20000, 1000, 'Card', 1, '2023-09-18 12:31:57'),
(33, 1, '#124828', 'Jack Sim', '', 'Normal', 76000, 1000, 'Cash', 1, '2023-09-18 14:23:24'),
(34, 1, '#121343', 'Hope Kim', '', 'Nice', 125000, 1000, 'Cash', 1, '2023-09-18 14:25:12'),
(35, 16, '#126969', 'Jack Sim', '', 'Normal Client', 135000, 5000, 'Cash', 1, '2023-09-18 17:25:20'),
(36, 16, '#125149', 'Hope Kim', '', 'Normal', 20000, 1000, 'Transfer', 0, '2023-09-18 17:33:04'),
(37, 16, '#126476', 'Eeer', '', 'fgf', 0, 0, 'Cash', 0, '2023-09-20 11:30:07'),
(38, 16, '#124750', 'ereerer', '', 'fgf', 0, 0, 'Cash', 0, '2023-09-20 11:33:34'),
(39, 16, '#121750', 'eww', '', '', 79000, 0, 'Transfer', 0, '2023-09-20 11:58:25'),
(40, 16, '#124024', 'eww', '', '', 79000, 0, 'Transfer', 0, '2023-09-20 11:58:41'),
(43, 16, '#121014', 'fdfd', '', 'Normal', 20000, 1000, 'Transfer', 1, '2023-09-20 12:08:02'),
(45, 1, '#121316', 'Jack Sim', '09012090301', 'efrefffe', 120000, 0, 'Cash', 1, '2023-09-21 17:27:09'),
(46, 1, '#128969', 'Jack Sim', '09012344556', 'defr', 40000, 0, 'Transfer', 1, '2023-09-21 17:34:46'),
(47, 1, '#122265', 'Hope Kim', '09012344556', 'dfdfe', 79000, 5000, 'Transfer', 1, '2023-09-22 14:20:04'),
(48, 16, '#128792', 'Jack Sim', '09012090301', 'Hello', 95000, 5000, 'Card', 1, '2023-09-22 16:36:00'),
(49, 16, '#125448', 'Acaquarim', '09012090301', 'Good ', 119000, 0, 'Cash', 1, '2023-09-24 05:20:09');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `prod_qty` int(11) NOT NULL,
  `discount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `supplier_id`, `name`, `amount`, `qty`, `photo`, `created_by`) VALUES
(3, 10, 2, 'iPhone 6', 40000, -11, '1695394261.jpg', 'admin001'),
(10, 9, 2, 'Acaquarim', 20000, 12, '1695393851.jpg', 'admin001'),
(11, 9, 2, 'Jack Sim', 23000, 12, '1695398814.jpeg', 'admin001'),
(12, 10, 2, 'Ac Kim', 1000, 45, '1695398854.jpg', 'admin001'),
(13, 9, 2, 'Speakers', 20000, 18, '1695399225.jpg', 'hopekim'),
(14, 9, 2, 'Piano XY', 1250, 20, '1695399296.jpg', 'hopekim');

-- --------------------------------------------------------

--
-- Table structure for table `store_order_items`
--

CREATE TABLE `store_order_items` (
  `id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `prod_name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `store_order_items`
--

INSERT INTO `store_order_items` (`id`, `prod_id`, `order_id`, `prod_name`, `price`, `qty`, `discount`, `total`) VALUES
(1, 2, 13, 'Wheel Barrow', 20000, 5, 5000, 0),
(2, 2, 14, 'Wheel Barrow', 20000, 5, 5000, 0),
(3, 3, 15, 'iPhone 6', 40000, 2, 10000, 70000),
(4, 2, 15, 'Wheel Barrow', 20000, 3, 0, 60000),
(5, 3, 16, 'iPhone 6', 40000, 10, 20000, 380000),
(6, 2, 16, 'Wheel Barrow', 20000, 5, 10000, 90000),
(7, 2, 17, 'Wheel Barrow', 20000, 1, 0, 20000),
(8, 2, 18, 'Wheel Barrow', 20000, 1, 0, 20000),
(9, 3, 19, 'iPhone 6', 40000, 1, 0, 40000),
(10, 3, 20, 'iPhone 6', 40000, 1, 5000, 35000),
(11, 3, 21, 'iPhone 6', 40000, 2, 5000, 75000),
(12, 2, 21, 'Wheel Barrow', 20000, 1, 1000, 19000),
(13, 2, 22, 'Wheel Barrow', 20000, 1, 0, 20000),
(14, 3, 23, 'iPhone 6', 40000, 1, 5000, 35000),
(15, 2, 23, 'Wheel Barrow', 20000, 2, 10000, 30000),
(16, 2, 24, 'Wheel Barrow', 20000, 1, 1000, 19000),
(17, 3, 24, 'iPhone 6', 40000, 1, 0, 40000),
(18, 2, 25, 'Wheel Barrow', 20000, 1, 0, 20000),
(19, 3, 26, 'iPhone 6', 40000, 1, 1000, 39000),
(20, 2, 26, 'Wheel Barrow', 20000, 2, 5000, 35000),
(21, 2, 27, 'Wheel Barrow', 20000, 3, 5000, 55000),
(22, 3, 34, 'iPhone 6', 40000, 1, 0, 40000),
(23, 2, 34, 'Wheel Barrow', 20000, 1, 0, 20000),
(24, 2, 29, 'Wheel Barrow', 20000, 1, 0, 20000),
(25, 2, 30, 'Wheel Barrow', 20000, 1, 0, 20000),
(26, 3, 31, 'iPhone 6', 40000, 1, 0, 40000),
(27, 2, 31, 'Wheel Barrow', 20000, 1, 0, 20000),
(28, 2, 32, 'Wheel Barrow', 20000, 1, 0, 20000),
(29, 3, 33, 'iPhone 6', 40000, 1, 1000, 39000),
(30, 2, 33, 'Wheel Barrow', 20000, 2, 3000, 37000),
(33, 3, 35, 'iPhone 6', 40000, 3, 5000, 115000),
(34, 2, 35, 'Wheel Barrow', 20000, 1, 0, 20000),
(35, 2, 36, 'Wheel Barrow', 20000, 1, 0, 20000),
(36, 3, 40, 'iPhone 6', 40000, 1, 1000, 39000),
(37, 2, 40, 'Wheel Barrow', 20000, 2, 0, 40000),
(38, 2, 43, 'Wheel Barrow', 20000, 1, 0, 20000),
(39, 3, 44, 'iPhone 6', 40000, 1, 0, 40000),
(40, 2, 44, 'Wheel Barrow', 20000, 2, 2000, 38000),
(41, 3, 45, 'iPhone 6', 40000, 3, 0, 120000),
(42, 3, 46, 'iPhone 6', 40000, 1, 0, 40000),
(43, 3, 47, 'iPhone 6', 40000, 1, 0, 40000),
(44, 8, 47, 'Acaquarim', 20000, 2, 1000, 39000),
(45, 3, 48, 'iPhone 6', 40000, 1, 0, 40000),
(46, 10, 48, 'Acaquarim', 20000, 3, 5000, 55000),
(47, 3, 49, 'iPhone 6', 40000, 3, 1000, 119000);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `email`, `phone`, `address`) VALUES
(2, 'Hope Kim', 'hopekim@gmail.com', '09012344556', '11 Ada Street, PHC');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `usertype` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `phone`, `usertype`, `password`) VALUES
(1, 'Admin', 'Admin', 'admin001', 'admin@gmail.com', '08116042291', 'admin', '$2y$10$E.3PFeu0kuI9kAI4Kv24k.b5fzNl1zczk2qZxQlg8F8Y9ksKhNaHy'),
(16, 'Hope', 'Kim', 'hopekim', 'hopekim@gmail.com', '09012090301', 'customer-care', '$2y$10$z19/nX4DPkOPIy1axCSXMOBBe2QvKjxqnG93dGo3zqmUlRD.7N.yS'),
(18, 'Samuel', 'Smith', 'samsmith', 'samsmith@gmail.com', '09012344557', 'customer-care', '$2y$10$o5/0Sln7atfLp2dnkzUiJO/0Dyt8XSEaegHEpKpBh58SJt8a75sTq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `store_order_items`
--
ALTER TABLE `store_order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `store_order_items`
--
ALTER TABLE `store_order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
