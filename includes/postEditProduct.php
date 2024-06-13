<?php

include "includes/connectionSettings.php";

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

$productID = $_GET["productID"]; // Retrieve productID from GET request

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $categorySelect = $_POST["categorySelect"];
    $newProductName = $_POST["newProductName"];
    $newProductDescription = $_POST["newProductDescription"];
    $newSerialNumber = $_POST["newSerialNumber"];
    $storageLocationToAdd = $_POST["storageLocationToAdd"];
    $possibleMinimumQuantity = (int)$_POST["possibleMinimumQuantity"];
    $possibleMaximumQuantity = (int)$_POST["possibleMaximumQuantity"];

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
            $errorMessage = "Query is not valid: " . $conn->error;
            break;
        } else {
            $successMessageProduct = "Successfully Edited Product";
            // Redirect after successful update
            header("location: products.php");
            exit;
        }

    } while(false);
}

if (!empty($errorMessage)) {
    echo "<div class='alert alert-danger'>$errorMessage</div>";
}
