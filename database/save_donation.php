<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verify login
if (!isset($_SESSION['name'])) {
    header("Location: ./login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "donation");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$full_name = $_POST['full_name'] ?? '';
$dob = $_POST['dob'] ?? '';
$gender = $_POST['gender'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$blood_type = $_POST['blood_type'] ?? NULL;  // Optional field
$donation_type = $_POST['donation_type'] ?? '';

// Process organs selection
$organs = '';
if (isset($_POST['organs'])) {
    if (is_array($_POST['organs'])) {
        $organs = implode(", ", $_POST['organs']);
    } else {
        $organs = 'All organs and tissues';
    }
}

// Prepare and execute SQL
$sql = "INSERT INTO donors (
    name, dob, gender, email, phone, 
    blood_type, donation_type, organs
) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

// Create variables to bind
$bind_blood_type = $blood_type;
$bind_organs = $organs;

$stmt->bind_param(
    "ssssssss",
    $full_name,
    $dob,
    $gender,
    $email,
    $phone,
    $bind_blood_type,
    $donation_type,
    $bind_organs
);

if ($stmt->execute()) {
    header("Location: ../dregistration.php?success=true");
    exit();
} else {
    header("Location: ../dregistration.php?error=" . urlencode($stmt->error));
    exit();
}

$stmt->close();
$conn->close();
?>