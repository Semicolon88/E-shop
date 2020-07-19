-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 19, 2020 at 02:15 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
(12, 'zanotti'),
(13, 'Phlipino'),
(14, 'Nike'),
(15, 'Polo Ralph');

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
(31, 'Girl', 20),
(32, 'Underwear', 0),
(33, 'Top', 32),
(34, 'Girl', 22),
(35, 'Jersey', 0),
(36, 'male', 35),
(37, 'Top', 22);

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
(22, 'potty', '5000', '4900', 9, 20, 21, '', 'gvdjbksj.kvmf,', '/E-shop/View/Admin/Uploads/b872943e1caf7c1965b9c1b2ed5bf3b06bd80486.png,/E-shop/View/Admin/Uploads/7e9927bc93b8243bdf5ad9743b2461893bcb7eeb.png,/E-shop/View/Admin/Uploads/6e6a58b2d7202b02842f76a532fdd1b55f2b3522.png', 1),
(23, 'Socks', '5000', '4900', 9, 20, 21, '54:2,45:3,36:6,43:4,', 'zdgfhgvjhbkjnK>M', '/E-shop/View/Admin/Uploads/342005ab6c26c455345f9ea538c90fc7e7b12609.png', 1),
(24, 'boot', '5000', '4900', 9, 20, 21, '', 'hgjhbkjlnkml,njv', '/E-shop/View/Admin/Uploads/51d7097f7693fb47bbf55c2d8f5668e05549289f.jpeg', 0),
(25, 'Adiddas', '5000', '4900', 10, 22, 23, '', 'etdfhgjhbkjnlkm;l,', '/E-shop/View/Admin/Uploads/df9eea7309b7cd316200714654b927597ae96406.jpeg', 0),
(26, 'Socks', '5000', '4900', 10, 22, 24, '', 'sfdgfchgvjhbkjnkm.,/.', '/E-shop/View/Admin/Uploads/ec1625dccca3bea291af4254288f7b6c99e988dd.png,/E-shop/View/Admin/Uploads/8aecb3dfa41d9b2decd887740fc93e4556d5e629.png', 0),
(27, 'No stimuli', '5000', '4900', 10, 25, 26, '45:2,', 'sfdgfhgjhbkjnmk.,/.', '/E-shop/View/Admin/Uploads/c3011a2771be4cc8804657f003a71e6cc827781b.png,/E-shop/View/Admin/Uploads/fcf2252f739f03423e64f9018e393151a0157290.png,/E-shop/View/Admin/Uploads/45f2c872d7ab27b8b39da9140f24ff2fb7d2d5dc.png,/E-shop/View/Admin/Uploads/7a82ecd20d98542650210d47003484bbe3ed03ad.png', 0),
(28, 'Sweater', '23000', '22900', 11, 27, 28, '34:3,45:3,', 'gdhksjlck;wdjchekbvdjnk.s', '/E-shop/View/Admin/Uploads/6aed4a03ed0fecb006cda7b08287d2486e43bc9d.png', 0),
(29, 'tried', '20000', '19800', 11, 27, 29, '', '', '/E-shop/View/Admin/Uploads/7b31ffae41c3e62eefdab68592cca461d037ce7e.jpeg', 1),
(30, 'tried', '20000', '19800', 11, 27, 29, '', '', '/E-shop/View/Admin/Uploads/ee21b976aaff08bf62bd102d02a1c531ac04320b.jpeg', 1),
(31, 'tried', '20000', '19800', 11, 27, 29, '', '', '/E-shopView/Admin/Uploads/64ef3c6a53413e64daf59c997f454fb0067d6b54.jpeg', 1),
(32, 'Socks', '5000', '4900', 11, 27, 29, '45:4,34:2,', 'fdgfhcgvhbj,', '/E-shop/View/Admin/Uploads/466ecad490fcd9a8c69e27e3886df238a460d2db.png,/E-shop/View/Admin/Uploads/5963a97a7a6f29a8f31009ab139b943bfab2605a.png,/E-shop/View/Admin/Uploads/2aedf91d96f9ba2d32f364ebc55f5a7a30cea14a.png', 0),
(33, 'battery', '5000', '4900', 10, 20, 21, '67:3,54:4,', 'hbj,kl', '/E-shopView/Admin/Uploads/b3467feacb74c118814992b649bcbfdd06688eee.png,/E-shop/View/Admin/Uploads/838e7efea72ce5c4a4364b382e88ac6efa720ae3.png,/E-shop/View/Admin/Uploads/09c9a15a13314a166d101744db6afc05d0ea70c4.png,/E-shop/View/Admin/Uploads/c2269347f1de43be4df50f4417959bb9ada14986.png,/E-shopView/Admin/Uploads/8e2dbc088dee9220e4f6fc138ce35bd437d6caf2.png,/E-shop/View/Admin/Uploads/43535b197aef941903377658e9df88cd6aa83061.png', 0),
(34, 'Single', '5000', '4900', 13, 32, 33, '34:2,', 'this is a nice product', '/E-shop/View/Admin/Uploads/958f689b5b472c6cc6fef59f9f7d0e002edc5fa1.jpeg', 0),
(35, 'Sweater', '5000', '22900', 14, 27, 29, '45:2,', 'get there fast', '/E-shop/View/Admin/Uploads/07dd40102e169ae56f0ea24a86a0c29e02310455.png,/E-shop/View/Admin/Uploads/b7929babafbe294ecfe70b3ee99240e7bebb0835.png,/E-shop/View/Admin/Uploads/fd9fd8f5dced4c79f1a9e19c57a02dddabda8ef0.png', 0),
(36, 'Sweater', '5000', '22900', 14, 27, 29, '45:2,', 'get there fast', '/E-shop/View/Admin/Uploads/e7a15a89a8f4a206b2a00d607f8527b81816cd78.png,/E-shop/View/Admin/Uploads/63d15638ab1df6ecbc28b18b101bfc5943f4a125.png,/E-shop/View/Admin/Uploads/56a8582819543dd38693c6c00af787f7f053d8ef.png', 0),
(37, 'Socks', '5000', '22900', 11, 22, 34, '35:3,', 'this is what i\'m trying to do', '/E-shop/View/Admin/Uploads/0cc76173e0a27c0eb6f7c8eaff0616da31de47d7.png,/E-shop/View/Admin/Uploads/a400b66fbbfb7c43bb599d742dce67311002ac2b.png', 0),
(38, 'Socks', '5000', '22900', 11, 22, 34, '35:3,', 'this is what i\'m trying to do', '/E-shop/View/Admin/Uploads/9a474da750b892bc221e10178797c5bb51f2d7cc.png,/E-shop/View/Admin/Uploads/cee13025725c3540b0134a4a07178e46d2711918.png', 0),
(39, 'Baseball Jersey', '25000', '13900', 15, 35, 36, '45:3,44:4,', 'This is a nice product', '/E-shop/View/Admin/Uploads/ed716dd9a8857fd5ce19da4cd711a47f19f33c8d.png,/E-shop/View/Admin/Uploads/ddcc887ec2c32ec969d6d4c02b9b203787f2a9ef.png', 0),
(40, 'Adiddas', '5000', '4900', 9, 22, 37, '43:2,', 'gfhgjj,m.', '/E-shop/View/Admin/Uploads/32fbadca980d6857994e2f427ddba9941f870f69.png,/E-shop/View/Admin/Uploads/de5c367c5ba9870761438a095ff34e57b84aa580.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pword` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `pword`, `first_name`, `last_name`) VALUES
(1, 'ajani_habeeb@yahoo.com', '$2y$10$TdvpJ47wio3tj3XpTVnoL.Yc1SSGsE51pOC24A7WPHMRdJK80PxBe', '', ''),
(2, 'ajani_habeeb88@yahoo.com', '$2y$10$TF6IhjsCoDDBqHLn/0RK3epBSbJmSdi3gkWsWfceslaZD1fG3xq82', '', ''),
(3, 'popo@gmail.com', '$2y$10$nnlhK2LUYrTMy90a3593yOwzLUNnwDV7fJ1UPfnTaF/mQBI33435K', '', ''),
(4, 'trinity@gmail.com', '$2y$10$YYhu.DxqIUsy4eFjdM71ZuoeZtNmazoF1cI0R1vsry.Y2.3LSqjZO', 'Ajani', 'Habeeb');

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
