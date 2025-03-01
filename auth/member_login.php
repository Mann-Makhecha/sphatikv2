<?php
require_once '../includes/db.php';
require_once '../includes/global.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid Email Format.";
    }

    if (empty($password) || strlen($password) < 6) {
        $error_message = "Invalid email or password.";
    }

    $stmt = $conn->prepare("SELECT mem_id, username, password FROM members WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0 && empty($error_message)) {
        $stmt->bind_result($id, $username, $hash);
        $stmt->fetch();

        if (password_verify($password, $hash)) {
            $_SESSION['id'] = $id;
            $_SESSION['type'] = "member";
            setcookie("id", $id, time() + (86400 * 30), "/");
            setcookie("type", "member", time() + (86400 * 30), "/");

            echo "<script> window.location.href='../index.php';</script>";
            exit;
        } else {
            $error_message = "Invalid email or password.";
        }
    } else {
        $error_message = "Invalid email or password.";
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
        <link rel="stylesheet" href="<?= BASE_URL ?>/css/form.css">
    </head>

    <body>
        <div class="container">
            <div class="left">
                <h2>Login</h2>
                <?php if (isset($error_message)) {
                    echo "<p style='color:red;'>$error_message</p>";
                } ?>
                <form name="loginForm" method="POST" action="member_login.php">
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit">Login</button>
                </form>
                <p>Don't have an account? <a href="member_register.php">Register</a></p>
            </div>
            <div class="right">
                <div>
                    <h2>Welcome Back!</h2>
                    <p>We're excited to see you again! Log in to continue where you left off and explore new features.
                    </p>
                </div>
            </div>
        </div>
    </body>

</html>