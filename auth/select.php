<?php
require_once '../includes/global.php';
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome to Sphatik</title>
        <link rel="stylesheet" href="<?= BASE_URL ?>css/select_style.css">
    </head>

    <body>
        <div class="container">
            <div class="welcome">Welcome to Sphatik</div>
            <div class="role"> Please select your role!</div>
            <div class="links">
                <a href="user_login.php" class="box">User</a>
                <a href="member_login.php" class="box">Member</a>
            </div>
        </div>
    </body>

</html>