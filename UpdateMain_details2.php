<?php
session_start(); // Start the session

// Check if the form data is posted and if the admin_id is set in the session
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['Authentication_id'])) {
    $main_id = $_SESSION['Authentication_id']; // Use consistent session variable name

    $Name = $_POST['Name'];
    $Number = $_POST['Number'];
    $Mail_id = $_POST['Mail_id'];
    $Password = $_POST['Password'];
   
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "superior";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the update query
    $sql = "UPDATE mainlogindetails SET  Name = ?, Number = ?, Mail_id = ?, Password = ? WHERE Authentication_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $Name, $Number, $Mail_id, $Password, $main_id);

    if ($stmt->execute()) {
        echo "<p>Details updated successfully. <a href='Main_Profile.php'>Click here to Go back</p>";
    } else {
        echo "<p>Error updating details: " . $stmt->error . "</p>";
    }

    $stmt->close();
} else {
    echo "<p>Invalid request.</p>";
}
?>