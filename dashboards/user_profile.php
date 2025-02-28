<?php
require_once '../includes/db.php';
require_once '../includes/header.php';
if (!isset($_SESSION['id'])) {
    header("Location: ../auth/user_login.php");
    exit();
}
$user_id = $_SESSION['id'];
$selectQ = "SELECT username, email, phone, address, created_at FROM users WHERE user_id = $user_id";
$res = mysqli_query($conn, $selectQ);
$user = mysqli_fetch_array($res);

?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Profile</title>
        <link rel="stylesheet" href="../css/profile_style.css">
        <link rel="stylesheet" href="../css/home_style.css">
    </head>

    <body>

        <section class="profile-container">
            <div class="profile-header">
                <h2>Welcome, <?php echo htmlspecialchars($user['username']); ?> !</h2>
                <p>Member since: <?php echo date("d M, Y", strtotime($user['created_at'])); ?></p>
            </div>

            <div class="profile-content">
                <div class="profile-info">
                    <h3>Account Information</h3>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                    <p><strong>Phone:</strong> <?php echo htmlspecialchars($user['phone']); ?></p>
                    <p><strong>Address:</strong> <?php echo htmlspecialchars($user['address']); ?></p>
                </div>

                <div class="account-settings">
                    <h3>Account Settings</h3>
                    <ul>
                        <form method="post">
                            <li><a href="#">Edit Profile</a></li>
                            <li><a href="../auth/update_password.php" name="pass">Change Password</a></li>
                            <li><a href="#">Manage Addresses</a></li>
                            <li><a href="#">Payment Methods</a></li>
                            <li><a href="../logout.php">Logout</a></li>
                        </form>
                    </ul>
                </div>
            </div>
        </section>

    </body>

</html>