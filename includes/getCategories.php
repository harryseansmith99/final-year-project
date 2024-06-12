<?php

include "connectionSettings.php";

$sql = "CALL proc_getAllCategories()";

$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='" . $row["categoryName"] . "'>" . $row["categoryName"] . "</option>";
    }
}

$conn->close();
    