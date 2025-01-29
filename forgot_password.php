<?php
require_once 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        $token = bin2hex(random_bytes(32));
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));
        $stmt = $pdo->prepare("UPDATE users SET reset_token = ?, reset_token_expiry = ? WHERE email = ?");
        $stmt->execute([$token, $expiry, $email]);

        // Send email (pseudo code)
        // mail($email, "Reset Password", "Here is your reset link: <link>");
    }
    echo "If this email is registered, a reset link will be sent.";
}
?>

<?php include 'includes/header.php'; ?>
<form method="POST">
    <h2>Forgot Password</h2>
    <input type="email" name="email" placeholder="Email" required>
    <button type="submit">Submit</button>
</form>
<?php include 'includes/footer.php'; ?>
