<?php 
include "includes/postChangePassword.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
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

            <h1 class="header-bar">Provide New Password</h1>
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
            <form id="changePasswordForm" action="changePassword.php" method="post">
                <div class="row mb-3">
                    <div class="input-control">
                        <label class="col-sm col-form-label">New Password</label>
                        <br>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="newPassword" name="newPassword" value="<?php echo $newPassword;?>">
                            <div class="error"></div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="input-control">
                        <label class="col-sm col-form-label">Conform New Password</label>
                        <br>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="confirmPassword" name="confirmPassword" value="<?php echo $confirmPassword;?>">
                            <div class="error"></div>
                        </div>
                    </div>
                </div>
                <br><br>
                <!-- no need for editing user type, in this situation you would just add a new user for the same 
                 person with the other security level -->
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