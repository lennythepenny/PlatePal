<?php
// Manages user account actions like login, logout, and accessing saved recipes
require_once('../model/user_db.php');
session_start();

// Handle login functionality
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = login($username, $password);

    if ($user) {
        // If login is successful, set session variables
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];

        header('Location: ../view/account_view.php'); // Redirect to the account page
        exit();
    } else {
        echo "Invalid login credentials";
    }
}
// Handle registration functionality
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

// Handle logout functionality
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_unset(); // Remove all session variables
    session_destroy(); // Destroy the session
    header("Location: ../view/login_view.php"); // Redirect to login page
    exit();
}

// Handle save recipe functionality
if (isset($_POST['save_recipe'])) {
    $userId = $_SESSION['user_id'];  // Get the user ID from the session
    $recipeId = $_POST['recipe_id']; // The ID of the recipe to save

    // Check if the recipe is already saved
    if (!isRecipeSaved($userId, $recipeId)) {
        // Save the recipe if not already saved
        if (saveRecipe($userId, $recipeId)) {
            $message = "Recipe saved successfully!";
        } else {
            $message = "Error saving the recipe.";
        }
    } else {
        $message = "This recipe is already saved.";
    }

    // Redirect or include the appropriate view (e.g., account_view.php)
    header("Location: ../view/account_view.php");
    exit();
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
