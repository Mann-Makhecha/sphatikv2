<?php
session_start();
include './includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format'); window.history.back();</script>";
        exit;
    }

    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match'); window.history.back();</script>";
        exit;
    }

    if (strlen($password) < 6) {
        echo "<script>alert('Password must be at least 6 characters long'); window.history.back();</script>";
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO members (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful!'); window.location.href='mem_login.php';</script>";
    } else {
        echo "<script>alert('Error registering user');</script>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: white;
            display: flex;
            width: 800px;
            border-radius: 20px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            flex-wrap: wrap;
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
            color: #6d28d9;
            font-size: 26px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 14px;
            margin: 10px 0;
            border: none;
            border-radius: 25px;
            background: #f3f3f3;
            text-align: center;
            font-size: 16px;
        }

        button {
            background-color: #6d28d9;
            color: white;
            border: none;
            padding: 14px;
            width: 100%;
            border-radius: 25px;
            cursor: pointer;
            margin-top: 14px;
            font-size: 16px;
            transition: background 0.3s;
        }

        button:hover {
            background-color: #5a1fb9;
        }

        p {
            margin-top: 14px;
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

            .left,
            .right {
                width: 100%;
                text-align: center;
                padding: 30px;
            }
        }
    </style>
    <script>
        function validateForm() {
            let email = document.forms["registerForm"]["email"].value;
            let password = document.forms["registerForm"]["password"].value;
            let confirmPassword = document.forms["registerForm"]["confirm_password"].value;
            let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!emailPattern.test(email)) {
                alert("Invalid email format");
                return false;
            }
            if (password.length < 6) {
                alert("Password must be at least 6 characters long");
                return false;
            }
            if (password !== confirmPassword) {
                alert("Passwords do not match");
                return false;
            }
            return true;
        }
    </script>
</head>

<body>
    <div class="container">
        <div class="left">
            <h2>Register</h2>
            <form name="registerForm" method="POST" action="member_register.php" onsubmit="return validateForm()">
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                <button type="submit">Register</button>
            </form>
            <p>Already have an account? <a href="user_login.php">Login</a></p>
        </div>
        <div class="right">
            <div>
                <h2>Join Us!</h2>
                <p>Create an account to access amazing features and stay connected.</p>
            </div>
        </div>
    </div>
</body>

</html>