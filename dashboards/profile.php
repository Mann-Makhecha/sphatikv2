<?php
require_once '../includes/db.php';
require_once '../includes/header.php';
if (!isset($_SESSION['id'])) {
    header("Location:../auth/select.php");
    exit();
}

$user_id = $_SESSION['id'];
$var = false;

// Fetch user details
if ($_SESSION['type'] === "member") {
    $selectQ = "SELECT username, email, phone, address, created_at, status, role FROM $tbl_name WHERE $id_name = $user_id";
} else {
    $selectQ = "SELECT username, email, phone, address, created_at FROM $tbl_name WHERE $id_name = $user_id";
}
$res = mysqli_query($conn, $selectQ);
$user = mysqli_fetch_array($res);

// Check instructor verification status
if ($user['role'] === "instructor") {
    $veriQuery = "SELECT mem_id FROM instructor_documents WHERE mem_id = $user_id";
    $ans = mysqli_query($conn, $veriQuery);
    if (mysqli_num_rows($ans) > 0) {
        $var = true;
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && !$var) {
    $uploads_dir = "D:/uploads/";
    if (!is_dir($uploads_dir)) {
        mkdir($uploads_dir, 0777, true);
    }

    $mem_id = $user_id;
    $doc_id = time();
    $college_name = mysqli_real_escape_string($conn, $_POST['college_name']);
    $designation = mysqli_real_escape_string($conn, $_POST['designation']);

    function uploadFile($fileKey)
    {
        global $uploads_dir;
        if (!isset($_FILES[$fileKey]) || $_FILES[$fileKey]['error'] !== UPLOAD_ERR_OK) {
            return null;
        }
        $file_tmp = $_FILES[$fileKey]["tmp_name"];
        $file_name = basename($_FILES[$fileKey]["name"]);
        $target_file = $uploads_dir . time() . "_" . $file_name;
        return move_uploaded_file($file_tmp, $target_file) ? $target_file : null;
    }

    $gov_id_proof = uploadFile('gov_id_proof');
    $qualification_proof = uploadFile('qualification_proof');
    $college_id_card = uploadFile('college_id_card');
    $employment_letter = uploadFile('employment_letter');
    $latest_payslip = uploadFile('latest_payslip');

    if ($gov_id_proof && $qualification_proof && $college_id_card && $employment_letter && $latest_payslip) {
        $sql = "INSERT INTO instructor_documents 
                (doc_id, mem_id, college_name, designation, gov_id_proof, qualification_proof, college_id_card, employment_letter, latest_payslip)
                VALUES ('$doc_id','$mem_id', '$college_name', '$designation', '$gov_id_proof', '$qualification_proof', '$college_id_card', '$employment_letter', '$latest_payslip')";
        $sql_up = "UPDATE members SET status = 'submitted' WHERE mem_id = $user_id";

        if (mysqli_query($conn, $sql)) {
            mysqli_query($conn, $sql_up);
            header("Location: profile.php?success=1"); // Redirect to prevent form resubmission
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "File upload failed.";
    }
    mysqli_close($conn);
}
?>

?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $user['username'] ?>'s Profile</title>
        <link rel="stylesheet" href="<?= BASE_URL ?>/css/profile_style.css">
        <link rel="stylesheet" href="<?= BASE_URL ?>/css/innerCourse.css">
        <link rel="stylesheet" href="<?= BASE_URL ?>/css/form2.css">
    </head>

    <body>
        <button class="mobile-button"><svg xmlns="http://www.w3.org/2000/svg" height="2.2rem" viewBox="0 -960 960 960"
                width="2.2rem" class="backSvg">
                <path d="m321-80-71-71 329-329-329-329 71-71 400 400L321-80Z" />
            </svg></button>
        <main class="myPage">
            <div class="sidebar">
                <h2>Dashboard</h2>
                <ul>
                    <li class="accountSett">Account Settings</li>
                    <?php if (($_SESSION['type'] === "member")) {
                        if ($user['status'] === "pending" && !$var) {
                            echo
                                "<li class='compProfile'><a href='#completeProfile'>Complete Profile</a></li>";
                        }
                        if ($user['status'] === "verified" && $user['role'] === "instructor") {
                            echo "
                                <li class='addCour'>ADD Course</li>";
                        }
                    

                    if ($user['status'] === "verified" && $user['role'] === "admin") {
                        echo "
                            <li class='addCour'><a href='admin.php'>GO TO ADMIN PANEL</a></li>";
                    }
                    }
                    ?>
                </ul>
            </div>
            <section class="profile-container" id="showProfile">
                <div class="profile-header">
                    <h2>Welcome, <?php echo htmlspecialchars($user['username']); ?> !</h2>
                    <p>Member since: <?php echo date("d M, Y", strtotime($user['created_at'])); ?></p>
                </div>

                <div class="profile-content">
                    <div class="profile-info">
                        <h3>Account Information</h3>
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                        <p><strong>Phone:</strong> <?php echo htmlspecialchars($user['phone']); ?></p>
                        <p><strong>Address:</strong> <?php echo htmlspecialchars($user['address']); ?></p>
                    </div>

                    <div class="account-settings">
                        <h3>Account Settings</h3>
                        <ul>
                            <form method="post">
                                <li><a href="#">Edit Profile</a></li>
                                <li><a href="<?= BASE_URL ?>/auth/update_password.php" name="pass">Change Password</a>
                                </li>
                                <li><a href="#">Manage Addresses</a></li>
                                <li><a href="#">Payment Methods</a></li>
                                <li><a href="<?= BASE_URL ?>auth/logout.php">Logout</a></li>
                            </form>
                        </ul>
                    </div>
                </div>
            </section>
            <section class="form-container hide" id="completeProfile">
                <h2 class="compProH2">Instructor Verification</h2>
                <form method="post" enctype="multipart/form-data" class="file-form">
                    <input type="hidden" name="mem_id" value="1">

                    <input type="text" name="college_name" placeholder="College Name" required>
                    <input type="text" name="designation" placeholder="Designation (Professor, Lecturer, etc.)"
                        required><br>

                    <label>Government ID Proof:</label>
                    <input class="file-upload" type="file" name="gov_id_proof" required><br>

                    <label>Educational Qualification Proof:</label>
                    <input class="file-upload" type="file" name="qualification_proof" required><br>

                    <label>College ID Card:</label><br>
                    <input class="file-upload" type="file" name="college_id_card" required><br>

                    <label>Employment Letter:</label>
                    <input class="file-upload" type="file" name="employment_letter" required><br>

                    <label>Latest Payslip:</label><br>
                    <input class="file-upload" type="file" name="latest_payslip" required><br>

                    <button type="submit" class="subit">Submit</button>
                </form>
            </section>
        </main>
        <script src="<?= BASE_URL ?>js/profile.js">
        </script>
    </body>

</html>