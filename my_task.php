<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "task_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$employee_id = "E001";

// Fetch tasks assigned to the employee
$sql = "SELECT * FROM tasks WHERE ASSIGNED_TO = '$employee_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Tasks - Employee</title>
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
        .container {
            padding: 20px;
        }
        .nav-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            background: rgba(0, 0, 0, 0.5);
        }
        .nav-bar .title {
            color: crimson;
            font-size: 2rem;
            font-weight: bold;
        }
        .nav-bar .menu li {
            list-style: none;
            display: inline-block;
        }
        .nav-bar .menu li a {
            color: white;
            text-decoration: none;
            font-size: 1.2rem;
            margin-left: 20px;
            transition: all 0.3s ease;
        }
        .nav-bar .menu li a:hover {
            color: crimson;
            text-decoration: underline;
        }
        .home {
            padding: 30px;
            background: rgba(0, 0, 0, 0.6);
            border-radius: 10px;
            margin-top: 20px;
        }
        .title-1 {
            font-size: 2rem;
            color: crimson;
            font-weight: 600;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        table th, table td {
            padding: 15px;
            text-align: left;
            border: 1px solid white;
        }
        table th {
            background-color: crimson;
        }
        table tr:nth-child(even) {
            background-color: #333;
        }
        table tr:hover {
            background-color: #444;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="nav-bar">
        <h1 class="title">Cala<span>brio</span></h1>
        <ul class="menu">
            <li><a href="employee.php">Home</a></li>
            <li><a href="my_task.php">My Tasks</a></li> <!-- Link to My Tasks Page -->
            <li><a href="#">Update Tasks</a></li>
            <li><a href="#">Logout</a></li>
        </ul>
    </div>

    <div class="home">
        <h2 class="title-1">My Assigned Tasks</h2>
        <table>
            <tr style="background-color: crimson;">
                <th>Task ID</th>
                <th>Task Name</th>
                <th>Description</th>
                <th>Assigned Date</th>
                <th>Status</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["TASK_ID"] . "</td>";
                    echo "<td>" . $row["TASK_NAME"] . "</td>";
                    echo "<td>" . $row["TASK_DESCRIPTION"] . "</td>";
                    echo "<td>" . $row["ASSIGNED_DATE"] . "</td>";
                    echo "<td>" . $row["STATUS"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No tasks assigned</td></tr>";
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
