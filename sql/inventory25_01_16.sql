-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2016 at 09:28 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE IF NOT EXISTS `inventories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `purchase_price` decimal(10,2) NOT NULL,
  `sale_price` decimal(10,2) NOT NULL,
  `variant` tinyint(1) NOT NULL,
  `type` varchar(50) NOT NULL COMMENT 'order,fulfillment,sale',
  `created` timestamp NOT NULL,
  `modified` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `user_id`, `product_id`, `quantity`, `purchase_price`, `sale_price`, `variant`, `type`, `created`, `modified`) VALUES
(1, 1, 1, 15, '90.00', '360.00', 1, 'order', '2016-01-21 09:50:32', '2016-01-21 09:50:32'),
(2, 1, 1, 5, '30.00', '120.00', 1, 'fulfillment', '2016-01-21 09:52:56', '2016-01-21 09:52:56'),
(3, 1, 1, 3, '18.00', '72.00', 1, 'fulfillment', '2016-01-21 09:52:56', '2016-01-21 09:52:56'),
(4, 1, 1, 9, '54.00', '225.00', 1, 'sale', '2016-01-21 09:54:42', '2016-01-21 09:54:42'),
(5, 1, 1, 3, '18.00', '84.00', 1, 'sale', '2016-01-21 09:54:42', '2016-01-21 09:54:42'),
(6, 1, 1, 30, '480.00', '720.00', 1, 'order', '2016-01-23 05:02:16', '2016-01-23 05:02:16'),
(7, 1, 1, 10, '70.00', '245.90', 1, 'order', '2016-01-23 05:05:13', '2016-01-23 05:05:13'),
(8, 1, 2, 50, '482.50', '1357.00', 1, 'order', '2016-01-25 02:29:35', '2016-01-25 02:29:35'),
(10, 1, 2, 15, '144.75', '407.10', 1, 'sale', '2016-01-25 02:58:53', '2016-01-25 02:58:53'),
(11, 1, 2, 2, '19.34', '44.00', 1, 'sale', '2016-01-25 03:09:33', '2016-01-25 03:09:33');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `vendor` varchar(150) NOT NULL,
  `type` varchar(150) NOT NULL,
  `tags` text NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '1',
  `price` decimal(10,2) NOT NULL,
  `list_price` decimal(10,2) NOT NULL,
  `sku` varchar(150) NOT NULL,
  `barcode` varchar(150) NOT NULL,
  `quantity` int(11) NOT NULL,
  `weight` float NOT NULL,
  `variants` tinyint(1) NOT NULL DEFAULT '0',
  `attributes` varchar(250) NOT NULL,
  `values` varchar(250) NOT NULL,
  `tax` tinyint(1) NOT NULL DEFAULT '0',
  `shipping` tinyint(1) NOT NULL DEFAULT '0',
  `published_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `title`, `description`, `vendor`, `type`, `tags`, `publish`, `price`, `list_price`, `sku`, `barcode`, `quantity`, `weight`, `variants`, `attributes`, `values`, `tax`, `shipping`, `published_at`, `updated_at`) VALUES
(1, 1, 'McDavid 6440 Hexpad Knee/Elbow/Shin Pad', 'The Impact pad with hexpad technology is integrated into a new low profile, form-fitting knee or elbow pad. Perfect for all levels of impact absorption.', 'McDavid', '', '', 1, '24.98', '24.99', 'bk101', '', 5, 0.11, 1, 'black,white,red', 'small,medium,large', 2, 2, '2016-01-18 11:20:17', '2016-01-18 11:20:17'),
(2, 1, 'McDavid 6446 Extended Compression Leg Sleeve with Hexpad Protective Pad - One Pair', '', 'McDavid', '', '', 1, '27.14', '34.99', 'bk0102', '', 5, 0.11, 1, 'black', 'medium', 2, 2, '2016-01-20 07:10:13', '2016-01-20 07:10:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(10) NOT NULL,
  `photo` text NOT NULL,
  `privilages` varchar(30) NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '1',
  `published_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `phone`, `email`, `password`, `photo`, `privilages`, `publish`, `published_at`, `updated_at`) VALUES
(1, 'vignesh', 'kumar', '9229103990', 'test@yopmail.com', 'test11', '', 'admin', 1, '2016-01-19 06:44:53', '2016-01-19 06:44:53');

-- --------------------------------------------------------

--
-- Table structure for table `varies`
--

CREATE TABLE IF NOT EXISTS `varies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `purchase_price` decimal(10,2) NOT NULL,
  `sale_price` decimal(10,2) NOT NULL,
  `attribute` varchar(50) NOT NULL,
  `value` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL COMMENT 'order,fulfillment,sale',
  `created_at` timestamp NOT NULL,
  `modified_At` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `varies`
--

INSERT INTO `varies` (`id`, `user_id`, `inventory_id`, `product_id`, `quantity`, `purchase_price`, `sale_price`, `attribute`, `value`, `type`, `created_at`, `modified_At`) VALUES
(1, 1, 1, 1, 3, '6.00', '24.00', 'black', 'small', '', '2016-01-19 12:13:41', '2016-01-19 12:13:41'),
(2, 1, 1, 1, 7, '7.00', '24.00', 'black', 'medium', '', '2016-01-19 12:13:41', '2016-01-19 12:13:41'),
(3, 1, 1, 1, 3, '6.00', '10.00', 'black', 'small', 'order', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 1, 6, 1, 10, '5.00', '25.00', '', 'small', 'order', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 1, 6, 1, 10, '5.00', '25.00', '', 'small', 'order', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 1, 6, 1, 10, '6.00', '30.00', '', 'medium', 'order', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 1, 7, 1, 10, '7.00', '24.59', 'black', 'small', 'order', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 1, 8, 2, 50, '9.65', '27.14', 'black', 'medium', 'order', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 1, 10, 2, 15, '9.65', '27.14', 'black', 'medium', 'order', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 1, 11, 2, 2, '9.67', '22.00', 'black', 'medium', 'order', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
