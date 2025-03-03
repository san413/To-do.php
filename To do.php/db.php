<?php
$host = "localhost"; // Change if needed
$user = "root"; // Default user in XAMPP
$password = ""; // Leave empty for XAMPP
$database = "task_manager"; // Your database name

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
