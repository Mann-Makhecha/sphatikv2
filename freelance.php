<?php
include './includes/db.php';
include 'includes/header.php';
// Fetch freelancers from the database
$query = "SELECT id, name, expertise, profile_image, contact_link,rating FROM freelancers";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Freelancers</title>
        <link rel="stylesheet" href="<?= BASE_URL ?>css/freelance.css">
        <link rel="stylesheet" href="./css/index.css">
    </head>

    <body>

        <section class="freelancers-page">
            <div class="freelance-container">
                <h1>Top Freelancers</h1>
                <div class="freelancers-grid">
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="freelancer-card">
                            <img src="<?php echo htmlspecialchars($row['profile_image']); ?>" alt="Freelancer Profile">
                            <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                            <p>Expertise: <?php echo htmlspecialchars($row['expertise']); ?></p>

                            <!-- Display Star Rating -->
                            <div class="rating">
                                <p>Rating:
                                    <?php
                                    $rating = round($row['rating']); // Round rating to nearest whole number
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $rating) {
                                            echo '<span class="star filled">&#9733;</span>';
                                        } else {
                                            echo '<span class="star">&#9734;</span>';
                                        }
                                    }
                                    ?>
                                </p>
                            </div>

                            <!-- <a href="<?= BASE_URL ?>pages/contact_freelance.php?freelancer_id=<?php echo $row['id']; ?>"
                                class="btn">Contact Freelancer</a> -->
                            <a href="#" onclick="alert('This feature will be available soon')" class="btn">Contact
                                Freelancer</a>
                        </div>
                    <?php endwhile; ?>

                </div>
            </div>
        </section>

        <?php include './includes/footer.php'; ?>
    </body>

</html>