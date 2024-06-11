USE inventory_management_db;

DELIMITER $$

CREATE PROCEDURE IF NOT EXISTS proc_getAllProducts()
BEGIN
    SELECT
        ProductTable.productID,
        CategoryTable.categoryName,
        ProductTable.productName,
        ProductTable.productDescription,
        ProductTable.productSerialNumber,
        StockTable.quantity,
        StockTable.minimumStockLevel,
        StockTable.maximumStockLevel,
        LocationTable.locationName,
        LocationTable.locationAddress
    FROM ProductTable
        JOIN CategoryTable ON ProductTable.categoryID_fk = CategoryTable.categoryID
        JOIN StockTable ON StockTable.productID_fk = ProductTable.productID
        JOIN LocationTable ON StockTable.locationID_fk = LocationTable.locationID;
END $$
DELIMITER ;

DELIMITER $$

CREATE PROCEDURE IF NOT EXISTS proc_getAllCategories() 
BEGIN
    SELECT * FROM CategoryTable;
END $$
DELIMITER ;

DELIMITER $$

CREATE PROCEDURE IF NOT EXISTS proc_getAllUsers()
BEGIN
    SELECT
        UserTable.userID,
        UserTable.firstName,
        UserTable.lastName,
        UserTable.email
    FROM UserTable;
END $$
DELIMITER ;

DELIMITER $$

CREATE PROCEDURE IF NOT EXISTS proc_getAllAdmins()
BEGIN
    SELECT
        UserTable.userID,
        UserTable.firstName,
        UserTable.lastName,
        UserTable.email
    FROM UserTable
    WHERE UserTable.secLevel = 1;
END $$
DELIMITER ;

DELIMITER $$

CREATE PROCEDURE IF NOT EXISTS proc_getAllStandardStaff()
BEGIN
    SELECT
        UserTable.userID,
        UserTable.firstName,
        UserTable.lastName,
        UserTable.email
    FROM UserTable
    WHERE UserTable.secLevel = 2;
END $$
DELIMITER ;

DELIMITER $$

CREATE PROCEDURE IF NOT EXISTS proc_getUserByID(IN userIdSearch INT)
BEGIN
    SELECT * FROM UserTable
    WHERE UserTable.userID = userIdSearch;
END $$
DELIMITER ;

DELIMITER $$

CREATE PROCEDURE IF NOT EXISTS proc_getUserByEmail(IN userEmailSearch VARCHAR(255))
BEGIN
    SELECT * FROM UserTable
    WHERE UserTable.email = userEmailSearch;
END $$
DELIMITER ;

DELIMITER $$

CREATE PROCEDURE IF NOT EXISTS proc_getUserPassword(IN userPasswordSearch VARCHAR(255))
BEGIN
    SELECT * FROM UserTable
    WHERE UserTable.userPassword = userPasswordSearch;
END $$
