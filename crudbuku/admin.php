<?php
// Assuming 'connect.php' is included
include('connect.php');

class Book {
    public $id;
    public $title;
    public $author;
    public $type;
    public $file_temp; // Renamed property for the temporary file

    public function __construct($id, $title, $author, $type, $file_temp) {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->type = $type;
        $this->file_temp = $file_temp; // Assign the temporary file path
    }

    public function displayInfo() {
        echo "ID: $this->id, Title: $this->title, Author: $this->author, Type: $this->type";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Dongeng</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-image: url('perpustakaan.jpg'); /* Menggunakan gambar sebagai latar belakang */
        background-size: cover; /* Menutupi seluruh area latar belakang */
        background-position: center; /* Posisi gambar di tengah */
        color: #000; /* Warna teks hitam agar kontras dengan latar belakang gambar */
        margin: 0;
        padding: 0;
    }

    h1 {
        margin: 0;
        color: black; /* Warna teks judul, bisa disesuaikan */
        font-size: 36px; /* Ukuran font judul */
    }

    .btn-warning {
        background-color: #FFA500; /* Jingga */
        color: black; /* Putih agar kontras dengan latar belakang oranye */
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

    

    .btn {
        /* Gaya tombol yang sama seperti sebelumnya */
        display: inline-block;
        padding: 10px 20px;
        margin: 5px;
        font-size: 16px;
        text-align: center;
        text-decoration: none;
        cursor: pointer;
        border: none;
        border-radius: 5px;
    }

    .btn:hover {
        background-color: #f2f2f2;
    }

    .btn-primary {
        background-color: #FFA500; 
        color: black;
        font-weight: bold;
    }

    .btn-back {
        background-color: black;
        color: orange;
        font-weight: bold;
    }

    .btn-info {
        background-color: #FFD700; 
        color: black;
    }

  
    .btn-danger {
        background-color: #DC143C; 
        color: #fff;
    }

    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .alert-success {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
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

</head>
<body>
    <div class="container">
        <header>
            <h1>Daftar Dongeng</h1>
            <div>
                <a href="create.php" class="btn btn-primary">Tambah Dongeng Baru</a>
                <a href="login.php" class="btn btn-back">Logout</a>
            </div>
        </header>

        <!-- Your existing code for displaying success messages -->

        <table>
    <thead>
        <tr>
            <th>nomor</th>
            <th>Judul</th>
            <th>Author</th>
            <th>Genre</th>
            <th>COVER</th> <!-- New column for the cover image -->
            <th>Action</th>
        </tr>
    </thead>
    
    <tbody>
        <?php
        $sqlSelect = "SELECT * FROM book";
        $result = mysqli_query($conn, $sqlSelect);
        $counter = 1; // Inisialisasi variabel counter
        while ($data = mysqli_fetch_array($result)) {
            $book = new Book($data['id'], $data['title'], $data['author'], $data['type'], $data['COVER']); // Assuming 'file_temp' is the column name in your database
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
                <td>
                    <a href="view.php?id=<?php echo $book->id; ?>" class="btn btn-info">Baca disini</a>
                    <a href="edit.php?id=<?php echo $book->id; ?>" class="btn btn-warning">Edit</a>
                    <a href="delete.php?id=<?php echo $book->id; ?>" class="btn btn-danger">Hapus</a>
                </td>
            </tr>
        <?php
            $counter++; // Increment counter setiap kali loop
        }
        ?>
    </tbody>
</table>
    </div>
</body>
</html>