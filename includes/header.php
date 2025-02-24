<?php
define("BASE_URL", "http://localhost/sphatikv2/");
?>

<header class="header">
    <div class="container">
        <a href="<?= BASE_URL ?>/index.php" class="logo">Sphatik</a>
        <nav class="nav">
            <button class="mobile-menu-btn">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <ul class="nav-list">
                <li class="lsit-item"><a href="<?= BASE_URL ?>home.php" style="text-decoration: none;">Home</a></li>
                <li class="lsit-item"><a href="<?= BASE_URL ?>courses.php">Courses</a></li>
                <li class="lsit-item"><a href="<?= BASE_URL ?>freelance.php">Freelance</a></li>
                <li class="lsit-item"><a href="<?= BASE_URL ?>local_services.php">Local Services</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="lsit-item"><a href="<?= BASE_URL ?>profile.php">Profile</a></li>
                    <li class="lsit-item"><a href="<?= BASE_URL ?>logout.php">Logout</a></li>
                <?php else: ?>
                    <li class="lsit-item"><a href="<?= BASE_URL ?>logout.php" class="btn btn-login">Logout</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>
<script src="js/home_js.js"></script>