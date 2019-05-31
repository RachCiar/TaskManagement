<?php

require("connect_db.php");

$taskList = $_POST['toDoListArrayID'];
$taskStatus = $_POST['order'];



foreach ($taskList as $task) {
//mysql_query("UPDATE donations SET claimed='1' WHERE username='$username' LIMIT 1");

    $query = "UPDATE task SET status='1' WHERE task_ID=$task";
    $result = mysqli_query($dbc, $query) or die('Error, insert query failed');
}


