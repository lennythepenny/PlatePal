<?php
// Manages user account actions like login, logout, and accessing saved recipes
require_once('../model/user_db.php');
session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if username and password are not empty
    if (!empty($username) && !empty($password)) {
        $user = login($username, $password);
        if ($user) {
            // Store user details in session (e.g., user_id or username)
            $_SESSION['user_id'] = $user['id'];  // Assuming there's an 'id' field in your user table
            $_SESSION['username'] = $user['username'];

            // Redirect to the account page
            header("Location: ../view/account_view.php");
            exit(); // Make sure no code runs after the redirect
        } else {
            $error = "Invalid login. Please try again.";
            include('../view/login_view.php');
        }
    } else {
        $error = "Username and password are required.";
        include('../view/login_view.php');
    }
} 

// Handle registration logic
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Validate input
    if (empty($username) || empty($password)) {
        $error = "Username and password are required.";
        include('../view/register_view.php');
        exit();
    }

    // Check if username already exists
    if (usernameExists($username)) {
        $error = "Username already exists. Please choose a different username.";
        include('../view/register_view.php');
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Add user to the database
    if (addUser($username, $hashed_password, $email)) {
        $_SESSION['username'] = $username;
        header("Location: ../view/account_view.php");
        exit(); // Make sure no code runs after the redirect
    } else {
        $error = "There was an issue with registration. Please try again.";
        include('../view/register_view.php');
    }
} else {
    include('../view/login_view.php'); // Default to the login view if no action is specified
}

// Function to check if the username already exists
function usernameExists($username) {
    global $db;
    $query = 'SELECT * FROM users WHERE username = :username';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $user = $statement->fetch();
    $statement->closeCursor();
    return $user !== false;
}

// Function to add the user to the database
function addUser($username, $password_hash, $email) {
    global $db;
    // Modified query to include the 'email' column
    $query = 'INSERT INTO users (username, password_hash, email) VALUES (:username, :password_hash, :email)';
    $statement = $db->prepare($query);
    
    // Bind the values for the query
    $statement->bindValue(':username', $username);
    $statement->bindValue(':password_hash', $password_hash);
    $statement->bindValue(':email', $email);
    
    // Execute the query
    $success = $statement->execute();
    $statement->closeCursor();
    
    return $success;
}

?>
