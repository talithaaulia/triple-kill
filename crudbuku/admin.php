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
            background-image: url('perpustakaan.jpg');
            background-size: cover;
            background-position: center;
            color: #000;
            margin: 0;
            padding: 0;
        }

        h1 {
            margin: 0;
            color: black;
            font-size: 36px;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 90%; 
            max-width: 1200px; 
            margin: 20px auto; 
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px; 
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%; 
            margin-top: 40px;
            flex-direction: column; 
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            box-sizing: border-box;
            width: auto; 
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

        /* Responsivitas untuk tampilan mobile */
        @media (max-width: 600px) {
            .container {
                margin: 10px; 
                padding: 15px; 
            }

            h1 {
                font-size: 28px; 
            }

            th, td {
                padding: 8px; 
                font-size: 14px; /* Ukuran font yang lebih kecil */
            }

            .btn {
                font-size: 14px; 
                padding: 8px; 
            }

            table {
                font-size: 14px; 
            }
        }

        /* Menambahkan div untuk mengatur overflow */
        .table-responsive {
            width: 100%;
            overflow-x: auto; /* Memungkinkan scroll horizontal jika diperlukan */
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
        <div class="table-responsive"> <!-- Kontainer untuk tabel -->
            <table>
                <thead>
                    <tr>
                        <th>Nomor</th>
                        <th>Judul</th>
                        <th>Author</th>
                        <th>Genre</th>
                        <th>COVER</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data tabel ditampilkan di sini -->
                    <?php
                    // Assuming you have a way to fetch the book data
                    $sqlSelect = "SELECT * FROM book";
                    $result = mysqli_query($conn, $sqlSelect);
                    $counter = 1;
                    while ($data = mysqli_fetch_array($result)) {
                        echo "<tr>
                                <td>{$counter}</td>
                                <td>{$data['title']}</td>
                                <td>{$data['author']}</td>
                                <td>{$data['type']}</td>
                                <td><img src='{$data['COVER']}' alt='Book Cover' style='width: 50px; height: auto;'></td>
                                <td>
                                    <a href='view.php?id={$data['id']}' class='btn btn-info'>Baca disini</a>
                                    <a href='edit.php?id={$data['id']}' class='btn btn-warning'>Edit</a>
                                    <a href='delete.php?id={$data['id']}' class='btn btn-danger'>Hapus</a>
                                </td>
                            </tr>";
                        $counter++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
