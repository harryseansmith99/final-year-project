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
        JOIN StockTable ON StockTable.productID_fk = ProductTable.productID
    ORDER BY ProductTable.productID ASC;
END $$
DELIMITER ;



DELIMITER $$
CREATE OR REPLACE PROCEDURE proc_findProductById(
    IN productIdSearch INT)
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
        JOIN StockTable ON StockTable.productID_fk = ProductTable.productID
    WHERE ProductTable.productID = productIdSearch;
END $$
DELIMITER ;



DELIMITER $$
CREATE OR REPLACE PROCEDURE proc_addNewProduct(
    IN categoryNameSearch VARCHAR(255),
    IN newProductName VARCHAR(255),
    IN newProdDescription VARCHAR(1000),
    IN newProductSerialNumber VARCHAR(255),
    IN storageLocationToAdd TEXT,
    IN receivedQuantity INT,
    IN possibleMinStockLevel INT,
    IN possibleMaxStockLevel INT)
BEGIN
    SET @categoryIdSearch = (SELECT CategoryTable.categoryID FROM CategoryTable WHERE categoryName = categoryNameSearch); 
    INSERT INTO ProductTable (categoryID_fk, productName, productDescription, productSerialNumber)
        VALUES (@categoryIdSearch, newProductName, newProdDescription, newProductSerialNumber);
    
    SET @productIdSearch = LAST_INSERT_ID();
    INSERT INTO StockTable (productID_fk, storageLocation, quantity, minimumStockLevel, maximumStockLevel)
        VALUES (@productIdSearch, storageLocationToAdd, receivedQuantity, possibleMinStockLevel, possibleMaxStockLevel);
END $$
DELIMITER ;



DELIMITER $$
CREATE OR REPLACE PROCEDURE proc_deleteProductById(
    IN productIdSearch INT)
BEGIN
    DELETE FROM ProductTable WHERE ProductTable.productID = productIdSearch;
END $$
DELIMITER ;



DELIMITER $$
CREATE OR REPLACE PROCEDURE proc_editProductDetails(
    IN productIdtoFind INT,
    IN categoryNameSearch VARCHAR(255),
    IN newProductName VARCHAR(255),
    IN newProductDescr VARCHAR(1000),
    IN newProductSerial VARCHAR(255),
    IN newLocation TEXT,
    IN newMinStockLevel INT,
    IN newMaxStockLevel INT)
BEGIN
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
END $$
DELIMITER ;



DELIMITER $$
CREATE OR REPLACE PROCEDURE proc_getAllCategories() 
BEGIN
    SELECT * FROM CategoryTable
    ORDER BY CategoryTable.categoryID ASC;
END $$
DELIMITER ;



DELIMITER $$
CREATE OR REPLACE PROCEDURE proc_addNewCategory(
    IN newCategoryName VARCHAR(255)) 
BEGIN
    INSERT INTO CategoryTable (categoryName) VALUES (newCategoryName);
END $$
DELIMITER ;



DELIMITER $$
CREATE OR REPLACE PROCEDURE proc_editCategoryByName(
    IN categoryNameSearch VARCHAR (255),
    IN newCategoryName VARCHAR(255)
) 
BEGIN
    UPDATE CategoryTable SET CategoryTable.categoryName = newCategoryName
    WHERE CategoryTable.categoryName = categoryNameSearch;
END $$
DELIMITER ;




DELIMITER $$
CREATE OR REPLACE PROCEDURE proc_deleteCategoryByName(
    IN categoryNameSearch VARCHAR(255)) 
BEGIN
    DELETE FROM CategoryTable WHERE CategoryTable.categoryName = categoryNameSearch;
END $$
DELIMITER ;



DELIMITER $$
CREATE OR REPLACE PROCEDURE proc_editProductStockQuantity(
    IN productNameSearch VARCHAR(255),
    IN amount INT
)
BEGIN
    SET @productIdSearch = (SELECT ProductTable.productID FROM ProductTable WHERE productName = productNameSearch);
    UPDATE StockTable SET StockTable.quantity = StockTable.quantity + amount
    WHERE StockTable.productID_fk = @productIdSearch;
END $$ 
DELIMITER ;



DELIMITER $$
CREATE OR REPLACE PROCEDURE proc_incStockForProduct(
    IN productNameSearch VARCHAR(255),
    IN amount INT
)
BEGIN
    SET @productIdSearch = (SELECT ProductTable.productID FROM ProductTable WHERE productName = productNameSearch);
    UPDATE StockTable SET StockTable.quantity = StockTable.quantity + amount
    WHERE StockTable.productID_fk = @productIdSearch;
END $$
DELIMITER ;



DELIMITER $$
CREATE OR REPLACE PROCEDURE proc_decStockForProduct(
    IN productNameSearch VARCHAR(255),
    IN amount INT
)
BEGIN
    SET @productIdSearch = (SELECT ProductTable.productID FROM ProductTable WHERE productName = productNameSearch);
    UPDATE StockTable SET StockTable.quantity = StockTable.quantity - amount
    WHERE StockTable.productID_fk = @productIdSearch;
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
CREATE OR REPLACE PROCEDURE proc_getUserByID(
    IN userIdSearch INT)
BEGIN
    SELECT * FROM UserTable
    WHERE UserTable.userID = userIdSearch;
END $$
DELIMITER ;



DELIMITER $$
CREATE OR REPLACE PROCEDURE proc_getUserByEmail(
    IN userEmailSearch VARCHAR(255))
BEGIN
    SELECT * FROM UserTable
    WHERE UserTable.email = userEmailSearch;
END $$
DELIMITER ;



DELIMITER $$
CREATE OR REPLACE PROCEDURE proc_getUserPassword(
    IN userPasswordSearch VARCHAR(255))
BEGIN
    SELECT * FROM UserTable
    WHERE UserTable.userPassword = userPasswordSearch;
END $$
