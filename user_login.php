<?php
session_start();
include './auth/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format'); window.history.back();</script>";
        exit;
    }

    if (empty($password) || strlen($password) < 6) {
        echo "<script>alert('Password must be at least 6 characters long'); window.history.back();</script>";
        exit;
    }

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $username, $hash);
        $stmt->fetch();

        if (password_verify($password, $hash)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            echo "<script> window.location.href='home.php';</script>";
            exit;
        } else {
            echo "<script>alert('Incorrect password'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('No account found with this email'); window.history.back();</script>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            display: flex;
            width: 800px;
            border-radius: 20px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            background: white;
        }
        .left {
            width: 50%;
            padding: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .right {
            width: 50%;
            background: linear-gradient(135deg, #6d28d9, #5a1fb9);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 40px;
        }
        h2 {
            color: #333;
            font-size: 24px;
        }
        input {
            width: 100%;
            padding: 12px;
            margin: 12px 0;
            border: none;
            border-radius: 25px;
            background: #f3f3f3;
            text-align: left;
            font-size: 16px;
            outline: none;
        }
        button {
            background-color: #6d28d9;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s;
        }
        button:hover {
            background-color: #5a1fb9;
        }
        p {
            margin-top: 12px;
            font-size: 14px;
        }
        a {
            color: #6d28d9;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                width: 90%;
            }
            .left, .right {
                width: 100%;
                text-align: center;
                padding: 20px;
            }
        }
    </style>
    <script>
        function validateForm() {
            let email = document.forms["loginForm"]["email"].value;
            let password = document.forms["loginForm"]["password"].value;
            let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!emailRegex.test(email)) {
                alert("Please enter a valid email address");
                return false;
            }
            if (password.length < 6) {
                alert("Password must be at least 6 characters long");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="left">
            <h2>Login</h2>
            <form name="loginForm" method="POST" action="user_login.php" onsubmit="return validateForm()">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
            <p>Don't have an account? <a href="register.php">Register</a></p>
        </div>
        <div class="right">
            <div>
                <h2>Welcome Back!</h2>
                <p>We're excited to see you again! Log in to continue where you left off and explore new features.</p>
            </div>
        </div>
    </div>
</body>
</html>