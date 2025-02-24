<?php
session_start();
include './includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $icon = $_POST['icon'];
    $service_link = $_POST['service_link'];

    $stmt = $conn->prepare("INSERT INTO services (name, description, icon, service_link) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $description, $icon, $service_link);

    if ($stmt->execute()) {
        echo "<script>alert('Service added successfully!'); window.location.href='local_services.php';</script>";
    } else {
        echo "<script>alert('Error adding service'); window.history.back();</script>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Local Service</title>
    <link rel="stylesheet" href="./css/addform.css">
</head>

<body>
    <? include './includes/mem_head.php'; ?>
    <div class="container">
        <h2>Add a Local Service</h2>
        <form method="POST" action="add_local.php">
            <label for="name">Service Name:</label>
            <input type="text" name="name" required>

            <label for="description">Description:</label>
            <textarea name="description" required></textarea>

            <label for="icon">Icon Class (e.g., fas fa-tools):</label>
            <input type="text" name="icon" required>

            <label for="service_link">Service Link:</label>
            <input type="text" name="service_link" required>

            <button type="submit">Add Service</button>
        </form>
    </div>
</body>

</html>