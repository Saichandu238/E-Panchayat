
<?php
// Start the session to access session variables
session_start();

// Check if the user is logged in and the email is set in the session
if (!isset($_SESSION['Mail_id'])) {
    die("You must be logged in to view this page.");
}

// Get the email from the session
$Mail_id = $_SESSION['Mail_id'];

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to get the village of the user based on their email
$sql_village = "SELECT Village FROM user_registration WHERE Mail_id='$Mail_id'";
$result_village = $conn->query($sql_village);

if ($result_village->num_rows > 0) {
    $row_village = $result_village->fetch_assoc();
    $Village = $row_village['Village'];
} else {
    die("No village information found for this user.");
}

// SQL query to count the number of registered users from the user's village
$sql_count = "SELECT COUNT(*) as count FROM user_registration WHERE Village='$Village'";
$result_count = $conn->query($sql_count);

if ($result_count->num_rows > 0) {
    $row_count = $result_count->fetch_assoc();
    $user_count = $row_count['count'];
} else {
    $user_count = 0;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Number of Registered Families</title>
    <style>
        .container {
            text-align: center;
            padding: 50px;
        }
        .count {
            font-size: 24px;
            color: green;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Number of Registered Families</h1>
        <p class="count"><?php echo $user_count; ?></p>
        <a href="user_profile.html">Back to Profile</a>
    </div>
</body>
</html>
