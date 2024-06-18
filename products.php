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
    include "includes/authenticateAdmin.php";
    include "includes/sidebar.php"; 
    ?>

    <div class="container-fluid my-5">

        <div class="main">

            <h1 id="my_header">All Current Products</h1>
            <br><br>
            
            <a class="btn btn-primary btn-lg mx-5" href="addProduct.php" role="button">Add New Product</a>
            <a class="btn btn-primary btn-lg mx-5" href="addCategory.php" role="button">Add New Category</a>
            <a class="btn btn-primary btn-lg mx-5" href="editCategory.php" role="button">Edit Category</a>

            <?php 
            // if the current user is an admin, then echo out the delete category button
            if ($isAdmin) {
                echo '<a class="btn btn-primary btn-lg mx-5" href="deleteCategory.php" role="button">Delete Category</a>';
            }
            ?>
            <br><br><br>

            <div class="content">
                <table class="table">
                    <thead>
                        <tr class="fs-9">
                            <th>Product Name</th>
                            <th>Product Desc</th>
                            <th>Category Name</th>
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
                        // for the edit and delete buttons we can simply use 
                        // $row[productID], this will allow us to use $_GET
                        // to edit or delete the product on that row 
                        echo "
                        <tr>
                            <td>$row[productName]</td>
                            <td>$row[productDescription]</td>
                            <td>$row[categoryName]</td>
                            <td>$row[productSerialNumber]</td>
                            <td>$row[quantity]</td>
                            <td>$row[minimumStockLevel]</td>
                            <td>$row[maximumStockLevel]</td>
                            <td>$row[storageLocation]</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='editProduct.php?editProductId=$row[productID]'>
                                    <span class='button-font'>Edit</span><br>
                                    <span class='button-font'>Product</span>
                                </a>";

                        // if the current user is an admin, then echo out the delete product button
                        if ($isAdmin) {
                            echo "<a class='btn btn-danger btn-sm' href='includes/deleteProduct.php?deleteProductId=$row[productID]'>
                            <span class='button-font'>Delete</span><br>
                            <span class='button-font'>Product</span>
                            </a>
                        </td>";
                        }  
                    }
                    echo "</tr>";
                }
                else {
                    echo "no results";
                }

                $conn->close();
                ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>