<?php
session_start();

// 1. Session Start and Authentication Check
// Check if user_id and username are set in the session
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    // If not set, redirect to login_form.php and exit
    header("Location: login_form.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Basic dashboard styling - can be moved to style.css later */
        body {
            /* Re-apply some body styles if style.css doesn't cover them fully for non-form pages */
            font-family: 'Roboto', 'Open Sans', Arial, sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
            margin: 0; /* Ensure no default margin */
            padding: 0; /* Ensure no default padding */
        }
        .dashboard-container {
            max-width: 900px; /* Wider container for dashboard content */
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }
        .dashboard-container h1 {
            text-align: center;
            color: #0056b3; /* Consistent with index.html header h1 */
            margin-bottom: 20px;
        }
        .dashboard-container h2 {
            color: #333;
            margin-bottom: 15px;
        }
        .dashboard-container p {
            line-height: 1.6;
            margin-bottom: 10px;
        }
        .logout-link {
            text-align: center; /* Center the logout link */
            margin-top: 30px;
        }
        .logout-link a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #dc3545; /* Red for logout */
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        .logout-link a:hover {
            background-color: #c82333; /* Darker red on hover */
            text-decoration: none;
        }
        /* Add nav styling here if you intend to reuse the nav from index.html */
        /* For now, keeping it simple as per instructions */
    </style>
</head>
<body>

    <!-- Optional: Include a common navigation bar if you have one -->
    <!-- <?php // include 'navigation.php'; // Example if you create a separate nav file ?> -->

    <div class="dashboard-container">
        <h1>User Dashboard</h1>

        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>

        <p>This is your dashboard. More features will be added here soon.</p>
        <p>You can manage your account settings, view your activity, or access exclusive content from this page.</p>

        <div class="logout-link">
            <a href="logout.php">Logout</a>
        </div>
    </div>

</body>
</html>
