-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 11, 2025 at 10:12 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `id` smallint NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`) VALUES
(1, 'Intel'),
(2, 'Intel'),
(3, 'AMD'),
(4, 'MSI'),
(5, 'Asus'),
(6, 'Cooler Master'),
(7, 'XPG'),
(8, 'Samsung');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` smallint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Motherboard'),
(2, 'CPU'),
(3, 'PSU'),
(4, 'Ram'),
(5, 'Storage'),
(6, 'GPU'),
(7, 'PC Case'),
(8, 'CPU Cooler'),
(9, 'Fan');

-- --------------------------------------------------------

--
-- Table structure for table `prebuilts`
--

DROP TABLE IF EXISTS `prebuilts`;
CREATE TABLE IF NOT EXISTS `prebuilts` (
  `id` smallint UNSIGNED NOT NULL AUTO_INCREMENT,
  `motherboard_id` smallint NOT NULL,
  `cpu_id` smallint NOT NULL,
  `psu_id` smallint NOT NULL,
  `ram_id` smallint NOT NULL,
  `storage_id` smallint NOT NULL,
  `gpu_id` smallint NOT NULL,
  `case_id` smallint NOT NULL,
  `cpu_cooler_id` smallint NOT NULL,
  `fan_id` smallint NOT NULL,
  `price` varchar(60) NOT NULL,
  `operating_sytem` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `prebuilts_motherboard_id_foreign` (`motherboard_id`),
  KEY `prebuilts_ram_id_foreign` (`ram_id`),
  KEY `prebuilts_cpu_cooler_id_foreign` (`cpu_cooler_id`),
  KEY `prebuilts_gpu_id_foreign` (`gpu_id`),
  KEY `prebuilts_storage_id_foreign` (`storage_id`),
  KEY `prebuilts_fan_id_foreign` (`fan_id`),
  KEY `prebuilts_cpu_id_foreign` (`cpu_id`),
  KEY `prebuilts_case_id_foreign` (`case_id`),
  KEY `prebuilts_psu_id_foreign` (`psu_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` smallint UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` smallint NOT NULL,
  `brand_id` smallint NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` int NOT NULL,
  `qty` smallint NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` smallint NOT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_created_by_foreign` (`created_by`),
  KEY `products_brand_id_foreign` (`brand_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` smallint UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `role` tinyint(1) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(70) NOT NULL,
  `date_of_birth` date NOT NULL,
  `address` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `role`, `password`, `email`, `date_of_birth`, `address`) VALUES
(1, 'rithy', 1, '123', 'hangrithy@gmail.com', '2005-06-08', 'Phnom Penh');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
