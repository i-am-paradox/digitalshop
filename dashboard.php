<?php
session_start();

// 1. Session Start and Authentication Check
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    header("Location: login_form.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Social & OTT Hub</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body>

    <nav>
        <div class="site-title">Social & OTT Hub</div>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php#products">Products</a></li>
            <!-- Add other relevant links for a logged-in user if any -->
            <li><a href="logout.php">Logout</a></li> 
        </ul>
    </nav>

    <main>
        <div class="dashboard-container" data-aos="fade-up">
            <h1>User Dashboard</h1>

            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>

            <p>This is your dashboard. More features will be added here soon.</p>
            <p>You can manage your account settings, view your activity, or access exclusive content from this page.</p>
            
            <!-- The logout link will now be part of the main nav for consistency -->
            <!-- Or, if preferred as a button on the page: -->
            <div class="logout-link-container" style="text-align: center; margin-top: 30px;">
                 <a href="logout.php" class="button-danger">Logout</a>
            </div>
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
