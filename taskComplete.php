<?php

require("connect_db.php");

$taskList = $_POST['toDoListArrayID'];
$taskStatus = $_POST['order'];



foreach ($taskList as $task) {


    $query = "UPDATE task SET status='1' WHERE task_ID=$task";
    $result = mysqli_query($dbc, $query) or die('Error, insert query failed');
}


