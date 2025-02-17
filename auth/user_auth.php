<?php
// db.php
$conn = new mysqli("localhost", "root", "", "sphatik_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>