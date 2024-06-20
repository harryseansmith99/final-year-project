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

    $sql = $conn->prepare("CALL proc_getUserByEmail(?)");
    $sql->bind_param("s", $email);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // right now in the db the password will already be hashed
        $hashedPassword = $user["userPassword"];

        // verify the password
        if (password_verify($password, $hashedPassword)) {
            // password is correct so successful login

            // we want these session variables so the site can be different
            // depending on who is logged in (standard or admin user)
            $_SESSION["userID"] = $user["userID"];
            $_SESSION["email"] = $email;
            (int)$_SESSION["secLevel"] = $user["secLevel"]; // get it from fetched db row (user)
            $successMessage = "Login Successful";
            header("Location: products.php");
            exit;
        }
        else {
            // incorrect password
            $errorMessage = "Invalid password";
        }
    }
    else {
        // user not found
        $errorMessage = "Invalid user";
    }
    $conn->close();
}