<?php
require_once '../includes/db.php';
require_once '../includes/header.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_POST['message']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p style='color: red;'>Invalid email format.</p>";
    } else {
        $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);

        if ($stmt->execute()) {
            echo "<p style='color: green;'>Message sent successfully!</p>";
        } else {
            echo "<p style='color: red;'>Error: " . $stmt->error . "</p>";
        }
        $stmt->close();
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?= BASE_URL ?>/css/form.css">
        <title>Contact Us</title>
        <style>
            form {
                margin-top: 3rem;
                background: var(--bg-light);
                padding: 20px;
                border-radius: 10px;
                max-width: 500px;
                margin: 20px auto;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                border: 1px solid var(--border-color);
            }

            h2 {
                color: var(--header-color);
                text-align: center;
            }

            label {
                color: var(--text-color);
                font-weight: bold;
                display: block;
                margin-top: 10px;
            }

            input,
            textarea {
                width: 100%;
                padding: 10px;
                margin-top: 5px;
                border: 1px solid var(--border-color);
                border-radius: 5px;
                background: var(--bg-dark);
                color: var(--text-color);
                font-size: 1rem;
            }

            input:focus,
            textarea:focus {
                border-color: var(--primary-color);
                outline: none;
                box-shadow: 0 0 5px var(--primary-color);
            }

            button {
                width: 100%;
                padding: 10px;
                margin-top: 15px;
                border: none;
                border-radius: 5px;
                background: var(--primary-color);
                color: var(--white);
                font-size: 1rem;
                cursor: pointer;
                transition: background 0.3s;
            }

            button:hover {
                background: var(--secondary-color);
            }

            @media (max-width: 600px) {
                form {
                    width: 90%;
                    padding: 15px;
                }
            }
        </style>
    </head>

    <body>
        <form method="POST">
            <h2>Contact Us</h2>

            <label>Name:</label>
            <input type="text" name="name" required>
            <br>
            <label>Email:</label>
            <input type="email" name="email" required>
            <br>
            <label>Message:</label>
            <textarea name="message" rows="4" required></textarea>
            <br>
            <button type="submit">Submit</button>
        </form>
    </body>

</html>
<?php
require_once '../includes/footer.php';
?>