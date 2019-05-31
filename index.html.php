<?php require("connect_db.php"); ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>jQuery draggable - To Do List</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>

        
        
        <h1>Tasks for Today</h1>
        <!--Button to add new tasks to task list -->
        <button id="button"><img src="img/plus-button.png" alt="plus button"></button>
        
        <div id="task">
            <input type="text" name="taskItem" id="taskItem" placeholder="Add new task"><br>
            <input type="submit" id="submit" value="Submit">
       
        </div>
        <div id="responseMessage"></div>
        <div id="container" >

            <div id="leftContainer">

                <ul id="toDoListArray" class="sortableBox">
                    <?php
                    $query = "SELECT * FROM task WHERE status = 0 ORDER BY task_pos ASC"; //WHERE 'status' =0 means active task";
                    $result = mysqli_query($dbc, $query);

                    /* Debug */
                    if ($result) {
                        echo "There are records";
                    } else {
                        echo"NO RECORDS";
                    }

                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        ?>
                        <li class="bg-color1" id="toDoListArrayID_<?php echo $row['task_ID'];?>"><?php echo $row['task_item']; ?></li>
                    <?php } ?>
                </ul>
            </div>

            <div id="rightContainer">
                <p>Task Completed</p>  
                 <p>Place your completed task here.</p>
                 <ul id="completedTasks" class="sortableBox">
                     <?php
                    $query = "SELECT * FROM task WHERE status = 1 ORDER BY task_pos ASC"; //WHERE 'status' =0 means active task";
                    $result = mysqli_query($dbc, $query);

                    /* Debug */
                    if ($result) {
                        echo "There are records";
                    } else {
                        echo"NO RECORDS";
                    }

                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        ?>
                        <li class="bg-color2" id="toDoListArrayID_<?php echo $row['task_ID'];?>"><?php echo $row['task_item']; ?></li>
                    <?php } ?>
                 </ul>
                <button id="btn">Move completed tasks to trash</button>
            </div>
           
        </div>
        <script src="script.js"></script>

    </body>
</html>
