<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input, textarea, select, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .task-list {
            margin-top: 20px;
        }
        .task-item {
            padding: 15px;
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .task-actions {
            margin-top: 10px;
        }
        .task-actions button {
            width: auto;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Task Management System</h1>

        <form action="insert_task.php" method="POST">
            <div class="form-group">
                <label for="taskName">Task Name</label>
                <input type="text" id="taskName" name="taskName" placeholder="Enter task name">
            </div>

            <div class="form-group">
                <label for="taskDescription">Task Description</label>
                <textarea id="taskDescription" name="DESCRIPTION" rows="4" placeholder="Enter task description"></textarea>
            </div>

            <div class="form-group">
                <label for="assignee">Assign To</label>
                <input type="text" id="assignee" name="assignee" placeholder="Enter employee name">
            </div>

            <button type="submit">Add Task</button>
        </form>

        <div class="task-list">
            <?php
                $conn = new mysqli('localhost:3307', 'root', '', 'task_management');

                if ($conn->connect_error) {
                    die('Connection failed: ' . $conn->connect_error);
                }

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $taskName = $_POST['TAS'];
                    $taskDescription = $_POST['taskDescription'];
                    $assigned = $_POST['assigne'];

                    $sql = "INSERT INTO tasks (name, description, assignee) VALUES ('$taskName', '$taskDescription', '$assignee')";
                    $conn->query($sql);
                }

                if (isset($_GET['delete'])) {
                    $id = $_GET['delete'];
                    $sql = "DELETE FROM tasks WHERE id=$id";
                    $conn->query($sql);
                }

                if (isset($_POST['update'])) {
                    $id = $_POST['id'];
                    $taskName = $_POST['taskName'];
                    $taskDescription = $_POST['taskDescription'];
                    $assignee = $_POST['assignee'];

                    $sql = "UPDATE tasks SET name='$taskName', description='$taskDescription', assignee='$assignee' WHERE id=$id";
                    $conn->query($sql);
                }

                $result = $conn->query("SELECT * FROM TASK"); //error

                while ($row = $result->fetch_assoc()) {
                    echo "<div class='task-item'>";
                    echo "<h3>{$row['name']}</h3>";
                    echo "<p>{$row['description']}</p>";
                    echo "<p><strong>Assigned to:</strong> {$row['assignee']}</p>";
                    echo "<div class='task-actions'>";
                    echo "<a href='?delete={$row['id']}'><button>Delete</button></a>";
                    echo "<form action='' method='POST' style='display:inline-block;'>";
                    echo "<input type='hidden' name='id' value='{$row['id']}'>";
                    echo "<input type='text' name='taskName' value='{$row['name']}'>";
                    echo "<textarea name='taskDescription'>{$row['description']}</textarea>";
                    echo "<input type='text' name='assignee' value='{$row['assignee']}'>";
                    echo "<button type='submit' name='update'>Update</button>";
                    echo "</form>";
                    echo "</div>";
                    echo "</div>";
                }

                $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
