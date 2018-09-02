-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2018 at 07:08 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emarket`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `parent` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent`, `status`) VALUES
(1, 'TShirt', 0, 1),
(2, 'Electronics', 2, 0),
(3, 'Jeans', 0, 1),
(5, 'Men', 1, 1),
(6, 'Sports', 1, 1),
(7, 'dfgdfg', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `content` varchar(500) NOT NULL,
  `pid` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `suspended` int(1) NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `userId`, `content`, `pid`, `status`, `suspended`, `date`) VALUES
(1, 2, 'test review', 1, 1, 0, ''),
(2, 2, 'hi', 1, 1, 0, ''),
(3, 2, 'fdsj', 1, 1, 0, ''),
(4, 2, 'new review', 2, 1, 0, ''),
(5, 2, 'Three review', 3, 1, 0, ''),
(6, 2, 'This is dated', 1, 1, 0, 'Sunday 22nd of April 2018 01:39:54 AM');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `cid` int(2) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(5) NOT NULL,
  `offer` float NOT NULL,
  `picture` varchar(500) NOT NULL,
  `date` varchar(50) NOT NULL,
  `userId` int(20) NOT NULL,
  `status` int(1) NOT NULL,
  `suspended` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `cid`, `price`, `quantity`, `offer`, `picture`, `date`, `userId`, `status`, `suspended`) VALUES
(1, 'Test12', 5, 250.52, 17, 0, '2018.04.21.20.29.39.jpg', '2018-04-21', 2, 1, 0),
(2, 'two', 2, 120, 22, 30.265, '2018.04.21.23.51.50.jpg', '2018-04-21', 2, 0, 0),
(3, 'Three', 5, 250.65, 23, 23, '2018.04.22.01.03.50.jpeg', '2018-04-22', 2, 1, 1),
(4, 'TS2', 1, 125.325, 98, 10, '2018.04.22.09.51.55.jpeg', '2018-04-22', 2, 1, 0),
(5, 'New', 1, 120, 249, 0, '2018.04.22.10.46.43.png', '2018-04-22', 2, 1, 0),
(6, 'New2', 3, 450.5, 12, 5, '2018.04.22.10.47.16.png', '2018-04-22', 2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sells`
--

CREATE TABLE `sells` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `dayno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sells`
--

INSERT INTO `sells` (`id`, `pid`, `dayno`) VALUES
(1, 1, 12),
(2, 1, 12),
(5, 1, 3),
(6, 1, 8),
(7, 1, 25),
(8, 1, 12),
(9, 4, 12),
(10, 6, 12),
(11, 1, 12),
(12, 4, 12),
(13, 5, 12),
(14, 6, 12),
(15, 6, 12);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nickName` varchar(200) NOT NULL,
  `name` varchar(300) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `age` int(2) NOT NULL,
  `type` int(2) NOT NULL,
  `address` varchar(500) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nickName`, `name`, `email`, `password`, `phone`, `age`, `type`, `address`, `status`) VALUES
(1, 'mujahid', 'Abdullah Al Mujahid', 'mujahid.swadhin@gmail.com', 'c7aca4adcf1e90a562022978ed414440', '', 25, 3, 'House-20, Road-8, Block-H\r\nSouth Banasree', 1),
(2, 'MyShop', 'Ekram Hossen', 'ekram@gmail.com', '0227a5da8af08c12889470994c181bda', '01924545487', 25, 2, 'House-320/A\r\nBanasree,\r\nDhaka 1219', 1),
(3, 'Azbi', 'Azbi Mohammad', 'azbi@gmail.com', '2ade2fd4cc0fc616d5cc2adc448e2ba9', '01924585858', 24, 1, 'House-20, Road-8, Block-H\r\nSouth Banasree', 1),
(4, 'Mujahid', 'Abdullah Al Mujahid', 'mujahid@gmail.com', 'c7aca4adcf1e90a562022978ed414440', '01924535146', 25, 2, 'House-20, Road-8, Block-H\r\nSouth Banasree', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sells`
--
ALTER TABLE `sells`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `sells`
--
ALTER TABLE `sells`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
