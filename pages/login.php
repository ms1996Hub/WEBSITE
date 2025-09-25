<?php
if (isLoggedIn()) {
    redirect('dashboard');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verify CSRF token
    if (!verifyCSRFToken()) {
        setFlashMessage('danger', 'Invalid CSRF token. Please try again.');
        redirect('login');
    }
    
    $username = validateInput($_POST['username']);
    $password = $_POST['password'];
    
    // Get user with verification status
    $stmt = $pdo->prepare("SELECT id, username, password, verified, verification_token FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user['password'])) {
        // Check if email is verified
        if (!$user['verified']) {
            // If not verified, offer to resend verification email
            $resendLink = 'resend-verification.php?email=' . urlencode($user['email']);
            $error = 'Please verify your email address before logging in. ';
            $error .= '<a href="' . $resendLink . '">Resend verification email</a>';
        } else {
            // Email is verified, log the user in
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            setFlashMessage('success', 'Login successful!');
            redirect('dashboard');
        }
    } else {
        $error = 'Invalid username or password';
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <h2>Login</h2>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <?php $message = getFlashMessage(); ?>
        <?php if ($message): ?>
            <div class="alert alert-<?php echo $message['type']; ?>">
                <?php echo $message['message']; ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <?php echo csrfField(); ?>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        
        <p class="mt-3">Don't have an account? <a href="index.php?page=register">Register here</a></p>
    </div>
</div>
