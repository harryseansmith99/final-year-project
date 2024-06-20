<?php 
include "includes/postEditCategory.php";
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
</head>
<body>
    
    <?php 
    include "includes/sidebar.php";
    ?>

    <div class="container my-5">

        <div class="main">

            <h1 class="header-bar">Edit Category Name</h1>
            <br><br>

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
                <form action="editCategory.php" method="post">
                    <div class="row mb-3">
                        <label>Category</label>
                        <select name="categorySelect" class="form-select form-select-md">
                            <option value="<?php echo $categorySelect;?>">Select Category</option>
                            <?php include "includes/getCategories.php"; ?>
                        </select>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm col-form-label">New Category Name</label>
                        <br>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="newCategoryName" value="<?php echo $newCategoryName;?>">
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