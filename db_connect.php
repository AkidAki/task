<?php
$servername = "localhost"; // Or your server address
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "task_management"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
