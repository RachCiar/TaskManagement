<?php


require("connect_db.php"); 


$query = "DELETE FROM task WHERE status=1";
$result = mysqli_query($dbc, $query) or die('Error, insert query failed');



if ($result === TRUE) {
    echo "Task deleted successfully";
} else {
    echo "Error: " . $query . "<br>" . $dbc->error;
}
