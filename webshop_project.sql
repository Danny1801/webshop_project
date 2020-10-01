-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 01, 2020 at 09:10 AM
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
  `category` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_code`, `name`, `description`, `specifications`, `price`, `stock`, `category`) VALUES
(1, '1234', 'GPU 8800ti', 'A very fast GPU. Dit wonderbaarlijk snelle apparaat zorgt ervoor dat je al je games op maximale settings kan spelen! Ook zeer goed voor editing en rendering!', '{\"Vram\": \"12GB\", \"Frequency\": \"2000Mhz\", \"Boost Clock\": \"2500Mhz\"}', 1000, 11, 'graphics_card'),
(2, '4321', 'GPU 8900ti', 'A fast GPU. Dit wonderbaarlijk snelle apparaat zorgt ervoor dat je al je games op maximale settings kan spelen! Ook zeer goed voor editing en rendering!', '{\"Vram\": \"12GB\", \"Frequency\": \"2000Mhz\", \"Boost Clock\": \"2500Mhz\"}', 2000, 19, 'graphics_card'),
(3, '8765', 'GPU 8700ti', 'A slower GPU. Dit wonderbaarlijk snelle apparaat zorgt ervoor dat je al je games op maximale settings kan spelen! Ook zeer goed voor editing en rendering!', '{\"Vram\": \"12GB\", \"Frequency\": \"2000Mhz\", \"Boost Clock\": \"2500Mhz\"}', 600, 14, 'graphics_card'),
(4, '5678', 'GPU 8600ti', 'An even slower GPU. Dit wonderbaarlijk snelle apparaat zorgt ervoor dat je al je games op maximale settings kan spelen! Ook zeer goed voor editing en rendering!', '{\"Vram\": \"12GB\", \"Frequency\": \"2000Mhz\", \"Boost Clock\": \"2500Mhz\"}', 300, 37, 'graphics_card');

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
