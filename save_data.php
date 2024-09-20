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
    // Get form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $address = $_POST['address'];
    
    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
        exit;
    }
    
    // Hash password before saving for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO Users (firstname, lastname, username, email, phone, address, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param( "sssssss", $firstname, $lastname, $username, $email, $phone,  $address, $hashed_password);
    
    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to login page
        header("Location: logger.html");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>

