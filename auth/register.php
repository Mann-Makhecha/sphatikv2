<?php
require_once '../includes/global.php';
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $id = time();
    $errors = [];

    if (empty($username) || strlen($username) < 3) {
        $errors[] = "Username must be at least 3 characters long";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    if (empty($password) || strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long";
    }

    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match";
    }

    if (empty($address) || strlen($address) < 10) {
        $errors[] = "Address must be at least 10 characters long";
    }

    if (empty($phone) || !preg_match('/^[0-9]{10}$/', $phone)) {
        $errors[] = "Phone number must be exactly 10 digits";
    }


    $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        $errors[] = "Username or email already exists";
    }


    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (user_id,username, email, password, address, phone) VALUES (?, ?, ?, ?, ?,?)");
        $stmt->bind_param("ssssss", $id, $username, $email, $hashed_password, $address, $phone);

        if ($stmt->execute()) {
            echo "<script>alert('Registration successful!'); window.location.href='user_login.php';</script>";
        } else {
            echo "<script>alert('Error registering user');</script>";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/form.css">
        <title>Register</title>
    </head>

    <body class="login-body">
        <div class="login-container">
            <div class="left">
                <h2>Register</h2>
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-error">
                        <?php foreach ($errors as $error): ?>
                            <p><?php echo $error; ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <form name="registerForm" method="POST" action="register.php">
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="text" name="address" placeholder="Address" required>
                    <input type="text" name="phone" placeholder="Phone Number" required pattern="[0-9]{10}"
                        title="Phone number must be 10 digits">
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