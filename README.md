# Digital Subscriptions Store

## Description

A web application for selling digital subscription-based products like Netflix, Spotify, and more. This project aims to provide a user-friendly interface for browsing products and managing user accounts. It features a modern design, responsive layout, and user authentication capabilities.

## Key Features Implemented

*   **Modern UI/UX:**
    *   Responsive design adapting to various screen sizes (desktops, tablets, mobile).
    *   Clean, premium aesthetic with a focus on user experience.
    *   "Inter" font used for consistent and modern typography.
*   **Engaging Visuals:**
    *   Glassmorphic navigation bar (sticky, with blur effect).
    *   Impactful hero section on the homepage.
    *   Visually appealing product cards with hover animations and custom list item bullets.
    *   Smooth scroll animations using AOS.js on key page elements.
*   **User Authentication & Management:**
    *   User registration system with input validation and password hashing.
    *   User login system with password verification.
    *   Session management to maintain user authentication state.
    *   Protected user dashboard area accessible after login.
    *   Logout functionality.
*   **Frontend Structure:**
    *   Consistent header and footer across all user-facing pages.
    *   HTML5 semantic elements for better structure.
    *   CSS3 for styling, utilizing Flexbox and CSS Grid for layouts.
*   **Mobile Enhancements:**
    *   Floating Action Button (FAB) for quick access (e.g., "Chat") on smaller screens.

## Technologies Used

*   **Frontend:**
    *   HTML5
    *   CSS3 (Flexbox, Grid, Animations, Custom Properties, Media Queries)
    *   JavaScript (for AOS.js library integration)
    *   AOS.js (Animate On Scroll library)
*   **Backend:**
    *   PHP (for user authentication, session management, and server-side logic)
*   **Database:**
    *   MySQL (used for storing user credentials and product information - conceptual, schema not included in this version)
*   **Development Environment (Assumed):**
    *   Web server like Apache or Nginx that supports PHP.

## Setup and Installation

1.  **Server Environment:**
    *   Ensure you have a web server (e.g., XAMPP, WAMP, MAMP, or a dedicated server) with PHP installed and running.
    *   A MySQL database server is required.

2.  **Clone Repository:**
    *   Clone this repository to your web server's document root (e.g., `htdocs` for XAMPP).
      ```bash
      git clone <repository-url>
      ```

3.  **Database Configuration:**
    *   Locate the `db_config.php` file in the project root.
    *   Update the following constants with your MySQL database credentials:
        *   `DB_SERVER` (e.g., 'localhost')
        *   `DB_USERNAME` (your database username)
        *   `DB_PASSWORD` (your database password)
        *   `DB_NAME` (the name of the database you will use)

4.  **Database Schema:**
    *   **Note:** An SQL schema file (`database.sql` or similar) needs to be created and imported into your MySQL database. This file should define the `users` table structure, including columns like `id`, `username`, `email`, `password_hash`, `is_active`, `last_login`, `created_at`.
    *   (Example `users` table structure - this should ideally be in an SQL file):
      ```sql
      CREATE TABLE users (
          id INT AUTO_INCREMENT PRIMARY KEY,
          username VARCHAR(50) NOT NULL UNIQUE,
          email VARCHAR(100) NOT NULL UNIQUE,
          password_hash VARCHAR(255) NOT NULL,
          is_active TINYINT(1) DEFAULT 1, -- 1 for active, 0 for inactive
          last_login DATETIME NULL,
          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
      );
      ```

5.  **Access the Website:**
    *   Open your web browser and navigate to the project directory on your server (e.g., `http://localhost/your-project-folder/`).
    *   Start by accessing `index.html` or `register_form.php` to create an account.

## Current Status / Next Steps

The project has a solid foundation with a modern frontend design and core user authentication features. The product display page (`index.html`) is styled, and user registration, login, logout, and a basic dashboard are functional.

**Potential Future Developments:**

*   **Full Product Management:** Admin interface for adding/editing products.
*   **Shopping Cart Functionality:** Allow users to add products to a cart.
*   **Checkout Process:** Implement a multi-step checkout.
*   **Payment Gateway Integration:** Integrate with services like Stripe or PayPal.
*   **Order History:** Allow users to view their past purchases.
*   **Enhanced User Profiles:** More options for users to manage their accounts.
*   **API Development:** Create APIs for potential mobile app integration.
*   **Refinement of Backend Logic:** Further hardening of security and more robust error handling.

This project serves as an excellent starting point for a full-fledged e-commerce platform for digital subscriptions.
