<?php
require_once '../includes/auth.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Student Stack</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            background: #f4f7fc;
        }
        .dashboard-header {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: white;
            padding: 2rem 0;
        }
        .card {
            border: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }
        .card-icon {
            font-size: 2.5rem;
            color: #6a11cb;
        }
        .btn-primary {
            background-color: #6a11cb;
            border-color: #6a11cb;
        }
        .btn-primary:hover {
            background-color: #2575fc;
            border-color: #2575fc;
        }
    </style>
</head>
<body>
    <header class="dashboard-header text-center">
        <h1>Welcome, Admin!</h1>
        <p class="lead">Manage users, modules, and administrative tasks with ease.</p>
    </header>

    <div class="container mt-5">
        <div class="row g-4">
            <!-- Manage Users Card -->
            <!-- <div class="col-md-4">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <div class="card-icon mb-3">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h5 class="card-title">Manage Users</h5>
                        <p class="card-text">Manage users in the system.</p>
                        <a href="../admin/manage_users.php" class="btn btn-primary">Go</a>
                    </div>
                </div>
            </div> -->

            <div class="col-md-4">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <div class="card-icon mb-3">
                            <i class="bi bi-folder-fill"></i>
                        </div>
                        <h5 class="card-title">Manage User</h5>
                        <p class="card-text">Manage users in the system.</p>
                        <a href="\StudentStackApp\admin\dashboard.php" class="btn btn-primary">Go</a>
                    </div>
                </div>
            </div>

            <!-- Manage Modules Card -->
            <div class="col-md-4">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <div class="card-icon mb-3">
                            <i class="bi bi-folder-fill"></i>
                        </div>
                        <h5 class="card-title">Manage Modules</h5>
                        <p class="card-text">Manage modules efficiently.</p>
                        <a href="../manage_modules.php" class="btn btn-primary">Go</a>
                    </div>
                </div>
            </div>

            <!-- Contact Support Card -->
            <div class="col-md-4">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <div class="card-icon mb-3">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <h5 class="card-title">Manage Pots</h5>
                        <p class="card-text">Manage posts efficiently.</p>
                        <a href="../index.php" class="btn btn-primary">Go</a>
                    </div>
                </div>
            </div>

            <!-- Reset Password Card -->
            <div class="col-md-6">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <div class="card-icon mb-3">
                            <i class="bi bi-key-fill"></i>
                        </div>
                        <h5 class="card-title">Reset Password</h5>
                        <p class="card-text">Change your password to secure your account.</p>
                        <a href="../reset_password.php" class="btn btn-warning">Reset Password</a>
                    </div>
                </div>
            </div>

            <!-- Logout Card -->
            <div class="col-md-6">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <div class="card-icon mb-3">
                            <i class="bi bi-box-arrow-right"></i>
                        </div>
                        <h5 class="card-title">Logout</h5>
                        <p class="card-text">Logout from your admin account securely.</p>
                        <a href="../logout.php" class="btn btn-danger">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
</body>
</html>

