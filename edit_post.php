<?php
include 'includes/db.php';
include 'includes/header.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->execute([$id]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_POST['user_id'];
    $module_id = $_POST['module_id'];

    $image_path = $post['image_path'];
    if ($_FILES['image']['name']) {
        $image_path = time() . '_' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image_path);
    }

    $stmt = $pdo->prepare("UPDATE posts SET title = ?, content = ?, user_id = ?, module_id = ?, image_path = ? WHERE id = ?");
    $stmt->execute([$title, $content, $user_id, $module_id, $image_path, $id]);

    header('Location: index.php');
}
?>

<h1>Edit Post</h1>
<form action="edit_post.php?id=<?= $id ?>" method="post" enctype="multipart/form-data">
    <label>Title</label>
    <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($post['title']) ?>" required>
    <label>Content</label>
    <textarea name="content" class="form-control" required><?= htmlspecialchars($post['content']) ?></textarea>
    <label>Author</label>
    <select name="user_id" class="form-control">
        <?php
        $users = $pdo->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($users as $user) {
            $selected = $user['id'] == $post['user_id'] ? 'selected' : '';
            echo "<option value='{$user['id']}' {$selected}>{$user['username']}</option>";
        }
        ?>
    </select>
    <label>Module</label>
    <select name="module_id" class="form-control">
        <?php
        $modules = $pdo->query("SELECT * FROM modules")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($modules as $module) {
            $selected = $module['id'] == $post['module_id'] ? 'selected' : '';
            echo "<option value='{$module['id']}' {$selected}>{$module['module_name']}</option>";
        }
        ?>
    </select>
    <label>Image</label>
    <input type="file" name="image" class="form-control">
    <?php if ($post['image_path']): ?>
        <img src="uploads/<?= htmlspecialchars($post['image_path']) ?>" alt="Post Image" width="200">
    <?php endif; ?>
    <button type="submit" class="btn btn-primary mt-3">Update Post</button>
</form>

<?php include 'includes/footer.php'; ?>
