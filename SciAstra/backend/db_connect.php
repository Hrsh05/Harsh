<?php
// db_connect.php: Establishing connection to the MySQL database

$host = 'localhost';       // Database host (typically localhost for local servers)
$username = 'root';        // Database username (default for XAMPP/MAMP is 'root')
$password = '';            // Database password (default for XAMPP/MAMP is an empty string)
$dbname = 'sciastra_blog'; // The name of the database you created

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
