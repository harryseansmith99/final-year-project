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

            <h1 id="my_header">All Current Users</h1>
            <br><br>
            
            <a class="btn btn-primary btn-lg mx-5" href="#add-new-user" role="button">Add New User</a>
            <br><br><br>

            <div class="content">
                <table class="table">
                    <thead>
                        <tr class="fs-9">
                            <th>User ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Security Level</th>
                        </tr>
                    </thead>
                <?php

                // connection settings
                include "includes/connectionSettings.php";

                $sql = "CALL proc_getAllUsers()";

                $result = mysqli_query($conn, $sql);

                // show all users in a table
                if ($result->num_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        // for the edit and delete buttons we can simply use 
                        // $row[userID], this will allow us to use $_GET
                        // to edit or delete the product on that row 
                        echo "
                        <tr>
                            <td>$row[userID]</td>
                            <td>$row[firstName]</td>
                            <td>$row[lastName]</td>
                            <td>$row[email]</td>
                            <td>$row[secLevel]</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href=#edit-user>
                                    <span class='button-font'>Edit</span><br>
                                    <span class='button-font'>User</span>
                                </a>
                                <a class='btn btn-danger btn-sm' href=#delete-user>
                                    <span class='button-font'>Delete</span><br>
                                    <span class='button-font'>User</span>
                                </a>
                            </td>
                        ";
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