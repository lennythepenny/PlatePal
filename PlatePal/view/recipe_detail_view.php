<?php include('header.php'); ?>
<main>
    <h2><?php echo htmlspecialchars($recipe['title']); ?></h2>
    <p><strong>Ingredients:</strong> <?php echo htmlspecialchars($recipe['ingredients']); ?></p>
    <p><strong>Instructions:</strong> <?php echo htmlspecialchars($recipe['instructions']); ?></p>
    <p><strong>Cooking Time:</strong> <?php echo htmlspecialchars($recipe['cooking_time']); ?> minutes</p>
</main>
<?php include('footer.php'); ?>
