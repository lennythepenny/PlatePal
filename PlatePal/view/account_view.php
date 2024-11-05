<?php include('header.php'); ?>
<main>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h2>
    <p>Your Saved Recipes:</p>
    <!-- Display saved recipes -->
</main>
<?php include('footer.php'); ?>
