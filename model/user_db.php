<?php
// Include the database connection settings
require_once 'database.php';  // Make sure this path is correct

// Manages user-related data like login and saved recipes
function login($username, $password) {
    global $db;
    // Query to get the user by username
    $query = 'SELECT * FROM users WHERE username = :username';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $user = $statement->fetch();
    $statement->closeCursor();

    // Check if user exists and verify the password
    if ($user && password_verify($password, $user['password_hash'])) {
        return $user;
    } else {
        return false; // Invalid login
    }
}
// Function to save a recipe to the user's saved recipes list
function saveRecipe($userId, $recipeId) {
    global $db;
    $query = 'INSERT INTO user_saved_recipes (user_id, recipe_id) VALUES (:user_id, :recipe_id)';
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $userId);
    $statement->bindValue(':recipe_id', $recipeId);
    $success = $statement->execute();
    $statement->closeCursor();
    
    return $success;
}

// Function to get all saved recipes for a user
function getSavedRecipes($userId) {
    global $db;
    $query = 'SELECT * FROM recipes 
              JOIN user_saved_recipes ON recipes.id = user_saved_recipes.recipe_id 
              WHERE user_saved_recipes.user_id = :user_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $userId);
    $statement->execute();
    $savedRecipes = $statement->fetchAll();
    $statement->closeCursor();
    
    return $savedRecipes;
}

// Function to check if a recipe is already saved by the user
function isRecipeSaved($userId, $recipeId) {
    global $db;
    $query = 'SELECT * FROM user_saved_recipes WHERE user_id = :user_id AND recipe_id = :recipe_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $userId);
    $statement->bindValue(':recipe_id', $recipeId);
    $statement->execute();
    $savedRecipe = $statement->fetch();
    $statement->closeCursor();
    
    return $savedRecipe !== false;
}

?>
