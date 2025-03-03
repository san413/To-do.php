<?php
include 'db.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "UPDATE tasks SET status='completed' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "error";
    }
}
?>
