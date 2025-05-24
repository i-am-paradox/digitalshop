<?php
session_start(); // Start session
require_once 'db_config.php'; // Database connection
require_once 'product_functions.php'; // Product fetching functions

// Fetch active products
$products = get_active_products($mysqli);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Store - Products</title> <!-- Updated title slightly -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body>
    <nav>
        <div class="site-title">Social & OTT Hub</div>
        <ul>
            <li><a href="index.php">Home</a></li> <!-- Changed from # to index.php for clarity -->
            <li><a href="#products">Products</a></li> <!-- Link to product grid if desired, or remove if redundant -->
            <li><a href="#">About Us</a></li>
            <li><a href="mailto:your-email@example.com">Contact</a></li>
        </ul>
    </nav>
    <section class="hero-section" data-aos="zoom-in" data-aos-duration="800">
        <h2>Premium Subscriptions at the Best Prices.</h2>
        <!-- Optional paragraph: <p>Your one-stop shop for all digital needs, available instantly.</p> -->
    </section>
    <header data-aos="fade-in" data-aos-delay="300">
        <h1>Social & OTT Hub</h1> <!-- This is the main page title -->
    </header>
    <main>
        <div class="product-grid-container" id="products"> <!-- Added id for potential anchor link -->
            <?php
            if (!empty($products)) {
                $aos_delay = 100; // Initialize AOS delay counter
                foreach ($products as $product) {
            ?>
            <section class="product" data-aos="fade-up" data-aos-delay="<?php echo $aos_delay; ?>">
                <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                <p><strong>Platform:</strong> <?php echo htmlspecialchars($product['platform']); ?></p>
                <p><strong>Validity:</strong> <?php echo htmlspecialchars($product['validity']); ?></p>
                
                <?php if (!empty($product['key_features']) && is_array($product['key_features'])): ?>
                <p><strong>Key Features:</strong></p>
                <ul>
                    <?php foreach ($product['key_features'] as $feature): ?>
                    <li><?php echo htmlspecialchars($feature); ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
                
                <p>₹<?php echo htmlspecialchars($product['price']); ?></p>
            </section>
            <?php
                    $aos_delay += 50; // Increment AOS delay
                } // end foreach product
            } else {
            ?>
            <p style="text-align: center; grid-column: 1 / -1;">No products found. Please check back later!</p>
            <?php
            } // end if !empty products
            ?>
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
        duration: 700, // Animation duration in milliseconds
        once: true,     // Whether animation should happen only once - while scrolling down
        offset: 50,     // Offset (in px) from the original trigger point
        delay: 100,     // Values from 0 to 3000, with step 50ms (default global delay)
      });
    </script>

    <button class="fab" aria-label="Chat">Chat</button>
</body>
</html>
