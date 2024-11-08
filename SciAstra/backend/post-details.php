<?php
// Fetch and display individual blog post details
include 'db_connect.php';

$id = $_GET['id'];
$query = "SELECT * FROM blog_posts WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

echo "<h1>" . $post['title'] . "</h1>";
echo "<p>" . $post['content'] . "</p>";
?>
