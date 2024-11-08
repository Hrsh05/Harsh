<?php
// Assuming you're using MySQLi
include 'db_connect.php';  // Connect to the database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author_id = $_SESSION['user_id'];  // Assuming the admin is logged in and the user_id is stored in session
    $publish_time = $_POST['publish_time'];  // format: YYYY-MM-DD HH:MM:SS

    // Insert the new blog post
    $query = "INSERT INTO blog_posts (title, content, author_id, publish_time) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssis', $title, $content, $author_id, $publish_time);
    $stmt->execute();
    header('Location: dashboard.php');  // Redirect after insertion
}
?>

<form action="create-post.php" method="POST">
    <label for="title">Title:</label><br>
    <input type="text" id="title" name="title" required><br>
    
    <label for="content">Content:</label><br>
    <textarea id="content" name="content" required></textarea><br>
    
    <label for="publish_time">Publish Time:</label><br>
    <input type="datetime-local" id="publish_time" name="publish_time" required><br>
    
    <input type="submit" value="Create Post">
</form>
