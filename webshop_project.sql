-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 06, 2020 at 12:30 PM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webshop_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `display_name` varchar(60) NOT NULL,
  `tiny_desc` varchar(80) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `display_name`, `tiny_desc`, `description`) VALUES
(1, 'graphics_card', 'Graphics Cards', 'Browse the best Graphics Cards', 'Find the best Graphics Cards to fit your needs!'),
(2, 'processor', 'Processors', 'Browse the fastest CPU\'s', 'Find the best Processors to fit your needs!'),
(3, 'ram', 'Ram', 'Browse the largest Ram', 'Find the best Ram to fit your needs!'),
(4, 'motherboard', 'Motherboards', 'Browse the best Motherboards', 'Find the best Motherboards to fit your needs!'),
(5, 'storage', 'Storage SSD/HDD', 'Browse the fastest Storage systems', 'Find the best Storage to fit your needs!'),
(6, 'power_supply', 'Power Supplies', 'Browse the most powerful powersupplies', 'Find the best Power Supply to fit your needs!'),
(7, 'cpu_cooler', 'CPU Coolers', 'Browse the coolest CPU Coolers', 'Find the best CPU Cooler to fit your needs!'),
(8, 'pc_case', 'PC Cases', 'Browse the most amazing PC Cases', 'Find the best PC Case to fit your needs!');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(45) NOT NULL,
  `product_codes` json NOT NULL,
  `total_price` float NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_code` varchar(45) NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` text NOT NULL,
  `specifications` json NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `category_id` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_code`, `name`, `description`, `specifications`, `price`, `stock`, `category_id`) VALUES
(1, '1234', 'GPU 8800ti', 'A very fast GPU. Dit wonderbaarlijk snelle apparaat zorgt ervoor dat je al je games op maximale settings kan spelen! Ook zeer goed voor editing en rendering!', '{\"Vram\": \"12GB\", \"Frequency\": \"2000Mhz\", \"Boost Clock\": \"2500Mhz\"}', 1000, 11, '1'),
(2, '4321', 'GPU 8900ti', 'A fast GPU. Dit wonderbaarlijk snelle apparaat zorgt ervoor dat je al je games op maximale settings kan spelen! Ook zeer goed voor editing en rendering!', '{\"Vram\": \"12GB\", \"Frequency\": \"2000Mhz\", \"Boost Clock\": \"2500Mhz\"}', 2000, 19, '1'),
(3, '8765', 'GPU 8700ti', 'A slower GPU. Dit wonderbaarlijk snelle apparaat zorgt ervoor dat je al je games op maximale settings kan spelen! Ook zeer goed voor editing en rendering!', '{\"Vram\": \"12GB\", \"Frequency\": \"2000Mhz\", \"Boost Clock\": \"2500Mhz\"}', 600, 14, '1'),
(4, '5678', 'GPU 8600ti', 'An even slower GPU. Dit wonderbaarlijk snelle apparaat zorgt ervoor dat je al je games op maximale settings kan spelen! Ook zeer goed voor editing en rendering!', '{\"Vram\": \"12GB\", \"Frequency\": \"2000Mhz\", \"Boost Clock\": \"2500Mhz\"}', 300, 37, '1'),
(7, '9090', 'GPU 9900ti', 'The very fastestest cpu we are currently offering to our customers. Get ahold of this guy.', '{\"Vram\": \"12GB\", \"Frequency\": \"2000Mhz\", \"Boost Clock\": \"2500Mhz\"}', 2900, 6, '1'),
(8, '1112', 'CPU 888800KX', 'The very bestestest cpu to ever exist in the entire universe', '{\"Cores\": \"128\", \"Threads\": \"256\", \"Clock Speed\": \"10Ghz\"}', 999, 10, '2'),
(9, '9999', 'Ram 5000Mhz', 'Bestest ram', '{\"Size\": \"16GB\", \"Frequency\": \"5000Mhz\", \"DDR version\": \"DDR6\"}', 300, 21, '3');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `address` json NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone` int(11) NOT NULL,
  `password_hash` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
