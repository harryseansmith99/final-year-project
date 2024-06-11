


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sidebar</title>
    <link rel="stylesheet" href="assets/style.css">
<style>
body {
  font-family: "Lato", sans-serif;
}

.sidenav {
  height: 100%;
  width: 160px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  padding-top: 20px;
}

.sidenav a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.main {
  margin-left: 160px; /* Same as the width of the sidenav */
  font-size: 28px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>
</head>

<body>

<div class="sidenav">
  <a href="#about">About</a>
  <a href="#services">Services</a>
  <a href="#clients">Clients</a>
  <a href="#contact">Contact</a>
</div>

<!-- trying to get main stuff on page next to sidebar -->
<div class="main">
<h1>get all products table test</h1>


<table>
    <tr>
        <th>Product ID</th>
        <th>Category Name</th>
        <th>Product Name</th>
        <th>Product Desc</th>
        <th>Serial Number</th>
        <th>Quanity</th>
        <th>Min Stock Level</th>
        <th>Max Stock Level</th>
        <th>Location</th>
        <th>Location Address</th>
    </tr>

<?php

// connection settings
// sidebar is in same folder
include "connectionSettings.php";

$sql = "CALL proc_getAllProducts()";

$result = mysqli_query($conn, $sql);

// show results from procedure in a table
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row["Product ID"] . "</td><td>"
        . $row["categoryName"] . "</td><td>" . $row["productName"] . "</td><td>" .
        $row["productDescription"] . "</td><td>" . $row["productSerialNumber"] . 
        "</td><td>" . $row["quantity"] . "</td><td>" . $row["minimumStockLevel"] . 
        "</td><td>" . $row["maximumStockLevel"] . "</td><td>" . $row["locationName"] . 
        "</td><td>" . $row["locationAddress"] . "</td></tr>";
    }
    echo "</table>";
}
else {
    echo "no results";
}

$conn->close();
?>
</table>
</div>

</body>
</html>

