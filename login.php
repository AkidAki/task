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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login or Signup</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 300px;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: crimson;
        }
        .form-container form {
            display: flex;
            flex-direction: column;
        }
        .form-container label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-container input, .form-container select {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }
        .form-container button {
            background: crimson;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
        }
        .form-container button:hover {
            background: darkred;
        }
        .form-container .link {
            text-align: center;
            margin-top: 10px;
        }
        .form-container .link a {
            text-decoration: none;
            color: crimson;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Login</h2>
    <form action="login_handler.php" method="POST">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <label for="role">Login As</label>
        <select id="role" name="role" required>
            <option value="manager">Manager</option>
            <option value="employee">Employee</option>
        </select>

        <button type="submit">Login</button>
    </form>
    <div class="link">
        <p>Don't have an account? <a href="sign_up.php">Sign up here</a></p>
    </div>
</div>

</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
