<?php

include "includes/connectionSettings.php";

// init empty variables as place holders
$categorySelect = "";
$newProductName = "";
$newProductDescription = "";
$newSerialNumber = "";
$storageLocationToAdd = "";
$receivedQuantity = "";
$possibleMinumumQuantity = "";
$possibleMaximumQuantity = "";


$errorMessage = "";
$successMessageProduct = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $categorySelect = $_POST["categorySelect"];
    $newProductName = $_POST["newProductName"];
    $newProductDescription = $_POST["newProductDescription"];
    $newSerialNumber = $_POST["newSerialNumber"];
    $storageLocationToAdd = $_POST["storageLocationToAdd"];
    $receivedQuantityInt = $_POST["receivedQuantity"];
    $possibleMinumumQuantityInt = $_POST["possibleMinumumQuantity"];
    $possibleMaximumQuantityInt = $_POST["possibleMaximumQuantity"];

    // do while false allows this to break out after finished
    do {
        if (
        empty($categorySelect)        ||
        empty($newProductName)        || 
        empty($newProductDescription) ||
        empty($newSerialNumber)       || 
        empty($storageLocationToAdd)  ||
        empty($receivedQuantityInt)) {
            $errorMessage = "All fields except minimum and maximum storage are required";
            break;
        }

        if (empty($possibleMinumumQuantityInt)) {
            $possibleMinumumQuantityInt = "0";
        }

        if (empty($possibleMaximumQuantityInt)) {
            $possibleMaximumQuantityInt = "0";
        }


        // prepare and bind
        $sql = $conn->prepare("CALL proc_addNewProduct(?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param(
            "sssssiii", // order of data types
            $categorySelect, 
            $newProductName, 
            $newProductDescription, 
            $newSerialNumber, 
            $storageLocationToAdd, 
            $receivedQuantityInt, 
            $possibleMinumumQuantity, 
            $possibleMaximumQuantity
        );

        if (! $sql->execute()) {
            $errorMessage = "Query is not valid: " . $conn->error;
            break;
        }
        else {
            $successMessageProduct = "successfully added product";
        }

    } while(false);
} 

?>
