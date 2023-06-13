<?php
    session_start(); // This will start all our session as we shall see

    // let us create to store our Localhost, root, password and database
    define('LOCALHOST', 'localhost');
    define('ROOT', 'root');
    define('PASSWORD', '');
    define('DATABASE', 'login_db');
    define('SITEURL', 'http://localhost/Web/'); // here is our site ... url for our project and we shall keep it in this variable.

    // let us connect to our database
    $conn = mysqli_connect(LOCALHOST, ROOT, PASSWORD, DATABASE) or die (mysqli_error($conn));
    $db_select = mysqli_select_db($conn, DATABASE) or die(mysqli_error($conn));
?>