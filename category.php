<?php
session_start(); // Start session
require_once 'db_config.php'; // Database connection
require_once 'product_functions.php'; // Product fetching functions

// Get Category Name from URL
$category_name = '';
if (isset($_GET['name']) && trim($_GET['name']) !== '') {
    $category_name = htmlspecialchars(trim($_GET['name']));
} else {
    // Redirect to index.php if no category name is provided
    header("Location: index.php");
    exit;
}

// Fetch active products for the specified category
$products = get_active_products($mysqli, $category_name);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products in <?php echo $category_name; ?> - Social & OTT Hub</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body>
    <nav>
        <div class="site-title">Social & OTT Hub</div>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php#products">Products</a></li> <!-- Link to products section on homepage -->
            <li><a href="category.php?name=Entertainment">Entertainment</a></li>
            <li><a href="category.php?name=Music">Music</a></li>
            <li><a href="category.php?name=Social+Media">Social Media</a></li>
            <li><a href="category.php?name=Productivity">Productivity</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="mailto:your-email@example.com">Contact</a></li>
        </ul>
    </nav>

    <main>
        <header data-aos="fade-in" style="text-align: center; margin-top: 20px; margin-bottom: 30px;"> <!-- Simplified header for category page -->
            <h1>Category: <?php echo $category_name; ?></h1>
        </header>

        <div class="product-grid-container" id="products">
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
            <p data-aos="fade-in" style="text-align: center; grid-column: 1 / -1; padding: 20px;">No products found in the '<?php echo $category_name; ?>' category.</p>
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
