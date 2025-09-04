<?php

if ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['SERVER_NAME'] === 'localhost') {
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'checkers_game';
} else {
	// Production
    $db_host = 'localhost';
    $db_user = 'your_db';
    $db_pass = 'pass';
    $db_name = 'your_db';
}

?>