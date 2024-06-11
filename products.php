<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>

    <?php 
    include "includes/sidebar.php"; 
    ?>

    <div class="container-fluid ">

        <div class="main">

        <h1>get all products table test</h1>

        <table class="table">
            <thead>
                <tr class="fs-9">
                    <th>Product ID</th>
                    <th>Category Name</th>
                    <th>Product Name</th>
                    <th>Product Desc</th>
                    <th>Serial Number</th>
                    <th>Quanity</th>
                    <th>Min Stock Level</th>
                    <th>Max Stock Level</th>
                    <th>Location</th>
                </tr>
            </thead>
        <?php

        // connection settings
        include "includes/connectionSettings.php";

        $sql = "CALL proc_getAllProducts()";

        $result = mysqli_query($conn, $sql);

        // show all products in a table
        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "
                <tr>
                    <td>$row[productID]</td>
                    <td>$row[categoryName]</td>
                    <td>$row[productName]</td>
                    <td>$row[productDescription]</td>
                    <td>$row[productSerialNumber]</td>
                    <td>$row[quantity]</td>
                    <td>$row[minimumStockLevel]</td>
                    <td>$row[maximumStockLevel]</td>
                    <td>$row[locationName]</td>
                ";
            }
            echo "</table>";
        }
        else {
            echo "no results";
        }

        $conn->close();
        ?>
        </table>

        </div>
    </div>
</body>
</html>