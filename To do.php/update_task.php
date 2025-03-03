<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "UPDATE tasks SET status='completed' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Task marked as completed!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<br><a href="index.php">Go Back</a>
