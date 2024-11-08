<?php
// account-dashboard.php
include 'db_connect.php';
require_once 'verify_token.php';

// Get the JWT from the request (header or cookies)
$jwt = $_COOKIE['jwt_token'] ?? null;

if ($jwt) {
    $decoded = verify_jwt($jwt);
    if ($decoded) {
        // Fetch user details from database
        $userId = $decoded->id;
        $query = "SELECT * FROM users WHERE id = $userId";
        $result = $conn->query($query);
        $user = $result->fetch_assoc();

        echo "Welcome, " . $user['username'];
        echo "<br>Email: " . $user['email'];
        // Optionally, display user purchases, course access, etc.
    } else {
        echo "Invalid token or expired session.";
    }
} else {
    echo "Please login to access your account!";
}
?>
