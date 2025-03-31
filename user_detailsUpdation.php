<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    $user_id = $conn->real_escape_string($_POST['user_id']);
    $FSC_number = $conn->real_escape_string($_POST['FSC_number']);
    $Aadhar_number = $conn->real_escape_string($_POST['Aadhar_number']);
    $Name = $conn->real_escape_string($_POST['Name']);
    $Village = $conn->real_escape_string($_POST['Village']);
    $Phone_number = $conn->real_escape_string($_POST['Phone_number']);
    $Mail_id = $conn->real_escape_string($_POST['Mail_id']);
    $Password = $_POST['Password'];


    // Check if user_id exists
    $check_query = "SELECT * FROM user_registration WHERE user_id = '$user_id'";
    $result = $conn->query($check_query);

    if ($result->num_rows == 0) {
        // User ID does not exist
        die("User ID does not exist.");
    }


    // Prepare and execute update query
    $update_fields = [];
    if (!empty($FSC_number)) {
        // Validate the FSC number to ensure it consists of up to 15 alphanumeric characters
        if (preg_match("/^[a-zA-Z0-9]{1,15}$/", $FSC_number)) {
            $update_fields[] = "FSC_number='$FSC_number'";
        } else {
            die("FSC number must consist of up to 15 alphanumeric characters.");
        }
    }
    
    if (!empty($Aadhar_number)) {
        // Validate the Aadhar number to ensure it is exactly 12 digits long
        if (preg_match("/^\d{12}$/", $Aadhar_number)) {
            $update_fields[] = "Aadhar_number='$Aadhar_number'";
        } else {
            die("Aadhar number must be exactly 12 digits.");
        }
    }
    if (!empty($Name)) {
        $update_fields[] = "Name='$Name'";
    }
    if (!empty($Village)) {
        $update_fields[] = "Village='$Village'";
    }
    if (!empty($Phone_number)) {
        $update_fields[] = "Phone_number='$Phone_number'";
    }
    if (!empty($Mail_id)) {
        $update_fields[] = "Mail_id='$Mail_id'";
    }
    if (!empty($Password)) {
        if (strlen($Password)>=8){
             $update_fields[] = "Password='$Password'";
        } else {
            die("Password must be atleast 8 characters long. ");
    }
}

    if (count($update_fields) > 0) {
        $update_query = "UPDATE user_registration SET " . implode(', ', $update_fields) . " WHERE user_id = '$user_id'";
        if ($conn->query($update_query) === TRUE) {
            echo 'Record updated successfully. <a href="user_login.html">Click here to go back</a>';

        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "No new data provided to update.";
    }

    $conn->close();
}
?>
