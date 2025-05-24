<?php
/*
 * Product Functions
 *
 * This file contains functions related to fetching and managing product data.
 */

/**
 * Fetches active products from the database, optionally filtering by category.
 *
 * @param mysqli $mysqli The mysqli database connection object.
 * @param string|null $category_name Optional. The name of the category to filter by. Defaults to null (no category filter).
 * @return array An array of active products, with 'key_features' decoded from JSON.
 *               Returns an empty array if no products are found or an error occurs.
 */
function get_active_products($mysqli, $category_name = null) {
    // Initialize an array to store products
    $products = [];
    $result = null; // Initialize result to null

    // 1. Construct the base SQL query
    $sql = "SELECT id, name, platform, validity, key_features, price, image_url, category 
            FROM products 
            WHERE is_active = 1";

    // 2. Conditional Category Filter and Query Execution
    if ($category_name !== null && trim($category_name) !== '') {
        // Append category filter and order by
        $sql .= " AND category = ? ORDER BY name ASC";
        
        // Use a prepared statement
        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("s", $category_name);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
            } else {
                // Error in execution
                // error_log("Error executing prepared statement: " . $stmt->error);
            }
            $stmt->close();
        } else {
            // Error in preparation
            // error_log("Error preparing statement: " . $mysqli->error);
        }
    } else {
        // No category filter, append order by and execute directly
        $sql .= " ORDER BY name ASC";
        $result = $mysqli->query($sql);
        if (!$result) {
            // Error in direct query execution
            // error_log("Error executing direct query: " . $mysqli->error);
        }
    }

    // 3. Process Results (only if $result is not null and contains data)
    if ($result && $result->num_rows > 0) {
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
