<?php
require_once '../includes/header.php';
require_once '../includes/db.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/innerCourse.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/admin.css">
</head>
<body>
<button class="mobile-button"><svg xmlns="http://www.w3.org/2000/svg" height="2.2rem" viewBox="0 -960 960 960"
                width="2.2rem" class="backSvg">
                <path d="m321-80-71-71 329-329-329-329 71-71 400 400L321-80Z" />
            </svg></button>
    <main><div class="sidebar">
                <h2>Course Modules</h2>
                <ul>
                    <li>Module 1</li>
                    <li>Module 2</li>
                    <li>Module 3</li>
                </ul>
            </div></main>
            <script src="<?= BASE_URL ?>js/profile.js">
        </script>
</body>
</html>