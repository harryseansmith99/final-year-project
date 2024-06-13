<?php

include "includes/connectionSettings.php";

// init empty variables as place holders

$categorySelect = "";
$newProductName = "";
$newProductDescription = "";
$newSerialNumber = "";
$storageLocationToAdd = "";
$possibleMinimumQuantity = "";
$possibleMaximumQuantity = "";


$errorMessage = "";
$successMessageProduct = "";

$productID = $_GET["editProductId"];

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
            $possibleMinumumQuantity = null;
        }

        if (!isset($possibleMaximumQuantity)) {
            $possibleMaximumQuantity = null;
        }


        // prepare and bind
        $sql = $conn->prepare("CALL proc_editProduct(?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param(
            "i,s,s,s,s,s,i,i", // order of data types
            $productID, 
            $categorySelect, 
            $newProductName, 
            $newProductDescription, 
            $newSerialNumber,
            $storageLocationToAdd,
            $possibleMinimumQuantity, 
            $possibleMaximumQuantity
        );

        if (! $sql->execute()) {
            $errorMessage = "Query is not valid: " . $conn->error;
            break;
        }
        else {
            echo "                                          updated successfully";
            // $successMessageProduct = "successfully added product";
        }
        $conn->close();

    } while(false);
} 

?>
