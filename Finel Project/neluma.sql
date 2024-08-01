-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 19, 2024 at 04:03 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `neluma`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(5, 'Dhananjaya', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(6, 'Kaveesha', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(7, 'kokila', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `pid` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int NOT NULL,
  `quantity` int NOT NULL,
  `image` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_user` (`user_id`),
  KEY `FK_products` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `catid` int NOT NULL AUTO_INCREMENT,
  `catname` varchar(50) NOT NULL,
  PRIMARY KEY (`catid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`catid`, `catname`) VALUES
(1, 'Breakfast'),
(2, 'Lunch'),
(4, 'Dinner'),
(5, 'Kottu'),
(6, 'Rice'),
(7, 'Noodles'),
(8, 'Beverages'),
(10, 'Special Offers');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(10) NOT NULL,
  `message` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `number`, `message`) VALUES
(1, 'Dhananjaya', 'dhananjaya@gmail.com', '0719764538', 'My order has not been approved yet.'),
(3, 'Dhananjaya', 'dhananjaya@gmail.com', '0714567896', 'Order tracking not working');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int NOT NULL,
  `placed_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'pending',
  `rider_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_user` (`user_id`),
  KEY `FK_rider` (`rider_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `order_status`, `rider_id`) VALUES
(4, 1, 'Dhananjaya', '0774575075', 'dhananjaya@gmail.com', 'cash on delivery', 'No.234, Temple Road, Ihala Bomiriya, Kaduwela, Colombo, Western Province - 10700', 'Seafood & Cheese Kottu (1350 x 1) - Chicken & Cheese Kottu (1290 x 1) - Strawberry Milkshake (850 x 1) - ', 3490, '2024-07-18 19:47:51', 'order received', 2),
(5, 1, 'Dhananjaya', '0774575075', 'dhananjaya@gmail.com', 'cash on delivery', 'No.234, Temple Road, Ihala Bomiriya, Kaduwela, Colombo, Western Province - 10700', 'Special Mixed Chopsuey rice (2290 x 1) - ', 2290, '2024-07-18 20:29:20', 'order received', 2),
(7, 5, 'Rashini', '0753444567', 'rashini@gmail.com', 'cash on delivery', 'no.21/2, 2nd lane, nawala, nugegoda, colombo, western province - 10700', 'Vegetable Kottu (930 x 1) - ', 930, '2024-07-18 22:28:27', 'ready to deliver', 2),
(8, 1, 'Dhananjaya', '0774575075', 'dhananjaya@gmail.com', 'cash on delivery', 'No.234, Temple Road, Ihala Bomiriya, Kaduwela, Colombo, Western Province - 10700', 'Kottu & Rice Offer (2390 x 1) - ', 2390, '2024-07-18 23:09:12', 'approved', 0),
(9, 1, 'Dhananjaya', '0774575075', 'dhananjaya@gmail.com', 'credit card', 'No.234, Temple Road, Ihala Bomiriya, Kaduwela, Colombo, Western Province - 10700', 'Vegetable Kottu (930 x 1) - Egg Kottu (930 x 1) - ', 1860, '2024-07-19 13:46:38', 'request refund', 2),
(10, 1, 'Dhananjaya', '0774575075', 'dhananjaya@gmail.com', 'credit card', 'No.234, Temple Road, Ihala Bomiriya, Kaduwela, Colombo, Western Province - 10700', 'Seafood & Cheese Kottu (1350 x 1) - Chicken Kottu (1140 x 1) - Strawberry Mojito (850 x 1) - ', 3340, '2024-07-19 20:52:46', 'approved', 0),
(11, 5, 'Rashini', '0753444567', 'rashini@gmail.com', 'cash on delivery', 'no.21/2, 2nd lane, nawala, nugegoda, colombo, western province - 10700', 'Vegetable Kottu (930 x 1) - Egg Kottu (930 x 1) - ', 1860, '2024-07-19 20:54:02', 'approved', 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` int NOT NULL,
  `image` varchar(100) NOT NULL,
  `catid` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_products` (`catid`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `catid`) VALUES
(4, 'Chicken & Cheese Kottu', 1290, 'Cheese-Kottu.png', 5),
(5, 'Mixed Rice', 1390, 'Mixed-Rice.png', 6),
(6, 'Chicken Noodles', 930, 'Chicken-Noodles.png', 7),
(7, 'Seafood Noodles', 1150, 'Seafood-Noodles.png', 7),
(8, 'Chocolate Milkshake', 750, 'Chocolate-Milkshake.png', 8),
(9, 'Classic Mojito', 850, 'Classic Mojito.png', 8),
(11, 'Seafood & Cheese Kottu', 1350, 'Seafood-Cheese.png', 5),
(12, 'Strawberry Milkshake', 850, 'Strawberry-Milkshake.png', 8),
(13, 'Egg Kottu', 930, 'Egg-Kottu.png', 5),
(14, 'Blueberry Mojito', 800, 'Blueberry-Mojito.png', 8),
(15, 'Chicken Kottu', 1140, 'Chicken-Kottu.png', 5),
(16, 'Special Mixed Chopsuey rice', 2290, 'Mixed-Chopsuey-Rice-DSC07126-removebg-preview.png', 6),
(17, 'Vegetable Kottu', 930, 'Pork-Kottu.png', 5),
(18, 'Vegetable Chopsuey Rice', 1590, 'Veg-Chopsuey.png', 6),
(19, 'Vanilla Milkshake', 840, 'Vanilla-Milkshake.png', 8),
(20, 'Special Kottu', 1290, 'Special-Kottu.png', 5),
(21, 'Strawberry Mojito', 850, 'Strawberry.png', 8),
(23, 'Kottu & Rice Offer', 2390, 'Kottu&Rice Offer.png', 10),
(24, 'Family Offer', 3390, 'Family Offer.png', 10),
(25, 'Kottu & Noodles Offer', 2390, 'Kottu&Noodles Offer.png', 10),
(26, 'Cheese Kottu Offer', 2590, 'CO.png', 10);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
  `review_id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) NOT NULL,
  `user_rating` int NOT NULL,
  `user_review` varchar(1000) NOT NULL,
  `datetime` int NOT NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `user_name`, `user_rating`, `user_review`, `datetime`) VALUES
(6, 'Dhananjaya', 5, 'Foods taste really good', 1720975948),
(7, 'Dhananjaya', 5, 'Excellent foods', 1721329750);

-- --------------------------------------------------------

--
-- Table structure for table `rider`
--

DROP TABLE IF EXISTS `rider`;
CREATE TABLE IF NOT EXISTS `rider` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rider`
--

INSERT INTO `rider` (`id`, `name`, `password`) VALUES
(2, 'lakshan', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(4, 'Ravindu', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `number`, `password`, `address`) VALUES
(1, 'Dhananjaya', 'dhananjaya@gmail.com', '0774575075', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'No.234, Temple Road, Ihala Bomiriya, Kaduwela, Colombo, Western Province - 10700'),
(2, 'Virantha', 'virantha@gmail.com', '0710835085', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', ''),
(5, 'Rashini', 'rashini@gmail.com', '0753444567', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'no.21/2, 2nd lane, nawala, nugegoda, colombo, western province - 10700'),
(15, 'Nimnaka', 'nimnaka@gmail.com', '0753456478', '$2y$10$p5WwxAT6phwK0EDLoCZhXuPwwunUrWwVZecFPf/pqSI', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
