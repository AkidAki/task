<?php
include 'server.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_id = $_POST['task_id'];
    $status = $_POST['status'];

    // Update the task status
    $sql = "UPDATE task SET STATUS = ? WHERE TASK_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $task_id);

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }

    $stmt->close();
}

$conn->close();
?>
