<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root"; // Change if you have a different username
    $password = ""; // Change if you have a different password
    $dbname = "revenuelogindetails";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $employee_id= $conn->real_escape_string($_POST['Employee_Id']);
    $Password = $_POST['Password'];

    $sql = "SELECT * FROM mro_details WHERE Employee_Id = '$employee_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); 

        if ($row['Password']==$Password){
            $_SESSION['Employee_Id']=$employee_id;
            $_SESSION['Employee_ID']=$row['Employee_Id'];
            $_SESSION['Mandal']=$row['Mandal'];
            $_SESSION['Village']=$row['Village'];
            $_SESSION['District']=$row['District'];
            $_SESSION['Name']=$row['Name'];
            // echo "login successfull and you can remove this at the end of the project in from MRO_loginAuthentication.php";
            
            include 'MRO_Profile.php';
        } else {
            include 'MRO_login.html';
            echo "Invalid password. saichandu";
        }
    } else {
        include 'MRO_login.html';
        echo "No Employee found with the Employee ID '$employee_id'.";
    }

 
}
?>




 
