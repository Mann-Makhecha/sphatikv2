<?php
session_start();
include './includes/db.php';

// Fetch courses from the database
$query = "SELECT id, title, description, image, enroll_link FROM courses";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Courses</title>
        <link rel="stylesheet" href="./css/course_style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="stylesheet" href="./css/home_style.css">
    </head>

    <body>
        <?php include 'includes/header.php'; ?>

        <section class="courses-page">
            <div class="container">
                <h1>Available Courses</h1>
                <div class="courses-grid">
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="course-card">
                            <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="Course Image">
                            <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                            <p><?php echo htmlspecialchars($row['description']); ?></p>
                            <!-- <a href="<?php echo htmlspecialchars($row['enroll_link']); ?>" class="btn"
                                target="_blank">Enroll
                                Now</a> -->
                            <a href="myCourse.php" class="btn" target="_blank">Enroll
                                Now</a>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>

        <?php include 'includes/footer.php'; ?>
    </body>

</html>