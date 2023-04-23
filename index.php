<?php
    include("data_layer.php");
    
    
    $servername ="localhost";
    $username ="id20140698_csc4110";
    $password = "!A123456789a";
    $database="id20140698_todolist";
    
    $conn=new mysqli($servername, $username, $password, $database);
    $sql = "SELECT * FROM `category`";
    $all_categories = mysqli_query($conn,$sql);

    function create_tasks_table() {
        //  Request for student data
        $tasks = db_get_task_data();
        // Create table with student data
        foreach ($tasks as $r) {
            echo "<tr>\n";
            echo "<td>" . $r[0] . "</td>\n";
            echo "<td>" . $r[1] . "</td>\n";
            echo "<td>" . $r[2] . "</td>\n";
            echo "<td>" . $r[3] . "</td>\n";
            echo "<td>" . $r[4] . "</td>\n";
            echo "<td>" . $r[5] . "</td>\n";
            echo "<td>
            <a class='btn btn-primary btn-sm' href='edit.php?id=$r[0]'>Edit</a>
                            <a class='btn btn-danger btn-sm' href='delete.php?id=$r[0]'>Delete</a>
                                        <a class='btn btn-secondary btn-sm' href='toggle_task_status.php?id=$r[0]'>" . ($r[5] == 'active' ? 'Mark as Complete' : 'Mark as Active') . "</a>

                            
                        </td>";

            //echo "<td><a href='db_remove_student.php?id=" . $r[0] . "'>Delete</a></td>\n";
            echo "</tr>\n";
        }
    }
        $task_desc = "";
        $task_due_date = "";
        $task_cat = "";
        $task_priority = "";
        $task_status = "";
        $errorMessage="";
        $successMessage="";
        
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
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
            
            $sql = "INSERT INTO tasks (task_desc, task_due_date, task_cat, task_priority, task_status) VALUES ('$task_desc', '$task_due_date', '$task_cat', '$task_priority', '$task_status')";
            $result=$conn->query($sql);
            if (!$result){
                $errorMessage="invaild query" . $conn->error;
                break;
            }

            $task_desc = "";
            $task_due_date = "";
            $task_cat = "";
            
            $successMessage="Task added succesfully!";
        }
        while (false);
    }
?>




<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8">
   <title>To-Do List</title>
     <style>
body {
background-color: #b4e1fa;
margin: 0 10%;
font-family: sans-serif;
}
h1 {text-align: center;
font-family: serif;
font-weight: normal;
text-transform: uppercase;
border-bottom: 1px solid #57b1dc;
margin-top: 30px;
}

</style>

</head>
<nav>
    <ul>
        <li><a href="authors.html">Authors' Pages</a></li>
        <li><a href="categories.php">Categories Pages</a></li>
        <li><a href="categoryview.php">Category View Page</a></li>
    </ul>
</nav>

<h2>Your To-Do List</h2>
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

        <li><label for="description">*Task Description: 
           <br> <textarea rows="2" cols="30" name="description"id="description" value ="<?php echo $task_desc;?>" required ></textarea>
              
        <li><label for="task_due_date">*Due Date: <input type="date" name="task_due_date"id="task_due_date" value ="<?php echo $task_due_date;?>"
        required></li>
        <li><label>Select a Category</label>
        <select name="task_cat">
            <?php
                // use a while loop to fetch data
                // from the $all_categories variable
                // and individually display as an option
                while ($name = mysqli_fetch_array(
                        $all_categories,MYSQLI_ASSOC)):;
            ?>
                <option value="<?php echo $name["id"];
                    // The value we usually set is the primary key
                ?>">
                    <?php echo $name["name"];
                        // To show the category name to the user
                    ?>
                </option>
            <?php
                endwhile;
                // While loop must be terminated
            ?>
        </li>
        </select>
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
            <input type="submit" value="Add Task">
      
        </form>
        
      

        <body>
            <h2>To-Do List</h2>
            
            <table>
                <tr>
                    <th>ID</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Due Date</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>  <?php
                 create_tasks_table();
                 ?>
                 
                  
                  
                  
                            
      
                 
                
               
