<?php
/**
 * CSRF Protection Functions
 */

/**
 * Generate and store a CSRF token in the session
 * @return string The generated CSRF token
 */
function generateCSRFToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Validate a CSRF token
 * @param string $token The token to validate
 * @return bool True if the token is valid, false otherwise
 */
function validateCSRFToken($token) {
    if (empty($_SESSION['csrf_token']) || empty($token)) {
        return false;
    }
    return hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Get CSRF token HTML input field
 * @return string HTML input field with CSRF token
 */
function csrfField() {
    $token = generateCSRFToken();
    return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($token) . '">';
}

/**
 * Verify if the current request has a valid CSRF token
 * @param string $method The request method to check (post, get, request)
 * @return bool True if the token is valid, false otherwise
 */
function verifyCSRFToken($method = 'post') {
    $token = null;
    
    switch (strtolower($method)) {
        case 'get':
            $token = $_GET['csrf_token'] ?? null;
            break;
        case 'request':
            $token = $_REQUEST['csrf_token'] ?? null;
            break;
        case 'post':
        default:
            $token = $_POST['csrf_token'] ?? null;
    }
    
    return validateCSRFToken($token);
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function validateInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function redirect($page) {
    header("Location: index.php?page=" . $page);
    exit();
}

function getFlashMessage() {
    if (isset($_SESSION['flash_message'])) {
        $message = $_SESSION['flash_message'];
        unset($_SESSION['flash_message']);
        return $message;
    }
    return null;
}

function setFlashMessage($type, $message) {
    $_SESSION['flash_message'] = [
        'type' => $type,
        'message' => $message
    ];
}
?>
