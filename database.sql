-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2025 at 05:55 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cloth_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_password` varchar(20) NOT NULL,
  `admin_image` mediumblob NOT NULL,
  `admin_phone` varchar(10) NOT NULL,
  `admin_address` varchar(100) NOT NULL,
  `admin_ip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`, `admin_image`, `admin_phone`, `admin_address`, `admin_ip`) VALUES
(2, 'admin', 'admin@admin.com', 'admin123', 0x4c6f756973205068696c69707065204d656e277320536c696d2050616e7473322e6a7067, '9692439651', 'Bhangel', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(10) NOT NULL,
  `brand_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `brand_name`) VALUES
(1, 'ZARA'),
(2, 'Levi\'s'),
(3, 'Pantaloons'),
(4, 'Bewakoof'),
(5, 'Allen Solly'),
(6, 'Leriya'),
(7, 'Louis Philippe'),
(8, 'Calvin Klein'),
(9, 'Dennis Lingo');

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `id` int(20) NOT NULL,
  `product_id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'T-Shirt'),
(2, 'Shirt'),
(3, 'Jacket'),
(4, 'Jeans'),
(5, 'Pant'),
(6, 'Hoodie'),
(7, 'Trousers');

-- --------------------------------------------------------

--
-- Table structure for table `order_history`
--

CREATE TABLE `order_history` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `DATE` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_history`
--

INSERT INTO `order_history` (`id`, `order_id`, `user_id`, `product_id`, `quantity`, `status`, `DATE`) VALUES
(1, 16, 14, 8, 1, 'canceled', '2025-04-08 18:05:50'),
(2, 18, 14, 6, 1, 'completed', '2025-04-08 18:05:57');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_description` text NOT NULL,
  `product_keyword` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_image1` mediumblob NOT NULL,
  `product_image2` mediumblob NOT NULL,
  `product_image3` mediumblob NOT NULL,
  `product_price` int(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_description`, `product_keyword`, `category_id`, `brand_id`, `product_image1`, `product_image2`, `product_image3`, `product_price`, `date`, `status`) VALUES
(1, 'Bewakoof Men\'s Graphic Print Oversized Fit T-Shirt', 'Fit: Oversized Fit - Super Loose On Body Thoda Hawa Aane De\r\nPrint Type: Graphic Print\r\nFabric Description: Single Jersey, 100% Cotton\r\nNeck: Round Neck\r\nStyle Tip: Pair it with cargo shorts and sliders for an easygoing look', 'Bewakoof Mens Graphic   Print Oversized Fit T-Shirt  Men\'s ', 1, 4, 0x426577616b6f6f66204d656e27732047726170686963205072696e74204f76657273697a65642046697420542d5368697274312e6a7067, 0x426577616b6f6f66204d656e27732047726170686963205072696e74204f76657273697a65642046697420542d5368697274332e6a7067, 0x6f7665726c6f61642e77656270, 699, '2025-04-09 07:23:44', '1'),
(2, 'Allen Solly Men\'s Regular Fit Formal Shirt', 'Occasion : Business Casual\r\nMaterial : 100% Cotton\r\nProduct Type : Shirt\r\nPattern : Solid\r\nFit : Slim Fit\r\nBrand: Allen Solly', 'Allen Solly Mens Regular Fit Formal Shirt               Men\'s ', 2, 5, 0x416c6c656e20536f6c6c79204d656e277320526567756c61722046697420466f726d616c205368697274312e6a7067, 0x416c6c656e20536f6c6c79204d656e277320526567756c61722046697420466f726d616c205368697274322e6a7067, 0x416c6c656e20536f6c6c79204d656e277320526567756c61722046697420466f726d616c205368697274332e6a7067, 999, '2025-04-03 11:23:31', '100'),
(3, 'Allen Solly Men\'s Slim Fit Shirt', 'Occasion : Business Casual\r\nMaterial : 100% Cotton\r\nProduct Type : Shirt\r\nPattern : Solid\r\nFit : Slim Fit\r\nBrand: Allen Solly', 'Allen Solly Mens Slim Fit Shirt Men\'s ', 2, 5, 0x416c6c656e20536f6c6c79204d656e277320536c696d20466974205368697274312e6a7067, 0x416c6c656e20536f6c6c79204d656e277320536c696d20466974205368697274332e6a7067, 0x416c6c656e20536f6c6c79204d656e277320536c696d20466974205368697274322e6a7067, 999, '2025-04-03 11:23:33', '100'),
(4, 'Leriya Fashion Mens Rayon Man Casual Shirt Regular Fit Western', 'Fabric:- Rayon || Color:- Multi Colored || Pattern:- Stylish Tropical Leaf Print || Sleeves:- Short Sleeve || Fit Type:- Regular', 'Leriya Fashion Mens Rayon Man Casual Shirt Regular Fit Western Men\'s ', 2, 6, 0x4c65726979612046617368696f6e204d656e73205261796f6e204d616e2043617375616c20536869727420526567756c617220466974205765737465726e312e6a7067, 0x4c65726979612046617368696f6e204d656e73205261796f6e204d616e2043617375616c20536869727420526567756c617220466974205765737465726e332e6a7067, 0x4c65726979612046617368696f6e204d656e73205261796f6e204d616e2043617375616c20536869727420526567756c617220466974205765737465726e322e6a7067, 999, '2025-04-03 11:23:45', '0'),
(5, 'Louis Philippe Men\'s Slim Pants', 'Product Type: Trousers\r\nOccasion: Formal\r\nPattern: Textured\r\nFront Style: Flat Front\r\nFit: Slim Fit', 'Louis Philippe Men\'s Slim Pants', 5, 7, 0x4c6f756973205068696c69707065204d656e277320536c696d2050616e7473312e6a7067, 0x4c6f756973205068696c69707065204d656e277320536c696d2050616e7473322e6a7067, 0x4c6f756973205068696c69707065204d656e277320536c696d2050616e7473332e6a7067, 2999, '2025-04-03 11:23:37', '100');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(20) NOT NULL,
  `user_address` varchar(30) NOT NULL,
  `user_phone` varchar(10) NOT NULL,
  `user_image` mediumblob NOT NULL,
  `user_ip` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_password`, `user_address`, `user_phone`, `user_image`, `user_ip`) VALUES
(14, 'Praveen', 'praveen@gmail.com', 'praveen123', 'Bhangel', '1234512345', 0x6f7665726c6f61642e77656270, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `user_orders`
--

CREATE TABLE `user_orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `invoice` int(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `order_status` varchar(11) NOT NULL,
  `order_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `quantity` int(255) NOT NULL,
  `mode` varchar(10) NOT NULL,
  `payment` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_orders`
--

INSERT INTO `user_orders` (`order_id`, `user_id`, `product_id`, `invoice`, `amount`, `order_status`, `order_time`, `quantity`, `mode`, `payment`) VALUES
(20, 14, 1, 599342120, 599, 'pending', '2025-04-08 18:55:41', 1, 'offline', 'pending'),
(21, 14, 5, 468965020, 2999, 'pending', '2025-04-08 18:55:41', 1, 'offline', 'pending'),
(22, 14, 2, 1517476489, 999, 'pending', '2025-04-08 18:55:41', 1, 'offline', 'pending'),
(23, 14, 6, 606955240, 4999, 'pending', '2025-04-08 18:55:41', 1, 'offline', 'pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `order_history`
--
ALTER TABLE `order_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_orders`
--
ALTER TABLE `user_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cart_details`
--
ALTER TABLE `cart_details`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_history`
--
ALTER TABLE `order_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_orders`
--
ALTER TABLE `user_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
