<?php
require '../includes/db.php';
require '../includes/global.php';

$user_id = $_SESSION['id'] ?? null;

if (!$user_id) {
    die("User not logged in.");
}

if ($_SESSION['type'] === "member") {
    $query = "SELECT username, email, address, phone FROM $tbl_name WHERE $id_name = ?";
} else {
    $query = "SELECT username, email, address, phone FROM $tbl_name WHERE $id_name = ?";
}
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $address = trim($_POST["address"]);
    $phone = trim($_POST["phone"]);

    if (!empty($username) && !empty($email) && !empty($address) && !empty($phone)) {
        $updateQuery = "UPDATE $tbl_name SET username=?, email=?, address=?, phone=? WHERE $id_name=?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("ssssi", $username, $email, $address, $phone, $user_id);
        if ($updateStmt->execute()) {
            $success = "Profile updated successfully!";
            die(header("Location: ../dashboards/profile.php"));
        } else {
            $error = "Failed to update profile.";
        }
    } else {
        $error = "All fields are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Profile</title>
        <link rel="stylesheet" href="<?= BASE_URL ?>css/edit_profile.css">
    </head>

    <body>
        <div class="container">
            <h2 class="welcome">Edit Profile</h2>

            <?php if (isset($success))
                echo "<p class='success'>$success</p>"; ?>
            <?php if (isset($error))
                echo "<p class='error'>$error</p>"; ?>

            <form method="POST" action="">
                <label>Username</label>
                <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>

                <label>Email</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

                <label>Address</label>
                <input type="text" name="address" value="<?php echo htmlspecialchars($user['address']); ?>" required>

                <label>Phone</label>
                <input type="text" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required
                    pattern="\d{10}">

                <button type="submit">Update Profile</button>
            </form>
        </div>
    </body>

</html>