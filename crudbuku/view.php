<?php
include("connect.php");

class BookDetailsPage {
    private $conn;
    private $books = []; // Menyimpan semua buku

    public function __construct($conn) {
        $this->conn = $conn;
        $this->loadBooks();
    }

    private function loadBooks() {
        $sql = "SELECT * FROM book";
        $result = mysqli_query($this->conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $this->books[] = $row; // Tambahkan setiap buku ke array
            }
        }
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
                    padding: 50px;
                    background-color: orange;
                }

                .container {
                    margin: 20px;
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    width: 60%;
                    text-align: center;
                }

                header {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    margin-bottom: 20px;
                }

                h1 {
                    margin: 0;
                    color: #333;
                }

                .btn {
                    display: inline-block;
                    padding: 10px 20px;
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
                }

                img {
                    max-width: 100%;
                    height: auto;
                    margin-bottom: 20px;
                    border-radius: 8px;
                }

                .navigation {
                    display: flex;
                    justify-content: space-between;
                    margin-top: 20px;
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
                <div class="book-details" id="book-details"></div>

                <div class="navigation">
                    <button class="btn" id="prevBtn" onclick="prevBook()">Back</button>
                    <button class="btn" id="nextBtn" onclick="nextBook()">Next</button>
                </div>
            </div>

            <script>
                let books = <?php echo json_encode($this->books); ?>;
                let currentIndex = 0;

                function displayBook(index) {
                    const bookDetails = document.getElementById('book-details');
                    const book = books[index];
                    
                    bookDetails.innerHTML = `
                        ${book.COVER ? `<img src="${book.COVER}" alt="Cover Image">` : "<p>No cover image available.</p>"}
                        <h3>Judul:</h3><p>${book.title}</p>
                        <h3>Penulis:</h3><p>${book.author}</p>
                        <h3>Genre:</h3><p>${book.type}</p>
                        <h3>Deskripsi:</h3><p>${book.description ? book.description : "No description available."}</p>
                    `;

                    // Menonaktifkan tombol jika tidak ada halaman selanjutnya atau sebelumnya
                    document.getElementById("prevBtn").disabled = currentIndex === 0;
                    document.getElementById("nextBtn").disabled = currentIndex === books.length - 1;
                }

                function nextBook() {
                    if (currentIndex < books.length - 1) {
                        currentIndex++;
                        displayBook(currentIndex);
                    }
                }

                function prevBook() {
                    if (currentIndex > 0) {
                        currentIndex--;
                        displayBook(currentIndex);
                    }
                }

                // Tampilkan buku pertama saat halaman dimuat
                displayBook(currentIndex);
            </script>
        </body>
        </html>
        <?php
    }
}

// Usage
$bookDetailsPage = new BookDetailsPage($conn);
$bookDetailsPage->displayBookDetails();
?>
