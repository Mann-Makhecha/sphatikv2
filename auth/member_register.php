<?php
session_start();
include './includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];

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
    $stmt = $conn->prepare("INSERT INTO members (username, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $hashed_password, $role);

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
    <link rel="stylesheet" href="../css/form.css">
    <script>
        function validateForm() {
            const email = document.forms["registerForm"]["email"].value;
            const password = document.forms["registerForm"]["password"].value;
            const confirmPassword = document.forms["registerForm"]["confirm_password"].value;
            const role = document.forms["registerForm"]["role"].value;
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

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
            if (role === "") {
                alert("Please select a role");
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

                <label for="role">Register as *</label>
                <select id="role" name="role" required>
                    <option value="">Select Role</option>
                    <option value="user" <?php echo (isset($_POST['role']) && $_POST['role'] === 'user') ? 'selected' : ''; ?>>Regular User</option>
                    <option value="freelancer" <?php echo (isset($_POST['role']) && $_POST['role'] === 'freelancer') ? 'selected' : ''; ?>>Freelancer</option>
                    <option value="delivery_partner" <?php echo (isset($_POST['role']) && $_POST['role'] === 'delivery_partner') ? 'selected' : ''; ?>>Delivery Partner</option>
                    <option value="service_provider" <?php echo (isset($_POST['role']) && $_POST['role'] === 'service_provider') ? 'selected' : ''; ?>>Service Provider</option>
                </select>

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