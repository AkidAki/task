<?php
$servername = "localhost:3307";
$username = "root"; 
$password = ""; 
$dbname = "task_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM MANAGER";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Homepage</title>
    <link rel="stylesheet" href="styles.css"> 
    <style>
        body {
            background: url('images/background.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            color: black; 
        }
    </style>
</head>
<body>
<div class="container">
    <div class="nav-bar">
        <h1 class="title">Cala<span>brio</span></h1>
        <ul class="menu">
            <li><a href="manager.php">Home</a></li>
            <li><a href="manage_accounts.php">Manage Account</a></li>
            <li><a href="assignTask.php">Manage Tasks</a></li>
            <li><a href="managerlogin.php">Logout</a></li>
        </ul>
    </div>

    <div class="home">
        <h2 class="title-1">Welcome, Manager</h2>
        <p>Here are the details of managers:</p>
        <table border="1" style="width: 100%; color: white;">
            <tr style="background-color: black;">
                <th>Manager ID</th>
                <th>Department</th>
                <th>Name</th>
                <th>Email</th>
                <th>Hire Date</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["MANAGER_ID"] . "</td>";
                    echo "<td>" . $row["DEPARTMENT"] . "</td>";
                    echo "<td>" . $row["MANAGER_NAME"] . "</td>";
                    echo "<td>" . $row["EMAIL"] . "</td>";
                    echo "<td>" . $row["HIRE_DATE"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No managers found</td></tr>";
            }
            ?>
        </table>
    </div>
</div>
</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
