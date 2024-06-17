<?php 

include "includes/connectionSettings.php";

$userID = 0;
$editFirstName = "";
$editLastName = "";
$editEmail = "";
$editPassword = "";
$confirmEditPassword = "";

$errorMessage = "";
$successMessageProduct = "";

if ($_SERVER["REQUEST METHOD"] == "GET") {
    if (isset($_GET[""]))
}