<?php
// Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "task_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
$role = $_POST['role'];

// Insert user into database
$sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $email, $password, $role);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "<script>alert('User successfully registered!'); window.location.href='login.php';</script>";
} else {
    echo "<script>alert('Error during registration. Please try again.'); window.location.href='signup.php';</script>";
}

$stmt->close();
$conn->close();
?>
