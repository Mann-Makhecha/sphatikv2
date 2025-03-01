<?php
require_once '../includes/db.php';
require_once '../includes/header.php';
if (!isset($_SESSION['id'])) {
    header("Location:../auth/select.php");
    exit();
}
$user_id = $_SESSION['id'];
if ($_SESSION['type'] === "member") {
    $selectQ = "SELECT username, email, phone, address, created_at,status FROM $tbl_name WHERE $id_name = $user_id";
} else {
    $selectQ = "SELECT username, email, phone, address, created_at FROM $tbl_name WHERE $id_name = $user_id";
}
$res = mysqli_query($conn, $selectQ);
if ($res) {
    $user = mysqli_fetch_array($res);
} else {
    echo "faied";
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $user['username'] ?>'s Profile</title>
        <link rel="stylesheet" href="<?= BASE_URL ?>/css/profile_style.css">
        <link rel="stylesheet" href="<?= BASE_URL ?>/css/innerCourse.css">
    </head>

    <body>
        <button class="mobile-button"><svg xmlns="http://www.w3.org/2000/svg" height="2.2rem" viewBox="0 -960 960 960"
                width="2.2rem" class="backSvg">
                <path d="m321-80-71-71 329-329-329-329 71-71 400 400L321-80Z" />
            </svg></button>
        <main class="myPage">
            <div class="sidebar">
                <h2>Settings</h2>
                <ul>
                    <li>Account Settings</li>
                    <?php if (($_SESSION['type'] === "member")) {
                        if ($user['status'] === "pending") {
                            echo
                                "<li>Complete Profile</li>";
                        } else {
                            echo "
                    <li>ADD Course</li>";
                        }
                    }
                    ?>
                </ul>
            </div>
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
                                <li><a href="<?= BASE_URL ?>/auth/update_password.php" name="pass">Change Password</a>
                                </li>
                                <li><a href="#">Manage Addresses</a></li>
                                <li><a href="#">Payment Methods</a></li>
                                <li><a href="<?= BASE_URL ?>auth/logout.php">Logout</a></li>
                            </form>
                        </ul>
                    </div>
                </div>
            </section>
            <section>

            </section>
        </main>
        <script>
            const sidebar = document.querySelector(".sidebar");
            const mobileButton = document.querySelector(".mobile-button");

            mobileButton.addEventListener("click", () => {
                sidebar.classList.toggle("s-active");
                mobileButton.classList.toggle("m-active");
            });
        </script>
    </body>

</html>