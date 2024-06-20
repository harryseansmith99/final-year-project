<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "includes/connectionSettings.php";

$newPassword = "";
$confirmPassword = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPassword = $_POST["newPassword"];
    $confirmPassword = $_POST["confirmPassword"];

    if (empty($newPassword) || empty($confirmPassword)) {
        $errorMessage = "All fields are required";
    } else if ($newPassword !== $confirmPassword) {
        $errorMessage = "Passwords do not match";
    } else {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        if (isset($_SESSION["userID"])) {
            $userID = (int)$_SESSION["userID"];
        } else {
            $errorMessage = "User ID not found in session";
        }

        if (empty($errorMessage)) {
            $sql = $conn->prepare("CALL proc_changePasswordById(?, ?)");
            $sql->bind_param("is", $userID, $hashedPassword);

            if (!$sql->execute()) {
                $errorMessage = "Error updating password: " . $conn->error;
            } else {
                $successMessage = "Password successfully updated";
            }
            $sql->close();
        }
    }
}

$conn->close();
?>
