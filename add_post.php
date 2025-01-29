<?php
include 'includes/db.php';
include 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'] ?? null;
    $content = $_POST['content'] ?? null;
    $user_id = $_POST['user_id'] ?? null;
    $module_id = $_POST['module_id'] ?? null;

    // Validate form data
    if (!$title || !$content || !$user_id || !$module_id) {
        echo "<div class='alert alert-danger'>All fields are required!</div>";
    } else {
        $image_path = null;
        if (isset($_FILES['image']['name']) && $_FILES['image']['name']) {
            $image_path = time() . '_' . $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image_path);
        }

        // Insert post into the database
        try {
            $stmt = $pdo->prepare("INSERT INTO posts (title, content, user_id, module_id, image_path) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$title, $content, $user_id, $module_id, $image_path]);
            header('Location: index.php');
            exit;
        } catch (PDOException $e) {
            echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
        }
    }
}
?>

<h1>Add New Post</h1>
<form action="add_post.php" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" id="title" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea name="content" id="content" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
        <label for="user_id" class="form-label">Author</label>
        <select name="user_id" id="user_id" class="form-control" required>
            <option value="">Select Author</option>
            <?php
            $users = $pdo->query("SELECT id, username FROM users")->fetchAll(PDO::FETCH_ASSOC);
            foreach ($users as $user) {
                echo "<option value='{$user['id']}'>{$user['username']}</option>";
            }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="module_id" class="form-label">Module</label>
        <select name="module_id" id="module_id" class="form-control" required>
            <option value="">Select Module</option>
            <?php
            $modules = $pdo->query("SELECT id, module_name FROM modules")->fetchAll(PDO::FETCH_ASSOC);
            foreach ($modules as $module) {
                echo "<option value='{$module['id']}'>{$module['module_name']}</option>";
            }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" name="image" id="image" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Add Post</button>
</form>

<?php include 'includes/footer.php'; ?>
