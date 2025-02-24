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
    <link rel="stylesheet" href="./css/service_form.css">
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