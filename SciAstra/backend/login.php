<?php
include 'db_connect.php';
require_once 'vendor/autoload.php';  // Include JWT library (use Composer to install 'firebase/php-jwt')

// Secret key for JWT (use environment variables for production)
define('JWT_SECRET_KEY', 'your-secret-key');

// Check if login form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user from the database
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        // User authenticated successfully, create JWT
        $payload = [
            'id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'role' => $user['role'],
            'iat' => time(),  // Issued at
            'exp' => time() + 3600  // Expiration time (1 hour)
        ];

        // Encode JWT
        $jwt = \Firebase\JWT\JWT::encode($payload, JWT_SECRET_KEY);

        // Send the token to the frontend
        echo json_encode(['token' => $jwt]);
    } else {
        echo "Invalid email or password!";
    }
}
?>
