<?php
/*
 * Database Configuration File
 *
 * This file contains the settings for connecting to your MySQL database.
 * Please update the placeholder values with your actual database credentials.
 */

// ** MySQL settings - You need to fill these in with your details ** //
/** MySQL database server hostname (e.g., localhost or an IP address) */
define('DB_SERVER', 'localhost');

/** MySQL database username */
define('DB_USERNAME', 'your_db_user'); // Replace 'your_db_user' with your actual database username

/** MySQL database password */
define('DB_PASSWORD', 'your_db_password'); // Replace 'your_db_password' with your actual database password

/** The name of the database you want to connect to */
define('DB_NAME', 'your_db_name'); // Replace 'your_db_name' with your actual database name

/* Attempt to establish a connection to MySQL database */
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

/* Check connection */
if ($mysqli->connect_errno) {
    // Connection failed. Output error message and terminate the script.
    // In a production environment, you might want to log this error instead of displaying it directly to the user.
    die("Connection failed: " . $mysqli->connect_error);
}

/*
 * If the script reaches this point, the connection was successful.
 * For testing purposes, you can uncomment the line below to display a success message.
 * IMPORTANT: Remove or comment out this message for production use to avoid exposing unnecessary information.
 */
// echo "Connected successfully to the database '" . DB_NAME . "'.";

/*
 * The $mysqli object is now available for use in any script that includes this file.
 * Example: $result = $mysqli->query("SELECT * FROM your_table");
 */

// It's good practice to set the character set for the connection.
// This helps prevent SQL injection issues and ensures proper character encoding.
if (!$mysqli->set_charset("utf8mb4")) {
    // This error is less critical but good to be aware of.
    // For production, you might log this error.
    // printf("Error loading character set utf8mb4: %s\n", $mysqli->error);
}

?>
