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
                <select name="select_box" class="form-select form-select-md" id="select_box">
                    <option value="">Select Category</option>
                    <?php include "includes/getCategories.php"; ?>
                </select>
            </div>
            <div class="row mb-3">
                <label class="col-sm col-form-label">Product Name</label>
                <br>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="newProductName" value="">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm col-form-label">Product Description</label>
                <br>
                <div class="col-sm-6">
                    <textarea class="form-control" name="newProductDescription"></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm col-form-label">Serial Number</label>
                <br>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="newSerialNumber" value="">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm col-form-label">Storage Location</label>
                <br>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="storageLocationToAdd" value="">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm col-form-label">Received Quanity</label>
                <br>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="receivedQuantity" value="">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm col-form-label">Minimum Quantity</label>
                <br>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="possibleMinimumQuantity" value="">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm col-form-label">Minimum Quantity</label>
                <br>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="possibleMaximumQuantity" value="">
                </div>
            </div>
            <br><br>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-outline-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-danger" href="products.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>