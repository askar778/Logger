<?php
require __DIR__ . '/../vendor/autoload.php'; // Adjust the path if necessary

// Create MongoDB client
$client = new MongoDB\Client("mongodb://localhost:27017"); // Change URI as needed
$collection = $client->your_database_name->your_collection_name; // Replace with your DB and collection names

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Log incoming form data
    error_log("Form submitted: " . print_r($_POST, true));

    // Capture form variables
    $firstname = $_POST['firstname'] ?? null;
    $lastname = $_POST['lastname'] ?? null;
    $password = $_POST['password'] ?? null;
    $confirm_password = $_POST['confirm_password'] ?? null;

    // Log captured variables
    error_log("First Name: $firstname");
    error_log("Last Name: $lastname");
    
    // Check if passwords match
    if ($password !== $confirm_password) {
        error_log("Passwords do not match!");
        echo "Passwords do not match!";
        exit;
    }

    // Prepare the data for insertion
    $data = [
        'firstname' => $firstname,
        'lastname' => $lastname,
        // Add other fields as needed
    ];

    // Attempt to insert into MongoDB
    try {
        $result = $collection->insertOne($data); // Your insert code here
        error_log("Insert result: " . print_r($result, true));
        echo "Data inserted successfully!";
    } catch (MongoDB\Driver\Exception\Exception $e) {
        error_log("MongoDB Insert Error: " . $e->getMessage());
        echo "MongoDB Insert Error: " . $e->getMessage();
    }
}
?>
