<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "task_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $manager_id = $_POST['manager_id'];
    $department = $_POST['department'];
    $manager_name = $_POST['manager_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hire_date = $_POST['hire_date'];

    if (empty($manager_id) || empty($department) || empty($manager_name) || empty($email) || empty($password) || empty($hire_date)) {
        $error = "All fields are required.";
    } else {
        // Insert manager into the database
        $sql = "INSERT INTO manager (MANAGER_ID, DEPARTMENT, MANAGER_NAME, EMAIL, PASSWORD, HIRE_DATE) 
                VALUES (?, ?, ?, ?, ?, ?);";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $manager_id, $department, $manager_name, $email, $password, $hire_date);

        if ($stmt->execute()) {
            $success = "Manager added successfully!";
        } else {
            $error = "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Manager</title>
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
            width: 40%;
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
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 10px;
            font-size: 1rem;
        }
        input {
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
        <h1>Add Manager</h1>
        <?php if ($error): ?>
            <p class="message error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <?php if ($success): ?>
            <p class="message success"><?= htmlspecialchars($success) ?></p>
        <?php endif; ?>
        <form action="" method="POST">
            <label for="manager_id">Manager ID:</label>
            <input type="text" id="manager_id" name="manager_id">

            <label for="department">Department:</label>
            <input type="text" id="department" name="department">

            <label for="manager_name">Manager Name:</label>
            <input type="text" id="manager_name" name="manager_name">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email">

            <label for="password">Password:</label>
            <input type="password" id="password" name="password">

            <label for="hire_date">Hire Date:</label>
            <input type="date" id="hire_date" name="hire_date">

            <button type="submit">Add Manager</button>
        </form>
    </div>
</body>
</html>
