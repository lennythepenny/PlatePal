<?php
//start session
 session_start();

//check if user logged in
$isLoggedIn = isset($_SESSION['username']);

//pass login status to main view
require_once('../view/index_view.php');
?>
