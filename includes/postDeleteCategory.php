<?php

// be warned, deleting the category deletes all products associated,
// this is the intended feature so it works as a group delete

include "includes/connectionSettings.php";

// Enable error reporting for debugging
ini_set('display_errors', 1); // Display errors on the page (development only)
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Ensure errors are logged to a file
ini_set('log_errors', 1);
ini_set('error_log', '/var/tmp/php-error.log'); // Adjust this path

// Init empty variables as place holders
$categorySelect = "";

$errorMessage = "";
$successMessageProduct = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    error_log("Form submitted: " . print_r($_POST, true)); // Log POST data

    $categorySelect = $_POST["$categorySelect"];

    // do while false allows this to break out after finished
    do {
        if (empty($deleteCategoryName)) {
            $errorMessage = "Category Name Field Required";
            error_log($errorMessage); // Log error
            echo $errorMessage;
            break;
        }

        // prepare and bind
        $sql = $conn->prepare("CALL proc_deleteCategoryByName(?)");
        $sql->bind_param("s", $categorySelect);

        error_log("Executing SQL statement");
        if (!$sql->execute()) {
            $errorMessage = "Execute failed: (" . $sql->errno . ") " . $sql->error;
            error_log($errorMessage); // Log error
            echo $errorMessage;
            break;
        } else {
            $successMessageProduct = "Successfully Deleted Category";
            error_log($successMessageProduct); // Log success message
            ob_clean(); // Ensure no output before header
            header("Location: products.php");
            exit;
        }

    } while (false);
}

?>
