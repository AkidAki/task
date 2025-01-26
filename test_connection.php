<?php
$servername = "localhost";
$username = "root"; // Default username for XAMPP or WAMP
$password = ""; // Default password (leave blank for XAMPP)
$dbname = "task_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
