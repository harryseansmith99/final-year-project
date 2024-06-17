<?php 

include "connectionSettings.php";

// similar to edit products, need to use GET to retrieve the id from the server
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['deleteUserId'])) {
        $productID = (int)$_GET['deleteUserId'];
        $sql = $conn->prepare("CALL proc_deleteUserById(?)");
        $sql->bind_param("i", $userID);
        $sql->execute();
        if (!$sql->execute()) {
            echo "Execute failed: (" . $sql->errno . ") " . $sql->error; // Debugging statement
            $errorMessage = "Query is not valid: " . $conn->error;
        } 
        else {
            // product has been deleted, redirect back to users.php
            header("location: users.php");
        }
    }
}
