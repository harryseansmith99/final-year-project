<?php

include "includes/connectionSettings.php";

// Enable error reporting for debugging
ini_set('display_errors', 1); // Display errors on the page (development only)
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Ensure errors are logged to a file
ini_set('log_errors', 1);
ini_set('error_log', '/var/tmp/php-error.log'); // Adjust this path

// Init empty variables as placeholders
$newFirstName = "";
$newLastName = "";
$newEmail = "";
$newPassword = "";
$confirmNewPassword = "";
$userSec = "";

$errorMessage = "";
$successMessageProduct = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newFirstName = $_POST["newFirstName"];
    $newLastName = $_POST["newLastName"];
    $newEmail = $_POST["newEmail"];
    $newPassword = $_POST["newPassword"];
    $confirmNewPassword = $_POST["confirmNewPassword"];
    $userSec = (int)$_POST["userSec"];

    // Log posted data
    error_log("Form data: " . print_r($_POST, true));

    // Do while false allows this to break out after finished
    do {
        if (
            empty($newFirstName)        ||
            empty($newLastName)        || 
            empty($newEmail) ||
            empty($newPassword)       || 
            empty($confirmNewPassword)  ||
            empty($userSec)) {
            $errorMessage = "All fields are required";
            error_log($errorMessage); // Log error
            break;
        }

        if ($newPassword != $confirmNewPassword) {
            $errorMessage = "Password fields do not match";
            error_log($errorMessage); // Log error
            break;
        }

        // hash password, currently uses bcrypt in PASSWORD_DEFAULT
        $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Prepare and bind
        $sql = $conn->prepare("CALL proc_addNewUser(?, ?, ?, ?, ?)");
        if (!$sql) {
            $errorMessage = "Prepare failed: (" . $conn->errno . ") " . $conn->error;
            error_log($errorMessage); // Log error
            break;
        }

        $sql->bind_param(
            "ssssi", // order of data types
            $newFirstName,
            $newLastName,
            $newEmail,
            $hashedNewPassword,
            $userSec
        );

        if (!$sql->execute()) {
            $errorMessage = "Execute failed: (" . $sql->errno . ") " . $sql->error;
            error_log($errorMessage); // Log error
            break;
        } 
        else {
            // standard user is level 1, admin is 2
            $status = ($userSec == 1) ? "Standard" : "Admin";
            $successMessageProduct = "Successfully Added New " . $status ." User: " . $newEmail;

            // clear the variables so another new user can be added
            $newFirstName = "";
            $newLastName = "";
            $newEmail = "";
            $newPassword = "";
            $confirmNewPassword = "";
            $userSec = "";
        }

    } while (false);
}

if (!empty($errorMessage)) {
    echo "<div class='alert alert-danger'>$errorMessage</div>";
}

?>
