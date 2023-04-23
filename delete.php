<?php

    $servername ="localhost";
    $username ="id20140698_csc4110";
    $password = "!A123456789a";
    $database="id20140698_todolist";

    $conn=new mysqli($servername, $username, $password, $database);

    $errorMessage="";

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
        $task_id = $_GET['id'];

        $sql = "DELETE FROM tasks WHERE task_id='$task_id'";
        $result = $conn->query($sql);

        if (!$result) {
            $errorMessage = "Error deleting task: " . $conn->error;
        } else {
            header("Location: index2.php");
            exit;
        }
    } else {
        header("Location: index2.php");
        exit;
    }
?>
