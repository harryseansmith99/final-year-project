<?php

include "includes/connectionSettings.php";

// init empty variables as place holders

$categorySelect = "";
$newCategoryName = "";

$errorMessage = "";
$successMessageProduct = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $categorySelect = $_POST["categorySelect"];
    $newCategoryName = $_POST["newCategoryName"];

    // do while false allows this to break out after finished
    do {
        if (empty($newCategoryName)) {
            $errorMessage = "Category Name Field Required";
            break;
        }

        // prepare and bind
        $sql = $conn->prepare("CALL proc_editCategoryByName(?,?)");
        $sql->bind_param("s,s", $categorySelect, $newCategoryName);

        if (! $sql->execute()) {
            $errorMessage = "Query is not valid: " . $conn->error;
            break;
        }
        else {
            $successMessageProduct = "Successfully Added New Category";
            header("location: products.php");
        }

    } while(false);
} 

?>
