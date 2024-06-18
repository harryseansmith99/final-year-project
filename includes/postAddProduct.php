<?php

include "includes/connectionSettings.php";

// init empty variables as place holders

$categorySelect = "";
$newProductName = "";
$newProductDescription = "";
$newSerialNumber = "";
$storageLocationToAdd = "";
$receivedQuantity = "";
$possibleMinimumQuantity = "";
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
    $possibleMinimumQuantity = (int)$_POST["possibleMinimumQuantity"];
    $possibleMaximumQuantity = (int)$_POST["possibleMaximumQuantity"];

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

        // if these 2 fields are empty when form is submitted, they are null
        if (!isset($possibleMinimumQuantity)) {
            $possibleMinumumQuantity = null;
        }

        if (!isset($possibleMaximumQuantity)) {
            $possibleMaximumQuantity = null;
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
            $possibleMinimumQuantity, 
            $possibleMaximumQuantity
        );

        if (! $sql->execute()) {
            $errorMessage = "Query is not valid: " . $conn->error;
            break;
        }
        else {
            $successMessageProduct = "Successfully Added Product";

            // reset fields
            $categorySelect = "";
            $newProductName = "";
            $newProductDescription = "";
            $newSerialNumber = "";
            $storageLocationToAdd = "";
            $receivedQuantity = "";
            $possibleMinimumQuantity = "";
            $possibleMaximumQuantity = "";
        }

    } while(false);
} 

?>
