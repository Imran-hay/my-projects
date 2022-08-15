-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2022 at 11:09 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hes1`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `username` varchar(25) NOT NULL,
  `fname` varchar(15) NOT NULL,
  `lname` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `flag` smallint(3) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `wallet` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`username`, `fname`, `lname`, `email`, `phone`, `pass`, `flag`, `active`, `wallet`) VALUES
('admin@hes.com', 'Baharu', 'Solomon', 'baharu@gmail.com', '0911223344', '$2y$10$UCF44awHF5ZuWCrLmagIo.PV9gA9lc8ISt2HTyRe776uZSLJRsLh.', 3, 1, 0),
('con@hes.com', 'Lela', 'Sentayewe', 'lakewsentayewe@gmail.com', '0987654321', '$2y$10$UK5DKKF1a0KHs2PWFmUKSecdSNJ5rjj9mpoN3BwkwJA80estn96Bu', 2, 1, 25290),
('first@hes.com', 'first', 'last', 'first@gamil.com', '0987654321', '$2y$10$N28hIkv7MN02.V23mSIajO.NoBQpIAwZcC6awWFUTqqIMFB4Jjwh.', 2, 1, 0),
('foodplanet@hes.com', '', '', 'haileyabsera3@gmail.com', '0987654321', '$2y$10$40TRE3NbgMZcZtd7N4e4LuGczetvuOOgWNIDOuaAmUbfWZC/QXQ/S', 1, 1, 5080),
('haileyabsera@hes.com', 'Yabsera', 'Haile', 'haileyabsera3@gmail.com', '0985928080', '$2y$10$Ew.bZJZDTUOOZvOIFJjJ/ehv4.JXVfgOjzuAeu8LHMohBOCyIKPYm', 2, 1, 2000),
('kk@hes.com', '', '', 'kk@gmail.com', '0912234456', '$2y$10$lMlLnaMVY67SVJBBU8EuoudXVtKGqt0oDXicUdLiYwJdertfXjmHK', 1, 0, 0),
('lemma@hes.com', 'Lemma ', 'Tela', 'lemma@gmail.com', '0987654321', '$2y$10$BBqJFSNAjcb4uUR.JVsajuTA2xEXMGaLzzm7Po6xV9dURtrOr4QCe', 4, 1, 0),
('ven@hes.com', 'Mahalet', 'Lemma', 'mahaletlemma@gmail.com', '0987654321', '$2y$10$.krCklr3d2p83DJA7aOpaO64eDxDE9OvnlfvwI5EMPOscPSxgUIUK', 1, 1, 0),
('y233y@hes.com', '', '', 'test2@gmail.com', '1234567890', '$2y$10$aIW8kn9QL8XGMFrLtanjhO4WeJlhBdjv6346HsPrk0Z0Pcs1Pe/hi', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` int(11) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `amount` double NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deposits`
--

INSERT INTO `deposits` (`id`, `sender`, `username`, `amount`, `total`) VALUES
(1, 'admin@hes.com', 'haileyabsera@hes.com', 2000, 2000),
(3, 'con@hes.com', 'foodplanet@hes.com', 530, 530),
(4, 'con@hes.com', 'foodplanet@hes.com', 530, 1060),
(5, 'con@hes.com', 'foodplanet@hes.com', 710, 1770),
(6, 'con@hes.com', 'foodplanet@hes.com', 530, 2300),
(7, 'con@hes.com', 'foodplanet@hes.com', 650, 2950),
(8, 'con@hes.com', 'foodplanet@hes.com', 710, 3660),
(9, 'con@hes.com', 'foodplanet@hes.com', 710, 4370),
(10, 'con@hes.com', 'foodplanet@hes.com', 710, 5080);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(300) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `link`, `username`) VALUES
(7, 'home', 'https://www.google.com/maps/search/?api=1&query=8.9513621,38.7224386', 'con@hes.com'),
(8, 'work', 'https://goo.gl/maps/6ZcoMu6c7fBMrooSA', 'con@hes.com');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(150) NOT NULL,
  `food` varchar(50) NOT NULL,
  `photo` tinytext DEFAULT NULL,
  `price` float DEFAULT NULL,
  `ingredients` varchar(255) DEFAULT NULL,
  `catagory` tinytext NOT NULL,
  `rname` varchar(100) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `food`, `photo`, `price`, `ingredients`, `catagory`, `rname`, `active`) VALUES
(1, 'apple pie', 'applepie.jpg', 120, 'Egg, Milk, Sugar ', 'lun ntrad nfast', 'Food Planet', 1),
(2, 'Baked beans', 'baked beans.jpg', 210, ' Egg, Milk, Sugar', 'din fast ntrad', 'Food Planet', 1),
(3, 'Banana-Bread', 'banana-bread.jfif', 30, ' Egg, Milk, Sugar', 'break fast ntrad', 'Food Planet', 1),
(4, 'barbecue ribs', 'barbeque ribs.jpg', 310, ' Egg, Milk, Sugar', 'lun ntrad nfast', 'Food Planet', 1),
(5, 'Beef burger', 'beefb.jfif', 200, 'Egg, Milk, Sugar', 'lun ntrad nfast', 'Food Planet', 1),
(6, 'beef jerky', 'beef jerky.jpg', 270, 'Egg, Milk, Sugar ', 'lun ntrad nfast', 'Food Planet', 1),
(7, 'beef with frechfries', 'bwf.jpg', 250, 'Egg, Milk, Sugar ', 'lun ntrad nfast', 'Food Planet', 1),
(8, 'california roll', 'california roll.jpg', 240, 'Egg, Milk, Sugar ', 'lun ntrad nfast', 'Food Planet', 1),
(9, 'cheese burger', 'cheeseb.jfif', 200, 'Egg, Milk, Sugar ', 'lun ntrad nfast', 'Food Planet', 1),
(10, 'Cheese cake', 'cheesecake.jpg', 160, 'Egg, Milk, Sugar ', 'din nfast ntrad', 'Food Planet', 1),
(11, 'chicken burger', 'chickenb.jfif', 250, 'Egg, Milk, Sugar ', 'lun ntrad nfast', 'Food Planet', 1),
(12, 'chicken dinner', 'chicken dinner.jpg', 250, 'Egg, Milk, Sugar ', 'din nfast trad', 'Food Planet', 1),
(13, 'chicken potpie', 'chicken pot pie.jpg', 240, 'Egg, Milk, Sugar ', 'din nfast ntrad', 'Food Planet', 1),
(14, 'chicken wings', 'chicken wings.jpg', 240, 'Egg, Milk, Sugar ', 'lun ntrad nfast', 'Food Planet', 1),
(15, 'Corn bread', 'cornbread.jpg', 140, 'Egg, Milk, Sugar ', 'din fast ntrad', 'Food Planet', 1),
(16, 'deep dish pizza', 'deep pizza.jpg', 270, ' Egg, Milk, Sugar', 'din nfast ntrad', 'Food Planet', 1),
(17, 'Egg Bendict', 'egg bendict.jpg', 80, 'Egg, Milk, Sugar ', 'break ', 'Food Planet', 1),
(18, 'Fajitas', 'fajitas.jpg', 230, 'Egg, Milk, Sugar ', 'din nfast ntrad', 'Food Planet', 1),
(19, 'french toast', 'frencht.jfif', 60, 'Egg, Milk, Sugar ', 'break ', 'Food Planet', 1),
(20, 'fritatta ', 'fritatta.jpg', 76, 'Egg, Milk, Sugar ', 'break ', 'Food Planet', 1),
(21, 'grilled cheese sandwich', 'grilled cheese.jpg', 220, 'Egg, Milk, Sugar ', 'din nfast ntrad', 'Food Planet', 1),
(22, 'Ham and cheese quiche', 'ham and chess.jpg', 70, 'Egg, Milk, Sugar ', 'break ', 'Food Planet', 1),
(23, 'Macaroni and cheese', 'macroni and cheese.jpg', 200, 'Egg, Milk, Sugar ', 'din nfast ntrad', 'Food Planet', 1),
(24, 'Mashed potatos', 'mashed potatos.jpg', 300, 'Egg, Milk, Sugar ', 'din fast ntrad', 'Food Planet', 1),
(25, 'meat loaf', 'meatloaf.jpg', 190, 'Egg, Milk, Sugar ', 'din nfast trad', 'Food Planet', 1),
(26, 'Monkey bread', 'monkey bread.jpg', 90, 'Egg, Milk, Sugar ', 'break ', 'Food Planet', 1),
(27, 'muffin', 'muffin.jfif', 50, 'Egg, Milk, Sugar ', 'break ', 'Food Planet', 1),
(28, 'Oatmeal', 'oatmeal.jfif', 90, 'Egg, Milk, Sugar ', 'break ', 'Food Planet', 1),
(29, 'omelette', 'omelet.jpg', 50, 'Egg, Milk, Sugar ', 'break ', 'Food Planet', 1),
(30, 'pancakes', 'pancake.jfif', 60, 'Egg, Milk, Sugar ', 'break ', 'Food Planet', 1),
(31, 'Pancakes and Maple Syrup', 'pankake with maple.jpg', 120, 'Egg, Milk, Sugar ', 'break ', 'Food Planet', 1),
(32, 'pilly cheese steak', 'pilly cheesestake.jpg', 220, 'Egg, Milk, Sugar ', 'lun ntrad nfast', 'Food Planet', 1),
(33, 'pot roast', 'pot roast.jpg', 350, 'Egg, Milk, Sugar ', 'din nfast ntrad', 'Food Planet', 1),
(34, 'ruben sandwich', 'buben sandwich.jpg', 300, 'Egg, Milk, Sugar ', 'lun ntrad fast', 'Food Planet', 1),
(35, 'sandwich', 'sandwich.jfif', 30, 'Egg, Milk, Sugar ', 'break ', 'Food Planet', 1),
(36, 'scrambled-eggs', 'scrambled-eggs.jpg', 30, 'Egg, Milk, Sugar ', 'break ', 'Food Planet', 1),
(37, 'Spagetti pie cassrole', 'spagett pie.jpg', 230, 'Egg, Milk, Sugar ', 'din nfast ntrad', 'Food Planet', 1),
(38, 'Tator tots', 'tater tots.jpg', 230, 'Egg, Milk, Sugar ', 'din nfast ntrad', 'Food Planet', 1),
(39, 'the blt', 'the blt.jpg', 320, 'Egg, Milk, Sugar ', 'lun ntrad nfast', 'Food Planet', 1),
(40, 'Tuna pizza', 'tunap.jfif', 200, 'Egg, Milk, Sugar ', 'lun ntrad nfast', 'Food Planet', 1),
(41, 'veg pizza', 'vegp.jfif', 230, 'Egg, Milk, Sugar ', 'lun ntrad fast', 'Food Planet', 1),
(42, 'Vegan yogurt with blueberries', 'vegan yogurt.jpg', 30, 'Egg, Milk, Sugar ', 'break ', 'Food Planet', 1),
(43, 'waffle with strwaberries', 'waffle with straw.jpg', 140, 'Egg, Milk, Sugar ', 'break ', 'Food Planet', 1),
(44, 'waffles', 'waffles.jfif', 90, 'Egg, Milk, Sugar ', 'lun ntrad nfast', 'Food Planet', 1),
(45, 'Wild salmon', 'wild salmon.jpg', 330, 'Egg, Milk, Sugar ', 'din nfast ntrad', 'Food Planet', 1),
(46, 'Pepsi', 'download (1).jpg', 30, 'Sugar, water', ' drink ', 'Food Planet', 1),
(47, 'Sprite', 'sprite.jpg', 30, 'Sugar, water', ' drink ', 'Food Planet', 1),
(48, 'Fried Fish', '1547589315824.jpeg', 180, 'Fish, Oil, Salt', 'fast lun trad', 'Food Planet', 1),
(49, 'Boiled Fish', 'boiled fish.jpg', 150, 'Fish, Soya Saouce', 'fast din trad', 'Food Planet', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `info` varchar(1000) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `cust_username` varchar(25) DEFAULT NULL,
  `location` varchar(300) DEFAULT NULL,
  `food` varchar(250) DEFAULT NULL,
  `amount` varchar(250) DEFAULT NULL,
  `resturant` varchar(50) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `total` float DEFAULT NULL,
  `date` date DEFAULT NULL,
  `visible` int(11) DEFAULT NULL,
  `delivery` int(11) NOT NULL DEFAULT 0,
  `deliverer` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `cust_username`, `location`, `food`, `amount`, `resturant`, `state`, `total`, `date`, `visible`, `delivery`, `deliverer`) VALUES
(1, 'con@hes.com', 'https://www.google.com/maps/search/?api=1&query=8.9513639,38.722444\r\n', '4,3,', '2,1,', 'Food Planet', 2, 675, '2022-06-05', 0, 0, ''),
(2, 'con@hes.com', 'https://www.google.com/maps/search/?api=1&query=8.9513639,38.722444', '16,19,22,', '1,2,2,', 'Food Planet', 7, 555, '2022-06-05', 0, 1, 'lemma@hes.com'),
(3, 'con@hes.com', 'https://www.google.com/maps/search/?api=1&query=8.9513639,38.722444', '4,3,', '2,1,', 'Food Planet', 7, 675, '2022-07-05', 0, 1, 'lemma@hes.com'),
(4, 'con@hes.com', 'https://goo.gl/maps/6ZcoMu6c7fBMrooSA', '16,19,22,', '1,2,2,', 'Food Planet', 7, 555, '2022-07-04', 0, 1, 'lemma@hes.com'),
(5, 'con@hes.com', 'https://goo.gl/maps/6ZcoMu6c7fBMrooSA', '3,4,2,1,', '1,1,1,1,', 'Food Planet', 4, 695, '2022-06-06', 0, 0, NULL),
(9, 'con@hes.com', 'https://www.google.com/maps/search/?api=1&query=8.9513639,38.722444', '1,3,4,7,', '1,1,1,1,', 'Food Planet', 7, 735, '2022-06-07', 0, 1, 'lemma@hes.com');

-- --------------------------------------------------------

--
-- Table structure for table `resturant`
--

CREATE TABLE `resturant` (
  `Rname` varchar(50) NOT NULL,
  `location` varchar(300) DEFAULT NULL,
  `about` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `state` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resturant`
--

INSERT INTO `resturant` (`Rname`, `location`, `about`, `logo`, `username`, `state`) VALUES
('Food Planet', 'https://www.google.com/maps/search/?api=1&query=8.945664,38.7514368', 'Food Planet  specializes in delicious food featuring fresh ingredients and masterful preparation by the Food Planet\\\'s culinary team. ', 'cooking-and-restaurant-logo-design-vector-29707307.jpg', 'foodplanet@hes.com', 1),
('Khaldis', 'some adress', 'Informaiton about the test restaurant', 'logo.bmp', 'kk@hes.com', 1),
('rootllk', 'fgh', 'hjk', 'logo.jpg', 'y233y@hes.com', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_wallets` (`username`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `saved locations` (`username`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `menu` (`rname`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications` (`username`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resturant`
--
ALTER TABLE `resturant`
  ADD PRIMARY KEY (`Rname`),
  ADD KEY `test` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `deposits`
--
ALTER TABLE `deposits`
  ADD CONSTRAINT `users_wallets` FOREIGN KEY (`username`) REFERENCES `customer` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `saved locations` FOREIGN KEY (`username`) REFERENCES `customer` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu` FOREIGN KEY (`rname`) REFERENCES `resturant` (`Rname`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications` FOREIGN KEY (`username`) REFERENCES `customer` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `resturant`
--
ALTER TABLE `resturant`
  ADD CONSTRAINT `test` FOREIGN KEY (`username`) REFERENCES `customer` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
