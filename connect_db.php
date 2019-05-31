<?php #connect_db.php

//This file contains the database access information.
//This file also establishes a connection to MySQL,
//selects the database, and sets the encoding.

//Set the database access information as constants:

        define('DB_USER', 'root');
        define('DB_PASSWORD', '');
        define('DB_HOST', 'localhost');
        define('DB_NAME', 'tododb');

        // Make the connection


        $dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
                
 // If no connection could be made, trigger an error:
if (!$dbc) {
	trigger_error('Could not connect to MySQL: ' . mysqli_connect_error() );
} else { // Otherwise, set the encoding:
	mysqli_set_charset($dbc, 'utf8');
}

