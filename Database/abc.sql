-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2024 at 05:20 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `abc`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(5) NOT NULL,
  `UserName` char(45) DEFAULT NULL,
  `MobileNumber` bigint(11) DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `ShopOwnerName` varchar(255) DEFAULT NULL,
  `ShopName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `UserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`, `UpdationDate`, `ShopOwnerName`, `ShopName`) VALUES
(2, '21012021038', 1234567890, 'heetkakdiya567@gmail.com', 'd9e538ee7c130465e73f04227083e862', '2024-04-27 08:19:50', '2024-05-07 10:21:28', ' Heet', 'HKD'),
(3, 'harsh42774', 9512642701, 'harshribadiya123@gmail.com', '7f70759e04f8364a025b4de5628500b5', '2024-05-07 05:01:01', '2024-05-07 05:11:18', ' harsh', 'hR');

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `CategoryName` varchar(200) DEFAULT NULL,
  `CategoryCode` varchar(255) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `userID`, `CategoryName`, `CategoryCode`, `PostingDate`) VALUES
(3, 2, 'snacks', 'S', '2024-04-27 14:19:28'),
(4, 2, 'wafer', 'W', '2024-04-30 16:37:41'),
(5, 2, 'Milk Products', 'MP', '2024-05-08 04:24:57'),
(7, 2, '', '', '2024-05-08 04:34:03');

-- --------------------------------------------------------

--
-- Table structure for table `tblcompany`
--

CREATE TABLE `tblcompany` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `CompanyName` varchar(150) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcompany`
--

INSERT INTO `tblcompany` (`id`, `userID`, `CompanyName`, `PostingDate`) VALUES
(4, 2, 'balaji', '2024-04-27 14:20:14'),
(5, 2, 'gopal', '2024-04-27 14:20:19'),
(6, 2, 'lays', '2024-04-27 14:20:24'),
(7, 2, 'balagi', '2024-04-30 16:37:54'),
(9, 2, 'Farm Fresh Dairy', '2024-05-08 04:24:58'),
(10, 2, '', '2024-05-08 04:24:58');

-- --------------------------------------------------------

--
-- Table structure for table `tblorders`
--

CREATE TABLE `tblorders` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `ProductId` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `InvoiceNumber` int(11) DEFAULT NULL,
  `CustomerName` varchar(150) DEFAULT NULL,
  `CustomerContactNo` bigint(12) DEFAULT NULL,
  `PaymentMode` varchar(100) DEFAULT NULL,
  `InvoiceGenDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblorders`
--

INSERT INTO `tblorders` (`id`, `userID`, `ProductId`, `Quantity`, `InvoiceNumber`, `CustomerName`, `CustomerContactNo`, `PaymentMode`, `InvoiceGenDate`) VALUES
(11, 2, 6, 5, 827673784, 'heet', 1237896540, 'card', '2024-04-27 14:27:00'),
(12, 2, 5, 15, 827673784, 'heet', 1237896540, 'card', '2024-04-27 14:27:00'),
(13, 2, 6, 50, 788605278, 'heet', 7410852963, 'cash', '2024-04-30 13:01:41'),
(14, 2, 7, 100, 196295077, 'Jonny', 7532149680, 'cash', '2024-04-30 16:39:47'),
(15, 2, 6, 45, 207690675, 'alex', 1234567890, 'card', '2024-05-06 16:25:32'),
(16, 2, 5, 15, 104361843, 'heet', 1234567789, 'cash', '2024-05-07 06:16:37'),
(17, 2, 7, 102, 104361843, 'heet', 1234567789, 'cash', '2024-05-07 06:16:37'),
(18, 2, 7, 1, 894675542, 'falgun', 7895123640, 'cash', '2024-05-08 04:52:24'),
(19, 2, 5, 1, 894675542, 'falgun', 7895123640, 'cash', '2024-05-08 04:52:24'),
(20, 2, 8, 51, 621114142, 'ROSE', 7419638520, 'cash', '2024-05-08 15:17:28');

-- --------------------------------------------------------

--
-- Table structure for table `tblproducts`
--

CREATE TABLE `tblproducts` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `CategoryName` varchar(150) DEFAULT NULL,
  `SubCategoryName` varchar(255) DEFAULT NULL,
  `CompanyName` varchar(150) DEFAULT NULL,
  `ProductName` varchar(150) DEFAULT NULL,
  `ProductPrice` decimal(10,0) DEFAULT current_timestamp(),
  `ExpiryDate` datetime DEFAULT NULL,
  `Stock` int(11) DEFAULT NULL,
  `ImagePath` varchar(255) DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblproducts`
--

INSERT INTO `tblproducts` (`id`, `userID`, `CategoryName`, `SubCategoryName`, `CompanyName`, `ProductName`, `ProductPrice`, `ExpiryDate`, `Stock`, `ImagePath`, `PostingDate`, `UpdationDate`) VALUES
(5, 2, 'biscuit', 'biscuit', 'britania', '20-20', 10, NULL, 469, 'img/2 (1) (1).png', '2024-05-08 04:52:24', '2024-05-08 04:52:24'),
(6, 2, 'wafers', 'wafers', 'balaji', 'mori wafer', 50, NULL, 0, 'img/Mahadev .jpg', '2024-05-06 16:39:52', '2024-05-06 16:39:52'),
(7, 2, 'salted wafer', 'salted wafer', 'balaji', 'salted wafer', 10, '2024-05-08 00:00:00', 397, 'img/WhatsApp Image 2024-04-29 at 22.07.05_e82cc852.jpg', '2024-05-08 04:52:24', '2024-05-08 04:52:24'),
(8, 2, 'wafer', 'tomato wafer', 'BALAJI', 'TOMATO WAFER', 20, '0000-00-00 00:00:00', 49, 'C:UsersHeetDownloadsimage_16.jpeg', '2024-05-08 15:17:28', '2024-05-08 15:17:28');

-- --------------------------------------------------------

--
-- Table structure for table `tblsubcategory`
--

CREATE TABLE `tblsubcategory` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `category_code` varchar(255) DEFAULT NULL,
  `sub_category_code` varchar(255) DEFAULT NULL,
  `sub_category_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblsubcategory`
--

INSERT INTO `tblsubcategory` (`id`, `userID`, `category_code`, `sub_category_code`, `sub_category_name`) VALUES
(5, 2, 'S', 'Sb', 'biscuit'),
(6, 2, 'S', 'Sw', 'wafers'),
(7, 2, 'W', 'SW', 'salted wafer'),
(8, 2, 'W', 'MW', 'masala masti'),
(9, 2, 'W', 'CP', 'cataka patakha'),
(10, 2, 'MP', 'MPWM', 'Whole Milk'),
(12, 2, 'W', 'TW', 'tomato wafer'),
(13, 2, '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcompany`
--
ALTER TABLE `tblcompany`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblorders`
--
ALTER TABLE `tblorders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblproducts`
--
ALTER TABLE `tblproducts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsubcategory`
--
ALTER TABLE `tblsubcategory`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblcompany`
--
ALTER TABLE `tblcompany`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblorders`
--
ALTER TABLE `tblorders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tblproducts`
--
ALTER TABLE `tblproducts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblsubcategory`
--
ALTER TABLE `tblsubcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
