<?php
session_start();
include 'config.php';

$_SESSION['form_data'] = [
    'name' => $_POST['name'],
    'email' => $_POST['email']
];

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = $_POST['password'];
$confirm = $_POST['confirm'];

if ($password !== $confirm) {
    $_SESSION['error'] = "Passwords do not match!";
    header("Location: ../register.php");
    exit;
}

$check_email = $conn->prepare("SELECT email FROM users WHERE email = ?");
$check_email->bind_param("s", $email);
$check_email->execute();
$check_email->store_result();

if ($check_email->num_rows > 0) {
    $_SESSION['error'] = "Email already registered!";
    header("Location: ../register.php");
    exit;
}
$check_email->close();

$stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $password);

if ($stmt->execute()) {
    unset($_SESSION['form_data']);
    $_SESSION['success'] = "Registration successful!";
} else {
    $_SESSION['error'] = "Registration failed. Please try again.";
}

$stmt->close();
$conn->close();

header("Location: ../register.php");
exit;
?>