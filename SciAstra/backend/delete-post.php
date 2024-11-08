<?php
// Assuming you're using MySQLi
include 'db_connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the blog post
    $query = "DELETE FROM blog_posts WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();

    header('Location: dashboard.php');  // Redirect after deletion
}
?>
