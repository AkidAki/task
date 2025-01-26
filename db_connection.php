<?php
$host = "localhost:3307";
$user = "root";
$password = "";
$dbname = "task_management";

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
