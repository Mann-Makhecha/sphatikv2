<?php
session_start();
session_destroy();
setcookie("id", $id, time() + (86400 * 0), "/");
setcookie("type", "member", time() + (86400 * 0), "/");
header("Location:../index.php");
exit();
?>