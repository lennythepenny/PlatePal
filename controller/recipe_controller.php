<?php
// Handles recipe-related actions like searching, navigating to recipe details, and saving recipes
require_once('../model/recipe_db.php');
require_once('../model/user_db.php'); // For user-related functions, if necessary

// Check if the user is logged in
session_start();

// Handle saved recipes display
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $saved_recipes = getSavedRecipes($user_id); // Fetch saved recipes for the logged-in user
} else {
    $saved_recipes = []; // Empty array if the user is not logged in
}

// Handle saving a recipe to the user's saved list if POST data exists
if (isset($_POST['save_recipe']) && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $recipe_id = $_POST['recipe_id'];

    // Debugging output
    echo "Debug: Recipe ID is " . htmlspecialchars($recipe_id) . "<br>";
    echo "Debug: User ID is " . htmlspecialchars($user_id) . "<br>";

    // Check if the recipe is already saved
    if (!isRecipeSaved($user_id, $recipe_id)) {
        saveRecipe($user_id, $recipe_id);
        echo "Debug: Recipe saved successfully!<br>";
    } else {
        echo "Debug: This recipe is already saved.<br>";
    }

    // Redirect to the account page or recipe page after saving
    // This needs to happen after the recipe is saved, not before
    header('Location: ../view/account_view.php');
    exit();
}

// Handle recipe display (view recipe details)
if (isset($_GET['recipe_id'])) {
    $recipe_id = $_GET['recipe_id'];
    $recipe = getRecipeById($recipe_id); // Fetch the recipe by ID
    include('../view/recipe_detail_view.php'); // Pass the recipe details to the view
} else {
    // If no recipe is requested, default to the index page
    include('../view/index_view.php');
}

function saveRecipe($user_id, $recipe_id) {
    global $db;
    try {
        $query = 'INSERT INTO user_saved_recipes (user_id, recipe_id) VALUES (:user_id, :recipe_id)';
        $statement = $db->prepare($query);
        $statement->bindValue(':user_id', $user_id);
        $statement->bindValue(':recipe_id', $recipe_id);
        $statement->execute();
        $statement->closeCursor();
        echo "Debug: Recipe saved successfully!";
    } catch (PDOException $e) {
        echo "Debug: Error saving recipe - " . $e->getMessage();
    }
}

// Function to check if the recipe is already saved
function isRecipeSaved($user_id, $recipe_id) {
    global $db;
    $query = 'SELECT * FROM user_saved_recipes WHERE user_id = :user_id AND recipe_id = :recipe_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->bindValue(':recipe_id', $recipe_id);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    return $result !== false;
}
?>