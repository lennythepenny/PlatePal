<?php include('header.php'); ?>

<main>
    <h2>Welcome to Plate Pal</h2>
    
    <?php if (isset($_SESSION['username'])): ?>
        <p>You are already logged in as <?php echo htmlspecialchars($_SESSION['username']); ?>.</p>
        <a href="account_view.php">Go to your account</a>
    <?php else: ?>
        <p>Please log in or create an account to continue.</p>
        <a href="login_view.php">Login</a> | <a href="register_view.php">Sign Up</a>
    <?php endif; ?>
</main>

<?php include('footer.php'); ?>
