<?php
/*
 * User Login Script
 * Handles the backend logic for user authentication.
 */

// Include database configuration to establish connection
require_once 'db_config.php'; // $mysqli object is now available

// Start session to store user data and feedback messages
session_start();

// Initialize a variable to store login error messages
// This can be cleared or set as needed.
// $_SESSION['login_error'] will be primarily used for feedback on the form page.

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Retrieve User Input
    $username_or_email = isset($_POST['username_or_email']) ? trim($_POST['username_or_email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : ''; // Don't trim password directly

    // 2. Validate Input (Basic)
    if (empty($username_or_email) || empty($password)) {
        $_SESSION['login_error'] = "Both username/email and password are required.";
        header("Location: login_form.php");
        exit;
    } else {
        // 3. If Basic Validation Passes
        // Retrieve User from Database
        // Assuming 'users' table has columns: id, username, email, password_hash, is_active (TINYINT 1 for active)
        $sql = "SELECT id, username, email, password_hash, is_active FROM users WHERE username = ? OR email = ?";

        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("ss", $username_or_email, $username_or_email);
            $stmt->execute();
            $result = $stmt->get_result(); // Get result set for fetching

            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc(); // Fetch user data

                // Verify User and Password
                if ((int)$user['is_active'] === 1) { // Check if user is active
                    if (password_verify($password, $user['password_hash'])) {
                        // Password matches

                        // Session Management
                        session_regenerate_id(true); // Regenerate session ID

                        // Store user identification in session
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['username'] = $user['username'];
                        // You might also store other non-sensitive info like email if needed frequently

                        // Optionally, update last_login timestamp
                        $update_sql = "UPDATE users SET last_login = NOW() WHERE id = ?";
                        if ($update_stmt = $mysqli->prepare($update_sql)) {
                            $update_stmt->bind_param("i", $user['id']);
                            $update_stmt->execute();
                            $update_stmt->close();
                        } else {
                            // Log this error, but don't necessarily block login
                            // error_log("Failed to update last_login for user ID: " . $user['id']);
                        }

                        // Clear any previous login error messages
                        unset($_SESSION['login_error']);

                        header("Location: dashboard.php");
                        exit;

                    } else {
                        // Password does not match
                        $_SESSION['login_error'] = "Invalid username/email or password.";
                    }
                } else {
                    // User is not active
                    $_SESSION['login_error'] = "Your account is not active. Please contact support.";
                }
            } else {
                // No user found with that username/email
                $_SESSION['login_error'] = "Invalid username/email or password.";
            }
            $stmt->close();
        } else {
            // Database error (prepare statement failed)
            $_SESSION['login_error'] = "Login failed due to a server error. Please try again later.";
            // error_log("Login error: " . $mysqli->error); // Log the actual DB error
        }

        // If there was a login error, redirect back to the login form
        if (isset($_SESSION['login_error'])) {
            header("Location: login_form.php");
            exit;
        }
    }
} else {
    // If not a POST request, redirect to the login form
    header("Location: login_form.php"); // Or a general error page
    exit;
}

// Close the database connection (optional, as PHP closes it at script end)
// $mysqli->close(); // As with register.php, consider where to close if used in combined scripts.

/*
 * For testing purposes, you can uncomment these lines to see messages.
 * In a real application, login_error would be displayed on an HTML login form.
 */
/*
if (isset($_SESSION['login_error'])) {
    echo "<h3>Login Error:</h3><p>" . $_SESSION['login_error'] . "</p>";
    // unset($_SESSION['login_error']); // Usually unset after displaying on the form page
}

if (isset($_SESSION['user_id'])) {
    echo "<h3>Login Success (Session Info):</h3>";
    echo "<p>User ID: " . $_SESSION['user_id'] . "</p>";
    echo "<p>Username: " . htmlspecialchars($_SESSION['username']) . "</p>";
    // echo "<p><a href='logout.php'>Logout</a></p>"; // Example link for logout
}
*/
?>
