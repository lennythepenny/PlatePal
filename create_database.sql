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

-- Step 5: Users Table
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash CHAR(64) NOT NULL, -- for storing hashed passwords
    email VARCHAR(255) UNIQUE NOT NULL
);

-- Step 6: Recipe Categories Table - Linking Recipes to Categories
CREATE TABLE recipe_categories (
    recipe_category_id INT AUTO_INCREMENT PRIMARY KEY,
    recipe_id INT NOT NULL,
    category_id INT NOT NULL,
    FOREIGN KEY (recipe_id) REFERENCES recipes(recipe_id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(category_id) ON DELETE CASCADE
);

-- Step 7: User-Saved Recipes Table - Linking Users to Saved Recipes
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
('Vegan Tofu Stir-fry', 'Stir-fry tofu and veggies, serve with rice', 20, 2, '{"calories": 300, "protein": 15, "carbs": 40}', 1);

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
('Rice');

-- Link recipes to ingredients
INSERT INTO recipe_ingredients (recipe_id, ingredient_id) VALUES
-- Vegan Avocado Toast
(1, 1), -- Avocado
(1, 2), -- Toast
(1, 3), -- Salt
(1, 4), -- Pepper
(1, 5), -- Lemon
-- Vegan Buddha Bowl
(2, 6), -- Quinoa
(2, 7), -- Chickpeas
(2, 1), -- Avocado
-- Vegan Tofu Stir-fry
(3, 8), -- Tofu
(3, 9), -- Bell Peppers
(3, 10); -- Rice

-- Link recipes to categories
INSERT INTO recipe_categories (recipe_id, category_id) VALUES
(1, 1), -- Vegan Avocado Toast linked to Vegan category
(2, 1), -- Vegan Buddha Bowl linked to Vegan category
(3, 1); -- Vegan Tofu Stir-fry linked to Vegan category

-- Insert sample users
INSERT INTO users (username, password_hash, email) VALUES 
('user1', SHA2('password1', 256), 'user1@example.com'),
('user2', SHA2('password2', 256), 'user2@example.com'),
('user3', SHA2('password3', 256), 'user3@example.com');

-- Link users to saved recipes
INSERT INTO user_saved_recipes (user_id, recipe_id) VALUES
(1, 1), -- user1 saved Vegan Avocado Toast
(2, 2), -- user2 saved Vegan Buddha Bowl
(3, 3); -- user3 saved Vegan Tofu Stir-fry
