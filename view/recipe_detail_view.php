<?php include('header.php'); ?>

<main>
<!-- Recipe Details Section -->
<section class="recipe-details">
        <h2 class="recipe-title"><?php echo htmlspecialchars($recipe['title']); ?></h2>

        <!-- Recipe Image -->
        <div class="recipe-image">
            <?php
            // Define the image filename based on the recipe title or any identifier you prefer
            $image_filename = strtolower(str_replace(" ", "_", $recipe['title'])) . '.jpg'; // Default to jpg

            // If you have different formats, you can check for them here:
            $image_formats = ['jpg', 'jpeg', 'png', 'webp', 'avif'];
            $image_found = false;

            foreach ($image_formats as $format) {
                $image_path = '../images/' . strtolower(str_replace(" ", "_", $recipe['title'])) . '.' . $format;
                if (file_exists($image_path)) {
                    echo "<img src='$image_path' alt='" . htmlspecialchars($recipe['title']) . "' />";
                    $image_found = true;
                    break;  // Stop checking once the image is found
                }
            }

            // Fallback in case no image was found
            if (!$image_found) {
                echo "<p>No image available for this recipe.</p>";
            }
            ?>
        </div>

        <div class="recipe-info">
            <p><strong>Cooking Time:</strong> <?php echo htmlspecialchars($recipe['cooking_time']); ?> minutes</p>
            <p><strong>Serving Size:</strong> <?php echo htmlspecialchars($recipe['servings']); ?> servings</p>
        </div>

<!-- Ingredients List with White Box -->
<div class="recipe-box">
            <h4>Ingredients:</h4>
            <ul>
                <?php 
                    $ingredients = explode(',', $recipe['ingredients']); // Assuming ingredients are stored as a comma-separated string
                    foreach ($ingredients as $ingredient): 
                ?>
                    <li><?php echo htmlspecialchars($ingredient); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Cooking Instructions with White Box -->
        <div class="recipe-box">
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
        </div>

        <!-- Nutritional Details with White Box -->
        <div class="recipe-box">
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
        </div>
    </section>
</main>

<?php include('footer.php'); ?>
</body>
</html>
