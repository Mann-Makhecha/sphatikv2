<?php
include './includes/db.php';
include 'includes/header.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
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
$query = "SELECT id, name, description, icon, service_link FROM services";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Local Services</title>
        <link rel="stylesheet" href="<?= BASE_URL ?>css/services.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="stylesheet" href="./css/home_style.css">
    </head>

    <body>

        <section class="services">
            <div class="container">
                <h1>Available Services</h1>
                <div class="services-grid">
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="service-card">
                            <i class="<?php echo htmlspecialchars($row['icon']); ?>"></i>
                            <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                            <p><?php echo htmlspecialchars($row['description']); ?></p>

                            <!-- <a href="book_service.php?service_id=<?php echo $row['id']; ?>" class="btn">Book Now</a> -->
                            <a href="#" onclick="alert('This feature will be available soon')" class="btn">Book Now</a>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>



        <?php include 'includes/footer.php'; ?>
    </body>

</html>