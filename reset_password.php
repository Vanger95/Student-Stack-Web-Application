<?php
require_once 'includes/db.php';
session_start();

// Initialize variables
$error_message = '';
$success_message = '';
$isAdmin = false;

// Check if user is logged in and is an admin
if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
    $isAdmin = true;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $old_password = $_POST['old_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';

    // Validate input fields
    if (empty($email) || empty($old_password) || empty($new_password)) {
        $error_message = "All fields are required.";
    } else {
        try {
            // Fetch user by email
            $stmt = $pdo->prepare("SELECT id, password FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if ($user && password_verify($old_password, $user['password'])) {
                // Update password
                $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
                $update_stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
                $update_stmt->execute([$hashed_password, $user['id']]);

                if ($update_stmt->rowCount()) {
                    // Set success message and redirect to login
                    $_SESSION['success_message'] = "Password reset successfully. Please log in with your new password.";
                    header('Location: login.php');
                    exit;
                } else {
                    $error_message = "Failed to update password. Please try again.";
                }
            } else {
                $error_message = "Invalid email or incorrect old password.";
            }
        } catch (Exception $e) {
            $error_message = "An error occurred: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | Student Stack</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .reset-form {
            max-width: 400px;
            width: 100%;
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .reset-form h2 {
            margin-bottom: 1.5rem;
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
        .form-text {
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="reset-form">
        <h2>Reset Password</h2>
        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
            </div>
            <div class="mb-3">
                <label for="old_password" class="form-label">Old Password</label>
                <input type="password" name="old_password" id="old_password" class="form-control" placeholder="Enter your old password" required>
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">New Password</label>
                <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Enter your new password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Reset Password</button>
            <?php if ($isAdmin): ?>
                <div class="text-center mt-3">
                    <small class="form-text"><a href="dashboard.php">Back to Dashboard</a></small>
                </div>
            <?php endif; ?>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
