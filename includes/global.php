<?php
define("BASE_URL", "http://localhost/sphatikv2/");
session_start();
if (isset($_SESSION['type'])) {
    $tbl_name = $_SESSION['type'] === "member" ? "members" : "users";
    $id_name = $_SESSION['type'] === "member" ? "mem_id" : "user_id";
}
?>

<link rel="stylesheet" href="<?= BASE_URL ?>/css/home_style.css">