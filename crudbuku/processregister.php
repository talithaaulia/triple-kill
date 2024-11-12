<?php
session_start();
include('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if the username is already taken
    $checkUsernameQuery = "SELECT * FROM admin WHERE username = '$username'";
    $result = mysqli_query($conn, $checkUsernameQuery);

    if (mysqli_num_rows($result) > 0) {
        echo "Username already taken. Please choose a different username.";
    } else {
        // Hash the password before saving it to the database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user into the database
        $insertUserQuery = "INSERT INTO admin1 (username, password) VALUES ('$username', '$hashedPassword')";

        if (mysqli_query($conn, $insertUserQuery)) {
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>
