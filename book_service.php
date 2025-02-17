<?php
session_start();
include './auth/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id']; // Unique user ID from session
    $service_id = $_POST['service_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    
    $stmt = $conn->prepare("INSERT INTO service_bookings (user_id, service_id, name, email, phone, address) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iissss", $user_id, $service_id, $name, $email, $phone, $address);
    
    if ($stmt->execute()) {
        echo "<script>alert('Service booked successfully!'); window.location.href='local_services.php';</script>";
    } else {
        echo "<script>alert('Error booking service'); window.history.back();</script>";
    }
    
    $stmt->close();
}

// Fetch services from the database
$query = "SELECT id, name FROM services";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Service</title>
    <link rel="stylesheet" href="./css/service_book.css">
</head>
<body>
    <div class="container">
        <h2>Book a Service</h2>
        <form method="POST" action="book_service.php">
            <label for="service_id">Select Service:</label>
            <select name="service_id" required>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['name']); ?></option>
                <?php endwhile; ?>
            </select>
            <label for="name">Your Name:</label>
            <input type="text" name="name" required>
            <label for="email">Your Email:</label>
            <input type="email" name="email" required>
            <label for="phone">Phone Number:</label>
            <input type="text" name="phone" required>
            <label for="address">Address:</label>
            <textarea name="address" required></textarea>
            <button type="submit">Book Now</button>
        </form>
    </div>
</body>
</html>
