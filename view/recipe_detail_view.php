<?php include('header.php'); ?>

<main>
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
</body>
</html>