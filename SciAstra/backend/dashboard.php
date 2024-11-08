<?php
// Fetch all blog posts for the admin
include 'db_connect.php';
$query = "SELECT * FROM blog_posts ORDER BY publish_time DESC";
$result = $conn->query($query);

while ($post = $result->fetch_assoc()) {
    echo "<div>";
    echo "<h3>" . $post['title'] . "</h3>";
    echo "<p>" . substr($post['content'], 0, 100) . "...</p>";
    echo "<a href='update-post.php?id=" . $post['id'] . "'>Edit</a> | ";
    echo "<a href='delete-post.php?id=" . $post['id'] . "'>Delete</a>";
    echo "</div>";
}
?>

<?php
include 'verify_token.php';

$headers = apache_request_headers();
$jwt = null;

if (isset($headers['Authorization'])) {
    $jwt = str_replace('Bearer ', '', $headers['Authorization']);
}

if ($jwt) {
    $decoded = verify_jwt($jwt);
    if ($decoded && $decoded->role === 'admin') {
        // Allow admin access
        echo "Welcome, Admin!";
    } else {
        echo "Access Denied!";
    }
} else {
    echo "Authorization token required!";
}
?>
