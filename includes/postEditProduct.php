<?php

include "includes/connectionSettings.php";

// init empty variables as place holders

$productID = "";
$categorySelect = "";
$newProductName = "";
$newProductDescription = "";
$newSerialNumber = "";
$storageLocationToAdd = "";
$possibleMinimumQuantity = "";
$possibleMaximumQuantity = "";


$errorMessage = "";
$successMessageProduct = "";

// get the id of the product when you click the edit product button
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    // if the product does not exist, redirect to products page 
    if (!isset($_GET["productID"])) {
        header("location: products.php");
        exit;
    }
    $productID = $_GET["productID"];
    $sql = $conn->prepare("CALL proc_findProductById(?)");
    $sql->bind_param("i", $productID);

    $categorySelect = $row["categoryName"];
    $newProductName = $row["productName"];
    $newProductDescription = $row["productDescription"];
    $newSerialNumber = $row["productSerialNumber"];
    $storageLocationToAdd = $row["storageLocation"];
    $possibleMinimumQuantity = $row["minimumStockLevel"];
    $possibleMaximumQuantity = $row["maximumStockLevel"];
}

else {
    // this means the POST method was used, so we are updating with inputs from form

    $productID = $_POST["productID"];
    $categorySelect = $_POST["categorySelect"];
    $newProductName = $_POST["newProductName"];
    $newProductDescription = $_POST["newProductDescription"];
    $newSerialNumber = $_POST["newSerialNumber"];
    $storageLocationToAdd = $_POST["storageLocationToAdd"];
    $possibleMinimumQuantity = (int)$_POST["possibleMinimumQuantity"];
    $possibleMaximumQuantity = (int)$_POST["possibleMaximumQuantity"];

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
            //"i,s,s,s,s,s,i,i", // order of data types
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
            $successMessageProduct = "successfully added product";
        }

        // exit back to products page on success
        header("location: products.php");

    }
    while(false);
    
}
