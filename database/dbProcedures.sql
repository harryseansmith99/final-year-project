USE inventory_management_db;

DELIMITER $$
CREATE OR REPLACE PROCEDURE proc_getAllProducts()
BEGIN
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
        JOIN StockTable ON StockTable.productID_fk = ProductTable.productID;
END $$
DELIMITER ;

DELIMITER $$

CREATE OR REPLACE PROCEDURE proc_editProductDetails(
    IN productIdtoFind INT,
    IN newProductName VARCHAR(255),
    IN newProductDescr VARCHAR(1000),
    IN newProductSerial VARCHAR(255),
    IN newMinStockLevel INT,
    IN newMaxStockLevel INT
)
BEGIN
    UPDATE ProductTable SET ProductTable.productName = newProductName,
    ProductTable.productDescription = newProductDescr,
    ProductTable.productSerialNumber = newProductSerial
    WHERE ProductTable.productID = productIdtoFind;
    UPDATE StockTable SET StockTable.minimumStockLevel = newMinStockLevel,
    StockTable.maximumStockLevel = newMaxStockLevel
    WHERE StockTable.productID_fk = productIdToFind;
END $$
DELIMITER ;



DELIMITER $$


CREATE OR REPLACE PROCEDURE proc_getAllCategories() 
BEGIN
    SELECT * FROM CategoryTable;
END $$
DELIMITER ;

DELIMITER $$

CREATE OR REPLACE PROCEDURE proc_getAllUsers()
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

CREATE OR REPLACE PROCEDURE proc_getAllAdmins()
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

CREATE OR REPLACE PROCEDURE proc_getAllStandardStaff()
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

CREATE OR REPLACE PROCEDURE proc_getUserByID(IN userIdSearch INT)
BEGIN
    SELECT * FROM UserTable
    WHERE UserTable.userID = userIdSearch;
END $$
DELIMITER ;

DELIMITER $$

CREATE OR REPLACE PROCEDURE proc_getUserByEmail(IN userEmailSearch VARCHAR(255))
BEGIN
    SELECT * FROM UserTable
    WHERE UserTable.email = userEmailSearch;
END $$
DELIMITER ;

DELIMITER $$

CREATE OR REPLACE PROCEDURE proc_getUserPassword(IN userPasswordSearch VARCHAR(255))
BEGIN
    SELECT * FROM UserTable
    WHERE UserTable.userPassword = userPasswordSearch;
END $$
