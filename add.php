<?php
require("connect_db.php"); 
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$task = $_POST['taskIteminUrl'];
$query = "INSERT INTO task(task_item, task_pos, status) VALUES('$task', 99, 0)";
$result = mysqli_query($dbc, $query);

if ($result === TRUE) {
    echo "New task created successfully";
} else {
    echo "Error: " . $query . "<br>" . $dbc->error;
}


?>