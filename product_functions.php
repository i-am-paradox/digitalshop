<?php
/*
 * Product Functions
 *
 * This file contains functions related to fetching and managing product data.
 */

/**
 * Fetches all active products from the database.
 *
 * @param mysqli $mysqli The mysqli database connection object.
 * @return array An array of active products, with 'key_features' decoded from JSON.
 *               Returns an empty array if no products are found or an error occurs.
 */
function get_active_products($mysqli) {
    // Initialize an array to store products
    $products = [];

    // 1. Construct the SQL query
    // Fetches products where is_active = 1, ordered by name ascending.
    // Assumed columns: id, name, platform, validity, key_features (JSON text), price, image_url, category
    $sql = "SELECT id, name, platform, validity, key_features, price, image_url, category 
            FROM products 
            WHERE is_active = 1 
            ORDER BY name ASC";

    // 2. Execute the Query
    // For this specific query (no user input directly in its structure), a direct query is used.
    // For queries with user input, prepared statements are strongly recommended.
    $result = $mysqli->query($sql);

    // 3. Process Results
    if ($result) {
        // Check if any products were found
        if ($result->num_rows > 0) {
            // Fetch all product rows
            while ($row = $result->fetch_assoc()) {
                // Decode the key_features JSON string into a PHP array
                // The second argument `true` makes json_decode return an associative array.
                $key_features_array = json_decode($row['key_features'], true);

                // If json_decode fails (e.g., invalid JSON), default to an empty array
                if (json_last_error() !== JSON_ERROR_NONE) {
                    $key_features_array = [];
                }
                $row['key_features'] = $key_features_array;

                // Add the processed product row to the products array
                $products[] = $row;
            }
        }
        // Free result set
        $result->free();
    } else {
        // 4. Error Handling (Basic)
        // If the query failed, you might want to log this error in a real application.
        // error_log("Error fetching active products: " . $mysqli->error);
        // For now, it will return an empty array as initialized.
    }

    // Return the array of products (empty if none found or error)
    return $products;
}

/*
 * Example Usage (Conceptual):
 *
 * // 1. Ensure db_config.php is included and $mysqli is available
 * // require_once 'db_config.php';
 *
 * // 2. Include this functions file
 * // require_once 'product_functions.php';
 *
 * // 3. Call the function
 * // $activeProducts = get_active_products($mysqli);
 *
 * // 4. Use the products
 * // if (!empty($activeProducts)) {
 * //     foreach ($activeProducts as $product) {
 * //         echo "<h2>" . htmlspecialchars($product['name']) . "</h2>";
 * //         echo "<p>Platform: " . htmlspecialchars($product['platform']) . "</p>";
 * //         echo "<p>Price: $" . htmlspecialchars($product['price']) . "</p>";
 * //         if (!empty($product['key_features'])) {
 * //             echo "<ul>Key Features:";
 * //             foreach ($product['key_features'] as $feature) {
 * //                 echo "<li>" . htmlspecialchars($feature) . "</li>";
 * //             }
 * //             echo "</ul>";
 * //         }
 * //         echo "<hr>";
 * //     }
 * // } else {
 * //     echo "<p>No active products found.</p>";
 * // }
 *
 * // 5. Close connection if it's the end of all operations (typically at script end)
 * // $mysqli->close();
 *
 */
?>
