<?php 
include "includes/postEditProduct.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css?<?php echo time(); ?>">
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script defer src="assets/js/validateEditProduct.js"></script>
</head>
<body>
    
    <?php 
    include "includes/sidebar.php";
    ?>

    <div class="container my-5">

        <div class="main">

            <h1 class="header-bar">Provide Altered Details For Product</h1>

                <?php
                if (!empty($errorMessage)) {
                    echo "
                    <div class='alert alert-warning alert-dismissable fade show text-center' role='alert'>
                        <strong>$errorMessage</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                    </div>
                    ";
                }
                ?>
                <form id="editProductForm" action="editProduct.php" method="post">
                <input type="hidden" name="productID" value="<?php echo $productID; ?>">
                    <div class="row mb-3">
                        <label >Cateogry</label>
                        <select name="categorySelect" class="form-select form-select-md">
                            <option value="<?php echo $categorySelect;?>">Select Category</option>
                            <?php include "includes/getCategories.php"; ?>
                        </select>
                    </div>
                    <div class="row mb-3">
                        <div class="input-control">
                            <label class="col-sm col-form-label">Product Name</label>
                            <br>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="newProductName" name="newProductName" value="<?php echo $newProductName;?>">
                                <div class="error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div>
                            <label class="col-sm col-form-label">Product Description</label>
                            <br>
                            <div class="col-sm-6">
                                <textarea class="form-control" type="text" id="newProductDescription" name="newProductDescription"><?php echo $newProductDescription;?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="input-control">
                            <label class="col-sm col-form-label">Serial Number</label>
                            <br>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="newSerialNumber" name="newSerialNumber" value="<?php echo $newSerialNumber;?>">
                                <div class="error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="input-control">
                            <label class="col-sm col-form-label">Storage Location</label>
                            <br>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="storageLocationToAdd" name="storageLocationToAdd" value="<?php echo $storageLocationToAdd;?>">
                                <div class="error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="input-control">
                            <label class="col-sm col-form-label">Minimum Quantity</label>
                            <br>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="possibleMinimumQuantity" name="possibleMinimumQuantity" value="<?php echo $possibleMinimumQuantity;?>">
                                <div class="error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="input-control">
                            <label class="col-sm col-form-label">Maximum Quantity</label>
                            <br>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="possibleMaximumQuantity" name="possibleMaximumQuantity" value="<?php echo $possibleMaximumQuantity;?>">
                                <div class="error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="offset-sm-3 col-sm-3 d-grid">
                            <button type="submit" name="update" class="btn btn-outline-primary">Update</button>
                        </div>
                        <div class="col-sm-3 d-grid">
                            <a class="btn btn-outline-danger" href="products.php" role="button">Cancel</a>
                        </div>
                    </div>
                    <br><br>
                    <?php
                    if (!empty($successMessageProduct)) {
                        echo "
                        <div class='alert alert-success alert-dismissable fade show text-center' role='alert'>
                            <strong>$successMessageProduct</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                        </div>
                        ";
                    }
                    ?>
                </form>
            </div>
        </div>
</body>
</html>