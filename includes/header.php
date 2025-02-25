<?php
define("BASE_URL", "http://localhost/sphatikv2/");
session_start();
?>

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
                    <li class="list-item"><a href="<?= BASE_URL ?>profile.php">Profile</a></li>
                    <li class="list-item"><a href="<?= BASE_URL ?>logout.php">Logout</a></li>
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