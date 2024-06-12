<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <?php 
    include "includes/sidebar.php";
    ?>
    <div class="container my-5">
        <h1>Provide Details For New Product</h1>
        <br><br>
        <form method="post">
            <div class="row mb-3">
                <select name="select_box" class="form-select" id="select_box">
                    <option value="">Select Category</option>
                    <?php include "includes/getCategories.php"; ?>
                </select>
            </div>
        </form>
    </div>
</body>
</html>