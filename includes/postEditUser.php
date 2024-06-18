<?php 

include "includes/connectionSettings.php";


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set("log_errors", TRUE);
ini_set("error_log", "/var/tmp/errors.log");

$userID = 0;
$editFirstName = "";
$editLastName = "";
$editEmail = "";
$confirmEditPassword = "";

$errorMessage = "";
$successMessageProduct = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["editUserId"])) {
        $userID = (int)$_GET["editUserId"];
        error_log("Retrieved userID: $userID"); // Log the retrieved userID
        
        if ($userID > 0) {
            $sql = $conn->prepare("CALL proc_getUserByID(?)");
            $sql->bind_param("i", $userID);
            $sql->execute();
            $result = $sql->get_result();
            $user = $result->fetch_assoc();

            if ($user) {
                $editFirstName = $user["firstName"];
                $editLastName = $user["lastName"];
                $editEmail = $user["email"];
                $confirmEditPassword = $user["userPassword"]; // needs to be the same password
            }
            else {
                $errorMessage = "User not found";
                error_log($errorMessage); // Log error
                echo $errorMessage;
                exit;
            }
        }
        else {
            $errorMessage = "Invalid user ID";
            error_log($errorMessage); // Log error
            echo $errorMessage;
            exit;
        }
    }
    else {
        $errorMessage = "editUserId not found in GET request";
        error_log($errorMessage); // Log error
        echo $errorMessage;
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST["userID"])) {
        $errorMessage = "userID not found";
        error_log($errorMessage); // Log error
        exit;
    }

    $sql = $conn->prepare("CALL proc_getUserByID(?)");

    $userID = (int)$_POST["userID"];
    $editFirstName = $_POST["editFirstName"];
    $editLastName = $_POST["editLastName"];
    $editEmail = $_POST["editEmail"];

    do {
        if (
            empty($editFirstName) ||
            empty($editLastName) ||
            empty($editEmail)
        ) {
            $errorMessage = "All fields are required";
            break;
        }

        $sql = $conn->prepare("CALL proc_editUserDetailsById(?,?,?,?)");
        if (!$sql) {
            echo "Prepare failed: (" . $conn->errno . ") " . $conn->error; // Debugging statement
            break;
        }

        $sql->bind_param("isss", $userID, $editFirstName, $editLastName, $editEmail);

        if (!$sql->execute()) {
            echo "Execute failed: (" . $sql->errno . ") " . $sql->error; // Debugging statement
            $errorMessage = "Query is not valid: " . $conn->error;
            break;
        } 
        else {
            $successMessageProduct = "Successfully Edited Product";
            header("location: users.php");
        }

    } while(false);
}