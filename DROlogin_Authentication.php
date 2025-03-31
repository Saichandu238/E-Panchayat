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

    $Employee_Id= $conn->real_escape_string($_POST['Employee_Id']);
    $Mail_id= $conn->real_escape_string($_POST['Mail_id']);
    $Password = $_POST['Password'];

    $sql = "SELECT * FROM dro_details WHERE Employee_Id = '$Employee_Id' and Gmail='$Mail_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); 

        if ($row['Password']==$Password){
            $_SESSION['Employee_Id']=$Employee_Id;
            $_SESSION['Mandal']=$row['Mandal'];
            $_SESSION['Village']=$row['Village'];
            $_SESSION['District']=$row['District'];
            $_SESSION['Name']=$row['Name'];
            // echo "login successfull and you can remove this at the end of the project in from MRO_loginAuthentication.php";
            
            include 'DRO_Profile.php';
        } else {
            include 'DRO_login.html';
            echo "Invalid password. saichandu";
        }
    } else {
        include 'DRO_login.html';
        echo "No login details found with the Authentication_id '$Employee_Id'. or mail_id '$Mail_id";
    }

 
}
?>