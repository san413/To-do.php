<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Include jQuery -->
</head>
<body>
    <h2>Task Manager</h2>

    <!-- Task Form -->
    <form action="add_task.php" method="POST">
        <input type="text" name="title" placeholder="Task Title" required>
        <textarea name="description" placeholder="Task Description"></textarea>
        <button type="submit">Add Task</button>
    </form>

    <hr>

    <!-- Display Tasks -->
    <h3>Your Tasks</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>

        <?php
        $sql = "SELECT * FROM tasks ORDER BY created_at DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr id='task-{$row['id']}'>
                        <td>{$row['id']}</td>
                        <td>{$row['title']}</td>
                        <td>{$row['description']}</td>
                        <td id='status-{$row['id']}'>{$row['status']}</td>
                        <td>
                            <button onclick='markCompleted({$row['id']})'>Mark as Completed</button>
                            <button onclick='deleteTask({$row['id']})'>Delete</button>
                            <td>
                            <a href='javascript:void(0);' onclick='markCompleted({$row['id']})' class='complete-btn'>Mark as Completed</a>
                            <a href='javascript:void(0);' onclick='deleteTask({$row['id']})' class='delete-btn'>Delete</a>
</td>

                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No tasks found</td></tr>";
        }
        ?>
    </table>

    <script>
        function markCompleted(taskId) {
            $.ajax({
                url: 'update_status.php',
                type: 'POST',
                data: { id: taskId },
                success: function(response) {
                    if (response === "success") {
                        $('#status-' + taskId).text("completed");
                    } else {
                        alert("Error updating task");
                    }
                }
            });
        }

        function deleteTask(taskId) {
            $.ajax({
                url: 'delete_task.php',
                type: 'GET',
                data: { id: taskId },
                success: function(response) {
                    if (response === "success") {
                        $('#task-' + taskId).remove();
                    } else {
                        alert("Error deleting task");
                    }
                }
            });
        }
    </script>
</body>
</html>

