<?php
// Database connection
$host = "localhost:3307";
$username = "root";
$password = "";
$dbname = "task_management";
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle CRUD actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $job_title = $_POST['job_title'];
        $hire_date = $_POST['hire_date'];
        $username = $_POST['username'];
        $manager_id = $_POST['manager_id'];
        $sql = "INSERT INTO employee (EMPLOYEE_NAME, EMAIL, EMP_PASSWORD, JOB_TITLE, HIRE_DATE, EMPLOYEE_USERNAME, MANAGER_ID) 
                VALUES ('$name', '$email', '$password', '$job_title', '$hire_date', '$username', '$manager_id')";
        $conn->query($sql);
    } elseif (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $job_title = $_POST['job_title'];
        $hire_date = $_POST['hire_date'];
        $username = $_POST['username'];
        $manager_id = $_POST['manager_id'];
        $sql = "UPDATE employee SET EMPLOYEE_NAME='$name', EMAIL='$email', JOB_TITLE='$job_title', 
                HIRE_DATE='$hire_date', EMPLOYEE_USERNAME='$username', MANAGER_ID='$manager_id' WHERE EMPLOYEE_ID=$id";
        $conn->query($sql);
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM employee WHERE EMPLOYEE_ID=$id";
        $conn->query($sql);
    }
}

// Search logic
$search_name = "";
if (isset($_GET['search'])) {
    $search_name = $_GET['search_name'];
    $result = $conn->query("SELECT * FROM employee WHERE EMPLOYEE_NAME LIKE '%$search_name%'");
} else {
    $result = $conn->query("SELECT * FROM employee");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Employees</title>
    <link rel="stylesheet" href="manageAccount_style.css"> <!-- Link to the external stylesheet -->
</head>
<body>
    <h1>Manage Employees</h1>

    <!-- Go to Homepage Button -->
    <button onclick="window.location.href='manager.php'">Go to Homepage</button>

    <!-- Search Form -->
    <div class="search-bar">
        <form method="GET">
            <input type="text" name="search_name" placeholder="Search by Name" value="<?php echo htmlspecialchars($search_name); ?>">
            <button type="submit" name="search">Search</button>
        </form>
    </div>

    <!-- Subtitle -->
    <h2>Add Employee</h2>

    <!-- Add Employee Form -->
    <form method="POST">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="job_title" placeholder="Job Title" required>
        <input type="date" name="hire_date" placeholder="Hire Date" required>
        <input type="text" name="username" placeholder="Username" required>
        <input type="text" name="manager_id" placeholder="Manager ID" required>
        <button type="submit" name="create">Add Employee</button>
    </form>

    <!-- Employee Table -->
    <table>
        <tr>
            <th>EMPLOYEE_ID</th>
            <th>EMPLOYEE_NAME</th>
            <th>EMAIL</th>
            <th>JOB_TITLE</th>
            <th>HIRE_DATE</th>
            <th>EMPLOYEE_USERNAME</th>
            <th>MANAGER_ID</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['EMPLOYEE_ID']; ?></td>
            <td><?php echo $row['EMPLOYEE_NAME']; ?></td>
            <td><?php echo $row['EMAIL']; ?></td>
            <td><?php echo $row['JOB_TITLE']; ?></td>
            <td><?php echo $row['HIRE_DATE']; ?></td>
            <td><?php echo $row['EMPLOYEE_USERNAME']; ?></td>
            <td><?php echo $row['MANAGER_ID']; ?></td>
            <td>
                <!-- Update Form -->
                <form method="POST" style="display: inline;">
                    <input type="hidden" name="id" value="<?php echo $row['EMPLOYEE_ID']; ?>">
                    <input type="text" name="name" value="<?php echo $row['EMPLOYEE_NAME']; ?>" placeholder="Name" required>
                    <input type="email" name="email" value="<?php echo $row['EMAIL']; ?>" placeholder="Email" required>
                    <input type="text" name="job_title" value="<?php echo $row['JOB_TITLE']; ?>" placeholder="Job Title" required>
                    <input type="date" name="hire_date" value="<?php echo $row['HIRE_DATE']; ?>" required>
                    <input type="text" name="username" value="<?php echo $row['EMPLOYEE_USERNAME']; ?>" placeholder="Username" required>
                    <input type="text" name="manager_id" value="<?php echo $row['MANAGER_ID']; ?>" placeholder="Manager ID" required>
                    <button type="submit" name="update">Update</button>
                </form>

                <!-- Delete Form -->
                <form method="POST" style="display: inline;">
                    <input type="hidden" name="id" value="<?php echo $row['EMPLOYEE_ID']; ?>">
                    <button type="submit" name="delete" style="background-color: red; color: white;">Delete</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
