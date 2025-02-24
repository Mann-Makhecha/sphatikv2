<?php
session_start();
include './includes/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: user_login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Area</title>
    <link rel="stylesheet" href="./css/home_style.css">
    <style>
        body {}
    </style>
</head>

<body>
    <?php include 'home.php'; ?>

    <section class="welcome-section">
        <div class="container">
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
            <p>This is your exclusive member area.</p>
            <a href="logout.php" class="btn">Logout</a>
        </div>
    </section>

    <?php include './includes/footer.php'; ?>
</body>

</html>