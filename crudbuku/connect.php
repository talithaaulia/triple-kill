<?php
$dbName = "buku";
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

if (!$conn) {
    die("Something went wrong");
}

// Perform deletion
$deletedId = 42; // Replace with the actual ID you want to delete
$sqlDelete = "DELETE FROM book WHERE id = $deletedId";
mysqli_query($conn, $sqlDelete);

// Optionally reset auto-increment
$tableName = "book"; // Replace with your actual table name
$sqlResetAutoIncrement = "ALTER TABLE $tableName AUTO_INCREMENT = 1";
mysqli_query($conn, $sqlResetAutoIncrement);


// Reset the auto-increment value for the table
$tableName = "book"; // Replace with your actual table name
$sql = "ALTER TABLE $tableName AUTO_INCREMENT = 1";
mysqli_query($conn, $sql);
if (!$conn) {
    die("Something went wrong");
}
?>