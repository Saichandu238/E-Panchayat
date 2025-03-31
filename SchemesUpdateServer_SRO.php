<?php
// Start the session
session_start();

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "schemes";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve POST data
$village = $_POST['village'] ?? '';
$mandal = $_POST['mandal'] ?? '';
$district = $_POST['district'] ?? '';
$state = $_POST['state'] ?? '';
$schemeType = $_POST['schemeType'] ?? '';
$goNumber = $_POST['goNumber'] ?? '';
$description = $_POST['description'] ?? '';
$startDate = $_POST['startDate'] ?? '';
$amount = $_POST['amount'] ?? '';

// Validate POST data
if (empty($village) || empty($mandal) || empty($district) || empty($schemeType) || empty($goNumber) || empty($description) || empty($startDate) || empty($amount)) {
    die("Error: Missing required POST data.");
}

// Prepare the SQL insertion query
$sql = "INSERT INTO schemes (Village, Mandal, District, State, SchemeType, Go_Number, Description, Start_date, Amount) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Prepare the statement
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

// Bind the parameters
$stmt->bind_param("sssssssss", $village, $mandal, $district, $state, $schemeType, $goNumber, $description, $startDate, $amount);

// Execute the query
if ($stmt->execute()) {
    echo "Details inserted successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
