<?php
// config.php - Centralized configuration for the website

// Admin Credentials
define('ADMIN_USERNAME', 'Aadmin');
define('ADMIN_PASSWORD', 'abdelhak1995'); // In a real application, hash passwords!

// Teacher's Contact Email
define('TEACHER_EMAIL', 'smahiabdelhak1994@gmail.com');

// Log File Path
define('ERROR_LOG_FILE', __DIR__ . '/logs/error.log');

// Database Configuration (for PDO abstraction later)
define('DB_PATH', __DIR__ . '/forum/forum.db');

// Session Security (recommended for production)
define('SESSION_HTTPONLY', true);
define('SESSION_SECURE', false); // Set to true if using HTTPS
define('SESSION_SAMESITE', 'Lax'); // 'Lax', 'Strict', or 'None'

// Brute-force protection settings
define('MAX_LOGIN_ATTEMPTS', 5);
define('LOGIN_COOLDOWN_TIME', 300); // 5 minutes in seconds

// CSRF Protection settings
define('CSRF_TOKEN_LIFETIME', 3600); // 1 hour in seconds

// Default content for new 'About' section (if file doesn't exist)
define('DEFAULT_ABOUT_CONTENT', "Mr. Samahi Abdelhak is a dedicated physics teacher with a passion for making science accessible and exciting for all students. He has been teaching at the high school in Aïn El Hadjar for over a decade, and is known for his engaging lessons and commitment to his students' success.");

// Max length for editable content
define('MAX_ABOUT_CONTENT_LENGTH', 2000);

// Path for downloadable PDFs
define('PDF_UPLOAD_DIR', __DIR__ . '/pdfs/lessons/');
