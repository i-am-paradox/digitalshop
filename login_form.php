<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login - Social & OTT Hub</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body>

    <nav>
        <div class="site-title">Social & OTT Hub</div>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php#products">Products</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="mailto:your-email@example.com">Contact</a></li>
        </ul>
    </nav>

    <main>
        <div class="form-container" data-aos="fade-up">
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
            <p class="form-page-link">Don't have an account? <a href="register_form.php">Register here</a>.</p>
        </div>
    </main>

    <footer>
        <p>© <?php echo date("Y"); ?> Social & OTT Hub. All rights reserved.</p>
        <p>
            <a href="#">Facebook</a> | 
            <a href="#">Twitter</a> | 
            <a href="#">Terms of Service</a> | 
            <a href="#">Privacy Policy</a>
        </p>
        <p>Get in touch: <a href="mailto:your-email@example.com">your-email@example.com</a></p>
    </footer>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init({
        duration: 700,
        once: true,
        offset: 50,
        delay: 100,
      });
    </script>

</body>
</html>
