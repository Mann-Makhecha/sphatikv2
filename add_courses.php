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
    <link rel="stylesheet" href="./css/course_form.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 400px;
            text-align: center;
        }

        h2 {
            color: #6d28d9;
        }

        label {
            display: block;
            text-align: left;
            margin-top: 10px;
            font-weight: bold;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            background-color: #6d28d9;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 15px;
            font-size: 16px;
            transition: background 0.3s;
        }

        button:hover {
            background-color: #5a1fb9;
        }
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