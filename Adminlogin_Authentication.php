<?php
// Start a session to manage user sessions
session_start();

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$database = "villagelogins"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $admin_id = $_POST['Admin_id'];
    $mail_id = $_POST['mail_id'];
    $password = $_POST['password'];

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM admindetails WHERE ID = ? AND Gmail = ?");
    $stmt->bind_param("ss", $admin_id, $mail_id);

    // Execute the statement
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a matching record was found
    if ($result->num_rows > 0) {
        // Fetch the user record
        $user = $result->fetch_assoc();

        // Verify the password (assuming the password is stored as plain text)
        // It is highly recommended to store passwords as hashed values (using password_hash() and verify with password_verify())
        if ($password === $user['Password']) {
            // Set session variables
            $_SESSION['admin_id'] = $user['ID'];
            $_SESSION['mail_id'] = $user['Gmail'];
            $_SESSION['Name']=$user['Name'];
            $_SESSION['Village']=$user['Village'];
            $_SESSION['Mandal']=$user['Mandal'];
            $_SESSION['District']=$user['District'];
            $_SESSION['Number']=$user['Number'];
            $_SESSION['Aadhar_number']=$user['Aadhar_number'];

            // Redirect to the admin dashboard or home page
            header("Location: Admin_Profile.php"); // Replace with the desired landing page
            exit();
        } else {
            // Invalid password
            echo "Invalid password. <a href='Admin_login.html'>Try again</a>";
        }
    } else {
        // Invalid Admin ID or Email
        echo "Invalid Admin ID or Email. <a href='Admin_login.html'>Try again</a>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>