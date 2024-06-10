<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>
<body>

    <h1>get all products table test</h1>

    <table>
        <tr>
            <th>productID</th>
            <th>categoryID<_fk/th>
            <th>categoryName</th>
            <th>productName</th>
            <th>productDescription</th>
            <th>productSerialNumber</th>
            <th>quantity</th>
            <th>minimumStockLevel</th>
            <th>maximumStockLevel</th>
            <th>locationName</th>
            <th>locationAddress</th>

    <?php

    // connection settings

    $server = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "inventory_management_system";

    $conn = mysqli_connect($server, $dbUser, $dbPassword, $dbName);

    // if failure to connect to the database for some reason
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // call procedure
    // $query = "CALL proc_getAllProducts();";

    $sql = "SELECT
        ProductTable.productID, 
        ProductTable.categoryID_fk, 
        CategoryTable.categoryName,
        ProductTable.productName,
        ProductTable.productDescription,
        ProductTable.productSerialNumber,
        StockTable.quantity,
        StockTable.minimumStockLevel,
        StockTable.maximumStockLevel,
        LocationTable.locationName,
        LocationTable.locationAddress
    FROM ProductTable
        JOIN CategoryTable ON ProductTable.categoryID_fk = CategoryTable.categoryID
        JOIN StockTable ON StockTable.productID_fk = ProductTable.productID
        JOIN LocationTable ON StockTable.locationID_fk = LocationTable.locationID;";


    $result = $conn->query($sql);



    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["productID"] . "</td><td>" . $row["categoryID_fk"] . "</td><td>"
            . $row["categoryName"] . "</td><td>" . $row["productName"] . "</td><td>" .
            $row["productDescription"] . "</td><td>" . $row["productSerialNumber"] . 
            "</td><td>" . $row["quantity"] . "</td><td>" . $row["minimumStockLevel"] . 
            "</td><td>" . $row["maximumStockLevel"] . "</td><td>" . $row["locationName"] . 
            "</td><td>" . $row["locationAddress"] . "</td><tr>";
        }
        echo "</table>";
    }
    else {
        echo "no results";
    }


    $conn->close();

    ?>
    </table>

</body>
</html>