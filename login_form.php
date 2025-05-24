<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Basic form styling - can be moved to style.css later or use existing */
        .form-container {
            max-width: 500px;
            margin: 40px auto; /* Added top margin */
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }
        .form-container h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box; /* So padding doesn't affect width */
        }
        .form-group button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #28a745; /* Green for login, consistent with price */
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .form-group button[type="submit"]:hover {
            background-color: #218838; /* Darker green */
        }
        .message {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .register-link {
            text-align: center;
            margin-top: 20px;
        }
        .register-link a {
            color: #007bff;
            text-decoration: none;
        }
        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h1>User Login</h1>

        <?php
        // Display login error if any
        if (isset($_SESSION['login_error'])) {
            echo '<div class="message error"><p>' . htmlspecialchars($_SESSION['login_error']) . '</p></div>';
            unset($_SESSION['login_error']); // Clear error after displaying
        }

        // Display success message if any (e.g., from registration)
        if (isset($_SESSION['success_message'])) {
            echo '<div class="message success"><p>' . htmlspecialchars($_SESSION['success_message']) . '</p></div>';
            unset($_SESSION['success_message']); // Clear success message after displaying
        }
        ?>

        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="username_or_email">Username or Email</label>
                <input type="text" id="username_or_email" name="username_or_email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit">Login</button>
            </div>
        </form>
        <p class="register-link">Don't have an account? <a href="register_form.php">Register here</a>.</p>
    </div>

</body>
</html>
