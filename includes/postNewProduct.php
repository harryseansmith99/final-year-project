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

// print_r($_POST);


// // vars that need to be casted to int from above, as post creates a string
// $possibleMinumumQuantityInt = 0;
// $possibleMinumumQuantityInt = 0;
// $possibleMaximumQuantityInt = 0;



$errorMessage = "";
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $categorySelect = $_POST["categorySelect"];
    $newProductName = $_POST["newProductName"];
    $newProductDescription = $_POST["newProductDescription"];
    $newSerialNumber = $_POST["newSerialNumber"];
    $storageLocationToAdd = $_POST["storageLocationToAdd"];
    $receivedQuantityInt = $_POST["receivedQuantity"];
    $possibleMinumumQuantityInt = $_POST["possibleMinumumQuantity"];
    $possibleMaximumQuantityInt = $_POST["possibleMaximumQuantity"];

    // cast these to ints, might not be needed
    // $receivedQuantityInt = (int)$_POST[$receivedQuantity];
    // $possibleMinumumQuantityInt = (int)$_POST[$possibleMinumumQuantity];
    // $possibleMaximumQuantityInt = (int)$_POST[$possibleMaximumQuantity];

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

    } while(false);
} 

?>
