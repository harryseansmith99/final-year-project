-- create the database in phpmyadmin and import this file

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 20, 2024 at 11:25 PM
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
-- Database: `inventory_management_db`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_addNewCategory` (IN `newCategoryName` VARCHAR(255))   BEGIN
    INSERT INTO CategoryTable (categoryName) VALUES (newCategoryName);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_addNewProduct` (IN `categoryNameSearch` VARCHAR(255), IN `newProductName` VARCHAR(255), IN `newProdDescription` VARCHAR(1000), IN `newProductSerialNumber` VARCHAR(255), IN `storageLocationToAdd` TEXT, IN `receivedQuantity` INT, IN `possibleMinStockLevel` INT, IN `possibleMaxStockLevel` INT)   BEGIN
    SET @categoryIdSearch = (SELECT CategoryTable.categoryID FROM CategoryTable WHERE categoryName = categoryNameSearch); 
    INSERT INTO ProductTable (categoryID_fk, productName, productDescription, productSerialNumber)
        VALUES (@categoryIdSearch, newProductName, newProdDescription, newProductSerialNumber);
    
    SET @productIdSearch = LAST_INSERT_ID();
    INSERT INTO StockTable (productID_fk, storageLocation, quantity, minimumStockLevel, maximumStockLevel)
        VALUES (@productIdSearch, storageLocationToAdd, receivedQuantity, possibleMinStockLevel, possibleMaxStockLevel);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_addNewUser` (IN `userFirstName` VARCHAR(255), IN `userLastName` VARCHAR(255), IN `newEmail` VARCHAR(255), IN `newPassword` VARCHAR(255), IN `securityLevel` INT)   BEGIN
    INSERT INTO UserTable (firstName, lastName, email, userPassword, secLevel)
    VALUES (userFirstName, userLastName, newEmail, newPassword, securityLevel);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_alterProductStockLevel` (IN `productNameSearch` VARCHAR(255), IN `OPTION` VARCHAR(7), IN `amount` INT)   BEGIN
    SET @productIdSearch = (SELECT ProductTable.productID FROM ProductTable WHERE productName = productNameSearch);
    
    IF option = "bookIn" THEN
        UPDATE StockTable SET StockTable.quantity = StockTable.quantity + amount
        WHERE StockTable.productID_fk = @productIdSearch;
    ELSEIF option = "bookOut" THEN
        UPDATE StockTable SET StockTable.quantity = StockTable.quantity - amount
        WHERE StockTable.productID_fk = @productIdSearch;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_changePasswordById` (IN `userIdSearch` INT, IN `newPassword` VARCHAR(255))   BEGIN
    UPDATE UserTable SET
        UserTable.userPassword = newPassword
    WHERE UserTable.userID = userIdSearch;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_deleteCategoryByName` (IN `categoryNameSearch` VARCHAR(255))   BEGIN
    DELETE FROM CategoryTable WHERE CategoryTable.categoryName = categoryNameSearch;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_deleteProductById` (IN `productIdSearch` INT)   BEGIN
    DELETE FROM ProductTable WHERE ProductTable.productID = productIdSearch;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_deleteUserById` (IN `userIdSearch` INT)   BEGIN
    DELETE FROM UserTable WHERE UserTable.userID = userIdSearch;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_editCategoryByName` (IN `categoryNameSearch` VARCHAR(255), IN `newCategoryName` VARCHAR(255))   BEGIN
    UPDATE CategoryTable SET CategoryTable.categoryName = newCategoryName
    WHERE CategoryTable.categoryName = categoryNameSearch;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_editProductDetails` (IN `productIdtoFind` INT, IN `categoryNameSearch` VARCHAR(255), IN `newProductName` VARCHAR(255), IN `newProductDescr` VARCHAR(1000), IN `newProductSerial` VARCHAR(255), IN `newLocation` TEXT, IN `newMinStockLevel` INT, IN `newMaxStockLevel` INT)   BEGIN
    SET @categoryIdSearch = (SELECT CategoryTable.categoryID FROM CategoryTable WHERE categoryName = categoryNameSearch); 
    UPDATE ProductTable SET 
        ProductTable.categoryID_fk = @categoryIdSearch,
        ProductTable.productName = newProductName,
        ProductTable.productDescription = newProductDescr,
        ProductTable.productSerialNumber = newProductSerial
    WHERE 
        ProductTable.productID = productIdtoFind;

    UPDATE StockTable SET 
        StockTable.minimumStockLevel = newMinStockLevel,
        StockTable.maximumStockLevel = newMaxStockLevel,
        StockTable.storageLocation = newLocation
    WHERE 
        StockTable.productID_fk = productIdToFind;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_editUserDetailsById` (IN `userIdSearch` INT, IN `editFirstName` VARCHAR(255), IN `editLastName` VARCHAR(255), IN `editEmail` VARCHAR(255))   BEGIN
    UPDATE UserTable SET
        UserTable.firstName = editFirstName,
        UserTable.lastName = editLastName,
        UserTable.email = editEmail
    WHERE UserTable.userID = userIdSearch;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_findProductById` (IN `productIdSearch` INT)   BEGIN
    SELECT
        ProductTable.productID,
        CategoryTable.categoryName,
        ProductTable.productName,
        ProductTable.productDescription,
        ProductTable.productSerialNumber,
        StockTable.storageLocation,
        StockTable.quantity,
        StockTable.minimumStockLevel,
        StockTable.maximumStockLevel
    FROM ProductTable 
        JOIN CategoryTable ON ProductTable.categoryID_fk = CategoryTable.categoryID
        JOIN StockTable ON StockTable.productID_fk = ProductTable.productID
    WHERE ProductTable.productID = productIdSearch;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getAllAdmins` ()   BEGIN
    SELECT
        UserTable.userID,
        UserTable.firstName,
        UserTable.lastName,
        UserTable.email
    FROM UserTable
    WHERE UserTable.secLevel = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getAllCategories` ()   BEGIN
    SELECT * FROM CategoryTable
    ORDER BY CategoryTable.categoryID ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getAllProducts` ()   BEGIN
    SELECT
        ProductTable.productID,
        CategoryTable.categoryName,
        ProductTable.productName,
        ProductTable.productDescription,
        ProductTable.productSerialNumber,
        StockTable.storageLocation,
        StockTable.quantity,
        StockTable.minimumStockLevel,
        StockTable.maximumStockLevel
    FROM ProductTable
        JOIN CategoryTable ON ProductTable.categoryID_fk = CategoryTable.categoryID
        JOIN StockTable ON StockTable.productID_fk = ProductTable.productID
    ORDER BY ProductTable.productID ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getAllStandardStaff` ()   BEGIN
    SELECT
        UserTable.userID,
        UserTable.firstName,
        UserTable.lastName,
        UserTable.email
    FROM UserTable
    WHERE UserTable.secLevel = 2;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getAllUsers` ()   BEGIN
    SELECT
        UserTable.userID,
        UserTable.firstName,
        UserTable.lastName,
        UserTable.email,
        UserTable.secLevel
    FROM UserTable;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getUserByEmail` (IN `userEmailSearch` VARCHAR(255))   BEGIN
    SELECT * FROM UserTable
    WHERE UserTable.email = userEmailSearch;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getUserByID` (IN `userIdSearch` INT)   BEGIN
    SELECT * FROM UserTable
    WHERE UserTable.userID = userIdSearch;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_getUserPassword` (IN `userPasswordSearch` VARCHAR(255))   BEGIN
    SELECT * FROM UserTable
    WHERE UserTable.userPassword = userPasswordSearch;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `CategoryTable`
--

CREATE TABLE `CategoryTable` (
  `categoryID` int(11) NOT NULL,
  `categoryName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `CategoryTable`
--

INSERT INTO `CategoryTable` (`categoryID`, `categoryName`) VALUES
(1, 'category 1'),
(2, 'category 2'),
(3, 'category 3'),
(4, 'category 4'),
(5, 'category 5'),
(6, 'category 6'),
(7, 'category 7'),
(8, 'category 8'),
(9, 'category 9'),
(10, 'category 10'),
(11, 'category 11');

-- --------------------------------------------------------

--
-- Table structure for table `ProductTable`
--

CREATE TABLE `ProductTable` (
  `productID` int(11) NOT NULL,
  `categoryID_fk` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productDescription` varchar(1000) NOT NULL,
  `productSerialNumber` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ProductTable`
--

INSERT INTO `ProductTable` (`productID`, `categoryID_fk`, `productName`, `productDescription`, `productSerialNumber`) VALUES
(1, 1, 'product 1', 'This is the 1st product', 'RxupSXR2'),
(2, 2, 'product 2', 'This is the 2nd product', 'pjnKhihp'),
(3, 3, 'product 3', 'This is the 3rd product', 'LeWWRfoH'),
(4, 4, 'product 4', 'This is the 4th product', 'sW8dc2RX'),
(5, 5, 'product 5', 'This is the 5th product', 'sNYY2CFf'),
(6, 6, 'product 6', 'This is the 6th product', 'V5vEsmR4'),
(7, 7, 'product 7', 'This is the 7th product', 'WriTfWYp'),
(8, 8, 'product 8', 'This is the 8th product', 'Huggkx7i'),
(9, 9, 'product 9', 'This is the 9th product', 'rvUGB5Uh'),
(10, 10, 'product 10', 'This is the 10th product', '3Z8JAPDM'),
(17, 1, 'test product', 'test product', '1234abc');

-- --------------------------------------------------------

--
-- Table structure for table `StockTable`
--

CREATE TABLE `StockTable` (
  `stockID` int(11) NOT NULL,
  `productID_fk` int(11) NOT NULL,
  `storageLocation` text DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `minimumStockLevel` int(11) DEFAULT NULL,
  `maximumStockLevel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `StockTable`
--

INSERT INTO `StockTable` (`stockID`, `productID_fk`, `storageLocation`, `quantity`, `minimumStockLevel`, `maximumStockLevel`) VALUES
(1, 1, 'Location A', 50, NULL, NULL),
(2, 2, 'Location b', 23, 10, 100),
(3, 3, 'Location c', 11, NULL, NULL),
(4, 4, 'Location d', 40, 10, NULL),
(5, 5, 'Location e', 30, 5, 30),
(6, 6, 'Location f', 20, 20, 100),
(7, 7, 'Location g', 10, 15, 30),
(8, 8, 'Location h', 75, NULL, NULL),
(9, 9, 'Location i', 60, NULL, NULL),
(10, 10, 'Location j', 20, 10, 20),
(17, 17, 'new ', 100, 100, 100);

-- --------------------------------------------------------

--
-- Table structure for table `UserTable`
--

CREATE TABLE `UserTable` (
  `userID` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `userPassword` varchar(255) NOT NULL,
  `secLevel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `UserTable`
--

INSERT INTO `UserTable` (`userID`, `firstName`, `lastName`, `email`, `userPassword`, `secLevel`) VALUES
(5, 'Admin', 'User', 'admin@gmail.com', '$2y$10$t1DxWEfxh1E6OCB1ZDW/O.FguyxIEntWG/lyG5WW9mykKEPGYsltm', 2),
(6, 'Standard', 'User', 'standard@gmail.com', '$2y$10$X.n87th.67WzotJXaGBqu.nKOkLGcQXj7/MWA9GPffg0QrGRyEJCi', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `CategoryTable`
--
ALTER TABLE `CategoryTable`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `ProductTable`
--
ALTER TABLE `ProductTable`
  ADD PRIMARY KEY (`productID`,`productName`),
  ADD KEY `categoryID_fk` (`categoryID_fk`);

--
-- Indexes for table `StockTable`
--
ALTER TABLE `StockTable`
  ADD PRIMARY KEY (`stockID`),
  ADD KEY `productID_fk` (`productID_fk`);

--
-- Indexes for table `UserTable`
--
ALTER TABLE `UserTable`
  ADD PRIMARY KEY (`userID`,`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `CategoryTable`
--
ALTER TABLE `CategoryTable`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ProductTable`
--
ALTER TABLE `ProductTable`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `StockTable`
--
ALTER TABLE `StockTable`
  MODIFY `stockID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `UserTable`
--
ALTER TABLE `UserTable`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ProductTable`
--
ALTER TABLE `ProductTable`
  ADD CONSTRAINT `ProductTable_ibfk_1` FOREIGN KEY (`categoryID_fk`) REFERENCES `CategoryTable` (`categoryID`) ON DELETE CASCADE;

--
-- Constraints for table `StockTable`
--
ALTER TABLE `StockTable`
  ADD CONSTRAINT `StockTable_ibfk_1` FOREIGN KEY (`productID_fk`) REFERENCES `ProductTable` (`productID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
