


-- this script creates all tables and then loads it with dummy data,
-- for demonstration purposes only



DROP DATABASE IF EXISTS inventory_management_db;
CREATE DATABASE IF NOT EXISTS inventory_management_db COLLATE utf8_unicode_ci;

USE inventory_management_db;


--  Create tables


DROP TABLE IF EXISTS CategoryTable;
CREATE TABLE CategoryTable (
    categoryID INT NOT NULL AUTO_INCREMENT,
    categoryName VARCHAR(255) NULL,
    PRIMARY KEY (categoryID)
);

DROP TABLE IF EXISTS ProductTable;
CREATE TABLE ProductTable (
    productID INT NOT NULL AUTO_INCREMENT,
    categoryID_fk INT NOT NULL,
    productName VARCHAR(255) NOT NULL,
    productDescription VARCHAR(1000) NOT NULL,
    productSerialNumber VARCHAR(255) NOT NULL,
    CONSTRAINT pk_ProductTable PRIMARY KEY (productID, productName),
    FOREIGN KEY (categoryID_fk) REFERENCES CategoryTable(categoryID) ON DELETE CASCADE
);

DROP TABLE IF EXISTS StockTable;
CREATE TABLE StockTable (
    stockID INT NOT NULL AUTO_INCREMENT,
    productID_fk INT NOT NULL,
    storageLocation TEXT,
    quantity INT NOT NULL,
    minimumStockLevel INT,
    maximumStockLevel INT,
    PRIMARY KEY (stockID),
    FOREIGN KEY (productID_fk) REFERENCES ProductTable(productID) ON DELETE CASCADE
);

DROP TABLE IF EXISTS UserTable;
CREATE TABLE UserTable (
    userID INT NOT NULL AUTO_INCREMENT,
    firstName VARCHAR(255) NOT NULL,
    lastName VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    userPassword VARCHAR(255) NOT NULL,
    secLevel INT NOT NULL,
    CONSTRAINT pk_UserTable PRIMARY KEY (userID, email)
);


-- load data

INSERT INTO CategoryTable (categoryName)
VALUES ("category 1"),
("category 2"),
("category 3"),
("category 4"),
("category 5"),
("category 6"),
("category 7"),
("category 8"),
("category 9"),
("category 10");


INSERT INTO ProductTable (categoryID_fk, productName, productDescription, productSerialNumber)
VALUES (1, "product 1", "This is the 1st product", "RxupSXR2"),
(2, "product 2", "This is the 2nd product", "pjnKhihp"),
(3, "product 3", "This is the 3rd product", "LeWWRfoH"),
(4, "product 4", "This is the 4th product", "sW8dc2RX"),
(5, "product 5", "This is the 5th product", "sNYY2CFf"),
(6, "product 6", "This is the 6th product", "V5vEsmR4"),
(7, "product 7", "This is the 7th product", "WriTfWYp"),
(8, "product 8", "This is the 8th product", "Huggkx7i"),
(9, "product 9", "This is the 9th product", "rvUGB5Uh"),
(10, "product 10", "This is the 10th product", "3Z8JAPDM");



INSERT INTO StockTable (productID_fk, storageLocation, quantity, minimumStockLevel, maximumStockLevel)
VALUES (1, "Location A", 50,  NULL, NULL),
(2, "Location b", 23, 10, 100),
(3, "Location c", 11, NULL, NULL),
(4, "Location d", 40, 10, NULL),
(5, "Location e", 30, 5, 30),
(6, "Location f", 20, 20, 100),
(7, "Location g", 10, 15, 30),
(8, "Location h", 75, NULL, NULL),
(9, "Location i", 60, NULL, NULL),
(10, "Location j", 20, 10, 20);


INSERT INTO UserTable (firstName, lastName, email, userPassword, secLevel)
VALUES ("Bob", "Lazar", "bob@gmail.com", "adminPassword123", 1),
("Caesar", "Milan", "caeser@gmail.com", "standardPassword123", 2);