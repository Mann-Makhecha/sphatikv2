<?php
define("BASE_URL", "http://localhost/sphatikv2/");
session_start();
if (isset($_SESSION['type'])) {
    $profile_url = $_SESSION['type'] === "member" ? "dashboards/member.php" : "dashboards/user_profile.php";
}
?>