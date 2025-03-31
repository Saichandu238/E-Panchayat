<?php
session_start(); // Start the session

if (!isset($_SESSION['FSC_number'])) {
    header("Location: user_login.html"); // Redirect to login if not authenticated
    exit();
}

// Connect to MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve FSC number from session
$FSC_number = $_SESSION['FSC_number'];

// Fetch user data from database
$sql = "SELECT * FROM user_registration WHERE FSC_number = '$FSC_number'";
$result = $conn->query($sql);

// Display user details
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<h1>User Profile</h1>";
    
    echo "<table style='border-collapse: collapse; width: 100%; border: 3px solid black;'>";
    
    echo "<tr><th style='border: 1px solid black;'>Field</th><th style='border: 1px solid black;'>Data</th></tr>";
    
    echo "<tr><td style='border: 1px solid black;'>User Id</td><td style='border: 1px solid black;'>". $row["user_id"]. "</td></tr>";

    echo "<tr><td style='border: 1px solid black;'>FSC Numberr</td><td style='border: 1px solid black;'>". $row["FSC_number"]. "</td></tr>";
    

    echo "<tr><td style='border: 1px solid black;'>Name</td><td style='border: 1px solid black;'>". $row["Name"]. "</td></tr>";

    echo "<tr><td style='border: 1px solid black;'>Aadhar Number</td><td style='border: 1px solid black;'>". $row["Aadhar_number"]. "</td></tr>";
    
    echo "<tr><td style='border: 1px solid black;'>Village</td><td style='border: 1px solid black;'>". $row["Village"]. "</td></tr>";
    
    echo "<tr><td style='border: 1px solid black;'>Phone Number</td><td style='border: 1px solid black;'>". $row["Phone_number"]. "</td></tr>";
    
    echo "<tr><td style='border: 1px solid black;'>Mail ID</td><td style='border: 1px solid black;'>". $row["Mail_id"]. "</td></tr>";

    echo "<tr><td style='border: 1px solid black;'>Password</td><td style='border: 1px solid black;'>". $row["Password"]. "</td></tr>";
    
    echo "</table>";

    // Fetch family details and count of families in the same village
    $sql_family = "SELECT * FROM family_registration WHERE FSC_number = '$FSC_number'";
    $result_family = $conn->query($sql_family);
    $num_families = $result_family->num_rows;

    echo "<h2>Family Details</h2>";
    if ($result_family->num_rows > 0) {
        echo "<table style='border-collapse: collapse; width: 100%; border: 1px solid black;'>";
        echo "<tr><th style='border: 1px solid black;'>Family ID</th><th style='border: 1px solid black;'>Family Name</th></tr>";
        while ($family = $result_family->fetch_assoc()) {
            echo "<tr>";
            echo "<td style='border: 1px solid black;'>". $family["Family_id"]. "</td>";
            echo "<td style='border: 1px solid black;'>". $family["Family_name"]. "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No family details found.";
    }

    // Count number of families registered in the same village
    $sql_village_families = "SELECT COUNT(*) AS num_families_in_village FROM family_registration WHERE Village = '". $row["Village"] ."'";
    $result_village_families = $conn->query($sql_village_families);
    $village_families = $result_village_families->fetch_assoc();
    $num_families_in_village = $village_families["num_families_in_village"];

    echo "<h2>Number of Families in Your Village</h2>";
    echo "<p>Number of families registered in your village: $num_families_in_village</p>";

    // Count number of villages registered
    $sql_villages = "SELECT COUNT(DISTINCT Village) AS num_villages FROM user_registration";
    $result_villages = $conn->query($sql_villages);
    $villages = $result_villages->fetch_assoc();
    $num_villages = $villages["num_villages"];

    echo "<h2>Number of Villages Registered</h2>";
    echo "<p>Number of villages registered: $num_villages</p>";

} else {
    echo "No user found with the FSC number: " . $FSC_number;
}

// Close database connection
$conn->close();
?>
