

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css?<?php echo time(); ?>">
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</head>
<body>
    
    <?php 
    include "includes/sidebar.php";
    ?>

    <div class="container my-5">

        <div class="main">

            <h1>Edit Product Details</h1>

                <br><br>
                <form action="editProduct.php" method="post">
                    <div class="row mb-3">
                        <label>Cateogry</label>
                        <select name="categorySelect" class="form-select form-select-md">
                            <option value="<?php echo $categorySelect;?>">Select Category</option>
                            <?php include "includes/getCategories.php"; ?>
                        </select>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm col-form-label">Product Name</label>
                        <br>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="newProductName" value="<?php echo $newProductName;?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm col-form-label">Product Description</label>
                        <br>
                        <div class="col-sm-6">
                            <textarea class="form-control" name="newProductDescription" value="<?php echo $newProductDescription;?>"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm col-form-label">Serial Number</label>
                        <br>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="newSerialNumber" value="<?php echo $newSerialNumber;?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm col-form-label">Storage Location</label>
                        <br>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="storageLocationToAdd" value="<?php echo $storageLocationToAdd;?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm col-form-label">Received Quanity</label>
                        <br>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="receivedQuantity" value="<?php echo $receivedQuantity;?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm col-form-label">Minimum Quantity</label>
                        <br>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="possibleMinimumQuantity" value="<?php echo $possibleMinumumQuantity;?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm col-form-label">Minimum Quantity</label>
                        <br>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="possibleMaximumQuantity" value="<?php echo $possibleMaximumQuantity;?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="offset-sm-3 col-sm-3 d-grid">
                            <button type="submit" class="btn btn-outline-primary">Submit</button>
                        </div>
                        <div class="col-sm-3 d-grid">
                            <a class="btn btn-outline-danger" href="products.php" role="button">Cancel</a>
                        </div>
                    </div>
                    <br><br>
                    <?php 
                    if (!empty($successMessageProduct)) {
                        echo '
                        <div class="alert alert-success" role="alert">
                            A simple success alert—check it out!
                        </div>
                        ';
                    }
                    ?>
                </form>
            </div>
        </div>
</body>
</html>