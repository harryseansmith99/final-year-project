-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 11, 2024 at 03:59 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: inventory_management_db
--

-- --------------------------------------------------------

--
-- Table structure for table CategoryTable
--

CREATE TABLE CategoryTable (
  categoryID int(11) NOT NULL,
  categoryName varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table CategoryTable
--

INSERT INTO CategoryTable (categoryID, categoryName) VALUES
(1, 'category 1 name'),
(2, 'category 2 name'),
(3, 'category 3 name'),
(4, 'category 4 name'),
(5, 'category 5 name'),
(6, 'category 6 name'),
(7, 'category 7 name'),
(8, 'category 8 name'),
(9, 'category 9 name'),
(10, 'category 10 name');

-- --------------------------------------------------------

--
-- Table structure for table ProductTable
--

CREATE TABLE ProductTable (
  productID int(11) NOT NULL,
  categoryID_fk int(11) NOT NULL,
  productName varchar(255) NOT NULL,
  productDescription varchar(1000) NOT NULL,
  productSerialNumber varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table ProductTable
--

INSERT INTO ProductTable (productID, categoryID_fk, productName, productDescription, productSerialNumber) VALUES
(100, 1, 'product 1', 'This is the 1st product', 'RxupSXR2'),
(101, 2, 'product 2', 'This is the 2nd product', 'pjnKhihp'),
(102, 3, 'product 3', 'This is the 3rd product', 'LeWWRfoH'),
(103, 4, 'product 4', 'This is the 4th product', 'sW8dc2RX'),
(104, 5, 'product 5', 'This is the 5th product', 'sNYY2CFf'),
(105, 6, 'product 6', 'This is the 6th product', 'V5vEsmR4'),
(106, 7, 'product 7', 'This is the 7th product', 'WriTfWYp'),
(107, 8, 'product 8', 'This is the 8th product', 'Huggkx7i'),
(108, 9, 'product 9', 'This is the 9th product', 'rvUGB5Uh'),
(109, 10, 'product 10', 'This is the 10th product', '3Z8JAPDM');

-- --------------------------------------------------------

--
-- Table structure for table StockTable
--

CREATE TABLE StockTable (
  stockID int(11) NOT NULL,
  productID_fk int(11) NOT NULL,
  storageLocation TEXT NULL,
  quantity int(11) NOT NULL,
  minimumStockLevel int(11) DEFAULT NULL,
  maximumStockLevel int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table StockTable
--

INSERT INTO StockTable (stockID, productID_fk, storageLocation, quantity, minimumStockLevel, maximumStockLevel) VALUES
(1, 100, "LOCATION 1", 1, 50, NULL, NULL),
(2, 101, "LOCATION 2", 2, 23, 10, 100),
(3, 102, "LOCATION 3", 3, 11, NULL, NULL),
(4, 103, "LOCATION 4", 4, 40, 10, NULL),
(5, 104, "LOCATION 5", 5, 30, 5, 30),
(6, 105, "LOCATION 6", 6, 20, 20, 100),
(7, 106, "LOCATION 7", 7, 10, 15, 30),
(8, 107, "LOCATION 8", 8, 75, NULL, NULL),
(9, 108, "LOCATION 9", 9, 60, NULL, NULL),
(10, 109, "LOCATION 10", 10, 20, 10, 20);

-- --------------------------------------------------------

--
-- Table structure for table UserTable
--

CREATE TABLE UserTable (
  userID int(11) NOT NULL,
  firstName varchar(255) NOT NULL,
  lastName varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  userPassword varchar(255) NOT NULL,
  secLevel int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table UserTable
--

INSERT INTO UserTable (userID, firstName, lastName, email, userPassword, secLevel) VALUES
(1000, 'Bob', 'Lazar', 'bob@gmail.com', 'adminPassword123', 1),
(1001, 'Caesar', 'Milan', 'caeser@gmail.com', 'standardPassword123', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table CategoryTable
--
ALTER TABLE CategoryTable
  ADD PRIMARY KEY (categoryID);

--
-- Indexes for table LocationTable
--
ALTER TABLE LocationTable
  ADD PRIMARY KEY (locationID);

--
-- Indexes for table ProductTable
--
ALTER TABLE ProductTable
  ADD PRIMARY KEY (productID),
  ADD KEY categoryID_fk (categoryID_fk);

--
-- Indexes for table StockTable
--
ALTER TABLE StockTable
  ADD PRIMARY KEY (stockID),
  ADD KEY productID_fk (productID_fk),
  ADD KEY locationID_fk (locationID_fk);

--
-- Indexes for table UserTable
--
ALTER TABLE UserTable
  ADD PRIMARY KEY (userID);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table CategoryTable
--
ALTER TABLE CategoryTable
  MODIFY categoryID int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table LocationTable
--
ALTER TABLE LocationTable
  MODIFY locationID int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table ProductTable
--
ALTER TABLE ProductTable
  MODIFY productID int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table StockTable
--
ALTER TABLE StockTable
  MODIFY stockID int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table UserTable
--
ALTER TABLE UserTable
  MODIFY userID int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1002;

--
-- Constraints for dumped tables
--

--
-- Constraints for table ProductTable
--
ALTER TABLE ProductTable
  ADD CONSTRAINT ProductTable_ibfk_1 FOREIGN KEY (categoryID_fk) REFERENCES CategoryTable (categoryID);

--
-- Constraints for table StockTable
--
ALTER TABLE StockTable
  ADD CONSTRAINT StockTable_ibfk_1 FOREIGN KEY (productID_fk) REFERENCES ProductTable (productID),
  ADD CONSTRAINT StockTable_ibfk_2 FOREIGN KEY (locationID_fk) REFERENCES LocationTable (locationID);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
