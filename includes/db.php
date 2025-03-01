<?php
$conn = new mysqli("localhost", "root", "", "sphatik");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>