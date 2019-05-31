<?php
require("connect_db.php");

$taskType = $_GET['taskType'];

switch ($taskType) {

    case 'newTask':
        $query = "SELECT * FROM task WHERE status = 0 ORDER BY task_pos ASC";
        $result = mysqli_query($dbc, $query);
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            ?>
            <li class="bg-color1" id="toDoListArrayID_<?php echo $row['task_ID'];?>"><?php echo $row['task_item']; ?></li>
            <?php
        }
        break;

    case 'showTaskCompleted':
        $query = "SELECT * FROM task WHERE status = 1 ORDER BY task_pos ASC";
        $result = mysqli_query($dbc, $query);
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            ?>
            <li class="bg-color2" id="toDoListArrayID_<?php echo $row['task_ID'];?>"><?php echo $row['task_item']; ?></li>
            <?php
        }
        break;
        
    default:
        break;
}


/* Debug */
//if ($result) {
//    echo "There are records";
//} else {
//    echo"NO RECORDS";
//}





