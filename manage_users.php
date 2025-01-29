<?php
include 'includes/db.php';
include 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete'])) {
        $id = $_POST['user_id'];
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
    } else {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $stmt = $pdo->prepare("INSERT INTO users (username, email) VALUES (?, ?)");
        $stmt->execute([$username, $email]);
    }
}

$users = $pdo->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Manage Users</h1>
<form method="post" class="mb-3">
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" id="username" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Add User</button>
</form>

<h2>User List</h2>
<ul class="list-group">
    <?php foreach ($users as $user): ?>
        <li class="list-group-item">
            <?= htmlspecialchars($user['username']) ?> (<?= htmlspecialchars($user['email']) ?>)
            <form method="post" class="d-inline">
                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                <button type="submit" name="delete" class="btn btn-danger btn-sm">Delete</button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>

<?php include 'includes/footer.php'; ?>
