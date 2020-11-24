-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 24, 2020 at 12:54 PM
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
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_codes`, `total_price`, `date`) VALUES
(1, '1', '[[\"0009\", 1]]', 199, '2020-11-18 10:49:31'),
(2, '2', '[[\"0012\", 1], [\"0017\", 1], [\"0032\", 1], [\"0003\", 1]]', 837, '2020-11-23 09:22:32'),
(3, '2', '[[\"0009\", 1]]', 199, '2020-11-23 12:18:52'),
(4, '2', '[[\"0009\", 2]]', 398, '2020-11-23 12:19:09'),
(5, '1', '[[\"0010\", 1], [\"0007\", 1], [\"0032\", 1], [\"0020\", 1]]', 894, '2020-11-23 02:14:37'),
(6, '1', '[[\"0010\", 1], [\"0032\", 1], [\"0020\", 1]]', 554, '2020-11-23 02:16:42'),
(7, '1', '[[\"0032\", 1], [\"0020\", 1]]', 235, '2020-11-23 02:16:46'),
(8, '1', '[[\"0020\", 1], [\"8765\", 1], [\"0008\", 1], [\"0014\", 5]]', 1840, '2020-11-23 02:30:09'),
(9, '1', '[[\"0020\", 1], [\"8765\", 1], [\"0008\", 1], [\"0014\", 5]]', 1840, '2020-11-23 02:35:15'),
(10, '1', '[[\"0020\", 1], [\"8765\", 1], [\"0008\", 1], [\"0014\", 8]]', 2437, '2020-11-23 02:35:47'),
(11, '1', '[[\"0020\", 1], [\"8765\", 1], [\"0008\", 1]]', 845, '2020-11-23 02:36:57'),
(12, '1', '[[\"0020\", 5], [\"8765\", 1], [\"0008\", 1]]', 1309, '2020-11-23 02:37:08'),
(13, '1', '[[\"0020\", 2], [\"8765\", 1], [\"0008\", 1]]', 961, '2020-11-23 02:37:26'),
(14, '1', '[[\"0020\", -4], [\"8765\", 1], [\"0008\", 1]]', 265, '2020-11-23 02:37:48'),
(15, '1', '[[\"8765\", 1], [\"0008\", 3]]', 987, '2020-11-23 02:44:14'),
(16, '1', '[[\"0023\", 4]]', 876, '2020-11-23 02:44:26'),
(17, '1', '[[\"0023\", 3]]', 657, '2020-11-23 02:44:31'),
(18, '1', '[[\"0023\", 3]]', 657, '2020-11-23 02:44:40'),
(19, '1', '[[\"0023\", 2]]', 438, '2020-11-23 02:44:51'),
(20, '1', '[[\"0023\", 2]]', 438, '2020-11-23 02:46:06'),
(21, '1', '[[\"0023\", 3]]', 657, '2020-11-24 11:06:17');

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
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_code`, `name`, `description`, `specifications`, `price`, `stock`, `category_id`) VALUES
(1, '1234', 'MSI Geforce GTX 1060', 'Dit wonderbaarlijk snelle apparaat zorgt ervoor dat je al je games op maximale settings kan spelen! Ook zeer goed voor editing en rendering!', '{\"Vram\": \"6GB\", \"Frequency\": \"2000Mhz\", \"Boost Clock\": \"2500Mhz\"}', 399, 11, '1'),
(2, '4321', 'MSI Geforce GTX 1070', 'Dit wonderbaarlijk snelle apparaat zorgt ervoor dat je al je games op maximale settings kan spelen! Ook zeer goed voor editing en rendering!', '{\"Vram\": \"8GB\", \"Frequency\": \"2000Mhz\", \"Boost Clock\": \"2500Mhz\"}', 489, 19, '1'),
(3, '8765', 'MSI Geforce GTX 1050 ti', 'Dit apparaat zorgt ervoor dat je al je games op maximale settings kan spelen! Ook zeer goed voor editing en rendering!', '{\"Vram\": \"6GB\", \"Frequency\": \"2000Mhz\", \"Boost Clock\": \"2500Mhz\"}', 299, 0, '1'),
(4, '5678', 'MSI Geforce GTX 1660 ti', 'An even slower GPU. Dit wonderbaarlijk snelle apparaat zorgt ervoor dat je al je games op maximale settings kan spelen! Ook zeer goed voor editing en rendering!', '{\"Vram\": \"8GB\", \"Frequency\": \"2000Mhz\", \"Boost Clock\": \"2500Mhz\"}', 449, 8, '1'),
(7, '9090', 'MSI Geforce GTX 1080 ti', 'The very fastestest cpu we are currently offering to our customers. Get ahold of this guy.', '{\"Vram\": \"12GB\", \"Frequency\": \"2000Mhz\", \"Boost Clock\": \"2500Mhz\"}', 899, 6, '1'),
(26, '0017', 'Gigabyte B550 Aorus Elite', 'De Gigabyte Aorus B550 Elite is een ATX Socket AM4 moederbord gebaseerd op de AMD B550 chipset. Het bord dient gecombineerd te worden met DDR4 geheugen. In totaal heeft de Gigabyte Aorus B550 Elite 4 Serial ATA aansluitingen voor harddisks en SSD\'s.', '{\"Type\": \"ATX\", \"Hoogte\": \"30,5 cm\", \"Socket\": \"AM4\", \"Breedte\": \"24,4 cm\", \"Geheugen\": \"DDR4\"}', 129, 2, '4'),
(10, '0001', 'Cooler Master MasterBox MB511 RGB ', 'De Cooler MasterBox MB511 RGB PC behuizing is voorzien van een mesh frontpaneel voor een efficiënte luchtstroom voor veeleisende systemen. Drie 120mm RGB LED ventilatoren zijn vooraf geïnstalleerd aan de voorkant voor een fantastisch lichteffect.', '{\"Kleur\": \"Zwart\", \"Diepte\": \"49.1 cm\", \"Hoogte\": \"46.9 cm\", \"Breedte\": \"27.1 cm\", \"Moederborden\": \"ATX, microATX\"}', 90, 3, '8'),
(11, '0002', 'Corsair Carbide SPEC-DELTA RGB', 'De Carbide Series SPEC-DELTA RGB van Corsair is een midtower behuizing met ruimte voor een ATX, microATX of Mini-ITX moederbord. De behuizing heeft twee interne 3.5\"en twee 2.5\" drive bays. Er passen tot zes fans in de behuizing, standaard worden al drie 120mm fans met RGB verlichting en een zwarte 120mm fan meegeleverd.', '{\"Kleur\": \"Zwart\", \"Diepte\": \"44 cm\", \"Hoogte\": \"45 cm\", \"Breedte\": \"21 cm\", \"Moederborden\": \"ATX, microATX\"}', 70, 4, '8'),
(12, '0003', 'Fractal Design Meshify C', 'De Meshify C TG van Fractal Design is de perfecte basis voor een elegante pc-behuizing die alle hardware-esthetiek van het systeem met geraffineerde accenten naar voren brengt. De Meshify C TG in ATX-vormfactor combineert slim en efficiënt ruimtegebruik, met een compact midi-tower ontwerp en de mogelijkheid om krachtige hardwareonderdelen in te bouwen.', '{\"Kleur\": \"Zwart\", \"Diepte\": \"39.5 cm\", \"Hoogte\": \"48.4 cm\", \"Breedte\": \"21.2 cm\", \"Moederborden\": \"ATX, microATX\"}', 90, 1, '8'),
(13, '0004', 'Corsair Carbide SPEC-OMEGA RGB', 'De Carbide-serie SPEC-OMEGA RGB van Corsair. Met Tempered Glass (TG) window is dit een midtower PC-behuizing met een opvallend uiterlijk. Deze behuizing heeft twee geïntegreerde Corsair HD120 RGB-ventilatoren en een Lighting Node PRO', '{\"Kleur\": \"Wit\", \"Diepte\": \"51.6 cm\", \"Hoogte\": \"49.5 cm\", \"Breedte\": \"23.2 cm\", \"Moederborden\": \"ATX, microATX\"}', 150, 2, '8'),
(14, '0005', 'Sharkoon RGB Lit 100', 'De RGB LIT 100 is een ATX-midi tower die niet alleen een effectieve verlichting biedt, maar ook RGB in expressieve banen leidt: in en rond het elegante window, bij de aan de achterkant gemonteerde adresseerbare fan en bij de adresseerbare ledstrip. Dit alles zorgt voor een sfeervolle hardwareverlichting en wordt aan de voorkant aangevuld met een ledstrip.', '{\"Kleur\": \"Zwart\", \"Diepte\": \"43.6 cm\", \"Hoogte\": \"48.1 cm\", \"Breedte\": \"20.6 cm\", \"Moederborden\": \"ATX, microATX\"}', 70, 6, '8'),
(15, '0006', 'MSI MAG FORGE 100R', 'De MAG Forge 100R van MSI is een midtower behuizing voor ATX, microATX en Mini-ITX moederborden. De 100R is voorzien van een groot zijpaneel van gehard glas, waardoor er een optimale zichtbaarheid op de interne componenten is.\r\n', '{\"Kleur\": \"Zwart\", \"Diepte\": \"42.8cm\", \"Hoogte\": \"49 cm\", \"Breedte\": \"21 cm\", \"Moederborden\": \"ATX, microATX\"}', 70, 4, '8'),
(16, '0007', 'Antec Torque', 'De Antec Torque is een imposante mid-tower behuizing met een naar voren gekantelde positie van het moederbord, agressieve lijnen en tal van functies ontworpen voor prestatiegerichte constructies, gecombineerd met precisie gesneden aluminium panelen in hoog contrasterende crimson en gunmetal om jouw desktop een extra speciale uitstraling te geven.', '{\"Kleur\": \"Zwart\", \"Diepte\": \"62.1 cm\", \"Hoogte\": \"64.4 cm\", \"Breedte\": \"28.5 cm\", \"Moederborden\": \"ATX, microATX\"}', 340, 0, '8'),
(17, '0008', 'Be Quiet! Base 601', 'De Silent Base 601 van be quiet! is een ruime midtower behuizing. De behuizing beschikt standaard over drie 3.5&quot; en zes 2.5&quot; inbouwsloten, met optionele brackets is dit verder uit te breiden.', '{\"Kleur\": \"Zwart\", \"Diepte\": \"53.2 cm\", \"Hoogte\": \"51.4 cm\", \"Breedte\": \"24 cm\", \"Moederborden\": \"ATX, microATX\"}', 129, 9, '8'),
(18, '0009', 'AMD Ryzen 5 3600', 'De Ryzen 5 3600 van AMD is een 3e generatie Ryzen processor, gebaseerd op de AMD Zen 2 architectuur. De processor is geschikt voor AM4 moederborden.', '{\"Cache\": \"35 MB\", \"Cores\": \"6\", \"Socket\": \"AM4\", \"Threads\": \"12\", \"Verbruik\": \"65 W\", \"kloksnelheid\": \"3,6 GHz\"}', 199, 4, '2'),
(19, '0010', 'AMD Ryzen 7 3700X', 'De Ryzen 7 3700X van AMD is een 3e generatie Ryzen processor, gebaseerd op de AMD Zen 2 architectuur. De processor is geschikt voor AM4 moederborden.', '{\"Cache\": \"36 MB\", \"Cores\": \"8\", \"Socket\": \"AM4\", \"Threads\": \"16\", \"Verbruik\": \"65 W\", \"kloksnelheid\": \"3,6 GHz\"}', 319, 0, '2'),
(20, '0011', 'AMD Ryzen Threadripper 3960X', 'De derde generatie Threadripper 3960X van AMD beschikt over 24 cores en kan dankzij SMT tot 48 taken tegelijk verwerken. De processor is geschikt voor moederborden met een sTRX4 socket.', '{\"Cache\": \"140 MB\", \"Cores\": \"24\", \"Socket\": \"TRX4\", \"Threads\": \"48\", \"Verbruik\": \"280 W\", \"kloksnelheid\": \"3,6 GHz\"}', 1399, 2, '2'),
(21, '0012', 'AMD Ryzen 9 3900XT', 'De Ryzen 9 3900XT van AMD is een 3e generatie Ryzen processor, gebaseerd op de AMD Zen 2 architectuur. De processor bevat 12 cores en kan dankzij SMT tot 24 threads tegelijk afhandelen.', '{\"Cache\": \"70 MB\", \"Cores\": \"12\", \"Socket\": \"AM4\", \"Threads\": \"24\", \"Verbruik\": \"105 W\", \"kloksnelheid\": \"3,6 GHz\"}', 499, 2, '2'),
(22, '0013', 'Intel Core i7 9700K', 'De Core i7-9700K van Intel beschikt over acht verwerkingseenheden, heeft een kloksnelheid van 3.6 GHz en een maximale Turbo tot 4.9 GHz. De i7-9700K kan geplaatst worden op LGA1151 moederborden welke beschikken over een Intel 300* of 400-serie chipset.', '{\"Cache\": \"12 MB\", \"Cores\": \"8\", \"Socket\": \"LGA1151\", \"Threads\": \"8\", \"Verbruik\": \"95 W\", \"kloksnelheid\": \"3,6 GHz\"}', 299, 4, '2'),
(23, '0014', 'Intel Core i5 9600K', 'De Intel Core i5-9600K beschikt over zes verwerkingseenheden, werkt op een kloksnelheid van 3.7 GHz en heeft een maximale Turbo tot 4.6 GHz. De processor kan op moederborden geplaatst worden die beschikken over een LGA1151 socket en een 300* of 400-serie Intel chipset.', '{\"Cache\": \"9 MB\", \"Cores\": \"6\", \"Socket\": \"LGA1151\", \"Threads\": \"6\", \"Verbruik\": \"95 W\", \"kloksnelheid\": \"3,7 GHz\"}', 199, 5, '2'),
(24, '0015', 'Intel Core i5 9400', 'De Core i5-9400 van Intel is een 9e generatie (Coffee Lake) processor. De processor kan geplaatst worden op LGA1151 moederborden met een Intel 300-serie chipset en een geschikte bios.', '{\"Cache\": \"9 MB\", \"Cores\": \"6\", \"Socket\": \"LGA1151\", \"Threads\": \"6\", \"Verbruik\": \"65 W\", \"kloksnelheid\": \"2,9 GHz\"}', 169, 6, '2'),
(25, '0016', 'Intel Core i3 9100', 'De Core i3-9100 van Intel is een 9e generatie processor uit de Coffee Lake familie. De processor is geschikt voor LGA1151 moederborden welke voorzien zijn van een chipset uit de 300-serie en een compatibel bios. De i3-9100 beschikt over vier cores en 6MB SmartCache.', '{\"Cache\": \"6 MB\", \"Cores\": \"4\", \"Socket\": \"LGA1151\", \"Threads\": \"4\", \"Verbruik\": \"65 W\", \"kloksnelheid\": \"3,6 GHz\"}', 129, 4, '2'),
(27, '0018', 'Asus ROG Strix B450-F', 'De ROG STRIX B450-F GAMING van ASUS ondersteunt één AMD Socket AM4 processor samen met maximaal 64 GB aan geheugen.', '{\"Type\": \"ATX\", \"Hoogte\": \"30,5 cm\", \"Socket\": \"AM4\", \"Breedte\": \"24,4 cm\", \"Geheugen\": \"DDR4\"}', 99, 3, '4'),
(28, '0019', 'MSI MAG B550 TOMAHAWK', 'De MSI MAG B550 TOMAHAWK is een gaming moederbord gebaseerd op de AMD B550 chipset. In de AM4 socket kan een 3e Generatie AMD Ryzen of een Zen 3 desktop processor geplaatst worden.', '{\"Type\": \"ATX\", \"Hoogte\": \"30,5 cm\", \"Socket\": \"AM4\", \"Breedte\": \"24,4 cm\", \"Geheugen\": \"DDR4\"}', 179, 2, '4'),
(29, '0020', 'Gigabyte B450 AORUS PRO', 'De Gigabyte B450 I Aorus Pro WiFi is een Mini ITX Socket AM4 moederbord gebaseerd op de AMD B450 chipset, geschikt voor AMD Ryzen 3 / 5 / 7 processors. Het bord dient gecombineerd te worden met DDR4 geheugen, waarvoor 2 sloten beschikbaar zijn', '{\"Type\": \"Mini ITX\", \"Hoogte\": \"17 cm\", \"Socket\": \"AM4\", \"Breedte\": \"17 cm\", \"Geheugen\": \"DDR4\"}', 116, 0, '4'),
(31, '0021', 'Gigabyte Z390 AORUS PRO', 'De Gigabyte Z390 AORUS PRO is een ATX Socket 1151 moederbord gebaseerd op de Intel Z390 chipset. Het bord dient gecombineerd te worden met DDR4 geheugen, waarvoor 4 sloten beschikbaar zijn. Voor moderne SSD\'s is er een M.2-slot aanwezig. Een gigabit netwerkaansluiting mag op dit bord natuurlijk niet ontbreken.', '{\"Type\": \"ATX\", \"Hoogte\": \"30,5 cm\", \"Socket\": \"LGA1151\", \"Breedte\": \"24,4 cm\", \"Geheugen\": \"DDR4\"}', 179, 3, '4'),
(32, '0022', 'MSI MGP Z390 GAMING', 'De MSI MPG Z390 GAMING EDGE AC is een ATX Socket 1151 moederbord gebaseerd op de Intel Z390 chipset. Het bord dient gecombineerd te worden met DDR4 geheugen, waarvoor 4 sloten beschikbaar zijn. Voor moderne SSD\'s is er een M.2-slot aanwezig. Een gigabit netwerkaansluiting mag op dit bord natuurlijk niet ontbreken.', '{\"Type\": \"ATX\", \"Hoogte\": \"30,5 cm\", \"Socket\": \"LGA1151\", \"Breedte\": \"24,4 cm\", \"Geheugen\": \"DDR4\"}', 169, 4, '4'),
(33, '0023', 'Asus ROG STRIX Z390-E', 'De Asus ROG STRIX Z390-E GAMING is een ATX Socket 1151 moederbord gebaseerd op de Intel Z390 chipset. Het bord dient gecombineerd te worden met DDR4 geheugen, waarvoor 4 sloten beschikbaar zijn. Voor moderne SSD\'s is er een M.2-slot aanwezig. Een gigabit netwerkaansluiting mag op dit bord natuurlijk niet ontbreken.', '{\"Type\": \"ATX\", \"Hoogte\": \"30,5 cm\", \"Socket\": \"LGA1151\", \"Breedte\": \"24,4 cm\", \"Geheugen\": \"DDR4\"}', 219, 0, '4'),
(34, '0024', 'MSI H310M PRO-M2 PLUS', 'De H310M PRO-M2 PLUS van MSI ondersteunt één Intel Socket 1151 processor samen met maximaal 32 GB aan geheugen. Verder ondersteunt het moederbord de interne grafische chip van de CPU, is er één PCIe x16 3.0 slot aanwezig en kunnen er SATA apparaten worden aangesloten.', '{\"Type\": \"ATX\", \"Hoogte\": \"30,5 cm\", \"Socket\": \"LGA1151\", \"Breedte\": \"24,4 cm\", \"Geheugen\": \"DDR4\"}', 59, 2, '4'),
(44, '0035', 'Corsair Vengeance 8GB', 'De 16 GB DDR4-3600 Kit bestaat in totaal uit 16 GB (twee modules van 8 GB) en ze zijn geschikt voor systemen met een DDR4 geheugenbus van 3600 MHz. Deze geheugenmodules zijn voorzien van RGB LED-verlichting, wat te bedienen is met Corsair iCUE software. Dus laat je PC stralen met de betoverende dynamische multi-zone RGB verlichting van Corsair`s Vengeance RGB PRO serie geheugen.', '{\"Type\": \"DDR4\", \"Snelheid\": \"3200 MHz\", \"Capaciteit\": \"8 GB, 2 x 4 GB\"}', 89, 3, '3'),
(36, '0034', 'Corsair Vengeance 16GB', 'De 16 GB DDR4-3600 Kit bestaat in totaal uit 16 GB (twee modules van 8 GB) en ze zijn geschikt voor systemen met een DDR4 geheugenbus van 3600 MHz. Deze geheugenmodules zijn voorzien van RGB LED-verlichting, wat te bedienen is met Corsair iCUE software. Dus laat je PC stralen met de betoverende dynamische multi-zone RGB verlichting van Corsair`s Vengeance RGB PRO serie geheugen.', '{\"Type\": \"DDR4\", \"Snelheid\": \"3200 MHz\", \"Capaciteit\": \"16 GB, 2 x 8 GB\"}', 89, 5, '3'),
(42, '0032', 'Gigabyte AORUS 16GB', 'Deze 16GB kit van Gigabyte bestaat uit twee exact dezelfde 8GB modules', '{\"Type\": \"DDR4\", \"Snelheid\": \"3600 MHz\", \"Capaciteit\": \"16 GB, 2 x 8 GB\"}', 119, 0, '3'),
(43, '0033', 'Gigabyte AORUS 32GB', 'Deze 32GB kit van Gigabyte bestaat uit twee exact dezelfde 16GB modules', '{\"Type\": \"DDR4\", \"Snelheid\": \"3600 MHz\", \"Capaciteit\": \"32 GB, 2 x 16 GB\"}', 139, 3, '3'),
(38, '0036', 'PNY RGB Gaming 16GB', 'De 16 GB DDR4-3200 Kit van PNY is een set van twee geheugenmodules met een totale capaciteit van 16GB (twee modules van 8GB), beide modules zijn volledig identiek. Beide zijn voorzien van geheugenchips uit eenzelfde productie-serie, wat uiteraard een betere compatibiliteit oplevert dan twee losse modules.', '{\"Type\": \"DDR4\", \"Snelheid\": \"3200 MHz\", \"Capaciteit\": \"16 GB, 2 x 8 GB\"}', 109, 4, '3'),
(39, '0037', 'PNY RGB Gaming 32GB', 'De XLR8 RGB Gaming Geheugenmodules van PNY geeft je een verbluffende kleurervaring in combinatie met extreme prestaties, haal het maximale uit je pc. Niet alleen vernietig je de concurrentie aan de buitenkant, je ziet er ook goed uit aan de binnenkant.', '{\"Type\": \"DDR4\", \"Snelheid\": \"3200 MHz\", \"Capaciteit\": \"32 GB, 2 x 16 GB\"}', 159, 3, '3'),
(40, '0038', 'PNY GRB Gaming 8GB', 'De opbouw van deze geheugenmodules is volledig identiek. Alle geheugenmodules zijn voorzien van geheugenchips uit eenzelfde productie-serie, wat uiteraard een betere compatibiliteit oplevert dan verschillende losse modules.', '{\"Type\": \"DDR4\", \"Snelheid\": \"3200 MHz\", \"Capaciteit\": \"8 GB, 2 x 4 GB\"}', 89, 7, '3'),
(41, '0031', 'Gigabyte AORUS 8GB', 'Deze 8GB kit van Gigabyte bestaat uit twee exact dezelfde 4GB modules.', '{\"Type\": \"DDR4\", \"Snelheid\": \"3600 MHz\", \"Capaciteit\": \"8 GB, 2 x 4 GB\"}', 99, 4, '3'),
(45, '0039', 'MSI Geforce RTX 3090', 'De MSI GeForce RTX 3090 VENTUS 3X 24G OC grafische kaart van MSI is gebaseerd op de NVIDIA GeForce RTX 3090 Chip en beschikt over 24 GB GDDR6X Geheugen dat via een 384 bit brede interface aangesproken wordt. De grafische kaart heeft 1 HDMI 2.1 aansluiting en  3 DisplayPort 1.4a aansluitingen.\r\n', '{\"Vram\": \"24GB\", \"Frequency\": \"1725 MHz\", \"Boost Clock\": \"2000Mhz\"}', 1749, 8, '1'),
(46, '0040', 'Gigabyte Geforce GTX 3070', 'De Gigabyte GeForce RTX 3070 Eagle OC 8G is een grafische kaart gebaseerd op de RTX 3070 chip. Met 8 GB GDDR6 geheugen en een boostklok van 1725 MHz ben je met deze kaart klaar voor de toekomst.', '{\"Vram\": \"8GB\", \"Frequency\": \"1725Mhz\", \"Boost Clock\": \"1945Mhz\"}', 619, 9, '1'),
(47, '0041', 'Gigabyte Geforce RTX 3080', 'De Gigabyte Aorus GeForce RTX 3080 Master 10G grafische kaart van Gigabyte is gebaseerd op de NVIDIA GeForce RTX 3080 Chip en beschikt over 10 GB GDDR6X geheugen dat via een 320 bit brede interface aangesproken wordt. De grafische kaart heeft 3x HDMI en 3x DisplayPort aansluitingen.', '{\"Vram\": \"10GB\", \"Frequency\": \"1725Mhz\", \"Boost Clock\": \"1945Mhz\"}', 869, 4, '1'),
(48, '0042', 'Samsung EVO 500GB', 'De Samsung EVO 860 (MZ-76E500B/EU) SSD heeft een opslagcapaciteit van 500 GB en een 2,5” bouwvorm. Deze snelle en betrouwbare SSD met de nieuwe V-NAND en een krachtige algoritmische controller is speciaal ontworpen voor gewone pc’s en laptops.', '{\"Opslag\": \"500 GB\", \"Formaat\": \"2,5 Inch\"}', 69, 15, '5'),
(49, '0043', 'Samsung EVO 1 TB', 'De Samsung EVO 860 (MZ-76E500B/EU) SSD heeft een opslagcapaciteit van 500 GB en een 2,5” bouwvorm. Deze snelle en betrouwbare SSD met de nieuwe V-NAND en een krachtige algoritmische controller is speciaal ontworpen voor gewone pc’s en laptops.', '{\"Opslag\": \"1000 GB\", \"Formaat\": \"2,5 Inch\"}', 109, 12, '5'),
(50, '0044', 'PNY CS900 120 GB', 'De PNY CS900 SSD is een uitstekende keuze om op te waarderen van een HDD. Deze SSD is speciaal ontworpen als een gebruiksvriendelijke en betaalbare HDD-vervanging voor de PC.', '{\"Opslag\": \"120 GB\", \"Formaat\": \"2,5 Inch\"}', 29, 14, '5'),
(51, '0045', 'Gigabyte GP M.2 SSD', 'De GP-GSM2NE3256GNTD van Gigabyte is een NVMe SSD met een capaciteit van 256GB. De SSD maakt gebruik van een PCIe 3.0 x4 interface en communiceert via NVMe. De SSD is gebouwd in het M.2 2280 formaat.', '{\"Opslag\": \"256 GB\", \"Formaat\": \"M.2\"}', 39, 6, '5'),
(52, '0046', 'WD Blue WD10 1TB', 'De WD Blue levert razendsnelle en ultra-stille prestaties hand in hand met een laag stroomverbruik. Bovendien zijn ze ontworpen met robuustheid, betrouwbaarheid en gegevensbescherming functies die actief waken over waardevolle gegevens.', '{\"Opslag\": \"1000 GB\", \"Formaat\": \"3,5 Inch\"}', 39, 21, '5'),
(53, '0047', 'Seagate Barracuda 4TB', 'Haal het meeste uit je opslag met BarraCuda harde schijven. Van computers vol met foto\'s en herinneringen tot gaming-pc\'s die meer speelruimte nodig hebben - BarraCuda groeit met je mee. De BarraCuda van Seagate heeft een opslagcapaciteit van 4000 GB en een cache van 256 MB.', '{\"Opslag\": \"4000 GB\", \"Formaat\": \"3,5 Inch\"}', 89, 14, '5'),
(54, '0048', 'Seagate Exos 16TB', 'Seagate produceert harde schijven die speciaal ontwikkeld zijn voor de hyperscale opslagmarkt. Als het vlaggenschip van de Seagate X-klasse beschikt de Exos X16 Enterprise harde schijf over de grootste capaciteit in de hele vloot.', '{\"Opslag\": \"16000 GB\", \"Formaat\": \"3,5 Inch\"}', 399, 3, '5'),
(55, '0049', 'WD Blue WDS10 1TB', 'Met zijn prestaties en betrouwbaarheid, biedt de WD Blue SSD digitale opslagcapaciteit die is geoptimaliseerd voor multitasking en die uw behoeften op het gebied van high-performance computergebruik kan bijbenen. De WD Blue van WD heeft een opslagcapaciteit van 1000 GB.', '{\"Opslag\": \"1000 GB\", \"Formaat\": \"M.2\"}', 109, 5, '5');

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
