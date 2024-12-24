<?php
// Konfigurasi database
$dbName = "crudbuku";
$dbHost = "db"; // Nama service dari docker-compose.yml
$dbUser = "user";
$dbPass = "password";

// Membuat koneksi
$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

// Cek koneksi
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// ID yang ingin dihapus
$deletedId = 42; // Ganti dengan ID yang ingin dihapus
$sqlDelete = "DELETE FROM book WHERE id = $deletedId";

if (mysqli_query($conn, $sqlDelete)) {
    echo "Record with ID $deletedId has been deleted.<br>";
} else {
    echo "Error deleting record: " . mysqli_error($conn) . "<br>";
}

// Reset auto-increment
$tableName = "book"; // Ganti dengan nama tabel Anda
$sqlResetAutoIncrement = "ALTER TABLE $tableName AUTO_INCREMENT = 1";

if (mysqli_query($conn, $sqlResetAutoIncrement)) {
    echo "Auto-increment reset successfully for table $tableName.<br>";
} else {
    echo "Error resetting auto-increment: " . mysqli_error($conn) . "<br>";
}

// Tutup koneksi
mysqli_close($conn);
?>
