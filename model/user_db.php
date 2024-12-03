<?php
require_once 'database.php';

//manage user related data like loggin in and getting a specific user's recipes
function login($username, $password) {
    global $db;
    //getting user by username
    $query = 'SELECT user_id, username, password_hash FROM users WHERE username = :username';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $user = $statement->fetch();
    $statement->closeCursor();

    //make sure user exists and verify the password
    if ($user && password_verify($password, $user['password_hash'])) {
        //valid user
        return $user;
    } else {
        //invalid login
        return false;
    }
}

//getting all saved recipes for specific user
function getSavedRecipes($userId) {
    global $db;
    $query = 'SELECT * FROM recipes 
              JOIN user_saved_recipes ON recipes.recipe_id = user_saved_recipes.recipe_id 
              WHERE user_saved_recipes.user_id = :user_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $userId);
    $statement->execute();
    $savedRecipes = $statement->fetchAll();
    $statement->closeCursor();
    
    return $savedRecipes;
}
?>
