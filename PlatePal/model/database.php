<?php
// Database connection settings
$dsn = 'mysql:host=localhost;dbname=plate_pal';
$username = 'root';
$password = 'WebDevDatabase';

try {
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    include('../view/database_error.php');
    exit();
}
?>
