<?php
/*
 * User Registration Script
 * Handles the backend logic for new user registration.
 */

// Start session to store messages for feedback
session_start();

// Include database configuration to establish connection
require_once 'db_config.php'; // $mysqli object is now available

// Initialize an array to store validation errors
$errors = [];
// Initialize a variable to store success messages
$success_message = '';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Retrieve and Sanitize User Input
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : ''; // Don't trim password directly, spaces can be intentional

    // 2. Validate Input
    // Required fields
    if (empty($username)) {
        $errors[] = "Username is required.";
    }
    if (empty($email)) {
        $errors[] = "Email is required.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    }

    // Email format
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Password length (basic)
    if (!empty($password) && strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    }

    // 3. If Validation Passes (no errors so far)
    if (empty($errors)) {
        // Check for existing username or email
        $sql_check = "SELECT id FROM users WHERE username = ? OR email = ?";
        if ($stmt_check = $mysqli->prepare($sql_check)) {
            $stmt_check->bind_param("ss", $username, $email);
            $stmt_check->execute();
            $stmt_check->store_result(); // Needed to check num_rows

            if ($stmt_check->num_rows > 0) {
                // Check which one exists (or if both)
                // For simplicity, we'll use a generic message, but you could be more specific
                $stmt_check->bind_result($id); // To iterate through results if needed
                $stmt_check->fetch();
                // A more specific check could be done here by re-querying for username and email separately
                // For now, a general message is fine.
                $errors[] = "Username or email already exists. Please choose a different one.";
            }
            $stmt_check->close();
        } else {
            $errors[] = "Database error (check user): " . $mysqli->error;
        }

        // If user does not exist and still no errors
        if (empty($errors)) {
            // Hash password
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            if ($password_hash === false) {
                $errors[] = "Error hashing password."; // Should not happen with PASSWORD_DEFAULT
            } else {
                // Insert new user
                $sql_insert = "INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)";
                if ($stmt_insert = $mysqli->prepare($sql_insert)) {
                    $stmt_insert->bind_param("sss", $username, $email, $password_hash);

                    if ($stmt_insert->execute()) {
                        $success_message = "Registration successful. You can now login.";
                        $_SESSION['success_message'] = $success_message;
                        header("Location: login_form.php");
                        exit;
                    } else {
                        $errors[] = "Registration failed. Please try again later. DB Error: " . $stmt_insert->error;
                    }
                    $stmt_insert->close();
                } else {
                    $errors[] = "Database error (insert user): " . $mysqli->error;
                }
            }
        }
    }

    // Store errors in session if any
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: register_form.php"); // Redirect back to registration form
        exit;
    }
} else {
    // If not a POST request, redirect to the registration form or show an error
    header("Location: register_form.php"); // Or a general error page
    exit;
}

// Close the database connection (optional, as PHP closes it at script end, but good practice)
// $mysqli->close(); // This line is commented out because db_config.php might be included in other scripts
                     // that run after this one in a single request, or if you plan to use it for displaying messages
                     // on the same page (though this script is backend only).
                     // For a pure backend script that redirects, closing here is fine.

/*
 * For testing purposes, you can uncomment these lines to see messages.
 * In a real application, these messages would be displayed on an HTML page.
 */
/*
if (!empty($_SESSION['errors'])) {
    echo "<h3>Errors:</h3><ul>";
    foreach ($_SESSION['errors'] as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul>";
    unset($_SESSION['errors']); // Clear errors after displaying
}

if (!empty($_SESSION['success_message'])) {
    echo "<h3>Success:</h3><p>" . $_SESSION['success_message'] . "</p>";
    unset($_SESSION['success_message']); // Clear message after displaying
}
*/
?>
