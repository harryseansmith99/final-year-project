<?php

include "includes/connectionSettings.php";

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set("log_errors", TRUE);
ini_set("error_log", "/var/tmp/errors.log");

// init empty variables as placeholders
$categorySelect = "";
$newProductName = "";
$newProductDescription = "";
$newSerialNumber = "";
$storageLocationToAdd = "";
$possibleMinimumQuantity = "";
$possibleMaximumQuantity = "";

$errorMessage = "";
$successMessageProduct = "";

// try to get productID from query string, idk why the hell it isnt working
$productID = isset($_GET['editProductId']) ? (int)$_GET['editProductId'] : 0;

// Fetch product details from the database using the productID
if ($productID > 0) {
    $sql = $conn->prepare("CALL proc_findProductById(?)");
    $sql->bind_param("i", $productID);
    $sql->execute();
    $result = $sql->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        $categorySelect = $row['categoryName'];
        $newProductName = $row['productName'];
        $newProductDescription = $row['productDescription'];
        $newSerialNumber = $row['productSerialNumber'];
        $storageLocationToAdd = $row['storageLocation'];
        $possibleMinimumQuantity = $row['minimumStockLevel'];
        $possibleMaximumQuantity = $row['maximumStockLevel'];
    } 
    else {
        $errorMessage = "Product not found";
        error_log($errorMessage); // Log error
        exit;
    }
} 
else {
    $errorMessage = "Invalid product ID";
    error_log($errorMessage); // Log error
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST["productID"])) {
        $errorMessage = "productID not found";
        error_log($errorMessage); // Log error
        exit;
    }

    $sql = $conn->prepare("CALL proc_findProductById(?)");

    $productID = (int)$_POST["productID"]; // Retrieve productID from POST data
    $categorySelect = $_POST["categorySelect"];
    $newProductName = $_POST["newProductName"];
    $newProductDescription = $_POST["newProductDescription"];
    $newSerialNumber = $_POST["newSerialNumber"];
    $storageLocationToAdd = $_POST["storageLocationToAdd"];
    $possibleMinimumQuantity = (int)$_POST["possibleMinimumQuantity"];
    $possibleMaximumQuantity = (int)$_POST["possibleMaximumQuantity"];

    // Debugging statements to check captured values
    echo "Product ID: $productID<br>";
    echo "Category: $categorySelect<br>";
    echo "Product Name: $newProductName<br>";
    echo "Product Description: $newProductDescription<br>";
    echo "Serial Number: $newSerialNumber<br>";
    echo "Storage Location: $storageLocationToAdd<br>";
    echo "Minimum Quantity: $possibleMinimumQuantity<br>";
    echo "Maximum Quantity: $possibleMaximumQuantity<br>";

    // do while false allows this to break out after finished
    do {
        if (
        empty($categorySelect)        ||
        empty($newProductName)        || 
        empty($newProductDescription) ||
        empty($newSerialNumber)       || 
        empty($storageLocationToAdd)) {
            $errorMessage = "All fields except minimum and maximum storage are required";
            break;
        }

        // if these 2 fields are empty when form is submitted, they are null
        if (!isset($possibleMinimumQuantity)) {
            $possibleMinimumQuantity = null;
        }

        if (!isset($possibleMaximumQuantity)) {
            $possibleMaximumQuantity = null;
        }

        // prepare and bind
        $sql = $conn->prepare("CALL proc_editProductDetails(?, ?, ?, ?, ?, ?, ?, ?)");
        if (!$sql) {
            echo "Prepare failed: (" . $conn->errno . ") " . $conn->error; // Debugging statement
            break;
        }

        $sql->bind_param(
            "isssssii", // order of data types
            $productID, 
            $categorySelect, 
            $newProductName, 
            $newProductDescription, 
            $newSerialNumber,
            $storageLocationToAdd,
            $possibleMinimumQuantity, 
            $possibleMaximumQuantity
        );

        if (!$sql->execute()) {
            echo "Execute failed: (" . $sql->errno . ") " . $sql->error; // Debugging statement
            $errorMessage = "Query is not valid: " . $conn->error;
            break;
        } 
        else {
            echo "Successfully Edited Product<br>"; // Debugging statement
            $successMessageProduct = "Successfully Edited Product";
            // Redirect after successful update
            exit;
        }

    } while(false);
}


?>
