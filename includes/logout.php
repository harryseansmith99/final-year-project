<?php
// this will effectively log out the user
session_start();
session_unset();
session_destroy();
// take them back to homepage
header("Location: ../index.php");
exit;
?>