<!-- idea taken from
https://www.w3schools.com/howto/howto_css_fixed_sidebar.asp 
-->

<?php 

include "includes/authenticateAdmin.php";

// echo '

// <div class="sidenav">
//   <a href="products.php">Products</a>
//   <a href="alterStock.php">Alter Stock</a>';
//   // only admin should have users page
//   if ($isAdmin) {
//     echo '<a href="users.php">Users</a>';
//   }
//   // rest of sidebar
//   echo '
  
//     <a href="includes/logout.php">Logout</a>
// </div>
// ';

?>

<div class="sidenav">
    <a href="products.php">Products</a>
    <a href="alterStock.php">Alter Stock</a>
    <?php 
    if ($isAdmin) {
        echo '<a href="users.php">Users</a>';
    }
    ?>
    <a href="changePassword.php">Change Password</a>
    <a href="includes/logout.php">Logout</a>
</div>