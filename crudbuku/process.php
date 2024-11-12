<?php
include('connect.php');
if (isset($_POST["create"])) {
    $title = mysqli_real_escape_string($conn, $_POST["title"]);
    $type = mysqli_real_escape_string($conn, $_POST["type"]);
    $author = mysqli_real_escape_string($conn, $_POST["author"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);

    // File upload handling
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Valid file formats
    $allowedFormats = array("jpg", "jpeg", "png");

    // Create the "uploads" directory if it doesn't exist
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    if (in_array($imageFileType, $allowedFormats)) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $COVER = mysqli_real_escape_string($conn, $targetFile);

            $sqlInsert = "INSERT INTO book (title, author, type, description, COVER) VALUES ('$title', '$author', '$type', '$description', '$COVER')";

            if (mysqli_query($conn, $sqlInsert)) {
                session_start();
                $_SESSION["create"] = "Buku berhasil ditambahkan!";
                header("Location: admin.php");
            } else {
                die("Kesalahan!");
            }
        } else {
            echo "File upload failed.";
        }
    } else {
        echo "File format not supported. Please upload a JPG or PNG file.";
    }
}
if (isset($_POST["edit"])) {
    $title = mysqli_real_escape_string($conn, $_POST["title"]);
    $type = mysqli_real_escape_string($conn, $_POST["type"]);
    $author = mysqli_real_escape_string($conn, $_POST["author"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);
    $id = mysqli_real_escape_string($conn, $_POST["id"]);

    // File upload handling for cover image
    if ($_FILES["image"]["name"]) {
        $targetDir = "uploads/"; // Adjust the target directory as needed
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);

        // You might want to perform additional checks/validation for the file, e.g., file size, file type, etc.

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $coverPath = mysqli_real_escape_string($conn, $targetFile);

            // Update the cover image path in the database
            $sqlUpdate = "UPDATE book SET title = '$title', type = '$type', author = '$author', description = '$description', COVER = '$coverPath' WHERE id='$id'";

            if (mysqli_query($conn, $sqlUpdate)) {
                session_start();
                $_SESSION["update"] = "Buku berhasil di edit!";
                header("Location: admin.php");
            } else {
                die("Kesalahan!");
            }
        } else {
            echo "File upload failed.";
        }
    } else {
        // If no new cover image is uploaded, update other details without changing the cover image
        $sqlUpdate = "UPDATE book SET title = '$title', type = '$type', author = '$author', description = '$description' WHERE id='$id'";

        if (mysqli_query($conn, $sqlUpdate)) {
            session_start();
            $_SESSION["update"] = "Buku berhasil di edit!";
            header("Location: admin.php");
        } else {
            die("Kesalahan!");
        }
    }
}

?>