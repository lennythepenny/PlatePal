<?php
// Handles search queries by meal type or ingredient
require_once('../model/recipe_db.php'); // corrected from search_db.php

if (isset($_POST['search'])) {
    // Sanitize the search term input
    $term = filter_input(INPUT_POST, 'search_term', FILTER_SANITIZE_STRING);
    
    // Fetch search results from the model
    $results = searchRecipes($term);
    
    // Pass results to the search results view
    include('../view/search_results_view.php');
} else {
    // Fallback if accessed without a search term
    include('../view/index_view.php');
}
?>
