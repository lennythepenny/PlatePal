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
        // Database connection (adjust as necessary)
        require_once '../model/database.php';
        
        // Fetch the logo image path from the site_media table
        $query = "SELECT media_filename FROM site_media WHERE media_type = 'logo' LIMIT 1";
        $result = $db->query($query);
        $logo = $result->fetch();
        
        if ($logo) {
            echo '<img src="' . htmlspecialchars($logo['media_filename']) . '" alt="Plate Pal Logo" class="logo">';
        } else {
            echo '<h1>Plate Pal</h1>'; // Fallback text if logo is not available
        }
        ?>
        <h2>Find your favorite recipe!</h2>
    </header>
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
</body>
</html>
