-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 10, 2023 at 02:28 PM
-- Server version: 5.7.39
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wd04_products`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id_account` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id_account`, `email`, `pass`, `create_date`) VALUES
(1, 'admin@gmail.com', '031caa5f77e6dfdbbec2b900184b62d7', '2023-01-05 14:14:07'),
(2, 'admin1@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', '2023-01-05 14:14:07'),
(3, 'admin2@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', '2023-01-05 14:14:07'),
(4, 'admin3@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', '2023-01-05 14:14:07'),
(5, 'admin4@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', '2023-01-05 14:14:07'),
(6, 'admin5@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', '2023-01-05 14:14:07'),
(7, 'admin6@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', '2023-01-05 14:14:07'),
(8, 'admin8@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', '2023-01-05 14:14:07'),
(9, 'admin9@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', '2023-01-05 14:14:07'),
(10, 'admin10@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', '2023-01-05 14:14:07');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id_product` int(11) NOT NULL,
  `id_product_category` int(11) NOT NULL,
  `id_account` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` text NOT NULL,
  `price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id_product`, `id_product_category`, `id_account`, `name`, `image`, `price`) VALUES
(1, 1, 1, 'iphone 12', 'ip.jpg', '12000000'),
(2, 1, 1, 'iphone 13', 'iphone-13-256gb-didongviet_1.jpg', '12222222'),
(3, 1, 1, 'iphone 13', '', '2432423'),
(4, 1, 1, 'HAHA', 'ip.jpg', '2222222222'),
(5, 1, 1, 'BAAAA', 'iphone-13-256gb-didongviet_1.jpg', '2222222222');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id_product_category` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id_product_category`, `name`, `description`) VALUES
(1, 'Smartphone', 'mo ta 1'),
(2, 'Bphone', 'mo ta 2'),
(3, 'Iphone', 'mo ta 2'),
(4, 'Dphone', 'mo ta 2'),
(5, 'Jphone', 'mo ta 2'),
(6, 'Gphone', 'mo ta 2'),
(7, 'Fphone', 'mo ta 2'),
(8, 'Vphone', 'mo ta 2'),
(9, 'Zphone', 'mo ta 2'),
(10, 'Aphone', 'mo ta 2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id_account`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `FK_account` (`id_account`),
  ADD KEY `FK_product_category` (`id_product_category`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id_product_category`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id_account` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id_product_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_account` FOREIGN KEY (`id_account`) REFERENCES `account` (`id_account`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_product_category` FOREIGN KEY (`id_product_category`) REFERENCES `product_category` (`id_product_category`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
