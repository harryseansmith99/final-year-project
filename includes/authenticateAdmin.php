<?php

    // start session 
    session_start();

    // check if a user is even logged in, if not go back to index.php
    if (!isset($_SESSION['email'])) {
        header("Location: index.php");
        exit;
    }

    // user is logged in, check if they are an admin
    $isAdmin = isset($_SESSION["secLevel"]) && $_SESSION["secLevel"] == 2;
?>