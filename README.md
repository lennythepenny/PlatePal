# Plate Pal

**Contributors**: Southana Saythong, Adam Earnest, Lena Sarieva  
**Project Type**: Web Development with PHP and MySQL

## Project Overview
Plate Pal is a dynamic recipe website that allows users to search for recipes by meal type or ingredients. Using a **Model-View-Controller (MVC)** architecture, the website features a rich database of recipes categorized by types (breakfast, lunch, dinner, etc.) and enables ingredient-based searches (e.g., recipes containing "chicken" across all meal types).  

The website also includes user accounts where registered users can save favorite recipes. Clicking on a recipe takes the user to a detailed view page with ingredients, instructions, cooking time, and nutritional information.

## Technologies
- **Backend**: PHP with MySQL for data storage and retrieval
- **Frontend**: HTML, CSS, and PHP for page rendering
- **Architecture**: Model-View-Controller (MVC)

## File Structure

### Root Directory
- **index.php**: Redirects to `controller/index.php`, the main entry point for the site.

### Controller Directory
Handles routing and user requests. 

- **controller/index.php**: Home controller responsible for main page routing and general searches.
- **controller/recipe_controller.php**: Processes recipe search requests and navigates to detailed recipe views.
- **controller/account_controller.php**: Manages user account actions, including authentication and accessing saved recipes.

### Model Directory
Contains the logic for interacting with the database.

- **model/database.php**: Sets up and maintains the connection to the MySQL database.
- **model/recipe_db.php**: Contains methods for handling recipe data, including fetching recipes by type or ingredient.
- **model/user_db.php**: Manages user-related data, such as creating accounts, logging in, and saving recipes.

### View Directory
Holds the website’s HTML templates and styles.

- **view/header.php**: Shared header for all pages, including navigation and title.
- **view/footer.php**: Shared footer for all pages.
- **view/index_view.php**: Displays the homepage with options to search recipes by meal type or ingredient.
- **view/recipe_detail_view.php**: Shows detailed recipe information, including ingredients, instructions, cooking time, and nutritional details.
- **view/account_view.php**: Displays the user account page, showing saved recipes and account settings.
- **view/login_view.php**: Provides a login form for user authentication.
- **view/main.css**: Main stylesheet for page layouts, forms, and overall styling.
- **view/images/**: Contains image assets such as recipe photos and icons.

## Features
- **Recipe Search by Meal Type or Ingredient**: Users can search recipes by selecting meal type categories or typing specific ingredients.
- **Detailed Recipe View**: Users can click on a recipe to see ingredients, preparation steps, cooking time, and nutritional information.
- **User Accounts**: Registered users can log in to view and save recipes to their account.

## Setup and Installation
1. Clone the repository.
2. Set up a MySQL database and configure the connection in `model/database.php`.
3. Place the project files in a server directory (e.g., `htdocs` if using XAMPP).
4. Access the website by navigating to `localhost/PlatePal/index.php`.

## License
This project is created for educational purposes and is intended to demonstrate web development principles using PHP and MySQL.

---

This README provides an overview of the Plate Pal project and describes the purpose of each file in the directory structure.
