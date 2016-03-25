-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Mar 25, 2016 at 10:41 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `products`
--

-- --------------------------------------------------------

--
-- Table structure for table `products_table`
--

CREATE TABLE `products_table` (
  `product_id` int(11) NOT NULL,
  `product_type` varchar(12) NOT NULL COMMENT 'food or clothing',
  `product_name` varchar(30) NOT NULL,
  `product_price` varchar(11) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL COMMENT 'price, inc. decimal'
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products_table`
--

INSERT INTO `products_table` (`product_id`, `product_type`, `product_name`, `product_price`) VALUES
(5, 'food', 'sugar', '0.99'),
(8, 'food', 'crunchy nut cornflakes', '3.99'),
(12, 'clothing', 'Men''s Jacket', '89.99'),
(13, 'food', 'salmon', '4.99'),
(14, 'clothing', 'Women''s Jackets', '49.99'),
(15, 'food', 'tomatoes', '2.49'),
(16, 'clothing', 'Men''s Tan Shoes', '44.99'),
(17, 'food', 'milk', '0.59'),
(18, 'food', 'eggs', '0.22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products_table`
--
ALTER TABLE `products_table`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products_table`
--
ALTER TABLE `products_table`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;