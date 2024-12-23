<?php
session_start();
include("connect.php");

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    // Check if the username is already taken
    $checkUsernameQuery = "SELECT * FROM admin1 WHERE username = '$username'";
    $result = mysqli_query($conn, $checkUsernameQuery);

    if (mysqli_num_rows($result) > 0) {
        $error_message = "Username sudah ada yang pakai. Coba ganti yang lain, yaa!";
    } else {
        // Hash the password sebelum disimpan ke database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $insertUserQuery = "INSERT INTO admin1 (username, password) VALUES ('$username', '$hashedPassword')";
        if (mysqli_query($conn, $insertUserQuery)) {
            header("Location: login.php");
            exit();
        } else {
            $error_message = "Terjadi kesalahan. Silakan coba lagi.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 300px;
            padding: 0;
            background-image: url("lib10.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }

        h1 {
            text-align: center;
            font-weight: bold;
            color: orange;
            font-family: 'Gill Sans', 'Gill Sans MT',  'Trebuchet MS', sans-serif;
            font-size: 40px;
        }

        form {
            max-width: 300px;
            margin: 20px auto;
            padding: 30px;
            background-color: orange;
            color: black;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: black;
            color: orange;
            font-weight: bold;
            cursor: pointer;
            margin-top: 5px;
        }

        input[type="submit"]:hover {
            background-color: navy;
        }

        .error-message {
            color: red;
            font-weight: bold;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <h1>Register</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <?php
        // Display error message if any
        if (!empty($error_message)) {
            echo '<div class="error-message">' . $error_message . '</div>';
        }
        ?>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" value="Register">
    </form>
</body>
</html>