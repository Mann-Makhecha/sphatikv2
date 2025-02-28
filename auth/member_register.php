<?php
session_start();
require_once '../includes/db.php';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = time();
    $username = $_POST['username'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];


    if (empty($username) || strlen($username) < 3) {
        $errors[] = "Username must be at least 3 characters long";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    if (empty($address) || strlen($address) < 10) {
        $errors[] = "Address must be at least 10 characters long";
    }

    if (empty($phone) || !preg_match('/^[0-9]{10}$/', $phone)) {
        $errors[] = "Phone number must be exactly 10 digits";
    }

    if (empty($password) || strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long";
    }

    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match";
    }

    if (empty($role)) {
        $errors[] = "Please select a role";
    }

    $stmt = $conn->prepare("SELECT COUNT(*) FROM members WHERE username = ? OR email = ?");
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
        $stmt = $conn->prepare("INSERT INTO members (mem_id,username, email, address,phone,password, role) VALUES (?, ?, ?, ?, ?, ? ,?)");
        $stmt->bind_param("sssssss", $id, $username, $email, $address, $phone, $hashed_password, $role);

        if ($stmt->execute()) {
            echo "<script>alert('Registration successful!'); window.location.href='member_login.php';</script>";
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
        <title>Register</title>
        <link rel="stylesheet" href="../css/form.css">
    </head>

    <body>
        <div class="container">
            <div class="left">
                <h2>Register</h2>

                <?php if (!empty($errors)): ?>
                    <div class="alert alert-error">
                        <?php foreach ($errors as $error): ?>
                            <p class="msg"><?php echo $error; ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <form name="registerForm" method="POST" action="member_register.php" onsubmit="return validateForm()">
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="text" name="address" placeholder="Address" required>
                    <input type="text" name="phone" placeholder="Phone Number" required pattern="[0-9]{10}"
                        title="Phone number must be 10 digits">
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="password" name="confirm_password" placeholder="Confirm Password" required>

                    <select id="role" name="role" required>
                        <option value="">Select Role</option>
                        <option value="freelancer" <?php echo (isset($_POST['role']) && $_POST['role'] === 'freelancer') ? 'selected' : ''; ?>>Freelancer</option>
                        <option value="instructor" <?php echo (isset($_POST['role']) && $_POST['role'] === 'delivery_partner') ? 'selected' : ''; ?>>Instructor</option>
                        <option value="local_service_provider" <?php echo (isset($_POST['role']) && $_POST['role'] === 'local_service_provider') ? 'selected' : ''; ?>>Service Provider</option>
                    </select>

                    <button type="submit">Register</button>
                </form>
                <p class="p">Already have an account? <a href="member_login.php">Login</a></p>
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