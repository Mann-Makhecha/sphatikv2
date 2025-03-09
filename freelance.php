<?php
include './includes/db.php';
include 'includes/header.php';
// Fetch freelancers from the database
$query = "SELECT id, name, expertise, profile_image, contact_link FROM freelancers";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Freelancers</title>
        <link rel="stylesheet" href="<?= BASE_URL ?>/css/freelance.css">
        <link rel="stylesheet" href="./css/home_style.css">
    </head>

    <body>

        <section class="freelancers-page">
            <div class="container">
                <h1>Top Freelancers</h1>
                <div class="freelancers-grid">
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="freelancer-card">
                            <img src="<?php echo htmlspecialchars($row['profile_image']); ?>" alt="Freelancer Profile">
                            <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                            <p>Expertise: <?php echo htmlspecialchars($row['expertise']); ?></p>
                            <a href="contact_freelance.php?freelancer_id=<?php echo $row['id']; ?>" class="btn">Contact
                                Freelancer</a>

                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>

        <?php include './includes/footer.php'; ?>
    </body>

</html>