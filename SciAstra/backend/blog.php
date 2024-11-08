<?php
// Fetch blog posts for users
include 'db_connect.php';

// Pagination variables
$posts_per_page = 5;
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($current_page - 1) * $posts_per_page;

// Fetch posts for the current page
$query = "SELECT * FROM blog_posts WHERE publish_time <= NOW() ORDER BY publish_time DESC LIMIT $offset, $posts_per_page";
$result = $conn->query($query);

// Display posts
while ($post = $result->fetch_assoc()) {
    echo "<div>";
    echo "<h3><a href='post-details.php?id=" . $post['id'] . "'>" . $post['title'] . "</a></h3>";
    echo "<p>" . substr($post['content'], 0, 150) . "...</p>";
    echo "</div>";
}

// Pagination Links
$query = "SELECT COUNT(id) AS total FROM blog_posts WHERE publish_time <= NOW()";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$total_posts = $row['total'];
$total_pages = ceil($total_posts / $posts_per_page);

echo "<div class='pagination'>";
for ($i = 1; $i <= $total_pages; $i++) {
    echo "<a href='blog.php?page=$i'>$i</a> ";
}
echo "</div>";
?>
