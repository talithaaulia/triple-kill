<?php

class BookDeleter {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function deleteBook($id) {
        if ($this->validateId($id)) {
            $sql = "DELETE FROM book WHERE id='$id'";
            if (mysqli_query($this->conn, $sql)) {
                session_start();
                $_SESSION["delete"] = "Data Buku berhasil dihapus";
                header("Location: admin.php");
            } else {
                die("Something went wrong");
            }
        } else {
            echo "Buku tidak ada";
        }
    }

    private function validateId($id) {
        return isset($id) && is_numeric($id);
    }
}

// Usage
if (isset($_GET['id'])) {
    include("connect.php");
    $id = $_GET['id'];
    $bookDeleter = new BookDeleter($conn);
    $bookDeleter->deleteBook($id);
} else {
    echo "Buku tidak ada";
}
?>
