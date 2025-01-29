<?php
include 'includes/db.php';
include 'includes/header.php';

$query = "SELECT posts.id, posts.title, posts.content, posts.image_path, users.username, modules.module_name
          FROM posts
          JOIN users ON posts.user_id = users.id
          JOIN modules ON posts.module_id = modules.id
          ORDER BY posts.created_at DESC";
$posts = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
?>

<h1 class="text-center">Student Questions</h1>
<a href="add_post.php" class="btn btn-success mb-3">Add New Post</a>
<div class="row">
    <?php foreach ($posts as $post): ?>
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($post['title']) ?></h5>
                    <p class="card-text"><?= nl2br(htmlspecialchars(substr($post['content'], 0, 100))) ?>...</p>
                    <?php if ($post['image_path']): ?>
                        <img src="uploads/<?= htmlspecialchars($post['image_path']) ?>" alt="Post Image" class="img-fluid">
                    <?php endif; ?>
                    <p><strong>Author:</strong> <?= htmlspecialchars($post['username']) ?></p>
                    <p><strong>Module:</strong> <?= htmlspecialchars($post['module_name']) ?></p>
                    <a href="edit_post.php?id=<?= $post['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete_post.php?id=<?= $post['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php include 'includes/footer.php'; ?>
