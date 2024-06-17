<?php 
//include "includes/postAddCategory.php";
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

            <h1>Provide Details For New User</h1>
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
            <form action="addUser.php" method="post">
                <div class="row mb-3">
                    <label class="col-sm col-form-label">New User First Name</label>
                    <br>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="newCategoryName" value="<?php echo $newfirstName;?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm col-form-label">New User Last Name</label>
                    <br>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="newCategoryName" value="<?php echo $newLastName;?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm col-form-label">New User Email</label>
                    <br>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="newCategoryName" value="<?php echo $newEmail;?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm col-form-label">New User Password</label>
                    <br>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="newCategoryName" value="<?php echo $newPassword;?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm col-form-label">Confirm New User Password</label>
                    <br>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="newCategoryName" value="<?php echo $confirmNewPassword;?>">
                    </div>
                </div>
                <div>
                    <label>Standard User
                        <input type="radio" name="incOrDec" value=1>
                    </label>
                    <label class="book-out-radio">Admin User
                        <input type="radio" name="incOrDec" value=2>
                    </label>
                    <br><br>
                </div>
                <div class="row mb-3">
                    <div class="offset-sm-3 col-sm-3 d-grid">
                        <button type="submit" class="btn btn-outline-primary">Submit</button>
                    </div>
                    <div class="col-sm-3 d-grid">
                        <a class="btn btn-outline-danger" href="users.php" role="button">Cancel</a>
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