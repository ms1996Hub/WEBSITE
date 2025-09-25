<?php
if (isLoggedIn()) {
    redirect('dashboard');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verify CSRF token
    if (!verifyCSRFToken()) {
        setFlashMessage('danger', 'Invalid CSRF token. Please try again.');
        redirect('register');
    }
    
    $username = validateInput($_POST['username']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Validate input
    $errors = [];
    
    if (empty($username) || strlen($username) < 3) {
        $errors[] = 'Username must be at least 3 characters long';
    }
    
    if (!$email) {
        $errors[] = 'Please enter a valid email address';
    }
    
    if (strlen($password) < 8) {
        $errors[] = 'Password must be at least 8 characters long';
    }
    
    if ($password !== $confirm_password) {
        $errors[] = 'Passwords do not match';
    }
    
    // Check if username or email already exists
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ? OR email = ?");
    if ($stmt->execute([$username, $email]) && $stmt->fetchColumn() > 0) {
        $errors[] = 'Username or email already exists';
    }
    
    if (empty($errors)) {
        // Generate verification token
        $verificationToken = bin2hex(random_bytes(32));
        
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Insert the new user with verification token
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, verification_token) VALUES (?, ?, ?, ?)");
        
        if ($stmt->execute([$username, $email, $hashed_password, $verificationToken])) {
            // Send verification email
            require_once __DIR__ . '/../includes/Mailer.php';
            $mailer = new Mailer();
            
            if ($mailer->sendVerificationEmail($email, $username, $verificationToken)) {
                setFlashMessage('success', 'Registration successful! Please check your email to verify your account.');
            } else {
                // If email sending fails, still show success but notify about email verification
                error_log("Failed to send verification email to: " . $email);
                setFlashMessage('warning', 'Registration successful, but we couldn\'t send a verification email. Please contact support.');
            }
            
            redirect('login');
        } else {
            $errors[] = 'Registration failed. Please try again.';
        }
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <h2>Register</h2>
        
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <?php echo csrfField(); ?>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required 
                       value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required
                       value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <div class="form-text">Password must be at least 8 characters long</div>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
        
        <p class="mt-3">Already have an account? <a href="index.php?page=login">Login here</a></p>
    </div>
</div>
