<?php
include("connect.php");

class BookDetailsPage {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function displayBookDetails() {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <style>
                body {
                    font-family: 'Arial', sans-serif;
                    margin: 0;
                    padding: 50px ;
                    background-color: orange; /* Ganti dengan warna background yang diinginkan */
                }

                .container {
                    margin: 20px;
                    background-color: #fff; /* Ganti dengan warna background yang diinginkan */
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }

                header {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    margin-bottom: 20px;
                }

                h1 {
                    margin: 0;
                    color: #333; /* Ganti dengan warna teks yang diinginkan */
                }

                .btn {
                    display: inline-block;
                    padding: 10px 20px;
                    margin-right: 50px;
                    font-size: 16px;
                    text-align: center;
                    text-decoration: none;
                    cursor: pointer;
                    background-color: #007bff;
                    color: #fff;
                    border: none;
                    border-radius: 4px;
                }

                .book-details {
                    background-color: #f5f5f5;
                    padding: 20px;
                    margin-top: 20px;
                    text-align: center;
                }

                img {
                    max-width: 100%;
                    height: auto;
                    margin-bottom: 20px;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }

                h3 {
                    margin-top: 20px;
                    color: #333; /* Ganti dengan warna teks yang diinginkan */
                }

                p {
                    margin-bottom: 20px;
                    color: #555; /* Ganti dengan warna teks yang diinginkan */
                    font-size: 25px;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <header>
                    <h1>Baca Dongeng:</h1>
                    <div>
                        <a href="login.php" class="btn">Logout</a>
                    </div>
                </header>
                <div class="book-details">
                    <?php
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $sql = "SELECT * FROM book WHERE id = $id";
                        $result = mysqli_query($this->conn, $sql);

                        if ($result && mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_array($result);
                            $this->displayBookInfo($row);
                        } else {
                            echo "<h3>No books found</h3>";
                        }
                    } else {
                        echo "<h3>No 'id' parameter found</h3>";
                    }
                    ?>
                </div>
            </div>
        </body>
        </html>
        <?php
    }

    private function displayBookInfo($row) {
        ?>
        <?php if (isset($row["COVER"])) : ?>
            <img src="<?php echo $row["COVER"]; ?>" alt="Cover Image">
        <?php else : ?>
            <p>No cover image available.</p>
        <?php endif; ?>
    
        <h3>Judul:</h3>
        <p><?php echo $row["title"]; ?></p>
    
        <h3>Penulis:</h3>
        <p><?php echo $row["author"]; ?></p>
    
        <h3>Genre:</h3>
        <p><?php echo $row["type"]; ?></p>
    
        <?php if (isset($row["description"])) : ?>
            <div>
                <h3>Deskripsi:</h3>
                <p class="book-info"><?php echo nl2br($row["description"]); ?></p>
            </div>
        <?php else : ?>
            <p>No description available.</p>
        <?php endif; ?>
        <?php
    }
}

// Usage
$bookDetailsPage = new BookDetailsPage($conn);
$bookDetailsPage->displayBookDetails();
?>