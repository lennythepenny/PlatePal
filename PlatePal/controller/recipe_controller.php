<?php
// Handles recipe-related actions like searching and navigating to recipe details
require_once('../model/recipe_db.php');

if (isset($_GET['recipe_id'])) {
    $recipe_id = $_GET['recipe_id'];
    $recipe = getRecipeById($recipe_id);
    include('../view/recipe_detail_view.php');
} else {
    // Default to index if no specific recipe is requested
    include('../view/index_view.php');
}
?>
