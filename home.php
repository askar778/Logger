<?php
// Load environment variables from .env file
require 'vendor/autoload.php'; // Ensure this path is correct

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


$current_user = $_SESSION['username'];

// Fetch user details
$sql = "SELECT firstname, lastname, email, phone FROM Users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $current_user);
$stmt->execute();
$stmt->bind_result($firstname, $lastname, $email, $phone);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        .header {
            text-align: left;
            padding-bottom: 10px;
            border-bottom: 2px solid #ddd;
        }
        .header h1 {
            margin: 0;
        }
        .header h2 {
            margin: 0;
            color: #555;
        }
        .user-info {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .user-info div {
            width: 48%;
        }
        .logout-btn {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            margin-top: 20px;
        }
        .logout-btn:hover {
            background-color: #c82333;
        }
        .footer {
            text-align: center;
            padding: 10px;
            color: #888;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Logger</h1>
        <h2>Welcome to Logger, <?php echo htmlspecialchars($firstname); ?>!</h2>
    </div>

    <div class="user-info">
        <div>
            <h3>Personal Information</h3>
            <p><strong>First Name:</strong> <?php echo htmlspecialchars($firstname); ?></p>
            <p><strong>Last Name:</strong> <?php echo htmlspecialchars($lastname); ?></p>
        </div>
        <div>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
            <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($phone); ?></p>
        </div>
    </div>

    <button class="logout-btn" onclick="window.location.href='logger.html'">Logout</button>
</div>

<div class="footer">
    <p>Thank you for using Logger</p>
</div>

</body>
</html>

