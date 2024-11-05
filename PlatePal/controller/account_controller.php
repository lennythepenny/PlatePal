<?php
// Manages user account actions like login, logout, and accessing saved recipes
require_once('../model/user_db.php');

session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (login($username, $password)) {
        header("Location: ../view/account_view.php");
    } else {
        $error = "Invalid login. Please try again.";
        include('../view/login_view.php');
    }
} else {
    include('../view/login_view.php');
}
?>
