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

    <!-- Recipe Details Section -->
    <section class="recipe-details">
        <h2><?php echo htmlspecialchars($recipe['title']); ?></h2>

        <div class="recipe-info">
            <p><strong>Cooking Time:</strong> <?php echo htmlspecialchars($recipe['cooking_time']); ?> minutes</p>
            <p><strong>Serving Size:</strong> 4 servings</p>
        </div>

        <!-- Ingredients List -->
        <h4>Ingredients:</h4>
        <ul>
            <?php 
                $ingredients = explode(',', $recipe['ingredients']); // Assuming ingredients are stored as a comma-separated string
                foreach ($ingredients as $ingredient): 
            ?>
                <li><?php echo htmlspecialchars($ingredient); ?></li>
            <?php endforeach; ?>
        </ul>

        <!-- Cooking Instructions -->
        <h4>Instructions:</h4>
        <ol>
            <?php 
                $instructions = explode('.', $recipe['instructions']); // Assuming instructions are stored as a period-separated string
                foreach ($instructions as $instruction): 
                    if (!empty(trim($instruction))): // Skip empty instructions
            ?>
                <li><?php echo htmlspecialchars(trim($instruction)); ?></li>
            <?php endif; endforeach; ?>
        </ol>

        <!-- Nutritional Details -->
        <h4>Nutritional Information (per serving):</h4>
        <table>
            <tr>
                <th>Calories</th>
                <td><?php echo htmlspecialchars($recipe['calories']); ?></td>
            </tr>
            <tr>
                <th>Protein</th>
                <td><?php echo htmlspecialchars($recipe['protein']); ?>g</td>
            </tr>
            <tr>
                <th>Fat</th>
                <td><?php echo htmlspecialchars($recipe['fat']); ?>g</td>
            </tr>
            <tr>
                <th>Carbohydrates</th>
                <td><?php echo htmlspecialchars($recipe['carbohydrates']); ?>g</td>
            </tr>
        </table>
    </section>
</main>

<?php include('footer.php'); ?>

<footer>
    <p>&copy; 2024 Plate Pal. All Rights Reserved.</p>
</footer>
</body>
</html>