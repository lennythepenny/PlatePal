<?php include('header.php'); ?>
<main>
    <form action="../controller/search_controller.php" method="post">
        <input type="text" name="search_term" placeholder="Search by ingredient or meal type">
        <button type="submit" name="search">Search</button>
    </form>
</main>

<?php include('footer.php'); ?>
