<?php
$servername = "localhost:3307";
$username = "root"; 
$password = ""; 
$dbname = "task_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM employee";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Homepage</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            background: url('images/background.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            color: white; 
        }
    </style>
</head>
<body>
<div class="container">
    <div class="nav-bar">
        <h1 class="title">Cala<span>brio</span></h1>
        <ul class="menu">
            <li><a href="employee.php">Home</a></li>
            <li><a href="TaskIndex.php">My Tasks</a></li>
            <li><a href="TaskIndex.php">Update Tasks</a></li>
            <li><a href="employeelogin.php">Logout</a></li>
        </ul>
    </div>

    <div class="home">
        <h2 class="title-1">Welcome, Employee</h2>
        <p>Here are the details of employees:</p>
        <table border="1" style="width: 100%; color: white;">
            <tr style="background-color: crimson;">
                <th>Employee ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Job Title</th>
                <th>Hire Date</th>
                <th>Manager ID</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["EMPLOYEE_ID"] . "</td>";
                    echo "<td>" . $row["EMPLOYEE_NAME"] . "</td>";
                    echo "<td>" . $row["EMAIL"] . "</td>";
                    echo "<td>" . $row["JOB_TITLE"] . "</td>";
                    echo "<td>" . $row["HIRE_DATE"] . "</td>";
                    echo "<td>" . $row["MANAGER_ID"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No employees found</td></tr>";
            }
            ?>
        </table>
    </div>
</div>
</body>
</html>

<?php
$conn->close();
?>
