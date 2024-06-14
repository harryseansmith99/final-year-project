<?php 

include "includes/connectionSettings.php";

// similar to edit products, need to use GET to retrieve the id from the server
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['deleteProductId'])) {
        $productID = (int)$_GET['deleteProductId'];
        $sql = $conn->prepare("CALL proc_deleteProductById(?)");
        $sql->bind_param("i", $productID);
        $sql->execute();
        if (!$sql->execute()) {
            echo "Execute failed: (" . $sql->errno . ") " . $sql->error; // Debugging statement
            $errorMessage = "Query is not valid: " . $conn->error;
        } 
        else {
            // product has been deleted, redirect back to products.php
            header("location: products.php");
        }
    }
}
