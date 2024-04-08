-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2024 at 04:42 PM
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
-- Database: `dbmobile`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `userID` int(20) NOT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `shipping_address` text DEFAULT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `userID`, `product_id`, `quantity`) VALUES
(43, 8, 17, 1);

-- --------------------------------------------------------

--
-- Table structure for table `experiences`
--

CREATE TABLE `experiences` (
  `eid` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `date_purchased` date DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `rating` int(20) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phones`
--

CREATE TABLE `phones` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `cover_photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `phones`
--

INSERT INTO `phones` (`id`, `brand`, `model`, `price`, `description`, `cover_photo`) VALUES
(15, 'samsung', 'Galaxy S23 Ultra 5G', 180000.00, 'Get a smartphone for yourself that can detect your moods and react appropriately. The Samsung Galaxy Ultra\'s potent processor and advanced camera sensor can handle low light and noise reduction. The phone\'s Snapdragon 8 Gen 2 processor, which also provides a long battery life to carry you through even the busiest days, also enables quick gaming and video streaming. You can also launch Expert RAW to take high-resolution RAW photos that are vivid and packed with information. Moreover, Dynamic AMOLED 2X offers clear, brilliant details in both bright and low-light conditions. Additionally, to smooth up gaming and save power, the refresh rate is automatically optimised with 120 Hz technology.', '../uploads/51noqYKjciL._SX679_ (1).jpg'),
(16, 'Nothing', 'Nothing Phone (2) 5G (Grey, 12GB RAM, 256GB Storage)', 47000.00, '☆【Memory, Storage, SIM & Battery】:- 12 GB RAM | 256 GB Storage (Not Expandable) & Dual SIM (Nano-SIM, dual stand-by) | 4500 mAh Li-Ion Battery, non-removable | (17.42 Wh) - 33W wired | PD3.0, QC4 | 50% in 30 min, 100% in 70 min, 15W wireless, 5W reverse wireless. || 12GB RAM - Smooth multitasking and gaming performance. || Spacious 256GB Storage - Store all your data, apps, and media.\r\n☆【Exceptional Display】:- The Nothing phone (1) boasts a 16.63 cm (6.55) OLED display that reflects over 1 billion colours, allowing you to appreciate every vibrant shade. Furthermore, the HDR10+ technology in this phone allows you to enjoy rich colour and vivid contrasts that are tailored to each scenario. Moreover, this phone\'s dynamic 120 Hz refresh rate provides seductively quick interactions while being encouragingly power-efficient.', '../uploads/Project.jpg'),
(17, 'Apple', 'iPhone 15 Pro Max (256 GB) - Blue Titanium', 148900.00, 'FORGED IN TITANIUM — iPhone 15 Pro Max has a strong and light aerospace-grade titanium design with a textured matte-glass back. It also features a Ceramic Shield front that’s tougher than any smartphone glass. And it’s splash, water, and dust resistant.\r\nADVANCED DISPLAY — The 6.7” Super Retina XDR display with ProMotion ramps up refresh rates to 120Hz when you need exceptional graphics performance. Dynamic Island bubbles up alerts and Live Notifications. Plus, with Always-On display, your Lock Screen stays glanceable, so you don’t have to tap it to stay in the know.', '../uploads/81fxjeu8fdL._SL1500_.jpg'),
(18, 'OnePlus', '12R (Iron Gray, 8GB RAM, 256GB Storage)', 42999.00, 'Fast & Smooth for years: Snapdragon 8 Gen 2 Mobile Platform, Up to 16GB of LPDDR5X RAM with RAM-Vita - Dual Cryo-velocity VC Cooling System, TÜV SÜD 48-Month Fluency Rating A\r\nPristine Display with Aqua Touch: Super-Bright 1.5K LTPO ProXDR Display with Dolby Vision, and a DisplayMate A+ rating, Intellignent Eye Care certified by TÜV Rheinland, 4500 nits Peak Brightness, Aqua Touch helps you stay swiping, even with wet hands\r\nComputational Photography That\'s Incomparable: RAW HDR Algorithm, 50MP Sony IMX890 Camera and Ultra-wide Camera 112° FoV Sony IMX355, Ultra-Clear Image Quality\r\nOur Longest-Lasting Battery Ever: 5500 mAh Battery with 100W SUPERVOOC, Paired with our advanced Battery Health Engine for longevity', '../uploads/Web_Photo_Editor.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbllogin`
--

CREATE TABLE `tbllogin` (
  `loginID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `phn` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbllogin`
--

INSERT INTO `tbllogin` (`loginID`, `username`, `password`, `usertype`, `status`, `phn`) VALUES
(1, 'admin', 'admin123', 'admin', 1, '000000'),
(9, 'aswin@gmail.com', '1234', 'user', 1, '9000000005');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `uName` varchar(255) NOT NULL,
  `uContact` varchar(20) NOT NULL,
  `uEmail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `uName`, `uContact`, `uEmail`) VALUES
(8, 'aswin', '9000000005', 'aswin@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experiences`
--
ALTER TABLE `experiences`
  ADD PRIMARY KEY (`eid`);

--
-- Indexes for table `phones`
--
ALTER TABLE `phones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbllogin`
--
ALTER TABLE `tbllogin`
  ADD PRIMARY KEY (`loginID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `experiences`
--
ALTER TABLE `experiences`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `phones`
--
ALTER TABLE `phones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbllogin`
--
ALTER TABLE `tbllogin`
  MODIFY `loginID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `phones` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
