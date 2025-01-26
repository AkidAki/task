<?php 
// Database connection
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "task_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submissions for adding a new employee
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_employee'])) {
    $employee_name = $_POST['employee_name'];
    $email = $_POST['email'];
    $job_title = $_POST['job_title'];
    $hire_date = $_POST['hire_date'];

    $sql = "INSERT INTO employee (EMPLOYEE_NAME, EMAIL, JOB_TITLE, HIRE_DATE) VALUES (?, ?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssss", $employee_name, $email, $job_title, $hire_date);
        if ($stmt->execute()) {
            $message = "Employee added successfully!";
            $message_class = "success";
        } else {
            $message = "Error adding employee: " . $conn->error;
            $message_class = "error";
        }
        $stmt->close();
    } else {
        $message = "Error preparing statement: " . $conn->error;
        $message_class = "error";
    }
}

// Handle form submissions for task assignment
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['assign_task'])) {
    $employee_id = $_POST['employee_id'];
    $task_description = $_POST['task_description'];

    $sql = "INSERT INTO tasks (EMPLOYEE_ID, TASK_DESCRIPTION) VALUES (?, ?)";
    if ($stmt = $conn->prepare($sql)) // 
    {
        $stmt->bind_param("is", $employee_id, $task_description);
        if ($stmt->execute()) {
            $message = "Task assigned successfully!";
            $message_class = "success";
        } else {
            $message = "Error assigning task: " . $conn->error;
            $message_class = "error";
        }
        $stmt->close();
    } else {
        $message = "Error preparing statement: " . $conn->error;
        $message_class = "error";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Task</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('image/sample.jpeg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 50%;
            background: rgba(255, 255, 255, 0.1);
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 2rem;
            color: crimson;
        }
        .option-buttons {
            text-align: center;
        }
        .option-buttons button {
            padding: 10px 20px;
            background: crimson;
            color: #fff;
            border: none;
            border-radius: 5px;
            margin: 10px;
            cursor: pointer;
            font-size: 1rem;
            transition: 0.3s;
        }
        .option-buttons button:hover {
            background: #fff;
            color: crimson;
            border: 2px solid crimson;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 10px;
            font-size: 1rem;
        }
        input, select, textarea {
            padding: 10px;
            margin-top: 5px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
        }
        button {
            margin-top: 20px;
            padding: 10px;
            background: crimson;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: 0.3s;
        }
        button:hover {
            background: #fff;
            color: crimson;
            border: 2px solid crimson;
        }
        .message {
            margin-top: 10px;
            text-align: center;
        }
        .message.error {
            color: red;
        }
        .message.success {
            color: green;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Manage Account</h1>

        <!-- Display success or error message -->
        <?php if (isset($message)): ?>
            <p class="message <?php echo $message_class; ?>"><?php echo $message; ?></p>
        <?php endif; ?>

        <!-- Option buttons for Add Employee and Assign Task -->
        <div class="option-buttons">
            <button id="add-employee-btn">Add Employee</button>
            <button id="assign-task-btn">Assign Task</button>
        </div>

        <!-- Forms for Add Employee and Assign Task, shown based on button click -->
        <div id="add-employee-form" style="display: none;">
            <h2>Add Employee</h2>
            <form action="assign_task.php" method="POST">
                <label for="employee_name">Employee Name:</label>
                <input type="text" id="employee_name" name="employee_name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="job_title">Job Title:</label>
                <input type="text" id="job_title" name="job_title" required>

                <label for="hire_date">Hire Date:</label>
                <input type="date" id="hire_date" name="hire_date" required>

                <button type="submit" name="add_employee">Add Employee</button>
            </form>
        </div>

        <div id="assign-task-form" style="display: none;">
            <h2>Assign Task</h2>
            <form action="assign_task.php" method="POST">
                <label for="employee_id">Select Employee:</label>
                <select name="employee_id" id="employee_id" required>
                    <option value="">Select an employee</option>
                    <?php
                    // Fetch employees for task assignment
                    $employee_sql = "SELECT EMPLOYEE_ID, EMPLOYEE_NAME FROM employee";
                    $employee_result = $conn->query($employee_sql);
                    while ($row = $employee_result->fetch_assoc()) {
                        echo "<option value='" . $row['EMPLOYEE_ID'] . "'>" . $row['EMPLOYEE_NAME'] . "</option>";
                    }
                    ?>
                </select>

                <label for="task_description">Task Description:</label>
                <textarea name="task_description" id="task_description" rows="5" required></textarea>

                <button type="submit" name="assign_task">Assign Task</button>
            </form>
        </div>
    </div>

    <script>
        // Show the corresponding form when a button is clicked
        document.getElementById('add-employee-btn').addEventListener('click', function() {
            document.getElementById('add-employee-form').style.display = 'block';
            document.getElementById('assign-task-form').style.display = 'none';
        });

        document.getElementById('assign-task-btn').addEventListener('click', function() {
            document.getElementById('assign-task-form').style.display = 'block';
            document.getElementById('add-employee-form').style.display = 'none';
        });
    </script>
</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
