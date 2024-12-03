<?php include('header.php'); ?>
<main>
    <!-- Display the term the user just typed in -->
    <h2>Search Results for "<?php echo htmlspecialchars($term); ?>"</h2>
    
    <?php if (!empty($results)): ?>
        <ul>
            <!-- Display the results based on what was searched -->
            <?php foreach ($results as $recipe): ?>
                <li>
                    <a href="../controller/recipe_controller.php?recipe_id=<?php echo $recipe['recipe_id']; ?>">
                        <?php echo htmlspecialchars($recipe['title']); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <!-- Unable to find a recipe for that term -->
    <?php else: ?>
        <p>No recipes found for "<?php echo htmlspecialchars($term); ?>"</p>
    <?php endif; ?>
</main>
<?php include('footer.php'); ?>
