<?php
//recipe-related actions: searching, navigating to recipe details, and saving recipes
require_once('../model/recipe_db.php');
require_once('../model/user_db.php');
//start session, check login status
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//saved recipes display for loggin in user
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $saved_recipes = getSavedRecipes($user_id);
} else {
    //$saved_recipes = []; //user not logged in use empty array (change this for future)
}

$action = filter_input(INPUT_POST, 'action');
if ($action == 'save_recipe') {
    //user id and recipe id from form
    $user_id = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);
    $recipe_id = filter_input(INPUT_POST, 'recipe_id', FILTER_VALIDATE_INT);

    //make sure both id's are valid
    if ($user_id && $recipe_id) {
        //if valid save the recipe
        saveRecipe($user_id, $recipe_id);
    }

    //account page after saving
    header("Location: ../view/account_view.php");
    exit();
}

//recipe display (recipe view details)
if (isset($_GET['recipe_id'])) {
    $recipe_id = $_GET['recipe_id'];
    $recipe = getRecipeById($recipe_id);
    include('../view/recipe_detail_view.php');
} else {
    //no recipe requested go to index
    include('../view/index_view.php');
}

//save recipe function to user's recipe list
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

//check if recipe already saved
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