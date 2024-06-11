
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

DROP TABLE IF EXISTS LocationTable;
CREATE TABLE LocationTable (
    locationID INT NOT NULL AUTO_INCREMENT,
    locationName VARCHAR(255) NOT NULL,
    locationAddress VARCHAR(255),
    PRIMARY KEY (locationID)
);

DROP TABLE IF EXISTS ProductTable;
CREATE TABLE ProductTable (
    productID INT NOT NULL AUTO_INCREMENT,
    categoryID_fk VARCHAR(10) NOT NULL,
    productName VARCHAR(255) NOT NULL,
    productDescription VARCHAR(1000) NOT NULL,
    productSerialNumber VARCHAR(255) NOT NULL,
    PRIMARY KEY (productID),
    FOREIGN KEY (categoryID_fk) REFERENCES CategoryTable(categoryID)
) AUTO

DROP TABLE IF EXISTS StockTable;
CREATE TABLE StockTable (
    stockID INT NOT NULL AUTO_INCREMENT,
    productID_fk VARCHAR(10) NOT NULL,
    locationID_fk VARCHAR(10) NOT NULL,
    quantity INT NOT NULL,
    minimumStockLevel INT,
    maximumStockLevel INT,
    PRIMARY KEY (stockID),
    FOREIGN KEY (productID_fk) REFERENCES ProductTable(productID),
    FOREIGN KEY (locationID_fk) REFERENCES LocationTable(locationID)
);

DROP TABLE IF EXISTS UserTable;
CREATE TABLE UserTable (
    userID INT NOT NULL AUTO_INCREMENT,
    firstName VARCHAR(255) NOT NULL,
    lastName VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    userPassword VARCHAR(255) NOT NULL,
    secLevel INT NOT NULL,
    PRIMARY KEY (userID)
);


-- load data

INSERT INTO CategoryTable (categoryID, categoryName)
VALUES ("c1", "category 1 description"),
("c2", "category 2 description"),
("c3", "category 3 description"),
("c4", "category 4 description"),
("c5", "category 5 description"),
("c6", "category 6 description"),
("c7", "category 7 description"),
("c8", "category 8 description"),
("c9", "category 9 description"),
("c10", "category 10 description");


INSERT INTO ProductTable (productID, categoryID_fk, productName, productDescription, productSerialNumber)
VALUES ("100", "c1", "product 1", "This is the 1st product", "RxupSXR2"),
("101", "c2", "product 2", "This is the 2nd product", "pjnKhihp"),
("102", "c3", "product 3", "This is the 3rd product", "LeWWRfoH"),
("103", "c4", "product 4", "This is the 4th product", "sW8dc2RX"),
("104", "c5", "product 5", "This is the 5th product", "sNYY2CFf"),
("105", "c6", "product 6", "This is the 6th product", "V5vEsmR4"),
("106", "c7", "product 7", "This is the 7th product", "WriTfWYp"),
("107", "c8", "product 8", "This is the 8th product", "Huggkx7i"),
("108", "c9", "product 9", "This is the 9th product", "rvUGB5Uh"),
("109", "c10", "product 10", "This is the 10th product", "3Z8JAPDM");


INSERT INTO LocationTable (locationID, locationName, locationAddress)
VALUES ("A", "Location A", "Location A Address"),
("B", "Location B", "Location B Address"),
("C", "Location C", "Location C Address"),
("D", "Location D", "Location D Address"),
("E", "Location E", "Location E Address"),
("F", "Location F", "Location F Address"),
("G", "Location G", "Location G Address"),
("H", "Location H", "Location H Address"),
("I", "Location I", "Location I Address"),
("J", "Location J", "Location J Address");


INSERT INTO StockTable (stockID, productID_fk, locationID_fk, quantity, minimumStockLevel, maximumStockLevel)
VALUES ("s1", "100", "A", 50,  NULL, NULL),
("s2", "101", "B", 23, 10, 100),
("s3", "102", "C", 11, NULL, NULL),
("s4", "103", "D", 40, 10, NULL),
("s5", "104", "E", 30, 5, 30),
("s6", "105", "F", 20, 20, 100),
("s7", "106", "G", 10, 15, 30),
("s8", "107", "H", 75, NULL, NULL),
("s9", "108", "I", 60, NULL, NULL),
("s10", "109", "J", 20, 10, 20);


INSERT INTO UserTable (userID, firstName, lastName, email, userPassword, secLevel)
VALUES ("U1", "Bob", "Lazar", "bob@gmail.com", "adminPassword123", 1),
("U2", "Caesar", "Milan", "caeser@gmail.com", "standardPassword123", 2);