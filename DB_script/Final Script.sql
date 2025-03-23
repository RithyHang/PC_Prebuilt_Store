-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 23, 2025 at 05:30 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pc_store_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `category` varchar(60) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `qty` smallint(6) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `products_category_id_foreign` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category`, `name`, `description`, `price`, `qty`, `image`) VALUES
(2, 'CPU', 'AMD Ryzen7', '7 9800X3D 8-Core, 16-Thread Desktop Processor', 500, 3, '67dfd360b36097.22782791.png'),
(6, 'CPU', 'AMD Ryzen5', '-Brand  AMD -CPU Manufacturer  AMD -CPU Model  Ryzen 5 -CPU Speed  5.3 GHz -CPU Socket  Socket AM5', 150, 3, '67dfd7a5d910a7.55004849.jpg'),
(7, 'GPU', 'RTX 4060', 'Gigabyte GeForce RTX 4060 Eagle OC ICE 8G Graphics Card - 8GB GDDR6, 128bit, PCI-E 4.0, 2505MHz Core Clock, 2 x DisplayPort 1.4a, 2 x HDMI 2.1a, NVIDIA DLSS 3, GV-N4060EAGLEOC ICE-8GD', 399, 5, '67dfd7d9cd3e00.43229448.jpg'),
(8, 'GPU', 'RTX 3060', 'MSI GeForce RTX 3060 Ventus 3X 12G OC, Gaming Graphics Card - RTX 3060', 299, 5, '67dfd7f9b2db87.02754880.jpg'),
(9, 'GPU', 'RTX 4090', 'MSI GeForce RTX 4090 Gaming X Trio 24G Gaming Graphics Card - 24GB GDDR6X, 2595 MHz, PCI Express Gen 4, 384-bit, 3X DP v 1.4a, HDMI 2.1a (Supports 4K & 8K HDR)', 1099, 3, '67dfd829f1f999.02744241.jpg'),
(10, 'RAM', 'Corsair Vengeance', 'Corsair Vengeance RGB 32GB (16x2GB) DDR5 6400MHz - Black', 119, 5, '67dfd8f81bd060.33973094.jpg'),
(11, 'RAM', 'G.SKILL Trident Z5', 'G.SKILL Trident Z5 RGB DDR5 64GB (2x32GB) 6400MT/s ', 279, 5, '67dfd916d4d512.64139217.jpg'),
(12, 'Cooler', 'DeepCool LS720', 'DeepCool LS720 SE Digital - 360mm / 300w TDP', 200, 7, '67dfd975ec29f2.84266828.png'),
(13, 'Cooler', 'ROG Ryujin', '360 ARGB - Asetek 8th gen Pump', 339, 1, '67dfd9c74050b3.04553244.jpg'),
(14, 'Motherboard', 'Gigabyte Z790', 'Supports Intel Core 14th and 13th processors, Digital twin 24+1+2 phases VRM solution, Dual Channel DDR5:4*DIMMs with XMP 3.0 memory module support.', 299, 5, '67dfdb71ed27e5.61009786.png'),
(15, 'Prebuilt', 'Desktop Gaming', 'Desktop Gaming / Design ( Core Ultra 7 265K / Ram 16GB DDR5 / M.2 PCIe 1TB / RTX 3060 12GB )', 1220, 1, '67dfdbf00b6e48.48961498.jpg'),
(16, 'Prebuilt', 'Destop Designing', ' Core Ultra 9 285K / Ram 32GB DDR5 / M.2 PCIe 1TB / ZOTAC RTX 5080 Solid 16GB GDDR7', 1300, 1, '67dfdc697afa08.91880562.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `userRole` varchar(10) NOT NULL DEFAULT 'user',
  `password` varchar(20) NOT NULL,
  `email` varchar(70) NOT NULL,
  `date_of_birth` date NOT NULL,
  `address` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `userRole`, `password`, `email`, `date_of_birth`, `address`) VALUES
(2, 'sophea', 'admin', '123', 'phea@gmail.com', '2025-03-11', 'Phnom Penh'),
(4, 'koko', 'user', '333', 'koko@gmail.com', '2025-03-11', 'Phnom Penh'),
(5, 'rady', 'user', 'Aa@12345', 'rady@gmail.com', '2025-03-11', 'Phnom Penh'),
(6, 'loko', 'user', 'Aa@12345', 'loko@gmail.com', '2025-03-11', 'Kratie'),
(7, 'admin', 'admin', 'Aa@12345', 'rithy@gmail.com', '2025-03-02', 'Phnom Penh');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
