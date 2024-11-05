# Plate Pal Project Structure

## Root Directory
```plaintext
PlatePal/
├── controller/
│   ├── index.php                  # Main controller for initial routing and homepage logic
│   ├── recipe_controller.php      # Manages recipe search, filtering, and navigation to detailed views
│   ├── account_controller.php     # Handles user login, registration, and saved recipe actions
│   └── search_controller.php      # Additional controller to handle search queries by meal type or ingredient
│
├── model/
│   ├── database.php               # Database connection settings and initialization
│   ├── recipe_db.php              # Methods for recipe-related operations (CRUD for recipes)
│   ├── user_db.php                # Methods for user-related operations (login, registration, saving recipes)
│   └── search_db.php              # Functions to support recipe searching and filtering by criteria
│
├── view/
│   ├── header.php                 # Common header for all pages (navigation, title, etc.)
│   ├── footer.php                 # Common footer for all pages
│   ├── index_view.php             # Home page view for searching recipes by type or ingredient
│   ├── recipe_detail_view.php     # Detailed recipe view with ingredients, instructions, and nutrition info
│   ├── account_view.php           # User account page view, showing saved recipes and account settings
│   ├── login_view.php             # Login form view for user authentication
│   ├── register_view.php          # Registration form view for creating a new user account
│   ├── search_results_view.php    # Displays search results for recipes based on user queries
│   ├── main.css                   # Main stylesheet for layout and form styling
│   └── images/                    # Folder for image assets like recipe photos and icons
│
└── index.php                      # Redirects to controller/index.php for initial routing
