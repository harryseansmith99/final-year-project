<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>

    <?php 
    include "includes/sidebar.php"; 
    ?>

    <div class="container-fluid my-5">

        <div class="main">

            <h1 id="my_header">All Current Products</h1>
            <br><br>
            
            <a class="btn btn-primary btn-lg mx-5" href="addProduct.php" role="button">Add New Product</a>
            <a class="btn btn-primary btn-lg mx-5" href="" role="button">Add New Category</a>
            <br><br><br>


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
                        <td>$row[storageLocation]</td>
                        <td>
                            <a class='btn btn-primary btn-lg' href='includes/editProduct.php?id=$row[productID]'>Edit Product Details</a>
                            <a class='btn btn-danger btn-lg' href='delete.php'>Delete Product</a>
                        </td>
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