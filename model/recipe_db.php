<?php
// Handles recipe data operations
require_once('database.php');

// Fetch a single recipe by ID
function getRecipeById($recipe_id) {
    global $db;
    $query = 'SELECT * FROM recipes WHERE id = :recipe_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':recipe_id', $recipe_id);
    $statement->execute();
    $recipe = $statement->fetch();
    $statement->closeCursor();
    return $recipe;
}

// Search for recipes by title or ingredients
function searchRecipes($term) {
    global $db;
    $search_term = '%' . $term . '%'; // For partial match
    $query = 'SELECT * FROM recipes WHERE title LIKE :term OR ingredients LIKE :term';
    $statement = $db->prepare($query);
    $statement->bindValue(':term', $search_term);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
}
?>
