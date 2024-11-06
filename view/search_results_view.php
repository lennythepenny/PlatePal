<?php include('header.php'); ?>
<main>
    <h2>Search Results for "<?php echo htmlspecialchars($term); ?>"</h2>
    
    <?php if (!empty($results)): ?>
        <ul>
            <?php foreach ($results as $recipe): ?>
                <li>
                    <a href="../controller/recipe_controller.php?recipe_id=<?php echo $recipe['recipe_id']; ?>">
                        <?php echo htmlspecialchars($recipe['title']); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No recipes found for "<?php echo htmlspecialchars($term); ?>"</p>
    <?php endif; ?>
</main>
<?php include('footer.php'); ?>
