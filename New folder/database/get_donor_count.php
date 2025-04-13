<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "donation");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get total donor count
$result = $conn->query("SELECT COUNT(*) as total FROM donors");
$row = $result->fetch_assoc();
echo $row['total'];

$conn->close();
?>