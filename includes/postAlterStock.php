<?php


include "includes/connectionSettings.php";

// Enable error reporting for debugging
ini_set('display_errors', 1); // Display errors on the page (development only)
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Ensure errors are logged to a file
ini_set('log_errors', 1);
ini_set('error_log', '/var/tmp/php-error.log'); // Adjust this path

// Init empty variables as place holders
$productSelect = "";
$amount = "";
$incOrDec = "";

$errorMessage = "";
$successMessageProduct = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    error_log("Form submitted: " . print_r($_POST, true)); // Log POST data

    $productSelect = $_POST["productSelect"];
    $amount = (int)$_POST["amount"];
    $incOrDec = $_POST["incOrDec"];

    // Log variables
    error_log("Category Select: $categorySelect");
    error_log("New Category Name: $newCategoryName");

    // do while false allows this to break out after finished
    do {
        if (empty($productSelect) ||
            empty($amount)        ||
            empty($incOrDec)) {

            $errorMessage = "All Fields Are Required";
            error_log($errorMessage); // Log error
            echo $errorMessage;
            break;
        }

        error_log("Preparing SQL statement");

        $sql = $conn->prepare("CALL proc_alterProductStockLevel(?, ?, ?)");
        if (!$sql) {
            $errorMessage = "Prepare failed: (" . $conn->errno . ") " . $conn->error;
            error_log($errorMessage); // Log error
            echo $errorMessage;
            break;
        }

        $sql->bind_param("ssi", $productSelect, $amount, $incOrDec);

        error_log("Executing SQL statement");
        if (!$sql->execute()) {
            $errorMessage = "Execute failed: (" . $sql->errno . ") " . $sql->error;
            error_log($errorMessage); // Log error
            echo $errorMessage;
            break;
        } else {
            $successMessageProduct = "Successfully Edited Category";
            error_log($successMessageProduct); // Log success message
            exit;
        }


    } while (false);
}

?>
