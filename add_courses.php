<?php
session_start();
include './includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_POST['image'];
    $enroll_link = $_POST['enroll_link'];

    $stmt = $conn->prepare("INSERT INTO courses (title, description, image, enroll_link) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $description, $image, $enroll_link);

    if ($stmt->execute()) {
        echo "<script>alert('Course added successfully!'); window.location.href='courses.php';</script>";
    } else {
        echo "<script>alert('Error adding course'); window.history.back();</script>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
    <link rel="stylesheet" href="./css/addform.css">
    <style>
    </style>
</head>

<body>
    <? include 'includes/mem_head.php'; ?>
    <div class="container">
        <h2>Add a New Course</h2>
        <form method="POST" action="add_courses.php">
            <label for="title">Course Title:</label>
            <input type="text" name="title" required>

            <label for="description">Description:</label>
            <textarea name="description" required></textarea>

            <label for="image">Image URL:</label>
            <input type="text" name="image" required>

            <label for="enroll_link">Enroll Link:</label>
            <input type="text" name="enroll_link" required>

            <button type="submit">Add Course</button>
        </form>
    </div>
</body>

</html>