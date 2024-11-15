<?php
// Start the session to check for login status
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('header.php');

// If the user is not logged in, redirect to the login page
if (!isset($_SESSION['username'])) {
    header('Location: login_view.php');
    exit();
}

$isLoggedIn = true; // Set to true if the user is logged in

// Fetch saved recipes for the logged-in user if they are not already set
if (!isset($saved_recipes)) {
    require_once('../model/user_db.php');  // Or wherever getSavedRecipes() is defined
    $saved_recipes = getSavedRecipes($_SESSION['user_id']);
}

// Display saved recipes for the logged-in user
if (isset($saved_recipes) && is_array($saved_recipes)) {
?>
<main>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h2>
    <p>Your Saved Recipes:</p>

    <?php if (!empty($saved_recipes)): ?>
        <?php foreach ($saved_recipes as $recipe): ?>
            <div class="saved-recipe">
                <!-- Make the recipe title a clickable link, directing to recipe_controller.php with the recipe_id -->
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
    // In case the controller did not pass $saved_recipes (e.g., an error occurred)
    echo '<p>Error fetching saved recipes.</p>';
}

include('footer.php');
?>
