<?php
session_start();
include './includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $freelancer_id = $_POST['freelancer_id'];

    $stmt = $conn->prepare("INSERT INTO freelancer_contacts (freelancer_id, name, email, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $freelancer_id, $name, $email, $message);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = 'Message sent successfully!';
        header('Location: freelance.php');
        exit();
    } else {
        $_SESSION['error_message'] = 'Error sending message. Please try again.';
        header('Location: contact_freelancer.php?freelancer_id=' . $freelancer_id);
        exit();
    }
}

// Fetch freelancers from the database
$query = "SELECT id, name FROM freelancers";
$result = $conn->query($query);

$selected_freelancer = isset($_GET['freelancer_id']) ? $_GET['freelancer_id'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Freelancer</title>
    <link rel="stylesheet" href="freelance_styles.css">
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
        select,
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

        .message {
            color: green;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .error {
            color: red;
            font-weight: bold;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Contact a Freelancer</h2>
        <?php
        if (isset($_SESSION['success_message'])) {
            echo '<p class="message">' . $_SESSION['success_message'] . '</p>';
            unset($_SESSION['success_message']);
        }
        if (isset($_SESSION['error_message'])) {
            echo '<p class="error">' . $_SESSION['error_message'] . '</p>';
            unset($_SESSION['error_message']);
        }
        ?>
        <form method="POST" action="contact_freelance.php">
            <label for="freelancer_id">Select Freelancer:</label>
            <select name="freelancer_id" required>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <option value="<?php echo $row['id']; ?>" <?php echo ($row['id'] == $selected_freelancer) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($row['name']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <label for="name">Your Name:</label>
            <input type="text" name="name" required value="<?php echo $_SESSION["username"] ?>">
            <label for="email">Your Email:</label>
            <input type="email" name="email" required>
            <label for="message">Message:</label>
            <textarea name="message" required></textarea>
            <button type="submit">Send Message</button>
        </form>
    </div>
</body>

</html>