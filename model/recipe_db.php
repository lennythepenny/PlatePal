<?php
// Handles recipe data operations
require_once('database.php');

// Fetch a single recipe by ID, including ingredients
function getRecipeById($recipe_id) {
    global $db;
    $query = 'SELECT r.recipe_id, r.title, r.instructions, r.cooking_time, r.servings, r.nutrition_info, 
              GROUP_CONCAT(i.name ORDER BY i.name ASC SEPARATOR ", ") AS ingredients
              FROM recipes r
              JOIN recipe_ingredients ri ON r.recipe_id = ri.recipe_id
              JOIN ingredients i ON ri.ingredient_id = i.ingredient_id
              WHERE r.recipe_id = :recipe_id
              GROUP BY r.recipe_id';
    
    $statement = $db->prepare($query);
    $statement->bindValue(':recipe_id', $recipe_id, PDO::PARAM_INT);
    $statement->execute();
    $recipe = $statement->fetch();
    $statement->closeCursor();

    // Decode the nutrition_info JSON and handle missing data
    $nutrition_info = json_decode($recipe['nutrition_info'], true);
    $recipe['nutrition_info'] = [
        'calories' => isset($nutrition_info['calories']) ? $nutrition_info['calories'] : 'N/A',
        'protein' => isset($nutrition_info['protein']) ? $nutrition_info['protein'] : 'N/A',
        'carbs' => isset($nutrition_info['carbs']) ? $nutrition_info['carbs'] : 'N/A',
    ];

    return $recipe;
}


// Search for recipes by title or ingredients
function searchRecipes($term) {
    global $db;
    $search_term = '%' . $term . '%'; // For partial match

    // Corrected SQL query to search by ingredients and use DISTINCT to avorecipe_id duplicates
    $query = 'SELECT DISTINCT r.recipe_id, r.title, r.instructions, r.cooking_time, r.servings, r.nutrition_info
              FROM recipes r
              JOIN recipe_ingredients ri ON r.recipe_id = ri.recipe_id
              JOIN ingredients i ON ri.ingredient_id = i.ingredient_id
              WHERE r.title LIKE :term OR i.name LIKE :term';

    $statement = $db->prepare($query);
    $statement->bindValue(':term', $search_term);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();

    // Process the results to extract nutrition info
    foreach ($results as &$recipe) {
        $nutrition_info = json_decode($recipe['nutrition_info'], true);
        $recipe['nutrition_info'] = [
            'calories' => isset($nutrition_info['calories']) ? $nutrition_info['calories'] : 'N/A',
            'protein' => isset($nutrition_info['protein']) ? $nutrition_info['protein'] : 'N/A',
            'carbs' => isset($nutrition_info['carbs']) ? $nutrition_info['carbs'] : 'N/A',
        ];
    }

    return $results;
}

?>
