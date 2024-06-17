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
$editPassword = "";
$confirmEditPassword = "";

$errorMessage = "";
$successMessageProduct = "";

if ($_SERVER["REQUEST METHOD"] == "GET") {
    if (isset($_GET["editUserId"])) {
        $userID = (int)$_GET["editUserId"];
        error_log("Retrieved userID: $userID"); // Log the retrieved userID
        
    }
}