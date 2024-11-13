<?php
// Start the session to access session variables
 //session_start();

// Destroy the session to log out the user
session_destroy();

// Redirect the user to the home page after logging out
header("Location: index.php");
exit();
?>
