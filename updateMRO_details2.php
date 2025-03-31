<?php
session_start(); // Start the session

// Check if the form data is posted and if the employeeId is set in the session
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['Employee_Id'])) {
    $Employee_Id = $_SESSION['Employee_Id']; // Use consistent session variable name

    $name = $_POST['name'];
    $Aadhar_Number = $_POST['Aadhar_Number'];
    $DOB = $_POST['DOB'];
    $Joining_date = $_POST['Joining_date'];
    $Village = $_POST['Village'];
    $Mandal = $_POST['Mandal'];
    $District = $_POST['District'];
    $Mail_id=$_POST['Mail_id'];
    $Password = $_POST['Password'];
   

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "revenuelogindetails";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the update query
    $sql = "UPDATE mro_details SET  Name = ?, Aadhar_Number = ?, DOB= ?, Joining_date=?, Village=?, Mandal=?, District=?, Gmail=?, Password = ? WHERE Employee_Id = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssss", $name, $Aadhar_Number, $DOB, $Joining_date, $Village, $Mandal, $District, $Mail_id, $Password, $Employee_Id);


    if ($stmt->execute()) {
        echo "<p>Details updated successfully. <a href='MRO_Profile.php'> Click here to go back</p>";
        
        
    } else {
        echo "<p>Error updating details: " . $stmt->error . "</p>";
    }

    $stmt->close();
} else {
    echo "<p>Invalid request.</p>";
}
?>
