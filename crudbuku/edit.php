<?php
include("connect.php");

class BookEditor {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function displayEditForm($id) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit Book</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                    background-color: orange;
                }

                .container {
                    margin: 50px;
                }

                header {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    margin-bottom: 40px;
                }

                h1 {
                    margin: 0;
                }

                .btn-back {
                    background-color: red;
                    color: #fff;
                    padding: 10px 20px;
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

                form {
                    width: 50%;
                    margin: 0 auto;
                }

                .form-element {
                    margin-bottom: 20px;
                }

                input[type="text"],
                input[type="number"],
                select,
                textarea {
                    width: 100%;
                    padding: 10px;
                    box-sizing: border-box;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                    margin-top: 5px;
                }

                textarea {
                    resize: vertical;
                }

                input[type="submit"] {
                    background-color: red;
                    color: #fff;
                    padding: 10px 20px;
                    font-size: 16px;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                }

                input[type="submit"]:hover {
                    background-color: pink;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <header>
                    <h1>Edit Buku</h1>
                    <div>
                        <a href="admin.php" class="btn-back">Kembali</a>
                    </div>
                </header>
                <form action="process.php" method="post" enctype="multipart/form-data">
                    <?php 
                    if ($this->validateId($id)) {
                        $row = $this->getBookDetails($id);
                        $this->displayFormElements($row);
                    } else {
                        echo "<h3>Book Does Not Exist</h3>";
                    }
                    ?>
                </form>
            </div>
        </body>
        </html>
        <?php
    }

    private function validateId($id) {
        return isset($id) && is_numeric($id);
    }

    private function getBookDetails($id) {
        $sql = "SELECT * FROM book WHERE id=$id";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_fetch_array($result);
    }
    private function displayFormElements($row) {
        ?>
        <div class="form-element">
            <label for="title">Judul Buku:</label>
            <input type="text" id="title" name="title" value="<?php echo $row["title"]; ?>">
        </div>
        <div class="form-element">
            <label for="author">Penulis:</label>
            <input type="text" id="author" name="author" value="<?php echo $row["author"]; ?>">
        </div>
        <div class="form-element">
            <label for="type">Pilih Genre Buku:</label>
            <select id="type" name="type">
                <option value="">Pilih genre buku</option>
                <option value="Petualangan" <?php echo ($row["type"] === 'Petualangan') ? 'selected' : ''; ?>>Petualangan</option>
                <option value="Kriminal" <?php echo ($row["type"] === 'Kriminal') ? 'selected' : ''; ?>>Kriminal</option>
                <option value="Fantasy" <?php echo ($row["type"] === 'Fantasy') ? 'selected' : ''; ?>>Fantasy</option>
                <option value="Horor" <?php echo ($row["type"] === 'Horor') ? 'selected' : ''; ?>>Horor</option>
            </select>
        </div>
        <div class="form-element">
            <label for="description">Deskripsi:</label>
            <textarea id="description" name="description"><?php echo $row["description"]; ?></textarea>
        </div>
        <div class="form-element">
            <label for="image">Gambar Buku:</label>
            <input type="file" name="image" id="image">
        </div>
        <input type="hidden" value="<?php echo $row['id']; ?>" name="id">
        <div class="form-element">
            <input type="submit" name="edit" value="Edit Buku">
        </div>
        <?php
    }
}


// Usage
$id = $_GET['id'];
$bookEditor = new BookEditor($conn);
$bookEditor->displayEditForm($id);
?>