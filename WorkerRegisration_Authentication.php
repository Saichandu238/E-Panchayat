<?php
// Database configuration
$servername = "localhost"; // Change this to your database server
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "user"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect and sanitize form data
$name = $conn->real_escape_string($_POST['name']);
$dob = $conn->real_escape_string($_POST['dob']);
$gender = $conn->real_escape_string($_POST['gender']);
$aadhar_number = $conn->real_escape_string($_POST['aadhar_number']);
$joining_date = $conn->real_escape_string($_POST['joining_date']);
$worker_type = $conn->real_escape_string($_POST['worker_type']);
$salary = $conn->real_escape_string($_POST['salary']);
$number = $conn->real_escape_string($_POST['number']);
$village = $conn->real_escape_string($_POST['village']);
$mandal = $conn->real_escape_string($_POST['mandal']);
$district = $conn->real_escape_string($_POST['district']);

// Insert data into database
$sql = "INSERT INTO gram_panchayat_workers (Name, DOB, Gender, Aadhar_Number, Joining_date, WorkerType, Salary, Number, Village, Mandal, District)
        VALUES ('$name', '$dob', '$gender', '$aadhar_number', '$joining_date', '$worker_type', '$salary', '$number', '$village', '$mandal', '$district')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
