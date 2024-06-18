<?php

include "includes/connectionSettings.php";

session_start();

$email = "";
$password = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = $conn->prepare();
}