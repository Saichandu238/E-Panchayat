<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$database = "superior"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $Authentication_id = $_POST['Authentication_id'];
    $Name=$_POST['Name'];
    $Aadhar_number = $_POST['Aadhar_number'];
    $DOB=$_POST['DOB'];
    $joining_date = $_POST['Joining_date'];
    $village = $_POST['Village'];
    $mandel = $_POST['Mandal'];
    $district = $_POST['District'];
    $Number = $_POST['Number'];
    $email = $_POST['Gmail'];
    $password = $_POST['Password'];




    $checkQuery = "SELECT * FROM statemanager WHERE SManager_id = ?";
     $stmt = $conn->prepare($checkQuery);
     $stmt->bind_param("s", $Authentication_id);
     $stmt->execute();
     $result = $stmt->get_result();
 
     if ($result->num_rows > 0) {
         // Aadhaar number already exists
         echo "State Manager already registered with this Authentication ID.";
     } else {


     // Check if the Aadhaar number already exists
     $checkQuery = "SELECT * FROM statemanager WHERE Aadhar_Number = ?";
     $stmt = $conn->prepare($checkQuery);
     $stmt->bind_param("s", $Aadhar_number);
     $stmt->execute();
     $result = $stmt->get_result();
 
     if ($result->num_rows > 0) {
         // Aadhaar number already exists
         echo "statemanager already registered with this Aadhar number.";
     } else {

         // Check if the Mail ID already exists
     $checkQuery = "SELECT * FROM statemanager WHERE Mail_id = ?";
     $stmt = $conn->prepare($checkQuery);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $result = $stmt->get_result();
 
     if ($result->num_rows > 0) {
         // Aadhaar number already exists
         echo "statemanager already registered with this Mail ID";
     } else {
          // Check if the Phone number already exists
    //  $checkQuery = "SELECT * FROM Serpanchdetails WHERE Number = ?";
    //  $stmt = $conn->prepare($checkQuery);
    //  $stmt->bind_param("s", $phone_number);
    //  $stmt->execute();
    //  $result = $stmt->get_result();
 
    //  if ($result->num_rows > 0) {
    //      // Aadhaar number already exists
    //      echo "Serpanch already registered with this Phone Number";
    //  } else {
        

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO statemanager (SManager_id, Name, Aadhar_Number, DOB, Joining_date, Village, Mandal, District,  Mail_id, Number, Password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssss", $Authentication_id, $Name, $Aadhar_number, $DOB, $joining_date, $village, $mandel, $district, $email, $Number, $password);

    // Execute the statement
    if ($stmt->execute()) {
        echo "state manager registered successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
}
     }
}

echo '<br>Click here to go back to <a href="SRO_Profile.php">Profile Page</a>';

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
