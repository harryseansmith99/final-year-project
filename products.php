<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>
<body>

    <h1>get all products table test</h1>

    <?php

    // connection settings

    $server = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "inventory_management_system";

    $conn = mysqli_connect($server, $dbUser, $dbPassword, $dbName);

    // if failure to connect to the database for some reason
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // call procedure
    $allProductsProcedure = "CALL proc_getAllProducts()";
    $query = mysqli_query($conn, $getAllProductsProcedure);

    



?>
</body>
</html>