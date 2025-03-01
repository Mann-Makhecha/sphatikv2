<?php
session_start();
session_destroy();
unset($_COOKIE);
header("Location:index.php");
exit();
?>