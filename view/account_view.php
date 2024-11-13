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

// Fetch saved recipes for the logged-in user
if (isset($saved_recipes)) {  // Make sure saved_recipes is set by the controller
?>
<main>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h2>
    <p>Your Saved Recipes:</p>

    <?php if (!empty($saved_recipes)): ?>
        <?php foreach ($saved_recipes as $recipe): ?>
            <div class="saved-recipe">
                <h3><?php echo htmlspecialchars($recipe['title']); ?></h3>
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
