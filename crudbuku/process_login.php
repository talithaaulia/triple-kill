<?php
session_start();
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Ambil informasi pengguna dari database
    $sql = "SELECT * FROM admin1 WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            // Verifikasi password
            if (password_verify($password, $row['password'])) {
                if ($username === "admin" && $password === "admin123") {
                    // Tandai pengguna sebagai admin dalam sesi
                    $_SESSION["user_role"] = "admin";
                    header("Location: admin.php");
                    exit();
                } else {
                    // Tandai pengguna sebagai user dalam sesi
                    $_SESSION["user_role"] = "user";
                    header("Location: user.php");
                    exit();
                }
            } else {
                $error_message = "Password salah. Silakan coba lagi.";
                header("Location: login.php?error=" . urlencode($error_message));
                exit();
            }
        } else {
            $error_message = "Username salah. Silakan coba lagi.";
            header("Location: login.php?error=" . urlencode($error_message));
            exit();
        }
    } else {
        $error_message = "Error database. Silakan coba lagi.";
        header("Location: login.php?error=" . urlencode($error_message));
        exit();
    }
}
?>
