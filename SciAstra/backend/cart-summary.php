<?php
// cart-summary.php
$cart = json_decode(file_get_contents('php://input'), true);  // Simulating cart retrieval from session

$totalPrice = 0;

foreach ($cart as $item) {
    // For each course, fetch details from the courses table
    $query = "SELECT * FROM courses WHERE id = " . $item['id'];
    $result = $conn->query($query);
    $course = $result->fetch_assoc();
    $totalPrice += $course['price'];
}
?>

<!-- Display Cart Summary -->
<h3>Your Cart</h3>
<ul>
    <?php foreach ($cart as $item): ?>
        <li><?php echo $item['name']; ?> - $<?php echo $item['price']; ?></li>
    <?php endforeach; ?>
</ul>

<p>Total: $<?php echo $totalPrice; ?></p>

<a href="checkout.php">Proceed to Checkout</a>
