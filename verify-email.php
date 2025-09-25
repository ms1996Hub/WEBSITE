<?php
session_start();
require_once 'includes/db.php';
require_once 'includes/functions.php';

// Check if token is provided in the URL
if (!isset($_GET['token']) || empty($_GET['token'])) {
    setFlashMessage('danger', 'Invalid verification link.');
    redirect('login');
}

$token = $_GET['token'];

try {
    // Find user with this verification token
    $stmt = $pdo->prepare("SELECT id, username, email FROM users WHERE verification_token = ? AND verified = 0");
    $stmt->execute([$token]);
    $user = $stmt->fetch();
    
    if ($user) {
        // Mark user as verified
        $update = $pdo->prepare("UPDATE users SET verified = 1, verification_token = NULL, verified_at = CURRENT_TIMESTAMP WHERE id = ?");
        
        if ($update->execute([$user['id']])) {
            // Log the user in automatically after verification
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            
            setFlashMessage('success', 'Your email has been verified successfully! You are now logged in.');
            redirect('dashboard');
        } else {
            throw new Exception('Failed to update user verification status.');
        }
    } else {
        // Check if user is already verified
        $stmt = $pdo->prepare("SELECT id FROM users WHERE verification_token = ? AND verified = 1");
        $stmt->execute([$token]);
        
        if ($stmt->fetch()) {
            setFlashMessage('info', 'Your email is already verified. Please log in.');
        } else {
            setFlashMessage('danger', 'Invalid or expired verification link. Please request a new one.');
        }
        redirect('login');
    }
    
} catch (Exception $e) {
    error_log("Email verification error: " . $e->getMessage());
    setFlashMessage('danger', 'An error occurred while verifying your email. Please try again.');
    redirect('login');
}
?>
