-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2019 at 10:25 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `adminId` int(11) NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `adminUser` varchar(255) NOT NULL,
  `adminEmail` varchar(255) NOT NULL,
  `adminPass` varchar(32) NOT NULL,
  `level` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminId`, `adminName`, `adminUser`, `adminEmail`, `adminPass`, `level`) VALUES
(1, 'Michael Sutradhar', 'michael', 'michaelsutradhar@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brandId` int(11) NOT NULL,
  `brandName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brandId`, `brandName`) VALUES
(2, 'Samsung'),
(3, 'Smart Phone'),
(5, 'Canon'),
(6, 'Acer'),
(7, 'Iphone');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cartId` int(11) NOT NULL,
  `sessionId` varchar(255) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `catId` int(11) NOT NULL,
  `catName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`catId`, `catName`) VALUES
(1, 'Desktop'),
(3, 'Television'),
(4, 'Mobile'),
(9, 'Sports'),
(10, 'Laptop'),
(11, 'Camera'),
(12, 'Clothing'),
(13, 'Jwellery'),
(14, 'Accesories');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_city`
--

CREATE TABLE `tbl_city` (
  `city_id` int(11) NOT NULL,
  `cityName` varchar(255) NOT NULL,
  `country_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_city`
--

INSERT INTO `tbl_city` (`city_id`, `cityName`, `country_id`) VALUES
(1, 'Dhaka', 1),
(2, 'Chittagong', 1),
(3, 'Kolkhata', 2),
(4, 'Chennai', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_compare`
--

CREATE TABLE `tbl_compare` (
  `id` int(11) NOT NULL,
  `cmrid` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_country`
--

CREATE TABLE `tbl_country` (
  `country_id` int(11) NOT NULL,
  `countryName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_country`
--

INSERT INTO `tbl_country` (`country_id`, `countryName`) VALUES
(1, 'Bangladesh'),
(2, 'India');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `zip` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `name`, `address`, `city`, `country`, `zip`, `phone`, `email`, `password`, `status`) VALUES
(13, 'Michael Sutradhar', 'Patiya', '3', '2', '1410', '01861931612', 'michaelsutradhar@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 1),
(14, 'Emon Chowdhury', 'West Bengal', '2', '1', '9780', '01812086003', 'emonchy35@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(11) NOT NULL,
  `cmrid` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `cmrid`, `productId`, `productName`, `quantity`, `price`, `image`, `date`, `status`) VALUES
(123, 13, 50, 'Smart Tv', 1, 970.35, 'upload/20103ddd8a.jpg', '2019-06-24 13:07:14', 2),
(124, 13, 43, 'Smart Camera', 1, 325.75, 'upload/0c2a724daf.jpg', '2019-06-24 13:07:14', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `catId` int(11) NOT NULL,
  `brandId` int(11) NOT NULL,
  `body` text NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`productId`, `productName`, `catId`, `brandId`, `body`, `price`, `image`, `type`) VALUES
(36, 'HDMI Camera', 11, 5, '<p>Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.</p>', 603.66, 'upload/5903858583.png', 0),
(40, 'CC Camera', 14, 5, '<p>Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.</p>', 750.24, 'upload/eaeea211ed.jpg', 0),
(41, 'Lorem Ipsum is simply', 14, 6, '<p>Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.v.v.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.</p>', 567.80, 'upload/d16df7a891.png', 1),
(43, 'Smart Camera', 14, 5, '<p>Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.v.v.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.</p>', 325.75, 'upload/0c2a724daf.jpg', 1),
(44, 'CCTV Footage Camera', 14, 6, '<p>Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.</p>', 850.24, 'upload/3d7c1f4ada.jpg', 1),
(47, 'Television', 3, 2, '<p>Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.</p>', 450.25, 'upload/14eb4a8386.jpg', 0),
(49, 'HD Camera', 10, 2, '<p>Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.</p>', 345.67, 'upload/ae80767bfc.png', 0),
(50, 'Smart Tv', 3, 2, '<p>Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.</p>', 970.35, 'upload/20103ddd8a.jpg', 1),
(51, 'CCTV Camera', 11, 7, '<p>Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.</p>', 870.56, 'upload/ffaadcc2cb.jpg', 1),
(52, 'Filter', 14, 6, '<p>Lorem Ipsum is simply.Lorem Ipsum is simply.Lorem Ipsum is simply.v.Lorem Ipsum is simply.</p>', 678.45, 'upload/b728aa70ae.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rating`
--

CREATE TABLE `tbl_rating` (
  `id` int(11) NOT NULL,
  `cmrid` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_rating`
--

INSERT INTO `tbl_rating` (`id`, `cmrid`, `productId`, `rating`, `timestamp`) VALUES
(12, 10, 43, 4, '2019-06-24 16:31:01'),
(13, 10, 50, 5, '2019-06-24 16:32:33'),
(14, 11, 51, 5, '2019-06-24 16:40:38'),
(15, 12, 51, 5, '2019-06-24 18:01:50'),
(16, 12, 43, 2, '2019-06-24 18:03:08'),
(17, 13, 51, 2, '2019-06-24 20:19:41'),
(18, 13, 43, 4, '2019-06-24 20:19:51');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wishlist`
--

CREATE TABLE `tbl_wishlist` (
  `id` int(11) NOT NULL,
  `cmrid` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_wishlist`
--

INSERT INTO `tbl_wishlist` (`id`, `cmrid`, `productId`, `productName`, `price`, `image`) VALUES
(2, 1, 43, 'Lorem Ipsum is simply', 325.75, 'upload/0c2a724daf.jpg'),
(4, 1, 44, 'Lorem Ipsum is simply', 850.24, 'upload/3d7c1f4ada.jpg'),
(5, 0, 35, 'Lorem Ipsum is simply', 505.22, 'upload/30f5d5a2b1.jpg'),
(6, 9, 35, 'Lorem Ipsum is simply', 505.22, 'upload/30f5d5a2b1.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brandId`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cartId`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`catId`);

--
-- Indexes for table `tbl_city`
--
ALTER TABLE `tbl_city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `tbl_compare`
--
ALTER TABLE `tbl_compare`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_country`
--
ALTER TABLE `tbl_country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brandId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_city`
--
ALTER TABLE `tbl_city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_compare`
--
ALTER TABLE `tbl_compare`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_country`
--
ALTER TABLE `tbl_country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
