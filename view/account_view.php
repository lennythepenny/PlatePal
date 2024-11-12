<?php
    // Start the session to check for login status
    session_start();

    // If the user is not logged in, redirect to the login page
    if (!isset($_SESSION['username'])) {
        header('Location: login_view.php');
        exit();
    }
    $isLoggedIn = true;
?>

<?php include('header.php'); ?>
<main>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h2>
    <p>Your Saved Recipes:</p>
    <!-- Display saved recipes -->
</main>
<?php include('footer.php'); ?>
