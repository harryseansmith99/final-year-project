<?php

include "connectionSettings.php";

$sql = "CALL proc_getAllProducts()";

$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='" . $row["productName"] . "'>" . $row["productName"] . "</option>";
    }
}

$conn->close();
    