    <!-- course-listing.php -->
<?php
// Include database connection
include 'backend/db_connect.php';

// Fetch all courses
$query = "SELECT * FROM courses";
$result = $conn->query($query);

echo "<div class='course-list'>";
while ($course = $result->fetch_assoc()) {
    echo "<div class='course-card'>";
    echo "<h3>" . $course['name'] . "</h3>";
    echo "<p>" . $course['description'] . "</p>";
    echo "<p>Price: $" . $course['price'] . "</p>";
    echo "<p>Discount: " . $course['discount'] . "%</p>";
    echo "<p><a href='course-details.php?id=" . $course['id'] . "'>View Details</a></p>";
    echo "</div>";
}
echo "</div>";
?>

<!-- Add to Cart Button (course-details.php or course-listing.php) -->
<button onclick="addToCart(<?php echo $course['id']; ?>, <?php echo $course['price']; ?>)">Add to Cart</button>

<script>
function addToCart(courseId, price) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    const course = { id: courseId, price: price };

    // Check if the course is already in the cart
    const existingCourseIndex = cart.findIndex(item => item.id === courseId);
    if (existingCourseIndex === -1) {
        cart.push(course); // Add course if not already in cart
    }

    // Save the cart to localStorage
    localStorage.setItem('cart', JSON.stringify(cart));

    // Optionally, you can show a message or update a cart icon here
    alert('Course added to cart!');
}
</script>
