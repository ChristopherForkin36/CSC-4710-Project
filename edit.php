<?php
    
    $servername ="localhost";
    $username ="id20140698_csc4110";
    $password = "!A123456789a";
    $database="id20140698_todolist";
    
    $conn=new mysqli($servername, $username, $password, $database);
        $task_id="";
        $task_desc = "";
        $task_due_date = "";
        $task_cat = "";
        $task_priority = "";
        $task_status = "";
        $errorMessage="";
        $successMessage="";
        
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        // if(!isset($_GET["task_id"])){
        //     header("location: index2.php");
        //     exit;
        // }
        $task_id=$_GET["id"];
        
        $sql ="SELECT * FROM tasks WHERE task_id='$task_id'";
        $result=$conn->query($sql);
        $row=$result->fetch_assoc();
        
        // if(!row){
        //     header("location: index2.php");
        //     exit;
        // }
        
        
        $task_desc = $row["task_desc"];
        $task_due_date = $row["task_due_date"];
        $task_cat = $row["task_cat"];
        $task_priority = $row["task_priority"];
        $task_status = $row["task_status"];
    }
    else{
        $task_id = $_POST['task_id'];
        $task_desc = $_POST['description'];
        $task_due_date = $_POST['task_due_date'];
        $task_cat = $_POST['task_cat'];
        $task_priority = $_POST['task_priority'];
        $task_status = $_POST['task_status'];
        
    
        do{
            if (empty($task_desc) || empty($task_due_date)){
                $errorMessage="Enter required fields.";
                break;
            }
            
            $sql = "UPDATE tasks SET task_desc='$task_desc', task_due_date='$task_due_date', task_cat='$task_cat', task_priority='$task_priority', task_status='$task_status' WHERE task_id = $task_id";
            $result=$conn->query($sql);
            if (!$result){
                $errorMessage="invaild query" . $conn->error;
                break;
            }
            
            $successMessage="Task updated succesfully!";
            
              header("location: index2.php");
            exit;
        }
        while (false);
    }
?>




<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8">
   <title>To-Do List</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css
">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js
"></script>

</head>


<h2>Edit Task</h2>
<?php
if (!empty($successMessage)){
    echo $successMessage;
}
?>
<?php
if (!empty($errorMessage)){
    echo $errorMessage;
}
?>

    <legend>Task Information (*Required field)</legend>
    <ul>

        <form method="POST">
            <input type="hidden" name="task_id" value="<?php echo $task_id;?>" >
            

        <li><label for="description">*Task Description: 
           <br> <textarea rows="2" cols="30" name="description"id="description" value ="<?php echo $task_desc;?>" required ></textarea>
              
        <li><label for="task_due_date">*Due Date: <input type="date" name="task_due_date"id="task_due_date" value ="<?php echo $task_due_date;?>"
        required></li>
        <li><label for="task_cat">Task Category: <input type="text" name="task_cat" value ="<?php echo $task_cat;?>"></li>
            <legend>Priority</legend>
            <select name="task_priority" id="task_priority" >
                <option value ="0">NA</option>
                <option value="1">1 (Highest)</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4 (Lowest)</option>
            </select>
            <p>*Is the task active or complete?</p>
            <input type="radio" name="task_status" id="active" value ="active" checked>
            <label for="active">Active</label>
            <input type="radio" name="task_status" id="complete" value ="complete">
            <label for="complete">Complete</label>
            <br>
            <input type="submit" value="Edit Task">
      
        </form>
                            
      
                 
                
               
