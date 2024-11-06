-- Drop existing tables if they exist
DROP TABLE IF EXISTS user_saved_recipes;
DROP TABLE IF EXISTS recipe_categories;
DROP TABLE IF EXISTS recipe_ingredients;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS ingredients;
DROP TABLE IF EXISTS recipes;
DROP TABLE IF EXISTS categories;

-- Step 1: Categories Table
CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- Step 2: Recipes Table
CREATE TABLE recipes (
    recipe_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    instructions TEXT NOT NULL,
    cooking_time INT, -- in minutes
    servings INT,
    nutrition_info JSON,
    category_id INT,
    FOREIGN KEY (category_id) REFERENCES categories(category_id) ON DELETE CASCADE
);

-- Step 3: Ingredients Table
CREATE TABLE ingredients (
    ingredient_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE
);
-- Step 4: Recipe Ingredients Table - Linking Recipes to Ingredients
CREATE TABLE recipe_ingredients (
    recipe_id INT,
    ingredient_id INT,
    PRIMARY KEY (recipe_id, ingredient_id),
    FOREIGN KEY (recipe_id) REFERENCES recipes(recipe_id) ON DELETE CASCADE,
    FOREIGN KEY (ingredient_id) REFERENCES ingredients(ingredient_id) ON DELETE CASCADE
);
-- Step 4: Users Table
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash CHAR(64) NOT NULL, -- for storing hashed passwords
    email VARCHAR(255) UNIQUE NOT NULL
);

-- Step 5: Recipe Categories Table - Linking Recipes to Categories
CREATE TABLE recipe_categories (
    recipe_category_id INT AUTO_INCREMENT PRIMARY KEY,
    recipe_id INT NOT NULL,
    category_id INT NOT NULL,
    FOREIGN KEY (recipe_id) REFERENCES recipes(recipe_id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(category_id) ON DELETE CASCADE
);

-- Step 6: User-Saved Recipes Table - Linking Users to Saved Recipes
CREATE TABLE user_saved_recipes (
    saved_recipe_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    recipe_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (recipe_id) REFERENCES recipes(recipe_id) ON DELETE CASCADE
);

-- Insert sample categories
INSERT INTO categories (name) VALUES
('Vegan'),
('Chicken'),
('Soup'),
('Beef'),
('Pork'),
('Chinese'),
('Mexican'),
('Mediterranean');

-- Insert sample recipes
INSERT INTO recipes (title, instructions, cooking_time, servings, nutrition_info, category_id) VALUES
('Vegan Avocado Toast', 'Mash avocado, season, spread on toast', 5, 1, '{"calories": 200, "protein": 3, "carbs": 22}', 1),
('Vegan Buddha Bowl', 'Cook quinoa, assemble ingredients in a bowl', 15, 1, '{"calories": 400, "protein": 10, "carbs": 60}', 1),
('Vegan Tofu Stir-fry', 'Stir-fry tofu and veggies, serve with rice', 20, 2, '{"calories": 300, "protein": 15, "carbs": 40}', 1),
('Lemon Herb Chicken', 'Marinate chicken, bake with lemon and herbs', 30, 4, '{"calories": 250, "protein": 30, "carbs": 2}', 2),
('Chicken Alfredo', 'Cook chicken in creamy alfredo sauce, serve with pasta', 40, 4, '{"calories": 600, "protein": 35, "carbs": 45}', 2),
('Grilled Chicken Salad', 'Grill chicken, add to mixed greens with dressing', 20, 2, '{"calories": 350, "protein": 28, "carbs": 10}', 2),
('Tomato Basil Soup', 'Simmer tomatoes with basil, blend', 25, 3, '{"calories": 150, "protein": 4, "carbs": 20}', 3),
('Chicken Noodle Soup', 'Simmer chicken, noodles, and vegetables in broth', 45, 4, '{"calories": 200, "protein": 15, "carbs": 25}', 3),
('Lentil Soup', 'Cook lentils with carrots, celery, and spices', 30, 4, '{"calories": 180, "protein": 12, "carbs": 30}', 3),
('Beef Stew', 'Slow-cook beef with veggies and broth', 120, 5, '{"calories": 350, "protein": 40, "carbs": 30}', 4),
('Beef Tacos', 'Cook beef with taco seasoning, serve with tortillas and toppings', 20, 4, '{"calories": 250, "protein": 20, "carbs": 20}', 4),
('Beef Stir-fry', 'Stir-fry beef with veggies in soy sauce', 25, 3, '{"calories": 300, "protein": 25, "carbs": 15}', 4),
('BBQ Pork Ribs', 'Grill pork ribs with BBQ sauce', 60, 4, '{"calories": 500, "protein": 35, "carbs": 20}', 5),
('Pork Schnitzel', 'Bread and fry pork cutlets, serve with lemon', 45, 4, '{"calories": 400, "protein": 35, "carbs": 30}', 5),
('Pork Stir-fry', 'Stir-fry pork with vegetables and soy sauce', 25, 4, '{"calories": 350, "protein": 30, "carbs": 25}', 5),
('Sweet and Sour Chicken', 'Stir-fry chicken with sweet and sour sauce', 25, 3, '{"calories": 400, "protein": 25, "carbs": 50}', 6),
('Kung Pao Chicken', 'Cook chicken with peanuts, peppers, and soy sauce', 30, 3, '{"calories": 350, "protein": 30, "carbs": 20}', 6),
('Chinese Fried Rice', 'Stir-fry rice with veggies, egg, and soy sauce', 20, 4, '{"calories": 250, "protein": 8, "carbs": 40}', 6),
('Tacos', 'Fill tortillas with seasoned beef, lettuce, cheese', 15, 4, '{"calories": 200, "protein": 10, "carbs": 15}', 7),
('Chicken Quesadillas', 'Fill tortillas with chicken, cheese, and cook', 20, 4, '{"calories": 350, "protein": 25, "carbs": 30}', 7),
('Mexican Rice', 'Cook rice with tomatoes, onions, and spices', 30, 4, '{"calories": 200, "protein": 5, "carbs": 40}', 7),
('Greek Salad', 'Mix cucumbers, tomatoes, feta, olives', 10, 2, '{"calories": 180, "protein": 5, "carbs": 10}', 8),
('Falafel', 'Blend chickpeas, parsley, garlic, and onions, fry into balls', 40, 4, '{"calories": 350, "protein": 15, "carbs": 40}', 8),
('Hummus', 'Blend chickpeas with tahini, garlic, and lemon', 15, 4, '{"calories": 250, "protein": 10, "carbs": 30}', 8);

-- Insert sample ingredients
INSERT INTO ingredients (name) VALUES
('Avocado'),
('Toast'),
('Salt'),
('Pepper'),
('Lemon'),
('Quinoa'),
('Chickpeas'),
('Tofu'),
('Bell Peppers'),
('Rice'),
('Chicken'),
('Tomato'),
('Basil'),
('Beef'),
('Carrot'),
('Onion'),
('Pork'),
('BBQ Sauce'),
('Bell Pepper'),
('Tortilla'),
('Lettuce'),
('Cheese'),
('Cucumber'),
('Feta Cheese'),
('Olives'),
('Tahini'),
('Egg'),
('Peanut'),
('Soy Sauce');

-- Insert into recipe_ingredients
INSERT INTO recipe_ingredients (recipe_id, ingredient_id) VALUES
(1, 1), (1, 2), (1, 3), (1, 4), (1, 5),
(2, 6), (2, 7), (2, 1),
(3, 8), (3, 9), (3, 10),
(4, 11), (4, 5), (4, 3), (4, 4),
(5, 11), (5, 22), (5, 10), (5, 29), (5, 19),
(6, 11), (6, 21), (6, 23),
(7, 12), (7, 13), (7, 3),
(8, 11), (8, 15), (8, 16),
(9, 7), (9, 15), (9, 16),
(10, 14), (10, 15), (10, 16),
(11, 14), (11, 20), (11, 21), (11, 22),
(12, 14), (12, 9), (12, 10),
(13, 17), (13, 18),
(14, 17), (14, 3),
(15, 17), (15, 9), (15, 10),
(16, 11), (16, 19), (16, 5),
(17, 11), (17, 9), (17, 28), (17, 29),
(18, 10), (18, 22),
(19, 14), (19, 20), (19, 21),
(20, 11), (20, 22), (20, 19),
(21, 10),
(22, 23), (22, 12), (22, 24),
(23, 7), (23, 26), (23, 19),
(24, 7), (24, 26), (24, 5);


-- Link recipes to categories
INSERT INTO recipe_categories (recipe_id, category_id) VALUES
(1, 1), (2, 1), (3, 1),
(4, 2), -- Chicken category
(5, 3), -- Soup category
(6, 4), -- Beef category
(7, 5), -- Pork category
(8, 6), -- Chinese category
(9, 7), -- Mexican category
(10, 8); -- Mediterranean category

-- Insert sample users
INSERT INTO users (username, password_hash, email) VALUES 
('user1', SHA2('password1', 256), 'user1@example.com'),
('user2', SHA2('password2', 256), 'user2@example.com');
