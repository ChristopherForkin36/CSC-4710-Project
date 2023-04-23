<?php

include("data_layer.php");

$servername = "localhost";
$username = "id20140698_csc4110";
$password = "!A123456789a";
$database = "id20140698_todolist";

$conn = new mysqli($servername, $username, $password, $database);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET["id"])) {
        $task_id = $_GET["id"];

        //get current status
        $sql = "SELECT task_status FROM tasks WHERE task_id = '$task_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $current_status = $row['task_status'];

            //toggle the status
            $new_status = ($current_status == 'active') ? 'complete' : 'active';

            //update status in db
            $sql = "UPDATE tasks SET task_status = '$new_status' WHERE task_id = '$task_id'";
            $conn->query($sql);
        }
    }
}

//redirect back to index page
header("location: index.php");
exit;

?>
