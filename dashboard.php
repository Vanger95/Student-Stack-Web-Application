<?php
require_once 'includes/auth.php';
require_admin();
?>

<?php include 'includes/header.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-12 mt-4">
            <h1>Welcome, Admin!</h1>
            <p class="lead">This is your admin dashboard where you can manage users, modules, and other administrative tasks.</p>
        </div>
    </div>

    <div class="row mt-5">
        <!-- Dashboard Cards -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Manage Users</h5>
                    <p class="card-text">Add, edit, or remove users.</p>
                    <a href="manage_users.php" class="btn btn-primary">Go</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Manage Modules</h5>
                    <p class="card-text">Add, edit, or delete modules.</p>
                    <a href="manage_modules.php" class="btn btn-primary">Go</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Contact Support</h5>
                    <p class="card-text">Need help? Contact the support team.</p>
                    <a href="contact.php" class="btn btn-primary">Go</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <!-- Additional Options -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Reset Password</h5>
                    <p class="card-text">Change your password to secure your account.</p>
                    <a href="reset_password.php" class="btn btn-warning">Reset Password</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Logout</h5>
                    <p class="card-text">Logout from your admin account.</p>
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
