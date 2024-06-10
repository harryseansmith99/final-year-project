<?php

$server = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "inventory_management_db";

$conn = mysqli_connect($server, $dbUser, $dbPassword, $dbName);

// if failure to connect to the database for some reason
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}