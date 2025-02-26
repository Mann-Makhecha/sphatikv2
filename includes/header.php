<?php
define("BASE_URL", "http://localhost/sphatikv2/");
session_start();
if (isset($_SESSION['type'])) {
    $profile_url = $_SESSION['type'] === "member" ? "dashboards/member.php" : "dashboards/user_profile.php";
}
?>
<link rel="stylesheet" href="<?= BASE_URL ?>/css/header.css">
<header class="header">
    <div class="container">
        <a href="<?= BASE_URL ?>index.php" class="logo">Sphatik</a>
        <nav class="nav">
            <button class="mobile-menu-btn">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <ul class="nav-list">
                <li class="list-item"><a href="<?= BASE_URL ?>courses.php">Courses</a></li>
                <li class="list-item"><a href="<?= BASE_URL ?>freelance.php">Freelance</a></li>
                <li class="list-item"><a href="<?= BASE_URL ?>local_services.php">Local Services</a></li>
                <?php if (isset($_SESSION['id'])): ?>
                    <li class="list-item"><a href="<?= BASE_URL . $profile_url ?>">
                            <svg class="profile" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" height="2rem"
                                width="2rem"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path
                                    d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z" />
                            </svg></a></li>
                <?php else: ?>
                    <li class="list-item"><a href="<?= BASE_URL ?>select.php" class="btn btn-login" style="color:#fff;">Log
                            in / Sign
                            up</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>
<script src="<?php echo BASE_URL ?>js/home_js.js"></script>