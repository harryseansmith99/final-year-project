<?php 
include "includes/postEditUser.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css?<?php echo time(); ?>">
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script defer src="assets/js/validateEditUser.js"></script>
</head>
<body>
    
    <?php 
    include "includes/sidebar.php";
    ?>

    <div class="container my-5">

        <div class="main">

            <h1 class="header-bar">Provide Altered Details For User</h1>
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
            <form id="editUserForm" action="editUser.php" method="post">
            <input type="hidden" name="userID" value="<?php echo $userID; ?>">
                <div class="row mb-3">
                    <div class="input-control">
                        <label class="col-sm col-form-label">First Name</label>
                        <br>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="editFirstName" name="editFirstName" value="<?php echo $editFirstName;?>">
                            <div class="error"></div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="input-control">
                        <label class="col-sm col-form-label">User Last Name</label>
                        <br>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="editLastName" name="editLastName" value="<?php echo $editLastName;?>">
                            <div class="error"></div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="input-control">
                        <label class="col-sm col-form-label">User Email</label>
                        <br>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="editEmail" name="editEmail" value="<?php echo $editEmail;?>">
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