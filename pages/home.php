<div class="jumbotron">
    <h1 class="display-4">Welcome to Our Website</h1>
    <p class="lead">This is a simple PHP website with user authentication and MySQL database integration.</p>
    <hr class="my-4">
    <?php if (!isLoggedIn()): ?>
        <p>Please login or register to access the dashboard.</p>
        <a class="btn btn-primary btn-lg" href="index.php?page=login" role="button">Login</a>
        <a class="btn btn-success btn-lg" href="index.php?page=register" role="button">Register</a>
    <?php else: ?>
        <p>Welcome back! You can now access your dashboard.</p>
        <a class="btn btn-primary btn-lg" href="index.php?page=dashboard" role="button">Go to Dashboard</a>
    <?php endif; ?>
</div>

<div class="row mt-5">
    <div class="col-md-4">
        <h3>Feature 1</h3>
        <p>User authentication system with secure password hashing.</p>
    </div>
    <div class="col-md-4">
        <h3>Feature 2</h3>
        <p>Responsive design that works on all devices.</p>
    </div>
    <div class="col-md-4">
        <h3>Feature 3</h3>
        <p>Clean and organized code structure for easy maintenance.</p>
    </div>
</div>
