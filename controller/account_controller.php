<?php
//user account functions like logging in and viewing recipes
require_once('../model/user_db.php');
session_start();

//login functionality
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = login($username, $password);

    if ($user) {
        //login is successful set the user_id and username
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        //account page redirect
        header('Location: ../view/account_view.php');
        exit();
    } else {
        echo "Invalid login credentials";
    }
}

//handle registration
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    //make sure username and password are inputted
    if (empty($username) || empty($password)) {
        $error = "Username and password are required.";
        include('../view/register_view.php');
        exit();
    }

    //make sure username doesn't already exist
    if (usernameExists($username)) {
        $error = "Username already exists. Please choose a different username.";
        include('../view/register_view.php');
        exit();
    }

    //hashing password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    //add new user to database
    if (addUser($username, $hashed_password, $email)) {
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = getUserIdByUsername($username);
        header("Location: ../view/account_view.php");
        exit();
    } else {
        $error = "There was an issue with registration. Please try again.";
        include('../view/register_view.php');
    }
} else {
    //login view if no action specified
    include('../view/login_view.php');
}

//logging out
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    //remove session variables
    session_unset();
    //destroy session
    session_destroy();
    //back to login page
    header("Location: ../view/login_view.php");
    exit();
}

//saving the recipe
if (isset($_POST['save_recipe'])) {
    $userId = $_SESSION['user_id'];
    $recipeId = $_POST['recipe_id'];
    //make sure recipe isn't already saved
    if (!isRecipeSaved($userId, $recipeId)) {
        //save if not already saved
        if (saveRecipe($userId, $recipeId)) {
            $message = "Recipe saved successfully!";
        } else {
            $message = "Error saving the recipe.";
        }
    } else {
        $message = "This recipe is already saved.";
    }
    header("Location: ../view/account_view.php");
    exit();
}

//check if username exists already
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

//adduser to database function
function addUser($username, $password_hash, $email) {
    global $db;
    $query = 'INSERT INTO users (username, password_hash, email) VALUES (:username, :password_hash, :email)';
    $statement = $db->prepare($query);
    
    //bind values
    $statement->bindValue(':username', $username);
    $statement->bindValue(':password_hash', $password_hash);
    $statement->bindValue(':email', $email);
    
    //execute
    $success = $statement->execute();
    $statement->closeCursor();
    
    return $success;
}
//get user_id from username
function getUserIdByUsername($username) {
    global $db;
    $query = 'SELECT user_id FROM users WHERE username = :username';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $user = $statement->fetch();
    $statement->closeCursor();
    //user not found? return null (fix this for the future for a default value)
    return $user['user_id'] ?? null;
}
?>
