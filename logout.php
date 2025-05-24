<?php
/*
 * User Logout Script
 * Handles the termination of a user's session.
 */

// 1. Start Session
// It's necessary to start the session to be able to access and then destroy it.
session_start();

// 2. Unset all session variables
// This removes all data stored in the $_SESSION array.
$_SESSION = array(); // Clears the $_SESSION array.
// Alternatively, session_unset(); could be used. It removes all session variables.

// 3. Destroy the session
// This completely ends the current session.
// It also removes the session cookie from the user's browser (on the next request if not already done).
if (session_destroy()) {
    // Session destroyed successfully.
    // No specific action needed here other than the redirect below.
} else {
    // If session_destroy() fails, it's an unusual server-side issue.
    // For a production environment, you might log this error.
    // error_log("Failed to destroy session.");
}

// 4. Redirect User
// Redirect the user to a public page, typically the login page or the homepage.
// For this example, we'll redirect to 'login_form.php'.
// Replace 'login_form.php' with your actual login page or homepage (e.g., 'index.php').
header("Location: login_form.php"); // Ensure this path is correct for your application.
exit; // Important to prevent further script execution after redirection.

?>
