<?php


include "connectionSettings.php";

// init empty variables as place holders
$categorySelect = "";
$newProductName = "";
$newProductDescription = "";
$newSerialNumber = "";
$storageLocationToAdd = "";
$receivedQuantity = "";
$possibleMinumumQuantity = "";
$possibleMaximumQuantity = "";

// vars that need to be casted to int from above, as post creates a string
$possibleMinumumQuantityInt = 0;
$possibleMinumumQuantityInt = 0;
$possibleMaximumQuantityInt = 0;

$errorMessage = "";
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $categorySelect = $_POST["categorySelect"];
    $newProductName = $_POST["newProductName"];
    $newProductDescription = $_POST["newProductDescription"];
    $newSerialNumber = $_POST["newSerialNumber"];
    $storageLocationToAdd = $_POST["storageLocationToAdd"];

    // cast these form submissions to int for db
    $receivedQuantityInt = (int)$_POST[$receivedQuantity];
    $possibleMinumumQuantityInt = (int)$_POST[$possibleMinumumQuantity];
    $possibleMaximumQuantityInt = (int)$_POST[$possibleMaximumQuantity];

    // do while false allows this to break out after finished
    do {
        if (
        empty($categorySelect) ||
        empty($newProductName) || 
        empty($newProductDescription) ||
        empty($newSerialNumber) || 
        empty($storageLocationToAdd) ||
        empty($receivedQuantityInt) ||
        empty($possibleMinumumQuantityInt) ||
        empty($possibleMaximumQuantityInt)) {
            $errorMessage = "All fields are required";
            break;
        }
    } while(false);
} 

?>