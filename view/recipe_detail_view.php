<?php include('header.php'); ?>

<main>
    <!-- Recipe Details Section -->
    <section class="recipe-details">
        <h2 class="recipe-title"><?php echo htmlspecialchars($recipe['title']); ?></h2>

        <!-- Display Recipe Image -->
        <div class="recipe-image">
            <?php
                // Fetch the image URL from the database
                $image_query = "SELECT image_filename FROM images WHERE recipe_id = " . $recipe['id'];
                $image_result = mysqli_query($conn, $image_query);
                $image = mysqli_fetch_assoc($image_result);
                
                if ($image) {
                    echo '<img src="' . htmlspecialchars($image['image_filename']) . '" alt="' . htmlspecialchars($recipe['title']) . '" class="recipe-image-display">';
                } else {
                    echo '<p>No image available.</p>';
                }
            ?>
        </div>
        <div class="recipe-info">
            <p><strong>Cooking Time:</strong> <?php echo htmlspecialchars($recipe['cooking_time']); ?> minutes</p>
            <p><strong>Serving Size:</strong> <?php echo htmlspecialchars($recipe['servings']); ?> servings</p>
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
        <div class="nutrition-info">
            <div class="nutrition-item">
                <strong>Calories:</strong> <?php echo htmlspecialchars($recipe['nutrition_info']['calories']); ?> kcal
            </div>
            <div class="nutrition-item">
                <strong>Protein:</strong> <?php echo htmlspecialchars($recipe['nutrition_info']['protein']); ?> g
            </div>
            <div class="nutrition-item">
                <strong>Carbohydrates:</strong> <?php echo htmlspecialchars($recipe['nutrition_info']['carbs']); ?> g
            </div>
        </div>
    </section>
</main>

<?php include('footer.php'); ?>
</body>
</html>
