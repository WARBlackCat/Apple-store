-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2021 at 10:02 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `AdminName` varchar(255) NOT NULL,
  `AdminPassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `AdminName`, `AdminPassword`) VALUES
(1, 'Admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `ID` int(11) NOT NULL,
  `Rate` int(5) NOT NULL,
  `Opinion` text NOT NULL,
  `CDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `ID` int(11) NOT NULL,
  `Sender` varchar(100) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Msg` text NOT NULL,
  `CDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Image` varchar(254) CHARACTER SET latin1 NOT NULL,
  `Price` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ID`, `Name`, `Image`, `Price`) VALUES
(1, 'iPhone 7 Black 128 GB', '7b128.jpg', 130000),
(2, 'iPhone 7 Jet Black 128 GB', '7jb128.jpg', 130000),
(3, 'iPhone 7 White 32 GB', '7w32.jpg', 115000),
(4, 'iPhone 7 Silver 32 GB', '7s32.jpeg', 115000),
(5, 'iPhone 8 Silver 256 GB', '8s64.jpg', 160000),
(6, 'iPhone 8 Silver 128 GB', '8s64.jpg', 150000),
(7, 'iPhone 8 Space Gray 64 GB', '8sg64.jpg', 140000),
(8, 'iPhone 8 Gold 64 GB', '8g64.jpg', 140000),
(9, 'iPhone SE 2 Red 256 GB', 'se2r256.jpg', 165000),
(10, 'iPhone SE 2 Black 128 GB', 'se2b128.jpg', 160000),
(11, 'iPhone SE 2 White 128 GB', 'se2w128.jpg', 160000),
(12, 'iPhone SE 2 White 64 GB', 'se2w128.jpg', 150000),
(13, 'iPhone XS Gold 256 GB', 'xsg256.jpg', 250000),
(14, 'iPhone XS Gold 128 GB', 'xsg256.jpg', 220000),
(15, 'iPhone XS Space Gray 128 GB', 'xgsg128.jpg', 220000),
(16, 'iPhone XS Space Gray 64 GB', 'xgsg128.jpg', 200000),
(17, 'iPhone XR Red 128 GB', 'xrr128.jpg', 220000),
(18, 'iPhone XR Blue 128 GB', 'xrb128.jpg', 220000),
(19, 'iPhone XR Blue 64 GB', 'xrb128.jpg', 200000),
(20, 'iPhone XR Black 64 GB', 'xrb64.jpg', 200000),
(21, 'iPhone 11 Midnight Green 256 GB', '11mg256.jpg', 300000),
(22, 'iPhone 11 Space Gray 256 GB', '11sg256.jpg', 300000),
(23, 'iPhone 11 Midnight Green 128 GB', '11mg256.jpg', 270000),
(24, 'iPhone 11 Space Gray 128 GB ', '11sg256.jpg', 270000),
(26, 'iPad Air Silver 256 GB', 'airs256.jpg', 220000),
(27, 'iPad Air Space Gray 64 GB', 'airsg64.jpg', 200000),
(28, 'iPad Pro Space Gray 256 GB', 'prosg256.jpg', 270000),
(29, 'iPad Pro Space Gray 64 GB', 'prosg256.jpg', 250000),
(30, 'iPad Mini Space Gray 64 GB', 'minisg64.jpg', 190000),
(31, 'iPad Mini Silver 64 GB', 'minis64.jpg', 190000);

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `ID` int(11) NOT NULL,
  `Buyer` varchar(255) NOT NULL,
  `Product` text NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `Country` varchar(100) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `Zip` int(10) NOT NULL,
  `Payment` varchar(255) NOT NULL,
  `Baddress` varchar(255) NOT NULL,
  `Bcity` varchar(255) NOT NULL,
  `Bzip` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `UserPassword` varchar(50) NOT NULL,
  `UserEmail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
