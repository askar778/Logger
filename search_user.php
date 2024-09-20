<?php

// Load environment variables from .env file
require 'vendor/autoload.php'; // Ensure this path is correct

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Database connection credentials
$servername = $_ENV['DB_SERVER'];
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];
$dbname = $_ENV['DB_NAME'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the username from the POST request
$username = $_POST['username'];

// Prepare and execute the query to fetch the password for the given username
$sql = "SELECT password FROM Users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $username);
$stmt->execute();
$stmt->bind_result($password);

if ($stmt->fetch()) {
    echo "Password for user '$username' is: " . htmlspecialchars($password);
} else {
    echo "No user found with the username '$username'.";
}

$stmt->close();
$conn->close();
?>

