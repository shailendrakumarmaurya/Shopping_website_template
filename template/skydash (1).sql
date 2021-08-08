-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 22, 2021 at 08:33 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skydash`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
CREATE TABLE IF NOT EXISTS `banners` (
  `banner_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL,
  `banner_image` varchar(255) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`banner_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`banner_id`, `status`, `banner_image`, `position`) VALUES
(10, 1, 'images/banners/face21.jpg', 222),
(9, 0, 'images/banners/face21.jpg', 2),
(3, 0, 'images/banners/face20.jpg', 2),
(5, 0, 'images/banners/face19.jpg', 2),
(8, 1, 'images/banners/face13.jpg', 2),
(12, 1, 'images/banners/face19.jpg', 255),
(15, 0, 'images/banners/face21.jpg', 222);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `category_image` varchar(255) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_image`) VALUES
(80, 'Digital', 'images/img/face21.jpg'),
(78, 'Clothing', 'images/img/face15.jpg'),
(77, 'book', 'images/img/face16.jpg'),
(76, 'Electronic', 'images/img/face9.jpg'),
(79, 'new img', 'images/img/face9.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `sku` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=191 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`category_id`, `sub_category_id`, `product_id`, `product_name`, `description`, `sku`, `img`, `price`, `status`) VALUES
(77, 69, 189, 'ytrehtre', 'yety', '35235', 'images/products/face3.jpg', 5423, '1'),
(77, 70, 190, 'hdftrgah', 'yheardh', '5434', 'images/products/face4.jpg', 43, '0'),
(76, 66, 187, 't43t', '43t', '4555', 'images/products/face1.jpg', 45, '1'),
(76, 66, 188, '4t6', 'rygdf', '45543', 'images/products/face8.jpg', 45, '0'),
(80, 64, 186, 'auhetr', 'trhjtr', '454', 'images/products/face27.jpg', 45, '0'),
(76, 66, 185, 'auhetr', 'trhjtr', '45', 'images/products/face24.jpg', 45, '1'),
(77, 70, 184, 'ery', 'earyhe', '444', 'images/products/face17.jpg', 44, '0'),
(77, 70, 183, 'tygasrgh', 'drhedae', '44', 'images/products/face17.jpg', 44, '0');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

DROP TABLE IF EXISTS `sub_category`;
CREATE TABLE IF NOT EXISTS `sub_category` (
  `sub_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` varchar(255) NOT NULL,
  `sub_category_name` varchar(255) NOT NULL,
  `sub_category_image` varchar(255) NOT NULL,
  PRIMARY KEY (`sub_category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`sub_category_id`, `category_id`, `sub_category_name`, `sub_category_image`) VALUES
(71, '77', 'word power', 'images/sub_img/face19.jpg'),
(70, '77', 'fire', 'images/sub_img/face16.jpg'),
(69, '77', 'wings', 'images/sub_img/face18.jpg'),
(68, '78', 'Hoodies', 'images/sub_img/face21.jpg'),
(67, '78', 'T-Shirt', 'images/sub_img/face21.jpg'),
(66, '76', 'new', 'images/sub_img/face24.jpg'),
(65, '80', 'earplug', 'images/sub_img/face22.jpg'),
(64, '80', 'watch', 'images/sub_img/face15.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `country` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `country`, `password`) VALUES
(12, 'test', 'test@test.com', 'USA', '$2y$10$dkiDoHttF/1xMAgnAYikDOmc2e5g4iGzYKo9C6RnUjlLyAUHP8SQS');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
