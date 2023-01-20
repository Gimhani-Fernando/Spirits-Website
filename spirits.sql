-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2023 at 06:41 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spirits`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `email`, `password`, `username`) VALUES
(1, 'gimhanif44@gmail.com', '$2y$10$ZSPzAa6VBOJenFcPnArfGecyfN8IONmFN/5ZkTCnWn0zDWWc/cGSO', 'Spirits_admin');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `product_id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `quantity` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice` int(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `number_of_products` int(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `invoice`, `amount`, `number_of_products`, `order_date`, `order_status`) VALUES
(1, 1, 247127303, 39250, 2, '2023-01-18 09:29:37', 'Complete'),
(7, 1, 2024379839, 6550, 1, '2023-01-18 08:15:32', 'pending'),
(9, 1, 839164056, 38050, 3, '2023-01-18 09:01:02', 'pending'),
(11, 4, 996021087, 2760, 1, '2023-01-18 13:54:20', 'Complete'),
(13, 6, 1961204614, 54300, 2, '2023-01-18 16:59:30', 'Complete'),
(14, 6, 2093370306, 11550, 2, '2023-01-18 16:09:25', 'Complete'),
(15, 6, 696082099, 23650, 2, '2023-01-18 18:13:23', 'Complete'),
(16, 1, 1887148643, 9850, 2, '2023-01-19 03:48:47', 'pending'),
(17, 1, 1795070199, 11050, 2, '2023-01-19 04:46:30', 'pending'),
(18, 10, 415240828, 17800, 1, '2023-01-19 05:18:46', 'Complete'),
(19, 10, 1550709000, 77800, 2, '2023-01-19 05:53:54', 'Complete'),
(20, 9, 1320098526, 49080, 2, '2023-01-19 06:13:33', 'Complete'),
(21, 1, 1633981614, 45000, 1, '2023-01-20 04:32:36', 'Complete');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `order_id`, `invoice_number`, `amount`, `payment_mode`, `date`) VALUES
(1, 19, 1550709000, 77800, 'Card payment', '2023-01-19 05:53:54'),
(2, 20, 1320098526, 49080, 'Cash on delivery', '2023-01-19 06:13:33'),
(3, 21, 1633981614, 45000, 'Cash on delivery', '2023-01-20 04:32:36');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(10) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` varchar(100) NOT NULL,
  `product_category` varchar(100) NOT NULL,
  `product_details` varchar(255) NOT NULL,
  `product_keywords` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `product_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_price`, `product_category`, `product_details`, `product_keywords`, `product_image`, `date`, `product_status`) VALUES
(1, 'ABSOLUT CITRON VODKA – LEMON', '15000', 'liquor', 'Made from 100% natural taste and no added sugar, is the best selling flavored vodka from the Absolut range.', 'absolut citron vodka - lemon, lemon,vodka,absolut citron,citron', 'v1.webp', '2023-01-19 01:21:31', 'true'),
(2, 'ABSOLUT KURANT', '17800', 'liquor', 'Blackcurrant flavoured vodka made from berries in the country house backyards and the Swedish wilderness.', 'vodka,absolut kurant,blackcurrant', 'v2.webp', '2023-01-10 07:37:00', 'true'),
(3, 'ANGEL BEACH VODKA', '7600', 'liquor', 'Triple filtered with charcoal to achieve its distinct smoothness, the Angel Vodka is brewed locally', 'vodka,angel beack vodka,charcoal', 'v3.webp', '2023-01-10 07:37:10', 'true'),
(4, 'HAVANA CLUB RUM, 3 YEAR OLD', '13600.00', 'liquor', 'First made in 1934, The Havana Club is crafted in the isle of rum – Cuba.', 'rum,havana club rum,liquor', 'r1.webp', '2023-01-10 07:37:29', 'true'),
(5, 'BACARDI CARTA BLANCA RUM – LOCAL', '4500.00', 'liquor', 'A classic white rum with distinctive vanilla and almond notes developed in white oak barrels and shaped through a secret blend of charcoal for a distinctive smoothness.', 'rum,barcardi carta blanca,liquor', 'r2.webp', '2023-01-10 07:37:39', 'true'),
(6, 'BLACK BY BACARDI', '4000.00', 'liquor', 'The Black by Bacardi is a classic dark rum blended with aged rum to ensure a smooth taste coupled with a bold flavour.', 'rum,black by bacardi,liquor', 'r3.webp', '2023-01-10 07:37:47', 'true'),
(7, 'BEEFEATER 24 LONDON DRY GIN', '25650.00', 'liquor', 'The Beefeater 24 gets its name as 12 exotic botanicals are steeped for 24 hours in London, the gin capital of the world.', 'gin,beefeater 24 london dry gin,liquor', 'g1.webp', '2023-01-10 07:38:26', 'true'),
(9, 'HAYMAN’S LONDON DRY GIN', '19850.00', 'liquor', 'The Hayman’s London Dry Gin is made using 150 year old family recipes. This gin has a two day manufacturing process.', 'haymans london dry gin,gin,liquor', 'g3.webp', '2023-01-10 07:40:14', 'true'),
(10, '4TH STREET SWEET RED', '4900.00', 'wine', 'The 4th Street Sweet Red is a refreshingly delicious and fruity red wine with a deep ruby hue. The wine is filled with aromas of blackcurrant.', 'wine,sweet red', '4th-Street-Sweet-Red-300x352.jpg.webp', '2023-01-10 07:43:51', 'true'),
(11, 'BLUE NUN CABERNET SAUVIGNON', '5850.00', 'wine', 'Created in 1951, Blue Nun combines European winemaking technology with German efficiency. The Blue Nun Cabernet Sauvignon is a full bodies smooth red wine', 'wine,blue nun cabernet', 'Blue-Nun-Cabernet-Sauvignon-300x352.jpg (1).webp', '2023-01-10 07:44:47', 'true'),
(12, 'CAMPO VIEJO RIOJA TEMPRANILLO', '6550.00', 'wine', 'The Campo Viejo Rioja Tempranillo is made exclusively with Tempranillo grapes and a passionate winemaking philosophy.', 'wine,campo viejo rioja', 'Campo-Viejo-Rioja-Tempranillo-300x352.jpg.webp', '2023-01-10 07:45:40', 'true'),
(13, 'CARLSBERG PILSNER', '2760.00', 'beer', 'The international flavours of global brewers Carlsberg, is produced at the Lion Brewery under license, adding further dimensions to the portfolio of products on offer, is available in 4.8%.', 'beer,carlsberg pilsner', 'Carlsberg-Pilsner-500ml-300x352.jpg.webp', '2023-01-10 07:47:16', 'true'),
(14, 'HEINEKEN', '1560.00', 'beer', 'From its origins as a 19th-century local beer, brewed in Amsterdam, Heineken has transformed over the years into a global icon that is sold in more than 192 countries', 'beer,heineken', 'Heineken-Lager-330ml-Bottle-01-01-300x352.jpg.webp', '2023-01-10 07:48:06', 'true'),
(16, 'VODKA', '560', 'wine', 'vODKA IS GOOD', 'Vodka, good', 'Campo-Viejo-Rioja-Tempranillo-300x352.jpg.webp', '2023-01-19 06:16:37', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ip_address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `fname`, `lname`, `email`, `contact`, `address`, `password`, `ip_address`) VALUES
(1, 'Gimhani', 'Fernando', 'gimhanif44@gmail.com', '0764378939', 'Gampaha', '$2y$10$pbUPKkNwK6oTNva1lSrWAezGsRvMZX3DGEI8mM8N9foSVSRfOC3y.', '::1'),
(2, 'Hashani', 'Fernando', 'hashfer@gmail.com', '0724523807', 'Piliyandala, Colombo', '$2y$10$8jsjDOclh19al2EiMu5mhuByQBdCNX8irh4TlI0PWbRbG4Tn2R842', '::1'),
(3, 'Gim', 'Fernando', 'gimci@gmail.com', '1231', 'ghjg', '$2y$10$VjWbzVlT1E5iiX8idJL3CeFHtr8THplbxFrKsLuX.0.iHNx.KsRUS', '::1'),
(8, 'nadee', 'Alison', 'nadee@gmail.com', '25725', 'ygyughj', '$2y$10$aBubMnor3ZnnyotSYS3X8.tY27J2r/iks047FCPf3J0B.WP874FiW', '::1'),
(9, 'Lathika', 'Arosha', 'lathikaarosha123@gmail.com', '0711130842', '330/1, Town Road, Homagama', '$2y$10$ftCMFCZXidO9eDqMJQc1geecLT3xaKdaL/mX.AOcyWT.pasHEedti', '::1'),
(10, 'Kavindu', 'Maduranga', 'kavindu@gmail.com', '0754683890', 'Walasmulla', '$2y$10$3/iRFOuPxH5qZ6bxV/D7Ue8aqnUYvE7Aah9szcp4zqaZI0xIDhnli', '::1'),
(11, 'wathsala ', 'yahampath', 'wathsala@gmail.com', '23321321', 'xfgh', '$2y$10$NsEDocSVOj7thFueSxwnBOVVbe6QeuCcTJ1D0xe2LanaTspsguhOe', '::1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
