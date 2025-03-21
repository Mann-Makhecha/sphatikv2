<?php
define("BASE_URL", "http://localhost/sphatikv2/");
session_start();
if (isset($_SESSION['type'])) {
    $tbl_name = $_SESSION['type'] === "member" ? "members" : "users";
    $id_name = $_SESSION['type'] === "member" ? "mem_id" : "user_id";
}
?>

<link rel="stylesheet" href="<?= BASE_URL ?>/css/home_style.css">
<style>
    :root {
        --primary-color: #238636;
        --secondary-color: #2ea043;
        --text-color: #c9d1d9;
        --bg-dark: #0d1117;
        --bg-darker: #010409;
        --bg-light: #161b22;
        --border-color: #30363d;
        --link-color: #58a6ff;
        --header-color: #f0f6fc;
        --muted-text: #8b949e;
        --light-gray: #30363d;
        --white: #f0f6fc;
        --error-bg: #f8d7da;
        --error-text: #721c24;
        --error-border: #f5c6cb;
    }
</style>