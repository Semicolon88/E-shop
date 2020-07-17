-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 10, 2020 at 11:06 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `E-shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand`) VALUES
(9, 'Adidias'),
(10, 'fendi'),
(11, 'Balenciaga'),
(12, 'zanotti');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `parent`) VALUES
(20, 'shirt', 0),
(21, 'male', 20),
(22, 'boxers', 0),
(23, 'male', 22),
(24, 'female', 22),
(25, 'Skirt', 0),
(26, 'Girl', 25),
(27, 'Female', 0),
(28, 'Top', 27),
(29, 'grid', 27),
(30, 'Girl', 27),
(31, 'Girl', 20);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `list_price` decimal(10,0) NOT NULL,
  `brand` int(11) NOT NULL DEFAULT 0,
  `category` int(11) NOT NULL DEFAULT 0,
  `portfolio` int(11) NOT NULL DEFAULT 0,
  `sizes` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `photo` text NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `price`, `list_price`, `brand`, `category`, `portfolio`, `sizes`, `description`, `photo`, `deleted`) VALUES
(22, 'potty', '5000', '4900', 9, 20, 21, '', 'gvdjbksj.kvmf,', '/E-shop/View/Admin/Uploads/b872943e1caf7c1965b9c1b2ed5bf3b06bd80486.png,/E-shop/View/Admin/Uploads/7e9927bc93b8243bdf5ad9743b2461893bcb7eeb.png,/E-shop/View/Admin/Uploads/6e6a58b2d7202b02842f76a532fdd1b55f2b3522.png', 0),
(23, 'Socks', '5000', '4900', 9, 20, 21, '', 'zdgfhgvjhbkjnK>M', '/E-shop/View/Admin/Uploads/342005ab6c26c455345f9ea538c90fc7e7b12609.png', 0),
(24, 'boot', '5000', '4900', 9, 20, 21, '', 'hgjhbkjlnkml,njv', '/E-shop/View/Admin/Uploads/51d7097f7693fb47bbf55c2d8f5668e05549289f.jpeg', 0),
(25, 'Adiddas', '5000', '4900', 10, 22, 23, '', 'etdfhgjhbkjnlkm;l,', '/E-shop/View/Admin/Uploads/df9eea7309b7cd316200714654b927597ae96406.jpeg', 0),
(26, 'Socks', '5000', '4900', 10, 22, 24, '', 'sfdgfchgvjhbkjnkm.,/.', '/E-shop/View/Admin/Uploads/ec1625dccca3bea291af4254288f7b6c99e988dd.png,/E-shop/View/Admin/Uploads/8aecb3dfa41d9b2decd887740fc93e4556d5e629.png', 0),
(27, 'No stimuli', '5000', '4900', 10, 25, 26, '', 'sfdgfhgjhbkjnmk.,/.', '/E-shop/View/Admin/Uploads/c3011a2771be4cc8804657f003a71e6cc827781b.png,/E-shop/View/Admin/Uploads/fcf2252f739f03423e64f9018e393151a0157290.png,/E-shop/View/Admin/Uploads/45f2c872d7ab27b8b39da9140f24ff2fb7d2d5dc.png,/E-shop/View/Admin/Uploads/7a82ecd20d98542650210d47003484bbe3ed03ad.png', 0),
(28, 'Sweater', '23000', '22900', 11, 27, 28, '', 'gdhksjlck;wdjchekbvdjnk.s', '/E-shop/View/Admin/Uploads/6aed4a03ed0fecb006cda7b08287d2486e43bc9d.png', 0),
(29, 'tried', '20000', '19800', 11, 27, 29, '', '', '/E-shop/View/Admin/Uploads/7b31ffae41c3e62eefdab68592cca461d037ce7e.jpeg', 1),
(30, 'tried', '20000', '19800', 11, 27, 29, '', '', '/E-shop/View/Admin/Uploads/ee21b976aaff08bf62bd102d02a1c531ac04320b.jpeg', 1),
(31, 'tried', '20000', '19800', 11, 27, 29, '', '', '/E-shop/View/Admin/Uploads/64ef3c6a53413e64daf59c997f454fb0067d6b54.jpeg', 1),
(32, 'Socks', '5000', '4900', 11, 27, 29, '45:4,34:2,', 'fdgfhcgvhbj,', '/E-shop/View/Admin/Uploads/466ecad490fcd9a8c69e27e3886df238a460d2db.png,/E-shop/View/Admin/Uploads/5963a97a7a6f29a8f31009ab139b943bfab2605a.png,/E-shop/View/Admin/Uploads/2aedf91d96f9ba2d32f364ebc55f5a7a30cea14a.png', 0),
(33, 'battery', '5000', '4900', 10, 20, 21, '67:3,54:4,', 'hbj,kl', '/E-shop/View/Admin/Uploads/b3467feacb74c118814992b649bcbfdd06688eee.png,/E-shop/View/Admin/Uploads/838e7efea72ce5c4a4364b382e88ac6efa720ae3.png,/E-shop/View/Admin/Uploads/09c9a15a13314a166d101744db6afc05d0ea70c4.png,/E-shop/View/Admin/Uploads/c2269347f1de43be4df50f4417959bb9ada14986.png,/E-shop/View/Admin/Uploads/8e2dbc088dee9220e4f6fc138ce35bd437d6caf2.png,/E-shop/View/Admin/Uploads/43535b197aef941903377658e9df88cd6aa83061.png', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
