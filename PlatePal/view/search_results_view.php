<?php include('header.php'); ?>
<main>
    <h2>Search Results</h2>
    <?php if (!empty($results)): ?>
        <?php foreach ($results as $recipe): ?>
            <p><a href="../controller/recipe_controller.php?recipe_id=<?php echo $recipe['id']; ?>">
                <?php echo htmlspecialchars($recipe['title']); ?>
            </a></p>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No recipes found for "<?php echo htmlspecialchars($term); ?>"</p>
    <?php endif; ?>
</main>
<?php include('footer.php'); ?>
