// payment-success.php
include 'backend/db_connect.php';

// Get the user ID and course ID
$user_id = $_SESSION['user_id'];  // Assuming the user is logged in
$course_id = $_SESSION['cart_course_id'];  // Store cart course details in session
$total_price = $_SESSION['total_price'];  // Store total price in session

// Insert the transaction into the database
$query = "INSERT INTO transactions (user_id, course_id, total_price, payment_status)
          VALUES ($user_id, $course_id, $total_price, 'completed')";
$conn->query($query);

// After successful payment, redirect to a thank-you page or course access page
header('Location: thank-you.php');
