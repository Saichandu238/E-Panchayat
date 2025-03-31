<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root"; // Change if you have a different username
    $password = ""; // Change if you have a different password
    $dbname = "user";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $Mail_id= $conn->real_escape_string($_POST['Mail_id']);
    $Password = $_POST['Password'];

    $sql = "SELECT * FROM user_registration WHERE Mail_id = '$Mail_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); 

        if ($row['Password']==$Password){
            $_SESSION['Mail_id']=$Mail_id;
            $_SESSION['Village']=$row['Village'];
            $_SESSION['FCS']=$row['FSC_number'];
            $_SESSION['Mandal']=$row['Mandal'];
            $_SESSION['District']=$row['District'];
            $_SESSION['Name']=$row['Name'];
            $_SESSION['user_id']=$row['user_id'];
            $_SESSION['Number']=$row['Phone_number'];
            $_SESSION['Gmail']=$row['Mail_id'];
            $_SESSION['Aadhar_Number']=$row['Aadhar_number'];
            // echo "login successfull and you can remove this at the end of the project in from user_loginAuthentication.php";
            
            include 'User_Profile.php';
        } else {
            include 'user_login.html';
            echo "Invalid password. saichandu";
        }
    } else {
        include 'user_login.html';

        echo "No user found with the Employee ID '$Mail_id'.";
    }

 
}
?>