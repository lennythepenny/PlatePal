<?php
//search queries by meal type or ingredient
require_once('../model/recipe_db.php');

if (isset($_POST['search'])) {
    $term = filter_input(INPUT_POST, 'search_term', FILTER_SANITIZE_STRING);
    
    //search results from model
    $results = searchRecipes($term);
    
    //results and search term passed to view
    include('../view/search_results_view.php');
} else {
    //accessed without search term
    include('../view/index_view.php');
}
?>
