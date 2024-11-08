<?php
// Assuming you're using MySQLi
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $publish_time = $_POST['publish_time'];

    // Update the blog post
    $query = "UPDATE blog_posts SET title = ?, content = ?, publish_time = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssi', $title, $content, $publish_time, $id);
    $stmt->execute();
    header('Location: dashboard.php');  // Redirect after update
}

// Fetch existing post details
$id = $_GET['id'];
$query = "SELECT * FROM blog_posts WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();
?>

<form action="update-post.php" method="POST">
    <input type="hidden" name="id" value="<?= $post['id'] ?>">
    
    <label for="title">Title:</label><br>
    <input type="text" id="title" name="title" value="<?= $post['title'] ?>" required><br>
    
    <label for="content">Content:</label><br>
    <textarea id="content" name="content" required><?= $post['content'] ?></textarea><br>
    
    <label for="publish_time">Publish Time:</label><br>
    <input type="datetime-local" id="publish_time" name="publish_time" value="<?= date('Y-m-d\TH:i', strtotime($post['publish_time'])) ?>" required><br>
    
    <input type="submit" value="Update Post">
</form>
