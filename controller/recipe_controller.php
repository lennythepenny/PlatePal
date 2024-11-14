<?php
// Handles recipe-related actions like searching, navigating to recipe details, and saving recipes
require_once('../model/recipe_db.php');
require_once('../model/user_db.php'); // For user-related functions, if necessary
// Start the session to check for login status
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Handle saved recipes display
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $saved_recipes = getSavedRecipes($user_id); // Fetch saved recipes for the logged-in user
} else {
    //$saved_recipes = []; // Empty array if the user is not logged in
    echo "You must be logged in to view saved recipes.";
}

$action = filter_input(INPUT_POST, 'action');
if ($action == 'save_recipe') {
    // Get user_id and recipe_id from the form data
    $user_id = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);
    $recipe_id = filter_input(INPUT_POST, 'recipe_id', FILTER_VALIDATE_INT);

    // Check if both user_id and recipe_id are valid
    if ($user_id && $recipe_id) {
        // Call the function to save the recipe
        addRecipeToUser($user_id, $recipe_id); // Assuming this function is in user_db.php
    }

    // Redirect to the account page after saving
    header("Location: ../view/account_view.php");
    exit(); // Ensure no further code is executed
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

// Function to save the recipe to the user's saved list
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