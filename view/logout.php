<?php

//destroy session to log out the user
session_destroy();

//redirect user to the home page after logging out
header("Location: index.php");
exit();
?>