<?php
//handle recipes by search terms
function searchRecipes($term) {
    global $db;
    $query = 'SELECT * FROM recipes WHERE ingredients LIKE :term OR meal_type LIKE :term';
    $statement = $db->prepare($query);
    $statement->bindValue(':term', '%' . $term . '%');
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
}
?>
