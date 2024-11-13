-- Drop existing tables if they exist
DROP TABLE IF EXISTS user_saved_recipes;
DROP TABLE IF EXISTS recipe_categories;
DROP TABLE IF EXISTS recipe_ingredients;
DROP TABLE IF EXISTS ingredients;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS recipes;
DROP TABLE IF EXISTS users;


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
    cooking_time INT,
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
-- Create table for storing images associated with recipes
CREATE TABLE images (
    image_id INT AUTO_INCREMENT PRIMARY KEY,
    recipe_id INT NOT NULL,
    image_filename VARCHAR(255) NOT NULL,
    upload_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (recipe_id) REFERENCES recipes(recipe_id)
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
('Vegan Avocado Toast', 'Mash avocado, season with salt & pepper and other desired seasonings, spread on toast and enjoy!', 5, 1, '{"calories": 200, "protein": 3, "carbs": 22}', 1),
('Vegan Buddha Bowl', 'Cook quinoa, While quinoa is cooking make sure to preapre other desired ingredients, Once quinoa is cooked assemble ingredients in a bowl and enjoy', 15, 1, '{"calories": 400, "protein": 10, "carbs": 60}', 1),
('Vegan Tofu Stir-fry', 'Stir-fry tofu and veggies in a hot pan or wok, while frying add some soy sauce to help add flavor, Once veggies are cooked to desired softness serve with rice', 20, 2, '{"calories": 300, "protein": 15, "carbs": 40}', 1),
('Lemon Herb Chicken', 'Marinate chicken in a bag with lemon jucie, garlic, and olive oil, after marinating for at least 2 hours, add marinated chicken into a pan & bake at 390 for 30 min with lemon and herbs', 30, 4, '{"calories": 250, "protein": 30, "carbs": 2}', 2),
('Chicken Alfredo', 'Grill chicken cutlets until done and slight crisp on the outside, then add cooked chicken into your creamy alfredo sauce and let simmer for 10 min, serve with pasta', 40, 4, '{"calories": 600, "protein": 35, "carbs": 45}', 2),
('Grilled Chicken Salad', 'Grill chicken cutlets, add to plate with mixed greens and your choice of dressing', 20, 2, '{"calories": 350, "protein": 28, "carbs": 10}', 2),
('Tomato Basil Soup', 'Simmer tomatoes, basil, and garlic until tomatoes are soft, once the tomatoes are soft add mixture to a blender and blend until desired consistencey', 25, 3, '{"calories": 150, "protein": 4, "carbs": 20}', 3),
('Chicken Noodle Soup', 'Boil whole chicken in a pot with vegetables, poultry herbs & seasonings, once fully cooked strip and shred the chicken meat and add noodles into the pot with vegetables in broth, serve once noodles & veggies are cooked thru', 45, 4, '{"calories": 200, "protein": 15, "carbs": 25}', 3),
('Lentil Soup', 'Boil/Simmer lentils with carrots, celery, and spices in a pot until done', 30, 4, '{"calories": 180, "protein": 12, "carbs": 30}', 3),
('Beef Stew', 'Slow-cook beef in a crock pot with veggies, broth, aeromatics and any other desired seasonings, let stew for 4-6 hours minimum giving it an ocasional stir, serve ontop of rice and enjoy', 120, 5, '{"calories": 350, "protein": 40, "carbs": 30}', 4),
('Beef Tacos', 'SautÃ© beef in a pan, once the beef is almost halfway done cooking add in taco seasoning, serve with tortillas and toppings', 20, 4, '{"calories": 250, "protein": 20, "carbs": 20}', 4),
('Beef Stir-fry', 'Stir-fry beef with veggies in soy sauce, Once beef & veggies are cooked through serve on bed of rice', 25, 3, '{"calories": 300, "protein": 25, "carbs": 15}', 4),
('BBQ Pork Ribs', 'Prep pork ribs with mixture of BBQ sauce and grill rubs let marinate for 15 min minimum, Preheat the grill/smoker to 225 degrees, Put onto grill/smoker and let cook until they reach an internal temp of 200 degrees then once taken off the grill let the ribs rest for 15 min and enjoy', 60, 4, '{"calories": 500, "protein": 35, "carbs": 20}', 5),
('Pork Schnitzel', 'Use a mallet to thin the pork cutlets into 1/4" cutlets, Prepare breading mixtures and use them to bread the pork cutlets, Add breaded cutlets to hot frying pan, once fully cooked through serve right away with lemon or ranch', 45, 4, '{"calories": 400, "protein": 35, "carbs": 30}', 5),
('Pork Stir-fry', 'Stir-fry pork with veggies in soy sauce, Once pork & veggies are cooked through serve on bed of rice', 25, 4, '{"calories": 350, "protein": 30, "carbs": 25}', 5),
('Sweet and Sour Chicken', 'Cut chicken into small 1 inch chunks, add chicken cubes into a bowl and add spices (salt, peper, garlic, and onion powder) to the bowl then mix until the chicken is evenly covered, create a batter out of flour, corn starch, and baking soda, batter the chicken before adding to the preheated fyring pan, after chicken has been fried add the sweet n sour sauce and mix until chicken is evenly coated and serve on bed of rice', 25, 3, '{"calories": 400, "protein": 25, "carbs": 50}', 6),
('Kung Pao Chicken', 'Marinate chicken in soy sauce, rice vinegar, hoisin sauce, and cornstarch for 10-15 minutes. Heat oil in a pan over medium heat. Stir-fry chicken until cooked through, then set aside, In the same pan, add garlic, ginger, and chilies, stir-frying until fragrant, Add bell pepper, green onions, and peanuts. Stir-fry for a few minutes, Return chicken to the pan, toss everything together, and season as needed, Serve hot with rice', 30, 3, '{"calories": 350, "protein": 30, "carbs": 20}', 6),
('Chinese Fried Rice', 'Heat oil in a pan over medium heat. Add eggs, scrambling them until fully cooked, then set aside, In the same pan, add vegetables and stir-fry until tender, Add the rice, soy sauce, and scrambled eggs, mixing well, Stir-fry for a few more minutes until rice is heated through, Garnish with green onions and serve.', 20, 4, '{"calories": 250, "protein": 8, "carbs": 40}', 6),
('Tacos', 'Cook ground meat in a pan over medium heat until browned, then drain excess fat, Add taco seasoning and a small amount of water (per package instructions), stirring until the meat is coated and the sauce thickens, Warm taco shells or tortillas, Fill each shell with meat, lettuce, cheese, tomato, and any additional toppings you like, Serve immediately.', 15, 4, '{"calories": 200, "protein": 10, "carbs": 15}', 7),
('Chicken Quesadillas', 'Heat a skillet over medium heat with butter or oil, Place one tortilla in the pan, add chicken, cheese, and bell pepper on half of the tortilla, then fold it over, Cook until the bottom is golden and the cheese is melted, then flip to cook the other side, Remove from the pan, slice, and serve hot.', 20, 4, '{"calories": 350, "protein": 25, "carbs": 30}', 7),
('Mexican Rice', 'Heat oil in a saucepan over medium heat. Add rice and cook, stirring constantly, until it turns golden, Add onion and garlic, cooking until softened, Pour in chicken broth and tomato sauce, stirring well, Cover, reduce heat, and simmer for 20 minutes, or until the liquid is absorbed, Fluff with a fork and serve.', 30, 4, '{"calories": 200, "protein": 5, "carbs": 40}', 7),
('Greek Salad', 'Mix cucumbers, tomatoes, feta, olives', 10, 2, '{"calories": 180, "protein": 5, "carbs": 10}', 8),
('Falafel', 'Blend chickpeas, parsley, cilantro, garlic, cumin, and coriander in a food processor until slightly chunky, Add flour, salt, and pepper, mixing well, Form into small balls or patties, Heat oil in a skillet over medium-high heat and fry the falafel until golden brown on both sides, Drain on paper towels and serve with tahini or yogurt sauce.', 40, 4, '{"calories": 350, "protein": 15, "carbs": 40}', 8),
('Hummus', 'In a food processor, blend chickpeas, tahini, garlic, olive oil, lemon juice, and salt, Add water as needed until the hummus is smooth and reaches the desired consistency, Adjust seasoning, and serve with pita or vegetables.', 15, 4, '{"calories": 250, "protein": 10, "carbs": 30}', 8);

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

-- Insert image URLs for each recipe
INSERT INTO images (recipe_id, image_filename) VALUES
(1, 'images/vegan_avocado_toast.jpg'),
(2, 'images/vegan_buddha_bowl.jpg'),
(3, 'images/vegan_tofu_stir-fry.jpg'),
(4, 'images/lemon_herb_chicken.jpg'),
(5, 'images/chicken_alfredo.jpg'),
(6, 'images/grilled_chicken_salad.jpg'),
(7, 'images/tomato_basil_soup.jpg'),
(8, 'images/chicken_noodle_soup.jpg'),
(9, 'images/lentil_soup.jpg'),
(10, 'images/beef_stew.jpg'),
(11, 'images/beef_tacos.jpg'),
(12, 'images/beef_stir-fry.jpg'),
(13, 'images/BBQ_pork_ribs.png'),
(14, 'images/pork_schnitzel.jpg'),
(15, 'images/pork_stir-fry.jpg'),
(16, 'images/sweet_and_sour_chicken.jpg'),
(17, 'images/kung_pao_chicken.jpg'),
(18, 'images/chinese_fried_rice.jpg'),
(19, 'images/tacos.jpeg'),
(20, 'images/chicken_quesadillas.jpg'),
(21, 'images/mexican_rice.jpg'),
(22, 'images/greek_salad.jpg'),
(23, 'images/falafel.jpg'),
(24, 'images/hummus.jpg');

-- Insert sample users
INSERT INTO users (username, password_hash, email) VALUES 
('user1', SHA2('password1', 256), 'user1@example.com'),
('user2', SHA2('password2', 256), 'user2@example.com');