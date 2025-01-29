<?php
include 'includes/db.php';
include 'includes/header.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete'])) {
        // Delete module
        $id = $_POST['module_id'];
        $stmt = $pdo->prepare("DELETE FROM modules WHERE id = ?");
        $stmt->execute([$id]);
    } elseif (isset($_POST['update'])) {
        // Update module
        $id = $_POST['module_id'];
        $module_name = trim($_POST['module_name']);
        $stmt = $pdo->prepare("UPDATE modules SET module_name = ? WHERE id = ?");
        $stmt->execute([$module_name, $id]);
    } else {
        // Add new module
        $module_name = trim($_POST['module_name']);
        $stmt = $pdo->prepare("INSERT INTO modules (module_name) VALUES (?)");
        $stmt->execute([$module_name]);
    }
}

// Fetch all modules
$modules = $pdo->query("SELECT * FROM modules")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Modules</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f7fc;
        }
        h1, h2 {
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
    <div class="container mt-5">
        <h1>Manage Modules</h1>
        <form method="post" class="mb-4">
            <div class="mb-3">
                <label for="module_name" class="form-label">Module Name</label>
                <input type="text" name="module_name" id="module_name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Module</button>
        </form>

        <h2>Module List</h2>
        <ul class="list-group">
            <?php foreach ($modules as $module): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><?= htmlspecialchars($module['module_name']) ?></span>
                    <div>
                        <form method="post" class="d-inline">
                            <input type="hidden" name="module_id" value="<?= $module['id'] ?>">
                            <!-- Update Button -->
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModuleModal<?= $module['id'] ?>">Edit</button>
                            <!-- Delete Button -->
                            <button type="submit" name="delete" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this module?')">Delete</button>
                        </form>
                    </div>
                </li>

                <!-- Edit Module Modal -->
                <div class="modal fade" id="editModuleModal<?= $module['id'] ?>" tabindex="-1" aria-labelledby="editModuleModalLabel<?= $module['id'] ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModuleModalLabel<?= $module['id'] ?>">Edit Module</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post">
                                    <input type="hidden" name="module_id" value="<?= $module['id'] ?>">
                                    <div class="mb-3">
                                        <label for="edit_module_name_<?= $module['id'] ?>" class="form-label">Module Name</label>
                                        <input type="text" name="module_name" id="edit_module_name_<?= $module['id'] ?>" class="form-control" value="<?= htmlspecialchars($module['module_name']) ?>" required>
                                    </div>
                                    <button type="submit" name="update" class="btn btn-primary">Update Module</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </ul>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php include 'includes/footer.php'; ?>
