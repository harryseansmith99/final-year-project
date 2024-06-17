<?php

include "includes/connectionSettings.php";

// init empty variables as place holders

$newfirstName = "";
$newLastName = "";
$newEmail = "";
$newPassword = "";
$confirmNewPassword = "";
$userSec = "";


$errorMessage = "";
$successMessageProduct = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newfirstName = $_POST["newFirstName"];
    $newLastName = $_POST["newLastName"];
    $newEmail = $_POST["newEmail"];
    $newPassword = $_POST["newPassword"];
    $confirmNewPassword = $_POST["confirmNewPassword"];
    $userSec = (int)$_POST["userSec"];

    // do while false allows this to break out after finished
    do {
        if (
        empty($newfirstName)        ||
        empty($newLastName)        || 
        empty($newEmail) ||
        empty($newPassword)       || 
        empty($confirmNewPassword)  ||
        empty($userSec)) {
            $errorMessage = "All fields are required";
            break;
        }

        if ($newPassword != $confirmNewPassword) {
            $errorMessage = "Password fields do not match";
            break;
        }

        // prepare and bind
        $sql = $conn->prepare("CALL proc_addNewUser(?, ?, ?, ?, ?)");
        $sql->bind_param(
            "ssssi", // order of data types
            $newfirstName,
            $newLasName,
            $newEmail,
            $newPassword,
            $userSec
        );

        if (! $sql->execute()) {
            $errorMessage = "Query is not valid: " . $conn->error;
            break;
        }
        else {
            $successMessageProduct = "Successfully Added New User";
            header("location: users.php");
        }

    } while(false);
} 

?>
