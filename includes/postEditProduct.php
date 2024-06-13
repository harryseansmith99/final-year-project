<?php

include "includes/connectionSettings.php";

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Form submitted<br>"; // Debugging statement
    $productID = $_POST["productID"]; // Retrieve productID from POST data
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
        $sql = $conn->prepare("CALL proc_editProduct(?, ?, ?, ?, ?, ?, ?, ?)");
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
        } else {
            echo "Successfully Edited Product<br>"; // Debugging statement
            $successMessageProduct = "Successfully Edited Product";
            // Redirect after successful update
            header("Location: products.php");
            exit;
        }

    } while(false);
}

if (!empty($errorMessage)) {
    echo "<div class='alert alert-danger'>$errorMessage</div>";
}
?>
