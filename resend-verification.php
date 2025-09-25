<?php
session_start();
require_once 'includes/db.php';
require_once 'includes/functions.php';

// Check if email is provided
if (!isset($_GET['email']) || empty($_GET['email'])) {
    setFlashMessage('danger', 'No email address provided.');
    redirect('login');
}

$email = filter_var($_GET['email'], FILTER_VALIDATE_EMAIL);

if (!$email) {
    setFlashMessage('danger', 'Invalid email address format.');
    redirect('login');
}

try {
    // Find user by email
    $stmt = $pdo->prepare("SELECT id, username, verification_token FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    
    if ($user) {
        if ($user['verification_token'] === null) {
            // If no token exists (e.g., user was registered before verification was implemented)
            // Generate a new verification token
            $verificationToken = bin2hex(random_bytes(32));
            $update = $pdo->prepare("UPDATE users SET verification_token = ? WHERE id = ?");
            $update->execute([$verificationToken, $user['id']]);
        } else {
            $verificationToken = $user['verification_token'];
        }
        
        // Send verification email
        require_once 'includes/Mailer.php';
        $mailer = new Mailer();
        
        if ($mailer->sendVerificationEmail($email, $user['username'], $verificationToken)) {
            setFlashMessage('success', 'A new verification email has been sent to your email address.');
        } else {
            throw new Exception('Failed to send verification email.');
        }
    } else {
        // User not found, but don't reveal that to prevent email enumeration
        setFlashMessage('info', 'If your email is registered, you will receive a verification email shortly.');
    }
    
} catch (Exception $e) {
    error_log("Resend verification error: " . $e->getMessage());
    setFlashMessage('danger', 'An error occurred while sending the verification email. Please try again later.');
}

redirect('login');
?>
