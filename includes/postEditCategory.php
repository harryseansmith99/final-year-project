<?php

include "includes/connectionSettings.php";

// init empty variables as place holders

$newCategoryName = "";

$errorMessage = "";
$successMessageProduct = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newCategoryName = $_POST["newCategoryName"];

    // do while false allows this to break out after finished
    do {
        if (empty($newCategoryName)) {
            $errorMessage = "Category Name Field Required";
            break;
        }

        // prepare and bind
        $sql = $conn->prepare("CALL proc_addNewCategory(?)");
        $sql->bind_param("s", $newCategoryName);

        if (! $sql->execute()) {
            $errorMessage = "Query is not valid: " . $conn->error;
            break;
        }
        else {
            $successMessageProduct = "Successfully Added New Category";
        }

    } while(false);
} 

?>
