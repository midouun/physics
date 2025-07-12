<?php
// init.php - Initializes session, language, and loads configuration

// Load configuration first
require_once __DIR__ . '/config.php';

// --- Error Logging Setup ---
ini_set('display_errors', 'Off'); // Never display errors to the user in production
ini_set('log_errors', 'On'); // Always log errors
ini_set('error_log', ERROR_LOG_FILE); // Define the log file path from config.php
error_reporting(E_ALL); // Report all types of errors

// --- Session Configuration and Start ---
// Set session cookie parameters for security
session_set_cookie_params([
    'lifetime' => 0, // Session cookie expires when browser closes
    'path' => '/',
    'domain' => '', // Your domain, e.g., 'yourwebsite.com'
    'secure' => SESSION_SECURE, // True if using HTTPS, false for HTTP (development)
    'httponly' => SESSION_HTTPONLY, // True to prevent JavaScript access to session cookie
    'samesite' => SESSION_SAMESITE // 'Lax', 'Strict', or 'None'
]);
session_start();

// --- Language Handling ---
// Check if language is set via GET parameter or session, otherwise default to Arabic
if (isset($_GET['lang'])) {
    $requested_lang = $_GET['lang'];
    // Validate requested language to prevent arbitrary file inclusion
    if (in_array($requested_lang, ['en', 'ar'])) {
        $_SESSION['lang'] = $requested_lang;
    } else {
        error_log("Invalid language requested: " . $requested_lang);
    }
} elseif (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'ar'; // Default language is Arabic
}

$lang_file = __DIR__ . '/lang/' . $_SESSION['lang'] . '.php';
if (file_exists($lang_file)) {
    include $lang_file;
} else {
    // Fallback to default language if the requested language file is missing
    error_log("Language file not found: " . $lang_file);
    include __DIR__ . '/lang/ar.php';
}

// Set text direction based on language
$dir = ($_SESSION['lang'] === 'ar') ? 'rtl' : 'ltr';

// --- Professor Activity Status Loading ---
$professor_status = ['status_type' => 'manual', 'is_online' => false, 'start_time' => '', 'end_time' => ''];
$status_file = __DIR__ . '/admin/status.json';
if (file_exists($status_file)) {
    $status_content = file_get_contents($status_file);
    if ($status_content !== false) {
        $decoded_status = json_decode($status_content, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            $professor_status = $decoded_status;
        } else {
            error_log("JSON decode error in status.json: " . json_last_error_msg());
        }
    } else {
        error_log("Failed to read status.json file.");
    }
}

$display_status = '';
$current_time = new DateTime();

if ($professor_status['status_type'] === 'manual') {
    if ($professor_status['is_online']) {
        $display_status = $lang['professor_online'];
    } else {
        $display_status = $lang['professor_offline'];
    }
} elseif ($professor_status['status_type'] === 'scheduled') {
    $start_time_str = $professor_status['start_time'];
    $end_time_str = $professor_status['end_time'];

    if (!empty($start_time_str) && !empty($end_time_str)) {
        try {
            $start_time = DateTime::createFromFormat('H:i', $start_time_str);
            $end_time = DateTime::createFromFormat('H:i', $end_time_str);

            if ($start_time === false || $end_time === false) {
                throw new Exception("Invalid time format in status.json");
            }

            // Handle overnight schedules
            if ($start_time > $end_time) {
                $end_time->modify('+1 day');
            }

            if ($current_time >= $start_time && $current_time <= $end_time) {
                $display_status = $lang['professor_online'];
            } else {
                $display_status = $lang['professor_available_from'] . ' ' . $start_time_str . ' ' . $lang['to'] . ' ' . $end_time_str . '.';
            }
        } catch (Exception $e) {
            error_log("Error processing scheduled status: " . $e->getMessage());
            $display_status = $lang['professor_offline_schedule_not_set'];
        }
    } else {
        $display_status = $lang['professor_offline_schedule_not_set'];
    }
}

// --- CSRF Token Generation ---
// Generate a new CSRF token if one doesn't exist or if it's expired
if (empty($_SESSION['csrf_token']) || 
    (isset($_SESSION['csrf_token_time']) && (time() - $_SESSION['csrf_token_time'] > CSRF_TOKEN_LIFETIME))) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    $_SESSION['csrf_token_time'] = time();
}

// --- Login Brute-Force Protection ---
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}
if (!isset($_SESSION['last_login_attempt_time'])) {
    $_SESSION['last_login_attempt_time'] = 0;
}