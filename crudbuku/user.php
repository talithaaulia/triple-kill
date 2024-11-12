<?php
class Book {
    public $id;
    public $title;
    public $author;
    public $type;
    public $file_temp;

    public function __construct($id, $title, $author, $type, $file_temp) {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->type = $type;
        $this->file_temp = $file_temp;
    }

    public function displayInfo() {
        echo "ID: $this->id, Title: $this->title, Author: $this->author, Type: $this->type";
    }
}

session_start();

include('connect.php');
$sqlSelect = "SELECT * FROM book";
$result = mysqli_query($conn, $sqlSelect);
$books = [];

while ($data = mysqli_fetch_array($result)) {
    $books[] = new Book($data['id'], $data['title'], $data['author'], $data['type'], $data['COVER']);
}

// Simulate the user role (replace this with your actual user role check)
$userRole = "admin";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Buku</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
   body {
        font-family: Arial, sans-serif;
        background-image: url('perpustakaan.jpg'); 
        background-size: cover; 
        background-position: center; 
        color: #000; 
        margin: 0;
        padding: 0;
    }

    h1 {
        margin: 0;
        color: black; /* Warna teks judul, bisa disesuaikan */
        font-size: 36px; /* Ukuran font judul */
    }

    .btn-back {
        background-color: red;
        color: #fff;
        padding: 10px 20px;
        margin-right: 50px;
        font-size: 16px;
        text-align: center;
        text-decoration: none;
        cursor: pointer;
        border: none;
        border-radius: 5px;
    }

    .btn-back:hover {
        background-color: pink;
    }

    .container {
        width: 80%;
        margin: 100px auto;
        background-color: white; /* Warna latar belakang kontainer (Jingga muda) */
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 40px;
    }

    .btn-info {
        /* Gaya tombol yang sama seperti sebelumnya */
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        text-align: center;
        text-decoration: none;
        cursor: pointer;
        border: none;
        border-radius: 4px;
        background-color: #FFD700; /* Emas */
        color: black;
    }

    .btn-info:hover {
        background-color: orange;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        border: 1px solid #dee2e6;
        padding: 10px;
        text-align: center;
    }

    th {
        background-color: #f2f2f2;
    }
</style>

<body>
    <div class="container">
        <header>
            <h1>Daftar Dongeng</h1>
            <a href="login.php" class="btn btn-back">Logout</a>
        </header>

        <!-- Hapus atau komentari pesan-pesan sukses yang ditampilkan -->
        
        <table>
            <thead>
                <tr>
                    <th>nomor</th>
                    <th>Judul</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>COVER</th>
                    <?php if ($userRole === "admin") { ?>
                        <th>Action</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 1;
                foreach ($books as $book) {
                ?>
                <tr>
                    <td><?php echo $counter; ?></td>
                    <td><?php echo $book->title; ?></td>
                    <td><?php echo $book->author; ?></td>
                    <td><?php echo $book->type; ?></td>
                    <td>
                        <!-- Display the image -->
                        <img src="<?php echo $book->file_temp; ?>" alt="Book Cover" style="width: 50px; height: auto;">
                    </td>
                    <?php if ($userRole === "admin") { ?>
                        <td>
                            <a href="view.php?id=<?php echo $book->id; ?>" class="btn btn-info">Baca disini</a>
                            <!-- Edit and delete buttons are not shown to users -->
                        </td>
                    <?php } ?>
                </tr>
                <?php
                    $counter++;
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
