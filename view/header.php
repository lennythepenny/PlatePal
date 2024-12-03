<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plate Pal</title>
    <link rel="stylesheet" href="../main.css">
</head>
<body>
<header>
        <?php
        //needed DB connection
        require_once '../model/database.php';

        //local file path for logo image
        $logo_path = '../images/plate_pal_plate.png'; 
        
        //make sure logo file exists
        if (file_exists($logo_path)) {
            echo '<img src="' . htmlspecialchars($logo_path) . '" alt="Plate Pal Logo" class="logo">';
        } else {
            //default if logo not available
            echo '<h1>Plate Pal</h1>';
        }
        ?>
        <h2>Find your favorite recipe!</h2>
    </header>
        <!-- Dynamic Navigation Based on Login Status -->
        <nav>
            <a href="../controller/index.php">Home</a> | <!-- Redirect to the home controller -->
            <?php if (isset($_SESSION['username'])): ?>
                <!-- If the user is logged in, show the account page link -->
                <a href="../view/account_view.php">My Account</a> | 
                <a href="../controller/account_controller.php?action=logout">Logout</a> <!-- Add logout link -->
            <?php else: ?>
                <!-- If the user is not logged in, show login and sign-up links -->
                <a href="../view/login_view.php">Login</a> | 
                <a href="../view/register_view.php">Sign Up</a>
            <?php endif; ?>
        </nav>
<!-- REMOVE BANNER IF IT LOOKS UGLY LOL-->
        <section class="footer-banner">
            <img src="../images/food_footer_image.png" alt="Banner Image" />
        </section>
</body>
</html>