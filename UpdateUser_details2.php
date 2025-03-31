<?php
session_start(); // Start the session

// Check if the form data is posted and if the employeeId is set in the session
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Use consistent session variable name
    

    $name = $_POST['name'];
    $Aadhar_Number = $_POST['Aadhar_Number'];
    $Village = $_POST['Village'];
    $Mandal = $_POST['Mandal'];
    $District = $_POST['District'];
    $Number=$_POST['Number'];
    $Mail_id=$_POST['Mail_id'];
    $Password = $_POST['Password'];
   

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "user";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the update query
    $sql = "UPDATE user_registration SET  Name = ?, Aadhar_Number = ?, Village=?, Mandal=?, District=?, Phone_number= ?, Mail_id=?, Password = ? WHERE user_id = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $name, $Aadhar_Number,  $Village, $Mandal, $District, $Number,  $Mail_id, $Password, $user_id);


    if ($stmt->execute()) {
        echo "<p>Details updated successfully. <a href='User_Profile.php'> Click here to go back</p>";
        
        
    } else {
        echo "<p>Error updating details: " . $stmt->error . "</p>";
    }

    $stmt->close();
} else {
    echo "<p>Invalid request.</p>";
}
?>
