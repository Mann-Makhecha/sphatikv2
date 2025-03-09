<?php
require_once '../includes/global.php';
require_once '../includes/db.php';

if (!isset($_SESSION['id'])) {
    echo "<p style='color: red;'>Unauthorized access.</p>";
    exit;
}

$id = $_SESSION['id'];
$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current_password = $_POST['current_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
        $error = "All fields are required.";
    } elseif (strlen($new_password) < 6) {
        $error = "New password must be at least 6 characters long.";
    } elseif ($new_password !== $confirm_password) {
        $error = "New password and confirm password do not match.";
    } else {
        try {
            $stmt = $conn->prepare("SELECT password FROM $tbl_name WHERE $id_name = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if (!$user || !password_verify($current_password, $user['password'])) {
                $error = "Current password is incorrect.";
            } else {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $update_stmt = $conn->prepare("UPDATE $tbl_name SET password = ? WHERE $id_name = ?");
                $update_stmt->bind_param("si", $hashed_password, $id);
                $update_stmt->execute();

                $success = "Password updated successfully.";
                $update_stmt->close();
            }
            $stmt->close();
            $conn->close();
        } catch (Exception $e) {
            $error = "Database error: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Change Password</title>
        <link rel="stylesheet" href="../css/update.css">
        <style>
        </style>
    </head>

    <body>
        <div class="container">
            <h2>Change Password</h2>
            <?php if ($error)
                echo "<p class='error'>$error</p>"; ?>
            <?php if ($success)
                echo "<p class='success'>$success</p>"; ?>
            <form action="" method="POST">

                <label for="current_password">Current Password:</label>
                <input type="password" id="current_password" name="current_password" required><br>

                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password" required><br>

                <label for="confirm_password">Confirm New Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required><br>
                <button type="submit">Save Changes</button>
            </form>
        </div>
    </body>

</html>