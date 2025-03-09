<?php
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $expertise = $_POST['expertise'];
    $profile_image = $_POST['profile_image'];
    $contact_link = $_POST['contact_link'];

    $stmt = $conn->prepare("INSERT INTO freelancers (name, expertise, profile_image, contact_link) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $expertise, $profile_image, $contact_link);

    if ($stmt->execute()) {
        echo "<script>alert('Freelancer added successfully!'); window.location.href='freelance.php';</script>";
    } else {
        echo "<script>alert('Error adding freelancer'); window.history.back();</script>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Freelancer</title>
        <link rel="stylesheet" href="./css/addform.css">
    </head>

    <body>
        <? include 'includes/mem_head.php'; ?>
        <div class="container">
            <h2>Add a Freelancer</h2>
            <form method="POST" action="add_freelancer.php">
                <label for="name">Freelancer Name:</label>
                <input type="text" name="name" required>

                <label for="expertise">Expertise:</label>
                <input type="text" name="expertise" required>

                <label for="profile_image">Profile Image URL:</label>
                <input type="text" name="profile_image" required>

                <label for="contact_link">Contact Link:</label>
                <input type="text" name="contact_link" required>

                <button type="submit">Add Freelancer</button>
            </form>
        </div>
    </body>

</html>