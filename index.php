<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Sphatik</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .welcome {
            color: #6d28d9;
            font-size: 50px;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .role {
            color: #6d28d9;
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .links {
            display: flex;
            gap: 30px;
            margin-top: 20px;
            width: 90%;
            max-width: 1000px;
        }

        .box {
            flex: 1;
            padding: 60px;
            background: #6d28d9;
            color: #fff;
            text-decoration: none;
            border-radius: 25px;
            font-size: 28px;
            font-weight: bold;
            transition: 0.3s;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .box:hover {
            background: #5a21b0;
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }

        @media (max-width: 600px) {
            .links {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="welcome">Welcome to Sphatik</div>
        <div class="role"> Please select your role!</div>
        <div class="links">
            <a href="auth/user_login.php" class="box">User</a>
            <a href="auth/member_login.php" class="box">Member</a>
        </div>
    </div>
</body>

</html>