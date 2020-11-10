-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 10, 2020 at 10:11 AM
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
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

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
(10, '0001', 'Cooler Master MasterBox MB511 RGB ', 'De Cooler MasterBox MB511 RGB PC behuizing is voorzien van een mesh frontpaneel voor een efficiënte luchtstroom voor veeleisende systemen. Drie 120mm RGB LED ventilatoren zijn vooraf geïnstalleerd aan de voorkant voor een fantastisch lichteffect.', '{\"Kleur\": \"Zwart\", \"Diepte\": \"49.1 cm\", \"Hoogte\": \"46.9 cm\", \"Breedte\": \"27.1 cm\", \"Moederborden\": \"ATX, microATX\"}', 90, 3, '8'),
(11, '0002', 'Corsair Carbide SPEC-DELTA RGB', 'De Carbide Series SPEC-DELTA RGB van Corsair is een midtower behuizing met ruimte voor een ATX, microATX of Mini-ITX moederbord. De behuizing heeft twee interne 3.5\"en twee 2.5\" drive bays. Er passen tot zes fans in de behuizing, standaard worden al drie 120mm fans met RGB verlichting en een zwarte 120mm fan meegeleverd.', '{\"Kleur\": \"Zwart\", \"Diepte\": \"44 cm\", \"Hoogte\": \"45 cm\", \"Breedte\": \"21 cm\", \"Moederborden\": \"ATX, microATX\"}', 70, 4, '8'),
(12, '0003', 'Fractal Design Meshify C', 'De Meshify C TG van Fractal Design is de perfecte basis voor een elegante pc-behuizing die alle hardware-esthetiek van het systeem met geraffineerde accenten naar voren brengt. De Meshify C TG in ATX-vormfactor combineert slim en efficiënt ruimtegebruik, met een compact midi-tower ontwerp en de mogelijkheid om krachtige hardwareonderdelen in te bouwen.', '{\"Kleur\": \"Zwart\", \"Diepte\": \"39.5 cm\", \"Hoogte\": \"48.4 cm\", \"Breedte\": \"21.2 cm\", \"Moederborden\": \"ATX, microATX\"}', 90, 2, '8'),
(13, '0004', 'Corsair Carbide SPEC-OMEGA RGB', 'De Carbide-serie SPEC-OMEGA RGB van Corsair. Met Tempered Glass (TG) window is dit een midtower PC-behuizing met een opvallend uiterlijk. Deze behuizing heeft twee geïntegreerde Corsair HD120 RGB-ventilatoren en een Lighting Node PRO', '{\"Kleur\": \"Wit\", \"Diepte\": \"51.6 cm\", \"Hoogte\": \"49.5 cm\", \"Breedte\": \"23.2 cm\", \"Moederborden\": \"ATX, microATX\"}', 150, 2, '8'),
(14, '0005', 'Sharkoon RGB Lit 100', 'De RGB LIT 100 is een ATX-midi tower die niet alleen een effectieve verlichting biedt, maar ook RGB in expressieve banen leidt: in en rond het elegante window, bij de aan de achterkant gemonteerde adresseerbare fan en bij de adresseerbare ledstrip. Dit alles zorgt voor een sfeervolle hardwareverlichting en wordt aan de voorkant aangevuld met een ledstrip.', '{\"Kleur\": \"Zwart\", \"Diepte\": \"43.6 cm\", \"Hoogte\": \"48.1 cm\", \"Breedte\": \"20.6 cm\", \"Moederborden\": \"ATX, microATX\"}', 70, 6, '8'),
(15, '0006', 'MSI MAG FORGE 100R', 'De MAG Forge 100R van MSI is een midtower behuizing voor ATX, microATX en Mini-ITX moederborden. De 100R is voorzien van een groot zijpaneel van gehard glas, waardoor er een optimale zichtbaarheid op de interne componenten is.\r\n', '{\"Kleur\": \"Zwart\", \"Diepte\": \"42.8cm\", \"Hoogte\": \"49 cm\", \"Breedte\": \"21 cm\", \"Moederborden\": \"ATX, microATX\"}', 70, 4, '8'),
(16, '0007', ' Antec Torque', 'De Antec Torque is een imposante mid-tower behuizing met een naar voren gekantelde positie van het moederbord, agressieve lijnen en tal van functies ontworpen voor prestatiegerichte constructies, gecombineerd met precisie gesneden aluminium panelen in hoog contrasterende crimson en gunmetal om jouw desktop een extra speciale uitstraling te geven.', '{\"Kleur\": \"Zwart\", \"Diepte\": \"62.1 cm\", \"Hoogte\": \"64.4 cm\", \"Breedte\": \"28.5 cm\", \"Moederborden\": \"ATX, microATX\"}', 340, 1, '8'),
(17, '0008', 'Be Quiet! Base 601', 'De Silent Base 601 van be quiet! is een ruime midtower behuizing. De behuizing beschikt standaard over drie 3.5\" en zes 2.5\" inbouwsloten, met optionele brackets is dit verder uit te breiden.', '{\"Kleur\": \"Zwart\", \"Diepte\": \"53.2 cm\", \"Hoogte\": \"51.4 cm\", \"Breedte\": \"24 cm\", \"Moederborden\": \"ATX, microATX\"}', 129, 3, '8');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `address` varchar(90) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone` int(11) NOT NULL,
  `password_hash` varchar(100) NOT NULL,
  `is_admin` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `address`, `email`, `phone`, `password_hash`, `is_admin`) VALUES
(1, 'Danny', 'Comes', 'huis 1', 'danny@gmail.com', 681586046, 'dc00c903852bb19eb250aeba05e534a6d211629d77d055033806b783bae09937', 1),
(2, 'klaas', 'vaak', 'huis 2', 'klaas@gmail.com', 645854585, '6c399ee6a9c60eb1b2b269d5a6e0c166eee2a9cca6da4dc1c38fa274ec371f57', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
