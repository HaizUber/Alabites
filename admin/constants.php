<?php
    // Start Session
    session_start();

    // Create Constants to Store Non-Repeating Values
    define('SITEURL', 'http://192.168.1.3/files/foodorderlatest/');
    define('LOCALHOST', ''); // Corrected localhost value

    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'id20669459_order');

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME) or die(mysqli_error());
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); // Selecting Database
?>
