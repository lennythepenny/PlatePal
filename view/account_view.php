<?php
//start session, check login status
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('header.php');

//user not logged in, redirect to login page
if (!isset($_SESSION['username'])) {
    header('Location: login_view.php');
    exit();
}
//user logs in
$isLoggedIn = true;

//get saved recipes for the logged-in user if they not set
if (!isset($saved_recipes)) {
    require_once('../model/user_db.php');
    $saved_recipes = getSavedRecipes($_SESSION['user_id']);
}
//displaying saved recipes for the logged-in user
if (isset($saved_recipes) && is_array($saved_recipes)) {
?>
<main>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h2>
    <p>Your Saved Recipes:</p>

    <?php if (!empty($saved_recipes)): ?>
        <?php foreach ($saved_recipes as $recipe): ?>
            <div class="saved-recipe">
                <!-- Recipe title is a clickable link, directing to recipe_controller.php with the recipe_id -->
                <h3>
                    <a href="../controller/recipe_controller.php?recipe_id=<?php echo htmlspecialchars($recipe['recipe_id']); ?>">
                        <?php echo htmlspecialchars($recipe['title']); ?>
                    </a>
                </h3>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>You don't have any saved recipes yet.</p>
    <?php endif; ?>
</main>

<?php
} else {
    //controller didn't pass $saved_recipes
    echo '<p>Error fetching saved recipes.</p>';
}

include('footer.php');
?>
