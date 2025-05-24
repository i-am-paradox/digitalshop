<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration - Social & OTT Hub</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" /> <!-- If AOS is desired on this page too -->
</head>
<body>

    <nav>
        <div class="site-title">Social & OTT Hub</div>
        <ul>
            <li><a href="index.php">Home</a></li> <!-- Assuming index.php is the homepage -->
            <li><a href="index.php#products">Products</a></li> <!-- Link to products section if exists -->
            <li><a href="category.php?name=Entertainment">Entertainment</a></li>
            <li><a href="category.php?name=Music">Music</a></li>
            <li><a href="category.php?name=Social+Media">Social Media</a></li>
            <li><a href="category.php?name=Productivity">Productivity</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="mailto:your-email@example.com">Contact</a></li>
        </ul>
    </nav>

    <main>
        <div class="form-container" data-aos="fade-up"> <!-- Added AOS for consistency -->
            <h1>User Registration</h1>

            <?php
            // Display errors if any
            if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
                echo '<div class="message error"><ul>';
                foreach ($_SESSION['errors'] as $error) {
                    echo '<li>' . htmlspecialchars($error) . '</li>';
                }
                echo '</ul></div>';
                unset($_SESSION['errors']); // Clear errors after displaying
            }

            // Display success message if any
            if (isset($_SESSION['success_message'])) {
                echo '<div class="message success"><p>' . htmlspecialchars($_SESSION['success_message']) . '</p></div>';
                unset($_SESSION['success_message']); // Clear success message after displaying
            }
            ?>

            <form action="register.php" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required minlength="8">
                </div>
                <div class="form-group">
                    <label for="password_confirm">Confirm Password</label>
                    <input type="password" id="password_confirm" name="password_confirm" required minlength="8">
                </div>
                <div class="form-group">
                    <button type="submit">Register</button>
                </div>
            </form>
            <p class="form-page-link">Already have an account? <a href="login_form.php">Login here</a>.</p>
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
