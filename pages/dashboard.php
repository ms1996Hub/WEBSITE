<?php
if (!isLoggedIn()) {
    setFlashMessage('danger', 'Please login to access the dashboard');
    redirect('login');
}

// Get user data
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>

<div class="row">
    <div class="col-md-12">
        <h2>Welcome to Your Dashboard, <?php echo htmlspecialchars($user['username']); ?>!</h2>
        <p class="lead">This is a protected area of the website.</p>
        
        <div class="card mt-4">
            <div class="card-header">
                Your Profile Information
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                        <p><strong>Member Since:</strong> <?php echo date('F j, Y', strtotime($user['created_at'])); ?></p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card mt-4">
            <div class="card-header">
                Quick Actions
            </div>
            <div class="card-body">
                <a href="#" class="btn btn-primary me-2">Edit Profile</a>
                <a href="#" class="btn btn-secondary me-2">View Activity</a>
                <a href="includes/logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
</div>
