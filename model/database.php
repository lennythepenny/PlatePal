<?php
//connecting to the database
$dsn = 'mysql:host=localhost;dbname=plate_pal';
$username = 'root';
$password = 'WebDevDataBase';

try {
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    //couldn't connect to the database
    include('../view/database_error.php');
    exit();
}
?>
