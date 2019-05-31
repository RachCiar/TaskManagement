<?php
require("connect_db.php"); 


$updateRecordsArray 	= $_POST['toDoListArray'];


	
	$listingCounter = 1;
	foreach ($updateRecordsArray as $recordIDValue) {
		
		$query = "UPDATE task SET task_pos = " . $listingCounter . " WHERE task_ID = " . $recordIDValue;
		mysqli_query($dbc, $query) or die('Error, insert query failed');
		$listingCounter = $listingCounter + 1;	
	}
	
	echo '<pre>';
	print_r($updateRecordsArray);
	echo '</pre>';
	echo 'If you refresh the page, you will see that records will stay just as you modified.';
?>