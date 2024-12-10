<?php

class BookForm {
    private $title;
    private $author;
    private $type;
    private $description;

    public function __construct($title = "", $author = "", $type = "", $description = "") {
        $this->title = $title;
        $this->author = $author;
        $this->type = $type;
        $this->description = $description;
    }

    public function render() {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Tambah Buku Baru</title>
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
                    margin: 200px;
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
                    <h1>Tambah Buku Baru</h1>
                    <div>
                        <a href="admin.php" class="btn-back">kembali</a>
                    </div>
                </header>
                <form action="process.php" method="post" enctype="multipart/form-data">
                    <div class="form-element">
                    <label for="title">Judul Buku:</label>
                        <input type="text" name="title" placeholder="Judul buku" value="<?php echo $this->title; ?>">
                    </div>
                    <div class="form-element">
                    <label for="title">Penulis</label>
                        <input type="text" name="author" placeholder="Penulis" value="<?php echo $this->author; ?>">
                    </div>
                    <div class="form-element">
                    <label for="title">Genre:</label>
                        <select name="type">
                            <option value="">Pilih genre buku</option>
                            <option value="Petualangan" <?php echo ($this->type === 'Petualangan') ? 'selected' : ''; ?>>Petualangan</option>
                            <option value="Kriminal" <?php echo ($this->type === 'Kriminal') ? 'selected' : ''; ?>>Kriminal</option>
                            <option value="Fantasy" <?php echo ($this->type === 'Fantasy') ? 'selected' : ''; ?>>Fantasy</option>
                            <option value="Horor" <?php echo ($this->type === 'Horor') ? 'selected' : ''; ?>>Horor</option>
                        </select>
                    </div>
                    <div class="form-element">
                    <label for="title">Deskripsi</label>
                        <textarea name="description" placeholder="Deskripsi Buku"><?php echo $this->description; ?></textarea>
                    </div>
                    <div class="form-element">
                        <label for="image" class="custom-file-upload">
                            Pilih Gambar Buku
                        </label>
                        <input type="file" name="image" id="image">
                    </div>
                    <div class="form-element">
                        <input type="submit" name="create" value="Tambahkan Buku">
                    </div>
                </form>
            </div>
        </body>
        </html>
        <?php
    }
}

// Example usage:
$form = new BookForm();
$form->render();

?>