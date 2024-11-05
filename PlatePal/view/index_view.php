<?php include('header.php'); ?>
<main>
    <h2>Find Your Perfect Recipe</h2>
    <form action="../controller/search_controller.php" method="post">
        <input type="text" name="search_term" placeholder="Search by ingredient or meal type">
        <button type="submit" name="search">Search</button>
    </form>
</main>
<?php include('footer.php'); ?>
