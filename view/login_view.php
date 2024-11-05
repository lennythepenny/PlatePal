<?php include('header.php'); ?>
<main>
    <h2>Login</h2>
    <form action="../controller/account_controller.php" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <button type="submit" name="login">Login</button>
    </form>
</main>
<?php include('footer.php'); ?>
