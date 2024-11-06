<?php
// Start session management
session_start();

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['username']);

// Pass the login status to the view and render it
require_once('../view/index_view.php');
?>
