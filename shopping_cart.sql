-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2023 at 07:06 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping_cart`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `price` varchar(10) NOT NULL,
  `qty` varchar(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `address_type` varchar(10) NOT NULL,
  `method` varchar(50) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `price` varchar(10) NOT NULL,
  `qty` varchar(2) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) NOT NULL DEFAULT 'in progress'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `address`, `address_type`, `method`, `product_id`, `price`, `qty`, `date`, `status`) VALUES
('7iTNKPeVOEmVq89n5hdu', 'R7IYskikb72oiFDXL7Pd', 'varshochi', '9128816706', 'varshochi@mail.com', 'flat 01 building 01, jordan, tehran, IRAN - 123456', 'home', 'paypal', 'hO95SHuB3eSCqKPVYXJh', '560', '1', '2023-01-01', 'cancelled'),
('Zlc2pRwgtni9Hd4lOnZz', 'R7IYskikb72oiFDXL7Pd', 'varshochi', '0912881679', 'varshochi@mail.com', 'flat 02 building 02, niavaran, tehran, IRAN - 123456', 'office', 'credit or debit card', 'zVGYW4Ruxx0eqpIFancu', '255', '3', '2023-01-01', 'in progress'),
('uQpilWqP6yDnQg1HWhui', 'R7IYskikb72oiFDXL7Pd', 'varshochi', '0912881679', 'varshochi@mail.com', 'flat 02 building 02, niavaran, tehran, IRAN - 123456', 'office', 'credit or debit card', 'hO95SHuB3eSCqKPVYXJh', '560', '2', '2023-01-01', 'in progress'),
('E2uEkkxvOYpjFVml1I9X', 'R7IYskikb72oiFDXL7Pd', 'varshochi', '0912881679', 'varshochi@mail.com', 'flat 02 building 02, niavaran, tehran, IRAN - 123456', 'office', 'credit or debit card', 'BOAXAJsem5QOoWJKuQtY', '760', '3', '2023-01-01', 'in progress');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` varchar(10) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`) VALUES
('hO95SHuB3eSCqKPVYXJh', 'laptop', '560', 'VFxM6HrafbkjNcwYTaer.webp'),
('sofOSfySFadAgQAkiYA5', 'cycle', '850', 'dZhYgNDvu529hHEqrZ8D.webp'),
('zVGYW4Ruxx0eqpIFancu', 't-shirt', '255', 'uVCcWGFYKToRjSzalRQz.webp'),
('BOAXAJsem5QOoWJKuQtY', 'smartphone', '760', 'hCPPXHqAnRi4y3JJRQTH.webp'),
('vAuU1AYQPjecPZk7Lb8p', 'bag', '240', 'ynHwWrml9Ggpwu545C7n.webp'),
('ZMmMl9TSs09mFz1cMzEe', 'shoes', '150', 'iRYnSaRbJvUMa8Engzkf.webp');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
