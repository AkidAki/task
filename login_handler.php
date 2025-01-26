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

// Get user input
$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];

// Validate user input (using prepared statements)
$sql = "SELECT * FROM users WHERE email = ? AND role = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $role);
$stmt->execute();
$result = $stmt->get_result();

// Check if a user exists with the provided credentials
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    // Verify the password using password_verify()
    if (password_verify($password, $user['password'])) {
        session_start();  // Start session to store user data
        $_SESSION['email'] = $email;
        $_SESSION['role'] = $role;

        // Redirect to the appropriate page based on the role
        if ($role == "manager") {
            header("Location: manager.php");
        } else if ($role == "employee") {
            header("Location: employee.php");
        }
        exit();  // Ensure the script stops after the redirection
    } else {
        // Invalid password
        echo "<script>alert('Incorrect password. Please try again.'); window.location.href='login.php';</script>";
    }
} else {
    // Invalid email or role
    echo "<script>alert('No user found with these credentials.'); window.location.href='login.php';</script>";
}

$stmt->close();
$conn->close();
?>
