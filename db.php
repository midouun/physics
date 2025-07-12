<?php
// db.php - PDO Database Connection Abstraction

require_once __DIR__ . '/config.php'; // Load configuration

function get_db_connection() {
    try {
        // Create a new PDO instance for SQLite
        $pdo = new PDO('sqlite:' . DB_PATH);
        
        // Set error mode to exception for better error handling
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Set default fetch mode to associative array
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        
        return $pdo;
    } catch (PDOException $e) {
        // Log the error and display a friendly message
        error_log("Database connection failed: " . $e->getMessage());
        die("<h1>Database connection error. Please try again later.</h1>");
    }
}
