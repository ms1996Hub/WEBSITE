<?php
// Load environment variables from .env file if it exists
if (file_exists(__DIR__ . '/../.env')) {
    $lines = file(__DIR__ . '/../.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        
        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);
        
        if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
            putenv(sprintf('%s=%s', $name, $value));
            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
        }
    }
}

// Database configuration from environment variables
$host = getenv('DB_HOST') ?: 'localhost';
$dbname = getenv('DB_NAME') ?: 'your_database_name';
$username = getenv('DB_USER') ?: 'your_username';
$password = getenv('DB_PASS') ?: 'your_password';

// Handle empty password case
if (empty(trim($password)) || $password === 'your_password') {
    $password = '';
}

// Try socket connection first (for Homebrew MySQL), then fallback to TCP
$dsn = null;
if (file_exists('/tmp/mysql.sock')) {
    $dsn = "mysql:unix_socket=/tmp/mysql.sock;dbname=$dbname;charset=utf8mb4";
} else {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
}

try {
    // Try connecting without password first if password is empty
    if (empty(trim($password))) {
        try {
            $pdo = new PDO(
                $dsn,
                $username,
                null,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
        } catch (PDOException $e) {
            // If that fails, try with empty string password
            $pdo = new PDO(
                $dsn,
                $username,
                '',
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
        }
    } else {
        $pdo = new PDO(
            $dsn,
            $username,
            $password,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]
        );
    }
} catch (PDOException $e) {
    error_log("Database connection failed: " . $e->getMessage());
    die("Database connection failed. Please try again later.");
}
?>
