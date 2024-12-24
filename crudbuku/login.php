<?php
session_start();

class LoginHandler
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function handleLogin()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = mysqli_real_escape_string($this->conn, $_POST["username"]);
            $password = mysqli_real_escape_string($this->conn, $_POST["password"]);

            $userValidator = new UserValidator($this->conn);
            $loginResult = $userValidator->validateLogin($username, $password);

            if ($loginResult['success']) {
                $this->redirectUser($username);
            } else {
                $this->handleError($loginResult['error']);
            }
        }
    }

    private function redirectUser($username)
    {
        if ($username === "admin") {
            header("Location: admin.php");
        } else {
            header("Location: user.php");
        }
        exit();
    }

    private function handleError($error)
    {
        header("Location: login.php?error=$error");
        exit();
    }
}

class UserValidator
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function validateLogin($username, $password)
    {
        $result = ['success' => false, 'error' => ''];

        $sql = "SELECT * FROM admin1 WHERE username = '$username'";
        $queryResult = mysqli_query($this->conn, $sql);
        $user = mysqli_fetch_assoc($queryResult);

        if ($user && password_verify($password, $user['password'])) {
            $result['success'] = true;
        } else {
            $result['error'] = ($user) ? 'invalid_password' : 'invalid_username';
        }

        return $result;
    }
}

require_once 'connect.php';

$loginHandler = new LoginHandler($conn);

$loginHandler->handleLogin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 100px;
            padding: 0;
            background-image: url("lib6.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }

        h1 {
            text-align: center;
            color: black;
        }

        p {
            color: red;
            font-weight: bold;
            text-align: center;
        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            text-align: center;
            overflow: hidden;
        }

        li {
            display: inline;
        }

        a:hover {
            background-color: wheat;
        }

        form {
            max-width: 300px;
            margin: 20px auto;
            padding: 20px;
            background-color: orange;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 10px;
            display: inline-block;
        }

        input[type="submit"] {
            background-color: black;
            color: orange;
            cursor: pointer;
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background-color: darkblue;
        }
    </style>
</head>
<body>
    <h1>Login</h1>
    <form action="login.php" method="post">
        <?php
            // Tampilkan pesan error jika ada
            if (isset($_GET['error']) && $_GET['error'] == 'invalid_username') {
                echo '<p>Invalid username</p>';
            } elseif (isset($_GET['error']) && $_GET['error'] == 'invalid_password') {
                echo '<p>Invalid password</p>';
            }
        ?>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <text>Belum punya akun? <a href="register.php">Register</a> disini</text>
        <br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
