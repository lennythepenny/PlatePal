<?php include('header.php'); ?>

<main>
    <!-- Dynamic Navigation Based on Login Status -->
    <nav>
        <a href="../controller/index.php">Home</a> | <!-- Redirect to the home controller -->
        <?php if (isset($isLoggedIn) && $isLoggedIn): ?>
            <!-- If the user is logged in, show the account page link -->
            <a href="../view/account_view.php">My Account</a> | 
            <a href="../controller/logout.php">Logout</a> <!-- Add logout link -->
        <?php else: ?>
            <!-- If the user is not logged in, show login and sign-up links -->
            <a href="../view/login_view.php">Login</a> | 
            <a href="../view/register_view.php">Sign Up</a>
        <?php endif; ?>
    </nav>
    <h3>Home</h3>
    <form action="../controller/search_controller.php" method="post">
        <input type="text" name="search_term" placeholder="Search by ingredient or meal type">
        <button type="submit" name="search">Search</button>
    </form>
</main>

<?php include('footer.php'); ?>
