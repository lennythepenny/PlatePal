<?php 
include('header.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<main>
<!-- Recipe Details Section -->
<section class="recipe-details">
        <h2 class="recipe-title"><?php echo htmlspecialchars($recipe['title']); ?></h2>
        
        <?php if (isset($_SESSION['username'])): ?>
            <!-- Show Save Recipe Button only if the user is logged in -->
            <form action="../controller/recipe_controller.php" method="POST">
                <input type="hidden" name="action" value="save_recipe">
                <input type="hidden" name="recipe_id" value="<?= $recipe['recipe_id']; ?>">
                <input type="hidden" name="user_id" value="<?= $_SESSION['user_id']; ?>">
                <button type="submit">Save Recipe</button>
            </form>
        <?php endif; ?>

        <!-- Recipe Image -->
        <div class="recipe-image">
            <?php
            //define image filename based on the recipe title
            $image_filename = strtolower(str_replace(" ", "_", $recipe['title'])) . '.jpg';

            //different local image formats if not jpg
            $image_formats = ['jpg', 'jpeg', 'png', 'webp', 'avif'];
            $image_found = false;
            //look for specific image for recipe detail page
            foreach ($image_formats as $format) {
                $image_path = '../images/' . strtolower(str_replace(" ", "_", $recipe['title'])) . '.' . $format;
                if (file_exists($image_path)) {
                    echo "<img src='$image_path' alt='" . htmlspecialchars($recipe['title']) . "' />";
                    $image_found = true;
                    break;
                }
            }

            //no recipe image found
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
                    //make sure ingredients are stored comma separated
                    $ingredients = explode(',', $recipe['ingredients']);
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
                    //instructions separated by periods
                    $instructions = explode('.', $recipe['instructions']);
                    foreach ($instructions as $instruction): 
                        if (!empty(trim($instruction))):
                ?>
                    <li><?php echo htmlspecialchars(trim($instruction)); ?></li>
                <?php endif; endforeach; ?>
            </ol>
        </div>

        <!-- Nutritional Details with White Boxes -->
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