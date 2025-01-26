<?php
include 'db_connection.php';

// Fetch task
$sql = "SELECT TASK_ID, TASK_NAME, DESCRIPTION, PRIORITY, STATUS, DUE_DATE, EMPLOYEE_ID, PROJECT_ID FROM task ORDER BY TASK_ID ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('image/best-quality-white-work-table-4wl7c7hdhbu9zn7y.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 20px;
            background-color: #f4f4f9;
        }
        h1 {
            text-align: center;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.3);
            color: darkred;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 10px 20px;
            border-radius: 8px;
            display: inline-block;
            margin: 20px auto;
        }
        #message {
            display: none;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        select, button {
            padding: 5px;
        }
        button {
            color: white;
            background-color: #4CAF50;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h1>Task Management System</h1>

<!-- Success/Error Message Container -->
<div id="message"></div>

<table>
    <tr>
        <th>TASK ID</th>
        <th>TASK NAME</th>
        <th>DESCRIPTION</th>
        <th>PRIORITY</th>
        <th>STATUS</th>
        <th>DUE DATE</th>
        <th>EMPLOYEE ID</th>
        <th>PROJECT ID</th>
        <th>UPDATE STATUS</th>
    </tr>

    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr id="row-<?php echo $row['TASK_ID']; ?>">
                <td><?php echo $row['TASK_ID']; ?></td>
                <td><?php echo htmlspecialchars($row['TASK_NAME']); ?></td>
                <td><?php echo htmlspecialchars($row['DESCRIPTION']); ?></td>
                <td><?php echo $row['PRIORITY']; ?></td>
                <td id="status-<?php echo $row['TASK_ID']; ?>"><?php echo $row['STATUS']; ?></td>
                <td><?php echo $row['DUE_DATE']; ?></td>
                <td><?php echo $row['EMPLOYEE_ID']; ?></td>
                <td><?php echo $row['PROJECT_ID']; ?></td>
                <td>
                    <select id="status-select-<?php echo $row['TASK_ID']; ?>">
                        <option value="Pending" <?php if ($row['STATUS'] == 'Pending') echo 'selected'; ?>>Pending</option>
                        <option value="In Progress" <?php if ($row['STATUS'] == 'In Progress') echo 'selected'; ?>>In Progress</option>
                        <option value="Completed" <?php if ($row['STATUS'] == 'Completed') echo 'selected'; ?>>Completed</option>
                        <option value="Overdue" <?php if ($row['STATUS'] == 'Overdue') echo 'selected'; ?>>Overdue</option>
                    </select>
                    <button onclick="updateStatus(<?php echo $row['TASK_ID']; ?>)">Update</button>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="9">No task available.</td>
        </tr>
    <?php endif; ?>
</table>

<script>
    function updateStatus(taskId) {
        const statusSelect = document.getElementById(`status-select-${taskId}`);
        const newStatus = statusSelect.value;

        const formData = new FormData();
        formData.append('task_id', taskId);
        formData.append('status', newStatus);

        fetch('update_task.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            const messageDiv = document.getElementById('message');
            if (data === 'success') {
                document.getElementById(`status-${taskId}`).innerText = newStatus;
                messageDiv.style.display = 'block';
                messageDiv.style.backgroundColor = '#4CAF50';
                messageDiv.style.color = 'white';
                messageDiv.innerText = 'Task successfully updated!';
                setTimeout(() => { messageDiv.style.display = 'none'; }, 3000);
            } else {
                messageDiv.style.display = 'block';
                messageDiv.style.backgroundColor = '#f44336';
                messageDiv.style.color = 'white';
                messageDiv.innerText = 'Failed to update task.';
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>

</body>
</html>

<?php
$conn->close();
?>
