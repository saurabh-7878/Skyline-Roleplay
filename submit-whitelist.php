<?php
session_start();
$discord_user = $_SESSION['discord_user'] ?? null;

if (!$discord_user) {
    header("Location: discord-login.php");
    exit;
}

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "gtarp";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id    = $discord_user['id'];
$fullname   = $_POST['fullname'];
$discord    = $_POST['discord'];
$age        = $_POST['age'];
$charname   = $_POST['charname'];
$background = $_POST['background'];
$reason     = $_POST['why'];
$experience = $_POST['experience'];
$rules      = $_POST['rules'];

// Check if the user already applied
$check_sql = "SELECT status FROM whitelist_applications WHERE user_id = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("s", $user_id);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if ($check_result->num_rows > 0) {
    $row = $check_result->fetch_assoc();

    if ($row['status'] === 'rejected') {
        // Update application if previously rejected
        $update_sql = "UPDATE whitelist_applications SET fullname=?, discord=?, age=?, charname=?, background=?, reason=?, experience=?, rules=?, status='pending' WHERE user_id=?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("ssissssss", $fullname, $discord, $age, $charname, $background, $reason, $experience, $rules, $user_id);
    } else {
        echo "<script>alert('You have already submitted an application. Please wait for the result.'); window.location.href='dashboard.php';</script>";
        exit;
    }
} else {
    // New application
    $insert_sql = "INSERT INTO whitelist_applications (user_id, fullname, discord, age, charname, background, reason, experience, rules, status)
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')";
    $stmt = $conn->prepare($insert_sql);
    $stmt->bind_param("ssssissss", $user_id, $fullname, $discord, $age, $charname, $background, $reason, $experience, $rules);
}

if ($stmt->execute()) {
    echo "<script>alert('Application submitted successfully!'); window.location.href='dashboard.php';</script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
