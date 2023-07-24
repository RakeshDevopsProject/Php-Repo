<!DOCTYPE html>
<html>
<head>
    <title>Simple To-Do List</title>
</head>
<body>
    <h1>Simple To-Do List</h1>

    <?php
    // Initialize the task list
    echo "<h1>This is first PHP program</h1>";
    $tasks = [];

    // Check if the form was submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Add a new task
        if (isset($_POST['newTask']) && $_POST['newTask'] !== '') {
            $newTask = $_POST['newTask'];
            $tasks[] = [
                'task' => $newTask,
                'completed' => false
            ];
        }

        // Mark task as completed
        if (isset($_POST['completedTask']) && $_POST['completedTask'] !== '') {
            $completedTaskIndex = (int)$_POST['completedTask'];
            if (isset($tasks[$completedTaskIndex])) {
                $tasks[$completedTaskIndex]['completed'] = true;
            }
        }

        // Remove completed tasks
        if (isset($_POST['removeCompleted'])) {
            $tasks = array_filter($tasks, function ($task) {
                return !$task['completed'];
            });
        }
    }
    ?>

    <form method="post">
        <label for="newTask">Add a new task:</label>
        <input type="text" name="newTask" id="newTask">
        <button type="submit">Add</button>
    </form>

    <h2>Task List:</h2>
    <ul>
        <?php foreach ($tasks as $index => $task) : ?>
            <li>
                <form method="post">
                    <input type="hidden" name="completedTask" value="<?php echo $index; ?>">
                    <input type="checkbox" <?php echo $task['completed'] ? 'checked' : ''; ?>>
                    <?php echo $task['task']; ?>
                    <button type="submit">Complete</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

    <form method="post">
        <button type="submit" name="removeCompleted">Remove Completed Tasks</button>
    </form>

</body>
</html>
