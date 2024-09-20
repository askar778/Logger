<?php

// Load environment variables from .env file
require 'vendor/autoload.php'; // Ensure this path is correct

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


// Error reporting (for debugging purposes)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user credentials from POST data
    $username = $_POST['username'];
    $input_password = $_POST['password'];
    
    // Prepare and execute the query to fetch the hashed password
    $sql = "SELECT password FROM Users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();
    $stmt->close();
    
    // Verify the password
    if (password_verify($input_password, $hashed_password)) {
        // Password is correct, redirect to home.php
        header("Location: home.php");
        exit;
    } else {
        // Password is incorrect or username does not exist
        echo "Invalid username or password.";
    }
}

// Close the connection
$conn->close();
?>

