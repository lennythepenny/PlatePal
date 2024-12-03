<?php include('header.php'); ?>
<main>
<h3>Log In</h3>
<!-- Login Form       -->
    <form action="../controller/account_controller.php?action=logout" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>
</main>
<?php include('footer.php'); ?>
