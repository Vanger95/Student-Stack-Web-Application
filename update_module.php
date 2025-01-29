<?php
session_start();
include 'db.php';

// Check if user is an admin
if ($_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit;
}

// Get Module Details
if (isset($_GET['id'])) {
    $module_id = $_GET['id'];
    $stmt = $pdo->prepare('SELECT * FROM modules WHERE id = ?');
    $stmt->execute([$module_id]);
    $module = $stmt->fetch();

    if (!$module) {
        die('Module not found!');
    }
}

// Update Module Name
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_name = $_POST['module_name'];
    $stmt = $pdo->prepare('UPDATE modules SET name = ? WHERE id = ?');
    $stmt->execute([$new_name, $module_id]);
    header('Location: manage_modules.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Module</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Update Module</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="module_name" class="form-label">Module Name</label>
                <input type="text" name="module_name" id="module_name" class="form-control" value="<?= htmlspecialchars($module['name']) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Module</button>
        </form>
    </div>
</body>
</html>
