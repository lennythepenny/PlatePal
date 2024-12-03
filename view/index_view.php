<?php include('header.php'); ?>
<main>
<h3>Home</h3>
    <form action="../controller/search_controller.php" method="post">
        <!-- Search Form for Recipes -->
        <input type="text" name="search_term" placeholder="Search by ingredient or meal type">
        <button type="submit" name="search">Search</button>
    </form>
</main>

<?php include('footer.php'); ?>
