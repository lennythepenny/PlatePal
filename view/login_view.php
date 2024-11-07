<?php include('header.php'); ?>

<main>
    <!-- Dynamic Navigation Based on Login Status -->
    <nav>
        <a href="../controller/index.php">Home</a> | <!-- Redirect to the home controller -->
        <?php if (isset($isLoggedIn) && $isLoggedIn): ?>
            <a href="../view/account_view.php">My Account</a> | 
            <a href="../controller/logout.php">Logout</a>
        <?php else: ?>
            <a href="../view/login_view.php">Login</a> | 
            <a href="../view/register_view.php">Sign Up</a>
        <?php endif; ?>
    </nav>
    <h3>Login</h3>        
    <form action="../controller/account_controller.php" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>
</main>

<?php include('footer.php'); ?>

