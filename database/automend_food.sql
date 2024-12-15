-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 15, 2024 at 10:30 AM
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
-- Database: `fds_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `email`, `name`, `password`) VALUES
(1, 'admin@food.com', 'sadiyo', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `totalAmount` varchar(20) NOT NULL,
  `payment_method` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `totalAmount`, `payment_method`) VALUES
(1, 3, '185000', ''),
(2, 4, '50000', ''),
(3, 5, '92500', ''),
(4, 6, '15000', ''),
(5, 5, '82500', ''),
(6, 5, '19000', ''),
(7, 5, '25500', '');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `unit_price` int(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` int(20) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_image`, `product_name`, `unit_price`, `quantity`, `total_price`, `status`) VALUES
(1, 1, 'http://localhost/food.com/assets/images/salad.jpg', 'Salad', 15000, 6, 90000, 0),
(2, 1, 'http://localhost/food.com/assets/images/cake.jpg', 'Cake', 15000, 3, 45000, 0),
(3, 1, 'http://localhost/food.com/assets/images/chiken.jpg', 'Chiken', 50000, 1, 50000, 0),
(4, 2, 'http://localhost/food.com/assets/images/burger.jpg', 'Burger', 25000, 2, 50000, 0),
(5, 3, 'http://localhost/food.com/assets/images/liquor.jpg', 'Mango Juice', 7000, 4, 28000, 0),
(6, 3, 'http://localhost/food.com/assets/images/donut.jpg', 'Donut', 1500, 3, 4500, 0),
(7, 3, 'http://localhost/food.com/assets/images/spaghetti.jpg', 'Spaghetti', 15000, 4, 60000, 0),
(8, 4, 'http://localhost/food.com/assets/images/salad.jpg', 'Salad', 15000, 1, 15000, 0),
(9, 5, 'http://localhost/food.com/assets/images/liquor.jpg', 'Mango Juice', 7000, 1, 7000, 0),
(10, 5, 'http://localhost/food.com/assets/images/salad.jpg', 'Salad', 15000, 1, 15000, 0),
(11, 5, 'http://localhost/food.com/assets/images/pizza.jpg', 'Pizza', 45000, 1, 45000, 0),
(12, 5, 'http://localhost/food.com/assets/images/strawberry.jpg', 'Strawberry Juice', 9000, 1, 9000, 0),
(13, 5, 'http://localhost/food.com/assets/images/capcake.jpg', 'Cupcake', 5000, 1, 5000, 0),
(14, 5, 'http://localhost/food.com/assets/images/donut.jpg', 'Donut', 1500, 1, 1500, 0),
(15, 6, 'http://localhost/food.com/assets/images/strawberry.jpg', 'Strawberry Juice', 9000, 1, 9000, 0),
(16, 6, 'http://localhost/food.com/assets/images/orange.jpg', 'Orange Juice', 10000, 1, 10000, 0),
(17, 7, 'http://localhost/food.com/assets/images/strawberry.jpg', 'Strawberry Juice', 9000, 1, 9000, 0),
(18, 7, 'http://localhost/food.com/assets/images/donut.jpg', 'Donut', 1500, 1, 1500, 0),
(19, 7, 'http://localhost/food.com/assets/images/rice.jpg', 'Rice', 15000, 1, 15000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `name`, `contact`, `address`, `password`) VALUES
(3, 'sadiyoabdul10@gmail.com', 'sadiyo', '0772973056', 'mengo', 'sadiyo'),
(4, 'sadiyoabdul100@gmail.com', 'sadiyo abdullahi', '0772973056', 'mengo', 'sadiyo'),
(5, 'maxim@food.com', 'Jenner Maxim', '0772973056', 'Nsambya, Kirombe', '123456'),
(6, 'jojo@gmail.com', 'jojo', '0776594369', 'n', 'jojo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
